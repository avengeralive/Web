<?php

// Если был запрос на изменение текущего языка
// If there was a request to change the current language
if (isset($_GET['language']))
	{
	$get_language=htmlentities($_GET['language']);
	if (file_exists('./localizations/'.$get_language.'.php')) 
		{
		$_SESSION['language']=$get_language;
		$localization_file = $_SESSION['language'].'.php';
		if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!='')
			{
			header ('Location: '.$_SERVER['HTTP_REFERER']);
			exit;
			}
		else
			{
			header ('Location: ./');
			exit;
			}			
		} 
	}
// Если в сессии уже передается информация о текущем языке
// If the session has already passed the information on the current language
if (isset($_SESSION['language']))
	{
	$get_language=htmlentities($_SESSION['language']);
	if (file_exists('./localizations/'.$get_language.'.php')) 
		{
		$_SESSION['language']=$get_language;
		$localization_file = $_SESSION['language'].'.php';
		} 
	}	
// Если в сессии не была передана информация о текущем языке и не было запроса на изменение языка
// То выводим локализацию указанную принудительно по умолчанию
// If the session has not been transmitted to the current language information and no request for changing the language
// the output location specified default force
else
	{
	// $_SESSION['language']='english';
	$_SESSION['language']='russian';
	$localization_file = $_SESSION['language'].'.php';	
	}

?>