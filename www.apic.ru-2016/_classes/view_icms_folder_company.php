<?
require_once(CLASSES_BASE.'view_icms_folder.php');

class view_icms_folder_company extends view_icms_folder{
var $template = 'folder_company';
var $eng = '';
var $title_postfix = CMS_VARS_TITLE_POSTFIX;


function aaa($a,$b){
	return ($a!='')?$a:$b;
	}

function get_html($o) {

	//alid($o);
	
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$this->_view_standart_parts(&$t);
	$this->_view_css_parts(&$t, &$o);

	
	$this->_view_2level_anonses(&$t, &$o, 2, 'cat_stats', 'CATALOG');
	
//	alid(	$o	);
	
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$this->_view_standart_seo($t, $o);
	$this->_view_matomo_stat($t, $o);
	$t->set_var("PAGE.title", $o['object']['name']. $this->title_postfix );

	//alid($o);
	//if ($this->eng!=''){
	//	unset($o['navigation'][1]);
		//};
		
$this->_view_standart_top_navigation(&$t, &$o,'NAVIGATION');
//	$this->_view_standart_left_menu(&$t, &$o);
	$this->_view_tree_menu(&$t, &$o);
	
	$t->set_var("BANNERS_ALL_LEFT.document", $o['b1']['document'] );
	$t->set_var("BANNERS_ALL_TOP.document", $o['b2']['document'] );
	$t->set_var("BANNERS_ALL_BOTTOM.document", $o['b3']['document'] );
	$t->set_var("BANNERS_INDEX_MIDDLE.document", $o['b4']['document'] );
	$t->set_var("BANNERS_NAV_LEFT.document", $o['b5']['document'] );
	$t->set_var("BANNERS_CNT_BOTTOM.document", $o['b6']['document'] );
	
//	alid($o['news']);
	while (list($k, $v)=each(	$o['membernews']	)){
//			$o['news'][$k]['params']['day']['pvalue']  =   $this->_guess_day($o['news'][$k]['params']['news_date']['pvalue']);
//			$o['news'][$k]['params']['month']['pvalue']  = $this->_guess_month($o['news'][$k]['params']['news_date']['pvalue']);
			$o['membernews'][$k]['params']['day']['pvalue']  =   $this->_guess_day_created($v['visdate']);
			$o['membernews'][$k]['params']['month']['pvalue']  = $this->_guess_month_created($v['visdate']);
			};
	reset(	$o['membernews']	);
	$this->_view_customed_anonces(&$t, &$o, 'membernews', 'MEMBERNEWS');

//	$t->set_var("PAGE.age", $o['params']['age']['pvalue'] );
	$t->set_var("PAGE.logo", $o['params']['logo']['pvalue'] );
	
//		echo $o['params']['logo']['pvalue'];
        list($lw,$lh)=getimagesize(PME_FOLDER_ROOT.'/images/flogos/'.$o['params']['logo']['pvalue']);
        $coefw=170/$lw;
        $coefh=120/$lh;
        if($coefw>=$coefh) {$coef=$coefh; }  else { $coef=$coefw;  };
       
		$logo_w = intval($lw*$coef);
		$logo_h = intval($lh*$coef);
	
	$t->set_var("PAGE.logo_h", $logo_h );
	$t->set_var("PAGE.logo_w", $logo_w );
	
	
	//$t->set_var("PAGE.web", $o['params']['web']['pvalue'] );
	$web = 
		preg_match('/^http/',$o['params']['web']['pvalue'])?
		$o['params']['web']['pvalue']
		:
		'http://'.$o['params']['web']['pvalue'];
		
		$t->set_var("PAGE.web", 
		$web=='http://'?'':$web
		);

	$t->set_var("PAGE.email", $this->aaa($o['params']['email']['pvalue'], '&nbsp;') );
	$t->set_var("PAGE.pcode1", $o['params']['pcode1']['pvalue'] );
	$t->set_var("PAGE.pcode2", 
		($o['params']['phone2']['pvalue']!='')
		?
		', '.$o['params']['pcode2']['pvalue']
		:
		''
		);
	

	$t->set_var("PAGE.fcode", $o['params']['fcode']['pvalue'] );
	$t->set_var("PAGE.fax", $this->aaa($o['params']['fax']['pvalue'], '&nbsp;') );
	$t->set_var("PAGE.phone1", $this->aaa($o['params']['phone1']['pvalue'], '&nbsp;') );
//	$t->set_var("PAGE.phone2", ($o['params']['phone2']['pvalue']!='')?', '.$o['params']['phone2']['pvalue']:'' );
	$t->set_var("PAGE.phone2", $o['params']['phone2']['pvalue'] );
	$t->set_var("PAGE.postal_address", $this->aaa($o['params']['postal_address']['pvalue'], '&nbsp;') );
//	$t->set_var("PAGE.stand", $o['params']['stand']['pvalue'] );

	$t->set_var("PAGE.additional_info", $o['params']['additional_info']['pvalue'] );
	$t->set_var("PAGE.equipment", nl2br($o['params']['equipment']['pvalue'] ));
	$t->set_var("PAGE.dilers", nl2br($o['params']['dilers']['pvalue'] ));
	$t->set_var("PAGE.services", nl2br($o['params']['services']['pvalue'] ));
//	$t->set_var("PAGE.stand", $o['params']['stand']['pvalue'] );

	$t->set_block("page", "BLOCK.STAND", "BLOCK_STAND");
	$t->set_var("BLOCK_STAND", "");
	if (
		isset($o['params']['stand']['pvalue'])  && 
		preg_match('|^[12345678]|',$o['params']['stand']['pvalue'])
		){
		$t->parse("BLOCK_STAND", "BLOCK.STAND", true);
		};

	$t->set_block("page", "BLOCK.VIDEO", "BLOCK_VIDEO");
	$t->set_var("BLOCK_VIDEO", "");
	if (
		isset($o['params']['youtube_url']['pvalue'])  && 
		preg_match('|^//www.youtube|',$o['params']['youtube_url']['pvalue'])
		){
		$t->set_var("PAGE.youtube_info", $o['params']['youtube_info']['pvalue'] );
		$t->set_var("PAGE.youtube_url", $o['params']['youtube_url']['pvalue'] );
		$t->set_var("PAGE.youtube_size", $o['params']['youtube_size']['pvalue'] );
		$t->parse("BLOCK_VIDEO", "BLOCK.VIDEO", true);
		};


		
	$t->set_var("PAGE.fax.show", ($o['params']['fax']['pvalue']=='')?'no':'show');
	$t->set_var("PAGE.email.show", ($o['params']['email']['pvalue']=='')?'no':'show');
	$t->set_var("PAGE.phone1.show", ($o['params']['phone1']['pvalue']=='')?'no':'show');
	$t->set_var("PAGE.postal_address.show", ($o['params']['postal_address']['pvalue']=='')?'no':'show');
	$t->set_var("PAGE.web.show", ($web=='')?'no':'show');
	
	
	/*
	$t->set_block("page", "BLOCK.LOGO", "BLOCK_LOGO");
	$t->set_var("BLOCK_LOGO", "");
	if ($o['params']['logo']['pvalue']!=''){
		$t->parse("BLOCK_LOGO", "BLOCK.LOGO", true);
		};
	*/

	$t->set_block("page", "BLOCK.AI", "BLOCK_AI");
	$t->set_var("BLOCK_AI", "");
	if ($o['params']['additional_info']['pvalue']!=''){
		$t->parse("BLOCK_AI", "BLOCK.AI", true);
		};
	$t->set_block("page", "BLOCK.DI", "BLOCK_DI");
	$t->set_var("BLOCK_DI", "");
	if ($o['params']['dilers']['pvalue']!=''){
		$t->parse("BLOCK_DI", "BLOCK.DI", true);
		};
	$t->set_block("page", "BLOCK.SERVICES", "BLOCK_SERVICES");
	$t->set_var("BLOCK_SERVICES", "");
	if ($o['params']['services']['pvalue']!=''){
		$t->parse("BLOCK_SERVICES", "BLOCK.SERVICES", true);
		};
	$t->set_block("page", "BLOCK.EQ", "BLOCK_EQ");
	$t->set_var("BLOCK_EQ", "");
	if ($o['params']['equipment']['pvalue']!=''){
		$t->parse("BLOCK_EQ", "BLOCK.EQ", true);
		};

	$t->set_var("PAGE.newsurl", $o['object']['url'].'news/' );
	
	while (list($k, $v)=each(	$o['nov']	)){
		if ($v['params']['logo']['pvalue']!=''){
				$o['nov'][$k]['params']['picture']['pvalue']  = $v['params']['logo']['pvalue'];
			}
		else {
			if ($v['params']['picture']['pvalue']==''){
				// воткнем лого вместо пустой картинки
				$o['nov'][$k]['params']['picture']['pvalue']  = '/images/flogos/'.$o['params']['logo']['pvalue'];
				}
			else {
				// legacy
				$o['nov'][$k]['params']['picture']['pvalue']  = '/images/novelty_pic/'.$v['params']['picture']['pvalue'];
				};
			};
		};
	reset(	$o['nov']	);
	$this->_view_customed_anonces(&$t, &$o, 'nov', 'NOV');

	
	while (list($k, $v)=each(	$o['brands']	)){
		$v['params']['logo']['pvalue']='';  // hack2016
		if ( 
			isset($v['params']['logo']['pvalue']) && ($v['params']['logo']['pvalue']!='')
			){
			$o['brands'][$k]['params']['logo']['pvalue']  = '/c/brand-logos/'.$v['params']['logo']['pvalue'];
			}
		else {
			$o['brands'][$k]['params']['logo']['pvalue']  = '/c/companys/x.gif';
			};
		
		$o['brands'][$k]['params']['logo']['pvalue']  = '/c/brand-logos/'.$v['params']['logo']['pvalue'];
	
			//alid($o['brands'][$k]);
		$o['brands'][$k]['url'] = $this->eng.$o['brands'][$k]['url'];
		};
		
	// отключили простынку брендов
	reset(	$o['brands']	);
	//$this->_view_customed_anonces(&$t, &$o, 'brands', 'BRAND');
	$t->set_block("page", "BLOCK.HAVEBRAND", "BLOCK_HAVEBRAND");	
	$t->set_var("BLOCK_HAVEBRAND", '' );
	

	$this->_view_customed_anonces(&$t, &$o, 'objects', 'OBJECT');


	$t->set_var("PAGE.novurl", $o['object']['url'].'novelty/' );

	/*
	'/images/novelty_pic/'
	http://c.local/images/flogos/logo_32.jpg	
	*/

	
	
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


	
	
	
	
	
	
	
}
?>