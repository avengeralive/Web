<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'bugaiv' ) {	
	do_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'"	AND (`id_eff` = "99066" OR `id_eff` = "99067")');
if( $itm['item_id'] == 10431 ) {
		do_query("INSERT INTO `eff_users` (
			`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`
		) VALUES (99066, '".$u->info['id']."', 'Дыхание Отмороженного Бугая (Воин)','add_s1=3|add_s2=3|add_s3=3|add_s4=3|add_s5=3|add_hpAll=500|speedhp=200|add_exp=25', 8956, ".time().", 0, '".$u->info['login']."', 0, '0', 0, '', 1, -1, '0', 0, 0, '', 0, 0, 0, 0
		);");
		do_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
		$u->error = '<font style="font-size:8pt;">Вы успешно использовали: "'.$itm['name'].'" на себя '.$u->microLogin($u->info['id'],1).'</font>';

	}
}
?>