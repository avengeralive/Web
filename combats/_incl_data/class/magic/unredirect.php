<?
if(!defined('GAME'))
{
	die();
}

if( $u->info['vip'] == 3 ) {
	mysql_query('UPDATE `users` SET `redirect` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
}
?>