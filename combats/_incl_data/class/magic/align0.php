<?
if(!defined('GAME'))
{
	die();
}

if( $u->info['clan'] > 0 ) {
	$u->error = 'Вы находитесь в клане...';
}elseif( $u->info['align'] != 1 && $u->info['align'] != 3 && $u->info['align'] != 7 ) {
	$u->error = 'У вас уже нет склонности которую можно было бы снять.';
}elseif( $itm['id'] > 0 ) {
	$u->deleteItem($itm['id']);
	mysql_query('UPDATE `users` SET `align` = 0 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	$u->error = 'У вас забрали склонность';
}
?>