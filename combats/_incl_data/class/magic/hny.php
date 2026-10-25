<?
if(!defined('GAME')) die();

//Âûäàåì ïğåäìåòû, íî íå ğàíüøå ÍÃ
if((date('n')==12 && date('j')==31 && date('H')==23 && date('i') > 58) || date('n') < 2)
//if((date('n')==12 && date('j')==10 && date('H')==16 && date('i') > 0) || date('n') < 3)
{
	$year = (date('n')==12 ? date('Y')+1 : date('Y'));
	//Ñíåæîê 0/13 (x1)
	$idit = $u->addItem(1000,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
	if($idit > 0)
	{
		mysql_query('UPDATE `items_users` SET `gift` = "Ñòàğûé Ãîä",`iznosMAX` = "15" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Íîâîãîäíèé ıëèêñèğ (x1)
		$idit = $u->addItem(997,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Ñòàğûé Ãîä",`iznosMAX` = "2" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Íîâîãîäíèé ıëèêñèğ (x1)
		$idit = $u->addItem(2870,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Ñòàğûé Ãîä",`iznosMAX` = "2" WHERE `id` = "'.$idit.'" LIMIT 1');

		//Çâåçäíàÿ Òÿæåñòü (x1)
		$idit = $u->addItem(1462,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Ñòàğûé Ãîä",`iznosMAX` = "2" WHERE `id` = "'.$idit.'" LIMIT 1');
				
		//Îòêğûòêà (x1)
		$idit = $u->addItem(996,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Íîâûé Ãîä" , `gtxt1` = "Àäìèíèñòğàöèÿ ïğîåêòà ïîçäğàâëÿåò Âàñ ñ Íîâûì, '.$year.', Ãîäîì!"
		WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Çåëåíûé âñïëåêñê 0/25 , 4055
		$idit = $u->addItem(4055,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Ñòàğûé Ãîä",`iznosMAX` = "10" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Âîññòàíîâëåíèå İíåğãèè 900ÍĞ (x3)
		$idit = $u->addItem(2710,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Ñòàğûé Ãîä",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Áëàãîñëîâåíèå
		$idit = $u->addItem(4466,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Ñòàğûé Ãîä",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Ìÿãêàÿ Ïîñòóïü(15)
		$idit = $u->addItem(5033,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Ñòàğûé Ãîä",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Íåóÿçâèìîñòü Îğóæèş +150
		$idit = $u->addItem(4936,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Ñòàğûé Ãîä",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Íåóÿçâèìîñòü Ñòèõèÿì +150
		$idit = $u->addItem(4937,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Ñòàğûé Ãîä",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$u->error = 'Âû óñïåøíî èñïîëüçîâàëè &quot;'.$itm['name'].'&quot;. Â èíâåíòàğü äîáàâëåíû ïîäàğêè. Ñ Íîâûì, '.$year.', Ãîäîì!';

		mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');
	}
} else $u->error = 'Ïîäàğîê âîçìîæíî èñïîëüçîâàòü íå ğàíüøå 31.12.'.date('Y').' 23:59';

?>