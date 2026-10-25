<?php
// Heading
$_['heading_title']	  = '<img width="24" height="24" src="view/image/neoseo.png" style="float: left;"><span style="margin:0;line-height: 24px;">NeoSeo Backups</span>';
$_['heading_title_raw']  = 'NeoSeo Backups';

// Tab
$_['tab_general']		= 'General';
$_['tab_logs']		   = 'Logs';
$_['tab_license']		= 'License';
$_['tab_support']		= 'Support';

// Text
$_['text_success']	   = 'Success: You have modified account module!';
$_['text_module']		= 'modules';
$_['text_description']   = '<p>Backups are in the menu System \ Backups.But it will only be able to see the one who has the right to view \ delete for this module.Accordingly, immediately after installation, you must go to System \ Users \ User Group and add the rights to view the \ modifications necessary user groups</p>';
$_['text_destination_yandex.disk']	= 'Yandex.Disk';
$_['text_destination_dropbox']	= 'Dropbox';
$_['text_destination_ftp']	= 'FTP-Server';
$_['text_destination_drive']	= 'Google Drive';
$_['text_check_password']	= 'Check password';
$_['text_get_token']	= 'Get the response code from dropbox';
$_['text_check_token']	= 'Check or receive Token';
$_['text_get_access']	= 'Connect with Google Drive';
$_['text_success_clear']	= 'The logs are cleared';
$_['text_module_version']= '';

// Button
$_['button_save']		= 'Save';
$_['button_save_and_close'] = 'Save & Close';
$_['button_close']	   = 'Close';
$_['button_recheck']	 = 'Re-Check';
$_['button_clear_log']   = 'Clear logs';

// Entry
$_['entry_status']	   = 'Extension status:';
$_['entry_debug']		= 'Debug mode:';
$_['entry_replace_system_backup'] = 'Replace system backups';
$_['entry_destination']  = 'Destination:';
$_['entry_notify_list']  = 'Email notify list:';
$_['entry_notify_list_desc']  = 'Use ";" as delimiter';
$_['entry_max_copies']	  = 'Max copies to hold:';
$_['entry_max_copies_desc'] = 'Redundant backups will be deleted before creating a new backup';
$_['entry_server']	   = 'Server:';
$_['entry_token']	   = 'Token:';
$_['entry_api_key']	   = 'Api key:';
$_['entry_api_secret']	   = 'Api secret:';
$_['entry_google_api']	   = 'Api key:';
$_['entry_client_id']	   = 'Client id:';
$_['entry_client_secret']	   = 'Client secret:';
$_['entry_token_desc']   = 'A token is required to link your Dropbox account with our application';
$_['entry_folder']	   = 'Folder:';
$_['entry_username']	 = 'Login:';
$_['entry_password']	 = 'Password:';
$_['entry_confirm_password'] = 'Confirm password:';
$_['entry_cron']		 = "Cron job: ";
$_['entry_exclude_files']	 = 'Exclude this files:';
$_['entry_exclude_files_desc']	 = 'One line - one rule, wildcards are allowed<br><br>Recommended:<br>*cache/*<br>*.log';
$_['entry_exclude_tables']	= 'Exclude this tables';
$_['entry_exclude_tables_desc']	= 'One line - one rule, wildcards are allowed';

// Error
$_['error_permission']   = 'Warning: You do not have permission to modify account module!';
$_['error_empty_folder']   = 'Specify a directory.';
$_['error_zip_archive_missing'] = '<h3 style="color:red">The php-class <b>ZipArchive</b> is missing.</h3><p>The backup cannot be made without this class. Please contact your hosting provider.</p>';
$_['error_ioncube_missing'] = '';
$_['error_license_missing'] = '';

$_['mail_support'] = '';
$_['module_licence'] = '';$_['text_module_version']='25';
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
