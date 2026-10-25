<?
if(!defined('GAME'))
{
	die();
}

if($u->info['id'] == 15260604 || $u->info['id'] == 15260607)
{
	$uu = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($_POST['id']).'" LIMIT 1'));
	$uu2 = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `items_id` = "'.mysql_real_escape_string($_POST['id']).'" LIMIT 1'));
	if(isset($uu['id'])) {
	mysql_query('DELETE FROM `items_main` WHERE `id` = "'.$uu['id'].'"');
	mysql_query('DELETE FROM `items_main_data` WHERE `items_id` = "'.$uu2['id'].'"');
	}
	$uer = 'Предмет <b>'.mysql_real_escape_string($_POST['id']).'</b>, успешно удален с Базы Данных!';
}


?>