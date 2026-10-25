<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Контузия лвл*2 - лвл противника
*/
$pvr = array();
//Действие при клике

if( $u->info['enemy'] > 0 ) {

    $pvr['x5'] = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$u->info['enemy'].'" AND `v2` = 191 AND `delete` = 0 LIMIT 1'));
	$btl->testUserInfoBattle($u->info['enemy']);
	
	$pvr['hp'] = rand($u->info['level'],2*$u->info['level']);
	$pvr['hpSee'] = '--';
	$pvr['hpNow'] = 0+floor($btl->stats[$btl->uids[$u->info['enemy']]]['hpNow']);
	$pvr['hpAll'] = 0+$btl->stats[$btl->uids[$u->info['enemy']]]['hpAll'];
		
	//Используем проверку на урон приемов
	$pvr['hp'] = $btl->testYronPriem( $u->info['id'], $u->info['enemy'], 227, $pvr['hp'], -1, true );
		
	$pvr['hpSee'] = '-'.$pvr['hp'];
	$pvr['hpNow'] -= $pvr['hp'];
		
	if( $pvr['hpNow'] > $pvr['hpAll'] ) {
		$pvr['hpNow'] = $pvr['hpAll'];
	}elseif( $pvr['hpNow'] < 0 ) {
		$pvr['hpNow'] = 0;
	}
	
	$btl->takeYronNow($u->info['id'],$pvr['hp']);
		
	$btl->stats[$btl->uids[$u->info['enemy']]]['hpNow'] = $pvr['hpNow'];
	$btl->users[$btl->uids[$u->info['enemy']]]['last_hp'] = -$pvr['hp'];
	
	mysql_query('UPDATE `stats` SET `last_hp` = "'.$btl->users[$btl->uids[$u->info['enemy']]]['last_hp'].'", `hpNow` = "'.$btl->stats[$btl->uids[$u->info['enemy']]]['hpNow'].'" WHERE `id` = "'.$u->info['enemy'].'" LIMIT 1');
		
	$prv['text'] = $btl->addlt(1 , 17 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL);
	
	$prv['text'] = $btl->addlt(1 , 17 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL);
	//pr($btl->stats[$btl->uids[$u->info['enemy']]]['antishock']);
	if( isset($pvr['x5']['id']) )//isset($btl->stats[$btl->uids[$u->info['enemy']]]['antishock']) - так всегда показывал наличие имунитета
	{
		$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
			'Контузия',
			'{tm1} '.$prv['text'].' на {u2} <font Color=#006699><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].'] (Цель полностью защищена от шока)',
			($btl->hodID + 1)
		);
        //$this->addPriem($u->info['enemy'],3508,'add_notactic=1|add_nousepriem=1',0,77,1,$u->info['id'],1,'контузия');
        //if(!isset($pvr['x5']['id'])) $this->addPriem($u->info['enemy'],191,'add_antishock=1',0,77,5,$u->info['id'],5,'иммунитеткошеломить');
	}else{
		$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
		    'Контузия',
		    '{tm1} '.$prv['text'].' на {u2} <font Color=#006699><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']',
		($btl->hodID + 1)
		);

		$this->addPriem($u->info['enemy'],3508,'add_nousepriem=1',0,77,1,$u->info['id'],1,'контузия');//add_notactic=1|
		$this->addPriem($u->info['enemy'],191,'add_antishock=1',0,77,5,$u->info['id'],5,'иммунитеткошеломить');
	}
	
	
	
	//Отнимаем тактики
	$this->mintr($pl);

}else{
	echo 'Прием не найден.';
}

unset($pvr);
?>