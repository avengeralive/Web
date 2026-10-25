<?php

if ((isset($_POST['reklamodatel_id']) && $_POST['reklamodatel_id']!='') && (isset($_POST['checkoffers']) && $_POST['checkoffers']=='yes'))
	{
	$reklamodatel_id=htmlentities($_POST['reklamodatel_id']);
	$sql_selectoffers = "SELECT id,name FROM offers WHERE `owner_id`='$reklamodatel_id' ORDER BY `id` DESC";
	$result_selectoffers = $mysqli->query($sql_selectoffers);
	if (mysqli_num_rows($result_selectoffers) > 0) 
		{
		$list_offers = array();
		while($row_selectoffers=mysqli_fetch_assoc($result_selectoffers)) 
			{
			 $list_offers[] = $row_selectoffers;
			}
			
		$fp = fopen('_1.txt', 'w');
		fwrite($fp, json_encode($list_offers));
		fclose($fp);			
		echo json_encode($list_offers);
		exit;
		}
	}


// Блок с добавлением нового колл-центра в базу
// Block with the addition of the new call center at the base
if (isset($_POST['submit_addcallcenter']) && ($user_tip=='40' || $user_tip=='70'))
	{
	if ((isset($_POST['name']) && $_POST['name']!='') && isset($_POST['site']) && isset($_POST['email']) && isset($_POST['skype']) && isset($_POST['phone']))
		{
		if (isset($_POST['reklamodatel'])) 
			{
			$reklamodatel=htmlentities($_POST['reklamodatel']);
			if ($reklamodatel=='0')
				{
				header('location: ./callcenter.php?xtext=7');
				exit;					
				}
			}
		if ($user_tip!='70') 
			{			
			$sql_callcenter_count = "SELECT id FROM callcenters WHERE `owner_id`='$user_id'";
			$result_callcenter_count=$mysqli->query($sql_callcenter_count);
			if (mysqli_num_rows($result_callcenter_count)>=$settings_account_max_callcenters) 
				{
				Header('location: ./callcenter.php?xtext=2');
				exit;	
				}
			}			
		$name=htmlentities($_POST['name']);
		$site=htmlentities($_POST['site']);
		$email=htmlentities($_POST['email']);
		$skype=htmlentities($_POST['skype']);
		$phone=htmlentities($_POST['phone']);
		$active=htmlentities($_POST['active']);
		if (isset($_POST['offers']) && is_array($_POST['offers']))	
			{
			$offers = htmlentities(implode(',', $_POST['offers'])); 
			if (isset($reklamodatel) && $user_tip=='70')
				{
				$request="INSERT INTO `callcenters`(`name`,`site`,`email`,`skype`,`phone`,`offers`,`active`,`owner_id`) VALUES ('$name','$site','$email','$skype','$phone','$offers','$active','$reklamodatel')";
				}
			elseif (!isset($reklamodatel) && $user_tip=='40')
				{
				$request="INSERT INTO `callcenters`(`name`,`site`,`email`,`skype`,`phone`,`offers`,`active`,`owner_id`) VALUES ('$name','$site','$email','$skype','$phone','$offers','$active','$user_id')";
				}				
			}
		else
			{
			if (isset($reklamodatel) && $user_tip=='70')
				{
				$request="INSERT INTO `callcenters`(`name`,`site`,`email`,`skype`,`phone`,`active`,`owner_id`) VALUES ('$name','$site','$email','$skype','$phone','$active','$reklamodatel')";
				}
			elseif (!isset($reklamodatel) && $user_tip=='40')
				{
				$request="INSERT INTO `callcenters`(`name`,`site`,`email`,`skype`,`phone`,`active`,`owner_id`) VALUES ('$name','$site','$email','$skype','$phone','$active','$user_id')";
				}
			}		
		$result=$mysqli->query($request);
		header('location: ./callcenter.php?xtext=1');
		exit;
		}
	}

// Блок с удалением колл-центра из базы
// Deleting the call center of the base
if (isset($_GET['delete']) && ($user_tip=='40' || $user_tip=='70' || $user_tip=='90'))
	{
	$delete_callcenter=htmlentities($_GET['delete']);
	if ($user_tip=='70') 
		{	
		$sql_callcenter_check = "SELECT id FROM callcenters WHERE `id`='$delete_callcenter'";
		}
	else
		{	
		$sql_callcenter_check = "SELECT id FROM callcenters WHERE `owner_id`='$user_id' AND `id`='$delete_callcenter'";
		}		
	$result_callcenter_check=$mysqli->query($sql_callcenter_check);
	if (mysqli_num_rows($result_callcenter_check)>0) 
		{
		if ($user_tip=='70') 
			{
			$request="DELETE FROM users WHERE `callcenter`='$delete_callcenter'";
			$result=$mysqli->query($request);
			$request="DELETE FROM callcenters WHERE `id`='$delete_callcenter'";
			$result=$mysqli->query($request);			
			}
		else
			{
			$request="DELETE FROM users WHERE `callcenter`='$delete_callcenter' AND `creator`='$user_id'";
			$result=$mysqli->query($request);
			$request="DELETE FROM callcenters WHERE `owner_id`='$user_id' AND `id`='$delete_callcenter'";
			$result=$mysqli->query($request);			
			}			
		header('location: ./callcenter.php?xtext=3');
		exit;
		}
	else
		{
		header('location: ./callcenter.php?xtext=4');
		exit;	
		}
	}

// Блок с редактированием колл-центра 
// The block with editing call center
if (isset($_POST['submit_editcallcenter']) && (isset($_POST['edit']) && $_POST['edit']!='') && ($user_tip=='40' || $user_tip=='70'))
	{
	$edit_callcenter=htmlentities($_POST['edit']);
	if ($user_tip=='70')
		{
		$sql_callcenter_check = "SELECT id FROM callcenters WHERE `id`='$edit_callcenter'";
		}
	else
		{
		$sql_callcenter_check = "SELECT id FROM callcenters WHERE `owner_id`='$user_id' AND `id`='$edit_callcenter'";
		}		
	$result_callcenter_check=$mysqli->query($sql_callcenter_check);
	if (mysqli_num_rows($result_callcenter_check)>0) 
		{	
		$name=htmlentities($_POST['name']);
		$site=htmlentities($_POST['site']);
		$email=htmlentities($_POST['email']);
		$skype=htmlentities($_POST['skype']);
		$phone=htmlentities($_POST['phone']);	
		$active=htmlentities($_POST['active']);
		if (isset($_POST['offers']) && is_array($_POST['offers']))	
			{
			$offers = htmlentities(implode(',', $_POST['offers'])); 
			if ($user_tip=='70')
				{
				$request="UPDATE `callcenters` SET `name`='$name',`site`='$site',`email`='$email',`skype`='$skype',`phone`='$phone',`offers`='$offers',`active`='$active' WHERE `id`='$edit_callcenter'";
				}
			else
				{
				$request="UPDATE `callcenters` SET `name`='$name',`site`='$site',`email`='$email',`skype`='$skype',`phone`='$phone',`offers`='$offers',`active`='$active' WHERE `id`='$edit_callcenter' AND `owner_id`='$user_id'";
				}				
			}
		else
			{
			if ($user_tip=='70')
				{
				$request="UPDATE `callcenters` SET `name`='$name',`site`='$site',`email`='$email',`skype`='$skype',`phone`='$phone',`offers`='',`active`='$active' WHERE `id`='$edit_callcenter'";
				}
			else
				{
				$request="UPDATE `callcenters` SET `name`='$name',`site`='$site',`email`='$email',`skype`='$skype',`phone`='$phone',`offers`='',`active`='$active' WHERE `id`='$edit_callcenter' AND `owner_id`='$user_id'";
				}				
			}
		$result=$mysqli->query($request);						
		header('location: ./callcenter.php?xtext=5');
		exit;
		}
	else
		{
		header('location: ./callcenter.php?xtext=6');
		exit;	
		}		
	}
?>	
	
