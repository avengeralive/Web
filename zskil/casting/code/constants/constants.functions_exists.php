<?php
########################################################
#	constants.functions_exists.php
#
#	Константы наличия функций.
#	Для того, чтобы каждый раз не вызывать функции function_exists OR extension_loaded,
#	результат вызова помещается в константу
#
# + реализация отсутствующих на сервере
#	необходимых для работы модулей
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.01 - файл создан
#
########################################################
########################################################
#
	define( 'FUNC_EXISTS_GZDECODE',		function_exists('gzdecode') );
	define( 'FUNC_EXISTS_GZENCODE',		function_exists('gzencode') );
	define( 'FUNC_EXISTS_GZINFLATE',	function_exists('gzinflate') );
	define( 'FUNC_EXISTS_JSON_ENCODE',	function_exists('json_encode') );
	define( 'FUNC_EXISTS_JSON_DECODE',	function_exists('json_decode') );
	define( 'FUNC_EXISTS_ICONV',		extension_loaded('iconv') );
	define( 'FUNC_EXISTS_MB',			extension_loaded('mbstring') );
	define( 'FUNC_EXISTS_SOCKETS',		extension_loaded('sockets') );
	define( 'FUNC_EXISTS_FTP',			extension_loaded('ftp') );
	define( 'FUNC_EXISTS_SQLITE3',		extension_loaded('sqlite3') );
	define( 'EXT_LOADED_GD',			extension_loaded('gd') );
	define( 'MAGIC_QUOTES_ON',			get_magic_quotes_gpc() );
#
########################################################
#

	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	if( FUNC_EXISTS_ICONV )										#
	#iconv_set_encoding( 'internal_encoding', ENC );			#
	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	if( FUNC_EXISTS_MB ) {										#
		mb_internal_encoding( ENC );							#
	} else {													#
																#
		if( !FUNC_EXISTS_ICONV ) {								#
			include_constants( 'bicycle.iconv' );				#
			iconv_set_encoding( 'internal_encoding', ENC );		#
		}														#
																#
		include_constants( 'bicycle.mbstring' );				#
	}															#
	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	if( !FUNC_EXISTS_JSON_ENCODE || !FUNC_EXISTS_JSON_DECODE )	#
	include_constants( 'bicycle.json' );						#
	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	if( !FUNC_EXISTS_GZDECODE || !FUNC_EXISTS_GZENCODE )		#
	include_constants( 'bicycle.gzip' );						#
	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	if( !function_exists('hex2bin') ){
	function hex2bin( $str ) {
		$sbin = "";
		$len = strlen( $str );
		for ( $i = 0; $i < $len; $i += 2 ) {
			$sbin .= pack( "H*", substr( $str, $i, 2 ) );
		}

		return $sbin;
	}}
#
#
########################################################
?>
