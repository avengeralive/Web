<?
if(!defined('GAME'))
{
	die();
}
		//Жажда Жизни +6
	$idit = $u->addItem(3101,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
	if($idit > 0) {
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Звездная Энергия
		$idit = $u->addItem(1461,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "4" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Звездное Сияние
		$idit = $u->addItem(1463,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "4" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Благословение
		$idit = $u->addItem(4466,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "3" WHERE `id` = "'.$idit.'" LIMIT 1');
				
		//Неуязвимость Оружию
		$idit = $u->addItem(2143,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');	
		
		//Неуязвимость Стихиям
		$idit = $u->addItem(2144,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Снадобье Забытых Мастеров
		$idit = $u->addItem(4041,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Эликсир Магического Искусства
		$idit = $u->addItem(4948,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Нектар Великана
		$idit = $u->addItem(4037,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Нектар Предчувствия
		$idit = $u->addItem(4038,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Нектар Разума
		$idit = $u->addItem(4039,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Нектар Змеи
		$idit = $u->addItem(4040,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Бутерброд -The best Friends-
		$idit = $u->addItem(5010,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Сокрушение
		$idit = $u->addItem(994,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Защита от оружия
		$idit = $u->addItem(1001,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Защита от Магии
		$idit = $u->addItem(4941,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Зелье Каменной Стойкости
		$idit = $u->addItem(4514,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "3" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Зелье Стража Магии
		$idit = $u->addItem(4515,$u->info['id'],'|noremont=1|notransfer=1|nomodif=1|auc=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Удача",`iznosMAX` = "3" WHERE `id` = "'.$idit.'" LIMIT 1');
				
		$u->error = 'Вы успешно использовали &quot;'.$itm['name'].'&quot;. В инвентарь добавлены предметы. Удачных боев, собрат!';
		mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE (`item_id` = "8777" OR `id` = "'.$itm['id'].'") AND `uid` = "'.$u->info['id'].'" LIMIT 25');
	}

?>