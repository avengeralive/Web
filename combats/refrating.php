<?
define('GAME',true);
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');

$url = explode('?', $_SERVER["REQUEST_URI"]);
$url = explode('/', $url[0]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Рейтинг Рефералов - primebk Бойцовский Клуб</title>
<link rel=stylesheet type="text/css" href="/i/main.css">
<meta content="text/html; charset=utf-8" http-equiv=Content-type>
<link href="/i/move/design3.css" rel="stylesheet" type="text/css">
<META Http-Equiv=Cache-Control Content="no-cache, max-age=0, must-revalidate, no-store">
<meta http-equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
<style type="text/css">
<!--
@import url(https://fonts.googleapis.com/css?family=Philosopher&subset=latin,cyrillic);
body, td {  font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif; font-size: 12pt; color: #000000 }

A {  font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif; font-size: 12pt; color: #decdb9;}
a:link { color: #333; text-decoration: none}
A:visited { color: #333; text-decoration: none}
A:hover, A:active {  color: red; text-decoration: none;}

body {
	background-color: #000000;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 12pt;
	color: #000000; }

	.nicname {
	color: #bfa178;
	font-size: 9pt;
	font-weight: bold;}
td.text {
/*background-image:url(/new/register/bgtext.jpg);*/
background-position:right top;
background-repeat:no-repeat;
}
	.place {
	color: #cc8e43;
	font-size: 8pt;
	font-weight: bold;}
	.nomber {
	color: #7c3e00;
	font-size: 8pt;
	font-weight: bold;}
	.green {
	color: #526700;
	font-size: 8pt;
	font-weight: bold;}
	.about {
	font-size: 9pt;}

	.levels {
	color: #bfa178;
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 7pt; }

	TD.topbgl {
	background-image: url(/new/register/topbgl.jpg);
	background-position: right top}
.style1 {
	color: #4b2500;
	font-weight: bold;
	font-size: 9pt;
}
a.lnkstyle1,a.lnkstyle1:link,a.lnkstyle1:visited,a.lnkstyle1:hover,a.lnkstyle1:active{
	color: #4b2500;
	font-weight: bold;
	font-size: 9pt;
}
a.lnkstyle2 { font-size: 9pt; font-weight: bold; color: #4b2500;}
a.lnkstyle2:link { font-weight: bold; color: #4b2500; text-decoration: none}
a.lnkstyle2:visited { font-weight: bold; color: #4b2500; text-decoration: none}
a.lnkstyle2:hover, a.lnkstyle2:active {  font-weight: bold; color: #84643e; text-decoration: none;}

input { font-size: 12px;}

-->
</style>
<script src="/new/register/flash.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>


</head>
<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="39%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="513" class="topbgl">&nbsp;</td>
      </tr>
    </table></td>
    <td width="1%" valign="top" background="/new/register/bgl.jpg"><script type="text/javascript">
AC_FL_RunContent( 'codebase','https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','67','height','108','src','/new/register/lamp1','quality','high','pluginspage','https://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','/new/register/lamp1' ); //end AC code
    </script>
      <noscript>
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="67" height="108">
        <param name="movie" value="/new/register/lamp1.swf" />
        <param name="quality" value="high" />
        <embed src="/new/register/lamp1.swf" quality="high" pluginspage="https://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="67" height="108"></embed>
      </object>
      </noscript><img src="/new/register/topl.jpg" /></td>
    <td width="20%" valign="top"><table width="850" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="/new/register/top.jpg" width="850" height="35" /></td>
      </tr>
      <tr>
        <td height="1"><img src="/new/register/top1_nul.jpg" width="850" height="65" /></td>
      </tr>
      <tr>
        <td height="593" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1" valign="top" background="/new/register/vesch_leftbg.jpg"><img src="/new/register/vesch_left.jpg" width="49" height="416" /></td>
            <td height="577" align="center" valign="top" bgcolor="#edd7ae"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="540" align="left" valign="top">

</HEAD>
<BODY aLink=#000000 bgColor=#666666 leftMargin=0 link=#000000 topMargin=0
vLink=#333333 marginheight="0" marginwidth="0" 0>
<TABLE border=0 cellPadding=0 cellSpacing=0 height="100%" width="100%">
  <TBODY>
  <TR>
    <TD vAlign=top width="15%">

            <!-- Begin of text -->

            <style type="text/css">

            .rating, .rating tr, .rating tr td { font-family: Times New Roman; font-size: 14px;
                    border: 1px solid black; border-collapse: collapse; text-align: center; vertical-align: top; }
            .rating { border: 3px solid black; border-collapse: collapse;}
            .rating .al { text-align: left; }
            .rating .vam { vertical-align: middle; }
            .rating .ac { text-align: center; }
            .rating .b { font-weight: bold; }
            .rating .p { padding: 0px 5px 0px 5px; }
            .rating .btop { border-top: 3px solid black; border-collapse: collapse;}
            .rating .bright { border-right: 3px solid black; border-collapse: collapse;}
            .rating .bleft { border-left: 3px solid black; border-collapse: collapse;}
            .rating .bbottom { border-bottom: 3px solid black; border-collapse: collapse;}
            .rating .light { background: #F4E7CC;}

            .rinfo p { text-align: justify; text-indent: 25px;}
            .rinfo p span { color: red; font-weight: bold;}
            h2 { margin: auto; text-align: center; font-family: Times New Roman; font-size: 18px; font-weight: bold; margin-top: 10px; margin-bottom: 5px;}

            </style>

            <h2 style=" margin-top: 0;">Рейтинг Рефералов</h2>    <br />

            <!--center>
              <a href="/rating_ref_gonka.php">Посмотреть результаты реферальной гонки:</a>
            </center-->

            <table width="100%" class="rating" style="margin-top: 5px;" >

            <tr class="b bbottom">
                <td class="bright p" width=100>Место</td>
                <td class="bright p al" style='padding-left: 20px;'>Персонаж</td>
                <td class="bright p" width=100>Количество рефералов</td>
            </tr>
			<?
			$i = 0;
			$html = '';
			$bya = '`ref` DESC';
			//mysql_query('insert into `aaa_ref_reting_list` (`uid`,`time`,`ref`,`date`,`pos`) VALUES ("158646","'.time().'","21","'.date('dmY').'","1")');
			$sp = mysql_query('SELECT * FROM `aaa_ref_reting_list` WHERE `date` = "'.date('dmY').'" ORDER BY '.$bya.' LIMIT 1000');
			while( $pl = mysql_fetch_array($sp) ) {
				$last_post = mysql_fetch_array(mysql_query('SELECT `pos` FROM `aaa_ref_reting_list` WHERE `uid` = "'.$pl['uid'].'" AND `date` != "'.$pl['date'].'" ORDER BY `id` DESC LIMIT 1'));
				$i++;
				$vid = $i;
				if( isset($last_post['pos']) && $url[2] != 'exp' && $url[2] != 'wins' ) {
					$last_post = $last_post['pos'];
					if( $last_post < $pl['pos'] ) {
						$vid = '<img src="https://img.testcombats.ru/down_red.png" height="16"> <b>'.$i.'</b> <sup style=\'color:red;\'>-'.($pl['pos']-$last_post).'</sup>';
					}elseif( $last_post > $pl['pos'] ) {
						$vid = '<img src="https://img.testcombats.ru/up_green.png" height="16"> <b>'.$i.'</b> <sup style=\'color:green;\'>+'.($last_post-$pl['pos']).'</sup>';
					}
				}
				//
				$usr = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`align`,`clan`,`level` FROM `users` WHERE `id` = "'.$pl['uid'].'" AND `banned` = 0 LIMIT 1'));
				$clan = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `clan` WHERE `id` = "'.$usr['clan'].'" LIMIT 1'));
				$clrt = '';
				if( 'id'.$usr['id'] == $url[2] ) {
					$clrt = ' bgcolor="#c3a878"';	
				}
				if(isset($clan['id'])) {
					$img = '<img src=https://img.testcombats.ru/i/clan/'.$clan['name'].'.gif>';
				}elseif($usr['clan'] == 0) {
					$img = '';
				}
				$html .= "<tr".$clrt."><td class='vam p' style='font-size: 14pt;'><b>".$vid."</b><a name='".$usr['id']."' /></td>
                      <td class='vam al' style='padding-left: 20px;'><img src='https://img.testcombats.ru/i/align/align".$usr['align'].".gif' >".$img."";
					  $html .= '<b><a href="https://primebktest.testcombats.ru/info/'.$usr['login'].'" target="_blank">'.$usr['login'].'</a> ['.$usr['level'].'] <a target=_blank href=https://primebktest.testcombats.ru/info/'.$usr['id'].'><img src=https://img.testcombats.ru/i/inf_capitalcity.gif></a></b></td>';
					  $html .= '<td class=\'vam p\' style=\'font-size: 14pt;\'><b>'.$pl['ref'].'</b></td>';
            }
			echo $html;
			unset($html);
			?>
            </table>

            <div class="rinfo">
              <p><center style="font-size: 14px;">Рейтинг обновляется каждые 24 Часов.</center></p>
            </div>






            <!-- End of text --></TD><!--td width=15% valign=top><img src="encicl/images/new_ico.gif" width=86 height=89 border=0></td--></TR>
    </TBODY></TABLE></TD>
</TR></TBODY></TABLE>            <td width="1" valign="top" bgcolor="#edd7ae"><img src="/new/register/vesch_right.jpg" width="26" height="423" /></td>
          </tr>
          <tr>
            <td colspan="3" valign="top"><img src="/new/register/vesch_bot2.jpg" width="850" height="34" /></td>
            </tr>
        </table>

        </td>
      </tr>
    </table></td>
    <td width="1%" valign="top" background="/new/register/bgr2.jpg"><img src="/new/register/topr.jpg" width="83" height="593" /><br />
    <img src="/new/register/right2.jpg" width="83" height="114" /></td>
    <td width="39%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="507" background="/new/register/topbgr.jpg">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td colspan="3" valign="top"><img src="/new/register/bottom.jpg" width="1000" height="163" /></td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td colspan="3" align="left" valign="top"><table width="970" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="225" align="left" valign="top">&nbsp;</td>
        <td width="546" align="center" valign="top">
    <style>
		A.copi { font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif; font-size: 7pt; color: #005348; font-weight: bold; text-decoration: none;}
		a.copi:link { color: #005348; font-weight: bold; text-decoration: none;}
		A.copi:visited { color: #005348; font-weight: bold; text-decoration: none;}
		A.copi:hover, A.copi:active { color: #329700; font-weight: bold; text-decoration: none;}
		</style>
		<br><span style="color:#EBD88B; font-family:'Philosopher', sans-serif;font-size: 18px;">Бойцовский Клуб © 2013-<?=date('Y');?></span>
		</td>
        <td width="199" align="right" valign="top"><img src="/new/register/pix.gif" width="10" height="30" /><br />
        			 &nbsp;
		        </td>
      </tr>
    </table>
    </td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
			<div style="display:none;"></div>
            <? echo $c['counters'];//счетчики ?>
		</body>
</html>
