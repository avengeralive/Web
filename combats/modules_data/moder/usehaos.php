<?
if(!defined('GAME'))
{
	die();
}
if($p['haos']==1)
{
	$tm = (int)$_POST['time'];
	$tmban = array(3=>'трое суток',7=>'одна неделя',14=>'две недели',30=>'один месяц',60=>'два месяца',1=>'бессрочно');
	if($tm!=3 && $tm!=7 && $tm!=14 && $tm!=30 && $tm!=60 && ($tm!=1 || ($p['haosInf']==0 && $tm==1)))
	{
		$uer = 'Неверно указано время наказания';
	}else{
		$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));

		if(isset($uu['id']))
		{
            $align1 = array_search($u->info['align'], $c['aligns'][floor($u->info['align'])]);
			$align2 = array_search($uu['align'], $c['aligns'][floor($uu['align'])]);

			if($uu['align']==2)
			{
				$uer = 'Персонаж был ранее отправлен в хаос';
			}elseif($uu['admin']>0 && $u->info['admin']==0)
			{
				$uer = 'Вы не можете отправлять Ангелов в хаос';
			}elseif($align1 < $align2 && $u->info['align']!=1.6 && $u->info['admin']==0)
			{
				$uer = 'Вы не можете отправлять в хаос старших по званию';
			}elseif($uu['id']==$u->info['id'] && $u->info['admin']==0){
				$uer = 'Вы не можете отправлять в хаос самого себя';
			}else{
				$th = time()+($tm*24*60*60);
				if($tm==1)
				{
					$th = 1;
				}
				$uu['palpro'] = time()-1;
				$upd = mysql_query('UPDATE `users` SET `align` = "2",`palpro` = "'.$uu['palpro'].'",`clan` = "0",`haos` = "'.mysql_real_escape_string($th).'" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
				if($upd)
				{
					$sx = ($u->info['sex']==1 ? 'а' : '');

					mysql_query('UPDATE `users_delo` SET `hb` = "0" WHERE `uid` = "'.$uu['id'].'" AND `hb`!="0"');
					$rtxt = '[img[items/pal_button4.gif]] '.$rang.' &quot;'.$u->info['cast_login'].'&quot; отправил'.$sx.' персонажа &quot;'.$uu['login'].'&quot; в хаос на срок: '.$tmban[$tm].'';
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");				
					$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; отправил'.$sx.' в &quot;<b>хаос</b>&quot; на срок: '.$tmban[$tm].'.';
					mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					$uer = 'Вы успешно отправили персонажа "'.$uu['login'].'" в хаос на срок: '.$tmban[$tm].'.';

                    //Ачивка
					$ar = mysql_fetch_array(mysql_query('SELECT `id` FROM `achiev` WHERE `uid` = "'.$uu['id'].'" LIMIT 1'));
					if(!isset($ar['id'])) mysql_query('INSERT INTO `achiev` (`uid`) VALUES ("'.$uu['id'].'")');
					mysql_query('UPDATE `achiev` SET `a22` = `a22` + "'.$tm.'" WHERE `uid` = "'.$uu['id'].'" LIMIT 1');
				}else{
					$uer = 'Не удалось использовать данное заклятие';
				}
			}
		}else{
			$uer = 'Персонаж не найден в этом городе';
		}
	}
}else{
	$uer = 'У Вас нет прав на использование данного заклятия';
}	
?>