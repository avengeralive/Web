<?php

// Добавляем субаккаунт в базу
// Add a subaccount in the database
if (isset($_POST['submit_subacc']) && ($user_tip=='10' || $user_tip=='70'))
	{
	if (isset($_POST['offer_id']) && isset($_POST['landing_id']) && isset($_POST['page_url']))
		{
		$sql_check_kolvo= "SELECT COUNT('id') as kolvo FROM `subacc` WHERE `user_id`='$user_id'";
		$result_check_kolvo=$mysqli->query($sql_check_kolvo);
		$res_check_kolvo = mysqli_fetch_assoc($result_check_kolvo);
		if ($res_check_kolvo['kolvo']<$settings_account_max_subacc)
			{			
			$offer_id=htmlentities($_POST['offer_id']);
			$landing_id=htmlentities($_POST['landing_id']);
			$page_url=htmlentities($_POST['page_url']);
			$sql_getlandingsdata = "SELECT url FROM landings WHERE `id`='$landing_id'";
			$result_getlandingsdata = $mysqli->query($sql_getlandingsdata);
			if (mysqli_num_rows($result_getlandingsdata) > 0) 
				{
				$res_getlandingsdata=mysqli_fetch_array($result_getlandingsdata);
				$page_url=htmlentities($res_getlandingsdata['url']).$page_url;
				$sql_add_subacc= "INSERT INTO `subacc`(`user_id`,`offer_id`,`landing_id`,`page`) VALUES ('$user_id','$offer_id','$landing_id','$page_url')";
				$result_add_subacc=$mysqli->query($sql_add_subacc);
				header('location:'.$_SERVER['PHP_SELF'].'?xtext=3');
				exit;
				}
			}
		else
			{
			header('location:'.$_SERVER['PHP_SELF'].'?xtext=1');
			exit;	
			}
		}		
	else
		{
		header('location:'.$_SERVER['PHP_SELF'].'?xtext=2');
		exit;
		}
	}

// Удаляем субаккаунт из базы
// Remove the subaccount of the base
if (isset($_GET['delete']) && $_GET['delete']!='' && ($user_tip=='10' || $user_tip=='70'))
	{
	// Проверяем, есть ли субаккаунт в базе
	// Check whether there is a subaccount in the database
	$subacc_id=htmlentities($_GET['delete']);
	$sql_check_subacc = "SELECT * FROM subacc WHERE `user_id`='$user_id' AND `id`='$subacc_id'";
	$result_check_subacc = $mysqli->query($sql_check_subacc);
	if (mysqli_num_rows($result_check_subacc) > 0) 
		{
		$sql_delete_subacc = "DELETE FROM subacc WHERE `user_id`='$user_id' AND `id`='$subacc_id'";
		$result_delete_subacc = $mysqli->query($sql_delete_subacc);
		header('location:'.$_SERVER['PHP_SELF'].'?xtext=4');
		exit;
		}
	else
		{
		header('location:'.$_SERVER['PHP_SELF'].'?xtext=5');
		exit;
		}
	}

?>
