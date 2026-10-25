<?
require_once(CLASSES_BASE."view_icms.php");

class view_icms_link_id extends view_icms{
function get_html($o) {
	$fact = new factory_view_icms();
	$me = $fact->get_me($o['type']);
	return $me->get_html( $o );
	}
}
?>