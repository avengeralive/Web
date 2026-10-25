<?
require_once(CLASSES_BASE.'view_icms_proto.php');

class view_icms_folder_brand extends view_icms_proto{
var $template = 'folder_brand';
var $title_postfix = CMS_VARS_TITLE_POSTFIX;

function get_html($o) {
//	alid($o);

	if (isset($_REQUEST['subID'])) {
		$this->template = 'folder_eng_brand';
		$o['b5']['document'] = '';
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


	$t->set_block("page", "BLOCK.HAVELOGO", "BLOCK_HAVELOGO");
	$t->set_var("BLOCK_HAVELOGO", "");

	$t->set_var("PAGE.logo", 
		(isset($o['params']['logo']['pvalue']) && ($o['params']['logo']['pvalue']!='' ))?
		'/c/brand-logos/'.$o['params']['logo']['pvalue']:
		'/c/companys/x.gif'
		);
	if (isset($o['params']['logo']['pvalue']) && ($o['params']['logo']['pvalue']!='' )){
			$t->parse("BLOCK_HAVELOGO", "BLOCK.HAVELOGO", false);
			};

	$t->set_var("PAGE.web", 
		(isset($o['params']['web']['pvalue']) && ($o['params']['web']['pvalue']!='' ))?
		$o['params']['web']['pvalue']:
		''
		);

	$t->parse("page","page");
	return $t->get("page");
	}

}
?>