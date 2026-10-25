<?php
########################################################
# 	lk.settings.php
#
#	Модуль "настройки"
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.03 - файл создан  
#
########################################################
class MODULE_settings {

	function _init() {

		global $mysqli;
		$this->mysqli = &$mysqli;

		$this->template	= &$this->engine->template;
		$this->lists	= &$this->engine->lists;
		$this->user		= &$this->engine->user;
		$this->settings	= &$this->engine->settings;

		$this->errors				= &$this->root->errors;
		$this->notices				= &$this->root->notices;
		$this->javascript			= &$this->root->javascript;
		$this->submenu_selected		= &$this->root->submenu_selected;
		$this->notices_codes		= &$this->root->notices_codes;
		$this->notices_codes_index	= &$this->root->notices_codes_index;
		$this->referer				= &$this->root->referer;
		$this->tpl_file				= &$this->root->tpl_file;

	}

	function _start() {

		$this->tpl_file = 'lk/settings.tpl';


		$this->check_updateSettings();
		$this->check_updatePassword();

	}

	function check_updateSettings() {


		if( isset($_POST['action']) && $_POST['action'] == 'update_settings' ) {

			foreach( $_POST['settings'] as $name => $value )
			if( $this->settings->exists($name) )
			$this->settings->update( $name, $value );

			if( empty($this->errors) ) {

				$this->notices[] = 'Настройки изменены';
			}
		}
	}

	function check_updatePassword() {

		if( isset($_POST['action']) && $_POST['action'] == 'update_password' ) {

			if( empty($_POST['new_password']) || empty($_POST['new_password2']) )
				$this->errors[] = 'Необходимо ввести новый пароль в оба поля';
			else
				if( $_POST['new_password'] != $_POST['new_password2'] )
					$this->errors[] = 'Введенные пароли не совпадают';
				else;

			$new_password = remove_quotes( $_POST['new_password'] );

			$update_rows = array(
				'password'	=> $this->user->make_crypt( $new_password ),
				'hash'		=> $this->user->make_hash( $this->user->login, $new_password )
			);

			if( empty($this->errors) && mysql_update_rows(
				$update_rows,
				'data_users',
				'`id`="'.$this->user->id.'"'
			)) {

				foreach( $update_rows as $index => $new_value )
				$this->user->info[ $index ] = $new_value;

				setcookie(
					$this->user->inf['cookie_hash'],
					$update_rows['hash'],
					COOKIE_TIME,
					$this->user->inf['cookie_path'],
					$this->user->inf['cookie_domain']
				);
				setcookie(
					$this->user->inf['cookie_hash'],
					$update_rows['hash'],
					COOKIE_TIME,
					$this->user->inf['cookie_path'],
					'.'.$this->user->inf['cookie_domain']
				);

				$this->notices[] = 'Пароль изменен';
			}
		}

	}

}
?>
