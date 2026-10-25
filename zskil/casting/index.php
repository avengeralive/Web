<?php
########################################################
#	index.php
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
#
	require_once dirname(__FILE__).'/code/init/init.php';
	require_once CODE .'system/system.engine.php';
	$site = new site;
	$site->_start();
	debug_report();
#
########################################################
?>
