<?
if(!defined('GAME')){die();}

if( $itm['magic_inci'] == 'dispell' )
{
	/* Свиток: Снять Проклятье - 4759 */

	$pvr = array();
	if( isset($btl->info['id']) ) $btl->priemAddLog( $id, 1, 2, $usr['id'], $u->info['enemy'], '', '{tm1} {u1} использовал заклятие &quot;<b>'.$itm['name'].'</b>&quot;.',($btl->hodID));

	/*Должно снимать: 4783, 4784, 4684, 4683,4682,4681,4680,4679
	и эффекты чарок птп: 4760,4761,4762,4763,4764,4765,4766,4767,4768,4769,4770,4771,47724773,4774,4775,4776,4777*/
	/*$pvr['nego'] .= ' `id_eff` = 320 OR `id_eff` = 319 OR `id_eff` = 318 OR `id_eff` = 317 OR `id_eff` = 316';*/
	/*$pvr['no'] = '  AND `a`.`v2` != 201';
	$pvr['no'] .= ' AND `a`.`v2` != 31';
	$pvr['no'] .= ' AND `a`.`v2` != 260';
	$pvr['no'] .= ' AND `a`.`v2` != 191';
	$pvr['no'] .= ' AND `a`.`v2` != 280';
	$pvr['no'] .= ' AND `a`.`v2` != 201';
	$pvr['no'] .= ' AND `a`.`v2` != 42  AND `a`.`v2` != 121 AND `a`.`v2` != 122 AND `a`.`v2` != 123 AND `a`.`v2` != 124 AND `a`.`v2` != 125';
	$pvr['no'] .= ' AND `a`.`v2` != 186 AND `a`.`v2` != 246 AND `a`.`v2` != 257 AND `a`.`v2` != 281';
	$pvr['no'] .= ' AND `a`.`v2` != 282';
	$pvr['no'] .= ' AND `a`.`v2` != 21 AND `a`.`v2` != 73 AND `a`.`v2` != 74 AND `a`.`v2` != 75 AND `a`.`v2` != 76 AND `a`.`v2` != 77
	AND `a`.`v2` != 78 AND `a`.`v2` != 79';*/

	$pvr['nego'] = ' `id_eff` IN (386,387,460,461,462,463,464,465,99037,99036,99035,424,425,432,600,601,602,603,316,317,318,319,320)';

	$pvr['no'] = '  AND `a`.`v2` NOT IN (242,280,3508,260,275,238,250,278,191,56,57,58,59,60,75,76,77,78,79,80,81,82,83,84,403)';

	$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Цель%" ';
	
	$pvr['sp'] = mysql_query('SELECT `a`.* FROM `eff_users` AS `a` LEFT JOIN `priems` AS `b` ON `b`.`id` = `a`.`v2` WHERE `a`.`uid` = "'.$usr['id'].'"
	AND `a`.`delete` = 0 AND ( `a`.`v1` = "priem" '.$pvr['no'].' OR ( `a`.`v1` = 0 AND ('.$pvr['nego'].') ) OR ( `a`.`id_eff` = 0 AND ('.$pvr['nego'].') ) )
	AND ( `b`.`neg` > 0 OR `a`.`v2` = 191 OR `a`.`v2` = 0 ) ORDER BY `a`.`id` DESC LIMIT 1');

	$pvr['pl'] = mysql_fetch_array($pvr['sp']);

	if(!isset($pvr['pl']['id'])) 	  $u->error = '<font color=red><b>Не удалось использовать &quot;'.$itm['name'].'&quot;, на вас нет проклятий!</b></font>';
	elseif( isset($btl->info['id']) ) $u->error = '<font color=red><b>Вы успешно использовали &quot;'.$itm['name'].'&quot; и сняли эффект &quot;'.$pvr['pl']['name'].'&quot;.</b></font>';
	else $u->error = '<font color=red><b>Вы успешно использовали &quot;'.$itm['name'].'&quot;</b></font>';

	if(isset($pvr['pl']['id']))
	{
        mysql_query('UPDATE `eff_users` SET `timeUse` = 1224562000 WHERE `id` = "'.$pvr['pl']['id'].'" LIMIT 1');
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
	}
	unset($pvr);
}
?>