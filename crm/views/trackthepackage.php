<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<div id="top">
	<h1>Отследить посылку РФ		
		<i class="pull-right">
			<input class="btn btn-primary add" item="0" list="50" type="submit" value="Добавить">
		</i>
		<i>Отследить посылку РФ</i>
   </h1>
</div>
<div id="contents-add"></div>
<div id="list2">
	<div searcher="" class="call crmls" list="50" status="all" user="all" count="50" pagination="true" template="10"></div>
</div>
<div paginator></div>
<div id="detail"></div>

<script>
</script>