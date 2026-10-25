<?php
include($P_CRON.'_incl_data/__config.php');
include($P_CRON.'_incl_data/class/__db_connect.php');
include($P_CRON.'_incl_data/class/__user.php');
include($P_CRON.'_incl_data/class/bot.priem.php');
include($P_CRON.'_incl_data/class/bot.logic.php');
$ADMIN = 0;
//dStart();
$time1 = microtime(true);//ћониторинг времени исполнени€

$btltest = array(); //$btl_ref = array(); $count = array(0,0,0,0,0,0);
//$minutes = array(10, 30, 50);//минуты бездействи€ ботов - зачем это нужно?
$bots_exp = array(8=>400000, 9=>3500000, 10=>18000000);

$sp = mysql_query('SELECT `u`.* , `s`.* FROM `stats` AS `s` LEFT JOIN `users` AS `u` ON `u`.`id` = `s`.`id`  WHERE `u`.`pass` = "saintlucia" ORDER BY `s`.`nextAct` ASC LIMIT 100');

while($pl = mysql_fetch_array($sp))
{
	$upd1 = 0; $upd2 = 0;
    //if($pl['id']==3175090) pr('bot:'.$pl['login']);
	if( $pl['zv'] > 0 )
	{
		$zv = mysql_fetch_array(mysql_query('SELECT `id`,`razdel` FROM `zayvki` WHERE `id` = "'.$pl['zv'].'" AND `btl_id` = 0 LIMIT 1'));
		if(!isset($zv['id']) || $zv['razdel'] != 5 )
		{
			mysql_query('UPDATE `stats` SET `zv` = 0 WHERE `id` = "'.$pl['id'].'" LIMIT 1');
            $pl['zv'] = 0;
            $upd1 = 1;
		}
	}

	if( $pl['battle'] == -1 )
	{
		mysql_query('UPDATE `users` SET `battle` = 0, `ipreg` = 0 WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		if(!$upd1) mysql_query('UPDATE `stats` SET `zv` = 0 WHERE `id` = "'.$pl['id'].'" LIMIT 1');

		$pl['battle'] = 0;
		$pl['ipreg'] = 0;
        $upd2 = 1;
	}

	//if(in_array(intval(date('i')), $minutes) &&  $pl['zv'] == 0 && !$upd2) mysql_query('UPDATE `users` SET `ipreg` = 0, `ipreg_time` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
	
	if( (!isset($btltest2[$pl['battle']]) || $btltest2[$pl['battle']] == 0) && $pl['battle'] > 0)
	{
		$btltest2[$pl['battle']]++;
		inuser_go_btl($pl);
		//pr('bot: '.$pl['login'].' ['.$pl['id'].'] - inBATTLE: '.$pl['battle']);//dg
	}
	
	if( $pl['zv'] == 0 && ($pl['battle'] == 0 || !isset($btltest[$pl['battle']]) || $btltest[$pl['battle']] < 1))
	{
		$btltest[$pl['battle']]++;
		$upd = ',`afk` = ""';
	} else $upd = '';

	if($pl['timereg'] == 0) mysql_query('UPDATE `users` SET `timereg` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');

	//ќграничение опыта ботам
	if( $pl['exp'] > $bots_exp[$pl['level']] ) mysql_query('UPDATE `stats` SET `exp` = '.$bots_exp[$pl['level']].' WHERE `id` = "'.$pl['id'].'" LIMIT 1');

	if( $pl['bot'] == 0 ) mysql_query('UPDATE `stats` SET `bot` = "2" WHERE `id` = "'.$pl['id'].'" LIMIT 1');

	mysql_query('UPDATE `stats` SET `nextAct` = "'.time().'"  WHERE `id` = "'.$pl['id'].'" LIMIT 1');
	mysql_query('UPDATE `users` SET `online` = "'.time().'"'.$upd.' WHERE `id` = "'.$pl['id'].'" LIMIT 1');
	//if($pl['id']==3175090) pr('zv:'.$pl['zv'].' bat: '.$pl['battle'].' btltest: '.$btltest[$pl['battle']]);
	//zv:0 bat: 0 btltest: 21
	if( $pl['zv'] == 0 && ($pl['battle'] == 0 || !isset($btltest[$pl['battle']]) || $btltest[$pl['battle']] < 1)) botLogic::start( $pl['id'] );
}
//dStart();
//dPrint();
//ћониторинг времени исполнени€
$time2 = microtime(true);
if($c['cron_log']==true)error_log(date('d-m-Y H:i:s')." cron_bot_core:".round($time2-$time1, 5)." sec");

function inuser_go_btl($id)
{
	global $c;

	if(isset($id['id']))
	{
		echo file_get_contents('https://'.$c['host'].'/jx/battle/refresh.php?uid='.$id['id'].'&cron_core='.md5($id['id'].'530f94c2a4868dac1ba81eb58d2bc098'.$id['pass']).'&pass='.$id['pass']);
	}
}
?>