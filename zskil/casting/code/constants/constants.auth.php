<?php
########################################################
#  constants.auth.php
#
#	Константы авторизации/регистрации
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.01 - файл создан
#
########################################################
#
	// количество попыток входа в администраторскую панель
	define( 'TRY_ADMIN_AUTH',		15 );

	// количество попыток авторизаций
	define( 'TRY_USER_AUTH',		15 );

	// количество возможных регистраций для данного IP
	// в TIME_BLOCK_REGISTER секунд
	// (по умолч. 3 регистрации в день)
	define( 'TRY_REGISTER_COUNT',	15 );

	// количество возможных заявок с одного IP
	define( 'TRY_REQUEST_COUNT',	15 );

	// количество возможных заявок на восстановление пароля с одного IP
	define( 'TRY_RESTORE_COUNT',	10 );

	// время блокировки при неправильном вводе пароля в админке
	define( 'TIME_BLOCK_ADMIN',		ONE_HOUR );

	// время блокировки при неправильном вводе пароля на сайт
	define( 'TIME_BLOCK_USER',		ONE_HOUR );

	// время блокировки после регистрации TRY_REGISTER_COUNT раз
	define( 'TIME_BLOCK_REGISTER',	ONE_HOUR * 24 );

	// время блокировки после отправки TRY_REQUEST_COUNT заявок
	define( 'TIME_BLOCK_REQUEST',	ONE_HOUR );

	// время блокировки после отправки заявок на восстановление пароля TRY_RESTORE_COUNT
	define( 'TIME_BLOCK_RESTORE',	ONE_HOUR * 3 );

	define( 'ID_SPAM_TYPE_ADMIN_AUTH',	1 );	// блокировка авторизации админа
	define( 'ID_SPAM_TYPE_USER_AUTH',	2 );	// блокировка авторизации пользователя
	define( 'ID_SPAM_TYPE_REGISTER',	3 );	// блокировка регистрации
	define( 'ID_SPAM_TYPE_REQUEST',		4 );	// блокировка отправки заявок
	define( 'ID_SPAM_TYPE_RESTORE',		5 );	// блокировка восстановления пароля
#
########################################################
#
$GLOBALS['LISTS'] += array(
	'auth' => array(
		'register'	=> array(
			'spam_id'		=> ID_SPAM_TYPE_REGISTER,
			'max_attempts'	=> TRY_REGISTER_COUNT,
			'block_time'	=> TIME_BLOCK_REGISTER,
			'error_id'		=> ERROR_REG_BLOCKED
		),
		'request'	=> array(
			'spam_id'		=> ID_SPAM_TYPE_REQUEST,
			'max_attempts'	=> TRY_REQUEST_COUNT,
			'block_time'	=> TIME_BLOCK_REQUEST,
			'error_id'		=> ERROR_REQUEST_BLOCKED
		),
		'restore'	=> array(
			'spam_id'		=> ID_SPAM_TYPE_RESTORE,
			'max_attempts'	=> TRY_RESTORE_COUNT,
			'block_time'	=> TIME_BLOCK_RESTORE,
			'error_id'		=> ERROR_RESTORE_BLOCKED
		),
	)
);
#
########################################################
?>
