<?
if(!defined('GAME'))
{
	die();
}

if( $u->info['clan'] == 0 ) {
	$u->error = 'Вы не состоите в клане!';
	}elseif( $itm['id'] > 0 ) {
	$u->deleteItem($itm['id']);
    mysql_query("UPDATE `clan` SET `exp`=`exp`+'1000' WHERE `id` = '".mysql_real_escape_string($u->info['clan'])."' LIMIT 1");
	$u->error = 'Вы увеличили клановый опыт +1000';
	}
?>