<?php

// Открываем сессию
// Open session
session_start();

// Подключаем необходимые служебные файлы и библиотеки
// Connect the necessary office and library files
include './includes/includes_login.php';

// Обработка ситуации при которой был запрос на добавление или удаление короткой ссылки
// Processing of the situation in which was a request for the addition or removal of short links
include './lib/update_shortlinks.php';

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