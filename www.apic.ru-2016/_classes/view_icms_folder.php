<?
require_once(CLASSES_BASE.'view_icms_proto.php');

class view_icms_folder extends view_icms_proto{
var $template = 'folder';

function get_html($o) {
	//alid($o);
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$this->_view_standart_parts(&$t);
	$this->_view_css_parts(&$t, &$o);

	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$t->set_var("PAGE.visdate", $o['object']['visdate'] );
	$this->_view_standart_seo($t, $o);
	$this->_view_matomo_stat($t, $o);

	
//alid($o['firm']);
	
	if($o['firm']){
		//alid($o['firm']);
		$t->set_var("PAGE.firm_name", $o['firm']['fullname'] );
		$t->set_var("PAGE.firm_url", $o['firm']['url'] );
		$t->set_var("PAGE.firm_logo", '/images/flogos/'.$o['firm']['params']['logo']['pvalue'] );
		$t->set_var("PAGE.firm_equipment", $o['firm']['params']['equipment']['pvalue'] );
		$this->_view_customed_anonces(&$t, &$o, 'morenews', 'MORENEWS', true);
		}
	else {
		$t->set_block("page", "BLOCK.HAVEMORENEWS", "BLOCK_HAVEMORENEWS");
		$t->set_var("BLOCK_HAVEMORENEWS", '' );
		//$t->parse("BLOCK_HAVEMORENEWS", "BLOCK.HAVEMORENEWS", false);
		};
		
		

		
		
	$t->set_block("page", "BLOCK.COMPANYHEADER", "BLOCK_COMPANYHEADER");		
	//alid($o['firm']);
	if ($o['companyheader'] && $o['firm']){
        list($lw,$lh)=getimagesize(PME_FOLDER_ROOT.'/images/flogos/'.$o['firm']['params']['logo']['pvalue']);
        $coefw=170/$lw;
        $coefh=120/$lh;
        if($coefw>=$coefh) {$coef=$coefh; }  else { $coef=$coefw;  };
		$logo_w = intval($lw*$coef);
		$logo_h = intval($lh*$coef);
		$t->set_var("COMPANYHEADER.web", $o['firm']['params']['web']['pvalue'] );
		$t->set_var("COMPANYHEADER.logo_w", $logo_w);
		$t->set_var("COMPANYHEADER.logo_h", $logo_h);
		$t->set_var("COMPANYHEADER.logo", $o['firm']['params']['logo']['pvalue'] );
		$t->set_var("COMPANYHEADER.name", $o['firm']['name'] );
		$t->set_var("COMPANYHEADER.pcode1", $o['firm']['params']['pcode1']['pvalue'] );
		$t->set_var("COMPANYHEADER.phone1", $o['firm']['params']['phone1']['pvalue'] );
		$t->set_var("COMPANYHEADER.web", $o['firm']['params']['web']['pvalue'] );
		$t->set_var("COMPANYHEADER.url", $o['firm']['url'] );
		$t->parse("BLOCK_COMPANYHEADER", "BLOCK.COMPANYHEADER", false);
		}
	else {
		$t->set_var("BLOCK_COMPANYHEADER", '' );
		};

	$this->_view_standart_top_navigation(&$t, &$o,'NAVIGATION');
//	$this->_view_standart_left_menu(&$t, &$o);
	$this->_view_tree_menu(&$t, &$o);

	$t->set_var("BANNERS_ALL_LEFT.document", $o['b1']['document'] );
	$t->set_var("BANNERS_ALL_TOP.document", $o['b2']['document'] );
	$t->set_var("BANNERS_ALL_BOTTOM.document", $o['b3']['document'] );
	$t->set_var("BANNERS_INDEX_MIDDLE.document", $o['b4']['document'] );
	$t->set_var("BANNERS_NAV_LEFT.document", $o['b5']['document'] );
	$t->set_var("BANNERS_CNT_BOTTOM.document", $o['b6']['document'] );
	
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
		
	
		
	// документ
	$t->set_var("PAGE.name", $o['object']['fullname'] );
	$t->set_var("PAGE.document", $o['object']['document'] );

	$t->parse("page","page");
	return $t->get("page");
	}


	
	
	
	
	
	
	
function _view_customed_anonces_age($t, $o, $arrayname, $NAME){
	$t->set_block("page", "BLOCK.HAVE$NAME", "BLOCK_HAVE$NAME");
	$t->set_var("BLOCK_HAVE$NAME", "");
	$t->set_block("BLOCK.HAVE$NAME", "BLOCK.$NAME", "BLOCK_$NAME");
	$t->set_var("BLOCK_$NAME", "");
	$t->set_block("BLOCK.$NAME", "BLOCK.AGE$NAME", "BLOCK_AGE$NAME");
	$t->set_var("BLOCK_AGE$NAME", "");
	if (is_array($o[$arrayname]) && (sizeof($o[$arrayname])>0) ) {
		while (list($k, $v) = each($o[$arrayname])) {
				$t->set_var("BLOCK_AGE$NAME", "");
				$t->set_var("$NAME.name", $v['name']);
				$t->set_var("$NAME.url", $this->get_cms_url($v['type'], $v['url']) );
				$t->set_var("$NAME.age", $v['params']['age']['pvalue']);
				$t->set_var("$NAME.letter", $v['params']['letter']['pvalue']);
				if($v['params']['age']['pvalue']>=5){
					$t->parse("BLOCK_AGE$NAME", "BLOCK.AGE$NAME", true);
					};
				$t->parse("BLOCK_$NAME", "BLOCK.$NAME", true);
			};
		$t->parse("BLOCK_HAVE$NAME", "BLOCK.HAVE$NAME", false);
		};
	}
	
	
	
	
	
	
	
}
?>