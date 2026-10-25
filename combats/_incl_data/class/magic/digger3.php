<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'digger3' && $itm['iznosNOW'] < $itm['iznosMAX']) {
	//
	if( $itm['gift'] == '0' || $itm['gift'] == '0' ) {
		$u->error = 'Использовать возможно, только если вам подарят этот предмет!';
	}else{
		//8765
		$itm['tpjjj'] = 1;
		$itm['tpiii'] = 862;
		//
		mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `data` LIKE "%itempltype='.$itm['tpjjj'].'%"');
		//
		mysql_query('INSERT INTO `eff_users`
		(`overType`,`timeUse`,`hod`,`name`,`data`,`uid`, `id_eff`, `img2`, `timeAce`, `v1`, `no_Ace`) VALUES (
			"0","'.time().'","-1",
			"Золотой комплект: '.$itm['name'].'","itempl='.$itm['item_id'].'|add_speed_dungeon=50|add_speedhp=50|itempltype='.$itm['tpjjj'].'","'.$u->info['id'].'",
			"'.$itm['tpiii'].'", "spell_item_illusion.gif","0", "0","1"
		)');
		//
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
		$itm['iznosNOW']--;
		//
		$u->error = 'Вы использовали &quot;'.$itm['name'].'&quot; и облачились в Комплект землекопа!';
	}
}
?>