<?php
########################################################
#	constants.modules.php
#
#	Список модулей
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
$GLOBALS['LISTS'] += array(

	'modules'	=> array(
		'is_system'	=>	true,
		'www'		=>	array(
			'main'		=>	array(
				'name'			=>	'main',
				'title'			=>	'Главная',
				'folder'		=>	'',
				'is_disabled'	=>	0,
				'is_static'		=>	0,
				'allow_auth'	=>	1,
				'allow_unauth'	=>	1,
				'allow_utypes'	=>	array( 'all' => 1 )
			),
			'lk'		=>	array(
				'name'			=>	'lk',
				'title'			=>	'Личный кабинет',
				'folder'		=>	'',
				'is_disabled'	=>	0,
				'is_static'		=>	0,
				'allow_auth'	=>	1,
				'allow_unauth'	=>	1,
				'allow_utypes'	=>	array( 'all' => 1 ),
			),
			'conditions'		=>	array(
				'name'			=>	'conditions',
				'title'			=>	'О нас',
				'folder'		=>	'',
				'is_disabled'	=>	0,
				'is_static'		=>	1,
				'allow_auth'	=>	1,
				'allow_unauth'	=>	1,
				'allow_utypes'	=>	array( 'all' => 1 ),
				'static_info'	=> array(
					'use_default_tpl'	=> false,
					'link'				=> 'conditions',
					'title'				=> 'Условия участия',
					'text'				=> ''
				)
			),
			'about'		=>	array(
				'name'			=>	'about',
				'title'			=>	'О нас',
				'folder'		=>	'',
				'is_disabled'	=>	0,
				'is_static'		=>	1,
				'allow_auth'	=>	1,
				'allow_unauth'	=>	1,
				'allow_utypes'	=>	array( 'all' => 1 ),
				'static_info'	=> array(
					'use_default_tpl'	=> false,
					'link'				=> 'about',
					'title'				=> 'О нас',
					'text'				=> ''
				)
			),
			'ajax'		=>	array(
				'name'			=>	'ajax',
				'title'			=>	'',
				'folder'		=>	'',
				'is_disabled'	=>	0,
				'is_static'		=>	0,
				'allow_auth'	=>	1,
				'allow_unauth'	=>	1,
				'allow_utypes'	=>	array( 'all' => 1 ),
			),
		),
	),

	'lk_modules' => array(
		'comment'	=> 'Список зарегистрированных модулей личного кабинета',
		'www'		=> array(
			# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			# ADMIN ONLY modules
			# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			'ankets'	=> array(
				'title'			=> 'Анкеты',
				'is_disabled'	=> false,
				'is_hidden'		=> false,
				'allow_utypes'	=> array( 'admin' => true ),
				'count_index'	=> 'ankets',
				'submenu'		=> array(
					'listing'		=> 'Список анкет'
				),
				'submenu_hidden'	=> array(
					'edit'		=> 'Редактирование анкеты',
					'insert'	=> 'Добавление анкеты'
				),
				'redirect_map'	=> array(
					'edit'		=> 'listing',
					'insert'	=> 'listing'
				)
			),
			'settings'	=> array(
				'title'			=> 'Настройки',
				'is_disabled'	=> false,
				'is_hidden'		=> false,
				'allow_utypes'	=> array( 'admin' => true )
			),
			# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

			# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			# HIDDEN modules
			# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

			'logout'	=> array(
				'title'			=> 'logout',
				'allow_utypes'	=> array( 'all' => true ),
				'is_disabled'	=> false,
				'is_hidden'		=> true
			),
			'ajax'	=> array(
				'title'			=> 'ajax handler',
				'allow_utypes'	=> array( 'all' => true ),
				'is_disabled'	=> false,
				'is_hidden'		=> true,
			)
			# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		)
	)
);

#
########################################################
?>
