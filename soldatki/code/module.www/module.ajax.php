<?php
########################################################
# 	module.ajax.php
#
#	AJAX-обработчик
#
#	Автор: Илья Ашмарин, post[at]cotfw.ru
#
#	История:
#			2017.11.15 - файл создан
#
########################################################
class MODULE_ajax {

	var $json = array( 'success' => false, 'msg' => '' );
	function _init() {
		$this->engine->modules->prepare_landing( $this );
	}

	function _start() {

		$registered_methods = array(
			'ankets_upload_file' => array( 'all' ),
			'ankets_delete_file' => array( 'all' )
		);

		$registeredMethods = array();
		foreach( $registered_methods as $m_name => $rights )
		$registeredMethods[ $m_name ] = true;

		$this->index_0 = $this->gets->str_val( $this->engine->index_0 );

		$method_name = str_replace( '-', '_', $this->index_0 );

		if(
			method_exists($this,$method_name)	&&
			isset($registeredMethods[ $method_name ])
		){
			// check rights
			$check_rights_success = $this->user->type == 'admin';
			$action_rights = $registered_methods[ $method_name ];

			if( gettype($action_rights) == 'array' ) {

				foreach( $action_rights as $allow_for_type )
				if( $allow_for_type == 'admin'				OR
					$allow_for_type == 'all'				OR
					$this->user->type == $allow_for_type
				)
					$check_rights_success = true;

			} else {

				if(
					$action_rights == 'admin'		OR
					$action_rights == 'all'
				) {

					$check_rights_success = true;

				} else {
					foreach( $this->lists->data['user_types']['data'] as $user_type => $user_title ) {
						if( $user_type == $this->user->type ) {
							$check_rights_success = true;
							break;
						}
					}
				}

			}

			if( $check_rights_success )
			$this->{ $method_name }();
		}

		echo_gz( $this->json );

	}

	function ankets_upload_file() {

		$group_id = $_GET['group'];
		if( $this->lists->exists( $group_id, 'ankets', 'files_groups' ) ) {
			$group = $this->lists->data[ 'ankets'][ 'files_groups' ][ $group_id ];

			// создаем необходимые директории, куда будут загружены файлы
			$temp_media_path = $this->ankets->get_temp_anket_path();
			dir_check_create( $temp_media_path );

			// подключаем системный модуль для работы с загруженными файлами
			$this->engine->load_module( 'fupload' );
			$this->fupload = &$this->engine->fupload;

			if( isset($group['max_width']) && isset($group['max_height']) ) {
				$this->fupload->IMG_SMALL_W	= $group['max_width'];
				$this->fupload->IMG_SMALL_H	= $group['max_height'];
			} else {
				$this->fupload->IMG_SMALL_W	= IMG_SMALL_W;
				$this->fupload->IMG_SMALL_H	= IMG_SMALL_H;
			}

			// группа файлов должна быть доступна для загрузки
			if( !empty($group['public']) ) {

				// ограничение на количество заливаемых файлов в группе
				if( empty($group['max_items']) || count($_SESSION[$group_id]) < $group['max_items'] ) {

					$this->fupload->init_index( 'uploadfile' );
					if($this->fupload->check_errors(
						'default-checks',
						$group['check_type']
					)){

						// формируем необходимую информацию о загруженном файле
						$file = array(
							'id'		=> uniqid(),
							'extension'	=> $this->fupload->FEXT,
							'name'		=> $this->fupload->FNAME_NOEXT,
							'group'		=> $group_id,
							'type'		=> $group['type'],
							'width'		=> IMG_SMALL_W,
							'height'	=> IMG_SMALL_H
						);
						$file['uri'] = $this->ankets->get_temp_file_uri( $file );
						$file['path'] = $this->ankets->get_temp_file_path( $file );

						// сохраняем файл в хранилище
						if( $group['type'] == 'image' ) {

							// сохраняем в хранилище файл с уменьшенным размером
							$this->fupload->create_jpg(
								$this->fupload->FPATH,
								$file['path'],
								$this->fupload->IMG_SMALL_W,
								$this->fupload->IMG_SMALL_H,
								IMG_CREATE_SMALLING
							);
						} else {
							// сохраняем загруженный медиа-файл в хранилище
							move_uploaded_file( $this->fupload->FPATH, $file['path'] );
						}

						// формируем размеры изображения
						$sizes	= getimagesize( $file['path'] );
						if( $sizes !== false ) {
							$file['width'] = $sizes[0];
							$file['height'] = $sizes[1];
						}

						// для видео генерируем thumb-изображение
						if( $group['type'] == 'video' ) {
							include_framework( 'php-ffmpeg/autoload' );
							$ffmpeg = FFMpeg\FFMpeg::create(array(
								'timeout' => intval($this->settings->val('ANKET_CONV_TIMEOUT'))
							));
							$video = $ffmpeg->open( $file['path'] );

							$thumb_path = $this->ankets->get_file_converted_path( $file['path'], $this->lists->val('thumb.orig','ankets','conv_tpl_index') );
							$file['thumb_uri'] = $this->ankets->get_file_converted_path( $file['uri'], $this->lists->val('thumb.orig','ankets','conv_tpl_index') );

							if( $thumb_path !== false ) {
								$file['thumb_path'] = $thumb_path;
								$video
									->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(intval($this->settings->val('ANKET_CONV_SCREENSHOTS_SECONDS'))))
									->save( $file['thumb_path'] )
								;
							}

						}

						// сохраняем информацию о загруженном файле на сервере
						$_SESSION[ $group_id ][ $file['id'] ] = $file;

						// информация о файле в JSON-ответе (урезанный массив $file)
						$this->json['file'] = $this->ankets->get_temp_file_public_info( $file );
						$this->good();

					} else {
						$this->bad( $this->fupload->get_err_msg() );
					}
				} else {
					$this->bad( 'превышено допустимое количество загружаемых файлов' );
				}
			} else {
				$this->bad( 'access error' );
			}
		} else {
			$this->bad( 'неизвестная файловая группа' );
		}

	}

	function ankets_delete_file() {

		$group_id = $_GET['group'];
		$file_id = filter( $_GET['item_id'], MASK_TEXT );
		if( $this->lists->exists( $group_id, 'ankets', 'files_groups' ) ) {
			$group = $this->lists->data[ 'ankets'][ 'files_groups' ][ $group_id ];

			if( isset($_SESSION[$group_id][$file_id]) ) {
				unlink( $_SESSION[$group_id][$file_id]['path'] );
				unset( $_SESSION[$group_id][$file_id] );
				session_write_close();
				$this->good();

			} else {
				$this->bad( 'файл не найден' );
			}
		} else {
			$this->bad( 'неизвестная файловая группа' );
		}
	}

	function good( $msg = '' ){
		$this->json[ 'success' ] = 'true';
		if( !empty($msg) ) {
			$this->json['msg'] = $msg;
		}
		unset( $this->json['msg'] );
		echo_gz( $this->json );
	}

	function bad( $msg = '' ) {
		$this->json[ 'msg' ] = $msg;
		echo_gz( $this->json );
	}

	function filter_array( &$item ) {

		$type = gettype( $item );
		if( gettype($item) == 'array' ) {
			foreach( $item as $key => $value )
			$this->filter_array( $item[$key] );
		} else {
			$item = strip_tags( remove_quotes( $item ) );
		}

	}

}
?>
