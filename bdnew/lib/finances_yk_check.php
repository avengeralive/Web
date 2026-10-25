<?php

// Блок с "Яндекс.Касса checkUrl"
// Block with "Yandeks.Kassa checkUrl"
if ((isset($_GET['act']) && $_GET['act']=='result') && (isset($_GET['type']) && $_GET['type']=='check') && isset($_POST['action']) && isset($_POST['orderSumAmount']) && isset($_POST['orderSumCurrencyPaycash']) && isset($_POST['orderSumBankPaycash']) && isset($_POST['invoiceId']) && isset($_POST['customerNumber']) && isset($_POST['md5']) && isset($_POST['requestDatetime']) && isset($_POST['paymentType']))
	{
	// Подключаем файл конфигурации
	// Connect configuration file
	include './includes/config.php';

	// Подключаем файл защиты от инжекта для передаваемых переменных
	// Connect the protection of Injection file transmitted variables
	include './includes/antiinject/index.php';

	// Подключаем файл с настройками системы
	// Connect the file system settings
	include './includes/settings/index.php';

	// Подключаем файл с определением того, какую версию дизайна выводить
	// Connect file with the definition of what type of design output version
	include './includes/otladka/index.php';		
		
	$yk_action=htmlentities($_POST['action']);
	$yk_orderSumAmount=htmlentities($_POST['orderSumAmount']);
	$yk_orderSumCurrencyPaycash=htmlentities($_POST['orderSumCurrencyPaycash']);
	$yk_orderSumBankPaycash=htmlentities($_POST['orderSumBankPaycash']);
	$yk_invoiceId=htmlentities($_POST['invoiceId']);
	$yk_customerNumber=htmlentities($_POST['customerNumber']);
	$yk_md5=htmlentities($_POST['md5']);
	$yk_paymentType=htmlentities($_POST['paymentType']);
	$yk_requestDatetime=htmlentities($_POST['requestDatetime']);
	$hash = md5($yk_action.';'.$yk_orderSumAmount.';'.$yk_orderSumCurrencyPaycash.';'.$yk_orderSumBankPaycash.';'.$settings_yk_shopid.';'.$yk_invoiceId.';'.$yk_customerNumber.';'.$settings_yk_shoppassword);		

	// Если было инициировано пополнение счета в системе, то выполняем
	// If the refill has been initiated in the system, then perform
	if ((isset($_POST['pay']) && $_POST['pay']=='paybalance') && isset($_POST['inv_id']))
		{
		$inv_id=htmlentities($_POST['inv_id']);
		// Если заяках на ввод средств есть заявка с указанным номером, то выполняем
		// If funds entering applications have an application with the specified number, then execute
		$sql_checkinvoice = "SELECT id FROM finances_log WHERE `id`='$inv_id' AND `status`='1'";
		$result_checkinvoice = $mysqli->query($sql_checkinvoice);
		if (mysqli_num_rows($result_checkinvoice) > 0) 
			{	
			// Если в системе есть пользователь с указанным id, то выполняем
			// If the system has a user with the specified id, then execute
			$sql_checkuser = "SELECT id FROM users WHERE `id`='$yk_customerNumber'";
			$result_checkuser = $mysqli->query($sql_checkuser);
			if (mysqli_num_rows($result_checkuser) > 0) 
				{
				if (strtolower($hash) != strtolower($yk_md5))
					{
					$code = 1;
					}
				else 
					{
					$code = 0;
					}
				print '<?xml version="1.0" encoding="UTF-8"?>';
				print '<checkOrderResponse performedDatetime="'. $yk_requestDatetime .'" code="'.$code.'"'. ' invoiceId="'. $yk_invoiceId .'" shopId="'. $settings_yk_shopid .'"/>';
				}
			}
		}	
		
	// Если это была оплата на лендинге или интернет-магазине, то выполняем
	// If it was a payment on the Landing or online store, then execute
	if ((isset($_POST['pay']) && $_POST['pay']=='paylanding') && isset($_POST['paystroka']))
		{
		$paystroka=htmlentities($_POST['paystroka']);
		
		if (strtolower($hash) != strtolower($yk_md5))
			{
			$code = 1;
			}
		else 
			{
			$code = 0;
			}
		print '<?xml version="1.0" encoding="UTF-8"?>';
		print '<checkOrderResponse performedDatetime="'. $yk_requestDatetime .'" code="'.$code.'"'. ' invoiceId="'. $yk_invoiceId .'" shopId="'. $settings_yk_shopid .'"/>';

		
		// Получаем данные используя статистику посещений
		// Get the data using the statistics of visits
		$sql_getdata = "SELECT * FROM clients_log WHERE `code`='$paystroka' ORDER BY id DESC";
		$result_getdata=$mysqli->query($sql_getdata);
		if (mysqli_num_rows($result_getdata) > 0) 
			{
			$res_getdata=mysqli_fetch_array($result_getdata);
		
			// Передаем значения в переменные
			// Pass values ​​to variables
			$userid=htmlentities($res_getdata['user_id']);
			$offerid=htmlentities($res_getdata['offer_id']);
			$ownerid=htmlentities($res_getdata['owner_id']);
			$landingid=htmlentities($res_getdata['landing_id']);
			$referer=htmlentities($res_getdata['referer']);
			$country=htmlentities($res_getdata['country']);
			$region=htmlentities($res_getdata['region']);
			$town=htmlentities($res_getdata['town']);
			$ip=htmlentities($res_getdata['ip']);
			$short_country=htmlentities($res_getdata['short_country']);
			$browser_name=htmlentities($res_getdata['browser_name']);
			$browser_version=htmlentities($res_getdata['browser_version']);
			$useragent=htmlentities($res_getdata['useragent']);
			$platform=htmlentities($res_getdata['platform']);
			$referer=htmlentities($res_getdata['referer']);
			$mobile=htmlentities($res_getdata['mobile']);
			$subid1=htmlentities($res_getdata['subid1']);
			$subid2=htmlentities($res_getdata['subid2']);
			$subid3=htmlentities($res_getdata['subid3']);
                        $subid4=htmlentities($res_getdata['subid4']);
                        $subid5=htmlentities($res_getdata['subid5']);
			
			// Задаем переменную для ГЕО
			// Set a variable for GEO
			if (isset($country) && ($country!='')) {if ((isset($region) && ($region!='')) && (isset($town) && ($town!=''))) {$geo=htmlentities($country).' / '.htmlentities($region).' / '.htmlentities($town);} else {$geo=htmlentities($country);}} else {$geo='Не определено';}
			if (isset($_POST['name']) && $_POST['name']!='') {$name=htmlentities($_POST['name']);} else {$name="";}
			if (isset($_POST['phone']) && $_POST['phone']!='') {$phone=htmlentities($_POST['phone']);} else {$phone="";}
			if (isset($_POST['email']) && $_POST['email']!='') {$email=htmlentities($_POST['email']);} else {$email="";}
			if (isset($_POST['address']) && $_POST['address']!='') {$address=htmlentities($_POST['address']);} else {$address="";}
			if (isset($_POST['kolvo']) && $_POST['kolvo']!='') {$kolvo=htmlentities($_POST['kolvo']);} else {$kolvo="1";}
			if (isset($_POST['artikul']) && $_POST['artikul']!='') {$artikul=htmlentities($_POST['artikul']);} else {$artikul="";}
			if (isset($_POST['comments']) && $_POST['comments']!='') {$comments=htmlentities($_POST['comments']);} else {$comments="";}
			
			// Получаем данные о цене и комиссии на оффере
			// Get information about the price and the commission on offer
			$sql_getdataoffer = "SELECT * FROM offers WHERE `id`='$offerid' AND `owner_id`='$ownerid'";
			$result_getdataoffer=$mysqli->query($sql_getdataoffer);
			if (mysqli_num_rows($result_getdataoffer) > 0) 
				{
				$res_getdataoffer=mysqli_fetch_array($result_getdataoffer);
				
				// Передаем значения в переменные
				// Pass values ​​to variables
				$deystvie=htmlentities($res_getdataoffer['deystvie']);
				$cena=htmlentities($res_getdataoffer['cena']);
				$sql_com = "select * from offers_visible where offer_id = ".$res_getdataoffer['offer_id']." and user_id = ".$res_getdataoffer['user_id'];
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
				//$comission=htmlentities($res_getdataoffer['comission']);
				//$comission_cpa=htmlentities($res_getdataoffer['comission_cpa']);
				$sms_ok=htmlentities($res_getdataoffer['sms_ok']);
				$sms_text=htmlentities($res_getdataoffer['sms_text_zakaz']);

				// Сумма заказа = цена * количество заказанного
				// Amount of order = price * quantity ordered
				$summa_zakaza=$cena*$kolvo;

				// Комиссия вебмастеру = комиссия вебмастеру * количество заказанного
				// The Commission webmaster = сommission webmaster * amount ordered
				$summa_comission=$comission*$kolvo;
	
				// Комиссия в пользу CPA-сети = комиссия CPA-сети * количество заказанного
				// The Commission in favor of the CPA-network = сommission CPA-network * amount ordered
				$summa_comission_cpa=$comission_cpa*$kolvo;
	
				// Общая сумма вычитаемой с рекламодателя комиссии = комиссия вебмастеру + комиссия в пользу CPA-сети
				// The total amount is deducted from the advertiser's webmaster commission = commission webmaster + commission in favor of the CPA-network
				$comission_all=$summa_comission+$summa_comission_cpa;
	
				// Cумма получаемая на баланс рекламодателем
				// Sum received on the balance of advertiser
				$dohod_reklamodatela=$summa_zakaza-$comission_all;
		
				// Узнаем текущий баланс рекламодателя
				// Check the current balance of advertiser
				$sql_balance_reklamodatel = "SELECT balance FROM users WHERE id=$ownerid";
				$result_balance_reklamodatel = $mysqli->query($sql_balance_reklamodatel);
				$res_balance_reklamodatel=mysqli_fetch_array($result_balance_reklamodatel);
	
				// Назначаем переменную под текущий баланс рекламодателя
				// Assign a variable for the current balance of advertiser
				$balance_reklamodatel=htmlentities($res_balance_reklamodatel['balance']);
	
				// Узнаем текущий баланс вебмастера и ID его рефовода
				// Check the current balance of the webmaster and its referrer ID
				$sql_data_webmaster = "SELECT balance,myrefovod FROM users WHERE id=$userid";
				$result_data_webmaster = $mysqli->query($sql_data_webmaster);
				$res_data_webmaster=mysqli_fetch_array($result_data_webmaster);

				// Назначаем переменную под текущий баланс вебмастера
				// Assign a variable current balance webmaster
				$balance_webmaster=htmlentities($res_data_webmaster['balance']);
	
				// Назначаем переменную под ID рефовода вебмастера
				// Assign a variable referrer ID webmaster
				$refovod_webmaster=htmlentities($res_data_webmaster['myrefovod']);
	
				// Узнаем текущий баланс рефовода
				// Check the current balance of the referrer
				if ($settings_refprocent!='0' && $refovod_webmaster!='0' && $refovod_webmaster!='')
					{
					$sql_balance_refovod = "SELECT balance FROM users WHERE `id`='$refovod_webmaster'";
					$result_balance_refovod = $mysqli->query($sql_balance_refovod);
					$res_balance_refovod=mysqli_fetch_array($result_balance_refovod);

					// Назначаем переменную под текущий баланс рефовода
					// Assign a variable current balance referrer
					$balance_refovod=htmlentities($res_balance_refovod['balance']);	
					}
				
				// Узнаем, количество заказов у рекламодателя для определения номера у очередного заказа
				// We'll know the number of orders from the advertiser to determine the number of the next in order
				$sql_zakaz_kolvo = "SELECT COUNT(id) as count FROM zakaz WHERE `owner_id`='$ownerid'";
				$result_zakaz_kolvo = $mysqli->query($sql_zakaz_kolvo);
				$res_zakaz_kolvo = mysqli_fetch_assoc($result_zakaz_kolvo);
				$zakaz_kolvo=htmlentities($res_zakaz_kolvo['count']);
				if ($zakaz_kolvo==null || $zakaz_kolvo==0)
					{$zakaz_number=1;}
				else
					{$zakaz_number=$zakaz_kolvo+1;}
				
				// Если заказ с таким InvoiceID уже есть в базе, то останавливаемся
				// If the order with InvoiceID already in the database, then stop
				$sql_check_zakaz = "SELECT id FROM zakaz WHERE `invoice_id`='$yk_invoiceId'";
				$result_check_zakaz=$mysqli->query($sql_check_zakaz);
				if (mysqli_num_rows($result_check_zakaz) > 0) 
					{
					exit;
					}
				
				// Пишем в базу новый заказ в статусе "ОЖИДАЕТ"
				// Write to the database a new order in the status "WAITING"
				$sql_save_zakaz= "INSERT INTO `zakaz` (`zakaz_number`,`user_id`,`offer_id`,`owner_id`,`landing_id`,`geo`,`ip`,`referer`,`useragent`,`subid1`,`subid2`,`subid3`,`subid4`,`subid5`,`name`,`phone`,`email`,`client_address`,`kolvo`,`artikul`,`status`,`comments`,`country`,`short_country`,`browser_name`,`browser_version`,`platform`,`mobile`,`region`,`town`,`cena`,`comission`,`comission_cpa`,`invoice_id`) VALUES ('$zakaz_number','$userid','$offerid','$ownerid','$landingid','$geo','$ip','$referer','$useragent','$subid1','$subid2','$subid3','$subid4','$subid5','$name','$phone','$email','$address','$kolvo','$artikul','1','$comments','$country','$short_country','$browser_name','$browser_version','$platform','$mobile','$region','$town','$cena','$comission','$comission_cpa','$yk_invoiceId')";
				$result_save_zakaz=$mysqli->query($sql_save_zakaz);					
				}
			}				
		}
	exit;	
	}

?>