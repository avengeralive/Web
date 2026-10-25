<?
require_once(CLASSES_BASE.'view_icms_folder.php');

class view_icms_folder_catalog extends view_icms_folder{
var $template = 'folder_catalog';

function get_html($o) {
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$this->_view_standart_parts(&$t);
	$this->_view_css_parts(&$t, &$o);

//	alid(	$o['object']	);
	
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$this->_view_standart_seo($t, $o);
	$this->_view_matomo_stat($t, $o);

	$this->_view_standart_top_navigation(&$t, &$o,'NAVIGATION');
//	$this->_view_standart_left_menu(&$t, &$o);
//alid($o['menu']);
	reset($o['menu'] );
	while (list($k, $v)=each(	$o['menu']	)){
		if ($v['type']!='folder_catalog'){
			unset($o['menu'][$k]);
			};
		};
	$this->_view_tree_menu(&$t, &$o);
	
	$t->set_var("BANNERS_ALL_LEFT.document", $o['b1']['document'] );
	$t->set_var("BANNERS_ALL_TOP.document", $o['b2']['document'] );
	$t->set_var("BANNERS_ALL_BOTTOM.document", $o['b3']['document'] );
	$t->set_var("BANNERS_INDEX_MIDDLE.document", $o['b4']['document'] );
	$t->set_var("BANNERS_NAV_LEFT.document", $o['b5']['document'] );
	$t->set_var("BANNERS_CNT_BOTTOM.document", $o['b6']['document'] );
	
/*
	reset($o['brands'] );
	while (list($k, $v)=each(	$o['brands']	)){
		if ( 
			isset($v['params']['logo']['pvalue']) && ($v['params']['logo']['pvalue']!='')
			){
			$o['brands'][$k]['params']['logo']['pvalue']  = '/c/brand-logos/'.$v['params']['logo']['pvalue'];
			}
		else {
			$o['brands'][$k]['params']['logo']['pvalue']  = '/c/companys/x.gif';
			};
		};
	reset(	$o['brands']	);
	$this->_view_customed_anonces(&$t, &$o, 'brands', 'BRAND');
*/
	
	reset($o['company']);
	while (list($k, $v)=each(	$o['company']	)){
		if ($v['params']['logo']['pvalue']==''){
			// воткнем лого вместо пустой картинки
			$o['company'][$k]['params']['logo']['pvalue']  = '/c/companys/x.gif';
			}
		else {
			$o['company'][$k]['params']['logo']['pvalue']  = '/images/flogos/'.$v['params']['logo']['pvalue'];
			};
		};
	reset(	$o['company']	);
	$this->_view_customed_anonces(&$t, &$o, 'company', 'COMPANY');
	
	
	// документ
	$t->set_var("PAGE.name", $o['object']['fullname'] );
	$t->set_var("PAGE.document", $o['object']['document'] );

	if ($o['header']){
		// мы искали как то сложно, поэтому название страницы НЕ выводим.
		$t->set_var("PAGE.name", '' );
		};
	




	/*
	$chars=array();
	reset($o['brands']);
	$i=1;
	$o['anons1']=array();
	$o['anons2']=array();
	$o['anons3']=array();
	while (list($kk, $vv) = each($o['brands'])) {
		$o['anons'.$i][$kk]=$vv;
		$char = strtolower(substr($vv['name'], 0,1));
		$o['anons'.$i][$kk]['params']['letter']['pvalue']= $char;
		$chars[$char]=$char;
		$i++;
		if ($i>3){
			$i=1;
			};
		};
	
	
	$t->set_block("page", "BLOCK.HAVEBRANDS", "BLOCK_HAVEBRANDS");
	$t->set_var("BLOCK_HAVEBRANDS", "");
	if (sizeof($o['anons1'])>0){
		$t->parse("BLOCK_HAVEBRANDS", "BLOCK.HAVEBRANDS", false);
		};
//	$this->_view_customed_anonces_age(&$t, &$o, 'anons1', 'ANONS1');
//	$this->_view_customed_anonces_age(&$t, &$o, 'anons2', 'ANONS2');
//	$this->_view_customed_anonces_age(&$t, &$o, 'anons3', 'ANONS3');

	
	$this->_view_customed_anonces(&$t, &$o, 'anons', 'ANONS');
	*/
	
	
	while (list($k, $v)=each(	$o['membernews']	)){
			$o['membernews'][$k]['params']['day']['pvalue']  =   $this->_guess_day_created($o['membernews'][$k]['visdate']);
			$o['membernews'][$k]['params']['month']['pvalue']  = $this->_guess_month_created($o['membernews'][$k]['visdate']);
			};
	reset(	$o['membernews']	);
	$this->_view_customed_anonces(&$t, &$o, 'membernews', 'MEMBERNEWS');

		
	while (list($k, $v)=each(	$o['news']	)){
			$o['news'][$k]['params']['day']['pvalue']  =   $this->_guess_day_created($o['news'][$k]['visdate']);
			$o['news'][$k]['params']['month']['pvalue']  = $this->_guess_month_created($o['news'][$k]['visdate']);
			};
	reset(	$o['news']	);
	$this->_view_customed_anonces(&$t, &$o, 'news', 'NEWS');
	
	
	
	$t->parse("page","page");
	return $t->get("page");
	}


	
	
	
	
	
	
	
}
?>