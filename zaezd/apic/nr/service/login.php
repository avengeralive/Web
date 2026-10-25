<?php
if(empty($_SESSION["user_id"]))
{
if($global_mode=="login" && !empty($finish))
{
	$login=$_POST["login"];
	$pass=$_POST["pass"];
	$sql='select id_user, name, mail, type, pass,login from '.$pr.'user where login="'.addslashes($login).'" and pass=password("'.addslashes($pass).'");';
    $user=mysql_query($sql);
	$user_id=mysql_result($user,0,0);
	$user_name=mysql_result($user,0,1);
	$user_mail=mysql_result($user,0,2);
	$user_type=mysql_result($user,0,3);
	if(!empty($user_id))
	{
	$pass=mysql_result($user,0,4);
	$login=mysql_result($user,0,5);
	}
		
	if(!empty($user_id))
	{
		$_SESSION["user_id"]=$user_id;
		$_SESSION["user_name"]=$user_name;
		$_SESSION["user_mail"]=$user_mail;
		$_SESSION["user_type"]=$user_type;
		$_SESSION["user_login"]=$login;
        
	    
	 /*$path="Location: https://".$_SERVER['HTTP_HOST'].'/';
	 header($path);
     die();*/
	}
	else
	{
	 $err_mess="Не верный логин или пароль";
	}
}
}

if(empty($_SESSION["user_type"]))
{
    if(!empty($err_mess)) $le_form.='<p id="error">'.$err_mess.'</p>'."\n";
    $le_form.='<div class="box">'."\n";
    $le_form.='<form id="auth_form" action="/nr/login/finish/" method="post">'."\n";
    $le_form.='<div><label>E-mail:</label><p><input type="text" name="login"/></p></div>'."\n";
    $le_form.='<div><label>Пароль:</label><p><input type="password" name="pass"/></p></div>'."\n";
    $le_form.='<div><p><input type="submit" class="submit" value="Войти"/></p></div>'."\n";
    $le_form.='</form>'."\n";
    $le_form.='</div>'."\n";
}

if(!empty($_SESSION["user_type"]))
{
 $le_form.='<div id="welcome"><p>Добро пожаловать, <b>'.$_SESSION["user_name"].'</b>!</p><p><a href="'.$base_url.'logout/">Выйти</a></p></div>';
}

?>