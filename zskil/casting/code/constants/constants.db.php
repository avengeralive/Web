<?php
########################################################
#	constants.db.php
#
#	Структура с описанием структуры БД
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.01 - файл создан
#
########################################################
$GLOBALS['LISTS'] += array(

	'db'	=> array(
		'struct' => array(
			'data_ankets' => array(
				'id' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
				'date_created' => 'timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'',
				'date_updated' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
				'date_birthday' => 'timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'',
				'status' => 'enum('.form_enum($GLOBALS['LISTS']['ankets']['statuses']).') NOT NULL DEFAULT \'moderating\'',
				'last_name' => 'varchar(255) NOT NULL DEFAULT \'\'',
				'first_name' => 'varchar(255) NOT NULL DEFAULT \'\'',
				'citizenship' => 'varchar(100) NOT NULL DEFAULT \'\'',
				'city' => 'varchar(255) NOT NULL DEFAULT \'\'',
				'phone' => 'varchar(40) NOT NULL DEFAULT \'\'',
				'email' => 'varchar(255) NOT NULL DEFAULT \'\'',
				'social1' => 'text NOT NULL',
				'social2' => 'text NOT NULL',
				'social3' => 'text NOT NULL',
				'men_participate' => 'tinyint(3) unsigned NOT NULL DEFAULT \'0\'',
				'men_army' => 'tinyint(3) unsigned NOT NULL DEFAULT \'0\'',
				'men_city' => 'varchar(255) NOT NULL DEFAULT \'\'',
				'men_social1' => 'text NOT NULL',
				'men_social2' => 'text NOT NULL',
				'men_social3' => 'text NOT NULL',
				'rating' => 'tinyint(3) unsigned NOT NULL DEFAULT \'0\'',
				'comment' => 'text NOT NULL',
			),
			'data_ankets_files'	=> array(
				'id' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
				'date_created' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
				'anket_id' => 'bigint(20) unsigned NOT NULL DEFAULT \'0\'',
				'order' => 'bigint(20) unsigned NOT NULL DEFAULT \'0\'',
				'is_preview' => 'tinyint(3) unsigned NOT NULL DEFAULT \'0\'',
				'group' => 'enum('.form_enum($GLOBALS['LISTS']['ankets']['files_groups']).') NOT NULL DEFAULT \'photos\'',
				'extension'	=> 'char(4) NOT NULL',
				'filename'	=> 'char(255) NOT NULL DEFAULT \'\'',
			),
			'data_ankets_files_conv'	=> array(
				'conv_id' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
				'anket_id' => 'bigint(20) unsigned NOT NULL DEFAULT \'0\'',
				'file_id' => 'bigint(20) unsigned NOT NULL DEFAULT \'0\'',
				'conv_date_created' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
				'date_conv_start' => 'timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'',
				'date_conv_end' => 'timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'',
				'conv_state' => 'enum('.form_enum($GLOBALS['LISTS']['ankets']['conv_states']).') NOT NULL DEFAULT \'unprocessed\'',
				'conv_tpl_id' => 'tinyint(3) unsigned NOT NULL DEFAULT \'0\'',
				'conv_path' => 'text NOT NULL',
			),
			'data_settings' => array(
				'name'		=> 'char(50) NOT NULL',
				'value'		=> 'char(255) NOT NULL'
			),
			'data_users' => array(
				'id' => 'mediumint(8) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(200) NOT NULL DEFAULT \'\'',
				'company' => 'varchar(200) NOT NULL DEFAULT \'\'',
				'phone' => 'varchar(20) NOT NULL DEFAULT \'\'',
				'email' => 'varchar(100) NOT NULL DEFAULT \'\'',
				'password' => 'varchar(32) NOT NULL DEFAULT \'\'',
				'key' => 'varchar(29) NOT NULL DEFAULT \'\'',
				'hash' => 'varchar(32) NOT NULL DEFAULT \'\'',
				'hash_activate' => 'varchar(32) NOT NULL DEFAULT \'\'',
				'hash_reset' => 'varchar(32) NOT NULL DEFAULT \'\'',
				'type' => 'enum('.form_enum($GLOBALS['LISTS']['users']['types']).') NOT NULL DEFAULT \'user\'',
				'status' => 'enum('.form_enum($GLOBALS['LISTS']['users']['statuses']).') NOT NULL DEFAULT \'moderating\'',
				'registered' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
				'last_visited' => 'timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'',
				'last_ip' => 'bigint(20) NOT NULL DEFAULT \'0\''
			),
			'logs_auth' => array(
				'id' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
				'ip' => 'bigint(20) NOT NULL',
				'type' => 'tinyint(3) unsigned NOT NULL',
				'time' => 'int(10) unsigned NOT NULL',
				'err_count' => 'tinyint(3) unsigned NOT NULL DEFAULT \'0\'',
			),
			'logs_sessions' => array(
				'session_id' => 'varchar(40) NOT NULL',
				'ip' => 'bigint(20) NOT NULL',
				'data' => 'text NOT NULL',
				'access' => 'bigint(20) NOT NULL',
			),
		),
		'indexes' => array(
			'data_settings' => array(
				'name' => array(
					'type' => '',
					'cols' => '(`name`,`value`)',
				),
			),
			'data_users' => array(
				'PRIMARY' => array(
					'type' => 'PRIMARY',
					'cols' => '(`id`)',
				),
				'type' => array(
					'type' => '',
					'cols' => '(`type`)',
				),
				'auth_check' => array(
					'type' => '',
					'cols' => '(`email`,`password`,`status`)',
				),
				'id' => array(
					'type' => '',
					'cols' => '(`id`,`status`)',
				),
				'hash' => array(
					'type' => '',
					'cols' => '(`hash`,`status`)',
				),
				'email' => array(
					'type' => '',
					'cols' => '(`email`,`status`)',
				),
				'login' => array(
					'type' => '',
					'cols' => '(`password`,`status`)',
				),
				'type_2' => array(
					'type' => '',
					'cols' => '(`type`,`status`,`name`)',
				),
				'status' => array(
					'type' => '',
					'cols' => '(`status`,`name`)',
				),
				'hash_activate' => array(
					'type' => '',
					'cols' => '(`hash_activate`,`status`,`type`)',
				)
			),
			'logs_auth' => array(
				'PRIMARY' => array(
					'type' => 'PRIMARY',
					'cols' => '(`id`)',
				),
				'ip' => array(
					'type' => '',
					'cols' => '(`ip`,`type`)',
				),
				'time' => array(
					'type' => '',
					'cols' => '(`time`)',
				)
			),
			'logs_sessions' => array(
				'PRIMARY' => array(
					'type' => 'PRIMARY',
					'cols' => '(`session_id`)',
				),
				'access' => array(
					'type' => '',
					'cols' => '(`access`)',
				)
			),
			'data_ankets' => array(
				'PRIMARY' => array(
					'type' => 'PRIMARY',
					'cols' => '(`id`)',
				),
				'status' => array(
					'type' => '',
					'cols' => '(`status`)',
				)
			),
			'data_ankets_files' => array(
				'PRIMARY' => array(
					'type' => 'PRIMARY',
					'cols' => '(`id`)',
				),
				'anket_id' => array(
					'type' => '',
					'cols' => '(`anket_id`)',
				)
			),
			'data_ankets_files_conv' => array(
				'PRIMARY' => array(
					'type' => 'PRIMARY',
					'cols' => '(`conv_id`)',
				),
				'file_id' => array(
					'type' => '',
					'cols' => '(`file_id`)',
				),
				'anket_id' => array(
					'type' => '',
					'cols' => '(`anket_id`)',
				),
				'conv_tpl_id' => array(
					'type' => '',
					'cols' => '(`conv_tpl_id`)',
				),
				'conv_zombie' => array(
					'type' => '',
					'cols' => '(`conv_state`,`date_conv_start`)',
				),
				'date_conv_start' => array(
					'type' => '',
					'cols' => '(`date_conv_start`)',
				),
				'unique_queue' => array(
					'type' => 'UNIQUE',
					'cols' => '(`anket_id`,`file_id`,`conv_tpl_id`)',
				)
			),
		),
		'procedures'	=> array(),
		'SETTINGS_ROWS' => array(
			'ANKET_CONV_TIMEOUT'	=> array(
				'defval'	=> ONE_DAY,
				'hidden'	=> '0',
				'comment'	=> 'таймаут конвертирования (сек), после которого считается, что процесс конвертирования файла завис и его необходимо перезапустить'
			),
			'ANKET_CONV_MEMORY_LIMIT'	=> array(
				'defval'	=> '512M',
				'hidden'	=> '0',
				'comment'	=> 'ограничение оперативной памяти на один скрипт конвертирования (пример: 512M)'
			),
			'ANKET_CONV_MAX_SIMULTANEOUSLY'	=> array(
				'defval'	=> '1',
				'hidden'	=> '0',
				'comment'	=> 'максимальное одновременное количество запущенных задач конвертирования'
			),
			'ANKET_CONV_SCREENSHOTS_SECONDS'	=> array(
				'defval'	=> '10',
				'hidden'	=> '0',
				'comment'	=> 'количество секунд, на которое отматываем видео, чтобы сделать скриншот'
			),
		),
		'pages'	=> array(
			'is_tree'	=> true,
			'dyna'		=> true,
			'table'		=> 'data_pages',
			'rows'		=> array(
				'id'		=> '`id`',
				'root'		=> '`parent_id`',
				'hidden'	=> '`is_hidden`',
				'disabled'	=> '`is_disabled`',
				'value'		=> '`title`',
				'order'		=> '`order`',
				'is_folder'	=> '"1"'
			)
		),
	)
);
#
########################################################
?>
