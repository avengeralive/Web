<?

require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'class_permission_manager.php');
require_once(CLASSES_BASE.'admin_icms.php');
require_once(CLASSES_BASE.'class_ice_excel.php');

/*
$currency_names = array(
	'0'=>'unset',
	'1'=>'usd',
	'2'=>'euro',
	'3'=>'rur'
	);
$currency_names_back = array(
	'unset'=>0,
	'usd'=>1,
	'euro'=>2,
	'rur'=>3
	);
*/
$rights = array(
    'view'=>77,
    'edit'=>77
    );

$bgcolors = array(
    "0" => "#ffffff",
    "1" => "#f0f0f0",
    "2" => "#ffdddd",
	"3" => "#ddddff",
	"4" => "#ccccff",
	"5" => "#ffffcc"
	);

//$m = new ice_mysql();
//$m_money = new model_money_currency($m, MYSQL_DB);
//$cmsadm = new cms_admin(&$m, MYSQL_DB.'.tree', MYSQL_DB.'.docs',MYSQL_DB.'.params', DOCUMENT_TEMPLATES_ADMIN);
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
	global  $bgcolors, $m;
//	$cbgcolor = 0;
	$files =  $m->selectManyRows("
	SELECT 
		id,
		urlfrom,
		urlto,
		status,
		created
	FROM
		".MYSQL_DB.".redirect
	ORDER BY
		id DESC
	", '','',array());
	rsort($files);
		$t = new ice_templates();
		$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."redirects/index.html" );
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
		$t->set_var('ERROR',    htmlspecialchars($error) );
		$t->set_block('page', 'BLOCK.GLOBAL', 'BLOCK_GLOBAL');
		$t->set_var('BLOCK_GLOBAL', '');
	while(list($kk,$vv)=each($files)) {
//                			    $cbgcolor = intval(!($cbgcolor));
//	                            $t->set_var('bgcolor', $bgcolors[	$cbgcolor	]);
	                            $t->set_var('id', $vv['id']);
                				$t->set_var('urlfrom',  $vv['urlfrom']);
                				$t->set_var('urlto',  $vv['urlto']);
								$t->set_var('status', $vv['status'] );
								$t->set_var('date', $vv['created'] );
                        $t->parse('BLOCK_GLOBAL', 'BLOCK.GLOBAL', true);
						};
		$t->parse("page","page");
		return $t->get("page");
}







function delete(){
	global $V, $m;
	$id = $V['row'];
	$o =  $m->query("
	DELETE
	FROM
		".MYSQL_DB.".redirect
	WHERE
		id = '#id#'
	", '','',array('id'=>$id));
	
	return index('Удалено');
	}




?>