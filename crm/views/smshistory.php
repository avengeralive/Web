<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>
<style>
#list2 .request > span:first-of-type {
    min-width: 5%;
}
#list2 .request > span:last-of-type {
    min-width: 40%;
}
</style>
<div id="top">
	<h1>История SMS
		<i>История SMS</i>
   </h1>
</div>
<div id="list"></div>
<div id="list2">
	<div searcher="" class="call crmls" list="6" status="all" user="all" count="50" pagination="true" template="10" style=""></div>
</div>
<div paginator></div>
<script></script>
