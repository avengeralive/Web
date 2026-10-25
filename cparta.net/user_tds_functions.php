<?php

// Подключаем файл конфигурации
// Connect configuration file
include './includes/config.php';

// Подключаем файл с функциями
// Connect to the file functions
include './includes/functions.php';

// Подключаем файл локализации
// Connect the localization file
include './localizations/'.$localization_file;

switch ($_POST['action'])
	{
	case "showLandingsNames":
		$offer_id=htmlentities($_POST['offer_id']);
		echo '<b>'.$loc['user_tds.php']['t36'].'</b><br /><select name="landing_id"><option value="">'.$loc['user_tds.php']['t04'].'</option>';
	
		$sql_getlandingsdata = "SELECT id,name FROM landings WHERE offer_id=$offer_id ORDER BY id ASC";
		$result_getlandingsdata  = $mysqli->query($sql_getlandingsdata );
		if (mysqli_num_rows($result_getlandingsdata) > 0) 
			{
			while ($res_getlandingsdata=mysqli_fetch_array($result_getlandingsdata)) 
				{
				$landing_id=htmlentities($res_getlandingsdata['id']);
				$landing_name=htmlentities($res_getlandingsdata['name']);
				echo '<option value="'.$landing_id.'">'.$landing_name.'</option>';
				}
			}
		echo '</select>';
	break;
	case "showLandingsNames2":
		$offer_dest_id=htmlentities($_POST['offer_dest_id']);
		echo '<b>'.$loc['user_tds.php']['t36'].'</b><br /><select name="landing_dest_id"><option value="">'.$loc['user_tds.php']['t04'].'</option>';
	
		$sql_getlandingsdata = "SELECT id,name FROM landings WHERE offer_id=$offer_dest_id ORDER BY id ASC";
		$result_getlandingsdata  = $mysqli->query($sql_getlandingsdata );
		if (mysqli_num_rows($result_getlandingsdata) > 0) 
			{
			while ($res_getlandingsdata=mysqli_fetch_array($result_getlandingsdata)) 
				{
				$landing_dest_id=htmlentities($res_getlandingsdata['id']);
				$landing_dest_name=htmlentities($res_getlandingsdata['name']);
				echo '<option value="'.$landing_dest_id.'">'.$landing_dest_name.'</option>';
				}
			}
		echo '</select>';
	break;	
	}
	
?>