<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'anti_yad' ) {	
	mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'"
	AND (`id_eff` = "427" OR
	`id_eff` = "428"OR
	`id_eff` = "429" OR
	`id_eff` = "430" OR
	`id_eff` = "431" OR
	`id_eff` = "432" OR
	`id_eff` = "433" OR
	`id_eff` = "434" OR
	`id_eff` = "435" OR
	`id_eff` = "436") ');
	$u->error = 'Вы исцелились от ядов...';
	mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
}
?>