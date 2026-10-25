<?php
// Heading
$_['heading_title'] = '<img width="24" height="24" src="view/image/neoseo.png" style="float: left;"><p style="margin:0;line-height: 24px;">NeoSeo Blog</p>';
$_['heading_title_raw'] = 'NeoSeo Blog settings';

// Tab
$_['tab_general'] = 'Options';
$_['tab_logs'] = 'Logs';
$_['tab_fields'] = 'Fields';
$_['tab_support'] = 'Support';
$_['tab_license'] = 'License';

// Text
$_['text_success']                    = 'Settings changed!';
$_['text_edit']                       = 'Change settings';
$_['text_support']                    = 'Module Support';
$_['text_module'] = 'Modules';
$_['text_success_clear'] = 'The log file has been successfully cleared!';
$_['text_clear_log'] = 'Clear Log';
$_['text_module_version'] = '';

// Button
$_['button_save'] = 'Save';
$_['button_save_and_close'] = 'Save and Close';
$_['button_close'] = 'Close';
$_['button_recheck'] = 'Check again';
$_['button_clear_log'] = 'Clear Log';
$_['button_download_log'] = 'Download log file';

// Entry
$_['entry_add_to_menu']               = 'Add a link to a blog in the menu:';
$_['entry_debug'] = 'Debug mode:';
$_['entry_comment_auto_approval']     = 'AutoCheck comments:';
$_['entry_author_block_article']      = 'Add information about the author to the article:';
$_['entry_product_limit']             = 'Number of products in category:';
$_['entry_comment_limit']             = 'Number of comments:';
$_['entry_cache_results']             = 'Cache results:';
$_['entry_article_time_format']       = 'Time format for the article:';
$_['entry_comment_time_format']       = 'Time format for comments:';

$_['entry_meta_date']                 = 'Display the date in the article:';
$_['entry_meta_author']               = 'Display author in article:';
$_['entry_meta_comments']             = 'Display the number of comments in the article:';
$_['entry_meta_category']             = 'Display category in article:';

$_['entry_heading']                   = 'Headline blog:';
$_['entry_title']                     = 'Blog Title:';
$_['entry_meta_keyword']              = 'Meta Keywords:';
$_['entry_meta_description']          = 'Meta Description:';
$_['entry_articles_block_heading']    = 'Article block header:';
$_['entry_products_block_heading']    = 'Product block header:';
$_['entry_comments_block_heading']    = 'Comment block header:';
$_['entry_author_block_heading']      = 'Headline author\'s block:';
$_['entry_gallery_heading']           = 'The title of the gallery:';
$_['entry_share_social_code']         = 'Block code "Share":';

$_['entry_image_article']             = 'Article image size';
$_['entry_image_article_list']        = 'Article image size in category';
$_['entry_image_article_list_width']  = 'Article image width in category';
$_['entry_image_article_list_height'] = 'Article image height in category';

$_['entry_image_article_block']       = 'Image size of the article in the block';
$_['entry_image_article_block_width']       = 'Width of the image of the article in the block';
$_['entry_image_article_block_height']       = 'Height of the image of the article in the block';

$_['entry_image_product_block']       = 'The size of the product image in the block';
$_['entry_image_product_block_width']       = 'Width of the product image in the block';
$_['entry_image_product_block_height']       = 'Height of the product image in the block';

$_['entry_image_category_block']      = 'Category image size';
$_['entry_image_category_block_width']      = 'Image Category Width';
$_['entry_image_category_block_height']      = 'Image Category Height';

$_['entry_image_author_block']        = 'Image size of the author';
$_['entry_image_author_block_width']        = 'Image width of the author';
$_['entry_image_author_block_height']        = 'Image heigth of the author';

$_['entry_image_gallery_thumb']       = 'Image size of gallery';
$_['entry_width'] = 'Width';
$_['entry_height'] = 'Height';



// Help
$_['help_time_format'] = '<a href="http://php.net/manual/en/function.strftime.php" target="_blank">time formats</a>';

// Error
$_['error_permission'] = 'You do not have the right to change the blog settings!';
$_['error_download_logs'] = 'The log file is empty or missing!';
$_['error_ioncube_missing'] = '';
$_['error_license_missing'] = '';
$_['mail_support'] = '';
$_['module_licence'] = '';
$_['text_module_version'] = '';
$_['text_module_version']='25';
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
