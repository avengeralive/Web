<?php
class ControllerInformationForm extends Controller {
	private $error = array();

	public function index() {

		$data['photo'] = '';
		$uploads_dir = DIR_UPLOAD;
		if (is_uploaded_file($this->request->files['photo']['tmp_name'])) {
		    move_uploaded_file($this->request->files['photo']['tmp_name'],$uploads_dir.$this->request->files['photo']['name']);
		  	$data['photo'] = $this->request->files['photo']['name'];
		}
		var_dump($data['photo']);
		
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo('office@aliveliyev.com');
		$mail->setFrom('postmaster@brs77.ru');
        $mail->setReplyTo('office@aliveliyev.com');
		$mail->setSender(html_entity_decode('aliveliyev93@gmail.com', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode(sprintf('Subject:', 'some subject'), ENT_QUOTES, 'UTF-8'));
		$mail->setText('sometext someemail');
			$mail->addAttachment('/image/catalog/brs.png');
		$mail->send();

		

		return !$this->error;
	}

}