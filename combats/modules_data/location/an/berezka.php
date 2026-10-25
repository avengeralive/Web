<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='an/berezka')
{	
	if(!isset($_GET['otdel'])) 
	{
		$_GET['otdel'] = 1;
	}
	
	$sid = 2;

	$sale_ekr = true;
	if( $u->stats['silver'] > 0 ) {
		$sale_ekr = true;
	}else{
		if( isset($_GET['sale']) ) {
			//unset($_GET['sale']);	
		}
	}

	$error = '';
	
	if(isset($_GET['buy'])){
		if($u->newAct($_GET['sd4'])==true)
		{
			$re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x']);
		}else{
			$re = 'Вы уверены что хотите купить этот предмет?';
		}
	}elseif(isset($_GET['sale']) && isset($_GET['item']) && $u->newAct($_GET['sd4']) && $sale_ekr == true ) {
		$id = (int)$_GET['item'];
		$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.*, count(`iuu`.id) as inGroupCount
			FROM `items_users` AS `iu`
			LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`)
			LEFT JOIN `items_users` as `iuu` ON (`iuu`.inGroup = `iu`.inGroup AND `iuu`.item_id = `im`.id )
			WHERE `iuu`.`uid`="'.$u->info['id'].'" AND `iu`.`uid`="'.$u->info['id'].'" AND `im`.`price2` > 0 AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `iu`.`id` = "'.mysql_real_escape_string($id).'" LIMIT 1'));
		$po = $u->lookStats($itm['data']);	
		if($u->info['allLock'] > time()) {
			$po['nosale'] = 1;
		}
		
		$effvip = mysql_fetch_array(mysql_query('SELECT `id`,`timeUse` FROM `eff_users` WHERE `data` LIKE "%add_silver=%" AND `uid` = "'.$u->info['id'].'" ORDER BY `id` DESC LIMIT 1'));
		$cblim = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `ekr_sale` WHERE `uid` = "'.$u->info['id'].'" AND `time` >= '.$effvip['timeUse'].' LIMIT 1'));
		
		//if( $cblim[0] >= $u->stats['silver'] * 5 ) {
		//	$error = 'Лимит продаж предметов в березку исчерпан, обновите VIP аккаунт';
		//}else
		if( ($itm['gift'] != '' && $itm['gift'] != '0') && (  $itm['type'] == 37 || $itm['type'] ==  38 || $itm['type'] == 39 || $itm['type'] == 63 ) ) {
			$error = 'Нельзя продавать подарки, они должны оставаться на память! :)';
		}elseif(isset($po['nosale'])){
			$error = 'Не удалось продать предмет ...';
		}elseif(isset($po['fromshop']) && ($po['fromshop'] != 777 && $po['fromshop'] != 2)){
			$error = 'Предмет не был приобретен за Евро-кредиты, его нельзя продать здесь...';
		}elseif($itm['gift'] != '0' && $itm['gift'] != '') {
				$error = 'Не удалось продать предмет ... Все-таки подарок ;)';
		}elseif(isset($po['frompisher'])){
			$error = 'Не удалось продать предмет ... предмет из подземелья';
		}elseif(isset($po['srok'])){
			$error = 'Предметы со сроком годности продавать нельзя ...';
		}elseif(isset($itm['id'])){
			if($itm['2price']>0){
				$itm['price2'] = $itm['2price'];
			}
			$shpCena = round($itm['price2'],2);
			$plmx = 0;
			if($itm['iznosMAXi']!=$itm['iznosMAX'] && $itm['iznosMAX']!=0){
				$plmx = $itm['iznosMAX'];
			}else{
				$plmx = $itm['iznosMAXi'];
			}
			if($itm['iznosNOW']>0){
				$prc1 = floor($itm['iznosNOW'])/$plmx*100;
			}else{
				$prc1 = 0;
			}
			$shpCena = $u->shopSaleM( $shpCena , $itm );
			$shpCena = $shpCena/100*(100-$prc1);
			if($itm['iznosMAX']>0 && $itm['iznosMAXi']>0 && $itm['iznosMAXi']>ceil($itm['iznosMAX'])){
				$shpCena = $shpCena/100*(ceil($itm['iznosMAX'])/$itm['iznosMAXi']*100);
			}
/*			if( isset($po['art']) ) {
				$shpCena = $u->round2($shpCena*$u->berezCena()); // Процент продажи 35%
			}else{
				$shpCena = $u->round2($shpCena*$u->berezCena()); // Процент продажи 35%
			}*/
			if($itm['magic_inci'] == 'addmoney'){
				$shpCena = $itm['price2'];
			}else{
				$premium = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$u->info['id'].'" AND `time_delete` > "'.time().'"'));
				if($premium){
					if($u->berezCena() != 0){
						if( isset($po['art']) ) {
							$shpCena = $u->round2($shpCena*$u->berezCena()); // Цена арта
						}else{
							$shpCena = $u->round2($shpCena*$u->berezCena()); // Цена
						}
						$shpCena = $u->round2($shpCena*($premium['saleEkr_prc']/100)); // Цена предметов
					}
					else{
						$shpCena = $u->round2($shpCena*($premium['saleEkr_prc']/100)); // Цена предметов
					}
				}else{
					if($u->berezCena() != 0){
						if( isset($po['art']) ) {
							$shpCena = $u->round2($shpCena*$u->berezCena()); // Цена арта
						}else{
							$shpCena = $u->round2($shpCena*$u->berezCena()); // Цена
						}
						$shpCena = $u->round2($shpCena*0.9); // Цена предметов
					}
					else{
						$shpCena = $u->round2($shpCena*0.9); // Цена предметов
					}
				}
				if($shpCena<0){
					$shpCena = 0;
				}
			}
			$col = $u->itemsX($itm['id']);	
			if($col>0){
				$shpCena = $shpCena*$col;
			}
			if($shpCena<0){
				$shpCena = 0;
			}
			$upd2 = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			if($upd2){
				if($col>1){
					mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `item_id`="'.$itm['item_id'].'" AND `uid`="'.$itm['uid'].'" AND `inGroup` = "'.$itm['inGroup'].'" LIMIT '.$col.'');	
				}
				$u->info['money2'] += $shpCena;
				$upd = mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				if($upd){
					mysql_query('INSERT INTO `ekr_sale` (`uid`,`time`,`money2`) VALUES ("'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($shpCena).'")');
					$u->info['catch'] += $shpCena;
					mysql_query('UPDATE `users` SET `catch` = "'.$u->info['catch'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					$error = 'Вы успешно продали предмет &quot;'.$itm['name'].' [x'.$col.']&quot; за '.$shpCena.' екр.';
					mysql_query('UPDATE `items_users` SET `inGroup` = "0",`delete` = "'.time().'" WHERE `inGroup` = "'.$itm['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT '.$itm['group_max'].'');
					$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.Ekrshop</font>&quot;: Предмет &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] был продан в магазин за <B>'.$shpCena.' екр.</B>.',time(),$u->info['city'],'System.Ekrshop',0,$shpCena);
				}else{
					$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.Ekrshop</font>&quot;: Предмет &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] был продан в магазин за <B>'.$shpCena.' екр.</B> (кредиты не переведены).',time(),$u->info['city'],'System.Ekrshop',0,0);
					$error = 'Не удалось продать предмет...';
				}
			}else{
				$error = 'Не удалось продать предмет...';
			}
		}else{
			$error = 'Предмет не найден в инвентаре.';
		}
	}
	
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
	<script type="text/javascript">
	function AddCount(name, txt){
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
	<tr><td valign="top"><div style="margin-top: 5px;" align="center" class="pH3"><? echo $u->room['name']; ?></div>
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
		if(!isset($_GET['sale']) && isset($_GET['otdel'])) 
		{
			$otdels_small_array = array (1=>'<b>Отдел&nbsp;&quot;Оружие: кастеты,ножи&quot;</b>',
				2=>'<b>Отдел&nbsp;&quot;Оружие: топоры&quot;</b>',
				3=>'<b>Отдел&nbsp;&quot;Оружие: дубины,булавы&quot;</b>',
				4=>'<b>Отдел&nbsp;&quot;Оружие: мечи&quot;</b>',
				5=>'<b>Отдел&nbsp;&quot;Оружие: магические посохи&quot;</b>',
				6=>'<b>Отдел&nbsp;&quot;Одежда: сапоги&quot;</b>',
				7=>'<b>Отдел&nbsp;&quot;Одежда: перчатки&quot;</b>',
				8=>'<b>Отдел&nbsp;&quot;Одежда: рубахи&quot;</b>',
				28=>'<b>Отдел&nbsp;&quot;Одежда: плащи&quot;</b>',
				9=>'<b>Отдел&nbsp;&quot;Одежда: легкая броня&quot;</b>',
				10=>'<b>Отдел&nbsp;&quot;Одежда: тяжелая броня&quot;</b>',
				11=>'<b>Отдел&nbsp;&quot;Одежда: шлемы&quot;</b>',
				12=>'<b>Отдел&nbsp;&quot;Одежда: наручи&quot;</b>',
				13=>'<b>Отдел&nbsp;&quot;Одежда: пояса&quot;</b>',
				14=>'<b>Отдел&nbsp;&quot;Одежда: поножи&quot;</b>',
				15=>'<b>Отдел&nbsp;&quot;Щиты&quot;</b>',
				16=>'<b>Отдел&nbsp;&quot;Ювелирные товары: серьги&quot;</b>',
				17=>'<b>Отдел&nbsp;&quot;Ювелирные товары: ожерелья&quot;</b>',
				18=>'<b>Отдел&nbsp;&quot;Ювелирные товары: кольца&quot;</b>',
				19=>'<b>Отдел&nbsp;&quot;Заклинания: нейтральные&quot;</b>',
				20=>'<b>Отдел&nbsp;&quot;Заклинания: боевые и защитные&quot;</b>',
				50=>'<b>Отдел&nbsp;&quot;Заклинания: исцеляющие&quot;</b>',
				55=>'<b>Отдел&nbsp;&quot;Заклинания: манящие&quot;</b>',
				56=>'<b>Отдел&nbsp;&quot;Заклинания: тактические&quot;</b>',
				51=>'<b>Отдел&nbsp;&quot;Руны&quot;</b>',
				52=>'<b>Отдел&nbsp;&quot;Чарки&quot;</b>',
				53=>'<b>Отдел&nbsp;&quot;Книги&quot;</b>',
				21=>'<b>Отдел&nbsp;&quot;Амуниция&quot;</b>',
				36=>'<b>Отдел&nbsp;&quot;Амуниция: эликсиры&quot;</b>',
				37=>'<b>Отдел&nbsp;&quot;Амуниция: еда&quot;</b>',
				32=>'<b>Отдел&nbsp;&quot;Сувениры: открытки&quot;</b>',
				29=>'<b>Отдел&nbsp;&quot;Сувениры: подарки&quot;</b>',
				33=>'<b>Отдел&nbsp;&quot;Сувениры: недобрые&quot;</b>',
				34=>'<b>Отдел&nbsp;&quot;Сувениры: упаковка&quot;</b>',
				35=>'<b>Отдел&nbsp;&quot;Сувениры: фейерверки&quot;</b>',
				54=>'<b>Отдел&nbsp;&quot;Чеки&quot;</b>');
			if(isset($otdels_small_array[$_GET['otdel']]))
			{
				echo $otdels_small_array[$_GET['otdel']];	
			}
			
		} elseif (isset($_GET['sale'])) 
		{
			echo '
			<B>Отдел&nbsp;&quot;Продажа предметов&quot;</B>';	
		}
	?>
	</tr>
	<tr><td>
	<!--Рюкзак / Прилавок-->
	<table width="100%" CELLSPACING="1" CELLPADDING="1" bgcolor="#a5a5a5">
	<?php
		//Выводим вещи в инвентаре для продажи
		if(isset($_GET['sale'])) {
			$itmAll = $u->genInv(16,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `im`.`price2` > 0 AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD` DESC');
			if($itmAll[0]==0)
			{
				$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО</td></tr>';
			}else{
				$itmAllSee = $itmAll[2];
			}
			echo '<tr><td align="center" bgcolor="#e2e0e0"><small>Продажа предметов купленных за екр. осуществляется с учетом износа предмета, а так-же налога на продажу.<br><b>Магазин принимает вещи за 90% от их стоимости, с <font color=red><b>аккаунтами:</b></font> <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');">Bronze</a> - 93%, <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');">Silver</a> - 95%, <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');">Gold</a> - 100%.</b><br><font color=red><b>Внимание!</b></font> Все улучшения, заточки, руны, зачарования предметов не входят в стоимость предмета при продаже! </small></td></tr>'.$itmAllSee;
		}else{
			//Выводим вещи в магазине для покупки
			$u->shopItems($sid);?>
			<?php 
		}
	?>
	</TABLE>	 
	</TD></TR>
	</TABLE>
    <div align="center">
    </div></TD>
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
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=2.180.0.234&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.9',1); ?>">Центральная площадь</a></td>
	</tr>

	<tr>
	<td bgcolor="#D3D3D3"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=2.180.0.399&rnd=<? echo $code; ?>';" title="<? thisInfRm('2.180.0.399',1); ?>">Артефактный магазин</a></td>
	</tr>

	</table>
	</td>
	</tr>
	</table>
	</td></table>
	</td></table>
	<div><br />
      <div align="center"><center>
      Масса всех ваших вещей: <b><?=$u->aves['now']?>/<?=$u->aves['max']?></b> &nbsp;<br />
	  У вас в наличии: <b style="color:#339900;"><font color=darkgreen><?php echo round($u->info['money2'],2); ?> екр.</b></font>
      <center>
	<?php

		/*кнопочки*/
		if($sale_ekr == true) {
			if(!isset($_GET['sale'])){ 
				echo '<INPUT TYPE="button" class="btn" value="Продать вещи" onclick="location=\'?otdel='.$_GET['otdel'].'&sale=1\'">&nbsp;';
			} else {
				echo '<INPUT TYPE="button" class="btn" value="Купить вещи" onclick="location=\'?otdel='.$_GET['otdel'].'\'">&nbsp;';
			}
		
	}
	?>
    <INPUT TYPE="button" class="btn" value="Обновить" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';">
    </center>
    <BR>
	  </div>
	<div style="background-color:#A5A5A5;padding:1"><center><B>Отделы магазина</B></center></div>
	<div style="line-height:17px;">
	<?php
		/*названия разделов (справа)*/
		$otdels_array = array (1=>'&nbsp;&nbsp;Кастеты,ножи',2=>'&nbsp;&nbsp;Топоры',3=>'&nbsp;&nbsp;Дубины,булавы',4=>'&nbsp;&nbsp;Мечи',5=>'&nbsp;&nbsp;Магические посохи',6=>'&nbsp;&nbsp;Сапоги',7=>'&nbsp;&nbsp;Перчатки',8=>'&nbsp;&nbsp;Рубахи',9=>'&nbsp;&nbsp;Легкая броня',10=>'&nbsp;&nbsp;Тяжелая броня',11=>'&nbsp;&nbsp;Шлемы',12=>'&nbsp;&nbsp;Наручи',13=>'&nbsp;&nbsp;Пояса',14=>'&nbsp;&nbsp;поножи',15=>'&nbsp;&nbsp;Щиты',16=>'&nbsp;&nbsp;Серьги',17=>'&nbsp;&nbsp;ожерелья',18=>'&nbsp;&nbsp;кольца',19=>'&nbsp;&nbsp;Нейтральные',20=>'&nbsp;&nbsp;Боевые и защитные',21=>'&nbsp;&nbsp;Амуниция',22=>'&nbsp;&nbsp;Эликсиры',23=>'&nbsp;&nbsp;Подарки',24=>'&nbsp;&nbsp;Недобрые',25=>'&nbsp;&nbsp;Открытки',26=>'&nbsp;&nbsp;Упаковка',27=>'&nbsp;&nbsp;Фейерверки',28=>'&nbsp;&nbsp;Плащи и накидки', 29=>'&nbsp;&nbsp;Подарочные сертификаты',29=>'&nbsp;&nbsp;Пещерные ресурсы',30=>'&nbsp;&nbsp;&nbsp;&nbsp;Еда',31=>'&nbsp;&nbsp;&nbsp;&nbsp;Чеки',32=>'&nbsp;&nbsp;&nbsp;&nbsp;Руны',33=>'&nbsp;&nbsp;&nbsp;&nbsp;Чарки',34=>'Тактики');
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
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/1.png"> <b>Оружие:</b></div>';
			} elseif($i == 6) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/2.png"> <b>Одежда:</b></div>';
			} elseif($i == 15) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/3.png"> <b>Щиты:</b></div>';
			} elseif($i == 16) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/4.png"> <b>Ювелирные товары:</b></div>';
			} elseif($i == 19) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/6.png"> <b>Заклинания:</b></div>';
			} elseif($i == 21) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/7.png"> <b>Амуниция:</b></div>';
			} elseif($i == 22) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/5.png"> <b>Эликсиры:</b></div>';
			} elseif($i == 23) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/8.png"> <b>Подарки:</b></div>';
			} elseif($i == 28) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/9.png"> <b>Дополнительно:</b></div>';
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
		$color = 'C7C7C7';	
		} 
		echo '</DIV>';
	}
	?>
	</div>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>