<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Чистота воды
*/
$pvr = array();
//
if( true == true ) {
	//
	$pvr['no'] = ' AND `a`.`v2` != 201';
	$pvr['no'] .= ' AND `a`.`v2` != 31';
    $pvr['no'] .= ' AND `a`.`v2` != 307';//проклятие уязвимости
	
	//$pvr['no'] .= ' AND `a`.`v2` != 260';
	
	$pvr['no'] .= ' AND `a`.`v2` != 191';
	$pvr['no'] .= ' AND `a`.`v2` != 25912';
	$pvr['no'] .= ' AND `a`.`v2` != 280';
    $pvr['no'] .= ' AND `a`.`v2` != 242';
    $pvr['no'] .= ' AND `a`.`v2` != 281';
	$pvr['no'] .= ' AND `a`.`v2` != 201';
	$pvr['no'] .= ' AND `a`.`v2` != 42 AND `a`.`v2` != 121 AND `a`.`v2` != 122 AND `a`.`v2` != 123 AND `a`.`v2` != 124 AND `a`.`v2` != 125';
	$pvr['no'] .= ' AND `a`.`v2` != 186 AND `a`.`v2` != 246 AND `a`.`v2` != 257 AND `a`.`v2` != 281';
	$pvr['no'] .= ' AND `a`.`v2` != 282';
    $pvr['no'] .= ' AND `a`.`v2` != 275';
    $pvr['no'] .= ' AND `a`.`v2` != 3508';
    $pvr['no'] .= ' AND `a`.`v2` != 237';
	$pvr['no'] .= ' AND `a`.`v2` != 21 AND `a`.`v2` != 73 AND `a`.`v2` != 74 AND `a`.`v2` != 75 AND `a`.`v2` != 76 AND `a`.`v2` != 77
	AND `a`.`v2` != 78 AND `a`.`v2` != 79';
	
	//$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Цель%" ';
	
	$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Оледенение%" ';
	$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Заряд Цели%" ';
	$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Серое Мастерство%" ';
	$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Метеорит%" ';
	$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Регенерация%" ';
	$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Туманный образ%" ';
	$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Жертва%" ';
	$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Призрачн%" ';
    $pvr['no'] .= ' AND `a`.`name` NOT LIKE "Уязвимость Оружию%" ';
	$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Уязвимость Стихиям%" ';
	
	$pvr['sp'] = mysql_query('SELECT `a`.*, `a`.`id` AS `ueffid` FROM `eff_users` AS `a` LEFT JOIN `priems` AS `b` ON `b`.`id` = `a`.`v2`
	WHERE `a`.`uid` = "'.$this->ue['id'].'" AND `a`.`delete` = 0 AND `a`.`v1` = "priem" '.$pvr['no'].' AND ( (`b`.`neg` > 0 AND `a`.`v2` != 260)
	OR `a`.`v2` = 191 OR ( `a`.`v2` = 260 AND `a`.`data` NOT LIKE "%add_mg2static_points=0%"  ) ) ORDER BY `a`.`id` DESC LIMIT 1');

	$pvr['pl'] = mysql_fetch_array($pvr['sp']);
	$pvr['pl']['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pvr['pl']['v2'].'" LIMIT 1'));
	if( isset($pvr['pl']['priem']) && isset($pvr['pl']['id']) )
	{
		$prv['color2'] = $btl->mcolor[$btl->mname['вода']];
		$prv['text'] = $btl->addlt(1 , 17 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL);	
		$prv['text2'] = '{tm1} '.$prv['text'].'';
		$btl->priemAddLog( $id, 1, 2, $u->info['id'], 0,
			'<font color^^^^#'.$prv['color2'].'>Чистота Воды</font>',
			$prv['text2'],
			($btl->hodID + 0)
		);
		
		$pvr['edt'] = $u->lookStats($pvr['pl']['data']);	
		$pvr['edt']['add_zm2proc'] = 0;
		$pvr['edt']['add_mg2static_points'] = 0;
		$pvr['edt'] = $u->impStats($pvr['edt']);
		
		if( $pvr['pl']['priem']['id'] == 260 )
		{
			$prv['color2'] = '000000';
			$prv['text'] = $btl->addlt(1 , 19 , $btl->users[$btl->uids[$this->ue['id']]]['sex'] , NULL);
			$prv['text2'] = '{tm1} Закончилось действие эффекта &quot;<b>Заряд</b>&quot; для {u1}.';
			$btl->priemAddLog( $id, 1, 2, $u->info['id'], 0,
				'',
				$prv['text2'],
				($btl->hodID + 0)
			);	
			mysql_query('UPDATE `eff_users` SET `x` = 1, `data` = "'.$pvr['edt'].'" WHERE `id` = "'.$pvr['pl']['ueffid'].'" LIMIT 1');
		}else{
			$btl->delPriem($pvr['pl'],$btl->users[$btl->uids[$this->ue['id']]],100,false,'',0,0,0);
		}
		$this->mintr($pl);
	}else{
		echo '<font color=red><b>Вам нечего очищать...</b></font>';
		$cup = true;
	}
	//
}else{
	$cup = true;
}
//
unset($pvr);
?>