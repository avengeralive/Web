<?php

// Открываем сессию
// Open session
session_start();

// Подключаем необходимые служебные файлы и библиотеки
// Connect the necessary office and library files
include './includes/includes_login.php';

// Пишем в базу данные о посетителе
// Write in the visitor data base
include_once './includes/userslog/index.php';

// Подключаем системную ТДС
// Connect system TDS
include './includes/systemtds/index.php';
	
// Получение списка выплат WebMoney.Masspayment
// Get the list of payments WebMoney.Masspayment
if (isset($_GET['masspay']) && $_GET['masspay']=='ok')
	{
	$masspay='<payments xmlns="http://tempuri.org/ds.xsd">';
	$sql = "SELECT id,date,user_id,summ FROM finances_log WHERE `description`='4' AND `status`='1' ORDER BY `id` DESC";
	$result = $mysqli->query($sql);
	if (mysqli_num_rows($result) > 0) 
		{
		while($res=mysqli_fetch_array($result)) 
			{
			$komu_vyplata=htmlentities($res['user_id']);
			
			// Определяем WMR-кошельки куда будем делать выплаты
			// Determine the WMR- wallets which will make payments
			$sql_userdata = "SELECT email,wmr FROM users WHERE `id`='$komu_vyplata'";
			$result_userdata = $mysqli->query($sql_userdata);
			$res_userdata=mysqli_fetch_array($result_userdata);
			
			$id_userdata=htmlentities($res['id']);
			$summ_userdata=htmlentities($res['summ']);
			$email_userdata=htmlentities($res_userdata['email']);
			$wmr_userdata=htmlentities($res_userdata['wmr']);

			$masspay.='
				<payment>
					<Destination>'.$wmr_userdata.'</Destination>
					<Amount>'.$summ_userdata.'</Amount>
					<Description>'.$settings_zagolovok.': Выплата пользователю '.$email_userdata.' по заявке №'.$id_userdata.'</Description>
					<Id>'.$id_userdata.'</Id>
				</payment>
			';
			}
		}
	$masspay.='</payments>';
	header('Content-type: text/plain');
	header('Content-Disposition: attachment; filename=masspay.xml');
	echo $masspay;
	exit;
	}
else
	{
	Header('Location: ./news.php');
	exit;
	}

?>