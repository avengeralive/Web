<?php

// Блок с инициированием платежа. Передача и обработка данных из платежной формы
// Если были переданы данные из формы пополнения баланса, то выполняем

// Block to initiate the payment. Transmission and processing of data from the payment form
// If the data has been transferred from the mold to replenish the balance, then execute
if (isset($_POST['submit_paylanding']) && isset($_POST['paysys']) && isset($_POST['amount']) && isset($_POST['paymentType']))
	{
	// Подключаем файл конфигурации
	// Connect configuration file
	include_once './includes/config.php';
	
	// Подключаем файл защиты от инжекта для передаваемых переменных
	// Connect the protection of Injection file transmitted variables
	include_once './includes/antiinject/index.php';

	// Подключаем файл с настройками системы
	// Connect the file system settings
	include_once './includes/settings/index.php';	

	// Подключаем функции кодирования и раскодирования партнерской строки
	// Connect the encoding and decoding functions affiliate line
	include_once './includes/partnerstroka/index.php';		
	
	// Помещаем полученную строку в переменную
	// Put the resulting string into a variable
	$paystroka = isset($_POST['partnerlink']) ? htmlentities($_POST['partnerlink']) : '';
	
	$partnerlink=partnerstroka_decode($paystroka,true);
	$user_id=htmlentities($partnerlink[0]);
	if ($user_id=='1') {$user_id='0';}
	$offer_id=htmlentities($partnerlink[1]);
	$landing_id=htmlentities($partnerlink[2]);
	
	// Проверяем, есть ли в наличии такой оффер и включен ли он
	// Check whether there is a presence of such offer and whether it is turned on
	$sql_check_offer = "SELECT id,name,owner_id,cena FROM offers WHERE `id`='$offer_id' AND `active`='1' AND `deystvie`='5'";
	$result_check_offer=$mysqli->query($sql_check_offer);
	if (mysqli_num_rows($result_check_offer) > 0) 
		{
		$res_check_offer=mysqli_fetch_array($result_check_offer);
		$offer_name=htmlentities($res_check_offer['name']);
		$offer_cena=htmlentities($res_check_offer['cena']);
		$offer_owner_id=htmlentities($res_check_offer['owner_id']);
		
		// Узнаем УРЛ лендинга по которому был заказ
		// Learn Landing URL on which the order was
		$sql_check_landing = "SELECT url FROM landings WHERE `id`='$landing_id'";
		$result_check_landing=$mysqli->query($sql_check_landing);
		$res_check_landing=mysqli_fetch_array($result_check_landing);
		$landing_url=htmlentities($res_check_landing['url']);
		
		// Узнаем реквизиты владельца оффера
		// Learn details offer owner
		$sql_check_owner = "SELECT id,email,name,balance FROM users WHERE `id`='$offer_owner_id'";
		$result_check_owner=$mysqli->query($sql_check_owner);
		if (mysqli_num_rows($result_check_owner) > 0) 
			{
			$res_check_owner=mysqli_fetch_array($result_check_owner);
			$owner_id=htmlentities($res_check_owner['id']);
			$owner_email=htmlentities($res_check_owner['email']);	
			$owner_name=htmlentities($res_check_owner['name']);
			$owner_balance=htmlentities($res_check_owner['balance']);
			
			// Проверяем, существует ли вебмастер, ID которого передано в ссылке
			// Check if there is a webmaster, who referred to the link ID
			$sql_check_webmaster = "SELECT id,balance FROM users WHERE `id`='$user_id'";
			$result_check_webmaster=$mysqli->query($sql_check_webmaster);
			if (mysqli_num_rows($result_check_webmaster) > 0) 
				{
				$res_check_webmaster=mysqli_fetch_array($result_check_webmaster);
				$webmaster_id=htmlentities($res_check_webmaster['id']);	
				$webmaster_balance=htmlentities($res_check_webmaster['balance']);
				}
			else
				{
				$webmaster_id='0';	
				}
				
				// Проверяем наличие переменных указывающих на название платежной системы и сумму пополнения баланса
				// Check for variables indicating the name of the payment system and the amount of deposit balance
				$amount = isset($_POST['amount']) ? intval($_POST['amount']) : 0;
				$paysys = isset($_POST['paysys']) ? htmlentities($_POST['paysys']) : 'yk';
				$paymentType = isset($_POST['paymentType']) ? htmlentities($_POST['paymentType']) : '';
			
				// Если сумма не указана, равна нулю или меньше нуля, то останавливаемся
				// If the amount is not specified is zero or less than zero, then stop
				if($amount<=0)
					{
					exit;
					}	
				
				// Если при оплате была указана платежная система Яндекс.Касса, то выполняем
				// If the payment system Yandeks.Kassa was listed at payment, then execute
				if ($paysys=='yk')
					{
					if (isset($_POST['name']) && $_POST['name']!='') {$name=htmlentities($_POST['name']);} else {$name='';}
					if (isset($_POST['phone']) && $_POST['phone']!='') {$phone=htmlentities($_POST['phone']);} else {$phone='';}
					if (isset($_POST['email']) && $_POST['email']!='') {$email=htmlentities($_POST['email']);} else {$email='';}
					if (isset($_POST['address']) && $_POST['address']!='') {$address=htmlentities($_POST['address']);} else {$address='';}
					if (isset($_POST['kolvo']) && $_POST['kolvo']!='') {$kolvo=htmlentities($_POST['kolvo']);} else {$kolvo='1';}
					if (isset($_POST['artikul']) && $_POST['artikul']!='') {$artikul=htmlentities($_POST['artikul']);} else {$artikul='';}
					if (isset($_POST['comments']) && $_POST['comments']!='') {$comments=htmlentities($_POST['comments']);} else {$comments='';}

					$html = '<form method="POST" action="'.$settings_yk_obrabotchik.'" name="payform">
					<input type="hidden" name="scId" value="'.$settings_yk_scid.'">
					<input type="hidden" name="shopId" value="'.$settings_yk_shopid.'">
					<input type="hidden" name="customerNumber" value="'.$user_id.'">
					<input type="hidden" name="Sum" value="'.$amount.'">
					<input type="hidden" name="paymentType" value="'.$paymentType.'">
					<input type="hidden" name="pay" value="paylanding">	
					
					<input type="hidden" name="name" value="'.$name.'">
					<input type="hidden" name="phone" value="'.$phone.'">
					<input type="hidden" name="email" value="'.$email.'">
					<input type="hidden" name="address" value="'.$address.'">
					<input type="hidden" name="kolvo" value="'.$kolvo.'">
					<input type="hidden" name="artikul" value="'.$artikul.'">
					<input type="hidden" name="comments" value="'.$comments.'">
					
					<input type="hidden" name="owner_id" value="'.$owner_id.'">
					<input type="hidden" name="offer_id" value="'.$offer_id.'">
					<input type="hidden" name="landing_id" value="'.$landing_id.'">
					<input type="hidden" name="landing_url" value="'.$landing_url.'">
					<input type="hidden" name="paystroka" value="'.$paystroka.'">
					</form>
					<script>document.payform.submit();</script>';
					echo $html;
					exit;
					}
				// Если не указана платежная система, то выводим сообщение об этом
				// If no payment system, the message about this
				else
					{
					echo '<p>'.$loc['finances.php']['t53'].'<br /><br /><a href="./finances.php">'.$loc['finances.php']['t54'].'</a></p>';
					exit;
					}

			} else {echo $loc['finances.php']['t55'];}
		} else {echo $loc['finances.php']['t56'];}
	exit;
	}

// Если финансы успешно приняты, то переадресовываем покупателя на оплаченный товар или услугу
// If finances successfully received, the buyer is redirected to a paid product or service
if ((isset($_GET['act']) && $_GET['act']=='result') && (isset($_GET['type']) && $_GET['type']=='success') && isset($_GET['landing_url']))
	{
	$landing_url=htmlentities($_GET['landing_url']);
	Header('Location: '.$landing_url.'_success_/');
	exit;
	}

// Если финансы НЕ БЫЛИ успешно приняты, то переадресовываем покупателя на лендинг или интернет-магазин откуда он пришел.
// If the finances are not successfully received, then redirect the buyer on Landing or online shop where he came from.
if ((isset($_GET['act']) && $_GET['act']=='result') && (isset($_GET['type']) && $_GET['type']=='fail') && isset($_GET['landing_url']))
	{
	$landing_url=htmlentities($_GET['landing_url']);
	Header('Location: '.$landing_url);
	exit;
	}	

?>