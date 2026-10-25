<?php
########################################################
#	run-all.php
#
#	Запуск всех зарегистрированных КРОН-методов
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.01 - файл создан
#
########################################################
#
	define( 'CRON_MODE', true );
	require_once dirname(__FILE__).'/../init/init.cron.php';
	foreach( $cron->tasks as $task_name => $method_name )
	$cron->run_task( $task_name );
#
########################################################
?>
