<?
if(!defined('GAME'))
{
	die();
}

if($p['useunalign']==1)
{
		$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));
		if(isset($uu['id']))
		{
            $align1 = array_search($u->info['align'], $c['aligns'][floor($u->info['align'])]);
			$align2 = array_search($uu['align'], $c['aligns'][floor($uu['align'])]);

			if($uu['admin']>0 && $u->info['admin']==0)
			{
				$uer = '¬ы не можете сн€ть склонность с јнгелов';
			}elseif($align1 < $align2 && $u->info['align']!=1.6 && $u->info['admin']==0)
			{
				$uer = '¬ы не можете сн€ть склонность со старших по званию';
			}elseif($uu['id']==$u->info['id'] && $u->info['admin']==0){
				$uer = '¬ы не можете сн€ть склонность с самого себ€';
			}else{
				 	mysql_query('UPDATE `users` SET `align` = "0",`clan` = "0" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
					$u->deleteAlign( $uu['align'] , $uu['id'] );
					
                    $sx = ($u->info['sex']==1 ? 'а' : '');
					$rtxt = '[img[items/palbuttondarkhc1.gif]] '.$rang.' &quot;'.$u->info['cast_login'].'&quot; сн€л'.$sx.' склонность&frasl;клан с персонажа &quot;'.$uu['login'].'&quot;';
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");				
					$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; сн€л'.$sx.' склонность с персонажа.';
					mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					$uer = '¬ы успешно сн€ли склонность с персонажа "'.$uu['login'].'".';
			}
		}else{
			$uer = 'ѕерсонаж не найден';
		}
}else{
	$uer = '” ¬ас нет прав на использование данного закл€ти€';
}	
?>