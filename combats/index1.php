<?php
	include_once('_incl_data/__config.php');
	define('GAME', true);
	include_once('_incl_data/class/__db_connect.php');
?>

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
	margin 0px;
	background: url(//img.testcombats.ru/admin/bg.jpg);
    background-repeat: no-repeat;
    background-size: cover;
	background-color: #000;

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
.fade {
  opacity: 1;
}

.fade:hover {
  opacity: 0.9;
}
-->
		</STYLE>

<!-- Put this script tag to the place, where the Share button will be -->

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
	<BODY class="menu">
		<TABLE width="100%" border="0" cellpadding="0" cellspacing="0" class="menu">
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
				<TD colspan="2" width="100%" align="center" scope="col">
					<TR height="205" valign="top">
						<TD  width="195" align="center" valign="bottom" style="padding-bottom: 42; ">
						<img class="fade" src="//img.testcombats.ru/admin/e1.png" width="280" height="224">
</TD>
						<TD align="center">
 
</TD>

<TD width="195" valign="bottom" style="padding-bottom: 42; padding-right: 5; " align="right"></TD>
					</TR>
				</TABLE></TD>
			</TR>
			<TR valign="top" height="50%">
				<TD colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0" class='menu'>
					<TR>
						<TD align="left" valign="bottom" noWrap style="padding-left:10; " width="25%">

<IMG height="75" src="/i/mainpage/18adult.png" width="175">
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
									<INPUT type="submit" class="btn" value=" Войти " onclick="this.blur(); ">&nbsp;<INPUT type="button" class="btn" value=" Регистрация " onclick="this.blur(); window.location='/register.php'; ">
								</TD>
							</TR>
							<TR>
								<TD align="center">
									
								</TD>
							</TR>
						</TABLE></TD>
						<TD width="25%" align="right" style="padding-right: 10; " valign="bottom">
							<IMG height="75" src="/i/mainpage/change_warn.png" width="185">
						</TD>
					</TR>
					<TR>
					</TD>
					</TR>
					</FORM>
					<TR>
						<tr>
					<td colspan="3" align="center" nowrap="" style="font-size: 10.04pt;"><br>
					<a href="http://testcombats.ru/encicl/1.html" target="_blank" title="Законы">Законы</a>&nbsp; &nbsp;
					<a href="http://testcombats.ru/encicl/2.html" target="_blank" title="Соглашение">Соглашение</a>&nbsp; &nbsp;
					<a href="/forum" target="_blank" title="Форум">Форум</a>&nbsp; &nbsp;
					<a href="/news" target="_blank" title="Новостная Лента">Новости</a>&nbsp; &nbsp;
					<a href="/rating/" target="_blank" title="Рейтинг Игроков">Рейтинг</a>&nbsp; &nbsp;
					<a href="/support" target="_blank" title="Тех. Поддержка">Тех. поддержка</a>&nbsp; &nbsp;
					</td>
					</TR>
				</TABLE>
				<TABLE width="100%">
					<TR>
						<TD style="padding-left: 10; " class="menu"><A href="mailto:co@testcombats.ru">Отдел развития и партнерства</A>
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
