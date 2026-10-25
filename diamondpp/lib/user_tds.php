
<?php
// Блок с добавлением нового редиректа в базу
// Block with the addition of a new redirect to the database
if (isset($_POST['submit_redirect']) && ($user_tip=='10' || $user_tip=='80'))
	{
	if (isset($_POST['description']) && $_POST['description']!='')
		{
		if ((isset($_POST['offer_id']) && $_POST['offer_id']>0) && (isset($_POST['offer_dest_id']) && $_POST['offer_dest_id']>0))
			{	
			$user_tds_offer_id=htmlentities($_POST['offer_id']);
			$user_tds_offer_dest_id=htmlentities($_POST['offer_dest_id']);
			}
		else 
			{
			$user_tds_offer_id=0;
			$user_tds_offer_dest_id=0;
			}
		if ((isset($_POST['landing_id']) && $_POST['landing_id']>0) && (isset($_POST['landing_dest_id']) && $_POST['landing_dest_id']>0))
			{	
			$user_tds_landing_id=htmlentities($_POST['landing_id']);
			$user_tds_landing_dest_id=htmlentities($_POST['landing_dest_id']);
			}
		else 
			{
			$user_tds_landing_id=0;
			$user_tds_landing_dest_id=0;
			}
			
		// Если были переданы все ID офферов и лендингов для составления правил редиректа, то только в этом случае выполняем то что идет дальше
		// If all ID offers and landing for drawing up the rules redirect been transferred, it is only in this case, carry out what is going on
		if ($user_tds_offer_id>0 && $user_tds_offer_dest_id>0 && $user_tds_landing_id>0 && $user_tds_landing_dest_id>0)
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
								$user_tds_description=htmlentities($_POST['description']);
								$user_tds_referer=htmlentities($_POST['referer']);
								$user_tds_ip=htmlentities($_POST['ip']);
								$user_tds_platform=htmlentities($_POST['platform']);
								$user_tds_useragent=htmlentities($_POST['useragent']);
								$user_tds_country=htmlentities($_POST['country']);

								$request= "SELECT COUNT('id') as kolvo FROM `user_tds` WHERE `user_id`='$user_id'";
								$result=$mysqli->query($request);
								$r = mysqli_fetch_assoc($result);
								if ($r['kolvo']<=9)
									{
									$request= "INSERT INTO `user_tds`(`user_id`,`description`,`offer_id`,`landing_id`,`referer`,`ip`,`platform`,`useragent`,`country`,`offer_dest_id`,`landing_dest_id`) VALUES ('$user_id','$user_tds_description','$user_tds_offer_id','$user_tds_landing_id','$user_tds_referer','$user_tds_ip','$user_tds_platform','$user_tds_useragent','$user_tds_country','$user_tds_offer_dest_id','$user_tds_landing_dest_id')";
									$result=$mysqli->query($request);
									header('location:' . $_SERVER['PHP_SELF']);
									exit;
									}
								else
									{
									echo '<font color=red>'.$loc['user_tds.php']['t44'].'</font>';
									}
								}
							}
						}
					}
				}
			}
		}
	}

// Блок с удалением редиректа из базы
// Block removing the redirect from the database
if (isset($_GET['delete']) && $_GET['delete']!='' && ($user_tip=='10' || $user_tip=='80'))
	{
	$id=htmlentities($_GET['delete']);
	$sql = "SELECT * FROM user_tds WHERE `id`='$id' AND `user_id`='$user_id'";
	$result = $mysqli->query($sql);
	if (mysqli_num_rows($result) > 0) 
		{
		$request = "DELETE from user_tds WHERE `id`='$id' AND `user_id`='$user_id'";
		$result = $mysqli->query($request);
		header('location:' . $_SERVER['PHP_SELF']);
		exit;
		} 
	}
	
?>
