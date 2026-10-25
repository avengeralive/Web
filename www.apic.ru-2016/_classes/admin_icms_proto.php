<?
require_once(CLASSES_BASE.'view_icms.php');

class admin_icms_proto {

		var $param_names = array(
			'folder_image'=>array(
				'name'=>'image',
				'description'=>'Картинка',
				'required'=>'proto'
				),


			);

		var $folders_type= array(
			'proto',
			'link_id',
            'link_static'
			);

		var $registered_types = array(
			"proto" => "обычная страница",
			"link_static" => "ссылка на URL",
			"link_id" => "симлинк на существующй документ",
			);

		var $banners_types = array(
			);

        var $folders_price_type=array(
        'folder_cat_type'
    	    );

		var $CMS_TEMPLATE_EDIT = "edit-proto.html";
		var $CMS_TEMPLATE_ADD  = "add-proto.html";
		var $allow_empty_url_part = false;




function admin_icms_proto($m, $MYSQL_DB='') {
		if ($MYSQL_DB=='') {
			$MYSQL_DB = MYSQL_DB;
			};
		$this->m = &$m;
		 $this->DOCUMENT_TREE                  = $MYSQL_DB.'.tree';                 // таблица
		 $this->DOCUMENT_DOCS                  = $MYSQL_DB.'.docs';                 // таблица
		 $this->DOCUMENT_PARAMS                = $MYSQL_DB.'.params';                 // таблица
		 $this->DOCUMENT_SYNC   	       = MYSQL_DB.'.syncrule';               // !!! константа а не переменная 
         $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER = DOCUMENT_TEMPLATES_ADMIN_FOLDER;// шаблоны админки
        }





function show_move() {
	$t = new ice_templates();
	$t->set_file("page", $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER.'move.html' );
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);

	$t->parse("page","page");
	return $t->get("page");
    }













function run(){
	global $HTTP_POST_VARS, $HTTP_GET_VARS,$V;

	if (isset($HTTP_POST_VARS["ID"])) {
	    $ID = $HTTP_POST_VARS["ID"];
		$V = $HTTP_POST_VARS;
	    }
	elseif (isset($HTTP_GET_VARS["ID"])) {
	    $ID = $HTTP_GET_VARS["ID"];      
		$V = $HTTP_GET_VARS;
	    }
	else {
		$ID = "show_index";
		$V['currentid']=0;
		$V['currentlevel']=0;
		$V['maxlevel']=1;
		};
//	alid($V);
	$html = "";
	if ($ID == "show_index") {
		$html = $this->show_tree('index.html');
		}
	elseif ( method_exists($this, $ID) ) {
		$html = call_user_func(array($this,$ID));
		};
	ice_cache::no_cache($html, true);
	exit();
	}








function get_me($type){
	$factory = 'admin_icms_'.$type;
	if (file_exists(CLASSES_BASE.$factory.'.php')) {
		require_once(CLASSES_BASE.$factory.'.php');
		}
	else {
		// если нет специальной админки то значит общая на всех
		$factory = 'admin_icms';
		require_once(CLASSES_BASE.$factory.'.php');
//		trigger_error('File '.CLASSES_BASE.$factory.'.php not exist, cant create object for type='.$type,E_USER_ERROR );
//		return false;
		};
	if (class_exists( $factory )) {
		$o = new $factory($this->m);
		$o->DOCUMENT_TREE =                  $this->DOCUMENT_TREE;
		$o->DOCUMENT_DOCS =                  $this->DOCUMENT_DOCS;
		$o->DOCUMENT_PARAMS =                $this->DOCUMENT_PARAMS;
		$o->DOCUMENT_TEMPLATES_ADMIN_FOLDER =$this->DOCUMENT_TEMPLATES_ADMIN_FOLDER;
		//alid($o);
		return $o;
		}
	else {
		trigger_error('File '.CLASSES_BASE.$factory.'.php dont have correct class for type='.$type,E_USER_ERROR );
		return false;
		};
	}


/*
function get_me($type){
	$factory = 'admin_icms_'.$type;
	if (file_exists(CLASSES_BASE.$factory.'.php')) {
		require_once(CLASSES_BASE.$factory.'.php');
		}
	else {
		trigger_error('File '.CLASSES_BASE.$factory.'.php not exist, cant create object for type='.$type,E_USER_ERROR );
		return false;
		};
	if (class_exists( $factory )) {
		$o = new $factory($this->m);
		$o->DOCUMENT_TREE =                  $this->DOCUMENT_TREE;
		$o->DOCUMENT_DOCS =                  $this->DOCUMENT_DOCS;
		$o->DOCUMENT_PARAMS =                $this->DOCUMENT_PARAMS;
		$o->DOCUMENT_TEMPLATES_ADMIN_FOLDER =$this->DOCUMENT_TEMPLATES_ADMIN_FOLDER;
		//alid($o);
		return $o;
		}
	else {
		trigger_error('File '.CLASSES_BASE.$factory.'.php dont have correct class for type='.$type,E_USER_ERROR );
		return false;
		};
	}
*/


// try to get new unique url for mass url changing
function get_safe_url($id, $url){
//		echo " get_safe_url($id, $url)<br>";
	$q = "
	SELECT
		0+count(id) as count
	FROM
		".$this->DOCUMENT_TREE."
	WHERE
		url = '#url#'
	AND
		type not in ('folder_pseudo', 'link_static', 'link_id')
	AND
		id != '#id#'
		";
    $o = $this->m->selectOneRow($q, __FILE__, __LINE__, Array(
		'url'=>$url,
		'id'=>$id
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	if ($o['count']>0){
		// not safe
		$newurl = substr_replace($url, rand(1,9).'/', -1);
		echo "get_safe_url($id, $url) changed $url to $newurl<br>";
		return $this->get_safe_url($id, $newurl);
		};

//	echo "get_safe_url($id, $url)  return $url as safe <br>";
	// is safe
	return $url;
	}




function change_url_and_parent_id ($id, $oldurl,$newurl, $new_parent_id){
	// не плодим дублей
	$newurl = $this->get_safe_url($id,$newurl);
	if ($oldurl==$newurl){
		// nothing to change...
		return array(
			'status'=>true,
			'id' => $id
			);
		};

	$q = "
	UPDATE
		".$this->DOCUMENT_TREE."
	SET
		parent_id = '#parent_id#',
		url='#url#',
		updated = NOW()
	WHERE
		id = '#id#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id'=>$id,
		'parent_id'=>$new_parent_id,
		'url' => $newurl
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };


	$q1 = "
	INSERT
		".MYSQL_DB.".redirect
	SET
		urlfrom='#urlfrom#',
		urlto='#urlto#',
		created = NOW()
		";
    $o1 = $this->m->query($q1, __FILE__, __LINE__, Array(
		'urlfrom'=>$oldurl,
		'urlto' => $newurl
		));


	return array(
		'status'=>true,
		'id' => $id
		);

	}




/*
принудительно задать все поля и вставить документ указанного типа.
используется в скриптах автоматизированного заполнения и импорта-экспорта
*/
function raw_add_document_for_parent( $parent_id, $type, $name, $visdate, $status, $statushidden, $urlpart, $fullname, $anons, $document, $title, $keywords, $description){
	$o_parent = $this->get_document_base($parent_id);
	$fullurl = $o_parent['document']['url'].$urlpart.'/';

	// проверим нет ли уже документа с таким же УРЛ какой мы собираемся вставить
	$o_exists = $this->get_id_and_type_for_url($fullurl,false,false);

	$q = "
	INSERT
		".$this->DOCUMENT_TREE."
	SET
		parent_id = '#parent_id#',
		type = '#type#',
		name = '#name#',
		visdate = '#visdate#',
		status = '#status#',
		statushidden = '#statushidden#',
		url='#url#',
		ordering = UNIX_TIMESTAMP(),
		updated = NOW(),
		created = NOW()
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'parent_id'=>$parent_id,
		'type' => $type,
		'name' => $name,
		'visdate' => $visdate,
		'status' => $status,
		'statushidden' => $statushidden,
		'url' => $fullurl
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	$id = $this->m->insert_id;
	$q2 = "
	INSERT
		".$this->DOCUMENT_DOCS."
	SET
		id = '#id#',
		fullname = '#fullname#',
		anons = '#anons#',
		document = '#document#',
		seo_title = '#title#',
		seo_keywords = '#keywords#',
		seo_description = '#description#',
		updated = NOW(),
		created = NOW()
		";
    $o2 = $this->m->query($q2, __FILE__, __LINE__, Array(
		'id' => $id,
		'fullname' => $fullname,
		'anons' => $anons,
		'document' => $document,
		'title' => $title,
		'keywords' => $keywords,
		'description' => $description
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };


	// проверим нет ли уже документа с таким же УРЛ какой мы собираемся вставить
	if (isset($o_exists['object']['id'])){
		$newfullurl = $o_parent['document']['url'].$id.'/';
		$this->raw_update_document($id, $parent_id, $type, $name, $visdate, $status, $statushidden, $newfullurl, $fullname, $anons, $document, $title, $keywords, $description);
		echo "URL_REWRITRE: $fullurl=>$newfullurl\r\n";
		};

	return array(
		'status'=>true,
		'id' => $id
		);
	}





/*
принудительно задать все поля и вставить документ указанного типа.
используется в скриптах автоматизированного заполнения и импорта-экспорта
*/
function raw_add_document($id, $parent_id, $type, $name, $visdate, $status, $statushidden, $fullurl, $fullname, $anons, $document, $title, $keywords, $description){
//	$o_parent = $this->get_document_base($parent_id);
	$q = "
	INSERT
		".$this->DOCUMENT_TREE."
	SET
		id = '#id#',
		parent_id = '#parent_id#',
		type = '#type#',
		name = '#name#',
		visdate = '#visdate#',
		status = '#status#',
		statushidden = '#statushidden#',
		url='#url#',
		ordering = UNIX_TIMESTAMP(),
		updated = NOW(),
		created = NOW()
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id'=>$id,
		'parent_id'=>$parent_id,
		'type' => $type,
		'name' => $name,
		'visdate' => $visdate,
		'status' => $status,
		'statushidden' => $statushidden,
		'url' => $fullurl
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
//	$id = $this->m->insert_id;
	$q2 = "
	INSERT
		".$this->DOCUMENT_DOCS."
	SET
		id = '#id#',
		fullname = '#fullname#',
		anons = '#anons#',
		document = '#document#',
		seo_title = '#title#',
		seo_keywords = '#keywords#',
		seo_description = '#description#',
		updated = NOW(),
		created = NOW()
		";
    $o2 = $this->m->query($q2, __FILE__, __LINE__, Array(
		'id' => $id,
		'fullname' => $fullname,
		'anons' => $anons,
		'document' => $document,
		'title' => $title,
		'keywords' => $keywords,
		'description' => $description
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };

	return array(
		'status'=>true,
		'id' => $id
		);
	}


/*
принудительно задать все поля и обновить документ указанного типа.
используется в скриптах автоматизированного заполнения и импорта-экспорта
*/
function raw_update_document($id, $parent_id, $type, $name, $visdate, $status, $statushidden, $fullurl, $fullname, $anons, $document, $title, $keywords, $description){
//	$o_parent = $this->get_document_base($parent_id);
	$q = "
	UPDATE
		".$this->DOCUMENT_TREE."
	SET
		parent_id = '#parent_id#',
		type = '#type#',
		name = '#name#',
		visdate = '#visdate#',
		status = '#status#',
		statushidden = '#statushidden#',
		url='#url#',
		updated = NOW()
	WHERE
		id = '#id#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id'=>$id,
		'parent_id'=>$parent_id,
		'type' => $type,
		'name' => $name,
		'visdate' => $visdate,
		'status' => $status,
		'statushidden' => $statushidden,
		'url' => $fullurl
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
//	$id = $this->m->insert_id;
	$q2 = "
	UPDATE
		".$this->DOCUMENT_DOCS."
	SET
		fullname = '#fullname#',
		anons = '#anons#',
		document = '#document#',
		seo_title = '#title#',
		seo_keywords = '#keywords#',
		seo_description = '#description#',
		updated = NOW()
	WHERE
		id = '#id#'
		";
    $o2 = $this->m->query($q2, __FILE__, __LINE__, Array(
		'id' => $id,
		'fullname' => $fullname,
		'anons' => $anons,
		'document' => $document,
		'title' => $title,
		'keywords' => $keywords,
		'description' => $description
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };

	return array(
		'status'=>true,
		'id' => $id
		);
	}








function raw_update_document_names($id, $name, $fullname,  $title){
//	echo "$id, $name, $fullname,  $title <br>";
//	return array('status'=>true);
	$q = "
	UPDATE
		".$this->DOCUMENT_TREE."
	SET
		name = '#name#',
		updated = NOW()
	WHERE
		id = '#id#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id'=>$id,
		'name' => $name,
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
//	$id = $this->m->insert_id;
	$q2 = "
	UPDATE
		".$this->DOCUMENT_DOCS."
	SET
		fullname = '#fullname#',
		seo_title = '#title#',
		updated = NOW()
	WHERE
		id = '#id#'
		";
    $o2 = $this->m->query($q2, __FILE__, __LINE__, Array(
		'id' => $id,
		'fullname' => $fullname,
		'title' => $title,
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };

	return array(
		'status'=>true,
		'id' => $id
		);
	}











static function get_url_part($url){
	$e = explode('/', $url);
//	ali_debug('','','',$e);
	return $e[sizeof($e)-2];
	}

function get_document_navigation($thisparentID, $name){
	$navigation = array();
	$id=0;
    $oldparentID=$thisparentID;
	$q5 = "
	SELECT
		name,
		url,
		type,
		status,
		parent_id
	FROM
		".$this->DOCUMENT_TREE."
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
		$navigation[$id]['status'] = $r5['status'];
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


function add_document_base($parent_id, $type, $name, $status, $statushidden, $url, $visdate=''){
//alid('url='.$url);

	$o_parent = $this->get_document_base($parent_id);
	$q = "
	INSERT
		".$this->DOCUMENT_TREE."
	SET
		parent_id = '#parent_id#',
		type = '#type#',
		name = '#name#',
		visdate = '#visdate#',
		status = '#status#',
		statushidden = '#statushidden#',
		ordering = UNIX_TIMESTAMP(),
		updated = NOW(),
		created = NOW()
		";
	$q1 = "
	UPDATE
		".$this->DOCUMENT_TREE."
	SET
		url = '#url#'
	WHERE
		id = '#id#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'parent_id'=>$parent_id,
		'type' => $type,
		'name' => $name,
		'visdate' => $visdate,
		'status' => $status,
		'statushidden' => $statushidden
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	$id = $this->m->insert_id;

	// мы еще не проверяем URL на то что уже такой есть! 
	//  определим URL документа.
    if  
    //  ($its_full_url){
    //		$newURL = $url;
    //		}
    //	elseif 
	($this->allow_empty_url_part) {
		// URL документа = URL родителя.
		$newURL = $o_parent['document']['url'];
		}
	elseif ($type=='link_static') {
		$newURL = $url;
		}
	elseif ($type=='link_id') {
		$newURL = $url;
		}
	elseif ($url=='') {
		// URL не был введен, используем insert_id как URL
		$newURL = $o_parent['document']['url'].$id.'/';
		$newURL = $this->get_safe_url($id,$newURL);

		}
	else {
		// URL был введен, используем его
		$newURL = $o_parent['document']['url'].$url.'/';
		$newURL = $this->get_safe_url($id,$newURL);
		};

	$o1 = $this->m->query($q1, __FILE__, __LINE__, Array(
		'url'=>$newURL,
		'id'=>$id
		));
	    if ($this->m->error ) {
	        return Array('status'=>false);
	        };

	return array(
		'status'=>true,
		'id' => $id
		);
	}



function update_childs_url($from, $to) {
ali_debug('--','--','--',array($from, $to));
	$q1 = "
	SELECT
		id, url
	FROM
		".$this->DOCUMENT_TREE."
	WHERE
		url REGEXP '^#from#'
	AND
		type not in ('folder_pseudo', 'link_static', 'link_id')
		";
	$q2 = "
	UPDATE
		".$this->DOCUMENT_TREE."
	SET
		url= '#url#'
	WHERE
		id = '#id#'
	AND
		type not in ('folder_pseudo', 'link_static')
		";

	$q3 = "
	INSERT
		".MYSQL_DB.".redirect
	SET
		urlfrom='#urlfrom#',
		urlto='#urlto#',
		created = NOW()
		";

	 $o33 = $this->m->query($q3, __FILE__, __LINE__, Array(
			'urlfrom'=>$from,
			'urlto' => $to
			));



    $o1 = $this->m->selectManyRows($q1, __FILE__, __LINE__, Array(
		'from' => $from
		));
	while (list($k, $v)=each($o1)) {
		$oldurl = $v['url'];
		$newurl =  ereg_replace ( "^$from(.*)", "$to\\1", $v['url'] );

		$newurl = $this->get_safe_url($v['id'],$newurl);

		echo "<br>$oldurl  ==> $newurl<br>";
	    $o = $this->m->query($q2, __FILE__, __LINE__, Array(
			'url'=>$newurl,
			'id'=>$v['id']
			));

	    $o3 = $this->m->query($q3, __FILE__, __LINE__, Array(
			'urlfrom'=>$oldurl,
			'urlto' => $newurl
			));

			};

    if ($this->m->error ) {
        return Array('status'=>false);
        };
}




function update_sort_value($document_id, $ordering) {
	$q1 = "
	UPDATE
		".$this->DOCUMENT_TREE."
	SET
		ordering= '#ordering#'
	WHERE
		id = '#id#'
		";
	 $o = $this->m->query($q1, __FILE__, __LINE__, Array(
		'ordering'=>$ordering,
		'id'=>$document_id
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		);
	}


function update_document_base($document_id, $visdate, $name, $status, $statushidden, $urlpart){
	$o_last = $this->get_document_base($document_id);
	$o_parent = $this->get_document_base($o_last['document']['parent_id']);

	if ($urlpart == '' & $this->allow_empty_url_part && ($document_id ==1) ) {
		$url = '/';
		}
	elseif ($urlpart == '' & $this->allow_empty_url_part) {
		$url = $o_parent['document']['url'];
		}
	elseif ($urlpart == '' & !$this->allow_empty_url_part) {
		$url = (isset($o_parent['document']['url'])?$o_parent['document']['url']:'').
			   (isset($o_parent['document']['url'])?$document_id:'').
			   '/';
		$url = $this->get_safe_url($document_id,$url);
		}
	else {
		$url = $o_parent['document']['url'].$urlpart.'/';
		$url = $this->get_safe_url($document_id,$url);
		};

	$q = "
	UPDATE
		".$this->DOCUMENT_TREE."
	SET
		name = '#name#',
		visdate = '#visdate#',
		url  = '#url#',
		status = '#status#',
		statushidden = '#statushidden#',
		updated = NOW()
	WHERE
		id = '#id#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id'=>$document_id,
		'name' => $name,
		'visdate' => $visdate,
		'url' => $url,
		'status' => $status,
		'statushidden' => $statushidden
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };

	if ($o_last['document']['url'] !== $url) {
		$this->update_childs_url(
			$o_last['document']['url'],   // from
			$url                          // to
			);
		};

	return array(
		'status'=>true,
		'id' => $document_id
		);
	}


function get_childs($parent_id, $ordering='ordering', $sort='DESC'){
	$q = "
	SELECT
		id, name, type, status, statushidden, updated, url, ordering
	FROM
		".$this->DOCUMENT_TREE."
	WHERE
		parent_id=#parent_id# 
	ORDER BY 
		#ordering#
	#sort#
		";
    $o = $this->m->selectManyRows($q, __FILE__, __LINE__, Array(
		'parent_id'=>$parent_id,
		'ordering'=>$ordering,
		'sort'=>$sort
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		'catalog' => $o
		);
	}


function get_document_base($document_id){
	$q = "
	SELECT
		*
	FROM
		".$this->DOCUMENT_TREE."
	WHERE
		id=#document_id# 
		";
    $o = $this->m->selectOneRow($q, __FILE__, __LINE__, Array(
		'document_id'=>$document_id
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		'document' => $o
		);
	}


/*
function get_parent_base($document_id){
	$o_parent = $this->get_document_base($document_id);
	return $this->get_document_base($o_parent['document']['parent_id']);
	}
*/



function get_tree_offset($parent_id,$limit=500,$offset=0){
	$ob = $this->get_document_base($parent_id);
	$url = $ob['document']['url'];

	$q0 = "
	SELECT
		count(*) as count
	FROM
		".$this->DOCUMENT_TREE."
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
		".$this->DOCUMENT_TREE."
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



function get_tree_offset_and_sync($parent_id,$limit=500,$offset=0){
	$ob = $this->get_document_base($parent_id);
	$url = $ob['document']['url'];

	$q0 = "
	SELECT
		count(*) as count
	FROM
		".$this->DOCUMENT_TREE."
	WHERE
		url like '#url#%'
		";
    $o0 = $this->m->selectOneRow($q0, __FILE__, __LINE__, Array(
		'url'=>$url
		));
//	alid($o0);

	$q = "
	SELECT
		t.id, t.parent_id, t.name, t.type, t.status, t.url, syncrule.type as synctype
	FROM
		".$this->DOCUMENT_TREE." as t
	LEFT JOIN
		syncrule
	ON
		t.id = syncrule.dst_id
	WHERE
		t.url like '#url#%'
	ORDER BY 
		t.url ASC
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









function get_tree_offset_notsynced($parent_id,$limit=500,$offset=0){
	$ob = $this->get_document_base($parent_id);
	$url = $ob['document']['url'];

/*
	$q0 = "
	SELECT
		count(*) as count
	FROM
		".$this->DOCUMENT_TREE."
	WHERE
		url like '#url#%'
		";
    $o0 = $this->m->selectOneRow($q0, __FILE__, __LINE__, Array(
		'url'=>$url
		));
//	alid($o0);
*/

	$q = "
	SELECT
		t.id, t.parent_id, t.name, t.type, t.status, t.url, s.type as synctype
	FROM
		".$this->DOCUMENT_TREE." as t
	LEFT JOIN
		".$this->DOCUMENT_SYNC." as s
	ON
		t.id = s.src_id
	WHERE
		t.url like '#url#%'
	AND
		s.dst_id IS NULL
	ORDER BY 
		t.url ASC
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
//		'count'=>$o0['count'],
		'catalog' => $res
		);
	}










function get_tree_offset_names($parent_id,$limit=500,$offset=0){
	$ob = $this->get_document_base($parent_id);
	$url = $ob['document']['url'];

	$q0 = "
	SELECT
		count(*) as count
	FROM
		".$this->DOCUMENT_TREE."
	WHERE
		url like '#url#%'
		";
    $o0 = $this->m->selectOneRow($q0, __FILE__, __LINE__, Array(
		'url'=>$url
		));
//	alid($o0);

	$q = "
	SELECT
		t.id, t.parent_id, t.name, t.type, t.status, t.url, d.fullname , d.seo_title
	FROM
		".$this->DOCUMENT_TREE." as t 
	LEFT JOIN
		".$this->DOCUMENT_DOCS." as d
		ON  
		d.id = t.id 
	WHERE
		t.url like '#url#%'
	ORDER BY 
		t.url ASC
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



function get_tree_only($parent_id, $current_level, $max_level, $only_show=''){
//echo " * ";
	if ($current_level > $max_level) {
		return array('status'=>false);
		};
	$current_level++;
	$q = "
	SELECT
		id, parent_id, name, type, status, statushidden, updated, url
	FROM
		".$this->DOCUMENT_TREE."
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
//		$prms = $this->get_document_params($v['id']);
		$res[$i] = $v;
//		$res[$i]['params'] = $prms['params'];
        $res[$i]['currentlevel'] = ($current_level -1);
		$i++;
//		if ( in_array($v['type'], $this->folders_type)) {
			// yeah. recursy
			$parents = $this->get_tree_only($v['id'], $current_level, $max_level, $only_show);
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



function get_tree($parent_id, $current_level, $max_level){
	if ($current_level > $max_level) {
		return array('status'=>false);
		};
	$current_level++;
	$q = "
	SELECT
		id, parent_id, name, type, status, statushidden, updated, url
	FROM
		".$this->DOCUMENT_TREE."
	WHERE
		parent_id=#parent_id# 
	ORDER BY 
		ordering
	DESC
		";
    $o = $this->m->selectManyRows($q, __FILE__, __LINE__, Array(
		'parent_id'=>$parent_id
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	$res = array();
	$i=0;
	while (list($k, $v)=each($o)) {
		$prms = $this->get_object_params($v['id']);
		$res[$i] = $v;
// huge memory usage ... 
		$res[$i]['params'] = $prms['list'];
//		$res[$i]['params'] = array();
        $res[$i]['currentlevel'] = ($current_level -1);
		$i++;
		if ( in_array($v['type'], $this->folders_type)) {
			// yeah. recursy
			$parents = $this->get_tree($v['id'], $current_level, $max_level);
			if ($parents['status'] ) {
				while (list($kk, $vv)=each($parents['catalog'])) {
					$res[] = $vv;
					$i++;
					};
				};
			unset($parents);
			};
		};
	return array(
		'status'=>true,
		'catalog' => $res
		);
	}



function show_search($template = 'index.html') {
    global $М, $V;
		$myq = str_replace( HTTP_BASE, '',  trim($V['q']) );
/*
	$tree = $this->get_tree(
		(isset($V['currentid'])?$V['currentid']:0), 
		(isset($V['currentlevel'])?$V['currentlevel']:0), 
		(isset($V['maxlevel'])?$V['maxlevel']:1576)
		);
*/

	$q = "
	SELECT
		id, name, type, status, statushidden, updated, url
	FROM
		".$this->DOCUMENT_TREE."
	WHERE
		url like '%#q#%'
		OR
		name like '%#q#%'
		OR
		id  like '%#q#%'
	ORDER BY 
		url, ordering
	DESC
		";
    $o = $this->m->selectManyRows($q, __FILE__, __LINE__, Array(
		'q'=>$myq
		));

	$t = new ice_templates();
	$t->set_file("page", $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER.$template );
	$t->set_var("q", $myq );
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("HTTPS_BASE_ADMIN", HTTPS_BASE_ADMIN );
	$t->set_var("CMS_ADMIN_NAME", CMS_ADMIN_NAME );
	$t->set_var("CMS_ADMIN_URL_BASE", CMS_ADMIN_URL_BASE);
	$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME", "" );
	$t->set_var("CMS_ADMIN_IMAGES_BASE", CMS_ADMIN_IMAGES_BASE);
	$t->set_block('page', 'BLOCK.DOCUMENT', 'BLOCK_DOCUMENT');
	$t->set_var('BLOCK_DOCUMENT', '');
	$t->set_block('BLOCK.DOCUMENT', 'BLOCK.DOCUMENTSORT', 'BLOCK_DOCUMENTSORT');
	$t->set_block('BLOCK.DOCUMENT', 'BLOCK.DOCUMENTADDCHILD', 'BLOCK_DOCUMENTADDCHILD');
	$t->set_block('BLOCK.DOCUMENT', 'BLOCK.DOCUMENTPRICES', 'BLOCK_DOCUMENTPRICES');
	$t->set_var('BLOCK_DOCUMENTSORT', '');
	$t->set_var('BLOCK_DOCUMENTADDCHILD', '');
	$t->set_var('BLOCK_DOCUMENTPRICES', '');
	$c = 0;
		while (list($k, $v)=each($o)) {
			$t->set_var('BLOCK_DOCUMENTSORT', '');
			$t->set_var('BLOCK_DOCUMENTADDCHILD', '');
        	$t->set_var('BLOCK_DOCUMENTPRICES', '');
			$t->set_var('rowcolor', $c ); $c = (int)!($c);
			$t->set_var('document.id',  $v['id']);
			$t->set_var('name',  htmlspecialchars($v['name']) );
			$t->set_var('type',  $v['type']);
			$t->set_var('url',  $v['url']);
			$t->set_var('full_url',  view_icms::get_cms_url($v['type'], $v['url']) );
			$t->set_var('blocked',  $v['status']);
			$v['currentlevel'] = sizeof(explode('/', $v['url']) )-2 ;

			$t->set_var('br',  ($v['currentlevel']*35) );
			$t->set_var('status',  $v['status'] );
			$t->set_var('statushidden',  $v['statushidden'] );
			$t->set_var('checked', ($v['status']=='active')?'':'checked' );
//			$t->set_var('statushiddenchecked', ($v['statushidden']=='active')?'':'checked' );
			$t->set_var('date', $this->mysqltimestamp_to_date( $v['updated'] ) );
			if ( in_array($v['type'], $this->folders_type)) {
				$t->parse('BLOCK_DOCUMENTSORT', 'BLOCK.DOCUMENTSORT', false);
				$t->parse('BLOCK_DOCUMENTADDCHILD', 'BLOCK.DOCUMENTADDCHILD', false);
				};

			if ( in_array($v['type'], $this->folders_price_type)) {
//			if ($v['type']=='folder_cat_type') {
				$t->parse('BLOCK_DOCUMENTPRICES', 'BLOCK.DOCUMENTPRICES', false);
				};


			$t->parse('BLOCK_DOCUMENT', 'BLOCK.DOCUMENT', true);
			};
	$t->parse("page","page");
	return $t->get("page");
    }


function show_tree($template = 'index.html') {
    global $М, $V, $admin_fast_add;
	$tree = $this->get_tree(
		(isset($V['currentid'])?$V['currentid']:0), 
		(isset($V['currentlevel'])?$V['currentlevel']:0), 
		(isset($V['maxlevel'])?$V['maxlevel']:9000)
		);
	
	$t = new ice_templates();
	$t->set_file("page", $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER.$template );
	$t->set_var("q", '' );
	$t->set_var("CMS_ADMIN_NAME", CMS_ADMIN_NAME );
	$t->set_var("CMS_ADMIN_URL_BASE", CMS_ADMIN_URL_BASE);
	$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME", "" );
	$t->set_var("CMS_ADMIN_IMAGES_BASE", CMS_ADMIN_IMAGES_BASE);
	$t->set_var("HTTP_BASE", HTTP_BASE);
	$t->set_var("level".$V['maxlevel']."active", ' class="active" ');
	$t->set_var("levelid", $V['currentid']);
	$t->set_var("currentlevel", $V['currentlevel']);
	$t->set_var("HTTPS_BASE_ADMIN", HTTPS_BASE_ADMIN);
	$t->set_block('page', 'BLOCK.DOCUMENT', 'BLOCK_DOCUMENT');
	$t->set_var('BLOCK_DOCUMENT', '');
	$t->set_block('BLOCK.DOCUMENT', 'BLOCK.DOCUMENTSORT', 'BLOCK_DOCUMENTSORT');
	$t->set_block('BLOCK.DOCUMENT', 'BLOCK.DOCUMENTADDCHILD', 'BLOCK_DOCUMENTADDCHILD');
	$t->set_block('BLOCK.DOCUMENT', 'BLOCK.DOCUMENTPRICES', 'BLOCK_DOCUMENTPRICES');
	$t->set_var('BLOCK_DOCUMENTSORT', '');
	$t->set_var('BLOCK_DOCUMENTADDCHILD', '');
	$t->set_var('BLOCK_DOCUMENTPRICES', '');
	$c = 0;

	$t->set_block('page', 'BLOCK.FASTLINK', 'BLOCK_FASTLINK');
	$t->set_var('BLOCK_FASTLINK', '');

	while (list($k, $v)=each($admin_fast_add)) {
		$t->set_var('FASTLINK.name', $v['name']);
		$t->set_var('FASTLINK.parent_id', $v['parent_id']);
		$t->set_var('FASTLINK.type', $v['type']);
		$t->parse('BLOCK_FASTLINK', 'BLOCK.FASTLINK', true);
		};

	while (list($k, $v)=each($tree['catalog'])) {
			$t->set_var('BLOCK_DOCUMENTSORT', '');
			$t->set_var('BLOCK_DOCUMENTADDCHILD', '');
			$t->set_var('BLOCK_DOCUMENTPRICES', '');
			$t->set_var('rowcolor', $c ); $c = (int)!($c);
			$t->set_var('document.id',  $v['id']);
			$t->set_var('name',  htmlspecialchars($v['name']) );
			$t->set_var('type',  $v['type']);
			$t->set_var('url',  $v['url']);
			$t->set_var('full_url',  view_icms::get_cms_url($v['type'], $v['url']) );
			$t->set_var('blocked',  $v['status']);
			$t->set_var('br',  ((1+$v['currentlevel'])*35) );
			$t->set_var('status',  ($v['status']=='active')?'':'warning' );
			$t->set_var('statushidden',  $v['statushidden'] );
			$t->set_var('checked', ($v['status']=='active')?'':'checked' );
//			$t->set_var('statushiddenchecked', ($v['statushidden']=='active')?'':'checked' );
			$t->set_var('date', $this->mysqltimestamp_to_date( $v['updated'] ) );
			if ( in_array($v['type'], $this->folders_type)) {
				$t->parse('BLOCK_DOCUMENTSORT', 'BLOCK.DOCUMENTSORT', false);
				$t->parse('BLOCK_DOCUMENTADDCHILD', 'BLOCK.DOCUMENTADDCHILD', false);
				};

			if ( in_array($v['type'], $this->folders_price_type)) {
//			if ($v['type']=='folder_cat_type') {
				$t->parse('BLOCK_DOCUMENTPRICES', 'BLOCK.DOCUMENTPRICES', false);
				};

			$t->parse('BLOCK_DOCUMENT', 'BLOCK.DOCUMENT', true);
			};
	$t->parse("page","page");
	return $t->get("page");
    }


function show_sort($message = ''){
    global $М, $V;
	if ($V['document_id']>0) {
		$o_parent = $this->get_document_base($V['document_id']);
		};
	$d = $this->get_childs($V['document_id']);
//	ali_debug('','','',$d);

	$t = new ice_templates();
	$t->set_file("page", $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER."sort.html" );
	$t->set_var("CMS_ADMIN_NAME", CMS_ADMIN_NAME );
	$t->set_var("CMS_ADMIN_URL_BASE", CMS_ADMIN_URL_BASE);
	$t->set_var("CMS_ADMIN_IMAGES_BASE", CMS_ADMIN_IMAGES_BASE);
	if ($V['document_id']>0) {
		$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME", htmlspecialchars($o_parent['document']['name']) );
		}
	else {
		$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME", '/' );
		};

	$t->set_block('page', 'BLOCK.DOCUMENT', 'BLOCK_DOCUMENT');
	$t->set_var('BLOCK_DOCUMENT', '');

		$t->set_var('message',  $message);
		$t->set_var('parent_id',  $V['document_id']);

		$c = 0;
		while (list($k, $v)=each($d['catalog'])) {
			$t->set_var('rowcolor', $c ); $c = (int)!($c);
			$t->set_var('document.id',  $v['id']);
			$t->set_var('name',  $v['name']);
			$t->set_var('type',  $v['type']);
			$t->set_var('url',  $v['url'] );
			$t->set_var('full_url',  view_icms::get_cms_url($v['type'], $v['url']) );
			$t->set_var('ordering',  $v['ordering']);
			$t->set_var('status',  $v['status'] );
			$t->set_var('statushidden',  $v['statushidden'] );
			$t->set_var('date', $this->mysqltimestamp_to_date( $v['updated'] ) );
			$t->parse('BLOCK_DOCUMENT', 'BLOCK.DOCUMENT', true);
			};

	$t->parse("page","page");
	return $t->get("page");
    }



function show_add_base() {
    global $М, $V;
	if ($V['parent_id']>0) {
		$o_parent = $this->get_document_base($V['parent_id']);
		};
	$t = new ice_templates();
	$t->set_file("page", $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER."add.html" );
	$t->set_var("CMS_ADMIN_NAME", CMS_ADMIN_NAME );
	$t->set_var("CMS_ADMIN_URL_BASE", CMS_ADMIN_URL_BASE);
	$t->set_var("CMS_ADMIN_IMAGES_BASE", CMS_ADMIN_IMAGES_BASE);

	if ($V['parent_id']>0) {
		$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME", htmlspecialchars($o_parent['document']['name']) );
		}
	else {
		$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME", '/' );
		};


	$t->set_block("page", "BLOCK.DOCTYPE", "BLOCK_DOCTYPE");
	$t->set_var("BLOCK_DOCTYPE", "");
	while (list($k, $v) = each($this->registered_types)) {
		$t->set_var("name",  $v);
		$t->set_var("type",  $k);
		$t->parse("BLOCK_DOCTYPE",   "BLOCK.DOCTYPE", true);
		};

	$t->set_var('parent.id', $V['parent_id'] );
	$t->set_var("name", '' );
	$t->set_var("url", '' );
	$t->set_var('status',  '' );
	$t->set_var('checked', '' );
	$t->set_var('' );
	$t->parse("page","page");	return $t->get("page");
    }

function add_base() {
    global $М, $V;
	// трюк: вызываем админку для $V['type']
	// и ему передаем данные. 
	// в базу еще ничего не записываем.
//	ali_debug('','','',$V);	
	$my_object = $this->get_me($V['type']);

//	ali_debug('','','',$my_object);	
	return $my_object->show_add( 
			$V['parent_id'], $V['type'], $V['name'], 
			isset($V['status'])?'disabled':'active', 
			isset($V['statushidden'])?'hidden':'active', 
			$V['url']
			);
	}

function show_edit(){
    global $М, $V;
	$o = $this->get_document_base($V['document_id']);
//	alid($o);
	$my_object = $this->get_me($o['document']['type']);
//	alid($my_object);
	return $my_object->view_edit();
	}



/*
function adddownload() {
    global $М, $V;
	$o = $this->get_document_base($V['document_id']);
	$my_object = $this->get_me($o['document']['type']);
	return $my_object->adddownload();
}



function editdownload() {
    global $М, $V;
	$o = $this->get_document_base($V['document_id']);
	$my_object = $this->get_me($o['document']['type']);
	return $my_object->editdownload();
}
*/


function add(){
    global $М, $V;
	$my_object = $this->get_me($V['type']);
	return $my_object->do_add();
	}

function edit(){
    global $М, $V;
	$o = $this->get_document_base($V['document_id']);
	$my_object = $this->get_me($o['document']['type']);
	return $my_object->do_edit();
	}


function update_sort(){
    global $V;
//	ali_debug('','','',$V);
	reset($V);
	while (list($k, $v)=each($V)) {
		if (preg_match('/^newordering_([0-9]*)$/', $k, $mm)) {
			$this->update_sort_value($mm[1], $v);
//			echo "1";
			};
		};

	return $this->show_sort('Обновлено');
	}



function mysqltimestamp_to_date($d){
    //echo $d;
    //2009-05-02 23:39:12
	//preg_match("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", $d, $m);
	  preg_match("/([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})/", $d, $m);
	$year=$m[1];
	$month=$m[2];
	$day=$m[3];
	$h=$m[4];
	$min=$m[5];
	$sec=$m[6];
	$ts = mktime ($h, $min, $sec, $month, $day, $year);
	return date("j F Y H:i:s ", $ts);
	}






// ############################################################################  



function update_sync_type($dst_id, $type) {
//        global $m;

//echo( " $dst_id, $type <br>");

    	$q0 = "
    		SELECT
                dst_id
            FROM 
                ".MYSQL_DB.".syncrule
            WHERE
                dst_id = #dst_id#
    	";

    	$q1 = "
    		UPDATE
                ".MYSQL_DB.".syncrule
            SET
                type = '#type#'
            WHERE
                dst_id = #dst_id#
    	";

    	$q2 = "
    		INSERT
                ".MYSQL_DB.".syncrule
            SET
                type = '#type#',
                dst_id = #dst_id#
    	";

	    $r0 = $this->m->selectOneRow($q0, __FILE__, __LINE__, Array(
                'dst_id' => $dst_id,
                'type' => $type
            ));
    	if ($this->m->error) return Array('status' => false);
        if (isset($r0['dst_id'])) {

        	$o = $this->m->query($q1, __FILE__, __LINE__, Array(
                    'dst_id' => $dst_id,
                    'type' => $type
                    ));

            }
        else {

        	$o = $this->m->query($q2, __FILE__, __LINE__, Array(
                    'dst_id' => $dst_id,
                    'type' => $type
                    ));

            };

    	if ($this->m->error) return Array('status' => false);

    	return array(
    		'status' => true
    	);

}







function update($id, $pname, $pvalue) {
//        global $m;

    	$q0 = "
    		SELECT
                uid
            FROM 
                ".$this->DOCUMENT_PARAMS."
            WHERE
                doc_id = #id#
            AND
                pname = '#pname#'
    	";

    	$q1 = "
    		UPDATE
                ".$this->DOCUMENT_PARAMS."
            SET
                pvalue = '#pvalue#'
            WHERE
                doc_id = #id#
            AND
                pname = '#pname#'
    	";

    	$q2 = "
    		INSERT
                ".$this->DOCUMENT_PARAMS."
            SET
                pvalue = '#pvalue#',
                doc_id = #id#,
                pname = '#pname#'
    	";

	    $r0 = $this->m->selectOneRow($q0, __FILE__, __LINE__, Array(
                'id' => $id,
                'pname' => $pname,
                'pvalue' => $pvalue
            ));
    	if ($this->m->error) return Array('status' => false);
        if (isset($r0['uid'])) {

        	$o = $this->m->query($q1, __FILE__, __LINE__, Array(
                    'id' => $id,
                    'pname' => $pname,
                    'pvalue' => $pvalue
                    ));

            }
        else {

        	$o = $this->m->query($q2, __FILE__, __LINE__, Array(
                    'id' => $id,
                    'pname' => $pname,
                    'pvalue' => $pvalue
                    ));

            };

    	if ($this->m->error) return Array('status' => false);

    	return array(
    		'status' => true
    	);

}



function get_childs_array($o_childs, $level = 1) {
        global $model;

        $o = array();

        foreach($o_childs as $v) {
                $childs = $this->get_object_childs($v['id']);
//alid($childs);
                if(count($childs['childs']) == 0) {
                    foreach($o_childs as $key => $value) {
                        $o_childs[$key]['level'] = $level;
                    }
                    return $o_childs;
                }

                $o[$v['id']] = $v;
                $o[$v['id']]['level'] = $level;
                $o[$v['id']]['childs'] = $this->get_o_childs($childs['childs'], ($level + 1) );

        }

        return $o;
}



/**
 *  Рекурсивно получаем все дерево
 */

function get_o_childs($o_childs, $level = 1) {
        $o = array();

        foreach($o_childs as $v) {
                $childs = $this->get_object_childs($v['id']);

                if(count($childs['childs']) == 0) {
                    foreach($o_childs as $key => $value) {
                        $o_childs[$key]['level'] = $level;
                    }
                    return $o_childs;
                }

                $o[$v['id']] = $v;
                $o[$v['id']]['level'] = $level;
                $arrTmp = $this->get_o_childs($childs['childs'], ($level + 1) );
         //       alid($arrTmp);
                foreach($arrTmp as $value) {
                    $o[$value['id']] = $value;
                }
                 

        }

        return $o;
}

/*
function insert($id) {
        global $m;

    	$q = "
    		INSERT INTO
                ".MYSQL_DB.".params
            SET
                doc_id = #id#,
                pname = 'currency'
    	";
    
    	$o = $m->query($q, __FILE__, __LINE__, Array('id' => $id));

    	return array(
    		'status' => true
    	);

}

*/

function get_prices($id) {
//        global $m;
        return $this->get_object_params($id);
}


function get_object_params($id){
//            doc_id
    	$q = "
    		SELECT
    		uid,
            pname,
            pvalue
    		FROM
                ".$this->DOCUMENT_PARAMS."
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





function get_object_childs($id, $limit=1024, $offset='0') {
    global $m;

//			tree.mp,

	$q1 = "
		SELECT
			tree.id,
			tree.name,
			tree.type,
			tree.url,
			tree.visdate,
			tree.statushidden,
			doc.fullname,
			doc.updated
		FROM 
			tree as tree
		LEFT JOIN
			docs as doc
		ON 
			doc.id = tree.id
		WHERE 
			tree.parent_id = '#id#'
		AND
			tree.status = 'active'
		ORDER BY 
			tree.ordering DESC
		LIMIT 
			#offset#, #limit#
	";
	$o1 = $m->selectManyRows($q1, __FILE__, __LINE__,
		Array(
			'id' =>		$id,
			'limit' =>	$limit,
			'offset' =>	$offset
		)
	);
	return Array(
		'status' =>	true,
		'childs' =>	$o1
	);
}



/* для link_static отдаем как есть, для всех остальных нет ... */
function get_cms_url($type, $url, $force_http_base = false){
	return (($type=='link_static') ?  $url : HTTP_BASE.$url );
	}






function add_document($parent_id, $type, $name, $anons, $document, $keywords,$description, $status, $statushidden, $url, $visdate=''){


if (defined('CMS_TABLE_FIX_FROM')){
	if (preg_match('/('.CMS_TABLE_FIX_FROM.')/ms',  $document, $mmw)){
//		echo "!!!!!!!!!!!!!!!!!!";
		$document =  preg_replace('/('.CMS_TABLE_FIX_FROM.')/ms', CMS_TABLE_FIX_TO, $document);
		};
	};


	// создадим запись в дереве.
	$o = $this->add_document_base(
		$parent_id, $type, $name, $status, $statushidden, $url, $visdate
		);
	$document_id = $o['id'];
	$q = "
	INSERT
		".$this->DOCUMENT_DOCS."
	SET
		id = '#id#',
		fullname = '#name#',
		anons = '#anons#',
		document = '#document#',
		seo_keywords = '#keywords#',
		seo_description = '#description#',
		status = '#status#',
		ordering =UNIX_TIMESTAMP(),
		updated = NOW(),
		created = NOW()
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id' => $document_id,
		'name' => $name,
		'anons' => $anons,
		'document' => $document,
		'keywords' => $keywords,
		'description' => $description,
		'status' => $status
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		'id' => $document_id
		);
	}



function update_document($document_id, $fullname, $anons, $document,$seo_title, $seo_keywords,$seo_description, $status){

if (defined('CMS_TABLE_FIX_FROM')){
	if (preg_match('/('.CMS_TABLE_FIX_FROM.')/ms',  $document, $mmw)){
//		echo "!!!!!!!!!!!!!!!!!!";
		$document =  preg_replace('/('.CMS_TABLE_FIX_FROM.')/ms', CMS_TABLE_FIX_TO, $document);
		};
	};


	$q = "
	UPDATE
		".$this->DOCUMENT_DOCS."
	SET
		fullname = '#fullname#',
		anons = '#anons#',
		document = '#document#',
		seo_title = '#seo_title#',
		seo_keywords = '#seo_keywords#',
		seo_description = '#seo_description#',
		status = '#status#',
		updated = NOW()
	WHERE
		id = '#id#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id'=>$document_id,
		'fullname' => $fullname,
		'anons' => $anons,
		'document' => $document,
		'seo_title' => $seo_title,
		'seo_keywords' => $seo_keywords,
		'seo_description' => $seo_description,
		'status' => $status
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };

	return array(
		'status'=>true,
		'id' => $document_id
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


function add_document_param($document_id, $pname, $pvalue){
	$q = "
	INSERT
		".$this->DOCUMENT_PARAMS."
	SET
		doc_id= '#document_id#',
		pname = '#pname#',
		pvalue= '#pvalue#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'document_id'=>$document_id,
		'pname'=>$pname,
		'pvalue'=>$pvalue
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true
		);
	}

function update_document_param($param_id, $pvalue){
	$q = "
	UPDATE
		".$this->DOCUMENT_PARAMS."
	SET
		pvalue= '#pvalue#'
	WHERE
		uid = '#uid#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'uid'=>$param_id,
		'pvalue'=>$pvalue
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true
		);
	}



function update_url($id, $url){

	$url = $this->get_safe_url($id,$url);

	$q = "
	UPDATE
		".$this->DOCUMENT_TREE."
	SET
		url= '#url#'
	WHERE
		id = '#id#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id'=>$id,
		'url'=>$url
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true
		);
	}




function get_document($document_id){
	$q = "
	SELECT
		doc.*,
		tree.parent_id,
		tree.name,
		tree.url,
		tree.visdate,
		tree.status,
		tree.type,
		tree.statushidden
	FROM
		".$this->DOCUMENT_DOCS." as doc
	LEFT JOIN
		".$this->DOCUMENT_TREE." as tree
	ON 
		tree.id = doc.id
	WHERE
		doc.id=#document_id# 
		";
    $o = $this->m->selectOneRow($q, __FILE__, __LINE__, Array(
		'document_id'=>$document_id
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		'document' => $o
		);
	}


function show_add() {
	global $М, $V;
	if ($V['parent_id']>0) {
		$o_parent = $this->get_document($V['parent_id']);
		};

	$t = new ice_templates();
	$t->set_file("page", $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER.$this->CMS_TEMPLATE_ADD );
	$t->set_var("type", $V['type']);
	$t->set_var("CMS_ADMIN_NAME", CMS_ADMIN_NAME );
	$t->set_var("CMS_ADMIN_URL_BASE", CMS_ADMIN_URL_BASE);
	$t->set_var("CMS_ADMIN_IMAGES_BASE", CMS_ADMIN_IMAGES_BASE);

	if ($V['parent_id']>0) {
		$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME", htmlspecialchars($o_parent['document']['name']) );
		}
	else {
		$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME", '/' );
		};

	$t->set_var('parent.id', $V['parent_id'] );
	$t->set_var("name", $V['name'] );
	$t->set_var("fullname", $V['name'] );
	$t->set_var("url", $V['url'] );
	$t->set_var("anons", '' );
	$t->set_var("document", '' );
	$t->set_var("description", '' );
	$t->set_var("keywords", '' );
	$t->set_var('status',  '' );
	$t->set_var('checked', '' );
	$t->set_var('' );
	$t->parse("page","page");

	return $t->get("page");
    }



function do_add() {
	global $М, $V;
	$o = $this->add_document(
		$V['parent_id'], $V['type'], $V['name'], $V['anons'], $V['document'], $V['seo_keywords'],$V['seo_description'], 
		isset($V['status'])?'disabled':'active', 
		isset($V['statushidden'])?'hidden':'active',
		$V['url']
		);
	$V['document_id'] = $o['id'];
	return $this->view_edit('Документ добавлен!');
	}


function do_edit() {
    global $М, $V;
	// в самом-самом parent'е
	
	if (preg_match('/[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,4}/',$V['visdate'])){
	$e = explode('.',$V['visdate']);
//	alid($e);
	while(list($k,$v)=each($e)){
		if (strlen($v)<2){$e[$k]='0'.$v;};
		};
//	alid($e);
	$V['visdate']=$e[0].'.'.$e[1].'.'.$e[2];
	};
	//alid($V['visdate']);
	
	$o1 = $this->update_document_base($V['document_id'], $V['visdate'], $V['name'], isset($V['status'])?'disabled':'active', 
		isset($V['statushidden'])?'hidden':'active',
		$V['url']
		);

	// в общем случае разные для разных типов.
	$o2 = $this->update_document(
		$V['document_id'], $V['fullname'], $V['anons'], $V['document'], $V['seo_title'],$V['seo_keywords'],$V['seo_description'], 
		isset($V['status'])?'disabled':'active',
		isset($V['statushidden'])?'hidden':'active'
		);

//	ali_debug('','','',$V);

	// разные параметры
	reset($V);
//	alid($V);
	while (list($k, $v)=each($V)) {
		// просто параметры 
		if (preg_match('/^oldparameter_(.*)$/', $k, $mm) ) {
			if (intval($v)>0) {
//				$this->update_document_param($v, $V[ 'parameter_'.$mm[1] ] );
				$this->update_document_param($v, 
					isset($V[ 'parameter_'.$mm[1] ])?$V[ 'parameter_'.$mm[1] ]:''
					);
				}
			else {
//				alid(	$mm[1]	);
//				alid(	$V[ 'parameter_'.$mm[1] ]	);

//				$opar = $this->add_document_param($V['document_id'],  $mm[1], $V[ 'parameter_'.$mm[1] ] );
				$opar = $this->add_document_param($V['document_id'],  $mm[1], 
					isset($V[ 'parameter_'.$mm[1] ])?$V[ 'parameter_'.$mm[1] ]:''
					);

//				$opar = $this->add_document_param($V['document_id'], $this->param_names[ $mm[1] ]['name'], $V[ 'parameter_'.$mm[1] ] );
//				$V[ 'oldparameter_'.$mm[1]] = $opar['id'];
				};
			};
		};

	// файлы 
//	ali_debug('','','',$_FILES);
	$errors = '';
	reset($_FILES);
	while (list($k, $v)=each($_FILES)) {
		// просто параметры 
//		echo $k."<br>";
		if (preg_match('/^parameterfile_(.*)$/', $k, $mm) ) {
				// для существующего параметра.TODO!!!! для нового тоже нужною
				$pname = $mm[1];
			//	echo 1;
				if (is_uploaded_file($_FILES[	$k	]['tmp_name'])) {
				//	echo 2;
					$s = $this->upload_file(
						$_FILES[	$k	]['tmp_name'],
						$this->param_names[$pname]['root'],
						$_FILES[	$k	]['name']
						);
					if (!$s) {
						$errors .= ' Ошибка: Не загружен файл '.$_FILES[	$k	]['name'];
						};
					if (isset($V[ 'oldparameter_'.$pname])){
						$this->update_document_param( $V[ 'oldparameter_'.$pname], $_FILES[	$k	]['name']  );
						}
					else {
						$this->add_document_param($V['document_id'], $this->param_names[ $pname ]['name'],        $_FILES[	$k	]['name'] );
						};
					};
			};
		};

	return $this->view_edit('Обновлено'.$errors);
}




private function upload_file($tmp_name, $dir, $name){
	//echo "<hr><br>$tmp_name, $dir, $name <br><hr>";
	if (is_writeable($dir)) {
		$res = move_uploaded_file($tmp_name, $dir.$name);
		if (file_exists($dir.$name) && (filesize($dir.$name)>0) ) {
		//	echo "file exists $dir$name size=".filesize($dir.$name);
			return true;
			};
		};
	return false;
	}

	
	
function change_type($error = '') {
	global $М, $V;
//	alid($V);
			$q = "
	UPDATE
		".$this->DOCUMENT_TREE."
	SET
		type = '#type#',
		updated = NOW()
	WHERE
		id = '#id#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id'=>$V['document_id'],
		'type' => $V['type'],
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
//	$V['document_id'] = $o['id'];

//	return array(
//		'status'=>true,
//		'id' => $id
//		);
	return $this->view_edit('Тип страницы изменен ');

	}






	
	
function view_edit($error = '') {
	global $М, $V, $admin_ckeditor;
	$mass_rus_assocc_key = array();

//	$model_rubric = new model_rubricator($this->m, MYSQL_DB);
//	$cms_admin = new cms_admin();

//	$mass_rub = $model_rubric->getAll();
//	$mass_rub_assocc = $model_rubric->getAllAssoccByDocID($V['document_id']);
	$d = $this->get_document($V['document_id']);
	$parent_params = $this->get_document_params($d['document']['parent_id']);
	$params = $this->get_document_params($V['document_id']);

// ali_debug('','','',$params);

	$t = new ice_templates();
	$t->set_file("page", $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER.$this->CMS_TEMPLATE_EDIT );



	$t->set_var('HTTP_BASE', HTTP_BASE);
	$t->set_var('HTTPS_BASE_ADMIN', HTTPS_BASE_ADMIN);

	$t->set_block('page', 'BLOCK.PARAMS', 'BLOCK_PARAMS');
	$t->set_block('page', 'BLOCK.IMGPARAMS', 'BLOCK_IMGPARAMS');
//	$t->set_block('page', 'BLOCK.RUBRIKATOR', 'BLOCK_RUBRIKATOR');
	$t->set_block('page', 'BLOCK.VALIDATE', 'BLOCK_VALIDATE');


	$t->set_block('page', 'BLOCK.HAVERTPARAMS', 'BLOCK_HAVERTPARAMS');
	$t->set_block('BLOCK.HAVERTPARAMS', 'BLOCK.RTPARAMS', 'BLOCK_RTPARAMS');

	$t->set_var('BLOCK_VALIDATE', '');
	$t->set_var('BLOCK_PARAMS', '');
	$t->set_var('BLOCK_IMGPARAMS', '');
//	$t->set_var('BLOCK_RUBRIKATOR', '');
	$t->set_var('BLOCK_RTPARAMS', '');
	$t->set_var('BLOCK_HAVERTPARAMS', '');

	$t->set_block('page', 'BLOCK.HAVEMULTIPARAMS', 'BLOCK_HAVEMULTIPARAMS');
	$t->set_block('BLOCK.HAVEMULTIPARAMS', 'BLOCK.MULTIPARAMS', 'BLOCK_MULTIPARAMS');
	$t->set_var('BLOCK_MULTIPARAMS', '');
	$t->set_var('BLOCK_HAVEMULTIPARAMS', '');

	$t->set_block('page', 'BLOCK.HAVEMULTICHECKS', 'BLOCK_HAVEMULTICHECKS');
	$t->set_block('BLOCK.HAVEMULTICHECKS', 'BLOCK.MULTICHECKS', 'BLOCK_MULTICHECKS');
	$t->set_var('BLOCK_MULTICHECKS', '');
	$t->set_var('BLOCK_HAVEMULTICHECKS', '');


	$t->set_var("CMS_ADMIN_NAME", CMS_ADMIN_NAME );
	$t->set_var("CMS_ADMIN_URL_BASE", CMS_ADMIN_URL_BASE);
	$t->set_var("CMS_ADMIN_IMAGES_BASE", CMS_ADMIN_IMAGES_BASE);
	$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME", htmlspecialchars($d['document']['name']) );
	$t->set_var('error', $error);
	$t->set_var("document.id", ($d['document']['id']) );
	$t->set_var("document.type", ($d['document']['type']) );
	$t->set_var("visdate", htmlspecialchars($d['document']['visdate']) );
	$t->set_var("name", htmlspecialchars($d['document']['name']) );
	$t->set_var("fullname", htmlspecialchars($d['document']['fullname']) );
	$t->set_var("url", $this->get_url_part($d['document']['url'])  );
	$t->set_var("myurl", HTTP_BASE.$d['document']['url'] );
	$t->set_var("anons", htmlspecialchars($d['document']['anons']) );
	$t->set_var("document", htmlspecialchars($d['document']['document']) );
	$t->set_var("seo_description", htmlspecialchars($d['document']['seo_description']) );
	$t->set_var("seo_keywords", htmlspecialchars($d['document']['seo_keywords']) );
	$t->set_var("seo_title", htmlspecialchars($d['document']['seo_title']) );
	$t->set_var('status',  $d['document']['status'] );
	$t->set_var('checked', ($d['document']['status']=='active')?'':'checked' );
	$t->set_var('statushiddenchecked', ($d['document']['statushidden']=='active')?'':'checked' );
	$t->set_var('created', $this->mysqltimestamp_to_date($d['document']['created']));
	$t->set_var('updated', $this->mysqltimestamp_to_date($d['document']['updated']));


	$t->set_block('page', 'BLOCK.CKEDITOR', 'BLOCK_CKEDITOR');
	$t->set_var('BLOCK_CKEDITOR', '');
	$t->set_block('page', 'BLOCK.EDITOR', 'BLOCK_EDITOR');
	$t->set_var('BLOCK_EDITOR', '');
	if (
		(isset($admin_ckeditor[		$d['document']['type']	]))
		){
		$t->parse('BLOCK_CKEDITOR', 'BLOCK.CKEDITOR', true);		
		}
	else {
		$t->parse('BLOCK_EDITOR', 'BLOCK.EDITOR', true);		
		};
	
	$t->set_block('page', 'BLOCK.ALLTYPES', 'BLOCK_ALLTYPES');
	$t->set_var('BLOCK_ALLTYPES', '');

	reset(	$this->registered_types	);
	while (list($k, $v)=each(	$this->registered_types	 )) {
		$t->set_var('ALLTYPES.id', $k   );
		$t->set_var('ALLTYPES.name',strip_tags($v) );
		$t->parse('BLOCK_ALLTYPES', 'BLOCK.ALLTYPES', true);
		}



	reset($this->param_names);
	while (list(, $v)=each($this->param_names )) {
		if ($v['type']=='other'){
			if ($v['required'] == $d['document']['type'] )	{
				//echo "<hr>";
				$t->set_var('param.description', $v['description']   );
				$t->set_var('param.name',$v['name'] );
				/*
				$t->set_var('param.rows',  
					1+intval(strlen($params['params'][ $v['name'] ]['pvalue'])/100 )  
					);
				*/
				$t->set_var('param.rows',  
				isset($params['params'][ $v['name'] ]['pvalue']) ?
					1+intval(strlen($params['params'][ $v['name'] ]['pvalue'])/100 )  
					:'1'
					);
				$t->set_var('param.value',
					(isset($params['params'][ $v['name'] ])?
					htmlspecialchars($params['params'][ $v['name'] ]['pvalue']):''
					)
					);
				$t->set_var('param.id',
					(isset($params['params'][ $v['name'] ])?
					htmlspecialchars($params['params'][ $v['name'] ]['uid']):''
					)
					);
				$t->parse('BLOCK_PARAMS', 'BLOCK.PARAMS', true);
			};
		}
	elseif ($v['type']=='radiotree'){
			if ($v['required'] == $d['document']['type'] )	{
			//  вот тут мы неочень хорошо поступим и тут же возьмем данные для формирования списка и сразу же их отрендерим. 
			$tree_param  = $this->get_childs(	$v['parent_id']	);
			//alid($tree_param);
			$t->set_var('param.description', $v['description']   );
			$t->set_var('param.old_id',
				(isset($params['params'][ $v['name'] ])?
				htmlspecialchars($params['params'][ $v['name'] ]['uid']):''
				)
				);

			$t->set_var('BLOCK_RTPARAMS','' );
			while (list($kk, $vv)=each($tree_param['catalog'] )) {
				$t->set_var('param.name',$v['name'] );
				$t->set_var('param.value',$vv['id'] );
				$t->set_var('param.help',$vv['name'] );
				$t->set_var('param.id',$vv['id']);
				$t->set_var('param.checked',  
					((isset($params['params'][ $v['name'] ]['pvalue'])) && (($params['params'][ $v['name'] ]['pvalue']) == $vv['id']))
					?" checked=checked ":''
					);
				$t->parse('BLOCK_RTPARAMS', 'BLOCK.RTPARAMS', true);
				};
			$t->parse('BLOCK_HAVERTPARAMS', 'BLOCK.HAVERTPARAMS', true);
			};
		}
	elseif ($v['type']=='multirating'){

			if ($v['required'] == $d['document']['type'] )	{
			//  вот тут мы неочень хорошо поступим и тут же возьмем данные для формирования списка и сразу же их отрендерим. 
			// сначала мы узнаем к какому 1 уровню привязана эта карточка товара,
			// узнаем применение,
			// потом сформируем список внуков этого применения
//			alid($d['document']['parent_id']);
			$d1 = $this->get_document($d['document']['parent_id']);
			$d2 = $this->get_document($d1['document']['parent_id']);
			$d3 = $this->get_document($d2['document']['parent_id']);
			$params3 = $this->get_document_params(	$d3['document']['id']	);
			//alid($params3['params']['app_id']['pvalue']);
			$tree_param  = $this->get_childs(	$params3['params']['app_id']['pvalue']	);
			$tree_param3 = array();
			while (list($kk, $vv)=each($tree_param['catalog'] )) {
				$tree_param2  = $this->get_childs(	$vv['id']	);
				while (list($kkk, $vvv)=each($tree_param2['catalog'] )) {
					$vvv['name']=$vv['name'].' '.$vvv['name'];
					$tree_param3['catalog'][] = $vvv;
					};
				};
				//alid($tree_param3);
				//alid($tree_param);
			$t->set_var('param.description', $v['description']   );
			$t->set_var('BLOCK_MULTIPARAMS','' );
			while (list($kk3, $vv3)=each($tree_param3['catalog'] )) {
//				alid($params['params']);
				$t->set_var('param.old_id',
						isset($params['params'][$v['name'].'_'.$vv3['id']]['uid'])?
						$params['params'][$v['name'].'_'.$vv3['id']]['uid']:''
						);
				$t->set_var('param.name',$v['name'].'_'.$vv3['id'] );
				//alid($params);
				$t->set_var('param.value',isset($params['params'][$v['name'].'_'.$vv3['id']]['pvalue'])?
				$params['params'][$v['name'].'_'.$vv3['id']]['pvalue']:'' );
				$t->set_var('param.help',$vv3['name'] );
				$t->set_var('param.id',$vv3['id']);
				$t->parse('BLOCK_MULTIPARAMS', 'BLOCK.MULTIPARAMS', true);
				};
			$t->parse('BLOCK_HAVEMULTIPARAMS', 'BLOCK.HAVEMULTIPARAMS', true);
			};
		}
	elseif ($v['type']=='multichecks'){

			if ($v['required'] == $d['document']['type'] )	{
			$tree_param3  = $this->get_childs(	$v['parent_id']	, 'name', 'ASC'	);
			$t->set_var('param.description', $v['description']   );
			$t->set_var('BLOCK_MULTICHECKS','' );
			while (list($kk3, $vv3)=each($tree_param3['catalog'] )) {
//				alid($params['params']);
				$t->set_var('param.old_id',
						isset($params['params'][$v['name'].'_'.$vv3['id']]['uid'])?
						$params['params'][$v['name'].'_'.$vv3['id']]['uid']:''
						);
				$t->set_var('param.name',$v['name'].'_'.$vv3['id'] );
				//alid($params);
				
				//$t->set_var('param.value',isset($params['params'][$v['name'].'_'.$vv3['id']]['pvalue'])?
				$t->set_var('param.checked',
						(
						isset($params['params'][$v['name'].'_'.$vv3['id']]['pvalue']) && 
						($params['params'][$v['name'].'_'.$vv3['id']]['pvalue'] !='')
						)
						?
						'checked':'' );
				
				$t->set_var('param.help',$vv3['name'] );
				$t->set_var('param.id',$vv3['id']);
				$t->parse('BLOCK_MULTICHECKS', 'BLOCK.MULTICHECKS', true);
				};
			$t->parse('BLOCK_HAVEMULTICHECKS', 'BLOCK.HAVEMULTICHECKS', true);
			};
		};


		
		
	};

	reset($this->param_names);
	while (list($k, $v)=each($this->param_names )) {
		if ($v['type']=='image'){
			if ($v['required'] == $d['document']['type'] )	{
				//echo "<hr>";
				$t->set_var('param.description', $v['description']   );
				$t->set_var('param.name',$k );
				$t->set_var('param.value',
					(isset($params['params'][ $v['name'] ])?
					htmlspecialchars($params['params'][ $v['name'] ]['pvalue']):''
					)
					);
				$t->set_var('param.id',
					(isset($params['params'][ $v['name'] ])?
					htmlspecialchars($params['params'][ $v['name'] ]['uid']):''
					)
					);
				$file = isset($params['params'][ $v['name'] ]['pvalue'])?$v['root'].$params['params'][ $v['name'] ]['pvalue']:'';
				$www = HTTP_BASE.$v['www'].
					(isset($params['params'][ $v['name'] ]['pvalue'])?
//					urlencode($params['params'][ $v['name'] ]['pvalue']):''
					$params['params'][ $v['name'] ]['pvalue']:''

					)
					;
				$hint =  is_file(  $file )?"<img src=$www />":'<font color=red>no file'.$file.'</font>'; 
				$t->set_var('param.hint', $hint    );
				
				$t->parse('BLOCK_IMGPARAMS', 'BLOCK.IMGPARAMS', true);
			};
		};
	};




	if (  defined('CMS_ADMIN_VALIDATE') && CMS_ADMIN_VALIDATE && ($d['document']['status'] == 'active')) {
		// валидация документов через iframe
		$t->set_var('CMS_ADMIN_VALIDATE_URL', CMS_ADMIN_VALIDATE_URL);
		$t->parse('BLOCK_VALIDATE', 'BLOCK.VALIDATE', true);
		};

	$t->parse("page", "page");
	return $t->get("page");
}
	
	
	
	
	
	
	
	
	
	
	
function get_id_and_type_for_url($url, $only_active_document=true, $only_real_document=true){
    $q = "
    SELECT
		id, type, status
    FROM
		".$this->DOCUMENT_TREE."
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




}
?>