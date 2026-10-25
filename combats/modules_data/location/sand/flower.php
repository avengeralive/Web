<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='sand/flower')
{
	$shopProcent = 50;
	
	if(isset($_POST['itemgift']))
	{
		$to = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['to_login']).'" ORDER BY `id` ASC LIMIT 1'));
	if(isset($to['id'])) {
	if($u->info['align'] == 2 || $u->info['haos'] > time()) {
		$re = '<div align="left">Хаосникам запрещается делать подарки другим игрокам</div>';
	}elseif($to['id']==$u->info['id']) {
		$re = '<div align="left">Очень щедро дарить что-то самому себе.</div>';
	}elseif($u->info['level']<8) {
		$re = '<div align="left">Дарить подарки можно начиная с 4-го уровня</div>';
	}else{
				if( $_POST['itemgift'] > 1000000000000 ) {
					$itm_l = mysql_fetch_array(mysql_query('SELECT * FROM `users_gifts` WHERE `uid` = "'.$u->info['id'].'" AND `id` = "'.mysql_real_escape_string((int)$_POST['itemgift']-1000000000000).'" LIMIT 1'));
					if( isset($itm_l['id']) && $itm_l['money'] > $u->info['money'] ) {
						$re = '<div align="left">Недостаточно денег</div>';
					}elseif( isset($itm_l['id']) ) {
						$itm = $u->addItem(4533,1,'|gift_id='.$itm_l['id'].'');
						if( $itm > 0 ) {
							$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE (`im`.`type` = "28") AND `iu`.`id` = "'.mysql_real_escape_string($itm).'" AND `iu`.`uid` = "1" AND `iu`.`gift` = "" AND `iu`.`delete` = "0" AND `iu`.`inOdet` = "0" AND `iu`.`inShop` = "0" LIMIT 1'));
							if(isset($itm['id'])) {
								$u->info['money'] -= $itm_l['money'];
								mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								
								$itm['gtxt1'] = $_POST['podarok2'];
								$itm['gtxt2'] = $_POST['txt'];
													
								$itm['gtxt1'] = str_replace('\x3C','<',$itm['gtxt1']);
								$itm['gtxt1'] = str_replace('\x3','>',$itm['gtxt1']);	
								$itm['gtxt1'] = htmlspecialchars($itm['gtxt1'],NULL,'cp1251');
								$itm['gtxt2'] = str_replace('\x3C','<',$itm['gtxt2']);
								$itm['gtxt2'] = str_replace('\x3','>',$itm['gtxt2']);	
								$itm['gtxt2'] = htmlspecialchars($itm['gtxt2'],NULL,'cp1251');
								
								$giftlogin = $u->info['login'];
								
								if( $_POST['from'] == 1 ) {
									//Анонимно
									$giftlogin = '<i>Анонима</i>';
								}elseif( $_POST['from'] == 2 && $u->info['clan'] > 0 ) {
									//От клана
									$cln = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$u->info['clan'].'" LIMIT 1'));
									if(isset($cln['id'])) {
										$giftlogin = 'клана <img src="//img.testcombats.ru/i/clan/'.$cln['id'].'.gif"> <b>'.$cln['name'].'</b>';
									}
								}
								
								$fspam = $filter->spamFiltr(str_replace('точка','.',str_replace('ру','ru',$itm['gtxt1']))); 								
								if( $fspam != '0' ) {
									$itm['gtxt1'] = '<font color=red><b>&lt;РВС&gt;</b></font>';
									$itm['gtxt2'] = '<font color=red><b>&lt;РВС&gt;</b></font>';
								}
								
								$upd = mysql_query('UPDATE `items_users` SET `data` = "'.$itm['data'].'",`gtxt1` = "'.mysql_real_escape_string($itm['gtxt1']).'",`gtxt2` = "'.mysql_real_escape_string($itm['gtxt2']).'", `uid` = "'.$to['id'].'", `gift` = "'.$giftlogin.'",`time_create` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
								$whos = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$to['id'].'" LIMIT 1'));
								$ld = $u->addDelo(1, $to['id'],'&quot;<font color=#C65F00>Shop.'.$u->info['city'].'</font>&quot;: Получен подарок от  [id="'.$u->info['id'].'"/ Логин : "'.$u->info['login'].'"]. Предмет [id="'.$itm['id'].'"/ Название : "'.$itm['name'].'"]',time(),$u->info['city'],'Shop.gift',0,0);
								$ld = $u->addDelo(1, $u->info['id'],'&quot;<font color=#C65F00>Shop.'.$u->info['city'].'</font>&quot;: Сделал подарок персонажу  [id="'.$to['id'].'"/ Логин : "'.$whos['login'].'"]. Предмет [id="'.$itm['id'].'"/ Название : "'.$itm['name'].'"]',time(),$u->info['city'],'Shop.gift',0,0);
								if($upd)
								{
									$re = '<div align="left">Подарок был успешно отправлен к &quot;'.$to['login'].'&quot; за '.$itm_l['money'].' кр.</div>';
									if( $giftlogin == $u->info['login'] ) {
										$text = ' Получен подарок <b>'.$itm_l['name'].'</b>. От персонажа [login:'.$u->info['login'].'] .';
									}else{
										$text = ' Получен подарок <b>'.$itm_l['name'].'</b>. От персонажа '.$giftlogin.' .';
									}
									mysql_query("INSERT INTO `chat` (`new`, `city`, `room`, `login`, `to`, `text`, `time`, `type`, `toChat`) VALUES ('1','".$u->info['city']."', '', '', '".$to['login']."', '".$text."', '".time()."', '6', '0')");
								}else{
									$re = '<div align="left">Не удалось сделать подарок</div>';
								}
							}else{
								$re = '<div align="left">Не удалось сделать подарок, он испортился...</div>';
							}
						}else{
							$re = '<div align="left">Не удалось сделать подарок, курьер случайно сломал его...</div>';
						}
					}else{
						$re = '<div align="left">Предмет не найден</div>';
					}
				}else{
					$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE (`im`.`type` = "28") AND `iu`.`id` = "'.mysql_real_escape_string($_POST['itemgift']).'" AND `iu`.`uid` = "'.$u->info['id'].'" AND (`iu`.`gift` = "" OR (`iu`.`data` LIKE "%|zazuby=%" AND `iu`.`gift` = 1)) AND `iu`.`delete` = "0" AND `iu`.`inOdet` = "0" AND `iu`.`inShop` = "0" LIMIT 1'));
					$po = $u->lookStats($itm['data']);
					 If(isset($itm['id']))
					{
						//$itm['data'] = '';
						
						$itm['gtxt1'] = $_POST['podarok2'];
						$itm['gtxt2'] = $_POST['txt'];
											
						$itm['gtxt1'] = str_replace('\x3C','<',$itm['gtxt1']);
						$itm['gtxt1'] = str_replace('\x3','>',$itm['gtxt1']);	
						$itm['gtxt1'] = htmlspecialchars($itm['gtxt1'],NULL,'cp1251');
						$itm['gtxt2'] = str_replace('\x3C','<',$itm['gtxt2']);
						$itm['gtxt2'] = str_replace('\x3','>',$itm['gtxt2']);	
						$itm['gtxt2'] = htmlspecialchars($itm['gtxt2'],NULL,'cp1251');
						
						$fspam = $filter->spamFiltr(str_replace('точка','.',str_replace('ру','ru',$itm['gtxt1']))); 								
						if( $fspam != '0' ) {
							$itm['gtxt1'] = '<font color=red><b>&lt;РВС&gt;</b></font>';
							$itm['gtxt2'] = '<font color=red><b>&lt;РВС&gt;</b></font>';
						}
						
						$giftlogin = $u->info['login'];
								
						if( $fspam != '0' ) {
							//Если спам то хуй анонимно!
						}elseif( $_POST['from'] == 1 ) {
							//Анонимно
							$giftlogin = '<i>Анонима</i>';
						}elseif( $_POST['from'] == 2 && $u->info['clan'] > 0 ) {
							//От клана
							$cln = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$u->info['clan'].'" LIMIT 1'));
							if(isset($cln['id'])) {
								$giftlogin = 'клана  '.$cln['name'].'';
							}
						}
						
						$upd = mysql_query('UPDATE `items_users` SET `data` = "'.$itm['data'].'",`gtxt1` = "'.mysql_real_escape_string($itm['gtxt1']).'",`gtxt2` = "'.mysql_real_escape_string($itm['gtxt2']).'", `uid` = "'.$to['id'].'", `gift` = "'.$giftlogin.'",`time_create` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
						$whos = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$to['id'].'" LIMIT 1'));
						$ld = $u->addDelo(1, $to['id'],'&quot;<font color=#C65F00>Shop.'.$u->info['city'].'</font>&quot;: Получен подарок от  [id="'.$u->info['id'].'"/ Логин : "'.$u->info['login'].'"]. Предмет [id="'.$itm['id'].'"/ Название : "'.$itm['name'].'"] ('.$giftlogin.')',time(),$u->info['city'],'Shop.gift',0,0);
						$ld = $u->addDelo(1, $u->info['id'],'&quot;<font color=#C65F00>Shop.'.$u->info['city'].'</font>&quot;: Сделал подарок персонажу  [id="'.$to['id'].'"/ Логин : "'.$whos['login'].'"]. Предмет [id="'.$itm['id'].'"/ Название : "'.$itm['name'].'" ('.$giftlogin.')]',time(),$u->info['city'],'Shop.gift',0,0);
						if($upd)
						{
							$re = '<div align="left">Подарок был успешно отправлен к &quot;'.$to['login'].'&quot;</div>';
							if( $giftlogin == $u->info['login'] ) {
								$text = ' Получен подарок <b>'.$itm['name'].'</b>. От персонажа [login:'.$u->info['login'].'] .';
							}else{
								$text = ' Получен подарок <b>'.$itm['name'].'</b>. От персонажа '.$giftlogin.' .';
							}
							mysql_query("INSERT INTO `chat` (`new`, `city`, `room`, `login`, `to`, `text`, `time`, `type`, `toChat`) VALUES ('1','".$u->info['city']."', '', '', '".$to['login']."', '".$text."', '".time()."', '6', '0')");
						}else{
							$re = '<div align="left">Не удалось сделать подарок</div>';
						}
					}else{
						$re = '<div align="left">Предмет не найден</div>';
					}
				}
			}
		}else{
			$re = '<div align="left">Персонаж с таким логином не найден</div>';
		}
	}
	
	if( $_GET['otdel'] == 4 ) {
		if( (int)date('m') != 2 || (int)date('d') < 14 ) {
			unset($_GET['otdel']);
		}
}
			
	if(!isset($_GET['otdel'])) 
	{
		$_GET['otdel'] = 1;
	}

	$sid = 6;

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
	
	if($re!=''){ echo '<div align="left"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
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
<script LANGUAGE='JavaScript'>
document.ondragstart = test;
//запрет на перетаскивание
document.onselectstart = test;
//запрет на выделение элементов страницы
document.oncontextmenu = test;
//запрет на выведение контекстного меню
function test() {
 return false
}
</SCRIPT>
	<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr><td valign="top"><div align="center" class="pH3">Цветочный магазин</div>
	<?php
	echo '<b style="color:red">'.$error.'</b>';
	?>
	<br />
	<TABLE width="100%" cellspacing="0" cellpadding="4">
	<TR>
	<form name="F1" method="post">
	<TD valign="top" align="left">
	<!--Магазин-->
    <? if((int)$_GET['otdel']!=2){ ?>
	<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#a5a5a5">
	<div id="hint3" style="visibility:hidden"></div>
	<tr>
	<td align="center" height="21">
    <?php	
		/*названия разделов (сверху)*/
		if(!isset($_GET['sale']) && !isset($_GET['gifts']) && isset($_GET['otdel'])) 
		{
			$otdels_small_array = array (1=>'<b>Отдел&nbsp;&quot;Общий зал&quot;</b>',2=>'',3=>'<b>Отдел&nbsp;&quot;Венки&quot;</b>',4=>'',9=>'');
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
	 <?php if(isset($_GET['gifts'])) { ?>
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
    <?php }if(isset($_GET['gifts'])){
			$htmlg2 = '';			
			$sp = mysql_query('SELECT * FROM `users_gifts` WHERE `uid` = "'.$u->info['id'].'"');
			while( $pl = mysql_fetch_array($sp) )
			{
				$itmg2 = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="160" align="center" style="border-right:#A5A5A5 1px solid; padding:5px;">'.
					'<img style="padding-bottom:5px;" src="//img.testcombats.ru/i/items/'.$pl['img'].'"><br>'.
					'<input onClick="document.getElementById(\'itemgift\').value='.(10+$pl['id']).';document.F1.submit();" type="button" value="Подарить за '.$pl['money'].' кр.">'.
				'</td><td align="left" valign="top" style="border-right:#A5A5A5 1px solid; padding:5px;">'.
					'<a href="//testcombats.ru/item/0">'.$pl['name'].'</a> &nbsp; (Масса: 1)<br>Долговечность: 0/1<br>'.
					'<small><b>Описание:</b><br>Это именной подарок, его можете подарить только Вы.<br>Сделано в Capital city</small>'.
				'</td></tr></table>';
				$htmlg2 .= '<tr><td align="center" bgcolor="#e2e0e0">'.$itmg2.'</td></tr>';
			}			
			if( $htmlg2 != '' ) {
				echo '<tr><td align="center" bgcolor="#e2e0e0"><h3>Уникальные подарки</h3>' . $htmlg2 . '</td></tr>';
				echo '<tr><td align="center" bgcolor="#e2e0e0"><h3>Стандартные подарки</h3></td></tr>';
			}
			unset($htmlg2,$itmg2);
            
			$itmAll = $u->genInv(3,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND (`im`.`type` = "28") AND (`iu`.`gift` = "" OR (`iu`.`data` LIKE "%|zazuby=%" AND `iu`.`gift` = 1)) ORDER BY `lastUPD` DESC');
			if($itmAll[0]==0){
				$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">У вас нет подходящих предметов</td></tr>';
			}else{
				$itmAllSee = $itmAll[2];
			}
            
			echo $itmAllSee;
		}elseif(!isset($_GET['sale']))
		{
			//Выводим вещи в магазине для покупки
           $u->shopItems($sid);
        }else{
			//Выводим вещи в инвентаре для продажи
            //dStart('geninv');
			$itmAll = $u->genInv(2,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0"
			AND `iu`.`data` NOT LIKE "%fromshop=2%" AND `iu`.`data` NOT LIKE "%frompisher=%" AND `iu`.`data` NOT LIKE "%art=1%"
            AND `iu`.`data` NOT LIKE "%nosale=1%" AND `iu`.`data` NOT LIKE "%sudba=%" AND `iu`.`data` NOT LIKE "%tr_rep=%"
			AND `iu`.`gift` = ""
			AND `im`.`price1` > 0 AND `im`.`type` != 31 AND `im`.`type` != 32 ORDER BY `lastUPD`  DESC');
			// AND `iu`.`data` NOT LIKE "%tr_rep=%"
			
			//pr($itmAll['collich']);
			if($itmAll[0]==0){
				$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО</td></tr>';
			}else{
				$itmAllSee = $itmAll[2];
			}
			echo $itmAllSee;
		}
        //dStart('code');
?>
	</TABLE>
	</TD></TR>
	</TABLE>
    <? }else{
	$itemsOk = $u->genInv(6,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD` DESC');
	?>
    <table width="100%" style="border:1px solid #a5a5a5;" border="0" cellpadding="0" cellspacing="0" bgcolor="A5A5A5">
      <tr>
        <td colspan="2"><!--Рюкзак-->
          <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#A5A5A5">
            <tr>
              <td bgcolor="e2e0e0" align="center">			    
				<? if($itemsOk==''){ ?>
                <div style="padding:4px;">У вас нет подходящих предметов в рюкзаке</div>
                <? }else{ echo $itemsOk; } ?>                
                </td>
            </tr>
          </table></td>
      </tr>
    </table><? } ?>
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
	<!-- -->
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td nowrap="nowrap">
	<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
	<tr>
	<td bgcolor="#D3D3D3"><img src="//img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=8.180.0.410&rnd=<? echo $code; ?>';" title="<? thisInfRm('8.180.0.410',1); ?>">Страшилкина улица</a></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</td></table>
	</td></table>
	<div><br />
      <div align="left">
	  Масса: <?=$u->aves['now']?>/<?=$u->aves['max']?> &nbsp;<br />
	  У вас в наличии: <b style="color:darkgreen;"><?php echo round($u->info['money'],2); ?> кр.</b><BR>
	  <INPUT TYPE="button" value="Обновить" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';"><BR>
      </div>

    	
	  </div>
	<div style="background-color:#A5A5A5;padding:1"><center><B>Отделы магазина</B></center></div>
	<div style="line-height:17px;">
	<?php
		/*названия разделов (справа)*/
		$otdels_array = array (1=>'Общий зал',2=>'',3=>'Венки');
		if( (int)date('m') == 2 && (int)date('d') >= 14 ) {
			$otdels_array[4] = 'Вещи Валентая';
		}
		$i=1;
		while($i!=-1)
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
			$i = -2;
			}
			$i++;
		}
		
		/* if(isset($_GET['otdel']) && $_GET['otdel']==9){$color = 'C7C7C7';} else {$color = 'e2e0e0';}
		echo '<div><A HREF="?otdel=9"><DIV style="background-color: #'.$color.'"></A></DIV>';
		
		if((int)date('m') == 12 || (int)date('m') == 1 || $u->info['admin'] > 0 ) {
		if(isset($_GET['otdel']) && $_GET['otdel']==5) {$color = 'C7C7C7';} else {$color = 'e2e0e0';}
		echo '<div><A HREF="?otdel=5"><DIV style="background-color: #'.$color.'"></A></DIV>';
		} */
		
		if(isset($_GET['gifts'])) 
		{
			$color = 'C7C7C7';	
		}else{
			$color = 'e2e0e0';	
		}
		echo '<A HREF="?otdel=4&gifts=1"><DIV style="background-color: #'.$color.'">Подарить букет</A></DIV>';
	?>
	</div>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>
<?
}
?>