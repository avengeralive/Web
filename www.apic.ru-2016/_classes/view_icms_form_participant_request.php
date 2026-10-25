<?
require_once(CLASSES_BASE.'view_icms_proto.php');

class view_icms_form_participant_request extends view_icms_proto{
var $template = 'form_participant_request';

function get_html($o) {
//alid($o);

		//$this->o = $o['object'];
		$this->o = $o;
		//$this->document = $o['document'];
		//$this->params = $o['document'];
		switch ($o['ID']) {
			case "index":
				return $this->index();
				break;
			case "process":
				return $this->index();
				break;
			case "ok":
				return $this->ok();
				break;
			default:
				return $this->index();
				break;
			}
	}


function index(){
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$o = $this->o;

	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	
	if ($this->template == 'form_participant_request'){
		$this->_view_standart_seo($t, $o);
		}
	else {
		$this->_view_standart_eng_seo($t, $o);
		};

	//alid($o['obj']['user']);
	$t->set_var(
		'errors', 
		(isset($o['obj']['errors'])?$o['obj']['errors']:'') 
		);

		while(list($k,$v)=each(	$o['obj']['user']	)){
			$t->set_var($k, htmlspecialchars($v) );
			};

	
	$this->_view_standart_top_navigation(&$t, &$o,'NAVIGATION');
//	$this->_view_standart_left_menu(&$t, &$o);
//	$this->_view_tree_menu(&$t, &$o);
	$this->_view_standart_parts(&$t);
	$this->_view_css_parts(&$t, &$o);

	$t->set_block('page', 'BLOCK.BIGFORM',         'BLOCK_BIGFORM');
	$t->set_var('BLOCK_BIGFORM', '');
	$t->parse('BLOCK_BIGFORM', 'BLOCK.BIGFORM', true);

	$t->set_block('page', 'BLOCK.FORMOK',         'BLOCK_FORMOK');
	$t->set_var('BLOCK_FORMOK', '');
	//$t->parse('BLOCK_FORMOK', 'BLOCK.FORMOK', true);
			
	$t->set_var("BANNERS_ALL_LEFT.document", $this->o['b1']['document'] );
	$t->set_var("BANNERS_ALL_TOP.document", $this->o['b2']['document'] );
	$t->set_var("BANNERS_ALL_BOTTOM.document", $this->o['b3']['document'] );
	$t->set_var("BANNERS_INDEX_MIDDLE.document", $this->o['b4']['document'] );
	$t->set_var("BANNERS_NAV_LEFT.document", $this->o['b5']['document'] );
	$t->set_var("BANNERS_CNT_BOTTOM.document", $this->o['b6']['document'] );

	$t->parse("page","page");
	return $t->get("page");
	}	
	
	

	
	
	
	
function ok(){
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$o = $this->o;

	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	if ($this->template == 'form_participant_request'){
		$this->_view_standart_seo($t, $o);
		}
	else {
		$this->_view_standart_eng_seo($t, $o);
		};

	$this->_view_standart_top_navigation(&$t, &$o,'NAVIGATION');
//	$this->_view_standart_left_menu(&$t, &$o);
//	$this->_view_tree_menu(&$t, &$o);
	$this->_view_standart_parts(&$t);
	$this->_view_css_parts(&$t, &$o);

	$t->set_block('page', 'BLOCK.BIGFORM',         'BLOCK_BIGFORM');
	$t->set_var('BLOCK_BIGFORM', '');
	//$t->parse('BLOCK_BIGFORM', 'BLOCK.BIGFORM', true);

	$t->set_block('page', 'BLOCK.FORMOK',         'BLOCK_FORMOK');
	$t->set_var('BLOCK_FORMOK', '');
	$t->parse('BLOCK_FORMOK', 'BLOCK.FORMOK', true);
			
	$t->set_var("BANNERS_ALL_LEFT.document", $this->o['b1']['document'] );
	$t->set_var("BANNERS_ALL_TOP.document", $this->o['b2']['document'] );
	$t->set_var("BANNERS_ALL_BOTTOM.document", $this->o['b3']['document'] );
	$t->set_var("BANNERS_INDEX_MIDDLE.document", $this->o['b4']['document'] );
	$t->set_var("BANNERS_NAV_LEFT.document", $this->o['b5']['document'] );
	$t->set_var("BANNERS_CNT_BOTTOM.document", $this->o['b6']['document'] );

	$t->parse("page","page");
	return $t->get("page");
	}	
	

}
?>