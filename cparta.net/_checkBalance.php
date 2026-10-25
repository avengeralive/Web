<?php
$ownerid = 9;

	include dirname(__FILE__) . '/includes/config.php';
include dirname(__FILE__) . '/includes/antiinject/index.php';

	$sql = "SELECT id,phone,message_b,balance,send_to_admin FROM users WHERE `tip`='40' AND `message_b`!='0' AND `sendsms_balance`='0'";
	$result=$mysqli->query($sql);
	if(mysqli_num_rows($result) != 0){
		$arr = array();
		while($res=mysqli_fetch_array($result)){
			$arr[] = array('user' => $res['id'],'phone' => $res['phone'],'message_b' => $res['message_b'],'balance' => $res['balance'],'send_to_admin' => $res['send_to_admin']);
		}

		$count = count($arr);
		for($i=0;$count>$i;$i++){
			if($arr[$i]['phone'] != '' && strlen($arr[$i]['phone']) > 10){
				if($arr[$i]['message_b'] != 0 && $arr[$i]['message_b'] >= $arr[$i]['balance']){
					sendSms($arr[$i]['balance'],$arr[$i]['phone'],$arr[$i]['send_to_admin'],$arr[$i]['user']);
				}
			}
		}

	}
	function sendSms($balance, $phone, $toAdmin, $user)
	{
		global $mysqli;

			$sql_settings = "SELECT smslogin,smspassword,smsapikey FROM settings";
			$result_settings = $mysqli->query($sql_settings);
			$res_settings=mysqli_fetch_array($result_settings);
			$settings_smslogin=htmlentities($res_settings['smslogin']);
			$settings_smspassword=htmlentities($res_settings['smspassword']);
			$settings_smsapikey=htmlentities($res_settings['smsapikey']);

			$sms_text = 'Здравствуйте, на балансе осталось '.$balance.' руб., в ближайшее время трафик остановится';
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
			"to"		=>	$phone,
			"text"		=>	$sms_text
			));
			$body = curl_exec($ch);
			curl_close($ch);

			if($toAdmin == 1){

				$phone2 = '+79612950952,+79166216674';

				$sms_text2 = 'На балансе рекла c id '.$user.' осталось '.$balance.' руб.';
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
				"to"		=>	$phone2,
				"text"		=>	$sms_text2
				));
				$body = curl_exec($ch);
				curl_close($ch);

			}

		$sql_update_zakaz = "UPDATE users SET `sendsms_balance`='1' WHERE `id`='$user'";
		$result_update_zakaz = $mysqli->query($sql_update_zakaz);
	}
