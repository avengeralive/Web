<?
require_once(CLASSES_BASE.'model_icms_proto.php');
require_once(CLASSES_BASE.'model_trigger.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_html_mime_mail.php');

class model_icms_form extends model_icms_proto{
var $trigger_name = NULL;
var $emails = NULL;
var $forms = NULL;
var $user = array();

function get_object_by_id($id) {
//	global $V, $_REQUEST, $SPHINX_INDEXES, $SPHINX_GROUPS;
	global $V,$HTTP_POST_VARS,$HTTP_GET_VARS;
//	alid($V['action']);
//  alid($_POST);

if (isset($HTTP_POST_VARS['action'])) {
	$ID = $HTTP_POST_VARS['action'];
	$this->V = $HTTP_POST_VARS;
	}
elseif (isset($HTTP_GET_VARS['action'])) {
	$ID = $HTTP_GET_VARS['action'];
	$this->V = $HTTP_GET_VARS;
	}
else {
	$ID = 'index';
	$this->V = $V;
	};

	//alid($V);

	$o_base =    $this->get_object_base($id);
	$this->o_base =    $o_base;
	$o_param = $this->get_document_params($id);
	$o_menu = $this->down_level_menu(	$this->_get_menu_tree($o_base['object'])	);
	$o_nav =   $this->get_document_navigation($o_base['object']['id'],$o_base['object']['name']);

	$is_request=false;
	$request=array();
	if (isset($_POST['action'])){
		$is_request=true;
		$request=$_POST;
		};
	
	$this->_get_object_seo(&$o_base);
	$o_b1 =    $this->get_object_base(ID_BANNERS_ALL_LEFT); 
	$o_b2 =    $this->get_object_base(ID_BANNERS_ALL_TOP); 
	$o_b3 =    $this->get_object_base(ID_BANNERS_ALL_BOTTOM); 
	$o_b4 =    $this->get_object_base(ID_BANNERS_INDEX_MIDDLE); 
	$o_b5 =    $this->get_object_base(ID_BANNERS_NAV_LEFT); 
	$o_b6 =    $this->get_object_base(ID_BANNERS_CNT_BOTTOM); 
	
switch($ID){
	case "index":
		$object = $this->index();
		break;
	case "process":
		$object = $this->process();
		break;
	case "ok":
		$object = $this->ok();
		break;
	case "error":
		$object = $this->error();
		break;
	default:
		$object = $this->index();
		break;
	};

    return Array(
        'status'=>true,
		'is_request'=>$is_request,
		'request'=>$request,
        'object'=>$o_base['object'],
        'b1'=>$o_b1['object'],
        'b2'=>$o_b2['object'],
        'b3'=>$o_b3['object'],
        'b4'=>$o_b4['object'],
        'b5'=>$o_b5['object'],
        'b6'=>$o_b6['object'],
		'navigation'=>$o_nav['navigation'],
		'menu'=>$o_menu,
		'params'=>$o_param['params'],
        'ID'=>$ID,
		'obj'=>$object
        );
	}



function ok(){
	return array(
		'status'=>true,
		'ID'=>'ok'
		);
	}

function error(){
	return array(
		'status'=>true,
		'user'=>$this->user,
		'ID'=>'error'
		);
	}


/*
// показать что 
function index(){
	return array(
		'status'=>true,
		'user'=>array(
			'company'=>'',
			'contact'=>'',
			'phone'=>'',
			'square'=>'',
			'phone'=>'',
			'comments'=>'',
			'email'=>''
			),
		);
	}
*/
// показать что 
function index(){
	return array(
		'status'=>true,
		'user'=>$this->user,
		);
	}

	
function process(){
	global $V, $m, $INTERFACE, $HTTP_POST_VARS;
	$errors = '';
	$o_user_form = array();
	$o_user_form_error = array();
	while (list($k, $v) = each($INTERFACE[$this->forms]['order'])) {
		if (
			isset($HTTP_POST_VARS[$k]) &&
			preg_match("<".$v['regexp'].">m", $HTTP_POST_VARS[$k]) 
			) {
			// ok
			$o_user_form[$k] = $HTTP_POST_VARS[$k];
			$o_user_form_error[$k.'_err'] = '';
			}
		else {
			// err
			$errors .= "".$v['message']."";
//			$o_user_form[$k] = '';  // надо показать все же
			$o_user_form[$k] = $HTTP_POST_VARS[$k];  // надо показать все же
			$o_user_form_error[$k.'_err'] = $v['message'];
			};
		};
	if (strlen($errors)>0) {
		// есть ошибки. 
		return array(
			'status'=>true,
			'user'=>$o_user_form,
			'errors'=>$errors
			);
		};
	// отпарсим и пошлем письмо администрации
	$this->_send_email_to_admin(&$o_user_form);
	$trigger = new model_trigger($this->m);
	$t = $trigger->call_trigger($this->trigger_name, $o_user_form );
	//alid($t);
	Header("Location: ".$this->o_base['object']['url']."?action=ok&".md5(time()) );
	exit();
	}










function _send_email_to_admin($o_user_form){
	global $EMAILS,$INTERFACE;
	$t = new ice_templates();
	$t->set_file("page", TEMPLATES_ROOT.$INTERFACE[$this->forms]['template']);
	reset($o_user_form);
	while (list($k, $v)=each($o_user_form)) {
		$t->set_var($k, $v );
		};
	$t->parse("page","page");
	$mail_user_body =  $t->get("page");
	while (list($kk, $vv)=each($EMAILS[	$this->emails	])) {
			html_mime_mail::sendTxtMail(
				$vv, 
				$INTERFACE[$this->forms]['subject'].$o_user_form['company'],
				$mail_user_body,
				'request@climatexpo.ru',
				'request@climatexpo.ru',
				''
				);
			};

	}



}
?>