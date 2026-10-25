
<?php
// Блок с добавлением нового редиректа в базу
// Block with the addition of a new redirect to the database
if (isset($_POST['submit_redirect']) && $user_tip=='70')
	{
	if (isset($_POST['description']) && $_POST['description']!='')
		{
		if (isset($_POST['page']))
			{		
			if (isset($_POST['referer']))
				{
				if (isset($_POST['ip']))
					{
					if (isset($_POST['platform']) && $_POST['platform']!='')
						{
						if (isset($_POST['useragent']))
							{
							if (isset($_POST['country']) && $_POST['country']!='')
								{
								if (isset($_POST['destination']) && $_POST['destination']!='')
									{
									$system_tds_description=htmlentities($_POST['description']);
									$system_tds_page=htmlentities($_POST['page']);
									$system_tds_referer=htmlentities($_POST['referer']);
									$system_tds_ip=htmlentities($_POST['ip']);
									$system_tds_platform=htmlentities($_POST['platform']);
									$system_tds_useragent=htmlentities($_POST['useragent']);
									$system_tds_country=htmlentities($_POST['country']);
									$system_tds_destination=htmlentities($_POST['destination']);

									$request= "SELECT COUNT('id') as kolvo FROM `system_tds`";
									$result=$mysqli->query($request);
									$r = mysqli_fetch_assoc($result);
									if ($r['kolvo']<=9)
										{
										$request= "INSERT INTO `system_tds`(`description`,`page`,`referer`,`ip`,`platform`,`useragent`,`country`,`destination`) VALUES ('$system_tds_description','$system_tds_page','$system_tds_referer','$system_tds_ip','$system_tds_platform','$system_tds_useragent','$system_tds_country','$system_tds_destination')";
										$result=$mysqli->query($request);
										header('location:' . $_SERVER['PHP_SELF']);
										exit;
										}
									else
										{
										echo '<font color=red>'.$loc['system_tds.php']['t40'].'</font>';
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}

// Блок с удалением источника из базы
// Block removing the redirect from the database
if (isset($_GET['delete']) && $_GET['delete']!='' && $user_tip=='70')
	{
	$id=htmlentities($_GET['delete']);
	$sql = "SELECT * FROM system_tds WHERE `id`='$id'";
	$result = $mysqli->query($sql);
	if (mysqli_num_rows($result) > 0) 
		{
		$request = "DELETE from system_tds WHERE `id`='$id'";
		$result = $mysqli->query($request);
		header('location:' . $_SERVER['PHP_SELF']);
		exit;
		} 
	}
	
?>
