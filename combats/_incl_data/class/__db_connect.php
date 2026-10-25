<?php

if(!defined('GAME'))
{
	die();
}

if( function_exists('date_default_timezone_set') )
{
	date_default_timezone_set('Europe/Moscow');
}
session_start();
/*if($_SESSION['tbl'] > time())
{
	unset(
		$_POST['buy'] , $_POST['item'] , $_GET['buy'] , $_GET['item']
	);
}else{
	$_SESSION['tbl'] = time() + 0.500;
}*/
$dbgo = mysql_pconnect('localhost','admin_default','lkb9fwxCTI');//рабочий
//$dbgo = mysql_pconnect('localhost','admin_default','cgipxp6i0Z');//Тест

mysql_select_db('admin_default',$dbgo);
mysql_query('SET NAMES cp1251');

if(!function_exists('GetRealIp'))
{
	function GetRealIpTest()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];
		else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		return $_SERVER['REMOTE_ADDR'];
	}
	$ipban = GetRealIpTest();
}else{
	$ipban = GetRealIp();
}

$ipbant = mysql_fetch_array(mysql_query('SELECT `id` FROM `block_ip` WHERE `ip` = "'.mysql_real_escape_string($ipban).'" OR `ip` = "'.mysql_real_escape_string($_COOKIE['ip']).'" LIMIT 1'));
if(isset($ipbant['id']) || isset($_GET['ipban']))
{
	echo 'Ваш ip %<b>'.$ipban.'</b> заблокирован. Код блокировки: '.$ipbant['id'].'<br>По всем возникшим вопросам обращайтесь по эл.почте: <a href="mailto:support@testcombats.ru">support@testcombats.ru</a>';
	die();
}
unset($ipban,$ipbant);
?>