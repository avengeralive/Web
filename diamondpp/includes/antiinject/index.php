<?php

// Предотвращаем SQL-инъекции для всех передаваемых данных
// Prevent SQL-injection for all data

if(isset($_SESSION)&&sizeof($_SESSION)) 
	{
	foreach($_SESSION as $key => $value) 
		{
		$_SESSION[$key]=$mysqli->real_escape_string($value);
		}
	}
if(isset($_POST)&&sizeof($_POST)) 
	{
	foreach($_POST as $key => $value) 
		{
		if(!is_array($_POST[$key]))
			{
			$_POST[$key]=$mysqli->real_escape_string($value);
			}
		}
	}
if(isset($_GET)&&sizeof($_GET)) 
	{
	foreach($_GET as $key => $value) 
		{
		$_GET[$key]=$mysqli->real_escape_string(urldecode($value));
		}
	}
	
?>