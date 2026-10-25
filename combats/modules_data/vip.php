<?
if(!defined('GAME') || ($u->info['vip']==2 && $u->info['vip']==3))
{
	die();
}
if(isset($_GET['hpAllkol'])){
	$u->error = 'Вы успешно восстановили HP';
}
if(isset($_GET['mpAllkol'])){
	$u->error = 'Вы успешно восстановили MP';
}
if( isset($_GET['1'])) {
				$p = 0.5;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(8506,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.5;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['2'])) {
				$p = 0.5;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(8507,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.5;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['3'])) {
				$p = 0.5;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(2146,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.5;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['4'])) {
				$p = 0.5;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(2147,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.5;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['5'])) {
				$p = 0.5;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(2148,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.5;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['6'])) {
				$p = 0.5;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(2149,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.5;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['7'])) {
				$p = 0.5;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(2150,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.5;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['8'])) {
				$p = 0.5;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(2151,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.5;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['9'])) {
				$p = 0.5;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(2152,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.5;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['10'])) {
				$p = 0.5;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(2153,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.5;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['11'])) {
				$p = 0.5;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(8505,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.5;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['12'])) {
				$p = 0.30;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(8510,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.30;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['13'])) {
				$p = 0.30;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10043,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.30;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
			}elseif( isset($_GET['14'])) {
				$p = 0.30;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10050,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0.30;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
				}
	}
		}elseif( isset($_GET['44'])) {
				$p = 1500;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(8766,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 1500;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Вы использовали &quot;<b>Снадобье Забытых Богов</b>&quot;.</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99988'])) {
				$p = 12.95;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10170,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 12.95;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Вы использовали &quot;<b>Набор (Темной Власти)</b>&quot;.</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99987'])) {
				$p = 14.99;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10171,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 14.99;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Вы использовали &quot;<b>Набор (Темной Власти)</b>&quot;.</font></b><br>';
				}
			}
		
		}/* elseif( isset($_GET['99989'])) {
				$p = 24.95;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(4943,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 24.95;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					
				}
			}
		
		} */elseif( isset($_GET['99990'])) {
				$p = 12.95;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10169,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 12.95;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Вы использовали &quot;<b>Набор (Темной Власти)</b>&quot;.</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99991'])) {
				$p = 12.95;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10165,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 12.95;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Вы использовали &quot;<b>Набор (Темной Власти)</b>&quot;.</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99992'])) {
				$p = 12.95;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10166,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 12.95;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Вы использовали &quot;<b>Набор (Темной Власти)</b>&quot;.</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99993'])) {
				$p = 12.95;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10167,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 12.95;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Вы использовали &quot;<b>Набор (Темной Власти)</b>&quot;.</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99994'])) {
				$p = 12.95;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10168,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 12.95;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Вы использовали &quot;<b>Набор (Темной Власти)</b>&quot;.</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99995'])) {
				$p = 12.95;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10163,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 12.95;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Вы использовали &quot;<b>Набор (Темной Власти)</b>&quot;.</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99996'])) {
				$p = 12.95;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10162,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 12.95;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Вы использовали &quot;<b>Набор (Темной Власти)</b>&quot;.</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99999'])) {
				$p = 500;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(4938,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 500;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					echo '<font color=red><b>Редирект установлен!</font></b><br>';
				}
			}
		
		}/*elseif( isset($_GET['99997'])) {
				$p = 0;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10161,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					mysql_query('UPDATE `stats` SET `wipe` = "1" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					echo '<font color=red><b>Сброс статов и умений прошел успешно!</font></b><br>';
				}else{
					echo 'Что-то пошло не так, каст не сработал...';
				}
			}
		
		}*/elseif( isset($_GET['99998'])) {
				$p = 0;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10160,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 0;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					echo '<font color=red><b>Редирект удален!</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99980'])) {
				$p = 0;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10270,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 2.59;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Редирект удален!</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99979'])) {
				$p = 0;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10271,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 2.59;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Редирект удален!</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99978'])) {
				$p = 0;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10272,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 2.59;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Редирект удален!</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99977'])) {
				$p = 0;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10273,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 2.59;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Редирект удален!</font></b><br>';
				}
			}
		
		}elseif( isset($_GET['99976'])) {
				$p = 0;
				if($u->info['battle'] > 0) {
		echo '<font color=red><b>Вы в поединке!<br></font></b>';
	}elseif($u->info['money2'] < $p) {
		echo '<font color=red><b>Недостаточно денег :)<br></font></b>';
	}else{
				$additm = $u->addItem(10274,$u->info['id']);
				if( $additm > 0 ) {
					$u->info['money2'] -= 2.59;
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					Mysql_query('UPDATE `users` SET `money2` = "'.$u->info['money2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					//echo '<font color=red><b>Редирект удален!</font></b><br>';
				}
			}
		
		}

if($u->error!='')
{
	echo '<font style="color:red;font-size:8pt;"><b>'.$u->error.'</b></font><br>';
}
$vt = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$u->info['id'].'" AND `vip` > "0" LIMIT 1'));
if($vt['vip']==2) {
    $account = 'bronze';
}elseif($vt['vip']==3) {
    $account = 'gold';
}
$vu = array(0,0,0,0,0,0,0);
  $ability = array(
    "gold" => array(
	//Золотой VIP
	
	//Заклятия
	//array(4805,3,0,0,0,'|onlyOne=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Побег из боя
	array(4943,3,0,0,0,'|usefromfile=1|onlyOne=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Выход из боя
	array(4804,1,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Сфера Непро-ти
	array(2557,3,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Спасение
	array(10012,3,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Воскрешение
	array(4404,5,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Кулачное нападаение
	array(8511,5,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Нападение [VIP]
	array(8525,10,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Кровавое Нападение [VIP]
	array(8513,2,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Темное Нападение [VIP]
	array(10027,1,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Восстановление ХР
	array(10046,1,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Восстановление Маны 
	array(10240,1,0,0,0,'|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//ЛЕчение легких
	array(10241,1,0,0,0,'|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//ЛЕчение средни
	array(10242,1,0,0,0,'|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//ЛЕчение тяжа
	array(2390,1,0,0,0,'|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//ЛЕчение тяжа
	array(4759,5,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Снять Проклятье
	array(2412,3,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Пропуск забытых
	array(10184,3,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Пропуск Кроггейнтайла
	array(10243,1,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//ЛЕчение тяжа



	//Пироги
	//array(1033,40,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=43200|nosale=1',5),//Пыль
	//array(1034,40,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=43200|nosale=1',5),//Мухомор
	//array(1030,40,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=43200|nosale=1',5),//Отвар василька
	//array(1031,40,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=43200|nosale=1',5),//Отвар когтей
	
	
	
	//Эликсиры
	array(4514,1,0,0,0,'|onlyeOne=1|tr_lvl=8|frompisher=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),//Каменка
	array(4515,3,0,0,0,'|tr_lvl=8|onlyeOne=1|frompisher=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),//Стойкость
	array(4690,3,0,0,0,'|tr_lvl=8|onlyeOne=1|frompisher=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),//Голем
	array(4689,3,0,0,0,'|tr_lvl=8|onlyeOne=1|frompisher=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),//Смазка
	array(4688,3,0,0,0,'|tr_lvl=8|onlyeOne=1|frompisher=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),//Смазка
	array(4913,3,0,0,0,'|tr_lvl=8|onlyeOne=1|frompisher=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),//Эссенция Го
	
	
	
	
	//Еда
	array(5009,1,0,0,0,'|tr_lvl=8|onlyeOne=1|frompisher=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),//Рыба
	array(5010,1,0,0,0,'|tr_lvl=8|onlyeOne=1|frompisher=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),//Бутер
	array(5008,1,0,0,0,'|tr_lvl=8|onlyeOne=1|frompisher=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),//Смазка
	//array(5010,1,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Бутер
	//array(5009,1,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Рыба
	//array(5008,1,0,0,0,'|useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=10800|nosale=1',5),//Яблоко
	
	
	
	//array(8784,2,0,0,0,'useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=900|nosale=1',5),//Молчанка 30 [VIP]
    //array(8785,1,0,0,0,'useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=900|nosale=1',5),//Молчанка 60 [VIP]

	//array(2412,2,0,0,0,'tr_lvl=7|noremont=1|usefromfile=1|musor=1|battleUseZd=300|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),// Пропуск забытых
	//array(8504,3,0,0,0,'tr_lvl=7|nohaos=1|onlyOne=1|oneType=24|musor=2|noremont=1|sudba='.$u->info['login'].'|srok=900|nosale=1',5),//Звездное Сияние [VIP]
	//array(8505,3,0,0,0,'useOnLogin=1|onlyOne=1|oneType=33|tr_lvl=7|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=900|nosale=1',5),// ЖЖ 6 [VIP]
	//array(1,3,0,0,0,'useOnLogin=1|onlyOne=1|oneType=33|tr_lvl=7|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=900|nosale=1',5), //Холодный Разум [VIP]
	
	//array(2709,3,0,0,0,'tr_lvl=7|useOnLogin=1|musor=1|noremont=1|magic_hpNow=900|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),// Хилл 900 [VIP] 0/10
	//array(8506,3,0,0,0, 'useOnLogin=1|onlyOne=1|oneType=44|tr_lvl=7|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=900|nosale=1',5),// Сокра [VIP]
	//array(8507,3,0,0,0,'onlyOne=1|oneType=7|tr_lvl=7|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=900|nosale=1',5),// Защита от оружия [VIP]
	//array(8508,3,0,0,0,'tr_lvl=7|nohaos=1|onlyOne=1|oneType=24|musor=2|noremont=1|sudba='.$u->info['login'].'|srok=900|nosale=1',5),//Звездная Энергия [VIP]
	//array(8509,3,0,0,0,'tr_lvl=7|nohaos=1|onlyOne=1|oneType=24|musor=2|noremont=1|sudba='.$u->info['login'].'|srok=900|nosale=1',5),//Звездная Тяжесть [VIP]
	//array(4926,1,0,0,0,'tr_lvl=7|onlyOne=1|musor=2|noremont=1|oneType=53|sudba='.$u->info['login'].'|srok=900|nosale=1',5),//Сила Великана +50 [VIP]
	//array(4927,1,0,0,0,'tr_lvl=7|onlyOne=1|musor=2|noremont=1|oneType=53|sudba='.$u->info['login'].'|srok=900|nosale=1',5),//Скорость Змеи +50 [VIP]
	//array(4928,1,0,0,0,'tr_lvl=7|onlyOne=1|musor=2|noremont=1|oneType=53|sudba='.$u->info['login'].'|srok=900|nosale=1',5), // Предчувствие +50 [VIP]
	//array(4929,1,0,0,0,'tr_lvl=7|onlyOne=1|musor=2|noremont=1|oneType=53|sudba='.$u->info['login'].'|srok=900|nosale=1',5),// Ледяной Интеллект +50 [VIP]
	//array(4930,1,0,0,0,'tr_lvl=7|onlyOne=1|musor=2|noremont=1|oneType=53|sudba='.$u->info['login'].'|srok=900|nosale=1',5),// Мудрость Веков  [VIP]
	//array(8523,3,0,0,0,'tr_lvl=7|onlyOne=1|musor=2|noremont=1|oneType=71|sudba='.$u->info['login'].'|srok=900|nosale=1',5), // Защита от Магии [VIP]
	//array(8524,3,0,0,0,'tr_lvl=7|onlyOne=1|musor=2|noremont=1|oneType=72|sudba='.$u->info['login'].'|srok=900|nosale=1',5), // Магическое Усиление [VIP]
	
    )
);
/* $kolod = array(
			//колодец жизни
			array(5124,array(0,20000,50000),0,0,0),
			//колодец маны
			array(5125,array(0,20000,50000),0,0,1)
		); */

/* $vi = array(

); */
?>
<style>
.line {
    border-bottom-style: inset;
    border-bottom-width: 1px;
    border-collapse: separate;
    border-left-style: inset;
    border-left-width: 1px;
    border-right-style: inset;
    border-right-width: 1px;
    border-top-style: inset;
    border-top-width: 1px;
    color: rgb(0, 0, 0);
    display: block;
    font-family: Verdana, Arial, Helvetica, Tahoma, sans-serif;
    font-size: 9pt;
    font-style: normal;
    font-variant: normal;
    font-weight: normal;
    height: 1px;
    line-height: normal;
    text-align: start;
    white-space: normal;
    display: block;
-webkit-margin-before: 0.5em;
-webkit-margin-after: 0.5em;
-webkit-margin-start: auto;
-webkit-margin-end: auto;
border-style: inset;
border-width: 1px;
}

.cp {
	font-size: 8pt;
}
</style>
<table width="100%">
		
<table width="100%">
<tbody>
<tr nowrap="">
<td align="center"><h3>VIP Панель Персонажа <?=$u->info['login']?>!</h3>
				<b style="font-size: 7pt;">Текущие эффекты на персонаже:<b>
				<b style="font-size: 7pt;">Текущие эффекты на персонаже:<b><br>
				<?
				$eff = mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0');
				while($now  = mysql_fetch_array($eff)) {
					$ef = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "'.$now['id_eff'].'" LIMIT 1'));
					echo '<img width="30" src="//'.$c['img'].'/i/eff/'.$ef['img'].'">';
				}
				?>
				<br><hr class="line">
</td>
<td style="font-size:8pt;" width="200" align="right"><input type="button" value="Обновить" onclick="location='main.php?vip=1';" />
<input type="button" value="Вернуться" onclick="location='main.php';" /><br>
Кредиты: <b><?=$u->info['money']?> кр.</b><br>Еврокредиты:&nbsp;<b><?=$u->info['money2']?> екр.</b><br>
<? 
echo '<a onclick="if (confirm(\'Установить редирект: за 500 екр ?\')) {location.href=\'/main.php?vip&99999\'}" onMouseOver="top.hi(this,\'<b>Стоимость: 500 екр</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp">Установить редирект</a><br><a onclick="location.href=\'/main.php?vip&99998\';" onMouseOver="top.hi(this,\'<b>Бесплатно</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp">Удалить редирект</a><br><a onclick="if (confirm(\'Купить Свобода истинного хаоса: за 1500 екр ?\')) {location.href=\'/main.php?vip&44\'}" onMouseOver="top.hi(this,\'<b>Стоимость: 1500 екр</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp">Свобода истинного хаоса</a>';
?>
</td>
</tr>
</tbody>
</table>
	
    <tr>	
			<table>
			<tbody>
			<tr>
			<td align="left" style="width: 30%;font-size: 8pt;vertical-align:top;">
            <b style="font-size: 10.04pt;">Доступные предметы:</b><br><small>(Вы можете забрать предметы просто нажав на изображение,предметы со сроком годности.)</small><p>
                <?
                $i = 0; $seet = '';
                $vnr = array(0 => 'на сегодня',1 => ' всего');
                while($i < count($ability[$account])) {

    if($ability[$account][$i][1]>0) {
        $itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$ability[$account][$i][0].'" LIMIT 1'));
    if(isset($itm['id'])) {
        $vix = 0;
    if($ability[$account][$i][4] == 0) {
    //за сегодня
        $vix = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "vitm_'.$itm['id'].'"',2);
        $vix = $vix[0];
    }else{
    //всего за действие премиума
        $vix = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.$vt['timeUse'].' AND `vars` = "vitm_'.$itm['id'].'" ',2);
        $vix = $vix[0];
    }
    if($ability[$account][$i][1]-$vix > 0) {
    if(isset($_GET['take_item_vip']) && $_GET['take_item_vip'] == $itm['id']) {
    $nitm = $u->addItem($itm['id'],$u->info['id'],$ability[$account][$i][5]);
    if($ability[$account][6]>0) {
    }
        $u->addAction(time(),'vitm_'.$itm['id'],'');
        echo '<font color="red">Предмет &quot;<b>'.$itm['name'].'</b>&quot; перемещен к Вам в инвентарь!</font><br><br>';
    }
}

        $seet0 = '';
	//Вывод предметов вип
         $seet0 .= '<img '.$vix.' title="'.$itm['name'].'(Осталось '.$vnr[$ability[$i][4]].': '.($ability[$account][$i][1]-$vix).' шт.)" src="//'.$c['img'].'/i/items/'.$itm['img'].'"> <b style="font-size:8pt;vertical-align: 5px;">'.$itm['name'].'</b><br>';
    if($ability[$account][$i][1]-$vix > 0) {
        $seet0 = '<a href="main.php?vip=1&take_item_vip='.$itm['id'].'">'.$seet0.'</a>';
    }else{
        $seet0 = '<span style="filter: alpha(opacity=20); -moz-opacity: 0.20; -khtml-opacity: 0.20; opacity: 0.20;">'.$seet0.'</span>';
    }
        $seet .= $seet0;
    }
}
        $i++;
    }
			$i = 0;
			$typ = array(0 => 'HP',1 => 'MP');
			while($i < count($kolod)) {
				$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$kolod[$i][0].'" LIMIT 1'));
				if(isset($itm['id'])) {
					$vix2 = 0;
					if($kolod[$i][4] == 0) {
						//за сегодня
							$vix2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "hpKolodec_'.$u->info['id'].'" ',3);
							$vix2 = round($vix2[0]);
						if($kolod[$i][1][$u->info['vip']]-$vix2 > 0) {
							if(isset($_GET['take_item_vip']) && $_GET['take_item_vip'] == $itm['id']) {
								if($_GET['take_item_vip'] == 5124){
									if($u->stats['hpNow'] != $u->stats['hpAll']){
										$kolodec_hp = mysql_fetch_array(mysql_query('SELECT * FROM `kolodec` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "0"'));
										if($vix2 < $kolod[$i][1][$u->info['vip']]){
											if(!isset($kolodec_hp['id'])){
												$in_kol = mysql_query('INSERT INTO `kolodec` (`uid`,`time`,`type`) VALUES ("'.$u->info['id'].'","'.(time()+300).'","0")');
												if($in_kol){
													//$_SESSION['timestamp'] = time()+300;
													$hpV = $u->stats['hpAll'] - $u->stats['hpNow'];
													if(($hpV + $vix2) > $kolod[$i][1][$u->info['vip']]){
														$hpV = $kolod[$i][1][$u->info['vip']] - $vix2;
													}
													mysql_query('UPDATE `stats` SET `hpNow` =`hpNow` + "'.$hpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
													$u->addActionKol($u->info['id'], time(),'hpKolodec_'.$u->info['id'], $hpV);
													echo '<script>location.href="main.php?vip=1&hpAllkol"</script>';
												}
											}else{
												$in_kol = mysql_query('UPDATE `kolodec` SET `time`="'.(time()+300).'" WHERE `uid`="'.$u->info['id'].'" AND `type` = "0"');
												if($in_kol){
													//$_SESSION['timestamp'] = time()+300;
													$hpV = $u->stats['hpAll'] - $u->stats['hpNow'];
													if(($hpV + $vix2) > $kolod[$i][1][$u->info['vip']]){
														$hpV = $kolod[$i][1][$u->info['vip']] - $vix2;
													}
													mysql_query('UPDATE `stats` SET `hpNow` =`hpNow` + "'.$hpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
													$u->addActionKol($u->info['id'], time(),'hpKolodec_'.$u->info['id'], $hpV);
													echo '<script>location.href="main.php?vip=1&hpAllkol"</script>';
												}
											}
										}else{
											echo '';
										}
									}else{
										echo '<font color="red"><b>Ваше здоровье и так полностью восстановлено</b></font><br>';
									}
								}
							}
						}
				
					}elseif($kolod[$i][4] == 1) {
						//за сегодня
							$vix2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "mpKolodec_'.$u->info['id'].'" ',3);
							$vix2 = round($vix2[0]);
						if($kolod[$i][1][$u->info['vip']]-$vix2 > 0) {
							if(isset($_GET['take_item_vip']) && $_GET['take_item_vip'] == $itm['id']) {
								if($_GET['take_item_vip'] == 5125){
									if($u->stats['mpNow'] != $u->stats['mpAll']){
										$kolodec_mp = mysql_fetch_array(mysql_query('SELECT * FROM `kolodec` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "0"'));
										if($vix2 < $kolod[$i][1][$u->info['vip']]){
											if(!isset($kolodec_mp['id'])){
												$in_kol = mysql_query('INSERT INTO `kolodec` (`uid`,`time`,`type`) VALUES ("'.$u->info['id'].'","'.(time()+300).'","0")');
												if($in_kol){
													//$_SESSION['timestamp'] = time()+300;
													$mpV = $u->stats['mpAll'] - $u->stats['mpNow'];
													if(($mpV + $vix2) > $kolod[$i][1][$u->info['vip']]){
														$mpV = $kolod[$i][1][$u->info['vip']] - $vix2;
													}
													mysql_query('UPDATE `stats` SET `mpNow` =`mpNow` + "'.$mpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
													$u->addActionKol($u->info['id'], time(),'mpKolodec_'.$u->info['id'], $mpV);
													echo '<script>location.href="main.php?vip=1&mpAllkol"</script>';
												}
											}else{
												$in_kol = mysql_query('UPDATE `kolodec` SET `time`="'.(time()+300).'" WHERE `uid`="'.$u->info['id'].'" AND `type` = "0"');
												if($in_kol){
													//$_SESSION['timestamp'] = time()+300;
													$mpV = $u->stats['mpAll'] - $u->stats['mpNow'];
													if(($mpV + $vix2) > $kolod[$i][1][$u->info['vip']]){
														$mpV = $kolod[$i][1][$u->info['vip']] - $vix2;
													}
													mysql_query('UPDATE `stats` SET `mpNow` =`mpNow` + "'.$mpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
													$u->addActionKol($u->info['id'], time(),'mpKolodec_'.$u->info['id'], $mpV);
													echo '<script>location.href="main.php?vip=1&mpAllkol"</script>';
												}
											}
										}else{
											echo '';
										}
									}else{
										echo '<font color="red"><b>Ваша мана и так полностью восстановлена</b></font><br>';
									}
								}
							}
						}
					}

					$seet0 = '';				
					$seet0 .= '<img '.$vix2.' title="'.$itm['name'].' (Осталось всего: '.($kolod[$i][1][$u->info['vip']]-$vix2).' шт.)" style="height:25px;" src="//img.testcombats.ru/i/items/'.$itm['img'].'"> ';
					if($kolod[$i][1][$u->info['vip']]-$vix2 > 0) {
						$seet0 = '<a href="main.php?vip=1&take_item_vip='.$itm['id'].'">'.$seet0.'</a>';
					}else{
						$seet0 = '<span style="filter: alpha(opacity=20); -moz-opacity: 0.20; -khtml-opacity: 0.20; opacity: 0.20;">'.$seet0.'</span>';
					}
					$seet .= $seet0;

					$tbl .= '<tr><td align="center" width="45" bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;">';
					$tbl .= '<img '.$vix2.' title="'.$itm['name'].' (Осталось всего: '.($kolod[$i][1][$u->info['vip']]-$vix2).' шт.)" style="height:25px;" src="//img.testcombats.ru/i/items/'.$itm['img'].'"></td>';
					$tbl .= '<td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;">'.$itm['name'].' (Осталось всего: '.($kolod[$i][1][$u->info['vip']]-$vix2).' '.$typ[$i].')</td></tr>';

				}
				$i++;
			}
        echo $seet;
?>
            </p></td>
			<td style="left" width="50%;">
			<?
			echo '<b style="font-size: 10.04pt;">Доступные усиления:</b><br><small style="font-size:7pt;">(Вы можете усилить своего персонажа просто нажав на изображение.)</small><br><br><table><tbody><tr nowrap=""><td class="cp"><img onclick="location.href=\'/main.php?vip&3\';"  onMouseOver="top.hi(this,\'<b>Огненное усиление</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_powerup1.gif"></td><td class="cp"><b>Огненное усиление</b> - стоимость использования <b>0.50 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td class="cp"><img onclick="location.href=\'/main.php?vip&4\';" onMouseOver="top.hi(this,\'<b>Водное усиление</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_powerup2.gif"></td><td class="cp"><b>Водное усиление</b> - стоимость использования <b>0.50 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td class="cp"><img onclick="location.href=\'/main.php?vip&5\';" onMouseOver="top.hi(this,\'<b>Воздушное усиление</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_powerup3.gif"></td><td class="cp"><b>Воздушное усиление</b> - стоимость использования <b>0.50 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td class="cp"><img onclick="location.href=\'/main.php?vip&6\';" onMouseOver="top.hi(this,\'<b>Земное усиление</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_powerup4.gif"></td><td class="cp"><b>Земное усиление</b> - стоимость использования <b>0.50 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&7\';" onMouseOver="top.hi(this,\'<b>Защита от Огня</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_protect1.gif"></td><td class="cp"><b>Защита от Огня</b> - стоимость использования <b>0.50 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&8\';" onMouseOver="top.hi(this,\'<b>Защита от Воды</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_protect2.gif"></td><td class="cp"><b>Защита от Воды</b> - стоимость использования <b>0.50 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&9\';" onMouseOver="top.hi(this,\'<b>Защита от Воздуха</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_protect3.gif"></td><td class="cp"><b>Защита от Воздуха</b> - стоимость использования <b>0.50 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&10\';" onMouseOver="top.hi(this,\'<b>Защита от Земли</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_protect4.gif"></td><td class="cp"><b>Защита от Земли</b> - стоимость использования <b>0.50 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&1\';" onMouseOver="top.hi(this,\'<b>Сокрушение</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_powerup10.gif"></td><td class="cp"><b>Сокрушение</b> - стоимость использования <b>0.50 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&2\';" onMouseOver="top.hi(this,\'<b>Защита от урона</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_protect10.gif"></td><td class="cp"><b>Защита от урона</b> - стоимость использования <b>0.50 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&11\';" onMouseOver="top.hi(this,\'<b>Жажда Жизни +6</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_powerHPup6.gif"></td><td class="cp"><b>Жажда Жизни</b> - стоимость использования <b>0.50 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&12\';" onMouseOver="top.hi(this,\'<b>Холодный Разум</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/spell_stat_intel.gif"></td><td class="cp"><b>Холодный Разум</b> - стоимость использования <b>0.30 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&13\';" onMouseOver="top.hi(this,\'<b>Восстановление Жизни 1500HP</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/cureHP1500_1.gif"></td><td class="cp"><b>Восстановление Жизни</b> - стоимость использования <b>0.30 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&14\';" onMouseOver="top.hi(this,\'<b>Восстановление Маны 1500MP</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/items/cureMana1500_1.gif"></td><td class="cp"><b>Восстановление Маны</b> - стоимость использования <b>0.30 екр.</b></td></tr></tbody></table>';
			/* echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99989\';" onMouseOver="top.hi(this,\'<b>Выход из боя</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/retreat.gif"></td><td class="cp"><b>Выход из боя</b> - стоимость использования <b>24.99 екр.</b></td></tr></tbody></table>'; */
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99987\';" onMouseOver="top.hi(this,\'<b>Право на Опыт +300</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/wis_light_shield.gif"></td><td class="cp"><b>Право на Опыт +300</b> - стоимость использования <b>14.99 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99996\';" onMouseOver="top.hi(this,\'<b>Благословение Грибницы</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/gg_gribnica_reward.gif"></td><td class="cp"><b>Благословение Грибницы</b> - стоимость использования <b>12.95 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99995\';" onMouseOver="top.hi(this,\'<b>Благословение Грибницы 250HP</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/gg_macropus_reward.gif"></td><td class="cp"><b>Благословение Грибницы</b> - стоимость использования <b>12.95 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99994\';" onMouseOver="top.hi(this,\'<b>Благодарность Задорного скелета [Мощь]</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/blagodarnost_skeleta.gif"></td><td class="cp"><b>Благодарность Задорного скелета [Мощь]</b> - стоимость использования <b>12.95 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99993\';" onMouseOver="top.hi(this,\'<b>Благодарность Задорного скелета [Подавление]</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/blagodarnost_skeleta.gif"></td><td class="cp"><b>Благодарность Задорного скелета [Подавление]</b> - стоимость использования <b>12.95 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99990\';" onMouseOver="top.hi(this,\'<b>Благодарность Задорного скелета [15% HP]</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/blagodarnost_skeleta.gif"></td><td class="cp"><b>Благодарность Задорного скелета [HP]</b> - стоимость использования <b>12.95 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99992\';" onMouseOver="top.hi(this,\'<b>Благодарность Одинокого призрака [Крит]</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/gl_npc_ghost_buff.gif"></td><td class="cp"><b>Благодарность Одинокого призрака [Крит]</b> - стоимость использования <b>12.95 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99991\';" onMouseOver="top.hi(this,\'<b>Благодарность Одинокого призрака [Увёрт]</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/gl_npc_ghost_buff.gif"></td><td class="cp"><b>Благодарность Одинокого призрака [Увёрт]</b> - стоимость использования <b>12.95 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99980\';" onMouseOver="top.hi(this,\'<b>Благословение Глубин Мощь</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/standart_curse.gif"></td><td class="cp"><b>Благословение Глубин Мощь</b> - стоимость использования <b>2.59 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99979\';" onMouseOver="top.hi(this,\'<b>Благословение Глубин: Скорость</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/standart_curse.gif"></td><td class="cp"><b>Благословение Глубин: Скорость</b> - стоимость использования <b>2.59 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99978\';" onMouseOver="top.hi(this,\'<b>Благословение Глубин: Предчуствие</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/standart_curse.gif"></td><td class="cp"><b>Благословение Глубин: Предчуствие</b> - стоимость использования <b>2.59 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99977\';" onMouseOver="top.hi(this,\'<b>Благословение Глубин: Регенерация</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/standart_curse.gif"></td><td class="cp"><b>Благословение Глубин: Регенерация</b> - стоимость использования <b>2.59 екр.</b></td></tr></tbody></table>';
			echo '<table><tbody><tr nowrap=""><td><img onclick="location.href=\'/main.php?vip&99976\';" onMouseOver="top.hi(this,\'<b>Благословение Глубин: Печать Хаоса</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="//img.testcombats.ru/i/eff/standart_curse.gif"></td><td class="cp"><b>Благословение Глубин: Печать Хаоса</b> - стоимость использования <b>2.59 екр.</b></td></tr></tbody></table><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
			?>
			</td>
			
			</tr>

            </table>
			<hr class="line">
			
    </tr>
</table>
