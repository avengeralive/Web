<?
if(!defined('GAME')) die();

/* Прием: Преследование*/

//Действие при клике
$has_pr1 = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.mysql_real_escape_string($this->ue['id']).'" AND `v2`="16"
AND `user_use`="'.$u->info['id'].'" AND `delete`="0" LIMIT 1'));

$has_pr2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.mysql_real_escape_string($this->ue['id']).'" AND `v2`="16"
AND `user_use`!="'.$u->info['id'].'" AND `delete`="0" LIMIT 1'));

if(isset($has_pr1['id']))  	   echo '<center><font color=red><b>Вы уже преследуете игрока</b></font></center>';
elseif(isset($has_pr2['id']))  echo '<center><font color=red><b>Кто-то уже преследует игрока</b></font></center>';
else
{
	mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`,`mark`)
	VALUES ("22","'.mysql_real_escape_string($this->ue['id']).'","Преследование","add_nosmena=1","77","'.$u->info['id'].'","priem", "16",
	"multi_followme.gif","1","1","1")');

	$btl->priemAddLog( $id, 1, 2, $u->info['id'], $this->ue['id'], 'Преследование',
	'{tm1} '.$btl->addlt(1 , 17 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL).' на {u2}. ', ($btl->hodID + 1));

	//отнимаем тактики
	$this->mintr($pl);
}
?>