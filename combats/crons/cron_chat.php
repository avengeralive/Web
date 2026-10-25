<?php
//Кеширование чата
include('cron_config.php');
include($P_CRON.'_incl_data/__config.php');
include($P_CRON.'_incl_data/class/__db_connect.php');
set_time_limit(300);

$limit = 10000;
$time1 = microtime(true);
$start_time = time() - 600;
$start_time2 = time() - 60;

//error_log('==================CHAT CLEAR ['.date('d-m-Y H:i').' lim: '.$limit.']========================');

//mysql_query('INSERT INTO `chat_history` (`invis`, `dn`, `login`, `to`, `city`, `room`, `effect`, `time`, `type`, `spam`, `text`, `toChat`, `color`, `typeTime`,
`sound`, `global`, `delete`, `new`, `ip`, `molch`, `da`, `jalo`, `active`, `frv`, `battle_chat`, `nosee`)
SELECT `invis`, `dn`, `login`, `to`, `city`, `room`, `effect`, `time`, `type`, `spam`, `text`, `toChat`, `color`, `typeTime`, `sound`, `global`, `delete`, `new`,
`ip`, `molch`, `da`, `jalo`, `active`, `frv`, `battle_chat`, `nosee` FROM `chat` WHERE `time` < "'.$start_time.'" LIMIT '.$limit) or die(mysql_error());
$del1 = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));

mysql_query('DELETE FROM `chat` WHERE `time` < "'.$start_time.'" LIMIT '.$limit);
$del2 = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));

//Очистка сообщений - гудков
mysql_query('DELETE FROM `chat` WHERE `text` = "" AND `sound` = "117" AND `time` < "'.$start_time2.'" LIMIT '.$limit);
$del3 = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));

$time2 = microtime(true);

//error_log('Chat : moved: '.$del1['Count'].' deleted: '.$del2['Count'].' rows. Sounds: '.$del3['Count'].' deleted. Time:'.round($time2 - $time1, 2).' sec');
//error_log('==================CHAT CLEAR ['.date('d-m-Y H:i').' lim: '.$limit.']========================');
?>