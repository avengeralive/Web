<?
if(!defined('GAME'))
{
	die();
}

elseif( $itm['id'] > 0 ) {
	$u->deleteItem($itm['id']);
	mysql_query('UPDATE `users` SET `vip` = 1 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	$u->error = 'VIP Панель активна';
}
?>