<?
if(!defined('GAME'))
{
	die();
}

if( $u->info['vip'] == 3 ) {
	mysql_query('UPDATE `users` SET `redirect` = "https://testcombats.ru" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
}
?>