<?

require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'class_permission_manager.php');
require_once(CLASSES_BASE.'model_money_currency.php');
require_once(CLASSES_BASE.'admin_icms.php');
require_once(CLASSES_BASE.'class_ice_excel.php');


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

$rights = array(
    'view'=>66,
    'edit'=>66
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
	global  $bgcolors;
	$cbgcolor = 0;
	$files = scandir(ALL_ROOT_BASE.'_backup/');
	rsort($files);
		$t = new ice_templates();
		$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."backups/index.html" );
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
		$t->set_var('ERROR',    htmlspecialchars($error) );
		$t->set_block('page', 'BLOCK.GLOBAL', 'BLOCK_GLOBAL');
		$t->set_var('BLOCK_GLOBAL', '');
	while(list($kk,$vv)=each($files)) {
				if (preg_match('/^backcontent.*/', $vv)){
                			    $cbgcolor = intval(!($cbgcolor));
	                            $t->set_var('bgcolor', $bgcolors[	$cbgcolor	]);
	                            $t->set_var('type', 'Только сайт');
                				$t->set_var('file',  $vv);
								$t->set_var('date', date("Y M d H:i:s", filemtime(ALL_ROOT_BASE.'_backup/'.$vv)) );
                				$t->set_var('size',  filesize(ALL_ROOT_BASE.'_backup/'.$vv));
                        $t->parse('BLOCK_GLOBAL', 'BLOCK.GLOBAL', true);
						}
				elseif(preg_match('/^[0-9]/', $vv)){
                			    $cbgcolor = intval(!($cbgcolor));
	                            $t->set_var('bgcolor', $bgcolors[	$cbgcolor	]);
	                            $t->set_var('type', '<strong>Полный</strong>, с заказами, курсами и всеми служебными таблицами');
                				$t->set_var('file',  $vv);
								$t->set_var('date', date("Y M d H:i:s", filemtime(ALL_ROOT_BASE.'_backup/'.$vv)) );
                				$t->set_var('size',  filesize(ALL_ROOT_BASE.'_backup/'.$vv));
                        $t->parse('BLOCK_GLOBAL', 'BLOCK.GLOBAL', true);
						};
				};
		$t->parse("page","page");
		return $t->get("page");
}



function create(){
	$file = ALL_ROOT_BASE.'_backup/backcontent-'.MYSQL_DB.'-'.date('Ymd-His').'.sql';
	$job= BACKUP_JOB.$file;
	$status = `$job`;
	echo '<!-- '.$job.$status.' -->';
	if (file_exists($file)){
		$c2 = "/usr/bin/gzip $file";
		$status = `$c2`;
		$file = $file.'.gz';
		return index('Создан новый бекап '.$file.' размер '.filesize($file));
		};
	return index('Файл не создан =\ ');
	}



function restore(){
	global $V;
	echo "Start restore...<br>"; flush();sleep(1);flush();
	$file = $V['file'];
	$ffile = ALL_ROOT_BASE.'_backup/'.$file;
	if (file_exists($ffile)){
		echo "Found file=$ffile size=".filesize($ffile)."<br>"; flush();sleep(1);flush();
		// unzip
		$c2 = "/usr/bin/gzip -d $ffile";
		$status = `$c2`;
		$newfile = str_replace('.gz','',$ffile);
		echo "Unzipped file=$newfile size=".filesize($newfile)."<br>"; flush();sleep(1);flush();
		if (file_exists($newfile)){
			echo "Start restore from file=$newfile ...<br>"; flush();sleep(1);flush();
			$c3 = BACKUP_RESTORE.$newfile;
			echo "Command is: $c3<br>"; flush();sleep(1);flush();
			$status = `$c3`;
			echo "Status: $status<br>"; flush();sleep(1);flush();
			echo "<hr><h1>Сайт восстановлен из файла $file</h1><a href='/'>Перейти в администрирование на первую страницу</a>";
			exit();
			};
		};

	echo 'Error: Cant restore from file='.$ffile;
	}


function download(){
	global $V;
	$file = $V['file'];
	if (file_exists(ALL_ROOT_BASE.'_backup/'.$file)){
		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename=$file");
		readfile(ALL_ROOT_BASE.'_backup/'.$file);
		}
	else {
		echo 'Error: Cant read file='.ALL_ROOT_BASE.'_backup/'.$file;
		};
	}




?>