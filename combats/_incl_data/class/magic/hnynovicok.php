<?
if(!defined('GAME'))
{
	die();
}

//Выдаем предметы, но не раньше 00:00:00 01-01-2013
	/*

2. Новогодний Шоколад (полное вост. хп) 
3. Новогодняя Открытка 
4. Зелье -Бойцовский Дух- (мощ урона/магии +10, хп +60) 

7. Новогодний Эликсир
	*/	
	//Снежок 0/13 (x1)
	$idit = $u->addItem(3101,$u->info['id']);{
	if($idit > 0) {
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Новогодний эликсир (x1)
		$idit = $u->addItem(4390,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Новогодний эликсир (x1)
		$idit = $u->addItem(4466,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "2" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Звездное сияние (x1)
		$idit = $u->addItem(4541,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
				
		//Открытка (x1)
		$idit = $u->addItem(4738,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Нападалка 0/13 (x1)
		$idit = $u->addItem(5050,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Кольцо жизни (x1)
		$idit = $u->addItem(1461,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "4" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Восстановление Энергии 900НР (x3)
		$idit = $u->addItem(1460,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "4" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(1462,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "4" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(1463,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "4" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(2141,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "4" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(2142,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "4" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(2143,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "2" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(2144,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "2" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(3044,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "4" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(3075,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "4" WHERE `id` = "'.$idit.'" LIMIT 1');
		//Восстановление Энергии 900НР (x3)
		$idit = $u->addItem(3077,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(3078,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(3079,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(3080,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(3081,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(3082,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(5008,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "3" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(5009,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "3" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(5010,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "3" WHERE `id` = "'.$idit.'" LIMIT 1');
		//Восстановление Энергии 900НР (x3)
		$idit = $u->addItem(5069,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(4514,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "3" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(4515,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "3" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(4038,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(4039,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(4040,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(4037,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(4056,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "3" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(4057,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "С Открытием Проекта primebk",`iznosMAX` = "3" WHERE `id` = "'.$idit.'" LIMIT 1');
				
		$u->error = 'Вы успешно использовали &quot;'.$itm['name'].'&quot;. В инвентарь добавлены подарки. С Открытием Проекта primebk!';
		mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE (`item_id` = "2763" OR `id` = "'.$itm['id'].'") AND `uid` = "'.$u->info['id'].'" LIMIT 10');
	}
}else{
	$u->error = 'Не удалось использовать &quot;'.$itm['name'].'&quot;. Подарок возможно использовать ';
}

?>