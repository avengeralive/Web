<?php

// Подключаем файл конфигурации
// Connect configuration file
include './includes/config.php';

// Подключаем настройки локализации
// Connect the localization settings
include './includes/localizations/index.php';

// Подключаем файл с функциями
// Connect to the file functions
include './includes/functions.php';

// Подключаем файл с настройками системы
// Connect the file system settings
include './includes/settings/index.php';

// Если в базе не задан текущий урл, или он не совпадает с текущим, то обновляем его
// If the database is not set to the current URL , or it does not match with the current ,then update it
 include './includes/checksiteurl/index.php';

// Подключаем файл с определением того, какую версию дизайна выводить
// Connect file with the definition of what type of design output version
include './includes/otladka/index.php';

// Подключаем файл локализации
// Connect the localization file
include './localizations/'.$localization_file;

// Назначаем TITLE для страницы
// Assign the TITLE of the page
$page_title = $loc[curr_file()]['title'];

?>