<?php


require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'admin_icms.php');
require_once(CLASSES_BASE.'view_icms.php');

add_node_html();



function add_node_html(){
	$parent_id = isset($_GET['id'])?$_GET['id']:1;
	$m = new ice_mysql();
	$adm = new admin_icms($m);
	$childs = $adm->get_childs($parent_id);
//	alid($childs);

	$node = array();
	while(list(,$v)=each($childs['catalog'])){
		$id = $v['id'];
		$name = $v['name'];
		if ($v['status']=='disabled'){
			$name = '<s>'.$v['name'].'</s>';
			};
		$url = view_icms::get_cms_url(	$v['type'],$v['url']	);
		$isFolder=1;
		$node[] = "{ id: $id, title: '$name', url: '$url',  isFolder: $isFolder}";
		};
echo '['.implode(',',$node).']';
}





?>