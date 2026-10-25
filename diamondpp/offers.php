<?php

// Открываем сессию
// Open session
session_start();

// Подключаем необходимые служебные файлы и библиотеки
// Connect the necessary office and library files
include './includes/includes_login.php';

// Обработка ситуации при которой был запрос на изменение данных оффера
// Processing of the situation in which there was a request to change the data offera
try{
include './lib/offers_moderation.php';

// Обработка ситуации при которой был запрос на добавление нового оффера
// Processing of the situation in which there was a request to add a new offera
include './lib/offers_addoffer.php';

include './lib/offers_visible.php';

// Пишем в базу данные о посетителе
// Write in the visitor data base
include_once './includes/userslog/index.php';

// Подключаем системную ТДС
// Connect system TDS
include './includes/systemtds/index.php';

// Подгружаем шаблон хидера
// Header template loaded
include './templates/' . $template . '/in_header.php';

$user = User::getById(User::isAuth());
// Подгружаем шаблон контента страницы
// Loads the page content template
include './templates/' . $template . '/roles_pages/' . $user_tip . '/' . curr_file();
}catch(Exception $e){
	echo "<script>top.location='/';</script>";
	exit;
}
// Подгружаем шаблон футера
// Loads the footer template
include './templates/' . $template . '/in_footer.php';

include_once './includes/errors.php';
?>