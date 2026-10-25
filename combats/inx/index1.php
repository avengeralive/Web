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
		<TITLE>Старый Бойцовский Клуб - Тысячи жизней, миллионы смертей, сотни битв между Светом и Тьмой</TITLE>
		<STYLE type="text/css">
<!--
body {
	background-color: #000000;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
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
	border: 1px double #817A63;
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
		</STYLE>

<!-- Put this script tag to the place, where the Share button will be -->
	</HEAD>
	<BODY class="menu">
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
						<TD width="200" valign="bottom" style="padding-bottom: 10">&nbsp;</TD>
						<TD align="center" valign="center">						
						</TD>
						<TD width="200" align="right" valign="bottom" style="padding-bottom: 10; ">&nbsp;</TD>
					</TR>
				</TABLE></TD>
			</TR>
			<TR height="205">
				<TD colspan="2" width="100%" align="center" scope="col"><SCRIPT>

// -=-=-=-=-=- BACKGROUND -=-=-=-=-=-

var k = 0;
if ((mon >= 2) && (mon <= 4)) { // Spring

		document.write('<TABLE width="100%"  border="0" cellspacing="0" cellpadding="0" class="menu" background="/i/mainpage/start_2011_spr_03.jpg" style="background-repeat: repeat-x">');

} else if ((mon >= 5) && (mon <=7)) { // Summer

		document.write('<TABLE width="100%"  border="0" cellspacing="0" cellpadding="0" class="menu" background="/i/mainpage/start_10sum1_03.jpg" style="background-repeat: repeat-x">');

} else if ((mon >= 8) && (mon <= 10)) { // Autumn
	document.write('<TABLE width="100%"  border="0" cellspacing="0" cellpadding="0" class="menu" background="/i/mainpage/start_10aut1_03.jpg" style="background-repeat: repeat-x">');
} else { // Winter
	document.write('<TABLE width="100%"  border="0" cellspacing="0" cellpadding="0" class="menu" background="/i/mainpage/start_2011_win_03.jpg" style="background-repeat: repeat-x">');
}

					</SCRIPT>
					<TR height="205" valign="top">
						<TD  width="195" align="right" valign="bottom" style="padding-bottom: 42; "><SCRIPT>
 
/* if ((mon >= 2) && (mon <= 4)) {
	document.write('<IMG src="/i/mainpage/runet_4.jpg" width="191" height="131" border="0">');
}
if ((mon >= 5) && (mon <= 7)) {
	document.write('<IMG src="/i/mainpage/runet_4.jpg" width="191" height="131" border="0">');
} */

 
						</SCRIPT></A></TD>
						<TD align="center"><SCRIPT>
 
// -=-=-=-=-=- LOGO -=-=-=-=-=-
 
if ((mon >= 2) && (mon <= 4)) { // Spring
		document.write('<IMG src="/i/mainpage/start_2011_spr_05.jpg" width="305" height="205" border="0" usemap="#Map">');
} else if ((mon >= 5) && (mon <=7)) { // Summer
		document.write('<IMG src="images/start_10sum1_05.jpg" width="428" height="205" border="0" usemap="#Map">');
} else if ((mon >= 8) && (mon <= 10)) { // Autumn
	document.write('<IMG src="/i/mainpage/astart_10aut1_05.jpg" width="428" height="205" border="0" usemap="#Map">');
} else { // Winter
	if ((mon >= 0) && (mon <= 1)) {
		document.write('<IMG src="/i/mainpage/start_2011_winng_05.jpg" width="428" height="205" border="0" usemap="#Map">');
	} else {
		document.write('<IMG src="/i/mainpage/start_2011_win_05.jpg" width="428" height="205" border="0" usemap="#Map">');
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

<IMG height="75" src="/i/mainpage/18adult.gif" width="175">
</TD>
						<TD align="center" width="50%" style="padding-left: 10; "><TABLE width="100%" border="0" class="menu">

<FORM action="/enter.php" method="post" name="F1">
							<TR>
								<TD align="center">
									<BR>
									<INPUT placeholder="Логин" class="inup" value="" name="login" style="width: 144; ">
								</TD>
							</TR>
							<TR>
								<TD align="center"><TABLE cellspacing="0" cellpadding="0" class="menu">
									<TR valign="bottom" >
										<TD><INPUT  placeholder="Пароль" style="width: 144px;" class="inup" type="password" value="" name="pass"></TD>
										
									</TR>
								</TABLE></TD>
							</TR>
							<TR>
								<TD height="19" align="center">
									<INPUT type="submit" class="btn" value=" Войти " onclick="this.blur(); ">
								</TD>
							</TR>
							<TR>
								<TD align="center">
									<INPUT type="button" class="btn" value=" Регистрация " onclick="this.blur(); window.location='/register.php'; ">
								</TD>
							</TR>
						</TABLE></TD>
						<TD width="25%" align="right" style="padding-right: 10; " valign="bottom">
							<IMG height="75" src="/i/mainpage/change_warn.gif" width="185">
						</TD>
					</TR>
					<TR>
					</TD>
					</TR>
					</FORM>
					<TR>
						<TD colspan=3 align="center" noWrap>
							<BR>
<A href="/low.html" target="_blank">Законы</A>&nbsp; &nbsp;
<A href="/tos.html" target="_blank">Соглашения</A>&nbsp; &nbsp;
<A href="/news" target="_blank">Новости</A>&nbsp; &nbsp;
<a href="/forum">Форум</a>&nbsp; &nbsp;
<A href="/rating" target="_blank">Рейтинг Кланов</A>&nbsp; &nbsp;
<A href="/rating" target="_blank">Рейтинг Игроков</A>&nbsp; &nbsp;
<A href="/repass.php"><NOBR>Забыли пароль?</NOBR></A>&nbsp; &nbsp;
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
									<TD>
										<A href="mailto:co@testcombats.ru">Отдел развития и партнерства </A>
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
