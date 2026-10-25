<?
require_once(CLASSES_BASE.'model_icms_folder.php');
class model_icms_folder_brand_index extends model_icms_folder{

function get_object_by_id($id) {
	$o_base =    $this->get_object_base($id); 
	$o_param = $this->get_document_params($id);
	$o_nav =   $this->get_document_navigation($o_base['object']['parent_id'],$o_base['object']['name']);
	$o_menu = $this->down_level_menu(	$this->_get_menu_tree($o_base['object'])	);
	$this->_get_object_seo(&$o_base);
	
	$o_b1 =    $this->get_object_base(ID_BANNERS_ALL_LEFT); 
	$o_b2 =    $this->get_object_base(ID_BANNERS_ALL_TOP); 
	$o_b3 =    $this->get_object_base(ID_BANNERS_ALL_BOTTOM); 
	$o_b4 =    $this->get_object_base(ID_BANNERS_INDEX_MIDDLE); 
	$o_b5 =    $this->get_object_base(ID_BANNERS_NAV_LEFT); 
	$o_b6 =    $this->get_object_base(ID_BANNERS_CNT_BOTTOM); 

	$o_anons =  $this->get_object_anons_by_name(	$id	,10000,0,'ASC',false);
	
    $return = Array(
        'status'=>true,

        'b1'=>$o_b1['object'],
        'b2'=>$o_b2['object'],
        'b3'=>$o_b3['object'],
        'b4'=>$o_b4['object'],
        'b5'=>$o_b5['object'],
        'b6'=>$o_b6['object'],

        'anons'=>$o_anons['childs'],

        'object'=>$o_base['object'],
		'menu'=>$o_menu,
		'navigation'=>$o_nav['navigation'],
		'params'=>$o_param['params']
        );
	return $return;
	}

}
?>