<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'dispellprok' ) {	
	mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'"
	AND (`id_eff` = "99037" OR
	`id_eff` = "99036"OR
	`id_eff` = "99035" OR
	`id_eff` = "425" OR
	`id_eff` = "424" OR
	`id_eff` = "432")');
	$u->error = 'Вы очистились от проклятья';
	mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
}
?>