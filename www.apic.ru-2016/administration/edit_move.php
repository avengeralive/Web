<?
require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'admin_icms.php');
require_once(CLASSES_BASE.'view_icms.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_permission_manager.php');


$m = new ice_mysql();
$adm = new admin_icms($m);

/** BEGIN PERMISSIONS CHECK **/
$rights = array(
    'view'=>49,
    'edit'=>49
    );
$pm = new permission_manager($m,  MYSQL_DB);
if (!$pm->checkLogged()){
	// добавить в лог что кто то логинился...
	trigger_error('Permission check failed',E_USER_NOTICE);
	exit();
	};
$status_permission = $pm->check_rights($rights['view']);
if (!$status_permission['status']) {
	$pm->show_permission_denied();
	echo "!";
	exit();
	};
/** END PERMISSIONS CHECK **/



if ($_REQUEST['action'] =='single') {
	$documentid = $_GET['documentid'];
	$newrootid = $_GET['newrootid'];
	show_template_header();
	show_preview($documentid, $newrootid);
	}
elseif($_REQUEST['action'] =='multiple'){
	// ...
//	alid($_REQUEST);
	if (!(isset($_REQUEST['to']))){
		echo "Не выбрано куда перемещать.";
		exit();
		};

	show_template_header();
	$newrootid = $_REQUEST['to'];
	while(list($k,$v)=each(	$_REQUEST	)){
		if (preg_match('/^child([0-9]*)$/',$k,$m)){
			$documentid = $m[1];
//			alid($documentid);
			show_preview($documentid, $newrootid);
			};
		};

	};



function  show_template_header(){
		$t = new ice_templates();
		$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."edit/move_ok.html" );
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
		$t->parse("page","page");
		echo $t->get("page");
		}


function show_preview($documentid, $newrootid){
	global $adm;

	// куда перемещаем 
	$newparent = $adm->get_document_base($newrootid);
//	alid($newparent);
	$newparent_url = $newparent['document']['url'];

	// исходный документ
	$doc = $adm->get_document_base($documentid);
//	alid($doc);
	$docurl = $adm->get_url_part($doc['document']['url']);

	$newurl=$newparent_url.$docurl.'/';
	$newparent=$newrootid;
	$childs = $adm->get_tree($documentid,1, 1000);
	$count = 1 + sizeof(	$childs['catalog']	);







	addheader($doc['document']['id'], $count);
	addmove($doc['document']['id'], $doc['document']['url'], $newurl, $newparent);

	// все потомки документа
//	alid($childs);
	while(list(,$v)=each($childs['catalog'])){
		$docurl = str_replace($doc['document']['url'], '', $v['url']);
		$newsuburl = $newurl.$docurl;
		$newparent=$v['parent_id'];
		addmove($v['id'], $v['url'], $newsuburl, $newparent);
		};
	echo "</table>";
}


function addheader($id, $count){
	echo 
	"<h1>Переместили $count документов и сменили у них URL</h1>
	<p>Перейти в <a href='/edit.php?ID=show_edit&document_id=$id'>редактирование документа</a></p>";
	echo "<table border=1><tr><td>старый адрес</td><td>новый адрес</td></tr>";
	}


function addmove($id, $oldurl, $newurl, $newparent){
	global $adm;
		echo "<tr><td><s>$oldurl</s></td><td>$newurl</td></tr>";
		$adm->change_url_and_parent_id ($id,$oldurl, $newurl, $newparent);
	}


?>