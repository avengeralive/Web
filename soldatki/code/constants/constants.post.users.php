<?php
########################################################
#	constants.posts.users.local.php
#
#	Зарегистрированные POST-переменные пользователей при
#	редактировании/удалении
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.01 - файл создан
#
########################################################
$GLOBALS['POST_USERS'] = array(

	'name'			=> array(
		'dbrow'		=> 'name',
		'filter'	=> MASK_TEXT
	),
	'email'			=> array(
		'dbrow'		=> 'email',
		'filter'	=> MASK_EMAIL
	),
	'type'	=> array(
		'dbrow'		=> 'type',
		'filter'	=> MASK_ENUM,
		'defval'	=> 'user'
	),
	'status'	=> array(
		'dbrow'		=> 'status',
		'filter'	=> MASK_ENUM,
		'defval'	=> 'active'
	)
);
########################################################
?>
