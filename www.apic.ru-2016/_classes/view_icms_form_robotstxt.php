<?
require_once(CLASSES_BASE.'view_icms_proto.php');
class view_icms_form_robotstxt extends view_icms_proto{
var $template = 'folder';
function get_html($o) {	
	$txt = str_replace (
		'{{ROBOTS_BASE}}',
		ROBOTS_BASE,
		$o['object']['document']
		);
	header('Content-type: text/plain');
	return $txt;
	}
}
?>
