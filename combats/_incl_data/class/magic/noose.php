<?
//Заклятие Арканы - свиток 5064
if(!defined('GAME')) die();
//376 - стихий
//16 - света
//375 - тьмы

//1 => 'Свет',
//3 => 'Тьма',
//7 => 'Нейтралитет'

$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "noose" AND `time` > "'.time().'" LIMIT 1'));
if($u->info['login'] == $usr['login']) {
	$u->error = 'Нельзя использовать на себя!';
}elseif(isset($test['id'])) {
	$u->error = 'Нельзя использовать это заклятие чаще чем раз в полчаса!';
}
elseif(($u->info['room']==16 || $u->info['room']==376) && floor($usr['align'])==3) {
	$u->error = 'вы не можете перенести темного в этот зал.';
}
elseif(($u->info['room']==375 || $u->info['room']==376) && floor($usr['align'])==1) {
	$u->error = 'вы не можете перенести светлого в этот зал.';
}
elseif(($u->info['room']==16 || $u->info['room']==375) && floor($usr['align'])==7) {
	$u->error = 'вы не можете перенести нейтрала в этот зал.';
}
elseif($usr['room']==217 || $usr['room']==218 || $usr['room']==219) {
	$u->error = 'Персонаж '.$u->microLogin($usr['id'],1).' находится в Общежитии!';
}elseif($usr['room']==$u->info['room']) {
	$u->error = 'Персонаж '.$u->microLogin($usr['id'],1).' уже находится в вашей комнате!';
}elseif($usr['dnow'] > 0 ) {
	$u->error = 'Персонаж '.$u->microLogin($usr['id'],1).' находится в Подземелье';
}elseif($usr['real']==1) {
	$u->error = 'Перемещать можно только реальных игроков!';
}elseif($usr['bot'] > 0) {
	$u->error = 'Вы не можете поймать бота ;)';
}elseif($usr['battle'] > 0) {
	$u->error = 'Персонаж '.$u->microLogin($usr['id'],1).' находится в поединке';
}elseif($usr['room']==274) {
	$u->error = 'Персонаж '.$u->microLogin($usr['id'],1).' находится в Заточении!';
}elseif($usr['online']<time()-520) {
	$u->error = 'Персонаж не в сети';
}else{
		mysql_query('UPDATE `users` SET `room` = "'.$u->info['room'].'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
		$u->error = 'Заклятие использовано успешно!';
		$txt = '[img[items/noose.gif]] Персонаж '.$u->info['login'].' поймал персонажа '.$usr['login'].' с помощью заклятия Арканы';
		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`)
		VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$txt."','".time()."','6','0','1')");
        $u->addAction( time()+1800, 'noose', $usr['id'],$u->info['id']);
        mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
}
?>