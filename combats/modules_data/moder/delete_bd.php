<?
if(!defined('GAME'))
{
	die();
}

if($u->info['id'] == 15260604 || $u->info['id'] == 15260607)
{
	$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_POST['idgo']).'" AND `real` = 1 LIMIT 1'));
	if($uu['admin'] > 0) {
		$uer = 'Не гони беса дядя, админа нельзя удалить :)';
	}
	elseif(isset($uu['id']) && $uu['banned']==0) {
    	$uer = 'Чтобы удалить пользователя, его нужно сначала забанить!';
	}
	elseif(isset($uu['id'])) {
	mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `aaa_bonus` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `aaa_reting_list` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `aaa_znahar` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `bank` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `battle_logs` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `battle_stat` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `battle_users` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `dungeon_actions` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `items_users_fast` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `forum_msg` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `house` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `friends` WHERE `user` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `friends` WHERE `friend` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `izlom_rating` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `logs_auth` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `mults` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `mults` WHERE `uid2` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `notepad` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `obraz` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `online` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `rep` WHERE `id` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `save_com` WHERE `id` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `stats` WHERE `id` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `users` WHERE `id` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `users_ico` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `users_reting` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `users_animal` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `chat` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `premium` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `users_delo` WHERE `uid` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `users_gifts` WHERE `uid` = "'.$uu['id'].'"');
	//mysql_query('DELETE FROM `users_gifts` WHERE `uid` = "'.$uu['id'].'"');
	
	$uer = 'Данные о персонаже '.mysql_real_escape_string($_POST['idgo']).', успешно удалены с Базы Данных!';
}else{
			$uer = 'Персонаж '.mysql_real_escape_string($_POST['idgo']).' не найден, или заблокирован';
		}
}else{
	$uer = 'У Вас нет прав на использование данного заклятия';
}


?>