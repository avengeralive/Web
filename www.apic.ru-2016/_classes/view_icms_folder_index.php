<?
require_once(CLASSES_BASE.'view_icms_proto.php');

class view_icms_folder_index extends view_icms_proto{
var $template = 'folder_index';

function get_html($o) {
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$this->_view_standart_parts(&$t);
	$this->_view_css_parts(&$t, &$o);

	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$this->_view_standart_seo($t, $o);

	$t->set_var("BANNERS_ALL_LEFT.document", $o['b1']['document'] );
	$t->set_var("BANNERS_ALL_TOP.document", $o['b2']['document'] );
	$t->set_var("BANNERS_ALL_BOTTOM.document", $o['b3']['document'] );
	$t->set_var("BANNERS_INDEX_MIDDLE.document", $o['b4']['document'] );
	$t->set_var("BANNERS_NAV_LEFT.document", $o['b5']['document'] );
	$t->set_var("BANNERS_CNT_BOTTOM.document", $o['b6']['document'] );

//	$this->_view_standart_left_menu(&$t, &$o);	
	// документ
	$t->set_var("PAGE.name", $o['object']['fullname'] );
	$t->set_var("PAGE.document", $o['object']['document'] );

	while (list($k, $v)=each(	$o['news']	)){
			$o['news'][$k]['params']['day']['pvalue']  =   $this->_guess_day_created($o['news'][$k]['visdate']);
			$o['news'][$k]['params']['month']['pvalue']  = $this->_guess_month_created($o['news'][$k]['visdate']);
			};
	reset(	$o['news']	);
	$this->_view_customed_anonces(&$t, &$o, 'news', 'NEWS');


	while (list($k, $v)=each(	$o['membernews']	)){
			$o['membernews'][$k]['params']['day']['pvalue']  =   $this->_guess_day_created($o['membernews'][$k]['visdate']);
			$o['membernews'][$k]['params']['month']['pvalue']  = $this->_guess_month_created($o['membernews'][$k]['visdate']);
			};
	reset(	$o['membernews']	);
	$this->_view_customed_anonces(&$t, &$o, 'membernews', 'MEMBERNEWS');


//   $this->_view_customed_anonces(&$t, &$o, 'articles', 'ARTICLES');
//	$this->_view_customed_anonces(&$t, &$o, 'countrys', 'COUNTRY');
//    $this->_view_customed_anonces(&$t, &$o, 'types', 'TYPE');
 	while (list($k, $v) = each(	$o['params']	)) {
		$t->set_var("PAGE.".$k, $v['pvalue'] );
		};

	$t->parse("page","page");
	return $t->get("page");
	}

}
?>