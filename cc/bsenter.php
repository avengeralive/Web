<?
if(!defined('GAME')) { die(); }

if($u->room['file'] == 'cc/bsenter')
{
  	$r = 2;
  	if(isset($_GET['r'])) {
	$_GET['r'] = (int)$_GET['r'];
	if($_GET['r'] == 7 || $_GET['r'] == 8 || $_GET['r'] == 9 || $_GET['r'] == 10 || $_GET['r'] == 11) { $r = round($_GET['r']-6); }
	if($u->info['level'] < $r+6) { $r = 1; }
	}
    if($magic->testTravma( $u->info['id'] , 4 )) $nTravma = 1;
	else $nTravma  = 0;

function changeSleep($uid,$sleep_action)
{
	global $u;
	if( $sleep_action == 1 ){
		//
		mysql_query('INSERT INTO `sleep` (`uid`,`time`,`sleep`) VALUES ("'.$uid.'","'.time().'","1")');
		//
		mysql_query("UPDATE `eff_users` SET `sleeptime`=".time().",`deactiveLast` = ( `deactiveTime` - ".time()." ) WHERE `uid`='".mysql_real_escape_string($uid)."' AND `no_Ace` = 0 AND `delete` = 0");
		mysql_query('UPDATE `items_users` SET `time_sleep` = "'.time().'" WHERE `uid` = "'.$uid.'" AND `delete` < 1001 AND `data` LIKE "%|sleep_moroz=1%"');
		$u->addAction(time(),'sleep',$u->info['city']);
		//
	} elseif( $sleep_action == 2 ){
		//
		mysql_query('INSERT INTO `sleep` (`uid`,`time`,`sleep`) VALUES ("'.$uid.'","'.time().'","2")');
		//
		$sp = mysql_query('SELECT * FROM `items_users` WHERE `time_sleep` > 0 AND `uid` = "'.$uid.'" AND `delete` < 1001 AND `data` LIKE "%|sleep_moroz=1%"');
		while( $pl = mysql_fetch_array($sp) ) {
			$tm_add = time() - $pl['time_sleep'];
			mysql_query('UPDATE `items_users` SET `time_sleep` = "0",`time_create` = "'.($pl['time_create'] + $tm_add).'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
		$sp = mysql_query('SELECT `id`,`deactiveTime`,`deactiveLast` FROM `eff_users` WHERE `v1` LIKE "pgb%" AND `delete` = "0" AND `deactiveTime` > 0 AND `uid` = "'.$uid.'" ORDER BY `timeUse` DESC');
		while($pl = mysql_fetch_array($sp)) {
			mysql_query("UPDATE `eff_users` SET `deactiveTime` = ".(time()+$pl['deactiveLast'])." WHERE `id`='".$pl['id']."' ");						
		}
		$sp = mysql_query('SELECT `id`,`sleeptime`,`timeUse` FROM `eff_users` WHERE `uid`="'.mysql_real_escape_string($uid).'" AND `no_Ace` = 0 AND `sleeptime` > 0 AND `delete` = 0');
		while($pl = mysql_fetch_array($sp)) {
			$timeUsen = time()-($pl['sleeptime']-$pl['timeUse']);
			mysql_query("UPDATE `eff_users` SET `timeUse`='".$timeUsen."',`sleeptime`='0' WHERE `id`='".$pl['id']."' ");
		}
		mysql_query('UPDATE `actions` SET `vars` = "unsleep",`val` = "'.time().'" WHERE `id` = "'.$sleep['id'].'" LIMIT 1');
	}
	//$sleep = $u->testAction('`vars` = "sleep" AND `uid` = "'.$uid.'" LIMIT 1', 1);
}

//Разморозка эффектов
/*$sp = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `sleeptime` > 0 LIMIT 1'));
if($sp[0] > 0) {
	changeSleep($u->info['id'],2);
}*/
/*$sp = mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `bs` = 1');
while( $pl = mysql_fetch_array($sp)) {
	//$time = time()-$pl['sleeptime'];
	//if( $pl['sleeptime'] == 0 ) {
	//	$time = 0;
	//}
	//$time = $pl['timeUse'] + $time;
	//mysql_query('UPDATE `eff_users` SET `timeUse` = "'.$time.'",`sleeptime` = 0,`bs` = 0 WHERE `id` = "'.$pl['id'].'" LIMIT 1');
}*/
//

$t = mysql_fetch_array(mysql_query('SELECT * FROM `bs_turnirs` WHERE `city` = "'.$u->info['city'].'" AND `level` = "'.((int)($r+6)).'" LIMIT 1'));
if(isset($t['id'])) {
  if($t['time_start'] > time())	{
	$tz = mysql_fetch_array(mysql_query('SELECT * FROM `bs_zv` WHERE `bsid` = "'.$t['id'].'" AND `time` = "'.$t['time_start'].'" AND `uid` = "'.$u->info['id'].'" AND `finish` = 0 LIMIT 1'));
	$tz_all = mysql_fetch_array(mysql_query('SELECT SUM(`money`) FROM `bs_zv` WHERE `bsid` = "'.$t['id'].'" AND `time` = "'.$t['time_start'].'" AND `uid` = "'.$u->info['id'].'" AND `finish` <= "'.$t['time_start'].'" LIMIT 1'));
  }
  if(isset($_POST['coin']) && $t['time_start'] > time() )
  {
		$_POST['coin'] = round((int)$_POST['coin'],2);

		//Проверка заявок
		if($u->info['inTurnirnew']>0)
		{
            $error = 'Вы уже участвуете в турнире в Бойцовском Клубе!';
		}
		elseif((round((int)$tz['money'], 2) + $_POST['coin']) > 3*$u->info['level'] || $tz_all[0] > 3*$u->info['level'])
		{
		  $error = 'Вам нельзя делать ставку выше '.(3* $u->info['level']).' кр.';
		}
		elseif(($_POST['coin'] >= $t['min_money'] || (isset($tz['id']) && $_POST['coin'] >= 1)) && $u->info['money'] >= $_POST['coin'])
		{
		  $t['money'] += $_POST['coin'];
		  $u->info['money'] -= $_POST['coin'];
		  if(isset($tz['id']))
		  {
			$tz['money'] += $_POST['coin'];
			mysql_query('UPDATE `bs_zv` SET `money` = "'.$tz['money'].'" WHERE `id` = "'.$tz['id'].'" LIMIT 1');
		  } else {
					//создаем
					$tz_all = mysql_fetch_array(mysql_query('SELECT SUM(`money`) FROM `bs_zv` WHERE `bsid` = "'.$t['id'].'" AND `time` = "'.$t['time_start'].'" AND `uid` = "'.$u->info['id'].'" AND `finish` = "0" LIMIT 1'));
					$ins = mysql_query('INSERT INTO `bs_zv` (`bsid`,`money`,`time`,`uid`) VALUES ("'.$t['id'].'","'.mysql_real_escape_string($_POST['coin']).'","'.$t['time_start'].'","'.$u->info['id'].'")');
					if($ins) {
						$tz_all = mysql_fetch_array(mysql_query('SELECT SUM(`money`) FROM `bs_zv` WHERE `bsid` = "'.$t['id'].'" AND `time` = "'.$t['time_start'].'" AND `uid` = "'.$u->info['id'].'" AND `finish` = "0" LIMIT 1'));
						if( $tz_all[0] > 0 ) {
							$_POST['coin'] = $tz_all[0];
							$error = 'Ваша ставка была возвращена. ('.round($_POST['coin'],2).' кр.)';
						}
						$t['users']++;
						$tz = array('id'=>1, 'bsid'=>$t['id'], 'money'=>$_POST['coin'], 'time'=>$t['time_start'], 'finish'=>0);
					}
				}
				mysql_query('UPDATE `bs_turnirs` SET `money` = "'.$t['money'].'", `users` = "'.$t['users'].'" WHERE `id` = "'.$t['id'].'" LIMIT 1');
				mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}
	}
}

if($u->info['id'] != 7) {
?>
<style>
body {
  background-color:#dfdfdf;
  background-image: url(//img.testcombats.ru/i/misc/showitems/dungeon.jpg);
  background-repeat:no-repeat;background-position:top right;
  font-size: 8pt;
}
</style>
<?
if($re != '') {
  echo '<div style="float:right"><font color=red><b>'.$re.'</b></font></div>';
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div style="padding-left:0px;" align="center">
      <center><b style="color: brown;"><? echo $u->room['name']; ?></b></center>
    </div></td>
    <td width="200"><div align="right">
      <table cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%">&nbsp;</td>
          <td><table  border="0" cellpadding="0" cellspacing="0">
              <tr align="right" valign="top">
                <td><!-- -->
                    <? echo $goLis; ?>
                    <!-- -->
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td nowrap="nowrap"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
                            <tr>
                              <td bgcolor="#D3D3D3"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
                              <td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onClick="location='main.php?loc=1.180.0.11&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.11',1); ?>">Страшилкина улица</a></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
              </tr>
          </table></td>
        </tr>
      </table>
      </div></td>
  </tr>
</table>

<b><font color="green">Поздравляем! Вы успешно допускаетесь к турниру!</font></b><br>
<form method="post" action="main.php?rnd=<?=$code;?>">
<fieldset style="padding: 5px; border:1px solid white;width:70%;">
<legend style='font-weight:bold; color:#8F0000;'><? if($t['status'] == 0) { ?>Прием заявок на следующий турнир <? } else { ?>Текущий турнир<? } ?></legend>

<!--Уровень:
<select name="level" onChange="location='main.php?r='+this.value+'&rnd=<?=$code;?>';">
        <option value="11" <? if($r == 5) { echo 'selected'; } if($u->info['level'] < 11) { echo 'disabled'; } ?> disabled >11</option>
        <option value="10" <? if($r == 4) { echo 'selected'; } if($u->info['level'] < 10) { echo 'disabled'; } ?> disabled >10</option>
        <option value="9"  <? if($r == 3) { echo 'selected'; } if($u->info['level'] < 9) { echo 'disabled'; } ?> disabled >9</option>
        <option value="8"  <? if($r == 2) { echo 'selected'; } if($u->info['level'] < 8) { echo 'disabled'; } ?> >8</option>
        <option value="7"  <? if($r == 1) { echo 'selected'; } ?> >7</option>
</select><br>-->
<? if(!isset($t['id'])) { echo '<br><center>К сожалению турниры данного типа не проводятся в этом городе</center><br>'; } else {
if ($nTravma)
{
    echo '<center><b><font color=red>У вас неизлечимая травма! Вы не можете посещать Туриниры БС.</font></b></center>';
}
elseif($t['status'] == 0)
{
?>
Начало турнира: <span class=date><?=date('d.m.Y H:i:',$t['time_start']);?>59</span><BR>
Призовой фонд на текущий момент: <B><?=round(($t['money']-($t['money']/100*15)),2);?></B> кр.<BR>
Всего подано заявок: <B><?=$t['users'];?></B><BR>
<?
if($error != '') {
  echo '<font color=red><b>'.$error.'</b></font><Br>';
}
?>
<? if(!isset($tz['id'])) { ?>
Сколько ставите кредитов? (минимальная ставка <b><?=$t['min_money'];?>.00 кр.</B> у вас в наличии <b><? echo floor($u->info['money']); ?> кр.</b>)<BR><input type="text" name="coin" value="<?=$t['min_money'];?>" size="8"><input type="submit" value="Подать заявку" name="docoin"><BR>
Чем выше ваша ставка, тем больше шансов принять участие в турнире.<BR>
<? }else{ ?>
Вы уже сделали ставку <b><? echo floor($tz['money']); ?> кр.</b> (У вас в наличии <b><? echo floor($u->info['money']); ?> кр.</b>) Сделать повторную ставку?<br />
<small><b><font color=red>Внимание! Покинув помещение Башни Смерти все Ваши ставки будут потеряны!</font></b></small><br>
<input type="text" name="coin" value="1.00" size="8" id="coin" />
<input type="submit" value="Увеличить ставку" name="docoin2" />&nbsp;
<INPUT TYPE="button" onClick="location = 'main.php?rnd=<?=$code;?>';" value="Обновить"> &nbsp;
<? } } elseif($t['status'] == 1) { ?>
<?
$r = ''; $p = ''; $b = '<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tbody>
    <tr valign="top">
      <td valign="bottom" nowrap="" title=""><input onClick="location=location;" type="submit" value="Обновить"></td>
    </tr>
  </tbody>
</table>';
$notowerlog = false;
$log = mysql_fetch_array(mysql_query('SELECT `id`,`count_bs`,`m` FROM `bs_logs` WHERE `count_bs` = "'.mysql_real_escape_string($t['count']).'" ORDER BY `id` ASC LIMIT 1'));
if(!isset($log['id'])) {
	$notowerlog = true;
	$r = '<div>Скорее всего Архивариус снова потерял пергамент с хрониками турниров ...</div>';
} else {
	$sp = mysql_query('SELECT * FROM `bs_logs` WHERE `count_bs` = "'.$log['count_bs'].'" ORDER BY `id` ASC');
	while( $pl = mysql_fetch_array($sp) ) {
		$datesb = '';
		if( $pl['type'] == 2 ) {
			$datesb = '2';
		}
		$r .= '<br><span class="date'.$datesb.'">'.date('d.m.y H:i',$pl['time']).'</span> '.$pl['text'].'';
	}
	$liveusers = '';
	$sp = mysql_query('SELECT `id` FROM `users` WHERE `inTurnir` = "'.$t['id'].'"');
	while( $plu = mysql_fetch_array($sp) )
	{
		$pl = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`align`,`clan`,`level` FROM `users` WHERE `inUser` = "'.$plu['id'].'"'));
		if( isset($pl['id']) ) {
			$alc = '';
			if( $pl['align'] > 0 ) {
				$alc .= '<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$pl['align'].'.gif >';
			}
			if( $pl['clan'] > 0 ) {
				$alc .= '<img width=24 height=15 src=//img.testcombats.ru/i/clan/'.$pl['clan'].'.gif >';
			}
			$liveusers .= ', <b>'.$alc.$pl['login'].'</b> ['.$pl['level'].']<a href=/info/'.$plu['id'].' target=_blank><img src=//img.testcombats.ru/i/inf_'.$pl['cityreg'].'.gif width=12 height=11 ></a>';
		}
	}
	$r .= '<br><br>Всего живых участников на данный момент: <b>'.$t['users'].'</b> ('.ltrim($liveusers,', ').')';
	unset($liveusers,$alc);
}
if( $notowerlog == false ) {?>
Призовой фонд: <b><?=$log['m']?> кр.</b>
<? } echo $r; ?>
<? } } ?>
<BR>
</fieldset>
</form><br>
<fieldset style="padding: 5px; border:1px solid white;width:70%;">
<legend><b style="color: brown;">Победители 10-ти предыдущих турниров <!--для <?=$t['level']?> уровней--></b></legend>
<?
$sp = mysql_query('SELECT * FROM `bs_statistic` WHERE `wuid` > 0 ORDER BY `id` DESC LIMIT 10');
$i = 1;
while ($pl = mysql_fetch_array($sp)) {
	$wuser = '<b>'.$pl['wlogin'].'</b> ['.$pl['wlevel'].']<a href=/info/'.$pl['wuid'].' target=_blank ><img width=12 height=11 src=//img.testcombats.ru/i/inf_'.$pl['cityreg'].'.gif ></a>';
	if( $pl['wclan'] > 0 ) {
		$wuser = '<img width=24 height=15 src=//img.testcombats.ru/i/clan/'.$pl['wclan'].'.gif>'.$wuser;
	}
	if( $pl['walign'] > 0 ) {
		$wuser = '<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$pl['walign'].'.gif>'.$wuser;
	}
	echo $i.'. Победитель: '.$wuser.' Начало турнира <span class=date>'.date('d.m.Y H:i',($pl['time_start']+60)).'</span> продолжительность <span class=date>'.$u->timeOut( $pl['time_sf'] ).'</span> приз: <b>'.$pl['money'].'</b> <a target=_blank href=/towerlog.php?towerid='.$pl['bsid'].'&id='.$pl['count'].' >История турнира »»</a><br>';
	$i++;
}
?>
</fieldset><br>
<fieldset style="padding: 5px; border:1px solid white;width:70%;">
<legend><b style="color: brown;">Максимальный выигрыш <!-- для <?=$t['level']?> уровней--></b></legend>
<?
$sp = mysql_query('SELECT * FROM `bs_statistic` WHERE `wuid` > 0 ORDER BY `money` DESC LIMIT 1');
$i = 1;
while ($pl = mysql_fetch_array($sp)) {
	$wuser = '<b>'.$pl['wlogin'].'</b> ['.$pl['wlevel'].']<a href=/info/'.$pl['wuid'].' target=_blank ><img width=12 height=11 src=//img.testcombats.ru/i/inf_'.$pl['cityreg'].'.gif ></a>';
	if( $pl['wclan'] > 0 ) {
		$wuser = '<img width=24 height=15 src=//img.testcombats.ru/i/clan/'.$pl['wclan'].'.gif>'.$wuser;
	}
	if( $pl['walign'] > 0 ) {
		$wuser = '<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$pl['walign'].'.gif>'.$wuser;
	}
	echo 'Победитель: '.$wuser.' Начало турнира <span class=date>'.date('d.m.Y H:i',($pl['time_start']+60)).'</span> продолжительность <span class=date>'.$u->timeOut( $pl['time_sf'] ).'</span> приз: <b>'.$pl['money'].'</b> <a target=_blank href=/towerlog.php?towerid='.$pl['bsid'].'&id='.$pl['count'].' >История турнира »»</a><br>';
	$i++;
}
?>
</fieldset><br>
<fieldset style="padding: 5px; border:1px solid white;width:70%;">
<legend><b style="color: brown;">Самый продолжительный турнир <!-- для <?=$t['level']?> уровней --></b></legend>
<?
$sp = mysql_query('SELECT * FROM `bs_statistic` WHERE `wuid` > 0 ORDER BY `time_sf` DESC LIMIT 1');
$i = 1;
while ($pl = mysql_fetch_array($sp)) {
	$wuser = '<b>'.$pl['wlogin'].'</b> ['.$pl['wlevel'].']<a href=/info/'.$pl['wuid'].' target=_blank ><img width=12 height=11 src=//img.testcombats.ru/i/inf_'.$pl['cityreg'].'.gif ></a>';
	if( $pl['wclan'] > 0 ) {
		$wuser = '<img width=24 height=15 src=//img.testcombats.ru/i/clan/'.$pl['wclan'].'.gif>'.$wuser;
	}
	if( $pl['walign'] > 0 ) {
		$wuser = '<img width=12 height=15 src=//img.testcombats.ru/i/align/align'.$pl['walign'].'.gif>'.$wuser;
	}
	echo 'Победитель: '.$wuser.' Начало турнира <span class=date>'.date('d.m.Y H:i',($pl['time_start']+60)).'</span> продолжительность <span class=date>'.$u->timeOut( $pl['time_sf'] ).'</span> приз: <b>'.$pl['money'].'</b> <a target=_blank href=/towerlog.php?towerid='.$pl['bsid'].'&id='.$pl['count'].' >История турнира »»</a><br>';
	$i++;
}
?>
</fieldset><br>
<? } } ?>