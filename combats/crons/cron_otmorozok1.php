<?php
//Отморозки вмешиваются в бой, для боев с отморозками
if( date('m') == 12 || date('m') == 1 )
{
	include('cron_config.php');
	include($P_CRON.'_incl_data/__config.php');
	include($P_CRON.'_incl_data/class/__db_connect.php');
	include($P_CRON.'_incl_data/class/__user.php');
	include($P_CRON.'_incl_data/class/__battle.php');

	$time1 = microtime(true);//Мониторинг времени исполнения
	
	$sp = mysql_query('SELECT * FROM `battle` WHERE `otmorozok` = 1 AND `team_win` = -1 AND `otmorozok_use` = 0');
	while( $pl = mysql_fetch_array($sp) )
	{
		//if( rand( 0 , 100 ) < 99 )
		//{
			mysql_query('UPDATE `battle` SET `otmorozok_use` = 1 WHERE `id` = "'.$pl['id'].'" LIMIT 1');

			$usr = mysql_fetch_array(mysql_query('SELECT `level`,`city` FROM `users` WHERE `battle` = "'.$pl['id'].'" ORDER BY `level` DESC LIMIT 1'));
			$bot = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `login` LIKE "%Отморозок [%'.$usr['level'].'%]%" LIMIT 1'));

			$tmr = rand(1,2);
			$logins_bot = array();
			$bot = $u->addNewbot($bot['id'],NULL,NULL,$logins_bot,NULL);
			$otmz = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `users` WHERE `login` LIKE "%Отморозок (%" AND `battle` = "'.$pl['id'].'" LIMIT 1'));
			$otmz[0]++;

			mysql_query('UPDATE `users` SET `city` = "'.$usr['city'].'", `login` = "Отморозок ('.$otmz[0].')",`battle` = "'.$pl['id'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
			mysql_query('UPDATE `stats` SET `team` = "'.$tmr.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');

			$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$pl['id'].'" ORDER BY `id_hod` DESC LIMIT 1'));
			//
			$mass = array(
				'time' 		=> time(),
				'battle' 	=> $pl['id'],
				'id_hod' 	=> ($last_hod['id_hod']+1),
				'vars' 		=> '||time1='.time().'||time2=0||s1=0||t1='.$tmr.'||login1=Отморозок ('.$otmz[0].')',
				'type' 		=> 1,
				'text'      => '{tm1} {u1} вмешался в поединок. Хо! Хо! Хо!'
			);

	        $btl->add_log($mass);
            //error_log('Отморозок ('.$otmz[0].') вмешался в бой:'.$pl['id']);//dg
		//}
	}

	//Мониторинг времени исполнения
	$time2 = microtime(true);
	if($c['cron_log']==true)error_log(date('d-m-Y H:i:s')." cron_otmorozok:".round($time2-$time1, 5)." sec");
	//$LA = LA();
	//eLog('Proc: '.$LA[0].' ('.$LA[3].'%)');
}
?>