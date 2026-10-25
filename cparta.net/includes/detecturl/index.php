<?php

// Определяем урл скрипта, включая и тип соединения (HTTP или HTTPS)
// Determine the URL of the script, including the connection type (HTTP or HTTPS)
function site_url()
	{
	$tekushiy_url = '';
	$default_port = 80;
	if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) 
		{
		$tekushiy_url .= 'https://';
		$default_port = 443;
		}
		else 
		{
		$tekushiy_url .= 'http://';
		}
	$tekushiy_url .= $_SERVER['SERVER_NAME'];
	if ($_SERVER['SERVER_PORT'] != $default_port) 
		{
		$tekushiy_url .= ':'.$_SERVER['SERVER_PORT'];
		}
	return $tekushiy_url;
	}
	
?>