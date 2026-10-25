<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Подлечить
*/
$pvr = array();
if( isset($pr_used_this) && isset($pr_moment) ) {
	//Каждый ход
	$fx_priem = function(  $id , $at , $uid, $j_id ) {
		// -- начало приема
		global $u, $btl, $priem;	
		//
		//Параметры приема
		$pvr['used'] = 0;
		//		
		$uid1 = $btl->atacks[$id]['uid1'];
		$uid2 = $btl->atacks[$id]['uid2'];			
		if( $uid == $uid1 ) {
			$a = 1;
			$b = 2;
			$u1 = ${'uid1'};
			$u2 = ${'uid2'};
		}elseif( $uid == $uid2 ) {
			$a = 2;
			$b = 1;
			$u1 = ${'uid2'};
			$u2 = ${'uid1'};
		}
		if( $a > 0 ) {
			
			//Проверяем эффект
			$prv['j_priem'] = $btl->stats[$btl->uids[$u1]]['u_priem'][$j_id][0];
			$prv['priem_th'] = $btl->stats[$btl->uids[$u1]]['effects'][$prv['j_priem']]['id'];
			
			//действия
			$pvr['hp'] = 20;
			$pvr['hp'] = $priem->magatack( $btl->stats[$btl->uids[$u1]]['effects'][$prv['j_priem']]['user_use'], $u1, $pvr['hp'], 'тьма', 1 );
			$pvr['promah_type'] = $pvr['hp'][3];
			$pvr['promah'] = $pvr['hp'][2];
			$pvr['krit'] = $pvr['hp'][1];
			$pvr['hp']   = $pvr['hp'][0];
			
			$btl->stats[$btl->uids[$u1]]['effects'][$prv['j_priem']]['data'] = $pvr['redata'];
			mysql_query('UPDATE `eff_users` SET `data` = "'.$pvr['redata'].'" WHERE `id` = "'.$btl->stats[$btl->uids[$u1]]['effects'][$prv['j_priem']]['id'].'" LIMIT 1');
			//			
				//$btl->stats[$btl->uids[$this->ue['id']]]['hpNow'] = $pvr['hpNow'];
				//$btl->users[$btl->uids[$this->ue['id']]]['hpNow'] = $pvr['hpNow'];				
				//
				$sp81 = mysql_query('SELECT `id` FROM `users` WHERE `battle` = "'.$u->info['battle'].'"');
				while( $pl81 = mysql_fetch_array($sp81) ) {
					$pl82 = mysql_fetch_array(mysql_query('SELECT `id`,`hpNow`,`team` FROM `stats` WHERE `id` = "'.$pl81['id'].'" LIMIT 1'));
					if($pl82['hpNow'] >= 1 && $btl->stats[$btl->uids[$pl82['id']]]['hpNow'] >= 1) {
						$rand_user[] = $u->info['id'];
					}
				}
				//
				$pvr['hp'] = 20;
				//$rand_user - массив!!!!
				$pvr['hp'] = $btl->testYronPriem( $btl->stats[$btl->uids[$rand_user]]['effects'][$prv['j_priem']]['user_use'], $rand_user, 302, $pvr['hp'], -1, true , false , 0);
				//
				$pvr['rndu']['id'] = $rand_user;
				$pvr['color'] = '006699';
				$pvr['color2'] = '006699';
				$pvr['hpSee'] = '--';
				$pvr['hp'] = round($pvr['hp']/2);
				if( $pvr['hp'] > 0 ) {
					$pvr['hpSee'] = '+'.$pvr['hp'];
				}else{
					$pvr['hp'] = 0;
				}
				$btl->stats[$btl->uids[$pvr['rndu']['id']]]['hpNow'] += $pvr['hp'];
				$btl->users[$btl->uids[$pvr['rndu']['id']]]['hpNow'] += $pvr['hp'];
				mysql_query('UPDATE `stats` SET `hpNow` = "'.$btl->stats[$btl->uids[$pvr['rndu']['id']]]['hpNow'].'" WHERE `id` = "'.$pvr['rndu']['id'].'" LIMIT 1');
				$pvr['hpNow'] = floor($btl->stats[$btl->uids[$pvr['rndu']['id']]]['hpNow']);
				$pvr['hpAll'] = $btl->stats[$btl->uids[$pvr['rndu']['id']]]['hpAll'];
				//
				//$btl->priemAddLogFast( $pvr['rndu']['id'], 0, "<font color^^^^#".$pvr['color2'].">Темное ранение</font>",
				//	'{tm1} ... <font Color=#'.$pvr['color'].'><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']',
				//1, time() );
				//
				$prv['text2'] = '{tm1} {u1} подвергся действию &quot;<b>Подлечить</b>&quot; и восстановил здоровье. <font Color=#'.$pvr['color'].'><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']';
				//
				$btl->priemAddLog( $id, 1, 2, $pvr['rndu']['id'], $u1,
					'<font color^^^^#'.$prv['color2'].'>Подлечить</font>',
					$prv['text2'],
					($btl->hodID)
				);				
				//
			
			//
			
		}
		// -- конец приема
		return $at;
	};
	unset( $pr_used_this );
}