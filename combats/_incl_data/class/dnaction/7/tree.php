<?php
if(!defined('GAME'))die();

if( isset($s[1]) && $s[1] == '7/tree' ) {
	
	$vad = array(
		'go' => true
	);
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" LIMIT 1'));
	$vad['test2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" LIMIT 1'));
	if( $vad['test1'][0] > 0 ) {
		$r = 'Вы не нашли ничего полезного...<br>';
		$vad['go'] = false;
	}
	if( $vad['test2'][0] > 1 ) {
		$r = 'Ничего не произошло...<br>';
		$vad['go'] = false;
	}
	
	if( $vad['go'] == true ) {
		mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES (
			"'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'"	)');
	
	$vad['rnd'] = rand(-3,5);
	if($vad['rnd'] == 1) {
		//Дрожь в коленях (Передвижение в пещере -60) 
		$vad['img'] = 'ggspeed';
		$vad['g'] = 'Дрожь в коленях';
		$vad['id2'] = 600;
		$vad['eff'] = mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` = "'.$vad['id_eff'].'" LIMIT 1');
		$vad['data'] = 'add_speed_dungeon=-60|nofastfinisheff=1';
	}elseif($vad['rnd'] == 2) {
		//Ускоренное Обновление (Реген хп и маны: +100) 
		$vad['img'] = 'ggregen';
		$vad['g'] = 'Ускоренное Обновление';
		$vad['id2'] = 601;
		$vad['eff'] = mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` = "'.$vad['id_eff'].'" LIMIT 1');
		$vad['data'] = 'add_speedhp=100|add_speedmp=100|nofastfinisheff=1';
	}elseif($vad['rnd'] == 3) {
		//Стихийная слабость (Мф. стихий: -100) 
		$vad['img'] = 'tn_debuff_res';
		$vad['g'] = 'Стихийная слабость';
		$vad['id2'] = 602;
		$vad['eff'] = mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` = "'.$vad['id_eff'].'" LIMIT 1');
		$vad['data'] = 'add_zm=-100|nofastfinisheff=1';
	}elseif($vad['rnd'] == 4) {
		//Болотная лихорадка (Сила, Ловкость, Интуиция, Интеллект -10) 
		$vad['img'] = 'tn_debuff';
		$vad['g'] = 'Болотная лихорадка';
		$vad['id2'] = 603;
		$vad['eff'] = mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` = "'.$vad['id_eff'].'" LIMIT 1');
		$vad['data'] = 'add_s1=-10|add_s2=-10|add_s3=-10|add_s5=-10|nofastfinisheff=1';
	}else{
		$vad['g'] = '';
	}
	
	if( $vad['eff']['x'] > 4 ) {
		$r = 'Вы попали в ловушку установленную кем то из обитателей подземелья.';
	}elseif( $vad['g'] == '' ) {
		$r = 'Вы чудом избежали ловушки, в следующий раз вам так не повезет!';
	}else{
		$r = 'Вы попали в ловушку и получили негативный эффект &quot;'.$vad['g'].'&quot;...'; 
		
		//Удаление эффектов
		if($vad['rnd'] == 1) {
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND (`id_eff` = "600" ) ');
		}elseif($vad['rnd'] == 2) {
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND (`id_eff` = "601" ) ');
		}elseif($vad['rnd'] == 3) {	
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND (`id_eff` = "602" ) ');
		}elseif($vad['rnd'] == 4) {	
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND (`id_eff` = "603" ) ');
		}
			
		//Добавляем Эффект
		if(!isset($vad['eff']['id'])) {
			mysql_query('INSERT INTO `eff_users` (
				`id_eff`,`uid`,`name`,`data`,`timeUse`
			) VALUES (
				"'.$vad['id2'].'","'.$u->info['id'].'","'.$vad['g'].'","'.$vad['data'].'","'.time().'"
			)');
			//
			if($u->info['sex'] == 0) {
				$vad['text'] = '<b>'.$u->info['login'].'</b> наложено заклятие &quot;'.$vad['g'].'&quot;!';
			}else{
				$vad['text'] = '<b>'.$u->info['login'].'</b> наложено заклятие &quot;'.$vad['g'].'&quot;!';	
			}
			$r = ($vad['text']);
		}else{
			mysql_query('UPDATE `eff_users` SET `data` = "'.$vad['data'].'" , `x` = `x`+1 WHERE `id` = "'.$vad['eff']['id'].'" LIMIT 1');
		}
		
	}
	}
	unset($vad);
}
?>