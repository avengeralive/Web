<?
if(!isset($_GET['ajax']))
{
?>
	<INPUT style="float:right" TYPE=button value="Обновить" style='width: 100px'  onclick="Load();"></div>
	<h3>Заявки на хаотические поединки</h3>
<? } ?>
<div id="List" style="width:100%;">
<?php
$html = ''; $i = 0;
$sp = mysql_query('SELECT * FROM `zayvki` WHERE `razdel` = 5 AND `cancel` = 0 AND `btl_id` = 0 ORDER BY `id` ASC');
while( $pl = mysql_fetch_array($sp) ) {
	$i++;
	//
	$users = '';
	//
	$spu = mysql_query('SELECT `id` FROM `stats` WHERE `zv` = "'.$pl['id'].'"');
	while( $plu = mysql_fetch_array($spu) ) {
		$users .= $u->microLogin($plu['id'],1).',';
	}
	//
	if( $users == '' ) {
		$users = '<i><font color=grey><small>Поле боя ждет своих героев!</small></font></i>';
	}else{
		$users = rtrim($users,',');
	}
	//
	$html .= $i . '. <span class="date">'.date('H:i',$pl['time']).'</span> ';
	$html .= ' <img src="//img.testcombats.ru/i/city_ico/'.$pl['city'].'.gif">';
	$html .= ' ('.$users.') ('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].') Тип боя: <img src="//img.testcombats.ru/i/fighttype'.$pl['type'].'.gif"> ';
	if( $pl['noinc'] > 0 ) {
		$html .= '<img src="//img.testcombats.ru/closefight.gif" title="В поединок нельзя вмешаться">';
	}
	if( $pl['fastfight'] > 0 ) {
		$html .= '<img src="//img.testcombats.ru/fastfight.gif" title="Для старта поединка требуется минимум двое участников">';
	}
	if( $pl['arand'] > 0 ) {
		$html .= '<img src="//img.testcombats.ru/arand.gif" title="Команды делятся на две равные команды (равные по количеству, но не по мощности)">';
	}
    if( $pl['otmorozok'] == 1 ) {
		$html .= ' <img src="//img.testcombats.ru/snow.gif" width="20" height="20" title="В бой могут вмешаться Отморозки">';
	}
	$html .= '&nbsp;<font color="grey">Бой начнется через <b>'.$u->timeOut($pl['time']+$pl['time_start']-time()).'</b>, таймаут '.$u->timeOut($pl['timeout']).'</font>';
	if( $pl['priz'] > 0 ) {
		$html .= '<a href="//testcombats.ru/lib/prizovoi-haot/" target="_blank"><span style="color:#e65700;" title="Участники получают жетоны, чем больше призовых хаотов за сутки, тем больше падает жетонов за победу "><b>(Призовой хаот)</b></span></a></font></i>';
	}

	$html .= '<br>';
}
if( $html == '' ) {
	$html = '<center>(Раздел пуст)</center>';
}
echo $html; $html = '';
?>
<h3>Текущие бои</h3>
<?php
$i = 0;
$sp = mysql_query('SELECT * FROM `battle` WHERE `team_win` = -1');
while( $pl = mysql_fetch_array($sp) ) {
	//
	$users = '';
	$usersa = array();
	$userst = array();
	//
	$spu = mysql_query('SELECT `a`.`id`,`b`.`team` FROM `users` AS `a` LEFT JOIN `stats` AS `b` ON `a`.`id` = `b`.`id` WHERE `a`.`battle` = "'.$pl['id'].'"');
	while( $plu = mysql_fetch_array($spu) ) {
		if(!isset($usersa[$plu['team']])) {
			$userst[] = $plu['team'];
		}
		$usersa[$plu['team']] .= $u->microLogin($plu['id'],1).',';
	}
	//
	if( count($usersa) > 0 ) {
		$j = 0;
		while( $j < count($userst) ) {
			if( $users != '' ) {
				$users .= ' &nbsp;<b><font color=red><small>против</small></font></b>&nbsp; ';
			}
			$users .= $usersa[$userst[$j]];
			$users = rtrim($users,',');
			$j++;
		}
		//
		$i++;
		//
		
		$html .= $i . '. <span class="date">'.date('d.m.Y H:i',$pl['time_start']).'</span> ';
		$html .= ' <img src="//img.testcombats.ru/i/city_ico/'.$pl['city'].'.gif">';
		$html .= ' ('.$users.') Тип боя: <img src="//img.testcombats.ru/i/fighttype'.$pl['type'].'.gif"> ';
		if( $pl['noinc'] > 0 ) {
			$html .= '<img src="//img.testcombats.ru/closefight.gif" title="В поединок нельзя вмешаться">';
		}
		if( $pl['fastfight'] > 0 ) {
			$html .= '<img src="//img.testcombats.ru/fastfight.gif" title="Для старта поединка требуется минимум двое участников">';
		}
		if( $pl['arand'] > 0 ) {
			$html .= '<img src="//img.testcombats.ru/arand.gif" title="Команды делятся на две равные команды (равные по количеству, но не по мощности)">';
		}
        if( $pl['otmorozok'] == 1 ) {
			$html .= ' <img src="//img.testcombats.ru/snow.gif" width="20" height="20" title="В бой могут вмешаться Отморозки">';
		}
		$html .= '&nbsp;<font color="grey">, таймаут '.$u->timeOut($pl['timeout']).'</font>';
		if( $pl['priz'] > 0 ) {
			$html .= '<a href="//testcombats.ru/lib/prizovoi-haot/" target="_blank"><span style="color:#e65700;" title="Участники получают жетоны, чем больше призовых хаотов за сутки, тем больше падает жетонов за победу "><b>(Призовой хаот)</b></span></a></font></i>';
		}
        
		$html .= ' <a href="/logs.php?log='.$pl['id'].'" target="_blank">&raquo;&raquo;</a> ';
		$html .= '<br>';
	}
	//
}
if( $html == '' ) {
	$html = '<center>(Раздел пуст)</center>';
}
echo $html; $html = '';
?>
<h3>Башня смерти</h3>
<?php
$sp = mysql_query('SELECT * FROM `bs_turnirs`');
$i = 0;
while( $pl = mysql_fetch_array($sp) )
{
	$i++;
	//
	$html .= $i.'. <img src="//img.testcombats.ru/i/city_ico/'.$pl['city'].'.gif">';
	$html .= ' [lev: '.$pl['level'].']';

    $users = '';
	$spu = mysql_query('SELECT `id` FROM `users` WHERE `inTurnir` = "'.$pl['id'].'"');
	while( $plu = mysql_fetch_array($spu) ) $users .=  $u->microLogin($plu['id'],1). ',';
	$users = rtrim($users,',');

	if( $pl['status'] == 0 )
	{
		//Ожидаем начала нового турнира
		$html .= ' Начало турнира: <span class="date">'.date('d.m.Y H:i',$pl['time_start']).'</span> (<small> <font color=grey>Начнется через <b>'.$u->timeOut($pl['time_start']-time()).'</b></font></small>) Призовой фонд на текущий момент: <b>'.round(($pl['money']/100*85),2).'</b> кр. Всего подано заявок: <b>'.$pl['users'].'</b>';
        $html .= ' Участники: '.$users;
	}else{
		//Уже идет турнир
		$html .= ' <span title="['.$pl['status'].']">Турнир уже идет.</span>';
		$html .= ' Участники: '.$users.', Лог турнира: <a href="/towerlog.php?towerid='.$pl['id'].'&id='.$pl['count'].'" target="_blank">&raquo;&raquo;</a>';
	}
	//
	$html .= '<br>';
	//
}
if( $html == '' ) {
	$html = '<center>(Раздел пуст)</center>';
}
echo $html;
$html = '';
?>
<h3>Турниры</h3>
<?php
$sp = mysql_query('SELECT * FROM `turnirs`');
$i = 0;
while( $pl = mysql_fetch_array($sp) )
{
	$i++;
	//
    $html .= $i.'. <img title="capitalcity" src="//img.testcombats.ru/i/city_ico/capitalcity.gif">';
	$html .= '. [lev: '.$pl['level'].']';

	
	$spu = mysql_query('SELECT `id` FROM `users` WHERE `inTurnirNew` = "'.$pl['id'].'"');

	$users = '';
	while( $plu = mysql_fetch_array($spu) ) $users .=  $u->microLogin($plu['id'],1). ', ';
	$users = rtrim($users,', ');

	if( $pl['status'] == 0 )
	{
		//Ожидаем начала нового турнира
		$html .= ' Начало турнира: <span class="date">'.date('d.m.Y H:i',$pl['time']).'</span> (<small> <font color=grey>Начнется через <b>'.$u->timeOut($pl['time']-time()).'</b></font></small>). Интервал: '.$u->timeOut($pl['time2']).' Всего подано заявок: <b>'.$pl['users_in'].'</b>';
        $html .= ' Участники: '.$users;
	}else{
		//Уже идет турнир
		$html .= ' <span title="['.$pl['status'].']">Турнир уже идет.</span>';
		$html .= ' Участники: '.$users;//.', Лог турнира: <a href="/towerlog.php?towerid='.$pl['id'].'&id='.$pl['count'].'" target="_blank">&raquo;&raquo;</a>';
	}
	//
	$html .= '<br>';
	//
}
if( $html == '' ) {
	$html = '<center>(Раздел пуст)</center>';
}
echo $html;
$html = '';
?>
</div>
<script>
function Load()
{
	$.ajax({
		url: "?mod=context&menu=hmonitor&ajax=1",
		type: "GET",
		success: function(data)
		{
            $('#List').html("");
			$('#List').append(data);
		}
	});
}
</script>