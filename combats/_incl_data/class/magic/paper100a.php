<?
if(!defined('GAME'))
{
	die();
}

if( $itm['id'] > 0 ) {
	$u->deleteItem($itm['id']);
	mysql_query('update `rep` set `rep2` = `rep2` + 100 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	$u->error = 'Вы повысили репутацию Алтарь Крови на +100 ед.';
	}
?>