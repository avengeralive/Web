<?php
include('cron_config.php');
include($P_CRON.'_incl_data/__config.php');
include($P_CRON.'_incl_data/class/__db_connect.php');

function testMonster( $mon , $type )
{
	$r = true;
	if(isset($mon['id'])) {
		//
		if($type == 'start') {
			//День недели
			if( $mon['start_day'] != -1 ) {
				if( ($mon['start_day'] < 7 && $mon['start_day'] != date('w')) || $mon['start_day'] != 7 )
				{
					$r = false;
				}
			}
			//число
			if( $mon['start_dd'] != -1 ) {
				if( $mon['start_dd'] != date('j') ) {
					$r = false;
				}
			}
			//месец
			if( $mon['start_mm'] != -1 ) {
				if( $mon['start_mm'] != date('n') ) {
					$r = false;
				}
			}
			//час
			if( $mon['start_hh'] != -1 )
			{
				if( $mon['start_hh'] > date('G') || $mon['back_hh'] < date('G')) {
					$r = false;
                    //print 't1';
				}
				if( $mon['start_min'] != -1 )
				{
					if( $mon['start_min'] > (int)date('i')
					|| ($mon['back_min']<(int)date('i') && $mon['back_hh'] <= date('G'))
					||  $mon['start_min'] < (int)date('i') && $mon['start_hh'] < date('G') )
					{
						$r = false;
                        //print '<br>t2:'.$mon['start_min'].' '.(int)date('i');
					}
				}
			}
			//print '<br>start:'.$mon['start_hh'].':'.$mon['start_min'];
            //print '<br>time:'.(int)date('G').':'.(int)date('i');
			//print '<br>пуск: '.($r==true ? 'да' : 'нет');

		}elseif($type == 'back') {
			//День недели
			if( $mon['back_day'] != -1 ) {
				if( ($mon['back_day'] < 7 && $mon['back_day'] != date('w')) || $mon['back_day'] != 7 ) {
					$r = false;
				}
			}
			//число
			if( $mon['back_dd'] != -1 ) {
				if( $mon['back_dd'] != date('j') ) {
					$r = false;
				}
			}
			//месец
			if( $mon['back_mm'] != -1 ) {
				if( $mon['back_mm'] != date('n') ) {
					$r = false;
				}
			}
			//часы и мин
			if( $mon['back_hh'] != -1 )
			{
				if( $mon['back_hh'] > date('G') ) {
					$r = false;
				}
				if( $mon['back_min'] != -1 ) {
					if( $mon['back_min'] >= (int)date('i') && $mon['back_hh'] == date('G') ) {
						$r = false;
					}
				}
			}

			//Вышел и не может уйти по какой-то причине
            if( $mon['back_hh'] != -1 && $mon['back_min'] != -1)
			{
				if($mon['back_hh'] < date('G') || ($mon['back_min']+60 < (int)date('i') && $mon['back_hh'] == date('G')))
				{
					$r = true;
				}
			}

            //print '<br>end:'.$mon['back_hh'].':'.$mon['back_min'];
            //print '<br>time:'.(int)date('G').':'.(int)date('i');
			//print '<br>стоп: '.($r==true ? 'да' : 'нет');
		}else{
			//что-то другое
			$r = false;
		}
		//
	}
	return $r;
}

$sp = mysql_query('SELECT `u`.*,`st`.* FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON `st`.`id` = `u`.`id` WHERE `u`.`no_ip` = "trupojor" LIMIT 100');
while($pl = mysql_fetch_array($sp))
{
	$act = 0;
	if($pl['online'] < time()-60)
	{
		$pl['online'] = time();
		mysql_query('UPDATE `users` SET `online` = "'.$pl['online'].'",`afk` = "" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
	}

	if($pl['res_x'] < time())//верно, в res_x пишется time() + 60*$mon['time_restart']
	{
		//Можно действовать!
		$mon = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_monsters` WHERE `uid` = "'.$pl['id'].'" LIMIT 1'));
		if( isset($mon['id']) )
		{
			if( testMonster($mon,'start') == true && $pl['room'] == 303 )
			{
				$pl['room'] = $mon['start_room'];
                mysql_query('UPDATE `aaa_monsters` SET `time_start` = `time_start` + (`time_restart` * 60)  WHERE `id` = "'.$mon['id'].'" LIMIT 1');//'.time().'
				mysql_query('UPDATE `users` SET `room` = "'.$pl['room'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				mysql_query('UPDATE `stats` SET `hpNow` = "1000000",`mpNow` = "1000000" WHERE `id` = "'.$pl['id'].'" LIMIT 1') or die(mysql_error());
				
				if( $mon['start_text'] != '' )
				{
					mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("<font color=red>Внимание!</font> '.mysql_real_escape_string(str_replace('{b}','<b>'.$pl['login'].'</b> ['.$pl['level'].']<a target=_blank href=inf.php?'.$pl['id'].' ><img width=12 height=11 src=https://img.testcombats.ru/i/inf_capitalcity.gif ></a>',$mon['start_text'])).'","'.$pl['city'].'","","3","1","'.time().'")');
				}
				$act = 1;
			}
		}else{
			mysql_query('UPDATE `stats` SET `res_x` = "'.(time()+3600).'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
	}
	if( $act == 0 && $pl['room'] != 303 && $pl['battle'] == 0 )
	{
		if(!isset($mon['id']))
		{
			$mon = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_monsters` WHERE `uid` = "'.$pl['id'].'" LIMIT 1'));
		}
		if( isset($mon['id']) )
		{
			if( testMonster($mon,'back') == true )
			{
				$pl['room'] = 303;
				mysql_query('UPDATE `users` SET `room` = "'.$pl['room'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				mysql_query('UPDATE `stats` SET `hpNow` = "1000000",`mpNow` = "1000000" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				if( $mon['back_text'] != '' ) {
					mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("<font color=red>Внимание!</font> '.mysql_real_escape_string(str_replace('{b}','<b>'.$pl['login'].'</b> ['.$pl['level'].']<a target=_blank href=inf.php?'.$pl['id'].' ><img width=12 height=11 src=https://img.testcombats.ru/i/inf_capitalcity.gif ></a>',$mon['back_text'])).'","'.$pl['city'].'","","3","1","'.time().'")');
				}
				$act = 2;
			}
		}
	}
	/*if($pl['battle'] > 0) {
		//inuser_go_atack($pl);
	}else{
		if($pl['room'] == 303 && $pl['timeGo'] < time()) {
			if($pl['res_x'] < time()) {
				$pl['room'] = $pl['invBlock'];
				mysql_query('UPDATE `users` SET `room` = "'.$pl['room'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				mysql_query('UPDATE `stats` SET `hpNow` = "1000000000000",`mpNow` = "1000000000000" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("<font color=red>Внимание!</font> <b>'.$pl['login'].'</b> ['.$pl['level'].']<a target=_blank href=inf.php?'.$pl['id'].' ><img width=12 height=11 src=https://img.testcombats.ru/i/inf_capitalcity.gif ></a> выбрался на охоту, будьте осторожны!","'.$pl['city'].'","","3","1","'.time().'")');
			}
		}
	}*/
}
?>