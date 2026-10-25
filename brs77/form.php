<?php
class ControllerInformationForm extends Controller {
	private $error = array();

	public function index() {

		$data['photo'] = '';
		if (isset($this->request->files['photo']['tmp_name'])) {
		$uploads_dir = DIR_UPLOAD;
		if (is_uploaded_file($this->request->files['photo']['tmp_name'])) {
		    move_uploaded_file($this->request->files['photo']['tmp_name'],$uploads_dir.$this->request->files['photo']['name']);
		  	$data['photo'] = $this->request->files['photo']['name'];
		}
		//$data['photo'] = $this->request->files['photo']['name'];
}
		if (!isset($_POST['description'])) $_POST['description'] = '';
		if (!isset($_POST['vin'])) $_POST['vin'] = '';
		//var_dump($data['photo']);
		
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo('servis@brs77.ru');
		$mail->setFrom('postmaster@brs77.ru');
        $mail->setReplyTo('servis@brs77.ru');
		$mail->setSender(html_entity_decode('postmaster@brs77.ru', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode(sprintf('Subject:', 'some subject'), ENT_QUOTES, 'UTF-8'));
		$mail->setText('
Имя: '.$_POST['name'].'
Телефон: '.$_POST['phone'].'
Мейл: '.$_POST['email'].'
Модель: '.$_POST['car_model'].'
Описание: '.$_POST['description'].'
Вин: '.$_POST['vin'].'
Фотка: http://zap.brs77.ru/storage/upload/'.$data['photo'].'
			');
			$mail->addAttachment('/image/catalog/brs.png');
		$mail->send();

		
header('Location: http://zap.brs77.ru/');
		return !$this->error;
	}

}