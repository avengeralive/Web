<?
require_once(CLASSES_BASE.'model_icms_folder.php');
class model_icms_folder_eng_company extends model_icms_folder{

var $name_profil = 'Профиль';
var $name_contact = 'Контактные данные';
var $name_novelty = 'Новинки';
var $name_news = 'Новости';


function get_object_by_id($id) {
	$o_base =  $this->get_object_base($id); 
	$o_param = $this->get_document_params($id);
	$o_nav =   $this->get_document_navigation($o_base['object']['parent_id'],$o_base['object']['name']);
//	$o_menu = $this->down_level_menu(	$this->_get_menu_tree($o_base['object'])	);
//	$o_menu = 	$this->_get_menu_tree($o_base['object'])	;
	
	$this->_get_object_seo(&$o_base);
	
	$o_b1 =    $this->get_object_base(ID_BANNERS_ALL_LEFT); 
	$o_b2 =    $this->get_object_base(ID_BANNERS_ALL_TOP); 
	$o_b3 =    $this->get_object_base(ID_BANNERS_ALL_BOTTOM); 
	$o_b4 =    $this->get_object_base(ID_BANNERS_INDEX_MIDDLE); 
	$o_b5 =    $this->get_object_base(ID_BANNERS_NAV_LEFT); 
	$o_b6 =    $this->get_object_base(ID_BANNERS_CNT_BOTTOM); 

	$news_ids = $this->get_id_and_type_for_url(		$o_base['object']['url'].'news/'	);
	$o_news =  isset($news_ids['object']['id'])?$this->get_object_anons(	$news_ids['object']['id']	,2,0,'DESC',false):array('childs'=>array());
	
	$nov_ids = $this->get_id_and_type_for_url(		$o_base['object']['url'].'novelty/'	);
	$nov_news =  isset($nov_ids['object']['id'])?$this->get_object_anons(	$nov_ids['object']['id'] ,3,0,'DESC',false):array('childs'=>array());


	$o_menu = array();
	$o_menu[0]=array (
	        'id' => $o_base['object']['id'],
            'type' => '',
            'name' => $o_base['object']['name'],
            'url' => $o_base['object']['url'],
            'statushidden' =>'active' ,
            'parent_id' => 0,
            'ordering' => 0,
            'level' => 1
			);
	$o_menu[1]=array (
	        'id' => $o_base['object']['id'],
            'type' => '',
//            'name' => 'Профиль',
            'name' => $this->name_profil,
            'url' => $o_base['object']['url'].'#profile',
            'statushidden' =>'active' ,
            'parent_id' => 0,
            'ordering' => 0,
            'level' => 2
			);
	$o_menu[2]=array (
	        'id' => '',
            'type' => '',
//            'name' => 'Контактные данные',
            'name' => $this->name_contact,
            'url' => $o_base['object']['url'].'#contact',
            'statushidden' =>'active' ,
            'parent_id' => 0,
            'ordering' => 0,
            'level' => 2
			);
	if (isset($o_news['childs']) && (sizeof($o_news['childs'])>0)){
		$o_menu[]=array (
				'id' => '',
				'type' => '',
//				'name' => 'Новинки',
            'name' => $this->name_news,
				'url' => $o_base['object']['url'].'news/',
				'statushidden' =>'active' ,
				'parent_id' => 0,
				'ordering' => 0,
				'level' => 2
				);
			};
	if (isset($nov_news['childs']) && (sizeof($nov_news['childs'])>0)){
		$o_menu[]=array (
				'id' => '',
				'type' => '',
//				'name' => 'Новости',
            'name' => $this->name_novelty,
				'url' => $o_base['object']['url'].'novelty/',
				'statushidden' =>'active' ,
				'parent_id' => 0,
				'ordering' => 0,
				'level' => 2
				);
			};
	
//alid($o_menu);
	
	$o_brands=array();
	//alid($o_param['params']);
	//let's get brands
	reset($o_param['params']);
	while (list($k, $v)=each($o_param['params'])) {
		if (preg_match('/^brand_assoc_(.*)$/',$k, $m) && ($v['pvalue']=='1')){
			$o_b =  $this->get_object_base($m[1]); 
			$o_b['visdate'] =  '';
			$o_p = $this->get_document_params($m[1]);

			$o_f = $o_b['object'];
			$o_f['params'] = $o_p['params'];
			//$o_brands[$m[1]] = $o_f;
			$o_brands[	$o_f['name']	] = $o_f;
			};
		};
//	alid($o_brands);
	ksort($o_brands);
















	
    $return = Array(
        'status'=>true,

        'b1'=>$o_b1['object'],
        'b2'=>$o_b2['object'],
        'b3'=>$o_b3['object'],
        'b4'=>$o_b4['object'],
        'b5'=>$o_b5['object'],
        'b6'=>$o_b6['object'],

        'brands'=>$o_brands,
        'news'=>$o_news['childs'],
        'nov'=>$nov_news['childs'],

        'object'=>$o_base['object'],
		'menu'=>$o_menu,
		'navigation'=>$o_nav['navigation'],
		'params'=>$o_param['params']
        );
	return $return;
	}

}
?>