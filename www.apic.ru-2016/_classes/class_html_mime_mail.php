<?

ini_set('include_path', CLASSES_BASE.'PEAR/');
require_once CLASSES_BASE.'PEAR/Mail.php';

class html_mime_mail {


/*
Отослать текстовое письмо.
@param $email      - мыло получателя
@param $subj       - тема письма
@param $body       - текст письма в txt
@param $from_email - от какого мыла шлем
@param $from_name  - от какого имени шлем - не используется ;=)
@param $reply_to  - reply-to кому отвечать на письмо
*/
static function sendTxtMail($email, $subj='', $body='', $from_email='', $from_name='', $reply_to='') {
	$subj = preg_replace("/[\r|\n]/", '', $subj);
	//// PEAR CODE

//	$mm = Mail::factory('smtp', array('host'=>SMTP_SERVER, 'port'=>25, 5)	);
//	$mm = Mail::factory('smtp', array('host'=>SMTP_SERVER, 'port'=>25, 'auth'=>true, 'username'=>'robot@pomo.ru', 'password'=>'178723111',  5)	);

	$mm = Mail::factory('sendmail');

//	$mm->debug = true;

//	$subj =  convert_cyr_string ($subj, 'w', 'k');
//	$body =  convert_cyr_string ($body, 'w', 'k');

	$subj =  iconv ('windows-1251','UTF-8', $subj);
	$body =  iconv ('windows-1251','UTF-8', $body);
	$headers['From']    = $from_email;
	$headers['To']      = $email;
	$headers['Subject'] = "=?utf-8?B?" . base64_encode($subj) . "?=";
	$headers['Reply-to'] = $reply_to;
	$headers['Content-Type'] = 'text/plain; charset="UTF-8"';

	$status =  $mm->send($email, $headers, $body);

//	var_dump($mm);
//	var_dump($status);

	if ((!is_object($status)) && ($status) ) {
		return array(
			'status'=>true
			);
		}
	else {
		// shit happens
		return array(
			'status'=>false,
			'pear_result'=>$status
			);
		};
	}


/*
Отослать текстовое письмо  и прикрепить один бинарный файл.
@param $email      - мыло получателя
@param $filename   - путь к файлу который отошлем
@param $subj       - тема письма
@param $body       - текст письма
@param $from_email - от какого мыла шлем
@param $from_name  - от какого имени шлем - не используется ;=)
@param $reply_to  - reply-to кому отвечать на письмо
*/
static function sendTxtMailAndAttachment($email, $filename, $subj='', $body='', $from_email='', $from_name='', $reply_to) {

	require_once CLASSES_BASE.'PEAR/Mail/mime.php';
//	require_once CLASSES_BASE.'PEAR/Mail/fmime.php';


	$subj = preg_replace("/[\r|\n]/", '', $subj);
	//// PEAR CODE
//	$mm = Mail::factory('smtp', array('host'=>SMTP_SERVER,	'port'=>25)	);
	$mm = Mail::factory('sendmail');

//	$subj =  convert_cyr_string ($subj, 'w', 'k');
//	$body =  convert_cyr_string ($body, 'w', 'k');
	$subj =  iconv ('windows-1251','UTF-8', $subj);
	$body =  iconv ('windows-1251','UTF-8', $body);

	$headers['From']    = $from_email;
	$headers['To']      = $email;
//	$headers['Subject'] = "=?windows-1251?b?" . base64_encode($subj) . "?=";
//	$headers['Reply-to'] = $from_email;
//	$headers['Content-Type'] = 'text/plain; charset="windows-1251"';
	$headers['Subject'] = "=?utf-8?B?" . base64_encode($subj) . "?=";
	$headers['Reply-to'] = $reply_to;
	$headers['Content-Type'] = 'text/plain; charset="UTF-8"';

	$mime = new Mail_mime("\n");                // ВАЖНО :-)
	$mime->setTXTBody($body);
	
	foreach($filename as $v) {
	        $mime->addAttachment($v);
	}
	
	$body_mime = $mime->get(
			array (
				'text_charset'=>'UTF-8',
				'head_charset'=>'UTF-8'
				)
			);
	$hdrs_mime = $mime->headers(	$headers	);	

	$status =  $mm->send($email,  $hdrs_mime , $body_mime );
	if ((!is_object($status)) && ($status) ) {
		return array(
			'status'=>true
			);
		}
	else {
		// shit happens
		return array(
			'status'=>false,
			'pear_result'=>$status
			);
		};
	}



/*
Отослать HTML письмо .
@param $email      - мыло получателя
@param $subj       - тема письма
@param $text       - текст письм
@param $html       - текст письма в html
@param $from_email - от какого мыла шлем
@param $from_name  - от какого имени шлем - не используется ;=)
@param $reply_to  - reply-to кому отвечать на письмо
*/
static function sendHTMLMail($email, $subj='', $text='', $html='', $from_email='', $from_name='', $reply_to) {
	require_once CLASSES_BASE.'PEAR/Mail/mime.php';
//	require_once CLASSES_BASE.'PEAR/Mail/fmime.php';
	$crlf = "\n";

	$subj =  iconv ('windows-1251','UTF-8', $subj);
	$html =  iconv ('windows-1251','UTF-8', $html);

	$hdrs = array(
              'From'    => $from_email,
              'To'    => $email,
              'Reply-to'    => $reply_to,
              'Subject' => 	"=?utf-8?b?" . base64_encode($subj) . "?=",
              'html_charset'  => 'UTF-8',
              'text_charset'  => 'UTF-8',
              'head_charset'  => 'UTF-8'
              );


	$mime = new Mail_mime($crlf);

	$mime->setTXTBody($text);
	$mime->setHTMLBody( $html );
	$body = $mime->get($hdrs);
	$hdrs = $mime->headers($hdrs);

//	$mm = Mail::factory('smtp', array( 'host'=>SMTP_SERVER, 'port'=>25) );
	$mm = Mail::factory('sendmail');

	$status =  $mm->send($email, $hdrs, $body);
	if ((!is_object($status)) && ($status) ) {
		return array(
			'status'=>true
			);
		}
	else {
		// shit happens
		return array(
			'status'=>false,
			'pear_result'=>$status
			);
		};
}


}

?>
