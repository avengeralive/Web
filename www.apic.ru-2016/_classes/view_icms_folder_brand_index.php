<?
require_once(CLASSES_BASE.'view_icms_folder.php');

class view_icms_folder_brand_index extends view_icms_folder{
var $template = 'folder_brand_index';
var $title_postfix = CMS_VARS_TITLE_POSTFIX;

function get_html($o) {

	if (isset($_REQUEST['subID'])) {
		$this->template = 'folder_eng_brand_index';
		$o['b5']['document'] = '';
		$o['object']['name'] = 'Brands';
		$this->title_postfix = CMS_VARS_TITLE_POSTFIX_ENGLISH;
		};



	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$this->_view_standart_parts(&$t);
	$this->_view_css_parts(&$t, &$o);

	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$this->_view_standart_seo($t, $o);
	$t->set_var("PAGE.title", $o['object']['name']. $this->title_postfix );

	$this->_view_standart_top_navigation(&$t, &$o,'NAVIGATION');
	$this->_view_standart_left_menu(&$t, &$o);

	$t->set_var("BANNERS_ALL_LEFT.document", $o['b1']['document'] );
	$t->set_var("BANNERS_ALL_TOP.document", $o['b2']['document'] );
	$t->set_var("BANNERS_ALL_BOTTOM.document", $o['b3']['document'] );
	$t->set_var("BANNERS_INDEX_MIDDLE.document", $o['b4']['document'] );
	$t->set_var("BANNERS_NAV_LEFT.document", $o['b5']['document'] );
	$t->set_var("BANNERS_CNT_BOTTOM.document", $o['b6']['document'] );

	$chars=array();
	reset($o['anons']);
	$i=1;
	while (list($kk, $vv) = each($o['anons'])) {
		$o['anons'.$i][$kk]=$vv;
		
		if (isset($_REQUEST['subID'])) {
			$o['anons'.$i][$kk]['url'] = '/eng'.$o['anons'.$i][$kk]['url'];
			};
		
		$char = strtolower(substr($vv['name'], 0,1));
		$o['anons'.$i][$kk]['params']['letter']['pvalue']= $char;
		$chars[$char]=$char;
		$i++;
		if ($i>3){
			$i=1;
			};
		};

	$t->set_block("page", "BLOCK.CHARS", "BLOCK_CHARS");
	$t->set_var("BLOCK_CHARS", "");
	$t->set_block("page", "BLOCK.RUSCHARS", "BLOCK_RUSCHARS");
	$t->set_var("BLOCK_RUSCHARS", "");
	while (list($k, $v) = each($chars)) {
		if (preg_match('/[a-z]{1}/',$v)){
			// lat
			$t->set_var("CHARS.name", $v);
			$t->parse("BLOCK_CHARS", "BLOCK.CHARS", true);
			}
		else {
			//rus
			$t->set_var("RUSCHARS.name", $v);
			$t->parse("BLOCK_RUSCHARS", "BLOCK.RUSCHARS", true);
			};
		};
	
	$this->_view_customed_anonces_age(&$t, &$o, 'anons1', 'ANONS1');
	$this->_view_customed_anonces_age(&$t, &$o, 'anons2', 'ANONS2');
	$this->_view_customed_anonces_age(&$t, &$o, 'anons3', 'ANONS3');

	// документ
	$t->set_var("PAGE.name", $o['object']['fullname'] );
	$t->set_var("PAGE.document", $o['object']['document'] );

	$t->parse("page","page");
	return $t->get("page");
	}
	
}
?>