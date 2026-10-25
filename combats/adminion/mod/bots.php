<?php
define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");

include('/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/_incl_data/__config.php');
include('/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/_incl_data/class/__db_connect.php');
include('/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/_incl_data/class/__user.php');

$i = 1;
$priz_bots   = array(3175090, 3094101, 3094239, 3094136, 4093850, 3096743);//Боты для призовых хаотов
$nohaot_bots = array(3175090,4093850,3096743);//Боты, которые не ходят в хаоты
$ip_regs = array('Отдых','Готов в бой','Готов в бой','Готов в бой','Готов в бой','Готов в бой','Готов в бой','Готов в бой','В бою');

$sp = mysql_query('SELECT `u`.* , `s`.* FROM `stats` AS `s` LEFT JOIN `users` AS `u` ON `u`.`id` = `s`.`id`
WHERE `u`.`pass` = "saintlucia" OR `u`.`no_ip`="trupojor" ORDER BY `u`.`ipreg` DESC, `u`.`battle` DESC, `s`.`zv`  LIMIT 100');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Состояние ботов</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta http-equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<meta http-equiv=Expires Content=0>
<link href="/css/common.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/jquery.1.11.js"></script>
<body style="padding-top:0px; margin-top:7px; height:100%; text-align: center; background-color: #fff;">
<style>
	table {border-collapse: collapse; color: #444;}
	table, th, td {border: 1px solid gray;}
	td{text-align: left; padding: 2px 5px;}
	td a:hover {color: #AB772A}
</style>
<script>
setTimeout(function(){
   window.location.reload(1);
}, 15000);
</script>
<p align=center><b style="color:#000;">Состояние ботов:</b> &nbsp;
<input onClick="location.href='bots.php';" type="button" value="Обновить">
</p>
<br>
<p align=center>
<table style="margin: auto;" align=center border=1 cellspacing=0 cellpadding=4 style="border: 1px solid #9e9e9e;">
<tr><td>#</td><td>Бот</td><td>HPNow</td><td>Заявка</td><td>Бой</td><td>Последний</td><td>Статус</td><td>Время</td></tr>

<?
while($pl = mysql_fetch_array($sp))
{
	$priz_bot = (in_array($pl['id'], $priz_bots) ? '<font color=red>[приз]</font>' : '');
    $no_priz_bot = (in_array($pl['id'], $nohaot_bots) ? '<font color=red>[не хаот]</font>' : '');
	$banned = ($pl['banned']>0 ? '<font color=red>[бан]</font>' : '');

	$last = mysql_fetch_array(mysql_query('SELECT `battle_id` FROM `battle_last` WHERE `uid` = "'.$pl['id'].'" ORDER BY `id` DESC LIMIT 1'));
	$hpNow = ($pl['hpNow']>0 ? '<font color=green>' : '<font color=red>').round($pl['hpNow']).'</font>';

	$battle = ($pl['battle'] > 0 ? '<a href="/logs.php?log='.$pl['battle'].'&rnd=1" target=_blank>'.$pl['battle'].'</a>' : '');
    $battle_l = ($last['battle_id'] > 0 ? '<a href="/logs.php?log='.$last['battle_id'].'&rnd=1" target=_blank>'.$last['battle_id'].'</a>' : '');

	if($pl['room']==303) $bot_status = 'В норке [303]';
	else $bot_status = (strlen($pl['ipreg']) < 3 ? $ip_regs[$pl['ipreg']].' ['.$pl['ipreg'].']' : '-');
	if($pl['zv'] && $pl['ipreg']==8) $bot_status = 'В заявке [8]';
    elseif(!$pl['battle'] && $pl['ipreg']==8) $bot_status = 'После боя [8]';
	$ipreg_time = ($pl['ipreg_time'] ? '&nbsp;'.(time() - $pl['ipreg_time']).' сек.' : '');
	

	echo '<tr><td>'.$i.'</td><td>'.$u->microLogin($pl['id'],1).'&nbsp;'.$priz_bot.$no_priz_bot.$banned.'</td><td style="text-align: center;">'.$hpNow.'</td>
	<td>'.($pl['zv'] ? $pl['zv'] : '').'</td><td>'.$battle.'</td>
	<td style="text-align: center;">'.$battle_l.'</td><td>'.$bot_status.'</td><td>'.$ipreg_time.'</td></tr>';//	<td style="text-align: center;">'.date('d.m.y H:i', $pl['online']).'</td>
	
	$i++;
}
?>
</table>
</p>
</body>
</html>