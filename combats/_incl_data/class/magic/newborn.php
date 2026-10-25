<?
if(!defined('GAME'))
{
	die();
}
	//Чек 10 екр
	$idit = $u->addItem(5020,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
	if($idit > 0) {
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Плащ новичка (x1)
		$idit = $u->addItem(3200,$u->info['id'],'|srok=2591999|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "50" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Великое зелье Стойкости
		$idit = $u->addItem(1186,$u->info['id'],'|noremont=1|srok=2591999|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Великое зелье Отрицания
		$idit = $u->addItem(1188,$u->info['id'],'|noremont=1|srok=2591999|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
				
		//Тактика Боя: 5
		$idit = $u->addItem(4247,$u->info['id'],'|noremont=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');	
		
		//Тактика Защиты: 5
		$idit = $u->addItem(4252,$u->info['id'],'|noremont=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Тактика Крови: 5
		$idit = $u->addItem(4257,$u->info['id'],'|noremont=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Тактика Ответа: 5
		$idit = $u->addItem(4262,$u->info['id'],'|noremont=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Тактика Отражения: 5
		$idit = $u->addItem(4267,$u->info['id'],'|noremont=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Защита от Магии
		$idit = $u->addItem(4941,$u->info['id'],'|noremont=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Магическое Усиление
		$idit = $u->addItem(4942,$u->info['id'],'|noremont=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Защита от оружия
		$idit = $u->addItem(1001,$u->info['id'],'|noremont=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Сокрушение
		$idit = $u->addItem(994,$u->info['id'],'|noremont=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Жажда Жизни +6
		$idit = $u->addItem(3101,$u->info['id'],'|noremont=1|nosale=1|notransfer=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Нектар Великана
		$idit = $u->addItem(4037,$u->info['id'],'|noremont=1|srok=2591999|nosale=1|notransfer=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Нектар Змеи
		$idit = $u->addItem(4040,$u->info['id'],'|noremont=1|srok=2591999|nosale=1|notransfer=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Нектар Предчувствия
		$idit = $u->addItem(4038,$u->info['id'],'|noremont=1|srok=2591999|nosale=1|notransfer=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Нектар Разума
		$idit = $u->addItem(4039,$u->info['id'],'|noremont=1|srok=2591999|nosale=1|notransfer=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
				
		$u->error = 'Вы успешно использовали &quot;'.$itm['name'].'&quot;. В инвентарь добавлены предметы. Удачных боев, собрат!';
		mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE (`item_id` = "8777" OR `id` = "'.$itm['id'].'") AND `uid` = "'.$u->info['id'].'" LIMIT 25');
	}

?>