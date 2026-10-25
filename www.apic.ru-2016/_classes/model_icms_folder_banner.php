<?
require_once(CLASSES_BASE.'model_icms_proto.php');
class model_icms_folder_banner extends model_icms_proto{

function get_object_by_id($id) {
	$o_base =    $this->get_object_base($id); 
	$o_param = $this->get_document_params($id);
	$this->_get_object_seo(&$o_base);
    $return = Array(
        'status'=>true,
        'object'=>$o_base['object'],
		'params'=>$o_param['params']
        );
	return $return;
	}

}
?>