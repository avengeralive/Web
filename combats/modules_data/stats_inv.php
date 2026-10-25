<?
if(!defined('GAME'))
{
	die();
}

$uShow = explode('|',$u->info['showmenu']);
if(isset($_GET['showmenu']))
{
	$_GET['showmenu'] = round($_GET['showmenu']);
	if($_GET['showmenu']>=1 && $_GET['showmenu']<=8)
	{
	 	if($uShow[$_GET['showmenu']-1]==0)
		{
			$uShow[$_GET['showmenu']-1] = 1;
		}else{
			$uShow[$_GET['showmenu']-1] = 0;
		}
		$u->info['showmenu'] = implode('|',$uShow);
		mysql_query('UPDATE `stats` SET `showmenu`="'.$u->info['showmenu'].'" WHERE `id`="'.$u->info['id'].'"');
	} 
}
?>
<style type="text/css">
.lstl1 {
	background-color: #ccc;
	font-size: 7pt;
	font-weight: bold;
  	border-radius: 2px; 
  	-moz-border-radius: 2px;
  	-webkit-border-radius: 2px;
	padding-right:0px;
	padding-bottom:1px;
}
</style>
<script>
function getLine(id,name,a,b,o,id2)
{
	var tss = '<td width="20"><img src="//img.testcombats.ru/i/minus.gif" style="display:block;cursor:pointer;margin-bottom:3px;" title="Скрыть" class="btn-slide" onClick="location=\'main.php?inv=1&otdel=<? echo $_GET['otdel']; ?>&showmenu='+id2+'&rnd=<? echo $code; ?>\';"></td>';
	if(o==0)
	{
		tss ='<td width="20"><img src="//img.testcombats.ru/i/plus.gif" style="display:block;cursor:pointer;margin-bottom:3px;" title="Показать" class="btn-slide" onClick="location=\'main.php?inv=1&otdel=<? echo $_GET['otdel']; ?>&showmenu='+id2+'&rnd=<? echo $code; ?>\';"></td>';
	}
	var sts01 = '<a href="main.php?inv=1&otdel=<? echo $_GET['otdel']; ?>&up='+id+'&rnd=<? echo $code; ?>"><img style="display:block;float:right; margin-bottom:3px;" src="//img.testcombats.ru/i/3.gif"></a>';
	if(id==0)
	{
		sts01 = '<img style="display:block;float:right;margin-bottom:3px;" src="//img.testcombats.ru/i/4.gif">';
	}
	var sts02 = '<a href="main.php?inv=1&otdel=<? echo $_GET['otdel']; ?>&down='+id+'&rnd=<? echo $code; ?>"><img style="display:block; margin-bottom:3px; float:right;" src="//img.testcombats.ru/i/1.gif"></a>';
	if(id==6)
	{
		sts02 = '<img style="display:block;float:right;margin-bottom:3px;" src="//img.testcombats.ru/i/2.gif">';
	}
	var sts2 = '<td width="40"><div style="float:right;">'+sts01+''+sts02+'</div></td>';
	document.write('<table class="mroinv" width="100%" border="0" cellspacing="2" cellpadding="0">'+
	'<tr>'+tss+
    '<td style="font-size:9px;"><span class="lstl1">&nbsp;'+name+'</span></td>'+sts2+'</tr>'+ 
	'</table>');
}

function showDiv (id)
{
	var block = document.getElementById('block_'+id);
	block.style.display = 'block';	
}
function hiddenDiv (id)
{
	var block = document.getElementById('block_'+id);
	block.style.display = 'none';	
}
<?
$rb = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `bank` WHERE `block` = 0 AND `uid` = "'.$u->info['id'].'"'));
?>
function bank_info() {
<? if(!isset($u->bank['id']) && $rb[0]==0){ ?>
	alert('У Вас нет активных счетов. \n\n На правах рекламы: Вы можете открыть счёт в Банке "<? echo $c['title3']; ?>",'+
		' на Страшилкиной улице*\n\n* Мелким шрифтом: услуга платная.');
<?
}elseif($rb[0]>0){ 
?>
				var ddtpswBank = '<div><form action="main.php?inv=1&otdel=<? echo $_GET['otdel']; ?>&rnd=<? echo $code; ?>" method="post">'+
				        '<table style="border:1px solid #B1A996;" width="300" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#B1A996"><div align="center"><strong>Счёт в банке</strong><a href="javascript:void(0)" onclick="document.getElementById(\'chpassbank\').style.display=\'none\'" title="Закрыть окно" style="float:right;padding-right:5px;">x</a></div></td></tr><tr><td bgcolor="#DDD5C2" style="padding:5px;"><div align="center"><small>Выберите счёт и введите пароль<br />'+
                        '<select name="bank" id="bank">'+
						<?
                        $scet = mysql_query('SELECT `id` FROM `bank` WHERE `block` = "0" AND `uid` = "'.$u->info['id'].'"');
                        while ($num_scet = mysql_fetch_array($scet)) 
                        {
                       		 echo "'<option>".$u->getNum($num_scet['id'])."</option>'+";
                        }
						?>
                        '</select><input style="margin-left:5px;" type="password" name="bankpsw" id="bankpsw" /><label></label></small><input style="margin-left:3px;" type="submit" name="button" id="button" value=" ok " /></div></td></tr></table></form></div>';
						var ddtpsBankDiv = document.getElementById('chpassbank');
						if(ddtpsBankDiv!=undefined)
						{
							ddtpsBankDiv.style.display = '';
							ddtpsBankDiv.innerHTML = ddtpswBank;
						}
<?
}
?>
}
function save_com_can()
{
	var ddtpsBankDiv = document.getElementById('chpassbank');
	if(ddtpsBankDiv!=undefined)
	{
		ddtpsBankDiv.style.display = 'none';
		ddtpsBankDiv.innerHTML = '';
	}
}
function save_compl()
{
				var ddtpswBank = '<div><form action="main.php?inv=1&otdel=<? echo $_GET['otdel']; ?>&rnd=<? echo $code; ?>" method="post">'+
				        '<table style="border:1px solid #B1A996;" width="250" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#B1A996"><div align="center"><strong>Сохранить комплект</strong></div></td></tr><tr><td bgcolor="#DDD5C2" style="padding:5px;"><div align="center"><small>Введите название боевого комплекта:<br />'+
                        '<input style="width:90%;" type="text" name="compname" value="" id="compname" /><label></label></small><br><input style="margin-left:3px;cursor:pointer;" type="submit" name="button" id="button" value=" Сохранить " /><input style="margin-left:3px;cursor:pointer;" onClick="save_com_can();" type="button" value=" Отмена " /></div></td></tr></table></form></div>';
						var ddtpsBankDiv = document.getElementById('chpassbank');
						if(ddtpsBankDiv!=undefined)
						{
							ddtpsBankDiv.style.display = '';
							ddtpsBankDiv.innerHTML = ddtpswBank;
						}
}
function za_block(id) {
	if($('#za_block_'+id).css('display') == 'none') {
		$('#za_block_'+id).css('display','');
	}else{
		$('#za_block_'+id).css('display','none');
	}
}
</script>
<style>
.mroinv {
	/*background-color:#e2e2e2;border-top:1px solid #eeeeee;border-left:1px solid #eeeeee;border-right:1px solid #a0a0a0;border-bottom:1px solid #a0a0a0;*/
	background:url(//img.testcombats.ru/i/back.gif) 0 2px;
}
.mroinv img {
	display:inline-block;
	border:0;
	padding-top:3px;
	padding-left:1px;
}
.dot {
	display:block;
	padding-bottom:2px;
    text-decoration: none; /* Убираем подчеркивание */
    border-bottom: 1px dotted #080808; /* Добавляем свою линию */
	cursor:pointer;
}
.dot:hover {
    border-bottom: 1px dotted #080808; /* Добавляем свою линию */
	background-color:#BEBEBE;
}
.infsmal{
  display: inline-block;
  padding-left: 1px;
  margin-top: 5px;
}
</style>
<div id="chpassbank" style="display:none; position:absolute; top:50px; left:250px;"></div>
<?php
	
	$rz0 = '';
	$rz1 = '';
	$rz2 = '';
	$rz3 = '';
	$rz4 = '';
	$rz5 = '';
	/* if($u->info['skills'] > 0 && $u->info['level'] > 0) { 
    echo '&bull;&nbsp;<a href="main.php?skills=1&side=1">Обучение&nbsp;&nbsp;'.$u->info['skills'].'</a><br>'; 
}  */
	$expbase = (isset($u->stats['levels']['exp']) ? number_format($u->stats['levels']['exp'], 0, ",", " ") : 0 );
	if( $expbase-1 == $u->info['exp'] && $c['nolevel'] == true ) {
		//Проверяем блок опыта
		$tlus = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `users` WHERE `real` = 1 AND `level` = "'.$u->info['level'].'" LIMIT 1'));
		if($tlus[0] < $u->info['level']*10) {
			$expbase = '<strike>'.$expbase.'</strike>';
		}
		$expbase = '<a href="//testcombats.ru/exp" target="_blank">('.$expbase.')</a>';
		if(((1+$u->info['level']*10)-$tlus[0]) > 0) {
			$expbase .= ' <u><a onMouseOver="top.hi(this,\'<b>Персонажи '.$u->info['level'].' уровня не получают опыт.</b><br>Для разблокировки не хватает <u>'.((1+$u->info['level']*10)-$tlus[0]).' персонажей</u> данного уровня.\',event,0,1,1,1,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();" style="cursor:help">[?]</a></u>';
		}
	}else{
		$expbase = '(<a href="//testcombats.ru/exp" target="_blank">'.$expbase.'</a>)';
	}
	if($u->info['exp'] == 12499 && $c['infinity5level'] == true) {
		$trks5 = '<div align="center"><hr><font color=red>Для получения следующего уровня вам необходим <a target="_blank" href="//testcombats.ru/item/1204">Кристалл Вечности</a></font><hr></div>';
	}
	echo '
	<table width="30%" border="0" cellspacing="3" cellpadding="0">
	<tr><td>&nbsp;</td></tr>
	<tr>
    <td height="15">
    <small class="infsmal">
	<div style="font-size:8pt;">
	<span style="font-size:8pt;">Опыт:&nbsp;<a href="//testcombats.ru/exp" target="_blank">'.number_format($u->info['exp'], 0, ",", " ").' </a>&nbsp;'.$expbase.'</span><br>
	Бои:&nbsp;<span style="float0:right"><span title="Побед: '.number_format($u->info['win'], 0, ",", " ").'"><b>'.number_format($u->info['win'], 0, ",", " ").' <img width="7" height="7" title="Побед: '.number_format($u->info['win'], 0, ",", " ").'"
	src="//img.testcombats.ru/i/ico/wins.gif" style="display:inline-block;" /></b></span> &nbsp; <span title="Поражений: '.number_format($u->info['lose'], 0, ",", " ").'"><b>'.number_format($u->info['lose'], 0, ",", " ").' <img width="7" height="7" alt="Поражений: '.number_format($u->info['lose'], 0, ",", " ").'"
	src="//img.testcombats.ru/i/ico/looses.gif" style="display:inline-block;" /></b></span> &nbsp; <span title="Ничьих: '.number_format($u->info['nich'], 0, ",", " ").'"><b>'.number_format($u->info['nich'], 0, ",", " ").' <img width="7" height="7" alt="Ничьих: '.number_format($u->info['nich'], 0, ",", " ").'"
	src="//img.testcombats.ru/i/ico/draw.gif" style="display:inline-block;" /></b></span></span><br />
	Кредиты:&nbsp;<b style="font-size:8pt;">'.$u->info['money'].' кр.</b><br />
	Еврокредиты:&nbsp;<b style="color:darkgreen; font-size:8pt;">'.$u->info['money2'].' екр.</b><br/>';
	if($u->info['level']>0 && $u->info['inTurnir'] == 0 && !isset($u->info['noreal']))
	{
		echo'<font>Банк:&nbsp;</font>';
		if(!isset($u->bank['id']))
		{ 
			if($rb[0]>0)
			{
				echo '<a href="javascript:bank_info();">выбрать счёт</a>';
			}else{
				echo '<a href="javascript:bank_info();">информация</a>';
			}
		}else{
			echo '<b>'.$u->bank['id'].'</b> <img style="display:inline-block;cursor:pointer;" src="//img.testcombats.ru/i/close_bank.gif" onClick="top.frames[\'main\'].location=\'main.php?inv=1&otdel='.$_GET['otdel'].'&bank_exit='.$code.'\';" title="Закончить работу со счётом" style="cursor:pointer"><br>
	Кредиты:&nbsp;<b style="font-size:8pt;">'.$u->bank['money1'].' кр.</b><br />
	Еврокредиты:&nbsp;<b style="color:darkgreen; font-size:8pt;">'.$u->bank['money2'].' екр.</b>';
		}
		echo '<br>';
	}
		
	$prt = explode('|',$u->info['prmenu']);
	if(isset($_GET['up']))
	{
		$i = 0;
		if(isset($prt[$_GET['up']],$prt[$_GET['up']-1]))
		{
			$prt1 = $prt[intval($_GET['up'])];
			$prt[$_GET['up']] = $prt[$_GET['up']-1];
			$prt[$_GET['up']-1] = $prt1;
			$prtNew = implode('|',$prt);
			$u->info['prmenu'] = $prtNew;
			mysql_query('UPDATE `stats` SET `prmenu`="'.mysql_real_escape_string($u->info['prmenu']).'" WHERE `id`="'.$u->info['id'].'" LIMIT 1');
			$prt = explode('|',$u->info['prmenu']);
		}
	}elseif(isset($_GET['down']))
	{
		$i = 0;
		if(isset($prt[$_GET['down']],$prt[$_GET['down']+1]))
		{
			$prt1 = $prt[intval($_GET['down'])];
			$prt[$_GET['down']] = $prt[$_GET['down']+1];
			$prt[$_GET['down']+1] = $prt1;
			$prtNew = implode('|',$prt);
			$u->info['prmenu'] = $prtNew;
			mysql_query('UPDATE `stats` SET `prmenu`="'.mysql_real_escape_string($u->info['prmenu']).'" WHERE `id`="'.$u->info['id'].'" LIMIT 1');
			$prt = explode('|',$u->info['prmenu']);
		}
	}
	
	$i = 0;
	while($i<count($prt))
	{
		$prtpos[$prt[$i]] = $i;
		$i++;
	}
	
	function intSpan($val) {
		$val = explode('>',$val);
		$val = explode('<',$val[1]);
		$val = $val[0];
		return $val;
	}
	
	$rz0 = '<script>getLine('.$prtpos[0].',"Характеристики ","0","0","'.$uShow[0].'",1);</script>';
	$rz0 .= '<font id="rz0">';
	if($uShow[0]==1){
		$i = 1;
		while( $i <= 10 ) {
			$u->stats['s'.$i] = 0+$u->stats['s'.$i];
			$i++;
		}
		$rz0 .= '<div style="display:none;font-size:8pt;" id="lnk0">
		Сила: <b>'.$u->stats['s1'].'</b><br />
		Ловкость:&nbsp;<b>'.$u->stats['s2'].'</b><br />
		Интуиция:&nbsp;<b>'.$u->stats['s3'].'</b><br />
		Выносливость:&nbsp;<b>'.$u->stats['s4'].'</b><br />
		';
		if($u->info['level'] >= 4 || $u->stats['n5']!=0)
		{
			$rz0 .= '
			Интеллект:&nbsp;<b>'.$u->stats['s5'].'</b><br />
			';
		}
		if($u->info['level'] >= 7 || (@isset($u->stats['n6']) && @$u->stats['n6']>0))
		{
			$rz0 .= '
			Мудрость:&nbsp;<b>'.@$u->stats['s6'].'</b><br />
			';
		}
		if($u->info['level'] >= 10 || @$u->stats['s7']>0)
		{
			$rz0 .= '
			Духовность:&nbsp;<b>'.@$u->stats['s7'].'</b><br />
			';
		}
		if($u->info['level'] >= 12 || @$u->stats['s8']>0)
		{
			$rz0 .= '
			Воля:&nbsp;<b>'.@$u->stats['s8'].'</b><br />
			';
		}
		if($u->info['level'] >= 15 || @$u->stats['s9']>0)
		{
			$rz0 .= '
			Свобода духа:&nbsp;<b>'.@$u->stats['s9'].'</b><br />
			';
		}
		if($u->info['level'] >= 20 || @$u->stats['s10']>0)
		{
			$rz0 .= '
			Божественный:&nbsp;<b>'.@$u->stats['s10'].'</b><br />
			';
		}
		if($u->info['level'] >= 12 || @$u->stats['s11']>0)
		{
			$rz0 .= '
			Энергия:&nbsp;<b>'.@$u->stats['s11'].'</b><br />
			';
		}
			if($u->info['ability'] > 0 || ($u->info['skills'] > 0 && $u->info['level'] > 0))
	{ 
		$rz0 .='&nbsp;<a href="main.php?skills=1&side=1">&bull;&nbsp;Способности&nbsp;</a>&nbsp;'; 
	}
			if($u->info['skills'] > 0 && $u->info['level'] > 0)
	{ 
		$rz0 .='&nbsp;<a href="main.php?skills=1&side=1">&bull;&nbsp;Обучение&nbsp;</a><br />'; 
	}
	}
	$rz0 .= '</font></div>';
	$rz1 = '<script>getLine('.$prtpos[1].',"Модификаторы ","0","0",'.$uShow[1].',2);</script>';
	if($uShow[1]==1)
	{
			$rz1 .= '<div style="display:none" id="lnk1">';
			$rz1 .= '<span style="font-size: 11px;">Урон: '.$u->inform('yrontest').'</span>';
			//$rz1 .= '<br><span style="font-size: 11px;">Крит. урон: '.$u->inform('yrontest-krit').'</span>';
			$rz1 .= '<br><span style="font-size: 11px;">Мф. крит. удара: '.$u->inform('m1').'';
		
		if(intSpan($u->inform('m3'))!=0)
			{
				$rz1 .='</span><br><nobr><span style="font-size: 11px;">Мф. мощности крит. удара: '.$u->inform('m3').'';
			}
			if( intSpan($u->inform('antm3')) != 0 && $u->info['admin'] > 0 ) {
				$rz1 .='</span><br><nobr><span style="font-size: 11px;">Мф. против мощности крита: '.$u->inform('antm3').'';
			}
			$rz1 .= '</span></nobr><br /><span style="font-size: 8pt;">Мф. против крит. удара: '.$u->inform('m2').'';
			$rz1 .= '</span><br /><span style="font-size: 8pt;">Мф. увертывания: '.$u->inform('m4').'';
			$rz1 .= '</span><br><nobr><span style="font-size: 8pt;">Мф. против увертывания: '.$u->inform('m5').'';
			$rz1 .= '</span></nobr><br><span style="font-size: 8pt;">Мф. пробоя брони: '.$u->inform('m9').'';
			$rz1 .= '</span><br><span style="font-size: 8pt;">Мф. контрудара: '.$u->inform('m6').'';
			$rz1 .='</span><br><span style="font-size: 8pt;">Мф. парирования: '.$u->inform('m7').'';
			$rz1 .= '</span><br><span style="font-size: 8pt;">Мф. блока щитом: '.$u->inform('m8').'';
			//$rz1 .= '</span><br /><span style="font-size: 8pt;">Абс. мф. крит. удара:'.$u->inform('m14').'';
			//$rz1 .= '</span><br /><span style="font-size: 8pt;">Абс. мф. увертывания:'.$u->inform('m15').'';
			//$rz1 .= '</span><br /><span style="font-size: 8pt;">Мастерство: '.$u->inform('aall').'';
			$rz1 .= '</span><br /><span style="font-size: 8pt;">Подавление защ. от магии: '.$u->inform('pzm').'';
			$rz1 .= '</span><br /><span style="font-size: 8pt;">Уменьшает расход маны: '.$u->inform('min_use_mp').'';

			//$rz1 .= '</span><br /><span style="font-size: 11px;">Цена комплекта: <b><font colol=grey>'.$u->stats['preckr'].'</b> eкр.';
			
			$rz1 .= '</span>';
		$rz1 .= '</nobr></div>';
	}
	/* $rz7 ='<script>getLine('.$prtpos[7].',"Защита","0","0",'.$uShow[7].',7);</script>';
	if($uShow[7]==1)
	{		
		$rz7 .= '<span style="font-size: 11px;">Мф. блока щитом: '.$u->inform('m8').'';
		$rz7 .= '</span><br /><span style="font-size: 11px;">Защита от урона: '.$u->inform('za').' ('.$u->zago(strip_tags($u->inform('za'))).'%)';
		$rz7 .= '</span><br /><span style="font-size: 11px;">Защита от магии: '.$u->inform('zm').' ('.$u->zmgo(strip_tags($u->inform('zm'))).'%)';
		
	} */
	$rz2 = '<script>getLine('.$prtpos[2].',"Защита: ","0","0",'.$uShow[2].',3);</script>';
	if($uShow[2]==1)
	{
		$rz2 .= '<span style="font-size: 11px;">Защита от урона: '.$u->inform('za').'';
		$rz2 .= '</span><br /><span style="font-size: 11px;">Защита от магии: '.$u->inform('zm').'';
		$rz2 .= '</span><br /><span style="font-size: 11px;">Магии Огня: '.$u->inform('zm1');
        $rz2 .= '</span><br /><span style="font-size: 11px;">Магии Воздуха: '.$u->inform('zm2');
        $rz2 .= '</span><br /><span style="font-size: 11px;">Магии Воды: '.$u->inform('zm3');
        $rz2 .= '</span><br /><span style="font-size: 11px;">Магии Земли: '.$u->inform('zm4');
        $rz2 .= '</span><br /><span style="font-size: 11px;">Магии Света: '.$u->inform('zm5');
        $rz2 .= '</span><br /><span style="font-size: 11px;">Магии Тьмы: '.$u->inform('zm6');
        $rz2 .= '</span><br /><span style="font-size: 11px;">Серой магии: '.$u->inform('zm7');
		$rz2 .= '</span><br /><span style="font-size: 11px;">Колющего урона: '.$u->inform('za1');
        $rz2 .= '</span><br /><span style="font-size: 11px;">Рубящий урона: '.$u->inform('za2');
        $rz2 .= '</span><br /><span style="font-size: 11px;">Дробящий урона: '.$u->inform('za3');
        $rz2 .= '</span><br /><span style="font-size: 11px;">Режущий урона: '.$u->inform('za4');
		$rz2 .= '<div style="display:none;font-size: 11px;" id="lnk2">
		Броня головы: '.$u->stats['mib1'].'-'.$u->stats['mab1'].' ('.($u->stats['mib1']).'+d'.($u->stats['mab1']-($u->stats['mib1'])+1).')<br />
		Броня груди: '.$u->stats['mib2'].'-'.$u->stats['mab2'].' ('.($u->stats['mib2']).'+d'.($u->stats['mab2']-($u->stats['mib2'])+1).')<br />
		Броня живота: '.$u->stats['mib2'].'-'.$u->stats['mab2'].' ('.($u->stats['mib2']).'+d'.($u->stats['mab2']-($u->stats['mib2'])+1).')<br />
		Броня пояса: '.$u->stats['mib3'].'-'.$u->stats['mab3'].' ('.($u->stats['mib3']).'+d'.($u->stats['mab3']-($u->stats['mib3'])+1).')<br />
		Броня ног: '.$u->stats['mib4'].'-'.$u->stats['mab4'].' ('.($u->stats['mib4']).'+d'.($u->stats['mab4']-($u->stats['mib4'])+1).')<br /></div>';
		$rz2 .= '</span>';
		

	}
	/* $rz2 ='<script>getLine('.$prtpos[2].',"Броня ","0","0",'.$uShow[2].',3);</script>';
	if($uShow[2]==1)
	{		
		$rz2 .= '<div style="display:none;font-size: 11px;" id="lnk2">
		Броня головы: '.$u->stats['mib1'].'-'.$u->stats['mab1'].' ('.($u->stats['mib1']).'+d'.($u->stats['mab1']-($u->stats['mib1'])+1).')<br />
		Броня груди: '.$u->stats['mib2'].'-'.$u->stats['mab2'].' ('.($u->stats['mib2']).'+d'.($u->stats['mab2']-($u->stats['mib2'])+1).')<br />
		Броня живота: '.$u->stats['mib2'].'-'.$u->stats['mab2'].' ('.($u->stats['mib2']).'+d'.($u->stats['mab2']-($u->stats['mib2'])+1).')<br />
		Броня пояса: '.$u->stats['mib3'].'-'.$u->stats['mab3'].' ('.($u->stats['mib3']).'+d'.($u->stats['mab3']-($u->stats['mib3'])+1).')<br />
		Броня ног: '.$u->stats['mib4'].'-'.$u->stats['mab4'].' ('.($u->stats['mib4']).'+d'.($u->stats['mab4']-($u->stats['mib4'])+1).')<br /></div>';
	} */
	$rz3 = '<script>getLine('.$prtpos[3].',"Мощность ","0","0",'.$uShow[3].',4);</script>';
	if($uShow[3]==1)
	{
		if( $u->info['admin'] > 0 ) {
			$rz3 .= '<span style="font-size: 11px;">Мф. мощность урона: '.$u->inform('m10').'</span><br>';
		}
		
        $rz3 .= '<span style="font-size: 8pt;">Колющего урона: '.$u->inform('pa1').'%';
        $rz3 .= '</span><br /><span style="font-size: 8pt;">Рубящий урона: '.$u->inform('pa2').'%';
        $rz3 .= '</span><br /><span style="font-size: 8pt;">Дробящий урона: '.$u->inform('pa3').'%';
        $rz3 .= '</span><br /><span style="font-size: 8pt;">Режущий урона: '.$u->inform('pa4').'%';
	$rz3 .= '</span><br /><span style="font-size: 8pt;">Магии Огня: '.$u->inform('pm1').'%';
        $rz3 .= '</span><br /><span style="font-size: 8pt;">Магии Воздуха: '.$u->inform('pm2').'%';
        $rz3 .= '</span><br /><span style="font-size: 8pt;">Магии Воды: '.$u->inform('pm3').'%';
        $rz3 .= '</span><br /><span style="font-size: 8pt;">Магии Земли: '.$u->inform('pm4').'%';
        $rz3 .= '</span><br /><span style="font-size: 8pt;">Магии Света: '.$u->inform('pm5').'%';
        $rz3 .= '</span><br /><span style="font-size: 8pt;">Магии Тьмы: '.$u->inform('pm6').'%';
        $rz3 .= '</span><br /><span style="font-size: 8pt;">Серой магии: '.$u->inform('pm7').'%';
		$rz3 .= '</span>';
		
		/* $i = 1;
		while($i<=4)
		{
			$rz3 .= ucfirst(str_replace('Мф. мощности','Мощность ',$u->is['pa'.$i].': '));
			if($u->stats['pa'.$i]>0)
			{
				//$rz3 .= '+';
			}
			//$rz3 .= $u->stats['pa'.$i].'<br />';
			$rz3 .= $u->inform('pa'.$i).'<br>';
			$i++;
		}
		$i = 1;
		while($i<=7)
		{
			$rz3 .= ucfirst(str_replace('Мф. мощности ','Мощность ',$u->is['pm'.$i].': '));
			if($u->stats['pm'.$i]>0)
			{
				//$rz3 .= '+';
			}
			//$rz3 .= $u->stats['pm'.$i].'<br />';
			$rz3 .= $u->inform('pm'.$i).'<br>';
			$i++;
		} */
        
	}
	
	$zi = array( //Предметы влияющие на зоны
		'n' => array(
			'','голова','грудь','живот','пояс','ноги'
		),
		1 => array( 1 , 8 , 9 , 52 ), //голова
		2 => array( 4 , 5 , 6 ), //грудь
		3 => array( 2 , 4 , 5 , 6 , 13 ), //живот
		4 => array( 7 , 16 , 10 , 11 , 12 ), //пояс
		5 => array( 17 )  //ноги
	);
		
	$rz4 = '<script>getLine('.$prtpos[4].',"Кнопки ","0","0",'.$uShow[4].',5);</script>';
	if($uShow[4]==1)
	{
		$rz4 .= '<div style="display:none" id="lnk4"><center style="padding:5px;">';
		$rz4 .= '<input style="style="font-width:bold;" type="button" size="8" name="snatvso" value="Снять всё" onclick="top.frames[\'main\'].location=\'main.php?inv=1&remitem&otdel='.$_GET['otdel'].'\';"
		style="font-weight:bold;" />
		&nbsp;';
		$hgo = $u->testHome();
		if(!isset($hgo['id']))
		{
			$rz4 .=  '<input style="font-width:bold;" size="8" type="button" value="Возврат" onclick="top.frames[\'main\'].location=\'main.php?homeworld&rnd='.$code.'\';" />';
		}
		unset($hgo);
		$rz4 .= '</center>';
		$rz4 .=  '</div>';
	}
	
	$rz5 ='<script>getLine('.$prtpos[5].',"Комплекты&nbsp;&nbsp;&nbsp;<a href=\"#\" onClick=\"save_compl();\">запомнить</a>&nbsp;","0","0",'.$uShow[5].',6);</script>';
	if($uShow[5]==1)
	{
		$rz5 .= '<div style="display:none" id="lnk5">';
		$sp = mysql_query('SELECT * FROM `save_com` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" LIMIT 10');
		while($pl = mysql_fetch_array($sp))
		{
			$rz5 .= '<a href="?inv=1&delc1='.$pl['id'].'&otdel='.((int)$_GET['otdel']).'&rnd='.$code.'"><img src="//img.testcombats.ru/i/close2.gif" title="Удалить комплект" width="9" height="9"></a> <small><a href="?inv=1&usec1='.$pl['id'].'&otdel='.((int)$_GET['otdel']).'&rnd='.$code.'">Надеть &quot;'.$pl['name'].'&quot;</a></small><br>';
		}
		$rz5 .= '</div>';
	}
	
	$rz6 ='<script>getLine('.$prtpos[6].',"Приемы <a href=\"/main.php?skills=1&rz=4&rnd='.$code.'\">настроить</a>","0","0",'.$uShow[6].',6);</script>';
	if($uShow[6]==1)
	{
		$rz6 .= '<div style="display:none" id="lnk6">'; //возможно 5
		$sp = mysql_query('SELECT * FROM `complects_priem` WHERE `uid` = "'.$u->info['id'].'" LIMIT 10');
		$rz6 .= '<small>';
		while($pl = mysql_fetch_array($sp)) {
			$rz6 .= '<a onclick="if(confirm(\'Удалить набор  ?\')){location=\'main.php?inv=1&otdel='.round((int)$_GET['otdel']).'&delcop='.$pl['id'].'\'}" href="javascript:void(0)"><img src="//'.$c['img'].'/i/close2.gif" width="9" height="9"></a> <a href="main.php?inv=1&otdel='.round((int)$_GET['otdel']).'&usecopr='.$pl['id'].'">Использовать &quot;'.$pl['name'].'&quot;</a><br>';
		}
		$rz6 .= '</small>';
		$rz6 .= '</div>'; //возможно 5
	}
	
	$i = 0;
	while($i<count($prt))
	{
		if(isset(${'rz'.$prt[$i]}))
		{
			echo ${'rz'.$prt[$i]};
		}
		$i++;
	}
		//
		$ch3 = '';
		//
		if(isset($_GET['svitki_auto'])) {
			if($u->info['autospell'] == 0) {
				$u->info['autospell'] = 1;
			}else{
				$u->info['autospell'] = 0;
			}
			mysql_query('UPDATE `users` SET `autospell` = "'.$u->info['autospell'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}elseif(isset($_GET['get_exp'])) {
			if($u->info['stopexp'] == 0) {
				$u->info['stopexp'] = 1;
			}else{
				$u->info['stopexp'] = 0;
			}
			mysql_query('UPDATE `users` SET `stopexp` = "'.$u->info['stopexp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}elseif(isset($_GET['hide_plaw'])) {
			if($u->info['noplaw'] == 0) {
				$u->info['noplaw'] = 1;
			}else{
				$u->info['noplaw'] = 0;
			}
			mysql_query('UPDATE `users` SET `noplaw` = "'.$u->info['noplaw'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}
		if($u->info['vip'] == 3) {
			if($u->info['autospell'] == 0) {
				$ch1 = '';
			}else{
				$ch1 = 'checked="checked"';
				$ch1s = 'style="font-weight:bold"';
			}
			if($u->info['stopexp'] == 0) {
				$ch2 = 'onclick="if(confirm(\'Вы дествительно хотите ОСТАНОВИТЬ получение ОПЫТА и личного РЕЙТИНГА?\')) location.href=\'/main.php?inv&get_exp=0\';"';
			}else{
				$ch2 = 'checked="checked"  onclick="location.href=\'/main.php?inv&get_exp=0\';"';
				$ch2s = 'style="font-weight:bold"';
			}
			if($u->info['noplaw'] == 0) {
				$ch3 = 'onclick="if(confirm(\'Вы дествительно хотите скрыть отображение плащей?\')) location.href=\'/main.php?inv&hide_plaw=1\';"';
			}else{
				$ch3 = 'checked="checked" onclick="location.href=\'/main.php?inv&hide_plaw=0\';"';
				$ch3s = 'style="font-weight:bold"';
			}
			//
			echo '<br><label '.$ch1s.'><input type="checkbox" '.$ch1.' onclick="location.href=\'/main.php?inv&svitki_auto=1\';" /> Автопополнение свитков</label><br><label '.$ch2s.'><input type="checkbox" '.$ch2.' /> Заморозка опыта</label><br><label '.$ch3s.'><input type="checkbox" '.$ch3.' /> Скрыть плащи</label>';
		}
?>
<script>
<?
$i = 0;
while( $i < count($uShow) ) {
	if( isset($uShow[$i]) && $uShow[$i] == 1 ) {
		echo '$("#lnk'.$i.'").slideToggle();';
	}
	$i++;
}
?>
</script>
</td>
</tr>
</table>