<?php
// Heading
$_['heading_title'] = '<img width="24" height="24" src="view/image/neoseo.png" style="float: left;"><span style="margin:0;line-height: 24px;">NeoSeo Email Informer</span>';
$_['heading_title_raw'] = 'NeoSeo Email Informer';

// Column
$_['column_status_name'] = 'Status Name';
$_['column_status'] = 'Send';
$_['column_template_subject'] = 'Letter subject';
$_['column_template_filename'] = 'Email Template';

// Text
$_['text_success'] = 'Module settings updated!';
$_['text_module'] = 'Modules';
$_['text_success_clear'] = 'The log file has been successfully cleared!';
$_['text_clear_log'] = 'Clear Log';
$_['text_select_template'] = 'Specify a template';
$_["text_new_order"] = 'New order received';
$_['text_customer_templates'] = 'Templates of letters to customers';
$_['text_admin_templates'] = 'Templates of letters to admins';
$_['text_force'] = 'Forced';
$_['text_module_version'] = '';

// Button
$_['button_save'] = 'Save';
$_['button_save_and_close'] = 'Save and Close';
$_['button_close'] = 'Close';
$_['button_clear_log'] = 'Clear Log';
$_['button_recheck'] = 'Check again';
$_['button_insert'] = 'Create';
$_['button_delete'] = 'Remove';

// Entry
$_['entry_status'] = 'Status:';
$_['entry_status_desc'] = 'Send letters when the order status changes';
$_['entry_force'] = 'Force:';
$_['entry_force_desc'] = 'Send email even if the "notify the buyer" option is not enabled:';
$_['entry_debug'] = 'Debug mode:';
$_['entry_debug_desc'] = 'In the system logs will be written various information for the developer module';
$_['entry_field_list_name'] = 'Template';
$_['entry_recipients'] = 'Recipients of admin messages:';
$_['entry_recipients_desc'] = 'Enter the recipients email addresses separated by commas..';
$_['entry_field_list_desc'] = 'Description';

// Tab
$_['tab_general'] = 'General';
$_['tab_templates'] = 'Email templates';
$_['tab_fields'] = 'Fields';
$_['tab_support'] = 'Support';
$_['tab_logs'] = 'Logs';
$_['tab_license'] = 'License';
$_['tab_templates_desc'] = 'Specify the correspondence patterns of letters to the statuses of orders';

// Field
$_['field_desc_product:start'] = 'Start of products section';
$_['field_desc_product_url'] = 'Product reference';
$_['field_desc_product_id'] = 'Product code';
$_['field_desc_product_image'] = 'Link to product image';
$_['field_desc_product_name'] = 'Product name';
$_['field_desc_product_model'] = 'Product Model';
$_['field_desc_product_quantity'] = 'Number of products';
$_['field_desc_product_price'] = 'Product Price';
$_['field_desc_product_price_gross'] = 'Price of product without taxes';
$_['field_desc_product_attribute'] = 'Product Attributes';
$_['field_desc_product_option'] = 'Product Options';
$_['field_desc_product_sku'] = 'Product number';
$_['field_desc_product_upc'] = 'UPC product';
$_['field_desc_product_tax'] = 'Product Taxes';
$_['field_desc_product_total'] = 'Product total';
$_['field_desc_product_total_gross'] = 'Total for the product without taxes';
$_['field_desc_product:stop'] = 'End of products section';
$_['field_desc_voucher:start'] = 'Beginning of the section of vouchers';
$_['field_desc_voucher_description'] = 'Name of voucher';
$_['field_desc_voucher_amount'] = 'Cost of voucher';
$_['field_desc_voucher:stop'] = 'End of section of vouchers';
$_['field_desc_tax:start'] = 'The beginning of the tax section';
$_['field_desc_tax_title'] = 'Tax Name';
$_['field_desc_tax_value'] = 'Tax amount';
$_['field_desc_tax:stop'] = 'The end of the tax section';
$_['field_desc_total:start'] = 'Beginning of the results section';
$_['field_desc_total_title'] = 'Name of the total';
$_['field_desc_total_value'] = 'Sum of total';
$_['field_desc_total:stop'] = 'End of the results section';
$_['field_desc_sub_total'] = 'Subtotal';
$_['field_desc_total'] = 'Total';
$_['field_desc_order_id'] = 'Order number';
$_['field_desc_invoice_number'] = 'Account number';
$_['field_desc_order_date'] = 'Order date';
$_['field_desc_status_name'] = 'Order status';
$_['field_desc_firstname'] = 'Customer name';
$_['field_desc_lastname'] = 'Customer subname';
$_['field_desc_email'] = 'Customer Email';
$_['field_desc_telephone'] = 'Customer`s phone number';
$_['field_desc_ip'] = 'Customer IP';
$_['field_desc_client_comment'] = 'Customer note';
$_['field_desc_date'] = 'Order date';
$_['field_desc_payment'] = 'Payment Information';
$_['field_desc_shipment'] = 'Information about delivery';
$_['field_desc_order_href'] = 'Link to the order';
$_['field_desc_store_url'] = 'Link to the store';
$_['field_desc_store_name'] = 'Name of shop';
$_['field_desc_comment'] = 'Note';
$_['field_desc_shipping_cost'] = 'Cost of delivery';
$_['field_desc_logo_url'] = 'Link to the logo';
$_['field_desc_shipping_country'] = 'Country of delivery';
$_['field_desc_shipping_zone'] = 'Shipping region';
$_['field_desc_shipping_city'] = 'City of delivery';
$_['field_desc_shipping_postcode'] = 'Postcode';
$_['field_desc_shipping_address_1'] = 'Address 1';
$_['field_desc_shipping_address_2'] = 'Address 2';

// Error
$_['error_permission'] = 'You do not have the rights to manage this module!';
$_['error_ioncube_missing'] = '';
$_['error_license_missing'] = '';

$_['mail_support'] = '';
$_['module_licence'] = '';$_['text_module_version']='9';
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
