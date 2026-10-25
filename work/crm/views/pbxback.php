<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>


<form action="/json.php" method="post">
<div id="top">
	<h1>Callback
			<i class="pull-right">
				<input class="btn btn-primary add" type="submit" value="Сохранить">
			</i>
		<i>Callback</i>
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
            <tr class=" callback">
                <td>
                    <b>Использовать callback</b>
                </td>
                <td id="pbx_callback_use_value">
                    <input id="ytpbx_callback_use" type="hidden" value="0" name="pbx.callback.use">
                    <input id="pbx_callback_use" type="checkbox" value="1" name="pbx.callback.use"> </td>
                <td>НЕТ</td>
            </tr>
            <tr class=" callback">
                <td>
                    <b>Номер телефона</b>
                    <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Номер телефона, на который нужно перезвонить при поступлении нового заказа" data-original-title="" title="">
                    </a>
                </td>
                <td id="pbx_callback_phone_value">
                    <input id="pbx_callback_phone" class="span6" placeholder="" type="text" value="" name="pbx.callback.phone"> </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</form>

<script>
</script>
