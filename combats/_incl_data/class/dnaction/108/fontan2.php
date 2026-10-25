<?
if(isset($s[1]) && $s[1] == '108/fontan2') {
  $vad = array('go' => true);
  
  $vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" LIMIT 1'));
  if($vad['test1'][0] > 1) {
	$r = 'Фонтан пуст ...';
	$vad['go'] = false;
  }
  
  $vad['test2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
  if($vad['test2'][0] > 0) {
	$r = 'Вы уже пользовались фонтаном ...';
	$vad['go'] = false;
  }
  
  if($vad['go'] == true) {
    $vad['bt'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "2" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inOdet` = "0" AND `inShop` = "0" AND `inTransfer` = "0" LIMIT 1'));
    if(isset($vad['bt']['id'])) {
	  if($vad['bt']['inGroup'] > 1) {
	    $r = 'Предмет не должен находиться в группе';
	    $vad['go'] = false;
	  } else {
	    $vad['go'] = true;
	  }
    } else {
	  $r = 'У вас нет пустой бутылки.';
	  $vad['go'] = false;
    }
  }
  
  if( $vad['go'] == true ) {
		mysql_query('INSERT INTO `dungeon_actions` (`dn`, `time`, `x`, `y`, `uid`, `vars`, `vals`) VALUES (
			"'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'")');
		$r = 'Опустив пустую бутылку в фонтан вы наполнили её.';
		$u->deleteItem(intval($vad['bt']['id']),$u->info['id'],1);
		$u->addItem(round(2417),$u->info['id'],'|musor=2|noremont=1|nosale=1',108, 3);
	}
	unset($vad);
  
  
}

?>