<?
require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'class_permission_manager.php');
require_once(CLASSES_BASE.'admin_icms.php');

$rights = array(
    'view'=>87,
    'edit'=>87
    );

$bgcolors = array(
    "0" => "#ffffff",
    "1" => "#f0f0f0",
    "2" => "#ffdddd",
	"3" => "#ddddff",
	"4" => "#ccccff",
	"5" => "#ffffcc"
	);

$memberlogtypes=array(
	 'process_edit_brand_card'=>'Изменены категории бренда',
	 'process_one_eng_nov'=>'Изменена английская новинка',
	 'process_add_eng_nov'=>'Добавлена английская новинка',
	 'process_one_nov'=>'Изменена новинка',
	 'process_add_nov'=>'Добавлена новинка',
	 'process_one_eng_news'=>'Изменена английская новсть',
	 'process_add_eng_news'=>'Добавлена английская новость',
	 'process_one_news'=>'Изменена новость',
	 'process_add_news'=>'Добавлена новость',
	 'remove_brand'=>'Удален бренд',
	 'add_brand'=>'Добавлен бренд',
	 'process_firm'=>'Изменена карточка компании',
	 'process_efirm'=>'Изменена английская карточка компании'
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
//	$cbgcolor = 0;

	$files =  $m->selectManyRows("
	SELECT 
		la.id,
		uc.login,
		la.user_id,
		la.session_id,
		la.type,
		la.created
	FROM
		".MYSQL_DB_MEMBER.".logged_actions as la 
	LEFT JOIN
		".MYSQL_DB_MEMBER.".user_card as uc
	ON
		uc.id=la.user_id
	WHERE
		la.user_id>0
	AND
		la.type in (	
	 'process_edit_brand_card',
	 'process_one_eng_nov',
	 'process_add_eng_nov',
	 'process_one_nov',
	 'process_add_nov',
	 'process_one_eng_news',
	 'process_add_eng_news',
	 'process_one_news',
	 'process_add_news',
	 'remove_brand',
	 'add_brand',
	 'process_firm',
	 'process_efirm'
      )
	ORDER BY
		la.id DESC
	LIMIT 5000
	", '','',array());
	rsort($files);
		$t = new ice_templates();
		$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."memberlog/index.html" );
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
		$t->set_var('ERROR',    htmlspecialchars($error) );
		$t->set_block('page', 'BLOCK.GLOBAL', 'BLOCK_GLOBAL');
		$t->set_var('BLOCK_GLOBAL', '');
	while(list($kk,$vv)=each($files)) {
//                			    $cbgcolor = intval(!($cbgcolor));
//	                            $t->set_var('bgcolor', $bgcolors[	$cbgcolor	]);
	                            $t->set_var('id', $vv['id']);
	                            $t->set_var('login', $vv['login']);
                				$t->set_var('user_id',  $vv['user_id']);
                				$t->set_var('session_id',  $vv['session_id']);
								$t->set_var('type', $memberlogtypes[ $vv['type'] ]);
								$t->set_var('created', $vv['created'] );
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