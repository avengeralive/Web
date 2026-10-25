<?php

// Блок с добавлением в базу нового оператора
// Block with the addition of a new operator
if (isset($_POST['submit_new_operator']) && ($user_tip=='40' || $user_tip=='70'))
	{
	if (isset($_POST['email']) && $_POST['email']!='')
		{
		if (isset($_POST['password1']) && $_POST['password1']!='')
			{
			if (isset($_POST['password2']) && $_POST['password2']!='')
				{
				if ($_POST['password1']==$_POST['password2'])
					{
					if (isset($_POST['callcenter']) && $_POST['callcenter']!='')
						{
						if (isset($_POST['reklamodatel'])) 
							{
							$reklamodatel=htmlentities($_POST['reklamodatel']);
							}
						if ($user_tip!='70') 
							{							
							$sql_operators_count = "SELECT id FROM users WHERE `creator`='$user_id'";
							$result_operators_count=$mysqli->query($sql_operators_count);
							if (mysqli_num_rows($result_operators_count)>=$settings_account_max_operators) 
								{
								Header('location: ./operators.php?xtext=8');
								exit;	
								}					
							}
						$op_email = $mysqli -> real_escape_string(htmlspecialchars($_POST['email']));
						$op_name = htmlentities($_POST['name']);
						$op_password = $mysqli -> real_escape_string(htmlspecialchars(md5(md5($_POST['password1']))));
						$op_callcenter = $mysqli -> real_escape_string(htmlspecialchars($_POST['callcenter']));
						$request= "SELECT id FROM users WHERE `email`='$op_email'";
						$result=$mysqli->query($request);
						if (mysqli_num_rows($result) > 0) 
							{
							header('location: ./operators.php?xtext=1');
							exit;
							}
						else
							{
							if (isset($reklamodatel) && $user_tip=='70')
								{
								$request= "INSERT INTO users (`email`,`name`,`password`,`active`,`callcenter`,`creator`,`tip`) VALUES ('$op_email','$op_name','$op_password','1','$op_callcenter','$reklamodatel','20')";
								}
							else
								{
								$request= "INSERT INTO users (`email`,`name`,`password`,`active`,`callcenter`,`creator`,`tip`) VALUES ('$op_email','$op_name','$op_password','1','$op_callcenter','$user_id','20')";
								}
							$result=$mysqli->query($request);
							header('location: ./operators.php?xtext=2');
							exit;
							}
						} else {header('location: ./operators.php?xtext=3'); exit;}
					} else {header('location: ./operators.php?xtext=4'); exit;}
				} else {header('location: ./operators.php?xtext=5'); exit;}
			} else {header('location: ./operators.php?xtext=6'); exit;}
		} else {header('location: ./operators.php?xtext=7'); exit;}
	}
	
// Блок с редактированием оператора
// The block with editing the operator
if (isset($_POST['submit_editoperator']) && ($user_tip=='40' || $user_tip=='70'))
	{
	if (isset($_POST['email']) && $_POST['email']!='')
		{
		if (isset($_POST['password1']))
			{
			if (isset($_POST['password2']))
				{
				if ($_POST['password1']==$_POST['password2'])
					{
					if (isset($_POST['callcenter']) && $_POST['callcenter']!='')
						{
						$op_id = htmlentities($_POST['id']);
						$op_email = $mysqli -> real_escape_string(htmlspecialchars($_POST['email']));
						$op_name = htmlentities($_POST['name']);
						$op_active = htmlentities($_POST['active']);
						$op_password = $mysqli -> real_escape_string(htmlspecialchars(md5(md5($_POST['password1']))));
						$op_callcenter = $mysqli -> real_escape_string(htmlspecialchars($_POST['callcenter']));
						
						if ($user_tip=='70') 
							{	
							$request= "SELECT id FROM users WHERE `id`='$op_id'";
							}
						else
							{	
							$request= "SELECT id FROM users WHERE `id`='$op_id' AND `creator`='$user_id'";
							}
						$result=$mysqli->query($request);
						if (mysqli_num_rows($result) == 0) 
							{
							header('location: ./operators.php?xtext=11');
							exit;
							}
						else
							{
							if ($user_tip=='70') 
								{
								$request= "UPDATE users SET `email`='$op_email',`name`='$op_name',`password`='$op_password',`active`='$op_active',`callcenter`='$op_callcenter' WHERE `id`='$op_id'";
								}
							else
								{
								$request= "UPDATE users SET `email`='$op_email',`name`='$op_name',`password`='$op_password',`active`='$op_active',`callcenter`='$op_callcenter' WHERE `id`='$op_id' AND `creator`='$user_id'";
								}
							$result=$mysqli->query($request);
							header('location: ./operators.php?xtext=12');
							exit;
							}
						} else {header('location: ./operators.php?xtext=3'); exit;}
					} else {header('location: ./operators.php?xtext=4'); exit;}
				} else {header('location: ./operators.php?xtext=5'); exit;}
			} else {header('location: ./operators.php?xtext=6'); exit;}
		} else {header('location: ./operators.php?xtext=7'); exit;}
	}	

// Блок с удалением оператора из базы (если пользователь - РЕКЛАМОДАТЕЛЬ)
// Deleting the operator from base (if the user - advertisers)
if (isset($_GET['delete']) && ($user_tip=='40' || $user_tip=='70' || $user_tip=='90'))
	{
	$delete_operator=htmlentities($_GET['delete']);
	if ($user_tip=='70')
		{
		$sql_operator_check = "SELECT id FROM users WHERE `id`='$delete_operator'";
		}
	else
		{
		$sql_operator_check = "SELECT id FROM users WHERE `creator`='$user_id' AND `id`='$delete_operator'";
		}		
	$result_operator_check=$mysqli->query($sql_operator_check);
	if (mysqli_num_rows($result_operator_check)>0) 
		{
		if ($user_tip=='70')
			{			
			$request="DELETE FROM users WHERE `id`='$delete_operator'";
			}
		else
			{			
			$request="DELETE FROM users WHERE `creator`='$user_id' AND `id`='$delete_operator'";
			}			
		$result=$mysqli->query($request);
		header('location: ./operators.php?xtext=9');
		exit;
		}
	else
		{
		header('location: ./operators.php?xtext=10');
		exit;	
		}
	}

?>	
	
