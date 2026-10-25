<?php
define('GAME', true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__chat_class.php');

function GetRealIp()
{
 if (!empty($_SERVER['HTTP_CLIENT_IP']))
 {
   $ip=$_SERVER['HTTP_CLIENT_IP'];
 }
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
 {
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 else
 {
   $ip=$_SERVER['REMOTE_ADDR'];
 }
 return $ip;
}

$ip = GetRealIp();
?>

<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Смена пароля игрока &laquo;Бойцовского Клуба&raquo;</title>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/psi.js"></script>
<link rel="stylesheet" href="/css/register.css?<?=time()?>" type="text/css" media="screen"/>
<link href="https://img.testcombats.ru/css/main.css" rel="stylesheet" type="text/css">
<link href="/css/common.css" rel="stylesheet" type="text/css">
<link href="https://img.testcombats.ru/css/reg.css" rel="stylesheet" type="text/css">
</head>

<body class="repass" bgcolor="3D3D3B">
<style type="text/css">
<!--
html, body { height:100%; }
-->
</style>

<div id="header" style="height: 54px;">
    <div class="container">
        <p align="center" style="font-size: 11px;"><a href="/"><span>Старый Бойцовский Клуб</span></a></p>
        <ul id="main-menu">
            <br><li><a href="https://top.testcombats.ru/" target="_blank" style="font-size: 11px;">НОВОСТИ</a></li>
            <li><a href="/rating_pers" style="font-size: 11px;">РЕЙТИНГ ИГРОКОВ</a></li>
            <li><a href="/rating_clans" style="font-size: 11px;">РЕЙТИНГ КЛАНОВ</a></li>
			<li><a href="/forum" style="font-size: 11px;">ФОРУМ</a></li>
        </ul>
    </div>
</div>
<!-- /#header -->
<div align="center" style="height:94%; min-height: 750px;">
<table width="900" height="100%" style="margin-bottom:-44px" border="0" cellspacing="0" cellpadding="0">
	<tr>
	 <td width="29" valign="top" background="https://img.testcombats.ru/i/regImg5.jpg"><img src="https://img.testcombats.ru/i/regImg4.jpg" width="29" height="256"></td>
	 <td width="118" valign="top" bgcolor="#f2e5b1"><img src="https://img.testcombats.ru/i/regImg2.jpg" width="118" height="257"></td>
	 <td valign="top" bgcolor="#f2e5b1" align="left">
	 	<br>
<br><br><br>
<h3>Смена пароля в игре</h3>
<br>
<?php
$err = '';
$info = '';

//Запрос смены пароля
if(isset($_POST['changepsw']))
{
    $_POST['ulogin'] = trim($_POST['ulogin']);
    $_POST['uemail'] = trim($_POST['uemail']);

	if ($_POST['ulogin'] && $_POST['uemail'])
	{
        $user = mysql_fetch_array(mysql_query('SELECT `id`,`mail`,`login`,`level` FROM `users`
		WHERE `login`="'.mysql_real_escape_string($_POST['ulogin']).'" AND `mail`="'.mysql_real_escape_string($_POST['uemail']).'" LIMIT 1'));

        if(!isset($user['id'])) {$err = "Пользователь с таким логином и email не найден.";}
		else {
				$code = GenCode(15);
				$link = 'https://'.$c['host'].'/repass?code='.$code;
				if($_POST['copy_email']) $link .='&copy=1';

				//код в базу
				mysql_query('UPDATE `users` SET `pass_code` = "'.$code.'" WHERE `id`="'.$user['id'].'" LIMIT 1');

				//отсылаем на почту
				$headers  = "Mime-Version: 1.1 \r\n";
				$headers .= "Date: ".date("r")." \r\n";
				$headers .= 'Content-type: text/html; charset=windows-1251'."\r\n";
				$headers .= "From: PrimeBK <".$c['admin_email'].">\r\n";

				$headers = trim($headers);
				$headers = stripslashes($headers);

				$aa='<html>
						<head>
							<title>Смена пароля</title>
						</head>
						<body>
							'.date("d.m.y H:i").'<br>
							Кто-то с IP: '.$ip.' пытается сменить пароль к персонажу "'.$user['login'].'" ['.$user['level'].'].<br>
							Т.к. в анкете у этого персонажа указан email: '.$user['mail'].', то вы и получили это письмо.<br>
							<br>
							Для того чтобы подтвердить смену пароля, вы должны зайти по ссылке:<br>
							'.$link.'<br><br>
							--<br>
							Старый Бойцовский Клуб https://www.testcombats.ru<br>
							Администрация Бойцовского Клуба: '.$c['admin_email'].'<br>
							P.S. Данное письмо сгенерировано автоматически, отвечать на него не нужно.

						</body>
					</html>';

				//$aa = iconv('windows-1251', 'UTF-8', $aa);
                $subject = "Смена пароля у персонажа \"".$user['login']."\" [".$user['level']."]";
                //$subject = iconv('windows-1251', 'UTF-8', $subject);
                $subject = "=?windows-1251?B?".base64_encode($subject)."?=\n";

				mail($user['mail'],$subject, $aa, $headers);
                if($_POST['copy_email']) mail($c['admin_email'],"Смена пароля у персонажа \"".$user['login']."\" [".$user['level']."]", $aa, $headers);

				$info = "На ваш email выслано письмо с просьбой подтвердить операцию смены пароля.";
                if($_POST['copy_email']) $info .= "<br>Копия письма отправлена администратору.";
			}
	} else {$err = "Пользователь с таким логином и email не найден.";}
}

//смена пароля
if(isset($_GET['code']) && trim($_GET['code'])!='')
{
	$user = mysql_fetch_array(mysql_query('SELECT `id`,`mail`,`login`,`level` from `users`
	WHERE `pass_code`="'.mysql_real_escape_string($_GET['code']).'" LIMIT 1'));

    if(!isset($user['id'])) {$err = "Неверный код подтверждения.";}
	else {
            	$password = GenCode(12);

				//Меняем пароль
				mysql_query('UPDATE `users` SET `pass` = "'.mysql_real_escape_string(md5($password)).'" WHERE `id`="'.$user['id'].'" LIMIT 1');

				//отсылаем на почту
				$headers  = "Mime-Version: 1.1 \r\n";
				$headers .= "Date: ".date("r")." \r\n";
				//$headers .= "Content-type: text/html; charset=utf-8 \r\n";
                $headers .= 'Content-type: text/html; charset=windows-1251'."\r\n";
				$headers .= "From: PrimeBK <".$c['admin_email'].">\r\n";

				$headers = trim($headers);
				$headers = stripslashes($headers);

				$aa='<html>
						<head>
							<title>Смена пароля</title>
						</head>
						<body>
							'.date("d.m.y H:i").'<br>
							Смена пароля успешно подтверждена. Теперь вы можете войти в игру по новому паролю.<br>
							<br>
							Ваш новый пароль:<br>
							'.$password.'<br><br>
							--<br>
							Бойцовский Клуб https://www.testcombats.ru<br>
							Администрация Бойцовского Клуба: '.$c['admin_email'].'<br>
							P.S. Данное письмо сгенерировано автоматически, отвечать на него не нужно.

						</body>
					</html>';

				//$aa = iconv('windows-1251', 'UTF-8', $aa);
                $subject = "Смена пароля у персонажа \"".$user['login']."\" [".$user['level']."]";
                //$subject = iconv('windows-1251', 'UTF-8', $subject);
                $subject = "=?windows-1251?B?".base64_encode($subject)."?=\n";

				mail($user['mail'],$subject, $aa, $headers);
                if($_GET['copy']==1) mail($c['admin_email'],"Смена пароля у персонажа \"".$user['login']."\" [".$user['level']."]", $aa, $headers);

				$info = "Пароль успешно изменен. Новый пароль отправлен на ваш email.";
                if($_GET['copy']==1) $info .= "<br>Копия письма отправлена администратору.";
	}
}

?>
Чем выше уровень вашего персонажа, тем больше к нему внимание со стороны хакеров, взломщиков и аферистов. Чтобы однажды не оказаться в ситуации, когда вы уже не сможете зайти под своим персонажем, которого развивали (которым жили!) месяцами, потому что пароль сменили, email сменили, все предметы/вещи/кредиты... все что нажито непосильным трудом... ушли в неизвестном направлении, необходимо соблюдать элементарные меры предосторожности. А именно:<br>
1. Никогда, ни под каким предлогом, никому не говорите свой пароль. Ни паладинам, ни администрации не нужно знать ваш пароль.<br>
2. Вводите логин и пароль только на титульной странице <a href="/index.php" target="_blank" style="color:black; font-size: 12px;"><b>Старый Бойцовский Клуб</b></a><br> Ни на каких других сайтах, которые будут как две капли похожие на наш, и куда вас зазывают обещая на халяву предметы и кредиты, не вводите свой пароль! Иначе вы рискуете потерять своего персонажа.<br>
<p><font color=red>Обратите внимание!</font> Мы не можем выслать вам ваш пароль, т.к. в целях безопасности он хранится в зашифрованном виде, что даже мы его не знаем, поэтому мы можем выслать вам новый пароль.</p>
Заполните форму ниже, укажите ваш логин и email в игре. На ваш email будет выслана ссылка для сброса пароля, только после ее нажатия, ваш пароль будет изменен на новый.
<p><font color=red>Обратите внимание!</font> Если письма от нашего проекта по каким-то причинам к вам не доходят, просто укажите "выслать копию письма администратору" и тогда копия
письма будет выслана администратору, а он сообщит вам новый пароль.</p><br>
<?php
if($err) echo '<p align=center><font color=red>Ошибка! '.$err.'</font></p>';
elseif($info) echo '<p align=center><font color=green>'.$info.'</font></p>';

if(!$info)
{
?>
	<FORM ACTION="repass.php" METHOD=POST>
	<fieldset>
	<legend><b>Сменить пароль</b></legend>
	<table align="center" style="margin: auto;">
		<tr>
			<td align=right>Ваш логин:</td>
			<td><input id="ulogin" class="psi_input1_none" style="width: 191px;" type=text name="ulogin">
	        	<span style="display:inline-block;width:15px;"> <span id="ulogin_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'>
	                <div id="login_error_text">Неверный логин.<br>Укажите ваш логин.</div>
	        	</span></span> </span>
			</td>
		</tr>
		<tr>
			<td align=right>Ваш email:</td>
			<td><input id="uemail" class="psi_input1_none" style="width: 191px;" type=text name="uemail">
	        	<span style="display:inline-block;width:15px;"> <span id="uemail_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'>
	                  <div id="email_error_text">Неверный email.<br>Укажите ваш email.</div>
	        	</span></span> </span>
			</td>
		</tr>
		<tr>
        	<td></td><td><input id="copy_email" type=checkbox name="copy_email">выслать копию письма администратору</td>
		</tr>
		<tr><td colspan=2 align=center><input id="changepsw" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type=submit value="Запросить пароль" name="changepsw"></td></tr>
	</table>
	</fieldset>
	</FORM>
<?php } ?>
<BR>
<FORM><p align=center><INPUT style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type=button value="Вернуться" onClick="location.href='/';"></p></form>
</td>
	<td width="139" valign="top" bgcolor="#f2e5b1"><img height=144 src="https://img.testcombats.ru/i/regImg3.jpg" width=139 border=0></td>
	<td width="23" valign="top" background="https://img.testcombats.ru/i/regImg6.jpg">&nbsp;</td>
</tr>
 </table>
<TABLE height="44" cellSpacing=0 cellPadding=0 width="100%" border=0>
	<TBODY>
		<TR>
			<TD width="100%" height=13 background="https://img.testcombats.ru/i/regImg7.jpg"></TD>
		</TR>
		<TR>
			<TD width="100%" bgColor=#000000 height=20>
				<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="10%" scope="col"></td>
						<td width="81%" scope="col"><div align="center"><NOBR><span style="color:#EBD88B; font-family:'Philosopher', sans-serif;font-size: 11px;">Старый Бойцовский Клуб © 2006 | Текущие время года: <?=date('Y');?></span></NOBR></div></td>
						<td width="9%" scope="col">&nbsp;</td>
					</tr>
				</table>
			</TD>
		</TR>
	</TBODY>
</TABLE>
</div>
<!-- -->
<script language="JavaScript">
$(document).ready(function()
{
	$(document).on("click", "#changepsw", function()
	//$(".form_submit").on("click", function()
	{
		var err = 0;

		if(!$('#ulogin').val())
		{
			$('#ulogin_error').show();
            $('#ulogin').addClass('psi_input1_red');
            err = 1;
		} else {
                $('#ulogin_error').hide();
            	$('#ulogin').removeClass('psi_input1_red');
		}
        if(!$('#uemail').val())
		{
			$('#uemail_error').show();
            $('#uemail').addClass('psi_input1_red');
            err = 1;
		} else {
                $('#uemail_error').hide();
            	$('#uemail').removeClass('psi_input1_red');
		}

		if(err) return false;
	});

});
</script>
<? echo $c['counters'];//счетчики ?>
</body>
</html>