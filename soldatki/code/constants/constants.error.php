<?php
########################################################
#	constants.error.php
#
#	Коды ошибок
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.01 - файл создан
#
########################################################
#
	define( 'ERROR_AUTH',				1 );	# неправильный логин/пароль
	define( 'ERROR_USER_BLOCKED',		2 );	# IP заблокирован
	define( 'ERROR_USER_REGISTERED',	3 );	# пользователь на модерации
	define( 'ERROR_USER_DELETED',		4 );	# пользователь заблокирован
	define( 'ERROR_REG_BLOCKED',		5 );	# IP адрес заблокирован для регистраций
	define( 'ERROR_REQUEST_BLOCKED',	19 );	# превышен лимит заявок
	define( 'ERROR_RESTORE_BLOCKED',	24 );	# превышен лимит заявок на восстановление пароля

	define( 'ERROR_LIC_EMPTY',			20 );
	define( 'ERROR_LIC_WRONG_FORMAT',	21 );
	define( 'ERROR_LIC_WRONG_SALT',		22 );
	define( 'ERROR_LIC_WRONG_USER_ID',	23 );

	define( 'ERROR_404',				6 );	# not found 404
	define( 'ERROR_403',				7 );	# forbidden 403
	define( 'ERROR_500',				8 );	# internal server error 500

	define( 'ERROR_FILE_OPEN',			9 );	# ошибка открытия файла

	define( 'ERROR_HTTP_SOCKET_OPEN',	10 );	# ошибка открытия сокета
	define( 'ERROR_HTTP_3xx',			11 );	# ошибка перенаправления
	define( 'ERROR_HTTP_4xx',			12 );	# сервер вернул ошибку 4xx
	define( 'ERROR_HTTP_5xx',			13 );	# сервер вернул ошибку 5xx
	define( 'ERROR_HTTP_GZIP_NO_FUNC',	14 );	# сервер вернул сжатые данные, для которых не найдена функция для разархивирования

	define( 'ERROR_MAIL_SEND',			15 );

	define( 'ERROR_DB_FILTERED',		16 );
	define( 'ERROR_DB_TOO_SHORT',		17 );
	define( 'ERROR_DB_TOO_LONG',		18 );

	$JSON_ERR_CODES = array(
		'UNKNOWN'			=>	0,

		'NOT_FOUND'					=>	1,
		'QUERY_TOO_SHORT'			=>	2,
		'WRONG_PARAMS'				=>	3,
		'ERROR_DB_INSERT'			=>	4,
		'DB_INSERT_TOO_SHORT_DATA'	=>	5
	);
	$JSON_ERR_MSGS	=	array(
		'UNKNOWN' => 'неизвестная ошибка',

		'NOT_FOUND'					=> 'не найдено',
		'QUERY_TOO_SHORT'			=> 'слишком короткий запрос',
		'WRONG_PARAMS'				=> 'неправильный набор параметров',
		'ERROR_DB_INSERT'			=> 'ошибка занесения записи в БД',
		'DB_INSERT_TOO_SHORT_DATA'	=> 'длина данных слишком короткая'
	);
	$GLOBALS['JSON_ERR_CODES']	= &$JSON_ERR_CODES;
	$GLOBALS['JSON_ERR_MSGS']	= &$JSON_ERR_MSGS;
#
########################################################
?>
