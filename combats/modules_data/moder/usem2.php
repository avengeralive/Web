<?
if(!defined('GAME'))
{
	die();
}
if($p['m2']==1 || $p['citym2']==1)
{
	$tm = (int)$_POST['time'];
	if($tm!=30 && $tm!=60 && $tm!=180 && $tm!=360 && $tm!=720 && $tm!=1440 && $tm!=4320 && $tm!=10080 && $tm!=43200)
	{
		$uer = 'Ќеверно указано врем€ наказани€';
	}else{
		$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));
		if(isset($uu['id']))
		{
			$align1 = array_search($u->info['align'], $c['aligns'][floor($u->info['align'])]);
			$align2 = array_search($uu['align'], $c['aligns'][floor($uu['align'])]);

			if($uu['admin']>0 && $u->info['admin']==0)
			{
				$uer = '¬ы не можете накладывать закл€тие форумного молчани€ на јнгелов';
			}elseif($align1 < $align2 && $u->info['align']!=1.6 && $u->info['admin']==0)
			{
				$uer = '¬ы не можете накладывать закл€тие форумного молчани€ на старших по званию';
			}elseif($uu['id']==$u->info['id'] && $u->info['admin']==0){
				$uer = '¬ы не можете накладывать закл€тие форумного молчани€ на самого себ€';
			}else{
				$upd = mysql_query('UPDATE `users` SET `molch2` = "'.mysql_real_escape_string(time()+round($tm)*60).'" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
				if($upd)
				{
					$sx = ($u->info['sex']==1 ? 'а' : '');

					$rtxt = '[img[items/sleepf.gif]] '.$rang.' &quot;'.$u->info['cast_login'].'&quot; наложил'.$sx.' закл€тие форумного молчани€ на &quot;'.$uu['login'].'&quot;, сроком '.$srok[$tm].'';
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");				
					$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; наложил'.$sx.' закл€тие &quot;<b>форумного молчани€</b>&quot; сроком '.$srok[$tm].'.';
					mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					$uer = '¬ы успешно наложили закл€тие форумного молчани€ на персонажа "'.$uu['login'].'", сроком '.$srok[$tm].'.';

                    //јчивка
					$ar = mysql_fetch_array(mysql_query('SELECT `id` FROM `achiev` WHERE `uid` = "'.$uu['id'].'" LIMIT 1'));
					if(!isset($ar['id'])) mysql_query('INSERT INTO `achiev` (`uid`) VALUES ("'.$uu['id'].'")');
					mysql_query('UPDATE `achiev` SET `a21` = `a21` + 1 WHERE `uid` = "'.$uu['id'].'" LIMIT 1');
				}else{
					$uer = 'Ќе удалось использовать данное закл€тие';
				}
			}
		}else{
			$uer = 'ѕерсонаж не найден';
		}
	}
}else{
	$uer = '” ¬ас нет прав на использование данного закл€ти€';
}	
?>