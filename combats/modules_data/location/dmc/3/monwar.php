<?php
if(!defined('GAME'))die();

if(isset($file) && $file[0]=='/dmc/3/monwar.php'){
    if(isset($_GET['back'])) {
		mysql_query('UPDATE `stats` SET `x` = "8",`y` = "81",`s` = "2" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		header('location: main.php');
	}
	$test = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_pavel_alt_use" LIMIT 1'));
    if(isset($test['id']) && $test['uid'] != $u->info['id']) {
		mysql_query('UPDATE `stats` SET `x` = "8",`y` = "81",`s` = "2" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		header('location: main.php');
		die();
    }elseif(!isset($test['id'])) {
		if( $u->info['sex'] == 0 ) {
			$d->sys_chat('<b>'.$u->info['login'].'</b> воспользовался &quot;Алтарем Крови&quot;, другим данный обьект стал недоступен');
		}else{
			$d->sys_chat('<b>'.$u->info['login'].'</b> воспользовалась &quot;Алтарем Крови&quot;, другим данный обьект стал недоступен');
		}
		mysql_query('INSERT INTO `dungeon_actions` (`dn`,`uid`,`x`,`y`,`time`,`vars`) VALUES (
			"'.$u->info['dnow'].'","'.$u->info['id'].'","8","82","'.time().'","obj_altar_blood_use"
		)');
    }
    if(!isset($_GET['otdel'])){
		$_GET['otdel'] = 21;
    }

    $sid = 11;

    $error = '';
    
    if( isset($_GET['buy']) ) {
	if( $u->newAct($_GET['sd4']) == true ){
	    $re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x'],'sudba='.$u->info['login'].'|frompisher='.$d->info['id2'].'|nosale=1');
	}else{
	    $re = 'Вы уверены что хотите получить этот предмет?';
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
	.pH3 { COLOR: #8f0000;  FONT-FAMILY: Arial;  FONT-SIZE: 12pt;  FONT-WEIGHT: bold; }
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
		<tr>
			<td valign="top">
				<div align="center" class="pH3">Алтарь Крови</div><?php
				echo '<b style="color:red">'.$error.'</b>';
				?><br />
				<TABLE width="100%" cellspacing="0" cellpadding="4">
					<TR>
						<TD valign="top" align="left">
							<form name="F1" method="post">
								<!--Магазин-->
								<div id="hint3" style="visibility:hidden"></div>
								<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#a5a5a5">
									<tr>
										<td align="center" height="21">
    <?php	
		/*названия разделов (сверху)*/
		if(!isset($_GET['sale']) && !isset($_GET['gifts']) && isset($_GET['otdel'])) 
		{
			$otdels_small_array = array (1=>'<b>Отдел&nbsp;&quot;Оружие: кастеты,ножи&quot;</b>',2=>'<b>Отдел&nbsp;&quot;Оружие: топоры&quot;</b>',3=>'<b>Отдел&nbsp;&quot;Оружие: дубины,булавы&quot;</b>',4=>'<b>Отдел&nbsp;&quot;Оружие: мечи&quot;</b>',5=>'<b>Отдел&nbsp;&quot;Оружие: магические посохи&quot;</b>',6=>'<b>Отдел&nbsp;&quot;Одежда: сапоги&quot;</b>',7=>'<b>Отдел&nbsp;&quot;Одежда: перчатки&quot;</b>',8=>'<b>Отдел&nbsp;&quot;Одежда: рубахи&quot;</b>',9=>'<b>Отдел&nbsp;&quot;Одежда: легкая броня&quot;</b>',10=>'<b>Отдел&nbsp;&quot;Одежда: тяжелая броня&quot;</b>',11=>'<b>Отдел&nbsp;&quot;Одежда: шлемы&quot;</b>',12=>'<b>Отдел&nbsp;&quot;Одежда: наручи&quot;</b>',13=>'<b>Отдел&nbsp;&quot;Одежда: пояса&quot;</b>',14=>'<b>Отдел&nbsp;&quot;Одежда: поножи&quot;</b>',15=>'<b>Отдел&nbsp;&quot;Щиты&quot;</b>',16=>'<b>Отдел&nbsp;&quot;Ювелирные товары: серьги&quot;</b>',17=>'<b>Отдел&nbsp;&quot;Ювелирные товары: ожерелья&quot;</b>',18=>'<b>Отдел&nbsp;&quot;Ювелирные товары: кольца&quot;</b>',19=>'<b>Отдел&nbsp;&quot;Заклинания: нейтральные&quot;</b>',20=>'<b>Отдел&nbsp;&quot;Заклинания: боевые и защитные&quot;</b>',21=>'<b>Отдел&nbsp;&quot;Амуниция&quot;</b>',22=>'<b>Отдел&nbsp;&quot;Эликсиры&quot;</b>',23=>'<b>Отдел&nbsp;&quot;Ресурсы&quot;</b>',24=>'<b>Отдел&nbsp;&quot;Поножи&quot;</b>',25=>'<b>Отдел&nbsp;&quot;Подарки: упаковка&quot;</b>',26=>'<b>Отдел&nbsp;&quot;Подарки: открытки&quot;</b>',27=>'<b>Отдел&nbsp;&quot;Подарки: фейерверки&quot;</b>');
			if(isset($otdels_small_array[$_GET['otdel']]))
			{
				echo $otdels_small_array[$_GET['otdel']];	
			}
			
		}
	?>
										</td>
									</tr>
									<tr>
										<td>
											<!--Рюкзак / Прилавок-->
											<table width="100%" CELLSPACING="1" CELLPADDING="1" bgcolor="#a5a5a5"><?php
												//Выводим вещи в магазине для покупки
												$u->shopItems($sid);
											?></TABLE>	 
										</TD>
									</TR>
								</TABLE> 
							</FORM>
						</TD>
					</TR>
				</TABLE>
			</td>
			<td width="280" valign="top">
				<TABLE cellspacing="0" cellpadding="0">
					<tr>
						<TD width="100%">&nbsp;</TD>
						<TD>
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
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div><br />
      <div align="right">
      <small>
	  <?php
		$poj = mysql_fetch_array(mysql_query('SELECT `rep2`,`rep2_buy` FROM `rep` WHERE `id`="'.$u->info['id'].'" LIMIT 1;'));
	  ?>
	  Масса: <?=$u->aves['now']?>/<?=$u->aves['max']?> &nbsp;<br />
	  У вас в наличии: <b style="color:#339900;"><?php echo round($u->info['money'],2); ?> кр.</b> &nbsp;<br/>
	  Общее кол-во пожертвований: <b style="color:#339900;"><?php echo $poj['rep2']; ?></b>
		<?php 
		if($poj['rep2']>99){
		   $repimg = '<img src="/img.testcombats.ru/znbl_1.gif" title="Алтарь Крови: Посвященный первого круга">';
		}
		elseif($poj['rep2']>999){
		   $repimg = '<img src="/img.testcombats.ru/znbl_1.gif" title="Алтарь Крови: Посвященный второго круга">';
		}
		else{
			$repimg ='';
		}
		echo $repimg;
		?>&nbsp;<br>
		Доступное для покупки: <b style="color:#339900;"><?php echo $poj['rep2_buy']; ?></b>&nbsp;<br/>
	  </small>
      </div>
					<br />
					<center><INPUT TYPE="button" value="Обновить" class="btn btn-inverse" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';"></center></BR>
				</div>
				<div style="background-color:#A5A5A5;padding:1"><center><B>Отделы магазина</B></center></div>
				<div style="line-height:17px;">
	<?php
		/*названия разделов (справа)*/
		$otdels_array = array (19=>'Заклинания: нейтральные',20=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;боевые и защитные',21=>'Амуниция',22=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Эликсиры',23=>'Ресурсы',24=>'Поножи');
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
			echo '
			<A HREF="?otdel='.$i.'"><DIV style="background-color: #'.$color.'">
			'.$otdels_array[$i].'
			</A></DIV>
			';
			} else {
				if($i > 30) {
					$i = -2;
				}
			}
			$i++;
		}
	?>
				</div></br>
				    <hr />
    <center><small>
      <b style="color:red">(Все вещи связываются <img src="/img.testcombats.ru/i/desteny.gif" width="16" height="18" /> Общей Судьбой с тем, кто их купил!)</b>
    </small>
    </center>
			</td>
		</tr>
    </table>
	<br>
    <div id="textgo" style="visibility:hidden;"></div>
<?
}
?>