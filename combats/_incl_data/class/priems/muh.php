<?
if(!defined('GAME'))
{
	die();
}

if($st['usefromfile']=='muh' && $u->info['battle'] > 0 && $u->info['hpNow'] >= 1)
{
	if($btl->info['team_win'] != -1 ) {
		$u->error = 'Использовать пирожки возможно только во время боя';
	}else{
		$bu = mysql_fetch_array(mysql_query('SELECT * FROM `pirogi` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
		if(isset($bu['id'])) {
			$u->error = 'Нельзя использовать пирожки так часто! Осталось ходов: '.$bu['hod'].'';
		}else{			
				
				mysql_query('INSERT INTO `pirogi` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","7")');

				
				if( $itm['magic_inci'] == 449  ) {
					$txt = ' В результате персонаж &quot;{u2}&quot; был подвержен действию &quot;<b>Сушеный Мухомор</b>&quot;.';
					//
					$txt = '';
					if( isset($mgp['id']) ) {
						$mgp['x']++;
						$mgp['hod']++;
						$txt = ' (x'.$mgp['x'].')';
					}
					if(isset($mgp['id'])) {
						mysql_query('UPDATE `eff_users` SET `hod` = "'.$mgp['hod'].'", `x` = "'.$mgp['x'].'" WHERE `id` = "'.$mgp['id'].'" LIMIT 1');
					}else{
						mysql_query('INSERT INTO `eff_users` (
						`hod`, `v2`, `img2`, `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `v1`, `user_use`
						) VALUES (
						"7", "328", "invoke_kar3_mush.gif", 22, "'.$u->info['id'].'", "Сушеный Мухомор", "add_m10=40|add_m11=40|add_za=-60|add_zma=-60", 0, "77", "priem", "'.$u->info['id'].'"
						)');
					}
				}
				
				if($u->info['sex']==1) {
					$txt = '{u1} применила заклинание &quot;<b>'.$itm['name'].'</b>&quot;. '.$txt.'';
				}else{
					$txt = '{u1} применил заклинание &quot;<b>'.$itm['name'].'</b>&quot;. '.$txt.'';
				}
				$lastHOD = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
				$id_hod = $lastHOD['id_hod'];
				if($lastHOD['type']!=6) {
						$id_hod++;
				}
				//
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.time().'","'.$u->info['battle'].'","'.($id_hod).'","{tm1} '.$txt.'","login1='.$u->info['login'].'||t1='.$u->info['team'].'||time1='.time().'||login2='.$u->info['login'].'||t2='.$u->info['team'].'||time2='.time().'","","","","","6")');
				//
				mysql_query('UPDATE `items_users` SET `iznosNow` = `iznosNow` + 0 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
				mysql_query('DELETE FROM `items_users` WHERE `iznosNOW` >= `iznosMAX` AND `id` = "'.$itm['id'].'" LIMIT 1');
}
	}
}

?>