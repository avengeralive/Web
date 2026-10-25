<?
if(!defined('GAME')) { die(); }
if($u->room['file']=='ruine') {
		
	$rn = mysql_fetch_array(mysql_query('SELECT * FROM `ruine_now` WHERE `id` = "'.$u->info['inTurnir'].'" LIMIT 1'));
	if(!isset($rn['id']))
	{
		die('Руины. Турнир был закончен, либо не найден...');	
	}
	
	$ru = mysql_fetch_array(mysql_query('SELECT * FROM `ruine_users` WHERE `bot` = "'.$u->info['id'].'" AND `tid` = "'.$rn['id'].'" LIMIT 1'));
	if(!isset($rn['id'])) {
		die('Руины. Вы уже не участвуете в турнире...');
	}
	
	function add_log($txt)
	{
		global $rn;
		if( isset($rn['id']) )
		{ 
			mysql_query('INSERT INTO `ruine_logs` ( `tid` , `time` , `text` ) VALUES (
				"'.$rn['id'].'","'.time().'","'.mysql_real_escape_string($txt).'"
			)');
		}
	}
	
	if( isset($_GET['ruine_exit']) )
	{
		//Записываем в лог что игрок покинул турнир
		if( $u->info['real'] == 0 )
		{
			$txt = $u->microLogin($u->info['__id'],1);
			if( $u->info['sex'] == 0 ) {
				$txt .= ' покинул турнир и ничего не получил!';
			}else{
				$txt .= ' покинула турнир и ничего не получила!';
			}
			add_log($txt);
			//
			mysql_query('DELETE FROM `ruine_users` WHERE `bot` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `users` WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `stats` WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$u->info['id'].'"');
			mysql_query('DELETE FROM `users_delo` WHERE `id` = "'.$u->info['id'].'"');
			mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$u->info['id'].'"');
			mysql_query('DELETE FROM `actions` WHERE `id` = "'.$u->info['id'].'"');
			//
			mysql_query('UPDATE `users` SET `room` = "412", `inUser` = "0" WHERE `id` = "'.$u->info['__id'].'" LIMIT 1');

			//вешаем эффект 858 при побеге
            mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$u->info['__id'].'" AND `id_eff`="858"');
            mysql_query('INSERT INTO `eff_users` (`no_Ace`,`id_eff`,`overType`,`uid`,`name`,`data`,`timeUse`)
			VALUES ("1","858","21","'.$u->info['__id'].'","Сбежал с поля боя","nofastfinisheff=1","'.(time()+3600*6).'")');

			$msg = 'На вас наложен эффект &quot;Сбежал с поля боя&quot; сроком на 6 часов.';
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`)
			VALUES (1,'".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$msg."','".time()."','6','0','1')");


			header('location: main.php');
		}else{
			die('Реальный пользователь в турнире! Обратитесь к Администрации, СРОЧНО!');
		}
	}
	elseif( isset($_GET['attack']) && $_GET['attack']!='' && $_GET['attack']!=$u->info['login'])
	{
		$ra = mysql_fetch_array(mysql_query('SELECT `id`,`sex`,`battle`,`real`,`login`,`align`,`clan` FROM `users` WHERE `login` = "'.mysql_real_escape_string($_GET['attack']).'" AND `room` = "'.$u->info['room'].'" AND `real` = 0 LIMIT 1'));
		if(!isset($ra['id']))
		{
			$u->error = 'Участник турнира с логином &quot;'.htmlspecialchars($_GET['attack']).'&quot; не найден.';
		}else{
			$ra_st = mysql_fetch_array(mysql_query('SELECT `id`,`x`,`y`,`team`,`hpNow` FROM `stats` WHERE `id` = "'.$ra['id'].'" LIMIT 1'));
			if( $ra_st['x'] != $u->info['x'] || $ra_st['y'] != $ra_st['y'] )
			{
				$u->error = 'Вы находитесь в разных комнатах.';
			}else{
				$ra_ru = mysql_fetch_array(mysql_query('SELECT `team` FROM `ruine_users` WHERE `bot` = "'.$ra['id'].'" AND `tid` = "'.$rn['id'].'" LIMIT 1'));
				if( $ra_ru['team'] == $ru['team'] )
				{
					$u->error = 'Нельзя нападать на союзников!'.$ra_ru['team'].' : '.$ru['team'];
				}else{
					//
					$tbtl = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$ra['battle'].'" AND `team_win` = "-1" LIMIT 1'));
					if( !isset($tbtl['id']) && $ra['battle'] > 0 )
					{
						$ra['battle'] = 0;
						$ra_st['team'] = 0;

						mysql_query('UPDATE `users` SET `battle` = 0 WHERE `id` = "'.$ra['id'].'" LIMIT 1');

						if( $ra_st['hpNow'] < 1 )
						{
							mysql_query('UPDATE `stats` SET `hpNow` = 1 WHERE `id` = "'.$ra['id'].'" LIMIT 1');
						}
					}
					//
					$ua1 = $u->microLogin($u->info['__id'],1);
					$ua2 = $u->microLogin($ra['id'],1);//$ra_ru['uid']
					//
					$btl_id = $magic->atackUser($u->info['id'],$ra['id'],$ra_st['team'],$ra['battle']);
					error_log($ra_st['battle']);
                    //if( $btl_id > 0 ) {
					//mysql_query('UPDATE `battle` SET `inTurnir` = "'.$bs['id'].'",`timeout` = "30" WHERE `id` = "'.$btl_id.'" LIMIT 1');
					//}
					//$me_real = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`align`,`clan`,`battle`,`level` FROM `users` WHERE `inUser` = "'.$u->info['id'].'" AND `login` = "'.$u->info['login'].'" LIMIT 1'));
                    if( $ra['battle'] > 0 )
					{
						$ra['battle'] = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle` WHERE `id` = "'.$ra['battle'].'" AND `team_win` = "-1" LIMIT 1'));
						if( isset($ra['battle']['id']) )
						{
							$ura['battle'] = $ra['battle']['id'];
						}else{
								$ra['battle'] = 0;
						}
					}
					//
					if( $ra['battle'] > 0 )
					{
						if( $u->info['sex'] == 0 )
						{
							$txt = $ua1 . ' вмешался в <a target="_blank" title="Бой #'.$ra['battle'].'" href="/logs.php?log='.$btl_id.'">бой</a> против ' . $ua2 . '.';
						}else{
							$txt = $ua1 . ' вмешалася в <a target="_blank" title="Бой #'.$ra['battle'].'" href="/logs.php?log='.$btl_id.'">бой</a> против ' . $ua2 . '.';
						}
					}else{
						if( $u->info['sex'] == 0 ) {
							$txt = $ua1 . ' напал на ' . $ua2 . ' и завязался <a target="_blank" href="/logs.php?log='.$btl_id.'">бой</a>.';
						}else{
							$txt = $ua1 . ' напала на ' . $ua2 . ' и завязался <a target="_blank" href="/logs.php?log='.$btl_id.'">бой</a>.';
						}
					}
					add_log($txt);
					//
					if( $btl_id > 0 )
					{
						mysql_query('UPDATE `battle` SET `inTurnir` = "'.$rn['id'].'",`timeout` = "'.(rand(1,3)*60).'" WHERE `id` = "'.$btl_id.'" LIMIT 1');
					}
					//
					header('location: main.php');
					//
				}
			}
		}
	}
	
?>
<script>
function ruin_exit()
{
	if(confirm('Выйти и ничего не получить?')){ top.frames['main'].location = '/main.php?ruine_exit=1'; }
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
      <div style="padding-left:0px;" align="center">
        <h3>Руины Старого Замка</h3>
      </div>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
    	<?
		
		if($u->error != '') {echo '<div><font color="red"><b>'.$u->error.'</b></font></div><br>';}
		
		$tmn = array(
			1 => array('Красные','red'),
			2 => array('Синие','blue')
		);
		$tm1 = $ru['team'];
		$tm2 = ($tm1 == 1 ? 2 : 1);
		
		echo 'Счет: <b><font color="'.$tmn[1][1].'">'.$rn['t1w'].'</font></b> - <b><font color="'.$tmn[2][1].'">'.$rn['t2w'].'</font></b><br><br>';
		echo '<div style="padding-bottom:5px;"><b>Ваша команда: <font color="'.$tmn[$tm1][1].'">'.$tmn[$tm1][0].'</font></b></div>';

		$i = 0;
		$ph = 100;

		$sp = mysql_query('SELECT * FROM `ruine_users` WHERE `tid` = "'.$rn['id'].'" AND `team` = "'.$tm1.'"');
		while( $pl = mysql_fetch_array($sp) )
		{
            $user = mysql_fetch_array(mysql_query('SELECT `login`,`clan`,`align`,`level` FROM `users` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));

			$plst = $u->getStats($pl['bot'],0);
			$hppx = -10;
   			if( $plst['mpAll'] < 1 ) {$hppx = -4;}

			//Комната
			$room = mysql_fetch_array(mysql_query('SELECT `name` FROM `dungeon_map_info` WHERE `x` = "'.$plst['x'].'" AND `y`="'.$plst['y'].'" LIMIT 1'));
            $room = (isset($room['name']) ? $room['name'] : '');

			$hpmp = '
			<div style="padding-left:10px;position:relative;"><div id="vhp'.($plst['id']+1000000000000).'" title="Уровень жизни" align="left" class="seehp" style="position:absolute; top:'.$hppx.'px; width:120px; height:10px; z-index:12;"> '.floor($plst['hpNow']).'/'.$plst['hpAll'].'</div>
			<div title="Уровень жизни" class="hpborder" style="position:absolute; top:'.$hppx.'px; width:120px; height:9px; z-index:13;"><img src="https://img.testcombats.ru/1x1.gif" height="9" width="1"></div>
			<div class="hp_3 senohp" style="height:9px; width:'.floor(120/100*$ph).'px; position:absolute; top:'.$hppx.'px; z-index:11;" id="lhp'.($plst['id']+1000000000000).'"><img src="https://img.testcombats.ru/1x1.gif" height="9" width="1"></div>
			<div title="Уровень жизни" class="hp_none" style="position:absolute; top:'.$hppx.'px; width:120px; height:10px; z-index:10;"><img src="https://img.testcombats.ru/1x1.gif" height="10"></div>
			';

			if( $plst['mpAll'] >= 1 )
			{
				$hpmp .= '
				<div id="vmp'.($plst['id']+1000000000000).'" title="Уровень маны" align="left" class="seemp" style="position:absolute; top:0px; width:120px; height:10px; z-index:12;"> '.floor($plst['mpNow']).'/'.$plst['mpAll'].'</div>
				<div title="Уровень маны" class="hpborder" style="position:absolute; top:0px; width:120px; height:9px; z-index:13;"><img src="https://img.testcombats.ru/1x1.gif" height="9" width="1"></div>
				<div class="hp_mp senohp" style="height:9px; position:absolute; top:0px; width:'.floor(120/100*$ph).'px; z-index:11;" id="lmp'.($plst['id']+1000000000000).'"><img src="https://img.testcombats.ru/1x1.gif" height="9" width="1"></div>
				<div title="Уровень маны" class="hp_none" style="position:absolute; top:0px; width:120px; height:10px; z-index:10;"></div>
				';
			}

			echo '<table border="0" cellspacing="0" cellpadding="0" height="25">
			<tr><td valign="middle">';
            if( $user['clan'] > 0 ) {echo '<img width=24 height=15 src=https://img.testcombats.ru/i/clan/'.$user['clan'].'.gif>';}
			echo $u->microLogin($pl['bot'],1).'</td><td width="'.($ph+40).'">'.$hpmp.'</td>';
			if($room) echo '<td><small>('.$room.')</small></td>';
			if($u->info['admin']>0) echo '<td><small>(x: '.$plst['x'].', y: '.$plst['y'].')</small></td>';
			echo '</tr></table>';

			$i++;
		}
		unset($plst,$sp,$pl);
		
		if( $i == 0 )
		{
			echo '<br><i>'.$tmn[$tm1][0].' покинули турнир.</i>';
		}
		
		echo '<br><br><div style="padding-bottom:5px;"><b>Команда противника: <font color="'.$tmn[$tm2][1].'">'.$tmn[$tm2][0].'</font></b></div>';

		$i = 0;

		$sp = mysql_query('SELECT * FROM `ruine_users` WHERE `tid` = "'.$rn['id'].'" AND `team` = "'.$tm2.'"');
		while( $pl = mysql_fetch_array($sp) )
		{
            $user = mysql_fetch_array(mysql_query('SELECT `login`,`clan`,`align`,`level` FROM `users` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));
			$plst = $u->getStats($pl['bot'],0);
			$hppx = -10;
			if( $plst['mpAll'] < 1 ) {$hppx = -4;}

			$hpmp = '
			<div style="padding-left:10px;position:relative;"><div id="vhp'.($plst['id']+1000000000000).'" title="Уровень жизни" align="left" class="seehp" style="position:absolute; top:'.$hppx.'px; width:120px; height:10px; z-index:12;"> '.floor($plst['hpNow']).'/'.$plst['hpAll'].'</div>
			<div title="Уровень жизни" class="hpborder" style="position:absolute; top:'.$hppx.'px; width:120px; height:9px; z-index:13;"><img src="https://img.testcombats.ru/1x1.gif" height="9" width="1"></div>
			<div class="hp_3 senohp" style="height:9px; width:'.floor(120/100*$ph).'px; position:absolute; top:'.$hppx.'px; z-index:11;" id="lhp'.($plst['id']+1000000000000).'"><img src="https://img.testcombats.ru/1x1.gif" height="9" width="1"></div>
			<div title="Уровень жизни" class="hp_none" style="position:absolute; top:'.$hppx.'px; width:120px; height:10px; z-index:10;"><img src="https://img.testcombats.ru/1x1.gif" height="10"></div>
			';

			if( $plst['mpAll'] >= 1 )
			{
				$hpmp .= '
				<div id="vmp'.($plst['id']+1000000000000).'" title="Уровень маны" align="left" class="seemp" style="position:absolute; top:0px; width:120px; height:10px; z-index:12;"> '.floor($plst['mpNow']).'/'.$plst['mpAll'].'</div>
				<div title="Уровень маны" class="hpborder" style="position:absolute; top:0px; width:120px; height:9px; z-index:13;"><img src="https://img.testcombats.ru/1x1.gif" height="9" width="1"></div>
				<div class="hp_mp senohp" style="height:9px; position:absolute; top:0px; width:'.floor(120/100*$ph).'px; z-index:11;" id="lmp'.($plst['id']+1000000000000).'"><img src="https://img.testcombats.ru/1x1.gif" height="9" width="1"></div>
				<div title="Уровень маны" class="hp_none" style="position:absolute; top:0px; width:120px; height:10px; z-index:10;"></div>
				';
			}

			echo '<table border="0" cellspacing="0" cellpadding="0" height="25">
			<tr><td valign="middle">';
            if( $user['clan'] > 0 ) {echo '<img width=24 height=15 src=https://img.testcombats.ru/i/clan/'.$user['clan'].'.gif>';}
			echo $u->microLogin($pl['bot'],1).'</td><td width="'.($ph+40).'">'.$hpmp.'</td>';
			if($u->info['admin']>0) echo '<td><small>(x: '.$plst['x'].', y: '.$plst['y'].')</small></td>';
			echo '</tr></table>';

			$i++;
		}

		if( $i == 0 )
		{
			echo '<br><i>'.$tmn[$tm2][0].' покинули турнир.</i>';
		}
		?>
    </td>
    <td align="right" valign="top">
    	<input type="button" value="Обновить" class="btnnew" onclick="location.href='/main.php';">
    	<input onClick="top.atackTower();" class="btnnew3" style="padding-left:24px; background-image:url('https://img.testcombats.ru/i/fighttype50.gif'); background-position:2px -2px; background-repeat:no-repeat;" type="button" value="Напасть">
    	<a href="/ruinelog.php?id=<?=$rn['id']?>" target="_blank" style="font-size:11px;" class="btnnew">Логи турнира</a>
        <input onclick="ruin_exit()" type="button" value="Выйти и ничего не получить!" class="btnnew2">
    </td>
  </tr>
</table>
<? } ?>
