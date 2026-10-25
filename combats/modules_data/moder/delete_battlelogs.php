<?
if(!defined('GAME'))
{
	die();
}

if($u->info['id'] == 15260604 || $u->info['id'] == 15260607 || $u->info['align'] == 1.99)
{
	$uu = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.mysql_real_escape_string($_POST['id']).'" LIMIT 1'));
	if(isset($uu['id'])) {
	mysql_query('DELETE FROM `battle` WHERE `id` = "'.$uu['id'].'"');
	}
	$uer = 'Лог боя под номером <b>'.mysql_real_escape_string($_POST['id']).'</b>, успешно удален с Базы Данных!';
}


?>