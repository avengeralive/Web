<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Агрессивная защита
	Следующий удар противника по вам будет равен 1 ед.
	+ наносит урон противнику на 3*(лвл противника) ед. урона
*/
//pr('prv-211');
$pvr = array();
if( isset($pr_momental_this))
{
	$fx_moment = function(  $uid, $enemy, $j_id, $yron, $profil )
	{
		global $u, $btl;
		if(!isset($btl->stats[$btl->uids[$uid]]['um_priem'][$j_id]) && isset($btl->stats[$btl->uids[$uid]]['u_priem'][$j_id]))
		{
			$yron = 1;
			$btl->stats[$btl->uids[$uid]]['um_priem'][$j_id] = true;

			//Ответка
			$pvr['hp'] = 3*$btl->users[$btl->uids[$uid]]['level'];
			$pvr['hp_n'] = $pvr['hp'];
			$pvr['hpSee'] = '--';
			$pvr['hpNow'] = floor($btl->stats[$btl->uids[$enemy]]['hpNow']);
			$pvr['hpAll'] = $btl->stats[$btl->uids[$enemy]]['hpAll'];
				
			//Используем проверку на урон приемов
			$pvr['hp'] = $btl->testYronPriem( $uid, $enemy, 211, $pvr['hp'], -1, true, true, 1 );
			if( $pvr['hp'] > $pvr['hp_n'] ) {$pvr['hp'] = $pvr['hp_n'];}

			$pvr['hpSee'] = '-'.$pvr['hp'];
			$pvr['hpNow'] -= $pvr['hp'];
				
			if( $pvr['hpNow'] > $pvr['hpAll'] ) {$pvr['hpNow'] = $pvr['hpAll'];}
			elseif( $pvr['hpNow'] < 0 ) {$pvr['hpNow'] = 0;}

			$btl->stats[$btl->uids[$enemy]]['hpNow'] = $pvr['hpNow'];
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$btl->stats[$btl->uids[$enemy]]['hpNow'].'" WHERE `id` = "'.$enemy.'" LIMIT 1');
			//

            if( !isset($btl->prlog[$uid][$j_id]) )
			{
				$btl->priemAddLogFast( $uid, $enemy, "Агрессивная защита",
				'{tm1} '.$btl->addlt(1 , 17 , $btl->users[$btl->uids[$uid]]['sex'] , NULL).' на {u2}.<font Color=#006699><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']',
				1, time() );
                $btl->prlog[$uid][$j_id] = true;
				
			}
			if( $yron < 0 ) {$yron = 1;}

			//$at['p'][$a]['priems']['kill'][$uid][$j_id] = true;
		}
		pr('moment-211');
		return round($yron);
	};
}
elseif( isset($pr_tested_this) )
{
		$fx_priem = function(  $id , $at , $uid, $j_id ) {
		// -- начало приема
		global $u, $btl;	
		//
		//Параметры приема
		$pvr['used'] = 0;
		//		
		$uid1 = $btl->atacks[$id]['uid1'];
		$uid2 = $btl->atacks[$id]['uid2'];			
		if( $uid == $uid2 ) {
			$a = 1;
			$b = 2;
			$u1 = ${'uid1'};
			$u2 = ${'uid2'};
		}elseif( $uid == $uid1 ) {
			$a = 2;
			$b = 1;
			$u1 = ${'uid2'};
			$u2 = ${'uid1'};
		}
		//Иначе не слетает при тумане - когда есть условие???
		if( isset($at['p'][$a]['priems']['kill'][$uid][$j_id]) )
		{
			mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id` = "'.$btl->stats[$btl->uids[$uid]]['u_priem'][$j_id][3].'" AND `uid` = "'.$uid.'" LIMIT 1');
			unset($btl->stats[$btl->uids[$uid]]['u_priem'][$j_id]);
            //pr('del-211');
		}
        pr('tested-211');
		//
		// -- конец приема

		return $at;
	};
	unset( $pr_used_this );
}
elseif( isset($pr_used_this) )
{
	$fx_priem = function(  $id , $at , $uid, $j_id )
	{
		// -- начало приема
		global $u, $btl;
		//
		//Параметры приема
		$pvr['used'] = 0;
		//			
		$uid1 = $btl->atacks[$id]['uid1'];
		$uid2 = $btl->atacks[$id]['uid2'];			
		if( $uid == $uid2 ) {
			$a = 1;
			$b = 2;
			$u1 = ${'uid1'};
			$u2 = ${'uid2'};
		}elseif( $uid == $uid1 ) {
			$a = 2;
			$b = 1;
			$u1 = ${'uid2'};
			$u2 = ${'uid1'};
		}
		if( $a > 0 )
		{
			$j = 0; $k = 0; $wp = 3;
			while($j < count($at['p'][$a]['atack']))
			{
                //pr($at['p'][$a]['atack'][$j][1]." : ".$btl->testProboiPriem($pid, $u1));
				if( (isset($at['p'][$a]['atack'][$j]['yron']) && (
				$at['p'][$a]['atack'][$j][1] == 1 ||
				$at['p'][$a]['atack'][$j][1] == 4 ||
				$at['p'][$a]['atack'][$j][1] == 5 )) || $btl->testProboiPriem($pid, $u1)==true)
				{
     				if( !isset($btl->stats[$btl->uids[$u1]]['prm_'.$btl->stats[$btl->uids[$u1]]['u_priem'][$j_id][3].'_use'])
					&& $pvr['used'] == 0 && !isset($at['p'][$a]['priems']['kill'][$uid][$j_id]))//&& !isset($btl->stats[$btl->uids[$uid]]['um_priem'][$j_id])
					{
						//
						$btl->stats[$btl->uids[$u1]]['prm_'.$btl->stats[$btl->uids[$u1]]['u_priem'][$j_id][3].'_use'] = true;
						$btl->stats[$btl->uids[$uid]]['um_priem'][$j_id] = true;
						//
						$pvr['hp'] = 3*$btl->users[$btl->uids[$u2]]['level'];
						$pvr['hp_n'] = $pvr['hp'];
						$pvr['hpSee'] = '--';
						$pvr['hpNow'] = floor($btl->stats[$btl->uids[$u1]]['hpNow']);
						$pvr['hpAll'] = $btl->stats[$btl->uids[$u1]]['hpAll'];
							
						//Используем проверку на урон приемов
						$pvr['hp'] = $btl->testYronPriem( $u2, $u1, 211, $pvr['hp'], -1, true );
						if( $pvr['hp'] > $pvr['hp_n'] ){$pvr['hp'] = $pvr['hp_n'];}

						$pvr['hpSee'] = '-'.$pvr['hp'];
						$pvr['hpNow'] -= $pvr['hp'];

						if( $pvr['hpNow'] > $pvr['hpAll'] ){$pvr['hpNow'] = $pvr['hpAll'];}
						elseif( $pvr['hpNow'] < 0 ){$pvr['hpNow'] = 0;}

						$btl->stats[$btl->uids[$u1]]['hpNow'] = $pvr['hpNow'];							
						mysql_query('UPDATE `stats` SET `hpNow` = "'.$btl->stats[$btl->uids[$u1]]['hpNow'].'" WHERE `id` = "'.$u1.'" LIMIT 1');
						//
                        $at['p'][$a]['atack'][$j]['yron']['y'] = 1;
						$at['p'][$a]['atack'][$j]['yron']['r'] 	= -1;
						$at['p'][$a]['atack'][$j]['yron']['k']   = 1;
						$at['p'][$a]['atack'][$j]['yron']['m_k'] = 1;
						$at['p'][$a]['atack'][$j]['yron']['m_y'] = 1;
						//pr($at['p'][$a]['atack'][$j]['yron']);

						//
                        if( !isset($btl->prlog[$uid][$j_id]) )//без условия двоит в лог
						{
							if($at['p'][$a]['atack'][$j][1]==3 || $at['p'][$a]['atack'][$j][1]==6)
							{
								$btl->priemAddLogFast( $u2, $u1, "Агрессивная защита", '{tm1} '.$btl->addlt(1 , 17 , $btl->users[$btl->uids[$u2]]['sex'] , NULL)
								.' на {u2}. <font Color=#006699><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']', 1, time() );
							} else {
										$at['p'][$a]['atack'][$j]['yron']['plog'][] = '$this->priemAddLog( '.$id.', '.$b.', '.$a.', '.$u2.', '.$u1.',
										"Агрессивная защита",
										"{tm1} '.$btl->addlt($b , 17 , $btl->users[$btl->uids[$u2]]['sex'] , NULL).' на {u2}. <font Color=#006699><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']",
										'.($btl->hodID + 1).' );';

										//mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$btl->stats[$btl->uids[$uid]]['u_priem'][$j_id][3].'" LIMIT 1');
										//выключен из-за того, что не срабатывала против слепой удачи - защита слетала раньше...
										//unset($btl->stats[$btl->uids[$uid]]['u_priem'][$j_id]);
							}
						}
                        pr('used-211');
						//
						$at['p'][$a]['atack'][$j]['yron']['used'][] = array($j_id,$uid,$pvr['used']);
						$at['p'][$a]['atack'][$j]['yron']['kill'][] = array($j_id,$uid,$pvr['kill']);
                        $at['p'][$a]['priems']['kill'][$uid][$j_id] = true;
                        $btl->prlog[$uid][$j_id] = true;
						//
					}
				}
				$j++;
			}
		}
		// -- конец приема

		return $at;
	};
	unset( $pr_used_this );
}else{
	//Действие при клике
	$this->addEffPr($pl,$id);
}
unset($pvr);
?>