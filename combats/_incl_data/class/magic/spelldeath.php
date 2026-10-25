<?
if(!defined('GAME')) 
	
	{ die(); }

$pvr = array();

$bu = mysql_fetch_array(mysql_query('SELECT `hpNow` FROM `stats` WHERE `id` = "'.$u->info['enemy'].'" LIMIT 1'));	
if( $itm['magic_inci'] == 'spelldeath' ) {
$u->deleteItem($itm['id']);
if($u->info['battle']==0) {
	$u->error = 'Использовать можно только в поединке';
}elseif(isset($bu['id'])) {
	$u->error = 'Нельзя использовать свиток каждый ход...';
}elseif( isset($btl->info['id']) ) {
//Легкая Смерть
mysql_query('UPDATE `stats` SET `hpNow` = "0" WHERE `id` = "'.$u->info['enemy'].'" LIMIT 1');
$mas['text'] = '{tm1} <b>'.$btl->stats[$btl->uids[$u1]]['login'].'</b> погиб.';
					
$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
			'',
			'{tm1} {u1} использовал заклятие <b>'.$itm['name'].'</b>',
			($btl->hodID)
	);			
			
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');			
	
	}else{
		$u->error = '<font color=red><b>Свиток возможно использовать только в бою</b></font>';
	}
	unset($pvr);
}
?>