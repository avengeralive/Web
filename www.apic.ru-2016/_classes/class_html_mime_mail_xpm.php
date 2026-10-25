<?

define('DISPLAY_XPM4_ERRORS', true); // display XPM4 errors
require_once '/path-to/MAIL.php'; // path to 'MAIL.php' file from XPM4 package

//ini_set('include_path', CLASSES_BASE.'PEAR/');
//require_once CLASSES_BASE.'PEAR/Mail.php';

require_once CLASSES_BASE.'XPM/MAIL.php';

class html_mime_mail {





static function sendTxtMail($email, $subj='', $body='', $from_email='', $from_name='') {
	$subj = preg_replace("/[\r|\n]/", '', $subj);
	//// PEAR CODE
/*
	$mm = Mail::factory('smtp', array('host'=>SMTP_SERVER, 'port'=>25, 5)	);

	$subj =  convert_cyr_string ($subj, 'w', 'k');
	$body =  convert_cyr_string ($body, 'w', 'k');
	$headers['From']    = $from_email;
	$headers['To']      = $email;
	$headers['Subject'] = "=?koi8-r?b?" . base64_encode($subj) . "?=";
	$headers['Reply-to'] = $from_email;
	$headers['Content-Type'] = 'text/plain; charset="koi8-r"';
*/
$m = new MAIL; // initialize MAIL class
$m->From($from_email); // set from address
$m->AddTo($email); // add to address
$m->Subject($subj); // set subject
$m->Text('Text message.'); // set text message
// connect to MTA server 'smtp.hostname.net' port '25' with authentication: 'username'/'password'
$c = $m->Connect('smtp.hostname.net', 25, 'username', 'password') or die(print_r($m->Result));
// send mail relay using the '$c' resource connection
echo $m->Send($c) ? 'Mail sent !' : 'Error !';
$m->Disconnect(); // disconnect from server
print_r($m->History); // optional, for debugging

	$status =  $mm->send($email, $headers, $body);
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
*/
static function sendTxtMailAndAttachment($email, $filename, $subj='', $body='', $from_email='', $from_name='') {

	require_once CLASSES_BASE.'PEAR/Mail/mime.php';
	require_once CLASSES_BASE.'PEAR/Mail/fmime.php';


	$subj = preg_replace("/[\r|\n]/", '', $subj);
	//// PEAR CODE
	$mm = Mail::factory('smtp', array('host'=>SMTP_SERVER,	'port'=>25)	);
	$subj =  convert_cyr_string ($subj, 'w', 'k');
	$body =  convert_cyr_string ($body, 'w', 'k');

	$headers['From']    = $from_email;
	$headers['To']      = $email;
	$headers['Subject'] = "=?koi8-r?b?" . base64_encode($subj) . "?=";
	$headers['Reply-to'] = $from_email;
	$headers['Content-Type'] = 'text/plain; charset="koi8-r"';

	$mime = new fMail_mime("\n");                // ВАЖНО :-)
	$mime->setTXTBody($body);
	
	foreach($filename as $v) {
	        $mime->addAttachment($v);
	}
	
	$body_mime = $mime->get(
			array (
				'text_charset'=>'koi8-r',
				'head_charset'=>'koi8-r'
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



static function sendHTMLMail($email, $subj='', $text='', $html='', $from_email='', $from_name='') {
	require_once CLASSES_BASE.'PEAR/Mail/mime.php';
	require_once CLASSES_BASE.'PEAR/Mail/fmime.php';
	$crlf = "\n";
	$hdrs = array(
              'From'    => $from_email,
              'To'    => $email,
              'Subject' => 	"=?koi8-r?b?" . base64_encode($subj) . "?=",
              'html_charset'  => 'windows-1251',
              'text_charset'  => 'windows-1251',
              'head_charset'  => 'windows-1251'
              );

	$mime = new fMail_mime($crlf);

	$mime->setTXTBody($text);
	$mime->setHTMLBody( $html );
	$body = $mime->get($hdrs);
	$hdrs = $mime->headers($hdrs);

	$mm = Mail::factory('smtp', array( 'host'=>SMTP_SERVER, 'port'=>25) );
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
