<?
if(isset($s[1]) && $s[1] == '108/fontan3') {
  $vad = array('go' => true);
  $vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" LIMIT 1'));
  if($vad['test1'][0] > 0) {
	$r = 'Фонтан пуст ...';
	$vad['go'] = false;
  }
  
  $bots = mysql_fetch_array(mysql_query('SELECT `id2` FROM `dungeon_bots` WHERE `dn` = "'.$u->info['dnow'].'" AND ((`x` = "-6" AND `y` = "32") OR (`x` = "-6" AND `y` = "31") OR (`x` = "-5" AND `y` = "32") OR (`x` = "-5" AND `y` = "31") OR (`x` = "-5" AND `y` = "30")) AND `delete` = "0" LIMIT 1'));
  if(isset($bots['id2'])) {
	$r = 'Не все боты убиты ...';
	$vad['go'] = false;
  }
  
  $vad['test2'] = mysql_fetch_array(mysql_query('SELECT `id2` FROM `dungeon_bots` WHERE `dn` = "'.$u->info['dnow'].'" AND `id_bot` = "484" AND `delete` = "0" LIMIT 1'));
  if(isset($vad['test2']['id2'])) {
	$r = 'Король всё еще жив ...';
	$vad['go'] = false;
  }
  
  if($vad['go'] == true) {
	mysql_query('INSERT INTO `dungeon_actions` (`dn`, `time`, `x`, `y`, `uid`, `vars`, `vals`) VALUES (
			"'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'")');
			//4041
	$u->addItem(round(4041),$u->info['id'],'|musor=2|noremont=1|nosale=1',108, 1);
	$r = 'Вы получили Снадобье Забытых Мастеров';
  }
  unset($vad);
  
}
?>