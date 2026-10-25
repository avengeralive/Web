<?php
/* CRON Очистки сервера от ненужной информации */

include('cron_config.php');
include($P_CRON.'_incl_data/__config.php');
include($P_CRON.'_incl_data/class/__db_connect.php');
set_time_limit(300);

$limit = 300000;
$time1 = microtime(true);
$count = 0;
$sleep1 = 0.02;//Задержка выполнения для снижения нагрузки - секунды


error_log('==================CLEAR ['.date('d-m-Y H:i').' lim: '.$limit.']========================');

//Очистка боев ботов с ботами
$del = 0;
$del2 = 0;
$sp = mysql_query('SELECT `id` FROM `battle` WHERE `time_start` < '.(time()-600).' AND `time_start` > '.(time()-86400).' AND `team_win`!="-1" LIMIT '.$limit);
while( $pl = mysql_fetch_array($sp) )
{
	$bot = 1;
	$users = mysql_query('SELECT `uid` FROM `battle_users` WHERE `battle` = "'.$pl['id'].'"');
    while( $pl2 = mysql_fetch_array($users) )
	{
        $nobot = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` = "'.$pl2['uid'].'" AND `pass`!="saintlucia"'));
		if(isset($nobot['id']))
		{
            $bot = 0;
			break;
		}
	}

	if($bot==1)
	{
		mysql_query('DELETE FROM `battle`         WHERE `id` = "'.$pl['id'].'"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del2 += $res['Count'];
		mysql_query('DELETE FROM `battle_logs`    WHERE `battle` = "'.$pl['id'].'"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del2 += $res['Count'];
	    mysql_query('DELETE FROM `battle_last`    WHERE `battle_id` = "'.$pl['id'].'"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del2 += $res['Count'];
	    mysql_query('DELETE FROM `battle_users`   WHERE `battle` = "'.$pl['id'].'"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del2 += $res['Count'];
	    mysql_query('DELETE FROM `battle_out`     WHERE `battle` = "'.$pl['id'].'"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del2 += $res['Count'];
	    mysql_query('DELETE FROM `battle_actions` WHERE `btl` = "'.$pl['id'].'"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del2 += $res['Count'];
		mysql_query('DELETE FROM `battle_stat`    WHERE `battle` = "'.$pl['id'].'"');
		$res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del2 += $res['Count'];

    	$del++;
	}
}
error_log('battle[bots]:'.$del.' logs: '.$del2);
$count += $del+$del2;

//Очистка удаленных вещей. 1357908642 - вещи в карцере!
mysql_query('DELETE FROM `items_users` WHERE `uid`>"0" AND `delete` NOT IN ("0","1000","1357908642") AND `delete` < "'.(time()-86400*3).'" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('items_users[deleted]:'.$del['Count']);
$count += $del['Count'];

//Очистка удаленных вещей из пещер. 1357908642 - вещи в карцере!
mysql_query('DELETE FROM `items_users` WHERE `uid`>"0" AND `delete` NOT IN ("0","1000","1357908642") AND `delete` < "'.(time()-86400).'"
AND `data` LIKE "%frompisher%" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('items_users[deleted-frompisher]:'.$del['Count']);
$count += $del['Count'];

//Очистка вещей ботов - черепов
$del = 0;
$sp = mysql_query('SELECT `uid` FROM `items_users` WHERE `item_id`="8531" GROUP BY `uid`');
while( $pl = mysql_fetch_array($sp) )
{
    $user = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` = "'.$pl['uid'].'" AND `pass`="saintlucia"'));

	if(isset($user['id']))
	{
		mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$user['id'].'" AND `item_id`="8531"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del += $res['Count'];
	}
}
error_log('items_users[bots-8531]:'.$del);
$count += $del;

//Очистка вещей из быстрой таблицы - код работает, система отключена
/*$del = 0;
$sp = mysql_query('SELECT `uid` FROM `items_users_fast` GROUP BY `uid` LIMIT '.$limit);
while( $pl = mysql_fetch_array($sp) )
{
    $btl = mysql_fetch_array(mysql_query('SELECT `battle` FROM `users` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));
	if($btl['battle']==0)
	{
		mysql_query('DELETE FROM `items_users_fast` WHERE `uid` = "'.$pl['uid'].'"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del += $res['Count'];
	}
}
error_log('items_users_fast:'.$del);
$count += $del;*/

//Очистка не входиших игроков - код отлажен и работает
/*$del2 = 0; $levels = array (0=>10, 7=>14, 8=>45);
foreach($levels as $key => $value)
{
	$sp = mysql_query('SELECT `id`,`login`,`online`,`timereg`,`level` FROM `users` WHERE `level` = "'.$key.'" AND `bot_id`="0" AND `ip`!="0" AND `moneyCop`<"10"
	AND `online`<"'.(time()-86400*$value).'" AND `banned` = "0" AND `admin`="0" ORDER BY `timereg` LIMIT 30');

	$del = 0; $del3 = 0;
	while( $pl = mysql_fetch_array($sp) )
	{
        //echo 'ID: '.$pl['id'].' '.$pl['login'].'['.$pl['level'].'] онлайн: '.date('d-m-Y', $pl['online']).' timereg: '.date('d-m-Y', $pl['timereg']).'<br>';
		$del += DelUser($pl['id']);
        if($del) $del3++;
	}
    $del2 += $del;

	error_log('Удалено игроков['.$key.'] не входивших '.$value.' дней: '.$del3);
}
error_log('users lines[nologin]:'.$del2);
$count += $del;*/


//Очистка вещей несуществующих пользователей `uid` < "0" - почта и хранилище клана!
$del = 0;
$sp = mysql_query('SELECT `uid` FROM `items_users` WHERE `uid` > "0" GROUP BY `uid`');
while( $pl = mysql_fetch_array($sp) )
{
    $user = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` = "'.$pl['uid'].'"'));

	if(!isset($user['id']))
	{
		mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$pl['uid'].'" AND `delete` < "'.(time()-86400*30).'"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del += $res['Count'];
	}
}
error_log('items_users[nouser]:'.$del);
$count += $del;

//Очистка дела несуществующих пользователей
$del = 0;
$sp = mysql_query('SELECT `uid` FROM `users_delo` WHERE `time` > '.(time()-86400).' GROUP BY `uid`');
while( $pl = mysql_fetch_array($sp) )
{
    $user = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` = "'.$pl['uid'].'"'));

	if(!isset($user['id']))
	{
		mysql_query('DELETE FROM `users_delo` WHERE `uid` = "'.$pl['uid'].'"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del += $res['Count'];
	}
}
error_log('users_delo[nouser]:'.$del);
$count += $del;

//Очистка действий несуществующих пользователей
$del = 0;
$sp = mysql_query('SELECT `uid` FROM `actions` WHERE `time` > '.(time()-86400).' GROUP BY `uid`');
while( $pl = mysql_fetch_array($sp) )
{
    $user = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` = "'.$pl['uid'].'"'));

	if(!isset($user['id']))
	{
		mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$pl['uid'].'"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del += $res['Count'];

		mysql_query('DELETE FROM `turnir_end` WHERE `uid` = "'.$pl['uid'].'"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $del += $res['Count'];
	}
}
error_log('actions+turnir_end[nouser]:'.$del);
$count += $del;

//Очистка репутации несуществующих пользователей
$del = 0;
$sp = mysql_query('SELECT `id` FROM `rep`');
while( $pl = mysql_fetch_array($sp) )
{
    $user = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` = "'.$pl['id'].'"'));

	if(!isset($user['id']))
	{
		mysql_query('DELETE FROM `rep` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
        $del++;
	}
}
error_log('rep[nouser]:'.$del);
$count += $del;

//Очистка пустых бутылок старше 3 дней
mysql_query('DELETE FROM `items_users` WHERE `item_id` = "2" AND `time_create` < "'.(time()-86400 * 3).'" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('items_users[deleted]:'.$del['Count']);
$count += $del['Count'];

//Очистка чата
mysql_query('DELETE FROM `chat_history` WHERE `time` < '.(time()-86400*3).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('chat_history:'.$del['Count']);
$count += $del['Count'];

//Очистка сообщений - гудков
mysql_query('DELETE FROM `chat_history` WHERE `text` = "" AND `sound`="117" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('chat_history[sound 117]:'.$del['Count']);
$count += $del['Count'];

//Почта
mysql_query('DELETE FROM `post` WHERE `time` < '.(time()-86400*32).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('post:'.$del['Count']);
$count += $del['Count'];

//Кланы
mysql_query('DELETE FROM `clan_ab` WHERE `time` < '.(time()-86400*3).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('clan_ab:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `clan_exp` WHERE `time` < '.(time()-86400*30).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('clan_exp:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `clan_ability` WHERE `time` < '.(time()-86400*3).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('clan_ability:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `clan_operations` WHERE `time` < '.(time()-86400*7).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('clan_operations:'.$del['Count']);
$count += $del['Count'];

//Бонусы
mysql_query('DELETE FROM `aaa_bonus` WHERE `time` < '.(time()-86400*3).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('aaa_bonus:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `eff_users` WHERE `delete` < '.(time()-86400*3).' AND `delete` > "0"  LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('eff_users:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `save_com` WHERE `delete` < '.(time()-86400*3).' AND `delete` > "0"  LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('save_com:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `premium` WHERE `time_delete` < '.(time()-86400*3).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('premium:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `fontan` WHERE `time` < '.(time()-86400*3).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('fontan:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `logs_auth` WHERE `time` < '.(time()-86400*90).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('logs_auth:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `online` WHERE `timeStart` < '.(time()-86400*7).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('online:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `ekr_sale` WHERE `time` < '.(time()-86400*90).' LIMIT '.$limit);//Березка
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('ekr_sale:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `bs_logs` WHERE `time` < '.(time()-86400*7).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('bs_logs:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `bs_zv` WHERE `time` < '.(time()-86400).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('bs_zv:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `zayvki` WHERE `start` > 0 OR `cancel` > 0 OR `time` < "'.(time()-86400).'" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('zayvki:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `dungeon_zv` WHERE `delete` > 0 OR `time` < "'.(time()-86400).'" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('dungeon_zv:'.$del['Count']);
$count += $del['Count'];

//Рейтинг пользователей
mysql_query('DELETE FROM `users_reting` WHERE `time` < '.(time()-86400*15).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_reting:'.$del['Count']);
$count += $del['Count'];

//Рейтинг пользователей - ничей
mysql_query('DELETE FROM `users_reting` WHERE `uid` = "0" AND clan = "0" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_reting[clan&uid=0]:'.$del['Count']);
$count += $del['Count'];

//Users delo
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*90).'" AND `text` NOT LIKE "%ПСЖ%"
AND login NOT IN ("Optimus","BillyMilligan","Мироздатель","Скел") LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo:'.$del['Count']);
$count += $del['Count'];

//AddItems
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*15).'" AND (login="AddItems.capitalcity" OR login="AddItems.abandonedplain") LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[AddItems]:'.$del['Count']);
$count += $del['Count'];

//AddItems
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*3).'" AND (login="AddItems.capitalcity" OR login="AddItems.abandonedplain") AND `text` LIKE "%Получен предмет%" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[AddItems:Получен предмет]:'.$del['Count']);
$count += $del['Count'];

//AddItems
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*7).'" AND (login="AddItems.capitalcity" OR login="AddItems.abandonedplain") AND text LIKE "%Призовая монетка%" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[Призовая монетка]:'.$del['Count']);
$count += $del['Count'];

//AddItems
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*7).'" AND (login="AddItems.capitalcity" OR login="AddItems.abandonedplain") AND text LIKE "%Череп Врага%" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[Череп Врага]:'.$del['Count']);
$count += $del['Count'];

//AddItems
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*7).'" AND (login="AddItems.capitalcity" OR login="AddItems.abandonedplain") AND text LIKE "%Образец%" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[Образец]:'.$del['Count']);
$count += $del['Count'];

//AddItems
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400).'" AND (login="AddItems.capitalcity" OR login="AddItems.abandonedplain") AND text LIKE "%Пустая бутылка%" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[Пустая бутылка]:'.$del['Count']);
$count += $del['Count'];

//AddItems
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400).'" AND (login="AddItems.capitalcity" OR login="AddItems.abandonedplain") AND text LIKE "%Испорченный Эликсир%" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[Испорченный Эликсир]:'.$del['Count']);
$count += $del['Count'];

//Shop.capitalcity
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*30).'" AND `login`="Shop.capitalcity" AND `text` LIKE "%Shop.capitalcity%" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[Shop.capitalcity]:'.$del['Count']);
$count += $del['Count'];

//System.shop
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*30).'" AND `login`="System.shop" AND `text` LIKE "%System.shop%" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[System.shop]:'.$del['Count']);
$count += $del['Count'];

//System.remont
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*21).'" AND `login` LIKE "System.remont%" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[System.remont]:'.$del['Count']);
$count += $del['Count'];

//System.inventory
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*3).'" AND login="System.inventory" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[inventory]:'.$del['Count']);
$count += $del['Count'];

//System.inventory
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400).'" AND login="System.inventory" AND (`text` LIKE "%выброшен%" OR `text` LIKE "%сломан%") LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[inventory: выброшен,сломан]:'.$del['Count']);
$count += $del['Count'];

//System.Repshop
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*5).'" AND login="System.Repshop" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[Repshop]:'.$del['Count']);
$count += $del['Count'];

//System.battle
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*3).'" AND login="System.battle" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[battle]:'.$del['Count']);
$count += $del['Count'];

//System.remont
mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*3).'" AND login="System.remont" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('users_delo[remont]:'.$del['Count']);
$count += $del['Count'];

//Очистка походов
$del = 0;
$sp = mysql_query('SELECT * FROM `dungeon_now` WHERE `time_start` < "'.(time()-86400).'" OR `time_finish` > 0 LIMIT '.$limit);
while( $pl = mysql_fetch_array($sp) )
{
	mysql_query('DELETE FROM `dungeon_actions` WHERE `dn` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `dungeon_bots` WHERE `dn` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `dungeon_items` WHERE `dn` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `dungeon_obj` WHERE `dn` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `dungeon_now` WHERE `id` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
}
error_log('dungeon_now:'.$del);
$count += $del;

//Очистка заблудших ботов
$del = 0; $count2 = 0;

$sp = mysql_query('SELECT * FROM `users` WHERE `bot_id` > "0" AND `ip`="0" AND `bithday`="01.01.1800" LIMIT '.$limit);//AND login NOT LIKE "%(зверь%" AND `battle`>"0"
while( $usr = mysql_fetch_array($sp) )
{
	if($usr['battle']>0) $btl1 = mysql_fetch_array(do_query('SELECT `id` FROM `battle` WHERE `id` = "'.$usr['battle'].'" AND `team_win`="-1" LIMIT 1'));

	if(!isset($btl1['id']))
	{
        //pr($usr['id'].' - '.$usr['login'].'-'.$usr['bot_id'].' - '.$usr['battle'].' - '.$btl1['id']);
        mysql_query('DELETE FROM `stats` WHERE `id` = "'.$usr['id'].'" LIMIT 1');
	    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
	    $del += $res['Count'];
		mysql_query('DELETE FROM `users` WHERE `id` = "'.$usr['id'].'" LIMIT 1');
	    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
	    $del += $res['Count'];
        mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$usr['id'].'"');
    	$res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    	$del += $res['Count'];

		$count2++;
	}
}
error_log('deleted lost_bots:'.$count2.' rows: '.$del);
$count += $del;


//Очистка действий прошедших квестов
$x = 0; $y = 0;
$sp = mysql_query('SELECT `id`,`battle`,`room` FROM `users` WHERE `real` = 1');
while( $pl = mysql_fetch_array($sp) )
{
	$bot_kill = array();

	$qp = mysql_query('SELECT `vars` FROM `actions` WHERE `uid` = "'.$pl['id'].'" AND `vars` LIKE "%start_quest%" AND `vals` = "go"');
	while( $ql = mysql_fetch_array($qp) )
	{
		$qst_id = str_replace('start_quest','',$ql['vars']);
		$qst = mysql_fetch_array(mysql_query('SELECT `act_date` FROM `quests` WHERE `id` = "'.$qst_id.'" LIMIT 1'));

		if(isset($qst['act_date']))
		{
			$act = explode(':|:', $qst['act_date']);
			$i = 0;

			while( $i < count($act) )
			{
				$act2 = explode(':=:', $act[$i]);
				$bots = explode(',',   $act2[1]);
				$j = 0;

				while( $j < count($bots) )
				{
					$bot = explode('=',$bots[$j]);
					$bot_kill[$bot[0]] = true;
					$j++;
				}

				$i++;
			}
		}
	}

	$delete = '';
	$wp = mysql_query('SELECT `id`,`vars` FROM `actions` WHERE `uid` = "'.$pl['id'].'" AND `vars` REGEXP "win_bot_|lose_bot_|nich_bot_" LIMIT '.$limit);

	while( $wl = mysql_fetch_array($wp) )
	{
		$wlb = str_replace(array('win_bot_', 'lose_bot_', 'nich_bot_'),'',$wl['vars']);
		(!isset($bot_kill[$wlb])) ? $delete .= 'OR `id` = "'.$wl['id'].'" ' : $y++;//активный квест
	}

	if( $delete != '' )
	{
        $delete = ltrim($delete,'OR ');

		mysql_query('DELETE FROM `actions` WHERE ' . $delete.' LIMIT '.$limit);
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    	$x += $res['Count'];
	}

	if( $pl['battle'] == 0 )
	{
		mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$pl['id'].'" AND (`vars` LIKE "%animal_use%"
		OR (`vars` LIKE "%takeit_%" AND `room` != "'.$pl['room'].'"))');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    	$x += $res['Count'];

		mysql_query('DELETE FROM `actions_fast` WHERE `uid` = "'.$pl['id'].'" AND `vars` LIKE "use_priem_%"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    	$x += $res['Count'];
	}

    time_sleep_until(microtime(true)+$sleep1);
}

error_log('active quests: '.$y.' deleted: '.$x.' rows.');
$count += $x;
//Очистка действий прошедших квестов


//Очистка ачивок кукол
$del = 0;
$sp = mysql_query('SELECT `id`, `uid` FROM `achiev` LIMIT '.$limit);
while( $pl = mysql_fetch_array($sp) )
{
    $user = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));
	if(!isset($user['id']))
	{
		mysql_query('DELETE FROM `achiev` WHERE `id` = "'.$pl['id'].'"');
        $del++;
	}
}
error_log('achiev[bots]:'.$del);
$count += $del;

//Очистка действий
mysql_query('DELETE FROM `actions` WHERE `vars` LIKE "psh%" AND `time` < '.(time()-86400*3).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[psh]:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `actions` WHERE `vars` LIKE "go_homeworld%" AND `time` < '.(time()-86400*3).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[go_homeworld]:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `actions` WHERE `vars` LIKE "statistic_today" AND `time` < '.(time()-86400*3).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[statistic_today]:'.$del['Count']);
$count += $del['Count'];

//Очистка действий завершенных квестов
mysql_query('DELETE FROM `actions` WHERE `vars` LIKE "start_quest%" AND `vals`="win" AND `time` < '.(time()-86400*30).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[start_quest=win]:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `actions` WHERE `vars`LIKE "trasfer_capitalcity%" AND `time` < '.(time()-86400*10).' LIMIT '.$limit);//Нужно ли вообще?
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[trasfer_capitalcity]:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `actions` WHERE `vars`LIKE "teleport" AND `time` < '.(time()-86400*3).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[teleport]:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `actions` WHERE `vars`="unsleep" AND `time` < '.(time()-86400*10).' LIMIT '.$limit);//Нужно ли вообще > 1 суток?
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[unsleep]:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `actions` WHERE (`vars`="use_cupNewYear" OR `vars`="create_snowball_cp") AND `time` < '.(time()-86400*60).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[use_cupNewYear,create_snowball_cp]:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `actions` WHERE `vars` LIKE "%bafit_%" AND `time` < '.(time()-86400*1).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[bafit]:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `actions_fast` WHERE `vars` LIKE "use_priem_%" AND `time` < "'.(time()-86400).'" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[use_priem_fast]:'.$del['Count']);
$count += $del['Count'];

//Рейтинг кланов
mysql_query('DELETE FROM `aaa_clan_reting_list` WHERE `time` < '.(time()-86400*3).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('aaa_clan_reting_list:'.$del['Count']);
$count += $del['Count'];

//Рейтинг пользователей - сделать хранение за 2 дня, когда перепишем рейтинг пользователей
mysql_query('DELETE FROM `aaa_reting_list` WHERE `time` < '.(time()-86400*100).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('aaa_reting_list:'.$del['Count']);
$count += $del['Count'];

//Подарки к ДР - очистка старых записей
mysql_query('DELETE FROM `aaa_birthday` WHERE `date` NOT LIKE "%'.date('Y').'" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('aaa_birthday:'.$del['Count']);
$count += $del['Count'];

//Стол заказов Радио - очистка удаленных записей
mysql_query('DELETE FROM `dj_orders` WHERE `delete` > "0" AND `id` > "1" LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('dj_orders:'.$del['Count']);
$count += $del['Count'];


//Оптимизация базы данных
//'items_users_fast', 'eff_users', 'chat', 'battle_last', 'battle_users', 'actions', 'stats', 'users', 'items_users', 'battle_logs', 'users_delo',
//'actions_fast', 'battle_stat', - inodb

$tables = array('aaa_birthday', 'dungeon_obj', 'rep', 'friends', 'chat_history', 'dungeon_bots', 'bs_logs', 'dungeon_items', 'clan_operations', 'post',
'dungeon_now', 'dungeon_zv', 'battle_actions', 'aaa_bonus', 'ekr_sale', 'users_turnirs', 'logs_auth', 'dungeon_actions', 'save_com', 'battle_act',
'online', 'bs_zv', 'premium', 'balance_money', 'turnir_end', 'blood_battle', 'complects_priem', 'notepad', 'dailybonus', 'users_ico', 'bank_alh',
'fontan', 'pirogi', 'clan_tituls', 'dungeon_dialog', 'dj_orders', 'clan_exp', 'worklist', 'items_main', 'clan_info', 'clan', 'obraz','users_animal');

$del = 0;
if(!isset($_GET['no_optimize']))
{
	foreach($tables as $table)
	{
	  mysql_query('OPTIMIZE TABLE `'.$table.'`');
	  time_sleep_until(microtime(true)+$sleep1);
	  $del++;
	}
}
error_log('optimized tables:'.$del);

$time2 = microtime(true);

error_log('Deleted: '.$count.' rows. Time:'.round($time2-$time1, 2).' sec');
error_log('==================CLEAR ['.date('d-m-Y H:i').' lim: '.$limit.']========================');

?>