<?php
########################################################
#	module.main.php
#
#	Главная страница
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.01 - файл создан
#
########################################################
class MODULE_main	{

	var $errors = array();
	var $notices = array();

	function _init()	{
		$this->engine->modules->prepare_landing( $this );

		$this->template->assignByRef( 'errors', $this->errors );
		$this->template->assignByRef( 'notices', $this->notices );
	}

	function _start()	{
		$this->anket_init();
		$this->anket_checkSend();

		$this->template->display( 'main.tpl' );
	}

	function anket_init() {

		$this->template->js_libs[] = 'SimpleAjaxUploader';
		$this->template->js_libs[] = 'jquery.simplemodal';

		// инициализационные значения массива загрузок
		$this->uploaded_files = array();
		if( !isset($_SESSION['uploads']) ) {
			$_SESSION['uploads'] = array();
		}
		foreach( $this->lists->data['ankets']['files_groups'] as $group_id => $gropup_info ) {
			if( !isset($_SESSION[$group_id]) ) {
				$_SESSION[$group_id] = array();
			}
			if( !isset($this->uploaded_files[$group_id]) ) {
				$this->uploaded_files[ $group_id ] = array();
			}
		}

		// формируем уже загруженные файлы
		foreach( $this->lists->data['ankets']['files_groups'] as $group_id => $gropup_info ) {
			if( !empty($_SESSION[$group_id]) ) {
				foreach( $_SESSION[$group_id] as $file ) {
					$this->uploaded_files[ $group_id ][ $file['id'] ] = $this->ankets->get_temp_file_public_info( $file );
				}
			}
		}

		$this->template->javascript .= 'var uploadedFiles = '.json_encode($this->uploaded_files).';';

	}

	function anket_checkSend() {

		include_constants( 'post.anket' );
		$this->template->assignByRef( 'act', $this->ACT );
		$this->ACT	= 'insert';

		if( !isset($_POST['action']) || $_POST['action'] != 'send_anket' )
		return $this->anket_initInputs();

		$this->ACT .= '-try';
		$this->anket_initInputs();

		if( $this->anket_checkInputs()) {
			$this->template->form_insertVals( $GLOBALS['POST_ANKET'] );
			$this->anket_do();
		}
	}

	function anket_initInputs() {

		$this->template->cur_obj = array();

		// form inputs using std interface
		$this->template->ACT = &$this->ACT;
		$this->template->form_inputs( $GLOBALS['POST_ANKET'] );
		$this->inputs = &$this->template->inputs;

		$this->template->assignByRef( 'inputs', 	$this->inputs );
		$this->template->assignByRef( 'cur_obj',	$this->template->cur_obj );

	}

	function anket_checkInputs() {
		$this->errors = $this->validate->anket( $this->inputs );

		if( !isset($_POST['confirm_personal_process']) ) {
			$this->errors[] = 'необходимо подтвердить согласие на обработку персональных данных';
		}

		return empty( $this->errors );
	}

	function anket_do() {

		$v = &$this->template->vals;

		$v['date_created'] = mysql_unixToTimestamp( NOW );

		$rows = array();
		$vals_stmt = array();
		$vals = array();
		$types = '';
		foreach( $v as $row => $value ) {
			$rows[] = '`'. $row .'`';
			$vals_stmt[] = '?';
			$vals[] = &$v[$row];
			$types .= 's';
		}

		$sql = 'INSERT INTO `data_ankets` ('. implode(',',$rows) .') VALUES ('. implode(',',$vals_stmt) .')';
		// pr($sql);pr($vals);
		$stmt = $this->mysqli->prepare($sql);
		if($stmt !== false) {
			// добавляем в начало переменную с описанием типов добавляемых данных
			array_unshift( $vals, $types );

			// выполняем запрос добавления
			call_user_func_array(array($stmt, 'bind_param'), $vals);
			$stmt->execute();
			$stmt->close();

			if( !$this->mysqli->errno ) {
				$this->id = $this->mysqli->insert_id;

				if( empty($this->errors) ) {
					$this->ankets->id = &$this->id;
					$this->anket_process_media();

					$this->template->assign( 'anket_sended', true );

					$this->user->increment_attempt( 'request' );
				}

				header('Location: /about');

			} else {
				$this->errors[] = 'Произошла ошибка при сохранении записи в базе данных. Обратитесь к администратору';
			}
		} else {
			$this->errors[] = 'Произошла ошибка при сохранении записи в базе данных. Обратитесь к администратору';
		}

	}

	function anket_process_media() {
		$ankets_media_path = $this->ankets->get_anket_path( $this->id );
		dir_check_create( $ankets_media_path );

		foreach( $this->lists->data['ankets']['files_groups'] as $group_id => $gropup_info ) {
			if( !empty($_SESSION[$group_id]) ) {

				// выполняем необходимые операции над файлами
				foreach( $_SESSION[$group_id] as $file_id => $file ) {
					$query = $this->mysqli->prepare('INSERT INTO `data_ankets_files` (`anket_id`,`group`,`extension`,`filename`) VALUES (?,?,?,?)');
					$query->bind_param( 'isss', $this->id, $group_id, $file['extension'], $file['name'] );
					$query->execute();
					$query->close();
					if( !$this->mysqli->errno ) {
						$img_id = $this->mysqli->insert_id;

						$dest_path = $this->ankets->get_file_path(array(
							'anket_id'	=> $this->id,
							'id'		=> $img_id,
							'extension'	=> $file['extension']
						));

						// перемещаем файл из временной песочницы в песочницу хранилища
						rename( $file['path'], $dest_path );
					}
				}

				// очищаем сессию
				unset( $_SESSION[$group_id] );
				$_SESSION[ $group_id ] = array();
			}
		}

		// запускаем задачу перекодирования видео анкет
		$this->ankets->convert_update_queues( $this->id );
	}
}

?>
