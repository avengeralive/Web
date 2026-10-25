<?php
define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");

include('/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/_incl_data/__config.php');
include('/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/_incl_data/class/__db_connect.php');
include('/home/admin/web/'.$_SERVER['HTTP_HOST'].'/public_html/_incl_data/class/__user.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Игроки онлайн</title>
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
<?
$btl = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `online` > "'.(time()-600).'" AND `pass` != "saintlucia" AND `mail`!="No E-mail" AND `battle` > "0" LIMIT 1'));
$dnd = mysql_fetch_array(mysql_query('SELECT COUNT(`u`.`id`) FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`
WHERE `online` > "'.(time()-600).'" AND `pass` != "saintlucia" AND `mail`!="No E-mail" AND `s`.`dnow` > "0" LIMIT 1'));
$la = LA();

//$dnd = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `pass` NOT LIKE "%saint%" AND `mail`!="No E-mail" AND `dnow` > "0" LIMIT 1'));
?>
<p align=center><b style="color:#000;">Игроки онлайн:</b> &nbsp;
<input onClick="location.href='users-online.php';" type="button" value="Обновить">
<b style="color:#000;"> | В боях: <?=$btl[0];?> | В пещерах: <?=$dnd[0];?> | Проц: <?=$la[3];?>%</b>
</p>
<br>
<p align=center>
<table style="margin: auto;" align=center border=1 cellspacing=0 cellpadding=4 style="border: 1px solid #9e9e9e;">
<tr><td>#</td><td>Игрок</td><td>Заявка</td><td>Бой</td><td>Город</td><td>Комната</td><td>Пещера</td></tr>

<?
$i = 1;
$sp = mysql_query('SELECT `s`.`dnow`,`u`.`timeMain`,`u`.`afk`,`u`.`dnd`,
		`u`.`room`,`u`.`id`,`u`.`city`,`u`.`online`,`u`.`inTurnir`,`u`.`battle`,
		`u`.`invis`,`u`.`inUser`,`s`.`hpNow`,`s`.`zv` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`
		WHERE `online` > "'.(time()-600).'" AND `inUser` = "0" AND `no_ip` != "trupojor" AND `login` NOT LIKE "%(%" AND `banned` = 0
		AND `bot_id` = 0 AND `pass` != "saintlucia" ORDER BY `u`.`inUser` DESC,`u`.`online` DESC,`s`.`dnow` DESC LIMIT 700');

while($pl = mysql_fetch_array($sp))
{
	$room = mysql_fetch_array(mysql_query('SELECT `name` FROM `room` WHERE `id` = "'.$pl['room'].'" LIMIT 1'));
    $dungeon = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_now` WHERE `id` = "'.$pl['dnow'].'" LIMIT 1'));
    $dungeon =(isset($dungeon['id']) ? $dungeon['name'].' ['.$dungeon['id2'].']' : '');

	$battle = ($pl['battle'] > 0 ? '<a href="/logs.php?log='.$pl['battle'].'&rnd=1" target=_blank>'.$pl['battle'].'</a>' : '');
    $battle_l = ($last['battle_id'] > 0 ? '<a href="/logs.php?log='.$last['battle_id'].'&rnd=1" target=_blank>'.$last['battle_id'].'</a>' : '');

	echo '<tr><td>'.$i.'</td><td>'.$u->microLogin($pl['id'],1).'&nbsp;</td>
	<td>'.($pl['zv'] ? $pl['zv'] : '').'</td><td>'.$battle.'</td><td>'.$pl['city'].'</td>
	<td>'.$room['name'].' ['.$pl['room'].']</td><td>'.$dungeon.'</td></tr>';//	<td style="text-align: center;">'.date('d.m.y H:i', $pl['online']).'</td>
	
	$i++;
}
?>
</table>
</p>
</body>
</html>