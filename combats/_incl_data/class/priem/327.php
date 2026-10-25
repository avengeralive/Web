<?
if(!defined('GAME')) {
	die();
}
/*
	Эффект: Живая вода
*/
$pvr = array();

//Действие при клике
if( isset($pr_used_this) && isset($pr_moment) ) { 
	$fx_priem = function(  $id , $at , $uid, $j_id ) {
		// -- начало приема
		global $u, $btl;	
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
		//
		if( $a > 0 ) {	
			if( $pvr['used'] == 0 && !isset($at['p'][$a]['priems']['kill'][$u1][$j_id]) ) {
				//
				$pvr['hp'] = 10;
				$pvr['hpSee'] = 0;
				$pvr['hpNow'] = floor($btl->stats[$btl->uids[$u1]]['hpNow']);
				$pvr['hpAll'] = $btl->stats[$btl->uids[$u1]]['hpAll'];
				$pvr['hpTr'] = $pvr['hpAll'] - $pvr['hpNow'];
				
				$pvr['hp'] = $btl->hphe( $u1 , $pvr['hp'] , true );
				
				if( $pvr['hpTr'] > 0 ) {
					//Требуется хилл
					if( $pvr['hpTr'] < $pvr['hp'] ) {
						$pvr['hp'] = $pvr['hpTr'];
					}
					$pvr['hpSee'] = '+'.$pvr['hp'];
					$pvr['hpNow'] += $pvr['hp'];
				}					
				if( $pvr['hpNow'] > $pvr['hpAll'] ) {
					$pvr['hpNow'] = $pvr['hpAll'];
				}elseif( $pvr['hpNow'] < 0 ) {
					$pvr['hpNow'] = 0;
				}
				//
				$btl->users[$btl->uids[$u1]]['last_hp'] = $pvr['hp'];
				//
				$btl->stats[$btl->uids[$u1]]['hpNow'] = $pvr['hpNow'];					
				mysql_query('UPDATE `stats` SET `last_hp` = "'.$btl->users[$btl->uids[$u1]]['last_hp'].'",`hpNow` = "'.$btl->stats[$btl->uids[$u1]]['hpNow'].'" WHERE `id` = "'.$u1.'" LIMIT 1');
				//
				if( $pvr['hpSee'] < 1 ) {
					$pvr['hpSee'] = '--';
				}
				//
				$btl->priemAddLogFast( $u1, 0, "Живая вода",
					'{tm1} '.$btl->addlt(1 , 17 , $btl->users[$btl->uids[$u1]]['sex'] , NULL).' на <font Color=green><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']',
				1, time() );					
				//
			}	
		}
		// -- конец приема
		return $at;
	};
	unset( $pr_used_this );
}

unset($pvr);
?>