<?
if(!defined('GAME')) {die();}

/*	ѕрием: ядовитое облако [10] */

$pvr = array();
if( isset($pr_used_this) && isset($pr_moment) )
{
	//Ёффект уже висит
	$fx_priem = function(  $id , $at , $uid, $j_id )
	{
		// -- начало приема
		global $u, $btl, $priem;
		//
		//ѕараметры приема
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
		if( $a > 0 )
		{
			//ѕровер€ем эффект
			$prv['j_priem'] = $btl->stats[$btl->uids[$u1]]['u_priem'][$j_id][0];
			$prv['priem_th'] = $btl->stats[$btl->uids[$u1]]['effects'][$prv['j_priem']]['id'];

			//действи€
			$pvr['hp'] = 0;
			//
			$pvr['data'] = $priem->lookStatsArray($btl->stats[$btl->uids[$u1]]['effects'][$prv['j_priem']]['data']);
			$pvr['di'] = 0;
			$pvr['dc'] = count($pvr['data']['atgm']);
			$pvr['rd'] = 0;
			$pvr['redata'] = '';
			while( $pvr['di'] < 4 )
			{
				if( isset($pvr['data']['atgm'][($pvr['dc']-$pvr['di'])]) )
				{
					if( $pvr['rd'] < 3 )
					{
						$pvr['hp'] += $pvr['data']['atgm'][($pvr['dc']-$pvr['di'])];
						$pvr['redata'] = 'atgm='.$pvr['data']['atgm'][($pvr['dc']-$pvr['di'])].'|'.$pvr['redata'];
						$pvr['rd']++;
					}
				}
				$pvr['di']++;
			}
			//
			$btl->stats[$btl->uids[$u1]]['effects'][$prv['j_priem']]['data'] = $pvr['redata'];
			mysql_query('UPDATE `eff_users` SET `data` = "'.$pvr['redata'].'" WHERE `id` = "'.$btl->stats[$btl->uids[$u1]]['effects'][$prv['j_priem']]['id'].'" LIMIT 1');
			//
			$pvr['hp'] = floor($pvr['hp']);
			$pvr['hp'] = $priem->magatack( $u2, $u1, $pvr['hp'], 'вода', 0 );
			$pvr['promah_type'] = $pvr['hp'][3];
			$pvr['promah'] = $pvr['hp'][2];
			$pvr['krit'] = $pvr['hp'][1];
			$pvr['hp']   = $pvr['hp'][0];
			$pvr['hpNow'] = floor($btl->stats[$btl->uids[$u1]]['hpNow']);
			$pvr['hpAll'] = $btl->stats[$btl->uids[$u1]]['hpAll'];

			//»спользуем проверку на урон приемов
			$pvr['hp'] = $btl->testYronPriem( $btl->stats[$btl->uids[$u1]]['effects'][$prv['j_priem']]['user_use'], $u1, 23, $pvr['hp'], -1, true );

			$pvr['hpSee'] = '-'.$pvr['hp'];
			$pvr['hpNow'] -= $pvr['hp'];
			$btl->priemYronSave($btl->stats[$btl->uids[$u1]]['effects'][$prv['j_priem']]['user_use'],$u1,$pvr['hp'],0);

			if( $pvr['hpNow'] > $pvr['hpAll'] ) $pvr['hpNow'] = $pvr['hpAll'];
			elseif( $pvr['hpNow'] < 0 ) $pvr['hpNow'] = 0;

			$btl->stats[$btl->uids[$u1]]['hpNow'] = $pvr['hpNow'];

			mysql_query('UPDATE `stats` SET `hpNow` = "'.$btl->stats[$btl->uids[$u1]]['hpNow'].'" WHERE `id` = "'.$u1.'" LIMIT 1');
			$prv['text'] = '{u2} утратил здоровье от &quot;{pr}&quot;';

			//÷вет приема
			if( $pvr['promah'] == false )
			{
				if( $pvr['krit'] == false ) {
					$prv['color2'] = '000000';
					$prv['color'] = '008000';
				}else{
					$prv['color2'] = 'FF0000';
					$prv['color'] = 'FF0000';
				}
			}else{
				$prv['color2'] = '909090';
				$prv['color'] = '909090';
			}

			$prv['text2'] = '{tm1} '.$prv['text'].'. <font Color='.$prv['color'].'><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']';
			if( $pvr['promah_type'] == 2 ) {
				$prv['text2'] = '{tm1} '.$prv['text'].'. <font Color='.$prv['color'].'><b>--</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']';
			}
			$btl->priemAddLog( $id, 1, 2, $u2, $u1,
				'<font color^^^^#'.$prv['color2'].'>ядовитое ќблако</font>',
				$prv['text2'],
				($btl->hodID)
			);
		}
		// -- конец приема
		return $at;
	};
	unset( $pr_used_this );
}else{
	//¬ешаем эффект при использовании приема
	$alive_users = array(); $rand_users_max = rand(3,5);

	foreach($btl->users as $btl_user)
	{
		if($btl_user['hpNow']>0 && $btl_user['team'] != $u->info['team']) $alive_users[] = $btl_user;
	}

	if($rand_users_max > count($alive_users)) $rand_users_max = count($alive_users);
	$rand_users = (count($alive_users)==1 ? array(0) : array_rand($alive_users, $rand_users_max));

    if (is_array($rand_users))
	{
		foreach($rand_users as $rand_user)
		{
			//pr($alive_users[$rand_user]['id']);

			$pvr['uid'] = $alive_users[$rand_user]['id'];
			$pvr['hp'] = 50;
			/*$pvr['hp'] = $this->magatack( $u->info['id'], $pvr['uid'], $pvr['hp'], 'вода', 0 );
			$pvr['promah_type'] = $pvr['hp'][3];
			$pvr['promah'] = $pvr['hp'][2];
			$pvr['krit'] = $pvr['hp'][1];
			$pvr['hp']   = $pvr['hp'][0];*/
			//
			$prv['color2'] = '000000';
			$prv['text'] = $btl->addlt(1 , 19 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL);
			$prv['text2'] = '{tm1} '.$prv['text'].'.';
			$btl->priemAddLog( $id, 1, 2, $u->info['id'], $pvr['uid'],
				'<font color^^^^#'.$prv['color2'].'>ядовитое ќблако [10]</font>',
				$prv['text2'],
				($btl->hodID + 1));

			//ƒобавл€ем прием
			$this->addPriem($pvr['uid'],$pl['id'],'atgm='.floor($pvr['hp']/5).'',0,77,5,$u->info['id'],1,'€довитоеоблако',0,0,1);
		}
	}
}

unset($pvr);
?>