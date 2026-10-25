<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Танец лезвий
	Уворот от 1-го удара и наносите контрудар
*/
$pvr = array();
if( isset($pr_tested_this) )
{
	$fx_priem = function(  $id , $at , $uid, $j_id )
	{
        //pr('48-tested:'.$at['p'][$a]['atack'][$j][1]);
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
		if( isset($at['p'][$a]['priems']['kill'][$uid][$j_id]) )
		{
			mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id` = "'.$btl->stats[$btl->uids[$uid]]['u_priem'][$j_id][3].'" AND `uid` = "'.$uid.'" LIMIT 1');
			unset($btl->stats[$btl->uids[$uid]]['u_priem'][$j_id]);
		}
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
        //pr('48-used:'.$at['p'][$a]['atack'][$j][1]);
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
		if( $a > 0 ) {
			$j = 0; $k = 0; $wp = 3;
			while($j < count($at['p'][$a]['atack']))
			{
                //pr('48-used:'.$at['p'][$a]['atack'][$j][1].' : '.$at['p'][$a]['atack'][$j]['priem_used']);
				if(!isset($at['p'][$a]['priems']['kill'][$uid][$j_id]) && $at['p'][$a]['atack'][$j][1] > 0 && $pvr['used'] == 0)//!isset($at['p'][$a]['atack'][$j]['priem_used'])
				{
					//Уворот от удара выставляем
					$plog = $at['p'][$a]['atack'][$j]['yron']['plog'];//Иначе теряются предыдущие приемы из лога!
					unset($at['p'][$a]['atack'][$j]['yron']);
                    $at['p'][$a]['atack'][$j]['yron']['plog'] = $plog;

					$at['p'][$a]['atack'][$j][1] = 8;
					$pvr['rnd_a'] = rand(1,5);

					if( $btl->testRazmenblock1($id,$u2,$u1,$pvr['rnd_a']) == false ) $at['p'][$b]['atack'][] = array( $pvr['rnd_a'] , 1 , 1 , 1 );//Попал
					else $at['p'][$b]['atack'][] = array( $pvr['rnd_a'] , 3 , 1 , 1 );//В блок
						
					$at = $btl->contrRestart($id,$at,true);
					//$at = $btl->priemsTestRazmen($id,$at);//Зацикливает сервер!

					//Учет приемов при контрударе
					$count = count($at['p'][$b]['atack'])-1;
                    if($uid==$uid2 && isset($at['p'][$b]['atack'][$count]['yron']) && $at['p'][$b]['atack'][$count]['yron'] != NULL)
					{
						$at['p'][$b]['atack'][$count]['yron'] = $btl->testYronPriemAttack( 48 , $u2 , $u1 , $at['p'][$b]['atack'][$count]['yron'] );//dg!!!!
					}
					//
					//pr('48-used5');
					$at['p'][$a]['atack'][$j]['yron']['plog'][] = '$this->deleffm(48,'.(0+$uid).','.$btl->stats[$btl->uids[$uid]]['u_priem'][$j_id][3].');
					$this->priemAddLog( '.$id.', '.$b.', '.$a.', '.$u2.', '.$u1.',
						"Танец лезвий",
						"{tm1} '.$btl->addlt($b , 17 , $btl->users[$btl->uids[$u2]]['sex'] , NULL).'",
					'.($btl->hodID + 1).' );';
					//
					$at['p'][$a]['atack'][$j]['yron']['used'][] = array($j_id,$uid,$pvr['used']);
					$at['p'][$a]['atack'][$j]['yron']['kill'][] = array($j_id,$uid,$pvr['kill']);
					//
					$at['p'][$a]['priems']['kill'][$uid][$j_id] = true;
					$at['p'][$a]['atack'][$j]['priem_used'] = $id;
					//
					if( $btl->testRazmenblock1($id,$u2,$u1,$pvr['rnd_a']) == false )$at = $this->yronRazmen($id,$at,true);
					//
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