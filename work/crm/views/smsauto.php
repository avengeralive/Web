<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<form action="/json.php" method="post">
	<div id="top">
		<h1>Авто-уведомления
			<i class="pull-right">
				<input class="btn btn-primary add" type="submit" value="Сохранить">
			</i>
			<i>Авто-уведомления</i>
	   </h1>
	</div>
    <div style="display:none">
        <input type="hidden" value="be0713bdcf4d2b1ae8f32bfaa8078ac8cfc44f93" name="YII_CSRF_TOKEN">
    </div>
    <table id="lv-config-table" class="table table-bordered table-forms">
        <thead>
            <tr>
                <th>Название</th>
                <th>Значение</th>
                <th>Значение по умолчанию</th>
                <!--th></th-->
            </tr>
        </thead>
        <tbody>
            <tr class=" client">
                <td>
                    <b>Автоматически отправлять клиенту СМС после оформления заказа</b>
                </td>
                <td id="smsAuto_client_value">
                    <select id="smsAuto_client" name="smsAuto.client">
                        <option value="-1" selected="selected">Не отправлять</option>
                        <option value="22445">ОКК</option>
                        <option value="22446">НДЗ</option>
                        <option value="22447">Переданы на склад</option>
                        <option value="22448">Предиктивный набор (День 4)</option>
                        <option value="22449">День 6</option>
                        <option value="22450">День 7</option>
                        <option value="22451">День 9</option>
                        <option value="22452">День 11</option>
                        <option value="22453">День 13</option>
                        <option value="22454">Робот-проверяющий заказы на валидность</option>
                        <option value="22455">Предиктивный набор (День 6)</option>
                        <option value="22456">Предиктивный набор (День 8)</option>
                        <option value="22457">Трек номер клиента</option>
                        <option value="22458">Предиктивный набор (День 10)</option>
                    </select>
                </td>
                <td>Не отправлять</td>
                <!--<td><a class="icon-wrench" href=""></a></td>-->
            </tr>
            <tr class="tr-odd sendToDoubles">
                <td>
                    <b>Отсылать автоматическое сообщение на дубли</b>
                    <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Автоматическое сообщение будет отправлено на дубль нового заказа" data-original-title="" title="">
                    </a>
                </td>
                <td id="smsAuto_sendToDoubles_value">
                    <input id="ytsmsAuto_sendToDoubles" type="hidden" value="0" name="smsAuto.sendToDoubles">
                    <input id="smsAuto_sendToDoubles" type="checkbox" value="1" name="smsAuto.sendToDoubles"> </td>
                <td>НЕТ</td>
                <!--<td><a class="icon-wrench" href=""></a></td>-->
            </tr>
            <tr class=" me">
                <td>
                    <b>Автоматически отправлять СМС о новом заказе на указанный ниже номер</b>
                </td>
                <td id="smsAuto_me_template_value">
                    <select id="smsAuto_me_template" name="smsAuto.me.template">
                        <option value="-1" selected="selected">Не отправлять</option>
                        <option value="22445">ОКК</option>
                        <option value="22446">НДЗ</option>
                        <option value="22447">Переданы на склад</option>
                        <option value="22448">Предиктивный набор (День 4)</option>
                        <option value="22449">День 6</option>
                        <option value="22450">День 7</option>
                        <option value="22451">День 9</option>
                        <option value="22452">День 11</option>
                        <option value="22453">День 13</option>
                        <option value="22454">Робот-проверяющий заказы на валидность</option>
                        <option value="22455">Предиктивный набор (День 6)</option>
                        <option value="22456">Предиктивный набор (День 8)</option>
                        <option value="22457">Трек номер клиента</option>
                        <option value="22458">Предиктивный набор (День 10)</option>
                    </select>
                </td>
                <td>Не отправлять</td>
                <!--<td><a class="icon-wrench" href=""></a></td>-->
            </tr>
            <tr class=" me">
                <td>
                    <b>На номер</b>
                    <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Указывайте номер в международном формате, через «+»" data-original-title="" title="">
                    </a>
                </td>
                <td id="smsAuto_me_phone_value">
                    <input id="smsAuto_me_phone" class="span6" placeholder="" type="text" value="" name="smsAuto.me.phone"> </td>
                <td></td>
                <!--<td><a class="icon-wrench" href=""></a></td>-->
            </tr>
        </tbody>
    </table>
</form>

<script>
</script>
