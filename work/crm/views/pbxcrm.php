<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
	$Data = CronRobot::getCronQueue();
?>

<div id="top">
	<h1>Запланированные звонки робота
		<i>Запланированные звонки робота</i>
   </h1>
</div>
<div id="list"></div>
<div id="list2">
	<div class="request">
		<span>Номер закзаа</span>
		<span>Статус заказа</span>
		<span>Шаблон робота</span>
		<span>Время звонка</span>
	</div>
	<?php foreach ($Data as $Item) { ?>
	<div class="request">
		<span><?php echo $Item['object']; ?></span>
		<span><?php echo $Item['order_status']; ?></span>
		<span><?php echo $Item['template']; ?></span>
		<span><?php echo $Item['calltime']; ?></span>
	</div>
	<?php } ?>
	<!--<div searcher="" class="call crmls" list="3" status="all" user="status1" count="50" pagination="true" template="10"></div>-->
</div>
<div id="detail"></div>

<script>
</script>
