<?
require ('adm_explorer_setting.php');
//require ('class-ali_error_handler.php');
require ('class_ali_explorer.php');
require ('class_view_ali_explorer.php');
require ('class_ali_dir.php');
require ('class_ali_templates.php');
require ('zip.php');
require ('ali_explorer_plugins.php');

if (isset($HTTP_POST_VARS['ID'])) {
	$ID = $HTTP_POST_VARS['ID'];
	$V = $HTTP_POST_VARS;
	}
elseif (isset($HTTP_GET_VARS['ID'])) {
	$ID = $HTTP_GET_VARS['ID'];
	$V = $HTTP_GET_VARS;
	}
else {
	$ID = 'get';
	$V = Array();
	}
if (!(isset($V['dir']))) {
	$V['dir'] = '';
	};
if (preg_match("/\.\.\//", $V['dir'])) {
	$V['dir'] = '';
	};


if  (preg_match("/^plugin::(.*)$/", $ID, $m)) {
	$p = new ali_explorer_plugins();
	if (method_exists($p, $m[1])) {
		call_user_func( array(&$p, $m[1]), $V );
		};
	};


switch ($ID) {
	case "get":
		if (!(isset($V['order']) && (strlen($V['order'])>0)  )) {
			$V['order'] = 'name';
			};
		if (!(isset($V['reverse']) && (strlen($V['reverse'])>0) )) {
			$V['reverse'] = 1;
			};
		$ae = new ali_explorer();
		$av = new view_ali_explorer();
		if (is_dir(PME_FOLDER_ROOT.$V['dir'])) {
			$d = $ae->get_directory($V['dir']);
			$dd = $ae->directory_to_navigation($V['dir']);
			$html = $av->get_directory($d, $V['dir'] , $dd, $V['order'], $V['reverse']);
			}
		elseif (is_file(PME_FOLDER_ROOT.$V['dir'])) {
			$d = $ae->get_file($V['dir']);
			exit();
			}
		else {
			$html = "oops! unknown file/folder type!";
			};
		break;

/*
	case "get_zip_redirect":
		// создадим `правильное` название закачиваемого файла ... js disabled =)
		if ( isset($V['file']) && is_array($V['file']) && (sizeof($V['file'])>0) ){
			$f="";
			while (list(,$file) = each ($V['file'])) {
				$f .= "file[]=".urlencode($file)."&";
				};
			header("Location: ".$_SERVER['SCRIPT_NAME']."/".time().".zip?ID=get_zip&".$f);
			exit();
			}
		else {
			$html = "oops! no files/folder selected!";
			};
		break;
*/

	case "get_zip":
		if ( isset($V['file']) && is_array($V['file']) && (sizeof($V['file'])>0) ){
			$ae = new ali_explorer();
			$ae->get_zip($V['file']);
			exit();
			}
		else {
			$html = "oops! no files/folder selected!";
			};
		break;

	case "delete":
		if ( isset($HTTP_POST_VARS['file']) && is_array($HTTP_POST_VARS['file']) && (sizeof($HTTP_POST_VARS['file'])>0) ){
			$ae = new ali_explorer();
			$r = $ae->delete_files($HTTP_POST_VARS['file']);
//			print_r($r);
//			$html = "ok ..";
			header("Location: ".$_SERVER['SCRIPT_NAME']."?ID=get&dir=".$V["dir"]);
			exit();
			}
		else {
			$html = "oops! no files/folder selected!";
			};
		break;

	case "upload":
		if ( (strlen($V['dir'])>0) && (is_uploaded_file($HTTP_POST_FILES['file']['tmp_name'])) ) {
			$ae = new ali_explorer();
			$s = $ae->upload_file(
				$HTTP_POST_FILES ['file']['tmp_name'], 
				$V['dir'], 
				$HTTP_POST_FILES ['file']['name']
				);
			if (!$s) {
				echo "error when upload .. check rights";
				};
			};
		header("Location: ".$_SERVER['SCRIPT_NAME']."?ID=get&dir=".$V["dir"]);
		exit();
		break;

	case "create_folder":
		if (!(isset($V['dir'])) || 0==strlen($V['dir']) ) {
			$V['dir'] = '/';
			};
		if (preg_match("/\.\.\//", $V['dir'])) {
			$V['dir'] = '';
			};
		if (preg_match("/\.\.\//", $V['folder'])) {
			$V['folder'] = '';
			};
		if ( (strlen($V['dir'])>0) && (strlen($V['folder'])>0)  ) {
			$ae = new ali_explorer();
			$s = $ae->create_folder( $V['dir'],$V['folder'] );
			if (!$s) {
				$html = "oops: не получилось создать папку ...";
				}
			else {
				header("Location: ".$_SERVER['SCRIPT_NAME']."?ID=get&dir=".$V['dir']."/".$V['folder']);
				exit();
				};
			}
		else {
			$html = "oops: unknown foldername";
			};
		break;

	case "execute":
			$ae = new ali_explorer();
		//	echo $ae->execute( $V['q'] );
			echo "отключено";
			exit();
			break;

	case "view":
		if (!(isset($V['file']))) {
			$V['file'] = '';
			};
		if (preg_match("/\.\.\//", $V['file'])) {
			$V['file'] = '';
			};
		if (strlen($V['file'])>0){
			$ae = new ali_explorer();
			$c = $ae->get( $V['file'] );
			if (!$c) {
				echo "Не удалось прочитать файл ". $V['file'];
				exit();
				};
			if (preg_match("/\.([A-Za-z]*)$/i", $V['file'], $mm)) {
				$ext = strtolower($mm[1]);
				switch($ext) {
					case "gif":
						header("Content-type: image/gif");
						break;
					case "jpg":
						header("Content-type: image/jpeg");
						break;
					case "html":
						header("Content-type: text/html");
						break;
					case "txt":
						header("Content-type: text/plain");
						break;
					case "php":
						header("Content-type: text/plain");
						break;
					};
				};
			header("Content-length: ".strlen($c));
			echo $c;
			exit();
			}
		else {
			$html = "oops! oops: unknown (folder|file)name";
			};
		break;

case "easy_edit":
		if (!(isset($V['file']))) {
			$V['file'] = '';
			};
		if (preg_match("/\.\.\//", $V['file'])) {
			$V['file'] = '';
			};
//		if ( (strlen($V['file'])>0) && (strlen($V['dir'])>0) ){
			$ae = new ali_explorer();
			$c = $ae->get( $V['dir']."/".$V['file'] );
			if (!$c) {
				echo "Не удалось прочитать файл ". $V['dir']."/".$V['file'];
				exit();
				};
			$dd = $ae->directory_to_navigation($V['dir']."/".$V['file']);
			$av = new view_ali_explorer();
			$html = $av->get_edit($c, $V['dir'], $V['file'], $dd);
//			}
//		else {
//			$html = "oops! oops: unknown (folder|file)name";
//			};
		break;

	case "update_file":
		if (!(isset($V['file']))) {
			$V['file'] = '';
			};
		if (!(isset($V['backup']))) {
			$V['backup'] = 0;
			};
		if (preg_match("/\.\.\//", $V['file'])) {
			$V['file'] = '';
			};
		if ( (strlen($V['file'])>0)  ){
			$ae = new ali_explorer();
			if (1==$V['backup']) {
				if (!(copy(
					PME_FOLDER_ROOT.$V['dir']."/".$V['file'], 
					PME_FOLDER_ROOT.$V['dir']."/".$V['file'].".".date("YmdHis",time()).".backup" 
					))) {
					echo "oops! не смогли создать бэкап. файл не был перезаписан!";
					exit();
					};
				};
			$ae->create(  $V['dir']."/".$V['file'], $V['content'] );
			switch($V['return']) {
				case "directory":
					header("Location: ".$_SERVER['SCRIPT_NAME']."?ID=get&dir=".$V['dir']);
					exit();
					break;
				case "view":
					header("Location: ".$_SERVER['SCRIPT_NAME']."?ID=view&file=".$V['dir']."/".$V['file']);
					exit();
					break;
				case "edit":
					header("Location: ".$_SERVER['SCRIPT_NAME']."?ID=easy_edit&dir=".$V['dir']."&file=".$V['file']);
					exit();
					break;
				};
			}
		else {
			$html = "oops! oops: unknown (folder|file)name";
			};

		break;


	case "tree":
		// no mvc; fast write
		$dn = view_ali_explorer::get_navigation(ali_explorer::directory_to_navigation($V['dir']."/"));
		$empty_parent = '';
		$d = &new AliDir($V['dir'],'', $empty_parent);
		$t = new ali_templates("get_tree.html");
		$html = $t->parse(
			array('tree', 'PME_WWW', 'directory', 'navigation'), 
			array($d->graph(), PME_WWW, $V['dir'], $dn)
			);
		break;


	case "search":
		// no mvc; fast write
		$ae = new ali_explorer();
		$dd = $ae->directory_to_navigation($V['dir']."/");
		if (isset($V['q']) && (strlen($V['q'])>0)  ) {
			$files = $ae->find_file_by_regexp($V['dir'], $V['q']);
			}
		else {
			$V['q'] = '';
			$files = array();
			};
		$ve = new view_ali_explorer();
		$html = $ve->get_search($files, $V['dir'], $dd, $V['q']);
		break;

	case "massupload":
		// no mvc; fast write
//		phpinfo();

		// modern AJAX call form 
		$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
		if ($fn) {
			// AJAX call
			//echo file_get_contents('php://input');	

			//echo $_SERVER['HTTP_X_FILENAME'];
			$name = iconv('utf-8','windows-1251',$_SERVER['HTTP_X_FILENAME']);
                        //echo $z;

			$z = file_put_contents(
                                        PME_FOLDER_ROOT.$V['dir']."/".$name,
					file_get_contents('php://input')
					//$HTTP_RAW_POST_DATA
					);					

			echo "$fn uploaded to=".PME_FOLDER_ROOT.$V['dir']."/".$name." status=".$z;
			exit();
			};


		// modern form but classic upload 
		//alid($HTTP_POST_FILES);
		if (isset($HTTP_POST_FILES['file']['tmp_name'])){
			while (list($k,$v) = each($HTTP_POST_FILES['file']['tmp_name'])) {
				if ( (is_uploaded_file($HTTP_POST_FILES['file']['tmp_name'][$k])) ) {
					$ae = new ali_explorer();
					$s = $ae->upload_file(
						$HTTP_POST_FILES['file']['tmp_name'][$k], 
						$V['dir'], 
						$HTTP_POST_FILES['file']['name'][$k]
						);
					if (!$s) {
						echo "error when upload .. check rights";
						};
					};
				};
		};


		// classic old form 
		if (isset($HTTP_POST_FILES['file']['tmp_name'])){
			while (list($k,$v) = each($HTTP_POST_FILES['file']['tmp_name'])) {
				if ( (is_uploaded_file($HTTP_POST_FILES['file']['tmp_name'][$k])) ) {
					$ae = new ali_explorer();
					$s = $ae->upload_file(
						$HTTP_POST_FILES['file']['tmp_name'][$k], 
						$V['dir'], 
						$HTTP_POST_FILES['file']['name'][$k]
						);
					if (!$s) {
						echo "error when upload .. check rights";
						};
					};
				};
		};

		if (isset($HTTP_POST_VARS['return'])){
			switch($HTTP_POST_VARS['return']) {
				case "directory":
					header("Location: ".$_SERVER['SCRIPT_NAME']."?ID=get&dir=".$V['dir']);
					exit();
					break;
				default:
					break;
				};
			};

		$t = new ali_templates("massupload.html");
		$ae = new ali_explorer();
		$dd = $ae->directory_to_navigation($V['dir']."/");
		
//		$fff =  PME_FOLDER_ROOT.$V['dir'].'/' ;
//echo $fff;
//echo is_writeable($fff)."*";

		if (is_writeable(PME_FOLDER_ROOT.$V['dir'])) {
			$write_disabled = "";
			$bgcolor = "#FFFFFF";
			}
		else {
//			echo "DESSSSSSS";
			$write_disabled = "disabled";
			$bgcolor = "#ffcccc";
			};
		
		$html = $t->parse(
			array( 'PME_WWW', 'SCRIPT_NAME', 'directory', 'navigation' , 'write_disabled', 'bgcolor'), 
			array( PME_WWW, $_SERVER['SCRIPT_NAME'], $V['dir'], view_ali_explorer::get_navigation($dd), $write_disabled, $bgcolor )
			);
		break;



	default:
			print_r($V);
			$html = "oops! unknown ID";
		break;
	};


//	header("Content-length: ".strlen($html));
	echo $html;
?>