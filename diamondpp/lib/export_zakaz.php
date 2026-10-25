<?php

// Если был запрос на экспорт базы заказов в CSV, то выполняем...
// If there was a request for export of base of orders to CSV, then carry out...
if (isset($_GET['export_zakaz']) && (isset($_POST['razdelitel']) && $_POST['razdelitel']!='') && (isset($_POST['extension']) && $_POST['extension']!='') && ($user_tip=='40' || $user_tip=='70') && isset($_POST['pole1']) && isset($_POST['pole2']) && isset($_POST['pole3']) && isset($_POST['pole4']) && isset($_POST['pole5']) && isset($_POST['pole6']) && isset($_POST['pole7']) && isset($_POST['pole8']) && isset($_POST['pole9']) && isset($_POST['pole10']) && isset($_POST['pole11']) && isset($_POST['pole12']) && isset($_POST['pole13']) && isset($_POST['pole14']) && isset($_POST['pole15']) && isset($_POST['pole16']) && isset($_POST['pole17']))
	{ 
	$pole1=htmlentities($_POST['pole1']); $pole2=htmlentities($_POST['pole2']);	$pole3=htmlentities($_POST['pole3']); $pole4=htmlentities($_POST['pole4']);	$pole5=htmlentities($_POST['pole5']); $pole6=htmlentities($_POST['pole6']);	$pole7=htmlentities($_POST['pole7']); $pole8=htmlentities($_POST['pole8']);	$pole9=htmlentities($_POST['pole9']); $pole10=htmlentities($_POST['pole10']);	$pole11=htmlentities($_POST['pole11']); $pole12=htmlentities($_POST['pole12']);	$pole13=htmlentities($_POST['pole13']);	$pole14=htmlentities($_POST['pole14']);	$pole15=htmlentities($_POST['pole15']);	$pole16=htmlentities($_POST['pole16']);	$pole17=htmlentities($_POST['pole17']);	
	$pole_array='';
        $pole_array.='id,';
	if ($pole1!='0') {$pole_array.=$pole1.',';}
	if ($pole2!='0') {$pole_array.=$pole2.',';}
	if ($pole3!='0') {$pole_array.=$pole3.',';}
	if ($pole4!='0') {$pole_array.=$pole4.',';}
	if ($pole5!='0') {$pole_array.=$pole5.',';}
	if ($pole6!='0') {$pole_array.=$pole6.',';}
	if ($pole7!='0') {$pole_array.=$pole7.',';}
	if ($pole8!='0') {$pole_array.=$pole8.',';}
	if ($pole9!='0') {$pole_array.=$pole9.',';}
	if ($pole10!='0') {$pole_array.=$pole10.',';}
	if ($pole11!='0') {$pole_array.=$pole11.',';}
	if ($pole12!='0') {$pole_array.=$pole12.',';}
	if ($pole13!='0') {$pole_array.=$pole13.',';}
	if ($pole14!='0') {$pole_array.=$pole14.',';}
	if ($pole15!='0') {$pole_array.=$pole15.',';}
	if ($pole16!='0') {$pole_array.=$pole16.',';}
	if ($pole17!='0') {$pole_array.=$pole17.',';}
	$pole_array=mb_substr($pole_array, 0, strlen($pole_array) - 1, 'UTF-8');
	
	if (isset($_POST['zakaz_numbers']) && $_POST['zakaz_numbers']!='')
		{
		$zakaz_numbers=htmlentities($_POST['zakaz_numbers']);
		if ($user_tip=='40')
			{
			$sql_zakaz = "SELECT $pole_array FROM zakaz WHERE `owner_id`='$user_id' AND `id` IN ($zakaz_numbers)";	
			}
		elseif ($user_tip=='70')
			{
			$sql_zakaz = "SELECT $pole_array FROM zakaz WHERE `id` IN ($zakaz_numbers)";	
			}
		}
	else
		{
		if ($user_tip=='40')
			{
			$sql_zakaz = "SELECT $pole_array FROM zakaz WHERE `owner_id`='$user_id'";		
			}
		elseif ($user_tip=='70')
			{
			$sql_zakaz = "SELECT $pole_array FROM zakaz";		
			}			
		}
	$result_zakaz = $mysqli->query($sql_zakaz);
	if (mysqli_num_rows($result_zakaz) > 0) 
		{
		$razdelitel=htmlentities($_POST['razdelitel']);
		if ($razdelitel=='1') {$razdelitel=';';} elseif ($razdelitel=='2') {$razdelitel=',';} else {$razdelitel=';';}
		$extension=htmlentities($_POST['extension']);
		if ($extension=='1') {$extension='.txt';} elseif ($extension=='2') {$extension='.csv';} else {$extension='.txt';}
		$path_file='./tmp/';
		$download_file='export_zakaz_userid_'.$user_id.$extension;
		$f = fopen($path_file.$download_file, 'w+b');
		$name_array=$pole_array;
                $name_array=str_replace('id', 'id', $name_array);
		$name_array=str_replace('date', $loc['export_zakaz.php']['t12'], $name_array);
		$name_array=str_replace('offer_id', $loc['export_zakaz.php']['t13'], $name_array);
		$name_array=str_replace('cena', $loc['export_zakaz.php']['t14'], $name_array);
		$name_array=str_replace('kolvo', $loc['export_zakaz.php']['t15'], $name_array);
		$name_array=str_replace('name', $loc['export_zakaz.php']['t16'], $name_array);
		$name_array=str_replace('phone', $loc['export_zakaz.php']['t17'], $name_array);
		$name_array=str_replace('email', $loc['export_zakaz.php']['t18'], $name_array);
		$name_array=str_replace('client_address', $loc['export_zakaz.php']['t19'], $name_array);
		$name_array=str_replace('country', $loc['export_zakaz.php']['t20'], $name_array);
		$name_array=str_replace('region', $loc['export_zakaz.php']['t21'], $name_array);
		$name_array=str_replace('town', $loc['export_zakaz.php']['t22'], $name_array);
		$name_array=str_replace('street', $loc['export_zakaz.php']['t23'], $name_array);
		$name_array=str_replace('status', $loc['export_zakaz.php']['t25'], $name_array);
		$name_array=str_replace('artikul', $loc['export_zakaz.php']['t26'], $name_array);
		$name_array=str_replace('comments', $loc['export_zakaz.php']['t27'], $name_array);
		$name_array=str_replace('ip', $loc['export_zakaz.php']['t28'], $name_array);
		$name_array=str_replace('referer', $loc['export_zakaz.php']['t29'], $name_array);
		$name_array=str_replace(',', $razdelitel, $name_array);
		fputs($f, "\xEF\xBB\xBF");
		fputs($f, "$name_array\r\n");
		while($res_zakaz=mysqli_fetch_row($result_zakaz)) 
			{
			fputcsv($f, $res_zakaz, $razdelitel);
			}
		fclose($f);
		header ("Content-Type: application/octet-stream");
		header ("Accept-Ranges: bytes");
		header ("Content-Length: ".filesize($path_file.$download_file));  
		header ("Content-Disposition: attachment; filename=".$download_file);  
		readfile($path_file.$download_file);		
		exit;
		}
	else
		{
		Header ('Location: ./export_zakaz.php?xtext=2');
		exit;			
		}
	}

?>