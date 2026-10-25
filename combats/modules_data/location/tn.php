<?php
if(!defined('GAME'))die();

if(isset($file) && $file[0]=='tn.php'){
    if(isset($_GET['back'])) {
		mysql_query('UPDATE `stats` SET `x` = "9",`y` = "-12",`s` = "1" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		header('location: main.php');
	}

	$test = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_tn_use" LIMIT 1'));
    if(isset($test['id']) && $test['uid'] != $u->info['id'])
	{
		mysql_query('UPDATE `stats` SET `x` = "9",`y` = "-12",`s` = "1" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		header('location: main.php');
		die();
	}elseif(!isset($test['id'])) {
		if( $u->info['sex'] == 0 )
			{
			$d->sys_chat('<b>'.$u->info['login'].'</b> воспользовался &quot;Заросшая Кузница&quot;, другим данный обьект стал недоступен');
			}else{
			$d->sys_chat('<b>'.$u->info['login'].'</b> воспользовалась &quot;Заросшая Кузница&quot;, другим данный обьект стал недоступен');
		}
   		mysql_query('INSERT INTO `dungeon_actions` (`dn`,`uid`,`time`,`vars`) VALUES (
			"'.$u->info['dnow'].'","'.$u->info['id'].'","'.time().'","obj_tn_use"
		)');
    }
	
    if(!isset($_GET['otdel']))
	{
		$_GET['otdel'] = 6;
    }

    $sid = 7;
	
    $error = '';
    
    if(isset($_GET['buy']))
	{
		if($u->newAct($_GET['sd4'])==true)
		{
			$re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x'],'frompisher='.$d->info['id2'].'|nosale=1');//'.$u->info['login'].'sudba=0|
		}else{
			$re = 'Вы уверены что хотите купить этот предмет?';
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
				<div align="center" class="pH3">Заросшая Кузница</div><?php
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
	$otdels_small_array = array (
	
	6=> '<b>Одежда: Сапоги</b>',
	7=> '<b>Одежда: Перчатки</b>',
    13=> '<b>Одежда: Пояса</b>',
	10=> '<b>Одежда: Броня</b>',
	11=> '<b>Одежда: Шлемы</b>',
	12=> '<b>Одежда: Наручи</b>',
    15=> '<b>Одежда: Щиты</b>',
	16=> '<b>Отдел&nbsp;&quot;Ювелирные товары: серьги&quot;</b>',
	17=> '<b>Одежда: Амулеты</b>',
		
	); 
	if(isset($otdels_small_array[$_GET['otdel']]))
	{
	echo $otdels_small_array[$_GET['otdel']];	
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
							Масса: <?=$u->aves['now']?>/<?=$u->aves['max']?> &nbsp;<br />
							У вас в наличии: <b style="color:#339900;"><?php echo round($u->info['money'],2); ?> кр.</b> &nbsp;
						</small>
					</div>
					<br />
					<INPUT TYPE="button" class="btn-ss1" value="Обновить" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';"><BR>
				</div>
				<div style="background-color:#A5A5A5;padding:1"><center><B>Отделы магазина</B></center></div>
				<div style="line-height:17px;">
<?php
		/*названия разделов (справа)*/
	$otdels_array = array (
	6=> '<b>Одежда: Сапоги</b>',
	7=> '<b>Одежда: Перчатки</b>',
    13=> '<b>Одежда: Пояса</b>',
	10=> '<b>Одежда: Броня</b>',
	11=> '<b>Одежда: Шлемы</b>',
	12=> '<b>Одежда: Наручи</b>',
    15=> '<b>Одежда: Щиты</b>',
	16=> '<b>Одежда: Серьги</b>',
	17=> '<b>Одежда: Амулеты</b>',
	);
	
	foreach($otdels_array as $key=>$val)
	{
	if(isset($key) && isset($val))
		{
		if(isset($_GET['otdel']) && $_GET['otdel']==$key) 
			{
		$color = 'C7C7C7';	
			} else {
		$color = 'e2e0e0';
			}
		echo '<A HREF="?otdel='.$key.'"><DIV style="background-color: #'.$color.'">'.$otdels_array[$key].'</DIV></A>';
		} 
	} 
?>
	</div><br /><hr />
    <center>
	<small>
      <b style="color:red">(Все вещи связываются <img src="https://img.testcombats.ru/i/desteny.gif" width="16" height="18" /> Общей Судьбой с тем, кто их купил!)</b>
    </small>
    </center>
			</td>
		</tr>
		</tr>
    </table>
	<br>
    <div id="textgo" style="visibility:hidden;"></div>
	
	
<?
}
?>
