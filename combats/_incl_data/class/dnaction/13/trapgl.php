<?php
if(!defined('GAME'))die();

if(isset($file) && $file[0]=='13/trapgl.php'){
	
	$actions = array();
	$action = explode('|',$file[1]);
	//id_bot:col | 
	foreach( $action as $value ) {
		$temp = explode(':',$value);
		$actions[$temp[0]]= $temp[1];
	}
	# attackBot:1|left=1|right=1
	$vad = array();
	//
	$vad['rnd'] = rand(-3,5);
	if($vad['rnd'] == 1) {
		//Снижение Концентрации (Интуиция: -15) 
		$vad['img'] = 'gl_debuff_inst';
		$vad['g'] = 'Снижение Концентрации';
		$vad['id_eff'] = 486;
		$vad['eff'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` = "'.$vad['id_eff'].'" LIMIT 1'));
		$vad['data'] = 'add_s3=-15';
	}elseif($vad['rnd'] == 2) {
		//Снижение Силы (Сила: -15) 
		$vad['img'] = 'gl_debuff_str';
		$vad['g'] = 'Снижение Силы';
		$vad['id_eff'] = 487;
		$vad['eff'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` = "'.$vad['id_eff'].'" LIMIT 1'));
		$vad['data'] = 'add_s1=-15';
	}elseif($vad['rnd'] == 3) {
		//Снижение стремительности (Ловкость: -15) 
		$vad['img'] = 'gl_debuff_agil';
		$vad['g'] = 'Снижение стремительности';
		$vad['id_eff'] = 488;
		$vad['eff'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` = "'.$vad['id_eff'].'" LIMIT 1'));
		$vad['data'] = 'add_s2=-15';
	}elseif($vad['rnd'] == 4) {
		//Ржавчина на доспехах (Защита от урона : -50) 
		$vad['img'] = 'gl_debuff_rzha';
		$vad['g'] = 'Ржавчина на доспехах';
		$vad['id_eff'] = 489;
		$vad['eff'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` = "'.$vad['id_eff'].'" LIMIT 1'));
		$vad['data'] = 'add_za=-50';
	}elseif($vad['rnd'] == 5) {
		//Паралич конечностей 
		$vad['img'] = 'gl_debuff_paralize';
		$vad['g'] = 'Паралич конечностей';
		$vad['id_eff'] = 490;
		$vad['eff'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` = "'.$vad['id_eff'].'" LIMIT 1'));
		$vad['data'] = 'add_speed_dungeon=-99999';
	}else{
		$vad['g'] = '';
	}
	
	if( $vad['eff']['x'] > 4 ) {
		$d->error = 'Вы попали в ловушку установленную кем то из обитателей подземелья.';
	}elseif( $vad['g'] == '' ) {
		$d->error = 'Вы чудом избежали ловушки, в следующий раз вам так не повезет!';
	}else{
		$d->error = 'Вы попали в ловушку и получили негативный эффект &quot;'.$vad['g'].'&quot;...'; 
		//
		//Добавляем новую болезнь
		if(!isset($vad['eff']['id'])) {
			mysql_query('INSERT INTO `eff_users` (
				`id_eff`,`uid`,`name`,`data`,`timeUse`
			) VALUES (
				"'.$vad['id_eff'].'","'.$u->info['id'].'","'.$vad['g'].'","'.$vad['data'].'","'.time().'"
			)');
			//
			if($u->info['sex'] == 0) {
				$vad['text'] = '[img[items/'.$vad['img'].'.gif]] <b>'.$u->info['login'].'</b> угодил в ловушку &quot;'.$vad['g'].'&quot;!';
			}else{
				$vad['text'] = '[img[items/'.$vad['img'].'.gif]] <b>'.$u->info['login'].'</b> угодил в ловушку &quot;'.$vad['g'].'&quot;!';	
			}
			$d->sys_chat($vad['text']);
		}else{
			mysql_query('UPDATE `eff_users` SET `data` = "'.$vad['data'].'" , `x` = `x`+1 WHERE `id` = "'.$vad['eff']['id'].'" LIMIT 1');
		}
	}
	//
	unset($temp,$actions,$r,$vad);
	
}