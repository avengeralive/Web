<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Круговая защита
*/
$pvr = array();
if( isset($pr_momental_this)) {

}elseif( isset($pr_tested_this) )
{

}elseif( isset($pr_used_this) ) {


}else {
	/*
	//Лимит кругов
	$team_eff2 = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0
	AND `name` LIKE "%Круговая Защита%" AND `x` > 99 LIMIT 1'));
	if(isset($team_eff2['id']))
	{
		mysql_query('UPDATE `eff_users` SET `x` = "'.$team_eff2['x'].'" WHERE `id` = "'.$team_eff2['id'].'" LIMIT 1');
		$btl->priemAddLogFast( $u->info['id'], 0, "Круговая Защита",
		'{tm1} '.$btl->addlt(1 , 17 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL).'',
	0, time() );
	}else {*/
			$u->info['tactic6'] -= 10;
			 mysql_query('UPDATE `stats` SET `tactic6` = "'.$u->info['tactic6'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			//Действие при клике
			$btl->priemAddLogFast( $u->info['id'], 0, "Круговая Защита",
				'{tm1} '.$btl->addlt(1 , 17 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL).'',
			0, time() );

			mysql_query('INSERT INTO `battle_actions` (`btl`,`uid`,`time`,`vars`,`vals`)
			VALUES ("'.$btl->info['id'].'","'.$u->info['id'].'","'.time().'","use_defteam'.$u->info['team'].'","1")');
			$now_team = mysql_query('SELECT * FROM `users` WHERE `battle` = "'.$u->info['battle'].'"');
			while($team = mysql_fetch_array($now_team))
			{
				$i1 = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `id` = "'.$team['id'].'" AND `team` = "'.$u->info['team'].'" LIMIT 1'));
				$team_eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$i1['id'].'" AND `delete` = 0 AND `name` LIKE "%Круговая Защита%"'));
				 if(isset($team_eff['id']))
				 {
					mysql_query('UPDATE `eff_users` SET `x` = `x` + 1 WHERE `uid` = "'.$i1['id'].'" AND `delete` = 0 AND `name` LIKE "%Круговая Защита%"');
				}else{
					mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`,`mark`)
					VALUES ("22","'.$i1['id'].'","Круговая Защита","add_ry159=","77","'.$u->info['id'].'","priem", "342", "hp_circleshield.gif","1","-1","1")');
				}
			}
	//}
}
unset($pvr,$now_team,$team);
?>