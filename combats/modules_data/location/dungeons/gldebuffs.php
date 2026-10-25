<?php
if(!defined('GAME'))die();

if(isset($file) && $file[0]=='dungeons/gldebuffs.php')
{
	$vad = array('' => true);
    $vad['rnd1'] = 70;//веротяность попасть в ловушку на первое наступание
	$vad['rnd2'] = 10;//попасть в ловушку на последющие наступания

	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "buffit'.$obj['id'].'" LIMIT 1'));
    $rand = rand(1,100000);
	$buf_chance  = (isset($vad['test1'][0]) ? $vad['rnd2'] : $vad['rnd1']);
	
    if($rand <= $buf_chance * 1000)//Попали в ловушку
	{
		if(!isset($vad['test1'][0]))//Считаем использование
		{
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES (
			"'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","buffit'.$obj['id'].'","'.$vad['bad'].'"	)');
		}

		$vad['rnd'] = rand(1,5);
		if($vad['rnd'] == 1) {
			//Снижение Силы (Сила -15)
			$vad['img'] = 'gl_debuff_str';
			$vad['g'] = 'Снижение Силы';
			$vad['id2'] = 604;
			$vad['data'] = 'add_s1=-15|nofastfinisheff=1';
		}elseif($vad['rnd'] == 2) {
			//Снижение Концентрации (Интуиция -15)
			$vad['img'] = 'gl_debuff_rzha';
			$vad['g'] = 'Снижение Концентрации';
			$vad['id2'] = 605;
			$vad['data'] = 'add_s3=-15|nofastfinisheff=1';
		}elseif($vad['rnd'] == 3) {
			//Снижение Стремительности (Ловкость -15)
			$vad['img'] = 'gl_debuff_agil';
			$vad['g'] = 'Снижение Стремительности';
			$vad['id2'] = 606;
			$vad['data'] = 'add_s2=-15|nofastfinisheff=1';
		}elseif($vad['rnd'] == 4) {
			//Ржавчина на доспехах (Защита от урона: -50)
			$vad['img'] = 'gl_debuff_inst';
			$vad['g'] = 'Ржавчина на доспехах';
			$vad['id2'] = 607;
			$vad['data'] = 'add_za=-50|nofastfinisheff=1';
		}elseif($vad['rnd'] == 5) {
			//Паралич конечностей(Скорость передвижения: -99999)
			$vad['img'] = 'gl_debuff_paralize';
			$vad['g'] = 'Паралич конечностей';
			$vad['id2'] = 608;
			$vad['data'] = 'add_speed_dungeon=-99999|nofastfinisheff=1';
		} else $vad['g'] = '';

		$vad['eff'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` = "'.$vad['id2'].'" LIMIT 1'));
		$vad['eff2'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` IN (600,601,602,603) LIMIT 1'));

        if(isset($vad['eff']['id']) && $vad['id2'] == 603 && $vad['eff']['x'] < 5)//Стаки
		{
			$xx = ($vad['eff']['x']+1);
            $vad['data'] = 'add_s1=-'.(10*$xx).'|add_s2=-'.(10*$xx).'|add_s3=-'.(10*$xx).'|add_s5=-'.(10*$xx).'|nofastfinisheff=1';
			mysql_query('UPDATE `eff_users` SET `data` = "'.$vad['data'].'" , `x` = `x`+1 WHERE `id` = "'.$vad['eff']['id'].'" LIMIT 1');

			$d->error = 'Вы попали в ловушку и получили негативный эффект &quot;'.$vad['g'].'&quot;...';
		}
        elseif(!isset($vad['eff2']['id']) || (isset($vad['eff']['id']) && $vad['eff']['id_eff']==$vad['id2']))
		{
            if(isset($vad['eff']['id'])) mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND (`id_eff` = "'.$vad['id2'].'" ) ');

			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`)
			VALUES ("'.$vad['id2'].'","'.$u->info['id'].'","'.$vad['g'].'","'.$vad['data'].'","'.time().'")');

            $d->error = 'Вы попали в ловушку и получили негативный эффект &quot;'.$vad['g'].'&quot;...';

			$sx =($u->info['sex'] == 0 ? '': 'а');
			$vad['text'] = '[img[items/'.$vad['img'].'.gif]] <b>'.$u->info['login'].'</b> угодил'.$sx.' в ловушку и получил'.$sx.' эффект &quot;'.$vad['g'].'&quot;!';
            $d->sys_chat($vad['text']);
		} else $d->error = $d->error = err_tr().'Вы попали в ловушку в ловушку и ничего не произошло, в следующий раз вам так не повезет!';

	} else $d->error = err_tr().'Вы чудом избежали ловушки, в следующий раз вам так не повезет!';
	//
	unset($vad);
	
}?>