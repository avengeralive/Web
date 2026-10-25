<?php
########################################################
#	init.mysql.php
#
#	Подключение к БД
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
#
	$mysqli = new mysqli( MYSQL_HOST, MYSQL_USER, MYSQL_PSWD, MYSQL_DBNM );

	if( $mysqli->connect_error )
	exit( '<center>cannot connect to database</center>' );

	$mysqli->set_charset( 'utf8' );
	// $mysqli->set_charset( 'cp1251' );

	if( DEBUG ) {
		$mysqli->query( 'SET profiling=1' );
	}
#
########################################################
?>
