<?php
if(!defined('GAME')) {
	die();
}
	
?>
<span style="font-size:10.04pt;">
Сила: <b><? echo $u->stats['s1']; ?></b><br />
Ловкость:&nbsp;<b><? echo $u->stats['s2']; ?></b><br />
Интуиция:&nbsp;<b><? echo $u->stats['s3']; ?></b><br />
Выносливость:&nbsp;<b><? echo $u->stats['s4']; ?></b><br />
<? if($u->info['level'] > 3 || $u->stats['s5']!=0){ ?>Интеллект:&nbsp;<b><? echo 0+$u->stats['s5']; ?></b><br /><? } ?>
<? if($u->info['level'] > 6 || $u->stats['s6']!=0){ ?>Мудрость:&nbsp;<b><? echo 0+$u->stats['s6']; ?></b><br /><? } ?>
<? if($u->info['level'] > 9 || $u->stats['s7']!=0){ ?>Духовность:&nbsp;<b><? echo 0+$u->stats['s7']; ?></b><br /><? } ?>
<? if($u->info['level'] > 13 || $u->stats['s8']!=0){ ?>Воля:&nbsp;<b><? echo 0+$u->stats['s8']; ?></b><br /><? } ?>
<? if($u->info['level'] > 14 || $u->stats['s9']!=0){ ?>Свобода духа:&nbsp;<b><? echo 0+$u->stats['s9']; ?></b><br /><? } ?>
<? if($u->info['level'] > 19 || $u->stats['s10']!=0){ ?>Божественный:&nbsp;<b><? echo 0+$u->stats['s10']; ?></b><br /><? } ?>
<?
if($u->info['ability'] > 0 || ($u->info['skills'] > 0 && $u->info['level'] > 0)) { 
    echo '<a href="main.php?skills=1&side=1">+ Способности&nbsp;&nbsp;'.$u->info['ability'].'</a><br />'; 
}
if($u->info['skills'] > 0 && $u->info['level'] > 0) { 
    echo '&bull;&nbsp;<a href="main.php?skills=1&side=1">Обучение&nbsp;&nbsp;'.$u->info['skills'].'</a><br>'; 
} 
	$expbase = (isset($u->stats['levels']['exp']) ? number_format($u->stats['levels']['exp'], 0, ",", " ") : 0 );
	if( $expbase-1 == $u->info['exp'] && $c['nolevel'] == true ) {
		//Проверяем блок опыта
		$tlus = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `users` WHERE `real` = 1 AND `level` = "'.$u->info['level'].'" LIMIT 1'));
		if($tlus[0] < $u->info['level']*10) {
			$expbase = '<strike>'.$expbase.'</strike>';
		}
		$expbase = '<a href="//testcombats.ru/exp" target="_blank">('.$expbase.')</a>';
		if(((1+$u->info['level']*10)-$tlus[0]) > 0) {
			$expbase .= ' <u><a onMouseOver="top.hi(this,\'<b>Персонажи '.$u->info['level'].' уровня не получают опыт.</b><br>Для разблокировки не хватает <u>'.((1+$u->info['level']*10)-$tlus[0]).' персонажей</u> данного уровня.\',event,0,1,1,1,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();" style="cursor:help">[?]</a></u>';
		}
	}else{
		$expbase = '(<a href="//testcombats.ru/exp" target="_blank">'.$expbase.'</a>)';
	}
?>
&nbsp;<br />
<span style="font-size:9pt;">Опыт:&nbsp;<a href="//testcombats.ru/exp" target="_blank"><? echo number_format($u->info['exp'], 0, ",", " "); ?></a>&nbsp;<?=$expbase?></span><br />
Уровень:&nbsp;<b><? echo $u->info['level']; ?></b><br />
Побед:&nbsp;<b><? echo number_format($u->info['win'], 0, ",", " "); ?></b><br />
Поражений:&nbsp;<? echo number_format($u->info['lose'], 0, ",", " "); ?><br />
Ничьих:&nbsp;<? echo number_format($u->info['nich'], 0, ",", " "); ?><br />

<?		
	if(isset($_GET['compensation'])) {
		$cop = mysql_fetch_array(mysql_query('SELECT * FROM `compensation` WHERE `uid` = "'.$u->info['id'].'" AND `finished` = "0" LIMIT 1'));
	if(empty($cop)){ 
		echo"Вы уже забрали всю компенсацию.";
	}/*elseif(isset($cop['time']) + 0 >= time()){ 
		echo"Компенсация только раз в месяц!";
	}*/else{
		$money2 = (round($cop['moneyCop']/100*100));
		mysql_query('UPDATE `users` SET `money2` = `money2` + "'.$money2.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		mysql_query('UPDATE `compensation` SET `moneyCop1` = `moneyCop1` + "'.$money2.'" WHERE `id` = "'.$cop['id'].'" LIMIT 1');
		echo"<center><font color=red><b>Вы получили компенсацию!</b></font></center>";
	if($cop['moneyCop1'] + $money2 >= $cop['moneyCop']){
		mysql_query('UPDATE `compensation` SET `finished` = "1" WHERE `id` = "'.$cop['id'].'" LIMIT 1');
	}
  }
}
    $money = mysql_fetch_array(mysql_query('SELECT * FROM `compensation` WHERE `uid` = "'.$u->info['id'].'" AND `finished` = "0" LIMIT 1'));
?>
<?if(!empty($money)){?>
	<hr style="height:1px; width:260px; margin:3px;">
<?if($money['time'] + 0 >= time()){?>
    Компенсация:&nbsp;<b style="color:red"><b style="color:red"><?=$money['moneyCop']; ?></b> екр.</b><br>
    Следующее получение через: <?=$u->timeOut($money['time'] + 0 - time())?>
<?}else{?>
    Компенсация:&nbsp;<b style="color:red"><b style="color:red"><?=$money['moneyCop']?></b> екр.</b> <a href="/main.php?compensation=1">Получить</a><br />
<?}?>
    <hr style="height:1px; width:260px; margin:3px;">
<?}?>
Кредиты:&nbsp;<b style="font-size:10.04 pt;"><? echo $u->info['money']; ?> кр.</b>&nbsp;<br />
Еврокредиты:&nbsp;<b style="color:darkgreen; font-size:10.40 pt;"><? echo $u->info['money2']; ?> екр.</b>&nbsp;<br />