<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<form action="/json.php" method="post">
	<div id="top">
		<h1>Настройки очереди проекта
			<i class="pull-right">
				<input class="btn btn-primary add" type="submit" value="Сохранить">
			</i>
			<i>Настройки очереди проекта</i>
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
            <tr class=" offer">
                <td>
                    <b>Очередь</b>
                </td>
                <td id="queue_offer_value">
                    <select id="queue_offer" name="queue.offer">
                        <option value="-1">Не выбрано</option>
                        <option value="115" selected="selected">Предиктивный набор</option>
                        <option value="116">актив</option>
                    </select>
                </td>
                <td>Не выбрано</td>
                <!--<td><a class="icon-wrench" href=""></a></td>-->
            </tr>
            <tr class="tr-odd work">
                <td>
                    <b>Часовой пояс по UTC</b>
                </td>
                <td id="queue_work_timezone_value">
                    <input id="queue_work_timezone" class="span6" placeholder="" type="text" value="3" name="queue.work.timezone"> </td>
                <td>3</td>
                <!--<td><a class="icon-wrench" href=""></a></td>-->
            </tr>
            <tr class="tr-odd work">
                <td>
                    <b>Начало рабочего дня</b>
                    <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Указывается в часах" data-original-title="" title="">
                    </a>
                </td>
                <td id="queue_work_hourBegin_value">
                    <input id="queue_work_hourBegin" class="span6" placeholder="" type="text" value="9" name="queue.work.hourBegin"> </td>
                <td>9</td>
                <!--<td><a class="icon-wrench" href=""></a></td>-->
            </tr>
            <tr class="tr-odd work">
                <td>
                    <b>Конец рабочего дня</b>
                    <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-delay="1500" data-content="Указывается в часах" data-original-title="" title="">
                    </a>
                </td>
                <td id="queue_work_hourEnd_value">
                    <input id="queue_work_hourEnd" class="span6" placeholder="" type="text" value="21" name="queue.work.hourEnd"> </td>
                <td>21</td>
                <!--<td><a class="icon-wrench" href=""></a></td>-->
            </tr>
            <tr class=" language">
                <td>
                    <b>Язык анонса очереди</b>
                </td>
                <td id="queue_language_value">
                    <select id="queue_language" name="queue.language">
                        <option value="ru" selected="selected">Русский</option>
                        <option value="en">Английский</option>
                        <option value="de">Немецкий</option>
                    </select>
                </td>
                <td>Русский</td>
                <!--<td><a class="icon-wrench" href=""></a></td>-->
            </tr>
        </tbody>
    </table>
</form>
<script>
</script>
