<?php

// Блок с добавлением в базу нового партнера
// Block with the addition of a new partner base
if (isset($_POST['submit_new_user']) && ($user_tip=='70' or $user_tip=='80' or $user_tip=='60'))
	{
	if (isset($_POST['email']) && $_POST['email']!='')
		{
		if (isset($_POST['password1']) && $_POST['password1']!='')
			{
			if (isset($_POST['password2']) && $_POST['password2']!='')
				{
				if (isset($_POST['active']) && $_POST['active']!='')
					{
					if (isset($_POST['tip']) && $_POST['tip']!='')
						{
						if ($_POST['password1']==$_POST['password2'])
							{
							$n_email = $mysqli -> real_escape_string(htmlspecialchars($_POST['email']));
							$n_password = $mysqli -> real_escape_string(htmlspecialchars(md5(md5($_POST['password1']))));
							$n_active = $mysqli -> real_escape_string(htmlspecialchars($_POST['active']));
							$n_tip = $mysqli -> real_escape_string(htmlspecialchars($_POST['tip']));
							$request= "SELECT id FROM users WHERE `email`='$n_email'";
							$result=$mysqli->query($request);



							if (mysqli_num_rows($result) > 0)
								{
								header('location: ./adduser.php?xtext=7');
								exit;
								}
								else
								{
								$apikey=md5(microtime(1));
								$request= "INSERT INTO users (`email`,`password`,`active`,`tip`,`apikey`) VALUES ('$n_email','$n_password','$n_active','$n_tip', '$apikey')";
								$result=$mysqli->query($request);
								header('location: ./adduser.php?xtext=8');
								exit;
								}
							} else {header('location: ./adduser.php?xtext=6'); exit;}
						} else {header('location: ./adduser.php?xtext=5'); exit;}
					} else {header('location: ./adduser.php?xtext=4'); exit;}
				} else {header('location: ./adduser.php?xtext=3'); exit;}
			} else {header('location: ./adduser.php?xtext=2'); exit;}
		} else {header('location: ./adduser.php?xtext=1'); exit;}
	}

?>
