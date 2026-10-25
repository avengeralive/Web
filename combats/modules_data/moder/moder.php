<?
if(!defined('GAME'))
{
	die();
}

if($p['priemIskl']==1)
{
	$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));
	if(isset($uu['id']))
	{
		if($uu['align'] != 0 && ((floor($uu['align'])==3 && !in_array($uu['align'], array(3.01,3.05,3.06,3.07,3.075,3.09,3.091,3.092,6.700)))
		|| (floor($uu['align'])==1 && !in_array($uu['align'], array(1.1,1.5,1.6,1.7,1.75,1.9,1.91,1.99,6.600)))) )// && $uu['clan']!=$u->info['clan'] ($uu['align']<=1 || $uu['align']>=2)
		{
			$uer = 'Персонаж находится в клане или у него уже есть склонность';
		}else{
			if( $a == 1 ) {
				$nalign = 1.1;
				if($_POST['zvanie']==1.4)
				{
					$nalign = 1.4;
				}elseif($_POST['zvanie']==1.5)
				{
					$nalign = 1.5;
				}elseif($_POST['zvanie']==1.81)
				{
					$nalign = 1.81;
				}elseif($_POST['zvanie']==1.6)
				{
					$nalign = 1.6;
				}elseif($_POST['zvanie']==1.7)
				{
					$nalign = 1.7;
				}elseif($_POST['zvanie']==1.75)
				{
					$nalign = 1.75;
				}elseif($_POST['zvanie']==1.9)
				{
					$nalign = 1.9;
				}elseif($_POST['zvanie']==1.91)
				{
					$nalign = 1.91;
				}elseif($_POST['zvanie']==1.92)
				{
					$nalign = 1.92;
				}
			}elseif( $a == 3 ) {
				$nalign = 3.01;
				if($_POST['zvanie']==3.05)
				{
					$nalign = 3.05;
				}elseif($_POST['zvanie']==3.81)
				{
					$nalign = 3.81;
				}elseif($_POST['zvanie']==3.06)
				{
					$nalign = 3.06;
				}elseif($_POST['zvanie']==3.07)
				{
					$nalign = 3.07;
				}elseif($_POST['zvanie']==3.075)
				{
					$nalign = 3.075;
				}elseif($_POST['zvanie']==3.09)
				{
					$nalign = 3.09;
				}elseif($_POST['zvanie']==3.091)
				{
					$nalign = 3.091;
				}
			}
			
			if( $nalign > 0 )
			{
				$upd = mysql_query('UPDATE `users` SET `align` = "'.$nalign.'" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
				if($upd && $nalign!=$uu['align'])
				{
					$sx = '';
					if($u->info['sex']==1)
					{
						$sx = 'а';
					}
					mysql_query('UPDATE `users_delo` SET `hb` = "0" WHERE `uid` = "'.$uu['id'].'" AND `hb`!="0"');
					if( $a == 1 ) {
						$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; принял'.$sx.' персонажа в Паладинский орден (align'.$nalign.').';
					}elseif( $a == 3 ) {
						$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; принял'.$sx.' персонажа в Армаду Тьмы (align'.$nalign.').';	
					}
					mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					if($uu['align']>$nalign)
					{
						$uer = 'Вы успешно понизили звание персонажа "'.$uu['login'].'".<br>';
					}elseif($uu['align']<$nalign && $uu['align']>0)
					{
						$uer = 'Вы успешно повысили звание персонажа "'.$uu['login'].'".<br>';
					}else{
						if( $a == 1 ) {
							$uer = 'Вы успешно приняли персонажа "'.$uu['login'].'" в Паладинский орден.<br>';
						}elseif( $a == 3 ) {
							$uer = 'Вы успешно приняли персонажа "'.$uu['login'].'" в Армаду Тьмы.<br>';
						}
					}
				}else{
					if($nalign!=$uu['align']) $uer = 'Не удалось принять персонажа в ОС';
					else $uer = 'Персонаж уже имеет такую склонность';
				}
			}else{
				$uer = 'Склонность не существует...';
			}
		}
	}else{
		$uer = 'Персонаж не найден в этом городе';
	}
}else{
	$uer = 'У Вас нет прав на использование данного заклятия';
}	
?>