<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('tech', $RoleUser) && !in_array('tech', $RoleGroup)) die();	
?>

<div id="top">
	<h1>Модуль «Почта России»
		<i class="radios little" style="float: right;">
		<select cabinet="cats">
			 <optgroup label="Формы">
				<option cats="24">Почта России Форма 7А</option>
				<option cats="25">Почта России Форма 7Б</option>
				<option cats="26">Почта России Форма 7П</option>
		   	<option cats="27">Почта России Форма 112</option>
		   	<option cats="28">Почта России Форма 117</option>
		    </optgroup><optgroup label="Списки">
		   	<option cats="31">Почта России Список ф.103 (реестр ПО)</option>
		    </optgroup><optgroup label="Файлы">
		   	<option cats="32">Почта России Файлы *.txt и *.ini (для реестра ПО)</option>
		   	<option cats="29">Почта России Бланк отчета</option>
		   	<option cats="30">Почта России Бланк заявления - указания</option>
		   </optgroup><optgroup label="Онлайн-сервис Отправка">
		   	<option cats="11">Типы отправлений</option>
				<option cats="23">Аккаунты</option>
			</optgroup>
			
		</select>
	  		<label class="active"><input type="radio" name="radios" radios="status1">Активные</label>
	  		<label><input type="radio" name="radios" radios="status2">Архив</label>
	  		<label id="add" list="24" item="0" class="add" action="addf"><b>+</b>Добавить</label>
		</i>
    	<i>Модуль «Почта России»</i>
   </h1>
</div>
<div id="contents-add"></div>

<div id="list2"></div>
<div id="detail"></div>




<script>

localStorage.removeItem('users');
localStorage.removeItem('price');
function objects(params) {
	$.extend(this.options, params);
}

	objects.prototype = {
		start: function() {
					
			$('[cabinet="cats"]').change(objects.ads.bind(this));
			$('.radios [name]').change(function() {
				$('.radios label').removeClass('active').find('[radios]:checked').parent().addClass('active');
				objects.ads();
			});
	    	return false;
		},
		ads: function() {
			if (JSCat.category != null) {
				var list = $('[cabinet="cats"] option:selected').attr('cats');
				var user = $('[cabinet="users"] option:selected').attr('users');
				var status = $('[radios]:checked').attr('radios');
				
				$('#contents-add, #search_content').empty();
				$('#add').removeAttr('list').attr('list', list);
				$('#search_content').removeAttr('list').attr('list', list);
				$('#list2').empty().append('<div searcher class="call crmls" list="'+ list +'" status="'+ user +'" user="'+ status +'" count="15" pagination="true" template="10"></div><div paginator></div>');
				renderer.process.search();
				return false;
			}
		}
	}
$(function() {
	objects = new objects();
	objects.start();
});

</script>






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
    <div class="spoiler">
        <div class="spoiler-btn">Форма 7П (ярлык посылка)</div>
        <div class="spoiler-body collapse in" id="lv-postblank-7p" style="" aria-expanded="true">
            <table id="lv-config-table-7p" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Форма 7П (ярлык посылка)»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Форма 7П (ярлык посылка)»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7p_use_value">
                            <input id="ytrussianpost_7p_use" type="hidden" value="0" name="russianpost.7p.use">
                            <input id="russianpost_7p_use" type="checkbox" value="1" name="russianpost.7p.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_7p_from_name_value">
                            <input id="russianpost_7p_from_name" class="span6" placeholder="" type="text" value="Мацепуро Анатолий Владимирович" name="russianpost.7p.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Откуда»</b>
                        </td>
                        <td id="russianpost_7p_from_city_value">
                            <input id="russianpost_7p_from_city" class="span6" placeholder="" type="text" value="Московская область, г. Москва, до востребования" name="russianpost.7p.from.city"> </td>
                        <td>г. Москва, до востребования</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Индекс места отправления»</b>
                        </td>
                        <td id="russianpost_7p_from_postIndex_value">
                            <input id="russianpost_7p_from_postIndex" class="span6" placeholder="" type="text" value="105118" name="russianpost.7p.from.postIndex"> </td>
                        <td>121500</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с объявленной ценностью</b>
                        </td>
                        <td id="russianpost_7p_type_ob_cennost_value">
                            <input id="ytrussianpost_7p_type_ob_cennost" type="hidden" value="0" name="russianpost.7p.type.ob.cennost">
                            <input id="russianpost_7p_type_ob_cennost" checked="checked" type="checkbox" value="1" name="russianpost.7p.type.ob.cennost"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с наложенным платежом</b>
                        </td>
                        <td id="russianpost_7p_type_naloj_value">
                            <input id="ytrussianpost_7p_type_naloj" type="hidden" value="0" name="russianpost.7p.type.naloj">
                            <input id="russianpost_7p_type_naloj" checked="checked" type="checkbox" value="1" name="russianpost.7p.type.naloj"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с описью</b>
                        </td>
                        <td id="russianpost_7p_type_s_opis_value">
                            <input id="ytrussianpost_7p_type_s_opis" type="hidden" value="0" name="russianpost.7p.type.s.opis">
                            <input id="russianpost_7p_type_s_opis" type="checkbox" value="1" name="russianpost.7p.type.s.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с простым уведомлением</b>
                        </td>
                        <td id="russianpost_7p_type_simplenotice_value">
                            <input id="ytrussianpost_7p_type_simplenotice" type="hidden" value="0" name="russianpost.7p.type.simplenotice">
                            <input id="russianpost_7p_type_simplenotice" type="checkbox" value="1" name="russianpost.7p.type.simplenotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с заказным уведомлением</b>
                        </td>
                        <td id="russianpost_7p_type_zakaznotice_value">
                            <input id="ytrussianpost_7p_type_zakaznotice" type="hidden" value="0" name="russianpost.7p.type.zakaznotice">
                            <input id="russianpost_7p_type_zakaznotice" type="checkbox" value="1" name="russianpost.7p.type.zakaznotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наложенный платеж внутри</b>
                        </td>
                        <td id="russianpost_7p_type_naloj_inside_value">
                            <input id="ytrussianpost_7p_type_naloj_inside" type="hidden" value="0" name="russianpost.7p.type.naloj.inside">
                            <input id="russianpost_7p_type_naloj_inside" type="checkbox" value="1" name="russianpost.7p.type.naloj.inside"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать КПШ</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Нужен только для партионной почты" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7p_kpsh_print_value">
                            <input id="ytrussianpost_7p_kpsh_print" type="hidden" value="0" name="russianpost.7p.kpsh.print">
                            <input id="russianpost_7p_kpsh_print" type="checkbox" value="1" name="russianpost.7p.kpsh.print"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Город ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Город ОПС, отображается на бланке 7П, при включенном поле «Печатать КПШ»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7p_kpsh_city_value">
                            <input id="russianpost_7p_kpsh_city" class="span6" placeholder="" type="text" value="" name="russianpost.7p.kpsh.city"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить дату на КПШ</b>
                        </td>
                        <td id="russianpost_7p_kpsh_date_value">
                            <select id="russianpost_7p_kpsh_date" name="russianpost.7p.kpsh.date">
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
                            <b>Выводить номер телефона отправителя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы получите смс-уведомление от почты о прибытии посылки на почту клиента. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7p_notice_phone_value">
                            <input id="ytrussianpost_7p_notice_phone" type="hidden" value="0" name="russianpost.7p.notice.phone">
                            <input id="russianpost_7p_notice_phone" type="checkbox" value="1" name="russianpost.7p.notice.phone"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Введите номер телефона для уведомлений</b>
                        </td>
                        <td id="russianpost_7p_notice_phoneSender_value">
                            <input id="russianpost_7p_notice_phoneSender" class="span6" placeholder="" type="text" value="" name="russianpost.7p.notice.phoneSender"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить номер телефона получателя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Ваш клиент получит смс-уведомление от почты о прибытии его посылки. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7p_notice_phoneReciever_value">
                            <input id="ytrussianpost_7p_notice_phoneReciever" type="hidden" value="0" name="russianpost.7p.notice.phoneReciever">
                            <input id="russianpost_7p_notice_phoneReciever" type="checkbox" value="1" name="russianpost.7p.notice.phoneReciever"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7p_weight_value">
                            <input id="ytrussianpost_7p_weight" type="hidden" value="0" name="russianpost.7p.weight">
                            <input id="russianpost_7p_weight" type="checkbox" value="1" name="russianpost.7p.weight"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_7p_weight_product_value">
                            <input id="russianpost_7p_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.7p.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7p_weight_package_value">
                            <input id="russianpost_7p_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.7p.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7p_weight_custom_value">
                            <select id="russianpost_7p_weight_custom" name="russianpost.7p.weight.custom">
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
                            <b>Вернуть по обратному адресу</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="В случае объективной невозможности пересылки воздушным транспортом" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7p_air_notice_returnAddress_value">
                            <input id="ytrussianpost_7p_air_notice_returnAddress" type="hidden" value="0" name="russianpost.7p.air.notice.returnAddress">
                            <input id="russianpost_7p_air_notice_returnAddress" type="checkbox" value="1" name="russianpost.7p.air.notice.returnAddress"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Направить наземным транспортом</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="В случае объективной невозможности пересылки воздушным транспортом" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7p_air_notice_landTransport_value">
                            <input id="ytrussianpost_7p_air_notice_landTransport" type="hidden" value="0" name="russianpost.7p.air.notice.landTransport">
                            <input id="russianpost_7p_air_notice_landTransport" type="checkbox" value="1" name="russianpost.7p.air.notice.landTransport"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Подпись отправителя</b>
                        </td>
                        <td id="russianpost_7p_air_sign_value">
                            <input id="russianpost_7p_air_sign" class="span6" placeholder="" type="text" value="" name="russianpost.7p.air.sign"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Подпись оператора</b>
                        </td>
                        <td id="russianpost_7p_air_signOperator_value">
                            <input id="russianpost_7p_air_signOperator" class="span6" placeholder="" type="text" value="" name="russianpost.7p.air.signOperator"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Тяжеловесная</b>
                        </td>
                        <td id="russianpost_7p_specialNotes_heavy_value">
                            <input id="ytrussianpost_7p_specialNotes_heavy" type="hidden" value="0" name="russianpost.7p.specialNotes.heavy">
                            <input id="russianpost_7p_specialNotes_heavy" type="checkbox" value="1" name="russianpost.7p.specialNotes.heavy"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Простая</b>
                        </td>
                        <td id="russianpost_7p_specialNotes_simple_value">
                            <input id="ytrussianpost_7p_specialNotes_simple" type="hidden" value="0" name="russianpost.7p.specialNotes.simple">
                            <input id="russianpost_7p_specialNotes_simple" type="checkbox" value="1" name="russianpost.7p.specialNotes.simple"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Стандартная</b>
                        </td>
                        <td id="russianpost_7p_specialNotes_standard_value">
                            <input id="ytrussianpost_7p_specialNotes_standard" type="hidden" value="0" name="russianpost.7p.specialNotes.standard">
                            <input id="russianpost_7p_specialNotes_standard" type="checkbox" value="1" name="russianpost.7p.specialNotes.standard"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Стандартная негабаритная</b>
                        </td>
                        <td id="russianpost_7p_specialNotes_standardNegabitnaya_value">
                            <input id="ytrussianpost_7p_specialNotes_standardNegabitnaya" type="hidden" value="0" name="russianpost.7p.specialNotes.standardNegabitnaya">
                            <input id="russianpost_7p_specialNotes_standardNegabitnaya" type="checkbox" value="1" name="russianpost.7p.specialNotes.standardNegabitnaya"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Обыкновенная</b>
                        </td>
                        <td id="russianpost_7p_specialNotes_common_value">
                            <input id="ytrussianpost_7p_specialNotes_common" type="hidden" value="0" name="russianpost.7p.specialNotes.common">
                            <input id="russianpost_7p_specialNotes_common" type="checkbox" value="1" name="russianpost.7p.specialNotes.common"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Крупногабаритная</b>
                        </td>
                        <td id="russianpost_7p_specialNotes_bulky_value">
                            <input id="ytrussianpost_7p_specialNotes_bulky" type="hidden" value="0" name="russianpost.7p.specialNotes.bulky">
                            <input id="russianpost_7p_specialNotes_bulky" type="checkbox" value="1" name="russianpost.7p.specialNotes.bulky"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Заказная</b>
                        </td>
                        <td id="russianpost_7p_specialNotes_custom_value">
                            <input id="ytrussianpost_7p_specialNotes_custom" type="hidden" value="0" name="russianpost.7p.specialNotes.custom">
                            <input id="russianpost_7p_specialNotes_custom" type="checkbox" value="1" name="russianpost.7p.specialNotes.custom"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Нестандартная</b>
                        </td>
                        <td id="russianpost_7p_specialNotes_noStandard_value">
                            <input id="ytrussianpost_7p_specialNotes_noStandard" type="hidden" value="0" name="russianpost.7p.specialNotes.noStandard">
                            <input id="russianpost_7p_specialNotes_noStandard" type="checkbox" value="1" name="russianpost.7p.specialNotes.noStandard"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Форма 7П (ярлык посылка без н/пл)</div>
        <div class="spoiler-body collapse in" id="lv-postblank-7pnonp" style="" aria-expanded="true">
            <table id="lv-config-table-7pnonp" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Форма 7П (ярлык посылка без н/пл)»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Форма 7П (ярлык посылка без н/пл)»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pnonp_use_value">
                            <input id="ytrussianpost_7pnonp_use" type="hidden" value="0" name="russianpost.7pnonp.use">
                            <input id="russianpost_7pnonp_use" type="checkbox" value="1" name="russianpost.7pnonp.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_7pnonp_from_name_value">
                            <input id="russianpost_7pnonp_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.7pnonp.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Откуда»</b>
                        </td>
                        <td id="russianpost_7pnonp_from_city_value">
                            <input id="russianpost_7pnonp_from_city" class="span6" placeholder="" type="text" value="г. Москва, до востребования" name="russianpost.7pnonp.from.city"> </td>
                        <td>г. Москва, до востребования</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Индекс места отправления»</b>
                        </td>
                        <td id="russianpost_7pnonp_from_postIndex_value">
                            <input id="russianpost_7pnonp_from_postIndex" class="span6" placeholder="" type="text" value="121500" name="russianpost.7pnonp.from.postIndex"> </td>
                        <td>121500</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с объявленной ценностью</b>
                        </td>
                        <td id="russianpost_7pnonp_type_ob_cennost_value">
                            <input id="ytrussianpost_7pnonp_type_ob_cennost" type="hidden" value="0" name="russianpost.7pnonp.type.ob.cennost">
                            <input id="russianpost_7pnonp_type_ob_cennost" checked="checked" type="checkbox" value="1" name="russianpost.7pnonp.type.ob.cennost"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с описью</b>
                        </td>
                        <td id="russianpost_7pnonp_type_s_opis_value">
                            <input id="ytrussianpost_7pnonp_type_s_opis" type="hidden" value="0" name="russianpost.7pnonp.type.s.opis">
                            <input id="russianpost_7pnonp_type_s_opis" type="checkbox" value="1" name="russianpost.7pnonp.type.s.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с простым уведомлением</b>
                        </td>
                        <td id="russianpost_7pnonp_type_simplenotice_value">
                            <input id="ytrussianpost_7pnonp_type_simplenotice" type="hidden" value="0" name="russianpost.7pnonp.type.simplenotice">
                            <input id="russianpost_7pnonp_type_simplenotice" type="checkbox" value="1" name="russianpost.7pnonp.type.simplenotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с заказным уведомлением</b>
                        </td>
                        <td id="russianpost_7pnonp_type_zakaznotice_value">
                            <input id="ytrussianpost_7pnonp_type_zakaznotice" type="hidden" value="0" name="russianpost.7pnonp.type.zakaznotice">
                            <input id="russianpost_7pnonp_type_zakaznotice" type="checkbox" value="1" name="russianpost.7pnonp.type.zakaznotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpost_7pnonp_declaredValueFix_value">
                            <input id="russianpost_7pnonp_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpost.7pnonp.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать КПШ</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Нужен только для партионной почты" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pnonp_kpsh_print_value">
                            <input id="ytrussianpost_7pnonp_kpsh_print" type="hidden" value="0" name="russianpost.7pnonp.kpsh.print">
                            <input id="russianpost_7pnonp_kpsh_print" type="checkbox" value="1" name="russianpost.7pnonp.kpsh.print"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Город ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Город ОПС, отображается на бланке 7П, при включенном поле «Печатать КПШ»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pnonp_kpsh_city_value">
                            <input id="russianpost_7pnonp_kpsh_city" class="span6" placeholder="" type="text" value="" name="russianpost.7pnonp.kpsh.city"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить дату на КПШ</b>
                        </td>
                        <td id="russianpost_7pnonp_kpsh_date_value">
                            <select id="russianpost_7pnonp_kpsh_date" name="russianpost.7pnonp.kpsh.date">
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
                            <b>Выводить номер телефона отправителя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы получите смс-уведомление от почты о прибытии посылки на почту клиента. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pnonp_notice_phone_value">
                            <input id="ytrussianpost_7pnonp_notice_phone" type="hidden" value="0" name="russianpost.7pnonp.notice.phone">
                            <input id="russianpost_7pnonp_notice_phone" type="checkbox" value="1" name="russianpost.7pnonp.notice.phone"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Введите номер телефона для уведомлений</b>
                        </td>
                        <td id="russianpost_7pnonp_notice_phoneSender_value">
                            <input id="russianpost_7pnonp_notice_phoneSender" class="span6" placeholder="" type="text" value="" name="russianpost.7pnonp.notice.phoneSender"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить номер телефона получателя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Ваш клиент получит смс-уведомление от почты о прибытии его посылки. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pnonp_notice_phoneReceiver_value">
                            <input id="ytrussianpost_7pnonp_notice_phoneReceiver" type="hidden" value="0" name="russianpost.7pnonp.notice.phoneReceiver">
                            <input id="russianpost_7pnonp_notice_phoneReceiver" type="checkbox" value="1" name="russianpost.7pnonp.notice.phoneReceiver"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pnonp_weight_value">
                            <input id="ytrussianpost_7pnonp_weight" type="hidden" value="0" name="russianpost.7pnonp.weight">
                            <input id="russianpost_7pnonp_weight" checked="checked" type="checkbox" value="1" name="russianpost.7pnonp.weight"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_7pnonp_weight_product_value">
                            <input id="russianpost_7pnonp_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.7pnonp.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pnonp_weight_package_value">
                            <input id="russianpost_7pnonp_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.7pnonp.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pnonp_weight_custom_value">
                            <select id="russianpost_7pnonp_weight_custom" name="russianpost.7pnonp.weight.custom">
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
                            <b>Вернуть по обратному адресу</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="В случае объективной невозможности пересылки воздушным транспортом" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pnonp_air_notice_returnAddress_value">
                            <input id="ytrussianpost_7pnonp_air_notice_returnAddress" type="hidden" value="0" name="russianpost.7pnonp.air.notice.returnAddress">
                            <input id="russianpost_7pnonp_air_notice_returnAddress" type="checkbox" value="1" name="russianpost.7pnonp.air.notice.returnAddress"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Направить наземным транспортом</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="В случае объективной невозможности пересылки воздушным транспортом" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pnonp_air_notice_landTransport_value">
                            <input id="ytrussianpost_7pnonp_air_notice_landTransport" type="hidden" value="0" name="russianpost.7pnonp.air.notice.landTransport">
                            <input id="russianpost_7pnonp_air_notice_landTransport" type="checkbox" value="1" name="russianpost.7pnonp.air.notice.landTransport"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Подпись отправителя</b>
                        </td>
                        <td id="russianpost_7pnonp_air_sign_value">
                            <input id="russianpost_7pnonp_air_sign" class="span6" placeholder="" type="text" value="" name="russianpost.7pnonp.air.sign"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Подпись оператора</b>
                        </td>
                        <td id="russianpost_7pnonp_air_signOperator_value">
                            <input id="russianpost_7pnonp_air_signOperator" class="span6" placeholder="" type="text" value="" name="russianpost.7pnonp.air.signOperator"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Тяжеловесная</b>
                        </td>
                        <td id="russianpost_7pnonp_specialNotes_heavy_value">
                            <input id="ytrussianpost_7pnonp_specialNotes_heavy" type="hidden" value="0" name="russianpost.7pnonp.specialNotes.heavy">
                            <input id="russianpost_7pnonp_specialNotes_heavy" type="checkbox" value="1" name="russianpost.7pnonp.specialNotes.heavy"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Простая</b>
                        </td>
                        <td id="russianpost_7pnonp_specialNotes_simple_value">
                            <input id="ytrussianpost_7pnonp_specialNotes_simple" type="hidden" value="0" name="russianpost.7pnonp.specialNotes.simple">
                            <input id="russianpost_7pnonp_specialNotes_simple" type="checkbox" value="1" name="russianpost.7pnonp.specialNotes.simple"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Стандартная</b>
                        </td>
                        <td id="russianpost_7pnonp_specialNotes_standard_value">
                            <input id="ytrussianpost_7pnonp_specialNotes_standard" type="hidden" value="0" name="russianpost.7pnonp.specialNotes.standard">
                            <input id="russianpost_7pnonp_specialNotes_standard" type="checkbox" value="1" name="russianpost.7pnonp.specialNotes.standard"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Стандартная негабаритная</b>
                        </td>
                        <td id="russianpost_7pnonp_specialNotes_standardNegabitnaya_value">
                            <input id="ytrussianpost_7pnonp_specialNotes_standardNegabitnaya" type="hidden" value="0" name="russianpost.7pnonp.specialNotes.standardNegabitnaya">
                            <input id="russianpost_7pnonp_specialNotes_standardNegabitnaya" type="checkbox" value="1" name="russianpost.7pnonp.specialNotes.standardNegabitnaya"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Обыкновенная</b>
                        </td>
                        <td id="russianpost_7pnonp_specialNotes_common_value">
                            <input id="ytrussianpost_7pnonp_specialNotes_common" type="hidden" value="0" name="russianpost.7pnonp.specialNotes.common">
                            <input id="russianpost_7pnonp_specialNotes_common" type="checkbox" value="1" name="russianpost.7pnonp.specialNotes.common"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Крупногабаритная</b>
                        </td>
                        <td id="russianpost_7pnonp_specialNotes_bulky_value">
                            <input id="ytrussianpost_7pnonp_specialNotes_bulky" type="hidden" value="0" name="russianpost.7pnonp.specialNotes.bulky">
                            <input id="russianpost_7pnonp_specialNotes_bulky" type="checkbox" value="1" name="russianpost.7pnonp.specialNotes.bulky"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Заказная</b>
                        </td>
                        <td id="russianpost_7pnonp_specialNotes_custom_value">
                            <input id="ytrussianpost_7pnonp_specialNotes_custom" type="hidden" value="0" name="russianpost.7pnonp.specialNotes.custom">
                            <input id="russianpost_7pnonp_specialNotes_custom" type="checkbox" value="1" name="russianpost.7pnonp.specialNotes.custom"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Особые отметки: Нестандартная</b>
                        </td>
                        <td id="russianpost_7pnonp_specialNotes_noStandard_value">
                            <input id="ytrussianpost_7pnonp_specialNotes_noStandard" type="hidden" value="0" name="russianpost.7pnonp.specialNotes.noStandard">
                            <input id="russianpost_7pnonp_specialNotes_noStandard" type="checkbox" value="1" name="russianpost.7pnonp.specialNotes.noStandard"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Форма 7П (ярлык посылка онлайн)</div>
        <div class="spoiler-body collapse in" id="lv-postblank-7pOnline" style="" aria-expanded="true">
            <table id="lv-config-table-7pOnline" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Форма 7П (ярлык посылка онлайн)»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Форма 7П (ярлык посылка онлайн)»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pOnline_use_value">
                            <input id="ytrussianpost_7pOnline_use" type="hidden" value="0" name="russianpost.7pOnline.use">
                            <input id="russianpost_7pOnline_use" type="checkbox" value="1" name="russianpost.7pOnline.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Заголовок</b>
                        </td>
                        <td id="russianpost_7pOnline_caption_value">
                            <input id="russianpost_7pOnline_caption" class="span6" placeholder="" type="text" value="ПОСЫЛКА ОНЛАЙН" name="russianpost.7pOnline.caption"> </td>
                        <td>ПОСЫЛКА ОНЛАЙН</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_7pOnline_from_name_value">
                            <input id="russianpost_7pOnline_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.7pOnline.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Откуда»</b>
                        </td>
                        <td id="russianpost_7pOnline_from_city_value">
                            <input id="russianpost_7pOnline_from_city" class="span6" placeholder="" type="text" value="г. Москва, до востребования" name="russianpost.7pOnline.from.city"> </td>
                        <td>г. Москва, до востребования</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Индекс места отправления»</b>
                        </td>
                        <td id="russianpost_7pOnline_from_postIndex_value">
                            <input id="russianpost_7pOnline_from_postIndex" class="span6" placeholder="" type="text" value="121500" name="russianpost.7pOnline.from.postIndex"> </td>
                        <td>121500</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: стандартная</b>
                        </td>
                        <td id="russianpost_7pOnline_type_standard_value">
                            <input id="ytrussianpost_7pOnline_type_standard" type="hidden" value="0" name="russianpost.7pOnline.type.standard">
                            <input id="russianpost_7pOnline_type_standard" type="checkbox" value="1" name="russianpost.7pOnline.type.standard"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: обыкновенная</b>
                        </td>
                        <td id="russianpost_7pOnline_type_simple_value">
                            <input id="ytrussianpost_7pOnline_type_simple" type="hidden" value="0" name="russianpost.7pOnline.type.simple">
                            <input id="russianpost_7pOnline_type_simple" type="checkbox" value="1" name="russianpost.7pOnline.type.simple"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с объявленной ценностью</b>
                        </td>
                        <td id="russianpost_7pOnline_type_ob_cennost_value">
                            <input id="ytrussianpost_7pOnline_type_ob_cennost" type="hidden" value="0" name="russianpost.7pOnline.type.ob.cennost">
                            <input id="russianpost_7pOnline_type_ob_cennost" type="checkbox" value="1" name="russianpost.7pOnline.type.ob.cennost"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с наложенным платежом</b>
                        </td>
                        <td id="russianpost_7pOnline_type_naloj_value">
                            <input id="ytrussianpost_7pOnline_type_naloj" type="hidden" value="0" name="russianpost.7pOnline.type.naloj">
                            <input id="russianpost_7pOnline_type_naloj" checked="checked" type="checkbox" value="1" name="russianpost.7pOnline.type.naloj"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с описью</b>
                        </td>
                        <td id="russianpost_7pOnline_type_opis_value">
                            <input id="ytrussianpost_7pOnline_type_opis" type="hidden" value="0" name="russianpost.7pOnline.type.opis">
                            <input id="russianpost_7pOnline_type_opis" type="checkbox" value="1" name="russianpost.7pOnline.type.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать КПШ</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Нужен только для партионной почты" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pOnline_kpsh_print_value">
                            <input id="ytrussianpost_7pOnline_kpsh_print" type="hidden" value="0" name="russianpost.7pOnline.kpsh.print">
                            <input id="russianpost_7pOnline_kpsh_print" type="checkbox" value="1" name="russianpost.7pOnline.kpsh.print"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Город ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Город ОПС, отображается на бланке 7П, при включенном поле «Печатать КПШ»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pOnline_kpsh_city_value">
                            <input id="russianpost_7pOnline_kpsh_city" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.kpsh.city"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить дату на КПШ</b>
                        </td>
                        <td id="russianpost_7pOnline_kpsh_date_value">
                            <select id="russianpost_7pOnline_kpsh_date" name="russianpost.7pOnline.kpsh.date">
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
                            <b>Номер телефона получателя платежа</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Заполняется по умолчанию" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pOnline_details_phone_value">
                            <input id="russianpost_7pOnline_details_phone" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.details.phone"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование получателя платежа</b>
                        </td>
                        <td id="russianpost_7pOnline_details_name_value">
                            <input id="russianpost_7pOnline_details_name" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.details.name"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выплатить наличными деньгами</b>
                        </td>
                        <td id="russianpost_7pOnline_details_cash_value">
                            <input id="ytrussianpost_7pOnline_details_cash" type="hidden" value="0" name="russianpost.7pOnline.details.cash">
                            <input id="russianpost_7pOnline_details_cash" type="checkbox" value="1" name="russianpost.7pOnline.details.cash"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИФП/ИРП получателя платежа</b>
                        </td>
                        <td id="russianpost_7pOnline_details_ifp_value">
                            <input id="russianpost_7pOnline_details_ifp" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.details.ifp"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН получателя платежа</b>
                        </td>
                        <td id="russianpost_7pOnline_details_inn_value">
                            <input id="russianpost_7pOnline_details_inn" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.details.inn"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Кор/счет получателя платежа</b>
                        </td>
                        <td id="russianpost_7pOnline_details_kor_value">
                            <input id="russianpost_7pOnline_details_kor" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.details.kor"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование банка получателя платежа</b>
                        </td>
                        <td id="russianpost_7pOnline_details_bankName_value">
                            <input id="russianpost_7pOnline_details_bankName" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.details.bankName"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Рас/счет получателя платежа</b>
                        </td>
                        <td id="russianpost_7pOnline_details_ras_value">
                            <input id="russianpost_7pOnline_details_ras" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.details.ras"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>БИК получателя платежа</b>
                        </td>
                        <td id="russianpost_7pOnline_details_bik_value">
                            <input id="russianpost_7pOnline_details_bik" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.details.bik"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ОГРН получателя платежа</b>
                        </td>
                        <td id="russianpost_7pOnline_details_ogrn_value">
                            <input id="russianpost_7pOnline_details_ogrn" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.details.ogrn"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Адрес получателя платежа</b>
                        </td>
                        <td id="russianpost_7pOnline_details_address_value">
                            <input id="russianpost_7pOnline_details_address" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.details.address"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс получателя платежа</b>
                        </td>
                        <td id="russianpost_7pOnline_details_index_value">
                            <input id="russianpost_7pOnline_details_index" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.details.index"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpost_7pOnline_declaredValueFix_value">
                            <input id="russianpost_7pOnline_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении (С НДС)</b>
                        </td>
                        <td id="russianpost_7pOnline_check_opis_fixedValueNDS_value">
                            <input id="russianpost_7pOnline_check_opis_fixedValueNDS" class="span6" placeholder="" type="text" value="" name="russianpost.7pOnline.check.opis.fixedValueNDS"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pOnline_weight_value">
                            <input id="ytrussianpost_7pOnline_weight" type="hidden" value="0" name="russianpost.7pOnline.weight">
                            <input id="russianpost_7pOnline_weight" checked="checked" type="checkbox" value="1" name="russianpost.7pOnline.weight"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_7pOnline_weight_product_value">
                            <input id="russianpost_7pOnline_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.7pOnline.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pOnline_weight_package_value">
                            <input id="russianpost_7pOnline_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.7pOnline.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7pOnline_weight_custom_value">
                            <select id="russianpost_7pOnline_weight_custom" name="russianpost.7pOnline.weight.custom">
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
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Форма 7б (ярлык бандероль)</div>
        <div class="spoiler-body collapse in" id="lv-postblank-7b" style="" aria-expanded="true">
            <table id="lv-config-table-7b" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Форма 7б (ярлык бандероль)»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Форма 7б (ярлык бандероль)»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7b_use_value">
                            <input id="ytrussianpost_7b_use" type="hidden" value="0" name="russianpost.7b.use">
                            <input id="russianpost_7b_use" type="checkbox" value="1" name="russianpost.7b.use"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Заголовок</b>
                        </td>
                        <td id="russianpost_7b_caption_value">
                            <input id="russianpost_7b_caption" class="span6" placeholder="" type="text" value="БАНДЕРОЛЬ" name="russianpost.7b.caption"> </td>
                        <td>БАНДЕРОЛЬ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_7b_from_name_value">
                            <input id="russianpost_7b_from_name" class="span6" placeholder="" type="text" value="Дашков Анатолий Алексеевич" name="russianpost.7b.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Откуда»</b>
                        </td>
                        <td id="russianpost_7b_from_city_value">
                            <input id="russianpost_7b_from_city" class="span6" placeholder="" type="text" value="Московская область, г. Москва, до востребования" name="russianpost.7b.from.city"> </td>
                        <td>г. Москва, до востребования</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Индекс места отправления»</b>
                        </td>
                        <td id="russianpost_7b_from_postIndex_value">
                            <input id="russianpost_7b_from_postIndex" class="span6" placeholder="" type="text" value="105118" name="russianpost.7b.from.postIndex"> </td>
                        <td>121500</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: простая</b>
                        </td>
                        <td id="russianpost_7b_type_prostaya_value">
                            <input id="ytrussianpost_7b_type_prostaya" type="hidden" value="0" name="russianpost.7b.type.prostaya">
                            <input id="russianpost_7b_type_prostaya" type="checkbox" value="1" name="russianpost.7b.type.prostaya"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: заказная</b>
                        </td>
                        <td id="russianpost_7b_type_zakaznaya_value">
                            <input id="ytrussianpost_7b_type_zakaznaya" type="hidden" value="0" name="russianpost.7b.type.zakaznaya">
                            <input id="russianpost_7b_type_zakaznaya" type="checkbox" value="1" name="russianpost.7b.type.zakaznaya"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с описью</b>
                        </td>
                        <td id="russianpost_7b_type_s_opis_value">
                            <input id="ytrussianpost_7b_type_s_opis" type="hidden" value="0" name="russianpost.7b.type.s.opis">
                            <input id="russianpost_7b_type_s_opis" type="checkbox" value="1" name="russianpost.7b.type.s.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с объявленной ценностью</b>
                        </td>
                        <td id="russianpost_7b_type_ob_cennost_value">
                            <input id="ytrussianpost_7b_type_ob_cennost" type="hidden" value="0" name="russianpost.7b.type.ob.cennost">
                            <input id="russianpost_7b_type_ob_cennost" type="checkbox" value="1" name="russianpost.7b.type.ob.cennost"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с уведомлением</b>
                        </td>
                        <td id="russianpost_7b_type_s_uved_value">
                            <input id="ytrussianpost_7b_type_s_uved" type="hidden" value="0" name="russianpost.7b.type.s.uved">
                            <input id="russianpost_7b_type_s_uved" type="checkbox" value="1" name="russianpost.7b.type.s.uved"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с объявленной ценностью и наложенным платежом</b>
                        </td>
                        <td id="russianpost_7b_type_ob_cennost_naloj_value">
                            <input id="ytrussianpost_7b_type_ob_cennost_naloj" type="hidden" value="0" name="russianpost.7b.type.ob.cennost.naloj">
                            <input id="russianpost_7b_type_ob_cennost_naloj" checked="checked" type="checkbox" value="1" name="russianpost.7b.type.ob.cennost.naloj"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наложенный платеж внутри</b>
                        </td>
                        <td id="russianpost_7b_type_naloj_inside_value">
                            <input id="ytrussianpost_7b_type_naloj_inside" type="hidden" value="0" name="russianpost.7b.type.naloj.inside">
                            <input id="russianpost_7b_type_naloj_inside" type="checkbox" value="1" name="russianpost.7b.type.naloj.inside"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать КПШ</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Нужен только для партионной почты" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7b_kpsh_print_value">
                            <input id="ytrussianpost_7b_kpsh_print" type="hidden" value="0" name="russianpost.7b.kpsh.print">
                            <input id="russianpost_7b_kpsh_print" type="checkbox" value="1" name="russianpost.7b.kpsh.print"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Город ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Город ОПС, отображается на бланке 7б, при включенном поле «Печатать КПШ»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7b_kpsh_city_value">
                            <input id="russianpost_7b_kpsh_city" class="span6" placeholder="" type="text" value="" name="russianpost.7b.kpsh.city"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить дату на КПШ</b>
                        </td>
                        <td id="russianpost_7b_kpsh_date_value">
                            <select id="russianpost_7b_kpsh_date" name="russianpost.7b.kpsh.date">
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
                            <b>Выводить номер телефона отправителя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы получите смс-уведомление от почты о прибытии посылки на почту клиента. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7b_notice_phone_value">
                            <input id="ytrussianpost_7b_notice_phone" type="hidden" value="0" name="russianpost.7b.notice.phone">
                            <input id="russianpost_7b_notice_phone" type="checkbox" value="1" name="russianpost.7b.notice.phone"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr style="display: none;">
                        <td>
                            <b>Введите номер телефона для уведомлений</b>
                        </td>
                        <td id="russianpost_7b_notice_phoneSender_value">
                            <input id="russianpost_7b_notice_phoneSender" class="span6" placeholder="" type="text" value="" name="russianpost.7b.notice.phoneSender"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить номер телефона получателя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Ваш клиент получит смс-уведомление от почты о прибытии его посылки. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7b_notice_phoneReciever_value">
                            <input id="ytrussianpost_7b_notice_phoneReciever" type="hidden" value="0" name="russianpost.7b.notice.phoneReciever">
                            <input id="russianpost_7b_notice_phoneReciever" checked="checked" type="checkbox" value="1" name="russianpost.7b.notice.phoneReciever"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7b_weight_value">
                            <input id="ytrussianpost_7b_weight" type="hidden" value="0" name="russianpost.7b.weight">
                            <input id="russianpost_7b_weight" type="checkbox" value="1" name="russianpost.7b.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Форма 7б (ярлык бандероль без н/пл)</div>
        <div class="spoiler-body collapse in" id="lv-postblank-7bnonp" style="" aria-expanded="true">
            <table id="lv-config-table-7bnonp" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Форма 7б (ярлык бандероль без н/пл)»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Форма 7б (ярлык бандероль без н/пл)»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7bnonp_use_value">
                            <input id="ytrussianpost_7bnonp_use" type="hidden" value="0" name="russianpost.7bnonp.use">
                            <input id="russianpost_7bnonp_use" type="checkbox" value="1" name="russianpost.7bnonp.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Заголовок</b>
                        </td>
                        <td id="russianpost_7bnonp_caption_value">
                            <input id="russianpost_7bnonp_caption" class="span6" placeholder="" type="text" value="БАНДЕРОЛЬ" name="russianpost.7bnonp.caption"> </td>
                        <td>БАНДЕРОЛЬ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_7bnonp_from_name_value">
                            <input id="russianpost_7bnonp_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.7bnonp.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Откуда»</b>
                        </td>
                        <td id="russianpost_7bnonp_from_city_value">
                            <input id="russianpost_7bnonp_from_city" class="span6" placeholder="" type="text" value="г. Москва, до востребования" name="russianpost.7bnonp.from.city"> </td>
                        <td>г. Москва, до востребования</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Индекс места отправления»</b>
                        </td>
                        <td id="russianpost_7bnonp_from_postIndex_value">
                            <input id="russianpost_7bnonp_from_postIndex" class="span6" placeholder="" type="text" value="121500" name="russianpost.7bnonp.from.postIndex"> </td>
                        <td>121500</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: простая</b>
                        </td>
                        <td id="russianpost_7bnonp_type_prostaya_value">
                            <input id="ytrussianpost_7bnonp_type_prostaya" type="hidden" value="0" name="russianpost.7bnonp.type.prostaya">
                            <input id="russianpost_7bnonp_type_prostaya" type="checkbox" value="1" name="russianpost.7bnonp.type.prostaya"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: заказная</b>
                        </td>
                        <td id="russianpost_7bnonp_type_zakaznaya_value">
                            <input id="ytrussianpost_7bnonp_type_zakaznaya" type="hidden" value="0" name="russianpost.7bnonp.type.zakaznaya">
                            <input id="russianpost_7bnonp_type_zakaznaya" type="checkbox" value="1" name="russianpost.7bnonp.type.zakaznaya"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с описью</b>
                        </td>
                        <td id="russianpost_7bnonp_type_s_opis_value">
                            <input id="ytrussianpost_7bnonp_type_s_opis" type="hidden" value="0" name="russianpost.7bnonp.type.s.opis">
                            <input id="russianpost_7bnonp_type_s_opis" type="checkbox" value="1" name="russianpost.7bnonp.type.s.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с объявленной ценностью</b>
                        </td>
                        <td id="russianpost_7bnonp_type_ob_cennost_value">
                            <input id="ytrussianpost_7bnonp_type_ob_cennost" type="hidden" value="0" name="russianpost.7bnonp.type.ob.cennost">
                            <input id="russianpost_7bnonp_type_ob_cennost" checked="checked" type="checkbox" value="1" name="russianpost.7bnonp.type.ob.cennost"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с уведомлением</b>
                        </td>
                        <td id="russianpost_7bnonp_type_s_uved_value">
                            <input id="ytrussianpost_7bnonp_type_s_uved" type="hidden" value="0" name="russianpost.7bnonp.type.s.uved">
                            <input id="russianpost_7bnonp_type_s_uved" type="checkbox" value="1" name="russianpost.7bnonp.type.s.uved"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с объявленной ценностью и наложенным платежом</b>
                        </td>
                        <td id="russianpost_7bnonp_type_ob_cennost_naloj_value">
                            <input id="ytrussianpost_7bnonp_type_ob_cennost_naloj" type="hidden" value="0" name="russianpost.7bnonp.type.ob.cennost.naloj">
                            <input id="russianpost_7bnonp_type_ob_cennost_naloj" type="checkbox" value="1" name="russianpost.7bnonp.type.ob.cennost.naloj"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наложенный платеж внутри</b>
                        </td>
                        <td id="russianpost_7bnonp_type_naloj_inside_value">
                            <input id="ytrussianpost_7bnonp_type_naloj_inside" type="hidden" value="0" name="russianpost.7bnonp.type.naloj.inside">
                            <input id="russianpost_7bnonp_type_naloj_inside" type="checkbox" value="1" name="russianpost.7bnonp.type.naloj.inside"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать КПШ</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Нужен только для партионной почты" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7bnonp_kpsh_print_value">
                            <input id="ytrussianpost_7bnonp_kpsh_print" type="hidden" value="0" name="russianpost.7bnonp.kpsh.print">
                            <input id="russianpost_7bnonp_kpsh_print" type="checkbox" value="1" name="russianpost.7bnonp.kpsh.print"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Город ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Город ОПС, отображается на бланке 7б, при включенном поле «Печатать КПШ»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7bnonp_kpsh_city_value">
                            <input id="russianpost_7bnonp_kpsh_city" class="span6" placeholder="" type="text" value="" name="russianpost.7bnonp.kpsh.city"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить дату на КПШ</b>
                        </td>
                        <td id="russianpost_7bnonp_kpsh_date_value">
                            <select id="russianpost_7bnonp_kpsh_date" name="russianpost.7bnonp.kpsh.date">
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
                            <b>Выводить номер телефона отправителя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы получите смс-уведомление от почты о прибытии посылки на почту клиента. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7bnonp_notice_phone_value">
                            <input id="ytrussianpost_7bnonp_notice_phone" type="hidden" value="0" name="russianpost.7bnonp.notice.phone">
                            <input id="russianpost_7bnonp_notice_phone" type="checkbox" value="1" name="russianpost.7bnonp.notice.phone"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Введите номер телефона для уведомлений</b>
                        </td>
                        <td id="russianpost_7bnonp_notice_phoneSender_value">
                            <input id="russianpost_7bnonp_notice_phoneSender" class="span6" placeholder="" type="text" value="" name="russianpost.7bnonp.notice.phoneSender"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить номер телефона получателя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Ваш клиент получит смс-уведомление от почты о прибытии его посылки. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7bnonp_notice_phoneReciever_value">
                            <input id="ytrussianpost_7bnonp_notice_phoneReciever" type="hidden" value="0" name="russianpost.7bnonp.notice.phoneReciever">
                            <input id="russianpost_7bnonp_notice_phoneReciever" type="checkbox" value="1" name="russianpost.7bnonp.notice.phoneReciever"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7bnonp_weight_value">
                            <input id="ytrussianpost_7bnonp_weight" type="hidden" value="0" name="russianpost.7bnonp.weight">
                            <input id="russianpost_7bnonp_weight" type="checkbox" value="1" name="russianpost.7bnonp.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Форма 7б (ярлык письмо)</div>
        <div class="spoiler-body collapse in" id="lv-postblank-7bLetter" style="" aria-expanded="true">
            <table id="lv-config-table-7bLetter" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Форма 7б (ярлык письмо)»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Форма 7б (ярлык письмо)»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7bLetter_use_value">
                            <input id="ytrussianpost_7bLetter_use" type="hidden" value="0" name="russianpost.7bLetter.use">
                            <input id="russianpost_7bLetter_use" type="checkbox" value="1" name="russianpost.7bLetter.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Заголовок</b>
                        </td>
                        <td id="russianpost_7bLetter_caption_value">
                            <input id="russianpost_7bLetter_caption" class="span6" placeholder="" type="text" value="ПИСЬМО" name="russianpost.7bLetter.caption"> </td>
                        <td>ПИСЬМО</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_7bLetter_from_name_value">
                            <input id="russianpost_7bLetter_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.7bLetter.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Откуда»</b>
                        </td>
                        <td id="russianpost_7bLetter_from_city_value">
                            <input id="russianpost_7bLetter_from_city" class="span6" placeholder="" type="text" value="г. Москва, до востребования" name="russianpost.7bLetter.from.city"> </td>
                        <td>г. Москва, до востребования</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Индекс места отправления»</b>
                        </td>
                        <td id="russianpost_7bLetter_from_postIndex_value">
                            <input id="russianpost_7bLetter_from_postIndex" class="span6" placeholder="" type="text" value="121500" name="russianpost.7bLetter.from.postIndex"> </td>
                        <td>121500</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_7bLetter_type_mailCtg_value">
                            <select id="russianpost_7bLetter_type_mailCtg" name="russianpost.7bLetter.type.mailCtg">
                                <option value="2" selected="selected">с объявленной ценностью</option>
                                <option value="4">с объявленной ценностью и наложенным платежом</option>
                            </select>
                        </td>
                        <td>с объявленной ценностью</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать КПШ</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Нужен только для партионной почты" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7bLetter_kpsh_print_value">
                            <input id="ytrussianpost_7bLetter_kpsh_print" type="hidden" value="0" name="russianpost.7bLetter.kpsh.print">
                            <input id="russianpost_7bLetter_kpsh_print" type="checkbox" value="1" name="russianpost.7bLetter.kpsh.print"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Город ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Город ОПС, отображается на бланке 7б, при включенном поле «Печатать КПШ»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7bLetter_kpsh_city_value">
                            <input id="russianpost_7bLetter_kpsh_city" class="span6" placeholder="" type="text" value="" name="russianpost.7bLetter.kpsh.city"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить дату на КПШ</b>
                        </td>
                        <td id="russianpost_7bLetter_kpsh_date_value">
                            <select id="russianpost_7bLetter_kpsh_date" name="russianpost.7bLetter.kpsh.date">
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
                            <b>Выводить номер телефона отправителя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы получите смс-уведомление от почты о прибытии посылки на почту клиента. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7bLetter_notice_phone_value">
                            <input id="ytrussianpost_7bLetter_notice_phone" type="hidden" value="0" name="russianpost.7bLetter.notice.phone">
                            <input id="russianpost_7bLetter_notice_phone" type="checkbox" value="1" name="russianpost.7bLetter.notice.phone"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Введите номер телефона для уведомлений</b>
                        </td>
                        <td id="russianpost_7bLetter_notice_phoneSender_value">
                            <input id="russianpost_7bLetter_notice_phoneSender" class="span6" placeholder="" type="text" value="" name="russianpost.7bLetter.notice.phoneSender"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить номер телефона получателя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Ваш клиент получит смс-уведомление от почты о прибытии его посылки. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7bLetter_notice_phoneReciever_value">
                            <input id="ytrussianpost_7bLetter_notice_phoneReciever" type="hidden" value="0" name="russianpost.7bLetter.notice.phoneReciever">
                            <input id="russianpost_7bLetter_notice_phoneReciever" type="checkbox" value="1" name="russianpost.7bLetter.notice.phoneReciever"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7bLetter_weight_value">
                            <input id="ytrussianpost_7bLetter_weight" type="hidden" value="0" name="russianpost.7bLetter.weight">
                            <input id="russianpost_7bLetter_weight" type="checkbox" value="1" name="russianpost.7bLetter.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Форма 7а (ярлык 1 кл)</div>
        <div class="spoiler-body collapse in" id="lv-postblank-7a" style="" aria-expanded="true">
            <table id="lv-config-table-7a" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Форма 7а (ярлык 1 кл)»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Форма 7а (ярлык 1 кл)»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7a_use_value">
                            <input id="ytrussianpost_7a_use" type="hidden" value="0" name="russianpost.7a.use">
                            <input id="russianpost_7a_use" type="checkbox" value="1" name="russianpost.7a.use"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_7a_from_name_value">
                            <input id="russianpost_7a_from_name" class="span6" placeholder="" type="text" value="Мацепуро Анатолий Владимирович" name="russianpost.7a.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Откуда»</b>
                        </td>
                        <td id="russianpost_7a_from_city_value">
                            <input id="russianpost_7a_from_city" class="span6" placeholder="" type="text" value="Московская область, г. Москва, до востребования" name="russianpost.7a.from.city"> </td>
                        <td>г. Москва, до востребования</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Индекс места отправления»</b>
                        </td>
                        <td id="russianpost_7a_from_postIndex_value">
                            <input id="russianpost_7a_from_postIndex" class="span6" placeholder="" type="text" value="105118" name="russianpost.7a.from.postIndex"> </td>
                        <td>121500</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: письмо 1-го класса</b>
                        </td>
                        <td id="russianpost_7a_type_letter_value">
                            <input id="ytrussianpost_7a_type_letter" type="hidden" value="0" name="russianpost.7a.type.letter">
                            <input id="russianpost_7a_type_letter" type="checkbox" value="1" name="russianpost.7a.type.letter"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: бандероль 1-го класса</b>
                        </td>
                        <td id="russianpost_7a_type_banderol_value">
                            <input id="ytrussianpost_7a_type_banderol" type="hidden" value="0" name="russianpost.7a.type.banderol">
                            <input id="russianpost_7a_type_banderol" type="checkbox" value="1" name="russianpost.7a.type.banderol"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: посылка 1-го класса</b>
                        </td>
                        <td id="russianpost_7a_type_posylka_value">
                            <input id="ytrussianpost_7a_type_posylka" type="hidden" value="0" name="russianpost.7a.type.posylka">
                            <input id="russianpost_7a_type_posylka" checked="checked" type="checkbox" value="1" name="russianpost.7a.type.posylka"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с объявленной ценностью</b>
                        </td>
                        <td id="russianpost_7a_type_ob_value">
                            <input id="ytrussianpost_7a_type_ob" type="hidden" value="0" name="russianpost.7a.type.ob">
                            <input id="russianpost_7a_type_ob" checked="checked" type="checkbox" value="1" name="russianpost.7a.type.ob"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с наложенным платежом</b>
                        </td>
                        <td id="russianpost_7a_type_naloj_value">
                            <input id="ytrussianpost_7a_type_naloj" type="hidden" value="0" name="russianpost.7a.type.naloj">
                            <input id="russianpost_7a_type_naloj" checked="checked" type="checkbox" value="1" name="russianpost.7a.type.naloj"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с простым уведомлением</b>
                        </td>
                        <td id="russianpost_7a_type_simplenotice_value">
                            <input id="ytrussianpost_7a_type_simplenotice" type="hidden" value="0" name="russianpost.7a.type.simplenotice">
                            <input id="russianpost_7a_type_simplenotice" type="checkbox" value="1" name="russianpost.7a.type.simplenotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с заказным уведомлением</b>
                        </td>
                        <td id="russianpost_7a_type_zakaznotice_value">
                            <input id="ytrussianpost_7a_type_zakaznotice" type="hidden" value="0" name="russianpost.7a.type.zakaznotice">
                            <input id="russianpost_7a_type_zakaznotice" type="checkbox" value="1" name="russianpost.7a.type.zakaznotice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с описью</b>
                        </td>
                        <td id="russianpost_7a_type_opis_value">
                            <input id="ytrussianpost_7a_type_opis" type="hidden" value="0" name="russianpost.7a.type.opis">
                            <input id="russianpost_7a_type_opis" type="checkbox" value="1" name="russianpost.7a.type.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наложенный платеж внутри</b>
                        </td>
                        <td id="russianpost_7a_type_naloj_inside_value">
                            <input id="ytrussianpost_7a_type_naloj_inside" type="hidden" value="0" name="russianpost.7a.type.naloj.inside">
                            <input id="russianpost_7a_type_naloj_inside" type="checkbox" value="1" name="russianpost.7a.type.naloj.inside"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать КПШ</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Нужен только для партионной почты" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7a_kpsh_print_value">
                            <input id="ytrussianpost_7a_kpsh_print" type="hidden" value="0" name="russianpost.7a.kpsh.print">
                            <input id="russianpost_7a_kpsh_print" type="checkbox" value="1" name="russianpost.7a.kpsh.print"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс на КПШ</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Индекс КПШ, отображается на бланке 7а, при включенном поле «Печатать КПШ»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7a_kpsh_postIndex_value">
                            <input id="russianpost_7a_kpsh_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.7a.kpsh.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Город ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Город ОПС, отображается на бланке 7а, при включенном поле «Печатать КПШ»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7a_kpsh_city_value">
                            <input id="russianpost_7a_kpsh_city" class="span6" placeholder="" type="text" value="" name="russianpost.7a.kpsh.city"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить дату на КПШ</b>
                        </td>
                        <td id="russianpost_7a_kpsh_date_value">
                            <select id="russianpost_7a_kpsh_date" name="russianpost.7a.kpsh.date">
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
                            <b>Выводить номер телефона отправителя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы получите смс-уведомление от почты о прибытии посылки на почту клиента. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7a_notice_phone_value">
                            <input id="ytrussianpost_7a_notice_phone" type="hidden" value="0" name="russianpost.7a.notice.phone">
                            <input id="russianpost_7a_notice_phone" type="checkbox" value="1" name="russianpost.7a.notice.phone"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr style="display: none;">
                        <td>
                            <b>Введите номер телефона для уведомлений</b>
                        </td>
                        <td id="russianpost_7a_notice_phoneSender_value">
                            <input id="russianpost_7a_notice_phoneSender" class="span6" placeholder="" type="text" value="" name="russianpost.7a.notice.phoneSender"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить номер телефона получателя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Ваш клиент получит смс-уведомление от почты о прибытии его посылки. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7a_notice_phoneReciever_value">
                            <input id="ytrussianpost_7a_notice_phoneReciever" type="hidden" value="0" name="russianpost.7a.notice.phoneReciever">
                            <input id="russianpost_7a_notice_phoneReciever" type="checkbox" value="1" name="russianpost.7a.notice.phoneReciever"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7a_weight_value">
                            <input id="ytrussianpost_7a_weight" type="hidden" value="0" name="russianpost.7a.weight">
                            <input id="russianpost_7a_weight" type="checkbox" value="1" name="russianpost.7a.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_7a_weight_product_value">
                            <input id="russianpost_7a_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.7a.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7a_weight_package_value">
                            <input id="russianpost_7a_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.7a.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7a_weight_custom_value">
                            <select id="russianpost_7a_weight_custom" name="russianpost.7a.weight.custom">
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
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_7a_sender_transType_value">
                            <select id="russianpost_7a_sender_transType" name="russianpost.7a.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                                <option value="4">системой ускоренной почты</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вернуть по обратному адресу</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="В случае объективной невозможности пересылки воздушным транспортом" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7a_air_notice_returnAddress_value">
                            <input id="ytrussianpost_7a_air_notice_returnAddress" type="hidden" value="0" name="russianpost.7a.air.notice.returnAddress">
                            <input id="russianpost_7a_air_notice_returnAddress" type="checkbox" value="1" name="russianpost.7a.air.notice.returnAddress"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Направить наземным транспортом</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="В случае объективной невозможности пересылки воздушным транспортом" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_7a_air_notice_landTransport_value">
                            <input id="ytrussianpost_7a_air_notice_landTransport" type="hidden" value="0" name="russianpost.7a.air.notice.landTransport">
                            <input id="russianpost_7a_air_notice_landTransport" checked="checked" type="checkbox" value="1" name="russianpost.7a.air.notice.landTransport"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Подпись отправителя</b>
                        </td>
                        <td id="russianpost_7a_air_sign_value">
                            <input id="russianpost_7a_air_sign" class="span6" placeholder="" type="text" value="" name="russianpost.7a.air.sign"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Форма 117 (ярлык посылка)</div>
        <div class="spoiler-body collapse in" id="lv-postblank-f117" style="" aria-expanded="true">
            <table id="lv-config-table-f117" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Форма 117 (ярлык посылка)»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Форма 117 (ярлык посылка)»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f117_use_value">
                            <input id="ytrussianpost_f117_use" type="hidden" value="0" name="russianpost.f117.use">
                            <input id="russianpost_f117_use" type="checkbox" value="1" name="russianpost.f117.use"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_f117_from_name_value">
                            <input id="russianpost_f117_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.f117.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Откуда»</b>
                        </td>
                        <td id="russianpost_f117_from_city_value">
                            <input id="russianpost_f117_from_city" class="span6" placeholder="" type="text" value="г. Москва, до востребования" name="russianpost.f117.from.city"> </td>
                        <td>г. Москва, до востребования</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «Индекс места отправления»</b>
                        </td>
                        <td id="russianpost_f117_from_postIndex_value">
                            <input id="russianpost_f117_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.f117.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Ф.И.О отправителя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Отображается на форме 117 в графе «С требованиями к упаковке ознакомлен»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f117_fiz_name_value">
                            <input id="russianpost_f117_fiz_name" class="span6" placeholder="" type="text" value="" name="russianpost.f117.fiz.name"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Предъявлен документ</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Отображается на форме 117 в графе «Предъявлен»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f117_fiz_document_value">
                            <input id="russianpost_f117_fiz_document" class="span6" placeholder="" type="text" value="Паспорт" name="russianpost.f117.fiz.document"> </td>
                        <td>Паспорт</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Серия</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Отображается на форме 117 в графе «Предъявлен ... серия»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f117_fiz_document_seriya_value">
                            <input id="russianpost_f117_fiz_document_seriya" class="span6" placeholder="" type="text" value="00 00" name="russianpost.f117.fiz.document.seriya"> </td>
                        <td>00 00</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Отображается на форме 117 в графе «Предъявлен ... номер»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f117_fiz_document_nomer_value">
                            <input id="russianpost_f117_fiz_document_nomer" class="span6" placeholder="" type="text" value="00" name="russianpost.f117.fiz.document.nomer"> </td>
                        <td>00</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>выдан (дата)</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Отображается на форме 117 в графе «Предъявлен ... выдан»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f117_fiz_document_vydan_date_value">
                            <input id="russianpost_f117_fiz_document_vydan_date" class="span6" placeholder="" type="text" value="1 января" name="russianpost.f117.fiz.document.vydan.date"> </td>
                        <td>1 января</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>выдан (год)</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Отображается на форме 117 в графе год выдачи документа, удостоверяющего личность. 2 цифры года" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f117_fiz_document_vydan_year_value">
                            <input id="russianpost_f117_fiz_document_vydan_year" class="span6" placeholder="" type="text" value="14" name="russianpost.f117.fiz.document.vydan.year"> </td>
                        <td>14</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>выдан (кем)</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Отображается на форме 117 в графе «наименование учреждения, выдавшего документ»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f117_fiz_document_vydan_kem_value">
                            <input id="russianpost_f117_fiz_document_vydan_kem" class="span6" placeholder="" type="text" value="ФМС России ..." name="russianpost.f117.fiz.document.vydan.kem"> </td>
                        <td>ФМС России ...</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить номер телефона отправителя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы получите смс-уведомление от почты о прибытии посылки на почту клиента. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f117_notice_phone_value">
                            <input id="ytrussianpost_f117_notice_phone" type="hidden" value="0" name="russianpost.f117.notice.phone">
                            <input id="russianpost_f117_notice_phone" type="checkbox" value="1" name="russianpost.f117.notice.phone"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr style="display: none;">
                        <td>
                            <b>Введите номер телефона для уведомлений</b>
                        </td>
                        <td id="russianpost_f117_notice_phoneSender_value">
                            <input id="russianpost_f117_notice_phoneSender" class="span6" placeholder="" type="text" value="" name="russianpost.f117.notice.phoneSender"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить номер телефона получателя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Ваш клиент получит смс-уведомление от почты о прибытии его посылки. Услуга платная, предоставляется Почтой России." data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f117_notice_phoneReciever_value">
                            <input id="ytrussianpost_f117_notice_phoneReciever" type="hidden" value="0" name="russianpost.f117.notice.phoneReciever">
                            <input id="russianpost_f117_notice_phoneReciever" type="checkbox" value="1" name="russianpost.f117.notice.phoneReciever"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Форма 112 эк (наложка фед. клиент)</div>
        <div class="spoiler-body collapse in" id="lv-postblank-f112ek" style="" aria-expanded="true">
            <table id="lv-config-table-f112ek" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Форма 112 эк (наложка фед. клиент)»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Форма 112 эк (наложка фед. клиент)»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f112ek_use_value">
                            <input id="ytrussianpost_f112ek_use" type="hidden" value="0" name="russianpost.f112ek.use">
                            <input id="russianpost_f112ek_use" type="checkbox" value="1" name="russianpost.f112ek.use"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Получатель перевода</b>
                        </td>
                        <td id="russianpost_f112ek_receiver_value">
                            <input id="russianpost_f112ek_receiver" class="span6" placeholder="" type="text" value="ООО &quot;ПИМ (Почта)&quot;" name="russianpost.f112ek.receiver"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер телефона получателя перевода</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Чтобы номер телефона не отображался на бланке, оставьте поле пустым. Вводите без пробелов, начиная с 7, без знака +" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f112ek_receiver_phone_value">
                            <input id="russianpost_f112ek_receiver_phone" class="span6" placeholder="" type="text" value="" name="russianpost.f112ek.receiver.phone"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Адрес получателя перевода</b>
                        </td>
                        <td id="russianpost_f112ek_receiver_to_value">
                            <input id="russianpost_f112ek_receiver_to" class="span6" placeholder="" type="text" value="125955 Федеральный клиент ООО &quot;ПИМ (Почта)&quot;" name="russianpost.f112ek.receiver.to"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Код федерального клиента</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Отображается на форме 112ЭК. Только для федеральных клиентов Почты России" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f112ek_fk_code_value">
                            <input id="russianpost_f112ek_fk_code" class="span6" placeholder="" type="text" value="026352" name="russianpost.f112ek.fk.code"> </td>
                        <td>000000</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Зона информации клиента</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Отображается на форме 112ЭК. Только для федеральных клиентов Почты России" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f112ek_fk_infozone_value">
                            <input id="russianpost_f112ek_fk_infozone" class="span6" placeholder="" type="text" value="Тариф (2%, минимум 50р)" name="russianpost.f112ek.fk.infozone"> </td>
                        <td>Тариф оплачивает отправитель перевода</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать двумерный матричный код</b>
                        </td>
                        <td id="russianpost_f112ek_datamatrix_use_value">
                            <input id="ytrussianpost_f112ek_datamatrix_use" type="hidden" value="0" name="russianpost.f112ek.datamatrix.use">
                            <input id="russianpost_f112ek_datamatrix_use" checked="checked" type="checkbox" value="1" name="russianpost.f112ek.datamatrix.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Почтовый индекс получателя перевода</b>
                        </td>
                        <td id="russianpost_f112ek_datamatrix_postIdnex_value">
                            <input id="russianpost_f112ek_datamatrix_postIdnex" class="span6" placeholder="" type="text" value="125955" name="russianpost.f112ek.datamatrix.postIdnex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион получателя перевода</b>
                        </td>
                        <td id="russianpost_f112ek_datamatrix_region_value">
                            <input id="russianpost_f112ek_datamatrix_region" class="span6" placeholder="" type="text" value="" name="russianpost.f112ek.datamatrix.region"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Адрес получателя перевода</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Адрес указывается без почтового индекса и наименования региона" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f112ek_datamatrix_address_value">
                            <input id="russianpost_f112ek_datamatrix_address" class="span6" placeholder="" type="text" value="" name="russianpost.f112ek.datamatrix.address"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип получателя перевода и форма оплаты</b>
                        </td>
                        <td id="russianpost_f112ek_datamatrix_payType_value">
                            <select id="russianpost_f112ek_datamatrix_payType" name="russianpost.f112ek.datamatrix.payType">
                                <option value="0">на адрес физического лица</option>
                                <option value="1">до востребовани</option>
                                <option value="2">на расчетный счет</option>
                                <option value="3" selected="selected">на федерального получателя</option>
                                <option value="4">на регионального получателя</option>
                                <option value="5">на адрес юридического лица</option>
                            </select>
                        </td>
                        <td>на адрес физического лица</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип отправителя перевода</b>
                        </td>
                        <td id="russianpost_f112ek_datamatrix_senderPayType_value">
                            <select id="russianpost_f112ek_datamatrix_senderPayType" name="russianpost.f112ek.datamatrix.senderPayType">
                                <option value="0" selected="selected">наличными от физического лица</option>
                                <option value="1">платежный документ</option>
                                <option value="2">с адреса организации наличными</option>
                                <option value="3">от регионального отправителя</option>
                            </select>
                        </td>
                        <td>наличными от физического лица</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН получателя</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="При rpo=1 в это поле вместо ИНН записывается идентификатор Федерального Получателя в ЕСПП в формате данного ТУ" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f112ek_datamatrix_inn_value">
                            <input id="russianpost_f112ek_datamatrix_inn" class="span6" placeholder="" type="text" value="" name="russianpost.f112ek.datamatrix.inn"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>БИК банка получателя</b>
                        </td>
                        <td id="russianpost_f112ek_datamatrix_bik_value">
                            <input id="russianpost_f112ek_datamatrix_bik" class="span6" placeholder="" type="text" value="" name="russianpost.f112ek.datamatrix.bik"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Расчетный счет получателя</b>
                        </td>
                        <td id="russianpost_f112ek_datamatrix_raschet_value">
                            <input id="russianpost_f112ek_datamatrix_raschet" class="span6" placeholder="" type="text" value="" name="russianpost.f112ek.datamatrix.raschet"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Корреспондентский счет банка получателя</b>
                        </td>
                        <td id="russianpost_f112ek_datamatrix_korRaschet_value">
                            <input id="russianpost_f112ek_datamatrix_korRaschet" class="span6" placeholder="" type="text" value="" name="russianpost.f112ek.datamatrix.korRaschet"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование банка получателя</b>
                        </td>
                        <td id="russianpost_f112ek_datamatrix_bankName_value">
                            <input id="russianpost_f112ek_datamatrix_bankName" class="span6" placeholder="" type="text" value="" name="russianpost.f112ek.datamatrix.bankName"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ШПИ РПО с наложенным платежом</b>
                        </td>
                        <td id="russianpost_f112ek_datamatrix_cod_value">
                            <select id="russianpost_f112ek_datamatrix_cod" name="russianpost.f112ek.datamatrix.cod">
                                <option value="0">перевод не наложенного платежа</option>
                                <option value="1" selected="selected">перевод наложенного платежа</option>
                            </select>
                        </td>
                        <td>перевод наложенного платежа</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Форма 112 эп (наложка)</div>
        <div class="spoiler-body collapse in" id="lv-postblank-f112ep" style="" aria-expanded="true">
            <table id="lv-config-table-f112ep" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Форма 112 эп (наложка)»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Форма 112 эп (наложка)»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f112ep_use_value">
                            <input id="ytrussianpost_f112ep_use" type="hidden" value="0" name="russianpost.f112ep.use">
                            <input id="russianpost_f112ep_use" type="checkbox" value="1" name="russianpost.f112ep.use"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Получатель перевода</b>
                        </td>
                        <td id="russianpost_f112ep_receiver_value">
                            <input id="russianpost_f112ep_receiver" class="span6" placeholder="" type="text" value="Дашков Анатолий Алексеевич" name="russianpost.f112ep.receiver"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер телефона получателя перевода</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Чтобы номер телефона не отображался на бланке, оставьте поле пустым. Вводите без пробелов, начиная с 7, без знака +" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f112ep_receiver_phone_value">
                            <input id="russianpost_f112ep_receiver_phone" class="span6" placeholder="" type="text" value="" name="russianpost.f112ep.receiver.phone"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Адрес получателя перевода</b>
                        </td>
                        <td id="russianpost_f112ep_receiver_to_value">
                            <input id="russianpost_f112ep_receiver_to" class="span6" placeholder="" type="text" value="Московская область, г. Москва, 105118, до востребования" name="russianpost.f112ep.receiver.to"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс получателя перевода</b>
                        </td>
                        <td id="russianpost_f112ep_receiver_postIndex_value">
                            <input id="russianpost_f112ep_receiver_postIndex" class="span6" placeholder="" type="text" value="105118" name="russianpost.f112ep.receiver.postIndex"> </td>
                        <td>123456</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН получателя перевода</b>
                        </td>
                        <td id="russianpost_f112ep_ul_inn_value">
                            <input id="russianpost_f112ep_ul_inn" class="span6" placeholder="" type="text" value="" name="russianpost.f112ep.ul.inn"> </td>
                        <td>1234567890</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Кор/счёт</b>
                        </td>
                        <td id="russianpost_f112ep_ul_kor_value">
                            <input id="russianpost_f112ep_ul_kor" class="span6" placeholder="" type="text" value="" name="russianpost.f112ep.ul.kor"> </td>
                        <td>12345678901234567890</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование банка</b>
                        </td>
                        <td id="russianpost_f112ep_ul_bankName_value">
                            <input id="russianpost_f112ep_ul_bankName" class="span6" placeholder="" type="text" value="" name="russianpost.f112ep.ul.bankName"> </td>
                        <td>Сбербанк России</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Расчетный счёт</b>
                        </td>
                        <td id="russianpost_f112ep_ul_raschet_value">
                            <input id="russianpost_f112ep_ul_raschet" class="span6" placeholder="" type="text" value="" name="russianpost.f112ep.ul.raschet"> </td>
                        <td>12345678901234567890</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>БИК</b>
                        </td>
                        <td id="russianpost_f112ep_ul_bik_value">
                            <input id="russianpost_f112ep_ul_bik" class="span6" placeholder="" type="text" value="" name="russianpost.f112ep.ul.bik"> </td>
                        <td>123456789</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Список ф.103 (реестр ПО)</div>
        <div class="spoiler-body collapse in" id="lv-postblank-f103" style="" aria-expanded="true">
            <table id="lv-config-table-f103" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Список ф.103 (реестр ПО)»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Список ф.103 (реестр ПО)»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103_use_value">
                            <input id="ytrussianpost_f103_use" type="hidden" value="0" name="russianpost.f103.use">
                            <input id="russianpost_f103_use" type="checkbox" value="1" name="russianpost.f103.use"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Заголовок</b>
                        </td>
                        <td id="russianpost_f103_caption_value">
                            <input id="russianpost_f103_caption" class="span6" placeholder="" type="text" value="БАНДЕРОЛЬ" name="russianpost.f103.caption"> </td>
                        <td>БАНДЕРОЛЬ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_f103_from_name_value">
                            <input id="russianpost_f103_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.f103.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места отправления</b>
                        </td>
                        <td id="russianpost_f103_from_postIndex_value">
                            <input id="russianpost_f103_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.f103.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: простая</b>
                        </td>
                        <td id="russianpost_f103_type_prostaya_value">
                            <input id="ytrussianpost_f103_type_prostaya" type="hidden" value="0" name="russianpost.f103.type.prostaya">
                            <input id="russianpost_f103_type_prostaya" type="checkbox" value="1" name="russianpost.f103.type.prostaya"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: заказная</b>
                        </td>
                        <td id="russianpost_f103_type_zakaznaya_value">
                            <input id="ytrussianpost_f103_type_zakaznaya" type="hidden" value="0" name="russianpost.f103.type.zakaznaya">
                            <input id="russianpost_f103_type_zakaznaya" type="checkbox" value="1" name="russianpost.f103.type.zakaznaya"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с описью</b>
                        </td>
                        <td id="russianpost_f103_type_s_opis_value">
                            <input id="ytrussianpost_f103_type_s_opis" type="hidden" value="0" name="russianpost.f103.type.s.opis">
                            <input id="russianpost_f103_type_s_opis" type="checkbox" value="1" name="russianpost.f103.type.s.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с объявленной ценностью</b>
                        </td>
                        <td id="russianpost_f103_type_ob_cennost_value">
                            <input id="ytrussianpost_f103_type_ob_cennost" type="hidden" value="0" name="russianpost.f103.type.ob.cennost">
                            <input id="russianpost_f103_type_ob_cennost" type="checkbox" value="1" name="russianpost.f103.type.ob.cennost"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с уведомлением</b>
                        </td>
                        <td id="russianpost_f103_type_s_uved_value">
                            <input id="ytrussianpost_f103_type_s_uved" type="hidden" value="0" name="russianpost.f103.type.s.uved">
                            <input id="russianpost_f103_type_s_uved" type="checkbox" value="1" name="russianpost.f103.type.s.uved"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип: с объявленной ценностью и наложенным платежом</b>
                        </td>
                        <td id="russianpost_f103_type_ob_cennost_naloj_value">
                            <input id="ytrussianpost_f103_type_ob_cennost_naloj" type="hidden" value="0" name="russianpost.f103.type.ob.cennost.naloj">
                            <input id="russianpost_f103_type_ob_cennost_naloj" checked="checked" type="checkbox" value="1" name="russianpost.f103.type.ob.cennost.naloj"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_f103_weight_product_value">
                            <input id="russianpost_f103_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.f103.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103_weight_package_value">
                            <input id="russianpost_f103_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.f103.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103_weight_custom_value">
                            <select id="russianpost_f103_weight_custom" name="russianpost.f103.weight.custom">
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
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Список ф.103 (реестр ПО) Посылка 1 класса</div>
        <div class="spoiler-body collapse in" id="lv-postblank-f103New" style="" aria-expanded="true">
            <table id="lv-config-table-f103New" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Список ф.103 (реестр ПО)»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Список ф.103 (реестр ПО)»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103New_use_value">
                            <input id="ytrussianpost_f103New_use" type="hidden" value="0" name="russianpost.f103New.use">
                            <input id="russianpost_f103New_use" type="checkbox" value="1" name="russianpost.f103New.use"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Заголовок</b>
                        </td>
                        <td id="russianpost_f103New_caption_value">
                            <input id="russianpost_f103New_caption" class="span6" placeholder="" type="text" value="БАНДЕРОЛЬ" name="russianpost.f103New.caption"> </td>
                        <td>БАНДЕРОЛЬ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_f103New_from_name_value">
                            <input id="russianpost_f103New_from_name" class="span6" placeholder="" type="text" value="" name="russianpost.f103New.from.name"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>E-mail</b>
                        </td>
                        <td id="russianpost_f103New_from_email_value">
                            <input id="russianpost_f103New_from_email" class="span6" placeholder="" type="text" value="" name="russianpost.f103New.from.email"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места отправления</b>
                        </td>
                        <td id="russianpost_f103New_from_postIndex_value">
                            <input id="russianpost_f103New_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.f103New.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование и индекс места приема:</b>
                        </td>
                        <td id="russianpost_f103New_from_receivePlace_value">
                            <input id="russianpost_f103New_from_receivePlace" class="span6" placeholder="" type="text" value="" name="russianpost.f103New.from.receivePlace"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_f103New_type_mailCtg_value">
                            <select id="russianpost_f103New_type_mailCtg" name="russianpost.f103New.type.mailCtg">
                                <option value="0">простое</option>
                                <option value="1">заказное</option>
                                <option value="2">с объявленной ценностью</option>
                                <option value="3" selected="selected">обыкновенное</option>
                                <option value="4">с объявленной ценностью и наложенным платежом</option>
                                <option value="5">не определена</option>
                                <option value="6">с объявленной ценностью и обязательным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_f103New_sender_transType_value">
                            <select id="russianpost_f103New_sender_transType" name="russianpost.f103New.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                                <option value="4">системой ускоренной почты</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_f103New_sender_date_value">
                            <select id="russianpost_f103New_sender_date" name="russianpost.f103New.sender.date">
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
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103New_weight_value">
                            <input id="ytrussianpost_f103New_weight" type="hidden" value="0" name="russianpost.f103New.weight">
                            <input id="russianpost_f103New_weight" type="checkbox" value="1" name="russianpost.f103New.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_f103New_weight_product_value">
                            <input id="russianpost_f103New_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.f103New.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103New_weight_package_value">
                            <input id="russianpost_f103New_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.f103New.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103New_weight_custom_value">
                            <select id="russianpost_f103New_weight_custom" name="russianpost.f103New.weight.custom">
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
                            <b>Проверка соответствия вложения описи ф.107</b>
                        </td>
                        <td id="russianpost_f103New_check_opis_value">
                            <input id="ytrussianpost_f103New_check_opis" type="hidden" value="0" name="russianpost.f103New.check.opis">
                            <input id="russianpost_f103New_check_opis" type="checkbox" value="1" name="russianpost.f103New.check.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_f103New_check_opis_region_value">
                            <select id="russianpost_f103New_check_opis_region" name="russianpost.f103New.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении (Без НДС)</b>
                        </td>
                        <td id="russianpost_f103New_check_opis_fixedValue_value">
                            <input id="russianpost_f103New_check_opis_fixedValue" class="span6" placeholder="" type="text" value="" name="russianpost.f103New.check.opis.fixedValue"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении (С НДС)</b>
                        </td>
                        <td id="russianpost_f103New_check_opis_fixedValueNDS_value">
                            <input id="russianpost_f103New_check_opis_fixedValueNDS" class="span6" placeholder="" type="text" value="" name="russianpost.f103New.check.opis.fixedValueNDS"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип уведомления</b>
                        </td>
                        <td id="russianpost_f103New_notice_type_value">
                            <select id="russianpost_f103New_notice_type" name="russianpost.f103New.notice.type">
                                <option value="0" selected="selected">Не использовать уведомление</option>
                                <option value="1">простое уведомление о вручение</option>
                                <option value="2">заказное уведомление о вручении</option>
                                <option value="3">«SMS-уведомление о поступлении РПО в адресное ОПС» на номер мобильного телефона адресата</option>
                                <option value="4">электронное уведомление</option>
                            </select>
                        </td>
                        <td>Не использовать уведомление</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Услуга SMS-уведомление</b>
                        </td>
                        <td id="russianpost_f103New_sms_notice_value">
                            <input id="ytrussianpost_f103New_sms_notice" type="hidden" value="0" name="russianpost.f103New.sms.notice">
                            <input id="russianpost_f103New_sms_notice" type="checkbox" value="1" name="russianpost.f103New.sms.notice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr style="display: none;">
                        <td>
                            <b>Номер телефона для SMS-уведомлений</b>
                        </td>
                        <td id="russianpost_f103New_sms_phone_value">
                            <input id="russianpost_f103New_sms_phone" class="span6" placeholder="" type="text" value="" name="russianpost.f103New.sms.phone"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr style="display: none;">
                        <td>
                            <b>SMS-уведомление о вручении РПО</b>
                        </td>
                        <td id="russianpost_f103New_sms_ofDelivery_value">
                            <input id="ytrussianpost_f103New_sms_ofDelivery" type="hidden" value="0" name="russianpost.f103New.sms.ofDelivery">
                            <input id="russianpost_f103New_sms_ofDelivery" type="checkbox" value="1" name="russianpost.f103New.sms.ofDelivery"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr style="display: none;">
                        <td>
                            <b>SMS-уведомление о поступлении РПО в адресное ОПС</b>
                        </td>
                        <td id="russianpost_f103New_sms_ops_value">
                            <input id="ytrussianpost_f103New_sms_ops" type="hidden" value="0" name="russianpost.f103New.sms.ops">
                            <input id="russianpost_f103New_sms_ops" type="checkbox" value="1" name="russianpost.f103New.sms.ops"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103New_comment_value">
                            <select id="russianpost_f103New_comment" name="russianpost.f103New.comment">
                                <option value="0" selected="selected">Текст примечания вручную</option>
                                <option value="16">Наименования товаров</option>
                                <option value="17">Алиасы товаров</option>
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
                            </select>
                        </td>
                        <td>Текст примечания вручную</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103New_comment_text_value">
                            <input id="russianpost_f103New_comment_text" class="span6" placeholder="" type="text" value="" name="russianpost.f103New.comment.text"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_f103New_rtm_version_value">
                            <input id="russianpost_f103New_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.f103New.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103New_list_number_value">
                            <input id="russianpost_f103New_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.f103New.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать уникальный номер списка партионной почты в день сдачи списка</b>
                        </td>
                        <td id="russianpost_f103New_list_number_user_value">
                            <input id="ytrussianpost_f103New_list_number_user" type="hidden" value="0" name="russianpost.f103New.list.number.user">
                            <input id="russianpost_f103New_list_number_user" checked="checked" type="checkbox" value="1" name="russianpost.f103New.list.number.user"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать заголовок только на первой странице</b>
                        </td>
                        <td id="russianpost_f103New_headers_value">
                            <input id="ytrussianpost_f103New_headers" type="hidden" value="0" name="russianpost.f103New.headers">
                            <input id="russianpost_f103New_headers" type="checkbox" value="1" name="russianpost.f103New.headers"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Список ф.103 (реестр ПО) Посылка онлайн</div>
        <div class="spoiler-body collapse in" id="lv-postblank-f103ParcelOnline" style="" aria-expanded="true">
            <table id="lv-config-table-f103ParcelOnline" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Список ф.103 (реестр ПО) Посылка онлайн»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Список ф.103 (реестр ПО) Посылка онлайн»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ParcelOnline_use_value">
                            <input id="ytrussianpost_f103ParcelOnline_use" type="hidden" value="0" name="russianpost.f103ParcelOnline.use">
                            <input id="russianpost_f103ParcelOnline_use" type="checkbox" value="1" name="russianpost.f103ParcelOnline.use"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Заголовок</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_caption_value">
                            <input id="russianpost_f103ParcelOnline_caption" class="span6" placeholder="" type="text" value="ПОСЫЛКА ОНЛАЙН" name="russianpost.f103ParcelOnline.caption"> </td>
                        <td>ПОСЫЛКА ОНЛАЙН</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_from_name_value">
                            <input id="russianpost_f103ParcelOnline_from_name" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelOnline.from.name"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>E-mail</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_from_email_value">
                            <input id="russianpost_f103ParcelOnline_from_email" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelOnline.from.email"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места отправления</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_from_postIndex_value">
                            <input id="russianpost_f103ParcelOnline_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelOnline.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование и индекс места приема:</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_from_receivePlace_value">
                            <input id="russianpost_f103ParcelOnline_from_receivePlace" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelOnline.from.receivePlace"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_type_mailCtg_value">
                            <select id="russianpost_f103ParcelOnline_type_mailCtg" name="russianpost.f103ParcelOnline.type.mailCtg">
                                <option value="0">простое</option>
                                <option value="1">заказное</option>
                                <option value="2">с объявленной ценностью</option>
                                <option value="3" selected="selected">обыкновенное</option>
                                <option value="4">с объявленной ценностью и наложенным платежом</option>
                                <option value="5">не определена</option>
                                <option value="6">с объявленной ценностью и обязательным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_sender_inn_value">
                            <input id="russianpost_f103ParcelOnline_sender_inn" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelOnline.sender.inn"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>КПП</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_sender_kpp_value">
                            <input id="russianpost_f103ParcelOnline_sender_kpp" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelOnline.sender.kpp"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Договор номер</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_sender_contract_value">
                            <input id="russianpost_f103ParcelOnline_sender_contract" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelOnline.sender.contract"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_sender_transType_value">
                            <select id="russianpost_f103ParcelOnline_sender_transType" name="russianpost.f103ParcelOnline.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                                <option value="4">системой ускоренной почты</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_sender_date_value">
                            <select id="russianpost_f103ParcelOnline_sender_date" name="russianpost.f103ParcelOnline.sender.date">
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
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_declaredValueFix_value">
                            <input id="russianpost_f103ParcelOnline_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelOnline.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ParcelOnline_weight_value">
                            <input id="ytrussianpost_f103ParcelOnline_weight" type="hidden" value="0" name="russianpost.f103ParcelOnline.weight">
                            <input id="russianpost_f103ParcelOnline_weight" type="checkbox" value="1" name="russianpost.f103ParcelOnline.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_weight_product_value">
                            <input id="russianpost_f103ParcelOnline_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.f103ParcelOnline.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ParcelOnline_weight_package_value">
                            <input id="russianpost_f103ParcelOnline_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.f103ParcelOnline.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ParcelOnline_weight_custom_value">
                            <select id="russianpost_f103ParcelOnline_weight_custom" name="russianpost.f103ParcelOnline.weight.custom">
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
                            <b>Проверка соответствия вложения описи ф.107</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_check_opis_value">
                            <input id="ytrussianpost_f103ParcelOnline_check_opis" type="hidden" value="0" name="russianpost.f103ParcelOnline.check.opis">
                            <input id="russianpost_f103ParcelOnline_check_opis" type="checkbox" value="1" name="russianpost.f103ParcelOnline.check.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_check_opis_region_value">
                            <select id="russianpost_f103ParcelOnline_check_opis_region" name="russianpost.f103ParcelOnline.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_check_opis_fixedValue_value">
                            <input id="russianpost_f103ParcelOnline_check_opis_fixedValue" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelOnline.check.opis.fixedValue"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении (С НДС)</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_check_opis_fixedValueNDS_value">
                            <input id="russianpost_f103ParcelOnline_check_opis_fixedValueNDS" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelOnline.check.opis.fixedValueNDS"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип уведомления</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_notice_type_value">
                            <select id="russianpost_f103ParcelOnline_notice_type" name="russianpost.f103ParcelOnline.notice.type">
                                <option value="0" selected="selected">Не использовать уведомление</option>
                                <option value="1">простое уведомление о вручение</option>
                                <option value="2">заказное уведомление о вручении</option>
                                <option value="3">«SMS-уведомление о поступлении РПО в адресное ОПС» на номер мобильного телефона адресата</option>
                                <option value="4">электронное уведомление</option>
                            </select>
                        </td>
                        <td>Не использовать уведомление</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Услуга SMS-уведомление</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_sms_notice_value">
                            <input id="ytrussianpost_f103ParcelOnline_sms_notice" type="hidden" value="0" name="russianpost.f103ParcelOnline.sms.notice">
                            <input id="russianpost_f103ParcelOnline_sms_notice" type="checkbox" value="1" name="russianpost.f103ParcelOnline.sms.notice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер телефона для SMS-уведомлений</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_sms_phone_value">
                            <input id="russianpost_f103ParcelOnline_sms_phone" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelOnline.sms.phone"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление о вручении РПО</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_sms_ofDelivery_value">
                            <input id="ytrussianpost_f103ParcelOnline_sms_ofDelivery" type="hidden" value="0" name="russianpost.f103ParcelOnline.sms.ofDelivery">
                            <input id="russianpost_f103ParcelOnline_sms_ofDelivery" type="checkbox" value="1" name="russianpost.f103ParcelOnline.sms.ofDelivery"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление о поступлении РПО в адресное ОПС</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_sms_ops_value">
                            <input id="ytrussianpost_f103ParcelOnline_sms_ops" type="hidden" value="0" name="russianpost.f103ParcelOnline.sms.ops">
                            <input id="russianpost_f103ParcelOnline_sms_ops" type="checkbox" value="1" name="russianpost.f103ParcelOnline.sms.ops"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_comment_value">
                            <select id="russianpost_f103ParcelOnline_comment" name="russianpost.f103ParcelOnline.comment">
                                <option value="0" selected="selected">Текст примечания вручную</option>
                                <option value="16">Наименования товаров</option>
                                <option value="17">Алиасы товаров</option>
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
                            </select>
                        </td>
                        <td>Текст примечания вручную</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_comment_text_value">
                            <input id="russianpost_f103ParcelOnline_comment_text" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelOnline.comment.text"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_rtm_version_value">
                            <input id="russianpost_f103ParcelOnline_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.f103ParcelOnline.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ParcelOnline_list_number_value">
                            <input id="russianpost_f103ParcelOnline_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.f103ParcelOnline.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать уникальный номер списка партионной почты в день сдачи списка</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_list_number_user_value">
                            <input id="ytrussianpost_f103ParcelOnline_list_number_user" type="hidden" value="0" name="russianpost.f103ParcelOnline.list.number.user">
                            <input id="russianpost_f103ParcelOnline_list_number_user" checked="checked" type="checkbox" value="1" name="russianpost.f103ParcelOnline.list.number.user"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать заголовок только на первой странице</b>
                        </td>
                        <td id="russianpost_f103ParcelOnline_headers_value">
                            <input id="ytrussianpost_f103ParcelOnline_headers" type="hidden" value="0" name="russianpost.f103ParcelOnline.headers">
                            <input id="russianpost_f103ParcelOnline_headers" type="checkbox" value="1" name="russianpost.f103ParcelOnline.headers"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Список ф.103 (реестр ПО) Ценная посылка</div>
        <div class="spoiler-body collapse in" id="lv-postblank-f103Parcel" style="" aria-expanded="true">
            <table id="lv-config-table-f103Parcel" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Список ф.103 (реестр ПО) Ценная посылка»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Список ф.103 (реестр ПО) Ценная посылка»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103Parcel_use_value">
                            <input id="ytrussianpost_f103Parcel_use" type="hidden" value="0" name="russianpost.f103Parcel.use">
                            <input id="russianpost_f103Parcel_use" type="checkbox" value="1" name="russianpost.f103Parcel.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Заголовок</b>
                        </td>
                        <td id="russianpost_f103Parcel_caption_value">
                            <input id="russianpost_f103Parcel_caption" class="span6" placeholder="" type="text" value="ЦЕННАЯ ПОСЫЛКА" name="russianpost.f103Parcel.caption"> </td>
                        <td>ЦЕННАЯ ПОСЫЛКА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_f103Parcel_from_name_value">
                            <input id="russianpost_f103Parcel_from_name" class="span6" placeholder="" type="text" value="" name="russianpost.f103Parcel.from.name"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>E-mail</b>
                        </td>
                        <td id="russianpost_f103Parcel_from_email_value">
                            <input id="russianpost_f103Parcel_from_email" class="span6" placeholder="" type="text" value="" name="russianpost.f103Parcel.from.email"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места отправления</b>
                        </td>
                        <td id="russianpost_f103Parcel_from_postIndex_value">
                            <input id="russianpost_f103Parcel_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.f103Parcel.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование и индекс места приема:</b>
                        </td>
                        <td id="russianpost_f103Parcel_from_receivePlace_value">
                            <input id="russianpost_f103Parcel_from_receivePlace" class="span6" placeholder="" type="text" value="" name="russianpost.f103Parcel.from.receivePlace"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_f103Parcel_type_mailCtg_value">
                            <select id="russianpost_f103Parcel_type_mailCtg" name="russianpost.f103Parcel.type.mailCtg">
                                <option value="0">простое</option>
                                <option value="1">заказное</option>
                                <option value="2">с объявленной ценностью</option>
                                <option value="3" selected="selected">обыкновенное</option>
                                <option value="4">с объявленной ценностью и наложенным платежом</option>
                                <option value="5">не определена</option>
                                <option value="6">с объявленной ценностью и обязательным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН</b>
                        </td>
                        <td id="russianpost_f103Parcel_sender_inn_value">
                            <input id="russianpost_f103Parcel_sender_inn" class="span6" placeholder="" type="text" value="" name="russianpost.f103Parcel.sender.inn"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>КПП</b>
                        </td>
                        <td id="russianpost_f103Parcel_sender_kpp_value">
                            <input id="russianpost_f103Parcel_sender_kpp" class="span6" placeholder="" type="text" value="" name="russianpost.f103Parcel.sender.kpp"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Договор номер</b>
                        </td>
                        <td id="russianpost_f103Parcel_sender_contract_value">
                            <input id="russianpost_f103Parcel_sender_contract" class="span6" placeholder="" type="text" value="" name="russianpost.f103Parcel.sender.contract"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_f103Parcel_sender_transType_value">
                            <select id="russianpost_f103Parcel_sender_transType" name="russianpost.f103Parcel.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                                <option value="4">системой ускоренной почты</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_f103Parcel_sender_date_value">
                            <select id="russianpost_f103Parcel_sender_date" name="russianpost.f103Parcel.sender.date">
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
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103Parcel_weight_value">
                            <input id="ytrussianpost_f103Parcel_weight" type="hidden" value="0" name="russianpost.f103Parcel.weight">
                            <input id="russianpost_f103Parcel_weight" type="checkbox" value="1" name="russianpost.f103Parcel.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_f103Parcel_weight_product_value">
                            <input id="russianpost_f103Parcel_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.f103Parcel.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103Parcel_weight_package_value">
                            <input id="russianpost_f103Parcel_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.f103Parcel.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103Parcel_weight_custom_value">
                            <select id="russianpost_f103Parcel_weight_custom" name="russianpost.f103Parcel.weight.custom">
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
                            <b>Проверка соответствия вложения описи ф.107</b>
                        </td>
                        <td id="russianpost_f103Parcel_check_opis_value">
                            <input id="ytrussianpost_f103Parcel_check_opis" type="hidden" value="0" name="russianpost.f103Parcel.check.opis">
                            <input id="russianpost_f103Parcel_check_opis" type="checkbox" value="1" name="russianpost.f103Parcel.check.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_f103Parcel_check_opis_region_value">
                            <select id="russianpost_f103Parcel_check_opis_region" name="russianpost.f103Parcel.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении</b>
                        </td>
                        <td id="russianpost_f103Parcel_check_opis_fixedValue_value">
                            <input id="russianpost_f103Parcel_check_opis_fixedValue" class="span6" placeholder="" type="text" value="" name="russianpost.f103Parcel.check.opis.fixedValue"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении (С НДС)</b>
                        </td>
                        <td id="russianpost_f103Parcel_check_opis_fixedValueNDS_value">
                            <input id="russianpost_f103Parcel_check_opis_fixedValueNDS" class="span6" placeholder="" type="text" value="" name="russianpost.f103Parcel.check.opis.fixedValueNDS"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип уведомления</b>
                        </td>
                        <td id="russianpost_f103Parcel_notice_type_value">
                            <select id="russianpost_f103Parcel_notice_type" name="russianpost.f103Parcel.notice.type">
                                <option value="0" selected="selected">Не использовать уведомление</option>
                                <option value="1">простое уведомление о вручение</option>
                                <option value="2">заказное уведомление о вручении</option>
                                <option value="3">«SMS-уведомление о поступлении РПО в адресное ОПС» на номер мобильного телефона адресата</option>
                                <option value="4">электронное уведомление</option>
                            </select>
                        </td>
                        <td>Не использовать уведомление</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Услуга SMS-уведомление</b>
                        </td>
                        <td id="russianpost_f103Parcel_sms_notice_value">
                            <input id="ytrussianpost_f103Parcel_sms_notice" type="hidden" value="0" name="russianpost.f103Parcel.sms.notice">
                            <input id="russianpost_f103Parcel_sms_notice" type="checkbox" value="1" name="russianpost.f103Parcel.sms.notice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер телефона для SMS-уведомлений</b>
                        </td>
                        <td id="russianpost_f103Parcel_sms_phone_value">
                            <input id="russianpost_f103Parcel_sms_phone" class="span6" placeholder="" type="text" value="" name="russianpost.f103Parcel.sms.phone"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление о вручении РПО</b>
                        </td>
                        <td id="russianpost_f103Parcel_sms_ofDelivery_value">
                            <input id="ytrussianpost_f103Parcel_sms_ofDelivery" type="hidden" value="0" name="russianpost.f103Parcel.sms.ofDelivery">
                            <input id="russianpost_f103Parcel_sms_ofDelivery" type="checkbox" value="1" name="russianpost.f103Parcel.sms.ofDelivery"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление о поступлении РПО в адресное ОПС</b>
                        </td>
                        <td id="russianpost_f103Parcel_sms_ops_value">
                            <input id="ytrussianpost_f103Parcel_sms_ops" type="hidden" value="0" name="russianpost.f103Parcel.sms.ops">
                            <input id="russianpost_f103Parcel_sms_ops" type="checkbox" value="1" name="russianpost.f103Parcel.sms.ops"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103Parcel_comment_value">
                            <select id="russianpost_f103Parcel_comment" name="russianpost.f103Parcel.comment">
                                <option value="0" selected="selected">Текст примечания вручную</option>
                                <option value="16">Наименования товаров</option>
                                <option value="17">Алиасы товаров</option>
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
                            </select>
                        </td>
                        <td>Текст примечания вручную</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103Parcel_comment_text_value">
                            <input id="russianpost_f103Parcel_comment_text" class="span6" placeholder="" type="text" value="" name="russianpost.f103Parcel.comment.text"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_f103Parcel_rtm_version_value">
                            <input id="russianpost_f103Parcel_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.f103Parcel.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103Parcel_list_number_value">
                            <input id="russianpost_f103Parcel_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.f103Parcel.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать уникальный номер списка партионной почты в день сдачи списка</b>
                        </td>
                        <td id="russianpost_f103Parcel_list_number_user_value">
                            <input id="ytrussianpost_f103Parcel_list_number_user" type="hidden" value="0" name="russianpost.f103Parcel.list.number.user">
                            <input id="russianpost_f103Parcel_list_number_user" checked="checked" type="checkbox" value="1" name="russianpost.f103Parcel.list.number.user"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать заголовок только на первой странице</b>
                        </td>
                        <td id="russianpost_f103Parcel_headers_value">
                            <input id="ytrussianpost_f103Parcel_headers" type="hidden" value="0" name="russianpost.f103Parcel.headers">
                            <input id="russianpost_f103Parcel_headers" type="checkbox" value="1" name="russianpost.f103Parcel.headers"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Список ф.103 (реестр ПО) Ценная посылка без н/пл</div>
        <div class="spoiler-body collapse in" id="lv-postblank-f103ParcelNonp" style="" aria-expanded="true">
            <table id="lv-config-table-f103ParcelNonp" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Список ф.103 (реестр ПО) Ценная посылка без н/пл»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Список ф.103 (реестр ПО) Ценная посылка без н/пл»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ParcelNonp_use_value">
                            <input id="ytrussianpost_f103ParcelNonp_use" type="hidden" value="0" name="russianpost.f103ParcelNonp.use">
                            <input id="russianpost_f103ParcelNonp_use" type="checkbox" value="1" name="russianpost.f103ParcelNonp.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Заголовок</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_caption_value">
                            <input id="russianpost_f103ParcelNonp_caption" class="span6" placeholder="" type="text" value="ЦЕННАЯ ПОСЫЛКА" name="russianpost.f103ParcelNonp.caption"> </td>
                        <td>ЦЕННАЯ ПОСЫЛКА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_from_name_value">
                            <input id="russianpost_f103ParcelNonp_from_name" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelNonp.from.name"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>E-mail</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_from_email_value">
                            <input id="russianpost_f103ParcelNonp_from_email" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelNonp.from.email"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места отправления</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_from_postIndex_value">
                            <input id="russianpost_f103ParcelNonp_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelNonp.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование и индекс места приема:</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_from_receivePlace_value">
                            <input id="russianpost_f103ParcelNonp_from_receivePlace" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelNonp.from.receivePlace"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_type_mailCtg_value">
                            <select id="russianpost_f103ParcelNonp_type_mailCtg" name="russianpost.f103ParcelNonp.type.mailCtg">
                                <option value="0">простое</option>
                                <option value="1">заказное</option>
                                <option value="2" selected="selected">с объявленной ценностью</option>
                                <option value="3">обыкновенное</option>
                                <option value="5">не определена</option>
                            </select>
                        </td>
                        <td>с объявленной ценностью</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_sender_inn_value">
                            <input id="russianpost_f103ParcelNonp_sender_inn" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelNonp.sender.inn"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>КПП</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_sender_kpp_value">
                            <input id="russianpost_f103ParcelNonp_sender_kpp" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelNonp.sender.kpp"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Договор номер</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_sender_contract_value">
                            <input id="russianpost_f103ParcelNonp_sender_contract" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelNonp.sender.contract"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_sender_transType_value">
                            <select id="russianpost_f103ParcelNonp_sender_transType" name="russianpost.f103ParcelNonp.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                                <option value="4">системой ускоренной почты</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_sender_date_value">
                            <select id="russianpost_f103ParcelNonp_sender_date" name="russianpost.f103ParcelNonp.sender.date">
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
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_declaredValueFix_value">
                            <input id="russianpost_f103ParcelNonp_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelNonp.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ParcelNonp_weight_value">
                            <input id="ytrussianpost_f103ParcelNonp_weight" type="hidden" value="0" name="russianpost.f103ParcelNonp.weight">
                            <input id="russianpost_f103ParcelNonp_weight" type="checkbox" value="1" name="russianpost.f103ParcelNonp.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_weight_product_value">
                            <input id="russianpost_f103ParcelNonp_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.f103ParcelNonp.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ParcelNonp_weight_package_value">
                            <input id="russianpost_f103ParcelNonp_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.f103ParcelNonp.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ParcelNonp_weight_custom_value">
                            <select id="russianpost_f103ParcelNonp_weight_custom" name="russianpost.f103ParcelNonp.weight.custom">
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
                            <b>Проверка соответствия вложения описи ф.107</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_check_opis_value">
                            <input id="ytrussianpost_f103ParcelNonp_check_opis" type="hidden" value="0" name="russianpost.f103ParcelNonp.check.opis">
                            <input id="russianpost_f103ParcelNonp_check_opis" type="checkbox" value="1" name="russianpost.f103ParcelNonp.check.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_check_opis_region_value">
                            <select id="russianpost_f103ParcelNonp_check_opis_region" name="russianpost.f103ParcelNonp.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_check_opis_fixedValue_value">
                            <input id="russianpost_f103ParcelNonp_check_opis_fixedValue" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelNonp.check.opis.fixedValue"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении (С НДС)</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_check_opis_fixedValueNDS_value">
                            <input id="russianpost_f103ParcelNonp_check_opis_fixedValueNDS" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelNonp.check.opis.fixedValueNDS"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип уведомления</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_notice_type_value">
                            <select id="russianpost_f103ParcelNonp_notice_type" name="russianpost.f103ParcelNonp.notice.type">
                                <option value="0" selected="selected">Не использовать уведомление</option>
                                <option value="1">простое уведомление о вручение</option>
                                <option value="2">заказное уведомление о вручении</option>
                                <option value="3">«SMS-уведомление о поступлении РПО в адресное ОПС» на номер мобильного телефона адресата</option>
                                <option value="4">электронное уведомление</option>
                            </select>
                        </td>
                        <td>Не использовать уведомление</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Услуга SMS-уведомление</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_sms_notice_value">
                            <input id="ytrussianpost_f103ParcelNonp_sms_notice" type="hidden" value="0" name="russianpost.f103ParcelNonp.sms.notice">
                            <input id="russianpost_f103ParcelNonp_sms_notice" type="checkbox" value="1" name="russianpost.f103ParcelNonp.sms.notice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер телефона для SMS-уведомлений</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_sms_phone_value">
                            <input id="russianpost_f103ParcelNonp_sms_phone" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelNonp.sms.phone"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление о вручении РПО</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_sms_ofDelivery_value">
                            <input id="ytrussianpost_f103ParcelNonp_sms_ofDelivery" type="hidden" value="0" name="russianpost.f103ParcelNonp.sms.ofDelivery">
                            <input id="russianpost_f103ParcelNonp_sms_ofDelivery" type="checkbox" value="1" name="russianpost.f103ParcelNonp.sms.ofDelivery"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление о поступлении РПО в адресное ОПС</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_sms_ops_value">
                            <input id="ytrussianpost_f103ParcelNonp_sms_ops" type="hidden" value="0" name="russianpost.f103ParcelNonp.sms.ops">
                            <input id="russianpost_f103ParcelNonp_sms_ops" type="checkbox" value="1" name="russianpost.f103ParcelNonp.sms.ops"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_comment_value">
                            <select id="russianpost_f103ParcelNonp_comment" name="russianpost.f103ParcelNonp.comment">
                                <option value="0" selected="selected">Текст примечания вручную</option>
                                <option value="16">Доп. поле 16</option>
                                <option value="17">Доп. поле 17</option>
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
                        <td>Текст примечания вручную</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_comment_text_value">
                            <input id="russianpost_f103ParcelNonp_comment_text" class="span6" placeholder="" type="text" value="" name="russianpost.f103ParcelNonp.comment.text"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_rtm_version_value">
                            <input id="russianpost_f103ParcelNonp_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.f103ParcelNonp.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ParcelNonp_list_number_value">
                            <input id="russianpost_f103ParcelNonp_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.f103ParcelNonp.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать уникальный номер списка партионной почты в день сдачи списка</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_list_number_user_value">
                            <input id="ytrussianpost_f103ParcelNonp_list_number_user" type="hidden" value="0" name="russianpost.f103ParcelNonp.list.number.user">
                            <input id="russianpost_f103ParcelNonp_list_number_user" checked="checked" type="checkbox" value="1" name="russianpost.f103ParcelNonp.list.number.user"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать заголовок только на первой странице</b>
                        </td>
                        <td id="russianpost_f103ParcelNonp_headers_value">
                            <input id="ytrussianpost_f103ParcelNonp_headers" type="hidden" value="0" name="russianpost.f103ParcelNonp.headers">
                            <input id="russianpost_f103ParcelNonp_headers" type="checkbox" value="1" name="russianpost.f103ParcelNonp.headers"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Список ф.103 (реестр ПО) Простая посылка</div>
        <div class="spoiler-body collapse in" id="lv-postblank-f103SimpleParcel" style="" aria-expanded="true">
            <table id="lv-config-table-f103SimpleParcel" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Список ф.103 (реестр ПО) Простая посылка»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Список ф.103 (реестр ПО) Простая посылка»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103SimpleParcel_use_value">
                            <input id="ytrussianpost_f103SimpleParcel_use" type="hidden" value="0" name="russianpost.f103SimpleParcel.use">
                            <input id="russianpost_f103SimpleParcel_use" type="checkbox" value="1" name="russianpost.f103SimpleParcel.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Заголовок</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_caption_value">
                            <input id="russianpost_f103SimpleParcel_caption" class="span6" placeholder="" type="text" value="ПОСЫЛКА" name="russianpost.f103SimpleParcel.caption"> </td>
                        <td>ПОСЫЛКА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_from_name_value">
                            <input id="russianpost_f103SimpleParcel_from_name" class="span6" placeholder="" type="text" value="" name="russianpost.f103SimpleParcel.from.name"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>E-mail</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_from_email_value">
                            <input id="russianpost_f103SimpleParcel_from_email" class="span6" placeholder="" type="text" value="" name="russianpost.f103SimpleParcel.from.email"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места отправления</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_from_postIndex_value">
                            <input id="russianpost_f103SimpleParcel_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.f103SimpleParcel.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование и индекс места приема:</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_from_receivePlace_value">
                            <input id="russianpost_f103SimpleParcel_from_receivePlace" class="span6" placeholder="" type="text" value="" name="russianpost.f103SimpleParcel.from.receivePlace"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_type_mailCtg_value">
                            <select id="russianpost_f103SimpleParcel_type_mailCtg" name="russianpost.f103SimpleParcel.type.mailCtg">
                                <option value="3" selected="selected">обыкновенное</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_sender_inn_value">
                            <input id="russianpost_f103SimpleParcel_sender_inn" class="span6" placeholder="" type="text" value="" name="russianpost.f103SimpleParcel.sender.inn"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>КПП</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_sender_kpp_value">
                            <input id="russianpost_f103SimpleParcel_sender_kpp" class="span6" placeholder="" type="text" value="" name="russianpost.f103SimpleParcel.sender.kpp"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Договор номер</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_sender_contract_value">
                            <input id="russianpost_f103SimpleParcel_sender_contract" class="span6" placeholder="" type="text" value="" name="russianpost.f103SimpleParcel.sender.contract"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_sender_transType_value">
                            <select id="russianpost_f103SimpleParcel_sender_transType" name="russianpost.f103SimpleParcel.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                                <option value="4">системой ускоренной почты</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_sender_date_value">
                            <select id="russianpost_f103SimpleParcel_sender_date" name="russianpost.f103SimpleParcel.sender.date">
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
                            <b>Упаковка</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_package_value">
                            <select id="russianpost_f103SimpleParcel_package" name="russianpost.f103SimpleParcel.package">
                                <option value="10" selected="selected">Коробка «S»</option>
                                <option value="11">Пакет полиэтиленовый «S»</option>
                                <option value="12">Конверт с воздушно-пузырчатой пленкой «S»</option>
                                <option value="20">Коробка «М»</option>
                                <option value="21">Пакет полиэтиленовый «М»</option>
                                <option value="22">Конверт с воздушно-пузырчатой пленкой «М»</option>
                                <option value="30">Коробка «L»</option>
                                <option value="31">Пакет полиэтиленовый «L»</option>
                                <option value="40">Коробка «ХL»</option>
                                <option value="41">Пакет полиэтиленовый «ХL»</option>
                            </select>
                        </td>
                        <td>Коробка «S»</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103SimpleParcel_weight_value">
                            <input id="ytrussianpost_f103SimpleParcel_weight" type="hidden" value="0" name="russianpost.f103SimpleParcel.weight">
                            <input id="russianpost_f103SimpleParcel_weight" type="checkbox" value="1" name="russianpost.f103SimpleParcel.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_weight_product_value">
                            <input id="russianpost_f103SimpleParcel_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.f103SimpleParcel.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103SimpleParcel_weight_package_value">
                            <input id="russianpost_f103SimpleParcel_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.f103SimpleParcel.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103SimpleParcel_weight_custom_value">
                            <select id="russianpost_f103SimpleParcel_weight_custom" name="russianpost.f103SimpleParcel.weight.custom">
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
                            <b>Проверка соответствия вложения описи ф.107</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_check_opis_value">
                            <input id="ytrussianpost_f103SimpleParcel_check_opis" type="hidden" value="0" name="russianpost.f103SimpleParcel.check.opis">
                            <input id="russianpost_f103SimpleParcel_check_opis" type="checkbox" value="1" name="russianpost.f103SimpleParcel.check.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_check_opis_region_value">
                            <select id="russianpost_f103SimpleParcel_check_opis_region" name="russianpost.f103SimpleParcel.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_check_opis_fixedValue_value">
                            <input id="russianpost_f103SimpleParcel_check_opis_fixedValue" class="span6" placeholder="" type="text" value="" name="russianpost.f103SimpleParcel.check.opis.fixedValue"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении (С НДС)</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_check_opis_fixedValueNDS_value">
                            <input id="russianpost_f103SimpleParcel_check_opis_fixedValueNDS" class="span6" placeholder="" type="text" value="" name="russianpost.f103SimpleParcel.check.opis.fixedValueNDS"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип уведомления</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_notice_type_value">
                            <select id="russianpost_f103SimpleParcel_notice_type" name="russianpost.f103SimpleParcel.notice.type">
                                <option value="0" selected="selected">Не использовать уведомление</option>
                                <option value="1">простое уведомление о вручение</option>
                                <option value="2">заказное уведомление о вручении</option>
                                <option value="3">«SMS-уведомление о поступлении РПО в адресное ОПС» на номер мобильного телефона адресата</option>
                                <option value="4">электронное уведомление</option>
                            </select>
                        </td>
                        <td>Не использовать уведомление</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Услуга SMS-уведомление</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_sms_notice_value">
                            <input id="ytrussianpost_f103SimpleParcel_sms_notice" type="hidden" value="0" name="russianpost.f103SimpleParcel.sms.notice">
                            <input id="russianpost_f103SimpleParcel_sms_notice" type="checkbox" value="1" name="russianpost.f103SimpleParcel.sms.notice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер телефона для SMS-уведомлений</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_sms_phone_value">
                            <input id="russianpost_f103SimpleParcel_sms_phone" class="span6" placeholder="" type="text" value="" name="russianpost.f103SimpleParcel.sms.phone"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление о вручении РПО</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_sms_ofDelivery_value">
                            <input id="ytrussianpost_f103SimpleParcel_sms_ofDelivery" type="hidden" value="0" name="russianpost.f103SimpleParcel.sms.ofDelivery">
                            <input id="russianpost_f103SimpleParcel_sms_ofDelivery" type="checkbox" value="1" name="russianpost.f103SimpleParcel.sms.ofDelivery"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление о поступлении РПО в адресное ОПС</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_sms_ops_value">
                            <input id="ytrussianpost_f103SimpleParcel_sms_ops" type="hidden" value="0" name="russianpost.f103SimpleParcel.sms.ops">
                            <input id="russianpost_f103SimpleParcel_sms_ops" type="checkbox" value="1" name="russianpost.f103SimpleParcel.sms.ops"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_comment_value">
                            <select id="russianpost_f103SimpleParcel_comment" name="russianpost.f103SimpleParcel.comment">
                                <option value="0" selected="selected">Текст примечания вручную</option>
                                <option value="16">Наименования товаров</option>
                                <option value="17">Алиасы товаров</option>
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
                            </select>
                        </td>
                        <td>Текст примечания вручную</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_comment_text_value">
                            <input id="russianpost_f103SimpleParcel_comment_text" class="span6" placeholder="" type="text" value="" name="russianpost.f103SimpleParcel.comment.text"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_rtm_version_value">
                            <input id="russianpost_f103SimpleParcel_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.f103SimpleParcel.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103SimpleParcel_list_number_value">
                            <input id="russianpost_f103SimpleParcel_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.f103SimpleParcel.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать уникальный номер списка партионной почты в день сдачи списка</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_list_number_user_value">
                            <input id="ytrussianpost_f103SimpleParcel_list_number_user" type="hidden" value="0" name="russianpost.f103SimpleParcel.list.number.user">
                            <input id="russianpost_f103SimpleParcel_list_number_user" checked="checked" type="checkbox" value="1" name="russianpost.f103SimpleParcel.list.number.user"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать заголовок только на первой странице</b>
                        </td>
                        <td id="russianpost_f103SimpleParcel_headers_value">
                            <input id="ytrussianpost_f103SimpleParcel_headers" type="hidden" value="0" name="russianpost.f103SimpleParcel.headers">
                            <input id="russianpost_f103SimpleParcel_headers" type="checkbox" value="1" name="russianpost.f103SimpleParcel.headers"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Список ф.103 (реестр ПО) Ценная бандероль</div>
        <div class="spoiler-body collapse in" id="lv-postblank-f103ValuablePackage" style="" aria-expanded="true">
            <table id="lv-config-table-f103ValuablePackage" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Список ф.103 (реестр ПО) Ценная бандероль»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Список ф.103 (реестр ПО) Ценная бандероль»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ValuablePackage_use_value">
                            <input id="ytrussianpost_f103ValuablePackage_use" type="hidden" value="0" name="russianpost.f103ValuablePackage.use">
                            <input id="russianpost_f103ValuablePackage_use" type="checkbox" value="1" name="russianpost.f103ValuablePackage.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Заголовок</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_caption_value">
                            <input id="russianpost_f103ValuablePackage_caption" class="span6" placeholder="" type="text" value="БАНДЕРОЛЬ" name="russianpost.f103ValuablePackage.caption"> </td>
                        <td>БАНДЕРОЛЬ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_from_name_value">
                            <input id="russianpost_f103ValuablePackage_from_name" class="span6" placeholder="" type="text" value="" name="russianpost.f103ValuablePackage.from.name"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>E-mail</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_from_email_value">
                            <input id="russianpost_f103ValuablePackage_from_email" class="span6" placeholder="" type="text" value="" name="russianpost.f103ValuablePackage.from.email"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места отправления</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_from_postIndex_value">
                            <input id="russianpost_f103ValuablePackage_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.f103ValuablePackage.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование и индекс места приема:</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_from_receivePlace_value">
                            <input id="russianpost_f103ValuablePackage_from_receivePlace" class="span6" placeholder="" type="text" value="" name="russianpost.f103ValuablePackage.from.receivePlace"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_type_mailCtg_value">
                            <select id="russianpost_f103ValuablePackage_type_mailCtg" name="russianpost.f103ValuablePackage.type.mailCtg">
                                <option value="2" selected="selected">с объявленной ценностью</option>
                                <option value="4">с объявленной ценностью и наложенным платежом</option>
                            </select>
                        </td>
                        <td>с объявленной ценностью</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_sender_transType_value">
                            <select id="russianpost_f103ValuablePackage_sender_transType" name="russianpost.f103ValuablePackage.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_sender_date_value">
                            <select id="russianpost_f103ValuablePackage_sender_date" name="russianpost.f103ValuablePackage.sender.date">
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
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ValuablePackage_weight_value">
                            <input id="ytrussianpost_f103ValuablePackage_weight" type="hidden" value="0" name="russianpost.f103ValuablePackage.weight">
                            <input id="russianpost_f103ValuablePackage_weight" type="checkbox" value="1" name="russianpost.f103ValuablePackage.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_weight_product_value">
                            <input id="russianpost_f103ValuablePackage_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.f103ValuablePackage.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ValuablePackage_weight_package_value">
                            <input id="russianpost_f103ValuablePackage_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.f103ValuablePackage.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ValuablePackage_weight_custom_value">
                            <select id="russianpost_f103ValuablePackage_weight_custom" name="russianpost.f103ValuablePackage.weight.custom">
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
                            <b>Проверка соответствия вложения описи ф.107</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_check_opis_value">
                            <input id="ytrussianpost_f103ValuablePackage_check_opis" type="hidden" value="0" name="russianpost.f103ValuablePackage.check.opis">
                            <input id="russianpost_f103ValuablePackage_check_opis" type="checkbox" value="1" name="russianpost.f103ValuablePackage.check.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_check_opis_region_value">
                            <select id="russianpost_f103ValuablePackage_check_opis_region" name="russianpost.f103ValuablePackage.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_check_opis_fixedValue_value">
                            <input id="russianpost_f103ValuablePackage_check_opis_fixedValue" class="span6" placeholder="" type="text" value="" name="russianpost.f103ValuablePackage.check.opis.fixedValue"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении (С НДС)</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_check_opis_fixedValueNDS_value">
                            <input id="russianpost_f103ValuablePackage_check_opis_fixedValueNDS" class="span6" placeholder="" type="text" value="" name="russianpost.f103ValuablePackage.check.opis.fixedValueNDS"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип уведомления</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_notice_type_value">
                            <select id="russianpost_f103ValuablePackage_notice_type" name="russianpost.f103ValuablePackage.notice.type">
                                <option value="0" selected="selected">Не использовать уведомление</option>
                                <option value="1">простое уведомление о вручение</option>
                                <option value="2">заказное уведомление о вручении</option>
                                <option value="3">«SMS-уведомление о поступлении РПО в адресное ОПС» на номер мобильного телефона адресата</option>
                                <option value="4">электронное уведомление</option>
                            </select>
                        </td>
                        <td>Не использовать уведомление</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Услуга SMS-уведомление</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_sms_notice_value">
                            <input id="ytrussianpost_f103ValuablePackage_sms_notice" type="hidden" value="0" name="russianpost.f103ValuablePackage.sms.notice">
                            <input id="russianpost_f103ValuablePackage_sms_notice" type="checkbox" value="1" name="russianpost.f103ValuablePackage.sms.notice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер телефона для SMS-уведомлений</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_sms_phone_value">
                            <input id="russianpost_f103ValuablePackage_sms_phone" class="span6" placeholder="" type="text" value="" name="russianpost.f103ValuablePackage.sms.phone"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление о вручении РПО</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_sms_ofDelivery_value">
                            <input id="ytrussianpost_f103ValuablePackage_sms_ofDelivery" type="hidden" value="0" name="russianpost.f103ValuablePackage.sms.ofDelivery">
                            <input id="russianpost_f103ValuablePackage_sms_ofDelivery" type="checkbox" value="1" name="russianpost.f103ValuablePackage.sms.ofDelivery"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление о поступлении РПО в адресное ОПС</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_sms_ops_value">
                            <input id="ytrussianpost_f103ValuablePackage_sms_ops" type="hidden" value="0" name="russianpost.f103ValuablePackage.sms.ops">
                            <input id="russianpost_f103ValuablePackage_sms_ops" type="checkbox" value="1" name="russianpost.f103ValuablePackage.sms.ops"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_comment_value">
                            <select id="russianpost_f103ValuablePackage_comment" name="russianpost.f103ValuablePackage.comment">
                                <option value="0" selected="selected">Текст примечания вручную</option>
                                <option value="16">Наименования товаров</option>
                                <option value="17">Алиасы товаров</option>
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
                            </select>
                        </td>
                        <td>Текст примечания вручную</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_comment_text_value">
                            <input id="russianpost_f103ValuablePackage_comment_text" class="span6" placeholder="" type="text" value="" name="russianpost.f103ValuablePackage.comment.text"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_rtm_version_value">
                            <input id="russianpost_f103ValuablePackage_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.f103ValuablePackage.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103ValuablePackage_list_number_value">
                            <input id="russianpost_f103ValuablePackage_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.f103ValuablePackage.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать уникальный номер списка партионной почты в день сдачи списка</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_list_number_user_value">
                            <input id="ytrussianpost_f103ValuablePackage_list_number_user" type="hidden" value="0" name="russianpost.f103ValuablePackage.list.number.user">
                            <input id="russianpost_f103ValuablePackage_list_number_user" checked="checked" type="checkbox" value="1" name="russianpost.f103ValuablePackage.list.number.user"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать заголовок только на первой странице</b>
                        </td>
                        <td id="russianpost_f103ValuablePackage_headers_value">
                            <input id="ytrussianpost_f103ValuablePackage_headers" type="hidden" value="0" name="russianpost.f103ValuablePackage.headers">
                            <input id="russianpost_f103ValuablePackage_headers" type="checkbox" value="1" name="russianpost.f103ValuablePackage.headers"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Список ф.103 (реестр ПО) Письмо с объявленной ценностью и наложенным платежом</div>
        <div class="spoiler-body collapse in" id="lv-postblank-f103Letter" style="" aria-expanded="true">
            <table id="lv-config-table-f103Letter" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Список ф.103 (реестр ПО) Письмо с объявленной ценностью и наложенным платежом»</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Включает возможность использования бланка «Список ф.103 (реестр ПО) Письмо с объявленной ценностью и наложенным платежом»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103Letter_use_value">
                            <input id="ytrussianpost_f103Letter_use" type="hidden" value="0" name="russianpost.f103Letter.use">
                            <input id="russianpost_f103Letter_use" type="checkbox" value="1" name="russianpost.f103Letter.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Заголовок</b>
                        </td>
                        <td id="russianpost_f103Letter_caption_value">
                            <input id="russianpost_f103Letter_caption" class="span6" placeholder="" type="text" value="БАНДЕРОЛЬ" name="russianpost.f103Letter.caption"> </td>
                        <td>БАНДЕРОЛЬ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст «От кого»</b>
                        </td>
                        <td id="russianpost_f103Letter_from_name_value">
                            <input id="russianpost_f103Letter_from_name" class="span6" placeholder="" type="text" value="" name="russianpost.f103Letter.from.name"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>E-mail</b>
                        </td>
                        <td id="russianpost_f103Letter_from_email_value">
                            <input id="russianpost_f103Letter_from_email" class="span6" placeholder="" type="text" value="" name="russianpost.f103Letter.from.email"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс места отправления</b>
                        </td>
                        <td id="russianpost_f103Letter_from_postIndex_value">
                            <input id="russianpost_f103Letter_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.f103Letter.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование и индекс места приема:</b>
                        </td>
                        <td id="russianpost_f103Letter_from_receivePlace_value">
                            <input id="russianpost_f103Letter_from_receivePlace" class="span6" placeholder="" type="text" value="" name="russianpost.f103Letter.from.receivePlace"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_f103Letter_type_mailCtg_value">
                            <select id="russianpost_f103Letter_type_mailCtg" name="russianpost.f103Letter.type.mailCtg">
                                <option value="2" selected="selected">с объявленной ценностью</option>
                                <option value="4">с объявленной ценностью и наложенным платежом</option>
                            </select>
                        </td>
                        <td>с объявленной ценностью</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_f103Letter_sender_transType_value">
                            <select id="russianpost_f103Letter_sender_transType" name="russianpost.f103Letter.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_f103Letter_sender_date_value">
                            <select id="russianpost_f103Letter_sender_date" name="russianpost.f103Letter.sender.date">
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
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103Letter_weight_value">
                            <input id="ytrussianpost_f103Letter_weight" type="hidden" value="0" name="russianpost.f103Letter.weight">
                            <input id="russianpost_f103Letter_weight" type="checkbox" value="1" name="russianpost.f103Letter.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_f103Letter_weight_product_value">
                            <input id="russianpost_f103Letter_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.f103Letter.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103Letter_weight_package_value">
                            <input id="russianpost_f103Letter_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.f103Letter.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103Letter_weight_custom_value">
                            <select id="russianpost_f103Letter_weight_custom" name="russianpost.f103Letter.weight.custom">
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
                            <b>Проверка соответствия вложения описи ф.107</b>
                        </td>
                        <td id="russianpost_f103Letter_check_opis_value">
                            <input id="ytrussianpost_f103Letter_check_opis" type="hidden" value="0" name="russianpost.f103Letter.check.opis">
                            <input id="russianpost_f103Letter_check_opis" type="checkbox" value="1" name="russianpost.f103Letter.check.opis"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_f103Letter_check_opis_region_value">
                            <select id="russianpost_f103Letter_check_opis_region" name="russianpost.f103Letter.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении</b>
                        </td>
                        <td id="russianpost_f103Letter_check_opis_fixedValue_value">
                            <input id="russianpost_f103Letter_check_opis_fixedValue" class="span6" placeholder="" type="text" value="" name="russianpost.f103Letter.check.opis.fixedValue"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная стоимость описи в вашем отделении (С НДС)</b>
                        </td>
                        <td id="russianpost_f103Letter_check_opis_fixedValueNDS_value">
                            <input id="russianpost_f103Letter_check_opis_fixedValueNDS" class="span6" placeholder="" type="text" value="" name="russianpost.f103Letter.check.opis.fixedValueNDS"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип уведомления</b>
                        </td>
                        <td id="russianpost_f103Letter_notice_type_value">
                            <select id="russianpost_f103Letter_notice_type" name="russianpost.f103Letter.notice.type">
                                <option value="0" selected="selected">Не использовать уведомление</option>
                                <option value="1">простое уведомление о вручение</option>
                                <option value="2">заказное уведомление о вручении</option>
                                <option value="3">«SMS-уведомление о поступлении РПО в адресное ОПС» на номер мобильного телефона адресата</option>
                                <option value="4">электронное уведомление</option>
                            </select>
                        </td>
                        <td>Не использовать уведомление</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Услуга SMS-уведомление</b>
                        </td>
                        <td id="russianpost_f103Letter_sms_notice_value">
                            <input id="ytrussianpost_f103Letter_sms_notice" type="hidden" value="0" name="russianpost.f103Letter.sms.notice">
                            <input id="russianpost_f103Letter_sms_notice" type="checkbox" value="1" name="russianpost.f103Letter.sms.notice"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер телефона для SMS-уведомлений</b>
                        </td>
                        <td id="russianpost_f103Letter_sms_phone_value">
                            <input id="russianpost_f103Letter_sms_phone" class="span6" placeholder="" type="text" value="" name="russianpost.f103Letter.sms.phone"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление о вручении РПО</b>
                        </td>
                        <td id="russianpost_f103Letter_sms_ofDelivery_value">
                            <input id="ytrussianpost_f103Letter_sms_ofDelivery" type="hidden" value="0" name="russianpost.f103Letter.sms.ofDelivery">
                            <input id="russianpost_f103Letter_sms_ofDelivery" type="checkbox" value="1" name="russianpost.f103Letter.sms.ofDelivery"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление о поступлении РПО в адресное ОПС</b>
                        </td>
                        <td id="russianpost_f103Letter_sms_ops_value">
                            <input id="ytrussianpost_f103Letter_sms_ops" type="hidden" value="0" name="russianpost.f103Letter.sms.ops">
                            <input id="russianpost_f103Letter_sms_ops" type="checkbox" value="1" name="russianpost.f103Letter.sms.ops"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103Letter_comment_value">
                            <select id="russianpost_f103Letter_comment" name="russianpost.f103Letter.comment">
                                <option value="0" selected="selected">Текст примечания вручную</option>
                                <option value="16">Наименования товаров</option>
                                <option value="17">Алиасы товаров</option>
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
                            </select>
                        </td>
                        <td>Текст примечания вручную</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Текст в столбец "Примечание"</b>
                        </td>
                        <td id="russianpost_f103Letter_comment_text_value">
                            <input id="russianpost_f103Letter_comment_text" class="span6" placeholder="" type="text" value="" name="russianpost.f103Letter.comment.text"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_f103Letter_rtm_version_value">
                            <input id="russianpost_f103Letter_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.f103Letter.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_f103Letter_list_number_value">
                            <input id="russianpost_f103Letter_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.f103Letter.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать уникальный номер списка партионной почты в день сдачи списка</b>
                        </td>
                        <td id="russianpost_f103Letter_list_number_user_value">
                            <input id="ytrussianpost_f103Letter_list_number_user" type="hidden" value="0" name="russianpost.f103Letter.list.number.user">
                            <input id="russianpost_f103Letter_list_number_user" checked="checked" type="checkbox" value="1" name="russianpost.f103Letter.list.number.user"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Печатать заголовок только на первой странице</b>
                        </td>
                        <td id="russianpost_f103Letter_headers_value">
                            <input id="ytrussianpost_f103Letter_headers" type="hidden" value="0" name="russianpost.f103Letter.headers">
                            <input id="russianpost_f103Letter_headers" type="checkbox" value="1" name="russianpost.f103Letter.headers"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Файлы *.txt и *.ini (для реестра ПО) Посылка 1 класса</div>
        <div class="spoiler-body collapse in" id="lv-postblank-registry" style="" aria-expanded="true">
            <table id="lv-config-table-registry" class="table table-bordered table-forms">
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
                            <b>Включает возможность использования выгрузки заказов в *.txt и .ini файл (для реестра ПО)</b>
                        </td>
                        <td id="russianpost_registry_use_value">
                            <input id="ytrussianpost_registry_use" type="hidden" value="0" name="russianpost.registry.use">
                            <input id="russianpost_registry_use" type="checkbox" value="1" name="russianpost.registry.use"> </td>
                        <td>ДА</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Ф.И.О. отправителя</b>
                        </td>
                        <td id="russianpost_registry_from_name_value">
                            <input id="russianpost_registry_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.registry.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Телефон отправителя</b>
                        </td>
                        <td id="russianpost_registry_from_phone_value">
                            <input id="russianpost_registry_from_phone" class="span6" placeholder="" type="text" value="79888888888" name="russianpost.registry.from.phone"> </td>
                        <td>79888888888</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpost_registry_from_typeAddress_value">
                            <select id="russianpost_registry_from_typeAddress" name="russianpost.registry.from.typeAddress">
                                <option value="1" selected="selected">стандартный</option>
                                <option value="2">а/я</option>
                                <option value="3">до востребования</option>
                                <option value="4">гостиница</option>
                                <option value="5">войсковая часть</option>
                                <option value="6">войсковая часть ЮЯ</option>
                                <option value="7">полевая почта</option>
                            </select>
                        </td>
                        <td>стандартный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер абоненстого ящика</b>
                        </td>
                        <td id="russianpost_registry_from_POBox_value">
                            <input id="russianpost_registry_from_POBox" class="span6" placeholder="" type="text" value="" name="russianpost.registry.from.POBox"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс отправителя</b>
                        </td>
                        <td id="russianpost_registry_from_postIndex_value">
                            <input id="russianpost_registry_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.registry.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Область, регион отправителя</b>
                        </td>
                        <td id="russianpost_registry_from_region_value">
                            <input id="russianpost_registry_from_region" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registry.from.region"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Район отправителя</b>
                        </td>
                        <td id="russianpost_registry_from_area_value">
                            <input id="russianpost_registry_from_area" class="span6" placeholder="" type="text" value="" name="russianpost.registry.from.area"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Населенный пункт отправителя</b>
                        </td>
                        <td id="russianpost_registry_from_city_value">
                            <input id="russianpost_registry_from_city" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registry.from.city"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Внутригородской элемент</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Квартал, спутник, поселение, микрорайон, территория" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registry_from_location_value">
                            <input id="russianpost_registry_from_location" class="span6" placeholder="" type="text" value="" name="russianpost.registry.from.location"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование улицы отправителя</b>
                        </td>
                        <td id="russianpost_registry_from_street_value">
                            <input id="russianpost_registry_from_street" class="span6" placeholder="" type="text" value="Московская" name="russianpost.registry.from.street"> </td>
                        <td>Московская</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер здания</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно для заполнения при указании типов адреса: «стандартный», «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registry_from_house_value">
                            <input id="russianpost_registry_from_house" class="span6" placeholder="" type="text" value="" name="russianpost.registry.from.house"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Литера</b>
                        </td>
                        <td id="russianpost_registry_from_houseLetter_value">
                            <input id="russianpost_registry_from_houseLetter" class="span6" placeholder="" type="text" value="" name="russianpost.registry.from.houseLetter"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Дробь</b>
                        </td>
                        <td id="russianpost_registry_from_houseSlash_value">
                            <input id="russianpost_registry_from_houseSlash" class="span6" placeholder="" type="text" value="" name="russianpost.registry.from.houseSlash"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Корпус</b>
                        </td>
                        <td id="russianpost_registry_from_houseCorpus_value">
                            <input id="russianpost_registry_from_houseCorpus" class="span6" placeholder="" type="text" value="" name="russianpost.registry.from.houseCorpus"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Строение</b>
                        </td>
                        <td id="russianpost_registry_from_houseBuilding_value">
                            <input id="russianpost_registry_from_houseBuilding" class="span6" placeholder="" type="text" value="" name="russianpost.registry.from.houseBuilding"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Название гостиницы</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно при типе адреса: «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registry_from_hotel_value">
                            <input id="russianpost_registry_from_hotel" class="span6" placeholder="" type="text" value="" name="russianpost.registry.from.hotel"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Номер помещения</b>
                        </td>
                        <td id="russianpost_registry_from_hotelRoom_value">
                            <input id="russianpost_registry_from_hotelRoom" class="span6" placeholder="" type="text" value="" name="russianpost.registry.from.hotelRoom"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер контракта (договора)</b>
                        </td>
                        <td id="russianpost_registry_sender_numContract_value">
                            <input id="russianpost_registry_sender_numContract" class="span6" placeholder="" type="text" value="" name="russianpost.registry.sender.numContract"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН отправителя</b>
                        </td>
                        <td id="russianpost_registry_sender_inn_value">
                            <input id="russianpost_registry_sender_inn" class="span6" placeholder="" type="text" value="123456789012" name="russianpost.registry.sender.inn"> </td>
                        <td>123456789012</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>КПП отправителя</b>
                        </td>
                        <td id="russianpost_registry_sender_kpp_value">
                            <input id="russianpost_registry_sender_kpp" class="span6" placeholder="" type="text" value="" name="russianpost.registry.sender.kpp"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Индекс ОПС, откуда поступило внутреннее отправление" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registry_sender_indexOps_value">
                            <input id="russianpost_registry_sender_indexOps" class="span6" placeholder="" type="text" value="654321" name="russianpost.registry.sender.indexOps"> </td>
                        <td>654321</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ и форма оплаты услуг почтовой связи</b>
                        </td>
                        <td id="russianpost_registry_pay_type_value">
                            <select id="russianpost_registry_pay_type" name="russianpost.registry.pay.type">
                                <option value="1" selected="selected">наличная</option>
                                <option value="2">безналичная</option>
                                <option value="4">бесплатно</option>
                                <option value="8">пластиковая карта</option>
                                <option value="16">государственные знаки почтовой оплаты марками</option>
                                <option value="32">предоплата (авансовый платеж)</option>
                                <option value="64">оплачено международному оператору</option>
                                <option value="128">оплачивается получателем</option>
                                <option value="256">государственные знаки почтовой оплаты франкирование</option>
                            </select>
                        </td>
                        <td>наличная</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория отправителя</b>
                        </td>
                        <td id="russianpost_registry_sender_category_value">
                            <select id="russianpost_registry_sender_category" name="russianpost.registry.sender.category">
                                <option value="1" selected="selected">население</option>
                                <option value="2">бюджетная организация</option>
                                <option value="3">хозрасчетная организация</option>
                                <option value="4">международный оператор</option>
                                <option value="5">корпоративный клиент</option>
                                <option value="6">почтовый оператор</option>
                            </select>
                        </td>
                        <td>население</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вид почтового отправления</b>
                        </td>
                        <td id="russianpost_registry_sender_mailType_value">
                            <select id="russianpost_registry_sender_mailType" name="russianpost.registry.sender.mailType">
                                <option value="0">не определено</option>
                                <option value="1">бланк почтового перевода</option>
                                <option value="2">письмо</option>
                                <option value="3" selected="selected">бандероль</option>
                                <option value="4">посылка</option>
                                <option value="5">мелкий пакет</option>
                                <option value="6">почтовая карточка</option>
                                <option value="7">отправление EMS</option>
                                <option value="8">секограмма</option>
                                <option value="9">мешок «М»</option>
                                <option value="10">прямой контейнер</option>
                                <option value="11">отправление электронной почты</option>
                                <option value="12">бланк уведомления</option>
                                <option value="13">газетная пачка</option>
                                <option value="14">сгруппированные отправления «Консигнация»</option>
                                <option value="15">письмо 1 класса</option>
                                <option value="16">бандероль 1 класса</option>
                                <option value="17">бланк уведомления 1 класса</option>
                                <option value="18">сумка страховая</option>
                                <option value="19">ОВПО</option>
                                <option value="20">мультиконверт</option>
                                <option value="21">МКПО</option>
                                <option value="23">Посылка онлайн</option>
                                <option value="47">Посылка 1 класса</option>
                            </select>
                        </td>
                        <td>бандероль</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_registry_sender_mailCtg_value">
                            <select id="russianpost_registry_sender_mailCtg" name="russianpost.registry.sender.mailCtg">
                                <option value="0">простое</option>
                                <option value="1">заказное</option>
                                <option value="2">с объявленной ценностью</option>
                                <option value="3" selected="selected">обыкновенное</option>
                                <option value="4">с объявленной ценностью и наложенным платежом</option>
                                <option value="5">не определена</option>
                                <option value="6">с объявленной ценностью и обязательным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Классификация почтового отправления</b>
                        </td>
                        <td id="russianpost_registry_sender_directCtg_value">
                            <select id="russianpost_registry_sender_directCtg" name="russianpost.registry.sender.directCtg">
                                <option value="1" selected="selected">внутренняя</option>
                                <option value="2">международная</option>
                            </select>
                        </td>
                        <td>внутренняя</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_registry_sender_transType_value">
                            <select id="russianpost_registry_sender_transType" name="russianpost.registry.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка отправления</b>
                        </td>
                        <td id="russianpost_registry_sender_postMark_value">
                            <select id="russianpost_registry_sender_postMark" name="russianpost.registry.sender.postMark">
                                <option value="0">без отметки</option>
                                <option value="1" selected="selected">с простым уведомлением</option>
                                <option value="2">с заказным уведомлением</option>
                                <option value="4">с описью</option>
                                <option value="8">осторожно (хрупкая)</option>
                                <option value="16">тяжеловесная</option>
                                <option value="32">крупногабаритная (громоздкая)</option>
                                <option value="64">с доставкой (доставка нарочным)</option>
                                <option value="128">вручить в собственные руки</option>
                                <option value="256">с документами</option>
                                <option value="512">с товарами</option>
                                <option value="1024">возврату не подлежит</option>
                                <option value="2048">нестандартная</option>
                                <option value="4096">приграничная</option>
                                <option value="8192">застраховано</option>
                            </select>
                        </td>
                        <td>с простым уведомлением</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Разряд почтового отправления</b>
                        </td>
                        <td id="russianpost_registry_sender_mailRank_value">
                            <select id="russianpost_registry_sender_mailRank" name="russianpost.registry.sender.mailRank">
                                <option value="0" selected="selected">без разряда</option>
                                <option value="1">правительственное</option>
                                <option value="2">воинское</option>
                                <option value="3">служебное</option>
                                <option value="4">судебное</option>
                                <option value="5">президентское</option>
                                <option value="6">кредитное</option>
                            </select>
                        </td>
                        <td>без разряда</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="При отстуствии заказной услуги выбрать поле «не использовать»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registry_sender_notice_sms_value">
                            <select id="russianpost_registry_sender_notice_sms" name="russianpost.registry.sender.notice.sms">
                                <option value="0" selected="selected">не использовать</option>
                                <option value="1">SMS-уведомление о поступлении РПО в ОПС вручения</option>
                                <option value="2">SMS-уведомление о вручении РПО</option>
                            </select>
                        </td>
                        <td>не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_registry_check_opis_region_value">
                            <select id="russianpost_registry_check_opis_region" name="russianpost.registry.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registry_weight_value">
                            <input id="ytrussianpost_registry_weight" type="hidden" value="0" name="russianpost.registry.weight">
                            <input id="russianpost_registry_weight" type="checkbox" value="1" name="russianpost.registry.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_registry_weight_product_value">
                            <input id="russianpost_registry_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.registry.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registry_weight_package_value">
                            <input id="russianpost_registry_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.registry.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registry_weight_custom_value">
                            <select id="russianpost_registry_weight_custom" name="russianpost.registry.weight.custom">
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
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_registry_sender_date_value">
                            <select id="russianpost_registry_sender_date" name="russianpost.registry.sender.date">
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
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_registry_rtm_version_value">
                            <input id="russianpost_registry_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.registry.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registry_list_number_value">
                            <input id="russianpost_registry_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.registry.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Файлы *.txt и *.ini (для реестра ПО) Ценная бандероль</div>
        <div class="spoiler-body collapse in" id="lv-postblank-registryValuablePackage" style="" aria-expanded="true">
            <table id="lv-config-table-registryValuablePackage" class="table table-bordered table-forms">
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
                            <b>Включает возможность использования выгрузки заказов в *.txt и .ini файл (для реестра ПО) Ценная бандероль</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_use_value">
                            <input id="ytrussianpost_registryValuablePackage_use" type="hidden" value="0" name="russianpost.registryValuablePackage.use">
                            <input id="russianpost_registryValuablePackage_use" type="checkbox" value="1" name="russianpost.registryValuablePackage.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Ф.И.О. отправителя</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_name_value">
                            <input id="russianpost_registryValuablePackage_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.registryValuablePackage.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Телефон отправителя</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_phone_value">
                            <input id="russianpost_registryValuablePackage_from_phone" class="span6" placeholder="" type="text" value="79888888888" name="russianpost.registryValuablePackage.from.phone"> </td>
                        <td>79888888888</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_typeAddress_value">
                            <select id="russianpost_registryValuablePackage_from_typeAddress" name="russianpost.registryValuablePackage.from.typeAddress">
                                <option value="1" selected="selected">стандартный</option>
                                <option value="2">а/я</option>
                                <option value="3">до востребования</option>
                                <option value="4">гостиница</option>
                                <option value="5">войсковая часть</option>
                                <option value="6">войсковая часть ЮЯ</option>
                                <option value="7">полевая почта</option>
                            </select>
                        </td>
                        <td>стандартный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер абоненстого ящика</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_POBox_value">
                            <input id="russianpost_registryValuablePackage_from_POBox" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.from.POBox"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс отправителя</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_postIndex_value">
                            <input id="russianpost_registryValuablePackage_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Область, регион отправителя</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_region_value">
                            <input id="russianpost_registryValuablePackage_from_region" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registryValuablePackage.from.region"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Район отправителя</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_area_value">
                            <input id="russianpost_registryValuablePackage_from_area" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.from.area"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Населенный пункт отправителя</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_city_value">
                            <input id="russianpost_registryValuablePackage_from_city" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registryValuablePackage.from.city"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Внутригородской элемент</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Квартал, спутник, поселение, микрорайон, территория" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_location_value">
                            <input id="russianpost_registryValuablePackage_from_location" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.from.location"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование улицы отправителя</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_street_value">
                            <input id="russianpost_registryValuablePackage_from_street" class="span6" placeholder="" type="text" value="Московская" name="russianpost.registryValuablePackage.from.street"> </td>
                        <td>Московская</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер здания</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно для заполнения при указании типов адреса: «стандартный», «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_house_value">
                            <input id="russianpost_registryValuablePackage_from_house" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.from.house"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Литера</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_houseLetter_value">
                            <input id="russianpost_registryValuablePackage_from_houseLetter" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.from.houseLetter"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Дробь</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_houseSlash_value">
                            <input id="russianpost_registryValuablePackage_from_houseSlash" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.from.houseSlash"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Корпус</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_houseCorpus_value">
                            <input id="russianpost_registryValuablePackage_from_houseCorpus" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.from.houseCorpus"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Строение</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_houseBuilding_value">
                            <input id="russianpost_registryValuablePackage_from_houseBuilding" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.from.houseBuilding"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Название гостиницы</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно при типе адреса: «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_hotel_value">
                            <input id="russianpost_registryValuablePackage_from_hotel" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.from.hotel"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Номер помещения</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_from_hotelRoom_value">
                            <input id="russianpost_registryValuablePackage_from_hotelRoom" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.from.hotelRoom"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер контракта (договора)</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_numContract_value">
                            <input id="russianpost_registryValuablePackage_sender_numContract" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.sender.numContract"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН отправителя</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_inn_value">
                            <input id="russianpost_registryValuablePackage_sender_inn" class="span6" placeholder="" type="text" value="123456789012" name="russianpost.registryValuablePackage.sender.inn"> </td>
                        <td>123456789012</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>КПП отправителя</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_kpp_value">
                            <input id="russianpost_registryValuablePackage_sender_kpp" class="span6" placeholder="" type="text" value="" name="russianpost.registryValuablePackage.sender.kpp"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Индекс ОПС, откуда поступило внутреннее отправление" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_indexOps_value">
                            <input id="russianpost_registryValuablePackage_sender_indexOps" class="span6" placeholder="" type="text" value="654321" name="russianpost.registryValuablePackage.sender.indexOps"> </td>
                        <td>654321</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ и форма оплаты услуг почтовой связи</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_pay_type_value">
                            <select id="russianpost_registryValuablePackage_pay_type" name="russianpost.registryValuablePackage.pay.type">
                                <option value="1" selected="selected">наличная</option>
                                <option value="2">безналичная</option>
                                <option value="4">бесплатно</option>
                                <option value="8">пластиковая карта</option>
                                <option value="16">государственные знаки почтовой оплаты марками</option>
                                <option value="32">предоплата (авансовый платеж)</option>
                                <option value="64">оплачено международному оператору</option>
                                <option value="128">оплачивается получателем</option>
                                <option value="256">государственные знаки почтовой оплаты франкирование</option>
                            </select>
                        </td>
                        <td>наличная</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория отправителя</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_category_value">
                            <select id="russianpost_registryValuablePackage_sender_category" name="russianpost.registryValuablePackage.sender.category">
                                <option value="1" selected="selected">население</option>
                                <option value="2">бюджетная организация</option>
                                <option value="3">хозрасчетная организация</option>
                                <option value="4">международный оператор</option>
                                <option value="5">корпоративный клиент</option>
                                <option value="6">почтовый оператор</option>
                            </select>
                        </td>
                        <td>население</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вид почтового отправления</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_mailType_value">
                            <select id="russianpost_registryValuablePackage_sender_mailType" name="russianpost.registryValuablePackage.sender.mailType">
                                <option value="0">не определено</option>
                                <option value="1">бланк почтового перевода</option>
                                <option value="2">письмо</option>
                                <option value="3" selected="selected">бандероль</option>
                                <option value="4">посылка</option>
                                <option value="5">мелкий пакет</option>
                                <option value="6">почтовая карточка</option>
                                <option value="7">отправление EMS</option>
                                <option value="8">секограмма</option>
                                <option value="9">мешок «М»</option>
                                <option value="10">прямой контейнер</option>
                                <option value="11">отправление электронной почты</option>
                                <option value="12">бланк уведомления</option>
                                <option value="13">газетная пачка</option>
                                <option value="14">сгруппированные отправления «Консигнация»</option>
                                <option value="15">письмо 1 класса</option>
                                <option value="16">бандероль 1 класса</option>
                                <option value="17">бланк уведомления 1 класса</option>
                                <option value="18">сумка страховая</option>
                                <option value="19">ОВПО</option>
                                <option value="20">мультиконверт</option>
                                <option value="21">МКПО</option>
                                <option value="23">Посылка онлайн</option>
                            </select>
                        </td>
                        <td>бандероль</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_mailCtg_value">
                            <select id="russianpost_registryValuablePackage_sender_mailCtg" name="russianpost.registryValuablePackage.sender.mailCtg">
                                <option value="0">простое</option>
                                <option value="1">заказное</option>
                                <option value="2">с объявленной ценностью</option>
                                <option value="3" selected="selected">обыкновенное</option>
                                <option value="4">с объявленной ценностью и наложенным платежом</option>
                                <option value="5">не определена</option>
                                <option value="6">с объявленной ценностью и обязательным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Классификация почтового отправления</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_directCtg_value">
                            <select id="russianpost_registryValuablePackage_sender_directCtg" name="russianpost.registryValuablePackage.sender.directCtg">
                                <option value="1" selected="selected">внутренняя</option>
                                <option value="2">международная</option>
                            </select>
                        </td>
                        <td>внутренняя</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_transType_value">
                            <select id="russianpost_registryValuablePackage_sender_transType" name="russianpost.registryValuablePackage.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                                <option value="4">системой ускоренной почты</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка отправления</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_postMark_value">
                            <select id="russianpost_registryValuablePackage_sender_postMark" name="russianpost.registryValuablePackage.sender.postMark">
                                <option value="0">без отметки</option>
                                <option value="1" selected="selected">с простым уведомлением</option>
                                <option value="2">с заказным уведомлением</option>
                                <option value="4">с описью</option>
                                <option value="8">осторожно (хрупкая)</option>
                                <option value="16">тяжеловесная</option>
                                <option value="32">крупногабаритная (громоздкая)</option>
                                <option value="64">с доставкой (доставка нарочным)</option>
                                <option value="128">вручить в собственные руки</option>
                                <option value="256">с документами</option>
                                <option value="512">с товарами</option>
                                <option value="1024">возврату не подлежит</option>
                                <option value="2048">нестандартная</option>
                                <option value="4096">приграничная</option>
                                <option value="8192">застраховано</option>
                            </select>
                        </td>
                        <td>с простым уведомлением</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Разряд почтового отправления</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_mailRank_value">
                            <select id="russianpost_registryValuablePackage_sender_mailRank" name="russianpost.registryValuablePackage.sender.mailRank">
                                <option value="0" selected="selected">без разряда</option>
                                <option value="1">правительственное</option>
                                <option value="2">воинское</option>
                                <option value="3">служебное</option>
                                <option value="4">судебное</option>
                                <option value="5">президентское</option>
                                <option value="6">кредитное</option>
                            </select>
                        </td>
                        <td>без разряда</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="При отстуствии заказной услуги выбрать поле «не использовать»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_notice_sms_value">
                            <select id="russianpost_registryValuablePackage_sender_notice_sms" name="russianpost.registryValuablePackage.sender.notice.sms">
                                <option value="0" selected="selected">не использовать</option>
                                <option value="1">SMS-уведомление о поступлении РПО в ОПС вручения</option>
                                <option value="2">SMS-уведомление о вручении РПО</option>
                            </select>
                        </td>
                        <td>не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_check_opis_region_value">
                            <select id="russianpost_registryValuablePackage_check_opis_region" name="russianpost.registryValuablePackage.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryValuablePackage_weight_value">
                            <input id="ytrussianpost_registryValuablePackage_weight" type="hidden" value="0" name="russianpost.registryValuablePackage.weight">
                            <input id="russianpost_registryValuablePackage_weight" type="checkbox" value="1" name="russianpost.registryValuablePackage.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_weight_product_value">
                            <input id="russianpost_registryValuablePackage_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.registryValuablePackage.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryValuablePackage_weight_package_value">
                            <input id="russianpost_registryValuablePackage_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.registryValuablePackage.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryValuablePackage_weight_custom_value">
                            <select id="russianpost_registryValuablePackage_weight_custom" name="russianpost.registryValuablePackage.weight.custom">
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
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_sender_date_value">
                            <select id="russianpost_registryValuablePackage_sender_date" name="russianpost.registryValuablePackage.sender.date">
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
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_registryValuablePackage_rtm_version_value">
                            <input id="russianpost_registryValuablePackage_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.registryValuablePackage.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryValuablePackage_list_number_value">
                            <input id="russianpost_registryValuablePackage_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.registryValuablePackage.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Файлы *.txt и *.ini (для реестра ПО) Простая посылка</div>
        <div class="spoiler-body collapse in" id="lv-postblank-registrySimpleParcel" style="" aria-expanded="true">
            <table id="lv-config-table-registrySimpleParcel" class="table table-bordered table-forms">
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
                            <b>Включает возможность использования выгрузки заказов в *.txt и .ini файл (для реестра ПО) Простая посылка</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_use_value">
                            <input id="ytrussianpost_registrySimpleParcel_use" type="hidden" value="0" name="russianpost.registrySimpleParcel.use">
                            <input id="russianpost_registrySimpleParcel_use" type="checkbox" value="1" name="russianpost.registrySimpleParcel.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Ф.И.О. отправителя</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_name_value">
                            <input id="russianpost_registrySimpleParcel_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.registrySimpleParcel.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Телефон отправителя</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_phone_value">
                            <input id="russianpost_registrySimpleParcel_from_phone" class="span6" placeholder="" type="text" value="79888888888" name="russianpost.registrySimpleParcel.from.phone"> </td>
                        <td>79888888888</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_typeAddress_value">
                            <select id="russianpost_registrySimpleParcel_from_typeAddress" name="russianpost.registrySimpleParcel.from.typeAddress">
                                <option value="1" selected="selected">стандартный</option>
                                <option value="2">а/я</option>
                                <option value="3">до востребования</option>
                                <option value="4">гостиница</option>
                                <option value="5">войсковая часть</option>
                                <option value="6">войсковая часть ЮЯ</option>
                                <option value="7">полевая почта</option>
                            </select>
                        </td>
                        <td>стандартный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер абоненстого ящика</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_POBox_value">
                            <input id="russianpost_registrySimpleParcel_from_POBox" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.from.POBox"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс отправителя</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_postIndex_value">
                            <input id="russianpost_registrySimpleParcel_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Область, регион отправителя</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_region_value">
                            <input id="russianpost_registrySimpleParcel_from_region" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registrySimpleParcel.from.region"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Район отправителя</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_area_value">
                            <input id="russianpost_registrySimpleParcel_from_area" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.from.area"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Населенный пункт отправителя</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_city_value">
                            <input id="russianpost_registrySimpleParcel_from_city" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registrySimpleParcel.from.city"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Внутригородской элемент</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Квартал, спутник, поселение, микрорайон, территория" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_location_value">
                            <input id="russianpost_registrySimpleParcel_from_location" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.from.location"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование улицы отправителя</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_street_value">
                            <input id="russianpost_registrySimpleParcel_from_street" class="span6" placeholder="" type="text" value="Московская" name="russianpost.registrySimpleParcel.from.street"> </td>
                        <td>Московская</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер здания</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно для заполнения при указании типов адреса: «стандартный», «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_house_value">
                            <input id="russianpost_registrySimpleParcel_from_house" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.from.house"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Литера</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_houseLetter_value">
                            <input id="russianpost_registrySimpleParcel_from_houseLetter" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.from.houseLetter"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Дробь</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_houseSlash_value">
                            <input id="russianpost_registrySimpleParcel_from_houseSlash" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.from.houseSlash"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Корпус</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_houseCorpus_value">
                            <input id="russianpost_registrySimpleParcel_from_houseCorpus" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.from.houseCorpus"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Строение</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_houseBuilding_value">
                            <input id="russianpost_registrySimpleParcel_from_houseBuilding" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.from.houseBuilding"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Название гостиницы</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно при типе адреса: «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_hotel_value">
                            <input id="russianpost_registrySimpleParcel_from_hotel" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.from.hotel"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Номер помещения</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_from_hotelRoom_value">
                            <input id="russianpost_registrySimpleParcel_from_hotelRoom" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.from.hotelRoom"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер контракта (договора)</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_numContract_value">
                            <input id="russianpost_registrySimpleParcel_sender_numContract" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.sender.numContract"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН отправителя</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_inn_value">
                            <input id="russianpost_registrySimpleParcel_sender_inn" class="span6" placeholder="" type="text" value="123456789012" name="russianpost.registrySimpleParcel.sender.inn"> </td>
                        <td>123456789012</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>КПП отправителя</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_kpp_value">
                            <input id="russianpost_registrySimpleParcel_sender_kpp" class="span6" placeholder="" type="text" value="" name="russianpost.registrySimpleParcel.sender.kpp"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Индекс ОПС, откуда поступило внутреннее отправление" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_indexOps_value">
                            <input id="russianpost_registrySimpleParcel_sender_indexOps" class="span6" placeholder="" type="text" value="654321" name="russianpost.registrySimpleParcel.sender.indexOps"> </td>
                        <td>654321</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ и форма оплаты услуг почтовой связи</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_pay_type_value">
                            <select id="russianpost_registrySimpleParcel_pay_type" name="russianpost.registrySimpleParcel.pay.type">
                                <option value="1" selected="selected">наличная</option>
                                <option value="2">безналичная</option>
                                <option value="4">бесплатно</option>
                                <option value="8">пластиковая карта</option>
                                <option value="16">государственные знаки почтовой оплаты марками</option>
                                <option value="32">предоплата (авансовый платеж)</option>
                                <option value="64">оплачено международному оператору</option>
                                <option value="128">оплачивается получателем</option>
                                <option value="256">государственные знаки почтовой оплаты франкирование</option>
                            </select>
                        </td>
                        <td>наличная</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория отправителя</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_category_value">
                            <select id="russianpost_registrySimpleParcel_sender_category" name="russianpost.registrySimpleParcel.sender.category">
                                <option value="1" selected="selected">население</option>
                                <option value="2">бюджетная организация</option>
                                <option value="3">хозрасчетная организация</option>
                                <option value="4">международный оператор</option>
                                <option value="5">корпоративный клиент</option>
                                <option value="6">почтовый оператор</option>
                            </select>
                        </td>
                        <td>население</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вид почтового отправления</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_mailType_value">
                            <select id="russianpost_registrySimpleParcel_sender_mailType" name="russianpost.registrySimpleParcel.sender.mailType">
                                <option value="0">не определено</option>
                                <option value="1">бланк почтового перевода</option>
                                <option value="2">письмо</option>
                                <option value="3">бандероль</option>
                                <option value="4" selected="selected">посылка</option>
                                <option value="5">мелкий пакет</option>
                                <option value="6">почтовая карточка</option>
                                <option value="7">отправление EMS</option>
                                <option value="8">секограмма</option>
                                <option value="9">мешок «М»</option>
                                <option value="10">прямой контейнер</option>
                                <option value="11">отправление электронной почты</option>
                                <option value="12">бланк уведомления</option>
                                <option value="13">газетная пачка</option>
                                <option value="14">сгруппированные отправления «Консигнация»</option>
                                <option value="15">письмо 1 класса</option>
                                <option value="16">бандероль 1 класса</option>
                                <option value="17">бланк уведомления 1 класса</option>
                                <option value="18">сумка страховая</option>
                                <option value="19">ОВПО</option>
                                <option value="20">мультиконверт</option>
                                <option value="21">МКПО</option>
                                <option value="23">Посылка онлайн</option>
                            </select>
                        </td>
                        <td>посылка</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_mailCtg_value">
                            <select id="russianpost_registrySimpleParcel_sender_mailCtg" name="russianpost.registrySimpleParcel.sender.mailCtg">
                                <option value="0">простое</option>
                                <option value="1">заказное</option>
                                <option value="2">с объявленной ценностью</option>
                                <option value="3" selected="selected">обыкновенное</option>
                                <option value="4">с объявленной ценностью и наложенным платежом</option>
                                <option value="5">не определена</option>
                                <option value="6">с объявленной ценностью и обязательным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Классификация почтового отправления</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_directCtg_value">
                            <select id="russianpost_registrySimpleParcel_sender_directCtg" name="russianpost.registrySimpleParcel.sender.directCtg">
                                <option value="1" selected="selected">внутренняя</option>
                                <option value="2">международная</option>
                            </select>
                        </td>
                        <td>внутренняя</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_transType_value">
                            <select id="russianpost_registrySimpleParcel_sender_transType" name="russianpost.registrySimpleParcel.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                                <option value="4">системой ускоренной почты</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка отправления</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_postMark_value">
                            <select id="russianpost_registrySimpleParcel_sender_postMark" name="russianpost.registrySimpleParcel.sender.postMark">
                                <option value="0">без отметки</option>
                                <option value="1" selected="selected">с простым уведомлением</option>
                                <option value="2">с заказным уведомлением</option>
                                <option value="4">с описью</option>
                                <option value="8">осторожно (хрупкая)</option>
                                <option value="16">тяжеловесная</option>
                                <option value="32">крупногабаритная (громоздкая)</option>
                                <option value="64">с доставкой (доставка нарочным)</option>
                                <option value="128">вручить в собственные руки</option>
                                <option value="256">с документами</option>
                                <option value="512">с товарами</option>
                                <option value="1024">возврату не подлежит</option>
                                <option value="2048">нестандартная</option>
                                <option value="4096">приграничная</option>
                                <option value="8192">застраховано</option>
                            </select>
                        </td>
                        <td>с простым уведомлением</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Разряд почтового отправления</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_mailRank_value">
                            <select id="russianpost_registrySimpleParcel_sender_mailRank" name="russianpost.registrySimpleParcel.sender.mailRank">
                                <option value="0" selected="selected">без разряда</option>
                                <option value="1">правительственное</option>
                                <option value="2">воинское</option>
                                <option value="3">служебное</option>
                                <option value="4">судебное</option>
                                <option value="5">президентское</option>
                                <option value="6">кредитное</option>
                            </select>
                        </td>
                        <td>без разряда</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="При отстуствии заказной услуги выбрать поле «не использовать»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_notice_sms_value">
                            <select id="russianpost_registrySimpleParcel_sender_notice_sms" name="russianpost.registrySimpleParcel.sender.notice.sms">
                                <option value="0" selected="selected">не использовать</option>
                                <option value="1">SMS-уведомление о поступлении РПО в ОПС вручения</option>
                                <option value="2">SMS-уведомление о вручении РПО</option>
                            </select>
                        </td>
                        <td>не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_check_opis_region_value">
                            <select id="russianpost_registrySimpleParcel_check_opis_region" name="russianpost.registrySimpleParcel.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Упаковка</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_package_value">
                            <select id="russianpost_registrySimpleParcel_package" name="russianpost.registrySimpleParcel.package">
                                <option value="10" selected="selected">Коробка «S»</option>
                                <option value="11">Пакет полиэтиленовый «S»</option>
                                <option value="12">Конверт с воздушно-пузырчатой пленкой «S»</option>
                                <option value="20">Коробка «М»</option>
                                <option value="21">Пакет полиэтиленовый «М»</option>
                                <option value="22">Конверт с воздушно-пузырчатой пленкой «М»</option>
                                <option value="30">Коробка «L»</option>
                                <option value="31">Пакет полиэтиленовый «L»</option>
                                <option value="40">Коробка «ХL»</option>
                                <option value="41">Пакет полиэтиленовый «ХL»</option>
                            </select>
                        </td>
                        <td>Коробка «S»</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registrySimpleParcel_weight_value">
                            <input id="ytrussianpost_registrySimpleParcel_weight" type="hidden" value="0" name="russianpost.registrySimpleParcel.weight">
                            <input id="russianpost_registrySimpleParcel_weight" type="checkbox" value="1" name="russianpost.registrySimpleParcel.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_weight_product_value">
                            <input id="russianpost_registrySimpleParcel_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.registrySimpleParcel.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registrySimpleParcel_weight_package_value">
                            <input id="russianpost_registrySimpleParcel_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.registrySimpleParcel.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registrySimpleParcel_weight_custom_value">
                            <select id="russianpost_registrySimpleParcel_weight_custom" name="russianpost.registrySimpleParcel.weight.custom">
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
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_sender_date_value">
                            <select id="russianpost_registrySimpleParcel_sender_date" name="russianpost.registrySimpleParcel.sender.date">
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
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_registrySimpleParcel_rtm_version_value">
                            <input id="russianpost_registrySimpleParcel_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.registrySimpleParcel.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registrySimpleParcel_list_number_value">
                            <input id="russianpost_registrySimpleParcel_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.registrySimpleParcel.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Файлы *.txt и *.ini (для реестра ПО) Ценная посылка</div>
        <div class="spoiler-body collapse in" id="lv-postblank-registryParcel" style="" aria-expanded="true">
            <table id="lv-config-table-registryParcel" class="table table-bordered table-forms">
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
                            <b>Включает возможность использования выгрузки заказов в *.txt и .ini файл (для реестра ПО) Ценная посылка</b>
                        </td>
                        <td id="russianpost_registryParcel_use_value">
                            <input id="ytrussianpost_registryParcel_use" type="hidden" value="0" name="russianpost.registryParcel.use">
                            <input id="russianpost_registryParcel_use" type="checkbox" value="1" name="russianpost.registryParcel.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Ф.И.О. отправителя</b>
                        </td>
                        <td id="russianpost_registryParcel_from_name_value">
                            <input id="russianpost_registryParcel_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.registryParcel.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Телефон отправителя</b>
                        </td>
                        <td id="russianpost_registryParcel_from_phone_value">
                            <input id="russianpost_registryParcel_from_phone" class="span6" placeholder="" type="text" value="79888888888" name="russianpost.registryParcel.from.phone"> </td>
                        <td>79888888888</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpost_registryParcel_from_typeAddress_value">
                            <select id="russianpost_registryParcel_from_typeAddress" name="russianpost.registryParcel.from.typeAddress">
                                <option value="1" selected="selected">стандартный</option>
                                <option value="2">а/я</option>
                                <option value="3">до востребования</option>
                                <option value="4">гостиница</option>
                                <option value="5">войсковая часть</option>
                                <option value="6">войсковая часть ЮЯ</option>
                                <option value="7">полевая почта</option>
                            </select>
                        </td>
                        <td>стандартный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер абоненстого ящика</b>
                        </td>
                        <td id="russianpost_registryParcel_from_POBox_value">
                            <input id="russianpost_registryParcel_from_POBox" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.from.POBox"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс отправителя</b>
                        </td>
                        <td id="russianpost_registryParcel_from_postIndex_value">
                            <input id="russianpost_registryParcel_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Область, регион отправителя</b>
                        </td>
                        <td id="russianpost_registryParcel_from_region_value">
                            <input id="russianpost_registryParcel_from_region" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registryParcel.from.region"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Район отправителя</b>
                        </td>
                        <td id="russianpost_registryParcel_from_area_value">
                            <input id="russianpost_registryParcel_from_area" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.from.area"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Населенный пункт отправителя</b>
                        </td>
                        <td id="russianpost_registryParcel_from_city_value">
                            <input id="russianpost_registryParcel_from_city" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registryParcel.from.city"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Внутригородской элемент</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Квартал, спутник, поселение, микрорайон, территория" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcel_from_location_value">
                            <input id="russianpost_registryParcel_from_location" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.from.location"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование улицы отправителя</b>
                        </td>
                        <td id="russianpost_registryParcel_from_street_value">
                            <input id="russianpost_registryParcel_from_street" class="span6" placeholder="" type="text" value="Московская" name="russianpost.registryParcel.from.street"> </td>
                        <td>Московская</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер здания</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно для заполнения при указании типов адреса: «стандартный», «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcel_from_house_value">
                            <input id="russianpost_registryParcel_from_house" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.from.house"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Литера</b>
                        </td>
                        <td id="russianpost_registryParcel_from_houseLetter_value">
                            <input id="russianpost_registryParcel_from_houseLetter" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.from.houseLetter"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Дробь</b>
                        </td>
                        <td id="russianpost_registryParcel_from_houseSlash_value">
                            <input id="russianpost_registryParcel_from_houseSlash" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.from.houseSlash"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Корпус</b>
                        </td>
                        <td id="russianpost_registryParcel_from_houseCorpus_value">
                            <input id="russianpost_registryParcel_from_houseCorpus" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.from.houseCorpus"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Строение</b>
                        </td>
                        <td id="russianpost_registryParcel_from_houseBuilding_value">
                            <input id="russianpost_registryParcel_from_houseBuilding" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.from.houseBuilding"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Название гостиницы</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно при типе адреса: «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcel_from_hotel_value">
                            <input id="russianpost_registryParcel_from_hotel" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.from.hotel"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Номер помещения</b>
                        </td>
                        <td id="russianpost_registryParcel_from_hotelRoom_value">
                            <input id="russianpost_registryParcel_from_hotelRoom" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.from.hotelRoom"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер контракта (договора)</b>
                        </td>
                        <td id="russianpost_registryParcel_sender_numContract_value">
                            <input id="russianpost_registryParcel_sender_numContract" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.sender.numContract"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН отправителя</b>
                        </td>
                        <td id="russianpost_registryParcel_sender_inn_value">
                            <input id="russianpost_registryParcel_sender_inn" class="span6" placeholder="" type="text" value="123456789012" name="russianpost.registryParcel.sender.inn"> </td>
                        <td>123456789012</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>КПП отправителя</b>
                        </td>
                        <td id="russianpost_registryParcel_sender_kpp_value">
                            <input id="russianpost_registryParcel_sender_kpp" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcel.sender.kpp"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Индекс ОПС, откуда поступило внутреннее отправление" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcel_sender_indexOps_value">
                            <input id="russianpost_registryParcel_sender_indexOps" class="span6" placeholder="" type="text" value="654321" name="russianpost.registryParcel.sender.indexOps"> </td>
                        <td>654321</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ и форма оплаты услуг почтовой связи</b>
                        </td>
                        <td id="russianpost_registryParcel_pay_type_value">
                            <select id="russianpost_registryParcel_pay_type" name="russianpost.registryParcel.pay.type">
                                <option value="1" selected="selected">наличная</option>
                                <option value="2">безналичная</option>
                                <option value="4">бесплатно</option>
                                <option value="8">пластиковая карта</option>
                                <option value="16">государственные знаки почтовой оплаты марками</option>
                                <option value="32">предоплата (авансовый платеж)</option>
                                <option value="64">оплачено международному оператору</option>
                                <option value="128">оплачивается получателем</option>
                                <option value="256">государственные знаки почтовой оплаты франкирование</option>
                            </select>
                        </td>
                        <td>наличная</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория отправителя</b>
                        </td>
                        <td id="russianpost_registryParcel_sender_category_value">
                            <select id="russianpost_registryParcel_sender_category" name="russianpost.registryParcel.sender.category">
                                <option value="1" selected="selected">население</option>
                                <option value="2">бюджетная организация</option>
                                <option value="3">хозрасчетная организация</option>
                                <option value="4">международный оператор</option>
                                <option value="5">корпоративный клиент</option>
                                <option value="6">почтовый оператор</option>
                            </select>
                        </td>
                        <td>население</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вид почтового отправления</b>
                        </td>
                        <td id="russianpost_registryParcel_sender_mailType_value">
                            <select id="russianpost_registryParcel_sender_mailType" name="russianpost.registryParcel.sender.mailType">
                                <option value="0">не определено</option>
                                <option value="1">бланк почтового перевода</option>
                                <option value="2">письмо</option>
                                <option value="3">бандероль</option>
                                <option value="4" selected="selected">посылка</option>
                                <option value="5">мелкий пакет</option>
                                <option value="6">почтовая карточка</option>
                                <option value="7">отправление EMS</option>
                                <option value="8">секограмма</option>
                                <option value="9">мешок «М»</option>
                                <option value="10">прямой контейнер</option>
                                <option value="11">отправление электронной почты</option>
                                <option value="12">бланк уведомления</option>
                                <option value="13">газетная пачка</option>
                                <option value="14">сгруппированные отправления «Консигнация»</option>
                                <option value="15">письмо 1 класса</option>
                                <option value="16">бандероль 1 класса</option>
                                <option value="17">бланк уведомления 1 класса</option>
                                <option value="18">сумка страховая</option>
                                <option value="19">ОВПО</option>
                                <option value="20">мультиконверт</option>
                                <option value="21">МКПО</option>
                                <option value="23">Посылка онлайн</option>
                            </select>
                        </td>
                        <td>посылка</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_registryParcel_sender_mailCtg_value">
                            <select id="russianpost_registryParcel_sender_mailCtg" name="russianpost.registryParcel.sender.mailCtg">
                                <option value="0">простое</option>
                                <option value="1">заказное</option>
                                <option value="2">с объявленной ценностью</option>
                                <option value="3" selected="selected">обыкновенное</option>
                                <option value="4">с объявленной ценностью и наложенным платежом</option>
                                <option value="5">не определена</option>
                                <option value="6">с объявленной ценностью и обязательным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Классификация почтового отправления</b>
                        </td>
                        <td id="russianpost_registryParcel_sender_directCtg_value">
                            <select id="russianpost_registryParcel_sender_directCtg" name="russianpost.registryParcel.sender.directCtg">
                                <option value="1" selected="selected">внутренняя</option>
                                <option value="2">международная</option>
                            </select>
                        </td>
                        <td>внутренняя</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_registryParcel_sender_transType_value">
                            <select id="russianpost_registryParcel_sender_transType" name="russianpost.registryParcel.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                                <option value="4">системой ускоренной почты</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка отправления</b>
                        </td>
                        <td id="russianpost_registryParcel_sender_postMark_value">
                            <select id="russianpost_registryParcel_sender_postMark" name="russianpost.registryParcel.sender.postMark">
                                <option value="0">без отметки</option>
                                <option value="1" selected="selected">с простым уведомлением</option>
                                <option value="2">с заказным уведомлением</option>
                                <option value="4">с описью</option>
                                <option value="8">осторожно (хрупкая)</option>
                                <option value="16">тяжеловесная</option>
                                <option value="32">крупногабаритная (громоздкая)</option>
                                <option value="64">с доставкой (доставка нарочным)</option>
                                <option value="128">вручить в собственные руки</option>
                                <option value="256">с документами</option>
                                <option value="512">с товарами</option>
                                <option value="1024">возврату не подлежит</option>
                                <option value="2048">нестандартная</option>
                                <option value="4096">приграничная</option>
                                <option value="8192">застраховано</option>
                            </select>
                        </td>
                        <td>с простым уведомлением</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Разряд почтового отправления</b>
                        </td>
                        <td id="russianpost_registryParcel_sender_mailRank_value">
                            <select id="russianpost_registryParcel_sender_mailRank" name="russianpost.registryParcel.sender.mailRank">
                                <option value="0" selected="selected">без разряда</option>
                                <option value="1">правительственное</option>
                                <option value="2">воинское</option>
                                <option value="3">служебное</option>
                                <option value="4">судебное</option>
                                <option value="5">президентское</option>
                                <option value="6">кредитное</option>
                            </select>
                        </td>
                        <td>без разряда</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="При отстуствии заказной услуги выбрать поле «не использовать»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcel_sender_notice_sms_value">
                            <select id="russianpost_registryParcel_sender_notice_sms" name="russianpost.registryParcel.sender.notice.sms">
                                <option value="0" selected="selected">не использовать</option>
                                <option value="1">SMS-уведомление о поступлении РПО в ОПС вручения</option>
                                <option value="2">SMS-уведомление о вручении РПО</option>
                            </select>
                        </td>
                        <td>не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_registryParcel_check_opis_region_value">
                            <select id="russianpost_registryParcel_check_opis_region" name="russianpost.registryParcel.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Упаковка</b>
                        </td>
                        <td id="russianpost_registryParcel_package_value">
                            <select id="russianpost_registryParcel_package" name="russianpost.registryParcel.package">
                                <option value="10" selected="selected">Коробка «S»</option>
                                <option value="11">Пакет полиэтиленовый «S»</option>
                                <option value="12">Конверт с воздушно-пузырчатой пленкой «S»</option>
                                <option value="20">Коробка «М»</option>
                                <option value="21">Пакет полиэтиленовый «М»</option>
                                <option value="22">Конверт с воздушно-пузырчатой пленкой «М»</option>
                                <option value="30">Коробка «L»</option>
                                <option value="31">Пакет полиэтиленовый «L»</option>
                                <option value="40">Коробка «ХL»</option>
                                <option value="41">Пакет полиэтиленовый «ХL»</option>
                            </select>
                        </td>
                        <td>Коробка «S»</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcel_weight_value">
                            <input id="ytrussianpost_registryParcel_weight" type="hidden" value="0" name="russianpost.registryParcel.weight">
                            <input id="russianpost_registryParcel_weight" type="checkbox" value="1" name="russianpost.registryParcel.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_registryParcel_weight_product_value">
                            <input id="russianpost_registryParcel_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.registryParcel.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcel_weight_package_value">
                            <input id="russianpost_registryParcel_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.registryParcel.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcel_weight_custom_value">
                            <select id="russianpost_registryParcel_weight_custom" name="russianpost.registryParcel.weight.custom">
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
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_registryParcel_sender_date_value">
                            <select id="russianpost_registryParcel_sender_date" name="russianpost.registryParcel.sender.date">
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
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_registryParcel_rtm_version_value">
                            <input id="russianpost_registryParcel_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.registryParcel.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcel_list_number_value">
                            <input id="russianpost_registryParcel_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.registryParcel.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Файлы *.txt и *.ini (для реестра ПО) Ценная посылка без н/пл</div>
        <div class="spoiler-body collapse in" id="lv-postblank-registryParcelNonp" style="" aria-expanded="true">
            <table id="lv-config-table-registryParcelNonp" class="table table-bordered table-forms">
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
                            <b>Включает возможность использования выгрузки заказов в *.txt и .ini файл (для реестра ПО) Ценная посылка без н/пл</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_use_value">
                            <input id="ytrussianpost_registryParcelNonp_use" type="hidden" value="0" name="russianpost.registryParcelNonp.use">
                            <input id="russianpost_registryParcelNonp_use" type="checkbox" value="1" name="russianpost.registryParcelNonp.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Ф.И.О. отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_name_value">
                            <input id="russianpost_registryParcelNonp_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.registryParcelNonp.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Телефон отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_phone_value">
                            <input id="russianpost_registryParcelNonp_from_phone" class="span6" placeholder="" type="text" value="79888888888" name="russianpost.registryParcelNonp.from.phone"> </td>
                        <td>79888888888</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_typeAddress_value">
                            <select id="russianpost_registryParcelNonp_from_typeAddress" name="russianpost.registryParcelNonp.from.typeAddress">
                                <option value="1" selected="selected">стандартный</option>
                                <option value="2">а/я</option>
                                <option value="3">до востребования</option>
                                <option value="4">гостиница</option>
                                <option value="5">войсковая часть</option>
                                <option value="6">войсковая часть ЮЯ</option>
                                <option value="7">полевая почта</option>
                            </select>
                        </td>
                        <td>стандартный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер абоненстого ящика</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_POBox_value">
                            <input id="russianpost_registryParcelNonp_from_POBox" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.from.POBox"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_postIndex_value">
                            <input id="russianpost_registryParcelNonp_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Область, регион отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_region_value">
                            <input id="russianpost_registryParcelNonp_from_region" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registryParcelNonp.from.region"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Район отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_area_value">
                            <input id="russianpost_registryParcelNonp_from_area" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.from.area"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Населенный пункт отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_city_value">
                            <input id="russianpost_registryParcelNonp_from_city" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registryParcelNonp.from.city"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Внутригородской элемент</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Квартал, спутник, поселение, микрорайон, территория" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_location_value">
                            <input id="russianpost_registryParcelNonp_from_location" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.from.location"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование улицы отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_street_value">
                            <input id="russianpost_registryParcelNonp_from_street" class="span6" placeholder="" type="text" value="Московская" name="russianpost.registryParcelNonp.from.street"> </td>
                        <td>Московская</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер здания</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно для заполнения при указании типов адреса: «стандартный», «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_house_value">
                            <input id="russianpost_registryParcelNonp_from_house" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.from.house"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Литера</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_houseLetter_value">
                            <input id="russianpost_registryParcelNonp_from_houseLetter" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.from.houseLetter"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Дробь</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_houseSlash_value">
                            <input id="russianpost_registryParcelNonp_from_houseSlash" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.from.houseSlash"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Корпус</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_houseCorpus_value">
                            <input id="russianpost_registryParcelNonp_from_houseCorpus" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.from.houseCorpus"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Строение</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_houseBuilding_value">
                            <input id="russianpost_registryParcelNonp_from_houseBuilding" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.from.houseBuilding"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Название гостиницы</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно при типе адреса: «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_hotel_value">
                            <input id="russianpost_registryParcelNonp_from_hotel" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.from.hotel"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Номер помещения</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_from_hotelRoom_value">
                            <input id="russianpost_registryParcelNonp_from_hotelRoom" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.from.hotelRoom"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер контракта (договора)</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_numContract_value">
                            <input id="russianpost_registryParcelNonp_sender_numContract" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.sender.numContract"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_inn_value">
                            <input id="russianpost_registryParcelNonp_sender_inn" class="span6" placeholder="" type="text" value="123456789012" name="russianpost.registryParcelNonp.sender.inn"> </td>
                        <td>123456789012</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>КПП отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_kpp_value">
                            <input id="russianpost_registryParcelNonp_sender_kpp" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.sender.kpp"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Индекс ОПС, откуда поступило внутреннее отправление" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_indexOps_value">
                            <input id="russianpost_registryParcelNonp_sender_indexOps" class="span6" placeholder="" type="text" value="654321" name="russianpost.registryParcelNonp.sender.indexOps"> </td>
                        <td>654321</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ и форма оплаты услуг почтовой связи</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_pay_type_value">
                            <select id="russianpost_registryParcelNonp_pay_type" name="russianpost.registryParcelNonp.pay.type">
                                <option value="1" selected="selected">наличная</option>
                                <option value="2">безналичная</option>
                                <option value="4">бесплатно</option>
                                <option value="8">пластиковая карта</option>
                                <option value="16">государственные знаки почтовой оплаты марками</option>
                                <option value="32">предоплата (авансовый платеж)</option>
                                <option value="64">оплачено международному оператору</option>
                                <option value="128">оплачивается получателем</option>
                                <option value="256">государственные знаки почтовой оплаты франкирование</option>
                            </select>
                        </td>
                        <td>наличная</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_category_value">
                            <select id="russianpost_registryParcelNonp_sender_category" name="russianpost.registryParcelNonp.sender.category">
                                <option value="1" selected="selected">население</option>
                                <option value="2">бюджетная организация</option>
                                <option value="3">хозрасчетная организация</option>
                                <option value="4">международный оператор</option>
                                <option value="5">корпоративный клиент</option>
                                <option value="6">почтовый оператор</option>
                            </select>
                        </td>
                        <td>население</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вид почтового отправления</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_mailType_value">
                            <select id="russianpost_registryParcelNonp_sender_mailType" name="russianpost.registryParcelNonp.sender.mailType">
                                <option value="0">не определено</option>
                                <option value="1">бланк почтового перевода</option>
                                <option value="2">письмо</option>
                                <option value="3">бандероль</option>
                                <option value="4" selected="selected">посылка</option>
                                <option value="5">мелкий пакет</option>
                                <option value="6">почтовая карточка</option>
                                <option value="7">отправление EMS</option>
                                <option value="8">секограмма</option>
                                <option value="9">мешок «М»</option>
                                <option value="10">прямой контейнер</option>
                                <option value="11">отправление электронной почты</option>
                                <option value="12">бланк уведомления</option>
                                <option value="13">газетная пачка</option>
                                <option value="14">сгруппированные отправления «Консигнация»</option>
                                <option value="15">письмо 1 класса</option>
                                <option value="16">бандероль 1 класса</option>
                                <option value="17">бланк уведомления 1 класса</option>
                                <option value="18">сумка страховая</option>
                                <option value="19">ОВПО</option>
                                <option value="20">мультиконверт</option>
                                <option value="21">МКПО</option>
                                <option value="23">Посылка онлайн</option>
                            </select>
                        </td>
                        <td>посылка</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_mailCtg_value">
                            <select id="russianpost_registryParcelNonp_sender_mailCtg" name="russianpost.registryParcelNonp.sender.mailCtg">
                                <option value="0">простое</option>
                                <option value="1">заказное</option>
                                <option value="2" selected="selected">с объявленной ценностью</option>
                                <option value="3">обыкновенное</option>
                                <option value="5">не определена</option>
                            </select>
                        </td>
                        <td>с объявленной ценностью</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Классификация почтового отправления</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_directCtg_value">
                            <select id="russianpost_registryParcelNonp_sender_directCtg" name="russianpost.registryParcelNonp.sender.directCtg">
                                <option value="1" selected="selected">внутренняя</option>
                                <option value="2">международная</option>
                            </select>
                        </td>
                        <td>внутренняя</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_transType_value">
                            <select id="russianpost_registryParcelNonp_sender_transType" name="russianpost.registryParcelNonp.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                                <option value="4">системой ускоренной почты</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка отправления</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_postMark_value">
                            <select id="russianpost_registryParcelNonp_sender_postMark" name="russianpost.registryParcelNonp.sender.postMark">
                                <option value="0">без отметки</option>
                                <option value="1" selected="selected">с простым уведомлением</option>
                                <option value="2">с заказным уведомлением</option>
                                <option value="4">с описью</option>
                                <option value="8">осторожно (хрупкая)</option>
                                <option value="16">тяжеловесная</option>
                                <option value="32">крупногабаритная (громоздкая)</option>
                                <option value="64">с доставкой (доставка нарочным)</option>
                                <option value="128">вручить в собственные руки</option>
                                <option value="256">с документами</option>
                                <option value="512">с товарами</option>
                                <option value="1024">возврату не подлежит</option>
                                <option value="2048">нестандартная</option>
                                <option value="4096">приграничная</option>
                                <option value="8192">застраховано</option>
                            </select>
                        </td>
                        <td>с простым уведомлением</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Разряд почтового отправления</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_mailRank_value">
                            <select id="russianpost_registryParcelNonp_sender_mailRank" name="russianpost.registryParcelNonp.sender.mailRank">
                                <option value="0" selected="selected">без разряда</option>
                                <option value="1">правительственное</option>
                                <option value="2">воинское</option>
                                <option value="3">служебное</option>
                                <option value="4">судебное</option>
                                <option value="5">президентское</option>
                                <option value="6">кредитное</option>
                            </select>
                        </td>
                        <td>без разряда</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="При отстуствии заказной услуги выбрать поле «не использовать»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_notice_sms_value">
                            <select id="russianpost_registryParcelNonp_sender_notice_sms" name="russianpost.registryParcelNonp.sender.notice.sms">
                                <option value="0" selected="selected">не использовать</option>
                                <option value="1">SMS-уведомление о поступлении РПО в ОПС вручения</option>
                                <option value="2">SMS-уведомление о вручении РПО</option>
                            </select>
                        </td>
                        <td>не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_check_opis_region_value">
                            <select id="russianpost_registryParcelNonp_check_opis_region" name="russianpost.registryParcelNonp.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Упаковка</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_package_value">
                            <select id="russianpost_registryParcelNonp_package" name="russianpost.registryParcelNonp.package">
                                <option value="10" selected="selected">Коробка «S»</option>
                                <option value="11">Пакет полиэтиленовый «S»</option>
                                <option value="12">Конверт с воздушно-пузырчатой пленкой «S»</option>
                                <option value="20">Коробка «М»</option>
                                <option value="21">Пакет полиэтиленовый «М»</option>
                                <option value="22">Конверт с воздушно-пузырчатой пленкой «М»</option>
                                <option value="30">Коробка «L»</option>
                                <option value="31">Пакет полиэтиленовый «L»</option>
                                <option value="40">Коробка «ХL»</option>
                                <option value="41">Пакет полиэтиленовый «ХL»</option>
                            </select>
                        </td>
                        <td>Коробка «S»</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_declaredValueFix_value">
                            <input id="russianpost_registryParcelNonp_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelNonp.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelNonp_weight_value">
                            <input id="ytrussianpost_registryParcelNonp_weight" type="hidden" value="0" name="russianpost.registryParcelNonp.weight">
                            <input id="russianpost_registryParcelNonp_weight" type="checkbox" value="1" name="russianpost.registryParcelNonp.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_weight_product_value">
                            <input id="russianpost_registryParcelNonp_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.registryParcelNonp.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelNonp_weight_package_value">
                            <input id="russianpost_registryParcelNonp_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.registryParcelNonp.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelNonp_weight_custom_value">
                            <select id="russianpost_registryParcelNonp_weight_custom" name="russianpost.registryParcelNonp.weight.custom">
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
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_sender_date_value">
                            <select id="russianpost_registryParcelNonp_sender_date" name="russianpost.registryParcelNonp.sender.date">
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
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_registryParcelNonp_rtm_version_value">
                            <input id="russianpost_registryParcelNonp_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.registryParcelNonp.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelNonp_list_number_value">
                            <input id="russianpost_registryParcelNonp_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.registryParcelNonp.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Файлы *.txt и *.ini (для реестра ПО) Посылка Онлайн</div>
        <div class="spoiler-body collapse in" id="lv-postblank-registryParcelOnline" style="" aria-expanded="true">
            <table id="lv-config-table-registryParcelOnline" class="table table-bordered table-forms">
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
                            <b>Включает возможность использования выгрузки заказов в *.txt и .ini файл (для реестра ПО) Посылка Онлайн</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_use_value">
                            <input id="ytrussianpost_registryParcelOnline_use" type="hidden" value="0" name="russianpost.registryParcelOnline.use">
                            <input id="russianpost_registryParcelOnline_use" type="checkbox" value="1" name="russianpost.registryParcelOnline.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Ф.И.О. отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_name_value">
                            <input id="russianpost_registryParcelOnline_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.registryParcelOnline.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Телефон отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_phone_value">
                            <input id="russianpost_registryParcelOnline_from_phone" class="span6" placeholder="" type="text" value="79888888888" name="russianpost.registryParcelOnline.from.phone"> </td>
                        <td>79888888888</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_typeAddress_value">
                            <select id="russianpost_registryParcelOnline_from_typeAddress" name="russianpost.registryParcelOnline.from.typeAddress">
                                <option value="1" selected="selected">стандартный</option>
                                <option value="2">а/я</option>
                                <option value="3">до востребования</option>
                                <option value="4">гостиница</option>
                                <option value="5">войсковая часть</option>
                                <option value="6">войсковая часть ЮЯ</option>
                                <option value="7">полевая почта</option>
                            </select>
                        </td>
                        <td>стандартный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер абоненстого ящика</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_POBox_value">
                            <input id="russianpost_registryParcelOnline_from_POBox" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.from.POBox"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_postIndex_value">
                            <input id="russianpost_registryParcelOnline_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Область, регион отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_region_value">
                            <input id="russianpost_registryParcelOnline_from_region" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registryParcelOnline.from.region"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Район отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_area_value">
                            <input id="russianpost_registryParcelOnline_from_area" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.from.area"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Населенный пункт отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_city_value">
                            <input id="russianpost_registryParcelOnline_from_city" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registryParcelOnline.from.city"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Внутригородской элемент</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Квартал, спутник, поселение, микрорайон, территория" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_location_value">
                            <input id="russianpost_registryParcelOnline_from_location" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.from.location"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование улицы отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_street_value">
                            <input id="russianpost_registryParcelOnline_from_street" class="span6" placeholder="" type="text" value="Московская" name="russianpost.registryParcelOnline.from.street"> </td>
                        <td>Московская</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер здания</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно для заполнения при указании типов адреса: «стандартный», «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_house_value">
                            <input id="russianpost_registryParcelOnline_from_house" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.from.house"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Литера</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_houseLetter_value">
                            <input id="russianpost_registryParcelOnline_from_houseLetter" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.from.houseLetter"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Дробь</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_houseSlash_value">
                            <input id="russianpost_registryParcelOnline_from_houseSlash" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.from.houseSlash"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Корпус</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_houseCorpus_value">
                            <input id="russianpost_registryParcelOnline_from_houseCorpus" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.from.houseCorpus"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Строение</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_houseBuilding_value">
                            <input id="russianpost_registryParcelOnline_from_houseBuilding" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.from.houseBuilding"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Название гостиницы</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно при типе адреса: «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_hotel_value">
                            <input id="russianpost_registryParcelOnline_from_hotel" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.from.hotel"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Номер помещения</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_from_hotelRoom_value">
                            <input id="russianpost_registryParcelOnline_from_hotelRoom" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.from.hotelRoom"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер контракта (договора)</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_numContract_value">
                            <input id="russianpost_registryParcelOnline_sender_numContract" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.sender.numContract"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_inn_value">
                            <input id="russianpost_registryParcelOnline_sender_inn" class="span6" placeholder="" type="text" value="123456789012" name="russianpost.registryParcelOnline.sender.inn"> </td>
                        <td>123456789012</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>КПП отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_kpp_value">
                            <input id="russianpost_registryParcelOnline_sender_kpp" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.sender.kpp"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Индекс ОПС, откуда поступило внутреннее отправление" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_indexOps_value">
                            <input id="russianpost_registryParcelOnline_sender_indexOps" class="span6" placeholder="" type="text" value="654321" name="russianpost.registryParcelOnline.sender.indexOps"> </td>
                        <td>654321</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ и форма оплаты услуг почтовой связи</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_pay_type_value">
                            <select id="russianpost_registryParcelOnline_pay_type" name="russianpost.registryParcelOnline.pay.type">
                                <option value="1" selected="selected">наличная</option>
                                <option value="2">безналичная</option>
                                <option value="4">бесплатно</option>
                                <option value="8">пластиковая карта</option>
                                <option value="16">государственные знаки почтовой оплаты марками</option>
                                <option value="32">предоплата (авансовый платеж)</option>
                                <option value="64">оплачено международному оператору</option>
                                <option value="128">оплачивается получателем</option>
                                <option value="256">государственные знаки почтовой оплаты франкирование</option>
                            </select>
                        </td>
                        <td>наличная</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория отправителя</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_category_value">
                            <select id="russianpost_registryParcelOnline_sender_category" name="russianpost.registryParcelOnline.sender.category">
                                <option value="1" selected="selected">население</option>
                                <option value="2">бюджетная организация</option>
                                <option value="3">хозрасчетная организация</option>
                                <option value="4">международный оператор</option>
                                <option value="5">корпоративный клиент</option>
                                <option value="6">почтовый оператор</option>
                            </select>
                        </td>
                        <td>население</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вид почтового отправления</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_mailType_value">
                            <select id="russianpost_registryParcelOnline_sender_mailType" name="russianpost.registryParcelOnline.sender.mailType">
                                <option value="0">не определено</option>
                                <option value="1">бланк почтового перевода</option>
                                <option value="2">письмо</option>
                                <option value="3">бандероль</option>
                                <option value="4" selected="selected">посылка</option>
                                <option value="5">мелкий пакет</option>
                                <option value="6">почтовая карточка</option>
                                <option value="7">отправление EMS</option>
                                <option value="8">секограмма</option>
                                <option value="9">мешок «М»</option>
                                <option value="10">прямой контейнер</option>
                                <option value="11">отправление электронной почты</option>
                                <option value="12">бланк уведомления</option>
                                <option value="13">газетная пачка</option>
                                <option value="14">сгруппированные отправления «Консигнация»</option>
                                <option value="15">письмо 1 класса</option>
                                <option value="16">бандероль 1 класса</option>
                                <option value="17">бланк уведомления 1 класса</option>
                                <option value="18">сумка страховая</option>
                                <option value="19">ОВПО</option>
                                <option value="20">мультиконверт</option>
                                <option value="21">МКПО</option>
                                <option value="23">Посылка онлайн</option>
                            </select>
                        </td>
                        <td>посылка</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_mailCtg_value">
                            <select id="russianpost_registryParcelOnline_sender_mailCtg" name="russianpost.registryParcelOnline.sender.mailCtg">
                                <option value="0">простое</option>
                                <option value="1">заказное</option>
                                <option value="2">с объявленной ценностью</option>
                                <option value="3" selected="selected">обыкновенное</option>
                                <option value="4">с объявленной ценностью и наложенным платежом</option>
                                <option value="5">не определена</option>
                                <option value="6">с объявленной ценностью и обязательным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Классификация почтового отправления</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_directCtg_value">
                            <select id="russianpost_registryParcelOnline_sender_directCtg" name="russianpost.registryParcelOnline.sender.directCtg">
                                <option value="1" selected="selected">внутренняя</option>
                                <option value="2">международная</option>
                            </select>
                        </td>
                        <td>внутренняя</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_transType_value">
                            <select id="russianpost_registryParcelOnline_sender_transType" name="russianpost.registryParcelOnline.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                                <option value="4">системой ускоренной почты</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка отправления</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_postMark_value">
                            <select id="russianpost_registryParcelOnline_sender_postMark" name="russianpost.registryParcelOnline.sender.postMark">
                                <option value="0">без отметки</option>
                                <option value="1" selected="selected">с простым уведомлением</option>
                                <option value="2">с заказным уведомлением</option>
                                <option value="4">с описью</option>
                                <option value="8">осторожно (хрупкая)</option>
                                <option value="16">тяжеловесная</option>
                                <option value="32">крупногабаритная (громоздкая)</option>
                                <option value="64">с доставкой (доставка нарочным)</option>
                                <option value="128">вручить в собственные руки</option>
                                <option value="256">с документами</option>
                                <option value="512">с товарами</option>
                                <option value="1024">возврату не подлежит</option>
                                <option value="2048">нестандартная</option>
                                <option value="4096">приграничная</option>
                                <option value="8192">застраховано</option>
                            </select>
                        </td>
                        <td>с простым уведомлением</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Разряд почтового отправления</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_mailRank_value">
                            <select id="russianpost_registryParcelOnline_sender_mailRank" name="russianpost.registryParcelOnline.sender.mailRank">
                                <option value="0" selected="selected">без разряда</option>
                                <option value="1">правительственное</option>
                                <option value="2">воинское</option>
                                <option value="3">служебное</option>
                                <option value="4">судебное</option>
                                <option value="5">президентское</option>
                                <option value="6">кредитное</option>
                            </select>
                        </td>
                        <td>без разряда</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="При отстуствии заказной услуги выбрать поле «не использовать»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_notice_sms_value">
                            <select id="russianpost_registryParcelOnline_sender_notice_sms" name="russianpost.registryParcelOnline.sender.notice.sms">
                                <option value="0" selected="selected">не использовать</option>
                                <option value="1">SMS-уведомление о поступлении РПО в ОПС вручения</option>
                                <option value="2">SMS-уведомление о вручении РПО</option>
                            </select>
                        </td>
                        <td>не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_check_opis_region_value">
                            <select id="russianpost_registryParcelOnline_check_opis_region" name="russianpost.registryParcelOnline.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Упаковка</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_package_value">
                            <select id="russianpost_registryParcelOnline_package" name="russianpost.registryParcelOnline.package">
                                <option value="10" selected="selected">Коробка «S»</option>
                                <option value="11">Пакет полиэтиленовый «S»</option>
                                <option value="12">Конверт с воздушно-пузырчатой пленкой «S»</option>
                                <option value="20">Коробка «М»</option>
                                <option value="21">Пакет полиэтиленовый «М»</option>
                                <option value="22">Конверт с воздушно-пузырчатой пленкой «М»</option>
                                <option value="30">Коробка «L»</option>
                                <option value="31">Пакет полиэтиленовый «L»</option>
                                <option value="40">Коробка «ХL»</option>
                                <option value="41">Пакет полиэтиленовый «ХL»</option>
                            </select>
                        </td>
                        <td>Коробка «S»</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_declaredValueFix_value">
                            <input id="russianpost_registryParcelOnline_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpost.registryParcelOnline.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelOnline_weight_value">
                            <input id="ytrussianpost_registryParcelOnline_weight" type="hidden" value="0" name="russianpost.registryParcelOnline.weight">
                            <input id="russianpost_registryParcelOnline_weight" type="checkbox" value="1" name="russianpost.registryParcelOnline.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_weight_product_value">
                            <input id="russianpost_registryParcelOnline_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.registryParcelOnline.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelOnline_weight_package_value">
                            <input id="russianpost_registryParcelOnline_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.registryParcelOnline.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelOnline_weight_custom_value">
                            <select id="russianpost_registryParcelOnline_weight_custom" name="russianpost.registryParcelOnline.weight.custom">
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
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_sender_date_value">
                            <select id="russianpost_registryParcelOnline_sender_date" name="russianpost.registryParcelOnline.sender.date">
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
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_registryParcelOnline_rtm_version_value">
                            <input id="russianpost_registryParcelOnline_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.registryParcelOnline.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryParcelOnline_list_number_value">
                            <input id="russianpost_registryParcelOnline_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.registryParcelOnline.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Файлы *.txt и *.ini (для реестра ПО) Письмо с объявленной ценностью и наложенным платежом</div>
        <div class="spoiler-body collapse in" id="lv-postblank-registryLetter" style="" aria-expanded="true">
            <table id="lv-config-table-registryLetter" class="table table-bordered table-forms">
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
                            <b>Включает возможность использования выгрузки заказов в *.txt и .ini файл (для реестра ПО) Письмо с объявленной ценностью и наложенным платежом</b>
                        </td>
                        <td id="russianpost_registryLetter_use_value">
                            <input id="ytrussianpost_registryLetter_use" type="hidden" value="0" name="russianpost.registryLetter.use">
                            <input id="russianpost_registryLetter_use" type="checkbox" value="1" name="russianpost.registryLetter.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Ф.И.О. отправителя</b>
                        </td>
                        <td id="russianpost_registryLetter_from_name_value">
                            <input id="russianpost_registryLetter_from_name" class="span6" placeholder="" type="text" value="ИП Иванов Иван Иванович" name="russianpost.registryLetter.from.name"> </td>
                        <td>ИП Иванов Иван Иванович</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Телефон отправителя</b>
                        </td>
                        <td id="russianpost_registryLetter_from_phone_value">
                            <input id="russianpost_registryLetter_from_phone" class="span6" placeholder="" type="text" value="79888888888" name="russianpost.registryLetter.from.phone"> </td>
                        <td>79888888888</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип адреса</b>
                        </td>
                        <td id="russianpost_registryLetter_from_typeAddress_value">
                            <select id="russianpost_registryLetter_from_typeAddress" name="russianpost.registryLetter.from.typeAddress">
                                <option value="1" selected="selected">стандартный</option>
                                <option value="2">а/я</option>
                                <option value="3">до востребования</option>
                                <option value="4">гостиница</option>
                                <option value="5">войсковая часть</option>
                                <option value="6">войсковая часть ЮЯ</option>
                                <option value="7">полевая почта</option>
                            </select>
                        </td>
                        <td>стандартный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер абоненстого ящика</b>
                        </td>
                        <td id="russianpost_registryLetter_from_POBox_value">
                            <input id="russianpost_registryLetter_from_POBox" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.from.POBox"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс отправителя</b>
                        </td>
                        <td id="russianpost_registryLetter_from_postIndex_value">
                            <input id="russianpost_registryLetter_from_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.from.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Область, регион отправителя</b>
                        </td>
                        <td id="russianpost_registryLetter_from_region_value">
                            <input id="russianpost_registryLetter_from_region" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registryLetter.from.region"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Район отправителя</b>
                        </td>
                        <td id="russianpost_registryLetter_from_area_value">
                            <input id="russianpost_registryLetter_from_area" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.from.area"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Населенный пункт отправителя</b>
                        </td>
                        <td id="russianpost_registryLetter_from_city_value">
                            <input id="russianpost_registryLetter_from_city" class="span6" placeholder="" type="text" value="Москва" name="russianpost.registryLetter.from.city"> </td>
                        <td>Москва</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Внутригородской элемент</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Квартал, спутник, поселение, микрорайон, территория" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryLetter_from_location_value">
                            <input id="russianpost_registryLetter_from_location" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.from.location"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наименование улицы отправителя</b>
                        </td>
                        <td id="russianpost_registryLetter_from_street_value">
                            <input id="russianpost_registryLetter_from_street" class="span6" placeholder="" type="text" value="Московская" name="russianpost.registryLetter.from.street"> </td>
                        <td>Московская</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер здания</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно для заполнения при указании типов адреса: «стандартный», «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryLetter_from_house_value">
                            <input id="russianpost_registryLetter_from_house" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.from.house"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Литера</b>
                        </td>
                        <td id="russianpost_registryLetter_from_houseLetter_value">
                            <input id="russianpost_registryLetter_from_houseLetter" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.from.houseLetter"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Дробь</b>
                        </td>
                        <td id="russianpost_registryLetter_from_houseSlash_value">
                            <input id="russianpost_registryLetter_from_houseSlash" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.from.houseSlash"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Корпус</b>
                        </td>
                        <td id="russianpost_registryLetter_from_houseCorpus_value">
                            <input id="russianpost_registryLetter_from_houseCorpus" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.from.houseCorpus"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Строение</b>
                        </td>
                        <td id="russianpost_registryLetter_from_houseBuilding_value">
                            <input id="russianpost_registryLetter_from_houseBuilding" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.from.houseBuilding"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Название гостиницы</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Обязательно при типе адреса: «гостиница»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryLetter_from_hotel_value">
                            <input id="russianpost_registryLetter_from_hotel" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.from.hotel"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Часть здания. Номер помещения</b>
                        </td>
                        <td id="russianpost_registryLetter_from_hotelRoom_value">
                            <input id="russianpost_registryLetter_from_hotelRoom" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.from.hotelRoom"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Номер контракта (договора)</b>
                        </td>
                        <td id="russianpost_registryLetter_sender_numContract_value">
                            <input id="russianpost_registryLetter_sender_numContract" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.sender.numContract"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>ИНН отправителя</b>
                        </td>
                        <td id="russianpost_registryLetter_sender_inn_value">
                            <input id="russianpost_registryLetter_sender_inn" class="span6" placeholder="" type="text" value="123456789012" name="russianpost.registryLetter.sender.inn"> </td>
                        <td>123456789012</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>КПП отправителя</b>
                        </td>
                        <td id="russianpost_registryLetter_sender_kpp_value">
                            <input id="russianpost_registryLetter_sender_kpp" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.sender.kpp"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс ОПС</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Индекс ОПС, откуда поступило внутреннее отправление" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryLetter_sender_indexOps_value">
                            <input id="russianpost_registryLetter_sender_indexOps" class="span6" placeholder="" type="text" value="654321" name="russianpost.registryLetter.sender.indexOps"> </td>
                        <td>654321</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ и форма оплаты услуг почтовой связи</b>
                        </td>
                        <td id="russianpost_registryLetter_pay_type_value">
                            <select id="russianpost_registryLetter_pay_type" name="russianpost.registryLetter.pay.type">
                                <option value="1" selected="selected">наличная</option>
                                <option value="2">безналичная</option>
                                <option value="4">бесплатно</option>
                                <option value="8">пластиковая карта</option>
                                <option value="16">государственные знаки почтовой оплаты марками</option>
                                <option value="32">предоплата (авансовый платеж)</option>
                                <option value="64">оплачено международному оператору</option>
                                <option value="128">оплачивается получателем</option>
                                <option value="256">государственные знаки почтовой оплаты франкирование</option>
                            </select>
                        </td>
                        <td>наличная</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория отправителя</b>
                        </td>
                        <td id="russianpost_registryLetter_sender_category_value">
                            <select id="russianpost_registryLetter_sender_category" name="russianpost.registryLetter.sender.category">
                                <option value="1" selected="selected">население</option>
                                <option value="2">бюджетная организация</option>
                                <option value="3">хозрасчетная организация</option>
                                <option value="4">международный оператор</option>
                                <option value="5">корпоративный клиент</option>
                                <option value="6">почтовый оператор</option>
                            </select>
                        </td>
                        <td>население</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вид почтового отправления</b>
                        </td>
                        <td id="russianpost_registryLetter_sender_mailType_value">
                            <select id="russianpost_registryLetter_sender_mailType" name="russianpost.registryLetter.sender.mailType">
                                <option value="0">не определено</option>
                                <option value="1">бланк почтового перевода</option>
                                <option value="2">письмо</option>
                                <option value="3">бандероль</option>
                                <option value="4" selected="selected">посылка</option>
                                <option value="5">мелкий пакет</option>
                                <option value="6">почтовая карточка</option>
                                <option value="7">отправление EMS</option>
                                <option value="8">секограмма</option>
                                <option value="9">мешок «М»</option>
                                <option value="10">прямой контейнер</option>
                                <option value="11">отправление электронной почты</option>
                                <option value="12">бланк уведомления</option>
                                <option value="13">газетная пачка</option>
                                <option value="14">сгруппированные отправления «Консигнация»</option>
                                <option value="15">письмо 1 класса</option>
                                <option value="16">бандероль 1 класса</option>
                                <option value="17">бланк уведомления 1 класса</option>
                                <option value="18">сумка страховая</option>
                                <option value="19">ОВПО</option>
                                <option value="20">мультиконверт</option>
                                <option value="21">МКПО</option>
                                <option value="23">Посылка онлайн</option>
                            </select>
                        </td>
                        <td>посылка</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Категория почтового отправления</b>
                        </td>
                        <td id="russianpost_registryLetter_sender_mailCtg_value">
                            <select id="russianpost_registryLetter_sender_mailCtg" name="russianpost.registryLetter.sender.mailCtg">
                                <option value="0">простое</option>
                                <option value="1">заказное</option>
                                <option value="2">с объявленной ценностью</option>
                                <option value="3" selected="selected">обыкновенное</option>
                                <option value="4">с объявленной ценностью и наложенным платежом</option>
                                <option value="5">не определена</option>
                                <option value="6">с объявленной ценностью и обязательным платежом</option>
                            </select>
                        </td>
                        <td>обыкновенное</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Классификация почтового отправления</b>
                        </td>
                        <td id="russianpost_registryLetter_sender_directCtg_value">
                            <select id="russianpost_registryLetter_sender_directCtg" name="russianpost.registryLetter.sender.directCtg">
                                <option value="1" selected="selected">внутренняя</option>
                                <option value="2">международная</option>
                            </select>
                        </td>
                        <td>внутренняя</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Способ пересылки почтовых отправления</b>
                        </td>
                        <td id="russianpost_registryLetter_sender_transType_value">
                            <select id="russianpost_registryLetter_sender_transType" name="russianpost.registryLetter.sender.transType">
                                <option value="1" selected="selected">наземный</option>
                                <option value="2">авиа</option>
                                <option value="3">комбинированный</option>
                                <option value="4">системой ускоренной почты</option>
                            </select>
                        </td>
                        <td>наземный</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка отправления</b>
                        </td>
                        <td id="russianpost_registryLetter_sender_postMark_value">
                            <select id="russianpost_registryLetter_sender_postMark" name="russianpost.registryLetter.sender.postMark">
                                <option value="0">без отметки</option>
                                <option value="1" selected="selected">с простым уведомлением</option>
                                <option value="2">с заказным уведомлением</option>
                                <option value="4">с описью</option>
                                <option value="8">осторожно (хрупкая)</option>
                                <option value="16">тяжеловесная</option>
                                <option value="32">крупногабаритная (громоздкая)</option>
                                <option value="64">с доставкой (доставка нарочным)</option>
                                <option value="128">вручить в собственные руки</option>
                                <option value="256">с документами</option>
                                <option value="512">с товарами</option>
                                <option value="1024">возврату не подлежит</option>
                                <option value="2048">нестандартная</option>
                                <option value="4096">приграничная</option>
                                <option value="8192">застраховано</option>
                            </select>
                        </td>
                        <td>с простым уведомлением</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Разряд почтового отправления</b>
                        </td>
                        <td id="russianpost_registryLetter_sender_mailRank_value">
                            <select id="russianpost_registryLetter_sender_mailRank" name="russianpost.registryLetter.sender.mailRank">
                                <option value="0" selected="selected">без разряда</option>
                                <option value="1">правительственное</option>
                                <option value="2">воинское</option>
                                <option value="3">служебное</option>
                                <option value="4">судебное</option>
                                <option value="5">президентское</option>
                                <option value="6">кредитное</option>
                            </select>
                        </td>
                        <td>без разряда</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>SMS-уведомление</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="При отстуствии заказной услуги выбрать поле «не использовать»" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryLetter_sender_notice_sms_value">
                            <select id="russianpost_registryLetter_sender_notice_sms" name="russianpost.registryLetter.sender.notice.sms">
                                <option value="0" selected="selected">не использовать</option>
                                <option value="1">SMS-уведомление о поступлении РПО в ОПС вручения</option>
                                <option value="2">SMS-уведомление о вручении РПО</option>
                            </select>
                        </td>
                        <td>не использовать</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Регион отправки, используется для расчета стоимости описи</b>
                        </td>
                        <td id="russianpost_registryLetter_check_opis_region_value">
                            <select id="russianpost_registryLetter_check_opis_region" name="russianpost.registryLetter.check.opis.region">
                                <option value="22" selected="selected">Алтайский край</option>
                                <option value="28">Амурская область</option>
                                <option value="29">Архангельская область</option>
                                <option value="30">Астраханская область</option>
                                <option value="31">Белгородская область</option>
                                <option value="32">Брянская область</option>
                                <option value="33">Владимирская область</option>
                                <option value="34">Волгоградская область</option>
                                <option value="35">Вологодская область</option>
                                <option value="36">Воронежская область</option>
                                <option value="79">Еврейская автономная область</option>
                                <option value="75">Забайкальский край</option>
                                <option value="37">Ивановская область</option>
                                <option value="38">Иркутская область</option>
                                <option value="7">Кабардино-Балкарская республика</option>
                                <option value="39">Калининградская область</option>
                                <option value="40">Калужская область</option>
                                <option value="41">Камчатский край</option>
                                <option value="9">Карачаево-Черкесская республика</option>
                                <option value="42">Кемеровская область</option>
                                <option value="43">Кировская область</option>
                                <option value="44">Костромская область</option>
                                <option value="23">Краснодарский край</option>
                                <option value="24">Красноярский край</option>
                                <option value="45">Курганская область</option>
                                <option value="46">Курская область</option>
                                <option value="47">Ленинградская область</option>
                                <option value="48">Липецкая область</option>
                                <option value="49">Магаданская область</option>
                                <option value="77">Москва</option>
                                <option value="50">Московская область</option>
                                <option value="51">Мурманская область</option>
                                <option value="83">Ненецкий автономный округ</option>
                                <option value="52">Нижегородская область</option>
                                <option value="53">Новгородская область</option>
                                <option value="54">Новосибирская область</option>
                                <option value="55">Омская область</option>
                                <option value="56">Оренбургская область</option>
                                <option value="57">Орловская область</option>
                                <option value="58">Пензенская область</option>
                                <option value="59">Пермский край</option>
                                <option value="25">Приморский край</option>
                                <option value="60">Псковская область</option>
                                <option value="1">Республика Адыгея</option>
                                <option value="4">Республика Алтай</option>
                                <option value="2">Республика Башкортостан</option>
                                <option value="3">Республика Бурятия</option>
                                <option value="5">Республика Дагестан</option>
                                <option value="6">Республика Ингушетия</option>
                                <option value="8">Республика Калмыкия</option>
                                <option value="10">Республика Карелия</option>
                                <option value="11">Республика Коми</option>
                                <option value="91">Республика Крым</option>
                                <option value="12">Республика Марий Эл</option>
                                <option value="13">Республика Мордовия</option>
                                <option value="14">Республика Саха (Якутия)</option>
                                <option value="15">Республика Северная Осетия — Алания</option>
                                <option value="16">Республика Татарстан</option>
                                <option value="17">Республика Тыва</option>
                                <option value="19">Республика Хакасия</option>
                                <option value="61">Ростовская область</option>
                                <option value="62">Рязанская область</option>
                                <option value="63">Самарская область</option>
                                <option value="78">Санкт-Петербург</option>
                                <option value="64">Саратовская область</option>
                                <option value="65">Сахалинская область</option>
                                <option value="66">Свердловская область</option>
                                <option value="92">Севастополь</option>
                                <option value="67">Смоленская область</option>
                                <option value="26">Ставропольский край</option>
                                <option value="68">Тамбовская область</option>
                                <option value="69">Тверская область</option>
                                <option value="70">Томская область</option>
                                <option value="71">Тульская область</option>
                                <option value="72">Тюменская область</option>
                                <option value="18">Удмуртская республика</option>
                                <option value="73">Ульяновская область</option>
                                <option value="27">Хабаровский край</option>
                                <option value="86">Ханты-Мансийский автономный округ - Югра</option>
                                <option value="74">Челябинская область</option>
                                <option value="20">Чеченская республика</option>
                                <option value="21">Чувашская республика</option>
                                <option value="87">Чукотский автономный округ</option>
                                <option value="89">Ямало-Ненецкий автономный округ</option>
                                <option value="76">Ярославская область</option>
                            </select>
                        </td>
                        <td>Алтайский край</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Упаковка</b>
                        </td>
                        <td id="russianpost_registryLetter_package_value">
                            <select id="russianpost_registryLetter_package" name="russianpost.registryLetter.package">
                                <option value="10" selected="selected">Коробка «S»</option>
                                <option value="11">Пакет полиэтиленовый «S»</option>
                                <option value="12">Конверт с воздушно-пузырчатой пленкой «S»</option>
                                <option value="20">Коробка «М»</option>
                                <option value="21">Пакет полиэтиленовый «М»</option>
                                <option value="22">Конверт с воздушно-пузырчатой пленкой «М»</option>
                                <option value="30">Коробка «L»</option>
                                <option value="31">Пакет полиэтиленовый «L»</option>
                                <option value="40">Коробка «ХL»</option>
                                <option value="41">Пакет полиэтиленовый «ХL»</option>
                            </select>
                        </td>
                        <td>Коробка «S»</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Фиксированная объявленная ценность</b>
                        </td>
                        <td id="russianpost_registryLetter_declaredValueFix_value">
                            <input id="russianpost_registryLetter_declaredValueFix" class="span6" placeholder="" type="text" value="" name="russianpost.registryLetter.declaredValueFix"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада и считать тариф</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса и подсчета тарифа Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryLetter_weight_value">
                            <input id="ytrussianpost_registryLetter_weight" type="hidden" value="0" name="russianpost.registryLetter.weight">
                            <input id="russianpost_registryLetter_weight" type="checkbox" value="1" name="russianpost.registryLetter.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_registryLetter_weight_product_value">
                            <input id="russianpost_registryLetter_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.registryLetter.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryLetter_weight_package_value">
                            <input id="russianpost_registryLetter_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.registryLetter.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryLetter_weight_custom_value">
                            <select id="russianpost_registryLetter_weight_custom" name="russianpost.registryLetter.weight.custom">
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
                            <b>Дата формирования отчета</b>
                        </td>
                        <td id="russianpost_registryLetter_sender_date_value">
                            <select id="russianpost_registryLetter_sender_date" name="russianpost.registryLetter.sender.date">
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
                            <b>Версия РТМ</b>
                        </td>
                        <td id="russianpost_registryLetter_rtm_version_value">
                            <input id="russianpost_registryLetter_rtm_version" class="span6" placeholder="" type="text" value="RTM0003-07-13" name="russianpost.registryLetter.rtm.version"> </td>
                        <td>RTM0003-07-13</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Уникальный номер списка партионной почты в день сдачи списка</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="С этого номера начнется нумерация" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_registryLetter_list_number_value">
                            <input id="russianpost_registryLetter_list_number" class="span6" placeholder="" type="text" value="1" name="russianpost.registryLetter.list.number"> </td>
                        <td>1</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Бланк отчета для почты России</div>
        <div class="spoiler-body collapse in" id="lv-postblank-report" style="" aria-expanded="true">
            <table id="lv-config-table-report" class="table table-bordered table-forms">
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
                            <b>Включает возможность использования выгрузки бланка отчета для почты России</b>
                        </td>
                        <td id="russianpost_report_use_value">
                            <input id="ytrussianpost_report_use" type="hidden" value="0" name="russianpost.report.use">
                            <input id="russianpost_report_use" type="checkbox" value="1" name="russianpost.report.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вид почтового отправления</b>
                        </td>
                        <td id="russianpost_report_sender_mailType_value">
                            <select id="russianpost_report_sender_mailType" name="russianpost.report.sender.mailType">
                                <option value="0">не определено</option>
                                <option value="1">бланк почтового перевода</option>
                                <option value="2">письмо</option>
                                <option value="3">бандероль</option>
                                <option value="4" selected="selected">посылка</option>
                                <option value="5">мелкий пакет</option>
                                <option value="6">почтовая карточка</option>
                                <option value="7">отправление EMS</option>
                                <option value="8">секограмма</option>
                                <option value="9">мешок «М»</option>
                                <option value="10">прямой контейнер</option>
                                <option value="11">отправление электронной почты</option>
                                <option value="12">бланк уведомления</option>
                                <option value="13">газетная пачка</option>
                                <option value="14">сгруппированные отправления «Консигнация»</option>
                                <option value="15">письмо 1 класса</option>
                                <option value="16">бандероль 1 класса</option>
                                <option value="17">бланк уведомления 1 класса</option>
                                <option value="18">сумка страховая</option>
                                <option value="19">ОВПО</option>
                                <option value="20">мультиконверт</option>
                                <option value="21">МКПО</option>
                                <option value="23">Посылка онлайн</option>
                                <option value="47">Посылка 1 класса</option>
                            </select>
                        </td>
                        <td>посылка</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Выводить вес со склада</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Для корректного отображения веса Вам необходимо заполнить вес товара на складе" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_report_weight_value">
                            <input id="ytrussianpost_report_weight" type="hidden" value="0" name="russianpost.report.weight">
                            <input id="russianpost_report_weight" type="checkbox" value="1" name="russianpost.report.weight"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес единицы товара в граммах</b>
                        </td>
                        <td id="russianpost_report_weight_product_value">
                            <input id="russianpost_report_weight_product" class="span6" placeholder="" type="text" value="0" name="russianpost.report.weight.product"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес упаковки в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес через запятую, где каждое новое число будет соответствовать весу упаковки при определенном количестве товаров" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_report_weight_package_value">
                            <input id="russianpost_report_weight_package" class="span6" placeholder="" type="text" value="0" name="russianpost.report.weight.package"> </td>
                        <td>0</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Вес товара вручную в граммах</b>
                            <a rel="popover" class="icon icon-comment" data-html="true" data-trigger="hover" data-content="Вы можете указать вес товара вручую, задав из какого доп. поля его нужно взять" data-original-title="" title="">
                            </a>
                        </td>
                        <td id="russianpost_report_weight_custom_value">
                            <select id="russianpost_report_weight_custom" name="russianpost.report.weight.custom">
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
                </tbody>
            </table>
        </div>
    </div>
    <div class="spoiler">
        <div class="spoiler-btn">Бланк заявления - указания</div>
        <div class="spoiler-body collapse in" id="lv-postblank-statement" style="" aria-expanded="true">
            <table id="lv-config-table-statement" class="table table-bordered table-forms">
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
                            <b>Использовать бланк «Заявления - указания»</b>
                        </td>
                        <td id="russianpost_statement_use_value">
                            <input id="ytrussianpost_statement_use" type="hidden" value="0" name="russianpost.statement.use">
                            <input id="russianpost_statement_use" type="checkbox" value="1" name="russianpost.statement.use"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отправитель</b>
                        </td>
                        <td id="russianpost_statement_sender_name_value">
                            <input id="russianpost_statement_sender_name" class="span6" placeholder="" type="text" value="" name="russianpost.statement.sender.name"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Телефон отправителя</b>
                        </td>
                        <td id="russianpost_statement_sender_phone_value">
                            <input id="russianpost_statement_sender_phone" class="span6" placeholder="" type="text" value="" name="russianpost.statement.sender.phone"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Индекс отправителя</b>
                        </td>
                        <td id="russianpost_statement_sender_postIndex_value">
                            <input id="russianpost_statement_sender_postIndex" class="span6" placeholder="" type="text" value="" name="russianpost.statement.sender.postIndex"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Город отправителя</b>
                        </td>
                        <td id="russianpost_statement_sender_city_value">
                            <input id="russianpost_statement_sender_city" class="span6" placeholder="" type="text" value="" name="russianpost.statement.sender.city"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Адрес отправитель</b>
                        </td>
                        <td id="russianpost_statement_sender_address_value">
                            <input id="russianpost_statement_sender_address" class="span6" placeholder="" type="text" value="" name="russianpost.statement.sender.address"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Паспорт: серия</b>
                        </td>
                        <td id="russianpost_statement_sender_document_seriya_value">
                            <input id="russianpost_statement_sender_document_seriya" class="span6" placeholder="" type="text" value="" name="russianpost.statement.sender.document.seriya"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Паспорт: номер</b>
                        </td>
                        <td id="russianpost_statement_sender_document_nomer_value">
                            <input id="russianpost_statement_sender_document_nomer" class="span6" placeholder="" type="text" value="" name="russianpost.statement.sender.document.nomer"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Паспорт: выдан (дата)</b>
                        </td>
                        <td id="russianpost_statement_sender_document_vydan_date_value">
                            <input id="russianpost_statement_sender_document_vydan_date" class="span6" placeholder="" type="text" value="" name="russianpost.statement.sender.document.vydan.date"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Паспорт: выдан (кем)</b>
                        </td>
                        <td id="russianpost_statement_sender_document_vydan_kem_value">
                            <input id="russianpost_statement_sender_document_vydan_kem" class="span6" placeholder="" type="text" value="" name="russianpost.statement.sender.document.vydan.kem"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Паспорт: код подразделения </b>
                        </td>
                        <td id="russianpost_statement_sender_document_code_value">
                            <input id="russianpost_statement_sender_document_code" class="span6" placeholder="" type="text" value="" name="russianpost.statement.sender.document.code"> </td>
                        <td></td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Тип отправления</b>
                        </td>
                        <td id="russianpost_statement_mailCategory_value">
                            <select id="russianpost_statement_mailCategory" name="russianpost.statement.mailCategory">
                                <option value="1" selected="selected">Регистрируемое</option>
                                <option value="2">Почтовая карточка</option>
                                <option value="3">Посылка</option>
                                <option value="4">Письмо</option>
                                <option value="5">Почтовый контейнер</option>
                                <option value="6">Бандероль</option>
                                <option value="7">Мелкий пакет</option>
                                <option value="8">Мешок М</option>
                                <option value="9">Секограмма</option>
                            </select>
                        </td>
                        <td>Регистрируемое</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Наложенный платеж</b>
                        </td>
                        <td id="russianpost_statement_type_naloj_value">
                            <input id="ytrussianpost_statement_type_naloj" type="hidden" value="0" name="russianpost.statement.type.naloj">
                            <input id="russianpost_statement_type_naloj" type="checkbox" value="1" name="russianpost.statement.type.naloj"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>С объявленной ценностью</b>
                        </td>
                        <td id="russianpost_statement_type_ob_value">
                            <input id="ytrussianpost_statement_type_ob" type="hidden" value="0" name="russianpost.statement.type.ob">
                            <input id="russianpost_statement_type_ob" type="checkbox" value="1" name="russianpost.statement.type.ob"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка: о  возврате</b>
                        </td>
                        <td id="russianpost_statement_info_return_value">
                            <input id="ytrussianpost_statement_info_return" type="hidden" value="0" name="russianpost.statement.info.return">
                            <input id="russianpost_statement_info_return" type="checkbox" value="1" name="russianpost.statement.info.return"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка: об изменении</b>
                        </td>
                        <td id="russianpost_statement_info_correction_value">
                            <input id="ytrussianpost_statement_info_correction" type="hidden" value="0" name="russianpost.statement.info.correction">
                            <input id="russianpost_statement_info_correction" type="checkbox" value="1" name="russianpost.statement.info.correction"> </td>
                        <td>НЕТ</td>
                        <!--<td><a class="icon-wrench" href=""></a></td>-->
                    </tr>
                    <tr>
                        <td>
                            <b>Отметка: о продлении срока хранения</b>
                        </td>
                        <td id="russianpost_statement_info_extendedStorage_value">
                            <input id="ytrussianpost_statement_info_extendedStorage" type="hidden" value="0" name="russianpost.statement.info.extendedStorage">
                            <input id="russianpost_statement_info_extendedStorage" type="checkbox" value="1" name="russianpost.statement.info.extendedStorage"> </td>
                        <td>НЕТ</td>
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