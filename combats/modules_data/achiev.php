<?php
if(!defined('GAME')) {
	die();
}

$ar = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
if(!isset($ar['id'])) {
	mysql_query('INSERT INTO `achiev` (`uid`) VALUES ("'.$u->info['id'].'")');
	$ar = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "https://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta http-equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<meta http-equiv=Expires Content=0>
<link href="https://img.testcombats.ru/css/main.css" rel="stylesheet" type="text/css">
</head>
<body style="padding-top:0px; margin-top:7px; height:100%; background-color:#E2E0E0;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="300">&nbsp;</td>
    <td>
    	<h3><center>
    	Достижения персонажа
    	</center></h3>
    </td>
    <td width="300" align="right">
        <input type="button" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" onClick="location.href='main.php?achiev'" value="Обновить">
    	<input type="button" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" onClick="location.href='main.php?inv'" value="Вернуться">
    </td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="/i/achiev/a1-<? if( $ar['a1lvl'] < 1 ) { echo 1; }else{ echo $ar['a1lvl']; } ?>.png"></td>
    <td><div> <b>Победы в физических боях</b><br>
    	<?
		$tx = array();
		if( $ar['a1lvl'] == 0 ) {
			$tx[0] = 100;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a1lvl'] == 1 ) {
			$tx[0] = 300;
			$tx[1] = 2000;
			$tx[2] = 20;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a1lvl'] == 2 ) {
			$tx[0] = 500;
			$tx[1] = 3000;
			$tx[2] = 70;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a1lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a1'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a1']-$ar['a1l'])/($tx[0]-$ar['a1l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a1']-$ar['a1l'])/($tx[0]-$ar['a1l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="/i/achiev/a2-<? if( $ar['a2lvl'] < 1 ) { echo 1; }else{ echo $ar['a2lvl']; } ?>.png"></td>
    <td><div> <b>Победы во всех боях</b><br>
    	<?
		$tx = array();
		if( $ar['a2lvl'] == 0 ) {
			$tx[0] = 1000;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a2lvl'] == 1 ) {
			$tx[0] = 10000;
			$tx[1] = 200;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a2lvl'] == 2 ) {
			$tx[0] = 100000;
			$tx[1] = 500;
			$tx[2] = 50;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a2lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a2'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a2']-$ar['a2l'])/($tx[0]-$ar['a2l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a2']-$ar['a2l'])/($tx[0]-$ar['a2l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="/i/achiev/a3-<? if( $ar['a3lvl'] < 1 ) { echo 1; }else{ echo $ar['a3lvl']; } ?>.png"></td>
    <td><div> <b>Накопленные деньги</b><br>
    	<?
		$tx = array();
		if( $ar['a3lvl'] == 0 ) {
			$tx[0] = 10000;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a3lvl'] == 1 ) {
			$tx[0] = 50000;
			$tx[1] = 500;
			$tx[2] = 10;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a3lvl'] == 2 ) {
			$tx[0] = 100000;
			$tx[1] = 1000;
			$tx[2] = 30;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a3lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a3'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a3']-$ar['a3l'])/($tx[0]-$ar['a3l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a3']-$ar['a3l'])/($tx[0]-$ar['a3l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="/i/achiev/a4-<? if( $ar['a4lvl'] < 1 ) { echo 1; }else{ echo $ar['a4lvl']; } ?>.png"></td>
    <td><div> <b>Плавка уникальных рун</b><br>
    	<?
		$tx = array();
		if( $ar['a4lvl'] == 0 ) {
			$tx[0] = 50;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 1; //екр
		}elseif( $ar['a4lvl'] == 1 ) {
			$tx[0] = 100;
			$tx[1] = 500;
			$tx[2] = 10;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 2; //екр
		}elseif( $ar['a4lvl'] == 2 ) {
			$tx[0] = 150;
			$tx[1] = 1000;
			$tx[2] = 30;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 3; //екр
		}elseif( $ar['a4lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a4'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[5] > 0 ) {
				echo $tx[5]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a4']-$ar['a4l'])/($tx[0]-$ar['a4l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a4']-$ar['a4l'])/($tx[0]-$ar['a4l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="/i/achiev/a5-<? if( $ar['a5lvl'] < 1 ) { echo 1; }else{ echo $ar['a5lvl']; } ?>.png"></td>
    <td><div> <b>Убийство пещерных монстров</b><br>
    	<?
		$tx = array();
		if( $ar['a5lvl'] == 0 ) {
			$tx[0] = 1000;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a5lvl'] == 1 ) {
			$tx[0] = 10000;
			$tx[1] = 2000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a5lvl'] == 2 ) {
			$tx[0] = 100000;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a5lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a5'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[5] > 0 ) {
				echo $tx[5]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a5']-$ar['a5l'])/($tx[0]-$ar['a5l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a5']-$ar['a5l'])/($tx[0]-$ar['a5l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="/i/achiev/a6-<? if( $ar['a6lvl'] < 1 ) { echo 1; }else{ echo $ar['a6lvl']; } ?>.png"></td>
    <td><div> <b>Победы в хаотичных боях</b><br>
    	<?
		$tx = array();
		if( $ar['a6lvl'] == 0 ) {
			$tx[0] = 1000;
			$tx[1] = 300;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a6lvl'] == 1 ) {
			$tx[0] = 5000;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a6lvl'] == 2 ) {
			$tx[0] = 10000;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a6lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a6'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a6']-$ar['a6l'])/($tx[0]-$ar['a6l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a6']-$ar['a6l'])/($tx[0]-$ar['a6l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="/i/achiev/a9-<? if( $ar['a9lvl'] < 1 ) { echo 1; }else{ echo $ar['a9lvl']; } ?>.png"></td>
    <td><div> <b>Победы в Призовых боях</b><br>
    	<?
		$tx = array();
		if( $ar['a9lvl'] == 0 ) {
			$tx[0] = 300;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a9lvl'] == 1 ) {
			$tx[0] = 700;
			$tx[1] = 700;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a9lvl'] == 2 ) {
			$tx[0] = 1250;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a9lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a9'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a9']-$ar['a9l'])/($tx[0]-$ar['a9l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a9']-$ar['a9l'])/($tx[0]-$ar['a9l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="/i/achiev/a10-<? if( $ar['a10lvl'] < 1 ) { echo 1; }else{ echo $ar['a10lvl']; } ?>.png"></td>
    <td><div> <b>Победы в Башне Смерти</b><br>
    	<?
		$tx = array();
		if( $ar['a10lvl'] == 0 ) {
			$tx[0] = 300;
			$tx[1] = 300;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a10lvl'] == 1 ) {
			$tx[0] = 750;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a10lvl'] == 2 ) {
			$tx[0] = 1500;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a10lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a10'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a10']-$ar['a10l'])/($tx[0]-$ar['a10l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a10']-$ar['a10l'])/($tx[0]-$ar['a10l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="/i/achiev/a11-<? if( $ar['a11lvl'] < 1 ) { echo 1; }else{ echo $ar['a11lvl']; } ?>.png"></td>
    <td><div><b>Заядлый Турнирщик</b><br>
    	<?
		$tx = array();
		if( $ar['a11lvl'] == 0 ) {
			$tx[0] = 300;
			$tx[1] = 300;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a11lvl'] == 1 ) {
			$tx[0] = 750;
			$tx[1] = 750;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a11lvl'] == 2 ) {
			$tx[0] = 1500;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a11lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a11'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a11']-$ar['a11l'])/($tx[0]-$ar['a11l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a11']-$ar['a11l'])/($tx[0]-$ar['a11l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>

    <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="/i/achiev/a15-<? if( $ar['a15lvl'] < 1 ) { echo 1; }else{ echo $ar['a15lvl']; } ?>.png"></td>
    <td><div><b>Благородный лекарь</b><br>
    	<?
		$tx = array();
		if( $ar['a15lvl'] == 0 ) {
			$tx[0] = 300;
			$tx[1] = 300;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a15lvl'] == 1 ) {
			$tx[0] = 500;
			$tx[1] = 500;
			$tx[2] = 10;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a15lvl'] == 2 ) {
			$tx[0] = 1000;
			$tx[1] = 1000;
			$tx[2] = 30;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a15lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 50;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a15'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a15']-$ar['a15l'])/($tx[0]-$ar['a15l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a15']-$ar['a15l'])/($tx[0]-$ar['a15l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>

	<tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="/i/achiev/a16-<? if( $ar['a16lvl'] < 1 ) { echo 1; }else{ echo $ar['a16lvl']; } ?>.png"></td>
    <td><div><b>За соклана в пекло</b><br>
    	<?
		$tx = array();
		if( $ar['a16lvl'] == 0 ) {
			$tx[0] = 300;
			$tx[1] = 300;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a16lvl'] == 1 ) {
			$tx[0] = 500;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a16lvl'] == 2 ) {
			$tx[0] = 1000;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a16lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a16'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a16']-$ar['a16l'])/($tx[0]-$ar['a16l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a16']-$ar['a16l'])/($tx[0]-$ar['a16l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>

    <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="/i/achiev/a17-<? if( $ar['a17lvl'] < 1 ) { echo 1; }else{ echo $ar['a17lvl']; } ?>.png"></td>
    <td><div><b>Все в казну для клана</b><br>
    	<?
		$tx = array();
		if( $ar['a17lvl'] == 0 ) {
			$tx[0] = 10000;
			$tx[1] = 200;
			$tx[2] = 10;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a17lvl'] == 1 ) {
			$tx[0] = 50000;
			$tx[1] = 500;
			$tx[2] = 30;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a17lvl'] == 2 ) {
			$tx[0] = 100000;
			$tx[1] = 1000;
			$tx[2] = 50;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a17lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a17'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a17']-$ar['a17l'])/($tx[0]-$ar['a17l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a17']-$ar['a17l'])/($tx[0]-$ar['a17l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>

  <!-- NEW -->
</table>
</body></html>