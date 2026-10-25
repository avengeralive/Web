<?php

// Если в базе не задан текущий урл, или он не совпадает с текущим, то обновляем его
// If the database is not set to the current URL, or it does not match with the current, then update it
if ($settings_url!=site_url()) 
	{
	$site_url=site_url();
	$sql_update_site_url = "UPDATE settings SET `url`='$site_url'";
	$result_update_site_url = $mysqli->query($sql_update_site_url);
	}
	
?>