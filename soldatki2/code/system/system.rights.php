<?php
########################################################
#	system.rights.php
#
#	Интерфейс, позволяющий разрешить/отказать в доступе
#	к чему-либо (модулю/действию/странице и т.д.)
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
class SYSTEM_rights	{

	function _init()	{
		$this->lists	= &$this->engine->lists;
		$this->user		= &$this->engine->user;

		$this->s = &$GLOBALS['subdomain'];
	}

	var $actions = array(
		// index => method-name
		'module-site'			=> 'allow_moduleSite',
		'module-lk'				=> 'allow_moduleLK',
		'module-landing'		=> 'allow_moduleLanding',
		'lk-ankets-delete'		=> 'allow_lk_ankets',
		'lk-ankets-insert'		=> 'allow_lk_ankets',
		'lk-ankets-edit'		=> 'allow_lk_ankets',
		'lk-ankets-moderate'	=> 'allow_lk_ankets',
	);
	function allow( $action_index, $params = array() ) {

		// админу разрешен полный доступ
		// UPD. могут быть модули, которые недоступны админу
		// if( $this->user->type == 'admin' )
		// return true;

		// права с индивидуальным обработчиком
		if(
			isset( $this->actions[$action_index] )	AND
			method_exists( $this, $this->actions[$action_index] )
		)
			return $this->{ $this->actions[$action_index] }( $params );

		return false;
	}


	// проверка на доступность выбранного посетителем модуля
	function allow_moduleSite( $url_str ) {

		$index = &$this->engine->modules->index;

		return

			// модуль зарегистрирован в системе
			isset( $index[$url_str]['index'] )			AND

			// модуль имеет статус "активен"
			empty( $index[ $url_str ][ 'is_disabled' ] )	AND
			(
				// набор условий, если пользователь авторизован
				(
					$this->user->is_authorized 				AND

					// модуль может запускаться, если пользователь авторизован
					$index[ $url_str ][ 'allow_auth' ]		AND
					(
						// админу разрешен запуск модуля в любом случае
						// UPD. могут быть модули, которые недоступны админу
						// $this->user->type == 'admin'
						// 	OR

						// модуль доступен для всех типов пользователей
						isset(
							$index
								[ $url_str ]
								[ 'allow_utypes' ]
								[ 'all' ]
						)
							OR

						// модуль доступен для текущего пользователя
						isset(
							$index
								[ $url_str ]
								[ 'allow_utypes' ]
								[ $this->user->type ]
						)
					)
				)
					OR
				// набор условий, если пользователь неавторизован
				(
					!$this->user->is_authorized		AND

					// модуль может запускаться, если пользователь неавторизован
					$index[ $url_str ][ 'allow_unauth' ]
				)
			)
		;
	}

	// проверка на доступность модуля "панель управления"
	function allow_moduleLK( $index ) {
		return
			// модуль зарегистрирован в системе
			$this->lists->exists( $index, 'lk_modules', $this->s )		AND

			// модуль имеет статус "активен"
			empty(
				$this->lists->data
					[ 'lk_modules' ]
					[ $this->s ]
					[ $index ]
					[ 'is_disabled' ]
			)
				AND

			(
				// админу разрешен запуск модуля в любом случае
				// UPD. могут быть модули, которые недоступны админу
				// $this->user->type	== 'admin'
				// 	OR

				// модуль доступен для всех типов пользователей
				isset(
					$this->lists->data
						[ 'lk_modules' ]
						[ $this->s ]
						[ $index ]
						[ 'allow_utypes' ]
						[ 'all' ]
				)
					OR

				// модуль доступен для текущего пользователя + флаг доступности установлен в true
				(
					isset(
						$this->lists->data
							[ 'lk_modules' ]
							[ $this->s ]
							[ $index ]
							[ 'allow_utypes' ]
							[ $this->user->type ]
					)
						AND
					!empty(
						$this->lists->data
							[ 'lk_modules' ]
							[ $this->s ]
							[ $index ]
							[ 'allow_utypes' ]
							[ $this->user->type ]
					)
				)
			)
		;
	}

	function allow_moduleLanding( $index ) {
		return true;
	}
	function allow_lk_ankets() {
		return $this->user->type == 'admin';
	}

}
?>
