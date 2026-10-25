<?php

// Если не переданы обязательные параметры, то редиректим в кабинет.
// If you do not pass the required parameters , then redirects to the cabinet
if (!isset($_POST['sendsms']) && $_POST['sendsms']!='ok') 
	{
	Header ('Location: ./cabinet.php');
	exit;
	}

?>