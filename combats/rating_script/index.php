<?
define('GAME',true);
include('/home/admin/web/testcombats.ru/public_html/_incl_data/__config.php');
include('/home/admin/web/testcombats.ru/public_html/_incl_data/class/__db_connect.php');

    function  microLogin($id,$t,$nnz = 1) {
    	global $c;
	if($t==1) {
		$inf = mysql_fetch_array(mysql_query('SELECT `u`.`id`,`u`.`align`,`u`.`login`,`u`.`clan`,`u`.`level`,`u`.`city`,`u`.`online`,`u`.`sex`,`u`.`cityreg`,`u`.`palpro`,`u`.`invis`,`st`.`hpNow` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`id`="'.mysql_real_escape_string($id).'" OR `u`.`login` = "'.mysql_real_escape_string((int)$id).'" LIMIT 1'));
	}else{
		$inf = $id;
		$id = $inf['id'];
	}
      	$r = '';
	if($inf['align']>0) {
		$r .= '<img width="12" height="15" src="//img.testcombats.ru/i/align/align'.$inf['align'].'.gif" />';
	}
	if($inf['clan']>0) {
		$cln = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`name_mini`,`align`,`type_m`,`exp` FROM `clan` WHERE `id` = "'.$inf['clan'].'" LIMIT 1'));
	if(isset($cln['id'])) {
		$r .= '<img width="24" height="15" src="//img.testcombats.ru/i/clan/'.$cln['name_mini'].'.gif" />';
	}
}
	if($inf['cityreg'] == '') {
		$inf['cityreg'] = 'capitalcity';
	}
	    $r .= ' <b>'.$inf['login'].'</b> ['.$inf['level'].']<a target="_blank" href="//testcombats.ru/inf.php?'.$inf['id'].'"><img rel="tooltip" title="Инф. о '.$inf['login'].'" src="//img.testcombats.ru/i/inf_'.$inf['cityreg'].'.gif" /></a>';	
     	return $r;
    }
?>
<HTML><HEAD><TITLE>Рейтинг игроков - НБК - www.testcombats.ru</TITLE>
<META content=INDEX,FOLLOW name=robots>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<META http-equiv=Pragma content=no-cache>
<META http-equiv=Cache-control content=private>
<META http-equiv=Expires content=0>

<link href="//testcombats.ru/rating_script/images/main1.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	width:100%;
	height:100%;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #000;
	font-size: 10pt; font-family: Verdana, Helvetica, Arial, Tahoma, sans-serif;
	background: url(//img.testcombats.ru/admin/zmk_all.jpg) repeat-y;
    background-position: center center;
    background-size: cover;
}
.style6 {	color: #DFD3A3;
	font-size: 9px;
}
A:link {
	FONT-WEIGHT: normal; COLOR: #524936; TEXT-DECORATION: none
}
A:visited {
	FONT-WEIGHT: normal; COLOR: #633525; TEXT-DECORATION: none
}
A:active {
	FONT-WEIGHT: normal; COLOR: #77684d; TEXT-DECORATION: none
}
A:hover {
	COLOR: #000000; TEXT-DECORATION: underline
}
.style10 {font-size: 9pt; font-weight: bold; }
.style7 {font-size: 9pt}
.style8 {color: #4F4B49}
ul {margin:0px; height:0px;}

li
{
list-style-type:decimal;
}


.bleft {
	background-image: url(//img.testcombats.ru/forumsimg/left.png);
    background-repeat: repeat-x;
    background-position: bottom;
}
.btitle {
    background-image: url(//img.testcombats.ru/forumsimg/top_line.png);
    background-repeat: repeat-x;
    background-position: bottom;
	text-align: center;
    color: white;
    font-size: 8pt;
    font-weight: bold;
    padding-top: 10px;
}
.bright {
	background-image: url(//img.testcombats.ru/forumsimg/right.png);
    background-repeat: repeat-x;
    background-position: bottom;
}	

.bmleft {
	background-image: url(//img.testcombats.ru/forumsimg/leftl.png);
}

.bmright {
	background-image: url(//img.testcombats.ru/forumsimg/rightl.png);
}

.bm1left {
	background-image: url(//img.testcombats.ru/forumsimg/leftd.png);
    background-repeat: repeat-x;
    background-position: bottom;
}
.bm1title {
    background-image: url(//img.testcombats.ru/forumsimg/bottom_line.png);
    background-repeat: repeat-x;
    background-position: bottom;
	text-align: center;
    color: white;
    font-size: 8pt;
    font-weight: bold;
    padding-bottom: 10px;
}
.bm1right {
	background-image: url(//img.testcombats.ru/forumsimg/rightd.png);
    background-repeat: repeat-x;
    background-position: bottom;
}

.fade {
  opacity: 1;
}

.fade:hover {
  opacity: 0.6;
}

.fnts {
	font-size: 8pt;
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
</HEAD>
<BODY bgColor=#000000 leftMargin=0 topMargin=0 marginwidth="0" marginheight="0">
<div align="center">
<table width="79%" height="62" border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td width="129" class="bleft">&nbsp;</td>
<td align="center" class="btitle">Наш Бойцовский клуб - Быть, а не казаться.</td>
<td width="129" class="bright">&nbsp;</td>
</tr>
</tbody></table></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr valign=top>
	
	<td align=center>
		<table cellspacing=0 cellpadding=0 width="75%" border=0>
		<tr valign=top>
		<td width="23" class="bmleft">&nbsp;</td>
		<td width="1" bgcolor="#F2E5B1">&nbsp;</td>
		<td bgcolor="#f2e5b1"></td>
		<td rowspan=2 bgcolor="#f2e5b1">
    <br><h3>Рейтинг персонажей Бойцовского Клуба</h3>
	<div align="center">
    <TABLE width="80%" border=0 cellPadding=2 cellSpacing=0 name="F1">
    <TBODY>
    <td bgcolor="#F2E5B1">
    <td valign=top><br><BR>
    <TABLE width=100%>
    <td>&nbsp; &nbsp; Рейтинг персонажей <? if(isset($_GET['type']) && $_GET['type'] == 2) { ?><a title="Нажмите чтобы посмотреть рейтинг за полночь" href="?user=<?=$p['id']?>&type=1">Победа</a><? }else{ ?><a title="Нажмите чтобы посмотреть текущий рейтинг" href="?user=<?=$p['id']?>&type=2">Опыт</a><? } ?>. &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
    <TD align=right>Статистика на <span class="style8"><code><? if(isset($_GET['type']) && $_GET['type'] == 2) { ?><?php echo date('d.m.o H:i'); ?><? }else{ echo date('d.m.o H:i'); } ?></code></span></TABLE>
<P>
<P>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="//testcombats.ru/rating_script/images/ram12_34.gif">
<tr>
<td align="left" scope="col"><img src="//testcombats.ru/rating_script/images/ram12_33.gif" width="12" height="11"></td>
<td scope="col"></td>
<td width="18" align="right" scope="col"><img src="//testcombats.ru/rating_script/images/ram12_35.gif" width="13" height="11"></td>
</tr>
</table>
<table width=100% border=0 align=center cellpadding=0 cellspacing="1">
<tr>
<td colspan="5"></td>
</tr>
<tr bgcolor="#ECDFAA">
<td><b>№</b></td>
<td><b>Персонаж</b></td>
<?  
        $r = 'Опыт';  
    if(isset($_GET['type']) && $_GET['type'] == 2) { 
        $r = 'Победа';
    }
?>
    <td align="center"><b><?php echo $r; ?></b></td>
    </tr>
    <tr bgcolor="#3D3D3B">
    <td></td>
    <td width="60%"></td>
    <td width="32%"></td>
    </tr>
    <ul>
<?php
    //рейтинг персонажей победы
        $r = '';
        $i = 1;
        $j = 0;
        $rt_type = 'exp';
    if(isset($_GET['type']) && $_GET['type'] == 2) {
      	$rt_type = 'win';
    }        
        $sp = mysql_query('SELECT * FROM `users` AS `us` LEFT JOIN `stats` AS `st` ON (`us`.`id` = `st`.`id`) WHERE `us`.`real` = 1 AND `us`.`pass` != "saintlucia" AND `us`.`admin` != "1" AND `us`.`admin` != "2" AND `us`.`align` != "50" AND `us`.`align` != "1.4" AND `us`.`align` != "3.075" AND `us`.`clan` != "38" AND `st`.`bot` != "2" AND (`us`.`pass` NOT LIKE "%saintlucia%") ORDER BY '.$rt_type.' DESC LIMIT 100');
    while( $pl = mysql_fetch_array($sp) ) {
       	$numbi = '';
    	$r .= '<tr height="20" bgcolor="#ECDFAA">';
	if( $i == 1 ) {
		$numbi = '<img src="//img.testcombats.ru/gold11.png" height="14">';
	}elseif( $i == 2 ) {
		$numbi = '<img src="//img.testcombats.ru/silver11.png" height="14">';
	}elseif( $i == 3 ) {
		$numbi = '<img src="//img.testcombats.ru/bronze11.png" height="14">';
	}
        $r .= '<td align="center" height="20" style="font-size:10pt" align=center valign="top" class="mystrong">&nbsp;'.$numbi.$i.'&nbsp;</td>';
        $r .= '<td height="20" align=left valign="top" class="mystrong">&nbsp;&nbsp;'.microLogin($pl['id'],1).'&nbsp;</td>';
     	$r .= '<td align="center" height="20" align=right valign="top" class="mystrong">'.number_format($pl[''.$rt_type.'']/24,0,'',' ').'</td>';
        $r .= '</tr>';	
     	$i++;
    }

    if($r == '') {
        $r = '<tr  bgcolor="#ECDFAA">';
     	$r .= '<td align=right valign="top" class="mystrong"></td>';
      	$r .= '<td align=center valign="top" class="mystrong">К сожалению рейтинг пуст</td>';
    	$r .= '<td align=right valign="top" class="mystrong"></td>';
        $r .= '</tr>';	
    }
        echo $r;
?>
    </ul>
    <tr>
    <td colspan=4><img src="//testcombats.ru/rating_script/images/1x1.gif" width="1" height="1" border=0 alt=""></td>
    </tr>
    <tr>
    <td colspan=5><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="//testcombats.ru/rating_script/images/ram12_34.gif">
    <tr>
    <td align="left" scope="col"><img src="//testcombats.ru/rating_script/images/ram12_33.gif" width="12" height="11"></td>
    <td scope="col"></td>
    <td width="18" align="right" scope="col"><img src="//testcombats.ru/rating_script/images/ram12_35.gif" width="13" height="11"></td>
    </tr>
    </table></td>
    </tr>
    </table><br>
<!--center><small>Рейтинг плавающий. Зависит от ваших активных боевых действий за последние 3 месяца.</small></center-->
</FORM>
</p>
</td>
</tr>
</TABLE>
<!-- End of text -->
</td>
<td width="23" class="bmright">&nbsp;</td>
</tr>
</table></div>
</td>
    

</tr>
</table>
</td>

</tr>
</table>
<div align="center">
<table width="79%" height="62" border="0" cellpadding="0" cellspacing="0">
		      <tbody><tr>
		        <td width="129" class="bm1left">&nbsp;</td>
		        <td class="bm1title"><!--LiveInternet counter--><a href="//www.liveinternet.ru/click"
target="_blank"><img id="licntC407" width="80" height="31" style="border:0" 
title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня"
src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAEALAAAAAABAAEAAAIBTAA7"
alt=""/></a><script>(function(d,s){d.getElementById("licntC407").src=
"//counter.yadro.ru/hit?t13.2;r"+escape(d.referrer)+
((typeof(s)=="undefined")?"":";s"+s.width+"*"+s.height+"*"+
(s.colorDepth?s.colorDepth:s.pixelDepth))+";u"+escape(d.URL)+
";h"+escape(d.title.substring(0,150))+";"+Math.random()})
(document,screen)</script><!--/LiveInternet--> <a href="https://rpgtop.su/26325" title="Рейтинг Ролевых Ресурсов - RPG TOP" target="_blank">
            <img src="//img.rpgtop.su/88x31x11x8.gif" alt="Рейтинг Ролевых Ресурсов - RPG TOP" width="88" height="31" border="0"></a></td>
		        <td width="129" class="bm1right">&nbsp;</td>
		      </tr>
</tbody></table></div>
</BODY>
</HTML>