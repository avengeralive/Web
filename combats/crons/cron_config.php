<?php
//Для кронов
$allow_ip = array('127.0.0.1', '144.91.105.4');
if(isset($_SERVER['SERVER_ADDR'])) $allow_ip[] = $_SERVER['SERVER_ADDR'];
$P_CRON = '/home/admin/web/testcombats.ru/public_html/';
$CRON_HOST = 'testcombats.ru';

define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");

function e($t)
{
	mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("core #'.date('d.m.Y').' %'.date('H:i:s').' (Критическая ошибка): <b>'.mysql_real_escape_string($t).'</b>","capitalcity","Багнутый","6","1","-1")');
}

function send_chat($type,$from,$text,$time)
{
	mysql_query('INSERT INTO `chat` (`text`,`city`,`login`,`to`,`type`,`new`,`time`,`room`) VALUES ("'.mysql_real_escape_string($text).'","capitalcity","'.mysql_real_escape_string($from).'","","'.$type.'","1","'.mysql_real_escape_string($time).'","3")');
}
?>