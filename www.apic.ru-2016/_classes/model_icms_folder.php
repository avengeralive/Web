<?
require_once(CLASSES_BASE.'model_icms_proto.php');
class model_icms_folder extends model_icms_proto{

function get_object_by_id($id) {
	$o_base =    $this->get_object_base($id); 
	$o_param = $this->get_document_params($id);
	$o_nav =   $this->get_document_navigation($o_base['object']['parent_id'],$o_base['object']['name']);
	$this->_get_object_seo(&$o_base);

	
	$companyheader = false;	
	
	$o_firm['object']=false;
	$o_morenews['childs']=false;
	if	(
		( preg_match('|/members/news/|', $o_base['object']['url'])   && isset($o_param['params']['firm_id']['pvalue']) )
		|| 
		( preg_match('|members/object/|', $o_base['object']['url'])   && isset($o_param['params']['firm_id']['pvalue']) )
		){
		//echo "!!!!!!";
		//alid($o_param);
	//$o_firm =    $this->get_object_base($id); 
	
		$q = 'select doc_id from params where pname ="firm_id" and pvalue="'.$o_param['params']['firm_id']['pvalue'].'" and doc_id in (select id from tree where parent_id="13" ) ';
		$r = $this->m->selectOneRow($q,NULL,NULL,NULL);
		//alid($r);
	
		$o_firm =    $this->get_object_base($r['doc_id']); 
		$o_morenews =  $this->get_object_anons_for_company_news(	'/members/news/%/' ,$o_param['params']['firm_id']['pvalue'],4,0,'DESC',false);
	//	alid($o_morenews);

		
		//alid($o_nav);
		$o_nav['navigation'][3] = array(
			'id'=>$o_firm['object']['id'],
			'url'=>$o_firm['object']['url'],
			'name'=>$o_firm['object']['name'],
			'statushidden'=>'active',
			'type'=>'folder'
			);

		$companyheader = true;	
		};
	
	

	$o_b1 =    $this->get_object_base(ID_BANNERS_ALL_LEFT); 
	$o_b2 =    $this->get_object_base(ID_BANNERS_ALL_TOP); 
	$o_b3 =    $this->get_object_base(ID_BANNERS_ALL_BOTTOM); 
	$o_b4 =    $this->get_object_base(ID_BANNERS_INDEX_MIDDLE); 
	$o_b5 =    $this->get_object_base(ID_BANNERS_NAV_LEFT); 
	$o_b6 =    $this->get_object_base(ID_BANNERS_CNT_BOTTOM); 

	if	(
		( preg_match('|/en/members_apic/|', $o_base['object']['url'])  ) 
		){	
		$o_anons =  $this->get_object_anons_for_company_index($id);
		
		$o_parent_base =    $this->get_object_base($o_base['object']['parent_id']); 
		$o_menu = 	$this->down_level_menu( $this->_get_menu_tree($o_parent_base['object']) );
		}
	elseif	(
		( preg_match('|/members/geograph/|', $o_base['object']['url'])  ) 
		){	
		echo "1";
		$o_anons =  $this->get_object_anons_for_parent_by_name(	$id	,100,0,'ASC',false, true, 'tree.name');		
		$o_menu = $this->down_level_menu(	$this->_get_menu_tree($o_base['object'])	);
		}
	else {
		//echo "2";
		$o_anons =  $this->get_object_anons(	$id	,100,0,'DESC',false);
		$o_menu = $this->down_level_menu(	$this->_get_menu_tree($o_base['object'])	);
		};
	
	
	
	// не показываем ссылки на обьекты и новости НЕ-членов АПИК 
	if	(
	//	( preg_match('|/members/news/|', $o_base['object']['url'])   && ( sizeof($o_anons['childs'])>0 ) )
	//	|| 
		( preg_match('|members/object/|', $o_base['object']['url'])  && ( sizeof($o_anons['childs'])>0 ) )
		){
		//alid($o_anons);
		reset($o_anons['childs']);
		while (list($k, $v)=each(	$o_anons['childs']	)){
			//alid($v);
			if (isset($v['params']['firm_id']['pvalue'])){
				$q1 = 'select doc_id from params where pname ="firm_id" and pvalue="'.$v['params']['firm_id']['pvalue'].'" and doc_id in (select id from tree where parent_id="13" ) ';
				$r1 = $this->m->selectOneRow($q1,NULL,NULL,NULL);
				$o_firm_1 =    $this->get_object_base($r1['doc_id']); 
				//alid($o_firm_1);
				if (!($o_firm_1['object']['status']=='active')){
					unset($o_anons['childs'][$k]);
					};
				};
			};
		
		
		};
	
//	alid($o_anons);
	$o_membernews =  $this->get_object_anons_for_raw_like_by_vidate(	'/members/news/%/' ,4,0,'DESC',false);
	$o_news =  $this->get_object_anons_for_raw_like_by_vidate(	'/about/apic-news/%/' ,3,0,'DESC',false);
//	alid($o_news);
	
    $return = Array(
        'status'=>true,
		'companyheader'=>$companyheader,
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
        'morenews'=>$o_morenews['childs'],
        'news'=>$o_news['childs'],
		
		'menu'=>$o_menu,
		'navigation'=>$o_nav['navigation'],
		'params'=>$o_param['params']
        );
	return $return;
	}


	
	
	
	
	
	
	
function get_object_anons_for_company_index($id) {
	$q1 = "
	SELECT
		tree.type,
		tree.visdate,
		tree.id,
		tree.parent_id,
		tree.created,
		tree.name,
		tree.url,
		tree.status,
		tree.statushidden,
		doc.anons,
		doc.document,
		doc.updated,
		doc.fullname
	FROM 
		".$this->TABLE_TREE." as tree
	LEFT JOIN
		".$this->TABLE_DOC." as doc
	ON 
		doc.id = tree.id
	WHERE 
		tree.parent_id = '#id#'
	AND
		(
		tree.type='folder_company' 
		OR 
		tree.type='folder_eng_company'  
		)
	AND
		tree.status='active'
	ORDER BY 
		tree.name 
	";
	$o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, 
		Array(
			'id' => $id
		)
	);
	while (list($k, $v) = each($o1)) {
		$params = $this->get_document_params($v['id']);
		$o1[$k]['params'] = $params['params'];
	};
	reset($o1);
	return Array(
		'status'=>true,
		'childs'=>$o1
	);
}
	
		
	
	
	
	
}
?>