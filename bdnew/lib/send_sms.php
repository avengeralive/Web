<?php

// Блок с отправкой СМС
// Block with sending SMS
if ((isset($_GET['sms']) && $_GET['sms']!='') && (($_GET['sms']=='send') || ($_GET['sms']=='way') || ($_GET['sms']=='success')) && (isset($_GET['ob']) && $_GET['ob']!=''))
	{
	// Отправка СМС-уведомления
	// zakaz	- СМС уведомление рекламодателю о новом поступившем заказе
	// send		- СМС уведомление клиенту о том что заказ ему отправлен
	// way		- СМС уведомление клиенту о том что заказ в пути
	// success	- СМС уведомление клиенту о том что заказ можно получать
	
	// Sending SMS notifications
	// zakaz - SMS notification to the advertiser of a new incoming orders
	// send - SMS notification to the client that he sent an order
	// way - SMS notification to the customer that the order in a way that
	// success - SMS notification to the customer that the order that you can receive	
	
	$sms_tip=htmlentities($_GET['sms']);
	$ob=htmlentities($_GET['ob']);
	
	// Берем из базы телефон клиента сделавшего заказ
	// Get the client base of the phone made ??the order
	$sql_zakaz_data = "SELECT offer_id,phone FROM zakaz WHERE `id`='$ob' AND `owner_id`='$user_id'";
	$result_zakaz_data = $mysqli->query($sql_zakaz_data);
	if (mysqli_num_rows($result_zakaz_data) > 0) 
		{
		$res_zakaz_data=mysqli_fetch_array($result_zakaz_data);
		$client_phone=htmlentities($res_zakaz_data['phone']);
		$offer_id=htmlentities($res_zakaz_data['offer_id']);
		}
	
	include './modules/sms/sendsms.php';
	unset ($sms_tip);
						
	header('location:' . htmlentities($_SERVER['HTTP_REFERER']));
	exit;
	}

?>