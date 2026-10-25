<?php

// Блок с добавлением нового домена в базу
// Block with the addition of a new domain in the database
if (isset($_POST['submit_adddomain']) && $user_tip=='70')
	{
	if (isset($_POST['domain']) && $_POST['domain']!='')
		{
		$domain=htmlentities($_POST['domain']);
		$sql_check = "SELECT id FROM domains WHERE `domain`='$domain'";
		$result_check = $mysqli->query($sql_check);
		if (mysqli_num_rows($result_check)==0) 
			{
			$request= "INSERT INTO `domains`(`domain`,`active`) VALUES ('$domain','0')";
			$result=$mysqli->query($request);
			header('location:'.$_SERVER['PHP_SELF'].'?xtext=2');
			exit;
			}
		else
			{
			header('location:'.$_SERVER['PHP_SELF'].'?xtext=4');
			exit;
			}
		}
	else
		{
		header('location:'.$_SERVER['PHP_SELF'].'?xtext=1');
		exit;
		$xtext='1';
		}
	}

// Блок с удалением домена из базы
// Block the removal of the domain database
if (isset($_GET['delete']) && $_GET['delete']!='' && $user_tip=='70')
	{
	$id_domain=htmlentities($_GET['delete']);
	$sql = "SELECT * FROM domains WHERE `id`='$id_domain'";
	$result = $mysqli->query($sql);
	if (mysqli_num_rows($result) > 0) 
		{
		$request = "DELETE from domains WHERE `id`='$id_domain'";
		$result = $mysqli->query($request);
		header('location:'.$_SERVER['PHP_SELF'].'?xtext=3');
		exit;
		} 
	}

// Блок с изменением статуса домена (активирован или нет)
// Block to change the domain status (active or not)
if (isset($_GET['main']) && $_GET['main']!='' && $user_tip=='70')
	{
	if (isset($_GET['act']) && $_GET['act']!='')
		{
		$id_domain=htmlentities($_GET['main']);
		$act=htmlentities($_GET['act']);
		$sql = "SELECT * FROM domains WHERE `id`='$id_domain'";
		$result = $mysqli->query($sql);
		if (mysqli_num_rows($result) > 0) 
			{
			if (isset($act) && $act=='1')
				{
				$request = "UPDATE domains SET `active`='0' WHERE `active`='1'";
				$result = $mysqli->query($request);		
				$request = "UPDATE domains SET `active`='1' WHERE `id`='$id_domain'";
				$result = $mysqli->query($request);		
				header('location:' . $_SERVER['PHP_SELF']);
				exit;
				}
			if (isset($act) && $act=='2')
				{
				$request = "UPDATE domains SET `active`='0' WHERE `active`='2'";
				$result = $mysqli->query($request);		
				$request = "UPDATE domains SET `active`='2' WHERE `id`='$id_domain'";
				$result = $mysqli->query($request);		
				header('location:' . $_SERVER['PHP_SELF']);
				exit;
				}	
			} 
		}
	}

?>