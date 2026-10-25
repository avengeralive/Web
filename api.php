<?php
	//https://cms.docdelivery.ru/deliveryapi/order/api.php?login=api_alfa_business&signature=6bef3d4ef4804ffd3f43fe349dad70d7&task=GetStatusList
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	header("Content-type: application/json; charset=utf-8");
	header("Connection: close");
	$dir_name = str_replace ("/deliveryapi/order","",dirname(__FILE__));
	/* Initialize Joomla framework */
	if (!defined('_JEXEC')) {	
		define( '_JEXEC', 1 );
		define('JPATH_BASE', $dir_name);
		define( 'DS', DIRECTORY_SEPARATOR );
		/* Required Files */
		require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
		require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
		/* To use Joomla's Database Class */
		require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'factory.php' );
		$file_import=JPATH_LIBRARIES.DS.'import.php';
		require_once ($file_import); // Joomla library imports.
		$file_helper=JPATH_LIBRARIES.DS.'cms'.DS.'module'.DS.'helper.php';
		require_once ($file_helper); // Joomla JModuleHelper.
		/* Create the Application */
		$app = JFactory::getApplication('site')->initialise();
	}
	require_once('errors.php');
	$login = $_REQUEST['login'];
	$signature = $_REQUEST['signature'];
	$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
	$task = $_REQUEST['task'];
	
	/// проверяем авторизацию
	$APILOGIN="";
	$db = JFactory::getDBO();
	$query = "SELECT a.id as id, b.onoff as onoff, b.api_login as api_login, b.api_password as api_password, b.api_secret as api_secret, a.email as email, c.telephone as telephone, c.alias as alias  FROM `cms_users` as a inner join `cms_del_api` as b on a.id=b.user inner join cms_contact_details as c on a.id=c.user_id  WHERE b.`api_login` = '".$login."' AND MD5(CONCAT(api_login, api_password)) = '".$signature."'";
	$db->setQuery( $query );
	$rows = $db->loadObjectList();
	if ($rows) {
		foreach ($rows as $row) {
			if ((int)$row->onoff==1) {
				define('USERID', $row->id);
				$APILOGIN=$row->api_login;
				define('APILOGIN', $row->api_login);
				define('APIPASSWORD', $row->api_password);
				define('APISECRET', $row->api_secret);
				define('P_EMAIL', $row->email);
				define('P_PHONE', $row->telephone);
				define('P_CONTACT', $row->alias);
			}
		}
	}
	else {
		SendError('002');
		die();
	}
	//ЛОГИ: постучались
	$date_time=date( "Y" )."-".date( "m" )."-".date( "d" )." ".date( "H" ).":".date( "i" ).":".date( "s" );
	SetLogs("\r\n".$date_time." from ".$_SERVER['REMOTE_ADDR']);
	$f = fopen('php://input', 'r');
	// Получаем содержимое потока
	$mass = stream_get_contents($f);
	if (count($mass)!=0) {
		SetLogs("INPUT: ".$mass);
		SetLogs("POST: ".json_encode($_POST));
		SetLogs("GET: ".json_encode($_GET));
	} else {
		SetLogs("Empty");
		exit();
	}

	switch ($task) {
		case 'GetStatusList': 
			GetStatusList(); 
			break;
		case 'GetBankList': 
			GetBankList(); 
			break;
		case 'GetOrderInfo': 
			GetOrderInfo(); 
			break;
		case 'AddOrder': 
			AddOrder(); 
			break;
		case 'GetOrderHistory': 
			GetOrderHistory(); 
			break;
		case 'ChangeOrderStatus': 
			ChangeOrderStatus(); 
			break;
		case 'GetOrderDocs': 
			GetOrderDocs(); 
			break;
		case 'GetOrderDoc': 
			GetOrderDoc(); 
			break;
		case 'AddOrderDoc': 
			AddOrderDoc(); 
			break;
	}

	function GetStatusList() {
		$db = JFactory::getDBO();
		$query = "SELECT cms_del_status.id, cms_del_status.title, cms_del_status.fulltext as description, cms_del_status.comments as comment_need FROM cms_del_status";
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		echo json_encode($rows);
		exit();
	}

	function GetBankList() {
		$db = JFactory::getDBO();
		$query = "SELECT cms_del_bank.id, cms_del_bank.title FROM cms_del_bank";
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		echo json_encode($rows);
		exit();
	}

	function GetOrderInfo() {
		if (!isset($_REQUEST['order_id'])) {
			SendError('004');
			die();
		}
		$order_id = $_REQUEST['order_id'];
		$db = JFactory::getDBO();
		$query = "SELECT o.id, o.alias as order_id, o.title as name, o.phone, o.email, o.fulltext as comment, o.created, o.bank as bank_id, b.title as bank_name, o.docs as add_docs, o.date as date_delivery, o.time1, o.time2, o.coordinaty as coordinate, o.address, o.region, o.city, o.street_type, o.street, o.building, o.status as status_id, s.title as status_name, o.published FROM cms_del_order o, cms_del_bank b, cms_del_status s WHERE b.id = o.bank AND s.id = o.status AND o.alias = '".$order_id."' AND o.partner = ".USERID;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		echo json_encode($rows);
		exit();
	}

	function GetOrderHistory() {
		if (!isset($_REQUEST['order_id'])) {
			SendError('004');
			die();
		}
		$order_id = $_REQUEST['order_id'];
		$db = JFactory::getDBO();
		$query = "SELECT o.created, o.status as status_id, s.title as status_name, o.fulltext as comment FROM cms_del_order o, cms_del_status s WHERE s.id = o.status AND o.alias = '".$_REQUEST['order_id']."' AND o.partner = ".USERID;;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		echo json_encode($rows);
		exit();
	}

	function AddOrder()
	{
		$f = fopen('php://input', 'r');
		$mass = stream_get_contents($f);
		$mass = json_decode($mass, true);
		$result = array();
		if (count($mass)==0) SendError('007');
		if (!isset($mass['order_id']) || $mass['order_id']=="") SendError('008', 'идентификатор заявки'); 
		else $mass['order_id'] = htmlspecialchars($mass['order_id']);
		if (!isset($mass['name']) || $mass['name']=="") SendError('008', 'имя клиента');
		else $mass['name'] = htmlspecialchars($mass['name']);
		if (!isset($mass['phone']) || $mass['phone']=="") SendError('008', 'телефон клиента');
		else $mass['phone'] = htmlspecialchars($mass['phone']);
		if (!isset($mass['bank_id']) || $mass['bank_id']=="") SendError('008', 'идентификатор банка');
		if (!isset($mass['address']) || $mass['address']=="") SendError('008', 'адрес клиента');
		else $mass['address'] = htmlspecialchars($mass['address']);
		if (!isset($mass['region'])) SendError('008', 'регион доставки');
		else $mass['region'] = htmlspecialchars($mass['region']);
		if (!isset($mass['city'])) SendError('008', 'город доставки');
		else $mass['city'] = htmlspecialchars($mass['city']);
		if (!isset($mass['street'])) SendError('008', 'улица доставки');
		else $mass['street'] = htmlspecialchars($mass['street']);
		if (!isset($mass['building'])) SendError('008', 'номер дома доставки');
		else $mass['building'] = htmlspecialchars($mass['building']);
		if (!isset($mass['status_id'])) SendError('008', 'статус заявки');
		//проверяем, нет ли уже заявки с таким кодом у этого партнера
		$db = JFactory::getDBO();
		$query = "SELECT * FROM `cms_del_order` WHERE `alias`='".$mass['order_id']."' and `partner`=".USERID;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if (count($rows) > 0)  SendError('009');
		//проверяем наличие данных
		$date_creaty=date( "Y" )."-".date( "m" )."-".date( "d" )." ".date( "H" ).":".date( "i" ).":".date( "s" );
		$mass['created']=$date_creaty;
		if (!isset($mass['email'])) $mass['email']="";
		else $mass['email'] = htmlspecialchars($mass['email']);
		if (!isset($mass['comments'])) $mass['comments']="";
		else $mass['comments'] = htmlspecialchars($mass['comments']);
		if (!isset($mass['add_docs'])) $mass['add_docs']="";
		else $mass['add_docs'] = htmlspecialchars($mass['add_docs']);
		if (!isset($mass['date_delivery'])) $mass['date_delivery']="0000-00-00 00:00:00";
		if (!isset($mass['time1'])) $mass['time1']="00:00";
		if (!isset($mass['time2'])) $mass['time2']="00:00";
		if (!isset($mass['coordinate'])) $mass['coordinate']="";
		else $mass['coordinate'] = htmlspecialchars($mass['coordinate']);
		if (!isset($mass['street_type'])) $mass['street_type']="";
		else $mass['street_type'] = htmlspecialchars($mass['street_type']);
		$test = "";
		$query = "INSERT INTO `cms_del_order`(`title`, `alias`, `asset_id`, `fulltext`, `created`, `ordering`, `created_by`, `published`, `partner`, `agent`, `courier`, `manager`, `bank`, `date`, `coordinaty`, `address`, `region`, `city`, `street`, `street_type`, `building`, `region_id`, `city_id`, `sreet_id`, `building_id`, `phone`, `email`, `sender_name`, `sender_phone`, `sender_email`, `type`, `status`, `weight`, `height`, `width`, `depth`, `volume_weight`, `image`, `time1`, `time2`, `cost`, `district`, `edit`, `edit_date`, `docs`, `status_edit`, `ready`) VALUES ('".addslashes($mass['name'])."', '".addslashes($mass['order_id'])."', 0, '".str_replace("'", "\\'", $mass['comments'])."', '".addslashes($mass['created'])."', 0, '".USERID."', '".addslashes($test)."', '".USERID."', 0, 0, 0, '".addslashes($mass['bank_id'])."', '".addslashes($mass['date_delivery'])."', '".addslashes($mass['coordinate'])."', '".addslashes($mass['address'])."', '".addslashes($mass['region'])."', '".addslashes($mass['city'])."', '".addslashes($mass['street'])."', '".addslashes($mass['street_type'])."', '".addslashes($mass['building'])."', 0, 0, 0, 0, '".addslashes($mass['phone'])."', '".addslashes($mass['email'])."', '".P_CONTACT."', '".P_PHONE."', '".P_EMAIL."', 11, '".addslashes($mass['status_id'])."', 0, 0, 0, 0, 0, '', '".addslashes($mass['time1'])."', '".addslashes($mass['time2'])."', 0, 0, 0, '', '".addslashes($mass['add_docs'])."', 0, 0)";  
		$db->setQuery($query);
		$db->query();
		$lastRowId = $db->insertid();
		$date_creaty = date( "Y" ).date( "m" ).date( "d" )."T".date( "H" ).date( "i" ).date( "s" ).".000 GMT";
		$result['id'] = $lastRowId; 
		$result['order_id'] = $mass['order_id']; 
		$result['created'] = $date_creaty;
		$result['result'] = true;
		SetLogs("SUCCESS! order_id: ".$id." create_dateTime: ".$date_creaty);
		SetLogs (json_encode($result));
		echo json_encode($result);
		closeconnect($mass);
	}

	function GetOrderDocs() {
		if (!isset($_REQUEST['order_id'])) {
			SendError('004');
			die();
		}
		$order_id = $_REQUEST['order_id'];
		$db = JFactory::getDBO();
		$query = "SELECT d.id, d.title, d.href as type FROM cms_del_order o, cms_del_doc d WHERE d.order_id = o.id AND o.alias = '".$order_id."' AND o.partner = ".USERID;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		foreach ($rows as $key => $value) {
			$x = explode('.', $rows[$key]->type);
			$rows[$key]->type = $x[count($x) - 1];
		} 
		echo json_encode($rows);
		exit();
	}

	function GetOrderDoc() {
		if (!isset($_REQUEST['order_id'])) {
			SendError('004');
			die();
		}
		if (!isset($_REQUEST['doc_id'])) {
			SendError('013');
			die();
		}
		$order_id = $_REQUEST['order_id'];
		$doc_id = $_REQUEST['doc_id'];
		$db = JFactory::getDBO();
		$query = "SELECT d.id, d.title, d.type, d.content FROM cms_del_order o, cms_del_doc d WHERE d.order_id = o.id AND o.alias = '".$order_id."' AND d.id = ".$doc_id." AND o.partner = ".USERID;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		foreach ($rows as $key => $value) {
			$x = explode('.', $rows[$key]->type);
			$rows[$key]->type = $x[count($x) - 1];
		}
		echo json_encode($rows);
		exit();
	}

	function ChangeOrderStatus() {
		if (!isset($_REQUEST['order_id'])) {
			SendError('004');
			die();
		}
		if (!isset($_REQUEST['status_id'])) {
			SendError('007');
			die();
		}
		$order_id = $_REQUEST['order_id'];
		$status_id = $_REQUEST['status_id'];
		$comment = (isset($_REQUEST['comment'])) ? $_REQUEST['comment'] : "";
		$db = JFactory::getDBO();
		$query = "UPDATE cms_del_order o SET o.status = ".$status_id.", o.fulltext = '".$comment."' WHERE o.alias = '".$order_id."' AND o.partner = ".USERID;
		$db->setQuery( $query );
		$res = $db->query();
		if ($res) {
			$query = "SELECT o.id, o.alias as order_id, o.created, o.status as status_id, s.title as status_name FROM cms_del_order o, cms_del_status s WHERE s.id = o.status AND o.alias = '".$order_id."' AND o.partner = ".USERID;
			$db->setQuery( $query );
			$rows = $db->loadObjectList();
			$result = array();
			$result['id'] = $rows[0]->id;
			$result['order_id'] = $rows[0]->order_id;
			$result['status_id'] = $rows[0]->status_id;
			$result['status_name'] = $rows[0]->status_name;
			$result['result'] = true;
			echo json_encode($result);
		}
		else SendError('012');
		exit();
	}

	function AddOrderDoc() {
		if (!isset($_REQUEST['order_id'])) {
			SendError('004');
			die();
		}
		if (!isset($_REQUEST['title'])) {
			SendError('007');
			die();
		}
		if (!isset($_REQUEST['content'])) {
			SendError('007');
			die();
		}
		if (!isset($_REQUEST['type'])) {
			SendError('007');
			die();
		}
		$order_id = $_REQUEST['order_id'];
		$title = $_REQUEST['title'];
		$content = $_REQUEST['content'];
		$type = $_REQUEST['type'];
		$db = JFactory::getDBO();
		$query = "SELECT * FROM `cms_del_order` WHERE `alias`='".$order_id."' and `partner`=".USERID;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if ($rows) {
			$query = "INSERT INTO `cms_del_doc`(`order_id`, `title`, `content`, `type`) VALUES (".$rows[0]->id.", '".$title."', '".$content."', '".$type."')";  
			$db->setQuery($query);
			$db->query();
			$lastRowId = $db->insertid();
			$result = array();
			$date_creaty = date( "Y" ).date( "m" ).date( "d" )."T".date( "H" ).date( "i" ).date( "s" ).".000 GMT";
			$result['doc_id'] = $lastRowId; 
			$result['created'] = $date_creaty;
			$result['result'] = true; 
			echo json_encode($result);
			exit();
		}
		else {
			SendError('014');
			exit();
		}
	}

	function SetLogs($text="")
	{
		if (USERID=="USERID") 
			define('USERID', 'UNDEFINED');
		$date_now=date( "Y" )."-".date( "m" )."-".date( "d" );
		if (!is_dir(dirname(__FILE__)."/".USERID)) 
			mkdir(dirname(__FILE__)."/".USERID);
		$fp = fopen(dirname(__FILE__)."/".USERID."/".$date_now.".txt", "a");
		fwrite($fp, $text."\r\n");
		fclose($fp);
	}

	//функция ошибки
	function SendError($code, $text="")
	{
		global $errors;
		SetLogs("ERROR: ".$code." ".$errors[$code]." ".$text);
		echo json_encode(array("errorInfo"=>array("errorString"=>$errors[$code], "errorCode"=>$code)));
		set_time_limit(0);
		ignore_user_abort(true);  
		ob_end_flush();
		flush();
		exit();
	}

	function closeconnect($mass)
	{
		set_time_limit(0);
		ignore_user_abort(true);  
		ob_end_flush();
		flush();
		exit();
	}

?>