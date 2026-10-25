<?
require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'class_permission_manager.php');
require_once(CLASSES_BASE.'admin_icms.php');

$rights = array(
    'view'=>103,
    'edit'=>103
    );

$bgcolors = array(
    "0" => "#ffffff",
    "1" => "#f0f0f0",
    "2" => "#ffdddd",
	"3" => "#ddddff",
	"4" => "#ccccff",
	"5" => "#ffffcc"
	);

$m = new ice_mysql();

$pm = new permission_manager($m, MYSQL_DB);
if (!$pm->checkLogged()){
	// добавить в лог что кто то логинился...
	exit();
	};
$status_permission = $pm->check_rights($rights['view']);
if (!$status_permission['status']) {
	$pm->show_permission_denied();
	exit();
	};

if (isset($HTTP_POST_VARS['ID'])) {
	$ID = $HTTP_POST_VARS['ID'];
	$V = $HTTP_POST_VARS;
	}
elseif (isset($HTTP_GET_VARS['ID'])) {
	$ID = $HTTP_GET_VARS['ID'];
	$V = $HTTP_GET_VARS;
	}
else {
	$ID = 'index';
	$V = $HTTP_GET_VARS;
	};

//$model_curr = new model_money_currency(&$m);

$html = "";
if ( function_exists($ID) ) {

// cache purge before 
	if ( defined('XCACHE_ENABLED') && (true==XCACHE_ENABLED)){
		xcache_unset_by_prefix('icms_');
		};

	$html = call_user_func($ID);

// cache purge after
	if ( defined('XCACHE_ENABLED') && (true==XCACHE_ENABLED)){
		xcache_unset_by_prefix('icms_');
		};

	}
else {
	ali_debug('','','',$HTTP_GET_VARS);
	ali_debug('','','',$HTTP_POST_VARS);
	echo "Обработчик для $ID не существует.";
	exit();
	};

ice_cache::no_cache($html, true);
exit();


//========================================================================================================//



function index($error = '') {
	global  $bgcolors, $m, $memberlogtypes;

	$f =  $m->selectManyRows("select 
		ma.event_id,ma.param_name,ma.param_value, mm.created
		from 
		TRIGGERS_EVENT_PARAMS as ma
		left join TRIGGERS_EVENT as mm
		on mm.id = ma.event_id
		where ma.trigger_name IN ('member_accreditation','member_accreditation_eng')	order by ma.event_id DESC", '','',array());
	$files=array();
	while(list($k,$v)=each($f)) {
		$files[$v['event_id']][$v['param_name']] = $v['param_value'];
		$files[$v['event_id']]['created'] = $v['created'];
		};
	
		$t = new ice_templates();
		$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."forms_acc/index.html" );
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
		$t->set_var('ERROR',    htmlspecialchars($error) );
		$t->set_block('page', 'BLOCK.GLOBAL', 'BLOCK_GLOBAL');
		$t->set_var('BLOCK_GLOBAL', '');
	while(list($kk,$vv)=each($files)) {
		while(list($kkk,$vvv)=each($vv)) {
			$t->set_var('id', $kk);
			$t->set_var($kkk, htmlspecialchars($vvv) );
			};
			$t->parse('BLOCK_GLOBAL', 'BLOCK.GLOBAL', true);
			};
		$t->parse("page","page");
		return $t->get("page");
}


?>