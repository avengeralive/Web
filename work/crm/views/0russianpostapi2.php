<div id="top">
	<h1>Модуль Онлайн-сервиса «Отправка» (2 аккаунт)
		<i>Модуль Онлайн-сервиса «Отправка» (2 аккаунт)</i>
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
        <div class="spoiler-btn">Онлайн-сервис «Отправка»</div>
        <div class="spoiler-body in collapse" id="lv-postblank-use" style="height: auto;">
            <table id="lv-config-table-use" class="table table-bordered table-forms">
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
                            <b>Использовать модуль API Онлайн-сервиса «Отправка»</b>
                        </td>
                        <td id="russianpostapi_use_value">
                            <input id="ytrussianpostapi_use" type="hidden" value="0" name="russianpostapi.use">
                            <input id="russianpostapi_use" checked="checked" type="checkbox" value="1" name="russianpostapi.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Логин</b>
                        </td>
                        <td id="russianpostapi_use_auth_login_value">
                            <input id="russianpostapi_use_auth_login" class="span6" placeholder="" type="password" value="treydplyus@gmail.com" name="russianpostapi.use.auth.login"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Пароль</b>
                        </td>
                        <td id="russianpostapi_use_auth_pass_value">
                            <input id="russianpostapi_use_auth_pass" class="span6" placeholder="" type="password" value="413439610Dkfp8cpjtPeacedabol1" name="russianpostapi.use.auth.pass"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Токен авторизации</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Можно найти в настройках личного кабинета на сайте почты" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_use_auth_token_value">
                            <input id="russianpostapi_use_auth_token" class="span6" placeholder="" type="password" value="d_5a0ku4ePpiqkIYGpR8a7ADnexscoGC" name="russianpostapi.use.auth.token"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Посылка «Нестандартная»</div>
        <div class="spoiler-body in collapse" id="lv-postblank-postalParcel" style="height: auto;">
            <table id="lv-config-table-postalParcel" class="table table-bordered table-forms">
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
                            <b>Использовать модуль отправлений «Посылка Нестандартная»</b>
                        </td>
                        <td id="russianpostapi_postalParcel_use_value">
                            <input id="ytrussianpostapi_postalParcel_use" type="hidden" value="0" name="russianpostapi.postalParcel.use">
                            <input id="russianpostapi_postalParcel_use" checked="checked" type="checkbox" value="1" name="russianpostapi.postalParcel.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отправитель на посылке/название брэнда</b>
                        </td>
                        <td id="russianpostapi_postalParcel_sender_company_value">
                            <input id="russianpostapi_postalParcel_sender_company" class="span6" placeholder="" type="text" value="ООО &quot;Трейд Плюс&quot;" name="russianpostapi.postalParcel.sender.company"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Код страны</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="По умолчанию установлен код страны Россия: 643" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_postalParcel_sender_country_value">
                            <input id="russianpostapi_postalParcel_sender_country" class="span6" placeholder="" type="text" value="643" name="russianpostapi.postalParcel.sender.country"> </td>
                        <td>643</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места приема</b>
                        </td>
                        <td id="russianpostapi_postalParcel_sender_postOfficeIndex_value">
                            <input id="russianpostapi_postalParcel_sender_postOfficeIndex" class="span6" placeholder="" type="text" value="109440" name="russianpostapi.postalParcel.sender.postOfficeIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpostapi_postalParcel_sender_mailCtg_value">
                            <select id="russianpostapi_postalParcel_sender_mailCtg" name="russianpostapi.postalParcel.sender.mailCtg">
                                <option value="SIMPLE">простое</option>
                                <option value="ORDERED">заказное</option>
                                <option value="ORDINARY">обыкновенное</option>
                                <option value="WITH_DECLARED_VALUE">с объявленной ценностью</option>
                                <option value="WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY" selected="selected">с объявленной ценностью и наложенным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpostapi_postalParcel_to_typeAddress_value">
                            <select id="russianpostapi_postalParcel_to_typeAddress" name="russianpostapi.postalParcel.to.typeAddress">
                                <option value="DEFAULT" selected="selected">Стандартный (улица, дом, квартира)</option>
                                <option value="PO_BOX">Абонентский ящик</option>
                                <option value="DEMAND">до востребования</option>
                            </select>
                        </td>
                        <td>Стандартный (улица, дом, квартира)</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpostapi_postalParcel_system_declaredValueFix_value">
                            <input id="russianpostapi_postalParcel_system_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpostapi.postalParcel.system.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Курьер»</b>
                        </td>
                        <td id="russianpostapi_postalParcel_system_isCourier_value">
                            <input id="ytrussianpostapi_postalParcel_system_isCourier" type="hidden" value="0" name="russianpostapi.postalParcel.system.isCourier">
                            <input id="russianpostapi_postalParcel_system_isCourier" type="checkbox" value="1" name="russianpostapi.postalParcel.system.isCourier"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Осторожно/Хрупкое»</b>
                        </td>
                        <td id="russianpostapi_postalParcel_system_isFragile_value">
                            <input id="ytrussianpostapi_postalParcel_system_isFragile" type="hidden" value="0" name="russianpostapi.postalParcel.system.isFragile">
                            <input id="russianpostapi_postalParcel_system_isFragile" type="checkbox" value="1" name="russianpostapi.postalParcel.system.isFragile"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Возврату не подлежит»</b>
                        </td>
                        <td id="russianpostapi_postalParcel_system_isNoReturn_value">
                            <input id="ytrussianpostapi_postalParcel_system_isNoReturn" type="hidden" value="0" name="russianpostapi.postalParcel.system.isNoReturn">
                            <input id="russianpostapi_postalParcel_system_isNoReturn" checked="checked" type="checkbox" value="1" name="russianpostapi.postalParcel.system.isNoReturn"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата сдачи в почтовое отделение</b>
                        </td>
                        <td id="russianpostapi_postalParcel_system_dateDelivery_value">
                            <select id="russianpostapi_postalParcel_system_dateDelivery" name="russianpostapi.postalParcel.system.dateDelivery">
                                <option value="0">сегодня</option>
                                <option value="1" selected="selected">завтра</option>
                                <option value="2">послезавтра</option>
                                <option value="3">+ 3 дня</option>
                                <option value="4">+ 4 дня</option>
                                <option value="5">+ 5 дня</option>
                                <option value="6">+ 6 дня</option>
                                <option value="7">+ 7 дня</option>
                            </select>
                        </td>
                        <td>сегодня</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С заказным уведомлением»</b>
                        </td>
                        <td id="russianpostapi_postalParcel_notice_isOrderNotice_value">
                            <input id="ytrussianpostapi_postalParcel_notice_isOrderNotice" type="hidden" value="0" name="russianpostapi.postalParcel.notice.isOrderNotice">
                            <input id="russianpostapi_postalParcel_notice_isOrderNotice" type="checkbox" value="1" name="russianpostapi.postalParcel.notice.isOrderNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С простым уведомлением»</b>
                        </td>
                        <td id="russianpostapi_postalParcel_notice_isSimpleNotice_value">
                            <input id="ytrussianpostapi_postalParcel_notice_isSimpleNotice" type="hidden" value="0" name="russianpostapi.postalParcel.notice.isSimpleNotice">
                            <input id="russianpostapi_postalParcel_notice_isSimpleNotice" type="checkbox" value="1" name="russianpostapi.postalParcel.notice.isSimpleNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Признак услуги SMS уведомления</b>
                        </td>
                        <td id="russianpostapi_postalParcel_notice_sms_value">
                            <input id="ytrussianpostapi_postalParcel_notice_sms" type="hidden" value="0" name="russianpostapi.postalParcel.notice.sms">
                            <input id="russianpostapi_postalParcel_notice_sms" type="checkbox" value="1" name="russianpostapi.postalParcel.notice.sms"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_postalParcel_weight_value">
                            <input id="ytrussianpostapi_postalParcel_weight" type="hidden" value="0" name="russianpostapi.postalParcel.weight">
                            <input id="russianpostapi_postalParcel_weight" type="checkbox" value="1" name="russianpostapi.postalParcel.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_postalParcel_weight_custom_value">
                            <select id="russianpostapi_postalParcel_weight_custom" name="russianpostapi.postalParcel.weight.custom">
                                <option value="0">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14" selected="selected">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: высота</b>
                        </td>
                        <td id="russianpostapi_postalParcel_dimension_height_value">
                            <input id="russianpostapi_postalParcel_dimension_height" class="span6" placeholder="" type="text" value="" name="russianpostapi.postalParcel.dimension.height"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: длина</b>
                        </td>
                        <td id="russianpostapi_postalParcel_dimension_length_value">
                            <input id="russianpostapi_postalParcel_dimension_length" class="span6" placeholder="" type="text" value="" name="russianpostapi.postalParcel.dimension.length"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: ширина</b>
                        </td>
                        <td id="russianpostapi_postalParcel_dimension_width_value">
                            <input id="russianpostapi_postalParcel_dimension_width" class="span6" placeholder="" type="text" value="" name="russianpostapi.postalParcel.dimension.width"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Получать тариф в доп. поле</b>
                        </td>
                        <td id="russianpostapi_postalParcel_getTariff_value">
                            <select id="russianpostapi_postalParcel_getTariff" name="russianpostapi.postalParcel.getTariff">
                                <option value="0">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13" selected="selected">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Cтатус, в который переместится заказ после экспорта</b>
                        </td>
                        <td id="russianpostapi_postalParcel_status_exported_value">
                            <select id="russianpostapi_postalParcel_status_exported" name="russianpostapi.postalParcel.status.exported">
                                <option value="-1">Не изменять статус</option>
                                <option value="0">Обработка</option>
                                <option value="49">Подтверждена отправка</option>
                                <option value="41">Подтвержден [2 прозвон]</option>
                                <option value="39">НДЗ-Звонит Робот</option>
                                <option value="51">НДЗ-Робот Дозвон</option>
                                <option value="40">Думает/набрать позже</option>
                                <option value="2">Отменен</option>
                                <option value="8">Дубль</option>
                                <option value="9">Спам/ошибки/Консультация</option>
                                <option value="44">Фрод</option>
                                <option value="50">Жалобы на конкурентов</option>
                                <option value="67">Завести трек</option>
                                <option value="13">Переданы на склад</option>
                                <option value="66">Промежуточный</option>
                                <option value="65">Уехали на почту</option>
                                <option value="14">Отправлен по РФ</option>
                                <option value="15">Пришло на почту сегодня</option>
                                <option value="21">День 1</option>
                                <option value="22">День 2</option>
                                <option value="23">День 3</option>
                                <option value="24">День 4</option>
                                <option value="52">День 4 [Дозвон]</option>
                                <option value="25">День 5</option>
                                <option value="53">День 5 [Дозвон]</option>
                                <option value="42">День 6</option>
                                <option value="54">День 6 [Дозвон]</option>
                                <option value="27">День 7</option>
                                <option value="55">День 7 [Дозвон]</option>
                                <option value="28">День 8</option>
                                <option value="56">День 8 [Дозвон]</option>
                                <option value="29">День 9</option>
                                <option value="57">День 9 [Дозвон]</option>
                                <option value="30">День 10</option>
                                <option value="58">День 10 [Дозвон]</option>
                                <option value="31">День 11</option>
                                <option value="59">День 11 [Дозвон]</option>
                                <option value="32">День 12</option>
                                <option value="60">День 12 [Дозвон]</option>
                                <option value="33">День 13</option>
                                <option value="61">День 13 [Дозвон]</option>
                                <option value="34">День 14</option>
                                <option value="62">День 14 [Дозвон]</option>
                                <option value="35">День 15</option>
                                <option value="63">День 15 [Дозвон]</option>
                                <option value="36">&gt;День 15</option>
                                <option value="64">&gt;День 15 [Дозвон]</option>
                                <option value="7">Возврат</option>
                                <option value="5">Оплачен</option>
                                <option value="6">ОКК</option>
                                <option value="68">Подтверждена отправка {Онлайн}</option>
                                <option value="74">Завести в почту {Онлайн}</option>
                                <option value="72" selected="selected">Распечатать накладные {Нестандартные}</option>
                                <option value="73">Распечатать накладные {Онлайн}</option>
                                <option value="69">Переданы на склад {Онлайн}</option>
                                <option value="70">Уехали на почту {Онлайн}</option>
                                <option value="71">Запасной</option>
                            </select>
                        </td>
                        <td>Не изменять статус</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Посылка «Онлайн»</div>
        <div class="spoiler-body in collapse" id="lv-postblank-onlineParcel" style="height: auto;">
            <table id="lv-config-table-onlineParcel" class="table table-bordered table-forms">
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
                            <b>Использовать модуль отправлений «Посылка Онлайн»</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_use_value">
                            <input id="ytrussianpostapi_onlineParcel_use" type="hidden" value="0" name="russianpostapi.onlineParcel.use">
                            <input id="russianpostapi_onlineParcel_use" checked="checked" type="checkbox" value="1" name="russianpostapi.onlineParcel.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отправитель на посылке/название брэнда</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_sender_company_value">
                            <input id="russianpostapi_onlineParcel_sender_company" class="span6" placeholder="" type="text" value="ООО &quot;Трейд Плюс&quot;" name="russianpostapi.onlineParcel.sender.company"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Код страны</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="По умолчанию установлен код страны Россия: 643" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_onlineParcel_sender_country_value">
                            <input id="russianpostapi_onlineParcel_sender_country" class="span6" placeholder="" type="text" value="643" name="russianpostapi.onlineParcel.sender.country"> </td>
                        <td>643</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места приема</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_sender_postOfficeIndex_value">
                            <input id="russianpostapi_onlineParcel_sender_postOfficeIndex" class="span6" placeholder="" type="text" value="109440" name="russianpostapi.onlineParcel.sender.postOfficeIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_sender_mailCtg_value">
                            <select id="russianpostapi_onlineParcel_sender_mailCtg" name="russianpostapi.onlineParcel.sender.mailCtg">
                                <option value="SIMPLE">простое</option>
                                <option value="ORDERED">заказное</option>
                                <option value="ORDINARY">обыкновенное</option>
                                <option value="WITH_DECLARED_VALUE">с объявленной ценностью</option>
                                <option value="WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY" selected="selected">с объявленной ценностью и наложенным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_to_typeAddress_value">
                            <select id="russianpostapi_onlineParcel_to_typeAddress" name="russianpostapi.onlineParcel.to.typeAddress">
                                <option value="DEFAULT" selected="selected">Стандартный (улица, дом, квартира)</option>
                                <option value="PO_BOX">Абонентский ящик</option>
                                <option value="DEMAND">до востребования</option>
                            </select>
                        </td>
                        <td>Стандартный (улица, дом, квартира)</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_system_declaredValueFix_value">
                            <input id="russianpostapi_onlineParcel_system_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpostapi.onlineParcel.system.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Курьер»</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_system_isCourier_value">
                            <input id="ytrussianpostapi_onlineParcel_system_isCourier" type="hidden" value="0" name="russianpostapi.onlineParcel.system.isCourier">
                            <input id="russianpostapi_onlineParcel_system_isCourier" type="checkbox" value="1" name="russianpostapi.onlineParcel.system.isCourier"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Осторожно/Хрупкое»</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_system_isFragile_value">
                            <input id="ytrussianpostapi_onlineParcel_system_isFragile" type="hidden" value="0" name="russianpostapi.onlineParcel.system.isFragile">
                            <input id="russianpostapi_onlineParcel_system_isFragile" type="checkbox" value="1" name="russianpostapi.onlineParcel.system.isFragile"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Возврату не подлежит»</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_system_isNoReturn_value">
                            <input id="ytrussianpostapi_onlineParcel_system_isNoReturn" type="hidden" value="0" name="russianpostapi.onlineParcel.system.isNoReturn">
                            <input id="russianpostapi_onlineParcel_system_isNoReturn" checked="checked" type="checkbox" value="1" name="russianpostapi.onlineParcel.system.isNoReturn"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата сдачи в почтовое отделение</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_system_dateDelivery_value">
                            <select id="russianpostapi_onlineParcel_system_dateDelivery" name="russianpostapi.onlineParcel.system.dateDelivery">
                                <option value="0">сегодня</option>
                                <option value="1" selected="selected">завтра</option>
                                <option value="2">послезавтра</option>
                                <option value="3">+ 3 дня</option>
                                <option value="4">+ 4 дня</option>
                                <option value="5">+ 5 дня</option>
                                <option value="6">+ 6 дня</option>
                                <option value="7">+ 7 дня</option>
                            </select>
                        </td>
                        <td>сегодня</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С заказным уведомлением»</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_notice_isOrderNotice_value">
                            <input id="ytrussianpostapi_onlineParcel_notice_isOrderNotice" type="hidden" value="0" name="russianpostapi.onlineParcel.notice.isOrderNotice">
                            <input id="russianpostapi_onlineParcel_notice_isOrderNotice" type="checkbox" value="1" name="russianpostapi.onlineParcel.notice.isOrderNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С простым уведомлением»</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_notice_isSimpleNotice_value">
                            <input id="ytrussianpostapi_onlineParcel_notice_isSimpleNotice" type="hidden" value="0" name="russianpostapi.onlineParcel.notice.isSimpleNotice">
                            <input id="russianpostapi_onlineParcel_notice_isSimpleNotice" type="checkbox" value="1" name="russianpostapi.onlineParcel.notice.isSimpleNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Признак услуги SMS уведомления</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_notice_sms_value">
                            <input id="ytrussianpostapi_onlineParcel_notice_sms" type="hidden" value="0" name="russianpostapi.onlineParcel.notice.sms">
                            <input id="russianpostapi_onlineParcel_notice_sms" type="checkbox" value="1" name="russianpostapi.onlineParcel.notice.sms"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_onlineParcel_weight_value">
                            <input id="ytrussianpostapi_onlineParcel_weight" type="hidden" value="0" name="russianpostapi.onlineParcel.weight">
                            <input id="russianpostapi_onlineParcel_weight" type="checkbox" value="1" name="russianpostapi.onlineParcel.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_onlineParcel_weight_custom_value">
                            <select id="russianpostapi_onlineParcel_weight_custom" name="russianpostapi.onlineParcel.weight.custom">
                                <option value="0">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14" selected="selected">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: высота</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_dimension_height_value">
                            <input id="russianpostapi_onlineParcel_dimension_height" class="span6" placeholder="" type="text" value="" name="russianpostapi.onlineParcel.dimension.height"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: длина</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_dimension_length_value">
                            <input id="russianpostapi_onlineParcel_dimension_length" class="span6" placeholder="" type="text" value="" name="russianpostapi.onlineParcel.dimension.length"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: ширина</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_dimension_width_value">
                            <input id="russianpostapi_onlineParcel_dimension_width" class="span6" placeholder="" type="text" value="" name="russianpostapi.onlineParcel.dimension.width"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Получать тариф в доп. поле</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_getTariff_value">
                            <select id="russianpostapi_onlineParcel_getTariff" name="russianpostapi.onlineParcel.getTariff">
                                <option value="0">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13" selected="selected">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Cтатус, в который переместится заказ после экспорта</b>
                        </td>
                        <td id="russianpostapi_onlineParcel_status_exported_value">
                            <select id="russianpostapi_onlineParcel_status_exported" name="russianpostapi.onlineParcel.status.exported">
                                <option value="-1">Не изменять статус</option>
                                <option value="0">Обработка</option>
                                <option value="49">Подтверждена отправка</option>
                                <option value="41">Подтвержден [2 прозвон]</option>
                                <option value="39">НДЗ-Звонит Робот</option>
                                <option value="51">НДЗ-Робот Дозвон</option>
                                <option value="40">Думает/набрать позже</option>
                                <option value="2">Отменен</option>
                                <option value="8">Дубль</option>
                                <option value="9">Спам/ошибки/Консультация</option>
                                <option value="44">Фрод</option>
                                <option value="50">Жалобы на конкурентов</option>
                                <option value="67">Завести трек</option>
                                <option value="13">Переданы на склад</option>
                                <option value="66">Промежуточный</option>
                                <option value="65">Уехали на почту</option>
                                <option value="14">Отправлен по РФ</option>
                                <option value="15">Пришло на почту сегодня</option>
                                <option value="21">День 1</option>
                                <option value="22">День 2</option>
                                <option value="23">День 3</option>
                                <option value="24">День 4</option>
                                <option value="52">День 4 [Дозвон]</option>
                                <option value="25">День 5</option>
                                <option value="53">День 5 [Дозвон]</option>
                                <option value="42">День 6</option>
                                <option value="54">День 6 [Дозвон]</option>
                                <option value="27">День 7</option>
                                <option value="55">День 7 [Дозвон]</option>
                                <option value="28">День 8</option>
                                <option value="56">День 8 [Дозвон]</option>
                                <option value="29">День 9</option>
                                <option value="57">День 9 [Дозвон]</option>
                                <option value="30">День 10</option>
                                <option value="58">День 10 [Дозвон]</option>
                                <option value="31">День 11</option>
                                <option value="59">День 11 [Дозвон]</option>
                                <option value="32">День 12</option>
                                <option value="60">День 12 [Дозвон]</option>
                                <option value="33">День 13</option>
                                <option value="61">День 13 [Дозвон]</option>
                                <option value="34">День 14</option>
                                <option value="62">День 14 [Дозвон]</option>
                                <option value="35">День 15</option>
                                <option value="63">День 15 [Дозвон]</option>
                                <option value="36">&gt;День 15</option>
                                <option value="64">&gt;День 15 [Дозвон]</option>
                                <option value="7">Возврат</option>
                                <option value="5">Оплачен</option>
                                <option value="6">ОКК</option>
                                <option value="68">Подтверждена отправка {Онлайн}</option>
                                <option value="74">Завести в почту {Онлайн}</option>
                                <option value="72">Распечатать накладные {Нестандартные}</option>
                                <option value="73" selected="selected">Распечатать накладные {Онлайн}</option>
                                <option value="69">Переданы на склад {Онлайн}</option>
                                <option value="70">Уехали на почту {Онлайн}</option>
                                <option value="71">Запасной</option>
                            </select>
                        </td>
                        <td>Не изменять статус</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Посылка 1-го класса</div>
        <div class="spoiler-body in collapse" id="lv-postblank-parcelClass1" style="height: auto;">
            <table id="lv-config-table-parcelClass1" class="table table-bordered table-forms">
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
                            <b>Использовать модуль отправлений «Посылка 1-го класса»</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_use_value">
                            <input id="ytrussianpostapi_parcelClass1_use" type="hidden" value="0" name="russianpostapi.parcelClass1.use">
                            <input id="russianpostapi_parcelClass1_use" type="checkbox" value="1" name="russianpostapi.parcelClass1.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отправитель на посылке/название брэнда</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_sender_company_value">
                            <input id="russianpostapi_parcelClass1_sender_company" class="span6" placeholder="" type="text" value="" name="russianpostapi.parcelClass1.sender.company"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Код страны</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="По умолчанию установлен код страны Россия: 643" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_parcelClass1_sender_country_value">
                            <input id="russianpostapi_parcelClass1_sender_country" class="span6" placeholder="" type="text" value="643" name="russianpostapi.parcelClass1.sender.country"> </td>
                        <td>643</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места приема</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_sender_postOfficeIndex_value">
                            <input id="russianpostapi_parcelClass1_sender_postOfficeIndex" class="span6" placeholder="" type="text" value="" name="russianpostapi.parcelClass1.sender.postOfficeIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_sender_mailCtg_value">
                            <select id="russianpostapi_parcelClass1_sender_mailCtg" name="russianpostapi.parcelClass1.sender.mailCtg">
                                <option value="SIMPLE">простое</option>
                                <option value="ORDERED">заказное</option>
                                <option value="ORDINARY" selected="selected">обыкновенное</option>
                                <option value="WITH_DECLARED_VALUE">с объявленной ценностью</option>
                                <option value="WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY">с объявленной ценностью и наложенным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_to_typeAddress_value">
                            <select id="russianpostapi_parcelClass1_to_typeAddress" name="russianpostapi.parcelClass1.to.typeAddress">
                                <option value="DEFAULT" selected="selected">Стандартный (улица, дом, квартира)</option>
                                <option value="PO_BOX">Абонентский ящик</option>
                                <option value="DEMAND">до востребования</option>
                            </select>
                        </td>
                        <td>Стандартный (улица, дом, квартира)</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_system_declaredValueFix_value">
                            <input id="russianpostapi_parcelClass1_system_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpostapi.parcelClass1.system.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Курьер»</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_system_isCourier_value">
                            <input id="ytrussianpostapi_parcelClass1_system_isCourier" type="hidden" value="0" name="russianpostapi.parcelClass1.system.isCourier">
                            <input id="russianpostapi_parcelClass1_system_isCourier" type="checkbox" value="1" name="russianpostapi.parcelClass1.system.isCourier"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Осторожно/Хрупкое»</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_system_isFragile_value">
                            <input id="ytrussianpostapi_parcelClass1_system_isFragile" type="hidden" value="0" name="russianpostapi.parcelClass1.system.isFragile">
                            <input id="russianpostapi_parcelClass1_system_isFragile" type="checkbox" value="1" name="russianpostapi.parcelClass1.system.isFragile"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Возврату не подлежит»</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_system_isNoReturn_value">
                            <input id="ytrussianpostapi_parcelClass1_system_isNoReturn" type="hidden" value="0" name="russianpostapi.parcelClass1.system.isNoReturn">
                            <input id="russianpostapi_parcelClass1_system_isNoReturn" type="checkbox" value="1" name="russianpostapi.parcelClass1.system.isNoReturn"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата сдачи в почтовое отделение</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_system_dateDelivery_value">
                            <select id="russianpostapi_parcelClass1_system_dateDelivery" name="russianpostapi.parcelClass1.system.dateDelivery">
                                <option value="0" selected="selected">сегодня</option>
                                <option value="1">завтра</option>
                                <option value="2">послезавтра</option>
                                <option value="3">+ 3 дня</option>
                                <option value="4">+ 4 дня</option>
                                <option value="5">+ 5 дня</option>
                                <option value="6">+ 6 дня</option>
                                <option value="7">+ 7 дня</option>
                            </select>
                        </td>
                        <td>сегодня</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С заказным уведомлением»</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_notice_isOrderNotice_value">
                            <input id="ytrussianpostapi_parcelClass1_notice_isOrderNotice" type="hidden" value="0" name="russianpostapi.parcelClass1.notice.isOrderNotice">
                            <input id="russianpostapi_parcelClass1_notice_isOrderNotice" type="checkbox" value="1" name="russianpostapi.parcelClass1.notice.isOrderNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С простым уведомлением»</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_notice_isSimpleNotice_value">
                            <input id="ytrussianpostapi_parcelClass1_notice_isSimpleNotice" type="hidden" value="0" name="russianpostapi.parcelClass1.notice.isSimpleNotice">
                            <input id="russianpostapi_parcelClass1_notice_isSimpleNotice" type="checkbox" value="1" name="russianpostapi.parcelClass1.notice.isSimpleNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Признак услуги SMS уведомления</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_notice_sms_value">
                            <input id="ytrussianpostapi_parcelClass1_notice_sms" type="hidden" value="0" name="russianpostapi.parcelClass1.notice.sms">
                            <input id="russianpostapi_parcelClass1_notice_sms" type="checkbox" value="1" name="russianpostapi.parcelClass1.notice.sms"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_parcelClass1_weight_value">
                            <input id="ytrussianpostapi_parcelClass1_weight" type="hidden" value="0" name="russianpostapi.parcelClass1.weight">
                            <input id="russianpostapi_parcelClass1_weight" type="checkbox" value="1" name="russianpostapi.parcelClass1.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_parcelClass1_weight_custom_value">
                            <select id="russianpostapi_parcelClass1_weight_custom" name="russianpostapi.parcelClass1.weight.custom">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: высота</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_dimension_height_value">
                            <input id="russianpostapi_parcelClass1_dimension_height" class="span6" placeholder="" type="text" value="" name="russianpostapi.parcelClass1.dimension.height"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: длина</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_dimension_length_value">
                            <input id="russianpostapi_parcelClass1_dimension_length" class="span6" placeholder="" type="text" value="" name="russianpostapi.parcelClass1.dimension.length"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: ширина</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_dimension_width_value">
                            <input id="russianpostapi_parcelClass1_dimension_width" class="span6" placeholder="" type="text" value="" name="russianpostapi.parcelClass1.dimension.width"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Получать тариф в доп. поле</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_getTariff_value">
                            <select id="russianpostapi_parcelClass1_getTariff" name="russianpostapi.parcelClass1.getTariff">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Cтатус, в который переместится заказ после экспорта</b>
                        </td>
                        <td id="russianpostapi_parcelClass1_status_exported_value">
                            <select id="russianpostapi_parcelClass1_status_exported" name="russianpostapi.parcelClass1.status.exported">
                                <option value="-1" selected="selected">Не изменять статус</option>
                                <option value="0">Обработка</option>
                                <option value="49">Подтверждена отправка</option>
                                <option value="41">Подтвержден [2 прозвон]</option>
                                <option value="39">НДЗ-Звонит Робот</option>
                                <option value="51">НДЗ-Робот Дозвон</option>
                                <option value="40">Думает/набрать позже</option>
                                <option value="2">Отменен</option>
                                <option value="8">Дубль</option>
                                <option value="9">Спам/ошибки/Консультация</option>
                                <option value="44">Фрод</option>
                                <option value="50">Жалобы на конкурентов</option>
                                <option value="67">Завести трек</option>
                                <option value="13">Переданы на склад</option>
                                <option value="66">Промежуточный</option>
                                <option value="65">Уехали на почту</option>
                                <option value="14">Отправлен по РФ</option>
                                <option value="15">Пришло на почту сегодня</option>
                                <option value="21">День 1</option>
                                <option value="22">День 2</option>
                                <option value="23">День 3</option>
                                <option value="24">День 4</option>
                                <option value="52">День 4 [Дозвон]</option>
                                <option value="25">День 5</option>
                                <option value="53">День 5 [Дозвон]</option>
                                <option value="42">День 6</option>
                                <option value="54">День 6 [Дозвон]</option>
                                <option value="27">День 7</option>
                                <option value="55">День 7 [Дозвон]</option>
                                <option value="28">День 8</option>
                                <option value="56">День 8 [Дозвон]</option>
                                <option value="29">День 9</option>
                                <option value="57">День 9 [Дозвон]</option>
                                <option value="30">День 10</option>
                                <option value="58">День 10 [Дозвон]</option>
                                <option value="31">День 11</option>
                                <option value="59">День 11 [Дозвон]</option>
                                <option value="32">День 12</option>
                                <option value="60">День 12 [Дозвон]</option>
                                <option value="33">День 13</option>
                                <option value="61">День 13 [Дозвон]</option>
                                <option value="34">День 14</option>
                                <option value="62">День 14 [Дозвон]</option>
                                <option value="35">День 15</option>
                                <option value="63">День 15 [Дозвон]</option>
                                <option value="36">&gt;День 15</option>
                                <option value="64">&gt;День 15 [Дозвон]</option>
                                <option value="7">Возврат</option>
                                <option value="5">Оплачен</option>
                                <option value="6">ОКК</option>
                                <option value="68">Подтверждена отправка {Онлайн}</option>
                                <option value="74">Завести в почту {Онлайн}</option>
                                <option value="72">Распечатать накладные {Нестандартные}</option>
                                <option value="73">Распечатать накладные {Онлайн}</option>
                                <option value="69">Переданы на склад {Онлайн}</option>
                                <option value="70">Уехали на почту {Онлайн}</option>
                                <option value="71">Запасной</option>
                            </select>
                        </td>
                        <td>Не изменять статус</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Бандероль</div>
        <div class="spoiler-body in collapse" id="lv-postblank-banderol" style="height: auto;">
            <table id="lv-config-table-banderol" class="table table-bordered table-forms">
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
                            <b>Использовать модуль отправлений «Бандероль»</b>
                        </td>
                        <td id="russianpostapi_banderol_use_value">
                            <input id="ytrussianpostapi_banderol_use" type="hidden" value="0" name="russianpostapi.banderol.use">
                            <input id="russianpostapi_banderol_use" type="checkbox" value="1" name="russianpostapi.banderol.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отправитель на посылке/название брэнда</b>
                        </td>
                        <td id="russianpostapi_banderol_sender_company_value">
                            <input id="russianpostapi_banderol_sender_company" class="span6" placeholder="" type="text" value="" name="russianpostapi.banderol.sender.company"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Код страны</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="По умолчанию установлен код страны Россия: 643" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_banderol_sender_country_value">
                            <input id="russianpostapi_banderol_sender_country" class="span6" placeholder="" type="text" value="643" name="russianpostapi.banderol.sender.country"> </td>
                        <td>643</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места приема</b>
                        </td>
                        <td id="russianpostapi_banderol_sender_postOfficeIndex_value">
                            <input id="russianpostapi_banderol_sender_postOfficeIndex" class="span6" placeholder="" type="text" value="" name="russianpostapi.banderol.sender.postOfficeIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpostapi_banderol_sender_mailCtg_value">
                            <select id="russianpostapi_banderol_sender_mailCtg" name="russianpostapi.banderol.sender.mailCtg">
                                <option value="SIMPLE">простое</option>
                                <option value="ORDERED">заказное</option>
                                <option value="ORDINARY" selected="selected">обыкновенное</option>
                                <option value="WITH_DECLARED_VALUE">с объявленной ценностью</option>
                                <option value="WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY">с объявленной ценностью и наложенным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpostapi_banderol_to_typeAddress_value">
                            <select id="russianpostapi_banderol_to_typeAddress" name="russianpostapi.banderol.to.typeAddress">
                                <option value="DEFAULT" selected="selected">Стандартный (улица, дом, квартира)</option>
                                <option value="PO_BOX">Абонентский ящик</option>
                                <option value="DEMAND">до востребования</option>
                            </select>
                        </td>
                        <td>Стандартный (улица, дом, квартира)</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpostapi_banderol_system_declaredValueFix_value">
                            <input id="russianpostapi_banderol_system_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpostapi.banderol.system.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Курьер»</b>
                        </td>
                        <td id="russianpostapi_banderol_system_isCourier_value">
                            <input id="ytrussianpostapi_banderol_system_isCourier" type="hidden" value="0" name="russianpostapi.banderol.system.isCourier">
                            <input id="russianpostapi_banderol_system_isCourier" type="checkbox" value="1" name="russianpostapi.banderol.system.isCourier"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Осторожно/Хрупкое»</b>
                        </td>
                        <td id="russianpostapi_banderol_system_isFragile_value">
                            <input id="ytrussianpostapi_banderol_system_isFragile" type="hidden" value="0" name="russianpostapi.banderol.system.isFragile">
                            <input id="russianpostapi_banderol_system_isFragile" type="checkbox" value="1" name="russianpostapi.banderol.system.isFragile"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Возврату не подлежит»</b>
                        </td>
                        <td id="russianpostapi_banderol_system_isNoReturn_value">
                            <input id="ytrussianpostapi_banderol_system_isNoReturn" type="hidden" value="0" name="russianpostapi.banderol.system.isNoReturn">
                            <input id="russianpostapi_banderol_system_isNoReturn" type="checkbox" value="1" name="russianpostapi.banderol.system.isNoReturn"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата сдачи в почтовое отделение</b>
                        </td>
                        <td id="russianpostapi_banderol_system_dateDelivery_value">
                            <select id="russianpostapi_banderol_system_dateDelivery" name="russianpostapi.banderol.system.dateDelivery">
                                <option value="0" selected="selected">сегодня</option>
                                <option value="1">завтра</option>
                                <option value="2">послезавтра</option>
                                <option value="3">+ 3 дня</option>
                                <option value="4">+ 4 дня</option>
                                <option value="5">+ 5 дня</option>
                                <option value="6">+ 6 дня</option>
                                <option value="7">+ 7 дня</option>
                            </select>
                        </td>
                        <td>сегодня</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С заказным уведомлением»</b>
                        </td>
                        <td id="russianpostapi_banderol_notice_isOrderNotice_value">
                            <input id="ytrussianpostapi_banderol_notice_isOrderNotice" type="hidden" value="0" name="russianpostapi.banderol.notice.isOrderNotice">
                            <input id="russianpostapi_banderol_notice_isOrderNotice" type="checkbox" value="1" name="russianpostapi.banderol.notice.isOrderNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С простым уведомлением»</b>
                        </td>
                        <td id="russianpostapi_banderol_notice_isSimpleNotice_value">
                            <input id="ytrussianpostapi_banderol_notice_isSimpleNotice" type="hidden" value="0" name="russianpostapi.banderol.notice.isSimpleNotice">
                            <input id="russianpostapi_banderol_notice_isSimpleNotice" type="checkbox" value="1" name="russianpostapi.banderol.notice.isSimpleNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Признак услуги SMS уведомления</b>
                        </td>
                        <td id="russianpostapi_banderol_notice_sms_value">
                            <input id="ytrussianpostapi_banderol_notice_sms" type="hidden" value="0" name="russianpostapi.banderol.notice.sms">
                            <input id="russianpostapi_banderol_notice_sms" type="checkbox" value="1" name="russianpostapi.banderol.notice.sms"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_banderol_weight_value">
                            <input id="ytrussianpostapi_banderol_weight" type="hidden" value="0" name="russianpostapi.banderol.weight">
                            <input id="russianpostapi_banderol_weight" type="checkbox" value="1" name="russianpostapi.banderol.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_banderol_weight_custom_value">
                            <select id="russianpostapi_banderol_weight_custom" name="russianpostapi.banderol.weight.custom">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: высота</b>
                        </td>
                        <td id="russianpostapi_banderol_dimension_height_value">
                            <input id="russianpostapi_banderol_dimension_height" class="span6" placeholder="" type="text" value="" name="russianpostapi.banderol.dimension.height"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: длина</b>
                        </td>
                        <td id="russianpostapi_banderol_dimension_length_value">
                            <input id="russianpostapi_banderol_dimension_length" class="span6" placeholder="" type="text" value="" name="russianpostapi.banderol.dimension.length"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: ширина</b>
                        </td>
                        <td id="russianpostapi_banderol_dimension_width_value">
                            <input id="russianpostapi_banderol_dimension_width" class="span6" placeholder="" type="text" value="" name="russianpostapi.banderol.dimension.width"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Получать тариф в доп. поле</b>
                        </td>
                        <td id="russianpostapi_banderol_getTariff_value">
                            <select id="russianpostapi_banderol_getTariff" name="russianpostapi.banderol.getTariff">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Cтатус, в который переместится заказ после экспорта</b>
                        </td>
                        <td id="russianpostapi_banderol_status_exported_value">
                            <select id="russianpostapi_banderol_status_exported" name="russianpostapi.banderol.status.exported">
                                <option value="-1" selected="selected">Не изменять статус</option>
                                <option value="0">Обработка</option>
                                <option value="49">Подтверждена отправка</option>
                                <option value="41">Подтвержден [2 прозвон]</option>
                                <option value="39">НДЗ-Звонит Робот</option>
                                <option value="51">НДЗ-Робот Дозвон</option>
                                <option value="40">Думает/набрать позже</option>
                                <option value="2">Отменен</option>
                                <option value="8">Дубль</option>
                                <option value="9">Спам/ошибки/Консультация</option>
                                <option value="44">Фрод</option>
                                <option value="50">Жалобы на конкурентов</option>
                                <option value="67">Завести трек</option>
                                <option value="13">Переданы на склад</option>
                                <option value="66">Промежуточный</option>
                                <option value="65">Уехали на почту</option>
                                <option value="14">Отправлен по РФ</option>
                                <option value="15">Пришло на почту сегодня</option>
                                <option value="21">День 1</option>
                                <option value="22">День 2</option>
                                <option value="23">День 3</option>
                                <option value="24">День 4</option>
                                <option value="52">День 4 [Дозвон]</option>
                                <option value="25">День 5</option>
                                <option value="53">День 5 [Дозвон]</option>
                                <option value="42">День 6</option>
                                <option value="54">День 6 [Дозвон]</option>
                                <option value="27">День 7</option>
                                <option value="55">День 7 [Дозвон]</option>
                                <option value="28">День 8</option>
                                <option value="56">День 8 [Дозвон]</option>
                                <option value="29">День 9</option>
                                <option value="57">День 9 [Дозвон]</option>
                                <option value="30">День 10</option>
                                <option value="58">День 10 [Дозвон]</option>
                                <option value="31">День 11</option>
                                <option value="59">День 11 [Дозвон]</option>
                                <option value="32">День 12</option>
                                <option value="60">День 12 [Дозвон]</option>
                                <option value="33">День 13</option>
                                <option value="61">День 13 [Дозвон]</option>
                                <option value="34">День 14</option>
                                <option value="62">День 14 [Дозвон]</option>
                                <option value="35">День 15</option>
                                <option value="63">День 15 [Дозвон]</option>
                                <option value="36">&gt;День 15</option>
                                <option value="64">&gt;День 15 [Дозвон]</option>
                                <option value="7">Возврат</option>
                                <option value="5">Оплачен</option>
                                <option value="6">ОКК</option>
                                <option value="68">Подтверждена отправка {Онлайн}</option>
                                <option value="74">Завести в почту {Онлайн}</option>
                                <option value="72">Распечатать накладные {Нестандартные}</option>
                                <option value="73">Распечатать накладные {Онлайн}</option>
                                <option value="69">Переданы на склад {Онлайн}</option>
                                <option value="70">Уехали на почту {Онлайн}</option>
                                <option value="71">Запасной</option>
                            </select>
                        </td>
                        <td>Не изменять статус</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">EMS</div>
        <div class="spoiler-body in collapse" id="lv-postblank-ems" style="height: auto;">
            <table id="lv-config-table-ems" class="table table-bordered table-forms">
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
                            <b>Использовать модуль отправлений «EMS»</b>
                        </td>
                        <td id="russianpostapi_ems_use_value">
                            <input id="ytrussianpostapi_ems_use" type="hidden" value="0" name="russianpostapi.ems.use">
                            <input id="russianpostapi_ems_use" type="checkbox" value="1" name="russianpostapi.ems.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отправитель на посылке/название брэнда</b>
                        </td>
                        <td id="russianpostapi_ems_sender_company_value">
                            <input id="russianpostapi_ems_sender_company" class="span6" placeholder="" type="text" value="" name="russianpostapi.ems.sender.company"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Код страны</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="По умолчанию установлен код страны Россия: 643" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_ems_sender_country_value">
                            <input id="russianpostapi_ems_sender_country" class="span6" placeholder="" type="text" value="643" name="russianpostapi.ems.sender.country"> </td>
                        <td>643</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места приема</b>
                        </td>
                        <td id="russianpostapi_ems_sender_postOfficeIndex_value">
                            <input id="russianpostapi_ems_sender_postOfficeIndex" class="span6" placeholder="" type="text" value="" name="russianpostapi.ems.sender.postOfficeIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpostapi_ems_sender_mailCtg_value">
                            <select id="russianpostapi_ems_sender_mailCtg" name="russianpostapi.ems.sender.mailCtg">
                                <option value="SIMPLE">простое</option>
                                <option value="ORDERED">заказное</option>
                                <option value="ORDINARY" selected="selected">обыкновенное</option>
                                <option value="WITH_DECLARED_VALUE">с объявленной ценностью</option>
                                <option value="WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY">с объявленной ценностью и наложенным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpostapi_ems_to_typeAddress_value">
                            <select id="russianpostapi_ems_to_typeAddress" name="russianpostapi.ems.to.typeAddress">
                                <option value="DEFAULT" selected="selected">Стандартный (улица, дом, квартира)</option>
                                <option value="PO_BOX">Абонентский ящик</option>
                                <option value="DEMAND">до востребования</option>
                            </select>
                        </td>
                        <td>Стандартный (улица, дом, квартира)</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpostapi_ems_system_declaredValueFix_value">
                            <input id="russianpostapi_ems_system_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpostapi.ems.system.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Курьер»</b>
                        </td>
                        <td id="russianpostapi_ems_system_isCourier_value">
                            <input id="ytrussianpostapi_ems_system_isCourier" type="hidden" value="0" name="russianpostapi.ems.system.isCourier">
                            <input id="russianpostapi_ems_system_isCourier" type="checkbox" value="1" name="russianpostapi.ems.system.isCourier"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Осторожно/Хрупкое»</b>
                        </td>
                        <td id="russianpostapi_ems_system_isFragile_value">
                            <input id="ytrussianpostapi_ems_system_isFragile" type="hidden" value="0" name="russianpostapi.ems.system.isFragile">
                            <input id="russianpostapi_ems_system_isFragile" type="checkbox" value="1" name="russianpostapi.ems.system.isFragile"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Возврату не подлежит»</b>
                        </td>
                        <td id="russianpostapi_ems_system_isNoReturn_value">
                            <input id="ytrussianpostapi_ems_system_isNoReturn" type="hidden" value="0" name="russianpostapi.ems.system.isNoReturn">
                            <input id="russianpostapi_ems_system_isNoReturn" type="checkbox" value="1" name="russianpostapi.ems.system.isNoReturn"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата сдачи в почтовое отделение</b>
                        </td>
                        <td id="russianpostapi_ems_system_dateDelivery_value">
                            <select id="russianpostapi_ems_system_dateDelivery" name="russianpostapi.ems.system.dateDelivery">
                                <option value="0" selected="selected">сегодня</option>
                                <option value="1">завтра</option>
                                <option value="2">послезавтра</option>
                                <option value="3">+ 3 дня</option>
                                <option value="4">+ 4 дня</option>
                                <option value="5">+ 5 дня</option>
                                <option value="6">+ 6 дня</option>
                                <option value="7">+ 7 дня</option>
                            </select>
                        </td>
                        <td>сегодня</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С заказным уведомлением»</b>
                        </td>
                        <td id="russianpostapi_ems_notice_isOrderNotice_value">
                            <input id="ytrussianpostapi_ems_notice_isOrderNotice" type="hidden" value="0" name="russianpostapi.ems.notice.isOrderNotice">
                            <input id="russianpostapi_ems_notice_isOrderNotice" type="checkbox" value="1" name="russianpostapi.ems.notice.isOrderNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С простым уведомлением»</b>
                        </td>
                        <td id="russianpostapi_ems_notice_isSimpleNotice_value">
                            <input id="ytrussianpostapi_ems_notice_isSimpleNotice" type="hidden" value="0" name="russianpostapi.ems.notice.isSimpleNotice">
                            <input id="russianpostapi_ems_notice_isSimpleNotice" type="checkbox" value="1" name="russianpostapi.ems.notice.isSimpleNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Признак услуги SMS уведомления</b>
                        </td>
                        <td id="russianpostapi_ems_notice_sms_value">
                            <input id="ytrussianpostapi_ems_notice_sms" type="hidden" value="0" name="russianpostapi.ems.notice.sms">
                            <input id="russianpostapi_ems_notice_sms" type="checkbox" value="1" name="russianpostapi.ems.notice.sms"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_ems_weight_value">
                            <input id="ytrussianpostapi_ems_weight" type="hidden" value="0" name="russianpostapi.ems.weight">
                            <input id="russianpostapi_ems_weight" type="checkbox" value="1" name="russianpostapi.ems.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_ems_weight_custom_value">
                            <select id="russianpostapi_ems_weight_custom" name="russianpostapi.ems.weight.custom">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: высота</b>
                        </td>
                        <td id="russianpostapi_ems_dimension_height_value">
                            <input id="russianpostapi_ems_dimension_height" class="span6" placeholder="" type="text" value="" name="russianpostapi.ems.dimension.height"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: длина</b>
                        </td>
                        <td id="russianpostapi_ems_dimension_length_value">
                            <input id="russianpostapi_ems_dimension_length" class="span6" placeholder="" type="text" value="" name="russianpostapi.ems.dimension.length"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: ширина</b>
                        </td>
                        <td id="russianpostapi_ems_dimension_width_value">
                            <input id="russianpostapi_ems_dimension_width" class="span6" placeholder="" type="text" value="" name="russianpostapi.ems.dimension.width"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Получать тариф в доп. поле</b>
                        </td>
                        <td id="russianpostapi_ems_getTariff_value">
                            <select id="russianpostapi_ems_getTariff" name="russianpostapi.ems.getTariff">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Cтатус, в который переместится заказ после экспорта</b>
                        </td>
                        <td id="russianpostapi_ems_status_exported_value">
                            <select id="russianpostapi_ems_status_exported" name="russianpostapi.ems.status.exported">
                                <option value="-1" selected="selected">Не изменять статус</option>
                                <option value="0">Обработка</option>
                                <option value="49">Подтверждена отправка</option>
                                <option value="41">Подтвержден [2 прозвон]</option>
                                <option value="39">НДЗ-Звонит Робот</option>
                                <option value="51">НДЗ-Робот Дозвон</option>
                                <option value="40">Думает/набрать позже</option>
                                <option value="2">Отменен</option>
                                <option value="8">Дубль</option>
                                <option value="9">Спам/ошибки/Консультация</option>
                                <option value="44">Фрод</option>
                                <option value="50">Жалобы на конкурентов</option>
                                <option value="67">Завести трек</option>
                                <option value="13">Переданы на склад</option>
                                <option value="66">Промежуточный</option>
                                <option value="65">Уехали на почту</option>
                                <option value="14">Отправлен по РФ</option>
                                <option value="15">Пришло на почту сегодня</option>
                                <option value="21">День 1</option>
                                <option value="22">День 2</option>
                                <option value="23">День 3</option>
                                <option value="24">День 4</option>
                                <option value="52">День 4 [Дозвон]</option>
                                <option value="25">День 5</option>
                                <option value="53">День 5 [Дозвон]</option>
                                <option value="42">День 6</option>
                                <option value="54">День 6 [Дозвон]</option>
                                <option value="27">День 7</option>
                                <option value="55">День 7 [Дозвон]</option>
                                <option value="28">День 8</option>
                                <option value="56">День 8 [Дозвон]</option>
                                <option value="29">День 9</option>
                                <option value="57">День 9 [Дозвон]</option>
                                <option value="30">День 10</option>
                                <option value="58">День 10 [Дозвон]</option>
                                <option value="31">День 11</option>
                                <option value="59">День 11 [Дозвон]</option>
                                <option value="32">День 12</option>
                                <option value="60">День 12 [Дозвон]</option>
                                <option value="33">День 13</option>
                                <option value="61">День 13 [Дозвон]</option>
                                <option value="34">День 14</option>
                                <option value="62">День 14 [Дозвон]</option>
                                <option value="35">День 15</option>
                                <option value="63">День 15 [Дозвон]</option>
                                <option value="36">&gt;День 15</option>
                                <option value="64">&gt;День 15 [Дозвон]</option>
                                <option value="7">Возврат</option>
                                <option value="5">Оплачен</option>
                                <option value="6">ОКК</option>
                                <option value="68">Подтверждена отправка {Онлайн}</option>
                                <option value="74">Завести в почту {Онлайн}</option>
                                <option value="72">Распечатать накладные {Нестандартные}</option>
                                <option value="73">Распечатать накладные {Онлайн}</option>
                                <option value="69">Переданы на склад {Онлайн}</option>
                                <option value="70">Уехали на почту {Онлайн}</option>
                                <option value="71">Запасной</option>
                            </select>
                        </td>
                        <td>Не изменять статус</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">EMS Optimal</div>
        <div class="spoiler-body in collapse" id="lv-postblank-emsOptimal" style="height: auto;">
            <table id="lv-config-table-emsOptimal" class="table table-bordered table-forms">
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
                            <b>Использовать модуль отправлений «EMS OPTIMAL»</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_use_value">
                            <input id="ytrussianpostapi_emsOptimal_use" type="hidden" value="0" name="russianpostapi.emsOptimal.use">
                            <input id="russianpostapi_emsOptimal_use" type="checkbox" value="1" name="russianpostapi.emsOptimal.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отправитель на посылке/название брэнда</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_sender_company_value">
                            <input id="russianpostapi_emsOptimal_sender_company" class="span6" placeholder="" type="text" value="" name="russianpostapi.emsOptimal.sender.company"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Код страны</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="По умолчанию установлен код страны Россия: 643" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_emsOptimal_sender_country_value">
                            <input id="russianpostapi_emsOptimal_sender_country" class="span6" placeholder="" type="text" value="643" name="russianpostapi.emsOptimal.sender.country"> </td>
                        <td>643</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места приема</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_sender_postOfficeIndex_value">
                            <input id="russianpostapi_emsOptimal_sender_postOfficeIndex" class="span6" placeholder="" type="text" value="" name="russianpostapi.emsOptimal.sender.postOfficeIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_sender_mailCtg_value">
                            <select id="russianpostapi_emsOptimal_sender_mailCtg" name="russianpostapi.emsOptimal.sender.mailCtg">
                                <option value="SIMPLE">простое</option>
                                <option value="ORDERED">заказное</option>
                                <option value="ORDINARY" selected="selected">обыкновенное</option>
                                <option value="WITH_DECLARED_VALUE">с объявленной ценностью</option>
                                <option value="WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY">с объявленной ценностью и наложенным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_to_typeAddress_value">
                            <select id="russianpostapi_emsOptimal_to_typeAddress" name="russianpostapi.emsOptimal.to.typeAddress">
                                <option value="DEFAULT" selected="selected">Стандартный (улица, дом, квартира)</option>
                                <option value="PO_BOX">Абонентский ящик</option>
                                <option value="DEMAND">до востребования</option>
                            </select>
                        </td>
                        <td>Стандартный (улица, дом, квартира)</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_system_declaredValueFix_value">
                            <input id="russianpostapi_emsOptimal_system_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpostapi.emsOptimal.system.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Курьер»</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_system_isCourier_value">
                            <input id="ytrussianpostapi_emsOptimal_system_isCourier" type="hidden" value="0" name="russianpostapi.emsOptimal.system.isCourier">
                            <input id="russianpostapi_emsOptimal_system_isCourier" type="checkbox" value="1" name="russianpostapi.emsOptimal.system.isCourier"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Осторожно/Хрупкое»</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_system_isFragile_value">
                            <input id="ytrussianpostapi_emsOptimal_system_isFragile" type="hidden" value="0" name="russianpostapi.emsOptimal.system.isFragile">
                            <input id="russianpostapi_emsOptimal_system_isFragile" type="checkbox" value="1" name="russianpostapi.emsOptimal.system.isFragile"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Возврату не подлежит»</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_system_isNoReturn_value">
                            <input id="ytrussianpostapi_emsOptimal_system_isNoReturn" type="hidden" value="0" name="russianpostapi.emsOptimal.system.isNoReturn">
                            <input id="russianpostapi_emsOptimal_system_isNoReturn" type="checkbox" value="1" name="russianpostapi.emsOptimal.system.isNoReturn"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата сдачи в почтовое отделение</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_system_dateDelivery_value">
                            <select id="russianpostapi_emsOptimal_system_dateDelivery" name="russianpostapi.emsOptimal.system.dateDelivery">
                                <option value="0" selected="selected">сегодня</option>
                                <option value="1">завтра</option>
                                <option value="2">послезавтра</option>
                                <option value="3">+ 3 дня</option>
                                <option value="4">+ 4 дня</option>
                                <option value="5">+ 5 дня</option>
                                <option value="6">+ 6 дня</option>
                                <option value="7">+ 7 дня</option>
                            </select>
                        </td>
                        <td>сегодня</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С заказным уведомлением»</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_notice_isOrderNotice_value">
                            <input id="ytrussianpostapi_emsOptimal_notice_isOrderNotice" type="hidden" value="0" name="russianpostapi.emsOptimal.notice.isOrderNotice">
                            <input id="russianpostapi_emsOptimal_notice_isOrderNotice" type="checkbox" value="1" name="russianpostapi.emsOptimal.notice.isOrderNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С простым уведомлением»</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_notice_isSimpleNotice_value">
                            <input id="ytrussianpostapi_emsOptimal_notice_isSimpleNotice" type="hidden" value="0" name="russianpostapi.emsOptimal.notice.isSimpleNotice">
                            <input id="russianpostapi_emsOptimal_notice_isSimpleNotice" type="checkbox" value="1" name="russianpostapi.emsOptimal.notice.isSimpleNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Признак услуги SMS уведомления</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_notice_sms_value">
                            <input id="ytrussianpostapi_emsOptimal_notice_sms" type="hidden" value="0" name="russianpostapi.emsOptimal.notice.sms">
                            <input id="russianpostapi_emsOptimal_notice_sms" type="checkbox" value="1" name="russianpostapi.emsOptimal.notice.sms"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_emsOptimal_weight_value">
                            <input id="ytrussianpostapi_emsOptimal_weight" type="hidden" value="0" name="russianpostapi.emsOptimal.weight">
                            <input id="russianpostapi_emsOptimal_weight" type="checkbox" value="1" name="russianpostapi.emsOptimal.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_emsOptimal_weight_custom_value">
                            <select id="russianpostapi_emsOptimal_weight_custom" name="russianpostapi.emsOptimal.weight.custom">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: высота</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_dimension_height_value">
                            <input id="russianpostapi_emsOptimal_dimension_height" class="span6" placeholder="" type="text" value="" name="russianpostapi.emsOptimal.dimension.height"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: длина</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_dimension_length_value">
                            <input id="russianpostapi_emsOptimal_dimension_length" class="span6" placeholder="" type="text" value="" name="russianpostapi.emsOptimal.dimension.length"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: ширина</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_dimension_width_value">
                            <input id="russianpostapi_emsOptimal_dimension_width" class="span6" placeholder="" type="text" value="" name="russianpostapi.emsOptimal.dimension.width"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Получать тариф в доп. поле</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_getTariff_value">
                            <select id="russianpostapi_emsOptimal_getTariff" name="russianpostapi.emsOptimal.getTariff">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Cтатус, в который переместится заказ после экспорта</b>
                        </td>
                        <td id="russianpostapi_emsOptimal_status_exported_value">
                            <select id="russianpostapi_emsOptimal_status_exported" name="russianpostapi.emsOptimal.status.exported">
                                <option value="-1" selected="selected">Не изменять статус</option>
                                <option value="0">Обработка</option>
                                <option value="49">Подтверждена отправка</option>
                                <option value="41">Подтвержден [2 прозвон]</option>
                                <option value="39">НДЗ-Звонит Робот</option>
                                <option value="51">НДЗ-Робот Дозвон</option>
                                <option value="40">Думает/набрать позже</option>
                                <option value="2">Отменен</option>
                                <option value="8">Дубль</option>
                                <option value="9">Спам/ошибки/Консультация</option>
                                <option value="44">Фрод</option>
                                <option value="50">Жалобы на конкурентов</option>
                                <option value="67">Завести трек</option>
                                <option value="13">Переданы на склад</option>
                                <option value="66">Промежуточный</option>
                                <option value="65">Уехали на почту</option>
                                <option value="14">Отправлен по РФ</option>
                                <option value="15">Пришло на почту сегодня</option>
                                <option value="21">День 1</option>
                                <option value="22">День 2</option>
                                <option value="23">День 3</option>
                                <option value="24">День 4</option>
                                <option value="52">День 4 [Дозвон]</option>
                                <option value="25">День 5</option>
                                <option value="53">День 5 [Дозвон]</option>
                                <option value="42">День 6</option>
                                <option value="54">День 6 [Дозвон]</option>
                                <option value="27">День 7</option>
                                <option value="55">День 7 [Дозвон]</option>
                                <option value="28">День 8</option>
                                <option value="56">День 8 [Дозвон]</option>
                                <option value="29">День 9</option>
                                <option value="57">День 9 [Дозвон]</option>
                                <option value="30">День 10</option>
                                <option value="58">День 10 [Дозвон]</option>
                                <option value="31">День 11</option>
                                <option value="59">День 11 [Дозвон]</option>
                                <option value="32">День 12</option>
                                <option value="60">День 12 [Дозвон]</option>
                                <option value="33">День 13</option>
                                <option value="61">День 13 [Дозвон]</option>
                                <option value="34">День 14</option>
                                <option value="62">День 14 [Дозвон]</option>
                                <option value="35">День 15</option>
                                <option value="63">День 15 [Дозвон]</option>
                                <option value="36">&gt;День 15</option>
                                <option value="64">&gt;День 15 [Дозвон]</option>
                                <option value="7">Возврат</option>
                                <option value="5">Оплачен</option>
                                <option value="6">ОКК</option>
                                <option value="68">Подтверждена отправка {Онлайн}</option>
                                <option value="74">Завести в почту {Онлайн}</option>
                                <option value="72">Распечатать накладные {Нестандартные}</option>
                                <option value="73">Распечатать накладные {Онлайн}</option>
                                <option value="69">Переданы на склад {Онлайн}</option>
                                <option value="70">Уехали на почту {Онлайн}</option>
                                <option value="71">Запасной</option>
                            </select>
                        </td>
                        <td>Не изменять статус</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Курьер «Онлайн»</div>
        <div class="spoiler-body in collapse" id="lv-postblank-onlineCourier" style="height: auto;">
            <table id="lv-config-table-onlineCourier" class="table table-bordered table-forms">
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
                            <b>Использовать модуль отправлений «Курьер "онлайн"»</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_use_value">
                            <input id="ytrussianpostapi_onlineCourier_use" type="hidden" value="0" name="russianpostapi.onlineCourier.use">
                            <input id="russianpostapi_onlineCourier_use" type="checkbox" value="1" name="russianpostapi.onlineCourier.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отправитель на посылке/название брэнда</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_sender_company_value">
                            <input id="russianpostapi_onlineCourier_sender_company" class="span6" placeholder="" type="text" value="" name="russianpostapi.onlineCourier.sender.company"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Код страны</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="По умолчанию установлен код страны Россия: 643" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_onlineCourier_sender_country_value">
                            <input id="russianpostapi_onlineCourier_sender_country" class="span6" placeholder="" type="text" value="643" name="russianpostapi.onlineCourier.sender.country"> </td>
                        <td>643</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места приема</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_sender_postOfficeIndex_value">
                            <input id="russianpostapi_onlineCourier_sender_postOfficeIndex" class="span6" placeholder="" type="text" value="" name="russianpostapi.onlineCourier.sender.postOfficeIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_sender_mailCtg_value">
                            <select id="russianpostapi_onlineCourier_sender_mailCtg" name="russianpostapi.onlineCourier.sender.mailCtg">
                                <option value="SIMPLE">простое</option>
                                <option value="ORDERED">заказное</option>
                                <option value="ORDINARY" selected="selected">обыкновенное</option>
                                <option value="WITH_DECLARED_VALUE">с объявленной ценностью</option>
                                <option value="WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY">с объявленной ценностью и наложенным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_to_typeAddress_value">
                            <select id="russianpostapi_onlineCourier_to_typeAddress" name="russianpostapi.onlineCourier.to.typeAddress">
                                <option value="DEFAULT" selected="selected">Стандартный (улица, дом, квартира)</option>
                                <option value="PO_BOX">Абонентский ящик</option>
                                <option value="DEMAND">до востребования</option>
                            </select>
                        </td>
                        <td>Стандартный (улица, дом, квартира)</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_system_declaredValueFix_value">
                            <input id="russianpostapi_onlineCourier_system_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpostapi.onlineCourier.system.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Курьер»</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_system_isCourier_value">
                            <input id="ytrussianpostapi_onlineCourier_system_isCourier" type="hidden" value="0" name="russianpostapi.onlineCourier.system.isCourier">
                            <input id="russianpostapi_onlineCourier_system_isCourier" type="checkbox" value="1" name="russianpostapi.onlineCourier.system.isCourier"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Осторожно/Хрупкое»</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_system_isFragile_value">
                            <input id="ytrussianpostapi_onlineCourier_system_isFragile" type="hidden" value="0" name="russianpostapi.onlineCourier.system.isFragile">
                            <input id="russianpostapi_onlineCourier_system_isFragile" type="checkbox" value="1" name="russianpostapi.onlineCourier.system.isFragile"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Возврату не подлежит»</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_system_isNoReturn_value">
                            <input id="ytrussianpostapi_onlineCourier_system_isNoReturn" type="hidden" value="0" name="russianpostapi.onlineCourier.system.isNoReturn">
                            <input id="russianpostapi_onlineCourier_system_isNoReturn" type="checkbox" value="1" name="russianpostapi.onlineCourier.system.isNoReturn"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата сдачи в почтовое отделение</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_system_dateDelivery_value">
                            <select id="russianpostapi_onlineCourier_system_dateDelivery" name="russianpostapi.onlineCourier.system.dateDelivery">
                                <option value="0" selected="selected">сегодня</option>
                                <option value="1">завтра</option>
                                <option value="2">послезавтра</option>
                                <option value="3">+ 3 дня</option>
                                <option value="4">+ 4 дня</option>
                                <option value="5">+ 5 дня</option>
                                <option value="6">+ 6 дня</option>
                                <option value="7">+ 7 дня</option>
                            </select>
                        </td>
                        <td>сегодня</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С заказным уведомлением»</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_notice_isOrderNotice_value">
                            <input id="ytrussianpostapi_onlineCourier_notice_isOrderNotice" type="hidden" value="0" name="russianpostapi.onlineCourier.notice.isOrderNotice">
                            <input id="russianpostapi_onlineCourier_notice_isOrderNotice" type="checkbox" value="1" name="russianpostapi.onlineCourier.notice.isOrderNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С простым уведомлением»</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_notice_isSimpleNotice_value">
                            <input id="ytrussianpostapi_onlineCourier_notice_isSimpleNotice" type="hidden" value="0" name="russianpostapi.onlineCourier.notice.isSimpleNotice">
                            <input id="russianpostapi_onlineCourier_notice_isSimpleNotice" type="checkbox" value="1" name="russianpostapi.onlineCourier.notice.isSimpleNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Признак услуги SMS уведомления</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_notice_sms_value">
                            <input id="ytrussianpostapi_onlineCourier_notice_sms" type="hidden" value="0" name="russianpostapi.onlineCourier.notice.sms">
                            <input id="russianpostapi_onlineCourier_notice_sms" type="checkbox" value="1" name="russianpostapi.onlineCourier.notice.sms"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_onlineCourier_weight_value">
                            <input id="ytrussianpostapi_onlineCourier_weight" type="hidden" value="0" name="russianpostapi.onlineCourier.weight">
                            <input id="russianpostapi_onlineCourier_weight" type="checkbox" value="1" name="russianpostapi.onlineCourier.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_onlineCourier_weight_custom_value">
                            <select id="russianpostapi_onlineCourier_weight_custom" name="russianpostapi.onlineCourier.weight.custom">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: высота</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_dimension_height_value">
                            <input id="russianpostapi_onlineCourier_dimension_height" class="span6" placeholder="" type="text" value="" name="russianpostapi.onlineCourier.dimension.height"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: длина</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_dimension_length_value">
                            <input id="russianpostapi_onlineCourier_dimension_length" class="span6" placeholder="" type="text" value="" name="russianpostapi.onlineCourier.dimension.length"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: ширина</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_dimension_width_value">
                            <input id="russianpostapi_onlineCourier_dimension_width" class="span6" placeholder="" type="text" value="" name="russianpostapi.onlineCourier.dimension.width"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Получать тариф в доп. поле</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_getTariff_value">
                            <select id="russianpostapi_onlineCourier_getTariff" name="russianpostapi.onlineCourier.getTariff">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Cтатус, в который переместится заказ после экспорта</b>
                        </td>
                        <td id="russianpostapi_onlineCourier_status_exported_value">
                            <select id="russianpostapi_onlineCourier_status_exported" name="russianpostapi.onlineCourier.status.exported">
                                <option value="-1" selected="selected">Не изменять статус</option>
                                <option value="0">Обработка</option>
                                <option value="49">Подтверждена отправка</option>
                                <option value="41">Подтвержден [2 прозвон]</option>
                                <option value="39">НДЗ-Звонит Робот</option>
                                <option value="51">НДЗ-Робот Дозвон</option>
                                <option value="40">Думает/набрать позже</option>
                                <option value="2">Отменен</option>
                                <option value="8">Дубль</option>
                                <option value="9">Спам/ошибки/Консультация</option>
                                <option value="44">Фрод</option>
                                <option value="50">Жалобы на конкурентов</option>
                                <option value="67">Завести трек</option>
                                <option value="13">Переданы на склад</option>
                                <option value="66">Промежуточный</option>
                                <option value="65">Уехали на почту</option>
                                <option value="14">Отправлен по РФ</option>
                                <option value="15">Пришло на почту сегодня</option>
                                <option value="21">День 1</option>
                                <option value="22">День 2</option>
                                <option value="23">День 3</option>
                                <option value="24">День 4</option>
                                <option value="52">День 4 [Дозвон]</option>
                                <option value="25">День 5</option>
                                <option value="53">День 5 [Дозвон]</option>
                                <option value="42">День 6</option>
                                <option value="54">День 6 [Дозвон]</option>
                                <option value="27">День 7</option>
                                <option value="55">День 7 [Дозвон]</option>
                                <option value="28">День 8</option>
                                <option value="56">День 8 [Дозвон]</option>
                                <option value="29">День 9</option>
                                <option value="57">День 9 [Дозвон]</option>
                                <option value="30">День 10</option>
                                <option value="58">День 10 [Дозвон]</option>
                                <option value="31">День 11</option>
                                <option value="59">День 11 [Дозвон]</option>
                                <option value="32">День 12</option>
                                <option value="60">День 12 [Дозвон]</option>
                                <option value="33">День 13</option>
                                <option value="61">День 13 [Дозвон]</option>
                                <option value="34">День 14</option>
                                <option value="62">День 14 [Дозвон]</option>
                                <option value="35">День 15</option>
                                <option value="63">День 15 [Дозвон]</option>
                                <option value="36">&gt;День 15</option>
                                <option value="64">&gt;День 15 [Дозвон]</option>
                                <option value="7">Возврат</option>
                                <option value="5">Оплачен</option>
                                <option value="6">ОКК</option>
                                <option value="68">Подтверждена отправка {Онлайн}</option>
                                <option value="74">Завести в почту {Онлайн}</option>
                                <option value="72">Распечатать накладные {Нестандартные}</option>
                                <option value="73">Распечатать накладные {Онлайн}</option>
                                <option value="69">Переданы на склад {Онлайн}</option>
                                <option value="70">Уехали на почту {Онлайн}</option>
                                <option value="71">Запасной</option>
                            </select>
                        </td>
                        <td>Не изменять статус</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Письмо</div>
        <div class="spoiler-body in collapse" id="lv-postblank-letter" style="height: auto;">
            <table id="lv-config-table-letter" class="table table-bordered table-forms">
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
                            <b>Использовать модуль отправлений «Письмо»</b>
                        </td>
                        <td id="russianpostapi_letter_use_value">
                            <input id="ytrussianpostapi_letter_use" type="hidden" value="0" name="russianpostapi.letter.use">
                            <input id="russianpostapi_letter_use" type="checkbox" value="1" name="russianpostapi.letter.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отправитель на посылке/название брэнда</b>
                        </td>
                        <td id="russianpostapi_letter_sender_company_value">
                            <input id="russianpostapi_letter_sender_company" class="span6" placeholder="" type="text" value="" name="russianpostapi.letter.sender.company"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Код страны</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="По умолчанию установлен код страны Россия: 643" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_letter_sender_country_value">
                            <input id="russianpostapi_letter_sender_country" class="span6" placeholder="" type="text" value="643" name="russianpostapi.letter.sender.country"> </td>
                        <td>643</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места приема</b>
                        </td>
                        <td id="russianpostapi_letter_sender_postOfficeIndex_value">
                            <input id="russianpostapi_letter_sender_postOfficeIndex" class="span6" placeholder="" type="text" value="" name="russianpostapi.letter.sender.postOfficeIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpostapi_letter_sender_mailCtg_value">
                            <select id="russianpostapi_letter_sender_mailCtg" name="russianpostapi.letter.sender.mailCtg">
                                <option value="SIMPLE">простое</option>
                                <option value="ORDERED">заказное</option>
                                <option value="ORDINARY" selected="selected">обыкновенное</option>
                                <option value="WITH_DECLARED_VALUE">с объявленной ценностью</option>
                                <option value="WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY">с объявленной ценностью и наложенным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpostapi_letter_to_typeAddress_value">
                            <select id="russianpostapi_letter_to_typeAddress" name="russianpostapi.letter.to.typeAddress">
                                <option value="DEFAULT" selected="selected">Стандартный (улица, дом, квартира)</option>
                                <option value="PO_BOX">Абонентский ящик</option>
                                <option value="DEMAND">до востребования</option>
                            </select>
                        </td>
                        <td>Стандартный (улица, дом, квартира)</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpostapi_letter_system_declaredValueFix_value">
                            <input id="russianpostapi_letter_system_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpostapi.letter.system.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Курьер»</b>
                        </td>
                        <td id="russianpostapi_letter_system_isCourier_value">
                            <input id="ytrussianpostapi_letter_system_isCourier" type="hidden" value="0" name="russianpostapi.letter.system.isCourier">
                            <input id="russianpostapi_letter_system_isCourier" type="checkbox" value="1" name="russianpostapi.letter.system.isCourier"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Осторожно/Хрупкое»</b>
                        </td>
                        <td id="russianpostapi_letter_system_isFragile_value">
                            <input id="ytrussianpostapi_letter_system_isFragile" type="hidden" value="0" name="russianpostapi.letter.system.isFragile">
                            <input id="russianpostapi_letter_system_isFragile" type="checkbox" value="1" name="russianpostapi.letter.system.isFragile"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Возврату не подлежит»</b>
                        </td>
                        <td id="russianpostapi_letter_system_isNoReturn_value">
                            <input id="ytrussianpostapi_letter_system_isNoReturn" type="hidden" value="0" name="russianpostapi.letter.system.isNoReturn">
                            <input id="russianpostapi_letter_system_isNoReturn" type="checkbox" value="1" name="russianpostapi.letter.system.isNoReturn"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата сдачи в почтовое отделение</b>
                        </td>
                        <td id="russianpostapi_letter_system_dateDelivery_value">
                            <select id="russianpostapi_letter_system_dateDelivery" name="russianpostapi.letter.system.dateDelivery">
                                <option value="0" selected="selected">сегодня</option>
                                <option value="1">завтра</option>
                                <option value="2">послезавтра</option>
                                <option value="3">+ 3 дня</option>
                                <option value="4">+ 4 дня</option>
                                <option value="5">+ 5 дня</option>
                                <option value="6">+ 6 дня</option>
                                <option value="7">+ 7 дня</option>
                            </select>
                        </td>
                        <td>сегодня</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С заказным уведомлением»</b>
                        </td>
                        <td id="russianpostapi_letter_notice_isOrderNotice_value">
                            <input id="ytrussianpostapi_letter_notice_isOrderNotice" type="hidden" value="0" name="russianpostapi.letter.notice.isOrderNotice">
                            <input id="russianpostapi_letter_notice_isOrderNotice" type="checkbox" value="1" name="russianpostapi.letter.notice.isOrderNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С простым уведомлением»</b>
                        </td>
                        <td id="russianpostapi_letter_notice_isSimpleNotice_value">
                            <input id="ytrussianpostapi_letter_notice_isSimpleNotice" type="hidden" value="0" name="russianpostapi.letter.notice.isSimpleNotice">
                            <input id="russianpostapi_letter_notice_isSimpleNotice" type="checkbox" value="1" name="russianpostapi.letter.notice.isSimpleNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Признак услуги SMS уведомления</b>
                        </td>
                        <td id="russianpostapi_letter_notice_sms_value">
                            <input id="ytrussianpostapi_letter_notice_sms" type="hidden" value="0" name="russianpostapi.letter.notice.sms">
                            <input id="russianpostapi_letter_notice_sms" type="checkbox" value="1" name="russianpostapi.letter.notice.sms"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_letter_weight_value">
                            <input id="ytrussianpostapi_letter_weight" type="hidden" value="0" name="russianpostapi.letter.weight">
                            <input id="russianpostapi_letter_weight" type="checkbox" value="1" name="russianpostapi.letter.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_letter_weight_custom_value">
                            <select id="russianpostapi_letter_weight_custom" name="russianpostapi.letter.weight.custom">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: высота</b>
                        </td>
                        <td id="russianpostapi_letter_dimension_height_value">
                            <input id="russianpostapi_letter_dimension_height" class="span6" placeholder="" type="text" value="" name="russianpostapi.letter.dimension.height"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: длина</b>
                        </td>
                        <td id="russianpostapi_letter_dimension_length_value">
                            <input id="russianpostapi_letter_dimension_length" class="span6" placeholder="" type="text" value="" name="russianpostapi.letter.dimension.length"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: ширина</b>
                        </td>
                        <td id="russianpostapi_letter_dimension_width_value">
                            <input id="russianpostapi_letter_dimension_width" class="span6" placeholder="" type="text" value="" name="russianpostapi.letter.dimension.width"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Получать тариф в доп. поле</b>
                        </td>
                        <td id="russianpostapi_letter_getTariff_value">
                            <select id="russianpostapi_letter_getTariff" name="russianpostapi.letter.getTariff">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Cтатус, в который переместится заказ после экспорта</b>
                        </td>
                        <td id="russianpostapi_letter_status_exported_value">
                            <select id="russianpostapi_letter_status_exported" name="russianpostapi.letter.status.exported">
                                <option value="-1" selected="selected">Не изменять статус</option>
                                <option value="0">Обработка</option>
                                <option value="49">Подтверждена отправка</option>
                                <option value="41">Подтвержден [2 прозвон]</option>
                                <option value="39">НДЗ-Звонит Робот</option>
                                <option value="51">НДЗ-Робот Дозвон</option>
                                <option value="40">Думает/набрать позже</option>
                                <option value="2">Отменен</option>
                                <option value="8">Дубль</option>
                                <option value="9">Спам/ошибки/Консультация</option>
                                <option value="44">Фрод</option>
                                <option value="50">Жалобы на конкурентов</option>
                                <option value="67">Завести трек</option>
                                <option value="13">Переданы на склад</option>
                                <option value="66">Промежуточный</option>
                                <option value="65">Уехали на почту</option>
                                <option value="14">Отправлен по РФ</option>
                                <option value="15">Пришло на почту сегодня</option>
                                <option value="21">День 1</option>
                                <option value="22">День 2</option>
                                <option value="23">День 3</option>
                                <option value="24">День 4</option>
                                <option value="52">День 4 [Дозвон]</option>
                                <option value="25">День 5</option>
                                <option value="53">День 5 [Дозвон]</option>
                                <option value="42">День 6</option>
                                <option value="54">День 6 [Дозвон]</option>
                                <option value="27">День 7</option>
                                <option value="55">День 7 [Дозвон]</option>
                                <option value="28">День 8</option>
                                <option value="56">День 8 [Дозвон]</option>
                                <option value="29">День 9</option>
                                <option value="57">День 9 [Дозвон]</option>
                                <option value="30">День 10</option>
                                <option value="58">День 10 [Дозвон]</option>
                                <option value="31">День 11</option>
                                <option value="59">День 11 [Дозвон]</option>
                                <option value="32">День 12</option>
                                <option value="60">День 12 [Дозвон]</option>
                                <option value="33">День 13</option>
                                <option value="61">День 13 [Дозвон]</option>
                                <option value="34">День 14</option>
                                <option value="62">День 14 [Дозвон]</option>
                                <option value="35">День 15</option>
                                <option value="63">День 15 [Дозвон]</option>
                                <option value="36">&gt;День 15</option>
                                <option value="64">&gt;День 15 [Дозвон]</option>
                                <option value="7">Возврат</option>
                                <option value="5">Оплачен</option>
                                <option value="6">ОКК</option>
                                <option value="68">Подтверждена отправка {Онлайн}</option>
                                <option value="74">Завести в почту {Онлайн}</option>
                                <option value="72">Распечатать накладные {Нестандартные}</option>
                                <option value="73">Распечатать накладные {Онлайн}</option>
                                <option value="69">Переданы на склад {Онлайн}</option>
                                <option value="70">Уехали на почту {Онлайн}</option>
                                <option value="71">Запасной</option>
                            </select>
                        </td>
                        <td>Не изменять статус</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Письмо 1-го класса</div>
        <div class="spoiler-body in collapse" id="lv-postblank-letterClass1" style="height: auto;">
            <table id="lv-config-table-letterClass1" class="table table-bordered table-forms">
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
                            <b>Использовать модуль отправлений «Письмо 1-го класса»</b>
                        </td>
                        <td id="russianpostapi_letterClass1_use_value">
                            <input id="ytrussianpostapi_letterClass1_use" type="hidden" value="0" name="russianpostapi.letterClass1.use">
                            <input id="russianpostapi_letterClass1_use" type="checkbox" value="1" name="russianpostapi.letterClass1.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отправитель на посылке/название брэнда</b>
                        </td>
                        <td id="russianpostapi_letterClass1_sender_company_value">
                            <input id="russianpostapi_letterClass1_sender_company" class="span6" placeholder="" type="text" value="" name="russianpostapi.letterClass1.sender.company"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Код страны</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="По умолчанию установлен код страны Россия: 643" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_letterClass1_sender_country_value">
                            <input id="russianpostapi_letterClass1_sender_country" class="span6" placeholder="" type="text" value="643" name="russianpostapi.letterClass1.sender.country"> </td>
                        <td>643</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места приема</b>
                        </td>
                        <td id="russianpostapi_letterClass1_sender_postOfficeIndex_value">
                            <input id="russianpostapi_letterClass1_sender_postOfficeIndex" class="span6" placeholder="" type="text" value="" name="russianpostapi.letterClass1.sender.postOfficeIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpostapi_letterClass1_sender_mailCtg_value">
                            <select id="russianpostapi_letterClass1_sender_mailCtg" name="russianpostapi.letterClass1.sender.mailCtg">
                                <option value="SIMPLE">простое</option>
                                <option value="ORDERED">заказное</option>
                                <option value="ORDINARY" selected="selected">обыкновенное</option>
                                <option value="WITH_DECLARED_VALUE">с объявленной ценностью</option>
                                <option value="WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY">с объявленной ценностью и наложенным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpostapi_letterClass1_to_typeAddress_value">
                            <select id="russianpostapi_letterClass1_to_typeAddress" name="russianpostapi.letterClass1.to.typeAddress">
                                <option value="DEFAULT" selected="selected">Стандартный (улица, дом, квартира)</option>
                                <option value="PO_BOX">Абонентский ящик</option>
                                <option value="DEMAND">до востребования</option>
                            </select>
                        </td>
                        <td>Стандартный (улица, дом, квартира)</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpostapi_letterClass1_system_declaredValueFix_value">
                            <input id="russianpostapi_letterClass1_system_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpostapi.letterClass1.system.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Курьер»</b>
                        </td>
                        <td id="russianpostapi_letterClass1_system_isCourier_value">
                            <input id="ytrussianpostapi_letterClass1_system_isCourier" type="hidden" value="0" name="russianpostapi.letterClass1.system.isCourier">
                            <input id="russianpostapi_letterClass1_system_isCourier" type="checkbox" value="1" name="russianpostapi.letterClass1.system.isCourier"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Осторожно/Хрупкое»</b>
                        </td>
                        <td id="russianpostapi_letterClass1_system_isFragile_value">
                            <input id="ytrussianpostapi_letterClass1_system_isFragile" type="hidden" value="0" name="russianpostapi.letterClass1.system.isFragile">
                            <input id="russianpostapi_letterClass1_system_isFragile" type="checkbox" value="1" name="russianpostapi.letterClass1.system.isFragile"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «Возврату не подлежит»</b>
                        </td>
                        <td id="russianpostapi_letterClass1_system_isNoReturn_value">
                            <input id="ytrussianpostapi_letterClass1_system_isNoReturn" type="hidden" value="0" name="russianpostapi.letterClass1.system.isNoReturn">
                            <input id="russianpostapi_letterClass1_system_isNoReturn" type="checkbox" value="1" name="russianpostapi.letterClass1.system.isNoReturn"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата сдачи в почтовое отделение</b>
                        </td>
                        <td id="russianpostapi_letterClass1_system_dateDelivery_value">
                            <select id="russianpostapi_letterClass1_system_dateDelivery" name="russianpostapi.letterClass1.system.dateDelivery">
                                <option value="0" selected="selected">сегодня</option>
                                <option value="1">завтра</option>
                                <option value="2">послезавтра</option>
                                <option value="3">+ 3 дня</option>
                                <option value="4">+ 4 дня</option>
                                <option value="5">+ 5 дня</option>
                                <option value="6">+ 6 дня</option>
                                <option value="7">+ 7 дня</option>
                            </select>
                        </td>
                        <td>сегодня</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С заказным уведомлением»</b>
                        </td>
                        <td id="russianpostapi_letterClass1_notice_isOrderNotice_value">
                            <input id="ytrussianpostapi_letterClass1_notice_isOrderNotice" type="hidden" value="0" name="russianpostapi.letterClass1.notice.isOrderNotice">
                            <input id="russianpostapi_letterClass1_notice_isOrderNotice" type="checkbox" value="1" name="russianpostapi.letterClass1.notice.isOrderNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка «С простым уведомлением»</b>
                        </td>
                        <td id="russianpostapi_letterClass1_notice_isSimpleNotice_value">
                            <input id="ytrussianpostapi_letterClass1_notice_isSimpleNotice" type="hidden" value="0" name="russianpostapi.letterClass1.notice.isSimpleNotice">
                            <input id="russianpostapi_letterClass1_notice_isSimpleNotice" type="checkbox" value="1" name="russianpostapi.letterClass1.notice.isSimpleNotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Признак услуги SMS уведомления</b>
                        </td>
                        <td id="russianpostapi_letterClass1_notice_sms_value">
                            <input id="ytrussianpostapi_letterClass1_notice_sms" type="hidden" value="0" name="russianpostapi.letterClass1.notice.sms">
                            <input id="russianpostapi_letterClass1_notice_sms" type="checkbox" value="1" name="russianpostapi.letterClass1.notice.sms"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_letterClass1_weight_value">
                            <input id="ytrussianpostapi_letterClass1_weight" type="hidden" value="0" name="russianpostapi.letterClass1.weight">
                            <input id="russianpostapi_letterClass1_weight" type="checkbox" value="1" name="russianpostapi.letterClass1.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpostapi_letterClass1_weight_custom_value">
                            <select id="russianpostapi_letterClass1_weight_custom" name="russianpostapi.letterClass1.weight.custom">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: высота</b>
                        </td>
                        <td id="russianpostapi_letterClass1_dimension_height_value">
                            <input id="russianpostapi_letterClass1_dimension_height" class="span6" placeholder="" type="text" value="" name="russianpostapi.letterClass1.dimension.height"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: длина</b>
                        </td>
                        <td id="russianpostapi_letterClass1_dimension_length_value">
                            <input id="russianpostapi_letterClass1_dimension_length" class="span6" placeholder="" type="text" value="" name="russianpostapi.letterClass1.dimension.length"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Размеры: ширина</b>
                        </td>
                        <td id="russianpostapi_letterClass1_dimension_width_value">
                            <input id="russianpostapi_letterClass1_dimension_width" class="span6" placeholder="" type="text" value="" name="russianpostapi.letterClass1.dimension.width"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Получать тариф в доп. поле</b>
                        </td>
                        <td id="russianpostapi_letterClass1_getTariff_value">
                            <select id="russianpostapi_letterClass1_getTariff" name="russianpostapi.letterClass1.getTariff">
                                <option value="0" selected="selected">Не использовать</option>
                                <option value="1">Доп. поле 1</option>
                                <option value="2">Доп. поле 2</option>
                                <option value="3">Доп. поле 3</option>
                                <option value="4">Доп. поле 4</option>
                                <option value="5">Доп. поле 5</option>
                                <option value="6">Доп. поле 6</option>
                                <option value="7">Доп. поле 7</option>
                                <option value="8">Доп. поле 8</option>
                                <option value="9">Доп. поле 9</option>
                                <option value="10">Доп. поле 10</option>
                                <option value="11">Доп. поле 11</option>
                                <option value="12">Доп. поле 12</option>
                                <option value="13">Доп. поле 13</option>
                                <option value="14">Доп. поле 14</option>
                                <option value="15">Доп. поле 15</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
                                <option value="18">Доп. поле 18</option>
                                <option value="19">Доп. поле 19</option>
                                <option value="20">Доп. поле 20</option>
                                <option value="21">Доп. поле 21</option>
                                <option value="22">Доп. поле 22</option>
                                <option value="23">Доп. поле 23</option>
                                <option value="24">Доп. поле 24</option>
                                <option value="25">Доп. поле 25</option>
                            </select>
                        </td>
                        <td>Не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Cтатус, в который переместится заказ после экспорта</b>
                        </td>
                        <td id="russianpostapi_letterClass1_status_exported_value">
                            <select id="russianpostapi_letterClass1_status_exported" name="russianpostapi.letterClass1.status.exported">
                                <option value="-1" selected="selected">Не изменять статус</option>
                                <option value="0">Обработка</option>
                                <option value="49">Подтверждена отправка</option>
                                <option value="41">Подтвержден [2 прозвон]</option>
                                <option value="39">НДЗ-Звонит Робот</option>
                                <option value="51">НДЗ-Робот Дозвон</option>
                                <option value="40">Думает/набрать позже</option>
                                <option value="2">Отменен</option>
                                <option value="8">Дубль</option>
                                <option value="9">Спам/ошибки/Консультация</option>
                                <option value="44">Фрод</option>
                                <option value="50">Жалобы на конкурентов</option>
                                <option value="67">Завести трек</option>
                                <option value="13">Переданы на склад</option>
                                <option value="66">Промежуточный</option>
                                <option value="65">Уехали на почту</option>
                                <option value="14">Отправлен по РФ</option>
                                <option value="15">Пришло на почту сегодня</option>
                                <option value="21">День 1</option>
                                <option value="22">День 2</option>
                                <option value="23">День 3</option>
                                <option value="24">День 4</option>
                                <option value="52">День 4 [Дозвон]</option>
                                <option value="25">День 5</option>
                                <option value="53">День 5 [Дозвон]</option>
                                <option value="42">День 6</option>
                                <option value="54">День 6 [Дозвон]</option>
                                <option value="27">День 7</option>
                                <option value="55">День 7 [Дозвон]</option>
                                <option value="28">День 8</option>
                                <option value="56">День 8 [Дозвон]</option>
                                <option value="29">День 9</option>
                                <option value="57">День 9 [Дозвон]</option>
                                <option value="30">День 10</option>
                                <option value="58">День 10 [Дозвон]</option>
                                <option value="31">День 11</option>
                                <option value="59">День 11 [Дозвон]</option>
                                <option value="32">День 12</option>
                                <option value="60">День 12 [Дозвон]</option>
                                <option value="33">День 13</option>
                                <option value="61">День 13 [Дозвон]</option>
                                <option value="34">День 14</option>
                                <option value="62">День 14 [Дозвон]</option>
                                <option value="35">День 15</option>
                                <option value="63">День 15 [Дозвон]</option>
                                <option value="36">&gt;День 15</option>
                                <option value="64">&gt;День 15 [Дозвон]</option>
                                <option value="7">Возврат</option>
                                <option value="5">Оплачен</option>
                                <option value="6">ОКК</option>
                                <option value="68">Подтверждена отправка {Онлайн}</option>
                                <option value="74">Завести в почту {Онлайн}</option>
                                <option value="72">Распечатать накладные {Нестандартные}</option>
                                <option value="73">Распечатать накладные {Онлайн}</option>
                                <option value="69">Переданы на склад {Онлайн}</option>
                                <option value="70">Уехали на почту {Онлайн}</option>
                                <option value="71">Запасной</option>
                            </select>
                        </td>
                        <td>Не изменять статус</td>
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


  $(function () {
    $('[rel="popover"]').popover();
  });

//   $(document).ready(function () {
//     var $use = $('#lv-postblank-use');
//     var $table = $('#lv-config-table-use');
//     $table.unwrap();
//     $table.prev().remove();
//     $table.unwrap();
//     $use.prev().remove();
//     $use.addClass('in');
//     $use.css('height', 'auto');
// 
// 
//     LvShowHideConfigRows('russianpost.f117.notice.phone', 1);
//     LvShowHideConfigRows('russianpost.7a.notice.phone', 1);
//     LvShowHideConfigRows('russianpost.7b.notice.phone', 1);
//     LvShowHideConfigRows('russianpost.f103New.sms.notice', 3);
//   });
  
/*<![CDATA[*/
jQuery(function($) {
jQuery('#yw0 .alert').alert();
jQuery('body').tooltip({'selector':'a[rel=tooltip]'});
jQuery('body').popover({'selector':'a[rel=popover]'});
});
/*]]>*/
</script>