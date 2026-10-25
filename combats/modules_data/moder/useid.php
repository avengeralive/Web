<?
if(!defined('GAME'))
{
	die();
}

if($u->info['admin']>0)
{
		$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_POST['idgo']).'" LIMIT 1'));
		$uu2 = mysql_fetch_array(mysql_query('SELECT `id` from `users` where `id`="'.mysql_real_escape_string($_POST['idgo2']).'" LIMIT 1'));

		if(isset($uu['id']))
		{
            if(isset($uu2['id']))
			{
				$uer = 'ID '.$_POST['idgo'].' уже занят, выберите другой.';
			}
			elseif($uu['battle']>0)
			{
				$uer = 'Персонаж находится в поединке.<br>';
			}else{
				    $uer = 'В разработке';
				}
				
		}else{
			$uer = 'Персонаж не найден';
		}
}else{
	$uer = 'У Вас нет прав на использование данного заклятия';
}	
?>