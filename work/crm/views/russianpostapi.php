<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<div id="top">
	<h1>Онлайн-сервис «Отправка»
		<i class="pull-right">
			<input class="btn btn-primary add" item="0" list="23" id="add" type="submit" value="Добавить Аккаунт">
			<input class="btn btn-primary add" item="0" list="11" id="add" type="submit" value="Добавить Тип">
		</i>
		<i>Онлайн-сервис «Отправка»</i>
   </h1>
</div>
<div id="contents-add"></div>
<div id="list"></div>
<div id="list2">
	<div searcher="" class="call crmls" list="23" status="all" user="status1" count="50" pagination="true" template="10"></div>
	<hr>
	<div searcher="" class="call crmls" list="11" status="all" user="status1" count="50" pagination="true" template="10"></div>
</div>
<div paginator></div>

<script>
</script>