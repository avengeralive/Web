<?php
define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");

//Скрипт полигон для испытаний кода
include('/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/_incl_data/__config.php');
include('/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/_incl_data/class/__db_connect.php');
include('/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/_incl_data/class/__user.php');
include('/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/_incl_data/class/__battle.php');

set_time_limit(30);
$time1 = microtime(true);
$count = 0;
$sleep1 = 0.02;//Задержка выполнения для снижения нагрузки - секунды
$ADMIN = 1;
$limit = 100000;
$del = 0;

mysql_query("
INSERT INTO `eff_users` ( `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
( 22, '4095055', 'Чары чахлости 3', 'add_s4=-30|add_hpAll=-50', 0, 77, 0, '1', 0, 'priem', 311, 'enhp_3_copower3.gif', 1, 5, 'чарычахлости3', 0, 0, '', 0, 0, 0, 1, 0);
");

/*mysql_query('DELETE FROM `actions` WHERE `vars`LIKE "teleport" AND `time` < '.(time()-86400*3).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[trasfer_capitalcity]:'.$del['Count']);
$count += $del['Count'];

//Очистка действий завершенных квестов
mysql_query('DELETE FROM `actions` WHERE `vars` LIKE "start_quest%" AND `vals`="win" AND `time` < '.(time()-86400*30).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[start_quest=win]:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `actions` WHERE `vars`="unsleep" AND `time` < '.(time()-86400*10).' LIMIT '.$limit);//Нужно ли вообще?
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[unsleep]:'.$del['Count']);
$count += $del['Count'];

mysql_query('DELETE FROM `actions` WHERE (`vars`="use_cupNewYear" OR `vars`="create_snowball_cp") AND `time` < '.(time()-86400*60).' LIMIT '.$limit);
$del = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
error_log('actions[use_cupNewYear,create_snowball_cp]:'.$del['Count']);
$count += $del['Count'];*/

//Очистка заблудших ботов
/*$sp = mysql_query('SELECT * FROM `users` WHERE `bot_id` > "0" AND `ip`="0" AND `bithday`="01.01.1800" LIMIT '.$limit);//AND login NOT LIKE "%(зверь%" AND `battle`>"0"
while( $usr = mysql_fetch_array($sp) )
{
	if($usr['battle']>0) $btl1 = mysql_fetch_array(do_query('SELECT `id` FROM `battle` WHERE `id` = "'.$usr['battle'].'" AND `team_win`="-1" LIMIT 1'));

	if(!isset($btl1['id']))
	{
        pr($usr['id'].' - '.$usr['login'].'-'.$usr['bot_id'].' - '.$usr['battle'].' - '.$btl1['id']);

        mysql_query('DELETE FROM `stats` WHERE `id` = "'.$usr['id'].'" LIMIT 1');
	    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
	    $del += $res['Count'];
		mysql_query('DELETE FROM `users` WHERE `id` = "'.$usr['id'].'" LIMIT 1');
	    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
	    $del += $res['Count'];
        mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$usr['id'].'"');
    	$res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    	$del += $res['Count'];

		$count++;
	}
}
pr('удалено ботов: '.$count,' Записей: '.$del);*/

//pr('дело несуществующих игроков');
/*$sp = mysql_query('SELECT `uid`,`time`,`text` FROM `users_delo` GROUP BY `uid`');
while( $pl = mysql_fetch_array($sp) )
{
    $user = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` = "'.$pl['uid'].'"'));

	if(!isset($user['id']))//$user['bot_id']>0
	{
		pr($pl['uid'].': '.date('d-m-Y H:i:s', $pl['time']).' - '.$pl['text']);

        mysql_query('DELETE FROM `users_delo` WHERE `uid` = "'.$pl['uid'].'"');
        $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        $count += $res['Count'];
	}
}*/



/*$sp = mysql_query('SELECT * FROM `actions`');
while( $pl = mysql_fetch_array($sp) )
{
    $user = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` = "'.$pl['uid'].'"'));

	if(!isset($user['id']))//$user['bot_id']>0
	{
        pr($pl['uid'].': '.date('d-m-Y H:i:s', $pl['time']).' - '.$pl['vars']);

		//mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$pl['uid'].'"');
        //$res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
        //$count += $res['Count'];
		$count++;
	}
}*/


//Поиск свободных id
/*pr('=======================================');
pr('Вещи и свитки');
$itm_old = 0;
$sp = mysql_query('SELECT `id` FROM `items_main` ORDER BY `id` LIMIT 10000');
while( $pl = mysql_fetch_array($sp) )
{
	if($pl['id'] > $itm_old+1)pr(($itm_old+1).' - '.($pl['id']-1));
    $itm_old = $pl['id'];
}
pr('=======================================');
pr('Приемы');
$itm_old = 0;
$sp = mysql_query('SELECT `id` FROM `priems` ORDER BY `id`');
while( $pl = mysql_fetch_array($sp) )
{
	if($pl['id'] > $itm_old+1)pr(($itm_old+1).' - '.($pl['id']-1));
    $itm_old = $pl['id'];
}*/

//$btl->addTravm(2,2,10);
//==================================================================//
/*$sp = do_query('SELECT `id`,`data` FROM `eff_users` WHERE `id_eff`="757" LIMIT 1000');
while( $pl = mysql_fetch_array($sp) )
{
	if(substr_count($pl['data'], "add_m11a="))
	{
		$data = str_replace('add_m11a=','add_m11u=', $pl['data']);
        pr($count.'. '.$pl['id'].': '.$pl['data'].' - '.$data);
        mysql_query('UPDATE `eff_users` SET `data` = "'.$data.'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
        $count++;
		pr('============================');
	}
}
pr($count);*/

/*$sp = mysql_query('SELECT `id`,`data` FROM `items_users` WHERE `item_id`="4759" AND `delete`="0" LIMIT 610');
while( $pl = mysql_fetch_array($sp) )
{
	if(!substr_count($pl['data'], "useOnlyInBattle=1"))
	{
		$data = $pl['data'].'|useOnlyInBattle=1';
        pr($count.'. '.$pl['id'].': '.$pl['data'].' - '.$data);
        mysql_query('UPDATE `items_users` SET `data` = "'.$data.'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
        $count++;
	}
}
pr($count);*/

//Очистка не входиших игроков
/*$del = 0;
$del2 = 0;
$limit = 1;$del2 = 0; $levels = array (0=>10, 7=>14, 8=>90);
foreach($levels as $key => $value)
{
	$sp = mysql_query('SELECT `id`,`login`,`online`,`timereg`,`level` FROM `users` WHERE `level` = "'.$key.'" AND `bot_id`="0" AND `ip`!="0" AND `moneyCop`<"10"
	AND `online`<"'.(time()-86400*$value).'" AND `banned` = "0" AND `admin`="0" ORDER BY `timereg` LIMIT 1000');

	$del = 0; $del3 = 0;
	while( $pl = mysql_fetch_array($sp) )
	{
        echo 'ID: '.$pl['id'].' '.$pl['login'].'['.$pl['level'].'] онлайн: '.date('d-m-Y', $pl['online']).' timereg: '.date('d-m-Y', $pl['timereg']).'<br>';
		$del += DelUser($pl['id']);
        if($del) $del3++;
	}
    $del2 += $del;

	error_log('Удалено игроков['.$key.'] не входивших '.$value.' дней: '.$del3);
}
error_log('users lines[nologin]:'.$del2);
$count += $del;
error_log('users lines[nologin]:'.$count);*/

/*$itms = array(0);
$sp = mysql_query('SELECT * FROM `post` WHERE `finish` = "0" AND `item_id`="0"  AND `sender_id`<"0" AND `time`<"1578748645" AND `money`>"0" AND `uid`>9999999 LIMIT 300');
while( $pl = mysql_fetch_array($sp) )
{
    $itm2 = mysql_fetch_array(mysql_query('SELECT `id`,`uid` FROM `items_users` WHERE `uid`="-51'.$pl['uid'].'" AND `1price` = "'.$pl['money'].'" LIMIT 1'));
	$qq = implode(',',$itms);
	$qq = ' AND `id` NOT IN ('.$qq.')';
    if(!isset($itm2['id'])) $itm = mysql_fetch_array(mysql_query('SELECT `id`,`uid` FROM `items_users` WHERE `1price` = "'.$pl['money'].'"'.$qq.' AND `uid`="-2147483648" LIMIT 1'));
	if(isset($itm['id']))
	{
		//mysql_query('UPDATE `items_users` SET `uid` = "-51'.$pl['uid'].'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
        $itms[] = $itm['id'];
		$f = ' -fixed!';
        $del2++;
	}
	elseif(isset($itm2['id'])) $f = ' - есть посылка';
	else $f = '';
    //if(!isset($itm2['id']))
	//{
		pr($del.' id: '.$pl['id'].' uid: '.$pl['uid'].' item_id: '.$pl['item_id'].' = '.$itm['id'].' uid:'.$itm['uid'].$f);
        $del++;
    //}
	unset($itm, $itm2);
}
pr($del2);*/

/*$sp = mysql_query('SELECT `id`,`login`,`online`,`timereg`,`level` FROM `users` WHERE `level` = "0"
AND `bot_id`="0" AND `ip`!="0" AND `moneyCop`<"10" AND `online`<"'.(time()-86400*45).'" ORDER BY `timereg` LIMIT 500');
while( $pl = mysql_fetch_array($sp) )
{
	echo 'ID: '.$pl['id'].' '.$pl['login'].'['.$pl['level'].'] онлайн: '.date('d-m-Y', $pl['online']).' timereg: '.date('d-m-Y', $pl['timereg']).'<br>';
	mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `aaa_bonus` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `aaa_reting_list` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `aaa_znahar` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `bank` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `dungeon_actions` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `forum_msg` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `friends` WHERE `user` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `friends` WHERE `friend` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `izlom_rating` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `logs_auth` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `mults` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `mults` WHERE `uid2` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `notepad` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `obraz` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `online` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `rep` WHERE `id` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `stats` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `users` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `users_ico` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `users_animal` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `users_delo` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	mysql_query('DELETE FROM `users_gifts` WHERE `uid` = "'.$pl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del += $res['Count'];
	$del2++;
}
echo '<br>users: '.$del2.' rows:'.$del;*/

//$count += $del;
/*$arr = array();

$sp = mysql_query('SELECT `login` FROM `users_delo` ORDER BY `login` LIMIT 500000');
while( $pl = mysql_fetch_array($sp) )
{
	if(!isset($arr[$pl['login']])) $arr[$pl['login']] = 1;
	else $arr[$pl['login']]++;
}
arsort($arr);
foreach($arr as $key => $value)
{
	echo $key.': '.$value.'<br>';
}*/

//$arr = array();

/*$sp = mysql_query('SELECT `item_id` FROM `items_users` ORDER BY `item_id` LIMIT 700000');
while( $pl = mysql_fetch_array($sp) )
{
	if(!isset($arr[$pl['item_id']])) $arr[$pl['item_id']] = 1;
	else $arr[$pl['item_id']]++;
}
arsort($arr);
foreach($arr as $key => $value)
{
	if($value>1000) echo $key.': '.$value.'<br>';
}*/

/*$sp = mysql_query('SELECT `uid` FROM `items_users` WHERE `item_id`="8531" LIMIT 700000');
while( $pl = mysql_fetch_array($sp) )
{
	if(!isset($arr[$pl['uid']])) $arr[$pl['uid']] = 1;
	else $arr[$pl['uid']]++;
}
arsort($arr);
foreach($arr as $key => $value)
{
	if($value>100) echo $key.': '.$value.'<br>';
}*/

/*$log = file_get_contents('exp.txt');
$i = 1;
$arr = explode("\n", $log);
$log = '';
$users = array();

foreach($arr as $line)
{
    $line = trim($line);
	if($line)
	{
  		preg_match('/\[(.*)\]/', $line, $reg);
        preg_match('/Получено опыта: ([0-9]+) \(/', $line, $reg2);

		if(!isset($users[$reg[1]]) && $reg) $users[$reg[1]] = 0;
        $users[$reg[1]] += $reg2[1];
		//pr($reg[1].' : '.$reg2[1]);
	}
}

$i = 0;
arsort($users);
echo '<br><br>';
foreach($users as $user => $exp)
{
    $usr = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `login` = "'.$user.'" LIMIT 1'));
    $stat = mysql_fetch_array(mysql_query('SELECT `exp`, `upLevel` FROM `stats` WHERE `id` = "'.$usr['id'].'" LIMIT 1'));
	$exp_new = $stat['exp'] - $exp;

	$lvl = mysql_fetch_array(mysql_query('SELECT `upLevel` FROM `levels` WHERE `exp` < "' . $exp_new . '" ORDER BY `exp` DESC LIMIT 1'));
    $lvl_new = $lvl['upLevel']+1;

	pr($user.' : '.$exp.' exp-now: '.$stat['exp'].' exp_new:'.$exp_new.' LEvUP: '.$stat['upLevel'].' New: '.$lvl_new);
    //mysql_query('UPDATE `stat` SET `exp` = "'.$exp_new.'", `upLevel` = "'.$lvl_new.'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
	$i++;
}
pr('Всего:'.$i);*/

/*$dir = '/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/battle_logs/';
$files = glob($dir."*");
echo count($files);
//usort($files, create_function('$a,$b', 'return filemtime($a) - filemtime($b);'));
$now  = time();
$del = 0;
$limit_files = 100;

foreach ($files as $file)
{
  if (is_file($file))
  {
	//if ($now - filemtime($file) >= 86400 * 7)// 7 days
	//{
	  echo '<br>'.$file;
	  $del++;
    //}
  }
  if($del==$limit_files) break;
  //time_sleep_until(microtime(true)+$sleep2);
}*/

//3265000 файлов!
//Очистка папки battle_logs/stat от старых логов
/*$dir = '/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/battle_logs/';
$files = glob($dir."*");
echo 'files:'.count($files);

for($n=900000; $n<1000337; $n++)
{
    $file = '/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/battle_logs/btl-1373317-'.$n.'.html';
	//echo '<br>'.$file;
	if(file_exists($file))
	{
		unlink($file);
		//echo ' - del';
		$count++;
	}
}

foreach ($files as $file)
{
  if (is_file($file))
  {
	if(!substr_count($file, '-1.html') && !substr_count($file, '-2.html')) echo $file.'<br>';
  }
  if($count>200000) break;
  $count++;
}*/


$time2 = microtime(true);

echo '<br>Count: '.$count.'. Time:'.round($time2-$time1, 2).' sec';
?>