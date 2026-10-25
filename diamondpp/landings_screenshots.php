<?php

// Открываем сессию
// Open session
session_start();

// Подключаем необходимые служебные файлы и библиотеки
// Connect the necessary office and library files
include './includes/includes_login.php';
// Пишем в базу данные о посетителе
// Write in the visitor data base
include_once './includes/userslog/index.php';

// Подключаем системную ТДС
// Connect system TDS
include './includes/systemtds/index.php';


$user = null;
if (isset($_SESSION['id'])) {
    $user = User::getById($_SESSION['id']);
}
$page_title = 'Мобильные скриншоты ';

$di = Registry::get('di');
$di->user = $user;

$mc = new ScreensController;
$tpl = [
    'page' => 'index',
    'vars' => [],
];
$pageLoad = false;
try {
    $pageLoad = $mc->handleRequest($di);
} catch (Exception $e) {
    
}
if (!$pageLoad) {
    $pageLoad = $tpl;
}
// Подгружаем шаблон хидера
// Header template loaded
include './templates/' . $template . '/in_header.php';

// Подгружаем шаблон контента страницы
// Loads the page content template


if (isset($pageLoad['vars'])) {
    foreach ($pageLoad['vars'] as $k => $v) {
        $k = 'var_' . $k;
        $$k = $v;
    }
}
include './templates/' . $template . '/modules/screens/' . $pageLoad['page'] . '.php';

// Подгружаем шаблон футера
// Loads the footer template
include './templates/' . $template . '/in_footer.php';
