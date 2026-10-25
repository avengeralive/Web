<?php
if(empty($_SESSION["user_id"]))
{
if($global_mode=="login" && !empty($finish))
{
	$login=$_POST["login"];
	$pass=$_POST["pass"];
	$sql='select id_user, name, mail, type, pass,login from '.$pr.'user where login="'.addslashes($login).'" and pass=password("'.addslashes($pass).'");';
    //echo $sql;
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
        
		if($_POST["rem"]==1) 
	    {
	     $exp = mktime(0,0,0,1,1,2010);	
	     setcookie("log","1",$exp,'/',$_SERVER['HTTP_HOST']);
	     setcookie("сlogin",$login,$exp,'/',$_SERVER['HTTP_HOST']);
	     setcookie("сpass",$pass,$exp,'/',$_SERVER['HTTP_HOST']);
	    }
	    
	 $path="Location: http://".$_SERVER['HTTP_HOST'].'/admin/';
	 header($path);
	 echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=/admin/">';
	}
	
	 
	else
	{
	 $err_mess="<h1>Неверное имя или пароль</h1>";
	}
}
}

if(empty($_SESSION["user_type"]))
{
  echo '<form method="post" action="/admin/login/finish/" id="auth" name="auth">'."\n";
  echo '<p><label for="username">Логин</label><input name="login" id="username" value="" type="text" width="100">'."\n";
  echo '<label for="userpass">Пароль</label><input name="pass" id="userpass" value="" type="password" width="100">'."\n";
  echo '<label for="rem">Запомнить</label><input id="rem" type="checkbox" name="rem" value="1" />'."\n";
  echo '<input type="submit" class="submit" name="submit" value="Войти" /></p>'."\n";
  echo '</form>'."\n";
}

if(!empty($_SESSION["user_type"]))
{
 echo '<p>Вы вошли как <span>'.$_SESSION["user_name"].'</span><a href="/admin/logout/" title="Intype">Выйти</a></p>';
}

?>