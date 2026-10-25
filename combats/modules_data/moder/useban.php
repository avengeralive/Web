<?
if(!defined('GAME')) die();

if($p['banned']==1 || $p['ban0']==1)
{
		$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));
		if(isset($uu['id']))
		{
            $align1 = array_search($u->info['align'], $c['aligns'][floor($u->info['align'])]);
			$align2 = array_search($uu['align'], $c['aligns'][floor($uu['align'])]);

			if($uu['banned']>0)
			{
				$uer = 'ѕерсонаж был заблокирован ранее';
			}elseif($uu['admin']>0 && $u->info['admin']==0)
			{
				$uer = '¬ы не можете накладывать закл€тие смерти на јнгелов';
			}elseif($align1<$align2 && $u->info['align']!=1.6 && $u->info['admin']==0)
			{
				$uer = '¬ы не можете накладывать закл€тие смерти на старших по званию';
			}elseif($uu['id']==$u->info['id'] && $u->info['admin']==0){
				$uer = '¬ы не можете накладывать закл€тие смерти на самого себ€';
			}else{
				$upd = mysql_query('UPDATE `users` SET `banned` = "'.time().'" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
				if($upd)
				{
					$sx = ($u->info['sex']==1 ? 'а' : '');

					$rtxt = '[img[items/pal_button6.gif]] '.$rang.' &quot;'.$u->info['cast_login'].'&quot; наложил'.$sx.' закл€тие смерти на &quot;'.$uu['login'].'&quot;';
					mysql_query("UPDATE `chat` SET `delete` = 1 WHERE `login` = '".$uu['login']."' LIMIT 1000");
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");				
					$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; наложил'.$sx.' закл€тие &quot;<b>смерти</b>&quot;.';
					mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					$uer = '¬ы успешно наложили закл€тие смерти на персонажа "'.$uu['login'].'".';
				}else{
					$uer = 'Ќе удалось использовать данное закл€тие';
				}
			}
		}else{
			$uer = 'ѕерсонаж не найден';
		}
}else{
	$uer = '” ¬ас нет прав на использование данного закл€ти€';
}	
?>