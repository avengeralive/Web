<?
require_once(CLASSES_BASE.'view_icms_proto.php');

class view_icms_folder_banner extends view_icms_proto{
var $template = 'folder';

function get_html($o) {
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$this->_view_standart_parts(&$t);

	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	//$this->_view_standart_seo($t, $o);

	// документ
	$t->set_var("PAGE.name", $o['object']['fullname'] );
	$t->set_var("PAGE.document", $o['object']['document'] );

	$t->parse("page","page");
	return $t->get("page");
	}

}
?>