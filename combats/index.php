<?php
	include_once('_incl_data/__config.php');
	define('GAME', true);
	include_once('_incl_data/class/__db_connect.php');
?>

<html>
<head>
<script LANGUAGE='JavaScript'> 
//document.ondragstart = test;
//запрет на перетаскивание
//запрет на выделение элементов страницы
//document.oncontextmenu = test;
//запрет на выведение контекстного меню
//function test() {
//return false
//}
</SCRIPT>
<HTML>
	<HEAD>
  <meta http-equiv="Content-type"
 content="text/html; charset=windows-1251">
  <meta http-equiv="Cache-Control"
 content="no-cache">
  
  <meta http-equiv="PRAGMA"
 content="NO-CACHE">
  <meta http-equiv="Expires"
 content="0">
<meta name="author" content="testcombats.ru"> 
<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<meta name="Keywords" content="игра, играть, игрушки, онлайн,online, интернет, internet, RPG, fantasy, фэнтези, меч, топор, магия, кулак, удар, блок, атака, защита, Бойцовский Клуб, бой, битва, отдых, обучение, развлечение, виртуальная реальность, рыцарь, маг, знакомства, чат, лучший, форум, свет, тьма, bk, games, клан, банк, магазин, клан">
		<meta name="Description" content="Отличная RPG онлайн игра посвященная боям и магии. Тысячи жизней, миллионы смертей, два бога, сотни битв между Светом и Тьмой.">
		<TITLE>Наш Бойцовский Клуб - Тысячи жизней, миллионы смертей, сотни битв между Светом и Тьмой</TITLE>
		<STYLE type="text/css">
<!--
body {
	background-color: #000000;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background: url(//img.testcombats.ru/admin/zmk_all.jpg ) no-repeat;
    background-position: center center;
    background-color: #000;
    background-size: cover;
}
A:link {
	COLOR: #F9F7EA;
	TEXT-DECORATION: none;
	font-weight: normal;
}
A:visited {
	COLOR: #F9F7EA;
	TEXT-DECORATION: none;
	font-weight: normal;
}
A:active {
	COLOR: #77684D;
	TEXT-DECORATION: none;
	font-weight: normal;
}
A:hover {
	COLOR: #7E7765; TEXT-DECORATION: underline
}

.inup {	FONT-SIZE: 8pt;
	COLOR: #DFDDD3;
	FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
	BACKGROUND-COLOR: #151616;
	border: 1px double #817A63;
}
.style2 {color: #A7A495}

.btn {	FONT-SIZE: 7.5pt;
	COLOR: #DFDDD3;
	FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
	BACKGROUND-COLOR: #2B2B18;
	//background-color: #151616;
    border: 1px double #817A63;
	width: 95px;
	height: 21px;
	margin: 3px;
}
.btn:active {
    filter: alpha(opacity=37);
    opacity: 0.7;
}
.btn:hover {
    filter: alpha(opacity=70);
    opacity: 0.37;
}

.ourimg:active {
    filter: alpha(opacity=70);
    opacity: 0.7;
}
.ourimg:hover {
    filter: alpha(opacity=37);
    opacity: 0.37;
}

.btkey {
	display: block; text-align: center;
	PADDING-RIGHT: 1px; PADDING-LEFT: 1px;
	FONT-SIZE: 7.5pt; FONT-FAMILY: verdana,sans-serif,arial;
	width: 20;
	CURSOR: hand;
	border: 1px solid #D6D3CE;
	COLOR: #DFDDD3; BACKGROUND-COLOR: #2B2B18;
}

.message {
	FONT-SIZE: 7.5pt; FONT-FAMILY: verdana,sans-serif,arial;
	COLOR: white;
}

.menu {
	FONT-SIZE: 10pt; FONT-FAMILY: verdana;
	COLOR: white;
}
-->
.baner {
	width:468
	height:60
}
</STYLE>
</HEAD>
<BODY class="menu">
<SCRIPT>
////////////////////////
///////// Настройки
////////////////////////

// количество снежинок, которое будет на экране одновременно.
var snowmax=40

// Цвета для снежинок. Для каждой конкретной снежинки цвет выбирается случайно из этого массива.
var snowcolor=new Array("#b9dff5","#7fc7ff","#7fb1ff","#7fc7ff","#b9dff5")

// Шрифт для снежинок
var snowtype=new Array("Times")

// Символ (*) и есть снежинка, в место нее можно вставить любой другой символ.
var snowletter="&#10052;"

// Скорость движения снежинок (от 0.3 до 2)
var sinkspeed=0.4

// Максимальный размер для снежинок
var snowmaxsize=40

// Минимальный размер для снежинок
var snowminsize=10

// Зона для снежинок
// 1 для всей страницы, 2 в левой части страницы
// 3 в центральной части, 4 в правой части страницы
var snowingzone=1

////////////////////////
///////// Конец настроек
////////////////////////

var snow=new Array()
var marginbottom
var marginright
var timer
var i_snow=0
var x_mv=new Array();
var crds=new Array();
var lftrght=new Array();
var browserinfos=navigator.userAgent
var ie5=document.all&&document.getElementById&&!browserinfos.match(/Opera/)
var ns6=document.getElementById&&!document.all
var opera=browserinfos.match(/Opera/)
var browserok=ie5||ns6||opera

function randommaker(range) {
	rand=Math.floor(range*Math.random())
    return rand
}

function initsnow() {
	if (ie5 || opera) {
		marginbottom = document.documentElement.clientHeight+50
		marginright = document.body.clientWidth-15
	}
	else if (ns6) {
		marginbottom = document.documentElement.clientHeight+50
		marginright = window.innerWidth-15
	}
	var snowsizerange=snowmaxsize-snowminsize
	for (i=0;i<=snowmax;i++) {
		crds[i] = 0;
		lftrght[i] = Math.random()*15;
		x_mv[i] = 0.03 + Math.random()/10;
		snow[i]=document.getElementById("s"+i)
		snow[i].style.fontFamily=snowtype[randommaker(snowtype.length)]
		snow[i].size=randommaker(snowsizerange)+snowminsize
		snow[i].style.fontSize=snow[i].size+'px';
		snow[i].style.color=snowcolor[randommaker(snowcolor.length)]
		snow[i].style.zIndex=1000
		snow[i].sink=sinkspeed*snow[i].size/5
		if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
		if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
		if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
		if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
		snow[i].posy=randommaker(2*marginbottom-marginbottom-2*snow[i].size)
		snow[i].style.left=snow[i].posx+'px';
		snow[i].style.top=snow[i].posy+'px';
	}
	movesnow()
}

function movesnow() {
	for (i=0;i<=snowmax;i++) {
		crds[i] += x_mv[i];
		snow[i].posy+=snow[i].sink
		snow[i].style.left=snow[i].posx+lftrght[i]*Math.sin(crds[i])+'px';
		snow[i].style.top=snow[i].posy+'px';
		
		if (snow[i].posy>=marginbottom-2*snow[i].size || parseInt(snow[i].style.left)>(marginright-3*lftrght[i])){
			if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
			if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
			if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
			if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
			snow[i].posy=0
		}
	}
	var timer=setTimeout("movesnow()",50)
}

for (i=0;i<=snowmax;i++) {
	document.body.insertAdjacentHTML('beforeend', "<span id='s"+i+"' style='user-select:none;position:fixed;top:-"+snowmaxsize+"'>"+snowletter+"</span>")
}

if (browserok) {
	window.onload=initsnow	
}</SCRIPT>

<SCRIPT>
var now = new Date()
var day = now.getDate();
var mon = now.getMonth();
var swnd = window.location + "";
</SCRIPT>
		<TABLE width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" class="menu">
			<TR height="30%">
				<TD align="center"><TABLE width="100%" height="100%" border="0">
					<TR>
						<TD width="200" valign="bottom" style="padding-bottom: 10"><!--a href="/news" target="_blank"><img align="left" style="position: absolute; left: 35px; top:56px;" src="/i/mainpage/news.png" oncontextmenu="return false;" width="135" height="110" border="0"></a--></TD>
						<TD align="center" valign="center"><img class="ourimg" width="468" height="60" style="border:dotted 1px #fcfdfd26;" src="//testcombats.ru/images/vk_abk.gif" oncontextmenu="return false;">
						</TD>
						<TD width="200" align="right" valign="bottom" style="padding-bottom: 10; "></TD>
					</TR>
				</TABLE></TD>
			</TR>
			<TR height="205">
				<TD colspan="2" width="100%" align="center" scope="col"><SCRIPT>

// -=-=-=-=-=- BACKGROUND -=-=-=-=-=-

var k = 0;
if ((mon >= 2) && (mon <= 4)) { // Spring

		document.write('<TABLE src="/images/process1.png" width="380" height="194"  border="0" cellspacing="0" cellpadding="0" class="menu">');

} else if ((mon >= 5) && (mon <=7)) { // Summer

		document.write('<TABLE src="/images/process1.png" width="380" height="194"  border="0" cellspacing="0" cellpadding="0" class="menu">');

} else if ((mon >= 8) && (mon <= 10)) { // Autumn
	document.write('<TABLE src="/images/process1.png" width="380" height="194" cellpadding="0" class="menu">');
} else { // Winter
	document.write('<TABLE src="/images/process1.png" width="380" height="194"  border="0" cellspacing="0" cellpadding="0" class="menu">');
}
					</SCRIPT>
					<TR height="205" valign="top">
						<TD  width="195" align="right" valign="bottom" style="padding-bottom: 42; " ><SCRIPT>
 
if ((mon >= 2) && (mon <= 4)) {
	//document.write('<IMG src="/i/mainpage/runet_4.jpg" width="191" height="131" border="0" oncontextmenu="return false;">');
}
if ((mon >= 5) && (mon <= 7)) {
	//document.write('<IMG src="/i/mainpage/runet_4.jpg" width="191" height="131" border="0" oncontextmenu="return false;">');
} 

 
						</SCRIPT></A></TD>
						<TD align="center"><SCRIPT>
 
// -=-=-=-=-=- LOGO -=-=-=-=-=-
 
if ((mon >= 2) && (mon <= 4)) { // Spring
		document.write('<IMG src="/images/process1.png" width="380" height="194" border="0" usemap="#Map" oncontextmenu="return false;">');
} else if ((mon >= 5) && (mon <=7)) { // Summer
		document.write('<IMG src="/images/process1.png" width="380" height="194" border="0" usemap="#Map" oncontextmenu="return false;">');
} else if ((mon >= 8) && (mon <= 10)) { // Autumn
	document.write('<IMG src="/images/process1.png" width="380" height="194" border="0" usemap="#Map" oncontextmenu="return false;">');
} else { // Winter
	if ((mon >= 0) && (mon <= 1)) {
		document.write('<IMG src="/images/process1.png" width="380" height="194" border="0" usemap="#Map" oncontextmenu="return false;">');
	} else {
		document.write('<IMG src="/images/process1.png" width="380" height="194" border="0" usemap="#Map" oncontextmenu="return false;">');
	} 
}
</SCRIPT>
</TD>

<TD width="195" valign="bottom" style="padding-bottom: 42; padding-right: 5; " align="right"><SCRIPT>
 
/* if ((mon >= 1) && (mon <= 12)) {
	document.write('<IMG src="/i/mainpage/runet_5.jpg" width="150" height="131" border="0">');
} */
 
						</SCRIPT></A></TD>
					</TR>
				</TABLE></TD>
			</TR>
			<TR valign="top" height="50%">
				<TD colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0" class='menu'>
					<TR>
						<TD align="left" valign="bottom" noWrap style="padding-left:10; " width="25%">

<IMG height="75" src="/i/mainpage/18adult.png" oncontextmenu="return false;" width="175">
</TD>
						<TD align="center" width="50%" style="padding-left: 10; "><TABLE width="100%" border="0" class="menu">

<FORM action="/enter.php" method="post" name="F1">
							<TR>
								<TD align="center">
									<BR>
									<INPUT placeholder="Логин" class="inup" value="" name="login" style="width: 200px;height: 21px;margin: 3px; ">
								</TD>
							</TR>
							<TR>
								<TD align="center"><TABLE cellspacing="0" cellpadding="0" class="menu">
									<TR valign="bottom" >
										<TD><INPUT  placeholder="Пароль" style="width: 200px;height: 21px;" class="inup" type="password" value="" name="pass"></TD>
										
									</TR>
								</TABLE></TD>
							</TR>
							<TR>
								<TD height="21" align="center">
									<INPUT type="submit" class="btn" value=" Войти " onclick="this.blur(); ">
									<INPUT type="button" class="btn" value=" Регистрация " onclick="this.blur(); window.location='/register.php'; ">
								</TD>
							</TR>
							</TABLE></TD>
						<TD width="25%" align="right" style="padding-right: 10; " valign="bottom">
							<IMG height="75" src="/i/mainpage/change_warn.png" oncontextmenu="return false;" width="185">
						</TD>
					</TR>
					<TR>
					</TD>
					</TR>
					</FORM>
					<TR>
						<TD colspan=3 align="center" noWrap>
							<BR>
<A href="/news/" target="_blank">Новости Клуба</A>&nbsp; &nbsp;
<A href="/item/" target="_blank">Библиотека</A>&nbsp; &nbsp;
<A href="//testcombats.ru/encicl/1.php" target="_blank">Законы</A>&nbsp; &nbsp;
<A href="//testcombats.ru/encicl/2.php" target="_blank">Соглашения</A>&nbsp; &nbsp;
<a href="/forum">Форум</a>&nbsp; &nbsp;
<A href="/clan/allclans" target="_blank">Рейтинг кланов</A>&nbsp; &nbsp;
<A href="/rating" target="_blank">Рейтинг игроков</A>&nbsp; &nbsp;
<!--A href="№"><NOBR>Забыли пароль?</NOBR></A-->&nbsp; &nbsp;<br><br>
<p style="font-size:10.04pt;color: red;">Открытие Клуба с 13.11.2020 года.</p>
						</TD>
					</TR>
				</TABLE>
				<TABLE width="100%">
					<TR>
						<TD style="padding-left: 10; ">
						</TD>
						<TD align="right" style="padding-right: 10; " valign="top" width="30%">
							<TABLE cellpadding="0" cellspacing="0" class="menu">
								<TR>
									<TD align="right" valign="top" style="padding-bottom: 5; ">
										<BR>

									</TD>
								</TR>
								<TR valign="bottom">
									<TD align="right">
										<A href="mailto:co@testcombats.ru">Отдел развития и партнерства</A><br><br>
										<!--LiveInternet counter--><a href="//www.liveinternet.ru/click"
										target="_blank"><img id="licntC407" width="80" height="28" style="border:0" 
										title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня"
										src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAEALAAAAAABAAEAAAIBTAA7"
										alt=""/></a><script>(function(d,s){d.getElementById("licntC407").src=
										"//counter.yadro.ru/hit?t13.2;r"+escape(d.referrer)+
										((typeof(s)=="undefined")?"":";s"+s.width+"*"+s.height+"*"+
										(s.colorDepth?s.colorDepth:s.pixelDepth))+";u"+escape(d.URL)+
										";h"+escape(d.title.substring(0,150))+";"+Math.random()})
										(document,screen)</script><!--/LiveInternet--> <a href="https://rpgtop.su/26325" title="Рейтинг Ролевых Ресурсов - RPG TOP" target="_blank"><img src="//img.rpgtop.su/88x31x11x8.gif" alt="Рейтинг Ролевых Ресурсов - RPG TOP" width="88" height="31" border="0"></a>
									</TD>
								</TR>
							</TABLE>
						</TD>
					</TR>
				</TABLE></TD>
			</TR>
		</TABLE>
	</BODY>
</HTML>
