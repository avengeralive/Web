<?php 
namespace lib;

if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

/**
* class.WError.php
*
*Класс - библиотека с функциями для работы с ошибками 
*подгружается через автоподгрузку классов
*
* История:  2016.12.15 - файл создан
*
**/

class CError {

	//вывод alert ошибок 
	function Alert($ErrorNumber) {
	
		switch ($ErrorNumber) {
			case 1:
				$Text = 'Неверный ключ авторизации, попробуйте еще раз';
			break;
			case 2:
				$Text = 'Мы отправили Вам пиcьмо. Пожалуйcта, проверьте E-mail';
				$Time = 5000;
			break;
			case 3:
				$Text = 'Пользователь с указанным адресом не найден';
			break;
			case 4:
				$Text = 'Этот логин принадлежит другому пользователю';
			break;
			case 5:
				$Text = 'Произошла ошибка, обратитесь к администратору';
			break;
			case 6:
				$Text = 'Пожалуйста, введите корректный E-mail';
			break;
			case 7:
				$Text = '';
			break;
			case 8:
				$Text = '';
			break;
			case 9:
				$Text = '';
			break;
			case 10:
				$Text = '';
			break;
		}
	
		$Alert =  [
			'texts'		=> $Text,
			'times'		=> (!empty($Time)) ? (int)$Time : false
		];
		
		echo '<script>const Alert = Object.freeze(' . json_encode($Alert) . ')</script>';
	}
	


    //вывод ошибок 404
	function Error_Message($Code, $Text) {
		header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
		header('Status: 404 Not Found');
		echo '<!DOCTYPE html>
		<html><head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Ошибка!</title>
		<style>body.e404 {margin: 0;
    padding: 0;
    text-align: center;
    background: #f1f1f1;}
body.e404 > div {background: #507299;
    height: 320px;} 
body.e404 > div > div {display: inline-block;
    width: 1000px;}
.e404 a {font-family: arial;
    font-size: 14px;
    color: #4c4c4c;}
.e404 a:hover {text-decoration:none;}   
.e404 p {background: white;
    width: 300px;
    height: 101px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    font-size: 20px;
    font-family: arial;
    padding: 40px;
    border-radius: 2px;
    box-shadow: 0px 1px 1px #258ac1;
    cursor: default;
    margin: 0 0 65px;
    text-transform: lowercase;
    line-height: 1;
    color: #545454;}
.e404 b {display: block;
    text-align: left;
    margin-top: 50px;
    font-size: 120px;
    color: white;
    line-height: 1;
    cursor: default;}</style></head>
		<body class="e404">
		<div><div><b>' . $Code . '</b><p class="errormsg" >' . $Text . '</p><a href="/">Перейти на главную</a></div></div>
		</body></html>';
		die();
	}
}
