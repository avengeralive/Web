<?
		$cop = mysql_fetch_array(mysql_query('SELECT `id`,`moneyCop`,`time` FROM `compensation` WHERE `uid` = "'.$u->info['id'].'" ORDER BY `time` DESC LIMIT 1'));
		$cop = $cop['time'] + 2419200;		
	if( isset($_GET['compensation']) && $cop < time() ) {
		$money2 = (round($u->info['moneyCop']/100*20));
	    mysql_query('UPDATE `users` SET `money2` = `money2` + "'.$money2.'",`moneyCop1` = `moneyCop1` + "'.$money2.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		mysql_query('INSERT INTO `compensation` (`uid`,`time`,`moneyCop`) VALUES ("'.$u->info['id'].'","'.time().'","'.$money2.'")');	
		$cop = time() + 2419200;
		echo"<center><font color=red><b>Вы получили компенсацию 20%!</b></font></center>";
	}	
		$money = mysql_fetch_array(mysql_query('SELECT `id`,`moneyCop` FROM `compensation` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
?>
<? if($u->info['moneyCop'] > 0) { ?>
    <hr style="height:1px; width:315px; margin:3px;">
<? 	if( $cop < time() ) { ?> 
    Компенсация:&nbsp;<b style="color:red"><? echo 0+$money['moneyCop']; ?></b>/<b style="color:red"><? echo $u->info['moneyCop']; ?></b> екр.</b> <a href="/main.php?compensation=1">Получить</a><br />
<? }else{ ?>
    Компенсация:&nbsp;<b style="color:red"><? echo $money['moneyCop']; ?></b>/<b style="color:red"><? echo $u->info['moneyCop']; ?></b> екр.</b><br>
    Следующое получение через: <?=$u->timeOut($cop-time())?>
<? } ?>
    <hr style="height:1px; width:315px; margin:3px;">
<? } ?>