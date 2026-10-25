<?php

// Открываем сессию
// Open session
session_start();

// Яндекс.Касса checkUrl
// Yandeks.Kassa checkUrl
include './lib/finances_yk_check.php';

// Обработка ситуации при которой был платеж с лендинга
// Processing of the situation in which the payment was to Landing
include './lib/finances_paylanding.php';

// Подключаем необходимые служебные файлы и библиотеки
// Connect the necessary office and library files
include './includes/includes_login.php';

// Обработка ситуации при которой было пополнение баланса
// Processing of the situation in which it was recharge
include './lib/finances_paybalance.php';

// Обработка ситуации при которой был запрос вывод средств из системы
// Processing of the situation in which there was a request withdrawal from the system
include './lib/finances_vyvod.php';

// Обработка ситуации при которой были запросы связанные с выплатами пользователям
// Processing of the situation in which the questions were related to benefit users
include './lib/finances_vyplata.php';

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