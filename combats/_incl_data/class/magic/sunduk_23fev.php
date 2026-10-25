<?
if(!defined('GAME'))
{
	die();
}

	//лечение легких травм
	$ov_item = $u->addItem(9085);
	if($ov_item > 0) {
		mysql_query('UPDATE `items_users` SET `iznosMAX` = "1" WHERE `id` = "'.$ov_item.'" LIMIT 1');
		
		//пропуск забытых
		$ov_item = $u->addItem(9084);
		mysql_query('UPDATE `items_users` SET `iznosMAX` = "1" WHERE `id` = "'.$ov_item.'" LIMIT 1');
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
		
		$u->error = 'Вы получили предметы:';
		
	}

?>