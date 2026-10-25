<?
if(!defined('GAME'))
{
	die();
}

	//лечение легких травм
	$ov_item = $u->addItem(875,$u->info['id'],'|srok=3200|sudba='.$u->info['login'].'');
	if($ov_item > 0) {
		mysql_query('UPDATE `items_users` SET `iznosMAX` = "1" WHERE `id` = "'.$ov_item.'" LIMIT 1');
		
		//пропуск забытых
		$ov_item = $u->addItem(2412,$u->info['id'],'|srok=43200|battleUseZd=7200|sudba='.$u->info['login'].'');
		mysql_query('UPDATE `items_users` SET `iznosMAX` = "1" WHERE `id` = "'.$ov_item.'" LIMIT 1');
		//жж6
		$ov_item = $u->addItem(3101,$u->info['id'],'|srok=3600|battleUseZd=7200|sudba='.$u->info['login'].'');
		mysql_query('UPDATE `items_users` SET `iznosMAX` = "1" WHERE `id` = "'.$ov_item.'" LIMIT 1');
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
		
		$u->error = 'Вы получили предметы:<br> Лечение легких травм, пропуск забытых, Жажда жизни +6</b>';
		
	}

?>