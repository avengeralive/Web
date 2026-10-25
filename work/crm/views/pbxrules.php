<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<div id="top">
	<h1>Правила Робо-прозвона
		<i class="pull-right">
			<input class="btn btn-primary add" item="0" list="2" id="add" type="submit" value="Добавить">
		</i>
		<i>Правила Робо-прозвона</i>
   </h1>
</div>
<div id="contents-add"></div>
<div id="list"></div>
<div id="list2">
	<div searcher="" class="call crmls" list="2" status="all" user="status1" count="50" pagination="true" template="10"></div>
</div>
<div paginator></div>

<script>
</script>
