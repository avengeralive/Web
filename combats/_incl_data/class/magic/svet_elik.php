<?
if(!defined('GAME')) { die(); }
$u->info['hpNow'] = $u->stats['hpAll'];
$u->info['mpNow'] = $u->stats['mpAll'];
mysql_query('UPDATE `stats` set `hpNow` = "'.$u->info['hpNow'].'",`mpNow` = "'.$u->info['mpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
$u->error = 'Вы успешно восстановили '.$u->info['hpNow'].' ХП / '.$u->info['mpNow'].' MP';
?>
