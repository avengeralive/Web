<?
//Воскрешение - 77
if(!defined('GAME')) 
	
	{ die(); }
	
if( $itm['magic_inci'] == 'rise' ) {

if($u->info['battle']==0) $u->error = 'Использовать заклятие можно только в бою.';
elseif($u->info['tactic7']<5) $u->error = 'У вас недостаточно духа для использования заклятия.';
else {
		$usr_s = mysql_fetch_array(mysql_query('SELECT `hpNow`, `mpNow` FROM `stats` WHERE `id` = "'.$usr['id'].'" LIMIT 1'));

		if($usr_s['hpNow'] > 0 && $usr_s['mpNow'] > 0) $u->error = 'Игрок еще не погиб.';
		else {
			$u->error = 'Заклятие использовано успешно!';

			//Воскрешаем
	        mysql_query('UPDATE `stats` SET `hpNow` = `hpAll`, `mpNow` = `mpAll` WHERE `id` = "'.$usr['id'].'" LIMIT 1');
	        //$btl->users[$btl->uids[$usr['id']]]['hpNow'] = ;
	        //$btl->users[$btl->uids[$usr['id']]]['mpNow'] = ;

			//Тратит 20 духа
            $tr_tactic7 = ($u->info['tactic7'] > 74 ? 10 : 5);
			$btl->users[$btl->uids[$u->info['id']]]['tactic7'] -= $tr_tactic7;
	        if($btl->users[$btl->uids[$u->info['id']]]['tactic7'] < 0) $btl->users[$btl->uids[$u->info['id']]]['tactic7'] = 0;
	        $u->info['tactic7'] = $btl->users[$btl->uids[$u->info['id']]]['tactic7'];
	        $u->stats['tactic7'] = $btl->users[$btl->uids[$u->info['id']]]['tactic7'];

			mysql_query('UPDATE `stats` SET `tactic7` = "'.$btl->users[$btl->uids[$u->info['id']]]['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');

			if( $btl->stats[$btl->uids[$usr['id']]]['s7'] > 99 )//Смерть очищает вас от негативных эффектов заклинаний, проклятий, болезней и ядов в текущем бою
			{
                    $pvr_no =  ' AND `a`.`v2` NOT IN (31,307,191,280,201,260,237,282,237,42,121,122,123,124,125,186,246,257,281,292,21,73,74)';

					$pvr_no .= ' AND `a`.`name` NOT LIKE "Оледенение%" ';
					$pvr_no .= ' AND `a`.`name` NOT LIKE "Метеорит%" ';
					$pvr_no .= ' AND `a`.`name` NOT LIKE "Уязвимость Оружию%" ';
					$pvr_no .= ' AND `a`.`name` NOT LIKE "Уязвимость Стихиям%" ';
					$pvr_no .= ' AND `a`.`name` NOT LIKE "Чары%" ';

					//$pvr_no .= ' AND `a`.`name` NOT LIKE "Регенерация%" ';
					//$pvr_no .= ' AND `a`.`name` NOT LIKE "Туманный образ%" ';
					//$pvr_no .= ' AND `a`.`name` NOT LIKE "Жертва%" ';
					//$pvr_no .= ' AND `a`.`name` NOT LIKE "Призрачн%" ';
                    //$pvr_no .= ' AND `a`.`name` NOT LIKE "Серое Мастерство%" ';

					$sp3 = mysql_query('SELECT `a`.`id` FROM `eff_users` AS `a` LEFT JOIN `priems` AS `b` ON `b`.`id` = `a`.`v2`
					WHERE `a`.`uid` = "'.$usr['id'].'" AND `a`.`delete` = 0 AND `a`.`v1` = "priem" '.$pvr_no.' AND ( (`b`.`neg` > 0 AND `a`.`v2` != 260)
					OR `a`.`v2` = 191 OR ( `a`.`v2` = 260 AND `a`.`data` NOT LIKE "%add_mg2static_points=0%"  ) ) ORDER BY `a`.`id` DESC LIMIT 1');

					while( $pl = mysql_fetch_array($sp3) )
					{
                        mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
						//el('снимаем: '.$pl['id']);
					}

            }

			
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1, `delete`="'.time().'" WHERE `id` = "'.$itm['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');
            mysql_query('UPDATE `items_users_fast` SET `iznosNOW` = `iznosNOW` + 1, `delete`="'.time().'" WHERE `id` = "'.$itm['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');

			if($u->info['battle']!=0)
			{
				//Потратил свой ход на магию
				$a1 = mysql_fetch_assoc(mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$u->info['battle'].'"
				AND `uid2` = "'.$u->info['id'].'" AND `uid1` = "'.$u->info['enemy'].'" LIMIT 1'));

				$a2 = mysql_fetch_assoc(mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$u->info['battle'].'"
				AND `uid1` = "'.$u->info['id'].'" AND `uid2` = "'.$u->info['enemy'].'" LIMIT 1'));

				if(!isset($a2['id']))//Если игрок еще не ударил
				{
					if(isset($a1['id']))
					{
						//противник ударил, пишем что игрок 2 пропустил ход
						mysql_query('UPDATE `battle_act` SET `out2` = "1",`tpo2` = "2" WHERE `id` = "'.$a1['id'].'" LIMIT 1');
						$a1['out2'] = 1;
						$a1['tpo2'] = 2;
						$btl->atacks[$a1['id']] = $a1;
						$btl->users[$u->info['id']]['priems_z'] = $u->info['priems_z'];
						$btl->startAtack($a1['id']);
					} else {
		                        //бьем противника с пропуском хода
		                        $minitime = round(microtime(true) * 1000);
								mysql_query('INSERT INTO `battle_act` (`battle`,`uid1`,`uid2`,`time`,`minitime`,`out1`,`type`,`tpo1`)
								VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.$u->info['enemy'].'","'.time().'","'.$minitime.'","1","1","2")');
					}
				}

				//В лог боя
	         	$lastHOD = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
				if(isset($lastHOD['id']))
				{
					$id_hod = $lastHOD['id_hod'];
	                $btxt = '{u1} использовал заклятье &quot;<b>'.$itm['name'].'</b>&quot; на '.$usr['login'].'.';

					mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`)
					VALUES ("'.time().'","'.$u->info['battle'].'","'.($id_hod).'","{tm1} '.$btxt.'","login1='.$u->info['login'].'||t1='.$u->info['team'].'||login2='.$u->info['login'].'||t2='.$u->info['team'].'||time1='.time().'","","","","","6")');
				}
			}
		}
}

}
?>