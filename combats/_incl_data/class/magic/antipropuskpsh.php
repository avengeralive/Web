<?
if(!defined('GAME')) die();

if( $itm['magic_inci'] == 'antipropuskpsh' )
{
	if(!isset($usr['id'])) $u->error = 'Не удалось найти персонажа &quot;'.htmlspecialchars($_GET['login']).'&quot;.';
	elseif( $u->info['align'] != 2 )
	{
        $psh_arr = array('psh13','psh12','psh101','psh9','psh10','psh3','psh7','psh16','psh17');

		foreach($psh_arr as $psh)
		{
			$test = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `actions` WHERE `uid` = "'.$usr['id'].'" AND `vars` = "'.$psh.'"
			AND `time` > "'.time().'" LIMIT 1'));

			if( !isset($test['id']) )
			{
				$u->addAction( time()+300, $psh, $usr['id'], $usr['id']);
                
				$test = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `actions` WHERE `uid` = "'.$usr['id'].'" AND `vars` = "'.$psh.'"
				AND `time` > "'.time().'" LIMIT 1'));
			}

			if($test['time'] < time()) $test['time'] = time();
			$test['time'] += 71700;

			mysql_query('UPDATE `actions` SET `time` = "'.$test['time'].'" WHERE `uid` = '.$usr['id'].' AND `id` = "'.$test['id'].'" LIMIT 1');
		}

		$u->addAction(time(),'propuskpsh','', $usr['id']);
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
        $u->error = 'Все прошло успешно, задержки в пещеры увеличены на 24 часа для &quot;'.$usr['login'].'&quot;.';

	} else $u->error = 'Хаосники не могут пользоваться этим свитком!';
}
?>