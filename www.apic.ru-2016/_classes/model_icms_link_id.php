<?
require_once(CLASSES_BASE."model_icms.php");

class model_icms_link_id extends model_icms{

function get_object_by_id($id) {
	// узнаем на кого стоит hardlink
	$o_param = $this->get_document_params($id);
	if (!isset($o_param['params']['nextid']['pvalue'])) {
		trigger_error(E_USER_NOTICE, 'Cant determine my real id');
		return false;
		};
	$obb = $this->get_object_base( $o_param['params']['nextid']['pvalue'] );
	// получаем обьект
	$fact = new factory_model_icms($this->m);
	$me = $fact->get_me($obb['object']['type']);
	$obj = $me->get_object_by_id( $o_param['params']['nextid']['pvalue'] );
	// подставляем тип, чтобы view знал как рисовать и перепопределяем название
	$o = $this->get_object_base($id);
	$obj['object']['fullname'] = $o['object']['fullname'];
	$obj['type'] = $obb['object']['type'];
	return $obj;
	}
}
?>