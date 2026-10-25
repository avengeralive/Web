<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file'] == 'cc/shop_sun')
{
	

	if(!isset($_GET['otdel'])) {
		$_GET['otdel'] = 1;
	}
	$sid = 45;
	$error = '';
	if(isset($_GET['buy'])){
		if($u->newAct($_GET['sd4'])==true){
			$re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x']);
		}else{
			$re = 'Вы уверены что хотите купить этот предмет?';
		}
	}
	
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
	<script type="text/javascript">
	function AddCount(name, txt)
	{
		document.getElementById("hint4").innerHTML = '<table border=0 width=100% cellspacing=1 cellpadding=0 bgcolor="#CCC3AA"><tr><td align=center><B>Купить неск. штук</td><td width=20 align=right valign=top style="cursor: pointer" onclick="closehint3();"><BIG><B>x</TD></tr><tr><td colspan=2>'+
		'<form method=post><table border=0 width=100% cellspacing=0 cellpadding=0 bgcolor="#FFF6DD"><tr><INPUT TYPE="hidden" name="set" value="'+name+'"><td colspan=2 align=center><B><I>'+txt+'</td></tr><tr><td width=80% align=right>'+
		'Количество (шт.) <INPUT TYPE="text" NAME="count" id=count size=4></td><td width=20%>&nbsp;<INPUT TYPE="submit" value=" »» ">'+
		'</TD></TR></form></TABLE></td></tr></table>';
		document.getElementById("hint4").style.visibility = 'visible';
		document.getElementById("hint4").style.left = '100px';
		document.getElementById("hint4").style.top = '100px';
		document.getElementById("count").focus();
	}
	function closehint3() {
	document.getElementById('hint4').style.visibility='hidden';
	Hint3Name='';
	}	
	</script>
	<style type="text/css"> 
	
	.pH3			{ COLOR: #8f0000;  FONT-FAMILY: Arial;  FONT-SIZE: 12pt;  FONT-WEIGHT: bold; }
	.class_ {
		font-weight: bold;
		color: #C5C5C5;
		cursor:pointer;
	}
	.class_st {
		font-weight: bold;
		color: #659BA3;
		cursor:pointer;
	}
	.class__ {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #659BA3;
	}
	.class__st {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #659BA3;
		font-size: 10px;
	}
	.class_old {
		font-weight: bold;
		color: #919191;
		cursor:pointer;
	}
	.class__old {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #838383;
		font-size: 10px;
	}	
	</style>
	<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr><td valign="top">
	<div align="center" class="pH3">Новогодний Магазин</div><center></center>
	<?php
	echo '<b style="color:red">'.$error.'</b>';
	?>
	<br />
	<TABLE width="100%" cellspacing="0" cellpadding="4">
	<TR>
	<form name="F1" method="post">
	<TD valign="top" align="left">
	<!--Магазин-->
	<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#a5a5a5">
	<div id="hint3" style="visibility:hidden"></div>
	<tr>
	<td align="center" height="21">
    <?php	
		/*названия разделов (сверху)*/
		if(!isset($_GET['sale']) && !isset($_GET['gifts']) && isset($_GET['otdel'])) {
			$otdels_small_array = array (
			'',
			'<b>Отдел&nbsp;&quot;Новогодние: Заклятия&quot;</b>',
			'<b>Отдел&nbsp;&quot;Новогодние: Эликсиры&quot;</b>',
			'',			
			'<b>Отдел&nbsp;&quot;Новогодняя Амуниция&quot;</b>',
			
			'<b>Отдел&nbsp;&quot;Оружие: магические посохи&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: сапоги&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: перчатки&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: рубахи&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: легкая броня&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: тяжелая броня&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: шлемы&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: наручи&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: пояса&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: поножи&quot;</b>',
			'<b>Отдел&nbsp;&quot;Щиты&quot;</b>',
			'<b>Отдел&nbsp;&quot;Ювелирные товары: серьги&quot;</b>',
			'<b>Отдел&nbsp;&quot;Ювелирные товары: ожерелья&quot;</b>',
			'<b>Отдел&nbsp;&quot;Ювелирные товары: кольца&quot;</b>',
			
			'<b>Отдел&nbsp;&quot;Заклинания: нейтральные&quot;</b>',
			'<b>Отдел&nbsp;&quot;Заклинания: боевые и защитные&quot;</b>'
			,'<b>Отдел&nbsp;&quot;Заклинания: пирожки&quot;</b>'
			,'<b>Отдел&nbsp;&quot;Заклинания: исцеляющие&quot;</b>'
			,'<b>Отдел&nbsp;&quot;Заклинания: манящие&quot;</b>'
			,'<b>Отдел&nbsp;&quot;Заклинания: стратегические&quot;</b>'
			,'<b>Отдел&nbsp;&quot;Заклинания: тактические&quot;</b>'
			,'<b>Отдел&nbsp;&quot;Заклинания: сервисные&quot;</b>'
			
			,'<b>Отдел&nbsp;&quot;Амуниция&quot;</b>',
			'<b>Отдел&nbsp;&quot;Эликсиры&quot;</b>',
			'<b>Отдел&nbsp;&quot;Еда&quot;</b>',
			'<b>Отдел&nbsp;&quot;Подарки&quot;</b>',
			'<b>Отдел&nbsp;&quot;Подарки: недобрые&quot;</b>',
			'<b>Отдел&nbsp;&quot;Подарки: упаковка&quot;</b>',
			'<b>Отдел&nbsp;&quot;Подарки: открытки&quot;</b>',
			'<b>Отдел&nbsp;&quot;Подарки: фейерверки&quot;</b>',
			'<b>Отдел&nbsp;&quot;Усиление оружия: заточки&quot;</b>',
			'<b>Отдел&nbsp;&quot;Наставничество: образы&quot;</b>');
			if(isset($otdels_small_array[$_GET['otdel']])){
				echo $otdels_small_array[$_GET['otdel']];	
			}
			//echo '<br><b>Магазин принимает вещи 0-7 уровней под 100%, вещи 8-го уровня под 95%, вещи 9-го уровня, а так же свитки и эликсиры можно сдать в магазин под 70%.</b>';
			
		} elseif (isset($_GET['sale']) && $_GET['sale']) {
			echo '
			<B>Отдел&nbsp;&quot;Скупка&quot;</B><br>
			Здесь вы можете продать свои вещи, за жалкие гроши...<br>'.
			//<b>Магазин принимает вещи 0-7 уровней под 99%, вещи 8-го уровня под 95%, вещи 9-го уровня, а так же свитки и эликсиры можно сдать в магазин под 70%.</b><br>
			'У вас в наличии: 
			';
		} elseif (isset($_GET['gifts'])) {
			echo '
			<B>Отдел&nbsp;&quot;Сделать подарки&quot;</B>';	
		}
	?>
	</tr>
	<tr><td>
	<!--Рюкзак / Прилавок-->
	<table width="100%" CELLSPACING="1" CELLPADDING="1" bgcolor="#a5a5a5">
    <?php
	if(isset($_GET['gifts']) && true == false)
	{
	?>
    
<tr><td bgcolor="#D5D5D5">
Вы можете сделать подарок дорогому человеку. Ваш подарок будет отображаться в информации о персонаже.
<OL>
<LI>Укажите логин персонажа, которому хотите сделать подарок<BR>
Логин 
  <INPUT TYPE=text NAME=to_login value="">
<LI>Цель подарка. Будет отображаться в информации о персонаже (не более 60 символов)<BR>
<INPUT TYPE=text NAME=podarok2 value="" maxlength=60 size=50>
<LI>Напишите текст сопроводительной записки (в информации о персонаже не отображается)<BR>
<TEXTAREA NAME=txt ROWS=6 COLS=80></TEXTAREA>
<LI>Выберите, от чьего имени подарок:<BR>
<INPUT TYPE=radio NAME=from value=0 checked> <B><?=$u->info['login']?></B> [<?=$u->info['level']?>]<BR>
<INPUT TYPE=radio NAME=from value=1 > анонимно<BR>
<? if($u->info['clan']>0){ ?><INPUT TYPE=radio NAME=from value=2 > от имени клана<BR><? } ?>
<LI>Нажмите кнопку <B>Подарить</B> под предметом, который хотите преподнести в подарок:<BR>
</OL>
<input name="itemgift" id="itemgift" type="hidden" value="0" />
</td></tr>
    <?php
	}
		if(isset($_GET['gifts']))
		{
			$htmlg2 = '';			
			$sp = mysql_query('SELECT * FROM `users_gifts` WHERE `uid` = "'.$u->info['id'].'"');
			while( $pl = mysql_fetch_array($sp) ) {
				$itmg2 = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="160" align="center" style="border-right:#A5A5A5 1px solid; padding:5px;">'.
				//
					'<img style="padding-bottom:5px;" src="https://img.testcombats.ru/i/items/'.$pl['img'].'"><br>'.
					'<input onClick="document.getElementById(\'itemgift\').value='.(1000000000000+$pl['id']).';document.F1.submit();" type="button" value="Подарить за '.$pl['money'].' кр.">'.
				//
				'</td><td align="left" valign="top" style="border-right:#A5A5A5 1px solid; padding:5px;">'.
				//
					'<a href="https://testcombats.ru/item/0">'.$pl['name'].'</a> &nbsp; (Масса: 1)<br>Долговечность: 0/1<br>'.
					'<small><b>Описание:</b><br>Это именной подарок, его можете подарить только Вы.<br>Сделано в Capital city</small>'.
				//
				'</td></tr></table>';
				$htmlg2 .= '<tr><td align="center" bgcolor="#e2e0e0">'.$itmg2.'</td></tr>';
			}			
			if( $htmlg2 != '' ) {
				echo '<tr><td align="center" bgcolor="#e2e0e0"><h3>Уникальные подарки</h3>' . $htmlg2 . '</td></tr>';
				echo '<tr><td align="center" bgcolor="#e2e0e0"><h3>Стандартные подарки</h3></td></tr>';
			}
			unset($htmlg2,$itmg2);
			//
			$itmAll = $u->genInv(3,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND (`im`.`type` = "28" OR `im`.`type` = "38" OR `im`.`type` = "63" OR `im`.`type` = "64" OR `im`.`type` = "37") AND (`iu`.`gift` = "" OR (`iu`.`data` LIKE "%|zazuby=%" AND `iu`.`gift` = 1)) ORDER BY `lastUPD` DESC');
			if($itmAll[0]==0){
				$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">У вас нет подходящих предметов</td></tr>';
			}else{
				$itmAllSee = $itmAll[2];
			}
			echo $itmAllSee;
		}elseif(!isset($_GET['sale'])){
			//Выводим вещи в магазине для покупки
			$u->shopItems($sid);
		}else{
			//Выводим вещи в инвентаре для продажи
			$itmAll = $u->genInv(2,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `iu`.`data` NOT LIKE "%fromshop=2%" AND `iu`.`gift` = "" AND `im`.`type` != 31 AND `im`.`type` != 32 ORDER BY `lastUPD`  DESC');
			if($itmAll[0]==0){
				$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО</td></tr>';
			}else{
				$itmAllSee = $itmAll[2];
			}
			echo $itmAllSee;
		}
	?>
	</TABLE>	 
	</TD></TR>
	</TABLE>
	</TD>
	</FORM>
	</TR>
	</TABLE>	
	<td width="280" valign="top">
    <TABLE cellspacing="0" cellpadding="0"><TD width="100%">&nbsp;</TD><TD>
	<table  border="0" cellpadding="0" cellspacing="0"> 
	<tr align="right" valign="top">
	<td>
	<!-- -->
	<? echo $goLis; ?>
	<!-- -->
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td nowrap="nowrap">
	<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
	<tr>
	<td bgcolor="#D3D3D3"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.208&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.208',1); ?>">Ёлка</a></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</td></table>
	</td></table>
	<div><br />
      <div align="right">
      <small>
	  Масса: <b><?=$u->aves['now']?>/<?=$u->aves['max']?></b> &nbsp;<br />
	  У вас в наличии: <b style="color:#339900;"><?php echo round($u->info['money'],2); ?> кр.</b> &nbsp;
      <?
	  if($u->info['level'] < 8 && $c['zuby'] == true) {
		?>
        <br />Зубов: <?=$u->zuby($u->info['money4'])?> &nbsp; &nbsp;
        <?  
	  }
	  ?>
      </small>
      </div>
	  <br />
      <center>
        <INPUT class="btn" TYPE="button" value="Обновить" onclick="location = '<? echo str_replace('item','',str_replace('buy','',$_SERVER['REQUEST_URI'])); ?>';">
    </center>
    <BR>
	  </div>
	<div style="background-color:#A5A5A5;padding:1"><center><B>Отделы магазина</B></center></div>
	<div style="line-height:17px;">
    <style>.shop_menu_txt { background-color: #d5d5d5; }</style>
	<?php
		/*названия разделов (справа)*/
		$otdels_array = array (
		'',		
		'&nbsp;&nbsp;Заклятия',
		'&nbsp;&nbsp;Эликсиры',
		'',
		'&nbsp;&nbsp;Предметы');
		$i=1;
		while ($i!=-1)
		{
			if(isset($otdels_array[$i]))
			{
				if(isset($_GET['otdel']) && $_GET['otdel']==$i) 
				{
				$color = 'C7C7C7';	
				} else {
				$color = 'e2e0e0';
				}
			if($i == 1) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/1.png"> <b>Новогодние:</b></div>';
			} elseif($i == 4) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/2.png"> <b>Амуниция:</b></div>';
			}
			
			echo '
			<A HREF="?otdel='.$i.'"><DIV style="background-color: #'.$color.'">
			'.$otdels_array[$i].'
			</A></DIV>
			';
			} else {
			$i = -2;
			}
			$i++;
		}
		
		if(isset($_GET['gifts'])) 
		{
		//$color = 'C7C7C7';	
		}else{
		//	$color = 'e2e0e0';
		}
		//echo '<div class="shop_menu_txt"><b>Возможности:</b></div>';
		//echo '<A HREF="?otdel=32&gifts=1"><DIV style="background-color: #'.$color.'">&nbsp;&nbsp;Сделать подарки</A>';
	?>
	</div>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>
<?
}
?>