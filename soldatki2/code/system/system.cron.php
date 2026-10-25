<?php
########################################################
# 	system.cron.php
#
#	Задачи для крона
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
#
	define( 'CRON_ECHO_ENABLED',	true );
	define( 'CRON_LOG_ENABLED',		true );
	define( 'CRON_LOG_FILENAME',	'cron.log' );
	define( 'CRON_LOG_FILE',		LOG_PATH.CRON_LOG_FILENAME );
#
########################################################
class SYSTEM_cron {

	var $buffer = array(
		'data'				=> array(),
		'counter'			=> 0,
		'ids'				=> array(),
		'total_count'		=> 0
	);
	var $static_mode = false;
	function _init( $static = false ) {

		global $mysqli;
		$this->mysqli = &$mysqli;

		set_time_limit2( LONG_LIFE_TIMEOUT );
		$this->method_name	= 'default';

		$this->static_mode = $static;

		init_interfaces( $this, $static, array('lists','rights','logs','user','template','settings','ankets') );
		$this->logs->LOG_FILE = CRON_LOG_FILE;

		$this->logs->log_echo = php_sapi_name() != 'cli';

		$this->user->save_session = false;

	}

	var $tasks = array(
		'delete-old-auth-logs'	=> 'delete_oldAuthLogs',
		'update-currency'		=> 'update_currency',
		'update-db-struct'		=> 'update_db_struct',

		'ankets-queue-gc'		=> 'ankets_queue_gc'
	);

	// эти задачи не будут выполняться при запуске /code/cron/run-all.php
	var $tasks_custom = array(
		'ankets-queue'				=> 'ankets_queue',
		'ankets-reset-processing'	=> 'ankets_reset_processing',
	);

	function run_task( $task_name, $task_params=null ) {

		if( isset($this->tasks[$task_name]) && method_exists($this, $this->tasks[$task_name]) ) {
			$this->method_name = $this->tasks[$task_name];
		} else {

			if( isset($this->tasks_custom[$task_name]) && method_exists($this, $this->tasks_custom[$task_name]) ) {
				$this->method_name = $this->tasks_custom[$task_name];

			} else {
				$this->logs->add( 'Unknown task "'.$task_name.'"' );
				return false;
			}
		}

		// запуск КРОН-задачи
		$this->{ $this->method_name }( $task_params );

	}

	function delete_oldAuthLogs() {

		$this->logs->add( 'Удаляем старые логи авторизации', LOG_CONF_DATE );
		timer_start( $this->method_name );

		$this->mysqli->query('

			DELETE
			FROM	logs_auth
			WHERE	time < '.(NOW - 60*60*24*180).'

		');

		$this->logs->add( ' - affected: '.$this->mysqli->affected_rows.', time: '.timer_stop($this->method_name,0).' sec.', LOG_CONF_LF );

	}

	function ankets_queue_gc() {
		$this->logs->add( 'запуск garbage collector\'а для конвертированных медиа-файлов' );

		$to_delete = array();

		$q = '

			-- получаем все файлы, у которых удаленные анкеты
			SELECT		`conv`.*
			FROM		`data_ankets_files_conv` AS `conv`
			LEFT JOIN	`data_ankets` AS `anket`
			ON			`anket`.`id` = `conv`.`anket_id`
			WHERE		`anket`.`id` IS NULL

				UNION

			-- получаем все медиафайлы, у которых удалены родительские файлы
			SELECT		`conv`.*
			FROM		`data_ankets_files_conv` AS `conv`
			LEFT JOIN	`data_ankets_files` AS `file`
			ON			`file`.`id` = `conv`.`file_id`
			WHERE		`file`.`id` IS NULL

				UNION

			-- получаем все медиафайлы, у которых неизвестный ID конвертера
			SELECT		`conv`.*
			FROM		`data_ankets_files_conv` AS `conv`
			WHERE		`conv`.`conv_tpl_id` NOT IN ('.implode_index(',',$this->lists->data['ankets']['conv_tpl']).')

			GROUP BY	`conv_id


		';
		// pr($q);
		$files_wo_ankets = mysql_assoc_array($q);
		if( !empty($files_wo_ankets) )
		foreach( $files_wo_ankets as $conv_file ) {
			$to_delete[ $conv_file['conv_id'] ] = $conv_file;
		}

		if( !empty($to_delete) ) {
			// удаляем файл из хранилища
			foreach( $to_delete as $conv_file ) {
				if( file_exists($conv_file['conv_path']) ) {
					@unlink( $conv_file['conv_path'] );
				}
			}

			// удаляем записи из базы данных
			$this->mysqli->query('DELETE FROM `data_ankets_files_conv` WHERE `conv_id` IN ('.implode_index(',',$to_delete).')');
		}

		// сбрасываем статус processing с зомби-процессов конвертации (у которых прошел таймаут)
		$this->mysqli->query('

			UPDATE	`data_ankets_files_conv`
			SET		`conv_state` = "unprocessed"
			WHERE	`conv_state` = "processing" AND
					`conv_date_updated` > "0000-00-00 00:00:00" AND
					`conv_date_updated` < "'.mysql_unixToTimestamp(NOW-intval($this->settings->val('ANKET_CONV_TIMEOUT'))).'"

		');

	}

	function ankets_reset_processing() {
		$this->logs->add( 'запускаем задачу сброса флага "обрабатывается" для конвертируемых файлов (при перезагрузке ОС)' );
		$this->mysqli->query('

			UPDATE	`data_ankets_files_conv`
			SET		`conv_state` = "unprocessed"
			WHERE	`conv_state` = "processing"

		');
	}

	function ankets_queue() {

		// error_reporting(E_ALL);ini_set('display_errors','on');
		set_time_limit( intval($this->settings->val('ANKET_CONV_TIMEOUT')) );
		ini_set( 'memory_limit', $this->settings->val('ANKET_CONV_MEMORY_LIMIT') );
		// pr( ini_get('max_execution_time') );pr( ini_get('memory_limit'), 1 );

		// проверка на допустимое количество одновременно-выполняемых задач
		if( $this->ankets->get_active_convert_tasks_count() < intval($this->settings->val('ANKET_CONV_MAX_SIMULTANEOUSLY')) ) {

			$task = mysql_assoc('

				SELECT		*,
							`file`.`id` AS `id`

				FROM		`data_ankets_files_conv` AS `conv`

				LEFT JOIN	`data_ankets_files` AS `file`
				ON			`file`.`id` = `conv`.`file_id`

				WHERE		`conv_state` = "unprocessed"

				LIMIT		1

			');

			// блокируем задачу
			$this->mysqli->query('UPDATE `data_ankets_files_conv` SET `conv_state` = "processing", `date_conv_start` = "'.mysql_unixToTimestamp(time()).'" WHERE `conv_id` = "'.$task['conv_id'].'"');

			if( !empty($task['conv_path']) && $this->lists->exists($task['conv_tpl_id'],'ankets','conv_tpl') ) {
				$this->logs->add( 'запускаем задачу конвертирования файла (anket_id='.$task['anket_id'].';file_id='.$task['file_id'].';conv_id='.$task['conv_id'].';)' );

				dir_check_create( dirname($task['conv_path']) );

				$anket = $this->ankets->get_anket_info( $task['anket_id'] );
				if( !empty($anket) ) {

					$conv_cfg = $this->lists->data['ankets']['conv_tpl'][ $task['conv_tpl_id'] ];
					$file_cfg = $this->lists->data['ankets']['files_groups'][ $task['group'] ];

					if( !empty($conv_cfg) && !empty($file_cfg) ) {

						$src_path = $this->ankets->get_file_path( $task );
						$dst_path = $this->ankets->get_file_converted_path( $src_path, $task['conv_tpl_id'] );

						if( !empty($src_path) && !empty($dst_path) ) {

							if( $file_cfg['type'] == 'video' ) {
								include_framework( 'php-ffmpeg/autoload' );
								$ffmpeg = FFMpeg\FFMpeg::create(array(
									'timeout' => intval($this->settings->val('ANKET_CONV_TIMEOUT'))
								));
								$video = $ffmpeg->open( $src_path );

								switch( $conv_cfg['type'] ) {

									case 'thumb':
										$video
											->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(intval($this->settings->val('ANKET_CONV_SCREENSHOTS_SECONDS'))))
											->save( $dst_path )
										;
										break;

									case 'webm':
										$video->save(new FFMpeg\Format\Video\WebM(), $dst_path );
										break;

								}

							}

							// обновляем статус
							$this->mysqli->query('UPDATE `data_ankets_files_conv` SET `conv_state` = "processed", `date_conv_end` = "'.mysql_unixToTimestamp(time()).'" WHERE `conv_id` = "'.$task['conv_id'].'"');
						}
					}
				}
			}
		}
	}

	function update_currency() {

		$log_res = 'Обновляем курс валют';
		timer_start( $this->method_name );

		$url = parse_url( ADDR_CURRENCY );

		$DOM = simplexml_load_file( ADDR_CURRENCY );

		$currencies = array();
		foreach( $DOM->Valute as $valute ) {

			$code = (string) $valute->CharCode;
			$cost = (string) $valute->Value;

			if( !empty($cost) && !empty($code) )
			$currencies[ $code ] = $cost;
		}

		$affected = 0;
		foreach( $this->lists->data['currency']['data'] as $currency_id => $title )
		if(
			$currency_id != 'RUB'	&&
			isset( $currencies[$currency_id] )
		) {
			$currency_value = str_replace(',','.',filter( $currencies[$currency_id], MASK_FLOAT ));

			$this->settings->update( 'currency_'.$currency_id, $currency_value );

			$affected++;
		}

		$log_res .= ' - обработано записей: '. $affected .', затрачено времени: '.timer_stop($this->method_name,0).' сек.';

		$this->logs->add( $log_res );

	}

	function update_db_struct() {

		// запускаем задачу только на мастер-кластере
		$this->logs->add( 'обновление структуры базы данных' );

		//---------------------------------------------------------
		// с внесением изменений в БД [PRODUCTION]
		$this->lists->update_db_struct( false );
		// без внесения изменений в БД [DEBUG]
		// $this->lists->update_db_struct( true );
		//---------------------------------------------------------

		// сгенерировать объявление массивов $GLOBALS['LISTS']['db']['struct'] и $GLOBALS['LISTS']['db']['indexes'] из текущей БД
		// $this->lists->update_db_struct_form_list_array();
	}

}

?>
