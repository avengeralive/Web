<div id="List" style="width:100%;">
<?

$count = 0;
$count2 = 0;
$count3 = 0;

echo '<h3>Статистика не играющих</h3>';
$levels = array (0=>10, 7=>14, 8=>45);
$counts = array(0,0);
foreach($levels as $key => $value)
{
    $users = array(0,0);
	$sp = mysql_query('SELECT `id`,`login`,`level` FROM `users` WHERE `level`="'.$key.'" AND `bot_id`="0" AND `ip`!="0" AND `moneyCop`<"10" AND
	`online`<"'.(time()-86400*$value).'" AND `banned` = "0"');
	while( $pl = mysql_fetch_array($sp) )
	{
		$sp2 = mysql_fetch_array(mysql_query('SELECT count(`id`) FROM `items_users` WHERE `uid` = "'.$pl['id'].'"'));
	    $users[0] += $sp2[0];
	    $users[1]++;
	}

	echo 'Игроков['.$key.'] не входивших '.$value.' дней: '.$users[1].' вещей: '.$users[0].'<br>';//.' users_delo: '.$user[1];
	$counts[1] += $users[1];
    $counts[0] += $users[0];
}
echo '<b>Всего игроков: '.$counts[1].' вещей: '.$counts[0].'</b><br>';

$count = 0; $count2 = 0; $count3 = 0;
$sp = mysql_query('SELECT `id`,`login` FROM `users` WHERE `banned` != "0"');
while( $pl = mysql_fetch_array($sp) )
{
	$sp2 = mysql_fetch_array(mysql_query('SELECT count(`id`) FROM `items_users` WHERE `uid` = "'.$pl['id'].'"'));
	//echo $pl['login'].'['.$pl['id'].']: предметов: '.$sp2[0].'  шт.<br>';
    $count += $sp2[0];
    $count2++;
}
echo '<br><font color=red>Забаненных игроков: '.$count2.' вещей: '.$count.'</font><br>';

$count = 0; $count2 = 0; $count3 = 0;
$sp = mysql_query('SELECT `id`,`login` FROM `users` WHERE `haos` = "1" AND `bot_id`="0" AND `ip`!="0" AND `moneyCop`<"10"
AND `online`<"'.(time()-86400*14).'"');
while( $pl = mysql_fetch_array($sp) )
{
	$sp2 = mysql_fetch_array(mysql_query('SELECT count(`id`) FROM `items_users` WHERE `uid` = "'.$pl['id'].'"'));
	//echo $pl['login'].'['.$pl['id'].']: предметов: '.$sp2[0].'  шт.<br>';
    $count += $sp2[0];
    $count2++;
}
echo '<font color=red>Игроков в хаосе (не входили 14 дн.): '.$count2.' вещей: '.$count.'</font><br>';

$count = 0; $count2 = 0; $count3 = 0;
$sp = mysql_query('SELECT `id`,`login` FROM `users` WHERE `banned` != "0" AND `haos` = "1"AND `bot_id`="0" AND `ip`!="0" AND `moneyCop`<"10"
AND `online`<"'.(time()-86400*14).'"');
while( $pl = mysql_fetch_array($sp) )
{
	$sp2 = mysql_fetch_array(mysql_query('SELECT count(`id`) FROM `items_users` WHERE `uid` = "'.$pl['id'].'"'));
	//echo $pl['login'].'['.$pl['id'].']: предметов: '.$sp2[0].'  шт.<br>';
    $count += $sp2[0];
    $count2++;
}
echo '<font color=red>Забаненных игроков в хаосе (не входили 14 дн.): '.$count2.' вещей: '.$count.'</font>';


echo '<h3>Статистика таблицы "users_delo" от 50</h3>';
$arr = array();
$count = 0;
$sp = mysql_query('SELECT `login` FROM `users_delo` ORDER BY `login`');
while( $pl = mysql_fetch_array($sp) )
{
	if(!isset($arr[$pl['login']])) $arr[$pl['login']] = 1;
	else $arr[$pl['login']]++;
}
arsort($arr);
foreach($arr as $key => $value)
{
	if($value>50) echo $key.': '.$value.' шт.<br>';
	$count += $value;
}
echo '<b>Всего: '.$count.'</b>';

echo '<h3>Статистика таблицы "items_users" от 5 000</h3>';

$arr = array();
$sp = mysql_query('SELECT `item_id` FROM `items_users` ORDER BY `item_id`');
while( $pl = mysql_fetch_array($sp) )
{
	if(!isset($arr[$pl['item_id']])) $arr[$pl['item_id']] = 1;
	else $arr[$pl['item_id']]++;
}
arsort($arr);
$count = 0;
foreach($arr as $key => $value)
{
	if($value>5000)
	{
        $itm = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$key.'" LIMIT 1'));
		echo $itm['name'].' ['.$key.']: '.$value.' шт.';
		if(!$itm['name']) echo '<font color=red><b> - нет названия!</b></font>';
		echo'<br>';
        $count += $value;
	}
}
echo '<b>Всего: '.$count.'</b><br>';

$sp = mysql_fetch_array(mysql_query('SELECT count(`item_id`) FROM `items_users` WHERE `delete` != "0" AND `delete` != "1000" AND `delete` != "1357908642"'));
echo '<b>Удаленных предметов: '.$sp[0].'</b><br><br>';


echo '<h3>Статистика таблицы "actions" от 50</h3>';
$arr = array();
$count = 0;
$sp = mysql_query('SELECT `vars` FROM `actions` ORDER BY `vars`');
while( $pl = mysql_fetch_array($sp) )
{
	if(!isset($arr[$pl['vars']])) $arr[$pl['vars']] = 1;
	else $arr[$pl['vars']]++;
}
arsort($arr);
foreach($arr as $key => $value)
{
	if($value>50) echo $key.': '.$value.' шт.<br>';
	$count += $value;
}
echo '<b>Всего: '.$count.'</b>';

//Поиск свободных id
echo '<h3>Свободные id</h3>';
echo '<br><b>Вещи и свитки</b><br>';
$itm_old = 0;
$sp = mysql_query('SELECT `id` FROM `items_main` ORDER BY `id`');
while( $pl = mysql_fetch_array($sp) )
{
	if($pl['id'] > $itm_old+1) echo (($itm_old+1==$pl['id']-1) ? ($itm_old+1) : ($itm_old+1).' - '.($pl['id']-1)).'<br>';
    $itm_old = $pl['id'];
}

echo '<br><br><b>Приемы</b><br>';
$itm_old = 0;
$sp = mysql_query('SELECT `id` FROM `priems` ORDER BY `id`');
while( $pl = mysql_fetch_array($sp) )
{
	if($pl['id'] > $itm_old+1) echo (($itm_old+1==$pl['id']-1) ? ($itm_old+1) : ($itm_old+1).' - '.($pl['id']-1)).'<br>';
    $itm_old = $pl['id'];
}

echo '<br><b>Пользователи</b><br>';
$itm_old = 0;
$sp = mysql_query('SELECT `id` FROM `users` ORDER BY `id` LIMIT 10000');
while( $pl = mysql_fetch_array($sp) )
{
	if($pl['id'] > $itm_old+1) echo (($itm_old+1==$pl['id']-1) ? ($itm_old+1) : ($itm_old+1).' - '.($pl['id']-1)).'<br>';
    $itm_old = $pl['id'];
}

/*echo '<h3>Статистика таблицы "items_users" - пачки</h3>';

$eko_all = 0;
$sp = mysql_query('SELECT `uid` FROM `items_users` WHERE `uid`>"0" GROUP BY `uid` LIMIT 8000');
while( $pl = mysql_fetch_array($sp) )
{
	$eko_user = 0;
	//echo '<br><br>UID: '.$pl['uid'].'<br>';
	$sp2 = mysql_query('SELECT `item_id` FROM `items_users` WHERE `uid`="'.$pl['uid'].'" GROUP BY `item_id`');
    while( $pl2 = mysql_fetch_array($sp2) )
	{
        $gr = mysql_fetch_array(mysql_query('SELECT `name`, `group`, `group_max` FROM `items_main` WHERE `id` = "'.$pl2['item_id'].'" LIMIT 1'));
		if($gr['group'])
		{
            $items = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` WHERE `uid`="'.$pl['uid'].'" AND `item_id` = "'.$pl2['item_id'].'" LIMIT 1'));
			if($items[0]>1)
			{
				$pachka = ceil($items[0]/$gr['group_max']);
				$eko = $items[0] - $pachka;
				//echo $gr['name'].'['.$pl2['item_id'].'] кол-во: '.$items[0].' пачек: '. $pachka.' Экономия: '.$eko.'<br>';
                $eko_user += $eko;
			}
		}
	}
    //echo 'Экономия: '.$eko_user;
    $eko_all += $eko_user;
}
echo '<br><br>Экономия всего: '.$eko_all;

echo '<h3>Статистика таблицы "items_users" itm: 8531 от 100</h3>';
$arr = array();
$sp = mysql_query('SELECT `uid` FROM `items_users` WHERE `item_id`="8531"');
while( $pl = mysql_fetch_array($sp) )
{
	if(!isset($arr[$pl['uid']])) $arr[$pl['uid']] = 1;
	else $arr[$pl['uid']]++;
}
arsort($arr);
foreach($arr as $key => $value)
{
    $usr = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$key.'" LIMIT 1'));
	if($value>100) echo $usr['login'].'['.$key.'][<a href="/info/'.$key.'" target="_blank">инфо</a>] = '.$value.' шт.<br>';
}*/
?>
</div>