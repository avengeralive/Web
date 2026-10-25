<?php
include('cron_config.php');
include($P_CRON.'_incl_data/__config.php');
include($P_CRON.'_incl_data/class/__db_connect.php');

$time1 = microtime(true);//Мониторинг времени исполнения

for($n=8; $n<=11; $n++)
{
	//Подаем турнир для 8-11 уровней
	$inc = mysql_query('INSERT INTO `zayvki` (`noart`,`noeff`,`arand`,`comment`,`city`,`creator`,`type`,`time_start`,`timeout`,`min_lvl_1`,`min_lvl_2`,
	`max_lvl_1`,`max_lvl_2`,`razdel`,`time`,`priz`,`fastfight`,`invise`,`maxplayers`
	) VALUES (  "1","1","1","","capitalcity","0","0","300","60","'.$n.'","'.$n.'","'.$n.'","'.$n.'","5","'.time().'","1","1","1","20" )');
}

$priz = '<font color=red><b>Призовой хаот:</b>&nbsp;(без артефактов) для 8-11 уровней, начнётся через 5 минут!</font>';
mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`)
VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$priz."','".time()."','6','0','1')");

//Мониторинг времени исполнения
$time2 = microtime(true);
if($c['cron_log']==true) error_log(date('d-m-Y H:i:s')." cron_psh:".round($time2-$time1, 5)." sec");
?>