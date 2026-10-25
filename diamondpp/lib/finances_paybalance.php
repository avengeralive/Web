<?php

// Блок с инициированием платежа. Передача и обработка данных из платежной формы
// Если были переданы данные из формы пополнения баланса, то выполняем

// Block to initiate the payment. Transmission and processing of data from the payment form
// If the data has been transferred from the mold to replenish the balance, then execute
if (isset($_POST['submit_paybalance']) && isset($_POST['paysys']) && isset($_POST['amount']))
	{
	// Проверяем наличие переменных указывающих на название платежной системы и сумму пополнения баланса
	// Check for variables indicating the name of the payment system and the amount of deposit balance
	$amount = isset($_POST['amount']) ? intval($_POST['amount']) : 0;
	$paysys = isset($_POST['paysys']) ? htmlentities($_POST['paysys']) : 'wm';
	
	// Если сумма неуказана, равна нулю или меньше нуля, то выводим сообщение об этом
	// If an unspecified amount is zero or less than zero, the message about this
	if($amount<=0)
		{
		include './templates/'.$template.'/in_header.php';
		echo '<p>'.$loc['finances.php']['t57'].'<br /><br /><a href="./finances.php">'.$loc['finances.php']['t54'].'</a></p>';
		include './templates/'.$template.'/in_footer.php';
		exit;
		}	
		
	// Если при пополнении счета была указана платежная система WebMoney, то выполняем
	// If the WebMoney payment system was available for funding the account , then perform
	if ($paysys=='wm')
		{
		// Пишем в базу информацию о попытке пополнения баланса
		// Write to the database information about an attempt to recharge
		$sql_log = "INSERT INTO finances_log (`user_id`,`operation`,`summ`,`description`,`balance`) values ('$user_id','1','$amount',1,'$user_balance')";
		$result_log = $mysqli->query($sql_log);
		// Формируем номер счета
		// Form the account number
		$inv_id = $mysqli->insert_id;
		$desc = base64_encode($loc['finances.php']['t58'].$inv_id);
		$html = '<form method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp" name="payform">
		<input type="hidden" name="LMI_PAYMENT_AMOUNT" value="'.$amount.'">
		<input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="'.$desc.'">
		<input type="hidden" name="LMI_PAYMENT_NO" value="'.$inv_id.'">
		<input type="hidden" name="LMI_PAYEE_PURSE" value="'.$settings_webmoney_wmr.'">
		<input type="hidden" name="LMI_SIM_MODE" value="0">
		<input type="hidden" name="CLIENT_ID" value="'.$user_id.'">
		<script>document.payform.submit();</script>';
		}
	// Если при пополнении счета была указана платежная система Яндекс.Касса, то выполняем
	// If the payment system Yandeks.Kassa was listed for funding the account, then perform
	elseif ($paysys=='yk')
		{
		// Пишем в базу информацию о попытке пополнения баланса
		// Write to the database information about an attempt to recharge
		$sql_log = "INSERT INTO finances_log (`user_id`,`operation`,`summ`,`description`,`balance`) values ('$user_id','1','$amount',3,'$user_balance')";
		$result_log = $mysqli->query($sql_log);
		// Формируем номер счета
		// Form the account number
		$inv_id = $mysqli->insert_id;
		$html = '<form method="POST" action="'.$settings_yk_obrabotchik.'" name="payform">
		<input type="hidden" name="scId" value="'.$settings_yk_scid.'">
		<input type="hidden" name="shopId" value="'.$settings_yk_shopid.'">
		<input type="hidden" name="customerNumber" value="'.$user_id.'">
		<input type="hidden" name="Sum" value="'.$amount.'">
		<input type="hidden" name="inv_id" value="'.$inv_id.'">
		<input type="hidden" name="pay" value="paybalance">		
		</form>
		<script>document.payform.submit();</script>';
		}
	// Если не указана платежная система, то выводим сообщение об этом
	// If no payment system, the message about this
	else
		{
		include './templates/'.$template.'/in_header.php';
		echo '<p>'.$loc['finances.php']['t53'].'<br /><br /><a href="./finances.php">'.$loc['finances.php']['t54'].'</a></p>';
		include './templates/'.$template.'/in_footer.php';
		exit;
		}
	echo $html;
	exit;
	}

// Если баланс был успешно пополнен, то выводим сообщение об этом
// If the balance has been successfully topped up, the message about this
if ((isset($_GET['act']) && $_GET['act']=='result') && (isset($_GET['type']) && $_GET['type']=='success'))
	{
	Header('Location: ./finances.php?success');
	exit;
	}

// Если баланс НЕ был успешно пополнен, то выводим сообщение об этом
// If the balance has not been successfully topped up, the message about this
if ((isset($_GET['act']) && $_GET['act']=='result') && (isset($_GET['type']) && $_GET['type']=='fail'))
	{
	Header('Location: ./finances.php?fail');
	exit;
	}	

?>