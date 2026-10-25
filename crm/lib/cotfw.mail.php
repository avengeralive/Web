<?php
namespace lib;
########################################################
# cotfw.mail.php
#
# Библиотека для работы с отправкой писем
#
# История:	2016.10.08 - файл создан
#
########################################################
#
	class COTFW_mail	{
		
		var $receivers	= array();
		var $errors		= array();

		function _init( $static = false ) {

			include_lib( 'class.mail.phpmailer' );
			$this->mail = new \PHPMailer();

			$this->mail->CharSet = 'windows-1251';
			// $this->mail->CharSet = 'utf-8';

			init_interfaces( $this, array('template','settings') );
			$this->setIsHtmlContent( true );
			$this->setFrom( $this->settings->val('pdd_main_mailbox') );
			$this->checkExternalSmtp();

		}

		function send( $receiver = '' ) {

			unset( $this->errors );
			$this->errors = array();

			if( !empty($receiver) )
			$this->receivers = array( $receiver );

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
		function setSubject( $title )			{ $this->mail->Subject  = $title; }
		function setCharset_cp1251()			{ $this->mail->CharSet  = 'windows-1251'; }
		function setCharset_utf8()				{ $this->mail->CharSet  = 'utf-8'; }

		function setFrom( $email, $setNameRaw = true ) {
			$this->mail->From     =
			$this->mail->Sender   = $email;

			if( $setNameRaw )
				$this->mail->FromName = $email;
			else {
				@list( $login, $domain ) = explode( '@', $email );
				$this->mail->FromName = strtolower( $login );
				// $this->mail->FromName = ucfirst( $login );
				// $this->mail->FromName = $login;
			}
		}

		function clearReceiversList() {
			unset( $this->receivers );
			$this->receivers = array();
		}

		function formBody( $tpl_file, $prefix='mail/' )	{
			
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

				include_lib( 'class.mail.smtp' );

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
#
########################################################
?>