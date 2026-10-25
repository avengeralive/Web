<?
require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'controller_icms.php');
$controller = new controller_icms();
$controller->run();
?>
