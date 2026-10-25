<?
if(!defined('GAME'))
{
	die();
}

$bu = mysql_fetch_array(mysql_query('SELECT * FROM `tactic` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));

if($u->info['battle']==0) {
	$u->error = 'Использовать можно только в поединке';
}elseif(isset($bu['id'])) {
	$u->error = 'Нельзя использовать свиток каждый ход...';
}elseif( isset($btl->info['id']) ) {
	//
	mysql_query('INSERT INTO `tactic` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
	//
	$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
			'',
			'{tm1} {u1} использовал заклятие &quot;<b>'.$itm['name'].'</b>&quot;.',
			($btl->hodID)
	);
	$btl->users[$btl->uids[$u->info['id']]]['tactic1'] += 5;
	$btl->users[$btl->uids[$u->info['id']]]['tactic2'] += 5;
	$btl->users[$btl->uids[$u->info['id']]]['tactic3'] += 5;
	$btl->users[$btl->uids[$u->info['id']]]['tactic4'] += 5;
	$btl->users[$btl->uids[$u->info['id']]]['tactic5'] += 5;
	
	mysql_query('UPDATE `stats` SET
		`tactic1` = "'.$btl->users[$btl->uids[$u->info['id']]]['tactic1'].'",
		`tactic2` = "'.$btl->users[$btl->uids[$u->info['id']]]['tactic2'].'",
		`tactic3` = "'.$btl->users[$btl->uids[$u->info['id']]]['tactic3'].'",
		`tactic4` = "'.$btl->users[$btl->uids[$u->info['id']]]['tactic4'].'",
		`tactic5` = "'.$btl->users[$btl->uids[$u->info['id']]]['tactic5'].'"
	WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	//
	mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
	$u->error = 'Вы использовали Уникальную тактику +5';
}
?>