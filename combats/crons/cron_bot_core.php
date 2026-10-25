<?php
include('cron_config.php');
include($P_CRON.'_incl_data/__config.php');
include($P_CRON.'_incl_data/class/__db_connect.php');
include($P_CRON.'_incl_data/class/__user.php');
include($P_CRON.'_incl_data/class/bot.priem.php');
include($P_CRON.'_incl_data/class/bot.logic.php');

$count = array(
	0,
	0,
	0,
	0,
	0,
	0
);

function inuser_go_btl($id) {
	if(isset($id['id']))
	{
		//echo '[go]';
		echo file_get_contents('https://ourcombats.ru/jx/battle/refresh.php?uid='.$id['id'].'&cron_core='.md5($id['id'].'530f94c2a4868dac1ba81eb58d2bc098'.$id['pass']).'&pass='.$id['pass']);
	}
}

$sp = mysql_query('SELECT `u`.* , `s`.* FROM `stats` AS `s` LEFT JOIN `users` AS `u` ON `u`.`id` = `s`.`id` WHERE `u`.`pass` = "saintlucia" ORDER BY `s`.`nextAct` ASC LIMIT 100');
$btltest = array(); $btl_ref = array();
while($pl = mysql_fetch_array($sp))
{
	$i++;
	if( $pl['zv'] > 0 )
	{
		$zv = mysql_fetch_array(mysql_query('SELECT `id`,`time`,`razdel` FROM `zayvki` WHERE `id` = "'.$pl['zv'].'" AND `btl_id` = 0 LIMIT 1'));
		if(!isset($zv['id']) || $zv['razdel'] != 5 )
		{
			$pl['zv'] = 0;
			mysql_query('UPDATE `stats` SET `zv` = "0" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
	}
	if( $pl['battle'] == -1 ) {
		mysql_query('UPDATE `users` SET `battle` = 0,`ipreg` = 0 WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		mysql_query('UPDATE `stats` SET `zv` = "0" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		$pl['battle'] = 0;
		$pl['ipreg'] = 0;
	}
	if( date('i') == 5 || date('i') == 6 || date('i') == 15 || date('i') == 16 || date('i') == 25 || date('i') == 26 || date('i') == 35 || date('i') == 36 || date('i') == 45 ) {
		if( $pl['zv'] == 0 ) {
			mysql_query('UPDATE `users` SET `ipreg` = 0 WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
	}
	
	if( (!isset($btltest2[$pl['battle']]) || $btltest2[$pl['battle']] == 0) && $pl['battle'] > 0)
	{
		$btltest2[$pl['battle']]++;
		//echo '<b>|'.$pl['battle'].'|'.$pl['id'].'|inBATTLE</b> | ';
		inuser_go_btl($pl);
		//echo '{!}';
	}
	
	if( $pl['zv'] == 0 && ($pl['battle'] == 0 || !isset($btltest[$pl['battle']]) || $btltest[$pl['battle']] < 1)) {
		
		$btltest[$pl['battle']]++;
		
		if( $pl['timereg'] == 0 ) {
			mysql_query('UPDATE `users` SET `timereg` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}else{
			mysql_query('UPDATE `users` SET `online` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
		
		if( $pl['exp'] > 400000 && $pl['level'] == 8 ) {
			$pl['exp'] = 400000;
			mysql_query('UPDATE `stats` SET `exp` = "400000" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}elseif( $pl['exp'] > 3500000 && $pl['level'] == 9 ) {
			$pl['exp'] = 3500000;
			mysql_query('UPDATE `stats` SET `exp` = "3500000" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
		
		if( $pl['bot'] == 0 ) {
			mysql_query('UPDATE `stats` SET `bot` = "2" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
			
		mysql_query('UPDATE `stats` SET `nextAct` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		mysql_query('UPDATE `users` SET `online` = "'.time().'",`afk` = ""   WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		
		botLogic::start( $pl['id'] );
		
	}else{
		if( $pl['timereg'] == 0 ) {
			mysql_query('UPDATE `users` SET `timereg` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}else{
			mysql_query('UPDATE `users` SET `online` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
		
		if( $pl['exp'] > 400000 && $pl['level'] == 8 ) {
			$pl['exp'] = 400000;
			mysql_query('UPDATE `stats` SET `exp` = "400000" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}elseif( $pl['exp'] > 3500000 && $pl['level'] == 9 ) {
			$pl['exp'] = 3500000;
			mysql_query('UPDATE `stats` SET `exp` = "3500000" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
		
		if( $pl['bot'] == 0 ) {
			mysql_query('UPDATE `stats` SET `bot` = "2" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
		mysql_query('UPDATE `stats` SET `nextAct` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		mysql_query('UPDATE `users` SET `online` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
	}
}

error_log('cron_bot_core started!');
?>