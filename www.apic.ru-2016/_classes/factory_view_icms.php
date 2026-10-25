<?
require_once(CLASSES_BASE.'view_icms.php');

class factory_view_icms extends view_icms{
function get_me($type){
	$factory = 'view_icms_'.$type;
	if (file_exists(CLASSES_BASE.$factory.'.php')) {
		require_once(CLASSES_BASE.$factory.'.php');
		};
	if (class_exists( $factory )) {
		$o = new $factory;
		return $o;
		}
	else {
		return false;
		};
	}

}
?>
