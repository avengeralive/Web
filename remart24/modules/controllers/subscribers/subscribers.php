<?php


/**
 * @package    MVC
 *
 * @copyright  Copyright (C) 2014  Rinat Gazikhanov, Vusal Khalilov, BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
class cSubscribers extends controller
{
    public function getMailingForm()
	{
        $subscribers = Loader::gi()->callModule('GET', 'subscribers');
		$this->data['subscribers'] = $subscribers['items'];
		
        $this->data['view_name'] = 'mailingForm';
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}	
	
	public function sendMail()
	{
		$form_values = json_decode($this->data['request']->parameters['form_values'], true);
		$files = json_decode($this->data['request']->parameters['files'], true);
		
		$subject = $form_values['title'];
		$file_names = array();
		$attachments = array();
		
		if (!empty($files))
		{
			foreach ($files as $file)
			{
				$file_names[] = $file['name'];
				$attachments[] = chunk_split(base64_encode(file_get_contents(Backstage::gi()->MATERIALS_DIR.'temp/files/'.session_id().'/'.$file['name'])));
			}
		}
		$content = $form_values['message'];
		$from = 'support@wacis.net';
		$from = str_replace(array("\r", "\n"), '', $from); // to prevent email injection
		$emails = json_decode($form_values['emails']);
		foreach ($emails as $email)
		{
			$to = $email;
			$random_hash = md5(date('r', time())); 

			$headers = "From: $from\r\nReply-To: $from\r\n"
			."MIME-Version: 1.0\r\n"
			."Content-Type: multipart/mixed; boundary=\"$random_hash\"\r\n\r\n"
			."This is a multi-part message in MIME format.\r\n" 
			."--$random_hash\r\n"
			."Content-type:text/html; charset=utf-8\r\n"
			."Content-Transfer-Encoding: 7bit\r\n\r\n"
			.$content."\r\n\r\n";

			if (!empty($file_names))
				foreach ($file_names as $key=>$file_name)
				{
					$headers .= "--$random_hash\r\n"
					."Content-Type: application/octet-stream; name=\"$file_name\"\r\n"
					."Content-Transfer-Encoding: base64\r\n"
					."Content-Disposition: attachment; filename=\"$file_name\"\r\n\r\n"
					.$attachments[$key]."\r\n\r\n";
				}
			$headers .= "--$random_hash--"; 
			$mail_sent = @mail($to, "=?utf-8?B?".base64_encode($subject)."?=", "", $headers); 
		}
		echo $mail_sent ? Translations::gi()->mail_sent_successfull : Translations::gi()->mail_send_failed;

        $this->data['body'] = '';    
		return $this->data;
	}	
}
