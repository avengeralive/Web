<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'bugai' ) {	
	do_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'"	AND (`id_eff` = "99066" OR `id_eff` = "99067")');
if( $itm['item_id'] == 10432 ) {
		do_query("INSERT INTO `eff_users` (
			`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`
		) VALUES (99067, '".$u->info['id']."', 'Дыхание Отмороженного Бугая (Маг)', 'add_s5=10|add_hpAll=200|add_mpAll=500|speedmp=200|add_exp=25', 8956, ".time().", 0, '".$u->info['login']."', 0, '0', 0, '', 1, -1, '0', 0, 0, '', 0, 0, 0, 0
		);");
		do_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
		$u->error = '<font style="font-size:8pt;">Вы успешно использовали: "'.$itm['name'].'" на себя '.$u->microLogin($u->info['id'],1).'</font>';
	}
}
?>