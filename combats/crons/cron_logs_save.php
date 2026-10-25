<?php
/* CRON переноса логов боев в файлы кеша */

include($P_CRON.'_incl_data/class/__db_connect.php');

set_time_limit(2500);
$limit = 20000;//5000 = 230сек. 10000 = 431сек. 15000 = 648сек. с задержкой 0.01 сек.
$limit_files = (date('G') < 10 ? 50000 : 5000);//Лимит удаления устаревших файлов
$time1 = microtime(true);
$sleep1 = (date('G') < 10 ? 0.02 : 0.1);//Задержка выполнения для снижения нагрузки - секунды - кеширование
$sleep2 = 0.005;//Задержка выполнения для снижения нагрузки - секунды - удаление из базы
list($del,$del2,$del3,$del4,$del5,$del6,$del7,$del8,$count,$count2,$count3) = array(0,0,0,0,0,0,0,0,1,0,0);

//Перенос прошедших боев в кеш
include($P_CRON.'jx/battle/log_text.php');

$sp3 = mysql_query('SELECT * FROM `battle` WHERE `time_over`<'.(time()-3600).' AND `team_win` != "-1" ORDER BY `id` LIMIT '.$limit) or die(mysql_error());// AND `id`="1373317"/
while( $btl = mysql_fetch_array($sp3) )
{
	//echo '<br>'.$count.':'.$btl['id'];
	//==========================Сохранение лога битвы===============================//
    $tbtl = '<img src="//img.testcombats.ru/i/fighttype'.$btl['type'].'.gif" />';
	if( $btl['invis'] > 0 ) $tbtl .= '<img src="//img.testcombats.ru/i/fighttypehidden0.gif" />';
	$tbtl = 'Тип боя: '.$tbtl.' ('.($btl['type'] == 1 ? 'кулачный' : 'физический').' поединок) &nbsp; &nbsp; ';
	if( $btl['izlom'] > 0 ) $tbtl .= 'Волна: '.$btl['izlomRoundSee'].' &nbsp; &nbsp; ';

	//Статус битвы
	$bType = $u->BattleType($u->BattleYron($btl['id']));
    $BattleType = ($btl['type'] == 99 ? '<font color=red>'.str_replace(' ','&nbsp;',$bType[4]).'</font>' : str_replace(' ','&nbsp;',$bType[3]));
    $ClanWar = ($btl['noinc']==2 ? '(клановая война)' : '');

	$pmax = mysql_fetch_array(mysql_query('SELECT `id_hod`, `id` FROM `battle_logs` WHERE `battle` = "'.$btl['id'].'" ORDER BY  `id_hod` DESC  LIMIT 1'));
	$pmax = ceil($pmax['id_hod']/30);
	if($pmax < 1) $pmax = 1;
	//echo 'pages:'.$pmax;

	$page = 1;
    while($page <= $pmax)//Генерируем страницы
	{
        $r = ''; $p = '';
		$btl_file = $P_CRON.'battle_logs/btl-'.$btl['id'].'-'.$page.'.html';
		if($page > 1000) break;//Аварийный выход

		if(!file_exists($btl_file))//Не сохраняем, если файл существует
		{
			$min = round(30*($page-1));
			if($min < 1) $min = 0;
			$max = $min + 29;

			if($min > round(30*($pmax-1)))
			{
				$min = round(30*($pmax-1));
				$max = $min+29;
			}

			$i = 1;
			while($i <= $pmax)
			{
				$style = (($page==$i || $page>$pmax && $i==$pmax) || ($page<1 && $i==1) ? ' style="color:maroon"' : '');
				$p .= ' <a'.$style.' href="/logs.php?log='.$btl['id'].'&p='.$i.'&rnd='.$code.'">'.$i.'</a> ';
				$i++;
			}

			$h = 0; $clr = 'e2e0e0'; $cclr = '';

			$sp = mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$btl['id'].'" AND `id_hod` > '.$min.' AND `id_hod` <= '.($max+1).' ORDER BY `id_hod`, `id` ASC');// LIMIT 200
			while($pl = mysql_fetch_array($sp))
			{
				$log_line = testlog($pl);
                if($log_line != '')
				{
					if($h != $pl['id_hod'])
					{
						if($h > 0)
						{
							$clr = ($clr == 'e2e0e0' ? 'e3e1e1' : 'e2e0e0');
							$cclr = 'border-top:1px solid #b1b1b1;';
						}
						$h = $pl['id_hod'];
					}

					$r .= '<div class="logs_php_line" style="background-color:#'.$clr.';'.$cclr.'padding:1px;">'.str_replace('\"','"',$log_line).'</div>';
					$cclr = '';
				}
			}

			//Собираем страницу
			$p = 'Страницы: '.$p;
			$r = '<div><span style="float:left;">'.$tbtl.$p.'</span><span style="float:right;">Статус битвы: <i>'.$BattleType.$ClanWar.'</i></span></div>
			<br><hr>'.$r.'<div id="not_found" style="display: none;"><i><center>Ничего не найдено. Совсем не найдено...</center></i></div>
			<hr><div align="left">'.$p.'</div>';

			if($page < 1000) $res = file_put_contents($btl_file, $r);//Пишем содержимое в файл
            $count2++;
		} //else {echo ' - btl exists: '.$page;}

		$page++;
	}

    //==========================Сохранение статов битвы===============================//
	$users = array(); $uids = array();
    $btl_stat_file = $P_CRON.'battle_logs/stat/btl-'.$btl['id'].'.html';

	if(!file_exists($btl_stat_file))//Не сохраняем, если файл существует
	{
	    //Получаем инфо
		$tpas = array(
			1 => 'X',
			2 => '<font color=#AAAAEE>&bull;</font>',
			3 => '<b>&bull;</b>',
			4 => '<font color=#FF0000>&curren;</font>',
			5 => '<font color=#FF0000>X</font>',
			6 => '<font color=#AAAAEE>&bull;</font>',
			7 => '<font color=777777><B>&bull;</B></font>',
			8 => '<font color=#AAAAEE>&bull;</font>'
		);

		$tpbs = array(
			0 => '',
			1 => '<B>&bull;</B>',
			2 => '<font color=#AAAAAA><B>&bull;</B></font>',
			3 => 'X',
			4 => '<font color=#FFEEEE><B>X</B></font>',
			5 => '<font color=#FFEEEE><B>&bull;</B></font>',
			6 => '<font color=#AAAAEE><B>&bull;</B></font>',
			7 => '<font color=#777777><B>&bull;</B></font>',
			8 => '<font color=#AAAAAA><B>&bull;</B></font>'
		);

		$sp = mysql_query('SELECT * FROM `battle_users` WHERE `battle` = "'.$btl['id'].'"');
		while($pl = mysql_fetch_array($sp))
		{
			if(!isset($uids[$pl['id']]))
			{
				$i = count($users);
				$users[$i] = $pl;
				$uids[$pl['uid']] = $i;
				//
				$users[$i]['value'] = array(
					'y' => 0, //уворотов+парирований+блоков щитом
					'b' => 0, //успешных блоков
					'p' => 0, //не успешных блоков, по персонажу попали
					'zb' => array( //Список зон блока
					),
					'sa' => array(0 => '',1 => '',2 => '',3 => '',4 => '',5 => ''),//Статистика ударов
					'sb' => array(0 => '',1 => '',2 => '',3 => '',4 => '',5 => '') //Статистика блоков
				);

				$sp2 = mysql_query('SELECT * FROM `battle_stat` WHERE `battle` = "'.$btl['id'].'" AND `uid1` = "'.$pl['uid'].'" ORDER BY `id` ASC');
				while($pl2 = mysql_fetch_array($sp2))
				{
					//Обновляем данные
					$users[$i]['yrn'] += $pl2['yrn'];
					$users[$i]['yrn_krit'] += $pl2['yrn_krit'];

					//Статистика далее
					$users[$i]['gaa']++;
					if( $users[$i]['yrn'] > 0 ) {$users[$i]['ga']++;}
					if( $users[$i]['yrn_krit'] > 0 ) {$users[$i]['gak']++;}

					//Получаем куда бил игрок
					$j = 0;
					while($j < $pl2['ma'])
					{
						$users[$i]['zona'][$pl2['a'][$j]]++;
						//
						$za = $pl2['a'][$j];
						$k = 1;
						while($k <= 5)
						{
							if( $za == $k )
							{
								$tpa = $pl2['type_a'][$j];
								$zag[$k] = true;
								$users[$i]['value']['sa'][$k] .= $tpas[$tpa];
							}else{$zag[$k] = false;}
							$k++;
						}

						$j++;
					}

					$j = $pl2['b'];
					$k = 0;
					while($k < $pl2['mb'])
					{
						if( $j > 5 ) {$j = 1;}
						$users[$i]['value']['zb'][] = array( 0 => $j , 1 => 0 );
						$users[$i]['zonb'][$j]++;
						$j++;
						$k++;
					}

					$k = 1;
					while($k <= 5)
					{
						if( $zag[$k] == false ){$users[$i]['value']['sa'][$k] .= ' ';}
						$k++;
					}
				}

				$sp2 = mysql_query('SELECT * FROM `battle_stat` WHERE `battle` = "'.$btl['id'].'" AND `uid2` = "'.$pl['uid'].'" ORDER BY `id` ASC');
				$k = 0;
				while($pl2 = mysql_fetch_array($sp2))
				{
					//Обновляем данные
					$users[$i]['_yrn'] -= $pl2['yrn'];
					$users[$i]['_yrn_krit'] -= $pl2['yrn_krit'];
					//Получаем куда били игрока
					$j = 0; $zag = array();

					while($j < $pl2['ma'])
					{
						$users[$i]['value']['zb'][$k][1] = $pl2['type_a'][$j];
						if( $pl2['type_a'][$j] == 2 || $pl2['type_a'][$j] == 6 || $pl2['type_a'][$j] == 7 || $pl2['type_a'][$j] == 8 ){$users[$i]['value']['y']++;}
						elseif( $pl2['type_a'][$j] == 3 ){$users[$i]['value']['b']++;}
						else{$users[$i]['value']['p']++;}
						//
						$j++;
					}

					$k++;
				}

				//Статистика блоков
				$k = 0;
				$h = 0;
				$bjj = array();
				while( $k < count($users[$i]['value']['zb']) )
				{
					$zb = 0+$users[$i]['value']['zb'][$k][0];
					$zt = 0+$users[$i]['value']['zb'][$k][1];
					$bjj[$zb] = true;
					$users[$i]['value']['sb'][$zb] .= ''.$tpbs[$zt].'';
					if( $h < 1 ) {$h++;}
					else{
						$d = 1;
						while($d <= 5)
						{
							if( $bjj[$d] == true ) {}
							else{$users[$i]['value']['sb'][$d] .= ' ';}
							$d++;
						}
						$bjj = array();
						$h = 0;
					}
					$k++;
				}
			}
		}

		$usr = '';
		$tm = array();
		$tm_u = array();
		$tm_v = array();

		$i = 0;
		while($i < count($users))
		{
			if( $users[$i] > 0 ) {
				$us = $users[$i];
				if( !isset($tm[$us['team']]) )
				{
					$tm[$us['team']] = '';
					$tm_v[] = $us['team'];
				}
				$tm_u[$us['team']][] = $i;
				$tm[$us['team']] .= con_login($us);
				$tm[$us['team']] .= ', ';
				unset($us);
			}
			$i++;
		}

		$i = 0;
		while($i < count($tm_v))
		{
			$usr .= rtrim($tm[$tm_v[$i]],', ');
			if( $i < count($tm_v)-1 ){$usr .= ' &nbsp; <b>против</b> &nbsp; ';}
			$i++;
		}

		$usr = '<H4>Участники поединка</H4>'.$usr.' ['.count($users).']<br><br>';
		$r  = '<H4>Последовательность ударов</H4>';
		$r .= '<TABLE border=1 cellspacing=0 cellpadding=4>
				<TR><TD align=center>Логин</TD><TD>Удар в</TD><TD>Последовательность ударов</TD></TR>';

		$i = 0;
		while($i <= count($tm_v))
		{
			$j = 0;
			$team_data = array( 'g' => false );
			while($j < count($tm_u[$tm_v[$i]]))
			{
				$us = $users[$tm_u[$tm_v[$i]][$j]];
				if($us['id'] > 0)
				{
					$rh = '';
					$rh .= ''.$us['value']['sa'][1].'';
					$rh .= '<br>'.$us['value']['sa'][2].'';
					$rh .= '<br>'.$us['value']['sa'][3].'';
					$rh .= '<br>'.$us['value']['sa'][4].'';
					$rh .= '<br>'.$us['value']['sa'][5].'';
					$r .= '<TR><TD align=center nowrap>'.con_login($us).'</TD><TD nowrap align="right"><pre>голову<br>грудь<br>живот<br>пояс<br>ноги</pre></TD><TD style="font-size:16px" nowrap><pre>'.$rh.'</pre></TD></TR>';
				}
				unset($us);
				$j++;
			}

			$i++;
		}

		$r .= '</TABLE><-help2->';
		$r .= '<H4>Последовательность блоков</H4>';
		$r .= '<TABLE border=1 cellspacing=0 cellpadding=4>
		<TR><TD align=center>Логин</TD><TD>Блок</TD><TD>Последовательность блоков</TD></TR>';

		$i = 0;
		while($i <= count($tm_v))
		{
			$j = 0;
			$team_data = array( 'g' => false );
			while($j < count($tm_u[$tm_v[$i]]))
			{
				$us = $users[$tm_u[$tm_v[$i]][$j]];
				if($us['id'] > 0)
				{
					$rh = '';
					$rh .= ''.$us['value']['sb'][1].'';
					$rh .= '<br>'.$us['value']['sb'][2].'';
					$rh .= '<br>'.$us['value']['sb'][3].'';
					$rh .= '<br>'.$us['value']['sb'][4].'';
					$rh .= '<br>'.$us['value']['sb'][5].'';
					$r .= '<TR><TD align=center nowrap>'.con_login($us).'</TD><TD nowrap align="right"><pre>голова<br>грудь<br>живот<br>пояс<br>ноги</pre></TD><TD style="font-size:16px" nowrap><pre>'.$rh.'</pre></TD></TR>';
				}
				unset($us);
				$j++;
			}

			$i++;
		}

		$r .= '</TABLE><-help3->';
		$r .= '<H4>Суммарно</H4>';
		$r .= '<TABLE border=1 cellspacing=0 cellpadding=4>
		<TR><TD align=center>&nbsp;</TD><TD align=center>Логин</TD><TD>Удары</TD><TD>Блоки</TD><TD>Попадания</TD><TD>Защита</TD><TD>Урон</TD><TD>Потери</TD><TD>Вылечено</TD></TR>';

		$i = 0;
		while($i <= count($tm_v))
		{
			$j = 0;
			$team_data = array( 'g' => false );
			while($j < count($tm_u[$tm_v[$i]]))
			{
				$us = $users[$tm_u[$tm_v[$i]][$j]];
				if($us['id'] > 0)
				{
					$team_data['g'] = true;
					$us['heal'] = ($us['hp']-$us['hpAll'])-$us['_yrn'];
					if($us['heal']<0) {$us['heal'] = 0;}
					if( $us['hp'] < 0 ) {$us['hp'] = 0;}
					if( $us['yrn'] < 0 ) {$us['yrn'] = 0;}
					if( $us['yrn_krit'] < 0 ) {$us['yrn_krit'] = 0;}
					if( $us['_yrn'] > 0 ) {$us['_yrn'] = 0;}
					if( $us['_yrn_krit'] > 0 ) {$us['_yrn_krit'] = 0;}

					$team_data['ga'] += $us['ga'];
					$team_data['gaa'] += $us['gaa'];
					$team_data['gak'] += $us['gak'];
					$team_data['hp'] += $us['hp'];
					$team_data['hpAll'] += $us['hpAll'];
					$team_data['yrn'] += $us['yrn'];
					$team_data['yrn_krit'] += $us['yrn_krit'];
					$team_data['_yrn'] += $us['_yrn'];
					$team_data['_yrn_krit'] += $us['_yrn_krit'];
					$team_data['val_b'] += $us['value']['b'];
					$team_data['val_y'] += $us['value']['y'];
					$team_data['val_p'] += $us['value']['p'];
					$team_data['heal'] += $us['heal'];
					$winw = '';
					if( $us['hp'] < 1 )
					{
						$us['hp'] = '<font color=red>0</font>';
						$winw = '<img title="Погиб" width="7" height="7" src="//img.testcombats.ru/i/ico/looses.gif">';
					} else {$winw = '<img title="Выжил" width="7" height="7" src="//img.testcombats.ru/i/ico/wins.gif">';}
					$r .= '<TR><TD valign=middle align=center>'.$winw.'</TD><TD align=right>'.con_login($us).' ['.$us['hp'].'/'.$us['hpAll'].']</TD><TD>'.(0+$us['zona'][1]).'/'.(0+$us['zona'][2]).'/'.(0+$us['zona'][3]).'/'.(0+$us['zona'][4]).'/'.(0+$us['zona'][5]).'</TD><TD>'.(0+$us['zonb'][1]).'/'.(0+$us['zonb'][2]).'/'.(0+$us['zonb'][3]).'/'.(0+$us['zonb'][4]).'/'.(0+$us['zonb'][5]).'</TD><TD align=center>'.(0+$us['ga']).'(<font color=red>'.(0+$us['gak']).'</font>)/'.($us['gaa']).'</TD><TD align=center>'.$us['value']['b'].'/'.$us['value']['y'].'/'.$us['value']['p'].'</TD><TD align=center>'.$us['yrn'].'/<font color=red>'.$us['yrn_krit'].'</font></TD><TD align=center>'.(-$us['_yrn']).'</TD><TD align=center>'.$us['heal'].'</TD></TR>';
				}
				unset($us);
				$j++;
			}

			if( $team_data['g'] == true )
			{
				$winw = '--';
				if( $team_data['hp'] < 1 ){$team_data['hp'] = '0';}
				else{$winw = '<img src="//img.testcombats.ru/i/flag.gif" width="20" height="20" title="Победитель">';}
				$r .= '<TR bgcolor=d2d0d0><TD align=center>'.$winw.'</TD><TD align=right><b class="CSSteam'.$tm_v[$i].'">Всего ['.$team_data['hp'].'/'.$team_data['hpAll'].']</b></TD><TD>&nbsp;</TD><TD>&nbsp;</TD><TD align=center>'.(0+$team_data['ga']).'(<font color=red>'.(0+$team_data['gak']).'</font>)/'.($team_data['gaa']).'</TD><TD align=center>'.$team_data['val_b'].'/'.$team_data['val_y'].'/'.$team_data['val_p'].'</TD><TD align=center>'.$team_data['yrn'].'/<font color=red>'.$team_data['yrn_krit'].'</font></TD><TD align=center>'.(-$team_data['_yrn']).'</TD><TD align=center>'.$team_data['heal'].'</TD></TR>';
			}

			$i++;
		}

		$r .= '</TABLE><-help->';
	    $tbtl .= 'Продолжительность боя: '.$u->timeOut($btl['time_over']-$btl['time_start']).'<br>';
	    $r = '<div><span style="float:left;">'.$tbtl.'</span><span style="float:right;">Статус битвы: <i>'.$BattleType.$ClanWar.'</i></span></div><br><br>'.$usr.$r;

		// Пишем содержимое в файл
		$res = file_put_contents($btl_stat_file, $r);
        $count3++;
	} //else {echo ' - stats exists';}

    //Удаляем логи боя из базы
    mysql_query('DELETE FROM `battle`  WHERE `id` = "'.$btl['id'].'"');
	$res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
	$del += $res['Count'];

	mysql_query('DELETE FROM `battle_logs`  WHERE `battle` = "'.$btl['id'].'"');
	$res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
	$del2 += $res['Count'];

    time_sleep_until(microtime(true)+$sleep2);

	mysql_query('DELETE FROM `battle_stat`  WHERE `battle` = "'.$btl['id'].'"');
	$res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
	$del3 += $res['Count'];

    mysql_query('DELETE FROM `battle_users` WHERE `battle` = "'.$btl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del5 += $res['Count'];
    
    mysql_query('DELETE FROM `battle_out`   WHERE `battle` = "'.$btl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del6 += $res['Count'];

    mysql_query('DELETE FROM `battle_actions` WHERE `btl` = "'.$btl['id'].'"');
    $res = mysql_fetch_array(mysql_query('SELECT ROW_COUNT() as Count'));
    $del7 += $res['Count'];

    time_sleep_until(microtime(true)+$sleep1);
	$count++;
}

error_log('battles:'.$del.' logs: '.$del2.' stats: '.$del3.' end:'.$del4.' users:'.$del5.' out:'.$del6.' actions:'.$del7);
error_log('all rows:'.($del+$del2+$del3+$del4+$del5+$del6+$del7).' deleted');
error_log('Files saved: battles:  '.$count2.'. Stats: '.$count3);

//Великие битвы
$great_btl = array();
$sp3 = mysql_query('SELECT `battle` FROM `battle_great`');
while( $btl = mysql_fetch_array($sp3) )
{
    $great_btl[] = $btl['battle'];
}

//Очистка папки battle_logs от старых логов
$dir = $P_CRON."battle_logs/";
$files = glob($dir."*");
$now  = time();
$del = 0;

foreach ($files as $file)
{
  if (is_file($file))
  {
	preg_match('/btl-([0-9]+)-/', $file, $matches);
	
	if (($now - filemtime($file) >= 86400 * 7) && !in_array($matches[1], $great_btl))//7 days
	{
	  	unlink($file);
	  	$del++;
    }
  }
  if($del==$limit_files) break;
}

error_log('battle: '.count($files).' files. Deleted: '.$del);

//Очистка папки battle_logs/stat от старых логов
$dir = $P_CRON."battle_logs/stat/";
$files = glob($dir."*");
$now  = time();
$del = 0;

foreach ($files as $file)
{
  if (is_file($file))
  {
    preg_match('/btl-([0-9]+)\.html/', $file, $matches);

	if (($now - filemtime($file) >= 86400 * 7) && !in_array($matches[1], $great_btl))//7 days
	{
	  	unlink($file);
	  	$del++;
    }
  }
  if($del==$limit_files) break;
}

error_log('battle_stat: '.count($files).' files. Deleted: '.$del);

$time2 = microtime(true);
error_log('Time:'.round($time2-$time1, 2).' sec');
$LA = LA();
error_log('Proc: '.$LA[0].' ('.$LA[3].'%)');
error_log('==================SaveLogs ['.date('d-m-Y H:i').' lim: '.$limit.']========================');

//Функции
function con_login($us)
{
	$r = '';
	if( $us['align'] > 0 ) {$r .= '<img src="//img.testcombats.ru/i/align/align'.$us['align'].'.gif" width="12" height="15">';}
	if( $us['clan'] > 0 )  {$r .= '<a href="clans_info/'.$us['clan'].'" target="_blank"><img src="//img.testcombats.ru/i/clan/'.$us['clan'].'.gif" width="24" height="15"></a>';}
	$r .= '<b class="CSSteam'.$us['team'].'">'.$us['login'].' ['.$us['level'].']</b>';
	$r .= '<a href="info/'.$us['uid'].'" target="_blank"><img src="//img.testcombats.ru/i/inf_capitalcity.gif" width="12" height="11"></a>';

	return $r;
}

function testlog($pl)
{
	global $log_text,$c,$u,$code;

	if($pl['type']==1 || $pl['type']==6)
	{
		$dt = explode('||',$pl['vars']);
		$i = 0; $d = array();
        $no1 = 0; $no2 = 0;

		while($i<count($dt))
		{
			$r = explode('=',$dt[$i]);
			if($r[0]!=''){$d[$r[0]] = $r[1];}

			if($r[0]=='login1' && $r[1]=='') $no1 = 1;
            if($r[0]=='login2' && $r[1]=='') $no2 = 1;

			$i++;
		}

		if($no1 && $no2) return '';//Не показывать размены без пользователей

		//обычный удар
		$rt = $pl['text'];
		//заменяем данные
		//$rt = str_replace('{u1}','<span onClick="top.addTo(\''.$d['login1'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login1'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t1'].'">'.$d['login1'].'</span>',$rt);
		//$rt = str_replace('{u2}','<span onClick="top.addTo(\''.$d['login2'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login2'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t2'].'">'.$d['login2'].'</span>',$rt);
        $rt = str_replace('{u1}','<span  class="CSSteam'.$d['t1'].'">'.$d['login1'].'</span>',$rt);
		$rt = str_replace('{u2}','<span  class="CSSteam'.$d['t2'].'">'.$d['login2'].'</span>',$rt);
		$rt = str_replace('{pr}','<b>'.$d['prm'].'</b>',$rt);
		$rt = str_replace('^^^^','=',$rt);
		$rt = str_replace('{tm1}','<span class="date">'.($u->info['admin']>0 ? date('H:i:s',$d['time1']) : date('H:i',$d['time1'])).'</span>',$rt);
		$rt = str_replace('{tm2}','<span class="date">'.($u->info['admin']>0 ? date('H:i:s',$d['time2']) : date('H:i',$d['time2'])).'</span>',$rt);
		$rt = str_replace('{tm3}','<span class="date">'.date('d.m.Y H:i',$d['time1']).'</span>',$rt);
		$rt = str_replace('{tm4}','<span class="date">'.date('d.m.Y H:i',$d['time2']).'</span>',$rt);

		$k01 = 1;
		$zb1 = array(1=>0,2=>0,3=>0,4=>0,5=>0);
		$zb2 = array(1=>0,2=>0,3=>0,4=>0,5=>0);

		if($d['bl2']>0)
		{
			$b11 = 1;
			$b12 = $d['bl1'];

			while($b11<=$d['zb1'])
			{
				$zb1[$b12] = 1;
				if($b12>=5 || $b12<0){$b12 = 0;}
				$b12++;
				$b11++;
			}
		}

		if($d['bl2']>0)
		{
			$b11 = 1;
			$b12 = $d['bl2'];

			while($b11<=$d['zb2'])
			{
				$zb2[$b12] = 1;
				if($b12>=5 || $b12<0){$b12 = 0;}
				$b12++;
				$b11++;
			}
		}

		while($k01<=5)
		{
			$zns01 = ''; $zns02 = '';
			$j01 = 1;

			while($j01<=5)
			{
				$zab1 = '0'; $zab2 = '0';
				if($j01==$k01)
				{
					$zab1 = '1';
					$zab2 = '1';
				}

				$zab1 .= $zb1[$j01];
				$zab2 .= $zb2[$j01];

				$zns01 .= '<img src="//img.testcombats.ru/i/zones/'.$d['t1'].'/'.$d['t2'].''.$zab1.'.gif">';
				$zns02 .= '<img src="//img.testcombats.ru/i/zones/'.$d['t2'].'/'.$d['t1'].''.$zab2.'.gif">';
				$j01++;
			}

			$rt = str_replace('{zn1_'.$k01.'}',$zns01,$rt);
			$rt = str_replace('{zn2_'.$k01.'}',$zns02,$rt);
			$k01++;
		}

		$j = 1;
		while($j<=21)
		{
			//замена R - игрок 1
			$r = $log_text[$d['s1']][$j];
			$k = 0;

			while($k<=count($r))
			{
				if(isset($log_text[$d['s1']][$j][$k])){$rt = str_replace('{1x'.$j.'x'.$k.'}',$log_text[$d['s1']][$j][$k],$rt);}
				$k++;
			}

			//замена R - игрок 2
			$r = $log_text[$d['s2']][$j];
			$k = 0;

			while($k<=count($r))
			{
				if(isset($log_text[$d['s2']][$j][$k])){$rt = str_replace('{2x'.$j.'x'.$k.'}',$log_text[$d['s2']][$j][$k],$rt);}
				$k++;
			}
			$j++;
		}

		//заменяем данные повторно
		//$rt = str_replace('{u1}','<span onClick="top.addTo(\''.$d['login1'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login1'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t1'].'">'.$d['login1'].'</span>',$rt);
		//$rt = str_replace('{u2}','<span onClick="top.addTo(\''.$d['login2'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login2'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t2'].'">'.$d['login2'].'</span>',$rt);
        $rt = str_replace('{u1}','<span class="CSSteam'.$d['t1'].'">'.$d['login1'].'</span>',$rt);
		$rt = str_replace('{u2}','<span class="CSSteam'.$d['t2'].'">'.$d['login2'].'</span>',$rt);
		$rt = str_replace('{pr}','<b>'.$d['prm'].'</b>',$rt);
		$rt = str_replace('^^^^','=',$rt);
		$rt = str_replace('{tm1}','<span class="date">'.date('H:i',$d['time1']).'</span>',$rt);
		$rt = str_replace('{tm2}','<span class="date">'.date('H:i',$d['time2']).'</span>',$rt);
		$rt = str_replace('{tm3}','<span class="date">'.date('d.m.Y H:i',$d['time1']).'</span>',$rt);
		$rt = str_replace('{tm4}','<span class="date">'.date('d.m.Y H:i',$d['time2']).'</span>',$rt);

		//закончили заменять
		$pl['text'] = $rt;
	}
	return $pl['text'];
}

?>