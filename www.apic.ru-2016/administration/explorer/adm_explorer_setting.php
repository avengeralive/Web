<?

require_once('../../_settings/settings.php');

//define ('CLASSES_BASE_EXT', '.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
//require_once(CLASSES_BASE.'class_lib_templates.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
//require_once(CLASSES_BASE.'cms_admin.php');

$m = new ice_mysql();
//$an = new cms_admin(&$m, MYSQL_DB.'.tree', MYSQL_DB.'.docs',MYSQL_DB.'.params', DOCUMENT_TEMPLATES_ADMIN);

/** BEGIN PERMISSIONS HACK **/
require_once(CLASSES_BASE.'class_permission_manager.php');
$rights = array(
    'view'=>56,
    'edit'=>56
    );
$pm = new permission_manager($m,  MYSQL_DB);
if (!$pm->checkLogged()){
	// добавить в лог что кто то логинился...
	exit();
	};
$status_permission = $pm->check_rights($rights['view']);
if (!$status_permission['status']) {
	$pm->show_permission_denied();
	echo "perm error";
	exit();
	};
/** END PERMISSIONS HACK **/



/*

	DEFINE('PME_VERSION', '1.01a-developing');
	DEFINE('PME_FOLDER_ROOT', '/www/www.payor.ru/public/');
	DEFINE('PME_WWW' , '/explorer/');
	DEFINE('PME_FOLDERS_ALWAYS_FIRST' , true);        // for sorting
	DEFINE('PME_FOLDER_ICO' , '/www/www.payor.ru/administration/explorer/i/');
	DEFINE('PME_TEMPLATES_ROOT',  '/www/www.payor.ru/administration/explorer/templates/');

*/

	DEFINE('PME_DISABLED_EXTENSIONS' , '/\.(php|jsp|htaccess|htacl|js|css)$/');


/*




// configuration file for "" explorer administration
// 2001-2002  mailto:ice@rbcmail.ru  icq:39472497

//DEFINE('DEVELOPING', true);         // intranet
DEFINE('DEVELOPING', false);        // internet

if (DEVELOPING) {
	// intranet
	}
else {
	// internet


//	error_reporting (E_ALL); 

	error_reporting (0); 

	ini_set ("magic_quotes_runtime" ,false);
	ini_set ("magic_quotes_sybase" ,false);
    ini_set ("magic_quotes_gpc" ,false);

    DEFINE("EHANDLER_EXIT_ON_ERROR", false);
    DEFINE("EHANDLER_SURFER_MESSAGE", "<h2>Сервер  временно недоступен.</h2>");
    DEFINE("EHANDLER_LOG_ERROR", true);
    DEFINE("EHANDLER_SHOW_ERROR", false );                                // MUST BE FALSE!!!
    DEFINE("EHANDLER_EMAIL_ERROR", false);
    DEFINE("EHANDLER_ADMIN_EMAIL", "webmaster@comfortshop.info");
    DEFINE("EHANDLER_LOG_FILE", ".hta_phperror");
    DEFINE('EHANDLER_DUMP_ALL_GLOBALS', false);                         // MUST BE FALSE!!!
    DEFINE('EHANDLER_BREAKPOINT_DEBUG', true);                         // MUST BE FALSE!!!
	};
*/

?>
