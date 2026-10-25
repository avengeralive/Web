<?php
//Коммиссионный магазин
if(!defined('GAME')) {
	die();
}

if($u->room['file']=='sand/commision')
{
	if(isset($u->stats['shopSale'],$_GET['sale']))
	{
	    $bns = 0+$u->stats['shopSale'];
	    if($bns!=0)
	    {
		if($bns>0)
		{
			$bns = '+'.$bns;
		}
		$shopProcent -= $bns;
		if($shopProcent>99){ $shopProcent = 99; }
		if($shopProcent<1){ $shopProcent = 1; }
		echo '<div style="color:grey;"><b>У Вас действует бонус при продаже: '.$bns.'%</b><br><small>Вы сможете продавать предметы за '.(100-$shopProcent).'% от их стоимости</small></div>';
	    }
	}
	
	if(!isset($_GET['otdel'])) $_GET['otdel'] = 1;

	$sid = 1;

	$error = '';
	
        # Выполнение функции покупки предмета
	if(isset($_GET['buy']))
	{
		if($u->info['allLock'] > time()) {
			$re = '<div align="left">Вам запрещается пользоваться данным магазином до '.date('d.m.y H:i',$u->info['allLock']).'</div>';
		}elseif($u->info['align'] == 2 || $u->info['haos'] > time()) {
			$re = '<div align="left">Хаосникам запрещается пользоваться данным магазином</div>';
		}elseif($u->newAct($_GET['sd4'])==true)
		{
			$re = $u->buyItemCommison($sid,(int)$_GET['itemid'],(int)$_GET['buy']);
		}else{
			$re = 'Вы уверены что хотите купить этот предмет?';
		}
	}
	
        /*
         * Выполнение функции "положить предмет в комисионку"
         * Или забрать предме из коммисионки.
         */
        
        if($u->info['align'] == 2 || $u->info['haos'] > time()) {
	    $re = '<div align="left">Хаосникам запрещается пользоваться данным магазином</div>';
	}elseif(isset($_POST['PresTR'])){
            $u->commisonRent(mysql_real_escape_string($_POST['PresTR']),(int)$_POST['iid'],(int)$_POST['summTR']);
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
	.pH3	{ COLOR: #8f0000;  FONT-FAMILY: Arial;  FONT-SIZE: 12pt;  FONT-WEIGHT: bold; }
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
	<tr><td valign="top"><?php
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
		'<b>Отдел&nbsp;&quot;Кастеты,ножи&quot;</b>',
		'<b>Отдел&nbsp;&quot;Топоры&quot;</b>',
		'<b>Отдел&nbsp;&quot;Дубины,булавы&quot;</b>',
		'<b>Отдел&nbsp;&quot;Мечи&quot;</b>',
		'<b>Отдел&nbsp;&quot;Магические посохи&quot;</b>',	
		'<b>Отдел&nbsp;&quot;Сапоги&quot;</b>',
		'<b>Отдел&nbsp;&quot;Перчатки&quot;</b>',
		'<b>Отдел&nbsp;&quot;Рубахи&quot;</b>',
		'<b>Отдел&nbsp;&quot;Легкая броня&quot;</b>',
		'<b>Отдел&nbsp;&quot;Тяжелая броня&quot;</b>',
		'<b>Отдел&nbsp;&quot;Шлемы&quot;</b>',
		'<b>Отдел&nbsp;&quot;Наручи&quot;</b>',
		'<b>Отдел&nbsp;&quot;Пояса&quot;</b>',
		'<b>Отдел&nbsp;&quot;Поножи&quot;</b>',
		'<b>Отдел&nbsp;&quot;Щиты&quot;</b>',
		'<b>Отдел&nbsp;&quot;Серьги&quot;</b>',
		'<b>Отдел&nbsp;&quot;Ожерелья&quot;</b>',
		'<b>Отдел&nbsp;&quot;Кольца&quot;</b>',
		'<b>Отдел&nbsp;&quot;Нейтральные&quot;</b>',		
		'<b>Отдел&nbsp;&quot;Боевые и защитные&quot;</b>',
		'<b>Отдел&nbsp;&quot;Пирожки&quot;</b>',
		'<b>Отдел&nbsp;&quot;Исцеляющие&quot;</b>',
		'<b>Отдел&nbsp;&quot;Манящие&quot;</b>',
		'<b>Отдел&nbsp;&quot;Стратегические&quot;</b>',
		'<b>Отдел&nbsp;&quot;Тактические&quot;</b>',
		'<b>Отдел&nbsp;&quot;Сервисные&quot;</b>',
		'<b>Отдел&nbsp;&quot;Амуниция&quot;</b>',
        '<b>Отдел&nbsp;&quot;Плащи и накидки&quot;</b>',
		'<b>Отдел&nbsp;&quot;Эликсиры&quot;</b>',
		'<b>Отдел&nbsp;&quot;Еда&quot;</b>',
		'<b>Отдел&nbsp;&quot;&nbsp;Подарки&quot;</b>',
		'<b>Отдел&nbsp;&quot;Недобрые&quot;</b>',
		'<b>Отдел&nbsp;&quot;Упаковка&quot;</b>',
		'<b>Отдел&nbsp;&quot;Открытки&quot;</b>',
		'<b>Отдел&nbsp;&quot;Фейерверки&quot;</b>',
		'<b>Отдел&nbsp;&quot;Усиление оружия: заточки&quot;</b>',
		'<b>Отдел&nbsp;&quot;Руны: I уровня&quot;</b>',
		'<b>Отдел&nbsp;&quot;Руны: II уровня&quot;</b>',
		'<b>Отдел&nbsp;&quot;Руны: III уровня&quot;</b>',
		'<b>Отдел&nbsp;&quot;Руны: IV уровня&quot;</b>',
		'<b>Отдел&nbsp;&quot;Чарки: I уровня&quot;</b>',
		'<b>Отдел&nbsp;&quot;Чарки: II уровня&quot;</b>',
		'<b>Отдел&nbsp;&quot;Чарки: III уровня&quot;</b>',
		'<b>Отдел&nbsp;&quot;Пещерные ресурсы&quot;</b>');
			if(isset($otdels_small_array[$_GET['otdel']])){
				echo $otdels_small_array[$_GET['otdel']];	
			}
			//echo '<br><b>Магазин принимает вещи 0-7 уровней под 100%, вещи 8-го уровня под 95%, вещи 9-го уровня, а так же свитки и эликсиры можно сдать в магазин под 70%.</b>';
			
		} 
	?>
	</tr>
	<tr><td>
	<!--Рюкзак / Прилавок-->
	<table width="100%" CELLSPACING="1" CELLPADDING="1" bgcolor="#a5a5a5">
    <?php
    
                /**
                 *  Вывод списка вещей продаваемых в комисионке 
                 *  Вывод вещей которые уже сдали в комок
                 */                    
		if(!isset($_GET['toRent'])){
			/*
                         * Выводим все вещи продоваемые в комке
                         * В режиме предварительного просмотра
                         */
			$u->commisionShop($sid,"preview");
		}elseif($_GET['toRent'] == 1){
			/*
                         * Выводим вещи из инвентарая 
                         * которые хотим сдать в комок			                      
                         */
            if($u->info['allLock'] < time())
			{
				$itmAll = $u->genInv(30,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0"
				AND `im`.`shop_category`!="99" AND `iu`.`inShop`!="30" AND `iu`.`inShop`!="1" AND `iu`.`gift` = ""
				AND `iu`.`data` NOT LIKE "%rune_id=%" AND `iu`.`data` NOT LIKE "%upatack_id=%" ORDER BY `lastUPD`  DESC');
			}else{
				$itmAll[0] = 0;
			}
			if($itmAll[0]==0){
                            $itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО</td></tr>';
			}else{
                            $itmAllSee = $itmAll[2];
			}
			echo $itmAllSee;
		}elseif($_GET['toRent'] == 2){
                        /*
                         *  Выводим вещи которые мы сдали в комок
                         */                    
                        $itmAll = $u->genInv(31,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="30" AND `iu`.`gift` = "" AND `iu`.`data` NOT LIKE "%fromshop=2%" ORDER BY `lastUPD`  DESC');
                        if($itmAll[0]==0){
                            $itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО</td></tr>';
			}else{
                            $itmAllSee = $itmAll[2];
			}
                        echo $itmAllSee;                                         
                }elseif($_GET['toRent'] == 3){
                    /*
                     * Выводим полный перечень вещей 
                     * продоваемых в комке по определенному 
                     * выбранному айтему
                     */
                    $u->commisionShop($sid,"full");                                       
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
	<td bgcolor="#D3D3D3"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=8.180.0.384&rnd=<? echo $code; ?>';" title="<? thisInfRm('8.180.0.384',1); ?>">Центральная Площадь</a></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</td></table>
	</td></table>
	<div><br>
      <div align="left">
      	Масса: <b><?=$u->aves['now']?>/<?=$u->aves['max']?></b> &nbsp;<br />
	У вас в наличии : <b><?php echo round($u->info['money'],2); ?></b> кр.
	<?php
	/*кнопочки*/
	
	echo '
	<INPUT TYPE="button" value="Сдать вещи" onclick="location=\'?toRent=1\'">&nbsp;	
	<INPUT TYPE="button" value="Забрать вещи" onclick="location=\'?toRent=2\'">&nbsp;
	';

	?>
    <INPUT TYPE="button" value="Обновить" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';">
	  </div>
	<div style="background-color:#A5A5A5;padding:1"><center><B>Отделы магазина</B></center></div>
	<div style="line-height:17px;">
	<?php
		/*названия разделов (справа)*/
		$otdels_array = array (
		'',
		'&nbsp;&nbsp;Кастеты,ножи',
		'&nbsp;&nbsp;Топоры',
		'&nbsp;&nbsp;Дубины,булавы',
		'&nbsp;&nbsp;Мечи',
		'&nbsp;&nbsp;Магические посохи',	
		'&nbsp;&nbsp;Сапоги',
		'&nbsp;&nbsp;Перчатки',
		'&nbsp;&nbsp;Рубахи',
		'&nbsp;&nbsp;Легкая броня',
		'&nbsp;&nbsp;Тяжелая броня',
		'&nbsp;&nbsp;Шлемы',
		'&nbsp;&nbsp;Наручи',
		'&nbsp;&nbsp;Пояса',
		'&nbsp;&nbsp;Поножи',
		'&nbsp;&nbsp;Щиты',
		'&nbsp;&nbsp;Серьги',
		'&nbsp;&nbsp;Ожерелья',
		'&nbsp;&nbsp;Кольца',
		'&nbsp;&nbsp;Нейтральные',		
		'&nbsp;&nbsp;Боевые и защитные',
		'&nbsp;&nbsp;Пирожки',
		'&nbsp;&nbsp;Исцеляющие',
		'&nbsp;&nbsp;Манящие',
		'&nbsp;&nbsp;Стратегические',
		'&nbsp;&nbsp;Тактические',
		'&nbsp;&nbsp;Сервисные',
		'&nbsp;&nbsp;Амуниция',
        '&nbsp;&nbsp;Плащи и накидки',
		'&nbsp;&nbsp;Эликсиры',
		'&nbsp;&nbsp;Еда',
		'&nbsp;&nbsp;Подарки',
		'&nbsp;&nbsp;Недобрые',
		'&nbsp;&nbsp;Упаковка',
		'&nbsp;&nbsp;Открытки',
		'&nbsp;&nbsp;Фейерверки',
		'&nbsp;&nbsp;Усиление оружия: заточки',
		'&nbsp;&nbsp;Руны: I уровня',
		'&nbsp;&nbsp;Руны: II уровня',
		'&nbsp;&nbsp;Руны: III уровня',
		'&nbsp;&nbsp;Руны: IV уровня',
		'&nbsp;&nbsp;Чарки: I уровня',
		'&nbsp;&nbsp;Чарки: II уровня',
		'&nbsp;&nbsp;Чарки: III уровня',
		'Пещерные ресурсы');
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
			  echo '<div class="shop_menu_txt"> <b>Оружие:</b></div>';
			} elseif($i == 6) {
			  echo '<div class="shop_menu_txt"> <b>Одежда:</b></div>';
			} elseif($i == 15) {
			  echo '<div class="shop_menu_txt"> <b>Щиты:</b></div>';
			} elseif($i == 16) {
			  echo '<div class="shop_menu_txt"> <b>Ювелирные товары:</b></div>';
			} elseif($i == 19) {
			  echo '<div class="shop_menu_txt"> <b>Заклинания:</b></div>';
			} elseif($i == 27) {
			  echo '<div class="shop_menu_txt"> <b>Амуниция:</b></div>';
			} elseif($i == 29) {
			  echo '<div class="shop_menu_txt"> <b>Эликсиры:</b></div>';
			} elseif($i == 31) {
			  echo '<div class="shop_menu_txt"> <b>Подарки:</b></div>';
			} elseif($i == 36) {
			  echo '<div class="shop_menu_txt"> <b>Усиления:</b></div>';
			} elseif($i == 44) {
			  echo '<div class="shop_menu_txt"> <b>Прочее:</b></div>';
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
		

	?>
	</div>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>
<?php
}
?>