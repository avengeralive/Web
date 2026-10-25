<?php
#########################################################
#	init.static.php
#
#	Этот файл можно подключать, если не используется
#	движок сайта, но есть необходимость обращаться
#	к интерфейсам
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
#########################################################
#
	include_constants( 'lists' );
	include_constants( 'error' );
	include_constants( 'auth' );
	load_interface( 'lists' );
	load_interface( 'gets' );
	load_interface( 'settings' );
	load_interface( 'error' );
	load_interface( 'subdomains' );
	load_interface( 'user' );
	load_interface( 'rights' );
	load_interface( 'template' );
	load_interface( 'logs' );
	load_interface( 'cache' );
	load_interface( 'ankets' );

	if( DEBUG ) {
		timer_start( 'main' );
	}
#
#########################################################
?>
