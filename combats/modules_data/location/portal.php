<?php
if(!defined('GAME')) {
	die();
}

if($u->room['file']=='portal') {
        $cbuy = array();
		$tmref = 0;
    	$sp = mysql_query('SELECT * FROM `portal` WHERE `city` = "'.$u->info['city'].'" OR `tocity` = "'.$u->info['city'].'"');
	while($pl = mysql_fetch_array($sp)) {
		
	if($see==1) {	
	if($pl['period']==0 || $pl['period']==1) {
		$plc = $pl['tocity'];
	}else{
		$plc = $pl['city'];
	}

	if($pl['time_start_go']-time()<$tmref) {
		$tmref = $pl['time_start_go']-time();
	}
	if($bl!='--' && $bl>0 && $pl['citygo']!=$u->info['city']) {
		$cbuy[$pl['id']] = 1;
	}
}
	}
	
	if(isset($_GET['portal'])) {
		$tp = mysql_fetch_array(mysql_query('SELECT * FROM `portal` WHERE `city` = "'.$u->info['city'].'" AND `cancel` = "0" AND `id` = "'.((int)$_GET['portal']).'" LIMIT 1'));
	if(isset($tp['id'])) {
	if($u->info['money']>=$tp['price1']) {
		$rm = mysql_fetch_array(mysql_query('SELECT * FROM `room` WHERE `name` = "Портал" AND `city` = "'.$tp['toCity'].'" LIMIT 1'));
	if(isset($rm['id'])) {
		$u->info['money'] -= $tp['price1'];
		$u->info['city'] = $tp['toCity'];
		mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'",`city` = "'.$u->info['city'].'",`room` = "'.$rm['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		$u->addAction((time()+$tp['time']*60),'portal',$tp['toCity']);
		die('<script>location="main.php";</script>');
	}else{
		$error = 'Нельзя телепортироваться, возможно Портал в этом городе был разрушен...';
	}
			}else{
				$error = 'У вас недостаточно средсв';
			}
		}else{
			$error = 'Нельзя телепортироваться...';
		}
	}
	
    	$cst = ''; $zd = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` >= '.time().' AND `vars` = "portal" LIMIT 1',1);
    	$sp = mysql_query('SELECT * FROM `portal` WHERE `city` = "'.$u->info['city'].'" AND `cancel` = "0"');
	while($pl = mysql_fetch_array($sp)) {
		$cst .= '
	<br><b>'.$pl['city_name'].',</b>';
	if($pl['price1'] > 0) {
		$cst .= ' цена перемещения: '.$pl['price1'].'  кр. ,';
	}	
		$cst .= ' время восстановления: '.$u->timeOut($pl['time']*60).'';
	if(isset($zd['id'])) {
		$cst .= ' Задержка еще '.$u->timeOut($zd['time']-time()).'';
	}else{
		$cst .= ' <input type="button" value="Войти в портал" onClick=location.href="?portal='.$pl['id'].'"><br>';
	}
	}
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>

	<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr><td valign="top">
	<?php
	echo '<b style="color:red">'.$error.'</b>';
	
	if($cst!='')
	{
	?>
	<style>
body {
	background-color:#E2E2E2;
	background-image: url(//img.testcombats.ru/i/misc/showitems/p_portal21.jpg);
	background-repeat:no-repeat;background-position:top right;
}
</style>
	<br>
	<h4>Портал <? if(isset($zd['id'])){ echo ' </b>(Возможна через '.$u->timeOut($zd['time']-time()).')<b>'; } ?></h4>
	<? if(!isset($zd['id'])){ ?>
	<table width="100%" border="0" cellspacing="1" cellpadding="0">
<? echo $cst; ?>
	  </table>
	<br />
    <? } } unset($zd); ?>

    <? if($tmref>600 && $tmref>0){ echo '<script>setTimer(\'location = location;\','.(1000*$tmref-600).');</script>'; }  ?>

	<td width="280" valign="top">
    <TABLE cellspacing="0" cellpadding="0"><TD width="100%">&nbsp;</TD><TD>
	<table  border="0" cellpadding="0" cellspacing="0">
	<tr align="right" valign="top">
	<td>
	<!-- -->
	<? echo $goLis; ?>
	<!-- -->
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td nowrap="nowrap">
	<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
	<tr>
    <td bgcolor="#D3D3D3"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
<? if($u->info['city'] == "abandonedplain") {  ?>
 	<td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=3.180.0.267&rnd=<? echo $code; ?>';" title="<? thisInfRm('3.180.0.267',1); ?>">Центральная Площадь</a></td>
<?  }elseif ($u->info['city'] == "angelscity") {  ?>
<td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=2.180.0.234&rnd=<? echo $code; ?>';" title="<? thisInfRm('2.180.0.234',1); ?>">Центральная Площадь</a></td>
<?  }elseif ($u->info['city'] == "demonscity") {  ?>
<td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=4.180.0.286&rnd=<? echo $code; ?>';" title="<? thisInfRm('4.180.0.286',1); ?>">Центральная Площадь</a></td>
<?  }elseif ($u->info['city'] == "sandcity") {  ?>
<td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=8.180.0.384&rnd=<? echo $code; ?>';" title="<? thisInfRm('8.180.0.384',1); ?>">Центральная Площадь</a></td>
<?  }elseif ($u->info['city'] == "suncity") {  ?>
<td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=5.180.0.355&rnd=<? echo $code; ?>';" title="<? thisInfRm('5.180.0.355',1); ?>">Центральная Площадь</a></td>
<?  }elseif ($u->info['city'] == "devilscity") {  ?>
<td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=9.180.0.413&rnd=<? echo $code; ?>';" title="<? thisInfRm('9.180.0.413',1); ?>">Центральная Площадь</a></td>
<?  }elseif ($u->info['city'] == "mooncity") {  ?>
<td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=12.180.0.602&rnd=<? echo $code; ?>';" title="<? thisInfRm('12.180.0.602',1); ?>">Центральная Площадь</a></td>
<? }else{ ?>
    <td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.213&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.213',1); ?>">Большая торговая улица</a></td>
<? } ?>

	</tr>
	<tr>
	<td bgcolor="#D3D3D3"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
<? if ($u->info['city'] == "mooncity") {  ?>
<td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=12.180.0.603&rnd=<? echo $code; ?>';" title="<? thisInfRm('12.180.0.603',1); ?>">Вокзал</a></td>
<? } elseif ($u->info['city'] == "capitalcity") { ?>
<!--td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.9&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.9',1); ?>">Вокзал</a></td-->
<? } ?>

	</tr>
	</table>
	</td>
	</tr>
	</table>
	</td></table>
	</td></table>
	<div>
	</div>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>
<?
}
?>