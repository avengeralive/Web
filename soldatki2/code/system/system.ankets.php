<?php
########################################################
#	system.ankets.php
#
#	Интерфейс для работы с анкетами
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.07 - файл создан
#
########################################################
#
	define( 'SALT_ANKET',			')D(*+#D:CPodICUV(*2347*(' );
	define( 'SALT_ANKET_FILE',		'C(D(8309D)(*#$(*#@)d0398' );
	define( 'SALT_ANKET_TEMP',		'D()E09398ED)R(*#$-DF_)(C' );
	define( 'SALT_ANKET_FILE_TEMP',	'CLDi390*R)(*342lEORIUDFL' );
#
########################################################
class SYSTEM_ankets	{

	var $data = array();
	var $cfg = null;

	function _init( $static = false, &$mysqli = null, $cfg=array() ) {

		if( $mysqli === null ) {
			global $mysqli;
		}
		$this->mysqli = &$mysqli;

		init_interfaces( $this, $static, array('gets','lists','logs') );

	}

	function delete( $id ) {

		$ids = array();
		if( gettype($id) == 'array' )
			$ids = $id;
		else
			$ids[] = $id;

		if( empty($ids) )
		return;

		foreach( $ids as $i => $id )
		$ids[ $i ] = filter( $id );
		$imploded = implode( ',', $ids );

		foreach( $ids as $id ) {
			$anket_media_path = $this->get_anket_path( $id );

			// сканируем директорию песочницы и удаляем все файлы в ней
			$files = scandir( $anket_media_path );
			$count = count( $files );
			for( $i = 0;$i < $count;$i++ ) {
				if( $files[$i] != '.' && $files[$i] != '..' ) {
					unlink( $anket_media_path.$files[$i] );
				}
			}

			// удаляем директорию песочницы
			rmdir( $anket_media_path );
		}

		// удаляем записи из базы данных
		$this->mysqli->query('

			DELETE
			FROM	`data_ankets`
			WHERE	`id` IN ('.$imploded.')

		');
		$this->mysqli->query('

			DELETE
			FROM	`data_ankets_files`
			WHERE	`anket_id` IN ('. $imploded .')

		');
		$this->mysqli->query('

			DELETE
			FROM	`data_ankets_files_conv`
			WHERE	`anket_id` IN ('. $imploded .')

		');
	}

	function delete_media( $id ) {

		$ids = array();
		if( gettype($id) == 'array' )
		$ids = $id;
		else
		$ids[] = $id;

		if( empty($ids) )
		return;

		foreach( $ids as $i => $id )
		$ids[ $i ] = filter( $id );
		$imploded = implode( ',', $ids );

		// удаляем файлы из хранилища
		$files = mysql_assoc_array('

			SELECT	*
			FROM	`data_ankets_files`
			WHERE	`id` IN ('.$imploded.')

		');
		if( !empty($files) ) {
			foreach( $files as $file ) {
				$file_path = $this->get_file_path( $file );
				@unlink( $file_path );

				// удаляем сконвертированные файлы
				array_map( 'unlink', glob($file_path.'*') );
			}
		}

		// удаляем записи из базы данных
		$this->mysqli->query('

			DELETE
			FROM	`data_ankets_files`
			WHERE	`id` IN ('.$imploded.')

		');
		$this->mysqli->query('

			DELETE
			FROM	`data_ankets_files_conv`
			WHERE	`file_id` IN ('.$imploded.')

		');
	}

	function get_sorted_media( $array_from_db ) {
		$result = array();

		foreach( $this->lists->data['ankets']['files_groups'] as $group_id => $gropup_info ) {
			$result[ $group_id ] = array();
		}

		if( !empty($array_from_db) )
		foreach( $array_from_db as $file ) {
			$file['id'] = $file['file_id'];

			// TODO :: check file exists (more load for filesystem?)

			$file['uri'] = $this->get_file_uri( $file );
			$file['path'] = $this->get_file_path( $file );

			// формируем информацию о конвертированных версиях файлов
			if( !empty($file['conv_files_by_id']) ) {
				foreach( $file['conv_files_by_id'] as $conv_id => $conv_file ) {

					$conv_cfg = array();
					if( $this->lists->exists( $conv_file['conv_tpl_id'], 'ankets', 'conv_tpl' ) ) {
						$conv_cfg = $this->lists->data['ankets']['conv_tpl'][ $conv_file['conv_tpl_id'] ];
					}

					$file['conv_files_by_id'][$conv_id]['path'] = $this->get_file_converted_path( $file['path'], $conv_file['conv_tpl_id'] );

					if( $conv_file['conv_state'] == 'processed' ) {
						$file['conv_files_by_id'][$conv_id]['uri'] = $this->get_file_converted_uri( $file['uri'], $conv_file['conv_tpl_id'] );
					} else {
						if( !empty($conv_cfg) ) {
							$file['conv_files_by_id'][$conv_id]['uri'] = ANKET_STUB_URI.$conv_cfg['stub'];
						} else {
							$file['conv_files_by_id'][$conv_id]['uri'] = ANKET_STUB_URI_DEFAULT;
						}
					}
				}
			}

//			print_r($file);

			$result[ $file['group'] ][ $file['id'] ] = $file;
		}

		return $result;
	}

	function get_file_path( $file ) {
		return
			$this->get_anket_path( $file['anket_id'] ).
			$this->get_anket_file_hash( $file['id'] ).'.'.$file['extension']
		;
	}
	function get_file_uri( $file ) {
		return
			$this->get_anket_uri( $file['anket_id'] ).
			$this->get_anket_file_hash( $file['id'] ).'.'.$file['extension']
		;
	}

	function get_file_converted_path( $orig_path, $convert_id ) {

		// /uploads/ankets/...../29d8c0d9e8r02.mp4 => /uploads/ankets/...../29d8c0d9e8r02.mp4.thumb.orig.jpg
		if( $this->lists->exists( $convert_id, 'ankets', 'conv_tpl' ) ) {
			$conf = $this->lists->data['ankets']['conv_tpl'][$convert_id];
			$ext = !empty($conf['ext']) ? $conf['ext'] : get_ext( $orig_path );
			return $orig_path.'.'.$conf['name'].'.'.$ext;
		} else {
			return false;
		}
	}
	function get_file_converted_uri( $orig_uri, $convert_id ) {
		return $this->get_file_converted_path( $orig_uri, $convert_id );
	}

	function get_anket_uri( $anket_id ) {
		return
			URI_UPLOADS.
			'ankets/'.
			$this->get_anket_sandbox_hash( $anket_id ).'/'
		;
	}
	function get_anket_path( $anket_id ) {
		return
			PATH_UPLOADS.
			'ankets/'.
			$this->get_anket_sandbox_hash( $anket_id ).'/'
		;
	}

	function get_anket_sandbox_hash( $anket_id ) {
		return md5( md5( SALT_ANKET.$anket_id ) );
	}

	function get_anket_file_hash( $file_id ) {
		return md5( md5( SALT_ANKET_FILE.$file_id ) );
	}

	function get_active_convert_tasks_count() {
		return mysql_row('

			SELECT	COUNT(*)
			FROM	`data_ankets_files_conv`
			WHERE	`conv_state` = "processing"

		');
	}

	function get_space_free( $humanize = true ) {
		$bytes = disk_free_space( PATH_UPLOADS );
		if( $humanize ) {
			return parse_size( $bytes );
		} else {
			return $bytes;
		}
	}

	function get_space_total( $humanize = true ) {
		$bytes = disk_total_space( PATH_UPLOADS );
		if( $humanize ) {
			return parse_size( $bytes );
		} else {
			return $bytes;
		}
	}

	function anket_process_media() {

		$ankets_media_path = $this->get_anket_path( $this->id );
		dir_check_create( $ankets_media_path );

		$this->engine->load_module( 'fupload' );
		$this->fupload = &$this->engine->fupload;

		foreach( $this->lists->data['ankets']['files_groups'] as $group_id => $group ) {

			if( isset($group['max_width']) && isset($group['max_height']) ) {
				$this->fupload->IMG_SMALL_W	= $group['max_width'];
				$this->fupload->IMG_SMALL_H	= $group['max_height'];
			} else {
				$this->fupload->IMG_SMALL_W	= IMG_SMALL_W;
				$this->fupload->IMG_SMALL_H	= IMG_SMALL_H;
			}

			if( !empty($_FILES[$group_id]) ) {
				$count = count( $_FILES[$group_id]['name'] );
				for( $i = 0;$i < $count;$i++ ) {

					// ограничение на количество заливаемых файлов в группе
					if( !empty($group['max_items']) && $i >= $group['max_items'] ) {
						break;
					}

					$this->fupload->init_indexes( $group_id, $i );
					if($this->fupload->check_errors(
						'default-checks',
						$group['check_type']
					)){

						// создаем запись в базе данных
						$query = $this->mysqli->prepare('INSERT INTO `data_ankets_files` (`anket_id`,`group`,`extension`,`filename`) VALUES (?,?,?,?)');
						$query->bind_param( 'isss', $this->id, $group_id, $this->fupload->FEXT, $this->fupload->FNAME_NOEXT );
						$query->execute();
						$query->close();
						if( !$this->mysqli->errno ) {
							$img_id = $this->mysqli->insert_id;

							$dest_path = $this->get_file_path(array(
								'anket_id'	=> $this->id,
								'id'		=> $img_id,
								'extension'	=> $this->fupload->FEXT
							));

							if( $group['type'] == 'image' ) {
								// сохраняем в хранилище файл с уменьшенным размером
								$this->fupload->create_jpg(
									$this->fupload->FPATH,
									$dest_path,
									$this->fupload->IMG_SMALL_W,
									$this->fupload->IMG_SMALL_H,
									IMG_CREATE_SMALLING
								);
							} else {
								// сохраняем загруженный медиа-файл в хранилище
								move_uploaded_file( $this->fupload->FPATH, $dest_path );
							}

						}

					}
				}
			}
		}

		// запускаем процедуру конвертирования медиа-файлов
		$this->convert_update_queues( $this->id );
	}

	function convert_update_queues( $anket_id ) {

		$anket_id = filter( $anket_id );

		// получаем информацию об анкете
		$anket = $this->get_anket_info( $anket_id );
		if( !empty($anket) ) {

			// добавляем отсутствющие задачи конвертирования
			foreach( $this->lists->data['ankets']['files_groups'] as $group_id => $group )
			if( !empty($group['conv_tpls']) ) {
				foreach( $group['conv_tpls'] as $conv_tpl_name => $conv_tpl_enabled ) {
					if( !empty($conv_tpl_enabled) && isset($this->lists->data['ankets']['conv_tpl_index'][$conv_tpl_name]) ) {
						$conv_tpl_id = $this->lists->data['ankets']['conv_tpl_index'][$conv_tpl_name];

						// проверяем файлы анкеты
						if( !empty($anket[$group_id]) )
						foreach( $anket[$group_id] as $file_id => $file ){
							if( !isset($file['conv_files'][$conv_tpl_name]) ) {
								$conv_path = $this->get_file_converted_path( $file['path'], $conv_tpl_id );
								// создаем задачу конвертирования
								$this->mysqli->query('INSERT IGNORE INTO `data_ankets_files_conv` (`anket_id`,`file_id`,`conv_tpl_id`,`conv_state`,`conv_path`) VALUES (\''.$anket_id.'\',\''.$file_id.'\',\''.$conv_tpl_id.'\',"unprocessed",\''.addslashes($conv_path).'\')');
							}
						}

					}
				}
			}

		}

	}

	function get_anket_info( $anket_id, $items=null ) {

		$anket = array();

		if( $items === null ) {
			$q = '

				SELECT		*,
							`items`.`id` AS `id`,
							`items`.`id` AS `anket_id`,
							`file`.`id` AS `file_id`
							

				FROM		`data_ankets` AS `items`

				LEFT JOIN	`data_ankets_files` AS `file`
				ON			`items`.`id` = `file`.`anket_id`

				LEFT JOIN	`data_ankets_files_conv` AS `conv`
				ON			`file`.`id` = `conv`.`file_id`

				WHERE		`items`.`id` = '. $anket_id .'
				ORDER by `file`.`order` ASC

			';
			$items = mysql_assoc_array( $q );
		}

		if( !empty($items) ) {
			$anket = $items[0];

			$conv_files_by_id = array();
			$conv_files_by_tpl = array();
			$files_info = array();
			foreach( $items as $item ) {

				if( !isset($conv_files_by_id[$item['file_id']]) ) {
					$conv_files_by_id[ $item['file_id'] ] = array();
					$conv_files_by_tpl[ $item['file_id'] ] = array();

					$file = array();
					foreach( $this->lists->data['db']['struct']['data_ankets_files'] as $col_name => $col_info ) {
						$file[ $col_name ] = $item[ $col_name ];
					}
					$file['file_id'] = $item['file_id'];
					$file['id'] = $item['file_id'];

					$files_info[ $file['file_id'] ] = $file;


				}


				if( !empty($item['conv_id']) ) {
					$conv_file = array();
					foreach( $this->lists->data['db']['struct']['data_ankets_files_conv'] as $col_name => $col_info ) {
						$conv_file[ $col_name ] = $item[ $col_name ];
					}
					$conv_files_by_id[ $item['file_id'] ][ $conv_file['conv_id'] ] = $conv_file;

					if( $this->lists->exists( $conv_file['conv_tpl_id'], 'ankets', 'conv_tpl' ) ) {
						$conv_files_by_tpl[ $item['file_id'] ][ $this->lists->data['ankets']['conv_tpl'][$conv_file['conv_tpl_id']]['name'] ] = &$conv_files_by_id[ $item['file_id'] ][ $conv_file['conv_id'] ];
					}
				}


			}

			foreach( $files_info as $file_id => $file ) {
				$files_info[ $file_id ][ 'conv_files_by_id' ] = isset($conv_files_by_id[$file_id]) ? $conv_files_by_id[$file_id] : array();
				$files_info[ $file_id ][ 'conv_files' ] = isset($conv_files_by_tpl[$file_id]) ? $conv_files_by_tpl[$file_id] : array();
			}



			$anket += $this->get_sorted_media( $files_info );
		}
		return $anket;

	}

	// временные файлы (загрузка незарегистрированной анкеты)
	function get_temp_file_public_info( $file ) {
		return array(
			'id'		=> $file['id'],
			'extension'	=> $file['extension'],
			'uri'		=> $file['uri'],
			'thumb_uri'	=> !empty($file['thumb_uri']) ? $file['thumb_uri'] : null,
			'group'		=> $file['group'],
			'type'		=> $file['type'],
			'name'		=> $file['name']
		);
	}

	function get_temp_file_path( $file ) {
		return
			$this->get_temp_anket_path().
			$this->get_temp_anket_file_hash( $file['id'] ).'.'.$file['extension']
		;
	}
	function get_temp_file_uri( $file ) {
		return
			$this->get_temp_anket_uri().
			$this->get_temp_anket_file_hash( $file['id'] ).'.'.$file['extension']
		;
	}

	function get_temp_anket_uri() {
		return
			URI_UPLOADS.
			'ankets_temp/'.
			$this->get_temp_anket_sandbox_hash().'/'
		;
	}
	function get_temp_anket_path( $session_id = null ) {
		return
			PATH_UPLOADS.
			'ankets_temp/'.
			$this->get_temp_anket_sandbox_hash( $session_id ).'/'
		;
	}

	function get_temp_anket_sandbox_hash( $session_id = null ) {
		if( $session_id === null ) {
			$session_id = session_id();
		}
		return md5( md5( SALT_ANKET_TEMP.$session_id ) );
	}

	function get_temp_anket_file_hash( $file_id ) {
		return md5( md5( SALT_ANKET_FILE_TEMP.$file_id ) );
	}
}
?>
