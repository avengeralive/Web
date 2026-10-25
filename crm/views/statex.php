<?php namespace lib;

if(!in_array('stat', $RoleGroup) && !in_array('seniormanager', $RoleGroup)) {
	die('Access denied');
}
// if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) {
//     die();
// }
?>

<link rel="stylesheet" type="text/css" href="/css/statex.css">
<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
<?php  if(!in_array('seniormanager', $RoleGroup)) {?>
<div id="top">
	<h1>Статистика по продажам
		<i class="radios little" style="float: right;">
			<label class="active"><input type="radio" name="radios" radios="statex_current">Все данные</label>
			<label><input type="radio" name="radios" radios="statex_cache">Кеширование</label>
			<label><input type="radio" name="radios" radios="statex_prepare">Обновить данные</label>
			<?php
				if (in_array('admin', $RoleGroup) || in_array('admin', $RoleUser) || in_array('seniormanager', $RoleGroup)) {
					echo('<label><input type="radio" name="radios" radios="statex_csv">Экспорт CSV</label>');
					echo('<label><input type="radio" name="radios" radios="statex_bprice">Цена закупа</label>');
					echo('<label><input type="radio" name="radios" radios="statex_config">Настройки</label>');
				}
			?>
		</i>
		<i>Сводная статистика</i>
	</h1>
</div>
<?php } ?>

<div id="tabs" >
	<div id="datetabs"></div>
</div>

<div id="loading">
Загрузка...<br>
	<img src="/img/spinner2.gif" class="spinner">
</div>

<div id="charts"></div>
<script type="text/javascript" src="/js/chart.js"></script>
<script type="text/javascript" src="/js/statex.js?v2020-03-12"></script>


