<?php
########################################################
#	lk.ajax.php
#
#	Модуль "AJAX-обработчик"
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.03 - файл создан
#
########################################################
class MODULE_ajax	{

	function _init()	{
		global $mysqli;
		$this->mysqli = &$mysqli;

		$this->gets			= &$this->engine->gets;
		$this->user			= &$this->engine->user;
		$this->lists		= &$this->engine->lists;
		$this->template		= &$this->engine->template;
		$this->settings		= &$this->engine->settings;
		$this->user			= &$this->engine->user;
		$this->authors		= &$this->engine->authors;
		$this->books		= &$this->engine->books;
		$this->forwarder	= &$this->engine->forwarder;
		$this->ankets		= &$this->engine->ankets;

	}

	function _start()	{
		$registered_methods = array(
			'ankets_set_status'		=> array( 'admin' ),
			'ankets_set_rating'		=> array( 'admin' ),
			'ankets_get_file'		=> array( 'admin' ),
			'stat'					=> array( 'admin' ),
		);

		$registeredMethods = array();
		foreach( $registered_methods as $m_name => $rights )
		$registeredMethods[ $m_name ] = true;

		$this->index_0 = $this->gets->str_val( $this->root->module );

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

	function ankets_set_status() {

		$item_id	= filter( $_GET['item_id'] );
		$new_value	= filter( $_GET['new_value'], MASK_ENUM );

		if( $this->lists->exists( $new_value, 'ankets', 'statuses' ) ) {
			$this->mysqli->query('

				UPDATE	`data_ankets`
				SET		`status` = "'. $new_value .'"
				WHERE	`id` = '. $item_id

			);

			if( !$this->mysqli->errno ) {
				$this->good();
			} else {
				$this->bad( 'произошла ошибка при выполнении запроса к базе данных' );
			}
		} else {
			$this->bad( 'неизвестный статус' );
		}
	}

	function ankets_set_rating() {

		$item_id	= filter( $_GET['item_id'] );
		$new_value	= filter( $_GET['new_value'] );

		$this->mysqli->query('

			UPDATE	`data_ankets`
			SET		`rating` = "'. $new_value .'"
			WHERE	`id` = '. $item_id

		);

		if( !$this->mysqli->errno ) {
			$this->good();
		} else {
			$this->bad( 'произошла ошибка при выполнении запроса к базе данных' );
		}
	}

	function ankets_get_file() {

		$file_id = filter( $_GET['file_id'] );

		// получаем фамилию из анкеты
		$file = mysql_assoc("

			SELECT		`file`.*,
						`anket`.`last_name`,
						`file`.`id` AS `id`

			FROM		`data_ankets_files` AS `file`

			LEFT JOIN	`data_ankets` AS `anket`
			ON			`anket`.`id` = `file`.`anket_id`

			WHERE		`file`.`id` = '$file_id'

		");

		if( !$this->mysqli->errno ) {
			if( !empty($file) ) {
				$file_path = $this->ankets->get_file_path( $file );
				if( file_exists($file_path) ) {
					$file_name = '';
					if( !empty($file['last_name']) ) {
						$file_name = $file['last_name'];
						if( !empty($file['extension']) ) {
							$file_name .= ".$file[extension]";
						}
					}

					file_force_download( $file_path, $file_name );
				} else {
					not_found();
				}
			} else {
				not_found();
			}
		} else {
			not_found();
		}
	}

	function stat() {
		$this->json['data'] = array(
			'space_free'			=> $this->ankets->get_space_free(),
			'space_total'			=> $this->ankets->get_space_total(),
			'active_convert_tasks'	=> $this->ankets->get_active_convert_tasks_count()
		);
		$this->good();
	}

	function good(){
		$this->json[ 'status' ] = 'good';
		unset( $this->json['err_msg'] );
		echo_gz( $this->json );
	}

	function bad( $err_msg = '' ) {
		$this->json[ 'err_msg' ] = $err_msg;
		echo_gz( $this->json );
	}

}
?>
