<?php
namespace lib;
#########################################################
# kassa.init.php
#
# Инициализация кассы (общий файл) для всех обработчиков
#
# История:  2016.10.18 - файл создан
#
#########################################################
#
	
	define( '_WEXEC', 1 );
    
    //инициализируем интерфейсы
    require_once $_SERVER["DOCUMENT_ROOT"].'/list.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/lib.php';
	CKassa::process_request();

?>