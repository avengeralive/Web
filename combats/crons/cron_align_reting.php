<?php
//выбор победител€ и сброс статистики рейтинга склонностей

include('cron_config.php');
include($P_CRON.'_incl_data/__config.php');
include($P_CRON.'_incl_data/class/__db_connect.php');
//$ADMIN=1;
 
$time1 = microtime(true);//ћониторинг времени исполнени€

do_query('UPDATE `aligns_reting` SET `winner` = "0"');

$win = mysql_fetch_array(do_query('SELECT `id` FROM `aligns_reting` WHERE `points` > "0" ORDER BY `points` DESC LIMIT 1'));
if(isset($win['id'])) do_query('UPDATE `aligns_reting` SET `winner` = "1" WHERE `id` = "'.$win['id'].'"');

do_query('UPDATE `aligns_reting` SET `points` = "0"');
do_query('DELETE FROM `battle_aligns` WHERE `time` < "'.(time()-86400 * 7).'"');

//ћониторинг времени исполнени€
$time2 = microtime(true);
//if($c['cron_log']==true)
error_log(date('d-m-Y H:i:s')." cron_align_reting:".round($time2-$time1, 5)." sec");
?>