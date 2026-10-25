<?php
########################################################
#	init.vars.php
#
#	Основные настройки, зависимые от сервера
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
#
	define( 'PROD',				$_SERVER['SERVER_ADDR'] != '127.0.0.1' );
	define( 'DEBUG',			false/*!PROD*/ );
	define( 'TEST_SERVER',		false );
	define( 'ROOT',				dirname(__FILE__).'/../../' );
	define( 'URI',				dirname($_SERVER['SCRIPT_NAME']) == '/' ? '' : dirname($_SERVER['SCRIPT_NAME']) );

	if( PROD ) {
		define( 'MYSQL_HOST',	'localhost' );
		define( 'MYSQL_USER',	'casting' );
		define( 'MYSQL_PSWD',	'diC83jdkCVUdhe' );
		define( 'MYSQL_DBNM',	'casting' );
	} else {
		define( 'MYSQL_HOST',	'localhost' );
		define( 'MYSQL_USER',	'root' );
		define( 'MYSQL_PSWD',	'' );
		define( 'MYSQL_DBNM',	'actors' );
	}
#
########################################################
#
	define( 'SMARTY_DEBUG_CONSOLE',		FALSE );

	// проверка на измененные шаблоны
	// (on production => false)
	define( 'SMARTY_COMPILE_CHECK',		false/*!PROD*/ );

	// принудительная компиляция шаблонов при каждом запуске
	// (on production => false )
	define( 'SMARTY_FORCE_COMPILE',		false/*!PROD*/ );

	// по умолчанию кеширование везде отключено
	define( 'SMARTY_CACHING',			FALSE );

	// отчет об ошибках компиляции
	// (on production => false)
	define( 'SMARTY_ERROR_REPORTING',	NULL );
#
########################################################
#
	define( 'CODE',				ROOT.'code/' );
	define( 'CACHE',			ROOT.'_temp/' );
	define( 'LOG_PATH',			CACHE.'logs/' );
	define( 'FRAMEWORK',		ROOT.'framework/' );
	define( 'SMARTY_FOLDER',	FRAMEWORK.'Smarty/' );
#
########################################################
?>
