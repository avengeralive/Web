<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Знак огня
*/
$pvr = array();

$pvr['id'] = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `v2` = 29 AND `delete` = 0 LIMIT 1'));


if($pvr['x'] == 29) {
//$priem->addPriem($u->info['id'],$pl['id'],-1,0,77,-2,$u->info['id'],1,'знакогня',1,1);

//$pvr = mysql_fetch_array(mysql_query('INSERT INTO `eff_users` WHERE `uid` = "'.$u->info['id'].'" `v2` = 29 `delete` = 0 LIMIT 1'));
		
$this->addEffPr($pl,$id);
	//
	$prv['x'] = '';
	if( $pvr['x'] > 0 ) {
		$prv['eff'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `id` = "'.$pvr['x'].'" LIMIT 1'));
		if( isset($prv['eff']['id']) ) {
			//Разбираем дату $prv['eff']['data']
			$prv['eda'] = $prv['eff']['data'];
		}
	}else{
		//Разбираем дату $pl['date3']
		$prv['eda'] = $pl['date3'];
	}
	
	if( isset($prv['eda']) ) {
		$prv['d'] = $u->lookStats($prv['eda']);
		$prv['j'] = $u->lookStats($this->redate($prv['eda'],$u->info['id']));
		$prv['v'] = $u->lookKeys($this->redate($prv['eda'],$u->info['id']),0); // ключи 2
		//$prv['i'] = 0; $prv['inf'] = '';
		$prv['effx'] = rtrim($prv['inf'],', ');
	}
	//
	if( $prv['effx'] != '' ) {
		$prv['effx'] = ' ('.$prv['eff'].')';
	}

	$prv['color2'] = '000000';
	$prv['text'] = $btl->addlt(1 , 17 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL);	
	$prv['text2'] = '{tm1} '.$prv['text'].' '.$prv['effx'].'';
	$btl->priemAddLog( $id, 1, 2, $u->info['id'], 0,
		'<font color^^^^#'.$prv['color2'].'>Знак огня</font>',
		$prv['text2'],
		($btl->hodID + 0)
	);
		
}
unset($pvr);
?>