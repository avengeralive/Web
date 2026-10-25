<?
if( isset($s[1]) && $s[1] == '13/sunduk_ukr' ) {
	/*
		Сундук: Украденный сундук
3064 - Часть глубинного зомби
3065 - Сочный оковалок
	*/
	//Все переменные сохранять в массиве $vad !
	$vad = array(
		'go' => true
	);
	
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `dn` = "'.$u->info['dnow'].'" LIMIT 1'));
	$vad['test2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `dn` = "'.$u->info['dnow'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if( $vad['test2'][0] > 0 ) {
		$r = 'Вы уже обыскали &quot;'.$obj['name'].'&quot;...';
		$vad['go'] = false;
	}elseif( $vad['test1'][0] > 1 ) {
		$r = 'Кто-то обыскал &quot;'.$obj['name'].'&quot; раньше вас...';
		$vad['go'] = false;
	}
	
	if( $vad['go'] == true ) {
		//Выпадает лут
		$vad['items'] = array(
		3064,3064,3064,3064,3064,3064,3064,3064,3064,3064,3064,3064,3064,3064,
		3065,3065,3065,3065,3065,3065,3065,3065,3065,3065,3065,3065,3065,3065
		);
		
		$vad['items'] = $vad['items'][rand(0,count($vad['items'])-1)];
		if( $vad['items'] != 3064 && rand(0,100) < 31 ) {
			$vad['items'] = 3064;	
		}
		if( $vad['items'] != 0 ) {
			//Выбрасываем предмет
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES (
				"'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'",""
			)');
			if( !isset($vad['dn_delete'][$vad['items']]) ) {
				$vad['dn_delete'][$vad['items']] = false;
			}
			if( $this->pickitem($obj,$vad['items'],$u->info['id'],'') ) {
				$r = 'Вы обнаружили предметы...';
			}else{
				$r = 'Что-то пошло не так, предметы растворились...';
			}
		}else{
			$r = 'Вы не нашли ничего полезного...';
		}
	}
	
	unset($vad);
}
?>