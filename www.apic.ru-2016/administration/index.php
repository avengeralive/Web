<?
require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'class_permission_manager.php');

$m = new ice_mysql();
$pm = new permission_manager($m);
if (!$pm->checkLogged()){
	// добавить в лог что кто то логинился...
	exit();
	};

$bgcolors = array(
    "0" => "#ffffff",
    "1" => "#f0f0f0",
    "2" => "#ffdddd"
	);

$perm_types = array(
    "edit" => " и редактирование",
    "view" => "просмотр "
	);

$t = new ice_templates();
$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."index/index.html" );

$t->set_var('ADMINISTRATOR_NAME',  ADMINISTRATOR_NAME);
$t->set_var('ADMINISTRATOR_EMAIL',  ADMINISTRATOR_EMAIL);

$t->set_var('HTTP_BASE',  HTTP_BASE);
$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
$t->set_var('CMS_ADMIN_IMAGES_BASE',  CMS_ADMIN_IMAGES_BASE);

$t->set_var('NAME',  $pm->user['name']);

$t->set_block('page', 'BLOCK.RIGHTS', 'BLOCK_RIGHTS');
$t->set_var('BLOCK_RIGHTS', '');


$pp = array();
reset($pm->rights);
while (list($k, $v)=each($pm->rights)) {
	$pp[$v['file']][$v['perm_type']] = true;
	$pp[$v['file']]['file'] = $v['file'];
	$pp[$v['file']]['name'] = $v['name'];
	};

reset($pp);
$cbgcolor = 0;
while (list($k, $v)=each($pp)) {
		$cbgcolor = intval(!($cbgcolor));
		$t->set_var('bgcolor', $bgcolors[$cbgcolor]);
		$t->set_var('name', $v['name']);
		$t->set_var('perm_view', $perm_types['view']);
		if (isset($v['edit'])) {
			$t->set_var('perm_edit', $perm_types['edit']);
			}
		else {
			$t->set_var('perm_edit', '');
			};
		$t->set_var('file', $v['file']);
		$t->parse('BLOCK_RIGHTS', 'BLOCK.RIGHTS', true);
	};

	$t->set_block('page', 'BLOCK.FASTLINK', 'BLOCK_FASTLINK');
	$t->set_var('BLOCK_FASTLINK', '');
	$t->set_block('page', 'BLOCK.FASTEDITLINK', 'BLOCK_FASTEDITLINK');
	$t->set_var('BLOCK_FASTEDITLINK', '');

	while (list($k, $v)=each($admin_fast_add)) {
		$t->set_var('FASTLINK.name', $v['name']);
		$t->set_var('FASTLINK.parent_id', $v['parent_id']);
		$t->set_var('FASTLINK.type', $v['type']);
		$t->parse('BLOCK_FASTLINK', 'BLOCK.FASTLINK', true);
		};
	while (list($k, $v)=each($admin_fast_edit)) {
		$t->set_var('FASTEDITLINK.name', $v['name']);
		$t->set_var('FASTEDITLINK.id', $v['id']);
		$t->parse('BLOCK_FASTEDITLINK', 'BLOCK.FASTEDITLINK', true);
		};
	
	
	$o_firms = $m->gets('tree', array('parent_id'=>ID_MEMBERS,'status'=>'active'), 'name');
	//alid($o_firms);
	$t->set_block('page', 'BLOCK.MEMBER', 'BLOCK_MEMBER');
	$t->set_var('BLOCK_MEMBER', '');
	while (list($k, $v)=each($o_firms)) {
		$o_new =   $m->get('tree', array('url'=>$v['url'].'news/','status'=>'active'));
		$o_novelty = $m->get('tree', array('url'=>$v['url'].'novelty/','status'=>'active'));
		$o_firm_id = $m->get('params', array('pname'=>'firm_id','doc_id'=>$v['id']));
		$t->set_var('MEMBER.name', $v['name']);
		$t->set_var('MEMBER.id', $v['id']);
		$t->set_var('MEMBER.url', $v['url']);
		$t->set_var('MEMBER.firm_id', isset($o_firm_id['pvalue'])?$o_firm_id['pvalue']:'');
		$t->set_var('MEMBER.news_id', isset($o_new['id'])?$o_new['id']:'');
		$t->set_var('MEMBER.news_name', isset($o_new['id'])?'добавить новость':'');
		$t->set_var('MEMBER.novelty_id', isset($o_novelty['id'])?$o_novelty['id']:'');
		$t->set_var('MEMBER.novelty_name', isset($o_novelty['id'])?'добавить новинку':'');		
		$t->parse('BLOCK_MEMBER', 'BLOCK.MEMBER', true);
		};

	
	$o_firms = $m->gets('tree', array('parent_id'=>ID_ENG_MEMBERS,'status'=>'active'), 'name');
	//alid($o_firms);
	$t->set_block('page', 'BLOCK.EMEMBER', 'BLOCK_EMEMBER');
	$t->set_var('BLOCK_EMEMBER', '');
	while (list($k, $v)=each($o_firms)) {
		$o_new =   $m->get('tree', array('url'=>$v['url'].'news/','status'=>'active'));
		$o_novelty = $m->get('tree', array('url'=>$v['url'].'novelty/','status'=>'active'));
		$o_firm_id = $m->get('params', array('pname'=>'firm_id','doc_id'=>$v['id']));
		$t->set_var('EMEMBER.name', $v['name']);
		$t->set_var('EMEMBER.id', $v['id']);
		$t->set_var('EMEMBER.url', $v['url']);
		$t->set_var('EMEMBER.firm_id', isset($o_firm_id['pvalue'])?$o_firm_id['pvalue']:'');
		$t->set_var('EMEMBER.news_id', isset($o_new['id'])?$o_new['id']:'');
		$t->set_var('EMEMBER.news_name', isset($o_new['id'])?'добавить новость':'');
		$t->set_var('EMEMBER.novelty_id', isset($o_novelty['id'])?$o_novelty['id']:'');
		$t->set_var('EMEMBER.novelty_name', isset($o_novelty['id'])?'добавить новинку':'');		
		$t->parse('BLOCK_EMEMBER', 'BLOCK.EMEMBER', true);
		};

		
$t->parse("page","page");
$html = $t->get("page");
ice_cache::no_cache($html, CACHE_USE_HEADERS);
//print_r($pm);
?>