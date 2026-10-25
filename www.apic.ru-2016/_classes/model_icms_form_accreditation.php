<?
require_once(CLASSES_BASE.'model_icms_form.php');
require_once(CLASSES_BASE.'model_trigger.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_html_mime_mail.php');

class model_icms_form_accreditation extends model_icms_form{
var $trigger_name = 'member_accreditation';
var $emails = 'accreditation';
var $forms = 'accreditation';
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