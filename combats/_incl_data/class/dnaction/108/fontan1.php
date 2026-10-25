<?
if(isset($s[1]) && $s[1] == '108/fontan1') {
  $vad = array('go' => true);
  $bots = mysql_fetch_array(mysql_query('SELECT `id2` FROM `dungeon_bots` WHERE `dn` = "'.$u->info['dnow'].'" AND ((`x` = "-7" AND `y` = "9") OR (`x` = "-5" AND `y` = "9") OR (`x` = "-7" AND `y` = "8") OR (`x` = "-6" AND `y` = "8") OR (`x` = "-5" AND `y` = "6")) AND `delete` = "0" LIMIT 1'));
  if(isset($bots['id2'])) {
	$r = 'Не все боты убиты ...';
	$vad['go'] = false;
  }
  $vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" LIMIT 1'));
  if($vad['test1'][0] > 2) {
	$r = 'Фонтан пуст ...';
	$vad['go'] = false;
  }
  $vad['test2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
  if($vad['test2'][0] > 0) {
	$r = 'Вы уже пользовались фонтаном ...';
	$vad['go'] = false;
  }
  if($vad['go'] == 'true') {
	$vad['items'] = array(4911, 4912, 4913);
	$vad['items'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($vad['items'][rand(0, count($vad['items'])-1)]).'" LIMIT 1'));
	$vad['dn_delete'][$vad['items']['id']] = false;
	$r = 'Вы обнаружили &quot;'.$vad['items']['name'].'&quot;';
	$this->pickitem($obj, $vad['items']['id'], 1,'',false, 1);
	mysql_query('INSERT INTO `dungeon_actions` (`dn`, `time`, `x`, `y`, `uid`, `vars`, `vals`) VALUES (
			"'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'")');
  }
  unset($vad);
}
?>