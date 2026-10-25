<?php
/* CRON переноса истории боев (прошедшие) в файлы кеша */

include($P_CRON.'_incl_data/class/__db_connect.php');

//Перенос прошедших боев в кеш всех кроме сегодняшнего дня
$sp1 = mysql_query('SELECT `id` FROM `users` WHERE `online` > "'.(time()-86400*30).'" LIMIT '.$limit);//WHERE `id`="8037563"
while( $usr = mysql_fetch_array($sp1) )
{
	$sp = mysql_query('SELECT * FROM `battle_last` WHERE `uid` = "'.$usr['id'].'" AND time < "'.$time_start.'" ORDER BY `id` DESC');
	$btl_lst = array();
    $file_name_old = '';
	$tm = '';
    $j = 1;
    //pr('user:'.$usr['id']);

	while($pl = mysql_fetch_array($sp))
	{
		$file_name = $P_CRON.'battle_last/'.$usr['id'].'-'.date('d-m-y',$pl['time']).'.html';

        if(!file_exists($file_name_old) && $file_name_old != $file_name && $file_name_old)
		{
			//pr('<br>'.$pl['battle_id'].' : '.$file_name_old);//pr('<br>'.$tm);
			$res = file_put_contents($file_name_old, $tm);//Пишем содержимое в файл

			$tm = '';
			$j = 1;
            $count++;
		}

		if(!isset($btl_lst[$pl['battle_id']]) && isset($pl['battle_id']))
		{
			$tms = array(); $ts = array();
			$spi = mysql_query('SELECT * FROM `battle_last` WHERE `battle_id` = "'.$pl['battle_id'].'"');
			while($pli = mysql_fetch_array($spi))
			{
				if(!isset($tms[$pli['team']])) $ts[count($ts)] = $pli['team'];
				$tms[$pli['team']][count($tms[$pli['team']])] = $pli;
			}
			$k = 0;

			while($k<count($ts))
			{
				$g = $ts[$k];
				$h = 0;
				$tm2 = '';

				while($h<count($tms[$g]))
				{
					if($tms[$g][$h]['uid']>0)
					{
						if($tms[$g][$h]['align']>0) $tm2 .= '<img src="//img.testcombats.ru/i/align/align'.$tms[$g][$h]['align'].'.gif">';
						$tm2 .= '<b>'.$tms[$g][$h]['login'].'</b> ['.$tms[$g][$h]['lvl'].']<a href="info/'.$tms[$g][$h]['uid'].'" target="_blank"><img src="//img.testcombats.ru/i/inf_capitalcity.gif"></a>, ';
					}
					$h++;
				}

				$tm2 = rtrim($tm2,', ');
				$btlg = mysql_fetch_array(mysql_query('SELECT `id`,`team_win` FROM `battle` WHERE `id` = "'.$pl['battle_id'].'" LIMIT 1'));
				if(isset($btlg['id']) && $g == $btlg['team_win']) $tm2 .= ' <img width="20" height="20" src="//img.testcombats.ru/i/flag.gif" title="Победа"> ';

				if($k==0) $tm2 = $j.'. <font class=date>'.date('d.m.y H:i',$pl['time']).'</font> '.$tm2;
				$tm .= $tm2;
				if($k+1<count($ts) && $tm2!='' && $ts[$k+1]>0) $tm .= ' <font color=red><b>против</b></font> ';
				$k++;
			}
			$tm .= ' <A HREF="/logs.php?log='.$pl['battle_id'].'&rnd=1" target=_blank>»»</A><br>';
		}
		
		$file_name_old = $file_name;
		$j++;
	}

	if($file_name_old && !file_exists($file_name_old) && $tm)
	{
        $res = file_put_contents($file_name_old, $tm);//Пишем содержимое в файл
        $count++;
	}

    time_sleep_until(microtime(true)+$sleep1);
}
error_log('Files saved: '.$count);

//Удаляем логи боя из базы
mysql_query('DELETE FROM `battle_last`  WHERE `time` < "'.$time_start.'"');
$res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
$del = $res['Count'];
mysql_query('OPTIMIZE TABLE `battle_last`');

//Очистка папки battle_last от старых логов
$dir = $P_CRON."battle_last/";
$files = glob($dir."*");
$now  = time();
$del = 0;

foreach ($files as $file)
{
  if (is_file($file))
  {
	if ($now - filemtime($file) >= 86400 * 7)// 7 days
	{
      unlink($file);
	  $del++;
    }
  }
  if($del==$limit_files) break;
}

?>