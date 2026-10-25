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
		echo '<b>'.$loc['subacc.php']['t10'].'</b><br /><select name="landing_id" onchange="javascript:showPageUrl();"><option>'.$loc['subacc.php']['t09'].'</option>';
	
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
		?>
		<script>
			$('p[name="url_place"]').html('<b><?php echo $loc['subacc.php']['t11']; ?></b><br /><input type="text" name="page_url" disabled="disabled" value="<?php echo $loc['subacc.php']['t22']; ?>" onchange="javascript:showButton();">');
		</script>
		<?php
	break;
	
	case "showLandingUrl":
		$landing_id=htmlentities($_POST['landing_id']);
		echo '<b>'.$loc['subacc.php']['t11'].'</b><br />';
		
		$sql_getlandingsdata = "SELECT url FROM landings WHERE id=$landing_id";
		$result_getlandingsdata  = $mysqli->query($sql_getlandingsdata);
		if (mysqli_num_rows($result_getlandingsdata) > 0) 
			{
			$res_getlandingsdata=mysqli_fetch_array($result_getlandingsdata);
			$landing_url=htmlentities($res_getlandingsdata['url']);
			echo $landing_url.' <input type="text" name="page_url" value="" onKeyUp="javascript:showButton();">';
			}
			else
			{
			echo '<input type="text" name="page_url" disabled="disabled" value="'.$loc['subacc.php']['t22'].'">';
			}
	break;	
	
	case "showButtonPlace":
		echo '<input type="submit" name="submit_subacc" class="others_button_sohranit" value="'.$loc['button']['t01'].'">';
	break;	
	}
	
?>