<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


	include dirname(__FILE__) . '/includes/config.php';
include dirname(__FILE__) . '/includes/antiinject/index.php';
	$cnt = 0;
	$sql = "SELECT * FROM dead_line_offers WHERE `status` = '0' ";
	$result=$mysqli->query($sql);
	$count = mysqli_num_rows($result);
	if($count != 0){
		$sms = array();
		$email = array();
		$user_ids = array();
		$offer_ids = array();
		$kolvo_hour = array();
		$kolvo_lids = array();
        while($res = mysqli_fetch_assoc($result)){
            $sms[] = $res['sms'];
			$email[] = $res['email'];
			$user_ids[] = $res['user_id'];
			$offer_ids[] = $res['offer_id'];
			$kolvo_hour[] = $res['kolvo_hour'];
			$kolvo_lids[] = $res['kolvo_lids'];
        }

		for($i=0;$count>$i;$i++){
			$offer = $offer_ids[$i];
			$user = $user_ids[$i];
			$sql = "SELECT * FROM offers WHERE `id` = '$offer' LIMIT 1";
			$result=$mysqli->query($sql);
			$res = mysqli_fetch_array($result);
			
			$time_offers_end = $res['offer_end'];
			$offer_name = $res['name'];
			
			if($kolvo_hour[$i] != 0 && $time_offers_end != 0){
				
				$kolvo_hour = $kolvo_hour[$i]*3600;
				$time_end_offer_check = $kolvo_hour + time();
				
				if($time_end_offer_check >= $time_offers_end){
					sendNotification($sms[$i],$email[$i],$kolvo_hour[$i],$user,$offer,$offer_name,1);				
					$sql_update_offer = "UPDATE dead_line_offers SET `kolvo_hour`= '0' WHERE `user_id` = '$user' AND offer_id = '$offer' LIMIT 1";
					$result_update_offer = $mysqli->query($sql_update_offer);	
                    $cnt++;
				}	
			
			}
            
            if($kolvo_lids[$i] != 0){
				
				if($res['off_lids'] != 0){
					$kolvo_lids_end = $res['kolvo_lids'];
					if($kolvo_lids[$i] >= $kolvo_lids_end){                      
						sendNotification($sms[$i],$email[$i],$kolvo_lids_end,$user,$offer,$offer_name,2);
						$sql_update_offer = "UPDATE dead_line_offers SET `kolvo_lids`= '0' WHERE `user_id` = '$user' AND offer_id = '$offer' LIMIT 1";
						$result_update_offer = $mysqli->query($sql_update_offer);
                        $cnt++;
					}elseif($res['off_balance'] != 0){

						$sql_com = "select * from offers_visible where offer_id = ".$res['offer_id']." and user_id = ".$res['user_id'];
						$offer_comission_result = $mysqli->query($sql_com);
						$offer_comission_res = mysqli_fetch_array($offer_comission_result);
						
						if (is_array($offer_comission_res) && count($offer_comission_res) > 0) {
							$comission = $offer_comission_res['comission'];
							$comission_cpa = $offer_comission_res['comission_cpa'];
						}
						else {
							$comission=htmlentities($res['comission']);
							$comission_cpa=htmlentities($res['comission_cpa']);
						}
						
						//$comission=htmlentities($res['comission']);
						//$comission_cpa=htmlentities($res['comission_cpa']);
						
						if ($res['tip_comission']=='2')
						{
							$cena=htmlentities($res['cena']);
							$comission=$cena/100*$comission;
							$comission_cpa=$cena/100*$comission_cpa;
						}
						
						$kolvo_lids_end = floor($res['off_balance'] / ($comission + $comission_cpa));
						if($kolvo_lids[$i] >= $kolvo_lids_end){
							sendNotification($sms[$i],$email[$i],$kolvo_lids_end,$user,$offer,$offer_name,2);
							$sql_update_offer = "UPDATE dead_line_offers SET `kolvo_lids`= '0' WHERE `user_id` = '$user' AND offer_id = '$offer' LIMIT 1";
							$result_update_offer = $mysqli->query($sql_update_offer);
                            $cnt++;
						}
					}
					
				}elseif($res['off_balance'] != 0){

					$sql_com = "select * from offers_visible where offer_id = ".$res['offer_id']." and user_id = ".$res['user_id'];
						$offer_comission_result = $mysqli->query($sql_com);
						$offer_comission_res = mysqli_fetch_array($offer_comission_result);
						
						if (is_array($offer_comission_res) && count($offer_comission_res) > 0) {
							$comission = $offer_comission_res['comission'];
							$comission_cpa = $offer_comission_res['comission_cpa'];
						}
						else {
							$comission=htmlentities($res['comission']);
							$comission_cpa=htmlentities($res['comission_cpa']);
						}

					//$comission=htmlentities($res['comission']);
					//$comission_cpa=htmlentities($res['comission_cpa']);
					
					if ($res['tip_comission']=='2')
					{
						$cena=htmlentities($res['cena']);
						$comission=$cena/100*$comission;
						$comission_cpa=$cena/100*$comission_cpa;
					}
					
					$kolvo_lids_end = floor($res['off_balance'] / ($comission + $comission_cpa));
					if($kolvo_lids[$i] >= $kolvo_lids_end){
						sendNotification($sms[$i],$email[$i],$kolvo_lids_end,$user,$offer,$offer_name,2);
						$sql_update_offer = "UPDATE dead_line_offers SET `kolvo_lids`= '0' WHERE `user_id` = '$user' AND offer_id = '$offer' LIMIT 1";
						$result_update_offer = $mysqli->query($sql_update_offer);
                        $cnt++;
					}
				
				}
				
			}
			
			
		}
 		
		
	}

	function sendNotification($sms,$email,$kolvos,$user,$offer,$offer_name,$type)
		{
			global $mysqli, $offer_id;	

			$sql_settings = "SELECT url,zagolovok,smslogin,smspassword,smsapikey FROM settings";
			$result_settings = $mysqli->query($sql_settings);
			$res_settings=mysqli_fetch_array($result_settings);
			$settings_url=htmlentities($res_settings['url']);
			$settings_zagolovok=htmlentities($res_settings['zagolovok']);
			$settings_smslogin=htmlentities($res_settings['smslogin']);
			$settings_smspassword=htmlentities($res_settings['smspassword']);
			$settings_smsapikey=htmlentities($res_settings['smsapikey']);
			
			$sql_update_offer = "UPDATE dead_line_offers SET `status`= '0' WHERE `user_id` = '$user' AND offer_id = '$offer' AND `kolvo_lids`= '0' AND `kolvo_hour`= '0' LIMIT 1";
			$result_update_offer = $mysqli->query($sql_update_offer);		
			if($type == 1){
				$str = 'часов';
			}elseif($type == 2){
				$str = 'лидов';
			}
				$sql = "SELECT email,phone FROM users WHERE `id`='$user' LIMIT 1";
				$result=$mysqli->query($sql);
				$res=mysqli_fetch_array($result);		
				$email_num=$res['email'];
				$sms_phone=$res['phone'];
			if($sms == 1){

				$sms_text = 'До остановки оффера «'.$offer_name.'» осталось '.$kolvos.' '.$str;
				// Отправка СМС
				// Send SMS
				$ch = curl_init("http://sms.ru/auth/get_token");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				$token = curl_exec($ch);
				curl_close($ch);
					
				$ch = curl_init("http://sms.ru/sms/send");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				curl_setopt($ch, CURLOPT_POSTFIELDS, array(
				"login"		=>	$settings_smslogin,
				"sha512"	=>	hash("sha512",$settings_smspassword.$token.$settings_smsapikey),
				"token"		=>	$token,
				"to"		=>	$sms_phone,
				"text"		=>	$sms_text
				));
				$body = curl_exec($ch);
				curl_close($ch);					
				
			}
			
			if($email == 1){
				
				// Отправка E-mail рекламодателю
				// Sending E-mail to the advertiser
				$mail_subj = 'Уведомление о скором дедлайне оффера «'.$offer_name.'»';
				$mail_body = 'Здравствуйте!<br /><br />Вы просили отправит Вам уведомление перед остановкой оффера «'.$offer_name.'»<br />До остановки оффера '.$kolvos.' '.$str.'<br /><br />CPA-сеть '.$settings_zagolovok.'<br />'.$settings_url;			
				$from_email = "info@".$settings_zagolovok;
				$mail_headers = '';
				$mail_headers .= "MIME-Version: 1.0\r\n";
				$mail_headers .= "Content-type: text/html; charset=utf-8\r\n";
				$mail_headers .= "From: $from_email\r\n";
				$mail_headers .= "Reply-To: $from_email\r\n";
				$mail_headers .= "Return-Path: $from_email\r\n";
				$mail_headers .= "X-Mailer: PHP/".phpversion();
				mail($email_num, $mail_subj, $mail_body, $mail_headers);
													
			}		
		
		}	

    echo 'Отправлено '.$cnt.' уведомлений';	