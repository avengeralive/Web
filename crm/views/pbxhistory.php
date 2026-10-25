<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
	$Data = CronRobot::getCronHistory();
	$Status_sms = json_decode('{"0":"- Не выбрано -","1":"Доставлено",
"-100":"Доставлено (не дослушано)",
"5000":"Доставлено (оператор)",
"-5000":"Доставлено (соединение не установлено)",
"-3":"Автоответчик",
"-1":"Ошибка",
"-486":"Занято",
"-404":"Некорректный номер",
"-603":"Вызов отклонен",
"-487":"Нет ответа",
"-5001":"Ошибка соединения с оператором",
"2001":"Нажата клавиша «1»",
"2002":"Нажата клавиша «2»",
"2003":"Нажата клавиша «3»",
"2004":"Нажата клавиша «4»",
"2005":"Нажата клавиша «5»",
"2006":"Нажата клавиша «6»",
"2007":"Нажата клавиша «7»",
"2008":"Нажата клавиша «8»",
"2009":"Нажата клавиша «9»",
"2010":"Нажата клавиша «0»"}', true);
?>
<style>
#list2 .request audio {display: block;
    height: 35px;
    margin: 2px;}#list2 .request > span:first-of-type {min-width: auto;}
#list2 .request {display: flex;}
#list2 .request > span:last-of-type {max-width: inherit;}</style>
    
<div id="top">
	<h1>История звонков робота
		<i>История звонков робота</i>
   </h1>
</div>
<div id="list"></div>
<div id="list2">
	<div class="request">
		<span>Номер закзаа</span>
		<span>Статус заказа</span>
		<span>Шаблон робота</span>
		<span>Время звонка</span>
		<span>Статус звонка</span>
		<span>Запись</span>
	</div>
	<?php foreach ($Data as $Item) { ?>
	<div class="request">
		<span><?php echo $Item['object']; ?></span>
		<span><?php echo $Item['order_status']; ?></span>
		<span><?php echo $Item['template']; ?></span>
		<span><?php echo $Item['calltime']; ?></span>
		<span><?php echo $Status_sms[$Item['status_sms']]; ?></span>
		<span><audio src="/robot/call_<?php echo $Item['id']; ?>/tmp.mp3" controls></audio></span>
	</div>
	<?php } ?>
</div>
<div id="detail"></div>

<script>
</script>
