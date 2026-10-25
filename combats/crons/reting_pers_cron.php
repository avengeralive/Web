<?php
include('cron_config.php');
include($P_CRON.'_incl_data/__config.php');
include($P_CRON.'_incl_data/class/__db_connect.php');

$time1 = microtime(true);//Мониторинг времени исполнения

//Рейтинг по вкладам
$ub = array();
$ui = array();
$sp = mysql_query('SELECT * FROM `pay_operation` WHERE `good` > 0 ORDER BY `id` DESC');
while( $pl = mysql_fetch_array($sp) )
{
	if(!isset($ub[$pl['uid']]))
	{
		$ui[] = $pl['uid'];
	}
	$ub[$pl['uid']][date('d.m.Y',$pl['good'])] = $pl['ekr'];
}
$i = 0;
while( $i < count($ui) )
{
	if(isset($ui[$i]))
	{
		$j = 1;
		$k = 0;
		$nj = 0;
		while( $j <= 1000 )
		{
			$dt = date('d.m.Y',time() - (86400 * $j));
			if( isset($ub[$ui[$i]][$dt]) )
			{
				$k++;
				$nj = 0;
			}elseif( $j > 0 && $nj >= 6 )
			{
				$j = 1000;
			}else{
				$nj++;
			}
			$j++;
		}
		mysql_query('DELETE FROM `users_paybonus` WHERE `id` = "'.$ui[$i].'" LIMIT 1');
		mysql_query('INSERT INTO `users_paybonus` (`id`,`level`) VALUES (
			"'.$ui[$i].'","'.$k.'"
		)');
	}
	$i++;
}

$add_exp_list = array();
$all_exp_list = array();
$exp_list = array();
$win_list = array();

$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `aaa_reting_list` WHERE `date` = "'.date('dmY').'" LIMIT 1'));
if(isset($test['id']))
{
	mysql_query('DELETE FROM `aaa_reting_list` WHERE `date` = "'.date('dmY').'"');
}
unset($test);
	
$sp = mysql_query('SELECT `id`,`login`,`win` FROM `users` WHERE `real` = 1 AND `admin` = 0');
while( $pl = mysql_fetch_array($sp) )
{
	$st = mysql_fetch_array(mysql_query('SELECT `id`,`exp` FROM `stats` WHERE `id` = "'.$pl['id'].'" AND `bot` = 0 LIMIT 1'));
	$rl = mysql_fetch_array(mysql_query('SELECT `exp`,`global`,`exp_real` FROM `aaa_reting_list` WHERE `uid` = "'.$pl['id'].'" ORDER BY `id` DESC LIMIT 1'));
	
	$exp_list[$pl['id']] = $st['exp'];
	
	$win_list[$pl['id']] = $pl['win'];
	
	$add_exp = $st['exp'] - $rl['exp_real'];
	
	$global_exp = 0; //значение рейтинга за 100 дней, каждый последующий день -1%
	$cp = mysql_query('SELECT `exp` FROM `aaa_reting_list` WHERE `uid` = "'.$pl['id'].'" ORDER BY `id` DESC LIMIT 100');
	$dd = 0;
	while( $cl = mysql_fetch_array($cp) )
	{
		$global_exp += round($cl['exp']/100*(100-$dd));
		$dd++;
	}
	
	$add_exp_list[$pl['id']] = $add_exp; //записываем сколько опыта получил за сегодня
	$all_exp_list[$pl['id']] = $global_exp + $add_exp; //записываем сколько опыта получил всего + сегодняшний				
}
unset($pl,$sp);

arsort($all_exp_list);

$keys = array_keys($all_exp_list);

$i = 0;
while( $i <= count($keys) )
{
	if( isset($keys[$i]) )
	{
		mysql_query('INSERT INTO `aaa_reting_list` ( `win`,`exp_real`,`uid`,`pos`,`global`,`exp`,`date`,`time` ) VALUES (
			"'.$win_list[$keys[$i]].'","'.$exp_list[$keys[$i]].'","'.$keys[$i].'","'.($i+1).'","'.$all_exp_list[$keys[$i]].'","'.$add_exp_list[$keys[$i]].'","'.date('dmY').'","'.time().'"
		)');
	}
	$i++;
}

//Мониторинг времени исполнения
$time2 = microtime(true);
if($c['cron_log']==true) error_log(date('d-m-Y H:i:s')." cron_reting_pers:".round($time2-$time1, 5)." sec");
?>