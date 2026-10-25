<?
require_once(CLASSES_BASE."admin_icms.php");

class admin_icms_link_id extends admin_icms {

function admin_icms_link_id($m) {
	$this->m = &$m;
	$this->CMS_TEMPLATE_EDIT =	"edit-link_id.html";
	$this->CMS_TEMPLATE_ADD =	"add-link_id.html";
	$this->allow_empty_url_part =	false;
}

function do_add() {
	global $М, $V;
	$o = $this->add_document_link_id(
		$V['parent_id'], $V['type'], $V['name'], 
		isset($V['status'])?'disabled':'active', 
		isset($V['statushidden'])?'hidden':'active',
		$V['url'],
		$V['nextid'] 
		);
	$V['document_id'] = $o['id'];
	return $this->show_edit();
	}


function add_document_link_id($parent_id, $type, $name, $status, $statushidden, $url, $nextid) {
global $V;

	// Создадим запись в дереве
	$o = $this->add_document_base($parent_id, $type, $name, $status, $statushidden, $url);
	$document_id = $o['id'];

	$q = "
		INSERT
			".$this->DOCUMENT_DOCS."
		SET
			id = '#id#',
			fullname = '#name#',
			status = '#status#',
			ordering = NOW(),
			updated = NOW(),
			created = NOW()
	";
	$o = $this->m->query($q, __FILE__, __LINE__,
		Array(
			'id' =>		$document_id,
			'name' =>	$name,
			'status' =>	$status
		)
	);
	if ($this->m->error) return Array('status' => false);

	$this->add_link_target($document_id, $nextid);

	return array(
		'status' =>	true,
		'id' =>		$document_id
	);
}






function view_edit($error = '') {
	global $М, $V;

	$d =	$this->get_document($V['document_id']);
	$d_p =	$this->get_document_params($V['document_id']);

	$t = new ice_templates();
	$t->set_file("page", $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER.$this->CMS_TEMPLATE_EDIT);
	$t->set_var("CMS_ADMIN_NAME",			CMS_ADMIN_NAME);
	$t->set_var("CMS_ADMIN_URL_BASE",		CMS_ADMIN_URL_BASE);
	$t->set_var("CMS_ADMIN_IMAGES_BASE",		CMS_ADMIN_IMAGES_BASE);
	$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME",	htmlspecialchars($d['document']['name']));
	$t->set_var("error",		$error);
	$t->set_var("document.id",	($d['document']['id']));
	$t->set_var("document.type",	($d['document']['type']));
	$t->set_var("name",		htmlspecialchars($d['document']['name']));
	$t->set_var("fullname",		htmlspecialchars($d['document']['fullname']));
	//$t->set_var("url",		$this->get_url_part($d['document']['url']));
	$t->set_var("url",		$d['document']['url']);
	$t->set_var("myurl",	HTTP_BASE.$d['document']['url']);

	$t->set_var("nextid",		isset($d_p['params']['nextid']['pvalue']) ? $d_p['params']['nextid']['pvalue'] : '');

	$t->set_var("status",		$d['document']['status']);
	$t->set_var("checked",		($d['document']['status'] == 'active') ? '' : 'checked');
	$t->set_var("statushiddenchecked",	($d['document']['statushidden'] == 'active') ? '' : 'checked');
	$t->set_var("created",		$this->mysqltimestamp_to_date($d['document']['created']));
	$t->set_var("updated",		$this->mysqltimestamp_to_date($d['document']['updated']));
	$t->parse("page", "page");

	return $t->get("page");
}




function show_add() {
	global $М, $V;
	if ($V['parent_id'] > 0) $o_parent = $this->get_document($V['parent_id']);
	$t = new ice_templates();
	$t->set_file("page", $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER.$this->CMS_TEMPLATE_ADD);
	$t->set_var("CMS_ADMIN_NAME",		CMS_ADMIN_NAME);
	$t->set_var("CMS_ADMIN_URL_BASE",	CMS_ADMIN_URL_BASE);
	$t->set_var("CMS_ADMIN_IMAGES_BASE",	CMS_ADMIN_IMAGES_BASE);

	$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME", ($V['parent_id'] > 0 ? htmlspecialchars($o_parent['document']['name']) : '/'));

	$t->set_var("error",			isset($V['error']) ? $V['error'] : "");
	$t->set_var("document.type",		$V['type']);
	$t->set_var("parent.id",		$V['parent_id']);
	$t->set_var("name",			$V['name']);
	$t->set_var("url",			$V['url']);
	$t->set_var("fullname",			$V['name']);
	$t->set_var("nextid",			isset($V['nextid']) ? $V['nextid'] : "");
	$t->set_var("status",			isset($V['status']) ? $V['status'] : "");
	$t->set_var("statushidden",		isset($V['statushidden']) ? $V['statushidden'] : "");
	$t->set_var("checked",			isset($V['checked']) ? $V['checked'] : "");
	$t->set_var("statushiddenchecked",	isset($V['statushiddenchecked']) ? $V['statushiddenchecked'] : "");
	$t->set_var("");
	$t->parse("page", "page");
	return $t->get("page");
}


function update_document_base($document_id, $visdate, $name, $status, $statushidden, $urlpart){
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
		'url' => $urlpart,
		'status' => $status,
		'statushidden' => $statushidden
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };

	return array(
		'status'=>true,
		'id' => $document_id
		);
	}


function do_edit() {
	global $V;
	if ($this->check_target($V['nextid'])) {
		return $this->view_edit("Документ с номером ID=".$V['nextid']." не существует. Укажите правильный номер. ");
		};

	// в самом-самом parent'е
	$o1 = $this->update_document_base(
		$V['document_id'],
		'', // kluge :)
		$V['name'],
		isset($V['status']) ? 'disabled' : 'active',
		isset($V['statushidden']) ? 'hidden' : 'active',
		$V['url']
	);

	// в общем случае разные для разных типов.
	$o2 = $this->update_document_link_id(
		$V['document_id'],
		$V['nextid']
	);


	$q = "
	UPDATE
		".$this->DOCUMENT_DOCS."
	SET
		fullname = '#fullname#',
		updated = NOW()
	WHERE
		id = '#id#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id'=>$V['document_id'],
		'fullname' => $V['fullname']
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };


	return $this->view_edit('Обновлено.');
}

function check_target($id) {
	// А есть ли id на который ссылаемся?
	$q2 = "
		SELECT
			*
		FROM
			".$this->DOCUMENT_TREE."
		WHERE
			id = '#id#'
	";
	$o2 = $this->m->selectManyRows($q2, __FILE__, __LINE__, Array('id' => $id));
	return !$this->m->numbers;
}


function update_document_link_id($document_id, $nextid) {
	$q = "
		UPDATE
			".$this->DOCUMENT_PARAMS."
		SET
			pvalue = '#nextid#'
		WHERE
			doc_id = #id#
		AND
			pname = 'nextid'
	";
	$o = $this->m->query($q, __FILE__, __LINE__,
		Array(
			'id' =>			$document_id,
			'nextid' =>		$nextid
		)
	);
	if ($this->m->error) return Array('status' => false);

	if ($this->m->rows == 0) $this->add_link_target($document_id, $nextid);

	return array(
		'status' =>	true,
		'id' =>		$document_id
	);
}


/*
//function show_add($parent_id, $type, $name, $status, $statushidden, $url, $error = "") {
function show_add() {
	global $М, $V;
	if ($V['parent_id'] > 0) $o_parent = $this->get_document($V['parent_id']);
	$t = new ice_templates();
	$t->set_file("page", $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER.$this->CMS_TEMPLATE_ADD);
	$t->set_var("CMS_ADMIN_NAME",		CMS_ADMIN_NAME);
	$t->set_var("CMS_ADMIN_URL_BASE",	CMS_ADMIN_URL_BASE);
	$t->set_var("CMS_ADMIN_IMAGES_BASE",	CMS_ADMIN_IMAGES_BASE);

	$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME", ($V['parent_id'] > 0 ? htmlspecialchars($o_parent['document']['name']) : '/'));

	$t->set_var("error",			$error);
	$t->set_var("document.type",		$V['type']);
	$t->set_var("parent.id",		$V['parent_id']);
	$t->set_var("name",			$V['name']);
	$t->set_var("url",			$V['url']);
	$t->set_var("fullname",			$V['name']);
	$t->set_var("nextid",			isset($V['nextid']) ? $V['nextid'] : "");
	$t->set_var("status",			isset($V['status']) ? $V['status'] : "");
	$t->set_var("statushidden",		isset($V['statushidden']) ? $V['statushidden'] : "");
	$t->set_var("checked",			isset($V['checked']) ? $V['checked'] : "");
	$t->set_var("statushiddenchecked",	isset($V['statushiddenchecked']) ? $V['statushiddenchecked'] : "");
	$t->set_var("");
	$t->parse("page", "page");
	return $t->get("page");
}
*/

/*
function add_document($parent_id, $type, $name, $title, $status, $statushidden, $url, $nextid) {
	// Создадим запись в дереве
	$o = $this->add_document_base($parent_id, $type, $name, $status, $statushidden, $url);
	$document_id = $o['id'];

	$q = "
		INSERT
			".$this->DOCUMENT_DOCS."
		SET
			id = '#id#',
			fullname = '#name#',
			seo_title = '#title#',
			status = '#status#',
			ordering = NOW(),
			updated = NOW(),
			created = NOW()
	";
	$o = $this->m->query($q, __FILE__, __LINE__,
		Array(
			'id' =>		$document_id,
			'name' =>	$name,
			'title' =>	$title,
			'status' =>	$status
		)
	);
	if ($this->m->error) return Array('status' => false);

	$this->add_link_target($document_id, $nextid);

	return array(
		'status' =>	true,
		'id' =>		$document_id
	);
}
*/


// Добавление ссылки
function add_link_target($document_id, $nextid) {
	$q2 = "
		INSERT
			".$this->DOCUMENT_PARAMS."
		SET
			doc_id = '#id#',
			pname = 'nextid',
			pvalue = '#nextid#'
	";
	$o2 = $this->m->query($q2, __FILE__, __LINE__,
		Array(
			'id' =>		$document_id,
			'nextid' =>	$nextid
		)
	);

	if ($this->m->error) return Array('status' => false);
}




/*
function check_target($id) {
	// А есть ли id на который ссылаемся?
	$q2 = "
		SELECT
			*
		FROM
			".$this->DOCUMENT_TREE."
		WHERE
			id = '#id#'
	";
	$o2 = $this->m->selectManyRows($q2, __FILE__, __LINE__, Array('id' => $id));
	return !$this->m->numbers;
}
*/

/*
function add() {
	global $М, $V;
	if ($this->check_target($V['nextid'])) $this->show_add(0, 0, 0, 0, 0, 0, "Страница не создана... ибо нет того документа, на который нужно сослаться");

	$o = $this->add_document_base(
		$V['parent_id'],
		$V['type'],
		$V['name'],
		isset($V['status']) ? 'disabled' : 'active',
		isset($V['statushidden']) ? 'hidden' : 'active',
		$V['url']
	);
	
	$o = $this->add_document(
		$V['parent_id'],
		$V['type'],
		$V['name'],
		$V['seo_title'], 
		isset($V['status']) ? 'disabled' : 'active', 
		isset($V['statushidden']) ? 'hidden' : 'active',
		$V['url'],
		$V['nextid']
	);
	$V['document_id'] = $o['id'];
	return $this->show_edit();
}
*/

/*
*/

/*
*/


/*
function update_document_base($document_id, $visdate, $name, $status, $statushidden, $urlpart){
	$o_last = $this->get_document_base($document_id);
	$o_parent = $this->get_document_base($o_last['document']['parent_id']);

	if ($urlpart == '' & $this->allow_empty_url_part) {
		$url = $o_parent['document']['url'];
	} elseif ($urlpart == '' & !$this->allow_empty_url_part) {
		$url = $o_parent['document']['url'].$id.'/';
	} else {
		$url = $urlpart;
	}

	$q = "
		UPDATE
			".$this->DOCUMENT_TREE."
		SET
			name = '#name#',
			url  = '#url#',
			status = '#status#',
			statushidden = '#statushidden#',
			updated = NOW()
		WHERE
			id = '#id#'
	";
	$o = $this->m->query($q, __FILE__, __LINE__,
		Array(
			'id' =>			$document_id,
			'name' =>		$name,
			'url' =>		$urlpart,
			'status' =>		$status,
			'statushidden' =>	$statushidden
		)
	);
	if ($this->m->error) return Array('status' => false);

	if ($o_last['document']['url'] !== $url) {
		$this->update_childs_url(
			$o_last['document']['url'],   // from
			$url                          // to
		);
	}

	return array(
		'status' =>	true,
		'id' =>		$document_id
	);
}
*/

/*
*/
/*
function get_document($document_id) {
	$q = "
		SELECT
			doc.*,
			tree.*
		FROM
			".$this->DOCUMENT_DOCS." as doc
		LEFT JOIN
			".$this->DOCUMENT_TREE." as tree
		ON 
			doc.id = tree.id
		WHERE
			doc.id = '#document_id#'
	";
	$o = $this->m->selectOneRow($q, __FILE__, __LINE__, Array('document_id' => $document_id));
	if ($this->m->error) return Array('status' => false);

	return array(
		'status' =>	true,
		'document' =>	$o
	);
}
*/
/*
function get_document_params($document_id) {
	$q = "
		SELECT
			*
		FROM
			".$this->DOCUMENT_PARAMS."
		WHERE
			doc_id = #document_id#
	";
	$o = $this->m->selectManyRowsByID($q, 'pname', __FILE__, __LINE__, Array('document_id' => $document_id));

	if ($this->m->error) return Array('status' => false);
	return Array(
		'status' =>	true,
		'params' =>	$o
	);
}
*/

}
?>
