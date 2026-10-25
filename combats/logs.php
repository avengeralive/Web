<?
define('GAME',true);
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

$_GET['log'] = intval($_GET['log']);
$page = (isset($_GET['p']) ? (int)$_GET['p'] : 1);
$btl_file = $c['doc_root'].'/battle_logs/btl-'.$_GET['log'].'-'.$page.'.html';
$btl_stat_file = $c['doc_root'].'/battle_logs/stat/btl-'.$_GET['log'].'.html';

$btl = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.mysql_real_escape_string($_GET['log']).'" LIMIT 1'));
if(isset($btl['id']))
{
	$bType = $u->BattleType($u->BattleYron($btl['id']));
    $BattleType = ($btl['type'] == 99 ? '<font style="color:red; font-size: 13px;">'.str_replace(' ','&nbsp;',$bType[4]).'</font>' : str_replace(' ','&nbsp;',$bType[3]));
	$ClanWar = ($btl['noinc']==2 ? ' (Клановая война)' : '');
}
elseif(file_exists($btl_file))
{
	$cache_f = file_get_contents($btl_file);
    preg_match('#Локация просмотра боя: <i>(.*)</i>#', $cache_f, $arr);//получаем статус из файла кеша
	$BattleType = $arr[1];
    //$ClanWar = (substr_count($cache_f,'клановая война') ? '(клановая война)' : '');
}

$fil = '<span style="margin-left: 25px;">Поиск: <form id="line_filter" style="display: inline;" onsubmit="return false;"> <input type="text" id="line_filter_input" size="25" autocomplete="off" style="padding:1px;" /> <input type="submit" id="line_filter_input_submit" value="Фильтр" onclick="return false" /> <input type="button" id="line_filter_glow" value="Подсветка" /></form></span>';
$r = ''; $p = '';
$b = '<table width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size:9pt;">
  <tbody>
    <tr valign="top">
      <td valign="bottom" nowrap="" title="">
	  <input onClick="location=location;" type="submit" name="analiz2" value="Обновить">';

if($btl['team_win'] != -1)
{
	if(!isset($_GET['analiz']))
	{
		$b .= ' <input onClick="location=\'logs.php?log='.((int)$_GET['log']).'&analiz=1\';" type="submit" name="analiz3" value="Статистика">';
	    $b .= $fil;
	}else{
		$b .= ' <input onClick="location=\'logs.php?log='.((int)$_GET['log']).'\';" type="submit" name="analiz3" value="Лог боя">';
	}
}

$b .= '</td>
    </tr>	
  </tbody>
</table>';

if(((isset($btl['id']) && $btl['team_win'] != -1) || file_exists($btl_stat_file)) && isset($_GET['analiz']))
{
    $help = '<br>
	Логин - имя персонажа и уровень жизни: [сейчас/всего]<br>
	Удары - статистика ударов по областям: голова/грудь/живот/пояс/ноги (всего)<br>
	Блоки - статистика блоков по областям: голова/грудь/живот/пояс/ноги<br>
	Попадания - удачных попаданий <font color=red>(из них критов)</font> / всего ударов<br>
	Защита - ударов заблокировано / уворотов / пропущено ударов<br>
	Урон - выбито HP из противников / из них <font color=red>критами</font><br>
	Потери - получено повреждений <br>
	Вылечено - восстановлено HP<br>';

	$help2 = '(<b>X</b>&nbsp;-&nbsp;удачный&nbsp;удар, <font color=red><B>&curren;</b></font> - критический удар пробив блок , <font color=red><B>X</B></font>
	&nbsp;-&nbsp;критический&nbsp;удар, <font color=red><B><code>&Xi;</code></B></font>&nbsp;-&nbsp;крит + инвалидность, <font color=006600><B>X</B></font>
	&nbsp;-&nbsp;доп.&nbsp;магический&nbsp;удар,<BR>&nbsp;<B>&bull;</B>&nbsp;-&nbsp;противник&nbsp;блокировал&nbsp;удар, <font color=AAAAAA><B>&bull;</B></font>
	&nbsp;-&nbsp;увернулся, <font color=AAAAEE><B>&bull;</B></font>&nbsp;-&nbsp;парировал, <font color=777777><B>&bull;</B></font>&nbsp;-&nbsp;отбил удар щитом)';

	$help3 = '(<b>X</b>&nbsp;-&nbsp;удачный блок, <b><FONT COLOR=red>X</FONT></b>&nbsp;-&nbsp;пробили блок критом, <B>&bull;</B>&nbsp;-&nbsp;пропустил удар,
	<font color=#AAAAAA><B>&bull;</B></font>&nbsp;-&nbsp;увернулся,
	<font color=#AAAAEE><B>&bull;</B></font>&nbsp;-&nbsp;парировал,
	<font color=#777777><B>&bull;</B></font>&nbsp;-&nbsp;отбил щитом)';

	if(!file_exists($btl_stat_file))
	{
		$tmStart = $u->timeOut($btl['time_over']-$btl['time_start']);
		$tbtl = '<img src="//img.testcombats.ru/i/fighttype'.$btl['type'].'.gif">';
		if( $btl['invis'] > 0 ) {$tbtl .= '<img src="//img.testcombats.ru/i/fighttypehidden0.gif">';}
		$tbtl = 'Тип боя: '.$tbtl.' ('.($btl['type'] == 1 ? 'кулачный' : '<b>физический</b>').' <b>бой</b>) &nbsp; &nbsp; ';
		if( $btl['izlom'] > 0 ) {$tbtl .= 'Волна: '.$btl['izlomRoundSee'].' &nbsp; &nbsp; ';}
		$tbtl .= 'Продолжительность боя: '.$tmStart.'<br>';

		$users = array(); $uids = array();

		 function con_login($us)
		{
			$r = '';
			if( $us['align'] > 0 ) {$r .= '<img src="//img.testcombats.ru/i/align/align'.$us['align'].'.gif" width="12" height="15">';}
			if( $us['clan'] > 0 ) {$r .= '<a href="/clan/'.$us['clan'].'" target="_blank"><img src="//img.testcombats.ru/i/clan/'.$us['clan'].'.gif" width="24" height="15"></a>';}
			$r .= '<b class="CSSteam'.$us['team'].'">'.$us['login'].' ['.$us['level'].']</b>';
			$r .= '<a href="inf.php?login='.$us['login'].'" target="_blank"><img src="//img.testcombats.ru/i/inf_'.$us['cityreg'].'.gif" width="12" height="11"></a>';

			return $r;
		}

		//Поулучаем инфо
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
					'sa' => array( //Статистика ударов
						0 => '',
						1 => '',
						2 => '',
						3 => '',
						4 => '',
						5 => ''
					),
					'sb' => array( //Статистика блоков
						0 => '',
						1 => '',
						2 => '',
						3 => '',
						4 => '',
						5 => ''
					)
				);
				$sp2 = mysql_query('SELECT * FROM `battle_stat` WHERE `battle` = "'.$btl['id'].'" AND `uid1` = "'.$pl['uid'].'" ORDER BY `id` DESC');
				while($pl2 = mysql_fetch_array($sp2))
				{
					//Обновляем данные
					$users[$i]['yrn'] += $pl2['yrn'];
					$users[$i]['yrn_krit'] += $pl2['yrn_krit'];
					//Статистика далее
					$users[$i]['gaa']++;
					if( $users[$i]['yrn'] > 0 ) {
						$users[$i]['ga']++;
					}
					if( $users[$i]['yrn_krit'] > 0 ) {
						$users[$i]['gak']++;
					}
					//Получаем куда бил игрок
					$j = 0;
					while($j < $pl2['ma']) {
						$users[$i]['zona'][$pl2['a'][$j]]++;
						//
						$za = $pl2['a'][$j];
						$k = 1;
						while($k <= 5) {
							if( $za == $k ) {
								$tpa = $pl2['type_a'][$j];
								$zag[$k] = true;
								$users[$i]['value']['sa'][$k] .= $tpas[$tpa];
							}else{
								$zag[$k] = false;
								//$users[$i]['value']['sa'][$za] .= '.';
							}
							$k++;
						}
						//
						$j++;
					}
					$j = $pl2['b'];
					$k = 0;
					while($k < $pl2['mb']) {
						if( $j > 5 ) {
							$j = 1;
						}
						$users[$i]['value']['zb'][] = array( 0 => $j , 1 => 0 );
						$users[$i]['zonb'][$j]++;
						$j++;
						$k++;
					}
					//
					$k = 1;
					while($k <= 5) {
						if( $zag[$k] == false ) {
							$users[$i]['value']['sa'][$k] .= ' ';
						}
						$k++;
					}
					//
				}
				//
				$sp2 = mysql_query('SELECT * FROM `battle_stat` WHERE `battle` = "'.$btl['id'].'" AND `uid2` = "'.$pl['uid'].'" ORDER BY `id` ASC');
				$k = 0;
				while($pl2 = mysql_fetch_array($sp2))
				{
					//Обновляем данные
					$users[$i]['_yrn'] -= $pl2['yrn'];
					$users[$i]['_yrn_krit'] -= $pl2['yrn_krit'];
					//Получаем куда били игрока
					$j = 0; $zag = array();
					while($j < $pl2['ma']) {
						$users[$i]['value']['zb'][$k][1] = $pl2['type_a'][$j];
						if( $pl2['type_a'][$j] == 2 || $pl2['type_a'][$j] == 6 || $pl2['type_a'][$j] == 7 || $pl2['type_a'][$j] == 8 ) {
							$users[$i]['value']['y']++;
						}elseif( $pl2['type_a'][$j] == 3 ) {
							$users[$i]['value']['b']++;
						}else{
							$users[$i]['value']['p']++;
						}
						//
						$j++;
					}
					//
					$k++;
					//
				}
				//Статистика блоков
				$k = 0;
				$h = 0;
				$bjj = array();
				while( $k < count($users[$i]['value']['zb']) ) {
					$zb = 0+$users[$i]['value']['zb'][$k][0];
					$zt = 0+$users[$i]['value']['zb'][$k][1];
					$bjj[$zb] = true;
					$users[$i]['value']['sb'][$zb] .= ''.$tpbs[$zt].'';
					if( $h < 1 ) {
						$h++;
					}else{
						$d = 1;
						while($d <= 5) {
							if( $bjj[$d] == true ) {

							}else{
								$users[$i]['value']['sb'][$d] .= ' ';
							}
							$d++;
						}
						$bjj = array();
						$h = 0;
					}
					$k++;
				}
				//
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
				if( !isset($tm[$us['team']]) ) {
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
			if( $i < count($tm_v)-1 )
			{
				$usr .= ' &nbsp; <b>против</b> &nbsp; ';
			}
			$i++;
		}
		//
		$usr = '<H4>Участники поединка ['.count($users).']</H4>'.$usr.'<br><br>';
		//
		$r = '';
		//
		$r .= '<H4>Последовательность ударов</H4>';
		$r .= '<TABLE border=1 cellspacing=0 cellpadding=4>
		<TR><TD align=center>Логин</TD><TD>Удар в</TD><TD>Последовательность ударов</TD></TR>';
		$i = 0;
		while($i <= count($tm_v))
		{
			$j = 0;
			$team_data = array( 'g' => false );
			while($j < count($tm_u[$tm_v[$i]])) {
				$us = $users[$tm_u[$tm_v[$i]][$j]];
				if($us['id'] > 0) {
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
		$r .= '</TABLE>'.$help2;
		//
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
				if($us['id'] > 0) {
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
		$r .= '</TABLE>'.$help3;
		//
		$r .= '<H4>Суммарно</H4>';
		$r .= '<TABLE border=1 cellspacing=0 cellpadding=4>
		<TR><TD align=center>&nbsp;</TD><TD align=center>Логин</TD><TD>Удары</TD><TD>Блоки</TD><TD>Попадания</TD><TD>Защита</TD><TD>Урон</TD><TD>Потери</TD><TD>Вылечено</TD></TR>';
		//<TR><TD align=right>&nbsp;</TD><TD>&nbsp;</TD><TD>&nbsp;</TD><TD align=center>&nbsp;</TD><TD align=center>&nbsp;</TD><TD align=center>&nbsp;</TD><TD align=center>&nbsp;</TD><TD align=center>&nbsp;</TD></TR>
		$i = 0;
		while($i <= count($tm_v))
		{
			$j = 0;
			$team_data = array( 'g' => false );
			while($j < count($tm_u[$tm_v[$i]])) {
				$us = $users[$tm_u[$tm_v[$i]][$j]];
				if($us['id'] > 0) {
					$team_data['g'] = true;
					$us['heal'] = ($us['hp']-$us['hpAll'])-$us['_yrn'];
					if($us['heal']<0) {
						$us['heal'] = 0;
					}
					if( $us['hp'] < 0 ) {
						$us['hp'] = 0;
					}
					if( $us['yrn'] < 0 ) {
						$us['yrn'] = 0;
					}
					if( $us['yrn_krit'] < 0 ) {
						$us['yrn_krit'] = 0;
					}
					if( $us['_yrn'] > 0 ) {
						$us['_yrn'] = 0;
					}
					if( $us['_yrn_krit'] > 0 ) {
						$us['_yrn_krit'] = 0;
					}
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
					if( $us['hp'] < 1 ) {
						$us['hp'] = '<font color=red>0</font>';
						$winw = '<img title="Погиб" width="7" height="7" src="//img.testcombats.ru/i/ico/looses.gif">';
					}else{
						$winw = '<img title="Выжил" width="7" height="7" src="//img.testcombats.ru/i/ico/wins.gif">';
					}
					$udar_all = $us['zona'][1] + $us['zona'][2] + $us['zona'][3] + $us['zona'][4] + $us['zona'][5];
					$r .= '<TR><TD valign=middle align=center>'.$winw.'</TD><TD align=right>'.con_login($us).' ['.$us['hp'].'/'.$us['hpAll'].']</TD><TD>'.(0+$us['zona'][1]).'/'.(0+$us['zona'][2]).'/'.(0+$us['zona'][3]).'/'.(0+$us['zona'][4]).'/'.(0+$us['zona'][5]).'('.$udar_all.')</TD><TD>'.(0+$us['zonb'][1]).'/'.(0+$us['zonb'][2]).'/'.(0+$us['zonb'][3]).'/'.(0+$us['zonb'][4]).'/'.(0+$us['zonb'][5]).'</TD><TD align=center>'.(0+$us['ga']).'(<font color=red>'.(0+$us['gak']).'</font>)/'.($us['gaa']).'</TD><TD align=center>'.$us['value']['b'].'/'.$us['value']['y'].'/'.$us['value']['p'].'</TD><TD align=center>'.$us['yrn'].'/<font color=red>'.$us['yrn_krit'].'</font></TD><TD align=center>'.(-$us['_yrn']).'</TD><TD align=center>'.$us['heal'].'</TD></TR>';
				}
				unset($us);
				$j++;
			}
			if( $team_data['g'] == true )
			{
				$winw = '--';
				if( $team_data['hp'] < 1 ) {$team_data['hp'] = '0';}
				else{$winw = '<img src="//img.testcombats.ru/i/flag.gif" width="20" height="20" title="Победитель">';}

				$r .= '<TR bgcolor=d2d0d0><TD align=center>'.$winw.'</TD><TD align=right><b class="CSSteam'.$tm_v[$i].'">Всего ['.$team_data['hp'].'/'.$team_data['hpAll'].']</b></TD><TD>&nbsp;</TD><TD>&nbsp;</TD><TD align=center>'.(0+$team_data['ga']).'(<font color=red>'.(0+$team_data['gak']).'</font>)/'.($team_data['gaa']).'</TD><TD align=center>'.$team_data['val_b'].'/'.$team_data['val_y'].'/'.$team_data['val_p'].'</TD><TD align=center>'.$team_data['yrn'].'/<font color=red>'.$team_data['yrn_krit'].'</font></TD><TD align=center>'.(-$team_data['_yrn']).'</TD><TD align=center>'.$team_data['heal'].'</TD></TR>';
			}

			$i++;
		}

		$r .= '</TABLE>'.$help;
		$r = '<div>'.$b.'</div><div><span style="float:left;">'.$tbtl.$p.'</span><span style="float:right;">Локация просмотра боя: <b>'.$u->room['name'].'</b></span></div><br><br>'.$r.'<div align="left">'.$p.'</div>';

	} else {
				//pr('cache');
				$r = '<!--cache--><div>'.$b.'</div>'.file_get_contents($btl_stat_file);
				$r = str_replace('<-help->', $help, $r);
                $r = str_replace('<-help2->', $help2, $r);
                $r = str_replace('<-help3->', $help3, $r);
		   }
	//
}
elseif(!isset($btl['id']) && file_exists($btl_file))
{
	//pr('cache');
	$r = '<!--cache--><div>'.$b.'</div>'.file_get_contents($btl_file);
}
elseif(!isset($btl['id']))
{
	$r = '<br><br><center>Скорее всего Архивариус снова потерял пергамент с хрониками боев ...</center>';
} else {
	include('jx/battle/log_text.php');
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
				if($r[0]!='') $d[$r[0]] = $r[1];

				if($r[0]=='login1' && $r[1]=='') $no1 = 1;
                if($r[0]=='login2' && $r[1]=='') $no2 = 1;

				$i++;
			}
			if($no1 && $no2) return;//Не показывать размены без пользователей

			//обычный удар
			$rt = $pl['text'];
			//заменяем данные
			$rt = str_replace('{u1}','<span onClick="top.addTo(\''.$d['login1'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login1'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t1'].'">'.$d['login1'].'</span>',$rt);
			$rt = str_replace('{u2}','<span onClick="top.addTo(\''.$d['login2'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login2'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t2'].'">'.$d['login2'].'</span>',$rt);
			$rt = str_replace('{pr}','<b>'.$d['prm'].'</b>',$rt);
			$rt = str_replace('^^^^','=',$rt);
            //if(!$d['time1']) $d['time1']='';
            if(!$d['time2']) $d['time2']=$d['time1'];
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
					if($b12>=5 || $b12<0)
					{
						$b12 = 0;
					}
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
					if($b12>=5 || $b12<0)
					{
						$b12 = 0;
					}
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
					if(isset($log_text[$d['s1']][$j][$k]))
					{
						$rt = str_replace('{1x'.$j.'x'.$k.'}',$log_text[$d['s1']][$j][$k],$rt);
					}
					$k++;
				}
				//замена R - игрок 2
				$r = $log_text[$d['s2']][$j];
				$k = 0;
				while($k<=count($r))
				{
					if(isset($log_text[$d['s2']][$j][$k]))
					{
						$rt = str_replace('{2x'.$j.'x'.$k.'}',$log_text[$d['s2']][$j][$k],$rt);
					}
					$k++;
				}						
				$j++;
			}
			
			//заменяем данные повторно
			$rt = str_replace('{u1}','<span onClick="top.addTo(\''.$d['login1'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login1'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t1'].'">'.$d['login1'].'</span>',$rt);
			$rt = str_replace('{u2}','<span onClick="top.addTo(\''.$d['login2'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login2'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t2'].'">'.$d['login2'].'</span>',$rt);
			$rt = str_replace('{pr}','<b>'.$d['prm'].'</b>',$rt);
			$rt = str_replace('^^^^','=',$rt);
            //if(!$d['time1']) $d['time1']='';
            //if(!$d['time2']) $d['time2']='';
			$rt = str_replace('{tm1}','<span class="date">'.date('H:i',$d['time1']).'</span>',$rt);
			$rt = str_replace('{tm2}','<span class="date">'.date('H:i',$d['time2']).'</span>',$rt);
			$rt = str_replace('{tm3}','<span class="date">'.date('d.m.Y H:i',$d['time1']).'</span>',$rt);
			$rt = str_replace('{tm4}','<span class="date">'.date('d.m.Y H:i',$d['time2']).'</span>',$rt);
			
			//закончили заменять
			$pl['text'] = $rt;
		}
		return $pl['text'];
	}
	//Получаем логи
	$min = round(30*((int)$_GET['p']-1));
	if($min<1){$min = 0;}
	$max = $min+29;
	
	$based = 'battle_logs';
	
	//генерируем страницы
	$pmax = mysql_fetch_array(mysql_query('SELECT `id_hod`,`id` FROM `'.$based.'` WHERE `battle` = "'.$btl['id'].'" ORDER BY  `id_hod` DESC  LIMIT 1'));
	$pmax = $pmax['id_hod'];
	
	$pmax = ceil($pmax/30);
	
	if($min > round(30*($pmax-1)))
	{
		$min = round(30*($pmax-1));
		$max = $min+29;
	}
	$i = 1;
	while($i<=$pmax)
	{
		if((int)$_GET['p']==$i || ((int)$_GET['p']>$pmax && $i==$pmax) || ((int)$_GET['p']<1 && $i==1))
		{
			$p .= ' <a style="color:maroon" href="?log='.$btl['id'].'&p='.$i.'&rnd='.$code.'">'.$i.'</a> ';
		}else{
			$p .= ' <a href="?log='.$btl['id'].'&p='.$i.'&rnd='.$code.'">'.$i.'</a> ';	
		}
		$i++;
	}
	$h = 0; $clr = 'e2e0e0'; $cclr = ''; $i = 1;
	$sp = mysql_query('SELECT * FROM `'.$based.'` WHERE `battle` = "'.$btl['id'].'" AND `id_hod` > '.$min.' AND `id_hod` <= '.($max+1).' ORDER BY `id_hod`, `id` ASC');// LIMIT 200
	while($pl = mysql_fetch_array($sp))
	{
		$pl['text'] = testlog($pl);
        if($pl['text'] != '')
		{
			$pl['text'] = str_replace('\"','"',$pl['text']);
			if($u->info['admin'] > 0) $pl['text'] = '<span class="date" title="'.$pl['id'].'">#'.$i.': </span> '.$pl['text'];

			if($h!=$pl['id_hod'])
			{
				if($h>0)
				{
					if($clr == 'e2e0e0') {
						$clr = 'e3e1e1';
					}else{
						$clr = 'e2e0e0';
					}
					$cclr = '';
				}
				$h = $pl['id_hod'];
			}

			$r .= '<div class="logs_php_line" style="background-color:#'.$clr.';'.$cclr.'padding:1px;">'.$pl['text'].'</div>';
			$cclr = '';
			$i++;
		}
	}
	//собираем страницу
	$p = 'Страницы:'.$p;
	//$p = '<br><input onClick="location=location;" type="submit" name="analiz2" value="Обновить">';
	$usr = '';
	if($btl['team_win'] == -1)
	{
		$sp = mysql_query('SELECT 
			`u`.`id`,`u`.`login`,`u`.`level`,`u`.`sex`,`u`.`align`,`u`.`online`,`u`.`battle`,`u`.`clan`,
			`s`.`hpNow`,`s`.`bot`,`s`.`team`,`u`.`city`
		 FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE `u`.`battle` = "'.$btl['id'].'" AND `s`.`hpNow` >= 1');
		 
		 $usrs = array(-1 => array());
		 
		while($pl = mysql_fetch_array($sp)) {
			if(!isset($usrs[$pl['team']])) {
				$usrs[$pl['team']] = '';
				$usrs[-1][count($usrs[-1])] = $pl['team'];
			}
			if($pl['align'] > 0) {
				$usrs[$pl['team']] .= '<img src="//img.testcombats.ru/i/align/align'.$pl['align'].'.gif" width="12" height="15">';
			}
			if($pl['clan'] > 0) {
				$usrs[$pl['team']] .= '<img src="//img.testcombats.ru/i/clan/'.$pl['clan'].'.gif" width="24" height="15">';
			}
			$pl['stats_r'] = $u->getStats($pl['id'], $i1);
			$usrs[$pl['team']] .= '<b class="CSSteam'.$pl['team'].'">'.$pl['login'].'['.$pl['level'].']<a href="info/'.$pl['id'].'" target="_blank"><img src="//img.testcombats.ru/i/inf_'.$pl['cityreg'].'.gif" width="12" height="11"></a></b> ['.ceil($pl['stats_r']['hpNow']).'/'.$pl['stats_r']['hpAll'].'],';		
		}
		
		if(count($usrs[-1]) > 0) {
			$i = 0;
			while($i < count($usrs[-1])) {
				$usr .= rtrim($usrs[$usrs[-1][$i]],',');
				if(count($usrs[-1]) > $i+1) {
					$usr .= '&nbsp; <b><font color=black>против</font></b> &nbsp; ';
				}
				$i++;
			}
		}
		
		if($usr != '') {
			$usr = '<div align="center">'.$usr.($u->info['admin'] > 0 ? ' [всего: '.mysql_num_rows($sp).']' : '').'</div><HR class="line">';
		}
	}

	$tbtl = '<img src="//img.testcombats.ru/i/fighttype'.$btl['type'].'.gif" />';
	if( $btl['invis'] > 0 ) {$tbtl .= '<img src="//img.testcombats.ru/i/fighttypehidden0.gif" />';}
	$tbtl = 'Тип боя: '.$tbtl.' ('.($btl['type'] == 1 ? '<b>кулачный</b>' : '<b>физический</b>').' <b>бой</b>) &nbsp; &nbsp; ';
	if( $btl['izlom'] > 0 ) {$tbtl .= 'Волна: '.$btl['izlomRoundSee'].' &nbsp; &nbsp; ';}
	
	$r = '<div style="font-size: 9px;">'.$b.'</div><div><span style="float:left;">'.$tbtl.$p.'</span><span style="float:right;">Основное место боя: <b>'.$u->room['name'].'</b></span></div><br><HR class="line">'.$r.'<div id="not_found" style="display: none;"><b><center>Ничего не найдено. Совсем не найдено...</center></b></div><HR class="line">'.$usr.'<div align="left">'.$p.'</div>';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Наш Бойцовский Клуб: Архив Поединок</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jqueryrotate.js"></script>
<script type="text/javascript" src="js/jquery.zclip.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/title.js"></script>
<script src="//img.testcombats.ru/js/Lite/gameEngine.js" type="text/javascript"></script>
<script>
hi_no_fm = 1;
function maginfo(z,p,m,obj)
{
	var r = '';
	r += '<b>'+$(obj).attr('magelogin')+'</b><br><br>';
	r += 'Мощь: '+m+', ';
	r += 'Защита: '+z+', ';
	r += 'Подавление: '+p+'';
	return r;	
}
</script>
<link href="//testcombats.ru/css/main.css" rel="stylesheet" type="text/css">
<style type="text/css">
h3 {
	text-align: center;
}
.ttl_css
{
	position: absolute;
	padding-left: 3px;
	padding-right: 3px;
	padding-top: 2px;
	padding-bottom: 2px;
	background-color: #ffffcc;
	border: 1px solid #6F6B5E;
}
.CSSteam	{ font-weight: bold; cursor:pointer; }
.CSSteam0	{ font-weight: bold; cursor:pointer; }
.CSSteam1	{ font-weight: bold; color: #6666CC; cursor:pointer; }
.CSSteam2	{ font-weight: bold; color: #B06A00; cursor:pointer; }
.CSSteam3 	{ font-weight: bold; color: #269088; cursor:pointer; }
.CSSteam4 	{ font-weight: bold; color: #A0AF20; cursor:pointer; }
.CSSteam5 	{ font-weight: bold; color: #0F79D3; cursor:pointer; }
.CSSteam6 	{ font-weight: bold; color: #D85E23; cursor:pointer; }
.CSSteam7 	{ font-weight: bold; color: #5C832F; cursor:pointer; }
.CSSteam8 	{ font-weight: bold; color: #842B61; cursor:pointer; }
.CSSteam9 	{ font-weight: bold; color: navy; cursor:pointer; }
.CSSvs 		{ font-weight: bold; }
</style>
<style>
.line {
    border-bottom-style: inset;
    border-bottom-width: 1px;
    border-collapse: separate;
    border-left-style: inset;
    border-left-width: 1px;
    border-right-style: inset;
    border-right-width: 1px;
    border-top-style: inset;
    border-top-width: 1px;
    color: rgb(0, 0, 0);
    display: block;
    font-family: Verdana, Arial, Helvetica, Tahoma, sans-serif;
    font-size: 13px;
    font-style: normal;
    font-variant: normal;
    font-weight: normal;
    height: 1px;
    line-height: normal;
    text-align: start;
    white-space: normal;
    display: block;
-webkit-margin-before: 0.5em;
-webkit-margin-after: 0.5em;
-webkit-margin-start: auto;
-webkit-margin-end: auto;
border-style: inset;
border-width: 1px;
}
</style>
</head>

<body bgcolor="#E2E0E0" style="font-size: 10.04pt;">
<div id="ttl" class="ttl_css" style="display:none;z-index:1111;" /></div>
<div id="gi" class="gifin" style="display:none;z-index:1110;"></div>
<H3><IMG SRC="//img.testcombats.ru/i/fighttype2.gif" WIDTH=20 HEIGHT=20>Наш Бойцовский Клуб<? if( $based != 'battle_logs' ) { echo ' (Архив поединков)'; } ?> &nbsp; <a href="//www.testcombats.ru/">www.testcombats.ru</a> <IMG SRC="//img.testcombats.ru/i/fighttype2.gif" WIDTH=20 HEIGHT=20></H3>
<h2 style="color:black;"><center><?echo $BattleType.$ClanWar; ?></center></h1>

<? echo $r; ?>

<script language="JavaScript">
$('#line_filter').submit(function ()
{
  $('#line_filter_input_submit').trigger('click');
});

$('#line_filter_glow').click(function () {
  var val = $('#line_filter_input').val();
  $(".logs_php_line").stop().css('background-color', '').show();
  $('#not_found').css('display', 'none');
  if(val != '') {
    $(".logs_php_line:contains('" + val + "')").css('background-color', '#f8f8ef'); //##f8f8ef ffff80
  }
});

$('#line_filter_input_submit').click(function () {
  $("#not_found").slideUp();
  var val = $('#line_filter_input').val();
  if(val == '') {
     $(".logs_php_line").stop().css('background-color', '').show();
  } else {
   if($.browser.msie || !1) {
     $(".logs_php_line").stop().css('background-color', '').hide();
     if (val != '') $(".logs_php_line:contains('" + val + "')").stop().show();
   } else {
     $(".logs_php_line").stop().css('background-color', '').slideUp();
      $(".logs_php_line:contains('" + val + "')").stop().slideDown();
   }
   setInterval('if ($(".logs_php_line:visible").length == 0) $("#not_found").slideDown();', 300);
 }
 return false;
});

$('#line_filter_input').keyup(function () {
  if($('#line_filter_input').val() == '') {
    $('#line_filter_input_submit').trigger('click');
  }
});

jQuery.expr[":"].contains = function (elem, i, match, array) {
  return (elem.textContent || elem.innerText || jQuery.text(elem) || "").toLowerCase().indexOf(match[3].toLowerCase()) >= 0;
}
</script>
</body>
</html>