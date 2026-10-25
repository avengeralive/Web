<?
require_once(CLASSES_BASE.'model_icms_proto.php');
class model_icms_folder_news_rss extends model_icms_proto{
function get_object_by_id($id) {
	$o_param = $this->get_document_params($id);
	$o_news =  $this->get_object_anons_for_raw_like('',50,0,'DESC',false);
    return Array(
        'status'=>true,
       'params'=>$o_param['params'],
		'childs'=>$o_news['childs']
        );
	}
	
function get_object_anons_for_raw_like($like, $limit = 1024, $offset = '0', $sort = 'ASC',$only_type='', $only_active=true) {
	$tt = ((strlen($only_type)>0)?' AND tree.type in ('.$only_type.')':'');
	$ta = ($only_active==true)? " AND tree.status ='active' ":'';
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
		tree.url like '%/news/%/'
		OR
		tree.url like '%/novelty/%/'
		
	".$ta
	.$tt."
	ORDER BY 
		tree.id #sort#
	LIMIT 
		#offset#, #limit#
	";
	$o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, 
		Array(
			'like' => $like,
			'limit' => $limit,
			'offset' => $offset,
			'sort' => $sort
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