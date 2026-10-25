<?
class model_icms_proto extends model_icms{


function get_object_params($id){
//            doc_id
    	$q = "
    		SELECT
    		uid,
            pname,
            pvalue
    		FROM
                ".MYSQL_DB.".params
            WHERE
                doc_id = #id#
    	";

    	$o = $this->m->selectManyRowsByID($q, 'pname', __FILE__, __LINE__, Array(
            'id' => $id
        ));

    	if ($this->m->error) return Array('status' => false);

    	return array(
    		'status' => true,
    		'list' => $o
    	);
   }


function get_tree_offset($parent_id,$limit=500,$offset=0){
	$ob = $this->get_object_base($parent_id);
//	alid($ob);
	$url = $ob['object']['url'];

	$q0 = "
	SELECT
		count(*) as count
	FROM
		".$this->TABLE_TREE."
	WHERE
		url like '#url#%'
		";
    $o0 = $this->m->selectOneRow($q0, __FILE__, __LINE__, Array(
		'url'=>$url
		));
//	alid($o0);

	$q = "
	SELECT
		id, parent_id, name, type, status, url
	FROM
		".$this->TABLE_TREE."
	WHERE
		url like '#url#%'
	ORDER BY 
		url ASC
	LIMIT 
		 #offset#, #limit#
		";

    $o = $this->m->selectManyRows($q, __FILE__, __LINE__, Array(
		'url'=>$url,
		'limit'=>$limit,
		'offset'=>$offset
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
//	alid($o);
	$res = array();
	while (list($k, $v)=each($o)) {
		$prms = $this->get_object_params($v['id']);
		$res[$k] = $v;
		$res[$k]['params'] = $prms['list'];
//        $res[$k]['currentlevel'] = ($current_level -1);
		};
//	alid($res);
	return array(
		'status'=>true,
		'count'=>$o0['count'],
		'catalog' => $res
		);
	}

	
function get_object_anons_for_parent_by_name($parent_id, $limit = 1024, $offset = '0', $sort = '',$only_type='', $only_active=true, $name='doc.fullname') {
	$tt = ((strlen($only_type)>0)?' AND tree.type in ('.$only_type.')':'');
	$ta = ($only_active==true)? " AND tree.status ='active' ":'';
//	echo $tt."<br>";
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
		doc.updated,
		doc.fullname
	FROM 
		".$this->TABLE_TREE." as tree
	LEFT JOIN
		".$this->TABLE_DOC." as doc
	ON 
		doc.id = tree.id
	WHERE 
		tree.parent_id = '#parent_id#'
	".$ta
	.$tt."
	ORDER BY 
		".$name."
		#sort#	
	LIMIT 
		#offset#, #limit#
	";
	$o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, 
		Array(
			'parent_id' => $parent_id,
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


function get_object_anons_for_parent_by_vidate($parent_id, $limit = 1024, $offset = '0', $sort = 'ASC',$only_type='', $only_active=true) {
	$tt = ((strlen($only_type)>0)?' AND tree.type in ('.$only_type.')':'');
	$ta = ($only_active==true)? " AND tree.status ='active' ":'';
//	echo $tt."<br>";
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
		doc.updated,
		doc.fullname
	FROM 
		".$this->TABLE_TREE." as tree
	LEFT JOIN
		".$this->TABLE_DOC." as doc
	ON 
		doc.id = tree.id
	WHERE 
		tree.parent_id = '#parent_id#'
	".$ta
	.$tt."
	ORDER BY 
#		tree.visdate #sort#
#		tree.ordering #sort#,
		 concat( substring(tree.visdate,7,4), substring(tree.visdate,4,2), substring(tree.visdate,1,2)  ) DESC
	LIMIT 
		#offset#, #limit#
	";
	$o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, 
		Array(
			'parent_id' => $parent_id,
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


function get_object_anons_for_raw_like_by_vidate($like, $limit = 1024, $offset = '0', $sort = 'ASC',$only_type='', $only_active=true) {
	$tt = ((strlen($only_type)>0)?' AND tree.type in ('.$only_type.')':'');
	$ta = ($only_active==true)? " AND tree.status ='active' ":'';
//	echo $tt."<br>";
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
		doc.updated,
		doc.fullname
	FROM 
		".$this->TABLE_TREE." as tree
	LEFT JOIN
		".$this->TABLE_DOC." as doc
	ON 
		doc.id = tree.id
	WHERE 
		tree.url like '#like#'
	".$ta
	.$tt."
	ORDER BY 
#		tree.visdate #sort#
#		tree.ordering #sort#,
		 concat( substring(tree.visdate,7,4), substring(tree.visdate,4,2), substring(tree.visdate,1,2)  ) DESC
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

	
	

function get_object_by_id($id) {
	$o_base =    $this->get_object_base($id);
	$o_childs =  $this->get_object_anons($id);
	$o_param = $this->get_document_params($id);
//	alid($o_base);
	$o_menu = $this->_get_menu_tree($o_base['object']);
	$o_nav =   $this->get_document_navigation($id,$o_base['object']['name']);
	$this->_get_object_seo(&$o_base);
    return Array(
        'status'=>true,
        'object'=>$o_base['object'],
        'childs'=>$o_childs['childs'],
		'navigation'=>$o_nav['navigation'],
		'menu'=>$o_menu,
		'params'=>$o_param['params']
        );
	}


function process_uploaded_file($formname, $uploads_dir){
	global $_FILES;
	//alid($_FILES);
	if (isset($_FILES[$formname]["error"])) {
	    if ($_FILES[$formname]["error"] == UPLOAD_ERR_OK) {
	        $tmp_name = $_FILES[$formname]["tmp_name"];
	        $name = $_FILES[$formname]["name"];
			preg_match('/\.(.*)$/',$name, $mm);
			$newname = date("Ymd-His-").md5(rand()).'.'.(isset($mm[1])?$mm[1]:'.txt');
	        $st = move_uploaded_file($tmp_name, $uploads_dir.$newname);
			if ($st){
				return array('status'=>true,'file'=>$newname);
				};
	    	};
		};
	return array('status'=>false);
	}




function get_money() {
	$q = "
	SELECT 
		*
	FROM
		".MYSQL_DB.".money
		";
    $o = $this->m->selectManyRowsByID($q, 'id', __FILE__, __LINE__, Array(
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		'childs' => $o
		);
	}


function get_specials($limit=3, $not_ids =array('-1') ) {
	$q1 = "
	SELECT
		tree.type,
		tree.visdate,
		tree.id,
		tree.created,
		tree.name,
		tree.url,
		tree.statushidden,
		doc.anons,
		doc.updated,
		doc.fullname,
        params.pvalue,
        p3.pvalue as anonsimg,
		p5.pvalue as money_id
	FROM 
		".$this->TABLE_TREE." as tree

	LEFT JOIN
		".$this->TABLE_DOC." as doc
	ON 
		doc.id = tree.id

	LEFT JOIN
		params as p4
	ON 
		p4.doc_id = tree.id
    AND
        p4.pname = 'is_special'
    AND
        p4.pvalue= '1'

	LEFT JOIN
		params
	ON 
		params.doc_id = tree.id
    AND
        params.pname = 'brand_id'

	LEFT JOIN
		params as p3
	ON 
		p3.doc_id = tree.id
    AND
        p3.pname = 'image'

	LEFT JOIN
		params as p5
	ON 
		p5.doc_id = tree.id
    AND
        p5.pname = 'currency'

	WHERE 
        tree.id  NOT IN (#not_ids#)
    AND
		tree.status = 'active'
    AND
        tree.type = '".TYPE_ITEMCARD."'
    AND
        p4.pvalue=1 


    ORDER BY 
		p4.updated DESC
    LIMIT 
		#limit#
	";
	$o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, 
		Array(
			'not_ids' => implode(',',$not_ids),
			'limit' => $limit,
		//	'offset' => $offset
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






function get_specials_for_url($limit=3, $url, $not_ids =array('-1') ) {
	$q1 = "
	SELECT
		tree.type,
		tree.visdate,
		tree.id,
		tree.created,
		tree.name,
		tree.url,
		tree.statushidden,
		doc.anons,
		doc.updated,
		doc.fullname,
        params.pvalue,
        p3.pvalue as anonsimg,
		p5.pvalue as money_id
	FROM 
		".$this->TABLE_TREE." as tree

	LEFT JOIN
		".$this->TABLE_DOC." as doc
	ON 
		doc.id = tree.id

	LEFT JOIN
		params as p4
	ON 
		p4.doc_id = tree.id
    AND
        p4.pname = 'is_special'
    AND
        p4.pvalue= '1'

	LEFT JOIN
		params
	ON 
		params.doc_id = tree.id
    AND
        params.pname = 'brand_id'

	LEFT JOIN
		params as p3
	ON 
		p3.doc_id = tree.id
    AND
        p3.pname = 'image'

	LEFT JOIN
		params as p5
	ON 
		p5.doc_id = tree.id
    AND
        p5.pname = 'currency'

	WHERE 
		tree.url like '".$url."%' 
		and
        tree.id  NOT IN (#not_ids#)
    AND
		tree.status = 'active'
    AND
        p4.pvalue=1 


    ORDER BY 
		p4.updated DESC
    LIMIT 
		#limit#
	";
	$o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, 
		Array(
			'not_ids' => implode(',',$not_ids),
			'limit' => $limit,
		//	'offset' => $offset
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










function get_object_two_level_anonses($id, $limit = 1024, $offset = '0', $sort = 'ASC',$only_type=''){
	$an = $this->get_object_anons($id,$limit , $offset, $sort ,$only_type);
	while (list($k, $v) = each($an['childs'])) {
		$l2 = $this->get_object_anons($v['id'],$limit , $offset, $sort ,$only_type);
		$an['childs'][$k]['childs'] = $l2['childs'];
		};
	return array(
		'status'=>true,
		'childs'=>$an['childs']
		);
	}



/**
*   Список пунктов в меню. По умолчанию если в меню >= $limit позиций то возвращаем пустой список. Связано с производительностью и огромными неудобными списками
*/
function get_document_menu($parent_id, $limit=100) {
	$q = "
	SELECT
		id,
		type,
		name,
		url,
		statushidden,
		parent_id,
		ordering
	FROM
		".$this->TABLE_TREE."
	WHERE
		parent_id='#parent_id#'
	AND
		status = 'active'
	ORDER BY
		ordering
	DESC
	LIMIT #limit#
	";
	$r = $this->m->selectManyRows($q, __FILE__, __LINE__, Array(
		'parent_id'=>$parent_id,
		'limit'=>$limit
		));
	if ($this->m->error) {
		return Array('status'=>false);
		};

	if (sizeof($r)==$limit){
	return array(
		'status'=>true,
		'menu'=>array()
		);
		};
	return array(
		'status'=>true,
		'menu'=>$r
		);
	}



function get_document_navigation($thisparentID, $name){
	$navigation = array();
	$id=0;
    $oldparentID=$thisparentID;
	$q5 = "
	SELECT
		id,
		name,
		url,
		type,
		statushidden,
		parent_id
	FROM
		".$this->TABLE_TREE."
	WHERE
		id=#thisparentID#
	";
    while ($thisparentID>0) {
	    $r5 = $this->m->selectOneRow($q5, __FILE__, __LINE__, 
        Array(
            'thisparentID'=>$thisparentID
            )
			);
	    if ($this->m->error) {
	        return Array('status'=>false);
	        };
		$thisparentID = $r5['parent_id'];
		$navigation[$id]['id'] = $oldparentID;
		$navigation[$id]['url'] = $r5['url'];
		$navigation[$id]['name'] = $r5['name'];
		$navigation[$id]['statushidden'] = $r5['statushidden'];
//		$navigation[$id]['status'] = $r5['status'];
		$navigation[$id]['type'] = $r5['type'];
		$id++;
		$oldparentID=$thisparentID;
        };
    if ($this->m->error) {
        return Array('status'=>false);
        };
	return Array(
		'status'=>true,
		'navigation'=>array_reverse($navigation)
		);
	}



function down_level_menu($o){
	$oo = array();
	$i=0;
	while (list($k, $v) = each($o)) {
		if ($v['level']>1) {
			$oo[$i] = $v;
			$oo[$i]['level'] = ($v['level']-1);
			$i++;
			};
		};
	return $oo;
	}







function get_object_anons($id, $limit = 1024, $offset = '0', $sort = 'ASC',$only_type='', $only_active=true) {
	$tt = ((strlen($only_type)>0)?' AND tree.type in ('.$only_type.')':'');
	$ta = ($only_active==true)? " AND tree.status ='active' ":'';
//	echo $tt."<br>";
	$q1 = "
	SELECT
		tree.type,
		tree.visdate,
		tree.id,
		tree.created,
		tree.name,
		tree.url,
		tree.status,
		tree.statushidden,
		doc.anons,
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
	".$ta
	.$tt."
	ORDER BY 
		tree.ordering #sort#,
		tree.id #sort#
	LIMIT 
		#offset#, #limit#
	";
	$o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, 
		Array(
			'id' => $id,
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



function get_object_anons_for_raw_like($like, $limit = 1024, $offset = '0', $sort = 'ASC',$only_type='', $only_active=true) {
	$tt = ((strlen($only_type)>0)?' AND tree.type in ('.$only_type.')':'');
	$ta = ($only_active==true)? " AND tree.status ='active' ":'';
//	echo $tt."<br>";
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
		doc.updated,
		doc.fullname
	FROM 
		".$this->TABLE_TREE." as tree
	LEFT JOIN
		".$this->TABLE_DOC." as doc
	ON 
		doc.id = tree.id
	WHERE 
		tree.url like '#like#'
	".$ta
	.$tt."
	ORDER BY 
#		tree.visdate #sort#
		tree.ordering #sort#,
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






function get_object_anons_by_name($id, $limit = 1024, $offset = '0', $sort = 'ASC',$only_type='', $only_active=true) {
	$tt = ((strlen($only_type)>0)?' AND tree.type in ('.$only_type.')':'');
	$ta = ($only_active==true)? " AND tree.status ='active' ":'';
//	echo $tt."<br>";
	$q1 = "
	SELECT
		tree.type,
		tree.visdate,
		tree.id,
		tree.created,
		tree.name,
		tree.url,
		tree.status,
		tree.statushidden,
		doc.anons,
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
	".$ta
	.$tt."
	ORDER BY 
		tree.name #sort#
	LIMIT 
		#offset#, #limit#
	";
	$o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, 
		Array(
			'id' => $id,
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








// kluge
function _get_menu_tree($o1){
	$e = explode('/', $o1['url']);
//	ali_debug('','','',$e);
//	$maxlevel =  ( $e[0]!='')?sizeof($e):0;
	$e[0] = '/';
	$maxlevel =  sizeof($e);
	$parent_url = '/';
	$o_menu_res = array();
	$j=0;
	$_tmp_parents = array();
	for ($i=1; $i<$maxlevel; $i++) {
		$j++;
		$this_parent_ids = $this->get_id_and_type_for_url($parent_url);
		if(isset($this_parent_ids['object']['id'])) {
		        $o_menu = $this->get_document_menu( $this_parent_ids['object']['id'] );
		}
		else {
		        $o_menu['menu'] = array();
		}
		while (list($k, $v) = each($o_menu['menu'])) {
			$_tmp_parents[$v['parent_id']][$v['id']] = '1';
			$o_menu_res[$v['id']] = $v;
			$o_menu_res[$v['id']]['level'] = $i;
			};
		if (isset($e[$i])) {
//			$parent_url	= ($i===0)?$e[$i]:$parent_url.'/'.$e[$i].'/';
			$parent_url	= $parent_url.$e[$i].'/';
			};
		};
//	ali_debug('','','',$o_menu_res);
	$outmenu = array();
	$inmenu = $o_menu_res;
	$this->_updatemenu(&$inmenu, &$outmenu, $_tmp_parents , '1');
//	ali_debug('','','',$outmenu);
	return $outmenu;
	}
function _updatemenu($in, $out, $_tmp_parents, $level){
	// thath's kluge - storing $in locally 
	$inn = $in;
	while (list($k, $v) = each($inn)) {
		if ($v['level'] == $level) {
			$out[] = $v;
			unset($in[$k]);
			if (
				(isset($_tmp_parents[$v['id']]))
				){
				$this->_updatemenu(&$in, &$out, &$_tmp_parents, ($level+1) );
				};
			};
		};
	return $out;
	}




function _get_object_seo($o) {
	// title
	if (
		!(strlen($o['object']['seo_title'])>0) &&
		(strlen($o['object']['fullname'])>0)
		) {
		// создадим из полного имени
		$o['object']['seo_title'] = $o['object']['fullname'];
		}
	elseif (
		!(strlen($o['object']['seo_title'])>0) &&
		(strlen($o['object']['name'])>0)
		) {
		// ...или из малого.
		$o['object']['seo_title'] = $o['object']['name'];
		};
	// description
	if (
		!(strlen($o['object']['seo_description'])>0) &&
		(strlen($o['object']['anons'])>0)
		) {
		// если нет seo_description но есть анонс, то отдадим начало анонса.
		$o['object']['seo_description'] = $this->_strip_text_to_len($o['object']['anons'], CMS_GENERATED_SEO_DESCRIPTION_LENGTH);
		}
	elseif (
		!(strlen($o['object']['seo_description'])>0) &&
		(strlen($o['object']['document'])>0)
		) {
		// если нет seo_description но есть документ, то отдадим начало документа.
		$o['object']['seo_description'] = $this->_strip_text_to_len($o['object']['document'], CMS_GENERATED_SEO_DESCRIPTION_LENGTH);
		};
	// keywords
	if (
		!(strlen($o['object']['seo_keywords'])>0) &&
		(strlen($o['object']['fullname'])>0)
		) {
		// создадим из полного имени
		$o['object']['seo_keywords'] = preg_replace('/'."([\s]+)".'/', ', ',$o['object']['fullname']);
		}
	elseif (
		!(strlen($o['object']['seo_keywords'])>0) &&
		(strlen($o['object']['name'])>0)
		) {
		// ...или из малого.
		$o['object']['seo_keywords'] = preg_replace('/'."([\s]+)".'/', ', ',$o['object']['name']);
		};
	}



function _strip_text_to_len($txt, $length){
		// уберем все лишнее.
		$new = preg_replace('/'."([\r\n])[\s]+".'/' , ' ', strip_tags($txt) );
		$new = preg_replace('/'."(\&[a-zA_Z0-9]*;)".'/U' , ' ', strip_tags($new) );
		$new = preg_replace('/'."(\s{2,})".'/U' , ' ', strip_tags($new) );
		// обрежем до нужной длины
		$new = substr($new,0, $length);
		// найдем конец слова и отдадим строчку без него.
		return (preg_match('/^(.*) ([^ ]*)$/', $new, $match)) ? $match[1]: $new;
	}



	
	
	
	
	
	


function get_object_anons_for_company_news($like, $firm_id, $limit = 1024, $offset = '0', $sort = 'ASC',$only_type='', $only_active=true) {
	$tt = ((strlen($only_type)>0)?' AND tree.type in ('.$only_type.')':'');
	$ta = ($only_active==true)? " AND tree.status ='active' ":'';
//	echo $tt."<br>";
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
		doc.updated,
		doc.fullname
	FROM 
		".$this->TABLE_TREE." as tree
	LEFT JOIN
		".$this->TABLE_DOC." as doc
	ON 
		doc.id = tree.id
		
	LEFT JOIN
		params as p4
	ON 
		p4.doc_id = tree.id
    AND
        p4.pname = 'firm_id'
		
	WHERE 
		tree.url like '#like#'
		AND 
        p4.pvalue= '#firm_id#'

	".$ta
	.$tt."
	ORDER BY 
#		tree.visdate #sort#
#		tree.ordering #sort#,
		 concat( substring(tree.visdate,7,4), substring(tree.visdate,4,2), substring(tree.visdate,1,2)  ) DESC
	LIMIT 
		#offset#, #limit#
	";
	$o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, 
		Array(
			'like' => $like,
			'firm_id' => $firm_id,
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
