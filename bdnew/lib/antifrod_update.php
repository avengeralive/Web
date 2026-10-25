<?php
if (isset($_POST['submit_antifrod_settings']) && $user_tip=='70')
	{
		//$phone=htmlentities($_POST['phone']);
		$lids_ip_1=htmlentities($_POST['lids_ip_1']);
		$lids_referer_1=htmlentities($_POST['lids_referer_1']);
		$lids_buys_1=htmlentities($_POST['lids_buys_1']);
		$lids_ip_2=htmlentities($_POST['lids_ip_2']);
		$lids_referer_2=htmlentities($_POST['lids_referer_2']);
		$lids_buys_2=htmlentities($_POST['lids_buys_2']);
		
	$request="UPDATE `antifrod_config` SET `lids_ip_1`='$lids_ip_1', `lids_referer_1`='$lids_referer_1', `lids_buys_1`='$lids_buys_1',`lids_ip_2`='$lids_ip_2', `lids_referer_2`='$lids_referer_2', `lids_buys_2`='$lids_buys_2' WHERE `id`='1'";
	$result=$mysqli->query($request);
	header('location:' . $_SERVER['PHP_SELF'] .'?success');
	exit;		
		
	}
	
if (isset($_GET['ban']) && $user_tip=='70')
	{
		$user=htmlentities($_GET['ban']);
		
		$request="UPDATE `users` SET `active`='5' WHERE `id`='$user' LIMIT 1";
		$result=$mysqli->query($request);
		header('location:' . $_SERVER['PHP_SELF'] .'?banned');
		exit;		
			
	}	
	
if (isset($_GET['cheks']) && $user_tip=='70')
	{
		$user=htmlentities($_GET['cheks']);
		
		$request="UPDATE `users` SET `antifrod`='0' WHERE `id`='$user' LIMIT 1";
		$result=$mysqli->query($request);
		header('location:' . $_SERVER['PHP_SELF'] .'?checked');
		exit;		
			
	}