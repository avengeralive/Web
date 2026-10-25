<?php
########################################################
# 	system.validate.php
#
#	Системный модуль валидации
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
class SYSTEM_validate {

	function _init()	{
	}

	function user( &$v, $id = 0 ) {
		$m = array();

		if( empty($v['email']) )
			$m[] = 'необходимо указать адрес электронной почты';
		else
			if( !email_check($v['email']) )
				$m[] = 'некорректный адрес электронной почты';
			else
				if( mysql_row('

					SELECT	1
					FROM	data_users

					WHERE	email = \''.remove_quotes($v['email']).'\' '.
							($id?' AND id != '. $id:'')

				))
					$m[] = 'адрес электронной почты занят';
				else;

		if( empty($v['company']) )
		$m[] = 'необходимо указать компанию';

		return $m;
	}

	function anket( &$p ) {
		$m = array();

		// проверка на ограничение количества заявок
		if( !$this->engine->user->check_ipAccess('request') ) {
			if( !DEBUG ) {
				$m[] = $this->engine->error->get_error_msg(
					$this->engine->error->val('err_main'),
					array(
						'ip'			=> $this->engine->user->ip,
						'block_time'	=> $this->engine->error->val('time_to_wait')
					)
				);
			}
		} else {

			if( empty($p['last_name']) ) {
				$m[] = 'необходимо указать фамилию';
			}
			if( empty($p['first_name']) ) {
				$m[] = 'необходимо указать имя';
			}
			if( empty($p['date_birthday']) ) {
				$m[] = 'необходимо указать дату рождения';
			}
			if( empty($p['city']) ) {
				$m[] = 'необходимо указать город';
			}
			if( empty($p['phone']) ) {
				$m[] = 'необходимо указать телефон';
			}
			if( empty($p['email']) ) {
				$m[] = 'необходимо указать емейл';
			} else {
				if( !email_check($p['email']) ) {
					$m[] = 'некорректный адрес емейл';
				}
			}
			// $capcha_check = $this->capcha( $p );
			// if( !empty($capcha_check) ) {
				// $m[] = $capcha_check;
			// }

			if(
				$this->engine->user->type != 'admin' &&
				(
					empty($_SESSION['photos']) &&
					(
						empty($_FILES['photos']) ||
						$_FILES['photos']['error'][0] == '4'
					)
				)
			) {
				$m[] = 'необходимо загрузить фотографии';
			}
			if(
				$this->engine->user->type != 'admin' &&
				(
					empty($_SESSION['videos']) &&
					(
						empty($_FILES['videos']) ||
						$_FILES['videos']['error'][0] == '4'
					)
				)
			) {
				$m[] = 'необходимо загрузить видео';
			}

		}

		return $m;
	}

	function capcha( &$p ) {
		$err_msg = '';

		if( empty($p['capcha']) ) {
			$err_msg = 'необходимо ввести капчу';
		} else {
			session_start();
			if( !isset( $_SESSION['captcha_keystring'] ) || $_SESSION['captcha_keystring'] != $p['capcha'] ){
				$err_msg = 'некорректные цифры';
			}
		}

		return $err_msg;
	}
}
?>
