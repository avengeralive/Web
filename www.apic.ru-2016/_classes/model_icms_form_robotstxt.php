<?
require_once(CLASSES_BASE.'model_icms_proto.php');
class model_icms_form_robotstxt extends model_icms_proto{
function get_object_by_id($id) {
	global $V, $_POST;
	$o_base =    $this->get_object_base($id);
    return Array(
        'status'=>true,
        'object'=>$o_base['object'],
        );
	}
}
?>