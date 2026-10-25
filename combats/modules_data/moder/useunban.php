<?
if(!defined('GAME'))
{
	die();
}
if($p['unbanned']==1)
{
	$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));
	if(isset($uu['id']))
	{
      	$align1 = array_search($u->info['align'], $c['aligns'][floor($u->info['align'])]);
		$align2 = array_search($uu['align'], $c['aligns'][floor($uu['align'])]);

		if($uu['admin']>0 && $u->info['admin']==0)
		{
			$uer = 'Вы не можете снять заклятие с Ангела.';
		}
		elseif($align1 < $align2 && $u->info['align']!=1.6 && $u->info['admin']==0)
		{
			$uer = 'Вы снять заклятие со старших по званию';
		}elseif($uu['id']==$u->info['id'] && $u->info['admin']==0){
			$uer = 'Вы снять заклятие с самого себя';
		}else{
				$upd = mysql_query('UPDATE `users` SET `banned` = "0" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
				if($upd)
				{
					if($uu['banned']>0)
					{
		                $sx = ($u->info['sex']==1 ? 'а' : '');
						mysql_query('UPDATE `users_delo` SET `hb` = "0" WHERE `uid` = "'.$uu['id'].'" AND `hb`!="0"');
						$rtxt = '[img[items/pal_button7.gif]] '.$rang.' &quot;'.$u->info['cast_login'].'&quot; снял'.$sx.' заклятие смерти с &quot;'.$uu['login'].'&quot;';
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");
						$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; снял'.$sx.' заклятие &quot;<b>смерти</b>&quot;.';
						mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
						$uer = 'Вы успешно сняли заклятие смерти с персонажа "'.$uu['login'].'".<br>';
					}else{
						$uer = 'Персонаж не заблокирован';
					}
				}else{
					$uer = 'Не удалось использовать данное заклятие';
				}
		}
	}else{
		$uer = 'Персонаж не найден';
	}
}else{
	$uer = 'У Вас нет прав на использование данного заклятия';
}	
?>