<?
require_once(CLASSES_BASE.'model_icms_proto.php');
class model_icms_folder_index extends model_icms_proto{

function get_object_by_id($id) {
	global $SPECIAL;
	$o_base =    $this->get_object_base($id); 
	$o_param = $this->get_document_params($id);
	$this->_get_object_seo(&$o_base);
	
//	$o_menu =  $this->_get_menu_tree($o_base['object'])	;
	$o_news =  $this->get_object_anons_for_raw_like_by_vidate(	'/about/apic-news/%/' ,3,0,'DESC',false);
//	alid($o_news);
//	$o_articles =  $this->get_object_anons(	ID_ARTICLES	,3,0,'DESC',false);
//	$o_countrys =  $this->get_object_anons(	ID_COUNTRYS	,5,0,'DESC',false);
//	$o_types =  $this->get_object_anons(	ID_TYPES	,5,0,'DESC',false);
	$o_membernews =  $this->get_object_anons_for_raw_like_by_vidate(	'/members/news/%/' ,4,0,'DESC',false);
//alid($o_membernews);
	
	$o_b1 =    $this->get_object_base(ID_BANNERS_ALL_LEFT); 
	$o_b2 =    $this->get_object_base(ID_BANNERS_ALL_TOP); 
	$o_b3 =    $this->get_object_base(ID_BANNERS_ALL_BOTTOM); 
	$o_b4 =    $this->get_object_base(ID_BANNERS_INDEX_MIDDLE); 
	$o_b5 =    $this->get_object_base(ID_BANNERS_NAV_LEFT); 
	$o_b6 =    $this->get_object_base(ID_BANNERS_CNT_BOTTOM); 

    $return = Array(
        'status'=>true,

        'b1'=>$o_b1['object'],
        'b2'=>$o_b2['object'],
        'b3'=>$o_b3['object'],
        'b4'=>$o_b4['object'],
        'b5'=>$o_b5['object'],
        'b6'=>$o_b6['object'],

//		'menu'=>$o_menu,
        'object'=>$o_base['object'],
        'news'=>$o_news['childs'],
        'membernews'=>$o_membernews['childs'],
//        'articles'=>$o_articles['childs'],
//        'types'=>$o_types['childs'],
//        'countrys'=>$o_countrys['childs'],
		'params'=>$o_param['params']
        );

	return $return;
	}





}
?>