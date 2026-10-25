<?php
include('cron_config.php');
include($P_CRON.'_incl_data/__config.php');
include($P_CRON.'_incl_data/class/__db_connect.php');
include($P_CRON.'_incl_data/class/__user.php');
include($P_CRON.'_incl_data/class/__zv.php');

$time1 = microtime(true);//Мониторинг времени исполнения

function inuser_go_btl($id)
{
	if(isset($id['id']))
	{
		echo file_get_contents('https://testcombats.ru/jx/battle/refresh.php?uid='.$id['id'].'&cron_core='.md5($id['id'].'530f94c2a4868dac1ba81eb58d2bc098'.$id['pass']).'&pass='.$id['pass']);
		//echo '<hr>';
	}
}

//
$sp = mysql_query('SELECT `id`,`time_start` FROM `battle` WHERE `team_win` = "-1" AND `time_over` = "0" AND `time_start` < "'.(time()-3600).'" LIMIT 100');
while($pl = mysql_fetch_array($sp))
{
	$user1 = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `battle` = "'.$pl['id'].'" LIMIT 1'));
	inuser_go_btl($user1);
}

//Проверка боев
$hend = 1; //Через сколько часов проверять и время бездействия

$sp = mysql_query('SELECT * FROM `battle` WHERE `time_start` < "'.( time() - 3600*$hend ).'" AND `team_win` = -1 LIMIT 100');
while( $pl = mysql_fetch_array($sp) )
{
	$test = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$pl['id'].'" ORDER BY `time` DESC LIMIT 1'));
	if(!isset($test['id']) || $test['time'] < ( time() - 3600*$hend ) )
	{
		mysql_query('UPDATE `battle` SET `team_win` = "0",`time_over` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		mysql_query('UPDATE `users` SET `battle` = "0" WHERE `battle` = "'.$pl['id'].'"');
	}
}

$zv->testCronZv();

//Мониторинг времени исполнения
$time2 = microtime(true);
if($c['cron_log']==true) error_log(date('d-m-Y H:i:s')." cron_zv:".round($time2-$time1, 5)." sec");
?>