<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='cc/pzshop')
{
	if(!isset($_GET['otdel'])) 
	{
		$_GET['otdel'] = 6;
	}
	
	$sid = 610;

	$error = '';
	
		
	if(isset($_GET['buy']))
	{
		if($u->newAct($_GET['sd4'])==true)
		{
			$re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x']);
		}else{
			$re = '<div align="left"><font style="display:none;font-size:8pt;">Вы уверены что хотите купить этот предмет?</font></div>';
		}
	}
	
	if($re!=''){ 
	echo '<div align="right"><font style="8pt;" color="red"><b>'.$re.'</b></font></div>';
	} ?>
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
    .shop_menu_txt { background-color: #d5d5d5; }
	</style>
	<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr><td valign="top"><div align="center" class="pH3"><? echo $u->room['name']; ?></div>
	<?php
	echo '<b style="font-size:8pt;color:red">'.$error.'</b>';
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
		if(!isset($_GET['gifts']) && isset($_GET['otdel'])) 
		{
			$otdels_small_array = array (1=>'',2=>'',3=>'',4=>'',5=>'',6=>'<b>Отдел&nbsp;&quot;Одежда: сапоги&quot;</b>',7=>'<b>Отдел&nbsp;&quot;Одежда: перчатки&quot;</b>',8=>'<b>Отдел&nbsp;&quot;Одежда: рубахи&quot;</b>',28=>'<b>Отдел&nbsp;&quot;Одежда: плащи&quot;</b>',9=>'<b>Отдел&nbsp;&quot;Одежда: легкая броня&quot;</b>',10=>'<b>Отдел&nbsp;&quot;Одежда: тяжелая броня&quot;</b>',11=>'<b>Отдел&nbsp;&quot;Одежда: шлемы&quot;</b>',12=>'<b>Отдел&nbsp;&quot;Одежда: наручи&quot;</b>',13=>'<b>Отдел&nbsp;&quot;Одежда: пояса&quot;</b>',14=>'<b>Отдел&nbsp;&quot;Одежда: поножи&quot;</b>',15=>'<b>Отдел&nbsp;&quot;Щиты&quot;</b>',16=>'<b>Отдел&nbsp;&quot;Ювелирные товары: серьги&quot;</b>',17=>'<b>Отдел&nbsp;&quot;Ювелирные товары: ожерелья&quot;</b>',18=>'<b>Отдел&nbsp;&quot;Ювелирные товары: кольца&quot;</b>',19=>'',20=>'',21=>'<b>Отдел&nbsp;&quot;Амуниция&quot;</b>',22=>'',23=>'',24=>'',25=>'',26=>'',27=>'');
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
    <div align="center">
      <? }else{ ?>
      <div align="center"><font style="font-size:8pt;color:red;">В прилавке собраны лучшие товары забытых мастеров которые усилят вас и помогут в достижении побед в поединках</font></div>
      <? } ?>
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
	<td bgcolor="#D3D3D3"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.13&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.13',1); ?>">Березка</a></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</td></table>
	</td></table>
	<div><br />
      <div align="left">
      <small>
	  Масса: <?=$u->aves['now']?>/<?=$u->aves['max']?> &nbsp;<br />
	  У вас в наличии : <b><?php echo round($u->info['money'],2); ?></b> кр.<br />
	  У вас в наличии : <b style="color:#339900;"><font color="darkgreen"><?php echo round($u->info['money2'],2); ?></b></font> екр.<br>

	  <INPUT TYPE="button" value="Обновить" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';">
	 </small></div></div>
	<div style="background-color:#A5A5A5;padding:1"><center><B>Отделы магазина</B></center></div>
	<div style="line-height:17px;">
	<?php
		/*названия разделов (справа)*/
		$otdels_array = array (
		1=>'',
		2=>'',
		3=>'',
		4=>'',
		5=>'',
		6=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Сапоги',
		7=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Перчатки',
		8=>'',
		9=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Легкая броня',
		10=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Тяжелая броня',
		11=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Шлемы',
		12=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Наручи',
		13=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Пояса',
		14=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Поножи',
		15=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Щиты',
		16=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Серьги',
		17=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ожерелья',
		18=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Кольца',
		19=>'',
		20=>'',
		21=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Амуниция'/*,
		22=>'',
		23=>'',
		24=>'',
		25=>'',
		26=>'',
		27=>'',
		28=>'',
		29=>'Слоты смены: Постоянные',
		30=>'&nbsp;&nbsp;Временные слоты смены'*/);
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
				if($i == 6) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/2.png"> <b>Одежда:</b></div>';
			} elseif($i == 15) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/3.png"> <b>Щиты:</b></div>';
			} elseif($i == 16) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/4.png"> <b>Ювелирные товары:</b></div>';
			} /* elseif($i == 19) {
			  echo '<div class="shop_menu_txt"><img height="12" width="12" src="i/shop_ico/6.png"> <b>Заклинания:</b></div>';
			}  */elseif($i == 21) {
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
		} ?>
	</div>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>