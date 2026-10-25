<?php

// Блок с добавлением новой категории офферов в базу
// Block with the addition of a new category in the database offers
if (isset($_POST['submit_category']) && $user_tip=='70')
	{
	if (isset($_POST['category']) && $_POST['category']!='')
		{
		$category=htmlentities($_POST['category']);
		$sql_check = "SELECT id FROM category_tpl WHERE `name`='$category'";
		$result_check = $mysqli->query($sql_check);
		if (mysqli_num_rows($result_check)==0) 
			{
			$request= "INSERT INTO `category_tpl`(`name`) VALUES ('$category')";
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

// Блок с удалением категории из базы
// Block with removal of the base category
if (isset($_GET['delete']) && $_GET['delete']!='' && $user_tip=='70')
	{
	$id_category=htmlentities($_GET['delete']);
	$sql = "SELECT * FROM category_tpl WHERE `id`='$id_category'";
	$result = $mysqli->query($sql);
	if (mysqli_num_rows($result) > 0) 
		{
		$request = "DELETE from category_tpl WHERE `id`='$id_category'";
		$result = $mysqli->query($request);
		header('location:'.$_SERVER['PHP_SELF'].'?xtext=3');
		exit;
		} 
	}

?>