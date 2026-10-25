<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Оледенение: Разбить!
*/
$pvr = array();
$pvr['mg'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['enemy'].'"
AND `bj` LIKE "%оледенение%" AND `delete` = 0 AND `user_use` = "'.$u->info['id'].'" ORDER BY `id` DESC LIMIT 1'));

if( isset($pvr['mg']['id']) )
{	
	 if( $btl->stats[$btl->uids[$u->info['enemy']]]['hpNow'] > floor($btl->stats[$btl->uids[$u->info['enemy']]]['hpAll']/100*33) )
	 {
		echo '<font color=red><b>У персонажа должно быть меньше 33% здоровья! (Должно быть меньше '.floor($btl->stats[$btl->uids[$u->info['enemy']]]['hpAll']/100*33).'НР)</b></font>';
		$cup = true;
	}else {
		//урон оледенения разбить=(5*умения воды+50)+интеллект
		$pvr['hpbase'] = (5*$u->stats['mg3']+50)+$u->stats['s5'];
		$pvr['hp'] = floor($pvr['hpbase'] + ($pvr['hpbase']/2)*$pvr['mg']['x']);
		//pr($pvr['hp']);
		$pvr['hp'] = $this->magatack( $u->info['id'], $u->info['enemy'], $pvr['hp'], 'вода', 1, 1 );//no_pm
		$pvr['promah_type'] = $pvr['hp'][3];
		$pvr['promah'] = $pvr['hp'][2];
		$pvr['krit'] = $pvr['hp'][1];
		$pvr['hp']   = $pvr['hp'][0];
		$pvr['hpSee'] = '--';
		$pvr['hpNow'] = floor($btl->stats[$btl->uids[$u->info['enemy']]]['hpNow']);
		$pvr['hpAll'] = $btl->stats[$btl->uids[$u->info['enemy']]]['hpAll'];
			
		//Используем проверку на урон приемов
		$pvr['hp'] = $btl->testYronPriem( $u->info['id'], $u->info['enemy'], 265, $pvr['hp'], 7, true );
			
		$pvr['hpSee'] = '-'.$pvr['hp'];
		$pvr['hpNow'] -= $pvr['hp'];
		$btl->priemYronSave($u->info['id'],$u->info['enemy'],$pvr['hp'],0);
			
		if( $pvr['hpNow'] > $pvr['hpAll'] ) {$pvr['hpNow'] = $pvr['hpAll'];}
		elseif( $pvr['hpNow'] < 0 ) {$pvr['hpNow'] = 0;}
			
		$btl->stats[$btl->uids[$u->info['enemy']]]['hpNow'] = $pvr['hpNow'];
			
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$btl->stats[$btl->uids[$u->info['enemy']]]['hpNow'].'" WHERE `id` = "'.$u->info['enemy'].'" LIMIT 1');
			
		$prv['text'] = $btl->addlt(1 , 19 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL);
		
		//Цвет приема
		if( $pvr['promah'] == false )
		{
			if( $pvr['krit'] == false )
			{
				$prv['color2'] = '006699';
				if(isset($btl->mcolor[$btl->mname['вода']])) {$prv['color2'] = $btl->mcolor[$btl->mname['вода']];}
				$prv['color'] = '000000';
				if(isset($btl->mncolor[$btl->mname['вода']])) {$prv['color'] = $btl->mncolor[$btl->mname['вода']];}
			}else{
				$prv['color2'] = 'FF0000';
				$prv['color'] = 'FF0000';
			}
		}else{
			$prv['color2'] = '909090';
			$prv['color'] = '909090';
		}
		
		$prv['text2'] = '{tm1} '.$prv['text'].'. <font Color='.$prv['color'].'><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']';
		if( $pvr['promah_type'] == 2 )
		{
			$prv['text'] = $btl->addlt(1 , 20 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL);
			$prv['text2'] = '{tm1} '.$prv['text'].'. <font Color='.$prv['color'].'><b>--</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']';
		}
		$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
			'<font color^^^^#'.$prv['color2'].'>Оледенение: Разбить!</font>',
			$prv['text2'],
			($btl->hodID + 1)
		);
		
		//Удаляем оледенение
		$pvr['mg']['priem']['id'] = $pvr['mg']['id'];
		$btl->delPriem($pvr['mg'],$btl->users[$btl->uids[$u->info['enemy']]],2,0,0,0,0,0);
		
		//Отнимаем тактики
		$this->mintr($pl);
	}
}else{
	echo '<font color=red><b>На персонаже нет оледенения (Вашего заклятия)</b></font>';
	$cup = true;
}
unset($pvr);
?>