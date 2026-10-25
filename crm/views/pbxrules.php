<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" type="text/css"/>

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
	<div searcher="" class="call crmls" list="2" status="all" user="all" count="50" pagination="true" template="10"></div>
</div>
<div paginator></div>

<script>
</script>
