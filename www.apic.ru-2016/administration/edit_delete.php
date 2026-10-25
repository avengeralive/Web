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



	if (!(isset($_REQUEST['document_id']))){
		echo "Не выбран номер документа к удалению.";
		exit();
		};

	show_template_header();
show_preview(	$_REQUEST['document_id']	);



function  show_template_header(){
		$t = new ice_templates();
		$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."edit/delete_ok.html" );
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
		$t->parse("page","page");
		echo $t->get("page");
		}


function show_preview($documentid){
	global $adm;


	echo "<table border=1>";
	$old = $adm->get_document_base($documentid);

	removeone($documentid,  $old['document']['url']);
	$childs = $adm->get_tree($documentid,1, 1000);
//	alid($childs);
	while(list(,$v)=each($childs['catalog'])){
		removeone($v['id'], $v['url']);
		};
	echo "</table>";
}



function removeone($id, $url){
	global $m,$adm;
	$q1 = "delete from tree where id = #id#";
	$q2 = "delete from docs where id = #id#";
	$q3 = "delete from params where doc_id = #id#";
    $o1 = $m->query($q1, __FILE__, __LINE__, Array('id' => $id));
    $o2 = $m->query($q2, __FILE__, __LINE__, Array('id' => $id));
    $o3 = $m->query($q3, __FILE__, __LINE__, Array('id' => $id));

	echo "<tr><td><s>$id</s></td><td><s>$url</s></td></tr>";
	}


?>