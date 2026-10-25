<?
if(!defined('GAME'))
{
	die();
}

if(isset($po['finish_file']) && $po['finish_file']=='books')
{
	//Добавляем слот
	mysql_query('UPDATE `actions` SET `val` = "cast" WHERE (`vals` = "1053") AND `val` != "cast" AND `vars` = "read"  AND `uid` = "'.$u->info['id'].'" LIMIT 1');
}else{
	$st['timeRead'] = 0;
	//$tst = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` > '.time().' AND `vars` = "read" LIMIT 1',1);
	if(isset($tst['id']))
	{
		//Уже что-то изучаем
		$u->error = 'Так не пойдет, вы уже что-то изучаете';
	}else{
		$tst = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "read" AND `vals` = "'.$itm['item_id'].'" LIMIT 1',1);
		if(isset($tst['id']))
		{
			$u->error = 'Вы уже изучили данное знание';
		}else{
			$fn = ''; $tom_iz = 0;
			if(($itm['item_id']>=1053))
			{
				$tst2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "read" AND `vals` = "'.($itm['item_id']-1).'" LIMIT 1',1);
				if(!isset($tst2['id']))
				{
					$tom_iz = 1;
				}
				unset($tst2);
			}
			
			if($tom_iz==0)
			{
				if(($itm['item_id']>=1053))
				{
					mysql_query('INSERT TO `priems` SET `activ` = `1053` WHERE `id` = "139" LIMIT 1');
					mysql_query('UPDATE `priems` SET `activ` = `1053` WHERE `id` = "139" LIMIT 1');
					
					$fn .= 'finish_file=books';
				}
				
					$u->error = 'Вы изучили &quot;'.$itm['name'].'&quot;.';
					$u->addAction(time()+$st['timeRead'],'read',$itm['item_id']);
					mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
				//}else{
				//	$u->error = 'Что-то здесь не так';
				//}
			}else{
				$u->error = 'Требует изучения предыдущего тома';
			}
			unset($tom_iz);
		}
	}
}
?>