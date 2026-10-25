<?php

// Heading
$_['heading_title'] = '<img width="24" height="24" src="view/image/neoseo.png" style="float: left;"><p style="margin:0;line-height: 24px;">NeoSeo Оформление заказа';
$_['heading_title_raw'] = 'NeoSeo Оформление заказа';

// Tab
$_['tab_general'] = 'Основные';
$_['tab_customer'] = 'Покупатель';
$_['tab_payment'] = 'Оплата';
$_['tab_shipping'] = 'Доставка';
$_['tab_shipping_type'] = 'Типы доставки';
$_['tab_logs'] = 'Логи';
$_['tab_support'] = 'Поддержка';
$_['tab_license'] = 'Лицензия';



// Text
$_['text_module'] = 'Модули';
$_['text_success'] = 'Успех: Вы успешно изменили настройки модуля NeoSeo Оформление заказа!';
$_['text_title'] = 'Оформление заказа';
$_['text_radio_type'] = 'Переключатель';
$_['text_select_type'] = 'Список';
$_['text_text_type'] = 'Text Type';
$_['text_city_select_default'] = 'Вручную вводить страну и регион';
$_['text_city_select_cities'] = 'Автоматическая подставновка страны и региона по названию города';
$_['text_clear_log'] = 'Очистить логи';
$_['text_success_clear'] = 'Логи успешно очищены';
$_['text_type-0'] = 'Физическое лицо';
$_['text_type-1'] = 'Юридическое лицо';
$_['text_dependency_disabled'] = 'Оплата и доставка не зависят друг от друга';
$_['text_dependency_payment_for_shipping'] = 'Оплата зависит от доставки';
$_['text_dependency_shipping_for_payment'] = 'Доставка зависит от оплаты';
$_['text_types_of_customers'] = 'Типы покупателей';
$_['text_block_customers'] = 'Поля для блока "Покупатель":';
$_['text_block_payment'] = 'Поля для метода оплаты';
$_['text_block_shipping'] = 'Поля для метода доставки';
$_['text_shipping'] = 'Метод доставки';
$_['text_payment'] = 'Метод оплаты';
$_['text_type_shipping'] = 'Тип доставки';
$_['text_pick_your_own'] = 'Забрать самостоятельно';
$_['text_order_delivery'] = 'Заказать доставку';
$_['text_select_all'] = 'Выделить все';
$_['text_name'] = 'Название:';
$_['text_field'] = 'Поле:';
$_['text_type'] = 'Тип:';
$_['text_identifier'] = 'Идентификатор:';
$_['text_mask'] = 'Маска ввода:';
$_['text_initial_value'] = 'Начальное значение:';
$_['text_show'] = 'Показывать:';
$_['text_required'] = 'Обязательное:';
$_['text_only_register'] = 'Только для регистрации:';

// Entry
$_['entry_status'] = 'Состояние: <a class="tooltip-trigger" title="Central function to turn on/off this extension."><i class="fa fa-question-circle"></i></a>';
$_['entry_payment_logo'] = 'Показывать логотип метода оплаты: <a class="tooltip-trigger" title="Display the payment logo for payment methods. This only works when payment method is displayed in radio mode."><i class="fa fa-question-circle"></i></a>';
$_['entry_payment_control'] = 'Выбор метода оплаты: <a class="tooltip-trigger" title="Sets the mode payment methods are displayed in. Either radio buttons or select drop down."><i class="fa fa-question-circle"></i></a>';
$_['entry_shipping_control'] = 'Выбор метода доставки: <a class="tooltip-trigger" title="Sets the mode shipping methods are displayed in. Either radio buttons or select drop down."><i class="fa fa-question-circle"></i></a>';
$_['entry_shipping_city_select'] = 'Ввод города';
$_['entry_shipping_country_select'] = 'Ввод страны';
$_['entry_shipping_country_default'] = 'Страна по умолчанию';
$_['entry_shipping_title'] = 'Вывод названия группы доставок';
$_['entry_shipping_novaposhta'] = 'Метод доставки для новой почты';
$_['entry_compact'] = 'Компактный вывод';
$_['entry_agreement_id'] = 'Требовать принятие условий соглашения';
$_['entry_agreement_default'] = 'Начальное значение для галки "Я принимаю условия соглашения"';
$_['entry_agreement_text'] = 'Выводить требования текстом';
$_['entry_stock_control'] = 'Проверять наличие товара из корзины';
$_['entry_min_amount'] = 'Минимальная сумма заказа';
$_['entry_use_shipping_type'] = 'Использовать типы доставки';
$_['entry_dependency_type'] = 'Тип зависимости';
$_['entry_dropped_cart_template'] = 'Шаблон сообщения брошенной корзины';
$_['entry_dropped_cart_email_subject'] = 'Тема сообщения брошенной корзины';
$_['entry_onestep'] = 'Оформление в 1 шаг';
$_['entry_cart_redirect'] = 'Перенаправлять с корзины на оплату';
$_['entry_hide_menu'] = 'Скрыть меню во время офрмления заказа';
$_['entry_api_key'] = 'API key Новой почты';
$_['entry_api_key_desc'] = 'Используется для обновления отделений новой почты. <a href="https://devcenter.novaposhta.ua/" target="_blank">Получить ключ</a>';

// Technical
$_['entry_debug'] = 'Отладка: <a class="tooltip-trigger" title="Turn on debug mode for checkout. Only turn this on if you know what you are doing."><i class="fa fa-question-circle"></i></a>';
$_['entry_payment_reloads_cart'] = 'Обновлять корзину при смене метода оплаты: <a class="tooltip-trigger" title="Only enable if your payment methods have surcharges. Disable to reduce ajax requests."><i class="fa fa-question-circle"></i></a>';
$_['entry_shipping_reloads_cart'] = 'Обновлять корзину при смене метода доставки: <a class="tooltip-trigger" title="Only enable if your payment methods are dependent on your shipping methods. Disable to reduce ajax requests."><i class="fa fa-question-circle"></i></a>';


// Module
$_['entry_coupon'] = 'Display Coupon Module: <a class="tooltip-trigger" title="Turn on/off the coupon module on the checkout page."><i class="fa fa-question-circle"></i></a>';
$_['entry_voucher'] = 'Display Voucher Module: <a class="tooltip-trigger" title="Turn on/off the voucher module on the checkout page."><i class="fa fa-question-circle"></i></a>';
$_['entry_reward'] = 'Display Reward Module: <a class="tooltip-trigger" title="Turn on/off the reward module on the checkout page."><i class="fa fa-question-circle"></i></a>';
$_['entry_cart'] = 'Display Cart Module: <a class="tooltip-trigger" title="Turn on/off the cart module on the checkout page."><i class="fa fa-question-circle"></i></a>';
$_['entry_shipping_module'] = 'Display Shipping Method Module: <a class="tooltip-trigger" title="Turn on/off the shipping method module on the checkout page."><i class="fa fa-question-circle"></i></a>';
$_['entry_payment_module'] = 'Display Payment Method Module: <a class="tooltip-trigger" title="Turn on/off the payment method module on the checkout page."><i class="fa fa-question-circle"></i></a>';
$_['entry_login_module'] = 'Display Login Module: <a class="tooltip-trigger" title="Turn on/off the login module on the checkout page."><i class="fa fa-question-circle"></i></a>';

// Button
$_['button_add'] = 'Добавить';
$_['button_continue'] = 'Применить';
$_['button_save_and_close'] = 'Сохранить и Закрыть';
$_['button_clear_log'] = 'Очистить лог';

// Error
$_['error_permission'] = '';
$_['error_ioncube_missing'] = '';
$_['error_license_missing'] = '';

$_['mail_support'] = '';
$_['module_licence'] = '';
$_['text_module_version'] = '';
$_['text_module_version']='22';
$_['error_license_missing']='<h3 style="color:red">Отсутствует файл лицензии!</h3>

<p>Для получения файла лицензии свяжитесь с разработчиком модуля  по email <a href="mailto:license@neoseo.com.ua">license@neoseo.com.ua</a>, при этом указав:</p>
<ul>
	<li>название сайта, на котором вы купили модуль. Например, opencartforum.com</li>
	<li>название модуля, который вы купили. Например, NeoSeo Обмен с 1с</li>
	<li>ваш ник на этом сайте. Например, alexsoftdev</li>
	<li>номер заказа на этом сайте. Например, 355446</li>
	<li>основной домен сайта для активации лицензии. Например lamoda.ru</li>
	<li>тестовый домен сайта для разработки. Например, lamoda.neoseo.com.ua</li>
</ul>

<p>Полученный файл лицензии положите в корень сайта, т.е. рядом с файлом robots.txt и нажмите кнопку "Проверить еще раз".</p>

<p>Вы можете не переживать что ваш файл лицензии кто-то украдет! Ваш файл лицензии сделан персонально для вас и не будет работать на другом домене</p>';
$_['error_ioncube_missing']='<h3 style="color:red">Отсутствует IonCube Loader!</h3>

<p>Чтобы пользоваться нашим модулем, вам нужно установить IonCube Loader. Ниже приводятся инструкции по установке IonCube Loader для разных случаев:</p>

<ul>
    <li>Если у вас shared-хостинг - <a href="http://neoseo.com.ua/articles/ioncube-loader-shared">http://neoseo.com.ua/articles/ioncube-loader-shared</a></li>
    <li>Если у вас VPS на ubuntu - <a href="http://neoseo.com.ua/articles/ioncube-loader-ubuntu">http://neoseo.com.ua/articles/ioncube-loader-ubuntu</a></li>
    <li>Если у вас VPS на centos - <a href="http://neoseo.com.ua/articles/ioncube-loader-centos">http://neoseo.com.ua/articles/ioncube-loader-centos</a></li>
</ul>

<p>Если у вас не выходит установить IonCube Loader самостоятельно, вы также можете попросить помощи у наших специалистов по адресу <a href="mailto:support@neoseo.com.ua">support@neoseo.com.ua</a>, указав где именно вы приобрели модуль, ваш ник на этом ресурсе и номер заказа.</p>';
$_['module_licence']='<h3 style="color:red">Благодарим вас за выбор нашего продукта!</h3>
<p>Все права на программный продукт, далее модуль, принадлежат <a href="http://neoseo.com.ua">Веб студии NeoSeo</a></p>
<p><b>Лицензия на данный модуль дает право на:</b>
    <ul>
        <li>активацию на <b>ОДИН домен</b>. Не на сайт, не на человека, не на студию. У вас несколько доменов подключены к одному сайту - значит вам нужно несколько лицензий.</li>
        <li>на использование на своем магазине или магазине клиента.</li>
        <li>бесплатные апдейты владельцам магазина в течение года после покупки, вне зависимости от того кто был установщиком модуля</li>
    </ul>
</p>
<p><b>Категорически запрещается:</b>
    <ul>
        <li>Публиковать модуль на других сайтах без уведомления автора</li>
        <li>Передавать модуль третьим лицам</li>
        <li>Продавать от своего имени без предварительной договоренности с автором</li>
        <li>Использовать нелицензионные версии модулей ( варез ). В случае нарушения, анулируются все покупки по домену без возврата денег</li>
    </ul>
</p>
<p><b>Отказ от ответственности:</b>
    <ul>
        <li>Автор модуля не несет какой либо ответственности за материальный и нематериальный ущерб, причиненный модулем. Вы используете модуль на свой страх и риск.</li>
        <li>Чтобы значительно минимизировать риски, вы можете <a href="https://opencartforum.com/files/file/1597-neoseo-rezervnye-kopii/" target="_blank">купить модуль NeoSeo Резервные копии</a>, который надежно защитит ваш магазин от потери данных, либо заказать комплексное обслуживание вашего магазина у автора <a href="mailto:info@neoseo.com.ua">info@neoseo.com.ua</a></li>
        <li>Автор оставляет за собой право в любой момент изменить условия лицензионного соглашения, без согласования с конечными пользователями его продуктов.</li>
        <li>В разрезе покупки модуля автор не предоставляет бесплатную поддержку модуля без явных указаний на ошибки в работе модуля.</li>
    </ul>
</p>';
$_['mail_support']='<h3 style="color:red">Благодарим вас за выбор нашего продукта!</h3>
<p><a href="https://neoseo.com.ua">Веб студия NeoSeo</a> прикладывает максимум усилий для того, чтобы наши продукты устанавливались как можно быстрее и проще, не создавая конфликтов с другими модулями и темами оформления, и доставляя клиентам только радость от использования продуктов</p>
<p>Однако это не всегда возможно, учитывая что opencart имеет очень слабые технические возможности для этого, поэтому просим отнестись к этим нюансам с пониманием.</p>
<p>Что <b>мы гарантируем</b>, и обеспечиваем бесплатно:</p>
<ul>
    <li>работу наших модулей на стандартной теме оформления opencart</li>
    <li>работу наших модулей на стандартной админке opencart</li>
</ul>
<p>Если у вас возникла проблема с работой модуля в этом контексте, то вы всегда можете запросить бесплатную техническую поддержку по адресу <a href="mailto:support@neoseo.com.ua">support@neoseo.com.ua</a>.</p>
<p>Что мы стараемся обеспечить, но <b>не гарантируем</b>:</p>
<ul>
    <li>работу наших модулей на НЕ стандартной теме оформления opencart</li>
    <li>работу наших модулей на НЕ стандартной админке opencart</li>
</ul>
<p>Как уже говорилось, заранее нельзя предусмотреть все нюансы чужих тем оформления, поэтому в случае проблем в этом ключе, мы обеспечиваем платную поддержку. Запросить ее, а также комплексное техническое обслуживание вашего магазина можно по адресу <a href="mailto:info@neoseo.com.ua">info@neoseo.com.ua</a></p>
<p><b>ВНИМАНИЕ!!!</b> Если вы испытываете трудности с установкой модулей, то вам не обязательно тратить свое драгоценное время на этот рутинный процесс. Позвольте нашим техническим специалистам выполнить это вместо Вас, а сэкономленное время вы сможете потратить на развитие своего бизнеса, семью и хобби. Заказать установку и техническое обслуживание можно по адресу <a href="mailto:info@neoseo.com.ua">info@neoseo.com.ua</a></p>';
