<?
include('cron_config.php');
include($P_CRON.'_incl_data/__config.php');
include($P_CRON.'_incl_data/class/__db_connect.php');

$time1 = microtime(true);//Мониторинг времени исполнения

//Удаляем предыдущий рейтинг за сегодня
$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `aaa_clan_reting_list` WHERE `date` = "'.date('dmY').'" LIMIT 1'));
if(isset($test['id']))
{
	mysql_query('DELETE FROM `aaa_clan_reting_list` WHERE `date` = "'.date('dmY').'"');
}

//Сброс рейтинга 1 и 15 числа до 1 часа т.е. 1 раз в эти дни
if((date('j', time()) == 1 || date('j', time()) == 15) && date('G', time()) < 1)
{
	mysql_query('UPDATE `users` SET `win_rating` = "0", `win_rating_d` = "0", `lose_rating` = "0", `lose_rating_d` = "0", `nich_rating` = "0"');
    mysql_query('UPDATE `clan` SET `rating_t` = "0"');
}

//Считаем рейтинг
list($add_exp_list, $all_exp_list, $exp_list, $win_list, $lose_list, $nich_list, $xu_list, $level_list, $all_rating_list) = array(array(),array(),array(),array(),array(),array(),array(),array(),array());

$day_start = (date('j', time()) < 15 ? 1 : 15);
$time_start = mktime(0, 0, 0, date('m',time()), $day_start, date('y',time()));

$sp = mysql_query('SELECT `id`,`level`,`rating_t` FROM `clan`');
while( $pl = mysql_fetch_array($sp) )
{
	list($clan_win, $clan_lose, $clan_nich, $clan_rating) = array(0,0,0,0);

	$sp2 = mysql_query('SELECT `id`, `win_rating`, `win_rating_d`, `lose_rating`, `lose_rating_d`, `nich_rating` FROM `users`
	WHERE `clan` = "'.$pl['id'].'" AND `admin` = "0" AND `real` = "1"');
    while( $pl2 = mysql_fetch_array($sp2) )
	{
        $clan_win    += $pl2['win_rating']  + $pl2['win_rating_d'];
        $clan_lose   += $pl2['lose_rating'] + $pl2['lose_rating_d'];
        $clan_nich   += $pl2['nich_rating'];
		$clan_rating += ($pl2['win_rating']/10 + $pl2['win_rating_d']/100) - ($pl2['lose_rating']/10 + $pl2['lose_rating_d']/100);
	}

    $clan_rating += $pl['rating_t'];//Учет рейтинга за битвы
    if($clan_rating < 0) $clan_rating = 0;

	$xu = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `clan` = "'.$pl['id'].'" AND `admin` = 0 AND `real` = 1 LIMIT 1'));
    $st = mysql_fetch_array(mysql_query('SELECT SUM(`val`) AS `exp` FROM `users_reting` WHERE `clan` = "'.$pl['id'].'" AND `time` > "'.$time_start.'" LIMIT 1'));
    $rl = mysql_fetch_array(mysql_query('SELECT `exp`,`global`,`exp_real` FROM `aaa_clan_reting_list` WHERE `clan` = "'.$pl['id'].'" ORDER BY `id` DESC LIMIT 1'));

	$all_rating_list[$pl['id']] = round($clan_rating, 2);
    $level_list[$pl['id']] = $pl['level'];
    $win_list[$pl['id']] = $clan_win;
    $lose_list[$pl['id']] = $clan_lose;
	$nich_list[$pl['id']] = $clan_nich;
    $xu_list[$pl['id']] = $xu[0];
    $exp_list[$pl['id']] = abs($st['exp'] - $rl['exp_real']); //сколько опыта получил за сегодня
	$all_exp_list[$pl['id']] = $st['exp'] + $exp_list[$pl['id']]; //сколько опыта получил всего + сегодняшний

}
unset($pl,$sp,$pl2,$sp2);

arsort($all_rating_list);
$keys = array_keys($all_rating_list);

$i = 0;
while( $i <= count($keys) )
{
	if( isset($keys[$i]) )
	{
		mysql_query('INSERT INTO `aaa_clan_reting_list` ( `level`,`xu`,`win`,`lose`,`nich`,`exp_real`,`clan`,`pos`,`global`,`exp`,`date`,`time` ) VALUES (
		"'.$level_list[$keys[$i]].'","'.$xu_list[$keys[$i]].'","'.$win_list[$keys[$i]].'","'.$lose_list[$keys[$i]].'","'.$nich_list[$keys[$i]].'",
		"'.$exp_list[$keys[$i]].'","'.$keys[$i].'","'.($i+1).'","'.$all_rating_list[$keys[$i]].'","'.$add_exp_list[$keys[$i]].'","'.date('dmY').'","'.time().'"
		)');
	}
	$i++;
}

//Мониторинг времени исполнения
$time2 = microtime(true);
if($c['cron_log']==true) error_log(date('d-m-Y H:i:s')." cron_reting_clans:".round($time2-$time1, 5)." sec");
?>