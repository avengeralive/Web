<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<form action="/json.php" method="post">
	<div id="top">
		<h1>Настройка параметров входящих вызовов
			<i class="pull-right">
				<input class="btn btn-primary add" type="submit" value="Сохранить">
			</i>
			<i>Входящие вызовы</i>
	   </h1>
	</div>
    <div class="alert alert-info">Изменения вступят в силу в течение 10 минут!</div>

    <table id="lv-config-table" class="table table-bordered table-forms">
            <tr>
                <td>
                    <b>Пользователь и пароль</b>
                </td>
                <td><input class="span12" placeholder="Имя пользователя" name="Pbx[username]" id="Pbx_username" type="text" maxlength="50" value="smorchkov_2"></td>
                <td><input class="span12" placeholder="Пароль" name="Pbx[password]" id="Pbx_password" type="password" maxlength="50" value="Bn6X_74SP-K7j8"></td>
            </tr>
            <tr>
                <td><b>Переводить звонок на номер</b></td>
                <td><input class="span12" placeholder="Номер телефона" name="InboundPbx[bridgeTo]" id="InboundPbx_bridgeTo" type="text" maxlength="50" value=""></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Имя хоста</b></td>
                <td><input class="span12" placeholder="Имя хоста" name="InboundPbx[realm]" id="InboundPbx_realm" type="text" maxlength="50" value=""></td>
                <td></td>
            </tr>
            <tr>
                <td><b>От кого (домен)</b></td>
                <td><input class="span12" placeholder="Домен" name="InboundPbx[fromDomain]" id="InboundPbx_fromDomain" type="text" maxlength="50" value=""></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Прокси</b></td>
                <td><input class="span12" placeholder="Прокси сервер" name="Pbx[proxy]" id="Pbx_proxy" type="text" maxlength="50" value=""></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Протокол</b></td>
                <td><select class="span12" name="Pbx[registerTransport]" id="Pbx_registerTransport">
                	<option value="auto" selected="selected">Автоматически</option>
                	<option value="tcp">tcp</option>
                	<option value="udp">udp</option>
            		</select></td>
                <td></td>
            </tr>
            <tr>
                <td>Время переподключения</td>
                <td><input class="span12" value="30" name="InboundPbx[retrySeconds]" id="InboundPbx_retrySeconds" type="number"></td>
                <td></td>
            </tr>
            <tr>
                <td>Пинг</td>
                <td><input class="span12" value="30" name="InboundPbx[retrySeconds]" id="InboundPbx_retrySeconds" type="number"></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><label class="checkbox" for="Pbx_withPlus"><input name="Pbx[withPlus]" id="Pbx_withPlus" value="1" checked="checked" type="checkbox">Всегда добавлять новый заказ при входящем вызове</label></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <div class="alert alert-danger">Для отключения входящих вызовов оставьте поля «Пользователь» и «Пароль» пустыми</div>
	<div class="alert alert-success">
		<h3>Использовать шаблон конфигурации</h3> Вы можете выбрать шаблон с заранее подготовленными данными для подключения необходимого Вам оператора. Выбрав нужного оператора Вам останется только заполнить поля <b>«Пользователь»</b>, <b>«Пароль»</b>, <b>«Переводить звонок на номер»</b>.
		<br>
		<select name="pbx-template" id="pbx-template">
         <option value="0" selected="selected">Пустой шаблон</option>
         <option value="1">Мультифон</option>
      </select>
   </div>
</form>
<script>
</script>
