<?php
if(!defined('GAME') || !isset($_GET['referals']))
{
	die();
}

$rfs = array();
$rfs['count'] = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `host_reg` = "'.$u->info['id'].'" AND `mail` != "No E-Mail" LIMIT 1000'));
$rfs['count'] = 0+$rfs['count'][0];
$rfs['c'] = 1;
$rfs['data'] = explode('|',$u->info['ref_data']);
if(isset($_POST['r_bank']) || isset($_POST['r_type']))
{
	$bnk = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `id` = "'.mysql_real_escape_string($_POST['r_bank']).'" AND `uid` = "'.$u->info['id'].'" AND `block` = "0" LIMIT 1'));
	if(!isset($bnk['id']))
	{
		
	}else{
		if($_POST['r_type']==1){ $_POST['r_type'] = 1; }else{ $_POST['r_type'] = 2; }
		$u->info['ref_data'] = $bnk['id'].'|'.$_POST['r_type'];
		$rfs['data'] = explode('|',$u->info['ref_data']);
		mysql_query('UPDATE `stats` SET `ref_data` = "'.mysql_real_escape_string($u->info['ref_data']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	}
}
$rfs['see']   = '';
$sp = mysql_query('SELECT `s`.`active`,`u`.`online`,`u`.`id`,`u`.`level` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `u`.`id` = `s`.`id` WHERE `u`.`host_reg` = "'.$u->info['id'].'" AND `u`.`mail` != "No E-Mail" ORDER BY `u`.`level` DESC LIMIT '.$rfs['count']);
while($pl = mysql_fetch_array($sp))
{
	$rfs['c2'] = '&nbsp; '.$rfs['c'].'. &nbsp; '.$u->microLogin($pl['id'],1).'';
	if($pl['active']!='')
	{
		$rfs['c2'] = '<font color="grey">'.$rfs['c2'].' &nbsp; <small>не активирован</small></font>';
	}elseif($pl['level']>5)
	{
		$rfs['c2'] = '<font color="black">'.$rfs['c2'].'</font>';
	}
	if($pl['online'] >time()-520) {
		$rfs['c2'] .= '<font color="green"> &nbsp; <small>Онлайн</small></font>';
	}
	$rfs['see'] .= $rfs['c2'].'<br>';
	$rfs['c']++;
}
if($rfs['see']=='')
{
	$rfs['see'] = '<b>К сожалению у Вас нет рефералов</b>';
}
?>
<table cellspacing="0" cellpadding="2" width="100%">
  <tr>
    <td style="vertical-align: top; "><table cellspacing="0" cellpadding="2" width="100%">
      <tr>
        <td colspan="4" align="center"><h4>Реферальная Система - Старый Бойцовский Клуб</h4></td>
      </tr>
      <tr>
        <td colspan="4" style="font-size: 8pt;">
<u><font color="#003388"><b>Кредиты</b> можно получить:</font></u> <br>
- набирая опыт в боях и поднимаясь по апам и уровням в соответствии с <a href="//testcombats.ru/exp" target="_blank">Таблицей Опыта</a> (доступно на любом уровне)<br>
-  в Пещерах: продав ресурсы в Магазин<br>
- с помощью <b>Реферальной системы</b>, которая описана ниже (доступно на любом уровне)<br>
- лечением и другими магическими услугами  (доступно с 8 уровня)<br>
- торговлей (доступно с 8 уровня)<br>
<br><br>

<u><font color="#003388"><b>Еврокредиты</b> можно получить:</font></u><br>
- с помощью <b>Реферальной системы</b>, которая описана ниже (доступно на любом уровне)<br>
- купив еврокредиты у официальных дилеров БК<br>
<br>  
<br>

<b>Реферальная система</b> - это возможность Вашего <b>дополнительного заработка</b> в игре. При открытии счета в банке, Вы автоматически получаете личную <b>реферальную ссылку</b>, которую можете раздать своим друзьям и знакомым.<br><br>

<b>Каждый персонаж</b>, зарегистрировавшийся в БК по Вашей реферальной ссылке, по достижению им <b>9го</b> уровня начнет приносить Вам <b>дополнительный заработок</b>.<br>
<br>

При достижении Вашим рефералом:<br>
<b>8го</b> уровня - <b style="color:darkred">50 екр.</b> | <b>9го</b> уровня - <b style="color:darkred">100 екр.</b> | 
<b>&nbsp;10го</b> уровня - <b style="color:darkred">200 екр.</b> | <b>&nbsp;11го</b> уровня - <b style="color:darkred">400 екр</b>.<br>
        
</td>
      </tr>
    </table></td>
    <td style="width: 30%; vertical-align: top; "><table width="100%" cellpadding="2" cellspacing="0">
      <tr>
		<td style="width: 27%; vertical-align: top; text-align: right; padding-right: 20px;">
			<input type="button" value="Обновить"  onclick='location="/main.php?referals"'>
			<input type="button" value="Вернуться" onclick="location.href='/main.php'">
		</td>
      </tr>
      <tr>
	    <td>
		<FIELDSET style="width:350px;border-color: white;"><LEGEND align="left"><h4>Банк счета:</h4> </LEGEND>
		<form method="post" action="main.php?referals"> <table style=" padding: 5px; 15px;">
			<tr>
				<td><b>Счет:</b></td>
				<td>
				<? $bsees = '';
					$sp = mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$u->info['id'].'" AND `block` = "0" LIMIT 10');
					while($pl = mysql_fetch_array($sp))
					{
						if($rfs['data'][0]==$pl['id'])
						{
							$bsees .= '<option selected="selected" value="'.$pl['id'].'">№ '.$pl['id'].'</option>';
						}else{
							$bsees .= '<option value="'.$pl['id'].'">№ '.$pl['id'].'</option>';
						}
					}
					if($bsees != '') {
				?>
				<select name="r_bank" id="r_bank">
            	<? 
					echo $bsees;
				?>
				</select>
				<? }else{
				echo '<b style="color: red;">Откройте счет в банке.</b>';
				}?>
				</td>
				<td style="float: right;"><input type="submit" name="button" value="Сохранить" /></td>
			</tr>
		</table></form>
		</FIELDSET>
		<FIELDSET style="width:350px; border-color: white;"><LEGEND align="left"><h4>Ваши уникальные ссылки:</h4></LEGEND>
		<table align="left">
			<tr><td><input style="background-color:#FBFBFB; border:1px solid #EFEFEF; padding:5px;" size="40" value="testcombats.ru/register.php?ref=<?=$u->info['id']?>"  /></td><td ><input type="submit" name="button" value="Скопировать"/></td></tr>
			<tr><td><input style="background-color:#FBFBFB; border:1px solid #EFEFEF; padding:5px;" size="40" value="testcombats.ru/r<?=$u->info['id']?>"  /></td><td><input type="submit" name="button" value="Скопировать"/></td></tr>
		<tr><td colspan="3" style="font-size: 8pt;">- В реферальной системе отображаются персонажи прошедшие регистрацию<br>- Выплаты производятся по банковскому счету указаному в настройках системы</td></tr>
		</table>
		</FIELDSET>
		<FIELDSET style="width:350px; border-color: white;"><LEGEND align="left" ><h4 >Ваши рефералы:</h4></LEGEND>
		 <span align="left"><?=$rfs['see']?></span>
		</FIELDSET>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
