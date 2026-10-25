<?
require_once(CLASSES_BASE.'admin_icms.php');

class admin_icms_link_static extends admin_icms{
function admin_icms_link_static($m) {
		$this->m = &$m;
		$this->CMS_TEMPLATE_EDIT = "edit-link_static.html";
		$this->CMS_TEMPLATE_ADD  = "add-link_static.html";
		$this->allow_empty_url_part = false;
        }





function view_edit($error = '') {
    global $V;
	$d = $this->get_document($V['document_id']);
	$t = new ice_templates();
	$t->set_file("page", $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER.$this->CMS_TEMPLATE_EDIT );
	$t->set_var("CMS_ADMIN_NAME", CMS_ADMIN_NAME );
	$t->set_var("CMS_ADMIN_URL_BASE", CMS_ADMIN_URL_BASE);
	$t->set_var("CMS_ADMIN_IMAGES_BASE", CMS_ADMIN_IMAGES_BASE);
	$t->set_var("CMS_ADMIN_CURRENT_PAGE_NAME", htmlspecialchars($d['document']['name']) );
	$t->set_var('error', $error);
	$t->set_var("document.id", ($d['document']['id']) );
	$t->set_var("document.type", ($d['document']['type']) );
	$t->set_var("visdate", ($d['document']['visdate']) );
	$t->set_var("name", htmlspecialchars($d['document']['name']) );
	$t->set_var("fullname", htmlspecialchars($d['document']['fullname']) );
	$t->set_var("url", $d['document']['url']  );
	$t->set_var("myurl", $d['document']['url'] );
	$t->set_var("anons", htmlspecialchars($d['document']['anons']) );
	$t->set_var("document", '' );
	$t->set_var("seo_description", '' );
	$t->set_var("seo_keywords", '' );
	$t->set_var("seo_title", '' );
	$t->set_var('status',  $d['document']['status'] );
	$t->set_var('checked', ($d['document']['status']=='active')?'':'checked' );
	$t->set_var('statushiddenchecked', ($d['document']['statushidden']=='active')?'':'checked' );
	$t->set_var('created', $this->mysqltimestamp_to_date($d['document']['created']));
	$t->set_var('updated', $this->mysqltimestamp_to_date($d['document']['updated']));
	$t->parse("page","page");
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

}
?>