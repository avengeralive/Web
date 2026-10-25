<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'suvenir' && $itm['iznosNOW'] < $itm['iznosMAX']) {
	//
	if( $itm['gift'] == '0' || $itm['gift'] == '0' ) {
		$u->error = 'Использовать возможно, только если вам подарят этот предмет!';
	}else{
		//
		$itm['tpjjj'] = 1;
		$itm['tpiii'] = 1000;
		if( $itm['item_id'] == 993)
		{
		}
		//
		mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `data` LIKE "%itempltype='.$itm['tpjjj'].'%"');
		//
		mysql_query('INSERT INTO `eff_users`
		(`overType`,`timeUse`,`hod`,`name`,`data`,`uid`, `id_eff`, `img2`, `timeAce`, `v1`) VALUES (
			"0","'.time().'","-1",
			"Иллюзия: '.$itm['name'].'","itempl='.$itm['item_id'].'|add_s1=5|add_s2=5|add_s3=5|itempltype='.$itm['tpjjj'].'","'.$u->info['id'].'",
			"'.$itm['tpiii'].'", "bachonok.gif","0", "0"
		)');
		//
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
		$itm['iznosNOW']--;
		//
		$u->error = 'Вы использовали &quot;'.$itm['name'].'&quot; и облачились в красивые одеяния!';
	}
}
?>