<?
require_once(CLASSES_BASE.'view_icms_folder.php');
class view_icms_folder_eng_index extends view_icms_folder{
var $template = 'folder_eng_index';
var $title_postfix = CMS_VARS_TITLE_POSTFIX_ENGLISH;

function get_html($o) {
	//alid($o);
	// уберем ссылку на "английскую" версию
	unset($o['navigation'][1]);
	$o['navigation'][0]['url'] = '/en/';
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$this->_view_standart_parts(&$t);
	$this->_view_css_parts(&$t, &$o);

	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$this->_view_standart_seo($t, $o);
	$t->set_var("PAGE.title", $o['object']['seo_title']. $this->title_postfix );

//	$this->_view_standart_top_navigation(&$t, &$o,'NAVIGATION');
//	$this->_view_standart_left_menu(&$t, &$o);
//	$this->_view_tree_menu(&$t, &$o);

	$t->set_var("BANNERS_ALL_LEFT.document", $o['b1']['document'] );
	$t->set_var("BANNERS_ALL_TOP.document", $o['b2']['document'] );
	$t->set_var("BANNERS_ALL_BOTTOM.document", $o['b3']['document'] );
	$t->set_var("BANNERS_INDEX_MIDDLE.document", $o['b4']['document'] );
	$t->set_var("BANNERS_NAV_LEFT.document", $o['b5']['document'] );
	$t->set_var("BANNERS_CNT_BOTTOM.document", $o['b6']['document'] );
	
	/*
	if (
		isset($o['params']['no_anons']['pvalue']) && 
		($o['params']['no_anons']['pvalue']!='')
		){
		$t->set_block("page", "BLOCK.HAVEANONS", "BLOCK_HAVEANONS");
		$t->set_var("BLOCK_HAVEANONS", "");
		}
	else {
		$this->_view_customed_anonces(&$t, &$o, 'anons', 'ANONS');
		};
	*/
	// документ
	$t->set_var("PAGE.name", $o['object']['fullname'] );
	$t->set_var("PAGE.document", $o['object']['document'] );

	$t->parse("page","page");
	return $t->get("page");
	}

}
?>