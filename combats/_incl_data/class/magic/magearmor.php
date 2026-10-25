<?
//’рустальный щит - 4605
if(!defined('GAME')) die();
//учесть расход маны с жертвой воде и посохом???
$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "magearmor" AND `time` > "'.time().'" LIMIT 1'));
if(isset($test['id'])) {
	$u->error = 'Ќельз€ использовать это закл€тие чаще чем раз в 15 минут!';
}elseif($u->stats['mpNow']<500) {
	$u->error = '” вас недостаточно маны дл€ использовани€ закл€ти€.';
}else{
		$u->error = '«акл€тие использовано успешно!';

		if($u->info['level']==8) $tt4 = 3;
		elseif($u->info['level']==9) $tt4 = 5;
        else $tt4 = 10;

		$btl->users[$btl->uids[$u->info['id']]]['tactic4'] += $tt4;
        $u->info['tactic4'] = $btl->users[$btl->uids[$u->info['id']]]['tactic4'];
		$btl->users[$btl->uids[$u->info['id']]]['mpNow'] -= 500;
		if($btl->users[$btl->uids[$u->info['id']]]['mpNow'] < 0) $btl->users[$btl->uids[$u->info['id']]]['mpNow'] = 0;
        $u->stats['mpNow'] = $btl->users[$btl->uids[$u->info['id']]]['mpNow'];
        $u->info['mpNow'] = $btl->users[$btl->uids[$u->info['id']]]['mpNow'];

		mysql_query('UPDATE `stats` SET `tactic4` = "'.$btl->users[$btl->uids[$u->info['id']]]['tactic4'].'",
		`mpNow`="'.$btl->users[$btl->uids[$u->info['id']]]['mpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');

		$u->addAction( time()+900, 'magearmor', $usr['id'],$u->info['id']);

        mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');

		if($u->info['battle']!=0)
		{
			//ѕотратил свой ход на магию
			$a1 = mysql_fetch_assoc(mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$u->info['battle'].'"
			AND `uid2` = "'.$u->info['id'].'" AND `uid1` = "'.$u->info['enemy'].'" LIMIT 1'));

			$a2 = mysql_fetch_assoc(mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$u->info['battle'].'"
			AND `uid1` = "'.$u->info['id'].'" AND `uid2` = "'.$u->info['enemy'].'" LIMIT 1'));

			if(!isset($a2['id']))//≈сли игрок еще не ударил
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

			//¬ лог бо€
	        $lastHOD = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
			if(isset($lastHOD['id']))
			{
				$id_hod = $lastHOD['id_hod'];
                $btxt = '{u1} использовал закл€тье &quot;<b>'.$itm['name'].'</b>&quot;.';

				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`)
				VALUES ("'.time().'","'.$u->info['battle'].'","'.($id_hod).'","{tm1} '.$btxt.'","login1='.$u->info['login'].'||t1='.$u->info['team'].'||login2='.$u->info['login'].'||t2='.$u->info['team'].'||time1='.time().'","","","","","6")');
			}
		}
}
?>