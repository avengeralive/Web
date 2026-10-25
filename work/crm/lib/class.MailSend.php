<?php
namespace lib;


if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

/**
 * class.MailSend.php
 *
 * Класс - библеотека отправки емейл сообщений средствами PHPMailer
 * подгружается через автоподгрузку классов
 *
 * История:  2017.07.20 - файл создан
 *
 **/
include_once __DIR__ . '/class.mail.phpmailer.php';
include_once __DIR__ . '/class.mail.smtp.php';

class MailSend extends \PHPMailer
{
	public function __construct( $fromemail, $fromname = '' )
	{
		parent::__construct( false );
		$this->XMailer = 'PHP/'.phpversion();
		$this->SetLanguage( 'ru' );
		$this->CharSet = 'UTF-8';
		$this->SetFrom( $fromemail, $fromname );

		$this->isSMTP();
		$this->Host = 'localhost';

//		$this->Host = 'smtp.yandex.ru';
//		$this->Port = 465;
//		$this->SMTPSecure = 'ssl';
//		$this->SMTPAuth = true;
//		$this->Username = $fromemail;
//		$this->Password = '';

// Отключено, тк DKIM подпись формируется средствами Exim
//		$this->Hostname = 'dkim.appcars.ru';
//		$this->DKIM_domain = 'appcars.ru';
//		$this->DKIM_selector = 'dkim';
//		$this->DKIM_private = DKIMFILE;
//		#$this->DKIM_private_string = DKIMPEMSTRING;
	}
	public function mail()
	{
		$result = $this->send();
		if ( ini_get('mail.log') )
		{
			$caller = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : __FILE__.':'.__LINE__;
			file_put_contents( ini_get('mail.log'), date('Y-m-d H:i:s').' MailSend() on ['.$caller.']: To: '.implode(' ',array_keys($this->all_recipients)).' From: '.$this->From.' Status: '.($this->ErrorInfo?$this->ErrorInfo:'OK')."\n", FILE_APPEND );
		}
		return $result;
	}
	public function MailSend( $tmpl_id, $data )
	{
		// Константы для шаблона
		$data['sitename'] = DOMAIN;
		// Чтение шаблона из базы
		$q = JBase::Query( "SELECT * FROM `email` WHERE `domain_id`=" . (int)$tmpl_id . " AND `domain` = '".DOMAIN."' LIMIT 1" );
		if ( $q && $data['email'] )
		{
			$tmpl = $q->fetch_assoc();
			$tmpl['body'] = preg_replace_callback( '/\{\{(\w+)\}\}/', function($name)use($data){return $data[strtolower($name[1])];}, $tmpl['html'] );
			$this->clearAllRecipients();
			$this->AddAddress( $data['email'] );
			$this->Subject = $tmpl['name'];
			$this->msgHTML( $tmpl['body'] );
			//$this->addAttachment('filename');
			return $this->mail();
		}
	}
}
?>