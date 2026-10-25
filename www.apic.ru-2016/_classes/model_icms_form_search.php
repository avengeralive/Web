<?
require_once(CLASSES_BASE.'model_icms_proto.php');
require_once(CLASSES_BASE.'model_sphinx_search.php');


class model_icms_form_search extends model_icms_proto{


function get_object_by_id($id) {
	global $V, $_REQUEST, $SPHINX_INDEXES, $SPHINX_GROUPS;
//	alid($V);
//  alid($_POST);
	$o_base =    $this->get_object_base($id);
	$o_param = $this->get_document_params($id);
	$o_menu = $this->down_level_menu(	$this->_get_menu_tree($o_base['object'])	);
	$o_nav =   $this->get_document_navigation($o_base['object']['id'],$o_base['object']['name']);

	$this->_get_object_seo(&$o_base);
	$o_b1 =    $this->get_object_base(ID_BANNERS_ALL_LEFT); 
	$o_b2 =    $this->get_object_base(ID_BANNERS_ALL_TOP); 
	$o_b3 =    $this->get_object_base(ID_BANNERS_ALL_BOTTOM); 
	$o_b4 =    $this->get_object_base(ID_BANNERS_INDEX_MIDDLE); 
	$o_b5 =    $this->get_object_base(ID_BANNERS_NAV_LEFT); 
	$o_b6 =    $this->get_object_base(ID_BANNERS_CNT_BOTTOM); 

    $q = ( isset($_REQUEST['q']) && strlen($_REQUEST['q'])> 1 ) ?  trim( strip_tags($_REQUEST['q']) )  : SPHINX_DEFAULT_QUERY;
    $q = trim(strip_tags($q));
	$q = (  strlen($q)> 1 ) ?  $q  : SPHINX_DEFAULT_QUERY;

    $page = ( isset($_REQUEST['page'])) ?  (intval($_REQUEST['page'])>0)?intval($_REQUEST['page']):1  : 1;

    $showall = ( isset($_REQUEST['showall'])) ?  true:false;

	$o_money = $this->get_money();

	
	$s = new model_sphinx_search($SPHINX_INDEXES, $SPHINX_GROUPS);
	$o_search = $s->search_multiple($q, $page, $showall);
//	alid($o_search);
	$o_result = $this->do_sphinx_results($o_search['result'], $o_search['groups']);
//	alid($o_result);

    return Array(
        'status'=>true,
        'page'=>$page,
        'money'=>$o_money['childs'],
        'showall'=>$showall,
        'object'=>$o_base['object'],
        'b1'=>$o_b1['object'],
        'b2'=>$o_b2['object'],
        'b3'=>$o_b3['object'],
        'b4'=>$o_b4['object'],
        'b5'=>$o_b5['object'],
        'b6'=>$o_b6['object'],

		'navigation'=>$o_nav['navigation'],
		'menu'=>$o_menu,
		'params'=>$o_param['params'],
		'q'=>$q,
		'total_results'=>$o_result['total_results'],
		'search'=>$o_result['matches']
        );
	}



function do_sphinx_results($result, $my_attrs_distribution){
		if (
			!(sizeof($result['matches'])>0)
			){
			return $result;
			};

	$time_start_11 = microtime(true);

		$q = "select t.id, d.fullname as name, t.type, t.url, d.anons, d.document  from ".MYSQL_DB.".tree as t LEFT JOIN  ".MYSQL_DB.".docs as d on t.id=d.id left join ".MYSQL_DB.".params as p on  t.id=p.doc_id  and p.pname='article' where t.id in (#ids#)";

		$o = $this->m->selectManyRowsByID($q, 'id', __FILE__, __LINE__, Array(
			'ids'=>implode(',', array_keys($result['matches'])  )
			));
		while (list($k, $v) = each(	$result['matches']	)) {
			if (isset($o[$k])) {
				$params = $this->get_document_params($k);
				$result['matches'][$k]['descr']=$o[$k];
				$result['matches'][$k]['params']=$params['params'];
				};
			};

	$result['attrs_distribution']=$my_attrs_distribution;
	return $result;
	}


}
?>
