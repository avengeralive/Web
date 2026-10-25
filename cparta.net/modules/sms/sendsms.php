<?php
// Если в настройках системы разрешено использовать СМС-уведомления, то разрешаем использовать даный код
// If the system settings are allowed to use SMS notification, permit the use of this product consult the code
if ($settings_sms_ok==1)
	{
	if ((isset($_POST['testsms']) && $_POST['testsms']=='ok') && (isset($_POST['apikey']) && $_POST['apikey']!=''))
		{
		// Если переданный API-KEY равен тому что взят из базы, то оправляем тестовое СМС
		// If passed API-KEY is equal to that taken from the database, you recover a test SMS
		if (htmlentities($_POST['apikey'])==$settings_smsapikey)
			{
			$sms_text=$settings_zagolovok.': Тестовое СМС.';
			$sms_phone=$settings_smslogin;
			send_sms($sms_text);
			exit;
			}
		}
	elseif (isset($_POST['zakaz_number']) && isset($_POST['offer_id']) && isset($_POST['owner_id']) && isset($_POST['ob']) && isset($_POST['sms']))
		{
		$zakaz_number=htmlentities($_POST['zakaz_number']);
		$offer_id=htmlentities($_POST['offer_id']);
		$owner_id=htmlentities($_POST['owner_id']);
		$ob=htmlentities($_POST['ob']);
		$sms_tip=htmlentities($_POST['sms']);
		
		// Проверка что суммы на балансе рекламодателя хватит для списания стоимости отправки СМС
		// Check that the sum of the balance on the advertiser's enough to write off the cost of sending SMS
		$sql_user_checkbalance = "SELECT balance FROM users WHERE `id`='$owner_id'";
		$result_user_checkbalance = $mysqli->query($sql_user_checkbalance);
		$res_user_checkbalance=mysqli_fetch_array($result_user_checkbalance);
		$owner_balance=$res_user_checkbalance['balance'];
		if ($owner_balance>=$settings_sms_price)
			{
			// Проверка, что полученные данные соответствуют действительности
			// Check that the data correspond to reality
			$sql_zakaz_check = "SELECT phone FROM zakaz WHERE `zakaz_number`='$zakaz_number' AND `offer_id`='$offer_id' AND `owner_id`='$owner_id' AND `id`='$ob'";
			$result_zakaz_check = $mysqli->query($sql_zakaz_check);
			if (mysqli_num_rows($result_zakaz_check)>0) 
				{	
				$res_zakaz_check=mysqli_fetch_array($result_zakaz_check);
				$client_phone=htmlentities($res_zakaz_check['phone']);
				
				if ($sms_tip=='zakaz') {$sql_sms = "SELECT sms_ok, sms_phone, sms_text_zakaz FROM offers WHERE `id`='$offer_id' AND `owner_id`='$owner_id'";}
				elseif ($sms_tip=='send') {$sql_sms = "SELECT sms_ok, sms_phone, sms_text_send FROM offers WHERE `id`='$offer_id' AND `owner_id`='$owner_id'";}
				elseif ($sms_tip=='way') {$sql_sms = "SELECT sms_ok, sms_phone, sms_text_way FROM offers WHERE `id`='$offer_id' AND `owner_id`='$owner_id'";}
				elseif ($sms_tip=='success') {$sql_sms = "SELECT sms_ok, sms_phone, sms_text_success FROM offers WHERE `id`='$offer_id' AND `owner_id`='$owner_id'";}
				
				$result_sms = $mysqli->query($sql_sms);
				$res_sms=mysqli_fetch_array($result_sms);
				if ((isset($res_sms['sms_ok']) && $res_sms['sms_ok']=='1'))
					{
					if ($sms_tip=='zakaz')
						{
						$sms_phone=htmlentities($res_sms['sms_phone']);
						}
					elseif ((($sms_tip=='send') || ($sms_tip=='way') || ($sms_tip=='success')) && (isset($client_phone) && $client_phone!=''))
						{
						$sms_phone=htmlentities($client_phone);
						}
					if ($sms_tip=='zakaz') {$sms_text=htmlentities($res_sms['sms_text_zakaz']);}
					elseif ($sms_tip=='send') {$sms_text=htmlentities($res_sms['sms_text_send']);}
					elseif ($sms_tip=='way') {$sms_text=htmlentities($res_sms['sms_text_way']);}
					elseif ($sms_tip=='success') {$sms_text=htmlentities($res_sms['sms_text_success']);}
			
					if (isset($sms_text) && $sms_text!='')
						{
						// Список переменных, которые можно использовать в тексте СМС:
						// {net_name} - Название CPA-сети
						// {offer_name} - Название оффера
						// {zakaz_date} - Дата поступления заказа
						// {zakaz_time} - Время поступления заказа
						// {date} - Текущая дата на момент отправки СМС
						// {time} - Текущее время на момент отправки СМС
						
						// The list of variables that can be used in the text of SMS:
						// {net_name} - The name of the CPA - network
						// {offer_name} - Name offera
						// {zakaz_date} - Date of receipt of the order
						// {zakaz_time} - receipt of the order Time
						// {date} - current date at the time of sending SMS
						// {time} - The current time at the time of sending SMS						
						
						$sms_text=html_entity_decode($sms_text, ENT_QUOTES, 'utf-8');
						
						// Получаем из базы данные для автозамены
						// Get the data from the database to the autocorrect						

						// Название оффера
						// Name offer						
						$sql_offer_data = "SELECT name FROM offers WHERE `id`='$offer_id' AND `owner_id`='$owner_id'";
						$result_offer_data = $mysqli->query($sql_offer_data);
						if (mysqli_num_rows($result_offer_data)>0) 
							{	
							$res_offer_data=mysqli_fetch_array($result_offer_data);
							$offer_name=htmlentities($res_offer_data['name']);
							}
						else
							{
							$offer_name='Название оффера';
							}
							
						// Дата и время заказа
						// Date and time of order
						$sql_zakaz_data = "SELECT date FROM zakaz WHERE `zakaz_number`='$zakaz_number' AND `offer_id`='$offer_id' AND `owner_id`='$owner_id' AND `id`='$ob'";
						$result_zakaz_data = $mysqli->query($sql_zakaz_data);
						if (mysqli_num_rows($result_zakaz_data)>0) 
							{	
							$res_zakaz_data=mysqli_fetch_array($result_zakaz_data);
							$zakaz_date=date('d.m.Y', strtotime(htmlentities($res_zakaz_data['date'])));
							$zakaz_time=date('H:i:s', strtotime(htmlentities($res_zakaz_data['date'])));
							}
						else
							{
							$zakaz_date='Дата заказа';
							$zakaz_time='Время заказа';
							}						
						
						// Текущие дата и время на момент отправки СМС
						// The current date and time at the time of sending SMS
						$cur_date=date('d.m.Y', strtotime('now'));
						$cur_time=date('H:i:s', strtotime('now'));
						
						$str_search = array('{net_name}', '{offer_name}', '{zakaz_date}', '{zakaz_time}', '{date}', '{time}'); 
						$str_replace = array($settings_zagolovok, $offer_name, $zakaz_date, $zakaz_time, $cur_date, $cur_time);
						$sms_text=str_replace($str_search, $str_replace, $sms_text);			
						
						send_sms($sms_text);
					
						// Вычитаем с баланса рекламодателя стоимость СМС (стоимость СМС указывается в настройках сети)
						// Subtract the balance sheet value of the advertiser's SMS (SMS cost is specified in the network settings)
						$sql_update_ownerbalance = "UPDATE users SET `balance`=`balance`-'$settings_sms_price' WHERE `id`='$owner_id'";
						$result_update_ownerbalance = $mysqli->query($sql_update_ownerbalance);
						
						// Пишем в базу, в таблицу "finances", информацию о списании средств с баланса рекламодателя
						// Write to the database, the table "finances", information about the funds are debited from the balance of advertiser
						$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','2','$settings_sms_price',9,'$owner_balance'-'$settings_sms_price','2')";
						$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
						
						exit;
						}
					}
				}
			}
		}
	}
	
function send_sms($sms_text)
	{
	global $settings_smslogin, $settings_smspassword, $settings_smsapikey, $sms_phone;
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
	"text"		=>	iconv("utf-8","utf-8",$sms_text)
	));
	$body = curl_exec($ch);
	curl_close($ch);
	}	
?>