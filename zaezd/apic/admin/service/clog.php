<?php
if(empty($_SESSION["user_id"]) && $mode1!="login")
{
 if($_COOKIE["log"]==1)
 {
 	$ñlogin=$_COOKIE["ñlogin"];
    $pñass=$_COOKIE["ñpass"];	
  
	$sql='Select id_user, name, mail, type from '.$pr.'user where login="'.addslashes($ñlogin).'" and pass="'.addslashes($ñpass).'";';
    $user=mysql_query($sql);
	$user_id=mysql_result($user,0,0);
	$user_name=mysql_result($user,0,1);
	$user_mail=mysql_result($user,0,2);
	$user_type=mysql_result($user,0,3);
		
	if(!empty($user_id))
	{
		$_SESSION["user_id"]=$user_id;
		$_SESSION["user_name"]=$user_name;
		$_SESSION["user_mail"]=$user_mail;
		$_SESSION["user_type"]=$user_type;
		$_SESSION["user_login"]=$login;
	}
 }
}
?>