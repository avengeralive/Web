<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('operators', $RoleUser) && !in_array('operators', $RoleGroup)) die();	
	settings
?>

<form action="json.php" method="post">
	<div id="top">
		<h1>Настройка прав операторов
			<i class="pull-right">
				<input class="btn btn-primary add" type="submit" name="yt0" value="Сохранить">
			</i>
			<i>Настройка прав операторов</i>
		</h1>
	</div>
 
	<div feed id="list">	
		<div>
			<input type="hidden" value="CUser" name="func">
			<input type="hidden" value="operators" name="action">
			<input type="hidden" value="<?php $JSCat['domain']?>" name="domain">
			<input type="hidden" value="<?php $JSCat['token']?>" name="token">
			<input class="ios8" id="operator_script" checked="checked" type="checkbox"><label title for="operator_script"></label><strong> Выводить текст скрипта оператору на странице редактирования заказа</strong><span></span>
		</div>   
		<div><input class="ios8" id="operator_export" checked="checked" type="checkbox"><label title for="operator_export"></label><strong> Разрешить операторам экспорт заказов</strong><span></span></div>   
		<div><input class="ios8" id="operator_denyManyOrders" checked="checked" type="checkbox"><label title for="operator_denyManyOrders"></label><strong> Запрещать оператору открывать одновременно несколько заказов</strong><span></span></div>   
		<div><input class="ios8" id="operator_manualOrder" checked="checked" type="checkbox"><label title for="operator_manualOrder"></label><strong> Разрешить оператору создавать заказы вручную</strong><span></span></div>   
		<div><input class="ios8" id="operator_allow_showDoubleIp" checked="checked" type="checkbox"><label title for="operator_allow_showDoubleIp"></label><strong> Показывать операторам дубли по ip в карточке заказа</strong><span></span></div>   
		<div><input class="ios8" id="operator_allow_showOrderStatus" checked="checked" type="checkbox"><label title for="operator_allow_showOrderStatus"></label><strong> Показывать операторам статусы дублей заказов в карточке заказа</strong><span></span></div>   
		<div><input class="ios8" id="operator_goods_hideIfNoReserve" checked="checked" type="checkbox"><label title for="operator_goods_hideIfNoReserve"></label><strong> Скрывать товар в карточке заказа, если его остаток меньше либо равен нулю</strong><span></span></div>   
		<div><input class="ios8" id="operator_callmodenew_timezone" checked="checked" type="checkbox"><label title for="operator_callmodenew_timezone"></label><strong> Выдавать заказы в режиме прозвона операторам только те, у которых время клиента с 9-00 до 21-00</strong><span></span></div>   
		<div><input class="ios8" id="operator_showNewOrdersCount" checked="checked" type="checkbox"><label title for="operator_showNewOrdersCount"></label><strong> Показывать счетчик заказов и уведомлять операторов</strong><span></span></div>   
		<div><input class="ios8" id="operator_showRecallLog" checked="checked" type="checkbox"><label title for="operator_showRecallLog"></label><strong> Записывать результаты прозвона в отдельное поле «Лог прозвона»</strong><span></span></div>   
		<div><input class="ios8" id="operator_showIpInHistory" checked="checked" type="checkbox"><label title for="operator_showIpInHistory"></label><strong> Показывать оператору IP-адрес в истории изменений</strong><span></span></div>   
	</div>
</form>
