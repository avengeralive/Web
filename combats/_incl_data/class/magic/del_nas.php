<?
if(!defined('GAME'))
{
	die();
}

if( $u->info['host_reg'] == 0 ) {
	$u->error = 'У вас нет Наставника';
	}elseif( $itm['id'] > 0 ) {
	$u->deleteItem($itm['id']);
	mysql_query('UPDATE `users` SET `host_reg` = 0 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	$u->error = 'Вы отказались от наставника';
	}
?>