<?
if(!defined('GAME'))
{
	die();
}
if($p['deletInfo']==1)
{
	$tm = (int)$_POST['time'];
	if($tm!=1 && $tm!=7 && $tm!=14 && $tm!=30 && $tm!=60)
	{
		$uer = 'Ќеверно указаны данные';
	}else{
		$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));
		if(isset($uu['id']))
		{
            $align1 = array_search($u->info['align'], $c['aligns'][floor($u->info['align'])]);
			$align2 = array_search($uu['align'], $c['aligns'][floor($uu['align'])]);

			if($uu['admin']>0 && $u->info['admin']==0)
			{
				$uer = '¬ы не можете использовать данное закл€тие на јнгелов.<br>';
			}elseif($align1 < $align2 && $u->info['align']!=1.6 && $u->info['admin']==0)
			{
				$uer = '¬ы не можете использовать закл€тие на старших по званию';
			}
			elseif($uu['info_delete']!=1 && $uu['info_delete']<time())
			{
				$srok = array(
					1=>'бессрочно',
					7=>'недел€',
					14=>'две недели',
					30=>'мес€ц',
					60=>'два мес€ца'
				);
				$srok = $srok[$tm];
				if($tm==1)
				{
					$tm = '`info_delete` = "1"';
				}elseif($tm==7)
				{
					$tm = '`info_delete` = "'.(time()+7*86400).'"';
				}elseif($tm==14)
				{
					$tm = '`info_delete` = "'.(time()+14*86400).'"';
				}elseif($tm==30)
				{
					$tm = '`info_delete` = "'.(time()+30*86400).'"';
				}elseif($tm==60)
				{
					$tm = '`info_delete` = "'.(time()+60*86400).'"';
				}

				$upd = mysql_query('UPDATE `users` SET '.$tm.' WHERE `id` = "'.$uu['id'].'" LIMIT 1');
				if($upd)
				{
					$sx = ($u->info['sex']==1 ? 'а' : '');
					$rtxt = '[img[items/cui.gif]] '.$rang.' &quot;'.$u->info['cast_login'].'&quot; использовал'.$sx.' закл€тие обезличивание на &quot;'.$uu['login'].'&quot; сроком '.$srok;
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES ('".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");				
					$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; использовал'.$sx.' закл€тие &quot;<b>обезличивание</b>&quot;, сроком '.$srok.'.';
					mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					$uer = '¬ы успешно использовали закл€тие обезличивани€ на персонажа "'.$uu['login'].'".<br>';
				}else{
					$uer = 'Ќе удалось использовать данное закл€тие';
				}
			}else{
				$uer = 'ѕерсонаж уже обезличен';
			}
		}else{
			$uer = 'ѕерсонаж не найден';
		}
	}
}else{
	$uer = '” ¬ас нет прав на использование данного закл€ти€';
}	
?>