<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'addmoney' ) {
	if( $u->info['align'] != 2 ) {
		if( $itm['4price'] > 0 ) {
			$u->info['money4'] += $itm['4price'];
			mysql_query('UPDATE `users` SET `money4` = `money4` + "'.$itm['4price'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}elseif( $itm['2price'] > 0 ) {
			$u->info['money2'] += $itm['2price'];
			mysql_query('UPDATE `users` SET `money2` = `money2` + "'.$itm['2price'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');	
		}elseif( $itm['1price'] > 0 ) {
			$u->info['money'] += $itm['1price'];
			mysql_query('UPDATE `users` SET `money` = `money` + "'.$itm['1price'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}elseif( $itm['price4'] > 0 ) {
			$u->info['money4'] += $itm['price4'];
			mysql_query('UPDATE `users` SET `money4` = `money4` + "'.$itm['price4'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}elseif( $itm['price2'] > 0 ) {
			$u->info['money2'] += $itm['price2'];
			mysql_query('UPDATE `users` SET `money2` = `money2` + "'.$itm['price2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');	
		}elseif( $itm['price1'] > 0 ) {
			$u->info['money'] += $itm['price1'];
			mysql_query('UPDATE `users` SET `money` = `money` + "'.$itm['price1'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}
		//
		if( $itm['4price'] > 0 ) {
			$u->error = 'Вы успешно обналичили чек на '.$u->zuby($itm['4price'],1).'';
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
		}elseif( $itm['2price'] > 0 ) {
			$u->error = 'Вы успешно обналичили чек на '.$itm['2price'].' екр.';
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');	
		}elseif( $itm['1price'] > 0 ) {
			$u->error = 'Вы успешно обналичили чек на '.$itm['1price'].' кр.';
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
		}elseif( $itm['price4'] > 0 ) {
			$u->error = 'Вы успешно обналичили чек на '.$u->zuby($itm['price4'],1).'';
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
		}elseif( $itm['price2'] > 0 ) {
			$u->error = 'Вы успешно обналичили чек на '.$itm['price2'].' екр.';
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');	
		}elseif( $itm['price1'] > 0 ) {
			$u->error = 'Вы успешно обналичили чек на '.$itm['price1'].' кр.';
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
		}else{
			$u->error = 'Баговый чек! Напишите Администрации!';
		}
	}else{
		$u->error = 'Хаосники не могут обналичивать чек!';
	}
}
?>