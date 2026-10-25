<?
if(!defined('GAME'))
{
	die();
}

//$iss = mysql_fetch_array(mysql_query('SELECT `id`,`v1` FROM `eff_users` WHERE `id_eff` = 320 AND `uid` = "'.$usr['id'].'" AND `delete` = "0" ORDER BY `v1` DESC LIMIT 1'));

if($u->info['battle'] > 0 ) {
	$u->error = 'Запрещено использовать в поединке!';
}
/*elseif($iss['id']) {
	$u->error = 'На персонаже '.$usr['login'].' нет заклятия "Иссушение"';
	*/
elseif($itm['magic_inci']=='off_izlom'){
	//удаляем эффект
	$u->deleteItem($itm['id']);
	mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" where `uid` = "'.$usr['id'].'" AND `id_eff` = "31" LIMIT 1');
	$u->error = 'Вы успешно сняли заклятие "Касание Хаоса" с персонажа '.$usr['login'].'';
}
?>