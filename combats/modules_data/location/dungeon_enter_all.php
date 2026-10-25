<?php
if(!defined('GAME')) { die(); }

if($u->room['file'] == 'dungeon_enter_all')
{
	$open_duns = array(101,12,3,9,10,7,16);//пещеры открыты для посещения

	if(isset($re) && $re!='') echo '<div align="right"><font color=red>'.$re.'</font></div>';
    elseif(isset($u->error) && $u->error!='') echo '<div align="right"><font color=red>'.$u->error.'</font></div>';

	function checkPshGo($dun_id)
	{
		global $u;
		$dungeon_timeout = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "psh'.$dun_id.'" AND `time` > '.(time()-60*60*3).' LIMIT 1',1);
		if(isset($dungeon_timeout['id']) && $u->info['admin']!='1'){
			return true;
		}
		else{
			return false;
		}
	}	

	function showDng($dun_id,$city,$name){
		global $u;
		if($dun_id==101) {
			$dun5 = 101; //Бездна
		}elseif($dun_id==12) {
			$dun5 = 12; //ПТП
		}elseif($dun_id==15) {
			$dun5 = 15; //Каток
		}elseif($dun_id==1) {
			$dun5 = 1; //Водосток
		}elseif($dun_id==16) {
			$dun5 = 16; //Пещера Мглы
		}elseif($dun_id==3) {
			$dun5 = 3; //Катакомбы
		}elseif($dun_id==9) {
			$dun5 = 9; //Потерянный вход
		}elseif($dun_id==10) {
			$dun5 = 10; //Грибница
		}elseif($dun_id==13) {
			$dun5 = 13; //Гора легиона
		}elseif($dun_id==7) {
			$dun5 = 7; //Туманные Низины
		}elseif($dun_id==8) {
			$dun5 = 8; //Сторожевая башня
		}elseif($dun_id==999) {
			$dun5 = 999; //Тестовая локация
		}elseif($dun_id==11) {
			$dun5 = 11; //Некровиль
		}elseif($dun_id==17) {
			$dun5 = 17; //Руины
		}
		$dungeon_timeout = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "psh'.$dun5.'" AND `time` > '.(time()-60*60*3).' LIMIT 1',1);
		if(!isset($dungeon_timeout['id'])){
			echo'
				<label>
					<input type="radio" name="rpmg1" id="rpmg1" value="'.$dun_id.'" />
					<img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/'.$city.'.gif" width="34" height="19"> '.$name.'
				</label>
				<hr>
			';			
		}
		else{
			echo'<img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/'.$city.'.gif" width="34" height="19"> '.$name.' <small>(Задержка: '.$u->timeOut(60*60*3-time()+$dungeon_timeout['time']).')</small> <hr>';
		}

	}

	$error = ''; // Собираем ошибки.
	$dungeonGroupList = ''; // Сюда помещаем список Групп.
	$dungeonGo = 1; // По умолчанию, мы идем в пещеру.
    if($magic->testTravma( $u->info['id'] , 4 ))
	{
		$dungeonGo = 0;
		$nTravma = 1;
	}
	$dungeon = mysql_fetch_assoc( mysql_query('SELECT `id` as room, city, `dungeon_room` as d_room, city, `shop`, `dungeon_id` as id, `dungeon_name` as name, quest FROM `dungeon_room` WHERE `id`="'.$u->room['id'].'" LIMIT 1') );

	$dungeon['quest'] = 1;

	$dunname = array(
		12 => array('capitalcity','Пещера Тысячи Проклятий'),
		17 => array('capitalcity','Руины'),
		3 => array('demonscity','Катакомбы'),
		101 => array('angelscity','Бездна'),
		16 => array('sandcity','Пещеры Мглы'),
		9 => array('emeraldscity','Потерянный вход'),
		10 => array('suncity','Грибница'),
		1 => array('dreamscity','Водосток'),
		13 => array('abandonedplain','Гора Легиона'),
		7 => array('devilscity','Туманные Низины'),
		8 => array('abaddonedplain','Сторожевая Башня'),
		11 => array('9','Некровиль'),
	);

    if(isset($_GET['rz']) && $dungeon['quest'] == 1) $roomSection = 1; // Получаем Задание
   	else $roomSection = 0;  // Собираем группу для похода
		$all_dungeon = mysql_query('SELECT `city` FROM `dungeon_room` WHERE `city` IS NOT NULL AND `active`=1 ');
    while( $t = mysql_fetch_array($all_dungeon) ) { $dungeon['list'][] = $t['city']; }
        unset($all_dungeon);
 
    if( $u->info['dn'] > 0 ) {
    	$zv = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_zv` WHERE `id`="'.$u->info['dn'].'" AND `delete` = "0" LIMIT 1'));
	if(!isset($zv['id'])){
		mysql_query('UPDATE `stats` SET `dn` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		$u->info['dn'] = 0;
	}
}

if( isset( $_GET['start'] ) && $zv['uid'] == $u->info['id'] && $dungeonGo == 1 ) {
	$ig = 1;
	if( $ig > 0 ){ //перемещаем игроков в пещеру
		$dungeon['room'] = 321;
		$dungeon['id'] = $zv['dun'];	
		$ins = mysql_query('INSERT INTO `dungeon_now` (`city`,`uid`,`id2`,`name`,`time_start`)VALUES ("'.$zv['city'].'","'.$zv['uid'].'","'.$zv['dun'].'","'.$dunname[$zv['dun']][1].'","'.time().'")');
	if($ins){
		$zid = mysql_insert_id();
		mysql_query('UPDATE `dungeon_zv` SET `delete` = "'.time().'" WHERE `id` = "'.$zv['id'].'" LIMIT 1');
	//обновляем пользователей
		$su = mysql_query('SELECT `u`.`id`,`st`.`dn` FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`dn`="'.$zv['id'].'" /*LIMIT '.($zv['team_max']+1).'*/');
		$ids = '';
		$map_locs = array();
		$spm2 = mysql_query('SELECT `id`,`x`,`y` FROM `dungeon_map` WHERE `id_dng` = "'.$zv['dun'].'"');
	while( $plm2 = mysql_fetch_array( $spm2 ) ) {
		$map_locs[] = array($plm2['x'],$plm2['y']);
	}
		unset( $spm2 , $plm2 );				
		$pxd = 0;
	while( $pu = mysql_fetch_array($su) ) {
    	$pxd++;
		$ids .= ' `id` = "'.$pu['id'].'" OR';
	if( $u->stats['gold'] >= 3 ) {
		$u->addAction( ( time() - ((60*60*3)/100*30) ) ,'psh'.$zv['dun'].'',$pu['id'],$pu['id']);
	}else{
		$u->addAction(time(),'psh'.$zv['dun'].'',$pu['id'],$pu['id']);
	}
	//Добавляем квестовые обьекты для персонажей 
		$sp = mysql_query('SELECT * FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `room` = '.$dungeon['room'].' AND `vars` LIKE "%start_quest%" AND `vals` = "go" LIMIT 100');
	while($pl2 = mysql_fetch_array($sp)){
		$pl = mysql_fetch_array(mysql_query('SELECT * FROM `quests` WHERE `id` = "'.(str_replace('start_quest','',$pl2['vars'])).'" AND `line` = "'.$dungeon['id'].'" LIMIT 1')); 
	if( isset($pl['id']) ) {
		$act = explode(',',$pl['act_date']);
		$i = 0;
	while( $i < count($act) ) {
		$act_date = explode(':|:',$act[$i]);
	foreach($act_date as $key=>$val){ 
		$val = explode(':=:',$val);
		$actdate[$val[0]] = $val[1];
    }
	//Сбор ресурсов
	if( isset($actdate['tk_itm']) && $actdate['tk_itm'] != '' ) {								
		$xr2 = explode('=',$actdate['tk_itm']);
	if( $xr2[2] == 0 ) {
	if( isset($actdate['tk_itm_fromY']) && isset($actdate['tk_itm_toY']) ) {
		$actdate['tk_itm_fromY'] = (integer)$actdate['tk_itm_fromY'];
		$actdate['tk_itm_toY'] = (integer)$actdate['tk_itm_toY'];
	}
		$ml_arr = array();
	foreach($map_locs as $ml){ // tk_itm_fromY  tk_itm_toY  - отсеиваем позицию для дропа предметов.
	if( (isset($actdate['tk_itm_fromY']) && isset($actdate['tk_itm_toY'])) OR (!isset($actdate['tk_itm_fromY']) && isset($actdate['tk_itm_toY'])) ) {
	if( $ml[1] > $actdate['tk_itm_fromY'] && $actdate['tk_itm_toY'] > $ml[1] )$ml_arr[] = $ml;
	elseif( !isset($actdate['tk_itm_fromY']) && $actdate['tk_itm_toY'] > $ml[1] ) $ml_arr[] = $ml;
	} else $ml_arr[] = $ml;
	}
	if( isset($ml_arr) && count($ml_arr) == 0 ) $ml_arr = $map_locs; 
	//Добавляем обьект для юзера
		$j = 0;
	//Перевыполнение %
		$perevip = 0;
		$perevip = round($xr2[1]*$pl['perevip']/100);
		$xr2[1]=$xr2[1]+$perevip;
		echo $xr2[1];
	while( $j < $xr2[1]){
		$cord = $ml_arr[rand(0,count($ml_arr)-1)];
	if( $cord[0] != 0 || $cord[1] != 0 ) {
		mysql_query('INSERT INTO `dungeon_items` (`dn`,`user`,`item_id`,`time`,`x`,`y`,`onlyfor`,`quest`) VALUES ("'.$zid.'","'.$u->info['id'].'","'.$xr2[0].'","'.time().'","'.$cord[0].'","'.$cord[1].'","'.$u->info['id'].'","'.$pl['id'].'")');
	}
		$j++;
	}
	}else{
	//Предмет находится в конкретном месте
		mysql_query('INSERT INTO `dungeon_items` (`dn`,`user`,`item_id`,`time`,`x`,`y`,`onlyfor`,`quest`) VALUES ("'.$zid.'","'.$u->info['id'].'","'.$xr2[0].'","'.time().'","'.$xr2[2].'","'.$xr2[3].'","'.$u->info['id'].'","'.$pl['id'].'")');
	}
}
		$i++;
	}
  }
}			
	}
		$ids = rtrim($ids,'OR');
		$snew = 1;
		$upd_x = 0;
		$upd_y = 0;
		$upd_res_x = 0;
		$upd_res_y = 0;		
	if($zv['dun']=="9"){
		$upd_x = "0";
		$upd_y = "1";	
		$upd_res_x = $upd_x;
		$upd_res_y = $upd_y;	
	}elseif($zv['dun']=="13"){
		$upd_x = "0";
		$upd_y = "10";
		$upd_res_x = $upd_x;
		$upd_res_y = $upd_y;
		$snew = 3;
	}elseif($zv['dun']=="10"){
		$snew = 4;
	}elseif($zv['dun']=="8"){
		$upd_x = "-2";
		$upd_y = "-1";
	}elseif($zv['dun']=="7"){
		$upd_x = "-3";
		$upd_y = "2";
		$snew = 3;
	}elseif($zv['dun']=="11"){
		$upd_x = "1";
		$upd_y = "-6";
	}
		$upd1 = mysql_query('UPDATE `stats` SET `s`="'.$snew.'",`res_s`="1",`x`="'.$upd_x.'",`y`="'.$upd_y.'",`res_x`="'.$upd_res_x.'",`res_y`="'.$upd_res_y.'",`dn` = "0",`dnow` = "'.$zid.'" WHERE '.$ids.' LIMIT '.($zv['team_max']+1).'');
	if( $upd1 ){
		$upd2 = mysql_query('UPDATE `users` SET `room` = "184" WHERE '.$ids.' LIMIT '.($zv['team_max']+1).'');
	//Добавляем ботов и обьекты в пещеру $zid с for_dn = $dungeon['id']
	//Добавляем ботов
		$vls = '';
		$sp = mysql_query('SELECT * FROM `dungeon_bots` WHERE `for_dn` = "'.$zv['dun'].'"');
	while( $pl = mysql_fetch_array( $sp ) ) {
	if( $pl['id_bot'] == 0 && $pl['bot_group'] !=''){
		$bots = explode( ',', $pl['bot_group'] );
		$pl['id_bot'] = (int)$bots[rand(0, count($bots)-1 )];
	}
	if( $pl['id_bot'] > 0 )$vls .= '("'.$zid.'","'.$pl['id_bot'].'","'.$pl['colvo'].'","'.$pl['items'].'","'.$pl['x'].'","'.$pl['y'].'","'.$pl['dialog'].'","'.$pl['items'].'","'.$pl['go_bot'].'","'.$pl['noatack'].'"),';
		unset($bots);
	}
		$vls = rtrim($vls,',');				
		$ins1 = mysql_query('INSERT INTO `dungeon_bots` (`dn`,`id_bot`,`colvo`,`items`,`x`,`y`,`dialog`,`atack`,`go_bot`,`noatack`) VALUES '.$vls.'');
    //Добавляем обьекты
		$vls = '';
		$sp = mysql_query('SELECT * FROM `dungeon_obj` WHERE `for_dn` = "'.$zv['dun'].'"');
	while($pl = mysql_fetch_array($sp)) {
		$vls .= '("'.$zid.'","'.$pl['name'].'","'.$pl['img'].'","'.$pl['x'].'","'.$pl['y'].'","'.$pl['action'].'","'.$pl['type'].'","'.$pl['w'].'","'.$pl['h'].'","'.$pl['s'].'","'.$pl['s2'].'","'.$pl['os1'].'","'.$pl['os2'].'","'.$pl['os3'].'","'.$pl['os4'].'","'.$pl['type2'].'","'.$pl['top'].'","'.$pl['left'].'","'.$pl['date'].'"),';
	}

	//Добавление обьектов
    //День Валентина
	/* if( (floor(date('m')) == 2 && floor(date('d')) >= 6 && floor(date('d')) <= 20) || $u->info['admin']==1)//цветы
	{
		if( (floor(date('m')) == 2 && floor(date('d')) >= 6 && floor(date('d')) <= 20) || $u->info['admin']==1)//мобы
		{
			//Появляются мобы которые принимают цветы
				$vlsbts = '';
				$ins1bts = NULL;
			if( $zv['dun'] == 12 ) {
			//(ПТП)
			//4-7 уровня
				$vlsbts .='("'.$zid.'","413","1","","-2","21","9","0","0"),';
			//4-9 уровня
				$vlsbts .='("'.$zid.'","414","1","","-1","31","10","0","0"),';
			}elseif( $zv['dun'] == 3 ) {
			//Катакомбы
			//4-7 уровня
				$vlsbts .='("'.$zid.'","413","1","","16","5","9","0","0"),';
			//4-9 уровня
			    $vlsbts .='("'.$zid.'","414","1","","3","35","10","0","0"),';
			}elseif( $zv['dun'] == 101 ) {
			//(бездна)
			//4-7 уровня
				$vlsbts .='("'.$zid.'","413","1","","-5","28","9","0","0"),';
			//4-9 уровня
				$vlsbts .='("'.$zid.'","414","1","","3","44","10","0","0"),';
			}

			if( $vlsbts != '' )
			{
				$vlsbts = rtrim($vlsbts,',');
				$ins1bts = mysql_query('INSERT INTO `dungeon_bots` (`dn`,`id_bot`,`colvo`,`items`,`x`,`y`,`dialog`,`atack`,`go_bot`) VALUES '.$vlsbts.'');
			}
			unset($vlsbts,$ins1bts);
		}
	//Предметы по пещере [Блёклый подземник]
			$dcords = array();
			$c_sp = mysql_query('SELECT * FROM `dungeon_map` WHERE `id_dng` = "'.$zv['dun'].'"');
			while( $c_pl = mysql_fetch_array($c_sp)) {
				$dcords[] = array($c_pl['x'],$c_pl['y']);
			}
			$fcords = array();
			$i = 1;
			while($i <= $pxd) {
				$j = rand(1,10);
				while( $j >= 0 ) {
					$rndxy = rand(0,count($dcords)-1);
					$rndx = $dcords[$rndxy][0];
					$rndy = $dcords[$rndxy][1];
					$fcords[$rndx][$rndy] = true;
					unset($dcords[$rndxy]);
					$vls .= '("'.$zid.'","Блеклый подземник","vbig1.gif","'.$rndx.'","'.$rndy.'","fileact:vbig1","0","81","81","0","0","5","8","12","0","0","0","0","{use:\'takeit\',rt2:154,rl2:146,rt3:139,rl3:154,rt4:125,rl4:161}"),';
					$j--;
				}
				$i++;
			}
			//Предметы по пещере [Черепичный подземник]
			$sp = mysql_query('SELECT * FROM `dungeon_bots` WHERE `for_dn` = "'.$zv['dun'].'"');
			$test = array();
			$dcords2 = array();
			$dcords3 = array();
			while( $pl = mysql_fetch_array( $sp ) ) {
				if(!isset($test[$pl['id_bot']])) {
					$test[$pl['id_bot']] = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `id` = "'.$pl['id_bot'].'" LIMIT 1'));
				}
				if( isset($test[$pl['id_bot']]['id']) && $test[$pl['id_bot']] != 2 ) {
					if( $test[$pl['id_bot']]['level'] > 6 ) {
						$dcords2[] = array($pl['x'],$pl['y']);
					}
					if( $test[$pl['id_bot']]['level'] >= 8 && $test[$pl['id_bot']]['align'] == 9 ) {
						$dcords3[] = array($pl['x'],$pl['y']);
					}
				}else{
					$test[$pl['id_bot']] = 2;
				}
			}
			$i = 1;
			while($i <= $pxd) {
				$j = rand(1,5);
				while( $j >= 0 ) {
					$rndxy = rand(0,count($dcords2)-1);
					$rndx = $dcords2[$rndxy][0];
					$rndy = $dcords2[$rndxy][1];
					if(!isset($fcords[$rndx][$rndy]) && isset($dcords2[$rndxy][0])) {
						$fcords[$rndx][$rndy] = true;
						unset($dcords2[$rndxy]);
						$vls .= '("'.$zid.'","Черепичный подземник","vbig2.gif","'.$rndx.'","'.$rndy.'","fileact:vbig2","0","81","81","0","0","5","8","12","0","0","0","0","{use:\'takeit\',rt2:154,rl2:146,rt3:139,rl3:154,rt4:125,rl4:161}"),';
					}
					$j--;
				}
				$i++;
			}
			$i = 1;
			while($i <= $pxd) {
				$j = rand(1,2);
				while( $j >= 0 ) {
					$rndxy = rand(0,count($dcords3)-1);
					$rndx = $dcords3[$rndxy][0];
					$rndy = $dcords3[$rndxy][1];
					if(!isset($fcords[$rndx][$rndy]) && isset($dcords3[$rndxy][0])) {
						$fcords[$rndx][$rndy] = true;
						unset($dcords3[$rndxy]);
						$vls .= '("'.$zid.'","Кровавый подземник","vbig3.gif","'.$rndx.'","'.$rndy.'","fileact:vbig3","0","81","81","0","0","5","8","12","0","0","0","0","{use:\'takeit\',rt2:154,rl2:146,rt3:139,rl3:154,rt4:125,rl4:161}"),';
					}
					$j--;
				}
				$i++;
			}
			unset($test);
		} */
		//Валентин НПЦ
				//
				$vls = rtrim($vls,',');	
				if( $vls != '' ) {			
					$ins2 = mysql_query('INSERT INTO `dungeon_obj` (`dn`,`name`,`img`,`x`,`y`,`action`,`type`,`w`,`h`,`s`,`s2`,`os1`,`os2`,`os3`,`os4`,`type2`,`top`,`left`,`date`) VALUES '.$vls.'');
				} else {
					$ins2 = true;
				}
				if( $upd2 && $ins1 && $ins2 ){
					die('<script>location="main.php?rnd='.$code.'";</script>');
				} else {
					$error = 'Ошибка перехода в подземелье...';
				}
			} else {
				$error = 'Ошибка перехода в подземелье...';
			}
		} else {
			$error = 'Ошибка перехода в подземелье...';
		}
	}
} elseif( isset( $_POST['go'] , $_POST['goid'] ) && $dungeonGo == 1 ) {
	if(!isset($zv['id'])) {
		$zv = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_zv` WHERE `city` = "all" AND `id`="'.mysql_real_escape_string($_POST['goid']).'" AND `delete` = "0" LIMIT 1'));
		if( isset( $zv['id'] ) && $u->info['dn'] == 0) {
			if(checkPshGo($zv['dun'])){
				$error = 'У вас задержка на посещение этой пещеры';
			}
			else{
				if( $zv['pass'] != '' && $_POST['pass_com'] != $zv['pass'] ) {
					$error = 'Вы ввели неправильный пароль';				
				} elseif( $u->info['level'] > 7 && $zv['dun'] != 1 ){
					$row = 0;
					if( 5 > $row ) {
						$upd = mysql_query('UPDATE `stats` SET `dn` = "'.$zv['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						if( !$upd ){
							$error = 'Не удалось вступить в эту группу';
							unset($zv);
						} else {
							$u->info['dn'] = $zv['id'];
						}
					} else {
						$error = 'В группе нет места';
						unset($zv);
					}
				} elseif( $zv['dun'] == 1 ){
					//Канализация
					$row_max = 5;
					if( $u->info['level'] == 4 ) {
						$row_max = 4;
					}elseif( $u->info['level'] == 5 ) {
						$row_max = 3;
					}elseif( $u->info['level'] == 6 ) {
						$row_max = 2;
					}elseif( $u->info['level'] >= 7 ) {
						$row_max = 1;
					}
					$row = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `dn` = "'.$zv['id'].'" LIMIT 1'));
					$row1 = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `dn` = "'.$zv['id'].'" LIMIT 1'));
					$row2 = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row1['id'].'" LIMIT 1'));
					$row = $row[0];
					if( $row2['level'] != $u->info['level'] ) {
						$error = 'Вы не подходите по уровню';
					}elseif( $row_max > $row ) {
						$upd = mysql_query('UPDATE `stats` SET `dn` = "'.$zv['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						if( !$upd ){
							$error = 'Не удалось вступить в эту группу';
							unset($zv);
						} else {
							$u->info['dn'] = $zv['id'];
						}
					} else {
						$error = 'В группе нет места';
						unset($zv);
					}
				}elseif( $u->info['level'] < 4 && $zv['dun'] == 104 ){
					//Шахты
					$row_max = 3;
					if( $u->info['level'] > 3 ) {
						$row_max = 1;
					}
					$row = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `dn` = "'.$zv['id'].'" LIMIT 1'));
					$row1 = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `dn` = "'.$zv['id'].'" LIMIT 1'));
					$row2 = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row1['id'].'" LIMIT 1'));
					$row = $row[0];
					if( $row2['level'] != $u->info['level'] && $u->info['level'] > 3 ) {
						$error = 'Вы не подходите по уровню';
					}elseif( $row_max > $row ) {
						$upd = mysql_query('UPDATE `stats` SET `dn` = "'.$zv['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						if( !$upd ){
							$error = 'Не удалось вступить в эту группу';
							unset($zv);
						} else {
							$u->info['dn'] = $zv['id'];
						}
					} else {
						$error = 'В группе для вас нет места';
						unset($zv);
					}
				} else {
					$error = 'Вы не подходите по уровню';
					unset($zv);
				}
			}
		} else {
			$error = 'Заявка не найдена';
		}
	} else {
		$error = 'Вы уже находитесь в группе';
	}
} elseif( isset( $_POST['leave'] ) && isset( $zv['id'] ) && $dungeonGo == 1 ) {
	if( $zv['uid'] == $u->info['id'] ) {
		//ставим в группу нового руководителя
		$ld = mysql_fetch_array(mysql_query('SELECT `id` FROM `stats` WHERE `dn` = "'.$zv['id'].'" AND `id` != "'.$u->info['id'].'" LIMIT 1'));
		if( isset($ld['id']) ){
			$zv['uid'] = $ld['id'];
			mysql_query('UPDATE `dungeon_zv` SET `uid` = "'.$zv['uid'].'" WHERE `id` = "'.$zv['id'].'" LIMIT 1');
			mysql_query('UPDATE `stats` SET `dn` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			$u->info['dn'] = 0;
			unset($zv);
		} else {
			//удаляем группу целиком
			mysql_query('UPDATE `dungeon_zv` SET `delete` = "'.time().'" WHERE `id` = "'.$zv['id'].'" LIMIT 1');
			mysql_query('UPDATE `stats` SET `dn` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			$u->info['dn'] = 0;
			unset($zv);
		}
	} else {
		//просто выходим с группы
		mysql_query('UPDATE `stats` SET `dn` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		$u->info['dn'] = 0;
		unset($zv);
	}
} elseif( isset($_POST['rpmg1']) && $u->info['level'] > 1 && $dungeonGo == 1 ) {
	if( $u->info['dn'] == 0 ) {

		$dun5 = $dungeon['id'];	
		//
		if(isset($_POST['rpmg1']))
		{
			if($_POST['rpmg1']==101) {
				$dun5 = 101; //Бездна
			}elseif($_POST['rpmg1']==12) {
				$dun5 = 12; //ПТП
			}elseif($_POST['rpmg1']==1) {
				$dun5 = 1; //Водосток
			}elseif($_POST['rpmg1']==16) {
				$dun5 = 16; //Пещера Мглы
			}elseif($_POST['rpmg1']==3) {
				$dun5 = 3; //Катакомбы
			}elseif($_POST['rpmg1']==9) {
				$dun5 = 9; //Потерянный вход
			}elseif($_POST['rpmg1']==10) {
				$dun5 = 10; //Грибница
			}elseif($_POST['rpmg1']==13) {
				$dun5 = 13; //Гора легиона
			}elseif($_POST['rpmg1']==7) {
				$dun5 = 7; //Туманные Низины
			}elseif($_POST['rpmg1']==8) {
				$dun5 = 8; //Сторожевая башня
			}elseif($_POST['rpmg1']==999) {
				$dun5 = 999; //Тестовая локация
			}elseif($_POST['rpmg1']==11) {
				$dun5 = 11; //Некровиль
			}elseif($_POST['rpmg1']==17) {
				$dun5 = 17; //Руины
			}elseif($_POST['rpmg1']==20) {
				$dun5 = 20; //Ледяная Пещера
			}else{
				$dun5 = 12; //ПТП
			}
		}else{
			$dun5 = 12; //ПТП
		}
		if(checkPshGo($dun5)) $error = 'У вас задержка на посещение этой пещеры';
		if(!in_array($_POST['rpmg1'], $open_duns) && $u->info['admin']==0) $error = 'Посещение этой пещеры запрещено';
		else{
			//
			$ins = mysql_query('INSERT INTO `dungeon_zv`
			(`city`,`time`,`uid`,`dun`,`pass`,`com`,`lvlmin`,`lvlmax`,`team_max`) VALUES
			("all","'.time().'","'.$u->info['id'].'","'.$dun5.'",
			"'.mysql_real_escape_string($_POST['pass']).'",
			"'.mysql_real_escape_string($_POST['text']).'",
			"8",
			"21",
			"5")');
			if( $ins ) {
				$u->info['dn'] = mysql_insert_id();
				$zv['id'] = $u->info['dn'];
				$zv['uid'] = $u->info['id'];
				mysql_query('UPDATE `stats` SET `dn` = "'.$u->info['dn'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$error = 'Вы успешно создали группу';
			} else {
				$error = 'Не удалось создать группу';
			}			
		}
	} else {
		$error = 'Вы уже находитесь в группе';
	}
}

		//Генерация списка групп
$sp = mysql_query('SELECT * FROM `dungeon_zv` WHERE `city` = "all" AND `delete` = "0" AND `time` > "'.(time()-60*60*2).'"');
while( $pl = mysql_fetch_array( $sp ) ){
	$dungeonGroupList .= '<div style="padding:2px;">';
	if( $u->info['dn'] == 0 ) $dungeonGroupList .= '<input type="radio" name="goid" id="goid" value="'.$pl['id'].'" />';
	$dungeonGroupList .= '<span class="date">'.date('H:i',$pl['time']).'</span> ';
	
	$dungeonGroupList .= '<span><img title="'.$dunname[$pl['dun']][1].'" style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/'.$dunname[$pl['dun']][0].'.gif" /></span> ';
	
	$pus = ''; //группа
	$su = mysql_query('SELECT `u`.`id`,`u`.`login`,`u`.`level`,`u`.`align`,`u`.`clan`,`st`.`dn`,`u`.`city`,`u`.`room` FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`dn`="'.$pl['id'].'" LIMIT '.($pl['team_max']+1).'');
	while( $pu = mysql_fetch_array( $su ) ) {
		$pus .= '<b>'.$pu['login'].'</b> ['.$pu['level'].']<a href="info/'.$pu['id'].'" target="_blank"><img src="https://img.testcombats.ru/i/inf_'.$pu['city'].'.gif" title="Инф. о '.$pu['login'].'"></a>'; 
		$pus .= ', ';
	}
	$pus = trim( $pus, ', ' );
	
	$dungeonGroupList .= $pus; unset($pus);
	
	if( $pl['pass'] != '' && $u->info['dn'] == 0 ) $dungeonGroupList .= ' <small><input type="password" name="pass_com" value=""></small>';
	
	if( $pl['com'] != '' ) {
		$dl = '';
		// Если модератор, даем возможность удалять комментарий к походу.
		$moder = mysql_fetch_array(mysql_query('SELECT * FROM `moder` WHERE `align` = "'.$u->info['align'].'" LIMIT 1'));
		if( ( $moder['boi'] == 1 || $u->info['admin'] > 0 ) && $pl['dcom'] == 0 ){
			$dl .= ' (<a href="?delcom='.$pl['id'].'&key='.$u->info['nextAct'].'&rnd='.$code.'">удалить комментарий</a>)';
			if( isset( $_GET['delcom'] ) && $_GET['delcom'] == $pl['id'] && $u->newAct( $_GET['key'] ) == true ) {
				mysql_query('UPDATE `dungeon_zv` SET `dcom` = "'.$u->info['id'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				$pl['dcom'] = $u->info['id'];
			}
		}
		$pl['com'] = htmlspecialchars($pl['com'],NULL,'cp1251');
		if( $pl['dcom'] > 0 ) {
			$dl = ' <font color="grey"><b>комментарий удален модератором</b></font>';
		}
		if( $pl['dcom'] > 0 ) {
			if( $moder['boi'] == 1 || $u->info['admin'] > 0 ) {
				$pl['com'] = '<font color="red">'.$pl['com'].'</font>';
			} else {
				$pl['com'] = '';
			}
		}
		$dungeonGroupList .= '<small> | '.$pl['com'].''.$dl.'</small>';
	}
	$dungeonGroupList .= '</div>';
}
	if(isset($_GET['saleres'])) {
	if(isset($_GET['repitm'])) {
		$id = (int)$_GET['repitm'];
		$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.*, count(`iuu`.id) as inGroupCount
				FROM `items_users` AS `iu`
				LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`)
				LEFT JOIN `items_users` as `iuu` ON (`iuu`.inGroup = `iu`.inGroup AND `iuu`.item_id = `im`.id )
				WHERE `iuu`.`uid`="'.$u->info['id'].'" AND `iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `iu`.`id` = "'.mysql_real_escape_string($id).'" LIMIT 1'));
		$po = $u->lookStats($itm['data']);	
	if(!isset($itm['id']) ) {
	}elseif( $po['frompisher'] <= 1 ) {
	 	echo '<font color="red">Только пещерные ресурсы</font><br>';  
	}else{
		$col = $u->itemsX($itm['id']);
		mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
	if($col>1) {
		mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `item_id`="'.$itm['item_id'].'" AND `uid`="'.$itm['uid'].'" AND `inGroup` = "'.$itm['inGroup'].'" LIMIT '.$col.'');	
	}
		$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.Repshop</font>&quot;: Предмет &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] был обменян на '.($col).' репутации сдачи ресурсов!.',time(),$u->info['city'],'System.Repshop',0,0);
		echo '<font color="red">Вы успешно обменяли &quot;'.$itm['name'].' (x'.$col.')&quot; на '.$col.' ед. репутации сдачи ресурсов</font><br>';
		$u->rep['repcapitalcity'] += $col;
		mysql_query('UPDATE `rep` SET `repcapitalcity` = "'.$u->rep['repcapitalcity'].'" WHERE `id` = "'.$u->rep['id'].'" LIMIT 1');
	}
	}
	//Выводим вещи в инвентаре для продажи
		$itmAll = $u->genInv(707,'`iu`.`uid`="'.$u->info['id'].'" AND `im`.`res` = "1" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `data` LIKE "%frompisher%" ORDER BY `lastUPD`  DESC');
    if($itmAll[0]==0) {
		$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО</td></tr>';
	}else{
		$itmAllSee = $itmAll[2];
	}
		echo '<h3>Ресурсы для обмена на репутацию';
		echo '<input onclick="location.href=\'main.php?rz=1\'" type="button" value="Вернуться" style="float:right" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;">
		<input onclick="location.href=\'main.php?saleres\'" type="button" value="Обновить" style="float:right" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;"></h3><br>';
		echo '<small style="float:left;"><b>Репутация: '.($u->rep['repcapitalcity']).' ед.</b></small><br>';
		echo '<table width="80%" border="0" style="border:1px solid #aaa;" cellpadding="0" cellspacing="0">'.$itmAllSee.'</table>';
		die();
	}
?>
<style>
.grid_but{float:right;width:200px;}

@media screen and (max-width: 1024px) {
  
	.grid_but{float:none;width:100%;}
}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <?php if( $roomSection == 0 ) { ?>
	<td><div style="padding-left:0px;" align="center">
      <h3>Вход в подземелья</h3>
	  <?php
	  if($u->info['dn']==0) {
	  echo '<p><h5>Для входа в подземелья нажмите на картинку или на кнопку <font color="darkgreen"><b>Создать группу</b /></font /> </p>';
	  }?>
    </div></td>
	<?php } ?>
    <td width="200"><div align="right">
      <table cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%">&nbsp;</td>
          <td>
          <?php if($roomSection==0) { ?>
          <table  border="0" cellpadding="0" cellspacing="0">
              <tr align="right" valign="top">
                <td><!-- -->
                    <?php echo $goLis; ?>
                    <!-- -->
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td nowrap="nowrap"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
                            <tr>
								<td bgcolor="#D3D3D3"><img src="https://img.testcombats.ru/i/move/links.gif" width="9" height="7" /></td>
								<td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=<?php if($u->info['city']=='catipalcity') { echo '1.180.0.213'; }
								elseif($u->info['room']==321) { echo '1.180.0.213'; } 
								else { echo '1.180.0.321'; } ?>&rnd=<?php echo $code; ?>';" title="<?php 
								if($u->info['city']=='capitalcity'){
									 thisInfRm('1.180.0.213',1);
								}else {
									thisInfRm('1.180.0.321',1);
								}
							
								?>"><?php
								if($u->info['city']=='catipalcity'){
								  echo "Большая торговая улица";
								} else {
								  echo "Большая торговая улица";
								}
								?></a></td>
                            </tr>
                        </table>
						</td>
                      </tr>
                  </table></td>
              </tr>
          </table>
          <?php } ?>
          </td>
        </tr>
      </table>
      </div></td>
  </tr>
</table>
<?php if( $roomSection == 1 ) { ?>
<td><div style="padding-left:0px;" align="center">
      <h3>Тут вы можете взять задания, за награды репутацию и сдать вещи - получив за это кредиты.</h3>
    </div></td>
	  <div align="right">
	<INPUT TYPE=button value="Обновить" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" style="width: 100px" onclick="location='main.php?rz=1'">&nbsp;
	<TD style="width: 25%; vertical-align: top; text-align: left; "><INPUT style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Вернуться' style='width: 100px' onclick='location="/main.php"'>
	</TD>
	</div>
	</div>
	<?php } else { ?>
	<div align="center" class="grid_but">
	  <p>
	<INPUT style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Обновить' onclick='location="/main.php"'>
	<?php if($u->info['level'] > 7) { ?>
	&nbsp;<INPUT TYPE=button value="Задание" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" onclick="location='main.php?rz=1'">
	<?php } ?>
    </p>
	<br>
	<fieldset style="border: 1px solid;font-size: 11px;">
	<legend style="font-size: 12px;color: brown;"><b>Информация:</b></legend>
	<a href="#"><b>ПТП</b></a><br>
	<a href="#"><b>Бездна</b></a><br>
	<a href="#"><b>Катакомбы</b></a><br>
	<a href="#"><b>Потерянный Вход</b></a><br>
	<a href="#"><b>Грибница</b></a><br>
	<a href="#"><b>Пещера Мглы</b></a><br>
	<a href="#"><b>Туманные Низины</b></a><br>
	</fieldset> 
	</div>
<?php
} 
if($error!='')echo '<font color="red"><b>'.$error.'</b></font><br>';

//отображаем
if( $dungeonGroupList != '' ) 
{
	if( !isset( $zv['id'] ) || $u->info['dn'] == 0 )
	{
		if($dungeonGo==1 || $u->info['dn'] == 0 ) $pr = '<p><input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;"
 name="go" type="submit" value="Вступить в группу"></p>';

		$dungeonGroupList = '<form autocomplete="off" action="main.php?rnd='.$code.'" method="post">'.$dungeonGroupList.''.$pr.'</form>';
	}
	$dungeonGroupList .= '<hr>';
}

if( $roomSection == 0 ) { echo $dungeonGroupList; }
if( $roomSection == 1 ) { 
	# endQuest завершаем задание по нажатию.
	if( isset( $_GET['endQuest'] ) && $_GET['endQuest'] != '' ){ 
		$action = mysql_fetch_array(mysql_query('SELECT * FROM `actions` WHERE `uid` = '.$u->info['id'].' AND `id`="'.$_GET['endQuest'].'" AND `vals` = "go" LIMIT 1'));
		$quest = mysql_fetch_array(mysql_query('SELECT * FROM `quests` WHERE `id` = "'.str_replace('start_quest','',$action['vars']).'" LIMIT 1'));
		if( $q->questCheckEnd($quest)==1 ){ 
			$q->questSuccesEnd($quest, $action);
		}
	}
?>
<div>
	<form autocomplete="off" action='/main.php' method="post" name="F1" id="F1">
<?php
	$qsee = '';
	$hgo = $u->testAction('`uid` = "'.$u->info['id'].'" AND `room` = "'.$u->info['room'].'" AND `time` >= '.(time()-60*60*24).' AND `vars` = "psh_qt_'.$dungeon['city'].'" LIMIT 1',1);
	$qc=0; // Quest Count
	$qcc = array();
	//Генерируем список текущих квестов
	$sp = mysql_query('SELECT * FROM `actions` WHERE `vars` LIKE "%start_quest%" AND `vals` = "go" AND `uid` = "'.$u->info['id'].'" LIMIT 100');
	while( $pl = mysql_fetch_array( $sp ) ) {
		if($pl['room'] == $u->info['room']){
			$pq = mysql_fetch_array(mysql_query('SELECT * FROM `quests` WHERE `id` = "'.str_replace('start_quest','',$pl['vars']).'" LIMIT 1'));
			if( $q->questCheckEnd($pq)==1 ) $qsee2 = '<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="button" value="Завершить задание" onclick="location=\'main.php?rz=1&amp;endQuest='.$pl['id'].'\'">'; else $qsee2 = '';
			 
			$qsee .= '
			<a href="main.php?rz=1&end_qst_now='.$pq['id'].'"><img src="https://img.testcombats.ru/i/clear.gif" title="Отказаться от задания"></a>
			<b>'.$pq['name'].'</b>
			<div style="padding-left:15px;padding-bottom:5px;border-bottom:1px solid grey"><small>'.$pq['info'].'<br>'.$q->info($pq).''.$qsee2.' </small></div>
			<br>';
			#
			$qcc[$pq['line']]++;
			# 
			$qc++;
		}
	}
	
	if( isset( $_GET['add_quest'] ))
	{
		$qst_city = $_GET['city_quest'];
		//Берем задания пещер
		if($qst_city=='angelscity') {
			$dun5 = 101; //Бездна
		}elseif($qst_city=='demonscity') {
			$dun5 = 3; //Катакомбы
		}elseif($qst_city=='emeraldscity') {
			$dun5 = 9; //Потерянный вход
		}elseif($qst_city=='suncity') {
			$dun5 = 10; //Грибница
		}elseif($qst_city=='dreamscity') {
			$dun5 = 1; //Водосток
		}elseif($qst_city=='abandonedplain') {
			$dun5 = 13; //Гора легиона
		}elseif($qst_city=='abaddonedplain') {
			$dun5 = 8; //Сторожевая башня
		}elseif($qst_city=='sandcity') {
			$dun5 = 16; //Пещера Мглы
		}elseif($qst_city=='devilscity') {
			$dun5 = 7; //Туманные низины
		}elseif($qst_city=='9') {
			$dun5 = 11; //Некровиль
		}elseif($qst_city=='17') {
			$dun5 = 17; //Руины
		}else{
			$dun5 = 12; //ПТП
		}
		//
		$hgo = $u->testAction('`uid` = "'.$u->info['id'].'" AND `room` = "'.$u->info['room'].'" AND `time` >= '.(time()-60*60*22+3540).' AND `vars` = "psh_qt_'.mysql_real_escape_string($qst_city).'" LIMIT 1',1);
		//$qcc
		if( $qcc[$dun5] > 0 ) {
			echo '<font color="red"><b>У Вас уже есть задание, завершите его или отмените для получения нового.</b></font><br>';
		}elseif( $qst_city != 'capitalcity' && $qst_city != 'angelscity' && $qst_city != 'suncity' && $qst_city != 'demonscity' && $qst_city != 'dreamscity' && $qst_city != 'abandonedplain' && $qst_city != 'emeraldscity' && $qst_city != 'sandcity' && $qst_city != 'devilscity') {
			echo '<font color="red"><b>Для этой пещеры еще нет заданий</b></font><br>';
		}elseif(!isset($u->city_id[$qst_city])) {
			echo '<font color="red"><b>Зачем подставляете неправильное значение города?</b></font><br>';
		}elseif( isset( $hgo['id'] ) ) {
			echo '<font color="red"><b>Нельзя получать задания чаще одного раза в сутки</b></font><br>';
		} else {
			$sp = mysql_query('SELECT * FROM `quests` WHERE `line` = '.$dun5.' AND `delete`="0"');
			$dq_add = array();
			while( $pl = mysql_fetch_array( $sp ) ) {
				if( $u->rep['rep'.$qst_city] == 24999 ) {
					//квет, рыцарского задания
					if( $pl['kin'] == 2 ) {
						$dq_add = array( 0 => $pl );
					}
				} else {
					if( $pl['kin'] == 0 ) {
						$dq_add[count($dq_add)] = $pl;
					}
				}
			}
			$dq_add = $q->onlyOnceQuest($dq_add, $u->info['id']);
			$dq_add = $dq_add[rand(0,count($dq_add)-1)];
			
			if( $q->testGood($dq_add) == 1 && $dq_add > 0 ) {
				$q->startq_dn($dq_add['id']);
				echo '<font color="red"><b>Вы успешно получили новое задание &quot;'.$dq_add['name'].'&quot;.</b></font><br>'; 
				$u->addAction(time(),'psh_qt_'.$qst_city,$dq_add['id']);
			} else {
				if( $u->rep['rep'.$qst_city] >= 24999 )
				{
					//квест, рыцарского задания
					echo '<font color="red"><b>Вы завершили квестовую линию, ожидайте новых заданий!</b></font><br>';
				} else {
					echo '<font color="red"><b>Не удалось получить задание &quot;'.$dq_add['name'].'&quot;. Попробуйте еще...</b></font><br>';
				}	
			}
			unset( $dq_add );
		}
	} elseif( isset( $_GET['add_quest'] ) && $qc > 0 ) {
		echo '<font color="red"><b>Что-то пошло не так... осторожнее.. <br/><br/></b></font><br>';
	}
	if( $qsee == '' ) {
		$qsee = 'К сожалению у вас нет ни одного задания<br/><br/>';
	}
?>
<br />	<style>
		.btnnewred {
			background-color:#ca726d;
			color:#f8d2d0;
			border-color:#b44039;
			cursor:default;
		}
		.btnnewred:hover {
			background-color:#ca726d;
			cursor:default;
		}
		</style>
		<fieldset style="border: 1px solid;">
		<LEGEND><B><font color=bagr>Текущие задания: </font></B></LEGEND>
		<?=$qsee?>
		<span style="padding-left: 10">
		<?php
		
			$hgo1 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `room` = "'.$u->info['room'].'" AND `time` >= '.(time()-60*60*22+3540).' AND `vars` = "psh_qt_capitalcity"  LIMIT 1',1);
			$hgo2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `room` = "'.$u->info['room'].'" AND `time` >= '.(time()-60*60*22+3540).' AND `vars` = "psh_qt_angelscity" LIMIT 1',1);
			$hgo3 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `room` = "'.$u->info['room'].'" AND `time` >= '.(time()-60*60*22+3540).' AND `vars` = "psh_qt_demonscity" LIMIT 1',1);
			$hgo9 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `room` = "'.$u->info['room'].'" AND `time` >= '.(time()-60*60*22+3540).' AND `vars` = "psh_qt_emeraldscity" LIMIT 1',1);
			$hgo17 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `room` = "'.$u->info['room'].'" AND `time` >= '.(time()-60*60*22+3540).' AND `vars` = "psh_qt_capitalcity" LIMIT 1',1);
			$hgo10 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `room` = "'.$u->info['room'].'" AND `time` >= '.(time()-60*60*22+3540).' AND `vars` = "psh_qt_suncity" LIMIT 1',1);
			$hgo16 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `room` = "'.$u->info['room'].'" AND `time` >= '.(time()-60*60*22+3540).' AND `vars` = "psh_qt_sandcity" LIMIT 1',1);
            $hgo11 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `room` = "'.$u->info['room'].'" AND `time` >= '.(time()-60*60*22+3540).' AND `vars` = "psh_qt_devilscity" LIMIT 1',1);
						
			if( !isset($hgo1['id']) ) { ?>
            <input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Получить задание (ПТП)' onclick='location="main.php?rz=1&add_quest=1&city_quest=capitalcity"' />
            <?php }else{ ?>
            <input disabled="disabled" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Задание будет через <?=$u->timeOut(60*60*22+3540+$hgo1['time']-time())?> (ПТП)' onclick='location="main.php?rz=1&add_quest=1&city_quest=capitalcity"' />
            <?php }
			echo '<br>';
			if( !isset($hgo2['id']) ) { ?>
            <input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Получить задание (Бездна)' onclick='location="main.php?rz=1&add_quest=1&city_quest=angelscity"' />
            <?php }else{ ?>
            <input disabled="disabled" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Задание будет через <?=$u->timeOut(60*60*22+3540+$hgo2['time']-time())?> (Бездна)' onclick='location="main.php?rz=1&add_quest=1&city_quest=angelscity"' />
            <?php }
			echo '<br>';
			if($u->info['level'] > 7) {
			if( !isset($hgo3['id']) ) { ?>
            <input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Получить задание (Катакомбы)' onclick='location="main.php?rz=1&add_quest=1&city_quest=demonscity"' />
            <?php }else{ ?>
            <input disabled="disabled" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Задание будет через <?=$u->timeOut(60*60*22+3540+$hgo3['time']-time())?> (Катакомбы)' onclick='location="main.php?rz=1&add_quest=1&city_quest=demonscity"' />
            <?php } 
			echo '<br>';
			if($u->info['level'] > 8) {
			if( !isset($hgo16['id']) ) { ?>
            <input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Получить задание (Пещера Мглы)' onclick='location="main.php?rz=1&add_quest=1&city_quest=sandcity"' />
            <?php }else{ ?>
            <input disabled="disabled" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Задание будет через <?=$u->timeOut(60*60*22+3540+$hgo16['time']-time())?> (Пещера Мглы)' onclick='location="main.php?rz=1&add_quest=1&city_quest=sandcity"' />
            <?php } }
			echo '<br>';
			if( !isset($hgo10['id']) ) { ?>
            <input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Получить задание (Грибница)' onclick='location="main.php?rz=1&add_quest=1&city_quest=suncity"' />
            <?php }else{ ?>
            <input disabled="disabled" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Задание будет через <?=$u->timeOut(60*60*22+3540+$hgo10['time']-time())?> (Грибница)' onclick='location="main.php?rz=1&add_quest=1&city_quest=suncity"' />
            <?php }
			echo '<br>';
			if( !isset($hgo9['id']) ) { ?>
            <input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Получить задание (Потерянный Вход)' onclick='location="main.php?rz=1&add_quest=1&city_quest=emeraldscity"' />
            <?php }else{ ?>
            <input disabled="disabled" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Задание будет через <?=$u->timeOut(60*60*22+3540+$hgo9['time']-time())?> (Потерянный Вход)' onclick='location="main.php?rz=1&add_quest=1&city_quest=emeraldscity"' />
            <?php }
			echo '<br>';
			?>
			
			<?php if($u->info['level'] > 7) {
			if( !isset($hgo11['id']) ) { ?>
            <input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Получить задание (Туманные Низины)' onclick='location="main.php?rz=1&add_quest=1&city_quest=devilscity"' />
            <?php }else{ ?>
            <input disabled="disabled" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Задание будет через <?=$u->timeOut(60*60*22+3540+$hgo11['time']-time())?> (Туманные Низины)' onclick='location="main.php?rz=1&add_quest=1&city_quest=devilscity"' />
            <?php }	}
			}?>
			
		</span>
		</FIELDSET>

	<br />
	<?php

	//Начисление бонуса награды
	if( isset( $_GET['buy1'] ) )
	{
		$rt = 1;
		if( $_GET['buy1'] == 1 )
		{
			//покупаем статы
			$price = 2000 +($u->rep['add_stats']*100);
			$cur_price = array('price'=>0);
			if( 30 - $u->rep['add_stats'] > 0 && $u->rep['allrep'] - $u->rep['allnurep'] >= $price )// Характеристики!
			{ 
				//if($u->info['id']==4507329) $ADMIN=1;//dg!!!!
				foreach( $dungeon['list'] as $key => $val )
				{
					if($cur_price['price'] < $price)
					{
						$rep_c = $u->rep['rep'.$val] - $u->rep['nu_'.$val];
						if($rep_c < 0) $rep_c = 0;
						$cur = ($price > ($cur_price['price'] + $rep_c) ? $rep_c : ( $rep_c -  (( ( $price - $cur_price['price'] ) - $rep_c )*-1)));
						$cur_price['price'] += $cur;
						$cur_price['nu_'.$val] 	= $cur;
					}
					//pr($key.' = '.$val);
					//pr($u->rep['rep'.$val].' : '.$u->rep['nu_'.$val]);
				}
				
				//pr($price.' : '.$cur_price['price']);
				//pr( $u->rep['allrep'].' : '.$u->rep['allnurep']);

				if( $price == $cur_price['price'] )
				{
					foreach( $dungeon['list'] as $key => $val )
					{
						if( isset( $cur_price['nu_'.$val] ) && isset( $u->rep['nu_'.$val] ) && $rt == 1 )
						{
							$u->rep['nu_'.$val] += $cur_price['nu_'.$val];
							$r = mysql_query('UPDATE `rep` SET `nu_'.$val.'` = "'.$u->rep['nu_'.$val].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
							if($r) $rt = 1; else $rt = 0;
						}
					}

					if($rt==1)
					{
						$u->info['ability']  += 1; $u->rep['add_stats'] += 1;
						mysql_query('UPDATE `rep` SET `add_stats` = "'.$u->rep['add_stats'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						mysql_query('UPDATE `stats` SET `ability` = "'.$u->info['ability'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						echo '<font color="red"><b>Вы успешно приобрели 1 способность за '.$price.' ед. награды</b></font><br>';
					} else {
						echo '<font color="red"><b>Ничего не получилось...</b></font><br><br>';
                        $rt = 0;
					}
				} else {
							echo '<font color="red"><b>Недостаточно репутации.</b></font><br><br>';
							$rt = 0;
						}
			} else {
			   echo '<font color="red"><b>Ничего не получилось...</b></font><br><br>';
                $rt = 0;
			}
		}elseif( $_GET['buy1'] == 2 ) { // Умения!
			$price = 2000 +($u->rep['add_skills']*2000);
			$cur_price = array('price'=>0); 
			if(15-$u->rep['add_skills']>0 && $u->rep['allrep']-$u->rep['allnurep'] >= $price ) { // Умения!
				foreach($dungeon['list'] as $key=>$val){
					if( !( $cur_price['price'] >= $price ) ) {
						$cur_price['price'] += $cur = ( $price > ($cur_price['price'] + ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) ) ? ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) : ( ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) -  (( ( $price - $cur_price['price'] ) - ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) )*-1)));
						$cur_price['nu_'.$val] 	= $cur;
					}
				}
				if( $price == $cur_price['price'] ) {
					foreach( $dungeon['list'] as $key => $val ) {
						if( isset( $cur_price['nu_'.$val] ) && isset( $u->rep['nu_'.$val] ) && $rt == 1 ) {
							$u->rep['nu_'.$val] += $cur_price['nu_'.$val];
							$r = mysql_query('UPDATE `rep` SET `nu_'.$val.'` = "'.$u->rep['nu_'.$val].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
							if($r) $rt = 1; else $rt = 0;
						}
					}
					if($rt==1){
						$u->info['skills']  += 1; $u->rep['add_skills'] += 1;
						mysql_query('UPDATE `rep` SET `add_skills` = "'.$u->rep['add_skills'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						mysql_query('UPDATE `stats` SET `skills` = "'.$u->info['skills'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						echo '<font color="red"><b>Вы успешно приобрели 1 умение за '.$price.' ед. награды</b></font><br>';
					} else {
						echo '<font color="red"><b>Ничего не получилось...</b></font><br><br>';
					}
				} else echo '<font color="red"><b>Недостаточно репутации.</b></font><br><br>';
			} else {
				echo '<font color="red"><b>Ничего не получилось...</b></font><br><br>';
			}
		} elseif( $_GET['buy1'] == 3 ) { // Кредиты
			$price = 100;
			$cur_price = array('price'=>0); 
			if( $u->rep['allrep'] - $u->rep['allnurep'] >= $price) { // Покупаем кредиты
				foreach($dungeon['list'] as $key=>$val){
					if( !( $cur_price['price'] >= $price ) ) {
						$cur_price['price'] += $cur = ( $price > ($cur_price['price'] + ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) ) ? ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) : ( ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) -  (( ( $price - $cur_price['price'] ) - ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) )*-1)));
						$cur_price['nu_'.$val] 	= $cur;
					}
				}
				if( $price == $cur_price['price'] ) {
					foreach( $dungeon['list'] as $key => $val ) {
						if( isset( $cur_price['nu_'.$val] ) && isset( $u->rep['nu_'.$val] ) && $rt == 1 ) {
							$u->rep['nu_'.$val] += $cur_price['nu_'.$val];
							$r = mysql_query('UPDATE `rep` SET `nu_'.$val.'` = "'.$u->rep['nu_'.$val].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
							if($r) $rt = 1; else $rt = 0;
						}
					}
					if($rt==1){
						$u->info['money']  += 10; $u->rep['add_money'] += 10;
						mysql_query('UPDATE `rep` SET `add_money` = "'.$u->rep['add_money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						echo '<font color="red"><b>Вы успешно приобрели 10 кр. за '.$price.' ед. награды</b></font><br>';
					} else {
						echo '<font color="red"><b>Ничего не получилось...</b></font><br><br>';
					}
				} else echo '<font color="red"><b>Недостаточно репутации.</b></font><br><br>';
			}else{
				echo '<font color="red"><b>Ничего не получилось...</b></font><br><br>';
			}
		} elseif( $_GET['buy1'] == 4 ) { // Особенности
			$price = 3000 +($u->rep['add_skills2']*3000);
			$cur_price = array('price'=>0);
			if( 5 - $u->rep['add_skills2'] > 0 && $u->rep['allrep']-$u->rep['allnurep'] >= $price ) { // Особенности
				foreach($dungeon['list'] as $key=>$val){
					if( !( $cur_price['price'] >= $price ) ) {
						$cur_price['price'] += $cur = ( $price > ($cur_price['price'] + ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) ) ? ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) : ( ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) -  (( ( $price - $cur_price['price'] ) - ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) )*-1)));
						$cur_price['nu_'.$val] 	= $cur;
					}
				}
				if( $price == $cur_price['price'] ) {
					foreach( $dungeon['list'] as $key => $val ) {
						if( isset( $cur_price['nu_'.$val] ) && isset( $u->rep['nu_'.$val] ) && $rt == 1 ) {
							$u->rep['nu_'.$val] += $cur_price['nu_'.$val];
							$r = mysql_query('UPDATE `rep` SET `nu_'.$val.'` = "'.$u->rep['nu_'.$val].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
							if($r) $rt = 1; else $rt = 0;
						}
					}
					if($rt==1){
						$u->info['sskills']  += 1; $u->rep['add_skills2'] += 1;
						mysql_query('UPDATE `rep` SET `add_skills2` = "'.$u->rep['add_skills2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						mysql_query('UPDATE `stats` SET `sskills` = "'.$u->info['sskills'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						echo '<font color="red"><b>Вы успешно приобрели 1 особенность за '.$price.' ед. награды</b></font><br>';
					} else {
						echo '<font color="red"><b>Ничего не получилось...</b></font><br><br>';
					}
				} else echo '<font color="red"><b>Недостаточно репутации.</b></font><br><br>';
				
			} else {
				echo '<font color="red"><b>Ничего не получилось...</b></font><br><br>';
			}
	  	}elseif( $_GET['buy1'] == 5 ) {
			//покупаем слоты
			$price = 2000+($u->rep['add_slot']*2000);
			$price_kr = 500+($u->rep['add_slot']*500);
			$cur_price = array('price'=>0);
			if( $price_kr > $u->info['money'] ) {
				echo '<font color=red><b>Недостаточно денег</b></font><br>';
			}elseif( 4 - $u->rep['add_slot'] > 0 && $u->rep['allrep'] - $u->rep['allnurep'] >= $price ) { // Характеристики!
				foreach( $dungeon['list'] as $key => $val ) {
					if( !( $cur_price['price'] >= $price ) ) {
						$cur_price['price'] += $cur = ( $price > ($cur_price['price'] + ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) ) ? ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) : ( ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) -  (( ( $price - $cur_price['price'] ) - ( $u->rep['rep'.$val] - $u->rep['nu_'.$val] ) )*-1)));
						$cur_price['nu_'.$val] 	= $cur;
					}
				}
				
				if( $price == $cur_price['price'] ) {
					foreach( $dungeon['list'] as $key => $val ) {
						if( isset( $cur_price['nu_'.$val] ) && isset( $u->rep['nu_'.$val] ) && $rt == 1 ) {
							$u->rep['nu_'.$val] += $cur_price['nu_'.$val];
							$r = mysql_query('UPDATE `rep` SET `nu_'.$val.'` = "'.$u->rep['nu_'.$val].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
							if($r) $rt = 1; else $rt = 0;
						}
					}
					if($rt==1){

						$u->info['priemslot']  += 1;
						$u->rep['add_slot'] += 1;
						$u->info['money'] -= $price_kr;
						mysql_query('UPDATE `rep` SET `add_slot` = "'.$u->rep['add_slot'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						mysql_query('UPDATE `stats` SET `priemslot` = "'.$u->info['priemslot'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						echo '<font color="red"><b>Вы успешно приобрели 1 слот для приема за '.$price.' награды и '.$price_kr.' кр.</b></font><br>';
					} else {
						echo '<font color="red"><b>Ничего не получилось...</b></font><br><br>';
					}
				} else echo '<font color="red"><b>Недостаточно репутации.</b></font><br><br>';
			} else {
			   echo '<font color="red"><b>Ничего не получилось...</b></font><br><br>';
			}
		}
	}
	//Сумма слотов
	?>
	<table width="99%">
	<tr>
	<td>
	<fieldset style="border: 1px solid;width:100%;">
        <legend><font color=brown><b>Награда: </font></b><font color="darkgreen"><b> <?php echo ( isset( $rt ) && $rt == 1 ? ($u->rep['allrep']-$u->rep['allnurep'])-$cur_price['price'] : ($u->rep['allrep']-$u->rep['allnurep']) );?>
        </font><font color=brown>ед.</b></legend></font>
        <table>
			<?php if( (30-$u->rep['add_stats']) > 0 ) { ?>
            <tr>
				<td>Способность (еще <?=(30-$u->rep['add_stats'])?>)</td>
				<td style='padding-left: 10px'>за<b> <?=2000+($u->rep['add_stats']*100);?></b> ед.</td>
				<td style='padding-left: 10px'><input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Купить'
	  onclick="if (confirm('Купить: Способность?\n\nКупив способность, Вы сможете увеличить характеристики персонажа.\nНапример, можно увеличить силу.')) {location='main.php?rz=1&buy1=1'}" /></td>
			</tr>
            <?php } ?>
			<?php if( (10-$u->rep['add_skills']) > 0 ) { ?>
            <tr>
				<td>Умение (еще <?=(10-$u->rep['add_skills'])?>)</td>
				<td style='padding-left: 10px'>за<b> <?=2000+($u->rep['add_skills']*2000);?></b> ед.</td>
				<td style='padding-left: 10px'><input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Купить'
	  onclick="if (confirm('Купить: Умение?\n\nУмение даёт возможность почуствовать себя мастером меча, топора, магии и т.п.')) {location='main.php?rz=1&buy1=2'}" /></td>
			</tr>
            <?php } ?>
			<?php if( (5-$u->rep['add_skills2']) > 0 ) { ?>
            <tr>
				<td>Особенности (еще <?=(5-$u->rep['add_skills2'])?>)</td>
				<td style='padding-left: 10px'>за<b> <?=3000+($u->rep['add_skills2']*3000);?></b> ед.</td>
				<td style='padding-left: 10px'><input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Купить'
	  onclick="if (confirm('Купить: Умение?\n\nУмение даёт возможность почуствовать себя мастером меча, топора, магии и т.п.')) {location='main.php?rz=1&buy1=4'}" /></td>
			</tr>
            <?php } ?>
			<?php if( (4-$u->rep['add_slot']) > 0 ) { ?>
            <tr>
				<td>Слоты (еще <?=(4-$u->rep['add_slot'])?>)</td>
				<td style='padding-left: 10px'>за <b><?=2000+($u->rep['add_slot']*2000);?></b> ед. и <b><?=500+($u->rep['add_slot']*500); ?></b> кр.</td>
				<td style='padding-left: 10px'><input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Купить'
	  onclick="if (confirm('Купить: слоты?\n\n+1 дополнительный слот для приема')) {location='main.php?rz=1&buy1=5'}" /></td>
			</tr>
            <?php } ?>
        </table>
	</fieldset>
	</td>
	<td>
	    <!--<fieldset style="border: 1px solid;">
	    <legend><b><font color=brown>Сдать пещерные ресурсы:</font></b></legend>
	    <small>Здесь вы можете сдать найденные в пещерах ресурсы и получить немного репутации.</b></small><br>
	    <br>Сдать ресурсы за <b>1 ед.</b></span>:
	    <input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Сдать' onClick="location='main.php?saleres'"/><br><br><br><br>
		</fieldset>-->
	<?php
		$chk = mysql_fetch_array(mysql_query('SELECT COUNT(`u`.`id`),SUM(`m`.`price1`) FROM `items_users` AS `u` LEFT JOIN `items_main` AS `m` ON `u`.`item_id` = `m`.`id` WHERE `m`.`type` = "61" AND `u`.`delete` = "0" AND `u`.`inOdet` = "0" AND `u`.`inShop` = "0" AND `u`.`inTransfer` = "0" AND `u`.`uid` = "'.$u->info['id'].'" LIMIT 1000'));
		if(isset($_GET['buy777']) && $chk[0]>0) {
			?>
	<fieldset style='margin-top:15px;border: 1px solid;'>
		<p><span style="padding-left: 10px">
			<?php
			$chk_cl = mysql_query('SELECT `u`.`id`,`m`.`price1` FROM `items_users` AS `u` LEFT JOIN `items_main` AS `m` ON `u`.`item_id` = `m`.`id` WHERE `m`.`type` = "61" AND `u`.`delete` = "0" AND `u`.`inOdet` = "0" AND `u`.`inShop` = "0" AND `u`.`inTransfer` = "0" AND `u`.`uid` = "'.$u->info['id'].'" LIMIT 1000');
			while($chk_pl = mysql_fetch_array($chk_cl)) {
				if(mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$chk_pl['id'].'" LIMIT 1'));
				{ 
					$x++; $prc += $chk_pl['price1'];
				}
			}
			$u->info['money'] += $prc;
			mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			echo '<font color="red"><b>Вы успешно сдали чеки в количестве '.$x.' шт. на сумму '.$prc.' кр.</b></font><br>'; 
			$chk[0] = 0;
		?>
        </span></p>
      </fieldset>
	  <?php
		}
		if($chk[0]>0) {
		?>
          <input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type='button' value='Сдать чеки'
onclick="if (confirm('Сдать все чеки (<?=$chk[0]?> шт.) находящиеся у Вас в инвентаре за <?=$chk[1]?> кр. ?')) {location='main.php?rz=1&buy777=1'}" />
		<?php } ?>
	  
	  </td>
	  <tr>
	  <table>
</div>
<?
	} else {
		if($dungeonGo == 1){
			if($u->info['dn']==0){
			?>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top">
							<style type="text/css">
							* {
							  box-sizing: border-box;
							}

							label[for] {
							  cursor: pointer;
							}

							input[type="checkbox"] {
							  display: none;
							}

							body {
							  background-color: #c4c4c4;
							}

							input[type="checkbox"]:checked ~ .grid {
							  opacity: .125;
							}

							.grid {
							  border: 1px solid #e5e5e5;
							  display: -webkit-box;
							  display: -webkit-flex;
							  display: -ms-flexbox;
							  display: flex;
							  -webkit-flex-wrap: wrap;
								  -ms-flex-wrap: wrap;
									  flex-wrap: wrap;
							  -webkit-box-align: start;
							  -webkit-align-items: flex-start;
								  -ms-flex-align: start;
									  align-items: flex-start;
							  -webkit-align-content: flex-start;
								  -ms-flex-line-pack: start;
									  align-content: flex-start;
							  z-index: 0;
							  height: 100%;
							  padding: 5px;
							  overflow: auto;
							  background-color: #ccc;
							  text-align: center;
							  -webkit-transition: opacity .15s;
									  transition: opacity .15s;
							}
							.grid .grid-item {
							  display: inline-block;
							  width: 20%;
							  padding: 3px;
							  opacity: .75;
							  -webkit-transition: opacity .5s;
									  transition: opacity .5s;
							}
                            .grid .grid-item input[type=password] {padding: 3px 3px; margin-bottom: 5px;}
							.grid .grid-item:hover {
							  opacity: 1;
							}

							@media screen and (max-width: 1024px) {
							  .grid .grid-item {
								width: 50%;
							  }
							}
                            @media screen and (max-width: 480px) {
							  .grid .grid-item {
								width: 95%;
							  }
							}
							.grid img {
							  max-width: 95%;
							  max-height: 95%;
							  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
                              transition: 0.5s;
							}
                            /*.grid img:hover {transform: scale(1.2);transition: 0.5s;}
							.dun_div {position:relative;}
                            .dun_img {position:absolute; left: 15px; top: 13px;}*/
							</style>
<div class="grid">
  <label class="grid-item">
								<?
								$dungeon_timeout = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "psh12" AND `time` > '.(time()-60*60*3).' LIMIT 1',1);
								$dun_out = (isset($dungeon_timeout['id']) ? 'Задержка еще: '.$u->timeOut(60*60*3-time()+$dungeon_timeout['time']) : '');
                                $pcolor = ''; $onclick = '';

								if($u->info['level'] < 8) $dun_out = 'Уровень маловат';
								if(!$dun_out) $onclick = 'style="cursor:pointer;" onclick="document.getElementById(\'form01\').submit();"';
                                else  $pcolor = 'color:grey;';

								echo '<label style="padding-bottom: 5px;display:block;'.$pcolor.'">';
                                echo '<img src="https://img.testcombats.ru/i/city/fo1.gif" width="17" height="15" /> <b style="font-size:10px;">Тысячи Проклятий [8]</b></label>';
								?>
								<!--<img <?=$onclick;?> src="#" title="ПТП (с 8 ур.)" />-->
								<fieldset style='width:100%; border:0px;'>
								<? if($dun_out) echo $dun_out;
								else {?>
								<form id="form01" autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" id="rpmg01" value="12" />
								<input style='width:100%;' placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="20" size="20" />
								<br>
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add12" value="Создать группу" />
								</form>
								<? }?>
								</fieldset>
								
</label>
  <label class="grid-item">
								<?
								$dungeon_timeout = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "psh101" AND `time` > '.(time()-60*60*3).' LIMIT 1',1);
								$dun_out = (isset($dungeon_timeout['id']) ? 'Задержка еще: '.$u->timeOut(60*60*3-time()+$dungeon_timeout['time']) : '');
                                $pcolor = ''; $onclick = '';
                                
                                if($u->info['level'] < 8) $dun_out = 'Уровень маловат';
                                if(!$dun_out) $onclick = 'style="cursor:pointer;" onclick="document.getElementById(\'form02\').submit();"';
                                else  $pcolor = 'color:grey;';

								echo '<label style="padding-bottom: 5px;display:block;'.$pcolor.'">';
                                echo '<img src="https://img.testcombats.ru/i/city/fo2.gif" width="17" height="15" /> <b style="font-size:10px;">Бездна [8]</b></label>';
								?>
                                
								<!--<img <?=$onclick;?> src="#" title="Бездна (с 8 ур.)"/>-->
								<fieldset style='width:100%; border:0px;'>
                                <? if($dun_out) echo $dun_out;
								else {?>
								<form id="form02" autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" id="rpmg02" value="101" />
								<input style='width:100%;' placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="20" size="20" />
								<br>
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" />
								</form>
                                <? }?>
								</fieldset>
								
  </label>
  <label class="grid-item">		<?
								$dungeon_timeout = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "psh3" AND `time` > '.(time()-60*60*3).' LIMIT 1',1);
								$dun_out = (isset($dungeon_timeout['id']) ? 'Задержка еще: '.$u->timeOut(60*60*3-time()+$dungeon_timeout['time']) : '');
                                $pcolor = ''; $onclick = '';
                                
                                if($u->info['level'] < 9) $dun_out = 'Уровень маловат';
                                if(!$dun_out) $onclick = 'style="cursor:pointer;" onclick="document.getElementById(\'form03\').submit();"';
                                else  $pcolor = 'color:grey;';

								echo '<label style="padding-bottom: 5px;display: block;'.$pcolor.'">';
                                echo '<img src="https://img.testcombats.ru/i/city/fo3.gif" width="17" height="15" /> <b style="font-size:10px;">Катакомбы [9]</b></label>';

								?>
								
								<!--<img <?=$onclick;?> title="Катакомбы (с 9 ур.)"/>-->
								<fieldset style='width:100%; border:0px;'>
                                <? if($dun_out) echo $dun_out;
								else {?>
								<form id="form03" autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" id="rpmg03" value="3" />
								<input style='width:100%;' placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="20" size="20" />
								<br>
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" />
								</form>
                                <? }?>
								</fieldset>
								
  </label>
  <label class="grid-item">
								<?
								$dungeon_timeout = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "psh9" AND `time` > '.(time()-60*60*3).' LIMIT 1',1);
								$dun_out = (isset($dungeon_timeout['id']) ? 'Задержка еще: '.$u->timeOut(60*60*3-time()+$dungeon_timeout['time']) : '');
                                $pcolor = ''; $onclick = '';

                                if($u->info['level'] < 10) $dun_out = 'Уровень маловат';
								if(!$dun_out) $onclick = 'style="cursor:pointer;" onclick="document.getElementById(\'form04\').submit();"';
                                else  $pcolor = 'color:grey;';

								echo '<label style="padding-bottom: 5px;display: block;'.$pcolor.'">';
								echo '<img src="https://img.testcombats.ru/i/city/fo6.gif" width="17" height="15" /> <b style="font-size:10px;">Потерянный Вход [10]</b></label>';
								?>
								<!--<img <?=$onclick;?> title="Потерянный Вход (с 10 ур.)"/>-->
								<fieldset style='width:100%; border:0px;'>
                                <? if($dun_out) echo $dun_out;
								else {?>
                                <form id="form04" autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" id="rpmg04" value="9" />
								<input style='width:100%;' placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="20" size="20" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" />
								</form>
                                <? }?>
								</fieldset>
  </label>
  <label class="grid-item">		
								<?
								$dungeon_timeout = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "psh10" AND `time` > '.(time()-60*60*3).' LIMIT 1',1);
								$dun_out = (isset($dungeon_timeout['id']) ? 'Задержка еще: '.$u->timeOut(60*60*3-time()+$dungeon_timeout['time']) : '');
                                $pcolor = ''; $onclick = '';
                                
                                if($u->info['level'] < 8) $dun_out = 'Уровень маловат';
								if(!$dun_out) $onclick = 'style="cursor:pointer;" onclick="document.getElementById(\'form05\').submit();"';
                                else  $pcolor = 'color:grey;';

								echo '<label style="padding-bottom: 5px;display: block;'.$pcolor.'">';
                                echo '<img src="https://img.testcombats.ru/i/city/fo7.gif" width="17" height="15" /> <b style="font-size:10px;">Грибница [8]</b></label>';
								?>
								<!--<img <?=$onclick;?> title="Грибница (с 8 ур.)"/>-->
								<fieldset style='width:100%; border:0px;'>
                                <? if($dun_out) echo $dun_out;
								else {?>
                                <form id="form05" autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" id="rpmg05" value="10" />
								<input style='width:100%;' placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="20" size="20" />
								<br>
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" />
								</form>
                                <? }?>
								</fieldset>
  </label>
  <label class="grid-item">		<?
								$dungeon_timeout = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "psh7" AND `time` > '.(time()-60*60*3).' LIMIT 1',1);
								$dun_out = (isset($dungeon_timeout['id']) ? 'Задержка еще: '.$u->timeOut(60*60*3-time()+$dungeon_timeout['time']) : '');
                                $pcolor = ''; $onclick = '';
                                
                                if($u->info['level'] < 11) $dun_out = 'Уровень маловат';
								if(!$dun_out) $onclick = 'style="cursor:pointer;" onclick="document.getElementById(\'form06\').submit();"';
                                else  $pcolor = 'color:grey;';

								echo '<label style="padding-bottom: 5px;display: block;'.$pcolor.'">';
                                echo '<img src="https://img.testcombats.ru/i/city/fo4.gif" width="17" height="15" /> <b style="font-size:10px;">Туманные Низины [11]</b></label>';
								?>
								<!--<img <?=$onclick;?> title="Туманные Низины (с 11 ур.)"/>-->
								<fieldset style='width:100%; border:0px;'>
                                <? if($dun_out) echo $dun_out;
								else {?>
                                <form id="form06" autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" id="rpmg06" value="7" />
								<input style='width:100%;' placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="20" size="20" />
								<br>
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" />
								</form>
                                <? } ?>
								</fieldset>
  </label>
   <label class="grid-item">		
								<?
                                //$dun_out = ''; $onclick = '';//Временно
								$dungeon_timeout = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "psh16" AND `time` > '.(time()-60*60*3).' LIMIT 1',1);
								$dun_out = (isset($dungeon_timeout['id']) ? 'Задержка еще: '.$u->timeOut(60*60*3-time()+$dungeon_timeout['time']) : '');
                                $pcolor = ''; $onclick = '';
								
                                if($u->info['level'] < 8) $dun_out = 'Уровень маловат';
								if(!$dun_out) $onclick = 'style="cursor:pointer;" onclick="document.getElementById(\'form07\').submit();"';
                                else  $pcolor = 'color:grey;';
									
								echo '<label style="padding-bottom: 5px;display: block;'.$pcolor.'">';
                                echo '<img src="https://img.testcombats.ru/i/city/fo5.gif" width="17" height="15" /> <b style="font-size:10px;">Пещера Мглы [8]</b></label>';
								?>
								<!--<img <?=$onclick;?> title="Пещера Мглы (с 8 ур.)"/>-->
								<!--<br /><div style="padding-top: 5px;"><b style="color: #ff0000;">(В разработке)</b></div>-->
								<fieldset style='width:100%; border:0px;'>
                                <? if($dun_out) echo $dun_out;
								else { ?>
                                <form id="form07" autocomplete="0" name="form" action="main.php?pz1=<?echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" id="rpmg16" value="16" />
								<input style='width:100%;' placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="20" size="20" />
								<br>
								<!--<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" />-->
								</form>
                                <? } ?>
								</fieldset>
  </label>
  <label class="grid-item"></label>
</div>
								<? if($u->info['admin']>0) { ?>
								<fieldset style='display: inline-block; margin-top: 30px;'>
								<legend><b> Для Админов </b></legend>                                
						
								<label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="1" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/dreamscity.gif" width="34" height="19" /> Водосток</label>
                                <div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
								</form>
								<hr>
                                <label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="12" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/capitalcity.gif" width="34" height="19" /> Тысячи Проклятий</label>
								<div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
                                <label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="101" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/angelscity.gif" width="34" height="19" /> Бездна</label>
								<div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
							    <label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="10" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/suncity.gif" width="34" height="19" /> Грибница</label>
                                <div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
                                <label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="3" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/demonscity.gif" width="34" height="19" /> Катакомбы</label>
								<div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
								<label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="13" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/abandonedplain.gif" width="34" height="19" /> Гора Легиона</label>
								<div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
								<label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="16" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/sandcity.gif" width="34" height="19" /> Пещера Мглы</label>
								<div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
								<label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="8" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/abaddonedplain.gif" width="34" height="19" /> Сторожевая Башня</label><br />
                                <div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
								<label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="104" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/mooncity.gif" width="34" height="19" /> Шахты</label>
								<div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
								<label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="11" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/legion.gif" width="34" height="19" /> Некровиль</label>
                                <div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
								<label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="17" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/capitalcity.gif" width="34" height="19" /> Руины</label>
                                <div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
								<label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="9" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/emeraldscity.gif" width="34" height="19" /> Потерянный Вход</label>
								<div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
								<label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="7" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/devilscity.gif" width="34" height="19" /> Туманные Низины</label>
								<div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
                                <label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="20" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/10.gif" width="34" height="19" /> Ледяная Пещера</label>
								<div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
                                <label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="15" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/10.gif" width="34" height="19" /> Хоккей</label>
								<div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
                                <label>
                                <form autocomplete="0" name="form" action="main.php?pz1=<? echo $code; ?>" method="post">
                                <input type="hidden" name="rpmg1" value="999" />
                                <img style="vertical-align:bottom" src="https://img.testcombats.ru/i/city_ico2/10.gif" width="34" height="19" /> Тестовая локация</label>
								<div align="left"><input placeholder="Пароль для группы" autocomplete="off" type="password" name="pass" maxlength="25" size="25" />
								<input style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type="submit" name="add" value="Создать группу" /></div />
                                </form>
								<hr>
								<? } ?>
							</fieldset>
							
					</td>
				</tr>
			</table>
			<?
			} else {
				$psh_start = '';
				if(isset($zv['id']))
				{
					if($zv['uid']==$u->info['id'])
					{
						$psh_start = '<INPUT style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type=\'button\' name=\'start\' value=\'Начать\' onClick="top.frames[\'main\'].location = \'main.php?start=1&rnd='.$code.'\'"> &nbsp;';
						mysql_query('update `dailybonus` set `dun_go` = `dun_go` + 1 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					}
					echo '<br><FORM autocomplete="off" id="REQUEST" method="post" style="display: inline-block;" action="main.php?rnd='.$code.'">
					<FIELDSET style=\'padding: 5px;\'>
					<LEGEND><B> Группа </B> </LEGEND>
					'.$psh_start.'
					<INPUT style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;" type=\'submit\' name=\'leave\' value=\'Покинуть группу\'> 
					</FIELDSET>
					</FORM>';
				}
			}
		}else{
				if($nTravma) echo '<center><font color=red><b>У вас неизлечимая травма! Вы не можете посещать пещеры.</b></font></center>';
			}
	}
}
?>