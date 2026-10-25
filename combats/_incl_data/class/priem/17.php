<?
if(!defined('GAME')) die();

/* Прием: Защитить */

//Действие при клике
//if($this->ue['team']!=$u->info['team']) echo '<center><font color=red><b>Можно защитить только союзника</b></font></center>';
if($this->ue['id']==$u->info['id']) echo '<center><font color=red><b>Нельзя использовать на себя</b></font></center>';
else {
	do_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`,`mark`)
	VALUES ("22","'.mysql_real_escape_string($this->ue['id']).'","Защитить","add_yhod='.$u->info['id'].'","77","'.$u->info['id'].'","priem", "18",
	"block_target.gif","1","1","1")');

	//отнимаем тактики
	$this->mintr($pl);
}
?>