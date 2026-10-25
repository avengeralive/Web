<?php
########################################################
#	constants.posts.anket.php
#
#	Зарегистрированные POST-переменные при
#	отправке заявки
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.07 - файл создан
#
########################################################
$GLOBALS['POST_ANKET'] = array(

	'email'			=> array(
		'dbrow'		=> 'email',
		'filter'	=> MASK_EMAIL
	),
	'last_name'	=> array(
		'dbrow'		=> 'last_name',
		'filter'	=> MASK_TEXT,
	),
	'first_name'	=> array(
		'dbrow'		=> 'first_name',
		'filter'	=> MASK_TEXT,
	),
	'date_birthday'	=> array(
		'dbrow'		=> 'date_birthday',
		'filter'	=> MASK_DATE,
	) + $GLOBALS['LISTS']['lambda']['birthday'],
	'citizenship'	=> array(
		'dbrow'		=> 'citizenship',
		'filter'	=> MASK_TEXT,
		'defval'	=> ''
	),
	'city'	=> array(
		'dbrow'		=> 'city',
		'filter'	=> MASK_TEXT,
	),
	'phone'	=> array(
		'dbrow'		=> 'phone',
		'filter'	=> MASK_TEXT,
	),
	'email'	=> array(
		'dbrow'		=> 'email',
		'filter'	=> MASK_TEXT,
	),
	'social1'	=> array(
		'dbrow'		=> 'social1',
		'filter'	=> 'all-chars'
	),
	'social2'	=> array(
		'dbrow'		=> 'social2',
		'filter'	=> 'all-chars'
	),
	'social3'	=> array(
		'dbrow'		=> 'social3',
		'filter'	=> 'all-chars'
	),
	'men_participate'	=> array(
		'dbrow'		=> 'men_participate',
		'filter'	=> 'all-chars',
	),
	'men_army'	=> array(
		'dbrow'		=> 'men_army',
		'filter'	=> 'all-chars',
	),
	'men_city'	=> array(
		'dbrow'		=> 'men_city',
		'filter'	=> MASK_TEXT,
	),
	'men_social1'	=> array(
		'dbrow'		=> 'men_social1',
		'filter'	=> 'all-chars'
	),
	'men_social2'	=> array(
		'dbrow'		=> 'men_social2',
		'filter'	=> 'all-chars'
	),
	'men_social3'	=> array(
		'dbrow'		=> 'men_social3',
		'filter'	=> 'all-chars'
	),
	'rating'	=> array(
		'dbrow'			=> 'rating',
		'filter'		=> MASK_TEXT,
		'defval'		=> '0',
		'force'			=> 'all',
		'force_except'	=> array( 'admin' => true ),
		'force_ACT'		=> 'all',
		'allow_nopost'	=> true
	),
	'status'	=> array(
		'dbrow'			=> 'status',
		'filter'		=> MASK_ENUM,
		'defval'		=> 'moderating',
		'allow_nopost'	=> true
	),
	'comment'	=> array(
		'dbrow'		=> 'comment',
		'filter'	=> 'all-chars'
	),

);
########################################################
?>
