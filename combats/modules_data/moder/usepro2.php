<?
if(!defined('GAME'))
{
	die();
}
if($p['proverka']==1)
{
		$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" ORDER BY `id` ASC LIMIT 1'));
		if(isset($uu['id']))
		{
            $align1 = array_search($u->info['align'], $c['aligns'][floor($u->info['align'])]);
			$align2 = array_search($uu['align'], $c['aligns'][floor($uu['align'])]);

			if($uu['palpro']<time())
			{
				$uer = 'ѕерсонаж нет проверки на чистоту';
			}elseif($align1 < $align2 && $u->info['align']!=1.6 && $u->info['admin']==0)
			{
				$uer = '¬ы не можете снимать проверку со старших по званию';
			}elseif($uu['admin']>0 && $u->info['admin']==0)
			{
				$uer = '¬ы не можете снимать проверку с јнгелов';
			}elseif($uu['id']==$u->info['id'] && $u->info['admin']==0){
				$uer = '¬ы не можете снимать проверку самому себе';
			}else{
				$uu['palpro'] = time()-1;
				$upd = mysql_query('UPDATE `users` SET `palpro` = "'.$uu['palpro'].'" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
				if($upd)
				{
					$sx = ($u->info['sex']==1 ? 'а' : '');

					$rtxt = '[img[items/pal_buttont.gif]] '.$rang.' &quot;'.$u->info['cast_login'].'&quot; сн€л'.$sx.' проверку на чистоту персонажу &quot;'.$uu['login'].'&quot;';
					//mysql_query("UPDATE `chat` SET `delete` = 1 WHERE `login` = '".$uu['login']."' LIMIT 1000");
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");				
					$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; сн€л'.$sx.' проверку на чистоту';
					mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					$uer = '¬ы успешно сн€ли пометку о чистоте персонажа "'.$uu['login'].'".';
				}else{
					$uer = 'Ќе удалось использовать данное закл€тие';
				}
			}
		}else{
			$uer = 'ѕерсонаж не найден в этом городе';
		}
}else{
	$uer = '” ¬ас нет прав на использование данного закл€ти€';
}	
?>