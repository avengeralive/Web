<?php
if(!defined('GAME'))
{
	die();
}
//1006,1007,1008
if(isset($file) && $file[0]=='nec_shop.php')
{
	$shopProcent = 50;
			
	if(!isset($_GET['otdel'])) 
	{
		$_GET['otdel'] = 1;
	}

	$sid = 888;

	$error = '';
	
	if(isset($_GET['buy']))
	{
		if($u->newAct($_GET['sd4'])==true)
		{
			$re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x'],'sudba='.$u->info['login'].'|frompisher='.$d->info['id2'].'|nosale=1');
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
	<tr><td valign="top"><div align="center" class="pH3">Магазин Квилки</div>
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
			$otdels_small_array = array (
			'',
			'',
			'',
			'',
			'',
			'',
			'<b>Отдел&nbsp;&quot;Одежда: сапоги&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: перчатки&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: рубахи&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: легкая броня&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: тяжелая броня&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: шлемы&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: наручи&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: пояса&quot;</b>',
			'<b>Отдел&nbsp;&quot;Одежда: поножи&quot;</b>',
			'',
			'',
			'',
			'',
			
			'<b>Отдел&nbsp;&quot;Заклинания: нейтральные&quot;</b>',
			'<b>Отдел&nbsp;&quot;Заклинания: боевые и защитные&quot;</b>'
			,''
			,'<b>Отдел&nbsp;&quot;Заклинания: исцеляющие&quot;</b>'
			,'<b>Отдел&nbsp;&quot;Заклинания: манящие&quot;</b>'
			,'<b>Отдел&nbsp;&quot;Заклинания: стратегические&quot;</b>'
			,'<b>Отдел&nbsp;&quot;Заклинания: тактические&quot;</b>'
			,'<b>Отдел&nbsp;&quot;Заклинания: сервисные&quot;</b>'
			
			,'<b>Отдел&nbsp;&quot;Полезное&quot;</b>',
			'<b>Отдел&nbsp;&quot;Эликсиры&quot;</b>',
			'',
			'<b>Отдел&nbsp;&quot;Подарки&quot;</b>',
			'',
			'',
			'',
			'',
			'<b>Отдел&nbsp;&quot;Скупка: Обменник&quot;</b>',
			'');
			if(isset($otdels_small_array[$_GET['otdel']]))
			{
				echo $otdels_small_array[$_GET['otdel']];	
			}
			
		}
	?>
	</tr>
	<tr><td>
	<!--Рюкзак / Прилавок-->
	<table width="100%" CELLSPACING="1" CELLPADDING="1" bgcolor="#a5a5a5">
    <?php
		//Выводим вещи в магазине для покупки
		$u->shopItems($sid);
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
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?back=1&rnd=<?=$code?>';">Вернуться назад</a></td>
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
	  <?php
	  $repnec = mysql_fetch_array(mysql_query('SELECT `repnecro`,`repnecro_buy` FROM `rep` WHERE `id`="'.$u->info['id'].'" LIMIT 1;'));
	  
	  ?>
	  Масса: <?=$u->aves['now']?>/<?=$u->aves['max']?> &nbsp;<br />
	  Репутация: <?=$repnec['repnecro']?> &nbsp;<br />
	  Репутация исследователя: <?=$repnec['repnecro_buy']?> &nbsp;<br />
      </small>
      </div>
	  <br />
    <center><INPUT TYPE="button" class="btn btn-inverse" value="Обновить" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';"></center><BR>
	  </div>
	<div style="background-color:#A5A5A5;padding:1"><center><B>Отделы магазина</B></center></div>
	<div style="line-height:17px;">
	<style>.shop_menu_txt { background-color: #d5d5d5; }</style>
	<?php
		/*названия разделов (справа)*/
		$otdels_array = array (
		'',
		'',
		'',
		'',
		'',
		'',	
		'&nbsp;&nbsp;Сапоги',
		'&nbsp;&nbsp;Перчатки',
		'&nbsp;&nbsp;Рубахи',
		'&nbsp;&nbsp;Легкая броня',
		'&nbsp;&nbsp;Тяжелая броня',
		'&nbsp;&nbsp;Шлемы',
		'&nbsp;&nbsp;Наручи',
		'&nbsp;&nbsp;Пояса',
		'&nbsp;&nbsp;Поножи',
		'',
		'',
		'',
		'',
		
		'&nbsp;&nbsp;Нейтральные',		
		'&nbsp;&nbsp;Боевые и защитные',
		'',
		'&nbsp;&nbsp;Исцеляющие',
		'&nbsp;&nbsp;Манящие',
		'&nbsp;&nbsp;Стратегические',
		'&nbsp;&nbsp;Тактические',
		'&nbsp;&nbsp;Сервисные',
		
		'&nbsp;&nbsp;Разное',
		'&nbsp;&nbsp;Эликсиры',
		'',
		'&nbsp;&nbsp;Подарки',
		'',
		'',
		'',
		'',
		'&nbsp;&nbsp; Скупка',
		//'Наставничество: образы'
		'');
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
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/2.png"> <b>Награбаленное:</b></div>';
			} elseif($i == 19) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/6.png"> <b>Свитки:</b></div>';
			} elseif($i == 27) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/7.png"> <b>Полезное:</b></div>';
			} elseif($i == 30) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/8.png"> <b>Сувениры:</b></div>';
			} elseif($i == 35) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/9.png"> <b>Обменник:</b></div>';
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
die();
?>