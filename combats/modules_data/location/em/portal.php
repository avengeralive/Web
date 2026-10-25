<?php
if(!defined('GAME')) {
	die();
}

if($u->room['file']=='em/portal') {
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
	<br><b>Возврат ('.$pl['city_name'].') </b>';
	/*if($pl['price1'] > 0) {
		$cst .= ' цена перемещения: '.$pl['price1'].'  кр. ,';
	}*/	
	//	$cst .= ' время восстановления: '.$u->timeOut($pl['time']*60).'';
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
<table border="0" cellpadding="0" cellspacing="0" style="float: right;">
    <tbody>
    <tr align="right" valign="top">
    <td>
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td align="right" colspan="2">
    <tr>
    <div style="position:relative; cursor: pointer;" id="ione">
    <img id="img_ione" src="//img.testcombats.ru/city/emeraldscity/em_bg3.jpg" oncontextmenu="return false;" alt="" name="img_ione" width="500" height="268" border="1" id="img_ione"/>
    <div style="position:absolute; left:107px; top:56px; width:134; height:171; z-index:90;">
    <a href="main.php?talk=7"><img title="Бугаг" src="//img.testcombats.ru/city/emeraldscity/em_golem1.gif" oncontextmenu="return false;" width="134" height="171" class="aFilter" /></a>
    </div>
    </div>
    </tr>
    <div style="display:none; height:0px " id="moveto"></div>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>
<?
}
?>