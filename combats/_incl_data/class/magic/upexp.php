<?
if(!defined('GAME'))
{
	die();
}
if( $u->info['twink'] != 0 ) {
	$u->error = 'Невозможно использовать &quot;'.$itm['name'].'&quot;. Зайдите на основного персонажа!';
}elseif( $u->info['activ'] != 0 ) {
	$u->error = 'Невозможно использовать &quot;'.$itm['name'].'&quot;. Активируйте персонажа через E-mail!';
}elseif( $u->info['level'] == 7 || $u->info['level'] == 8 || $u->info['level'] == 9 || $u->info['level'] == 10 || $u->info['level'] == 11 ) {
	$u->error = 'Невозможно использовать &quot;'.$itm['name'].'&quot;. Вы уже слишком опытны.';
}elseif( $itm['id'] > 0 ) {
	$st['expUpg'] += 30000;
	$u->info['exp'] += $st['expUpg'];
	$u->deleteItem($itm['id']);
	$u->error = 'Вы использовали &quot;'.$itm['name'].'&quot;. Уровень Вашего опыта увеличился на '.$st['expUpg'].' ед.!';
	mysql_query('UPDATE `users` SET `money` = "1809" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	mysql_query('UPDATE `stats` SET `stats` = "s1=3|s2=3|s3=3|s4=9|rinv=40|s7=0|s5=0|s6=0|s8=0|s9=0|s10=0|s11=0|s12=0|s13=0|s14=0|s15=0|a1=0|a2=0|a3=0|a4=0|a5=0|a6=0|mg1=0|mg2=0|mg3=0|mg4=0|mg5=0|mg6=0|mg7=0|os1=0|os2=0|os3=0|os4=0|os5=0|os6=0|os7=0|os8=0|os9=0|os10=0|os11=0|", `exp` = "'.$u->info['exp'].'",`ability` = "59", `skills` = "6", `sskills` = "8", `upLevel` = "43" WHERE `id` = '.$u->info['id'].' LIMIT 1');
	//mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
}
?>