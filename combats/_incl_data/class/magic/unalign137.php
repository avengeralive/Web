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
mysql_query('DELETE FROM `users_align` WHERE `align`="3" or `align`="7" or `align`="1" ');
$u->error = 'Задержка на Сколонность успешно снята!';
}
?>