<?php

// Защита от инжекта для передаваемых переменных
// Protection of Injection for the transmission of variables
include './includes/antiinject/index.php';

// Функция герерации строки из 50 случайных символов
// Function gereratsii string of 50 random characters
include './includes/genrand50sym/index.php';

// Функция отправки письма на почту
// Function of sending a letter to the post office
include './includes/sendemail/index.php';

// Функция генерация пароля
// Function password generation
include './includes/genpasswd/index.php';

// Функция пагинации
// Pagination feature
include './includes/pagination/index.php';

// Функция определения УРЛа и типа соединения (HTTP или HTTPS)
// Function definition of Urla and the connection type (HTTP or HTTPS)
include './includes/detecturl/index.php';
	
// Функция определения домена
// Function definition domain
include './includes/detectdomain/index.php';
	
// Функция определения текущего имени файла
// Function to determine the current file name
include './includes/detectfilename/index.php';

// Функция определения данных о посетителе
// Function definition of visitor data
include './includes/detectclient/index.php';

// Функция работы с куками посетителей
// Function works with cookies visitors
include './includes/usercookie/index.php';

// Функция кодирования и раскодирования патнерских идентификаторов
// Function of coding and decoding of partner IDs
include './includes/partnerstroka/index.php';

// Функция сокращения длинных строк
// Function to reduce long lines
include './includes/trimtext/index.php';

?>