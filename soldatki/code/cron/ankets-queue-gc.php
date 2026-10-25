<?php
########################################################
#	ankets-queue-gc.php
#
#	Garbage Collector для конвертированных медиа-файлов
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.17 - файл создан
#
########################################################
#
	define( 'CRON_MODE', true );
	require_once dirname(__FILE__).'/../init/init.cron.php';
	$cron->run_task( 'ankets-queue-gc' );
#
########################################################
?>
