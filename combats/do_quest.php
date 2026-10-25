<?php
define('GAME',true);
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
//include('_incl_data/class/__user.php');

if(isset($_POST['id']) && isset($_POST['uid']))
{
	$_POST['id']  = intval($_POST['id']);
    $_POST['uid'] = intval($_POST['uid']);
	$key = md5($_POST['uid'].$c['skey']);

	if($_POST['key']==$key)
	{
		if($_POST['id'] == 1)//Уведомление для всех
		{
			do_query('UPDATE `users` SET `fnq` = "0" WHERE id="'.$_POST['uid'].'" LIMIT 1');
		}
	}
}
?>