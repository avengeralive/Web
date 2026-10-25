<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Коснуться Земли
*/
$pvr = array();

//Действие при клике
if( isset($pr_momental_this)) {
	$fx_moment = function(  $uid, $enemy, $j_id, $yron, $profil, $inlog ) {
		return round($yron);
	};
}elseif( isset($pr_tested_this) ) {
		$fx_priem = function(  $id , $at , $uid, $j_id ) {
		return $at;
	};
	unset( $pr_used_this );
}elseif( isset($pr_used_this) && isset($pr_moment) ) { 
	$fx_priem = function(  $id , $at , $uid, $j_id ) {
		return $at;
	};
	unset( $pr_used_this );
}else{
	//Действие при клике
	/*
	$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
		'Медитация',
		'{tm1} '.$btl->addlt(1 , 21 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL).'',
		($btl->hodID+1)
	);
	*/
				//
				$pvr['mp'] = round($u->stats['mpAll']*0.03);
				$pvr['mpSee'] = 0;
				$pvr['mpNow'] = floor($u->stats['mpNow']);
				$pvr['mpAll'] = $u->stats['mpAll'];
				$pvr['mpTr'] = $pvr['mpAll'] - $pvr['mpNow'];
				
				//$pvr['mp'] = $btl->hphe( $u->info['id'] , $pvr['hp'] );
				
				if( $pvr['mpTr'] > 0 ) {
					//Требуется хилл
					if( $pvr['mpTr'] < $pvr['mp'] ) {
						$pvr['mp'] = $pvr['mpTr'];
					}
					$pvr['mpSee'] = '+'.$pvr['mp'];
					$pvr['mpNow'] += $pvr['mp'];
				}					
				if( $pvr['mpNow'] > $pvr['mpAll'] ) {
					$pvr['mpNow'] = $pvr['mpAll'];
				}elseif( $pvr['mpNow'] < 0 ) {
					$pvr['mpNow'] = 0;
				}
				if( $pvr['mpSee'] == 0 ) {
					$pvr['mpSee'] = '--';
				}
				//
				//$btl->users[$btl->uids[$u->info['id']]]['last_hp'] = $pvr['hp'];
				//
				$pvr['color2'] = $btl->mcolor[$btl->mname['земля']];
				//
				$u->stats['mpNow'] = $pvr['mpNow'];	
				$u->info['mpNow'] = $pvr['mpNow'];	
				$btl->stats[$btl->uids[$u->info['id']]]['mpNow'] = $pvr['mpNow'];
				$btl->users[$btl->uids[$u->info['id']]]['mpNow'] = $pvr['mpNow'];
				//
				//$btl->users[$btl->uids[$u->info['id']]]['last_hp'] = $pvr['hp'];
				//
				$pvr['color2'] = $btl->mcolor[$btl->mname['земля']];
				//								
				mysql_query('UPDATE `stats` SET `mpNow` = "'.$u->stats['mpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				//
				$btl->priemAddLogFast( $u->info['id'], 0, "<font color^^^^#".$pvr['color2'].">Коснуться Земли</font>",
					'{tm1} '.$btl->addlt(1 , 21 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL).' на <font Color=#006699><b>'.$pvr['mpSee'].'</b></font> ['.$pvr['mpNow'].'/'.$pvr['mpAll'].'] (Мана)',
				1, time() );					
				//
				$pvr['no'] = ' AND `a`.`v2` != 201';
				$pvr['no'] .= ' AND `a`.`v2` != 31';

				$pvr['no'] .= ' AND `a`.`v2` != 191';
				$pvr['no'] .= ' AND `a`.`v2` != 280';
				$pvr['no'] .= ' AND `a`.`v2` != 201';
				$pvr['no'] .= ' AND `a`.`v2` != 42 AND `a`.`v2` != 121 AND `a`.`v2` != 122 AND `a`.`v2` != 123 AND `a`.`v2` != 124 AND `a`.`v2` != 125';
				$pvr['no'] .= ' AND `a`.`v2` != 186 AND `a`.`v2` != 246 AND `a`.`v2` != 257 AND `a`.`v2` != 281';
				$pvr['no'] .= ' AND `a`.`v2` != 282';
				$pvr['no'] .= ' AND `a`.`v2` != 21 AND `a`.`v2` != 73 AND `a`.`v2` != 74 AND `a`.`v2` != 75 AND `a`.`v2` != 76 AND `a`.`v2` != 77 AND `a`.`v2` != 78 AND `a`.`v2` != 79';
				
				$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Оледенение%" ';
				$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Серое Мастерство%" ';
				$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Метеорит%" ';
				$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Регенерация%" ';
				$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Туманный образ%" ';
				$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Жертва%" ';
				$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Призрачн%" ';
				
				$pvr['sp'] = mysql_query('SELECT `a`.*, `a`.`id` AS `ueffid` FROM `eff_users` AS `a` LEFT JOIN `priems` AS `b` ON `b`.`id` = `a`.`v2` WHERE `a`.`uid` = "'.$u->info['id'].'" AND `a`.`delete` = 0 AND `a`.`v1` = "priem" '.$pvr['no'].' AND ( (`b`.`neg` > 0 AND `a`.`v2` != 260) OR `a`.`v2` = 191 OR ( `a`.`v2` = 260 AND `a`.`data` NOT LIKE "%add_mg2static_points=0%"  ) ) ORDER BY `a`.`id` DESC LIMIT 1');
				$pvr['pl'] = mysql_fetch_array($pvr['sp']);
				$pvr['pl']['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pvr['pl']['v2'].'" LIMIT 1'));
				if( isset($pvr['pl']['priem']) ) {
					$pvr['edt'] = $u->lookStats($pvr['pl']['data']);	
					$pvr['edt']['add_zm2proc'] = 0;
					$pvr['edt']['add_mg2static_points'] = 0;
					$pvr['edt'] = $u->impStats($pvr['edt']);
					
					if( $pvr['pl']['priem']['id'] == 260 ) {
						$prv['color2'] = '000000';
						$prv['text'] = $btl->addlt(1 , 19 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL);	
						$prv['text2'] = '{tm1} Закончилось действие эффекта &quot;<b>Заряд</b>&quot; для {u1}.';
						$btl->priemAddLog( $id, 1, 2, $u->info['id'], 0,
							'',
							$prv['text2'],
							($btl->hodID + 0)
						);	
						mysql_query('UPDATE `eff_users` SET `x` = 1, `data` = "'.$pvr['edt'].'" WHERE `id` = "'.$pvr['pl']['ueffid'].'" LIMIT 1');
					}else{
						$btl->delPriem($pvr['pl'],$btl->users[$btl->uids[$u->info['id']]],100);	
					}
				}
				//
	echo '<font color=red><b>Вы успешно использовали прием &quot;Жертва Земле&quot;</b></font>';
	//$this->addEffPr($pl,$id);
}

unset($pvr);
?>