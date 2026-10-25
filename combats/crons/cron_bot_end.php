<?php
//Завершение боев ботов с ботами
include('cron_config.php');
include($P_CRON.'_incl_data/__config.php');
include($P_CRON.'_incl_data/class/__db_connect.php');
include($P_CRON.'_incl_data/class/__user.php');
include($P_CRON.'_incl_data/class/bot.priem.php');
include($P_CRON.'_incl_data/class/bot.logic.php');

set_time_limit(180);
$sleep1 = 0.02;//Задержка выполнения для снижения нагрузки - секунды
$max_razmen = 200;//Максимальное количество разменов в одном бою за один запуск
$max_btl = 10;//Максимальное количество боев проверять за один запуск
$time1 = microtime(true);//Мониторинг времени исполнения

$sp1 = mysql_query('SELECT `id` FROM `battle` WHERE `team_win` = "-1" AND `dungeon` = "0" AND `time_start` < "'.(time()-60).'" LIMIT '.$max_btl);
while( $pl1 = mysql_fetch_array($sp1) )
{
    $users = mysql_fetch_array(mysql_query('SELECT COUNT(`uid`) AS `count` FROM `battle_users` WHERE `battle`="'.$pl1['id'].'"'));
	if($users['count'] > 0)
	{
		$nobot = mysql_fetch_array(mysql_query('SELECT `u`.`id` FROM `users` AS `u` LEFT JOIN `battle_users` AS `b` ON `u`.`id` = `b`.`uid`
		WHERE `b`.`battle` = "'.$pl1['id'].'" AND `u`.`pass` != "saintlucia" AND `b`.`hp` > 0 LIMIT 1'));

		if(!isset($nobot['id']))//Бой, где остались только живые боты
		{
			$i = 1; $exit = 0;

			while(!$exit)//Цикл разменов
			{
				$team1 = mysql_fetch_array(mysql_query('SELECT COUNT(`uid`) AS `count` FROM `battle_users` WHERE `battle`="'.$pl1['id'].'" AND `team`="1" AND `hp` > 0'));
				$team2 = mysql_fetch_array(mysql_query('SELECT COUNT(`uid`) AS `count` FROM `battle_users` WHERE `battle`="'.$pl1['id'].'" AND `team`="2" AND `hp` > 0'));

				if($team1['count'] && $team2['count'] && $i <= $max_razmen)
				{
	                //error_log('Размен:'.$i.' команда1: '.$team1['count'].' команда 2: '.$team2['count']);
					$sp = mysql_query('SELECT `b`.`uid` FROM `battle_users` AS `b` LEFT JOIN `stats` AS `s` ON `b`.`uid` = `s`.`id`
					WHERE `b`.`battle`="'.$pl1['id'].'" AND `b`.`hp` > 0 ORDER BY `s`.`nextAct` ASC');//Все игроки боя

					while($pl = mysql_fetch_array($sp)) {botLogic::start($pl['uid']);}//pr('user: '.$pl['uid']);

					mysql_query('UPDATE `stats` SET `nextAct` = "'.time().'" WHERE `id` = "'.$pl['uid'].'" LIMIT 1');
					mysql_query('UPDATE `users` SET `online`  = "'.time().'" WHERE `id` = "'.$pl['uid'].'" LIMIT 1');

					time_sleep_until(microtime(true)+$sleep1);
	                $i++;
				} else $exit = 1;
			}
	        //if($i > 1) eLog('Бой:'.$pl1['id'].' Разменов: '.($i-1));
		}
	}
}

//Удаляем пустые бои и ботов из них
$sp1 = mysql_query('SELECT `id` FROM `battle` WHERE `team_win` = "-1" AND `time_start` < "'.(time()-60).'" LIMIT '.$max_btl);
while( $pl1 = mysql_fetch_array($sp1) )
{
    $users = mysql_fetch_array(mysql_query('SELECT COUNT(`uid`) AS `count` FROM `battle_users` WHERE `battle`="'.$pl1['id'].'"'));
	if($users['count'] == 0)
	{
        mysql_query('DELETE FROM `battle` WHERE `id` = "'.$pl1['id'].'" LIMIT 1');
        mysql_query('UPDATE `users` SET `battle`  = "0" WHERE `battle` = "'.$pl['id'].'" LIMIT 1');
        //eLog('Бой:'.$pl1['id'].' Игроков: '.$users['count'].' -  удален');
	}
}

//Мониторинг времени исполнения
$time2 = microtime(true);
if($c['cron_log']==true) eLog(date('d-m-Y H:i:s')." cron_bot_end:".round($time2-$time1, 5)." sec");
?>