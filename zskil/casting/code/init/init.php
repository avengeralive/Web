<?php
########################################################
#	init.php
#
#	Подключение требуемых файлов по умолчанию
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
#
	require_once dirname(__FILE__).'/init.vars.php';
	require_once CODE.'init/init.mysql.php';
	include_once CODE.'system/system.vars.php';
	if( DEBUG ) {
		timer_start( 'main' );
	}
#
########################################################
?>
