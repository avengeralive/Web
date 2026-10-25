<?php
if(!defined('GAME'))die();

if( isset($s[1]) && $s[1] == '7/lake4' )
{
	$vad = array('go' => true);

	//Берег озера координаты 9  -14
	$vad['max_use'] = 5;//сколько раз работает объект
	$vad['items'] = array(8816,8823,8824,8822);
	$vad['rnd_itm'] = 3;//веротяность вытащить вещь - 3%
	$vad['rnd_baf'] = 30;//попасть в ловушку - 30%
	//pr('tst');

    $rand = rand(1,100000);
	
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" LIMIT 1'));
	
	if(!isset($vad['test1'][0]) || $vad['test1'][0] < $vad['max_use'])
	{
		//Считаем использование
		mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES (
		"'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'"	)');
	
        if($rand <= $vad['rnd_itm'] * 1000)//Получили вещь
		{
			$vad['items'] = $vad['items'][rand(0,count($vad['items'])-1)];
            $vad['itm'] = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$vad['items'].'" LIMIT 1'));

			if($vad['items'] != 0 && $this->pickitem($obj,$vad['items'],$u->info['id'])) $r = 'Вы обнаружили предмет &quot;'.$vad['itm']['name'].'&quot;';
			else $r = 'Вы не нашли ничего полезного...';
		}
		elseif($rand <= ($vad['rnd_baf'] + $vad['rnd_itm']) * 1000)//Попали в ловушку
		{
			$vad['rnd'] = rand(1,4);

			if($vad['rnd'] == 1) {
    			//Дрожь в коленях (Передвижение в пещере -60)
				$vad['img'] = 'ggspeed';
				$vad['g'] = 'Дрожь в коленях';
				$vad['id2'] = 600;
				$vad['data'] = 'add_speed_dungeon=-60|nofastfinisheff=1';
			}elseif($vad['rnd'] == 2) {
    			//Ускоренное Обновление (Реген хп и маны: +100)
				$vad['img'] = 'ggregen';
				$vad['g'] = 'Ускоренное Обновление';
				$vad['id2'] = 601;
				$vad['data'] = 'add_speedhp=100|add_speedmp=100|nofastfinisheff=1';
			}elseif($vad['rnd'] == 3) {
    			//Стихийная слабость (Мф. стихий: -100)
				$vad['img'] = 'tn_debuff_res';
				$vad['g'] = 'Стихийная слабость';
				$vad['id2'] = 602;
				$vad['data'] = 'add_zm=-100|nofastfinisheff=1';
			}elseif($vad['rnd'] == 4) {
    			//Болотная лихорадка (Сила, Ловкость, Интуиция, Интеллект -10)
				$vad['img'] = 'tn_debuff';
				$vad['g'] = 'Болотная лихорадка';
				$vad['id2'] = 603;
				$vad['data'] = 'add_s1=-10|add_s2=-10|add_s3=-10|add_s5=-10|nofastfinisheff=1';
			}

			$vad['eff'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` = "'.$vad['id2'].'" LIMIT 1'));
            $vad['eff2'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` IN (600,601,602,603) LIMIT 1'));

            if(isset($vad['eff']['id']) && $vad['id2'] == 603 && $vad['eff']['x'] < 5)//Стаки
			{
				$xx = ($vad['eff']['x']+1);
              	$vad['data'] = 'add_s1=-'.(10*$xx).'|add_s2=-'.(10*$xx).'|add_s3=-'.(10*$xx).'|add_s5=-'.(10*$xx).'|nofastfinisheff=1';
				mysql_query('UPDATE `eff_users` SET `data` = "'.$vad['data'].'" , `x` = `x`+1 WHERE `id` = "'.$vad['eff']['id'].'" LIMIT 1');

				$r = '<b>'.$u->info['login'].'</b> наложено заклятие &quot;'.$vad['g'].'&quot;!';
			}
			elseif(!isset($vad['eff2']['id']) || (isset($vad['eff']['id']) && $vad['eff']['id_eff']==$vad['id2']))
			{
                if(isset($vad['eff']['id'])) mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND (`id_eff` = "'.$vad['id2'].'" ) ');

				mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`)
				VALUES ("'.$vad['id2'].'","'.$u->info['id'].'","'.$vad['g'].'","'.$vad['data'].'","'.time().'")');

                $r = '<b>'.$u->info['login'].'</b> наложено заклятие &quot;'.$vad['g'].'&quot;!';

				$vad['text'] = '[img[items/'.$vad['img'].'.gif]] <b>'.$u->info['login'].'</b> наложено заклятие &quot;'.$vad['g'].'&quot;!';
			
				$this->sys_chat($vad['text']);
			}
		} else {$r = 'Вы не нашли ничего полезного...<br>';}
	} else  $r = 'Ничего не произошло...<br>';

	unset($vad);
}
?>