<?
if(isset($s[1]) && $s[1] == '108/door1') {
  $vad = array('go' => true);
  $vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" LIMIT 1'));
  if($vad['test1'][0] > 0) {
	$r = 'Кто-то вас опередил...';
	$vad['go'] = false;
  }
  if($vad['go'] == 'true') {
	mysql_query('INSERT INTO `dungeon_actions` (`dn`, `time`, `x`, `y`, `uid`, `vars`, `vals`) VALUES (
			"'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'")');
	$vad['items'] = array(4914, 4915, 4916, 4917, 4918);
	$vad['items'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($vad['items'][rand(0, count($vad['items'])-1)]).'" LIMIT 1'));
	$vad['dn_delete'][$vad['items']['id']] = true;
	$r = 'Вы обнаружили &quot;'.$vad['items']['name'].'&quot;';
	$this->pickitem($obj, $vad['items']['id'], 1,'',true, 1);
  }
  unset($vad);
}
?>