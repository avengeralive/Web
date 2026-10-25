<?php
if(!defined('GAME'))
{
	die();
}

if(isset($file) && $file[0]=='/dmc/3/altar_cat.php')
{
	$shopProcent = 50;
			
	if(!isset($_GET['otdel'])) 
	{
		$_GET['otdel'] = 1;
	}

	$sid = 45;

	$error = '';
	
	if(isset($_GET['buy']))
	{
		if($u->newAct($_GET['sd4'])==true)
		{
			$re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x']);
		}else{
			$re = 'Вы уверены что хотите купить этот предмет?';
		}
	}elseif(isset($_GET['add_alt_char'])) {
		//Ложим предмет
		$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `data` LIKE "%alt_cat=%" AND `id` = "'.mysql_real_escape_string($_GET['add_alt_char']).'" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inShop` = "0" AND `inOdet` = "0" AND `inTransfer` = "0" LIMIT 1'));
		if(!isset($itm['id'])) {
			$re = 'Подходящий предмет не найден';
		}else{
			if($u->itemsX($itm['id'])==1) {
				$itm_m = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$itm['item_id'].'" LIMIT 1'));
				mysql_query('UPDATE `items_users` SET `inShop` = "'.$sid.'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
				$re = 'Предмет &quot;'.$itm_m['name'].'&quot; успешно добавлен';
			}else{
				//группа
				$re = 'Разделите группу предметов';
			}
		}
	}elseif(isset($_GET['clear_alt_char'])){
		//Ложим предмет
		$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `data` LIKE "%alt_cat=%" AND `id` = "'.mysql_real_escape_string($_GET['clear_alt_char']).'" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inShop` = "'.$sid.'" AND `inOdet` = "0" AND `inTransfer` = "0" LIMIT 1'));
		if(!isset($itm['id'])) {
			$re = 'Подходящий предмет не найден';
		}else{

			$itm_m = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$itm['item_id'].'" LIMIT 1'));
			mysql_query('UPDATE `items_users` SET `inShop` = "0",`lastUPD` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			$re = 'Предмет &quot;'.$itm_m['name'].'&quot; успешно убран';
		}
	}elseif(isset($_GET['createLaba'])) {
		$vaza = true;
		$rec1 = '';
		$rec2 = '';
		$rec3 = '';
		$rec3l = 0;
		$sp = mysql_query('SELECT `id`,`item_id` FROM `items_users` WHERE `data` LIKE "%alt_cat=1%" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inShop` = "'.$sid.'" AND `inOdet` = "0" AND `inTransfer` = "0" ORDER BY `item_id` ASC LIMIT 1000');
		while($pl = mysql_fetch_array($sp)) {
			if($pl['item_id']!=2555) {
				$rec1 .= $pl['item_id'].',';
				$rec3 .= ' `id`='.$pl['id'].' OR';
				$rec3l++;
			}elseif($pl['item_id']==2555) {
				$vaza = true;
			}
		}
		$sp = mysql_query('SELECT `id`,`item_id` FROM `items_users` WHERE `data` LIKE "%alt_cat=2%" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inShop` = "'.$sid.'" AND `inOdet` = "0" AND `inTransfer` = "0" ORDER BY `item_id` ASC LIMIT 1000');
		while($pl = mysql_fetch_array($sp)) {
			if($pl['item_id']!=2555) {
				$rec2 .= $pl['item_id'].',';
				$rec3 .= ' `id`='.$pl['id'].' OR';
				$rec3l++;
			}elseif($pl['item_id']==2555) {
				$vaza = true;
			}
		}
		$rec1 = rtrim($rec1,',');
		$rec2 = rtrim($rec2,',');
		$rec3 = rtrim($rec3,'OR');

		
		$rec = mysql_fetch_array(mysql_query('SELECT * FROM `alt_cat` WHERE `itm_1` = "'.$rec1.'" AND `itm_2` = "'.$rec2.'" AND `shop` = "'.$sid.'" AND `active` = "1" LIMIT 1'));
		if(isset($rec['id']) && $rec3 = '') {
				$itm = mysql_fetch_array(mysql_query('SELECT `id`, `name` FROM `items_main` WHERE `id` = "'.$rec['itm_add'].'" LIMIT 1'));
				$itm_data = mysql_fetch_array(mysql_query('SELECT `data` FROM `items_main_data` WHERE `items_id` = "'.mysql_real_escape_string($itm['id']).'"'));
				if(isset($itm['id'])) { 
						if($vaza==true && isset($itm_data['data'])){ 
								$itm_data = $u->lookStats($itm_data['data']);
								$itm_data = array('srok'=>$itm_data['srok']); // Извлекаем только срок!
								$itm_data['srok'] = (int)$itm_data['srok']; // Только Цифры!
								if(isset($itm_data['srok']) and $itm_data['srok']>0){
								$itm_data['srok'] = $itm_data['srok']*3; // В три раза больше срок хранения!
								$itm_data = '|'.$u->impStats($itm_data);
								}
						} else {
						$itm_data = NULL;
						}
						$u->addItem($itm['id'],$u->info['id'],$itm_data,NULL,NULL,true);
						mysql_query('UPDATE `items_users` SET `delete` = "'.time().'",`inShop` = "0" WHERE '.$rec3.' LIMIT '.$rec3l);
						$re = 'Предмет &quot;'.$itm['name'].'&quot; был успешно создан!';
				}else{
				$re = 'Не удалось получить чарку по рецепту...';
				}
		} else {
				if($u->info['admin']>0) {
				echo '<div><b>ITM1:</b> '.$rec1.'</div><div><b>ITM2:</b> '.$rec2.'</div>';
				}
		$re = 'Подходящий рецепт не найден...';
		}
	}
	if($re!=''){ echo '<div align="left"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
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
	<tr><td valign="top"><div align="center" class="pH3">Лаборатория</div><br>
	<center><b>Персонаж: <?=$u->microLogin($u->info['id'],1)?></center></b>
	<?php
	echo '<b style="color:red">'.$error.'</b>';
	?>
	<br />
	<TABLE width="100%" cellspacing="0" cellpadding="4">
	<TR>
	<form name="F1" method="post">
	<TD valign="top" align="left">
	<!--Магазин-->
    <? if((int)$_GET['otdel']!=1){ ?>
	<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#a5a5a5">
	<div id="hint3" style="visibility:hidden"></div>
	<tr>
	<td align="center" height="21">
    <?php	
		/*названия разделов (сверху)*/
		if(!isset($_GET['sale']) && isset($_GET['otdel'])) 
		{
			$otdels_small_array = array (1=>'<b>Отдел&nbsp;&quot;Лаборатория&quot;</b>',2=>'<b>Рецепты&quot;</b>');
			if(isset($otdels_small_array[$_GET['otdel']]))
			{
				echo $otdels_small_array[$_GET['otdel']];	
			}		
		}
	?>
	</tr>
	<tr><td>
	<table width="100%" CELLSPACING="1" CELLPADDING="1" bgcolor="#a5a5a5">
    <?php
		if(isset($_GET['otdel']) && $_GET['otdel']==2) {
			
			$is2='';
			$cl = mysql_query('SELECT * FROM altar_cat WHERE razdel=2');
			
			while($pl = mysql_fetch_array($cl)){
				$itm = mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($pl['itm_add']).'"');
				$itm = mysql_fetch_array($itm);
					$is2.='<tr style="background-color:#d4d4d4;">
						<td  width="110" style="padding:7px;" valign="middle" align="center"><a target="_blank" href="https://testcombats.ru/item/'.$pl['itm_add'].'"><img  src="https://img.testcombats.ru/i/items/'.$itm['img'].'"></a></td>
						<td width="250">
						</>';
						$itm['srok'] = ($itm['srok']/60/60/24);
						$is2.='<a target="_blank" href="https://testcombats.ru/item/'.$pl['itm_add'].'">'.$itm['name'].'</a><br/>
						    Масса: '.$itm['massa'].'<br/>
						    <b>Цена: '.$itm['price1'].' кр.</b><br/>
						    Долговечность: 0/'.$itm['iznosMAXi'].'<br/>
							Уровень: '.$itm['level'].'';
						$is2.='</td>
						';
						$treb = explode(',', $pl['itm_1']);
						foreach($treb as $tr){
							$itm_treb = mysql_fetch_array(mysql_query('SELECT id, name, img, srok, price1,iznosMAXi FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($tr).'"'));
							$is2.='<td align="center"><a target="_blank" href="https://testcombats.ru/item/'.$itm_treb['id'].'" title=">'.$itm_treb['name'].'"<b>'.$itm_treb['name'].'<br><img width="40" src="https://img.testcombats.ru/i/items/'.$itm_treb['img'].'"></a></td>';
						}
						$treb = explode(',', $pl['itm_2']);
						foreach($treb as $tr){
								if( isset($tr) && $tr!=''){
										$itm_treb = mysql_fetch_array(mysql_query('SELECT id, name, img, srok, price1,iznosMAXi FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($tr).'"'));
										$is2.='<td align="center"><a target="_blank" href="https://testcombats.ru/item/'.$itm_treb['id'].'" title=">'.$itm_treb['name'].'"<b>'.$itm_treb['name'].'<br><img width="40" src="https://img.testcombats.ru/i/items/'.$itm_treb['img'].'"></a></td>';
								}
						}
						$is2.='</td>
					</tr>';
					$i++;
			}
			echo "<tbody>".$is2."</tbody>";
		}else {
			$u->shopItems($sid);	
		}
		
	?>
	</TABLE>
	</TD></TR>
	</TABLE>
    <? }else{
	$itemsOk = $u->genInv(142,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD` DESC');
	$itemsOk = $itemsOk[2];
	$itemsAdd = '';
	$resAdd = '';
	$sp = mysql_query('SELECT `u`.*,`m`.`name`,`m`.`type`,`m`.`img` FROM `items_users` AS `u` LEFT JOIN `items_main` AS `m` ON `u`.`item_id` = `m`.`id` WHERE `u`.`uid` = "'.$u->info['id'].'" AND `u`.`inShop` = "'.$sid.'" AND `u`.`delete` = "0" AND `u`.`data` LIKE "%alt_cat=1%"');
	while($pl = mysql_fetch_array($sp)) {
		$res_Add .= '<div style="float:left;width:80px;padding-bottom:5px;"><img src="https://img.testcombats.ru/i/items/'.$pl['img'].'"><br>&nbsp;<input type="button" onclick="location=\'main.php?otdel=1&clear_alt_char='.$pl['id'].'&rnd='.$code.'\';return true;" class="btn btn-danger" value="Убрать"></div>';
	}
	$sp = mysql_query('SELECT `u`.*,`m`.`name`,`m`.`type`,`m`.`img` FROM `items_users` AS `u` LEFT JOIN `items_main` AS `m` ON `u`.`item_id` = `m`.`id` WHERE `u`.`uid` = "'.$u->info['id'].'" AND `u`.`inShop` = "'.$sid.'" AND `u`.`delete` = "0" AND `u`.`data` LIKE "%alt_cat=2%"');
	while($pl = mysql_fetch_array($sp)) {
		$itemsAdd .= '<div style="float:left;width:80px;padding-top:5px;"><img src="https://img.testcombats.ru/i/items/'.$pl['img'].'"><br>&nbsp;<input type="button" onclick="location=\'main.php?otdel=1&clear_alt_char='.$pl['id'].'&rnd='.$code.'\';return true;" class="btn btn-danger" value="Убрать"></div>';
	}
	?>
    <table width="100%" style="border:1px solid #a5a5a5;" border="0" cellpadding="0" cellspacing="0" bgcolor="A5A5A5">
      <tr>
        <td colspan="2" align="center"><b>Соединение Чарок</b></td>
      </tr>
      <tr bgcolor="C7C7C7">
        <td align="center" valign="top" width="180" nowrap="nowrap" ><b>Чарки:</b><br />
          <? echo $itemsAdd; ?>
          <br />
          <div style="float:left;width:180px;padding-top:5px;">
          <input type="button" class="btn btn-success"  style="width:170px;"value="Создать предмет" onclick="top.frames['main'].location='main.php?otdel=1&createLaba';" />
          </div>
          </td>
          <td width="100%" align="left" valign="top">
          <? if($res_Add == '') { ?>&nbsp;&nbsp;<center style="padding-right:180px;">Добавляйте сюда чарки, которые хотите соединить</center>
          <? }else{ echo '<br>'.$res_Add; } ?> <br /></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><b>Ресурсы у вас в рюкзаке:</b></td>
      </tr>
      <tr>
        <td colspan="2"><!--Рюкзак-->
          <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#A5A5A5">
            <tr>
              <td bgcolor="e2e0e0" align="center">			    
				<? if($itemsOk==''){ ?>
                <div style="padding:4px;">У вас нет подходящих чарок в рюкзаке</div>
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
	 <b> Масса: <?=$u->aves['now']?>/<?=$u->aves['max']?> &nbsp;</b><br />
      </small>
      </div>
	  <br />
    	<INPUT TYPE="button" class="btn" value="Обновить" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';"><BR>
	  </div>
	<div style="background-color:#A5A5A5;padding:1"><center><B>Отделы:</B></center></div>
	<div style="line-height:17px;">
	<?php
		/*названия разделов (справа)*/
		$otdels_array = array (1=>'Соединить чарки',2=>'Рецепты');
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
	?>
	</div>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>
<?
}
?>