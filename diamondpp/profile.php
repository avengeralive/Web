<?php

// Открываем сессию
// Open session
session_start();

// Подключаем необходимые служебные файлы и библиотеки
// Connect the necessary office and library files
include './includes/includes_login.php';

// Обработка ситуации при которой был запрос на изменение данных профиля
// Processing of the situation in which there was a request to change the profile data
include './lib/update_profile.php';

// Обработка ситуации при которой был запрос на получение повторного письма активации аккаунта
// Processing of the situation in which was a request for re-activation email account
include './lib/re_activate.php';

// Пишем в базу данные о посетителе
// Write in the visitor data base
include_once './includes/userslog/index.php';

// Подключаем системную ТДС
// Connect system TDS
include './includes/systemtds/index.php';
	
// Подгружаем шаблон хидера
// Header template loaded
include './templates/'.$template.'/in_header.php';

// Подгружаем шаблон контента страницы
// Loads the page content template
include './templates/'.$template.'/roles_pages/'.$user_tip.'/'.curr_file();

// Подгружаем шаблон футера
// Loads the footer template
include './templates/'.$template.'/in_footer.php';

?>