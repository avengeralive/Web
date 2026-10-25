<?
if(!defined('GAME'))
{
	die();
}

//Выдаем предметы, но не раньше 00:00:00 01-01-2013
if(date('Y')==2018) {
	/*

2. Новогодний Шоколад (полное вост. хп) 
3. Новогодняя Открытка 
4. Зелье -Бойцовский Дух- (мощ урона/магии +10, хп +60) 

7. Новогодний Эликсир
	*/	
	//Снежок 0/13 (x1)
	$idit = $u->addItem(4056,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
	if($idit > 0) {
		mysql_query('UPDATE `items_users` SET `gift` = "Позвольте вас поздравить с праздником весны, красоты и любви - с 8-м Марта!",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
				
		//Открытка (x1)
		$idit = $u->addItem(9099,$u->info['id'],'|noremont=1|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "8 Марта" , `gtxt1` = "Позвольте вас поздравить с праздником весны, красоты и любви - с 8-м Марта! Пусть сегодня ваша душа до краев наполнится светом, теплом и радостью от искренних пожеланий, нежных цветов, приятных подарков! Пусть ласточки вьют гнезда над вашими окнами и несут в дом благополучие и взаимопонимание, а первые лучи весеннего солнышка укажут на счастливую тропинку вашей судьбе! Администрация проекта" WHERE `id` = "'.$idit.'" LIMIT 1');	
		
		//Благословление Ангелов 5
		$idit = $u->addItem(7308,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Позвольте вас поздравить с праздником весны, красоты и любви - с 8-м Марта!",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Восстановление Энергии 900НР (x3)
		$idit = $u->addItem(2710,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Позвольте вас поздравить с праздником весны, красоты и любви - с 8-м Марта!",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Благословение
		$idit = $u->addItem(7304,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Позвольте вас поздравить с праздником весны, красоты и любви - с 8-м Марта!",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Мягкая Поступь(15)
		$idit = $u->addItem(5033,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Позвольте вас поздравить с праздником весны, красоты и любви - с 8-м Марта!",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Неуязвимость Оружию +150
		$idit = $u->addItem(4936,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Позвольте вас поздравить с праздником весны, красоты и любви - с 8-м Марта!",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Неуязвимость Стихиям +150
		$idit = $u->addItem(4937,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Позвольте вас поздравить с праздником весны, красоты и любви - с 8-м Марта!",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Новогодняя Елка
		$idit = $u->addItem(9100,$u->info['id'],'|noremont=1|srok=204800|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Позвольте вас поздравить с праздником весны, красоты и любви - с 8-м Марта!",`iznosMAX` = "999999999" WHERE `id` = "'.$idit.'" LIMIT 1');

		$u->error = 'Вы успешно использовали &quot;'.$itm['name'].'&quot;. В инвентарь добавлены подарки. Позвольте вас поздравить с праздником весны, красоты и любви - с 8-м Марта!';
		mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE (`item_id` = "2763" OR `id` = "'.$itm['id'].'") AND `uid` = "'.$u->info['id'].'" LIMIT 10');
	}
}else{
	$u->error = 'Подарок возможно использовать не раньше 01.01.2018';
}

?>