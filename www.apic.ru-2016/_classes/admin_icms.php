<?
require_once(CLASSES_BASE.'admin_icms_proto.php');
class admin_icms extends admin_icms_proto {

		var $banners_types = array(
			);

        var $folders_price_type=array(
        'folder_cat_type'
    	    );

		var $CMS_TEMPLATE_EDIT = "edit-proto.html";
		var $CMS_TEMPLATE_ADD  = "add-proto.html";
		var $allow_empty_url_part = false;


function admin_icms($m, $MYSQL_DB=NULL) {
		global 	$param_names, $folders_type, $registered_types;

		if ($MYSQL_DB==NULL) {
			$MYSQL_DB = MYSQL_DB;
			};
		$this->m = &$m;

		$this->param_names = $param_names;
		$this->folders_type = $folders_type;
		$this->registered_types = $registered_types;

		$this->DOCUMENT_TREE                  = $MYSQL_DB.'.tree';                 // таблица
		 $this->DOCUMENT_DOCS                  = $MYSQL_DB.'.docs';                 // таблица
		 $this->DOCUMENT_PARAMS                = $MYSQL_DB.'.params';                 // таблица
		 $this->DOCUMENT_SYNC   		= MYSQL_DB.'.syncrule';        // !!! константа а не переменная 
         $this->DOCUMENT_TEMPLATES_ADMIN_FOLDER = DOCUMENT_TEMPLATES_ADMIN_FOLDER;// шаблоны админки
        }



}
?>