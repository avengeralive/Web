<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<div id="top">
	<h1>История звонков
		<i>История звонков</i>
   </h1>
</div>
<div id="list"></div>
<div id="list2">
	<div searcher="" class="call crmls" list="7" status="all" user="status1" count="50" pagination="true" template="10"></div>
</div>
<div id="detail"></div>

<script>
</script>
