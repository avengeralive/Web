<?
if(!defined('GAME'))
{
	die();
}


if($itm['magic_inci'] == 'un_metka' ) {
	mysql_query('UPDATE `stats` set `atack` = "0" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
	mysql_query('UPDATE `stats` set `atack2` = "0" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
	$u->deleteItem($itm['id']);
	$u->error = 'Вы успешно сняли "Метку" с персонажа '.$usr['login'].'!';
}

?>