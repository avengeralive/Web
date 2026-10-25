<?php
if (isset($_POST['track_number']) && isset($_POST['zakaz_number']) && isset($_POST['offer_id']) && isset($_POST['owner_id']) && isset($_POST['ob']))
	{
	$track_number=htmlentities($_POST['track_number']);
	$zakaz_number=htmlentities($_POST['zakaz_number']);
	$offer_id=htmlentities($_POST['offer_id']);
	$owner_id=htmlentities($_POST['owner_id']);
	$ob=htmlentities($_POST['ob']);
	// Проверка, что полученные данные соответствуют действительности
	$sql_data_check = "SELECT tracking_number FROM zakaz WHERE `zakaz_number`='$zakaz_number' AND `offer_id`='$offer_id' AND `owner_id`='$owner_id' AND `id`='$ob'";
	$result_data_check = $mysqli->query($sql_data_check);
	if (mysqli_num_rows($result_data_check)>0) 
		{
		$res_data_check=mysqli_fetch_array($result_data_check);
		$tracking_number_from_zakaz=htmlentities($res_data_check['tracking_number']);
		// Если трек-номер из указанного заказа совпадает с полученным от пользователя треком, то трекаем почтовое отправление
		if ($track_number==$tracking_number_from_zakaz)
			{
			include './modules/russianpost/lib/functions.php';
			$config = array ('login' => $settings_russianpost_login, 'password' => $settings_russianpost_password);
			$api = new RPostApi($config);
			$ticket = $api->getTicketSingle($track_number, true);
			echo $ticket;
			}
		}
	}
?>