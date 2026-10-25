<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<form action="/json.php" method="post">
	<div id="top">
		<h1>SMS-провайдеры
			<i class="pull-right">
				<input class="btn btn-primary add" type="submit" value="Сохранить">
			</i>
			<i>SMS-провайдеры</i>
	   </h1>
	</div>
<div class="alert alert-info">
                            <h3>MainSms</h3> позволяет отправлять смс по России и СНГ. Обратите внимание, что вы указываете не логин и пароль, а ключ API. Для этого перейдите в личный кабинет (в главном меню ссылка API) и добавьте новый проект, указав его имя и получив ключ.
<!-- 
                            <br> Чтобы получать статус, отправленного SMS, в добавленном проекте нужно указать "URL ОБНОВЛЕНИЙ СТАТУСОВ" вставив данный URL <code>https://test991.leadvertex.ru/api/mainSms/updateStatus</code>
 -->
                        </div>
    <table id="lv-config-table" class="table table-bordered table-forms">
        <tbody>
            <tr class=" mainsms">
                <td>
                    <b>Использовать MainSMS.ru</b>
                </td>
                <td id="sms_mainsms_use_value">
                    <input id="ytsms_mainsms_use" type="hidden" value="0" name="sms.mainsms.use">
                    <input id="sms_mainsms_use" checked="checked" type="checkbox" value="1" name="sms.mainsms.use"> </td>
                <td>НЕТ</td>
            </tr>
            <tr class=" mainsms">
                <td>
                    <b>MainSMS project</b>
                </td>
                <td id="sms_mainsms_login_value">
                    <input id="sms_mainsms_login" class="span6" placeholder="" type="text" value="fun" name="sms.mainsms.login"> </td>
                <td></td>
            </tr>
            <tr class=" mainsms">
                <td>
                    <b>MainSMS API key</b>
                </td>
                <td id="sms_mainsms_password_value">
                    <input id="sms_mainsms_password" class="span6" placeholder="" type="password" value="f0440699a8535" name="sms.mainsms.password"> </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</form>
<div id="list2"></div>

<script>
</script>
