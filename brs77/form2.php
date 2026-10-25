<?php
class ControllerInformationForm2 extends Controller {
	private $error = array();

	public function index() {

		//var_dump($_POST);
		
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo('zap@brs77.ru');
		$mail->setFrom('postmaster@brs77.ru');
        $mail->setReplyTo('zap@brs77.ru');
		$mail->setSender(html_entity_decode('postmaster@brs77.ru', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode(sprintf('Subject:', 'Подбор запчасти по VIN'), ENT_QUOTES, 'UTF-8'));
		$mail->setText('
Имя: '.$_POST['name'].'
Телефон: '.$_POST['phone'].'
Мейл: '.$_POST['email'].'
Модель: '.$_POST['car_model'].'
Вин: '.$_POST['vin'].'
Детали: '.$_POST['zap'].'
Оригинал/не оригинал: '.$_POST['orig'].'
Б/у: '.$_POST['bu'].'
		');

		$mail->send();

		header('Location: http://zap.brs77.ru/');


		return !$this->error;
	}

}