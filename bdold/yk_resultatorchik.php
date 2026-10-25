<?php
// Блок с "Яндекс.Касса PaymentAviso"
// Block with "Yandeks.Kassa PaymentAviso"

if (isset($_POST['action']) && isset($_POST['orderSumAmount']) && isset($_POST['orderSumCurrencyPaycash']) && isset($_POST['orderSumBankPaycash']) && isset($_POST['invoiceId']) && isset($_POST['customerNumber']) && isset($_POST['md5']) && isset($_POST['requestDatetime']) && isset($_POST['paymentType']))
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

	// Подключаем функции кодирования и раскодирования партнерской строки
	// Connect the encoding and decoding functions affiliate line
	include './includes/partnerstroka/index.php';
	
	// Подключаем файл с функцией генерации случайной строки
	// Include files with the function of generating a random string
	include './includes/genrand50sym/index.php';	
	
	// Подключаем файл с функцией отправки почты
	// Include files with the function of sending mail
	include './includes/sendemail/index.php';	
	
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

	// Обработка ситуации при которой было пополнение счета в системе
	// Processing of the situation in which was the account replenishment system
	if ((isset($_POST['pay']) && $_POST['pay']=='paybalance') && isset($_POST['inv_id']))
		{
		$inv_id=htmlentities($_POST['inv_id']);
		// Если в заявках на пополнение средств есть заявка с указанным номером, то выполняем
		// If the applications for replenishment have application with the specified number , then execute
		$sql_checkinvoice = "SELECT id FROM finances_log WHERE `id`='$inv_id' AND `status`='1'";
		$result_checkinvoice = $mysqli->query($sql_checkinvoice);
		if (mysqli_num_rows($result_checkinvoice) > 0) 
			{	
			// Если в системе есть пользователь с указанным id, то выполняем
			// If the system has a user with the specified id, then execute
			$sql_checkuser = "SELECT id,balance FROM users WHERE `id`='$yk_customerNumber'";
			$result_checkuser = $mysqli->query($sql_checkuser);
			if (mysqli_num_rows($result_checkuser) > 0) 
				{
				$res_checkuser=mysqli_fetch_array($result_checkuser);
				$user_current_balance=htmlentities($res_checkuser['balance']);
				if (strtolower($hash) != strtolower($yk_md5))
					{
					$code = 1;
					}
				else 
					{
					$code = 0;
					}
				print '<?xml version="1.0" encoding="UTF-8"?>';
				print '<paymentAvisoResponse performedDatetime="'. $yk_requestDatetime .'" code="'.$code.'"'. ' invoiceId="'. $yk_invoiceId .'" shopId="'. $settings_yk_shopid .'"/>';

				$new_user_balance = $user_current_balance + intval($yk_orderSumAmount);
				
				$sql_yk2="UPDATE users SET `balance`='$new_user_balance', `sendsms_balance` = '0' WHERE `id`='$yk_customerNumber'";
				$result_yk2 = $mysqli->query($sql_yk2);		
				
				$sql_yk2="UPDATE finances_log SET `status`='2', `balance`='$new_user_balance' WHERE `user_id`='$yk_customerNumber' AND `id`='$inv_id' AND `status`='1'";
				$result_yk2 = $mysqli->query($sql_yk2);		
		
				}
			}
		}

	// Обработка ситуации при которой была оплата на лендинге или интернет-магазине
	// Processing of the situation in which the payment was to the Landing or online store
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
		print '<paymentAvisoResponse performedDatetime="'. $yk_requestDatetime .'" code="'.$code.'"'. ' invoiceId="'. $yk_invoiceId .'" shopId="'. $settings_yk_shopid .'"/>';

		
		// Получаем данные из статистики посещений
		// Get the data from the statistics of visits
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
				$offer_name=htmlentities($res_getdataoffer['name']);
				$deystvie=htmlentities($res_getdataoffer['deystvie']);
				$cena=htmlentities($res_getdataoffer['cena']);
				
				// Узнаем тип комиссии
				// Find out the type of the commission
				$tip_comission=htmlentities($res_getdataoffer['tip_comission']);
			
				$comission=htmlentities($res_getdataoffer['comission']);
				$comission_cpa=htmlentities($res_getdataoffer['comission_cpa']);
				
				// Если комиссия задана в процентном соотношении от цены
				// If the commission is set as a percentage of the price
				if ($tip_comission=='2')
					{
					$comission=$cena/100*$comission;
					$comission_cpa=$cena/100*$comission_cpa;
					}				
				
				$sms_ok=htmlentities($res_getdataoffer['sms_ok']);
				$sms_text=htmlentities($res_getdataoffer['sms_text_zakaz']);
				
				// Сумма заказа = цена * количество заказанного
				// Amount = price * quantity ordered
				$summa_zakaza=$cena*$kolvo;

				// Комиссия вебмастеру = комиссия вебмастеру * количество заказанного
				// The Commission webmaster webmaster * = Commission amount ordered
				$summa_comission=$comission*$kolvo;
	
				// Комиссия в пользу CPA-сети = комиссия CPA-сети * количество заказанного
				// The Commission in favor of the CPA- network = CPA- network fee * amount ordered
				$summa_comission_cpa=$comission_cpa*$kolvo;
	
				// Общая сумма вычитаемой с рекламодателя комиссии = комиссия вебмастеру + комиссия в пользу CPA-сети
				// The total amount is deducted from the advertiser's webmaster commission = commission + commission in favor of the CPA- network
				$comission_all=$summa_comission+$summa_comission_cpa;
	
				// Cумма получаемая на баланс рекламодателем
				// Sum received on the balance of advertiser
				$dohod_reklamodatela=$summa_zakaza-$comission_all;
		
				// Узнаем текущий баланс и email рекламодателя
				// Find out the current balance and advertiser email
				$sql_balance_reklamodatel = "SELECT balance,email FROM users WHERE id=$ownerid";
				$result_balance_reklamodatel = $mysqli->query($sql_balance_reklamodatel);
				$res_balance_reklamodatel=mysqli_fetch_array($result_balance_reklamodatel);
	
				// Назначаем переменную под текущий баланс рекламодателя
				// Assign a variable for the current balance of advertiser
				$balance_reklamodatel=htmlentities($res_balance_reklamodatel['balance']);
				
				// Назначаем переменную под email рекламодателя
				// Assign a variable by email advertiser
				$email_reklamodatel=htmlentities($res_balance_reklamodatel['email']);
	
				// Узнаем текущий баланс вебмастера и ID его реферера
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
				
				// Если присутствует заказ со статусом ОЖИДАЕТ и таким же InvoiceID то выполняем
				// If there is an order with the status WAITING and the same InvoiceID perform
				$sql_check_zakaz = "SELECT id FROM zakaz WHERE `invoice_id`='$yk_invoiceId' AND `status`='1'";
				$result_check_zakaz=$mysqli->query($sql_check_zakaz);
				if (mysqli_num_rows($result_check_zakaz) > 0) 
					{
					// Обновляем заказ (из статуса ОЖИДАЕТ в статус ПРИНЯТ)
					// Update the order (of the expected status ACCEPTED status)
					$sql_update_zakaz= "UPDATE `zakaz` SET `status`='3' WHERE `invoice_id`='$yk_invoiceId'";
					$result_update_zakaz=$mysqli->query($sql_update_zakaz);					
				
					// Если заказ успешно записался в базу, то изменяем баланс у пользователей, фиксируем финансовые логи и отправляем рекламодателю СМС о том что оплачен новый заказ
					// If the order is successfully written to the database , then change the balance of users , fix the financial logs and send SMS to the advertiser that paid for that new order
					$sql_check_zakaz = "SELECT id,zakaz_number FROM zakaz WHERE `user_id`='$userid' AND `offer_id`='$offerid' AND `owner_id`='$ownerid' AND `landing_id`='$landingid' AND `status`='3' AND `invoice_id`='$yk_invoiceId'";
					$result_check_zakaz=$mysqli->query($sql_check_zakaz);
					if (mysqli_num_rows($result_check_zakaz) > 0) 
						{
						$res_check_zakaz=mysqli_fetch_array($result_check_zakaz);
						$zakaz_id=htmlentities($res_check_zakaz['id']);
						$zakaz_number=htmlentities($res_check_zakaz['zakaz_number']);
						// Изменяем баланс у пользоваталей и фиксируем финансовые логи
						// Change the balance in polzovataley and fix the financial logs
					
						// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
						// If the order came from existing in the database webmaster, then execute
						if ($userid!='0')
							{
							// Начисляем комиссию на баланс вебмастеру
							// Commission is charged on the balance webmaster
							$sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`+'$summa_comission' WHERE `id`='$userid'";
							$result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);
			
							// Пишем в базу, в таблицу finances, информацию о начислении средств на баланс вебмастеру
							// Write to the database , in finances table, information about the funds be credited to the balance webmaster
							$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$userid','1','$summa_comission',5,'$balance_webmaster'+'$summa_comission','2')";
							$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
		
							// Начисляем комиссию системы на баланс CPA-сети
							// The system is charged a commission on CPA-network balance
							$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$summa_comission_cpa'";
							$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
							}
							// Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
							// If the order came without a webmaster, then execute
						else
							{
							// Начисляем на счет баланса CPA-сети средства вычтенные с баланса рекламодателя (комиссию вебмастера+комиссию CPA-сети)
							// Accrued on the account balance CPA-network money deducted from the advertiser's balance (the commission webmaster + CPA-network fee)
							$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$comission_all'";
							$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);	
							}
							
						// Начисляем средства на баланс рекламодателя
						// To accrue funds to balance the advertiser
						$sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`+'$dohod_reklamodatela' WHERE `id`='$ownerid'";
						$result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);	
			
						// Пишем в базу, в таблицу finances, информацию о начислении средств на баланс рекламодателю
						// Write to the database, in "finances" table, information about the funds be credited to the balance of advertiser
						$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$ownerid','1','$dohod_reklamodatela',17,'$balance_reklamodatel'+'$dohod_reklamodatela','2')";
						$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
				
						// Если у вебмастера есть рефовод, то начисляем рефоводу реферальские
						// If the webmaster has a referrer, the referrer accrue referral bonus
						if ($settings_refprocent!='0' && $refovod_webmaster!='0' && $refovod_webmaster!='')
							{
							// Начисляем реферальские на счет рефовода
							// Referral bonus is charged to the account of the referrer
							$summ_referal=$summa_comission/100*$settings_refprocent;
							$sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`+'$summ_referal' WHERE `id`='$refovod_webmaster'";
							$result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);	
							
							// Пишем в базу, в таблицу finances, информацию о начислении реферальских на баланс рефовода
							// Write to the database, the table "finances", information on the calculation of the balance of referrers to a referrer
							$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','1','$summ_referal',11,'$balance_refovod'+'$summ_referal','2')";
							$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
							}

						// Отправка E-mail рекламодателю
						// Sending E-mail to the advertiser
						$email_ok=htmlentities($res_getdataoffer['email_ok']);
						$email_box=htmlentities($res_getdataoffer['email_box']);
				
						if ($email_ok=='1')
							{
							$email=$email_box;
							$mail_subj = 'У Вас новый заказ в личном кабинете - CPA-сеть '.$settings_zagolovok;
							$mail_body = 'Здравствуйте!<br /><br />У Вас в личном кабинете CPA-сети '.$settings_zagolovok.', на оффере &laquo;'.$offer_name.'&raquo; появился новый необработанный заказ.<br />Пожалуйста, загляните и обработайте его, не забыв изменить статус заказа. Если у Вас будут вопросы или уточнения, пожалуйста, беспокойте техническую поддержку. Спасибо.<br /><br />CPA-сеть '.$settings_zagolovok.'<br />'.$settings_url;
							SendEMail($email, $mail_subj, $mail_body);
							$mail_sended = true;
							}
							
						// Отправка СМС рекламодателю
						// Sending SMS advertiser
						$url = $settings_url.'/sendsms.php'; 
						$data = array  
							(  
							'sms'			=>	'zakaz',
							'ob'			=>	$zakaz_id,
							'zakaz_number'	=>	$zakaz_number,
							'offer_id'		=>	$offerid,
							'owner_id'		=>	$ownerid
							);  
						$options = array ('http' => array ('header' => "Content-type: application/x-www-form-urlencoded\r\n", 'method'  => 'POST', 'content' => http_build_query($data)));  
						$context  = stream_context_create($options);  
						$result = file_get_contents($url, false, $context);  
				
						exit;
						}
					}
				}
			}				
		}
	exit;			
	}

?>