<?php
include('cron_config.php');
include($P_CRON.'_incl_data/__config.php');
include($P_CRON.'_incl_data/class/__db_connect.php');
include($P_CRON.'_incl_data/class/__user.php');
//$ADMIN=1;

/*Список игроков кто не получал подарки в этом году*/
$sp = mysql_query('SELECT `id`,`login`,`timereg`,`city`,`room` FROM `users` WHERE `banned`="0" AND `timereg` < "'.(time()-86400*360).'" AND `activ` = "0"
AND `ip` != "0" AND `pass` != "" ORDER BY `timereg` ASC');
while( $pl = mysql_fetch_array($sp) )
{
	if( date('d.m',$pl['timereg']) == date('d.m') && date('Y',$pl['timereg']) < date('Y') )
	{
		$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `aaa_birthday` WHERE `uid` = "'.$pl['id'].'" AND `date` = "'.date('d.m.Y').'" LIMIT 1'));
		if(!isset($test['id']))
		{
			eLog('Подарок: '.$pl['id']);
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`)
			VALUES ('1','".$pl['city']."','".$pl['room']."','','".$pl['login']."','<font color=red>Внимание!</font> Бойцовский Клуб поздравляет вас с Днем Рождения в этом мире! Вы получили подарок от Ангела.','-1','10','0')");

			$i3 = $u->addItem(4540,$pl['id'],'|nosale=1|notr=1|sudba='.$pl['login'],NULL,1);
			mysql_query('UPDATE `items_users` SET `gift` = "Ангел",`gtxt1` = "С Днем Рождения! Поздравляем! Удачи жизни и боях желаем!" WHERE `id` = "'.$i3.'" LIMIT 1');

			mysql_query('INSERT INTO `aaa_birthday` (`uid`,`date`) VALUES ("'.$pl['id'].'","'.date('d.m.Y').'")');
		}
	}
}

?>