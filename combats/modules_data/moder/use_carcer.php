<?
if(!defined('GAME'))
{
	die();
}
if($p['zatoch']==1 || $p['citym1']==1)
{
	$tm = (int)$_POST['time'];
	if($tm!=1 && $tm!=3 && $tm!=7 && $tm!=14 && $tm!=30 && $tm!=60 && $tm!=365 && $tm!=24 && $tm!=6)
	{
		$uer = 'Неверно указано время наказания';
	}else{
		$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));
		if(isset($uu['id']))
		{
			//$uuss = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `id` = "'.mysql_real_escape_string($uu['id']).'" LIMIT 1'));

			$align1 = array_search($u->info['align'], $c['aligns'][floor($u->info['align'])]);
			$align2 = array_search($uu['align'], $c['aligns'][floor($uu['align'])]);

			if($uu['admin']>0 && $u->info['admin']==0)
			{
				$uer = 'Вы не можете посадить Ангела.';
			}
			elseif($align1 < $align2 && $u->info['align']!=1.6 && $u->info['admin']==0)
			{
				$uer = 'Вы не можете посадить старших по званию';
			}elseif($uu['id']==$u->info['id'] && $u->info['admin']==0){
				$uer = 'Вы не можете посадить самого себя';
			}else{
                    if($tm==6) $time=time()+60*60;
					elseif($tm==24) $time=time()+(60*60*24*30*90);
					else $time=time()+(60*60*24*$tm);

					$upd = mysql_query('UPDATE `users` SET `jail` = "'.mysql_real_escape_string($time).'", `room`="274", `city`="capitalcity" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
					if($upd)
					{
						$sx = ($u->info['sex']==1 ? 'а' : '');
						mysql_query('UPDATE `items_users` SET `delete` = "1357908642" WHERE `uid` = '.$uu['id'].' AND `delete` = 0');
						$rtxt = '[img[items/jail.gif]] '.$rang.' &quot;'.$u->info['cast_login'].'&quot; отправил'.$sx.' в заточение &quot;'.$uu['login'].'&quot;, сроком '.$srokt[$tm].'';
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");
						$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; отправил'.$sx.' в &quot;<b>заточение</b>&quot; сроком '.$srokt[$tm].'.';
						mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',6)");
						$uer = 'Вы успешно посадили в тюрьму персонажа "'.$uu['login'].'", сроком '.$srokt[$tm].'.';
					}else{
						$uer = 'Не удалось использовать данное заклятие';
					}
			}
		}else{
			$uer = 'Персонаж не найден';
		}
	}
}else{
	$uer = 'У Вас нет прав на использование данного заклятия';
}	
?>