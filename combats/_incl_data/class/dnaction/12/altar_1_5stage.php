<?
if( isset($s[1]) && $s[1] == '12/altar_1_5stage' )
{
	/*
		Сундук: Алтарь Осколков
		# '4443', '4444', '4445' = 4446
		# '4517', '4518', '4519', '4520', '4521' = 4522
	*/
	//Все переменные сохранять в массиве $vad !
	$vad = array(
		'portal_items' => array(0=>0, 1=>0, 2=>0),
		'rune_items' => array(0=>0, 1=>0, 2=>0, 3=>0, 4=>0)
	);
    $r ='';

	//Ключ портала
    $has_item = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid`="'.$u->info['id'].'" AND `item_id`="4446" AND `delete` = "0" LIMIT 1'));
    $has_item2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `dungeon_items` WHERE `dn`="'.$this->info['id'].'" AND `user`="'.$u->info['id'].'" AND `item_id`="4446" AND `delete` = "0" AND `take`="0" LIMIT 1'));

    if(!isset($has_item['id']) && !isset($has_item2['id']))
	{
		//dStart();
		$vad['portal_q'] = mysql_query('SELECT `id`,`item_id` FROM `items_users` WHERE `item_id` IN (4443, 4444, 4445) AND `uid` = "'.$u->info['id'].'"
		AND `delete` = "0" AND `inOdet` = "0" AND `inShop` = "0" AND `inTransfer` = "0" GROUP BY item_id LIMIT 3');

		while($vad['sp'] = mysql_fetch_array($vad['portal_q']) )
		{
			if($vad['sp']['item_id'] == '4443')	   {$vad['portal_items'][0] = $vad['sp']['id'];}
			elseif($vad['sp']['item_id'] == '4444'){$vad['portal_items'][1] = $vad['sp']['id'];}
			elseif($vad['sp']['item_id'] == '4445'){$vad['portal_items'][2] = $vad['sp']['id'];}
		}

		if( $vad['portal_items'][2]!=0 AND $vad['portal_items'][1]!=0 AND $vad['portal_items'][0]!=0 )
		{
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`)
			VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","altar_keyportal'.$obj['id'].'","'.$vad['bad'].'")');

			foreach($vad['portal_items'] as $vad['row']){$u->deleteItem($vad['row'],$u->info['id'],1);}

			$this->pickitem($obj,4446,$u->info['id'],'|sudba='.$u->info['login'], false);//sudba=-1
			$r .= 'Вы использовали &quot;'.$obj['name'].'&quot; и собрали &quot;Ключ Портала&quot; из трех частей... ';
		}
        //dPrint(true);
	} else {$r .= (isset($has_item['id']) ? 'У вас уже есть один ключ портала... ' : 'Не больше одного ключа портала за один поход... ');}

	//Отпирающая руна
	$has_item = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid`="'.$u->info['id'].'" AND `item_id`="4522" AND `delete` = "0" LIMIT 1'));
    $has_item2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `dungeon_items` WHERE `dn`="'.$this->info['id'].'" AND `user`="'.$u->info['id'].'" AND `item_id`="4522" AND `delete` = "0" AND `take`="0" LIMIT 1'));

	if(!isset($has_item['id']) && !isset($has_item2['id']))
	{
        //dStart();
		$vad['rune_q'] = mysql_query('SELECT `id`,`item_id` FROM `items_users` WHERE `item_id` IN (4517, 4518, 4519, 4520, 4521) AND `uid` = "'.$u->info['id'].'"
		AND `delete` = "0" AND `inOdet` = "0" AND `inShop` = "0" AND `inTransfer` = "0" GROUP BY item_id LIMIT 5');

		while($vad['sp'] = mysql_fetch_array($vad['rune_q']))
		{
			if($vad['sp']['item_id'] == '4517')	   {$vad['rune_items'][0] = $vad['sp']['id'];}
			elseif($vad['sp']['item_id'] == '4518'){$vad['rune_items'][1] = $vad['sp']['id'];}
			elseif($vad['sp']['item_id'] == '4519'){$vad['rune_items'][2] = $vad['sp']['id'];}
			elseif($vad['sp']['item_id'] == '4520'){$vad['rune_items'][3] = $vad['sp']['id'];}
			elseif($vad['sp']['item_id'] == '4521'){$vad['rune_items'][4] = $vad['sp']['id'];}
		}

		if( $vad['rune_items'][4]!=0 AND $vad['rune_items'][3]!=0 AND $vad['rune_items'][2]!=0 AND $vad['rune_items'][1]!=0 AND $vad['rune_items'][0]!=0 )
		{
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`)
			VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","altar_keyrune'.$obj['id'].'","'.$vad['bad'].'")');

			foreach($vad['rune_items'] as $vad['row']){$u->deleteItem($vad['row'],$u->info['id'],1);}

			$this->pickitem($obj,4522,$u->info['id'],'|sudba='.$u->info['login'], true);//sudba=-1
			$r .= 'Вы использовали &quot;'.$obj['name'].'&quot; и собрали &quot;Отпирающая руна&quot; из пяти частей... ';
		}
        //dPrint(true);
	} else {$r .= (isset($has_item['id']) ? 'У вас уже есть одна отпирающая руна... ' : 'Не больше одной отпирающей руны за один поход... ');}

	if($r==''){$r = 'Ничего не получилось... ';}
	
	unset($vad);
}
?>