<?
if(!defined('GAME'))
{
	die();
}
if($p['deletInfo']==1)
{
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
		elseif($uu['info_delete']==1 || $uu['info_delete']>time())
		{
			$upd = mysql_query('UPDATE `users` SET `info_delete` = 0 WHERE `id` = "'.$uu['id'].'" LIMIT 1');

			$sx = ($u->info['sex']==1 ? 'а' : '');
			$rtxt = '[img[items/uncui.gif]] '.$rang.' &quot;'.$u->info['cast_login'].'&quot; сн€л'.$sx.' закл€тие обезличивание с персонажа &quot;'.$uu['login'].'&quot;';
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");
			$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; сн€л'.$sx.' закл€тие &quot;<b>обезличивание</b>&quot;.';
			mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
			$uer = '¬ы успешно сн€ли закл€тие обезличивани€ с персонажа "'.$uu['login'].'".<br>';

		}else{
			$uer = 'ѕерсонаж не обезличен';
		}
	}else{
		$uer = 'ѕерсонаж не найден';
	}
}else{
	$uer = '” ¬ас нет прав на использование данного закл€ти€';
}	
?>