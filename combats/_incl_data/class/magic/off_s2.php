<?
if(!defined('GAME')) {
  die();
}
//выбираем эффект жертвы $usr
$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `id_eff` = "308" AND `uid` = "'.$usr['id'].'" AND `delete` = "0" LIMIT 1'));
//эффект свой
$eff_users = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `id_eff` = "308" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" LIMIT 1'));
//эффект защиты от вора
$no_vor = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `id_eff` = "459" AND `uid` = "'.$usr['id'].'" AND `delete` = "0" LIMIT 1'));
if($u->info['login']==$usr['login']) {
	$u->error = 'Глупец, ты не можешь украсть сам у себя ;)';
}elseif(isset($no_vor['id'])) {
	$u->error = 'Персонаж '.$usr['login'].' не дремлет, будьте осторожны';
}elseif($usr['battle'] > 0 ) {
	$u->error = 'Персонаж '.$usr['login'].' в поединке!';
}elseif(!isset($eff['id'])) {
	$u->error = 'На персонаже '.$usr['login'].' нету эффекта "Нектар Змеи"';
}elseif($eff_users['name'] && $eff_users['delete'] ==0) {
	$u->error = 'У вас есть Нектар Змеи!';
}else{
	//воруем эффект
	mysql_query('UPDATE `eff_users` SET `uid` = "'.$u->info['id'].'" WHERE `uid` = "'.$usr['id'].'" AND `name` = "'.$eff['name'].'" LIMIT 1');
	$u->error = 'Вы украли эффект '.$eff['name'].' у персонажа '.$usr['login'].'!';
	//отправляем системку
	mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','capitalcity','0','','".$usr['login']."',' Персонаж <b>".$u->info['login']." </b>украл у вас эффект ".$eff['name']." .','-1','6','0')");
	$txt = '<font color=red>Внимание!</font>&nbsp;<b>'.$u->info['login'].'</b> украл эффект <b>'.$eff['name'].'</b> у персонажа <b>'.$usr['login'].'</b>';
	mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$txt."','".time()."','6','0','1')"); 
    //уменьшаем износ
    mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');	
}
?>