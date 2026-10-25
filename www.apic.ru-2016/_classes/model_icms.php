<?
class model_icms{
function model_icms($m) {
	$this->m = &$m;
	$this->TABLE_TREE=MYSQL_DB.'.tree';
	$this->TABLE_DOC=MYSQL_DB.'.docs';
	$this->TABLE_DOC2=MYSQL_DB.'.docs2';
	$this->DOCUMENT_PARAMS=MYSQL_DB.'.params';
	}


function get_object_base($id) {
	$q1 = "
		SELECT
			doc.*,
			tree.parent_id,
			tree.visdate,
			tree.type,
			tree.url,
			tree.name
		FROM
			".$this->TABLE_DOC." as doc
		LEFT JOIN
			".$this->TABLE_TREE." as tree
		ON 
			doc.id = tree.id
		WHERE
			doc.id = '#id#'
		AND
			tree.status = 'active'
	";
	$o1 = $this->m->selectOneRow($q1, __FILE__, __LINE__, Array('id' => $id));
	if (!(is_array($o1) && (sizeof($o1) > 0))) return Array('status' => false);
	$params = $this->get_document_params($o1['id']);
	$o1['params'] = $params['params'];
	reset($o1);
	return Array(
		'status' => true,
		'object' => $o1
	);
}


function get_id_and_type_for_url($url, $only_active_document=true, $only_real_document=true){
    $q = "
    SELECT
		id, type, status
    FROM
		".$this->TABLE_TREE."
	WHERE
		url = '#url#' 
		"
		.(($only_active_document=='true')?"	AND status = 'active'":"").
		"
        AND    
                type not in ('link_static')
	";
	$o = $this->m->selectOneRow($q, __FILE__, __LINE__, 
        Array(
			'url'=>$url
            )
        );
    if (!( is_array($o) && (sizeof($o)>0) )) {
        return Array('status'=>false);
        };
    return Array(
        'status'=>true, 
        'object'=>$o
        );
	}


function get_id_and_type_for_id($id, $only_active_document=true, $only_real_document=true){
    $q = "
    SELECT
		id, type, status
    FROM
		".$this->TABLE_TREE."
	WHERE
		id = '#id#' 
		"
		.(($only_active_document=='true')?"	AND status = 'active'":"").
		"
        AND    
                type not in ('link_static')
	";
	$o = $this->m->selectOneRow($q, __FILE__, __LINE__, 
        Array(
			'id'=>$id
            )
        );
    if (!( is_array($o) && (sizeof($o)>0) )) {
        return Array('status'=>false);
        };
    return Array(
        'status'=>true, 
        'object'=>$o
        );
	}


function get_parent_for_id($id) {
	$q = "
	SELECT
		parent_id
	FROM
		".$this->TABLE_TREE."
	WHERE
		id='#id#'
	";
	$r = $this->m->selectOneRow($q, __FILE__, __LINE__, Array(
		'id'=>$id
		));
		if ($this->m->error) {
			return Array('status'=>false);
			};
	return array(
		'status'=>true,
		'parent_id'=>$r['parent_id']
		);
	}


function get_document_params($document_id){
	$q = "
	SELECT
		*
	FROM
		".$this->DOCUMENT_PARAMS."
	WHERE
		doc_id=#document_id# 
		";
    $o = $this->m->selectManyRowsByID($q, 'pname', __FILE__, __LINE__, Array(
		'document_id'=>$document_id
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		'params' => $o
		);
	}



function get_tree($parent_id, $current_level, $max_level, $only_show=''){
//echo " * ";
	if ($current_level > $max_level) {
		return array('status'=>false);
		};
	$current_level++;
	$q = "
	SELECT
		id, parent_id, name, type, status, statushidden, updated, url
	FROM
		".$this->TABLE_TREE."
	WHERE
		parent_id=#parent_id# 
		".
		(
		(strlen($only_show)>0)
			?
			" AND type in (".$only_show.")":
			''
		)
		."
	ORDER BY 
		ordering
	DESC
		";

    $o = $this->m->selectManyRows($q, __FILE__, __LINE__, Array(
		'parent_id'=>$parent_id,

		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	$res = array();
	$i=0;
	while (list($k, $v)=each($o)) {
		$prms = $this->get_document_params($v['id']);
		$res[$i] = $v;
		$res[$i]['params'] = $prms['params'];
        $res[$i]['currentlevel'] = ($current_level -1);
		$i++;
//		if ( in_array($v['type'], $this->folders_type)) {
			// yeah. recursy
			$parents = $this->get_tree($v['id'], $current_level, $max_level, $only_show);
			if ($parents['status'] ) {
				while (list($kk, $vv)=each($parents['catalog'])) {
					$res[] = $vv;
					$i++;
					};
				};
			};
//		};
	return array(
		'status'=>true,
		'catalog' => $res
		);
	}


}
?>