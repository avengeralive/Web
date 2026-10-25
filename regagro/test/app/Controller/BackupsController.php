<?php
require_once 'google-api-php-client/autoload.php';

class BackupsController extends AppController {

	public function index() {
	}
	
	public function _gooDriveServiceInsert($title, $data) {
		$this->layout = null;
		$this->autoRender = false;
		
		$client_id = '65406654197-ho3fo0jph3j9g5hkj07144gnaunq0e5p.apps.googleusercontent.com'; //Client ID
		$service_account_name = '65406654197-ho3fo0jph3j9g5hkj07144gnaunq0e5p@developer.gserviceaccount.com'; //Email Address
		$key_file_location = APP.'/lvse-dc55059e3a17.p12'; //key.p12

		echo "Service Account Access <br/>";
		if ($client_id == '65406654197-ho3fo0jph3j9g5hkj07144gnaunq0e5p@developer.gserviceaccount.com'
			|| !strlen($service_account_name)
			|| !strlen($key_file_location)) {
		  echo missingServiceAccountDetailsWarning();
		}

		$client = new Google_Client();
		$client->setApplicationName("lvse");

		/************************************************
		  If we have an access token, we can carry on.
		  Otherwise, we'll get one with the help of an
		  assertion credential. In other examples the list
		  of scopes was managed by the Client, but here
		  we have to list them manually. We also supply
		  the service account
		 ************************************************/
		if (isset($_SESSION['service_token'])) {
		  $client->setAccessToken($_SESSION['service_token']);
		}
		$key = file_get_contents($key_file_location);
		$cred = new Google_Auth_AssertionCredentials(
			$service_account_name,
			array('https://www.googleapis.com/auth/drive'),
			$key
		);
		$client->setAssertionCredentials($cred);
		if ($client->getAuth()->isAccessTokenExpired()) {
		  $client->getAuth()->refreshTokenWithAssertion($cred);
		}
		$_SESSION['service_token'] = $client->getAccessToken();
		pr($_SESSION['service_token']);
		
		$service = new Google_Service_Drive($client);
		
		$file = new Google_Service_Drive_DriveFile();
		$file->setTitle($title);
		
		$parent = new Google_Service_Drive_ParentReference();
		$parent->setId('0B2wkhzXrJ8NLcDlMSkZHSk1obFE');
		$file->setParents(array($parent));
		$result = $service->files->insert(
			  $file,
			  array(
				'data' => $data,
				'mimeType' => 'application/octet-stream',
				'uploadType' => 'multipart'
			  )
		  );


		if (isset($result) && $result) {
		  return pr($result);
		} else 
		{
			return false;
		}
		
	}
	
	public function files() {
		$this->layout = null;
		$this->autoRender = false;
		
		unlink(APP.'/tmp/backup.zip');
		$this->_Zip(APP, APP.'/tmp/backup.zip');
		echo $this->_gooDriveServiceInsert('backup'.time().'.zip', file_get_contents(APP.'/tmp/backup.zip'));
	}
	
	public function database() {
		$this->layout = null;
		$this->autoRender = false;

		//echo $this->_gooDriveClientInsert("lvse_dump".time().".sql", $this->_database_mysql_dump());
		echo $this->_gooDriveServiceInsert("lvse_dump".time().".sql", $this->_database_mysql_dump());
	}
	
	private function _gooDriveClientInsert($title, $data)
	{
		$client_id = '65406654197-luvia6bl9h9aud6m2ek773rm3uga0au0.apps.googleusercontent.com';
		$client_secret = 'iWr_gr50zmGsJITnwbx84ZsR';
		$redirect_uri = 'http://lvse.ru/backups';//TODO:по хорошему нужно сюда передать тот урл на котором нам понадобится авторизация

		$client = new Google_Client();
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->addScope("https://www.googleapis.com/auth/drive");
		$service = new Google_Service_Drive($client);

		if (isset($_REQUEST['logout'])) {
		  unset($_SESSION['upload_token ']);
		}

		if (isset($_GET['code'])) {
		  $client->authenticate($_GET['code']);
		  $_SESSION['upload_token'] = $client->getAccessToken();
		  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
		}

		if (isset($_SESSION['upload_token']) && $_SESSION['upload_token']) {
		  $client->setAccessToken($_SESSION['upload_token']);
		  if ($client->isAccessTokenExpired()) {
			unset($_SESSION['upload_token']);
		  }
		} else {
		  $authUrl = $client->createAuthUrl();
		}

		/************************************************
		  If we're signed in then lets try to upload our
		  file.
		 ************************************************/
		if ($client->getAccessToken()) {
		
			$file = new Google_Service_Drive_DriveFile();
			$file->setTitle($title);
			
			$parent = new Google_Service_Drive_ParentReference();
			$parent->setId('0B2wkhzXrJ8NLcDlMSkZHSk1obFE');
			$file->setParents(array($parent));
			
			$result = $service->files->insert(
				  $file,
				  array(
					'data' => $data,
					'mimeType' => 'application/octet-stream',
					'uploadType' => 'multipart'
				  )
			  );
		}
		
		if (isset($authUrl)) {
		  return "<a class='login' href='" . $authUrl . "'>Connect Me!</a>";
		} else if (isset($result) && $result) {
		  return pr($result);
		} else 
		{
			return false;
		}
	}
	
	public function _database_mysql_dump($tables = '*') {

		$return = '';

		$modelName = $this->modelClass;

		$dataSource = $this->{$modelName}->getDataSource();
		$databaseName = $dataSource->getSchemaName();


		// Do a short header
		$return .= '-- Database: `' . $databaseName . '`' . "\n";
		$return .= '-- Generation time: ' . date('D jS M Y H:i:s') . "\n\n\n";


		if ($tables == '*') {
			$tables = array();
			$result = $this->{$modelName}->query('SHOW TABLES');
			foreach($result as $resultKey => $resultValue){
				$tables[] = current($resultValue['TABLE_NAMES']);
			}
		} else {
			$tables = is_array($tables) ? $tables : explode(',', $tables);
		}

		// Run through all the tables
		foreach ($tables as $table) {
			$tableData = $this->{$modelName}->query('SELECT * FROM ' . $table);

			$return .= 'DROP TABLE IF EXISTS ' . $table . ';';
			$createTableResult = $this->{$modelName}->query('SHOW CREATE TABLE ' . $table);
			$createTableEntry = current(current($createTableResult));
			$return .= "\n\n" . $createTableEntry['Create Table'] . ";\n\n";

			// Output the table data
			foreach($tableData as $tableDataIndex => $tableDataDetails) {

				$return .= 'INSERT INTO ' . $table . ' VALUES(';

				foreach($tableDataDetails[$table] as $dataKey => $dataValue) {

					if(is_null($dataValue)){
						$escapedDataValue = 'NULL';
					}
					else {
						// Convert the encoding
						//$escapedDataValue = mb_convert_encoding( $dataValue, "UTF-8", "ISO-8859-1" );
						$escapedDataValue = $dataValue;

						// Escape any apostrophes using the datasource of the model.
						$escapedDataValue = $this->{$modelName}->getDataSource()->value($escapedDataValue);
					}

					$tableDataDetails[$table][$dataKey] = $escapedDataValue;
				}
				$return .= implode(',', $tableDataDetails[$table]);

				$return .= ");\n";
			}

			$return .= "\n\n\n";
		}

		// Set the default file name
		$fileName = $databaseName . '-backup-' . date('Y-m-d_H-i-s') . '.sql';

		// Serve the file as a download
		$this->autoRender = false;

		// $this->response->type('Content-Type: text/x-sql');
		// $this->response->download($fileName);
		//$this->response->body($return);
		return $return;
	}
	
	private function _Zip($source, $destination)
	{
		if (!extension_loaded('zip') || !file_exists($source)) {
			return false;
		}

		$zip = new ZipArchive();
		if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
			return false;
		}

		$source = str_replace('\\', '/', realpath($source));

		if (is_dir($source) === true)
		{
			$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

			foreach ($files as $file)
			{
				$file = str_replace('\\', '/', $file);

				// Ignore "." and ".." folders
				if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
					continue;

				$file = realpath($file);

				if (is_dir($file) === true)
				{
					$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
				}
				else if (is_file($file) === true)
				{
					$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
				}
			}
		}
		else if (is_file($source) === true)
		{
			$zip->addFromString(basename($source), file_get_contents($source));
		}

		return $zip->close();
	}

}