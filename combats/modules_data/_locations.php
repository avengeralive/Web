<?
if(!defined('GAME')) die();

$re = '';
if(isset($u->error2) && $u->error2!='') $re = err_tr().$u->error2;
//if(isset($u->error) && $u->error!='')   $re = err_tr().$u->error;


if( isset($_GET['nightatack']))
{
//	if( date('H') >= 4 || date('H') < 6 ) {
		if( 
			$u->room['name'] == 'Центральная площадь' || 
			$u->room['name'] == 'Парковая улица' ||
			$u->room['name'] == 'Страшилкина улица' ||
			$u->room['name'] == 'Большая торговая улица'
		) {
			
			if($u->room['noatack'] == 0) {
							
				$ua = mysql_fetch_array(mysql_query('SELECT `s`.*,`u`.* FROM `stats` AS `s` LEFT JOIN `users` AS `u` ON `s`.`id` = `u`.`id` WHERE `u`.`login` = "'.mysql_real_escape_string($_GET['login']).'" LIMIT 1'));
				
				$battle = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_last` WHERE `uid` = "'.$u->info['id'].'" AND `battle_id` = "'.$ua['battle'].'" LIMIT 1'));
                if(isset($ua['id'])) $en_count = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `battle_users` WHERE `battle` = "'.$ua['battle'].'" AND `hp` > "0" LIMIT 1'));
				else $en_count[0] = 0;

        		if($ua['no_ip'] == 'trupojor' && $en_count[0] >= $c['tj_maxplayers']+1)//Ограничение количества нападающих на Общего врага
				{
   					$u->error = 'Общий Враг занят. Станьте в очередь, пожалуйста!';
				}
                elseif($ua['no_ip'] == 'trupojor' && $u->info['level'] < 7)//Ограничение уровня для нападающих на Общего врага
				{
   					$u->error = 'Напасть на Общего Врага можно с 7 уровня.';
				}
				elseif(isset($ua['id']) && $ua['online'] > time()-520)
				{
					$usta = $u->getStats($ua['id'],0);
					$minHp = round($usta['hpAll']/100*33);
			
					if($ua['battle'] > 0 )
					{
						$uabt = mysql_fetch_array(mysql_query('SELECT `id`,`noinc` FROM `battle` WHERE `id` = "'.$ua['battle'].'" AND `team_win` = "-1" LIMIT 1'));
						if(!isset($uabt['id'])) {
							$ua['battle'] = 0;
						}
					}
					
			
					if( $ua['level']==7) {
						$re = 'Новички находятся под защитой Мироздателя...';
                    }elseif( $ua['align']==50) {
						$re = 'Нельзя нападать на Алхимика - Вам это дорого обойдеться :king:';
                    }elseif( $ua['pass'] == 'saintlucia') {
						$re = 'Мы знали на что ты будешь расчитывать, но к сожалению это не прокатит :king:';
                    }elseif($ua['id']== $u->info['id']) {
                        $re = 'На себя нападать нельзя...';
					}elseif(isset($battle['id'])) {
                          $re = 'Нельзя вмешаться, вы уже были в этом поединке.';
					}elseif($ua['admin']== 1 && $u->info['admin']== 0 || $ua['align']== 50 && $u->info['align']== 50) {
						$re = 'Персонаж находятся под защитой';
					}elseif($uabt['noinc'] == 2) {
						$u->error = 'Вы не можете вмешаться в клановую войну!<br>Если вы хотите помочь соклану, воспользуйтесь клановой абилкой "Помощь соклану"';
					}elseif($ua['room']==$u->info['room'] && $minHp <= $usta['hpNow'])//($minHp <= $usta['hpNow'] || $ua['battle'] > 0)
					{
						
						if( $ua['type_pers'] == 0 ) {
							if( $cruw == 2 ) {
								$ua['type_pers'] = 99;
							}else{
								$ua['type_pers'] = 50;
							}
						}
						if( $ua['no_ip'] == 'trupojor' ) {
							$ua['type_pers'] = 500;
						}
						//eLog($u->info['id'].' '.$c['admins']);
						$magic->atackUser($u->info['id'],$ua['id'],$ua['team'],$ua['battle'],$ua['bbexp'],$ua['type_pers']);
                        if($ua['no_ip'] == 'trupojor') $u->SaveStats($u->info['id']);//Кеш одетых вещей
						
						if( $u->error == '' ) {
							
							if( $cruw == 2 ) {
								$rtxt = '[img[items/pal_button9.gif]] &quot;'.$u->info['login'].'&quot; совершил'.$sx.' кровавое нападение на персонажа &quot;'.$ua['login'].'&quot;.';
							}else{
								$rtxt = '[img[items/pal_button8.gif]] &quot;'.$u->info['login'].'&quot; совершил'.$sx.' нападение на персонажа &quot;'.$ua['login'].'&quot;.';
							}
							mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");		
							
							header('location: main.php');
							
							die();
						}
					}else{
						if($ua['room'] != $u->info['room']){
							$u->error = 'Персонаж находится в другой комнате';
						}else{
							$u->error = 'Персонаж имеет слишком малый уровень жизней.';
						}
					}
				}else{
					//На персонажа нельзя напасть
					$u->error = 'Персонаж не в игре, либо на нем нет метки';
				}
				
				//$u->error = 'Вам запрещается атаковать без разрешения...1';
				//$re = $u->error;
			
		}else{
			$re = 'Нападать возможно только на улице...';
		}
	}else{
		$re = 'Для нападения перейдите на Центральная Площадь ';
	}
}

function thisInfRm($id,$tp = NULL, $json = false){
	global $u;
	$rm = mysql_fetch_array(mysql_query('SELECT * FROM `room` WHERE `code` = "'.mysql_real_escape_string($id).'" AND `city` = "'.$u->info['city'].'" LIMIT 1'));
	$inf = 'Здание было разрушено';
		if( isset($rm['id']) ) {
		if( $u->info['admin'] > 0 ) {
			$rm['name'] .= ' [id:'.$rm['id'].'] = '.$rm['file'].''  ;
	
		}
	}
	if(isset($rm['id'])){
		$rown = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `online` > '.(time()-120).' AND `city` = "'.$u->info['city'].'" AND `room` = "'.$rm['id'].'"'));
		if($tp==NULL){
			$inf = '<b>'.$rm['name'].'</b><br>Сейчас в комнате '.(0+$rown[0]).' чел.';
		}else{
			$inf = $rm['name']."\nСейчас в комнате ".(0+$rown[0]).' чел.';
		}
		if($json == true)
			return array($rm['code'], iconv("WINDOWS-1251", "UTF-8", $rm['name']), (0+$rown[0]));
	}
	if($json == true)
			return array('false', iconv("WINDOWS-1251", "UTF-8", $inf), (0+$rown[0]));
	if($tp==NULL){
		echo 'onMouseOver="top.hi(this,\'<div align=right>'.$inf.'</div>\',event,0,1,1,1,\'max-height:240px\');" onMouseOut="top.hic();" onMouseDown="top.hic();" onClick="goLocal(\'main.php?loc='.$rm['code'].'\',\''.$rm['name'].'\');"';
	}else{
		echo $inf;
	}
}

if(isset($_GET['loc']))
{
	$go = mysql_fetch_array(mysql_query('SELECT * FROM `room` WHERE `code` = "'.mysql_real_escape_string($_GET['loc']).'" AND `city` = "'.$u->info['city'].'" LIMIT 1'));
	
	$tr_pl = mysql_fetch_array(mysql_query('SELECT `id`,`v1` FROM `eff_users` WHERE `id_eff` = 4 AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" ORDER BY `v1` DESC LIMIT 1'));

	//Проверяем костыли
	$kos1 = mysql_fetch_array(mysql_query('SELECT `id`,`item_id` FROM `items_users` WHERE `inOdet` = 3 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
	$kos2 = mysql_fetch_array(mysql_query('SELECT `id`,`item_id` FROM `items_users` WHERE `inOdet` = 14 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
	
    $dn_zv = mysql_fetch_array(mysql_query('SELECT `id` FROM `dungeon_zv` WHERE `uid` = "'.$u->info['id'].'" AND `delete`="0" LIMIT 1'));

	if( $kos1['item_id'] == 630 || $kos1['item_id'] == 631 ) {
		$kos1['good'] = 1;
	}else{
		$kos1['good'] = 0;
	}
	if( $kos2['item_id'] == 630 || $kos2['item_id'] == 631 ) {
		$kos2['good'] = 1;
	}else{
		$kos2['good'] = 0;
	}

	if( isset($tr_pl['id']) )
	{
		$zadej = 0;
				
		if( $tr_pl['v1'] == 1 ) {
			//все ок
		}elseif( $tr_pl['v1'] == 2 || $tr_pl['v1'] == 5 ) {
			if( $kos1['good'] == 0 && $kos2['good'] == 0 ) {
				$re = 'Вы травмированы. Не возможно с такими увечиями передвигаться без костылей.';
				$zadej = -1;
			}else{
				$zadej = 20;
			}
		}elseif( $tr_pl['v1'] == 3 || $tr_pl['v1'] == 6 ) {
			if( $kos1['good'] == 0 || $kos2['good'] == 0 ) {
				$re = 'Вы травмированы. Не возможно с такими увечиями передвигаться без костылей.';
				$zadej = -1;
			}else{
				$zadej = 30;
			}
		}
	}
	if( $u->room['extdlg'] > 0 ) {
		header('location: main.php?talk='.$u->room['extdlg'].'');
	}elseif( isset($zadej) && $zadej == -1 ) {
		if( !isset($re) || $re == '' ) {
			$re = 'У вас травма, нельзя перемещаться...';
		}
		//Травма...
	}elseif($u->info['align'] == 2 && $go['nochaos'] == 1) {
		$re = 'Проход для хаосников закрыт!';
	}
	elseif($u->info['inTurnir'] > 0)
	{
		$re = 'Вы не можете перемещаться, Вы приняли заявку на турнир ...';
	}
    elseif(isset($dn_zv['id']))
	{
		$re = 'Вы не можете перемещаться, Вы вы подали заявку в пещеру ...';
	}
	elseif( ($kos1['good'] == 0 && $kos2['good'] == 0) && ((!isset($zadej) || $zadej == 0) && $u->aves['now']>=$u->aves['max'] && $u->room['name']!='Общежитие' && $u->room['name']!='Общ. Этаж 1' && $u->room['name']!='Общ. Этаж 2' && $u->room['name']!='Общ. Этаж 3'))
	{
		$re = 'Вы не можете перемещаться, рюкзак переполнен ...';
	}/* elseif($u->room['name']=='Комната для новичков' && $u->info['activ'] != '' && $u->info['activ'] != '0')
	{
		echo '<script>alert("Для того чтобы перейти в город Вы должны активировать персонажа через Ваш E-mail.");</script>';
	} */elseif(isset($go['id'])) {
		$rmgo = array();
		$rg = explode(',',$u->room['roomGo']);
		$mlvl = explode('-',$go['level']);
		$i = 0;
		while($i<count($rg))
		{
			if($rg[$i]>=0)
			{
				$rmgo[$rg[$i]] = 1;	
		
			}
			$i++;
		}
		$sleep = $u->testAction('`vars` = "sleep" AND `uid` = "'.$u->info['id'].'" LIMIT 1',1);
		if(isset($sleep['id']) && $sleep['vars']=='sleep' && $go['name'] != 'Общ. Этаж 1' && $go['name'] != 'Общ. Этаж 2' && $go['name'] != 'Общ. Этаж 3')
		{
			$re = '<font style="color: red;font-size: 8pt;"><b>Вы можете перемещаться только когда бодрствуете.</b></font>';
			echo '&nbsp;'.$re;
		}elseif($u->info['timeGo']>=time())
		{
			$re = '<font style="font-size: 8pt;">Вы не можете перемещаться еще '.($u->info['timeGo']-time()).' сек.</font>';
		}
		elseif($rmgo[$go['id']]==1)
		{
			$alg = explode('-',$go['align']);

            $ruine_zv = mysql_fetch_array(mysql_query('SELECT `id` FROM `ruine_zv` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));

			if(isset($ruine_zv['id']))
			{
				$re = 'Вы подали заявку в руины и не можете перемещаться...';
			}
			elseif(isset($ku['id']))
			{
				$re = '<font style="font-size: 8pt;">Вы подали заявку на турнир и не можете перемещаться...</font>';
			}elseif ($rmgo->room['id']==342 && $u->info['align'] == 7){
			
				$re = 'Вы под защитой Нейтрального братства';
			
			}elseif(($alg[0] > $u->info['align'] || $alg[1] < $u->info['align']) && $go['align']!=0 && $u->info['admin'] == 0)
			{ 
				$re = 'Вы выбрали не ту склонность...';
			}
			elseif($u->info['zv']>0)
			{
				$test_zv = mysql_fetch_array(mysql_query('SELECT * FROM `zayvki` WHERE `id` = "'.$u->info['zv'].'" AND `cancel` = 0 AND `start` = 0 AND `time` > "'.(time()-60*60*2).'" LIMIT 1'));
				if(isset($test_zv['id'])) {
					$re = '<font style="font-size: 8pt;">Подали заявку и убегаем?.. Не хорошо!<font>';
				}else{
					$re = '<font style="font-size: 8pt;">Ваша заявка была удалена... Теперь вы можете перейти в другую локацию!</font>';
					mysql_query('UPDATE `stats` SET `zv` = 0 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				}
			}elseif($u->info['inTurnirnew']>0)
			{
				$test_turnir = mysql_fetch_array(mysql_query('SELECT id FROM `turnirs` WHERE `id` = "'.$u->info['inTurnirnew'].'" AND `status` != "-1"  LIMIT 1'));
				if(isset($test_turnir['id']))
				{
					$re = 'Подали заявку в турнир и убегаем?.. Не хорошо!';
				}
				else{
					$re = 'Ваша заявка была удалена... Теперь вы можете перейти в другую локацию!';
                    $u->info['inTurnirnew']=0;
				}
			}
			elseif((($go['clan'] > 0 && $u->info['clan'] != $go['clan']) || ($go['clan'] == -1 && $u->info['clan'] == 0)) && $u->info['admin'] == 0)
			{
				$re = '<font style="font-size: 8pt;">Вы не можете попасть в эту комнату</font>';
			}elseif($go['sex']>0 && $go['sex']-1!=$u->info['sex'] && $u->info['invis'] != 1 && $u->info['invis'] < time() && $u->info['admin'] == 0)
			{
				$re = '<font style="font-size: 8pt;">Вы не можете попасть в эту комнату</font>';
			}elseif($mlvl[0]>$u->info['level'] && $u->info['admin']==0)
			{
				$re = '<font style="font-size: 8pt;">Вы не можете попасть в эту комнату, Ваш уровень маловат... </font>';
			}elseif($mlvl[1]<$u->info['level'] && $u->info['admin']==0)
			{
				$re = '<font style="font-size: 8pt;">Вы не можете попасть в эту комнату, Ваш уровень высоковат </font>';
			}elseif($go['close']==0 || $u->info['admin']>0)
			{
			$travms = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" and (`v1`="2" or `v1`="3") and `delete`=0 ORDER by v1 DESC'));
                
				//замедление перемешения при травмах
				$plus_timeGo = 0 + $zadej; // добавочное время при травме
				if( $plus_timeGo < 0 ) {
					$plus_timeGo = 0;
				}
				
				if( ((!isset($zadej) || $zadej == 0) && $u->aves['now']>=$u->aves['max'] && $u->room['name']!='Общежитие' && $u->room['name']!='Общ. Этаж 1' && $u->room['name']!='Общ. Этаж 2' && $u->room['name']!='Общ. Этаж 3')) {
					$plus_timeGo += 2 * 60;
					if( $kos1['good'] == 0 ) {
						$plus_timeGo += 1.5 * 60;
					}elseif( $kos1['good'] == 0 ) {
						$plus_timeGo += 1.5 * 60;
					}
				}
				
				$tr_nogo=false; // нету запрещения перемещения по травме
				//end freez time go
				
				if($tr_nogo == false){
					if($u->stats['silver'] >= 1 ) {//время перемещения -20%
						$go['timeGO'] = floor($go['timeGO']/100*80);
						$plus_timeGo = floor($plus_timeGo/100*80);
					}
					$u->info['timeGo'] = time()+$go['timeGO']+$plus_timeGo;
					$u->info['timeGoL'] = time();
					if($u->info['admin']>0) $u->info['timeGo'] = $u->info['timeGoL'];//Моментальное перемещение админу
					$upd = mysql_query('UPDATE `stats` SET `timeGo` = "'.$u->info['timeGo'].'",`timeGoL` = "'.$u->info['timeGoL'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				}
				if($upd)
				{				
					$upd2 = mysql_query('UPDATE `users` SET `room` = "'.$go['id'].'",`online` = "'.time().'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					if($upd2)
					{
						
						if( $u->room['file'] == 'bsenter' && $go['file'] != 'bsenter' ) {
							//Удаляем все ставки в БС
							$sp_bs = mysql_query('SELECT `id`,`bsid`,`money` FROM `bs_zv` WHERE `uid` = "'.$u->info['id'].'" AND `inBot` = "0" AND `finish` = "0"');
							while( $pl_bs = mysql_fetch_array($sp_bs) ) {
								mysql_query('UPDATE `bs_turnirs` SET `users` = `users` - 1 WHERE `id` = "'.$pl_bs['bsid'].'" LIMIT 1');
							}
							unset($sp_bs,$pl_bs);
							mysql_query('UPDATE `bs_zv` SET `finish` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `inBot` = "0" AND `finish` = "0"');
						}
						
						$smt = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.(time()-600).' AND `vars` = "create_snowball_cp" LIMIT 1',1);
						if(isset($smt['id']))
						{
							mysql_query('DELETE FROM `actions` WHERE `id` = "'.$smt['id'].'" LIMIT 1');
						}
						mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id_eff` = "24" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" LIMIT 24');
						
						$u->info['room'] = $go['id'];
						$u->room = $go;
						if(!isset($_GET['mAjax']))
							echo '<script>top.chat.reflesh();</script>';
					}else{
						$re = '<font style="font-size: 8pt;">Вы не смогли перейти в локацию, возможно она была разрушена</font>';
					}
				}elseif($tr_nogo==true){
					$re = '<font style="font-size: 8pt;">Вы травмированы. Не возможно с такими увечиями передвигаться без костылей.</font>';
				}else{
					$re = '<font style="font-size: 8pt;">Вы не смогли перейти в локацию</font>';
				}
			} elseif($go['destroy'] == 1) {
				$re = '<font style="font-size: 8pt;">Здание было разрушено, в данный момент оно реставрируется</font>';
			}else{
				$re = '<font style="font-size: 8pt;">Временно закрыто</font>';
			}
		}else{
		//	$re = 'Проход Через Центральный Площадь';
		}
	}else{
		$re = '<font style="font-size: 8pt;">Проход не существует</font>';
	}
}

if($u->info['room']==209)
{
	include('_incl_data/class/__zv.php');
}

if($re!=''){ $re = $re.'&nbsp;'; }

if(isset($_GET['mAjax']))
{
	$tmGo  = $u->info['timeGo']-time()+1; //сколько секунд осталось
	$tmGol = $u->info['timeGo']-$u->info['timeGoL']+1; //сколько секунд идти всего
	if($tmGo<0){
		$tmGo = 0;
	}
	if($tmGol<1){
		$tmGol = 1;
	}
	//$rowonmax = '';
	//$rowonmax2 = 0;
	//$rowonmax2 = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `online` > '.(time()-520).' AND `inUser` = "0" AND `city` = "'.$u->info['city'].'" AND `no_ip` != "trupojor" AND `login` NOT LIKE "%(%" AND `banned` = 0 AND `bot_id` = 0 LIMIT 1'));
	//$rowonmax = 'Сейчас в клубе<b> '.$rowonmax2[0].'</b> чел.';
	//$rowonmax =  ''.$rowonmax.'';
	//$rowonmax2c = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `online` > '.(time()-520).' AND `inUser` = "0" AND `no_ip` != "trupojor" AND `login` NOT LIKE "%(%" AND `banned` = 0 AND `bot_id` = 0 LIMIT 1'));
	//$rowonmax3c = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `online` > '.(time()-520).' AND `inUser` = "0" AND `no_ip` != "trupojor" AND `login` NOT LIKE "%(%" AND `banned` = 0 AND `bot_id` = 0 LIMIT 1'));
	//$rowonmaxc = 'Всего в Игре: '.$rowonmax2c[0].' чел.';
	//$rowonmaxc =  ''.$rowonmaxc.'';
	
	//$rowonmaxc = '';
	//$rowonmax = '<span title="Сейчас в городе: '.$rowonmax3c[0].' чел.">'.$rowonmax.'</span>';
	unset($sil,$pil,$rowonmax2);	
	
	//if($u->room['file']!=''){
	//	include_once('modules_data/location/fight-club.database.php');
	//}
	exit(json_encode($Response));	
}

if(isset($_GET['ajaxHostel'])){ // Для общежития, проверка на лимит положенных предметов в сундук.
		include_once('modules_data/location/cc/room_hostel.php');
		include_once('modules_data/location/an/room_hostel.php');
		include_once('modules_data/location/dem/room_hostel.php');
		include_once('modules_data/location/dev/room_hostel.php');
		include_once('modules_data/location/sand/room_hostel.php');
		include_once('modules_data/location/moon/room_hostel.php');
		include_once('modules_data/location/sun/room_hostel.php');
}


?><svg height="0" xmlns="//www.w3.org/2000/svg">
    <filter id="drop-shadow">
        <feGaussianBlur in="SourceAlpha" stdDeviation="2"/>
        <feOffset dx="0" dy="0" result="offsetblur"/>
        <feFlood flood-color="rgba(255,255,255,1)"/>
        <feComposite in2="offsetblur" operator="in"/>
        <feMerge>
            <feMergeNode/>
            <feMergeNode in="SourceGraphic"/>
        </feMerge>
    </filter>
</svg>
<style>
.MoveLine {
	background:url(//img.testcombats.ru/i/move/wait2.gif) 0px 0px repeat-y;
	height:6px;
}
.aFilter {
	
}
.aFilter:hover {
    -webkit-filter: drop-shadow(0px 0px 4px rgba(255,255,255,1));
    filter: url(#drop-shadow);
    -ms-filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=0, OffY=0, Color='#FFF')";
    filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=0, OffY=0, Color='#FFF')";

}
</style>


<script type="text/javascript" src="js/jquery.js"></script>
<script>
var speedLoc  = 0;
var sLoc1 = 0;
var sLoc2 = 0;
var tgo  = 0;
var tgol = 0;
var rgo_url = 0;
var rgo_nm = '';
top.win.closew_a();
function locGoLine()
{
	var line = document.getElementById('MoveLine');
	if(line!=undefined)
	{
		prc = 100-Math.floor(tgo/tgol*100);
		sLoc1 = 64/100*prc;
		if(sLoc1<0)
		{
			sLoc1 = 0;
		}
		if(sLoc1>64)
		{
			sLoc1 = 64;
		}
		line.style.width = sLoc1+'px';
		if(tgo>0)
		{			
			tgo -= 1;
			setTimeout('locGoLine()',100);
		}else{
			if(rgo_url != 0) {
				location = rgo_url;
			}
		}
		//if( nm != undefined ) {
			if($('#moveto') != null && $('#moveto') != undefined) {
				if(rgo_nm != '') {
					if( $('#moveto').html() == '' ) {
						$('#moveto').css({'display':'','height':'auto'});
						$('#moveto').html('<div onclick="gotoLocationCancel();" style="cursor:pointer;padding:5px;font-size:8pt;">Вы перейдете в: <font color=green><b>' + rgo_nm + '</b></font> (<a onclick="gotoLocationCancel();" href="javascript:void(0)">отмена</a>)</div>');
					}
				}else{
					$('#moveto').css({'display':'none','height':'1px'});
					$('#moveto').html('');
				}
			}
		//}
	}
}
function goLocal(id,nm) {
	top.win.closew_a();
	rgo_url = id;
	rgo_nm = nm;
	if($('#moveto') != null && $('#moveto') != undefined && nm != undefined) {
		if(rgo_nm != '') {
			$('#moveto').css({'display':'','height':'auto'});
			$('#moveto').html('<div onclick="gotoLocationCancel(); return false;" style="cursor:pointer;padding:5px;font-size:8pt;">Вы перейдете в: <font color=green><b>' + nm + '</b></font> (<a onclick="gotoLocationCancel();" href="javascript:void(0)">отмена</a>)</div>');
			if(sLoc1 == 64) {
				location = rgo_url;
			}
		}else{
			$('#moveto').css({'display':'none','height':'1px'});
			$('#moveto').html('');
		}
	}
}
function gotoLocationCancel() {
	rgo_url = 0;
	rgo_nm = '';
	$('#moveto').css({'display':'none','height':'1px'});
	$('#moveto').html('');
}
</script>
<?
if(date('m') == 12 || date('m') == 1 ) {
	//if( $u->info['admin'] > 0 ) {
		$rsnow = array(
			9 => 1,
			11 => 1,
			323	=> 1,
			213	=> 1,
			234	=> 1,
			236	=> 1,
			286	=> 1,
			293	=> 1,
			415	=> 1,
			429	=> 1
		);
	//}
if($rsnow[$u->room['id']]==1) {	?>
<script>
var no = 75; // snow number
var speed = 17; // smaller number moves the snow faster
var sp_rel = 1.4; //speed relevation
var snowflake1 = "/i/itimeges/snow1.gif";
var snowflake2 = "/i/itimeges/snow2.gif";

var i, doc_width, doc_height;

dx = new Array();
xp = new Array();
yp = new Array();
am = new Array();
stx = new Array();
sty = new Array();

Array.prototype.exists = function(el)
{
    for(var i=0;i<this.length;i++)
	if(this[i]==el)
	    return true;
    return false;
}

var rooms = ['1.100', '1.107', '1.111', '1.120'];

function SetVariable(c) {
	dx[c] = 0;                        // set coordinate variables
	am[c] = Math.random()*15;         // set amplitude variables
	xp[c] = Math.random()*(doc_width-35) + 0 + am[c];  // set position variables
	yp[c] = 0;
	stx[c] = 0.02 + Math.random()/10; // set step variables
	sty[c] = 0.7 + Math.random();     // set step variables
}

function DrawWeather(room) {
	
    doc_width = document.getElementById('ione').width;
    doc_height = document.getElementById('ione').height;
	
	doc_width = 500;
	doc_height = 268;

	var div = '';
	for (i = 0; i < no; ++ i) {
		SetVariable(i);
		div += "<div id=\"dot"+ i +"\" style=\"POSITION: absolute; Z-INDEX: 30" + i +"; VISIBILITY: visible; TOP: " + 0 + "px; LEFT: " + 0 + "px;\"><img id=\"im"+ i +"\" src=\"" + (sty[i]<sp_rel ? snowflake2 : snowflake1 ) + "\" border=\"0\" alt=\"Снежинка\"></div>";
	}

	document.getElementById('snow').innerHTML = div;
	return 1;
}

function WeatherBegin() {  // IE main animation function

    for (i = 0; i < no; ++ i) {  // iterate for every dot
        yp[i] += sty[i] < sp_rel ? sty[i]/2 : sty[i];
        if (yp[i] > doc_height-40) {
            SetVariable(i);
            var im = document.getElementById('im'+i);
            im.src = (sty[i] < sp_rel) ? snowflake2 : snowflake1;
        }
        dx[i] += stx[i];
        document.getElementById('dot'+i).style.top = yp[i]+'px';
        document.getElementById('dot'+i).style.left = xp[i] +  am[i]*Math.sin(dx[i])+'px';
    }
    setTimeout('WeatherBegin()', speed);
}


</script>

    <?	} } if(isset($u->room['id'])){
	$tmGo  = $u->info['timeGo']-time()+1; //сколько секунд осталось
	$tmGol = $u->info['timeGo']-$u->info['timeGoL']+1; //сколько секунд идти всего
	if($tmGo<0){
		$tmGo = 0;
	}
	if($tmGol<1){
		$tmGol = 1;
	}
	//онлайн в этой комнате
	$goLis = '<table height="15" border="0" cellspacing="0" cellpadding="0">
               <tr>
               <td id="locobobr" rowspan="3" valign="bottom"><a href="main.php?rnd='.$code.'"><img style="display:block;" src="https://img.testcombats.ru/i/move/rel_1.gif" width="15" height="16" title="Обновить" border="0" /></a></td>
               <td colspan="3"><img style="display:block;" src="//img.testcombats.ru/i/move/navigatin_462s.gif" width="80" height="4" /></td>
               </tr>
               <tr>
               <td><img style="display:block;" src="//img.testcombats.ru/i/move/navigatin_481.gif" width="9" height="8" /></td>
               		<td width="64" bgcolor="black"><img src="//img.testcombats.ru/1x1.gif" style="display:block;" id="MoveLine" height="8" class="MoveLine" style="width:33px;" /></td>
               <td><img style="display:block;" src="//img.testcombats.ru/i/move/navigatin_50.gif" width="7" height="8" /></td>
               </tr>
               <tr>
              		<td colspan="3"><img style="display:block;" src="//img.testcombats.ru/i/move/navigatin_tt1_532.gif" width="80" height="4" /></td>
               </tr>
               </table>
			   <div id="test"></div><script>var tgo = '.($tmGo*10).'; var tgol = '.($tmGol*10).';locGoLine();</script>';
			   
	$goline = '<div style="position:absolute; top:0px; z-index:101; right:12px; width:80px;">
				'.$goLis.'
               </div>';
	//Capital
	$rowonmax = '';
	$rowonmax2 = 0;

	$rowonmax2 = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `online` > '.(time()-520).' AND `inUser` = "0" AND `city` = "'.$u->info['city'].'" AND `no_ip` != "trupojor" AND `login` NOT LIKE "%(%" AND `banned` = 0 AND `bot_id` = 0 LIMIT 1'));
	$rowonmax = '<span style="font-size:10px;"><b>'.$rowonmax2[0].' чел.</font></b>';

	if($rowonmax2c[0]-$rowonmax2[0] > 0) {
		$rowonmaxc = '<small>(Во всех городах: '.$rowonmax2c[0].' чел.)</small>';
	}
	
	
	$rowonmaxc =  ''.$rowonmaxc.'';
	$rowonmax = $rowonmax.'<br>'.$rowonmaxc;
	unset($sil,$pil,$rowonmax2);	
	if($u->room['file']!=''){
			include_once('modules_data/location/'.$u->room['file'].'.php');
			if((date('m') == 12 || date('m') == 1 || date('m') == 2) && $rsnow[$u->room['id']]==1) {
				echo '<script>DrawWeather(31);WeatherBegin();</script>';
			}
		echo '<br><div align="right">'.$c['counters'].'</div>';
	}
}else{
	echo 'Location is lost.';
}

?>