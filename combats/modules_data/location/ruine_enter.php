<?
if(!defined('GAME')) { die(); }
if($u->room['file']=='ruine_enter')
{
	$loc_c = array('free' => 125);

	//Удаление пользователей оффлайн более 10 минут
	$sp = mysql_query('SELECT * FROM `ruine_zv`');
	while( $pl = mysql_fetch_array($sp) )
	{
		$usr = mysql_fetch_array(mysql_query('SELECT `online` FROM `users` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));
		if( $usr['online'] < time()-600 )
		{
			mysql_query('DELETE FROM `ruine_zv` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
            //if($pl['zv_main']==0 && $pl['type']==2) mysql_query('DELETE FROM `ruine_zv` WHERE `zv_main` = "'.$pl['id'].'"');
            if($pl['zv_main']==0) mysql_query('UPDATE `ruine_zv` SET `zv_main` = "0" WHERE `zv_main` ="'.$pl['id'].'" LIMIT 1');
		}
	}

    $rzc1 = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS count FROM `ruine_zv` WHERE `type` = 1 LIMIT 1'));
 	$rz1  = mysql_fetch_array(mysql_query('SELECT * FROM `ruine_zv` WHERE `type` = 1 AND `zv_main` = "0" LIMIT 1'));
    $rz3  = mysql_fetch_array(mysql_query('SELECT * FROM `ruine_zv` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));

	if(isset($rz3['id']) && !isset($_GET['loc']))
	{
		$u->error = 'Заявка на '.($rz3['type']==1 ? 'хаотический' : 'групповой').' поединок подана. Ожидаем набора группы.';
		if ($rz3['type'] == 2) $u->error .= ' Ваша команда: '.($rz3['team']==1 ? '<font style="color: blue !important;">синие</font>' : 'красные');
	}
	elseif(isset($_GET['loc'])) $u->error = 'Вы подали заявку на турнир и не можете перемещаться...';

	$kolvo1 = $rz1['sostav'] * 2;

	if($_POST['b_type'] > 2)
	{
    	$zv_main = $_POST['b_type'];
		$_POST['b_type'] = 2;
	} else $zv_main = 0;

	if($zv_main > 0)
	{
 		$rzn = mysql_fetch_array(mysql_query('SELECT * FROM `ruine_zv` WHERE `id` = "'.$zv_main.'" LIMIT 1'));
        $rzcn = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS count FROM `ruine_zv` WHERE `id`="'.$rzn['id'].'" OR `zv_main`="'.$rzn['id'].'" LIMIT 1'));
        $rzt1 = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS count FROM `ruine_zv` WHERE `team`="1" AND (`id`="'.$rzn['id'].'" OR `zv_main`="'.$rzn['id'].'") LIMIT 1'));
        $rzt2['count'] = $rzcn['count'] - $rzt1['count'];

		$kolvon = $rzn['sostav']*2;
        $_POST['b_sostav'] = $rzn['sostav'];
	} else $kolvon = 0;

	if(isset($_GET['join']))
	{
        $rst = mysql_fetch_array(mysql_query('SELECT `id` FROM `ruine_sets` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
        $z = mysql_fetch_array(mysql_query('SELECT `id` FROM `zayvki` WHERE `id`="'.intval($u->info['zv']).'" AND `start` = "0" LIMIT 1'));
        if($u->info['inTurnir']>0) $bs_is = mysql_fetch_array(mysql_query('SELECT `id` FROM `bs_turnirs` WHERE `id` = "'.$u->info['inTurnir'].'" LIMIT 1'));

		if(!isset($rst['id']))
		{
			$u->error = 'Чтобы подать заявку, нужно создать профиль характеристик.';
		}
        elseif($u->info['level']<8)
		{
			$u->error = 'Подать заявку могут игроки от 8-го уровня.';
		}
        elseif($_POST['b_type']==2 && $zv_main==0 && strlen(trim($_POST['b_pass'])) < 3)
		{
			$u->error = 'Для группового поединка нужно задать пароль от 3-х знаков.';
		}
        elseif($_POST['b_type']==2 && isset($rzn['id']) && trim($_POST['b_pass']) != $rzn['password'])
		{
			$u->error = 'Неверный пароль для группового поединка.';
		}
        elseif(isset($z['id']))
		{
			$u->error = 'Вы уже подали заявку на участие в поединке.';
		}
		elseif(isset($rz3['id']) || $u->info['inTurnir']>0 || $u->info['inTurnirnew']>0 || isset($bs_is['id']))
		{
			$u->error = 'Вы уже принимаете участие в турнире.';
		}
		elseif( $kolvon > 0 && $kolvon <= $rzcn['count'] )
		{
			$u->error = 'Вы опоздали, эта группа уже начала турнир...';
		}
        elseif( $kolvon > 0 && $rzt1['count'] >= $rzn['sostav'] && $_POST['b_team']==1 )
		{
			$u->error = 'Команда синих уже набрана, выберите красную команду...';
		}
        elseif( $kolvon > 0 && $rzt2['count'] >= $rzn['sostav'] && $_POST['b_team']==2 )
		{
			$u->error = 'Команда красных уже набрана, выберите синюю команду...';
		}
		else {
				if($_POST['b_type']==1)
				{
                    $rz1 = mysql_fetch_array(mysql_query('SELECT `id`,`sostav` FROM `ruine_zv` WHERE `type` = 1 AND `zv_main` = "0" LIMIT 1'));
					$zv_main = (isset($rz1['id']) ? $rz1['id'] : 0);

                    $tm1  = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS count FROM `ruine_zv` WHERE `type` = 1 AND `team`= 1 LIMIT 1'));
                    $tm1  = (isset($tm1['count']) ? $tm1['count'] : 0);
                    $tm2  = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS count FROM `ruine_zv` WHERE `type` = 1 AND `team`= 2 LIMIT 1'));
                    $tm2  = (isset($tm2['count']) ? $tm2['count'] : 0);
                    $team = (($tm2 > $tm1 && $tm1 < $rz1['sostav']) ? 1 : 2);

				} else $team = ($zv_main==0 ? rand(1,2) : $_POST['b_team']);

				mysql_query('INSERT INTO `ruine_zv` (`city`, `time`, `uid`, `sostav`, `team`, `type`, `password`, `zv_main`)
				VALUES ("'.$u->info['city'].'","'.time().'","'.$u->info['id'].'","'.mysql_real_escape_string($_POST['b_sostav']).'",
                "'.mysql_real_escape_string($team).'", "'.mysql_real_escape_string($_POST['b_type']).'","'.mysql_real_escape_string($_POST['b_pass']).'",
				"'.$zv_main.'")');
				
				$u->error = 'Заявка на '.($_POST['b_type']==1 ? 'хаотический' : 'групповой').' поединок подана. Ожидаем набора группы.';
				if ($_POST['b_type'] == 2) $u->error .= ' Ваша команда: '.($team==1 ? '<font style="color: blue !important;">синие</font>' : 'красные');
		}
	}
	elseif(isset($_GET['cancel']))
	{
		if( $kolvon > 0 && $kolvon <= $rzcn['count'] )
		{
			$u->error = 'Турнир уже начался...';
		}
		elseif(isset($rz3['id']))
		{
			mysql_query('DELETE FROM `ruine_zv` WHERE `id` = "'.$rz3['id'].'" LIMIT 1');
			//if($rz3['zv_main']==0 && $rz3['type']==2) mysql_query('DELETE FROM `ruine_zv` WHERE `zv_main` = "'.$rz3['id'].'"');
            if($rz3['zv_main']==0) mysql_query('UPDATE `ruine_zv` SET `zv_main` = "0" WHERE `zv_main` ="'.$rz3['id'].'" LIMIT 1');
            $u->error = 'Заявка на '.($rz3['type']==1 ? 'хаотический' : 'групповой').' поединок удалена.';
		}
		else $u->error = 'Заявка на поединок уже удалена.';
	}

	$rz1  = mysql_fetch_array(mysql_query('SELECT * FROM `ruine_zv` WHERE `type` = 1 AND `zv_main` = "0" LIMIT 1'));
    $rzc1 = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS count FROM `ruine_zv` WHERE `type` = 1 LIMIT 1'));
    $rzc2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS count FROM `ruine_zv` WHERE `type` = 2 LIMIT 1'));
    $rz3  = mysql_fetch_array(mysql_query('SELECT * FROM `ruine_zv` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
	$kolvo1 = $rz1['sostav']*2;
	
	//Проверям все заявки
	$sp = mysql_query('SELECT `id`,`sostav` FROM `ruine_zv` WHERE `zv_main`="0" ORDER BY `time`');
	while( $pl = mysql_fetch_array($sp) )
	{
        $kolvo = $pl['sostav']*2;
        $rzc = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS count FROM `ruine_zv` WHERE `id`="'.$pl['id'].'" OR `zv_main`="'.$pl['id'].'" LIMIT 1'));
		//pr($kolvo.' : '.$rzc['count']);

		//Закидываем в руины
		if( $rzc['count'] >= $kolvo )
		{
			mysql_query('INSERT INTO `ruine_now` (`time_start`,`time_finish`,`t1w`,`t2w`,`tw`) VALUES ("'.time().'","0","0","0","0")');
			$rid = mysql_insert_id();

			if( $rid > 0 )
			{
                $text_user = array();
            	$used_x    = array();
            	$used_y    = array();
                //pr('ruine:'.$rid);

				$sp2 = mysql_query('SELECT * FROM `ruine_zv` WHERE `id`="'.$pl['id'].'" OR `zv_main`="'.$pl['id'].'"');
				while( $pl2 = mysql_fetch_array($sp2) )
				{
					$bus = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$pl2['uid'].'" LIMIT 1'));
					if(isset($bus['id']))
					{
						//Создаем бота
						$text_user[$pl2['team']] .= $u->microLogin($bus['id'],1).', ';//$pl2['uid']

						mysql_query('INSERT INTO `users` (`obraz`,`chatColor`,`align`,`inTurnir`,`molch1`,`molch2`,`activ`,`login`,`room`,`name`,`sex`,`level`,`bithday`) VALUES (
						"'.$bus['obraz'].'","'.$bus['chatColor'].'","'.$bus['align'].'","'.$rid.'","'.$bus['molch1'].'","'.$bus['molch2'].'","0","'.$bus['login'].'","413","'.$bus['name'].'","'.$bus['sex'].'","10","'.date('d.m.Y').'")');

						$inbot = mysql_insert_id();//id бота

						if( $inbot > 0 )//Создаем данные в руинах
						{
							//Координаты игрока
							$used_point = 1;
							$i = 0;

							while($used_point==1 || $i < 50)//Координаты без повтора
							{
								//if($pl2['type']==1) {$randx = rand(0,28);}
								//else {
				                        $randx = ($pl2['team']==1 ? rand(16,28) : rand(0,15));
									 //}

								$randy = rand(-19,0);

								if(!in_array($randx, $used_x) || !in_array($randx, $used_x)) $used_point = 0;

								$i++;
							}

                            $rx = $randx;
                            $ry = $randy;
							$used_x[] = $rx;
                            $used_y[] = $ry;
							//pr('rx:'.$rx.' ry:'.$ry);

							$botst = mysql_fetch_array(mysql_query('SELECT * FROM `ruine_sets` WHERE `uid` = "'.$bus['id'].'" AND `use` = 1 LIMIT 1'));
							if(!isset($botst['id']))
							{
								$botst = array('s1' => 25,'s2' => 25,'s3' => 25,'s4' => 25,'s5' => 25,'s6' => 25,'free' => 0);
							}

							mysql_query('INSERT INTO `stats` (`res_x`,`res_y`,`timeGo`,`timeGoL`,`upLevel`,`dnow`,`id`,`stats`,`exp`,`ability`,`skills`,`team`,`x`,`y`)
							VALUES (
								"'.$rx.'","'.$ry.'",
								"'.(time()+180).'","'.(time()+180).'","81","0","'.$inbot.'",
								"s1='.round($botst['s1']).'|s2='.round($botst['s2']).'|s3='.round($botst['s3']).'|s4='.round($botst['s4']).'|s5='.round($botst['s5']).'|s6='.round($botst['s6']).'|rinv=40|m9=5|m6=10","0",
								"'.$botst['free'].'","11", "'.$pl2['team'].'", "'.$rx.'","'.$ry.'"
							)');

							mysql_query('UPDATE `users` SET `room` = "414", `inUser` = "'.$inbot.'" WHERE `id` = "'.$bus['id'].'" LIMIT 1');

							mysql_query('INSERT INTO `ruine_users` (`tid`,`team`,`uid`,`bot`,`die`,`last_die`,`money`)
							VALUES ("'.$rid.'","'.$pl2['team'].'","'.$bus['id'].'","'.$inbot.'","0","0","'.$pl['money'].'")');

							mysql_query('DELETE FROM `ruine_zv` WHERE `id` = "'.$pl2['id'].'" LIMIT 1');
						}
					}
				}

				$text_user[1] = rtrim($text_user[1],', ');
				$text_user[2] = rtrim($text_user[2],', ');

				$text = 'Турнир между '.$text_user[1].' и '.$text_user[2].' начался.';

				mysql_query('INSERT INTO `ruine_logs` (`tid`,`time`,`text`) VALUES ("'.$rid.'","'.time().'","'.mysql_real_escape_string($text).'")');

				//Сохраняем статистику
				//mysql_query('INSERT INTO `ruine_statistic` (`tid`,`count`,`time_start`) VALUES ("'.$rid.'","0","'.time().'")');
			}
            header('location: main.php');
		}
	}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <div style="padding-left:0px;" align="center">
      <h3><? echo $u->room['name']; ?></h3>
    </div>
    </td>
    <td width="200" valign="top"><div align="right">
      <table cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%">&nbsp;</td>
          <td>
          <table  border="0" cellpadding="0" cellspacing="0">
              <tr align="right" valign="top">
                <td><!-- -->
                    <? echo $goLis; ?>
                    <!-- -->
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td nowrap="nowrap"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
                            <tr>
								<td bgcolor="#D3D3D3"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
								<td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='/main.php?loc=1.180.0.469&rnd=<? echo $code; ?>';">Старая площадь</a></td>
                            </tr>
                        </table>
						</td>
                      </tr>
                  </table></td>
              </tr>
          </table>
          </td>
        </tr>
      </table>
      </div></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
		<?
        if($u->error != '') {echo '<div><b><font color=red>'.$u->error.'</font></b></div><br>';}
        $arch = mysql_fetch_array(mysql_query('SELECT `a7` FROM `achiev` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));

    	echo 'Всего вами одержано побед в руинах: <b>'.$arch['a7'].'</b><br><br>';

		//Вывод формы
        $style1 = ((isset($rz3['type']) || ($kolvo1>0 && $rzc1['count'] > $kolvo1)) ? ' disabled="disabled"' : '');
        $style2 = ((isset($rz3['type'])) ? ' disabled="disabled"' : '');

		?>
        <form action="/main.php?join" method="POST">
        <fieldset>
   		<legend>Подача заявки на бой</legend>
		<p id="b_sostav">
		<?php if(!$style1 || !$style2) { ?>
		<b>Состав команд:</b>
		<select name="b_sostav">
        	<?php if($u->info['admin']>0) echo '<option value="1">1x1</option>';?>
			<option value="3">3x3</option>
		</select>
		<?php } ?>
		</p>
		<p><b>Тип поединка:</b></p>
		<p>
	    <?
			if(isset($rz3['type']) && $rz3['zv_main'] == 0) $rz3['type'] == 1 ? $ch1 = ' checked' : $ch2 = ' checked';
            elseif((!$style1 && isset($_POST['b_type']) && $_POST['b_type']==1) || !$style1) $ch1 = ' checked';
            elseif((!$style2 && isset($_POST['b_type']) && $_POST['b_type']==2) || !$style2) $ch2 = ' checked';
            $haots = (isset($rzc1['count']) && $rzc1['count'] > 0 ? 1 : 0);

			echo '<input '.$style1.'onClick="ShowField('.($haots==1 ? 3 : 0).');" type="radio" name="b_type" value="1"'.$ch1.'>Хаотический поединок';
			if( $haots==1 )
			{
                $result2 = mysql_query('SELECT * FROM `ruine_zv` WHERE `type`="1" ORDER BY `team`');
				while( $row2 = mysql_fetch_array($result2) )
				{
                    $user = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$row2['uid'].'" LIMIT 1'));
					$team_color = ($row2['team']==1 ? 'blue' : 'red');
					$wuser .= str_replace('<b>'.$user['login'].'</b>', '<b><font color='.$team_color.'>'.$user['login'].'</font></b>', $u->microLogin($row2['uid'],1)).', ';
				}
                $wuser = rtrim($wuser,', ');
				echo ' (участники: '.$wuser.') (набрано: <b>'.$rzc1['count'].'/'.$kolvo1.'</b> чел.)';
			}
			if( isset($rz3['id']) && $rz3['type']==1 ) echo ' <input onClick="location.href=\'/main.php?cancel\';" type="button" class="btn btn-inverse" value="Покинуть группу" >';
	    	echo '<br><input '.$style2.'onClick="ShowField(1);" type="radio" name="b_type" value="2"'.$ch2.'>Групповой поединок [<b>новый</b>]';

			if( isset($rzc2['count']) && $rzc2['count'] > 0 )
			{
				$result = mysql_query('SELECT * FROM `ruine_zv` WHERE `type`="2" AND `zv_main`="0" ORDER BY `time`');
				while( $row = mysql_fetch_array($result) )
				{
    				$rzc = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS count FROM `ruine_zv` WHERE `id`="'.$row['id'].'" OR `zv_main`="'.$row['id'].'" LIMIT 1'));

    				$kolvo = $row['sostav']*2;
                    $ch = (($rz3['id']==$row['id'] || $rz3['zv_main']==$row['id']) ? ' checked' : '');
                    $wuser = '';

                    $result2 = mysql_query('SELECT * FROM `ruine_zv` WHERE `id`="'.$row['id'].'" OR `zv_main`="'.$row['id'].'" ORDER BY `team`');
					while( $row2 = mysql_fetch_array($result2) )
					{
                        $user = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$row2['uid'].'" LIMIT 1'));
						$team_color = ($row2['team']==1 ? 'blue' : 'red');
						$wuser .= str_replace('<b>'.$user['login'].'</b>', '<b><font color='.$team_color.'>'.$user['login'].'</font></b>', $u->microLogin($row2['uid'],1)).', ';
					}
                    $wuser = rtrim($wuser,', ');

					echo '<br><input '.$style2.'onClick="ShowField(2);" type="radio" name="b_type" value="'.$row['id'].'"'.$ch.'>';
					echo 'Групповой поединок (участники: '.$wuser.')';
                    echo ' (набрано: <b>'.$rzc['count'].'/'.$kolvo.'</b> чел.)';

					if( isset($rz3['id']) && ($rz3['id']==$row['id']) || $rz3['zv_main']==$row['id'] )
					{
						echo ' <input onClick="location.href=\'/main.php?cancel\';" type="button" class="btn btn-inverse" value="Покинуть группу" >';
		                //if($rz3['zv_main']==0) echo ' <font color=red>Внимание!</font> Если вы покинете группу, все участники из нее будут удалены, т.к. вы инициатор заявки.';
					}
				}
				unset($ch);
			}

			unset($ch1, $ch2);

			((isset($_POST['b_team']) && $_POST['b_team']==1) || !isset($_POST['b_team'])) ? $ch1 = ' checked' : $ch2 = ' checked';

			if(isset($rz3['id'])) echo '<script>setTimeout(function () { location.href=\'/main.php\'; }, 10000);</script>';//Если заявка подана
		?>
        </p>
        <p id="b_pass" style="display:none;"><b>Пароль:</b><br><input name="b_pass" size=30 type="text" placeholder="введите пароль"></p>
		<p id="b_team" style="display:none;"><b>Команда:</b><br>
        <input type="radio" name="b_team" value="1"<?=$ch1;?>><font color=blue>Синие</font>&nbsp;&nbsp;
        <input type="radio" name="b_team" value="2"<?=$ch2;?>><font color=red>Красные</font>
		</p>
		<?
			if(!$style1 || !$style2) echo '<p><input type="submit" class="btn btn-inverse" value="Подать заявку" ></p>';
			unset($style1, $style2);
		?>
        </fieldset>
		</form>

		<div style="margin: 15px 0;">
		<p style="margin: 5px 0;"><font color=red>Внимание!</font><br>При создании заявки на групповой поединок:</p>
		<p style="margin: 5px 0;">- укажите пароль, сообщите его другим игрокам, тогда они смогут присоединиться к вашему поединку.</p>
        <p style="margin: 5px 0;">- для первого участника, команда выбирается автоматически, а остальные игроки могут выбирать команду.</p>
		</div>
    </td>
    <td align="right" valign="top">
    	<INPUT TYPE="button" value="Обновить" class="btn btn-inverse" value="Обновить" onclick="location = '/main.php?loc=1.180.0.412';">
    	<input type="button" value="Профили характеристик" class="btn btn-inverse" onclick="top.winframe('ruine_fm','Профили характеристик',590,480,'/ruin_characteristics.php');">
    </td>
  </tr>
</table>
<br>
<h4>Победители 10-ти предыдущих турниров</h4>
<?
$sp = mysql_query('SELECT * FROM `ruine_statistic` WHERE `wuid` > 0 ORDER BY `id` DESC LIMIT 10');
$i = 1;
while ($pl = mysql_fetch_array($sp))
{
	echo $i.'. Победитель: '.$u->microLogin($pl['wuid'],1).' Начало турнира <span class=date>'.date('d.m.Y H:i',($pl['time_start']+60)).'</span> продолжительность <span class=date>'.$u->timeOut( $pl['time_sf'] ).'</span> <a target=_blank href=/ruinelog.php?id='.$pl['tid'].'>История турнира »»</a><br>';
	$i++;
}
?>

<h4>Самый продолжительный турнир</h4>
<?
$sp = mysql_query('SELECT * FROM `ruine_statistic` WHERE `wuid` > 0 ORDER BY `time_sf` DESC LIMIT 1');
$i = 1;
while ($pl = mysql_fetch_array($sp))
{
	echo 'Победитель: '.$u->microLogin($pl['wuid'],1).' Начало турнира <span class=date>'.date('d.m.Y H:i',($pl['time_start']+60)).'</span> продолжительность <span class=date>'.$u->timeOut( $pl['time_sf'] ).'</span> <a target=_blank href=/ruinelog.php?id='.$pl['tid'].'>История турнира »»</a><br>';
	$i++;
}
?>
<br /><br />
<? } ?>

<script>
function ShowField(type)
{
	if(type==1)
	{
		$('#b_pass,#b_sostav').slideDown();
        $('#b_team').slideUp()
	}
	else if(type==2)
	{
		$('#b_pass, #b_team').slideDown();
        $('#b_sostav').slideUp();
	}
    else if(type==3)
	{
        $('#b_sostav').slideUp();
	}
	else
	{
		$('#b_pass,#b_team').slideUp();
        $('#b_sostav').slideDown();
	}

}
</script>
