<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'bochonok' && $itm['iznosNOW'] < $itm['iznosMAX']) {
	//
	if( $itm['gift'] == '0' || $itm['gift'] == '0' ) {
		$u->error = 'Использовать возможно, только если вам подарят этот предмет!';
	}else{
		//
		if( $itm['item_id'] == 993)
		{
		mysql_query('INSERT INTO `eff_users`
		(`overType`,`timeUse`,`hod`,`name`,`data`,`uid`, `id_eff`, `img2`, `timeAce`, `v1`) VALUES (
			"0","'.time().'","-1",
			"Бочонок Эликсира:",add_s1=5|add_s2=5|add_s3=5,"'.$u->info['id'].'",
			"0", "bachonok.gif","0", "0"
		)');
		//
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
		$itm['iznosNOW']--;
		//
		$u->error = 'Вы напились &quot;'.$itm['name'].'&quot; и вас потянуло на подвиги!';
	}
}
?>