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
$page_title = 'Рассылки ';

$di = Registry::get('di');
$di->user = $user;

$mc = new MailingController;
$tpl = [
    'page' => 'index',
    'vars' => [],
];
try {
    $pageLoad = $mc->handleRequest($di);
} catch (Exception $e) {
    
}
if (!$pageLoad) {
    $pageLoad = $tpl;
}
// Подгружаем шаблон хидера
// Header template loaded

if ($pageLoad['page'] != 'templates') {
    include './templates/' . $template . '/in_header.php';
}

// Подгружаем шаблон контента страницы
// Loads the page content template


if (isset($pageLoad['vars'])) {
    foreach ($pageLoad['vars'] as $k => $v) {
        $k = 'var_' . $k;
        $$k = $v;
    }
}
echo '<div class="row cabinet main mt-50 mb-50">';
include './templates/' . $template . '/modules/mailing/' . $pageLoad['page'] . '.php';
echo '</div>';
// Подгружаем шаблон футера
// Loads the footer template
if ($pageLoad['page'] != 'templates') {
    include './templates/' . $template . '/in_footer.php';
}
