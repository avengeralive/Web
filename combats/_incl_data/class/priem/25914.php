<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Ограниченный маневр
*/
$pvr = array();
if(isset($btl->users[$btl->uids[$u->info['enemy']]]['login'])) {
	echo '<font color=red><b>Вы успешно использовали прием Преследование на '.$btl->users[$btl->uids[$u->info['enemy']]]['login'].'</b></font>';
	mysql_query('UPDATE `stats` SET `smena` = "-1" WHERE `id` = "'.mysql_real_escape_string($u->info['id']).'" LIMIT 1');
	$btl->priemAddLogFast( $u->info['id'], $u->info['enemy'], "Преследование",
		'{tm1} '.$btl->addlt(1 , 17 , $btl->users[$btl->uids[$uid]]['sex'] , NULL).' на {u2}.',
	1, time() );
}
unset($pvr);
?>