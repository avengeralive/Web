<?php namespace lib;
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<div id="top">
	<h1>Телефониия	
		<i class="pull-right">
			<input class="btn btn-primary add" item="0" list="36" type="submit" value="Добавить">
		</i>
		<i>Настройка параметров телефонии</i>
   </h1>
</div>
<div id="contents-add"></div>
<div id="list2">
	<div searcher="" class="call crmls" list="36" status="all" user="status1" count="50" pagination="true" template="10"></div>
</div>
<div paginator></div>

<script>
</script>
