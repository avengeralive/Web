<?
require_once(CLASSES_BASE.'model_icms_folder.php');
class model_icms_folder_company_index extends model_icms_folder{

function get_object_by_id($id) {
	$o_base =    $this->get_object_base($id); 
	$o_param = $this->get_document_params($id);
	$o_nav =   $this->get_document_navigation($o_base['object']['parent_id'],$o_base['object']['name']);
	$o_menu = $this->down_level_menu(	$this->_get_menu_tree($o_base['object'])	);
	$this->_get_object_seo(&$o_base);

	$o_firm['object']=false;

	

	$o_b1 =    $this->get_object_base(ID_BANNERS_ALL_LEFT); 
	$o_b2 =    $this->get_object_base(ID_BANNERS_ALL_TOP); 
	$o_b3 =    $this->get_object_base(ID_BANNERS_ALL_BOTTOM); 
	$o_b4 =    $this->get_object_base(ID_BANNERS_INDEX_MIDDLE); 
	$o_b5 =    $this->get_object_base(ID_BANNERS_NAV_LEFT); 
	$o_b6 =    $this->get_object_base(ID_BANNERS_CNT_BOTTOM); 

	$o_anons =  $this->get_object_anons_for_company_index($id);
	$o_membernews =  $this->get_object_anons_for_raw_like_by_vidate(	'/members/news/%/' ,4,0,'DESC',false);
	$o_news =  $this->get_object_anons_for_raw_like_by_vidate(	'/about/apic-news/%/' ,3,0,'DESC',false);
//	alid($o_news);
	
    $return = Array(
        'status'=>true,

        'b1'=>$o_b1['object'],
        'b2'=>$o_b2['object'],
        'b3'=>$o_b3['object'],
        'b4'=>$o_b4['object'],
        'b5'=>$o_b5['object'],
        'b6'=>$o_b6['object'],

        'anons'=>$o_anons['childs'],
        'membernews'=>$o_membernews['childs'],

        'object'=>$o_base['object'],
		'firm'=>$o_firm['object'],
//        'morenews'=>$o_morenews['childs'],
        'news'=>$o_news['childs'],
		
		'menu'=>$o_menu,
		'navigation'=>$o_nav['navigation'],
		'params'=>$o_param['params']
        );
	return $return;
	}



	
	
}
?>