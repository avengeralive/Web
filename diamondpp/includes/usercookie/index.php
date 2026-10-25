<?php

// Проверяем наличие куки
// Check for cookies
if (isset($_COOKIE['user_session'])) 
	{
	// Если кука есть, то обновляем ее
	// If the cookie is, update it
    $user_session = htmlentities($_COOKIE['user_session']);
	} 
else 
	{
	// Если куки нет, то создаем ее на основе IP
	// If the cookie is not present, create it based on IP
    $user_session = md5(md5($ip));
    }
// Обновление куки
// Update cookies
//setcookie("user_session", $user_session, time()+60*60*24*365);

?>