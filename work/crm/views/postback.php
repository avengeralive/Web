<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('admin', $RoleUser) && !in_array('admin', $RoleGroup)) die();	
?>

<div id="top">
	<h1>Postback
		<i>Postback</i>
   </h1>
</div>

<script>

(function ($) {
    $(function () {
        var $spoilers = $('.spoiler-btn'),
            $spoilerBodies = $('.spoiler-body');

        $spoilerBodies.collapse();

        $spoilers.on('click', function() {
            var $target = $(this).parent().find('.spoiler-body');
            $target.collapse('toggle');
        });
    });
})(jQuery);

function zeroPad(num, places) {
    var zero = places - num.toString().length + 1;
    return Array(+(zero > 0 && zero)).join("0") + num;
}

function rand( min, max ) {
    if( max ) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    } else {
        return Math.floor(Math.random() * (min + 1));
    }
}

$(document).ready(function () {
    $('.dropdown-menu').not('.dropdown-menu-ajax').click(function (event) {
        event.stopPropagation();
    });

    //Мигающее количество тикетов
    var $supportTicketCount = $('#supportTicketCount');
    var $webmasterPaymentsCount = $('#webmasterEventsCount');
    setInterval(function(){
        $supportTicketCount.fadeOut(500);
        $supportTicketCount.fadeIn(500);
        $webmasterPaymentsCount.fadeOut(500);
        $webmasterPaymentsCount.fadeIn(500);
    }, 1000);

//     if ($.cookie('noActiveOffer') === null) $('#alertNoActiveOffer').show();
//     $('#closeNoActiveOffer').click(function () {
//         $.cookie('noActiveOffer', 'hide', {expires: 5});
//     });
// 
//     if ($.cookie('noActiveLiteOffer') === null) $('#alertNoActiveLiteOffer').show();
//     $('#closeNoActiveLiteOffer').click(function () {
//         $.cookie('noActiveLiteOffer', 'hide', {expires: 5});
//     });
// 
//     if (localStorage.getItem('oldLandingForms') === null) $('#alertOldForms').show();
//     $('#alertOldFormsCloseBtn').click(function () {
//         $("#alertOldForms").alert('close');
//         localStorage.setItem('oldLandingForms', 'hide');
//     });
// 
//     if ($.cookie('robotAlert') === null) $('#robotAlert').show();
//     $('#closeRobotAlert').click(function () {
//         var date = new Date();
//         var minutes = 60;
//         date.setTime(date.getTime() + (minutes * 60 * 1000));
//         $.cookie('robotAlert', 'hide', {expires: date});
//     });
// 
//     if ($.cookie('webinarAlert') === null) $('#webinarAlert').show();
//     $('#closeWebinarAlert').click(function () {
//         var date = new Date();
//         var minutes = 1440;
//         date.setTime(date.getTime() + (minutes * 120 * 1000));
//         $.cookie('webinarAlert', 'hide', {expires: date});
//     });
});


</script>
<form action="/json.php" method="post">
    <div style="display:none">
        <input type="hidden" value="be0713bdcf4d2b1ae8f32bfaa8078ac8cfc44f93" name="YII_CSRF_TOKEN">
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Общий Postback (все заказы) для новых заказов</div>
        <div class="spoiler-body in collapse" id="lv-postblank-common" style="height: auto;">
            <table id="lv-config-table-common" class="table table-bordered table-forms">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Значение</th>
                        <th>Значение по умолчанию</th>
                        <!--th></th-->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <b>Включить общий postback (для новых заказов)</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Postback будет срабатывать как для ваших личных заказов (если вы льете трафик сами), так и для заказов, пришедших от ваших веб-мастеров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="postback_common_use_value">
                            <input id="ytpostback_common_use" type="hidden" value="0" name="postback.common.use">
                            <input id="postback_common_use" checked="checked" type="checkbox" value="1" name="postback.common.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Url для отправки postback</b>
                        </td>
                        <td id="postback_common_url_value">
                            <input id="postback_common_url" class="span6" placeholder="" type="text" value="http://timberland-m.ru/api/live.php" name="postback.common.url"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Поля для отправки данных через POST-запрос</b>
                        </td>
                        <td id="postback_common_post_value">
                            <div id="postback_common_post_notice">
                                Здесь можно сформировать какие данные будут отправляться на указанный url и в каком формате. Например, если указать такие данные
                                <pre>status:{{status}}
name:{{fio}}
track:{{russianpostTrack}}</pre> то на указанный выше url будет отправлен POST, где в качестве ключей будут использованы <code>status</code>,
                                <code>name</code> и <code>track</code>, а в их значении будут переданы соответствующие значения из заказа. <strong>Будьте внимательны с пробелами! Они не нужны</strong>
                                <ul>
                                    <li><code>{{id}}</code> - возвращает номер заказа пользователя</li>
                                    <li><code>{{offerName}}</code> - название проекта</li>
                                    <li><code>{{statusID}}</code> - ID статуса заказа</li>
                                    <li><code>{{statusGroup}}</code> - группа статуса, может принимать значения:
                                        <ul>
                                            <li><code>spam</code> - Ошибка/Спам/Дубль</li>
                                            <li><code>return</code> - Возврат</li>
                                            <li><code>canceled</code> - Отменен</li>
                                            <li><code>processing</code> - Обработка</li>
                                            <li><code>accepted</code> - Принят</li>
                                            <li><code>shipped</code> - Отправлен</li>
                                            <li><code>paid</code> - Оплачен</li>
                                        </ul>
                                    </li>
                                    <li><code>{{payment_status}}</code> - статус вознаграждения. <span class="label">-1</span> - отказано, <span class="label">0</span> - в обработке, <span class="label">1</span> - выплачено</li>
                                    <li><code>{{payment_sum}}</code> - сумма вознаграждения за заказ</li>
                                    <li><code>{{datetime}}</code> - дата и время в формате: 2019-05-17 11:22:00</li>
                                    <li><code>{{lastUpdate}}</code> - статус изменен в формате: 2019-05-17 11:22:00</li>
                                    <li><code>{{lastModify}}</code> - последние изменение в формате: 2019-05-17 11:22:00</li>
                                    <li><code>{{approvedAt}}</code> - дата и время апрува в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{shippedAt}}</code> - дата и время отправки в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{canceledAt}}</code> - дата и время отмены в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{buyoutAt}}</code> - дата и время выкупа в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{refundedAt}}</code> - дата и время возврата в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{timezone}}</code> - смещение времени клиента в минутах относительно UTC (чтобы не звонить клиенту ночью)</li>
                                    <li><code>{{price}}</code> - цена товара</li>
                                    <li><code>{{total}}</code> - сумма заказа</li>
                                    <li><code>{{goods}}</code> - данные о товарах в заказе в JSON:
                                        <pre><code>{
  "alias": {
    "goodID": "ID товара_1",
    "name": "Наименование товара_1",
    "quantity": "Количество товара_1",
    "price": "Цена товара_1"
  },
  "alias2": {
    "goodID": "ID товара_2",
    "name": "Наименование товара_2",
    "quantity": "Количество товара_2",
    "price": "Цена товара_2"
  }
  ...
}</code></pre>, где в качестве ключа используется alias-товара</li>
                                    <li><code>{{russianpostTrack}}</code> - номер отправления Почты России</li>
                                    <li><code>{{domain}}</code> - домен, на котором пользователь совершил заказ</li>
                                    <li><code>{{timeSpent}}</code> - количество секунд, затраченных на заказ</li>
                                    <li><code>{{webmasterID}}</code> - ID веб-мастера, от которого пришел заказ</li>
                                    <li><code>{{operatorID}}</code> - ID оператора</li>
                                    <li><code>{{ip}}</code> - IP адрес пользователя</li>
                                    <li><code>{{referer}}</code> - Referer</li>
                                    <li><code>{{utm_source}}</code> - метка utm_source</li>
                                    <li><code>{{utm_medium}}</code> - метка utm_medium</li>
                                    <li><code>{{utm_campaign}}</code> - метка utm_campaign</li>
                                    <li><code>{{utm_content}}</code> - метка utm_content</li>
                                    <li><code>{{utm_term}}</code> - метка utm_term</li>
                                    <li><code>{{fio}}</code> - возвращает значение поля «Ф.И.О». Аналогичным образом можно использовать поля:<code title="Индекс">{{postIndex}}</code> <code title="Регион">{{region}}</code> <code title="Город">{{city}}</code> <code title="Адрес">{{address}}</code> <code title="Телефон">{{phone}}</code> <code title="Кол-во">{{quantity}}</code> <code title="Комментарий">{{comment}}</code> <code title="Liveinform">{{additional1}}</code> <code title="Размер">{{additional2}}</code> <code title="Дожим">{{additional11}}</code> <code title="Масса">{{additional14}}</code> </li>
                                </ul>
                            </div>
                            <textarea id="postback_common_post" class="span6" rows="4" placeholder="" name="postback.common.post">api_id:5sBrM9tE-P3HnxTBU-sm8NMlOO-86pM5flY contact:{{phone}} id:{{id}} domain:fun lvKey:12345678910
                            </textarea>
                        </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Общий Postback (все заказы) при смене статуса</div>
        <div class="spoiler-body in collapse" id="lv-postblank-commonStatus" style="height: auto;">
            <table id="lv-config-table-commonStatus" class="table table-bordered table-forms">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Значение</th>
                        <th>Значение по умолчанию</th>
                        <!--th></th-->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <b>Включить общий postback (при смене статуса)</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Postback будет срабатывать только при смене статуса у заказов. Как для ваших личных заказов (если вы льете трафик сами), так и для заказов, пришедших от ваших веб-мастеров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="postback_commonStatus_use_value">
                            <input id="ytpostback_commonStatus_use" type="hidden" value="0" name="postback.commonStatus.use">
                            <input id="postback_commonStatus_use" checked="checked" type="checkbox" value="1" name="postback.commonStatus.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Url для отправки postback</b>
                        </td>
                        <td id="postback_commonStatus_url_value">
                            <input id="postback_commonStatus_url" class="span6" placeholder="" type="text" value="https://www.liveinform.ru/api/leadvertex/?api_id=5sBrM9tE-P3HnxTBU-sm8NMlOO-86pM5flY" name="postback.commonStatus.url"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Поля для отправки данных через POST-запрос</b>
                        </td>
                        <td id="postback_commonStatus_post_value">
                            <div id="postback_common_post_notice">
                                Здесь можно сформировать какие данные будут отправляться на указанный url и в каком формате. Например, если указать такие данные
                                <pre>status:{{status}}
name:{{fio}}
track:{{russianpostTrack}}</pre> то на указанный выше url будет отправлен POST, где в качестве ключей будут использованы <code>status</code>,
                                <code>name</code> и <code>track</code>, а в их значении будут переданы соответствующие значения из заказа. <strong>Будьте внимательны с пробелами! Они не нужны</strong>
                                <ul>
                                    <li><code>{{id}}</code> - возвращает номер заказа пользователя</li>
                                    <li><code>{{offerName}}</code> - название проекта</li>
                                    <li><code>{{statusID}}</code> - ID статуса заказа</li>
                                    <li><code>{{statusGroup}}</code> - группа статуса, может принимать значения:
                                        <ul>
                                            <li><code>spam</code> - Ошибка/Спам/Дубль</li>
                                            <li><code>return</code> - Возврат</li>
                                            <li><code>canceled</code> - Отменен</li>
                                            <li><code>processing</code> - Обработка</li>
                                            <li><code>accepted</code> - Принят</li>
                                            <li><code>shipped</code> - Отправлен</li>
                                            <li><code>paid</code> - Оплачен</li>
                                        </ul>
                                    </li>
                                    <li><code>{{payment_status}}</code> - статус вознаграждения. <span class="label">-1</span> - отказано, <span class="label">0</span> - в обработке, <span class="label">1</span> - выплачено</li>
                                    <li><code>{{payment_sum}}</code> - сумма вознаграждения за заказ</li>
                                    <li><code>{{datetime}}</code> - дата и время в формате: 2019-05-17 11:22:00</li>
                                    <li><code>{{lastUpdate}}</code> - статус изменен в формате: 2019-05-17 11:22:00</li>
                                    <li><code>{{lastModify}}</code> - последние изменение в формате: 2019-05-17 11:22:00</li>
                                    <li><code>{{approvedAt}}</code> - дата и время апрува в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{shippedAt}}</code> - дата и время отправки в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{canceledAt}}</code> - дата и время отмены в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{buyoutAt}}</code> - дата и время выкупа в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{refundedAt}}</code> - дата и время возврата в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{timezone}}</code> - смещение времени клиента в минутах относительно UTC (чтобы не звонить клиенту ночью)</li>
                                    <li><code>{{price}}</code> - цена товара</li>
                                    <li><code>{{total}}</code> - сумма заказа</li>
                                    <li><code>{{goods}}</code> - данные о товарах в заказе в JSON:
                                        <pre><code>{
  "alias": {
    "goodID": "ID товара_1",
    "name": "Наименование товара_1",
    "quantity": "Количество товара_1",
    "price": "Цена товара_1"
  },
  "alias2": {
    "goodID": "ID товара_2",
    "name": "Наименование товара_2",
    "quantity": "Количество товара_2",
    "price": "Цена товара_2"
  }
  ...
}</code></pre>, где в качестве ключа используется alias-товара</li>
                                    <li><code>{{russianpostTrack}}</code> - номер отправления Почты России</li>
                                    <li><code>{{domain}}</code> - домен, на котором пользователь совершил заказ</li>
                                    <li><code>{{timeSpent}}</code> - количество секунд, затраченных на заказ</li>
                                    <li><code>{{webmasterID}}</code> - ID веб-мастера, от которого пришел заказ</li>
                                    <li><code>{{operatorID}}</code> - ID оператора</li>
                                    <li><code>{{ip}}</code> - IP адрес пользователя</li>
                                    <li><code>{{referer}}</code> - Referer</li>
                                    <li><code>{{utm_source}}</code> - метка utm_source</li>
                                    <li><code>{{utm_medium}}</code> - метка utm_medium</li>
                                    <li><code>{{utm_campaign}}</code> - метка utm_campaign</li>
                                    <li><code>{{utm_content}}</code> - метка utm_content</li>
                                    <li><code>{{utm_term}}</code> - метка utm_term</li>
                                    <li><code>{{fio}}</code> - возвращает значение поля «Ф.И.О». Аналогичным образом можно использовать поля:<code title="Индекс">{{postIndex}}</code> <code title="Регион">{{region}}</code> <code title="Город">{{city}}</code> <code title="Адрес">{{address}}</code> <code title="Телефон">{{phone}}</code> <code title="Кол-во">{{quantity}}</code> <code title="Комментарий">{{comment}}</code> <code title="Liveinform">{{additional1}}</code> <code title="Размер">{{additional2}}</code> <code title="Дожим">{{additional11}}</code> <code title="Масса">{{additional14}}</code> </li>
                                </ul>
                            </div>
                            <textarea id="postback_commonStatus_post" class="span6" rows="4" placeholder="" name="postback.commonStatus.post">phone:{{phone}} tracking:{{russianpostTrack}} lastname:{{fio}} statusID:{{statusID}} tags:ООО,Трейд,wmr,fun
                            </textarea>
                        </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Личный Postback (заказа НЕ от веб-мастеров) для новых заказов и при смене статуса</div>
        <div class="spoiler-body in collapse" id="lv-postblank-personal" style="height: auto;">
            <table id="lv-config-table-personal" class="table table-bordered table-forms">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Значение</th>
                        <th>Значение по умолчанию</th>
                        <!--th></th-->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <b>Включить личный postback (для новых заказов и при смене статуса)</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Postback будет срабатывать только для ваших личных заказов (если вы льете трафик сами)" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="postback_personal_use_value">
                            <input id="ytpostback_personal_use" type="hidden" value="0" name="postback.personal.use">
                            <input id="postback_personal_use" type="checkbox" value="1" name="postback.personal.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Url для отправки postback</b>
                        </td>
                        <td id="postback_personal_url_value">
                            <input id="postback_personal_url" class="span6" placeholder="" type="text" value="" name="postback.personal.url"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Поля для отправки данных через POST-запрос</b>
                        </td>
                        <td id="postback_personal_post_value">
                            <div id="postback_common_post_notice">
                                Здесь можно сформировать какие данные будут отправляться на указанный url и в каком формате. Например, если указать такие данные
                                <pre>status:{{status}}
name:{{fio}}
track:{{russianpostTrack}}</pre> то на указанный выше url будет отправлен POST, где в качестве ключей будут использованы <code>status</code>,
                                <code>name</code> и <code>track</code>, а в их значении будут переданы соответствующие значения из заказа. <strong>Будьте внимательны с пробелами! Они не нужны</strong>
                                <ul>
                                    <li><code>{{id}}</code> - возвращает номер заказа пользователя</li>
                                    <li><code>{{offerName}}</code> - название проекта</li>
                                    <li><code>{{statusID}}</code> - ID статуса заказа</li>
                                    <li><code>{{statusGroup}}</code> - группа статуса, может принимать значения:
                                        <ul>
                                            <li><code>spam</code> - Ошибка/Спам/Дубль</li>
                                            <li><code>return</code> - Возврат</li>
                                            <li><code>canceled</code> - Отменен</li>
                                            <li><code>processing</code> - Обработка</li>
                                            <li><code>accepted</code> - Принят</li>
                                            <li><code>shipped</code> - Отправлен</li>
                                            <li><code>paid</code> - Оплачен</li>
                                        </ul>
                                    </li>
                                    <li><code>{{payment_status}}</code> - статус вознаграждения. <span class="label">-1</span> - отказано, <span class="label">0</span> - в обработке, <span class="label">1</span> - выплачено</li>
                                    <li><code>{{payment_sum}}</code> - сумма вознаграждения за заказ</li>
                                    <li><code>{{datetime}}</code> - дата и время в формате: 2019-05-17 11:22:00</li>
                                    <li><code>{{lastUpdate}}</code> - статус изменен в формате: 2019-05-17 11:22:00</li>
                                    <li><code>{{lastModify}}</code> - последние изменение в формате: 2019-05-17 11:22:00</li>
                                    <li><code>{{approvedAt}}</code> - дата и время апрува в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{shippedAt}}</code> - дата и время отправки в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{canceledAt}}</code> - дата и время отмены в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{buyoutAt}}</code> - дата и время выкупа в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{refundedAt}}</code> - дата и время возврата в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{timezone}}</code> - смещение времени клиента в минутах относительно UTC (чтобы не звонить клиенту ночью)</li>
                                    <li><code>{{price}}</code> - цена товара</li>
                                    <li><code>{{total}}</code> - сумма заказа</li>
                                    <li><code>{{goods}}</code> - данные о товарах в заказе в JSON:
                                        <pre><code>{
  "alias": {
    "goodID": "ID товара_1",
    "name": "Наименование товара_1",
    "quantity": "Количество товара_1",
    "price": "Цена товара_1"
  },
  "alias2": {
    "goodID": "ID товара_2",
    "name": "Наименование товара_2",
    "quantity": "Количество товара_2",
    "price": "Цена товара_2"
  }
  ...
}</code></pre>, где в качестве ключа используется alias-товара</li>
                                    <li><code>{{russianpostTrack}}</code> - номер отправления Почты России</li>
                                    <li><code>{{domain}}</code> - домен, на котором пользователь совершил заказ</li>
                                    <li><code>{{timeSpent}}</code> - количество секунд, затраченных на заказ</li>
                                    <li><code>{{webmasterID}}</code> - ID веб-мастера, от которого пришел заказ</li>
                                    <li><code>{{operatorID}}</code> - ID оператора</li>
                                    <li><code>{{ip}}</code> - IP адрес пользователя</li>
                                    <li><code>{{referer}}</code> - Referer</li>
                                    <li><code>{{utm_source}}</code> - метка utm_source</li>
                                    <li><code>{{utm_medium}}</code> - метка utm_medium</li>
                                    <li><code>{{utm_campaign}}</code> - метка utm_campaign</li>
                                    <li><code>{{utm_content}}</code> - метка utm_content</li>
                                    <li><code>{{utm_term}}</code> - метка utm_term</li>
                                    <li><code>{{fio}}</code> - возвращает значение поля «Ф.И.О». Аналогичным образом можно использовать поля:<code title="Индекс">{{postIndex}}</code> <code title="Регион">{{region}}</code> <code title="Город">{{city}}</code> <code title="Адрес">{{address}}</code> <code title="Телефон">{{phone}}</code> <code title="Кол-во">{{quantity}}</code> <code title="Комментарий">{{comment}}</code> <code title="Liveinform">{{additional1}}</code> <code title="Размер">{{additional2}}</code> <code title="Дожим">{{additional11}}</code> <code title="Масса">{{additional14}}</code> </li>
                                </ul>
                            </div>
                            <textarea id="postback_personal_post" class="span6" rows="4" placeholder="" name="postback.personal.post"></textarea>
                        </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Postback при любом редактировании любого заказа</div>
        <div class="spoiler-body in collapse" id="lv-postblank-orderModify" style="height: auto;">
            <table id="lv-config-table-orderModify" class="table table-bordered table-forms">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Значение</th>
                        <th>Значение по умолчанию</th>
                        <!--th></th-->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <b>Включить postback редактирования заказа (при любом редактировании заказа)</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Postback будет срабатывать только после редактирования заказа" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="postback_orderModify_use_value">
                            <input id="ytpostback_orderModify_use" type="hidden" value="0" name="postback.orderModify.use">
                            <input id="postback_orderModify_use" type="checkbox" value="1" name="postback.orderModify.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Url для отправки postback</b>
                        </td>
                        <td id="postback_orderModify_url_value">
                            <input id="postback_orderModify_url" class="span6" placeholder="" type="text" value="" name="postback.orderModify.url"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Поля для отправки данных через POST-запрос</b>
                        </td>
                        <td id="postback_orderModify_post_value">
                            <div id="postback_order_modify_common_post_notice">
                                Здесь можно сформировать какие данные будут отправляться на указанный url и в каком формате. Например, если указать такие данные
                                <pre>status:{{status}}
name:{{fio}}
track:{{russianpostTrack}}</pre> то на указанный выше url будет отправлен POST, где в качестве ключей будут использованы <code>status</code>,
                                <code>name</code> и <code>track</code>, а в их значении будут переданы соответствующие значения из заказа. <strong>Будьте внимательны с пробелами! Они не нужны</strong>
                                <ul>
                                    <li><code>{{id}}</code> - возвращает номер заказа пользователя</li>
                                    <li><code>{{offerName}}</code> - название проекта</li>
                                    <li><code>{{statusID}}</code> - ID статуса заказа</li>
                                    <li><code>{{statusGroup}}</code> - группа статуса, может принимать значения:
                                        <ul>
                                            <li><code>spam</code> - Ошибка/Спам/Дубль</li>
                                            <li><code>return</code> - Возврат</li>
                                            <li><code>canceled</code> - Отменен</li>
                                            <li><code>processing</code> - Обработка</li>
                                            <li><code>accepted</code> - Принят</li>
                                            <li><code>shipped</code> - Отправлен</li>
                                            <li><code>paid</code> - Оплачен</li>
                                        </ul>
                                    </li>
                                    <li><code>{{payment_status}}</code> - статус вознаграждения. <span class="label">-1</span> - отказано, <span class="label">0</span> - в обработке, <span class="label">1</span> - выплачено</li>
                                    <li><code>{{payment_sum}}</code> - сумма вознаграждения за заказ</li>
                                    <li><code>{{datetime}}</code> - дата и время в формате: 2019-05-17 11:22:00</li>
                                    <li><code>{{lastUpdate}}</code> - статус изменен в формате: 2019-05-17 11:22:00</li>
                                    <li><code>{{lastModify}}</code> - последние изменение в формате: 2019-05-17 11:22:00</li>
                                    <li><code>{{approvedAt}}</code> - дата и время апрува в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{shippedAt}}</code> - дата и время отправки в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{canceledAt}}</code> - дата и время отмены в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{buyoutAt}}</code> - дата и время выкупа в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{refundedAt}}</code> - дата и время возврата в формате: 2019-05-17 11:22:00, либо <code>NULL</code>, если не указана дата</li>
                                    <li><code>{{timezone}}</code> - смещение времени клиента в минутах относительно UTC (чтобы не звонить клиенту ночью)</li>
                                    <li><code>{{price}}</code> - цена товара</li>
                                    <li><code>{{total}}</code> - сумма заказа</li>
                                    <li><code>{{goods}}</code> - данные о товарах в заказе в JSON:
                                        <pre><code>{
  "alias": {
    "goodID": "ID товара_1",
    "name": "Наименование товара_1",
    "quantity": "Количество товара_1",
    "price": "Цена товара_1"
  },
  "alias2": {
    "goodID": "ID товара_2",
    "name": "Наименование товара_2",
    "quantity": "Количество товара_2",
    "price": "Цена товара_2"
  }
  ...
}</code></pre>, где в качестве ключа используется alias-товара</li>
                                    <li><code>{{russianpostTrack}}</code> - номер отправления Почты России</li>
                                    <li><code>{{domain}}</code> - домен, на котором пользователь совершил заказ</li>
                                    <li><code>{{timeSpent}}</code> - количество секунд, затраченных на заказ</li>
                                    <li><code>{{webmasterID}}</code> - ID веб-мастера, от которого пришел заказ</li>
                                    <li><code>{{operatorID}}</code> - ID оператора</li>
                                    <li><code>{{ip}}</code> - IP адрес пользователя</li>
                                    <li><code>{{referer}}</code> - Referer</li>
                                    <li><code>{{utm_source}}</code> - метка utm_source</li>
                                    <li><code>{{utm_medium}}</code> - метка utm_medium</li>
                                    <li><code>{{utm_campaign}}</code> - метка utm_campaign</li>
                                    <li><code>{{utm_content}}</code> - метка utm_content</li>
                                    <li><code>{{utm_term}}</code> - метка utm_term</li>
                                    <li><code>{{recall_time}}</code> - время перезвона в формате <code>ГГГГ-ММ-ДД ЧЧ:ММ:СС</code></li>
                                    <li><code>{{buyout_time}}</code> - время перезвона для «До выкупа» в формате <code>ГГГГ-ММ-ДД ЧЧ:ММ:СС</code></li>
                                    <li><code>{{accept2_time}}</code> - время перезвона для «Повторного подтверждения» в формате <code>ГГГГ-ММ-ДД ЧЧ:ММ:СС</code></li>
                                    <li><code>{{fio}}</code> - возвращает значение поля «Ф.И.О». Аналогичным образом можно использовать поля:<code title="Индекс">{{postIndex}}</code> <code title="Регион">{{region}}</code> <code title="Город">{{city}}</code> <code title="Адрес">{{address}}</code> <code title="Телефон">{{phone}}</code> <code title="Кол-во">{{quantity}}</code> <code title="Комментарий">{{comment}}</code> <code title="Liveinform">{{additional1}}</code> <code title="Размер">{{additional2}}</code> <code title="Дожим">{{additional11}}</code> <code title="Масса">{{additional14}}</code> </li>
                                </ul>
                            </div>
                            <textarea id="postback_orderModify_post" class="span6" rows="4" placeholder="" name="postback.orderModify.post"></textarea>
                        </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" name="yt0" value="Сохранить">
</form>

<script>
</script>
