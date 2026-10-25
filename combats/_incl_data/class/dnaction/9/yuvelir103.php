<?php
if(!defined('GAME')) { die(); }

if($_GET['go_away']) { header('location: main.php'); die(); }
if($u->info['battle'] != 0) { header('location: main.php'); die(); }

if(isset($_POST['clip76_'])) {
  $obj = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "9205" LIMIT 1'));
    if($u->count_items(2182, $u->info['id'], 20) > 19) {
    if($u->count_items(2181, $u->info['id'], 5) > 4) {        
        $data = '|frompisher=103';
                $u->addItem(9205, $u->info['id'], $data, $obj);
                $u->deleteItemID(2182, $u->info['id'], 20);
                $u->deleteItemID(2181, $u->info['id'], 5);
                $err = 'Вы получили Сияющий Изумруд х1';
    
    } else {
      $err = "Не хватает &quot;Рубин;";
    }
    } else {
      $err = "Не хватает &quot;Изумруд&quot;";
    }
    
    } 

function getColor($id, $num) {
  global $u;
  $color = 'green';
  $ch = mysql_query("SELECT `id` FROM `items_users` WHERE `uid` = ".$u->info['id']." AND `delete` = 0 AND `item_id` = ".(int)$id." AND inShop = 0 AND inOdet = 0");
  if(mysql_num_rows($ch) < $num) { $color = 'red'; }
  return $color;
}

function getImg($id, $num) {
  global $u;
  $img = 'good.png';
  $ch = mysql_query("SELECT `id` FROM `items_users` WHERE `uid` = ".$u->info['id']." AND `delete` = 0 AND `item_id` = ".(int)$id." AND inShop = 0 AND inOdet = 0");
  if(mysql_num_rows($ch) < $num) { $img = 'i/clear.gif'; }
  return $img;
}

?>
<html><head>
<link rel="stylesheet" type="text/css" href="https://img.testcombats.ru/css/main.css" />
<meta content="text/html; charset=windows-1251" http-equiv="Content-type" />
<meta http-equiv="Cache-Control" content="no-cache, max-age=0, must-revalidate, no-store" />
<meta http-equiv="PRAGMA" content="NO-CACHE" />
<meta http-equiv="Expires" content="0" />
<style>
.row { cursor:pointer; }      
#answer1 {color: #003388; font-weight: bold; text-decoration: none; }
</style>
<script type="text/javascript">
function show(ele) {
  var srcElement = document.getElementById(ele);
  if(srcElement != null) {
    if(srcElement.style.display == "block") {
      srcElement.style.display= 'none';
    } else {
      srcElement.style.display='block';
    }
  }
}

function OpenDiv(vr) {
  var dg01 = document.getElementById(vr);
  if(dg01.style.display == '') {
    dg01.style.display = 'none'
  } else {
    dg01.style.display = ''
  }
}
</script>
<script type="text/javascript" src="https://img.testcombats.ru/js/inf.0.104.js?<?=mt_rand(1436,1293286936)/10000000000?>" charset="utf-8"></script>
</head>
<body leftmargin=5 topmargin=5 marginwidth=5 marginheight=5  bgcolor="#d7d7d7" onLoad="">
<div id=hint4 class=ahint></div>
<TABLE cellspacing=0 cellpadding=2 width=100%>
<TD style="width: 40%; vertical-align: top; ">
<TABLE cellspacing=0 cellpadding=2 style="width: 100%; ">
<tr><TD align=center><h4>Ювелирная Мастерская</h4></TD></tr>
<TR>
</TABLE>
</TD>
<TD style="width: 5%; vertical-align: top; ">&nbsp;</TD>
</TR>
</TABLE>
</html>
<? if($err != '') { echo "<center><b style='color: Red;'>".$err."</b></center>"; } ?>
<table width="100%">
<tr>
<td width="255" valign="top"><div align="left"><? $st = array(); $st2 = array(); $st = $u->getStats($u->info['id'],1); $st2 = $st[1]; $st = $st[0]; $rgd = $u->regen($u->info['id'],$st,1); $us = $u->getInfoPers($u->info['id'],1,$st); if($us!=false){ echo $us[0]; }else{ echo 'information is lost.'; } ?></div>
<div align="left"></div><div align="left"></div>
<div style="float: left">
<td valign="top"><br />
<div id="step1" style="margin-left: 20px;"></div>
<br /><br />
<table>
<tr>
<td>
<div id="answer1">
  • <a href="#" onClick="OpenDiv('clip76')">Сияющий Изумруд 1 штука</a><br />
  <div id="clip76" style="display: none; color: black;"><br />
  <b style="color:<?=getColor(2182, 20)?>"> Изумруд <font color=blue>х20 </font><img src="https://img.testcombats.ru/<?=getImg(2182, 20)?>" width="13" height="13" /></b><br />
  <b style="color:<?=getColor(2181, 5)?>"> Рубин <font color=blue>х5 </font><img src="https://img.testcombats.ru/<?=getImg(2181, 5)?>" width="13" height="13" /></b> <br />
  <form action="" method="POST"><br>
  <input type="submit" name="clip76_" value="Собрать" /><br /><br />
  </form>
  </div>
  • <a href="?go_away=1">Уйти. (Выход)</a>
    </div></td></tr>
    </table>
    </td>
    </div>
    <div style="float:left">
                <td width="120">
                    <table width="100" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <TABLE  border=0 cellSpacing=1 cellPadding=0 width="100%">
                                    <TBODY>
                                    <TR vAlign=top>
                                        <TD>
                                            <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                                                <TBODY>
                                                </TBODY></TABLE></TD>
                                        <TD><TABLE border=0 cellSpacing=0 cellPadding=0 width="100%"><TBODY>

                                        </TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
                            </td>
                        </tr>
                    </table>
                </td>

</tr>
</table>
</div>
<TABLE width=100% align="right">
<tr><td>
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</TD></tr></TABLE>
</body>
</html>