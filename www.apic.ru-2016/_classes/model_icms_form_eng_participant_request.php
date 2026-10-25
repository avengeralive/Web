<?
require_once(CLASSES_BASE.'model_icms_form.php');
require_once(CLASSES_BASE.'model_trigger.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_html_mime_mail.php');
class model_icms_form_eng_participant_request extends model_icms_form{

var $trigger_name = 'member_registration_request_eng';
var $emails = 'part';
var $forms = 'participant_request_eng';
var $user = array(
			'company'=>'',
			'contact'=>'',
			'phone'=>'',
			'square'=>'',
			'phone'=>'',
			'comments'=>'',
			'email'=>''
			);


}
?>
