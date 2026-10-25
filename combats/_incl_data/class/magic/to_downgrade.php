<?
if(!defined('GAME'))
{
	die();
}	

$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
if($battle['timeout'] == 60) {
		$u->error = 'Таймаут боя и так 1 минута!';
}elseif(isset($battle['id'])) {
	$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],'','{tm1} {u1} <font color=green><b>уменьшил таймаут поединка на 1 минуту</font></b> ',($btl->hodID));			
	mysql_query('UPDATE `battle` SET `timeout` = `timeout` - 60 WHERE `id` = "'.$u->info['battle'].'" LIMIT 1');
	mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
}
?>