<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='cc/portal')
{
    if($magic->testTravma( $u->info['id'] , 4 )) $nTravma = 1;
	else $nTravma  = 0;

	$zd = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` >= '.time().' AND `vars` = "teleport" LIMIT 1',1);
	
	if(isset($_GET['teleport']) && !isset($zd['id']))
	{
		$tp = mysql_fetch_array(mysql_query('SELECT * FROM `teleport` WHERE `city` = "'.$u->info['city'].'" AND `cancel` = "0" AND `id` = "'.((int)$_GET['teleport']).'" LIMIT 1'));
		if(isset($tp['id']))
		{
			if($u->info['money']>=$tp['price1'])
			{
				$rm = mysql_fetch_array(mysql_query('SELECT * FROM `room` WHERE `name` = "Портал" AND `city` = "'.$tp['toCity'].'" LIMIT 1'));
				if(isset($rm['id']))
				{
					$u->info['money'] -= $tp['price1'];
					$u->info['city'] = $tp['toCity'];
					mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'",`city` = "'.$u->info['city'].'",`room` = "'.$rm['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					/*if( $u->stats['silver'] >= 3 ) {
						$tp['time'] = round($tp['time']/2);
					}*/
					$u->addAction((time()+$tp['time']*60),'teleport',$tp['toCity']);
					die('<script>location="main.php";</script>');
				}else{
					$error = 'Нельзя телепортироваться, возможно Портал в этом городе был разрушен...';
				}
			}else{
				$error = 'У вас недостаточно средсв';
			}
		}else{
			$error = 'Нельзя телепортироваться...';
		}
	}
	
    if(!$nTravma)
	{
		$cst = '';
		$sp = mysql_query('SELECT * FROM `teleport` WHERE `city` = "'.$u->info['city'].'" AND `cancel` = "0"');
		while($pl = mysql_fetch_array($sp))
		{
			$col = 'e6e6e6" style="color:#B7B7B7;"';
			if(!isset($zd['id']))
			{
				$col = 'c9c9c9';
			}
			$cst .= '<tr>
				<td bgcolor="#'.$col.'" align="center">'.$pl['toCity'].'</td>
				<td bgcolor="#'.$col.'" align="center">'.$u->timeOut($pl['time']*60).'</td>
				<td bgcolor="#'.$col.'" align="center">'.$pl['price1'].' кр.</td>';
				if(isset($zd['id']))
				{
					$cst .= '<td bgcolor="#'.$col.'" align="center">Задержка еще '.$u->timeOut($zd['time']-time()).'</td>';
				}else{
					$cst .= '<td bgcolor="#'.$col.'" align="center"><a href="?teleport='.$pl['id'].'">Полетели!</a></td>';
				}
			    $cst .= '</tr>';
		}
	} else {echo '<br>'; $error = '<center>У вас неизлечимая травма! Вы не можете посещать другие города.</center>';}

	
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
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
	<tr><td valign="top"><div align="center" class="pH3"><? echo $u->room['name'].' "'.$u->city_name[$u->info['city']].'"'; ?></div>
	<?php
	echo '<b style="color:red">'.$error.'</b>';
	if($cst!='')
	{
	?>
    <center>
	<b>Телепортация в другие города<? if(isset($zd['id'])){ echo ' </b>(Возможна через '.$u->timeOut($zd['time']-time()).')<b>'; } ?></b>
	</center>
	<? if(!isset($zd['id'])){ ?>
    <br />
	<table width="100%" border="0" cellspacing="1" cellpadding="0">
	  <tr>
	    <td width="25%" bgcolor="#81888e"><div align="center">пункт назначения</div></td>
	    <td width="25%" bgcolor="#81888e"><div align="center">время задержки телепортации</div></td>
	    <td width="25%" bgcolor="#81888e"><div align="center">цена телепортации</div></td>
	    <td width="25%" bgcolor="#81888e"><div align="center">Телепортироваться</div></td>
	    </tr>
	  <? echo $cst; ?>
	  </table>
	<br />
    <? } } unset($zd); ?>


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
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.9&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.9',1); ?>">Центральная площадь</a></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</td></table>
	</td></table>
	<div>
	  <br />
      <div align="right">
      <small>
	  Масса: <?=$u->aves['now']?>/<?=$u->aves['max']?> &nbsp;<br />
	  У вас в наличии: <b style="color:#339900;"><?php echo round($u->info['money'],2); ?> кр.</b> &nbsp;
      </small>
      </div>
	  <br />
    <br />
	</div>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>
<?
}
?>