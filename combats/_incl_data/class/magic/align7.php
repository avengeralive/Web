<?
if(!defined('GAME'))
{
	die();
}

if( $u->info['clan'] > 0 ) {
	$u->error = 'Вы находитесь в клане...';
}elseif( $u->info['align'] != 0 ) {
	$u->error = 'У вас уже есть склонность';
}elseif( $itm['id'] > 0 ) {
	$u->deleteItem($itm['id']);
	mysql_query('UPDATE `users` SET `align` = 7 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	$u->error = 'Вас наградили Нейтральной Склонностью';
}
?>