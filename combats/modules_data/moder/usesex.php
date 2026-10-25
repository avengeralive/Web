<?
if(!defined('GAME'))
{
	die();
}

if($u->info['admin']>0)
{
		$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));
		if(isset($uu['id']))
		{
			if($uu['align']>1 && $uu['align']<2 && $u->info['admin']==0)
			{
				$uer = 'Вы не можете сменить пол у Паладинов.<br>';
			}elseif($uu['align']>3 && $uu['align']<4 && $u->info['admin']==0)
			{
				$uer = 'Вы не можете сменить пол у Тарманов.<br>';
			}elseif($uu['admin']>0 && $u->info['admin']==0)
			{
				$uer = 'Вы не можете сменить пол у Ангелов';
			}elseif($uu['id']==$u->info['id'] && $u->info['admin']==0){
				$uer = 'Вы не можете сменить пол самому себе';
			}else{
				$usx = array(0=>1,1=>0,'0-0'=>'мужской','0-1'=>'женский');
				$uu['sex'] = $usx[$uu['sex']];
				$upd = mysql_query('UPDATE `users` SET `obraz` = "0.gif",`sex` = "'.$uu['sex'].'" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
				if($upd)
				{
					$sx = ($u->info['sex']==1 ? 'а' : '');
					$rtxt = '[img[items/male.png]] '.$rang.' &quot;'.$u->info['cast_login'].'&quot; сменил'.$sx.' пол персонажа &quot;'.$uu['login'].'&quot; на '.$usx['0-'.$uu['sex']].'';
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");				
					$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; сменил'.$sx.' пол сперсонажа на '.$usx['0-'.$uu['sex']].'.';
					mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					$uer = 'Вы успешно сменили пол персонажа "'.$uu['login'].'" на '.$usx['0-'.$uu['sex']].'.';
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