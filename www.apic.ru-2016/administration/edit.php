<?
require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'class_permission_manager.php');
require_once(CLASSES_BASE.'admin_icms.php');

$m = new ice_mysql();

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

$an = new admin_icms(&$m);

// cache purge before 
	if ( defined('XCACHE_ENABLED') && (true==XCACHE_ENABLED)){
		xcache_unset_by_prefix('icms_');
		};

$an->run();

// cache purge after
	if ( defined('XCACHE_ENABLED') && (true==XCACHE_ENABLED)){
		xcache_unset_by_prefix('icms_');
		};
?>
