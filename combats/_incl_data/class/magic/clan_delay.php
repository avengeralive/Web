<?
if(!defined('GAME'))
{
	die();
}

if($u->info['clan'] > 0) {
	$u->error = 'Вы находитесь в клане';
}elseif($u->info['clan_delay']==0){
	$u->error = 'У вас нет задержки на вступление в клан';
}elseif( $itm['id'] > 0 ) {
	$u->deleteItem($itm['id']);
mysql_query('UPDATE `users` SET `clan_delay` = `clan_delay` - "259200" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
$u->error = 'Задержка на кланы успешно снята!';
}
?>