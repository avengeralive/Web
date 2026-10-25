<?
require_once(CLASSES_BASE.'model_icms.php');

class factory_model_icms extends model_icms{
function get_me($type) {
	$factory = 'model_icms_'.$type;
	if (file_exists(CLASSES_BASE.$factory.'.php')) {
		require_once(CLASSES_BASE.$factory.'.php');
		};
	if (class_exists( $factory )) {
		$o = new $factory($this->m);
		return $o;
		};
	return false;
	}
}
?>
