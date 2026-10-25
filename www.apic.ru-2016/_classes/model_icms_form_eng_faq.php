<?
require_once(CLASSES_BASE.'model_icms_form.php');
require_once(CLASSES_BASE.'model_trigger.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_html_mime_mail.php');

class model_icms_form_eng_faq extends model_icms_form{
var $trigger_name = 'faq';
var $emails = 'faq';
var $forms = 'faq';
var $user = array(
			'contact'=>'',
			'city'=>'',
			'comments'=>'',
			'email'=>''
			);

}
?>