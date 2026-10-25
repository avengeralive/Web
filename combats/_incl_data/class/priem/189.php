<?
if(!defined('GAME')) {
	die();
}

/*прием: ошеломить*/

$pvr = array();
//действие при клике
    $imun = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['enemy'].'" and `v2`="191" and `delete`="0" LIMIT 1'));
    if($imun)
	{
        echo '<font color=red><b>Иммунитет к ошеломить еще '.$imun['hod'].' ходов.</b></font>';
        $cup = true;
    }else{
		$prv['text'] = $btl->addlt(1 , 17 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL);
		$pvr['x5'] = mysql_fetch_array(mysql_query('SELECT `id`,`x`,`hod` FROM `eff_users` WHERE `uid` = "'.$u->info['enemy'].'" AND `v2` = 191 AND `delete` = 0 LIMIT 1'));

if( $pvr['x5']['x'] > 0 ) {
	
	$btl->testUserInfoBattle($u->info['enemy']);
	
	$pvr['hp'] = rand(5,10);
	$pvr['hpSee'] = '--';
	$pvr['hpNow'] = 0+floor($btl->stats[$btl->uids[$u->info['enemy']]]['hpNow']);
	$pvr['hpAll'] = 0+$btl->stats[$btl->uids[$u->info['enemy']]]['hpAll'];
		
	//используем проверку на урон приемов
	$pvr['hp'] = $btl->testYronPriem( $u->info['id'], $u->info['enemy'], 189, $pvr['hp'], -1, true );
		
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
	
	$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
		'Ошеломить',
		'{tm1} '.$prv['text'].' на {u2}. <font Color=#006699><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']',
		($btl->hodID + 1)
	);	
	//отнимаем тактики
	$this->mintr($pl);
}else{
	$btl->testUserInfoBattle($u->info['enemy']);
	
	$pvr['hp'] = rand(5,10);
	$pvr['hpSee'] = '--';
	$pvr['hpNow'] = 0+floor($btl->stats[$btl->uids[$u->info['enemy']]]['hpNow']);
	$pvr['hpAll'] = 0+$btl->stats[$btl->uids[$u->info['enemy']]]['hpAll'];
		
	//используем проверку на урон приемов
	$pvr['hp'] = $btl->testYronPriem( $u->info['id'], $u->info['enemy'], 189, $pvr['hp'], -1, true );
		
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

	if( isset($btl->stats[$btl->uids[$u->info['enemy']]]['antishock']) && $btl->stats[$btl->uids[$u->info['enemy']]]['antishock'] > 0 && $pvr['x5']['x'] >= 2 )
	{
		$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
			'Ошеломить',
			'{tm1} '.$prv['text'].' на {u2}. (цель полностью защищена от шока) <font Color=#006699><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']',
			($btl->hodID + 1)
		);
		if( isset($pvr['x5']['id']) ) {
			mysql_query('UPDATE `eff_users` SET `hod` = 5,`x` = ( `x` + 1 ) WHERE `id` = "'.$pvr['x5']['id'].'" LIMIT 1');
		}
	}else{
		$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
			'Ошеломить',
			'{tm1} '.$prv['text'].' на {u2}. <font Color=#006699><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']',
			($btl->hodID + 1)
		);
		$pvr['x4'] = mysql_fetch_array(mysql_query('SELECT `id`,`x`,`hod` FROM `eff_users` WHERE `uid` = "'.$u->info['enemy'].'" AND `v2` = 275 AND `delete` = 0 LIMIT 1'));
		mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$pvr['x4']['id'].'" LIMIT 1');
		$this->addPriem($u->info['enemy'],275,'add_nousepriem=1',0,77,(1-$pvr['x5']['x']),$u->info['id'],5,'Ошеломить');//add_notactic=1|
		if( !isset($pvr['x5']['id']) ) {
			$this->addPriem($u->info['enemy'],191,'add_antishock=1',0,77,5,$u->info['id'],5,'иммунитет к Ошеломить');	
		}else{
			mysql_query('UPDATE `eff_users` SET `hod` = 5,`x` = ( `x` + 1 ) WHERE `id` = "'.$pvr['x5']['id'].'" LIMIT 1');
		}
	}
	
	//отнимаем тактики
	$this->mintr($pl);
}
}
unset($pvr);

?>