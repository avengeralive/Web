<?php
define('GAME',true);
function GetRealIp()
{
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
    $ip=$_SERVER['REMOTE_ADDR'];
}
    return $ip;
}
    define('IP',GetRealIp()); 

include_once('_incl_data/__config.php');
include_once('_incl_data/class/__db_connect.php');
include_once('_incl_data/class/__user.php');
include_once('_incl_data/class/__filter_class.php');
include_once('_incl_data/class/__chat_class.php');

function er($e)
{
	global $c;

	die('<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru">
	<TITLE>Произошла ошибка</TITLE></HEAD><BODY text="#FFFFFF"><p><font color=black>Произошла ошибка: <pre>'.$e.'</pre><b><p><a href="//'.$c['host'].'/">Назад</b></a><HR><p align="right">(c) <a href="//'.$c[0].'/">'.$c[1].'</a></p></body></html>');
}

/* if(isset($_GET['showcode']))
{
	include('show_reg_img/security.php');
	die();
} */

if($u->info['joinIP']==1 && $u->info['ip']!=IP)
{
	er('#Пожалуйста авторизируйтесь с главной страницы');
}
elseif(isset($_GET['exit']))
{
    //setcookie('login', '', time() - 60 * 60 * 24, '', '.'.$c['host']);//mine
    //setcookie('pass',  '', time() - 60 * 60 * 24, '', '.'.$c['host']);//mine
	setcookie('login', '', time()-60*60*24*30,'',$c['host']);
	setcookie('pass',  '', time()-60*60*24*30,'',$c['host']);
	setcookie('login', '', time()-60*60*24*30);
	setcookie('pass',  '', time()-60*60*24*30);
	setcookie('auth2', '', time()-60*60*24*7,'','.'.$c['host']);
	setcookie('auth2', '', time()-60*60*24*7, '', $c['host']);
    setcookie('auth2', '', time()-60*60*24*7);

	mysql_query('UPDATE `users` SET `online` = "'.(time()-520).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	die('<script>top.location = "//'.$c['host'].'/";</script>');
}elseif(!isset($u->info['id'])) {
	//er('Возникла проблема с определением id персонажа<br>Авторизируйтесь с главной страницы.');
    header('location: /');
	die();
}

if($u->info['online'] < time()-60) {
	$filter->setOnline($u->info['online'],$u->info['id'],0);
	mysql_query("UPDATE `users` SET `online`='".time()."',`timeMain`='".time()."' WHERE `id`='".$u->info['id']."' LIMIT 1");	
}

//$u->stats = $u->getStats($u->info['id'],0);

/* if($u->info['activ']>0)
{
	include('activnew.php');
	die();
} */
?>

<html xmlns="//www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<title>Наш Бойцовский Клуб - www.testcombats.ru</title>
<link href="//img.testcombats.ru/css/main.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/clu0b.css" />
<link rel="stylesheet" type="text/css" href="css/windows.css" />
<link rel="stylesheet" type="text/css" href="css/hack.css" />
<script>
var des = <?=(0+$u->info['design'])?>;
var c = { 
	noEr:0,
	noErTmr:0,
	url:'<?=$c['host']?>',
	img:'img.testcombats.ru',
	uid:<?=(0+$u->info['id'])?>,
	login:'<?=$u->info['login']?>',
	city:'<?=$u->info['city']?>',
	lvl:<?=$u->info['level']?>,
	rnd:'<?=$code?>',
	filter:0,
	time:<?=time()?>,
	pl:0,
	align:<?=$u->info['align']?>,
	clan:<?=$u->info['clan']?>,
	admin:<?=$u->info['admin']?>,
	sound:0,
	money:<?=$u->info['money']?>
}, sd4key = "<?=$u->info['nextAct']?>", lafstReg = {},enterUse = 0;

function ctest(city) {
	if(city != c['city']) {
		top.location = '/battle';
	}
}

function testKey(event)
{
	if(event.keyCode==10 || event.keyCode==13)
	{
		if(top.enterUse == 0)
		{
			chat.subSend();
			top.enterUse = 1;
			setTimeout('top.enterUse = 0',1000);
		}
	}
}
setInterval('c.time++',1000);
</script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script>
$.ajaxSetup({cache: false});
$(window).error(function(){
  return true;
});
var iusrno = {};
function ignoreUser(u) {
	if( iusrno[u] == undefined || iusrno[u] == 0 ) {
		//top.iusrno[u] = 1;
		$('#main').attr({'src':'main.php?friends=1&ignore=' + u + ''});
	}else{
		//top.iusrno[u] = 0;
		$('#main').attr({'src':'main.php?friends=1&ignore=' + u + ''});
	}
}
</script>
<script type="text/javascript" src="js/jqueryrotate.js?<?=time()?>"></script>
<script type="text/javascript" src="js/jquery.zclip.js?<?=time()?>"></script>
<script type="text/javascript" src="js/jquery.cookie.js?<?=time()?>"></script>
<script type="text/javascript" src="js/title.js?<?=time()?>"></script>
<script type="text/javascript" src="js/gameEngine.js?<?=time()?>"></script>
<script type="text/javascript" src="js/interface.js"></script>
<script type="text/javascript" src="js/onlineList.js?<?=time()?>"></script>
<script type="text/javascript" src="js/hpregen.js?<?=time()?>"></script>
<script type="text/javascript" src="//hosted.muses.org/mrp.js"></script>
<style type="text/css">
		/* Additional classes examples */
        #touchmain {
			padding: 0px;
			border: 0;
			overflow: auto;
			margin: 0px;
		}
		.woman a {
			color:#C33;
		}
		.woman a:hover {
			color:#ff0000;
		}
		img { vertical-align:bottom; }
		#tgf_loadingLine {
			height:18px;
			width:100%;
			color:#776b4a;
			background-color:#ddd5bf;
			position:relative;
		}
		.tfpgs {
			padding:5px;
			background-color:#d4cbb4;
			border-bottom:1px solid #988e73;
			border-top:1px solid #eae3d0;
			cursor:default;
			text-align:center;
		}
		.tgf_msg0 { 
			padding:5px;
			background-color:#c6b893;
			border-bottom:1px solid #988e73;
			border-top:1px solid #eae3d0;
			cursor:default;
		}
		.tgf_msg1 { 
			padding:5px;
			background-color:#d4cbb4;
			border-bottom:1px solid #988e73;
			border-top:1px solid #eae3d0;
			cursor:default;
		}
		.tgf_msgt {
			color:#988e73;
			padding-left:2px;
			padding-right:2px;
			border-right:1px solid #b1a993;
		}
		.tf_btn1 {
			background-color:#ddd5bf;
			padding-left:10px;
			padding-right:10px;
			padding-bottom:3px;
			padding-top:3px;
			margin:1px;
			color:#988e73;
			cursor:pointer;
		    -moz-border-radius: 4px;
		    -webkit-border-radius: 4px;
		    border-radius: 4px;
		}
		
		.tf_btn1:hover {
			background-color:#b7ae96;
			color:#ddd5bf;
			cursor:pointer;
		}
		
		.tf_btn11 {
			background-color:#988e73;
			padding-left:10px;
			padding-right:10px;
			padding-bottom:3px;
			padding-top:3px;
			margin:1px;
			color:#ddd5bf;
			cursor:pointer;
		    -moz-border-radius: 4px;
		    -webkit-border-radius: 4px;
		    border-radius: 4px;
		}
		.qel0 {
			dispaly:none;
			position:absolute;
			z-index:100000;
			border:4px solid #f5cc50;
			border-top-left-radius: 4px;
			border-top-right-radius: 4px;
			border-bottom-right-radius: 4px;
			border-bottom-left-radius: 4px;
		}
</style>
</head>

<body onLoad="bodyLoaded();">
<!--div style="display:none" class="qel0" id="qel0"></div-->
<style>
/* цвета команд */
.CSSteam0	{ font-weight: bold; cursor:pointer; }
.CSSteam1	{ font-weight: bold; color: #6666CC; cursor:pointer; }
.CSSteam2	{ font-weight: bold; color: #B06A00; cursor:pointer; }
.CSSteam3 	{ font-weight: bold; color: #269088; cursor:pointer; }
.CSSteam4 	{ font-weight: bold; color: #A0AF20; cursor:pointer; }
.CSSteam5 	{ font-weight: bold; color: #0F79D3; cursor:pointer; }
.CSSteam6 	{ font-weight: bold; color: #D85E23; cursor:pointer; }
.CSSteam7 	{ font-weight: bold; color: #5C832F; cursor:pointer; }
.CSSteam8 	{ font-weight: bold; color: #842B61; cursor:pointer; }
.CSSteam9 	{ font-weight: bold; color: navy; cursor:pointer; }
.CSSvs 		{ font-weight: bold; }
.buttons:hover { background-color:#EFEFEF; }
.buttons:active { color:#777777; }
.buttons { background-color:#E9E9E9; }
.menutop2{color:#003366;} .menutop2:hover{
	color:#446B93;
}
.klan { font-weight:bold; color: green; background-color: #99FFCC;}
.union { font-weight:bold; color: blue; background-color: #bdedf3;}
.aliance { font-weight:bold; color: blue; background-color: #bdedf3;}
.redColor {
	color: #FF0000;
	font-weight: bold;
}
.borderWhite {
	border: 1px solid #f2f0f0;
}
.date21	{
	font-family: Courier;
	font-size: 8pt;
	text-decoration:underline;
	font-weight:normal;
	color: #007000;
	background-color: #00FFAA
}


.zoneCh_no {
	float:left;
	overflow:hidden;
	height: 18px;
	width: 18px;
}

.inpBtl {
	color: #000000;
	text-decoration: none;
	background-color: #ECE9D8;
	border: 1px solid #000000;    
}

.zoneCh_yes {
	float:left;
	overflow:hidden;
	height: 18px;
	width: 18px;
	background-color: #A9AFB1;
}
	
body {
	background-color: #e8e8e8;
}
.st1222 {
	font-size: 18px;
	color: #990000;
	font-weight: bold;
}
.crop {
	float:left;
	overflow:hidden;
	height: 18px;
	width: 18px;
}

.radio_off {
    margin-left:0px;
}

.radio_on {
    margin-left:-18px;
}

.battle_hod_style {
    border-bottom-width: 1px;
    border-bottom-style: solid;
    border-bottom-color: #AEAEAE;
}
.zbtn1l{	width:9px;	height:18px;	background: url(//testcombats.ru/tab.png) 0px 0px repeat-x;}
.zbtn1r {	width:9px;	height:18px;	background: url(//testcombats.ru/tab.png) -18px 0px repeat-x;}
.zbtn1r2 {	width:9px;	height:18px;	background: url(//testcombats.ru/tab.png) 18px 0px repeat-x;}
.zbtn2l{	width:9px;	height:18px;	background: url(//testcombats.ru/tab.png) -36px 0px repeat-x;}
.zbtn2r {	width:9px;	height:18px;	background: url(//testcombats.ru/tab.png) -54px 0px repeat-x;}
.zbtn2r2 {	width:9px;	height:18px;	background: url(//testcombats.ru/tab.png) -90px 0px repeat-x;}
.zbtn2r3 {	width:9px;	height:18px;	background: url(//testcombats.ru/tab.png) 54px 0px repeat-x;}
.zbtn1c{	background-color: #808080;	border-top-width: 1px;	border-bottom-width: 1px;	border-top-style: solid;	border-bottom-style: solid;	border-top-color: #000000;	border-bottom-color: #000000;	color: #FFFFFF;	cursor:default;	padding-left:5px;	padding-right:5px;	FONT-FAMILY: Verdana, Arial, Helvetica, Tahoma, sans-serif;}
.zbtn2c{
	background-color: #D5D2C9;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #000000;
	color: #000000;
	cursor:default;
	padding-left:5px;
	padding-right:5px;
	FONT-FAMILY: Verdana, Arial, Helvetica, Tahoma, sans-serif;
	font-weight: bold;
}
</style>
<!--script>
if(window.top !== window.self)
{
	document.write = "";
	window.top.location = window.self.location;
	setTimeout(function(){ document.body.innerHTML='Ошибка доступа.'; },500);
	window.self.onload=function(evt){
	document.body.innerHTML='Ошибка доступа.';};
}
function cc(el) {
	$(window).resize(function(){
		$(el).css({
				position:'absolute',
				left: ($(document).width() - $(el).outerWidth())/2,
				top: ($(document).height() - $(el).outerHeight())/2
		});
	});		
	$(window).resize();
}
</script-->
<? 
	if($u->info['bithday'] == '01.01.1800') {
?>
<!--script>
function startRegistration() {
	//if( goodread >= 9 ) {
		$.post( 'reg.php' , {
			'ajax_reg':true,
			'reg_login':$('#reg_login').val(),
			'reg_mail':$('#reg_mail').val(),
			'reg_dd':$('#reg_dd').val(),
			'reg_mm':$('#reg_mm').val(),
			'reg_yy':$('#reg_yy').val(),
			'reg_sex':$('#reg_sex').val(),
			'reg_pass':$('#reg_pass').val(),
			'reg_pass2':$('#reg_pass2').val(),
			'mail_post':$('#mail_post').attr('checked')
		} , function(data) { 
			$('#errorreg').html( data );
		});
	/*}else{
		alert('Ознакомьтесь с "Первыми шагами новичка" справа! \n Эта информация будет полезна Вам! \n Вы прочитали '+goodread+' из 9 страниц!');
	}*/
}
</script-->
<style>
.proza {
	filter:progid:DXImageTransform.Microsoft.Alpha(opacity=87); /* IE 5.5+*/
	-moz-opacity: 0.87; /* Mozilla 1.6 и ниже */
	-khtml-opacity: 0.87; /* Konqueror 3.1, Safari 1.1 */
	opacity: 0.87; /* CSS3 - Mozilla 1.7b +, Firefox 0.9 +, Safari 1.2+, Opera 9+ */
}
.nobtn12 {
	border:0;
	bottom:80px;
	left:225px;
	position:absolute;
}
.nobtn12:active {
	bottom:79px;
}
.inpreg1 {
	padding:2px;
	font-size:14px;
	color:#003144;
	background-color:#f6f4ec;
	border:1px solid #d1cdb8;
	width:178px;
}
.inpreg2 {
	font-size:12px;
	color:#003144;
	background-color:#f6f4ec;
	border:1px solid #d1cdb8;
}
#errorreg {
	position:absolute;
	width:680px;
	top:0;
	left:0;
	text-align:center;
	color:red;
	font-weight:bold;
}
</style>
<script>
	cc('#regblock');
</script>
<? }elseif($u->info['active']!='' && $u->info['mail']=='No E-mail') {
		if($error!='') {
			echo '<script>alert("'.$error.'");</script>';
		}	
?>
<!-- ACTIVE -->
<?
}
?>
<script>
var lasts = [-1,-1];
function myexpLineTop27(e1,e2) {
		$('#exp23mkrtkm').attr('title',"Опыт персонажа"+"\n"+e1+" / "+e2);
		$('#exp23mkrtkm').html(Math.ceil(e1/e2*100)+'%!');		
		if( Math.ceil(e1/e2*100) < 1 ) {
			$('#myexplin233').attr('width','1%');
		}else{
			if( lasts[1] < e2 ) {
				$('#myexplin233').css('width','1%');
			}
			if( lasts[0] != e1 || lasts[1] != e2 ) {
				$('#myexplin233').animate({'width':Math.ceil(e1/e2*100)+'%'},3000);
			}
		}
		lasts[0] = e1;
		lasts[1] = e2;
}
</script>
<script>
var smlk1 = 0;
function smiles1load() {
	if( smlk1 == 0 ) {
		$('#btnsmlrz').html('<small>&nbsp; Общие смайлики &nbsp;</small>');
		smlk1 = 1;
		$('#smilesDiv').hide();
		$('#smilesDiv2').show();
		$('#smilesDiv3').hide();
	}else{
		$('#btnsmlrz').html('<small>&nbsp; Личные смайлики &nbsp;</small>');
		smlk1 = 0;
		$('#smilesDiv').show();
		$('#smilesDiv2').hide();
		$('#smilesDiv3').hide();
	}
}
</script>
<style>
#qsst {
	position:absolute;
	z-index:10000000;
	cursor:default;
	display:none;
}
#onbon {
	position:absolute;
	z-index:100;
	cursor:default;
	display:none;
	bottom:30px;
	left:18px;
}
#mini_qsst {
	position:absolute;
	z-index:100;
	cursor:default;
	display:none;
	bottom:10px;
	right:18px;
}
</style>

<style>
.overlay2 {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: visible;
  opacity: 1;
  z-index:2000
}
.overlay2:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 50px auto;
  padding: 20px;
  background: #fff;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup .close {
  position: absolute;
  top: 5px;
  right: 5px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #ff0000;
}
.popup .content {
  padding-top: 10px;
}

@media screen and (max-width: 900px){
  .popup{
    width: 70%;
  }
}
</style>
<?
if($u->info['fnq']==1)
{
	$new_info = mysql_fetch_array(mysql_query('SELECT `name`, `info` FROM `quests` WHERE `id` = "1" LIMIT 1'));
	if($new_info['info']!='')
	{
		echo '<div id="popup2" class="overlay2">
			<div class="popup">
				<a onclick="CloseInfo();" class="close" href="javascript:void(0);">&times;</a>
				<div class="content">
					<div id="page-wrapper" style="text-align: left;"><h3>'.$new_info['name'].'</h3>'.nl2br($new_info['info']).'
					<p align="center"><input onclick="CloseInfo();" value="Ок" type="button"></p></div>
				</div>
			</div>
		</div>';
		$key = md5($u->info['id'].$c['skey']);
	}
?>
	<script>
	function CloseInfo()
	{
	    $.ajax({
			url: "do_quest.php",
			type: "POST",
	        data: "id=1&uid=<?=$u->info['id'];?>&key=<?=$key;?>",
			success: function(data)
			{
	            $( "#popup2" ).hide();
			}
		});

	}
	</script>
<? }?>
<div id="qsst"></div>
<div id="ttl" class="ttl_css" style="display:none;z-index:1111;" /></div>
<div id="nfml" style="display:none;position:absolute;" /></div>
<div id="persmenu" style="display:none;z-index:1110;" /></div>
<div id="windows" style="position:absolute;z-index:1101;"></div>
<div id="wupbox" onmouseup="win.WstopDrag()" onmousemove="win.WmoveDrag(event)" onselectstart="return false"></div>
<div id="chconfig">
<center></center>
<br>
</div>
<!-- <div id="counters"></div> -->
<!-- ресайзы -->
<div id="actionDiv" style="position:absolute;">
</div>
<div id="reline1" onselectstart="return false">
	<img width="9" height="4" style="float:left; display:block; position:absolute; background-image:url(//<?=$c['img']?>/i/lite/_top_24.gif);">
	<img width="9" height="4" style="float:right; display:block; background-image:url(//<?=$c['img']?>/i/lite/_top_28.gif);">
</div>
<!-- ресайзы -->
<div id="upbox" onselectstart="return false"></div>
    <div style="position:absolute; top:0; left:0; height:37px; width:100%;" onselectstart="return false">
    <div style="display:block;position:absolute; top: 5px;left: 40%; margin-left: -155px;">
</div>
<div style="background: url(//img.testcombats.ru/i/lite/<?=$u->info['city']?>/top_lite_cap_11.gif) repeat-x bottom; ">
     <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: url(//img.testcombats.ru/i/lite/<?=$u->info['city']?>/top_lite_cap_03.gif) repeat-x top; ">
        <tr>
          <td align="left"><img src="//img.testcombats.ru/i/lite/<?=$u->info['city']?>/top_lite_cap_01.gif" height="14" class="db" /></td>
          <td align="right" class="main_text" style="position: relative"><table cellspacing="0" cellpadding="0" border="0" width="565">
            <tr valign="bottom" align="center">
              <td width="31" height="14"><img class="db" height="14" src="//img.testcombats.ru/i/lite/mennu112_06_lite.gif" width="31" /></td>
              <td align="center"><table height="14" cellspacing="0" cellpadding="0" width="100%" background="//img.testcombats.ru/i/lite/mennu112_06.gif" border="0">
            <tr align="middle">
                  <td id="el1" class="main_text" onClick="this.style.backgroundColor='#404040'; this.style.color='#FFFFFF'; showtable('1');" align="center">Знания</td>
                  <td width="1"><img class="db" height="11" src="//img.testcombats.ru/i/lite/mennu112_09.gif" width="1" /></td>
                  <td id="el2" class="main_text" onClick="this.style.backgroundColor='#404040'; this.style.color='#FFFFFF'; showtable('2');" align="center">Общение</td>
                  <td width="1"><img class="db" height="11" src="//img.testcombats.ru/i/lite/mennu112_09.gif" width="1" /></td>
                  <td id="el3" class="main_text" onClick="this.style.backgroundColor='#404040'; this.style.color='#FFFFFF'; showtable('3');" align="center">Безопасность</td>
                  <td width="1"><img class="db" height="11" src="//img.testcombats.ru/i/lite/mennu112_09.gif" width="1" /></td>
                  <td id="el4" class="main_text" onClick="this.style.backgroundColor='#404040'; this.style.color='#FFFFFF'; showtable('4');" style="background:#404040; color:#FFFFFF;" align="center">Персонаж</td>
                  <td width="1"><img class="db" height="11" src="//img.testcombats.ru/i/lite/mennu112_09.gif" width="1" /></td>
                  <td id="el5" class="main_text" onClick="if(confirm('Выйти из игры?')){ top.location = '/battle?exit&rnd=<?=$code?>'; }"  align="center">Выход&nbsp;</td>
                </tr>
              </table></td>
              <td width="38"><img class="db" height="14" src="//img.testcombats.ru/i/lite/mennu112_04_lite.gif" width="37" /></td>
            </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td align="left"><img style="display:block; float:left;" src="//img.testcombats.ru/i/lite/top_lite_cap_07.gif" width="15" height="17" /><img src="//img.testcombats.ru/i/lite/<?=$u->info['city']?>/top_lite_cap_08.gif" width="158" height="17" class="db" /></td>
          <td align="right">
          <table cellspacing="0" cellpadding="0" width="565" style="background-image:url(//img.testcombats.ru/i/lite/top_lite_cap_15.gif);" border="0">
                  <tr>
                    <td width="20"><img class="db" src="//img.testcombats.ru/i/lite/top_lite_13.gif" width="20" height="17" /></td>
                    <td align="right" valign="top" background="//img.testcombats.ru/i/lite/top_lite_low_15.gif" style="font-size:10px;">
                        <span style="display:none;" id="menu1"><a href="//testcombats.ru/encicl/1.php" target="_blank" class="menutop">&nbsp;Законы&nbsp;</a> | <a href="//testcombats.ru/encicl/2.php" target="_blank" class="menutop">&nbsp;Соглашения&nbsp;</a> | <a href="//testcombats.ru/exp.php" target="_blank" class="menutop">&nbsp;Таблица опыта&nbsp;</a> | <a href="//testcombats.ru/bonus_stats.php" target="_blank" class="menutop">&nbsp;Бонусы параметров&nbsp;</a> |&nbsp;<a href="/item/" target="_blank" class="menutop">&nbsp;Библиотека&nbsp;</a></span>
                        <span style="display:none;" id="menu2"><a onClick="top.telegraf(); return false" href="javascript:void(0)" target="_blank" class="menutop">&nbsp;Телеграммы&nbsp;</a> | <a href="/news/" target="_blank" class="menutop">&nbsp;Новости&nbsp;</a> | <a href="/forum" target="_blank" class="menutop">&nbsp;Форум&nbsp;</a> | <a href="/rating" target="_blank" class="menutop">&nbsp;Рейтинг&nbsp;</a> | <a href="#" target="_blank" class="menutop">&nbsp;Рейтинг кланов&nbsp;</a>&nbsp;</span>
                        <span style="display:none;" id="menu3"><a href="main.php?act_sec=1" target="main" class="menutop">&nbsp;Отчеты по безопасности&nbsp;</a> | <a href="/main.php?anketa=1" target="main" class="menutop">&nbsp;Анкета&nbsp;</a>&nbsp;| <a href="main.php?security&rnd=<?=$c[9]?>" target="main" class="menutop">&nbsp;Смена пароля&nbsp;</a>&nbsp;</span>
                        <span style="display:block;" id="menu4"><a href="/main.php?referals=1&rn=<?=$c[9]?>" target="main" class="menutop"><font style="color:darkgreen">Рефералка</font></a> | <a href="/main.php?inv=1&rn=<?=$c[9]?>" target="main" class="menutop">&nbsp;Инвентарь&nbsp;</a> | <a href="/main.php?skills=1&side=5" target="main" class="menutop">&nbsp;Умения&nbsp;</a> | <a href="/main.php?zayvka=1" target="main" class="menutop">&nbsp;Поединки&nbsp;</a> | <a href="/main.php?act_trf=1" target="main" class="menutop">&nbsp;Отчеты о переводах&nbsp;</a></span>
                    </td>
                    <td width="22"><img class="db" src="//img.testcombats.ru/i/lite/top_lite_18.gif" width="22" height="17" /></td>
                  </tr>             
                </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
    </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15" height="6"><img class="db" src="//img.testcombats.ru/i/lite/_lit_20.gif" width="15" height="6" /></td>
        <td background="//img.testcombats.ru/i/lite/_top_20s.gif"></td>
        <td width="24" height="6"><img class="db" src="//img.testcombats.ru/i/lite/_lit_27.gif" width="24" height="6" /></td>
      </tr>
    </table>
    <!-- -->
</div>
<table id="globalMain" width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="31" width="9" bgcolor="#D6D6D6"></td>
    <td height="31" bgcolor="#D6D6D6">&nbsp;</td>
    <td height="31" width="12" bgcolor="#D6D6D6"></td>
  </tr>
  <tr>
    <td bgcolor="#D6D6D6" background="//img.testcombats.ru/i/lite/_top_24.gif"></td>
    <td valign="top" bgcolor="#e2e0e0" id="main_td">
    <div id="touchmain" style="margin-top:3px;">
    	<iframe id="main" name="main" src="main.php" frameborder="0" style="display:block;padding-top:0px;padding:0;margin:0;width:100%;border:0;" scrolling="auto"></iframe>
    </div>
    </td>
    <td bgcolor="#D6D6D6" background="//img.testcombats.ru/i/lite/_top_28.gif"></td>
  </tr>
  <tr>
    <td bgcolor="#D6D6D6" background="//img.testcombats.ru/i/lite/_top_24.gif"></td>
    <td id="chat" valign="top" height="35%" bgcolor="#eeeeee">
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:1px solid #CCCCCC">
      <tr>
        <td valign="top" id="chat_block" style="position:relative;border-top:1px solid #808080">
            <!--<div id="mini_qsst" onClick="top.qn_slk()" style="cursor:pointer"></div>-->
            <div id="onbon"></div>
            <div id="chat_menus" unselectable="on" onselectstart="return false;" style="display:;position:absolute; right:0px; top:3px; padding-right:20px; height:18px; text-align:right; white-space:nowrap;">
              	<!-- -->

				<table border="0" style="margin-top:-3px;" align="right" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <div id="chat_menu" style="text-align:right; white-space:nowrap;">
                        </div>
                      </td>
                      <td style="display:none;" id="scroll_none" width="3"></td>
                    </tr>
                </table>
                <!-- -->
              </div>

        <div id="ttSmiles" onselectstart="return false" style="display:none;z-index:2000;" />
        	<div id="smilesDiv">Смайлы</div>
            <div id="smilesDiv3" style="display:none">
            
            </div>
            <div align="center" style="padding-left:5px; padding-right:5px;">
            <button style="padding:0; margin:0; margin-top:5px;" onClick="chat.lookSmiles()"><small>&nbsp; Закрыть &nbsp;</small></button>
            </div>
        </div>
          <div id="chat_list" style="cursor:default;">
                <div id="canals">
				<div id="canal5" style="display:block;">
				<div style="padding:5px;">
                <font color="red" style="font-size: 9pt;"><b>НБК:</b> Приветствуем тебя!</font><br>
				<font color="red" style="font-size: 9pt;"><b>НБК:</b> Желаем приятного общения, великих побед и незабываемых впечатлений в нашей с вами игре!</font><br>
				<font color="red" style="font-size: 9pt;"><b>НБК:</b> На все ваши вопросы ответят модераторы <img height="15" src="//img.testcombats.ru/i/align/align1.99.gif"><b>Паладины</b> и <img height="15" src="//img.testcombats.ru/i/align/align3.99.gif"><b>Тарманы</b> и вы так же можете ознакомиться с <a href="//testcombats.ru/forum?read=396" target="_blank">гайдом для новичка.</a></font>
				</div>
				</div>
				<div id="canal6" style="display: none;">
                 <div style="padding:5px;">
                        	<font color="red" style="font-size: 9pt;"><b>НБК:</b> Поиск услуг <b>лечения / найма / ловца</b> , а также сбор в <b>БС</b> разрешены 1 раз в 5 минут.</font>
                       </div>                    
                    </div>
					<div id="canal3" style="display:none;"><div id="battle_logg"></div></div>
				</div>
          </div>        
        </td>
        <td width="280" valign="top" style="border-left:3px solid #CCCCCC;" id="online">
        <div id="online_list" style="cursor:default;">
 <!-- ------------------------------------------------------------------------------------------------------- --> 
    <div align="center" style="margin-top:5px;">
		<div style="padding:3px 3px;" align="left">
		  <table>
<tbody><tr nowrap="">
<td><script type="text/javascript">MRP.insert({'url':'//air.radiorecord.ru:8101/rr_320','lang':'ru','codec':'mp3','volume':35,'autoplay':false,'jsevents':true,'buffering':0,'title':'Радио OurCombats','welcome':'Танцуют Все ^_-','wmode':'transparent','skin':'repvku-100','width':100,'height':25});</script></td>
<td>
	<input style="font-size:13px;border-radius: 50px;" size="15" type="button" value="Обновить" onClick="chat.reflesh()">
</td>
</tr>
</tbody>
</table>
	</div>
        </div>
          <font class="db" style="padding:0px 0 8px 0;font-size: 10pt; color:#8f0000;"><b id="roomName"></b></font>
          <div id="onlist"></div>
          <div style="padding:5px;margin-top:5px;font-size: 11px;">
		      <div><label><input type="checkbox" value="1" <? if( $u->info['level'] < 7 ) { ?>checked<? } ?> id="autoRefOnline">Обновлять автомат.</label></div>
              <? if( $u->info['admin'] == 1) { ?>
              <div><label><input name="chcf10" type="checkbox" id="chcf10" <? if( $u->info['level'] < 8 ) { ?>checked<? } ?> value="0">Показать всех игроков</label></div>
          	  <? } ?>
          </div>
        </div>
      </td>
      </tr>
    </table>
    </td>
    <td bgcolor="#D6D6D6" background="//img.testcombats.ru/i/lite/_top_28.gif"></td>
  </tr>

  <tr>
    <td height="30" valign="bottom"><img class="db" src="//img.testcombats.ru/i/lite/bkf_l_r1_02.gif" width="9" height="30"></td>
    <td height="30" bgcolor="#E9E9E9" background="//img.testcombats.ru/i/buttons/chat_bg.gif">
	<table width="100%" height="26" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="display:none;" width="100" align="center" id="trader">
		<div id="trader" style="border:1px solid #CCCCCC;padding:2px; margin-left:-2px; width:90%;" class="klan">
		<small id="moneyGM"><b>Торговый чат</b></small></div></td>
        <td><input type="hidden" name="trader" id="trader_val" value="0">
		<input onmouseup="top.chat.inObj=undefined;" type="text" name="textmsg" id="textmsg" maxlength="240" onKeyPress="top.testKey(event)" style="width:100%;font-size:9pt;margin-bottom:2px;" /></td>
        <td width="6">&nbsp;</td>
        <td width="30">
		<img onClick="chat.subSend();" src="//img.testcombats.ru/1x1.gif" onMouseOver="top.hi(this,'<b>Отправить в Чат</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" class="db cp chatBtn2_1"></td>
        <td width="30"><img onClick="chat.clear();" class="db cp"  onMouseOver="top.hi(this,'<b>Очистить строку ввода</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/chatBtn3.gif"></td>
        <td width="30"><img onClick="chat.filterMsg();" id="chbtn1"  onMouseOver="top.hi(this,'<b>Скрыть общий чат</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/1x1.gif" class="db cp chatBtn1_1"></td>
        <td width="30"><img onClick="chat.systemMsg();" id="chbtn4"  onMouseOver="top.hi(this,'<b>Показывать в чате системные сообщения</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/1x1.gif" class="db cp chatBtn4_<? if(isset($_COOKIE['citySys']) && $_COOKIE['citySys']==1){ echo 2; }else{ echo 1; } ?>"></td>
        <td width="30"><img id="chbtn6" onClick="chat.translitChat()"  onMouseOver="top.hi(this,'<b>Преобразовывать транслит в русский текст</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/1x1.gif" class="db cp chatBtn6_1"></td>
        <td width="30"><img id="chbtn7" onClick="chat.soundChat()" src="//img.testcombats.ru/1x1.gif" onMouseOver="top.hi(this,'<b>Звуки</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" class="db cp chatBtn7_1"></td>
        <td width="10">&nbsp;</td>
        <td width="30"><img id="chbtn8" class="db cp chatBtn8_1" onClick="chat.lookSmiles()" onMouseOver="top.hi(this,'<b>Смайлики</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/1x1.gif"></td>
        <td width="16" bgcolor="#BAB7B3"><img src="//img.testcombats.ru/i/buttons/chat_explode.gif" width="16" height="30" class="db" /></td>
        <td width="30"><img onclick="top.getUrl('main','main.php?inv=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Инвентарь</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/chatBtn13.gif"></td>
		<?   if($u->info['level']>4){ ?>
        <td width="30"><img onClick="top.getUrl('main','main.php?transfer=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Передачи</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/chatBtn16.gif"></td> 
         <? } if($u->info['level']>=0){ ?>
        <td width="30"><img onClick="top.getUrl('main','main.php?alh=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Алхимики Онлайн</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/chatBtn9.gif"></td>
        <? } if($u->info['align']==50 || $u->info['align2']==50 || $u->info['admin'] == 1) {?>
		<td width="30"><img onClick="top.getUrl('main','main.php?alhp=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Панель Алхимика</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/chatBtn20.gif"></td>
		<?} if($u->info['inTurnirnew']) $realUser = mysql_fetch_array(mysql_query('SELECT `align` FROM `users` WHERE `inUser` = "'.$u->info['id'].'" LIMIT 1'));
		if(($u->info['align']>=1.1 && $u->info['align']<2) || ($realUser['align']>=1.1 && $realUser['align']<2)){ ?>
		<td width="30"><img onClick="top.getUrl('main','main.php?clan_moders=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Клан Паладинов</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/a___ang15.gif"></td>
        <td width="30"><img onClick="top.getUrl('main','main.php?light=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Панель Паладина</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/a___ang17.gif"></td>
        <? } if(($u->info['align']>=3.01 && $u->info['align']<4) || ($realUser['align']>=3.01 && $realUser['align']<4)){ ?>
		<td width="30"><img onClick="top.getUrl('main','main.php?clan_moders=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Клан Тарманов</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/a___ang12.gif"></td>
        <td width="30"><img onClick="top.getUrl('main','main.php?dark=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Панель Тармана</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/a___ang28.gif"></td>       
        <? } if($u->info['level']>= 0){ ?>
        <td width="30"><img onClick="top.getUrl('main','main.php?friends=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Друзья</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/chatBtn12.gif"></td>
		<?}  if(($u->info['align']>=1 && $u->info['align']<2)){ ?>
		<td width="30"><img onClick="top.getUrl('main','main.php?1_panel=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Панель Cвета</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/a___ang26.gif"></td>
		<?}  if(($u->info['align']>=3 && $u->info['align']<4)){ ?>
		<td width="30"><img onClick="top.getUrl('main','main.php?3_panel=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Панель Темного</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/a___ang25.gif"></td>
		<?}  if($u->info['align']==7) { ?>
		<td width="30"><img onClick="top.getUrl('main','main.php?7_panel=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Панель Нейтралитета</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/a___ang24.gif"></td>
		<? } ?>
        <!--<td width="30"><img onClick="top.getUrl('main','main.php?bukmeker=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Стол заказов</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/2312.gif"></td>-->
        
        <!--td width="30"><img onClick="top.getUrl('main','main.php?notepad=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Блокнот</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/b_notepad.gif"></td-->
        <? if($u->info['clan']>0){ ?>
        <td width="30"><img onClick="top.getUrl('main','main.php?clan=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Клан</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/chatBtn14.gif"></td>
        <? } if($u->info['admin']>0){ ?>
       <td width="30"><img onClick="top.getUrl('main','main.php?admin=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Админка</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/a___ang14.gif"></td>
  		<? } ?>
		<!--<td width="30"><img onClick="top.getUrl('main','main.php?achiev=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Достижения персонажа</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/otheralignt.png"></td>-->
		 <!--<td width="30"><img onClick="top.getUrl('main','main.php?buyvip=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Премиум</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//<?=$c['img']?>/blago/blago_5.gif" title="<b>Премиум Панель</b>',event,3,0,1,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();">-->
		<? if($u->info['vip']>0){ ?>
            <td width="30"><img onClick="top.getUrl('main','main.php?vip=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>VIP</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//<?=$c['img']?>/i/buttons/chatBtn17.gif" title="VIP Панель Игрока" onMouseOut="top.hic();" onMouseDown="top.hic();">
		<? } ?>
		<!--<td width="30"><img onClick="top.getUrl('main','main.php?bagreport=1&rnd='+c.rnd);" class="db cp" onMouseOver="top.hi(this,'<b>Тех Поддержка</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/chatBtn115.gif"></td>-->
        <td width="30"><img onClick="if(confirm('Выйти из игры?')){ top.location = '/battle?exit&rnd=<?=$code?>'; }" class="db cp" onMouseOver="top.hi(this,'<b>Выход</b>',event,1,1,2,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//img.testcombats.ru/i/buttons/chatBtn11.gif"></td>
		<td width="70">
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="//download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="70" height="25">
           		<param name="movie" value="flash/clock.swf?hours=<?=date("H")?>&amp;minutes=<?=date("i")?>&amp;sec=<?=date("s")?>">
            	<param name="quality" value="high">
            	<embed src="flash/clock.swf?hours=<?=date("H")?>&minutes=<?=date("i")?>&sec=<?=date("s")?>" quality="high" pluginspage="//www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="70" height="25"></embed>
            </object>
        </td>
      </tr>
    </table>
    </td>
    <td height="30" align="right" bgcolor="#D6D6D6"><img class="db" src="//img.testcombats.ru/i/lite/bkf_l_r1_06.gif" width="9" height="30"></td>
  </tr>
  <tr>
    <td height="5" bgcolor="#D6D6D6" style="background:url(//img.testcombats.ru/sand_mid_31.png);"></td>
    <td height="5" bgcolor="#D6D6D6" style="background:url(//img.testcombats.ru/sand_mid_31.png);"><!-- iFrames zone --></td>
    <td height="5" bgcolor="#D6D6D6" style="background:url(//img.testcombats.ru/sand_mid_31.png);"></td>
  </tr>
</table>
<?

if($u->info['active']!='' && $u->info['mail']!='No E-mail')
{
	$yes = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "user_active_good" LIMIT 1',1);
	$yes2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "user_active_send" LIMIT 1',1);

	if($u->info['login'] != 'admin') mysql_query('UPDATE `stats` SET `active` = "" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
}

//Уведомления о почте
if(isset($u->info['id']))
{
	$post_item = mysql_fetch_array(mysql_query('SELECT * FROM `post` WHERE `uid` = "'.$u->info['id'].'" AND `sender_id` > 0
	AND `money` = 0 AND `finish` = 0 AND (`time`+'.($u->info['id'] ? 180 : 1800).') <'.time().' AND `time`>'.(time()-86400 * 3)));

	$post_money = mysql_fetch_array(mysql_query('SELECT * FROM `post` WHERE `uid` = "'.$u->info['id'].'" AND `sender_id` < 0
	AND `money` > 0 AND `finish` = 0 AND (`time`+'.($u->info['id'] ? 180 : 1800).') <'.time().' AND `time`>'.(time()-86400 * 3)));
}
echo '<div id="post1" style="position:absolute; top:13px; left:180px;">';
$style1 = (isset($post_item['id']) ? '' : ' style="display:none;"');
?>
<img<?=$style1;?> width=24 height=15 onMouseOver="top.hi(this,'<b>Получена почта</b>',event,0,0,0,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//<?=$c['img'];?>/post-mail1.gif">
<?
echo '</div>';

echo '<div id="post2" style="position:absolute; top:13px; left:160px;">';
$style2 = (isset($post_money['id']) ? '' : ' style="display:none;"');
?>
	<img<?=$style2;?> width=24 height=15 onMouseOver="top.hi(this,'<b>Получены кредиты</b>',event,0,0,0,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="//<?=$c['img'];?>/post-mail2.gif">
<?
echo '</div>';
?>
<script>
startEngine();
chat.testTimer(false);
</script>
</body>
</html>
<?
unset($db);
?>