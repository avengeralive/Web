<?php
########################################################
# 	system.mail.php
#
#	Модуль для управления отправкой сообщений
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
#
class SYSTEM_mail	{

	var $receivers	= array();
	var $errors		= array();

	function _init( $static = false ) {

		include_framework( 'class.phpmailer' );
		$this->mail = new PHPMailer();

		$this->mail->CharSet = ENC == 'UTF-8' ? 'utf-8' : 'windows-1251';

		$this->setIsHtmlContent( true );
		$this->setFrom( MAIL_FROM, MAIL_FROM_NAME );
		$this->checkExternalSmtp();

		if( !$static ) {

			$this->lists	= &$this->engine->lists;
			$this->template	= &$this->engine->template;
			$this->logs		= &$this->engine->logs;

		} else {

			global $lists, $template, $logs;

			$this->lists	= &$lists;
			$this->template	= &$template;
			$this->logs		= &$logs;

		}
		init_interfaces( $this, $static, array('lang') );

	}

	function send( $receiver = '' ) {

		unset( $this->errors );
		$this->errors = array();

		if( !empty($receiver) ) {
			if( gettype($receiver) == 'array' ) {
				$this->receivers = $receiver;
			} else {
				$try_list = explode( ';', $receiver );
				if( count($try_list) > 1 ) {
					$this->receivers = $try_list;
				} else {
					$this->receivers = array( $receiver );
				}
			}
		}

		// form receivers
		if( !empty($this->receivers) )
		foreach( $this->receivers as $email ) {

			$this->mail->ClearAddresses();
			$this->mail->AddAddress( $email );

			if( !$this->mail->Send() )
			$this->errors[] = $this->mail->ErrorInfo;

		}

		return empty( $this->errors );
	}

	function addAttach( $path,$name='' )	{ $this->mail->AddAttachment($path,$name); }
	function addReceiver( $email )			{ $this->receivers[] = $email; }
	function setIsHtmlContent( $isHtml )	{ $this->mail->IsHTML($isHtml); }
	function setBody( $text )				{ $this->mail->Body		= $text; }
	function setSubject( $title )			{ $this->mail->Subject  = $this->lists->data['lang']['mail_title_prefixes'][$this->lang->selected].$title.$this->lists->data['lang']['mail_title_postfixes'][$this->lang->selected]; }
	function setCharset_cp1251()			{ $this->mail->CharSet  = 'windows-1251'; }
	function setCharset_utf8()				{ $this->mail->CharSet  = 'utf-8'; }

	function setFrom( $email, $name='' ) {
		$this->mail->From =
		$this->mail->Sender = $email;

		if( !empty($name) ) {
			$this->mail->FromName = $name;
		}

	}

	function clearReceiversList() {
		unset( $this->receivers );
		$this->receivers = array();
	}

function formBody( $tpl_file, $prefix='../mail/'/*$prefix='mail/'*/ )	{

		$this->setBody( $this->template->fetch( $prefix.$tpl_file.'.tpl' ) );
		$this->check_themeSetFromTpl();

	}

	function check_themeSetFromTpl() {

		$try_subject = $this->template->value( 'letter_subject' );

		if( !empty($try_subject) )
		$this->setSubject( $try_subject );

	}

	function checkExternalSmtp() {

		if( !empty($GLOBALS['MAIL_CFG']['send_via_smtp']) ) {

			include_framework( 'class.smtp' );

			$cfg = &$GLOBALS['MAIL_CFG'];

			$this->mail->IsSMTP();
			$this->mail->Host		= $cfg['host'];
			$this->mail->SMTPDebug 	= $cfg['debug'];
			$this->mail->SMTPAuth	= $cfg['auth'];
			$this->mail->Port		= $cfg['port'];
			$this->mail->Username	= $cfg['username'];
			$this->mail->Password	= $cfg['password'];

			if( !empty($cfg['secure']) )
			$this->mail->SMTPSecure = $cfg['secure'];

			if( !empty($cfg['addreply']) )
			$this->mail->AddReplyTo( $cfg['addreply'], $cfg['addreply'] );

		}

	}

}

?>
