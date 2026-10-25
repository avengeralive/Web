<?
require_once(CLASSES_BASE.'view_icms_proto.php');

class view_icms_folder_news extends view_icms_proto{
var $template = 'folder_news';

function get_html($o) {
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$this->_view_standart_parts(&$t);
	$this->_view_css_parts(&$t, &$o);

	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$this->_view_standart_seo($t, $o);

	$this->_view_standart_top_navigation(&$t, &$o,'NAVIGATION');
//	$this->_view_standart_left_menu(&$t, &$o);
	//$this->_view_tree_menu(&$t, &$o);

	$t->set_var("BANNERS_ALL_LEFT.document", $o['b1']['document'] );
	$t->set_var("BANNERS_ALL_TOP.document", $o['b2']['document'] );
	$t->set_var("BANNERS_ALL_BOTTOM.document", $o['b3']['document'] );
	$t->set_var("BANNERS_INDEX_MIDDLE.document", $o['b4']['document'] );
	$t->set_var("BANNERS_NAV_LEFT.document", $o['b5']['document'] );
	$t->set_var("BANNERS_CNT_BOTTOM.document", $o['b6']['document'] );

	while (list($k, $v)=each(	$o['anons']	)){
	//		echo $v['visdate'];
			$o['anons'][$k]['params']['day']['pvalue']  =   $this->_guess_day_created($v['visdate']);
			$o['anons'][$k]['params']['month']['pvalue']  = $this->_guess_month_created($v['visdate']);
			$o['anons'][$k]['params']['year']['pvalue']  = $this->_guess_year_created($v['visdate']);
			};
	reset(	$o['anons']	);
//	alid($o['anons']);
	
	$this->_view_customed_anonces(&$t, &$o, 'anons', 'ANONS');
	
	// документ
	$t->set_var("PAGE.name", $o['object']['fullname'] );
	$t->set_var("PAGE.document", $o['object']['document'] );

	$t->parse("page","page");
	return $t->get("page");
	}

}
?>