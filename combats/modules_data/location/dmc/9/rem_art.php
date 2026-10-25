<?php
if(!defined('GAME'))
{
	die();
}

if(isset($file) && $file[0]=='/dmc/9/rem_art.php')
{

	

	
	$r = 1;
	if(isset($_GET['r']))
	{
		$r = (int)$_GET['r'];
		if($r!=1 )
		{
			$r = 1;
		}

	}
	
if(isset($_GET['remon']))
	{
		$t = 1;
		if($_GET['t']==2)
		{
			$t = 2;	
		}elseif($_GET['t']==3)
		{
			$t = 3;	
		}
		//Проверка наличия свитков для починки
		$check_rem1 = mysql_num_rows(mysql_query('SELECT `id` FROM `items_users` WHERE `item_id`="7257" AND `uid`="'.$u->info['id'].'" AND `delete`="0" LIMIT 1;'));
		$check_rem2 = mysql_num_rows(mysql_query('SELECT `id` FROM `items_users` WHERE `item_id`="7255" AND `uid`="'.$u->info['id'].'" AND `delete`="0" LIMIT 1;'));
		$check_rem3 = mysql_num_rows(mysql_query('SELECT `id` FROM `items_users` WHERE `item_id`="7256" AND `uid`="'.$u->info['id'].'" AND `delete`="0" LIMIT 1;'));
		
		if($check_rem1 || $check_rem2 || $check_rem3){
			$ir = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE `iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `iu`.`iznosNOW` >= 1 AND `iu`.`id` = "'.mysql_real_escape_string((int)$_GET['remon']).'" LIMIT 1'));
			
			$r1 = round($ir['1price']*0.05,2);
			$r2 = round($ir['1price']*0.05,2);
			$r3 = round($ir['1price']*0.05,2);

			if(isset($ir['id']))
			{
				$po = $u->lookStats($ir['data']);
				if(isset($po['noremont']) || !isset($po['art']))
				{
					$re2 = 'Предмет не подлежит ремонту в этой мастерской.';
				}else{
					if($t == 1)
					{
						$rem_cell=$r1;
						$t = 0;
						$rm = 25;
						$re2 .= $rm.' ед.';
						$rem_svitok = 7257;
					}elseif($t == 2)
					{
						$t = 0;
						$rm = 50;
						$rem_cell=$r2;
						$re2 .= $rm.' ед.';
						$rem_svitok = 7255;
					}elseif($t == 3)
					{
						$rem_cell=$r3;
						$t = 0;
						$rm = 100;
						$re2 .= $rm.' ед.';
						$rem_svitok = 7256;
					}

					if($rem_cell>$u->info['money2'])
					{
						$re2 = 'У вас недостаточно средств для ремонта.';
					}else{
						if($rm > $ir['iznosNOW'])
						{
							$rm = $ir['iznosNOW'];
						}
						$ir['iznosNOW'] -= $rm;
						if($ir['iznosNOW']<0)
						{
							$ir['iznosNOW'] = 0;
						}
						$u->info['money2'] -= $rem_cell;	
						$upd = mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1;');	
						if($upd)
						{
							$il = $ir['iznosMAX'];
							if( rand(0,100) < 25 ) {
								$ir['iznosMAX'] -= 1;
							}
							if($ir['iznosMAX']<1)
							{
								$ir['iznosMAX'] = 1;
							}
							mysql_query('UPDATE `items_users` SET `iznosNOW` = "'.$ir['iznosNOW'].'",`iznosMAX` = "'.$ir['iznosMAX'].'" WHERE `id` = "'.$ir['id'].'" LIMIT 1;');	
							$re2 = 'Удачно произведен ремонт '.$re2.' предмета &quot;'.$ir['name'].'&quot; за '.$rem_cell.' екр.';
							mysql_query('UPDATE `items_users` SET `delete`="'.$u->info['id'].'" WHERE `item_id` = "'.$rem_svitok.'" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inOdet` = "0" AND `inShop` = "0" AND `inTransfer` = "0" LIMIT 1;');
							$dop = 0;
							if(ceil($il)>ceil($ir['iznosMAX']))
							{
								$re2 .= '<br>К сожалению, максимальная долговечность предмета из-за ремонта уменьшилась.';
								$dop = 1;
							}
							$u->addDelo(2,$u->info['id'],'&quot;<font color="grey">System.remont</font>&quot;: Предмет &quot;'.$ir['name'].'&quot; [itm:'.$ir['id'].'] был <b>отремонтирован</b>, максимальная долговечность уменьшилась: '.$dop.' ('.$rm.' ед. за '.$rem_cell.' екр.).',time(),$u->info['city'],'System.remont',0,0);
						}else{
							$re2 = 'Что-то здесь не так...';
						}
					}
				}
			}else{
				$re2 = 'Предмет подходящий для ремонта не найден в инвентаре';	
			}
		}
		else{
			$re2 = 'Для починки артефакта требуется свиток починки';
		}
	}
	
	$see = '';
	if($r==1){
		//ремонт предметов
		$see = $u->genInv(4,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0"  AND `iu`.`inShop`="0" AND `iu`.`iznosNOW` >= 1 ORDER BY `lastUPD` DESC');
		$see = $see[2];
	}
	
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
    
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
	td {
	text-align: center;
}
    </style>
	<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr><td valign="top"><div align="center" class="pH3">Мастерская потерянных</div>
	<?php
	echo '<b style="color:red">'.$error.'</b>';
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td><table width="100%" border="0" cellpadding="2" cellspacing="0" bgcolor="d2d2d2">
	      <tr>
	        
	        <td nowrap="nowrap" align="center" <?php if($r==1){ echo 'bgcolor="#A5A5A5"'; } ?> >&nbsp;&nbsp;<?php if($r==1){ echo '<b>Ремонт</b>'; }else{ echo '<a href="?r=1&rnd='.$code.'">Ремонт</a>'; } ?>&nbsp;&nbsp;</td>

			<?php
			//if($u->info['admin']>0){
		?>
			


	       
			

            

			<td nowrap="nowrap" style="position: absolute; right: 290px;"><?=$u->microLogin($u->info['id'],1) ?></td>
            <td width="90%">&nbsp;</td>
	        </tr>
	      </table></td>
	    </tr>
	  <tr>
	    <?php
		$rn = array(
			1 => 'Починка поврежденных предметов'
		);
		$rn2 = array(
			1 => 'У вас в рюкзаке нет поврежденных предметов'
		);
		?>
        <td bgcolor="#A5A5A5"><small><b><?php echo $rn[$r]; ?></b></small></td>
	    </tr>
	  <tr>
	    <td style="border:1px solid #A5A5A5;padding:0px;">

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php

			if($see == '')
			{
				echo $rn2[$r];
			}else{
				echo $see;	
			}

		?>
        </table>
        </td>
	    </tr>
	  </table>
	<br />

	<td width="280" valign="top">
    <TABLE cellspacing="0" cellpadding="0"><TD width="100%">&nbsp;</TD><TD>
	<table  border="0" cellpadding="0" cellspacing="0">
	<tr align="right" valign="top">
	<td>
	<!-- -->
	<?php echo $goLis; ?>
	<!-- -->
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td nowrap="nowrap">
	<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
	<tr>
	<td bgcolor="#D3D3D3"><img src="/img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
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
	  Масса: <?=$u->aves['now']?>/<?=$u->aves['max']?> &nbsp;<br />
	  У вас в наличии: <b style="color:#339900;"><?php echo round($u->info['money'],2); ?> кр.</b> &nbsp;<br><br><br><br>
	 
      </small>
      </div>
      	<p><small>
      	<?php
        if(isset($re2)){ echo '<b style="color:red">'.$re2.'</b>'; }
        ?>
      	</small></p>
      	<p>
      	  <br /><BR>
   	    </p>
    </div>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>
<?php
}
die();
?>