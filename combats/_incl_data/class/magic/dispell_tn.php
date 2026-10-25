<?
if(!defined('GAME')){die();}

if( $itm['magic_inci'] == 'dispell_tn' )
{
	/* Свиток: Снять Проклятье(низины) - 5347 */

	$pvr = array();
	if( isset($btl->info['id']) ) $btl->priemAddLog( $id, 1, 2, $usr['id'], $u->info['enemy'], '', '{tm1} {u1} использовал заклятие &quot;<b>'.$itm['name'].'</b>&quot;.',($btl->hodID));

	/*Должно снимать: 600 601 602 603*/

	$pvr['nego'] = ' `id_eff` IN (600,601,602,603)';
    //$pvr['no'] = '';
	
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