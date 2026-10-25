<?php
if(!defined('GAME'))
{
	die();
}

$bu = mysql_fetch_array(mysql_query('SELECT * FROM `tactic` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
$checkUnicTactic1 = mysql_fetch_array(mysql_query('SELECT * FROM `battle_actions` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" ORDER BY `time` DESC LIMIT 1'));

if($u->info['battle']==0) {
	$u->error = 'Использовать можно только в поединке';
}elseif(isset($bu['id'])) {
	$u->error = 'Нельзя использовать свиток каждый ход...';
}elseif(isset($checkUnicTactic1['id']) && $checkUnicTactic1['time']>time()) {
    $timeToEnd = $checkUnicTactic1['time']-time();
    $u->error = 'Не удалось использовать "Тактика Отражения: 5"<br>Задержка использования: ' . $u->timeOut($timeToEnd) . '';
}elseif( isset($btl->info['id']) ) {
	//
	mysql_query('INSERT INTO `tactic` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
	//
	$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
			'',
			'{tm1} {u1} использовал заклятие &quot;<b>'.$itm['name'].'</b>&quot;.',
			($btl->hodID+0)
	);
	$btl->users[$btl->uids[$u->info['id']]]['tactic5'] += 5;
	
	mysql_query('UPDATE `stats` SET	`tactic5` = "'.$btl->users[$btl->uids[$u->info['id']]]['tactic5'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	//

    $timeTo = time()+180;
    mysql_query('INSERT INTO `battle_actions` (`uid`,`btl`,`time`,`vars`,`vals`) VALUES ("'.$u->info['id'].'","'.$u->info['battle'].'","'.$timeTo.'","use_unic_tactic3","")');

	mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
	$u->error = 'Вы использовали Тактика Отражения: 5';
}