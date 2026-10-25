<?php
########################################################
# 	system.user.php
#
#	Модуль, связанный с авторизацией пользователя
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
class SYSTEM_user	{

	var $info  = array();
	var $is_authorized = 0;
	var $id = 0;
	var $hash = '';
	var $rights = array();
	var $lic = array();

	var $auth_pass_hashed = '';
	var $save_session = true;
	var $sandbox_mode = false;

	var $static = false;

	function _init( $static = false )	{

		global $mysqli;
		$this->mysqli = &$mysqli;

		$this->static = $static;

		if( !$static ) {

			$this->gets		= &$this->engine->gets;
			$this->error	= &$this->engine->error;
			$this->settings	= &$this->engine->settings;

		} else {

			global $gets, $error, $settings, $db;
			$this->gets		= &$gets;
			$this->error	= &$error;
			$this->settings	= &$settings;

		}

		init_interfaces( $this, $static, array('lists','logs') );

		if( !isset($_SERVER['REMOTE_ADDR']) )
		$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

		$this->ip		= $_SERVER['REMOTE_ADDR'];
		$this->ip_int	= ip2long( $this->ip );

		$this->CONF		= 0x00;
		$this->inf = array(
			'cookie_uid'	=> 'uid',
			'cookie_hash'	=> 'hash',
			'cookie_path'	=> '/',
			'cookie_domain'	=> &$this->lists->domain,
			'is_admin'		=> '0',
			'try_count'		=> TRY_USER_AUTH,
			'block_time'	=> TIME_BLOCK_USER,
			'spam_id' 		=> ID_SPAM_TYPE_USER_AUTH
		);
		$this->info['is_authorized'] = &$this->is_authorized;
		$this->check_autorized();

		if( empty($this->type) )
		$this->type = 'user';

		if( $this->is_authorized && !$static ) {
			$this->sandbox_hash = $this->get_user_sandbox_hash();
		}

	}

	var $try = array();
	function check_autorized()	{
		$this->is_authorized	= 0;
		$this->is_admin			= false;
		$this->id				= 0;
		$this->login			= '';
		$this->type				= '';

		if( !empty($_COOKIE[$this->inf['cookie_uid']]) && !empty($_COOKIE[$this->inf['cookie_hash']]) ){

			$id  = filter($_COOKIE[$this->inf['cookie_uid']]);
			$try = mysql_assoc('

				SELECT	*
				FROM	`data_users`

				WHERE	`id` = '. $id .' AND
						`status` = "active"

			');
			if(
				!empty($try) &&
				$try['hash'] == filter_ref( $_COOKIE[$this->inf['cookie_hash']], MASK_HASH, 32 )
			) {
				$try[ 'last_ip' ] = long2ip( $try['last_ip'] );

				if( LOG_USER_LAST_VISITED && !$this->sandbox_mode )
				$this->mysqli->query('

					UPDATE	`data_users`
					SET		`last_visited` = "'. mysql_unixToTimestamp( NOW ) .'"
					WHERE	`id` = '. $try['id']

				);

				$this->is_authorized = 1;
				$this->id		= $try[ 'id' ];
				$this->login	= $try[ 'email' ];
				$this->email	= $try[ 'email' ];
				$this->type		= $try[ 'type' ];
				$this->try		= &$try;
// pr($try);
				$this->get_user_info();

			} else $this->logoff();
		}

		if( isset($_POST['try_auth']) )
			if( $this->check_auth() ){
				// перенаправляем в личный кабинет (если не находится в режиме песочницы)
				// if( !$this->sandbox_mode ) {
					// redirect( '/lk' );
				// }
				$this->is_authorized = 1;
				$this->get_user_info();
			} else {
				$this->is_authorized = 0;
			}
		else;
	}

	var $time_to_wait = 0;
	var $time         = 0;
	var $usr_spam_log = array();

	// Проверка на авторизацию
	function check_auth()	{

		$this->time = NOW;

		$this->usr_spam_log = mysql_assoc('

			SELECT	`time`, `err_count`
			FROM	`logs_auth`

			WHERE	`ip` = '. $this->ip_int . ' AND
					`type` = '. $this->inf['spam_id']

		);

	#лог на этот айпи уже есть, не создаем новую запись
		if( !empty($this->usr_spam_log) )	{

	#число попыток авторизации превысило максимум
			if( $this->usr_spam_log['err_count'] >= $this->inf['try_count'] )
	#проверка на остановку блокировки пользователя
				if( $this->usr_spam_log['time']+$this->inf['block_time'] < $this->time )
					$this->usr_spam_log['err_count']=0;
	#иначе выводим сообщение о том, что необходимо ждать окончания блокировки
				else	{
					$this->error->insert( 'err_main', ERROR_USER_BLOCKED );
					$this->error->insert(
						'time_to_auth_wait',
						parse_sec(
							$this->usr_spam_log['time']
							+
							$this->inf['block_time']
							-
							$this->time
						)
					);

					$this->clear_cookies(
						$this->inf['cookie_uid'] .';'. $this->inf['cookie_hash'],
						$this->inf['cookie_path']
					);
					return 0;
				}
			else
	#если прошло >TIME_BLOCK времени с момента последней попытки, сбрасываем на нуль
				if( $this->usr_spam_log['time'] + $this->inf['block_time'] < $this->time )
					$this->usr_spam_log['err_count']=0;
				else;
		} else {
			$this->mysqli->query('

				INSERT INTO `logs_auth`
				(
					`type`,
					`time`,
					`ip`
				) VALUES (
					"'. $this->inf['spam_id'] .'",
					"'. $this->time .'",
					"'. $this->ip_int .'"
				)
			' );
			$this->usr_spam_log[ 'err_count' ] = 0;
			$this->usr_spam_log[ 'time' ]      = $this->time;
		}
		################################

		if( !isset($_POST['login']) )
		$_POST['login'] = '';

		if( !isset($_POST['password']) )
		$_POST['password'] = '';

		$LOGIN = remove_quotes( $_POST['login'] );
		$phone_mode = false;

		if( !empty($this->auth_pass_hashed) )
			$pass_check = $this->auth_pass_hashed;
		else
			$pass_check = $this->make_crypt( $_POST['password'] );

		$try = mysql_assoc('

			SELECT	*
			FROM	`data_users`

			WHERE	`email` = \''.$LOGIN.'\' AND
					`password` = \''. $pass_check .'\' AND
					`status` = "active"

		');

		if( !empty($try) )	{

			if( $try['status'] == 'blocked' ) {
				$this->error->insert( 'err_main', ERROR_USER_DELETED );
				return 0;
			}
			elseif( $try['status'] == 'active' ) {
				$this->is_authorized = 1;
				$this->id			= $try[ 'id' ];
				$this->login		= $try[ 'email' ];
				$this->email		= $try[ 'email' ];
				$this->type			= $try[ 'type' ];
				$this->try			= &$try;

				$this->check_auth_setLoginErrorCount( 0 );

				if( !empty($try['hash']) ) {
					$this->hash = $try['hash'];
				} else {

					if( !empty($this->auth_pass_hashed) )
						$this->hash = $this->auth_pass_hashed;
					else
						$this->hash = $this->make_hash( $try['email'], $_POST['password'] );

					$this->mysqli->query('

						UPDATE	`data_users`
						SET		`hash` = "'. $this->hash .'"
						WHERE	`id` = '.$this->id

					);
				}

				if( $this->save_session ) {
					setcookie( $this->inf['cookie_uid'],	$this->id,	COOKIE_TIME,	$this->inf['cookie_path'], $this->inf['cookie_domain'] );
					setcookie( $this->inf['cookie_hash'],	$this->hash,COOKIE_TIME,	$this->inf['cookie_path'], $this->inf['cookie_domain'] );
					setcookie( $this->inf['cookie_uid'],	$this->id,	COOKIE_TIME,	$this->inf['cookie_path'], '.'.$this->inf['cookie_domain'] );
					setcookie( $this->inf['cookie_hash'],	$this->hash,COOKIE_TIME,	$this->inf['cookie_path'], '.'.$this->inf['cookie_domain'] );
				}

				if( LOG_USER_LAST_VISITED && !$this->sandbox_mode )
				$this->mysqli->query('

					UPDATE	`data_users`

					SET		`last_ip` = "'. $this->ip_int .'",
							`last_visited` = "'. mysql_unixToTimestamp( NOW ) .'"

					WHERE	`id` = '.$this->id

				);

				return 1;
			}
		} else {
			$this->usr_spam_log['err_count']++;

			if( $this->usr_spam_log['err_count'] >= $this->inf['try_count'] )	{
				$this->error->insert( 'err_main', ERROR_USER_BLOCKED );
				$this->error->insert( 'time_to_auth_wait', parse_sec($this->inf['block_time']) );
			} else {
				$this->error->insert( 'err_main', ERROR_AUTH );
			}

			$this->check_auth_setLoginErrorCount( $this->usr_spam_log['err_count'] );
			$this->clear_cookies( $this->inf['cookie_uid'].';'.$this->inf['cookie_hash'], $this->inf['cookie_path'] );
			return 0;
		}
	}

	function check_auth_setLoginErrorCount( $err_count )	{
		$this->mysqli->query('

			UPDATE	`logs_auth`

			SET		`time` = "'. $this->time .'",
					`err_count` = "'. $err_count .'"

			WHERE	`ip` = "'. $this->ip_int .'" AND
					`type` = "'. $this->inf['spam_id'] .'"

		' );
	}

	function check_registerAccess() {

		$query_resetAttemptsCount = '

			UPDATE	`logs_auth`

			SET		`time` = '. NOW .',
					`err_count` = 0

			WHERE	`ip` = '.$this->ip_int.' AND
					`type` = '. ID_SPAM_TYPE_REGISTER

		;

		@list( $time_last, $err_count ) = mysql_fetch('

			SELECT	`time`, `err_count`
			FROM	`logs_auth`

			WHERE	`ip` = '. $this->ip_int.' AND
					`type` = '. ID_SPAM_TYPE_REGISTER

		);

		// log exists, no creating new log's record
		if( !empty($time_last) )	{
			// try count limited
			if( $err_count >= TRY_REGISTER_COUNT )
				// check for stop block
				if( $time_last + TIME_BLOCK_REGISTER < NOW )
					$this->mysqli->query( $query_resetAttemptsCount );
				// show message - user should to wait for registration
				else	{
					$this->error->insert( 'err_main', ERROR_REG_BLOCKED );
					$this->error->insert( 'time_to_wait', parse_sec(
							$time_last + TIME_BLOCK_REGISTER - NOW
						)
					);
					return false;
				}
			else
				// reset attempts count, if block time expired
				if( $time_last + TIME_BLOCK_REGISTER < NOW )
					$this->mysqli->query( $query_resetAttemptsCount );
				else;
		} else {
			// creating new log's record
			$this->mysqli->query('

				INSERT INTO `logs_auth`
				(

					`type`,
					`time`,
					`ip`,
					`err_count`

				) VALUES (

					'. ID_SPAM_TYPE_REGISTER .',
					'. NOW .',
					'. $this->ip_int .',
					0

				)

			');
		}

		return true;
	}

	function check_ipAccess( $name ) {
		if( isset($this->lists->data['auth'][$name]) ) {
			return $this->_check_ipAccess( $this->lists->data['auth'][$name] );
		}

		return false;
	}

	function _check_ipAccess( $params ) {

		$options = $params + array(
			'spam_id'		=> '0',
			'max_attempts'	=> '3',
			'block_time'	=> ONE_DAY,
			'error_id'		=> ERROR_REG_BLOCKED
		);

		$query_resetAttemptsCount = '

			UPDATE	`logs_auth`

			SET		`time` = '. NOW .',
					`err_count` = 0

			WHERE	`ip` = '.$this->ip_int.' AND
					`type` = '. $options['spam_id']

		;

		@list( $time_last, $err_count ) = mysql_fetch('

			SELECT	`time`, `err_count`
			FROM	`logs_auth`

			WHERE	`ip` = '. $this->ip_int.' AND
					`type` = '. $options['spam_id']

		);

		// log exists, no creating new log's record
		if( !empty($time_last) )	{
			// try count limited
			if( $err_count >= $options['max_attempts'] )
				// check for stop block
				if( $time_last + $options['block_time'] < NOW )
					$this->mysqli->query( $query_resetAttemptsCount );
				// show message - user should to wait for registration
				else	{
					$this->error->insert( 'err_main', $options['error_id'] );
					$this->error->insert( 'time_to_wait', parse_sec(
							$time_last + $options['block_time'] - NOW
						)
					);
					return false;
				}
			else
				// reset attempts count, if block time expired
				if( $time_last + $options['block_time'] < NOW )
					$this->mysqli->query( $query_resetAttemptsCount );
				else;
		} else {
			// creating new log's record
			$this->mysqli->query('

				INSERT INTO `logs_auth`
				(

					`type`,
					`time`,
					`ip`,
					`err_count`
				) VALUES (

					'. $options['spam_id'] .',
					'. NOW .',
					'. $this->ip_int .',
					0
				)

			');
		}

		return true;
	}

	function clear_attempt( $name )	{

		if( isset($this->lists->data['auth'][$name]) ) {
			$this->mysqli->query('

				DELETE
				FROM	`logs_auth`
				WHERE	`ip` = "'. $this->ip_int .'" AND
						`type` = "'.$this->lists->data['auth'][$name]['spam_id'].'"

			');
		}

	}

	function increment_attempt( $name ) {

		if( isset($this->lists->data['auth'][$name]) ) {
			$this->mysqli->query('

				UPDATE	`logs_auth`
				SET		`err_count` = `err_count` + 1
				WHERE	`ip` = '. $this->ip_int .' AND
						`type` = '.$this->lists->data['auth'][$name]['spam_id']

			);
		}

	}

	function check_for_update_associated_data( $old, $new ) {

		if(
			$old['email'] != $new['email'] ||
			$old['name'] != $new['name']
		) {
			$new_fio = $this->get_fio( $new );

			$this->mysqli->query('

				UPDATE	`data_news`
				SET		`author_cache` = \''.$new_fio.'\'
				WHERE	`author_id` = '. $old['id']

			);
		}

	}

	function tpl_allow( $params )	{
		if( gettype($params) == 'string' )
		$params = array( 'index' => $params );

		if( !isset($params['index']) )
		return '';

		$like = $params['index'];

		if( isset($this->lists->data['modules']['data'][$like]['name']) )
		return $this->lists->data['modules']['data'][$like]['name'];

		return '';
	}

	// PHP >= 5.2.0
	function get_server_timezone_offset( $user_timezone=null ) {

		if( $user_timezone === null )
			if( !empty($this->info['timezone']) )
				$user_timezone = $this->info['timezone'];
			else
				$user_timezone = TZ_DEFAULT;

		$dateTimeZoneServer = new DateTimeZone("UTC");
		$dateTimeZoneMy = new DateTimeZone( $user_timezone );

		$dateTimeServer = new DateTime("now", $dateTimeZoneServer);
		$dateTimeMy = new DateTime("now", $dateTimeZoneMy);

		return $dateTimeZoneMy->getOffset($dateTimeServer);
	}

	function get_server_timezone_offset_from_name( $timezone_name ) {
		$timezone_name = filter( $timezone_name, MASK_TEXT );
		$offset = $this->get_server_timezone_offset( $timezone_name ) / 60;
		return get_time_for_schedule( $offset, true/*with sign*/ );
	}

	function get_activation_hash( $uid ) {
		return md5( md5( ACTIVATE_SALT.$uid ) );
	}

	function get_user_sandbox_hash( $uid = null ) {
		if( $uid === null )
		$uid = $this->id;

		return md5( md5( SALT_USER_SANDBOX.$uid ) );
	}

	function set_user_info( $update_rows, $user_id='', $update_in_db = true ) {

		if( empty($user_id) ) {
			$user_id = $this->id;
		}

		foreach( $update_rows as $key => $value ) {
			$this->info[ $key ] = $value;
		}

		if( $update_in_db ) {
			mysql_update_rows(
				$update_rows,
				'data_users',
				"`id` = '$user_id'"
			);
		}

	}

	function get_user_info() {

		$this->info = $this->try;

		$this->info[ 'id' ]		= &$this->id;
		$this->info[ 'type' ]	= &$this->type;
		$this->info[ 'ip' ]		= &$this->ip;

		$this->info[ 'type_name' ] = $this->lists->val( $this->type, 'users', 'types' );

		$this->info[ 'registered_unix' ] = mysql_timestampToUnix( $this->info['registered'] );

		if( $this->type == 'admin' ) {
			$this->is_admin = true;
			$this->inf['is_admin'] = 1;
		} else {
			$this->is_admin = false;
			$this->inf['is_admin'] = 0;
		}

		$this->get_fio( $this->info );

		// timezone
		if( !empty($this->info['timezone']) && $this->lists->exists( $this->info['timezone'], 'timezones' ) ) {
			date_default_timezone_set($this->info['timezone']);
		}

	}

	var $cache_GUIWID = array();
	function get_user_info_withID( $id )	{
		if( !empty($this->cache_GUIWID[$id]) )
		return $this->cache_GUIWID[$id];

		$data = mysql_assoc('

			SELECT	*
			FROM	`data_users`
			WHERE	`id` = '. $id

		);

		$this->cache_GUIWID[ $id ] = $data;

		return isset($this->cache_GUIWID[$id]) ? $this->cache_GUIWID[$id] : array();
	}

	function get_fio( &$info = null, $onEmptyUserEmail = false, $save_fio = true ) {

		$result = '';

		if( !$info )
		$info = &$this->info;

		if( !empty($info['name']) )
			$result = $info['name'];
		else
			if( $onEmptyUserEmail )
				$result = $info['email'];
			else;

		if( $save_fio )
		$info['fio'] = $result;

		return $result;
	}


	function get_company_name( &$info = null, $onEmptyFio = true, $onEmptyUserEmail = true ) {

		$result = '';

		if( !$info )
		$info = &$this->info;

		if( !empty($info['company']) )
			$result = $info['company'];
		else
			if( $onEmptyFio )
				$result = $this->get_fio( $info, $onEmptyUserEmail, false );
			else;

		return $result;
	}

	function get_restore_hash( $user_id ) {
		return
			md5(
				md5(
					$user_id.
					RESTORE_SALT.
					time().
					rand()
				)
			)
		;
	}

	function set_sandbox( $user_id ) {

		$user_id = filter( $user_id );

		$info = mysql_assoc('

			SELECT	`email`, `password`
			FROM	`data_users`
			WHERE	`id` = "'. $user_id .'"

		');

		// fake auth
		$_COOKIE['uid'] = '';
		$_COOKIE['hash'] = '';
		$_POST['login'] = $info['email'];
		$_POST['password'] = '';
		$_POST['try_auth'] = '1';
		$this->auth_pass_hashed = $info['password'];
		$this->save_session = false;
		$this->sandbox_mode = true;

		$this->_init( $this->static );

	}

	function set_balance( $balance, $currency=null ) {

		$this->mysqli->query('

			UPDATE	`data_users`
			SET		`balance` = \''. $balance .'\'
			WHERE	`id` = '. $this->id

		);
		$this->info['balance'] = $balance;
	}

	function generate_password() {

		$result = '';

		for( $i = 0;$i < 6;$i++ )
		$result .= rand( 0, 9 );

		return $result;

	}

	function form_list( $active_only = true ) {

		$list = array();
		$q = $this->mysqli->query('

			SELECT	*
			FROM	`data_users`
			WHERE	1'.( $active_only ? ' AND `status` = "active"' : '' )

		);
		while( $u = $q->fetch_assoc() ) {
			$u['name']='';
			$u['fio'] = $this->get_fio( $u, true );

			$list[ $u['id'] ] = $u;
		}
		$q->free();

		return $list;

	}

	function make_crypt( $password ) {
		return md5(md5( $password ));
	}

	function make_hash( $login, $password, $password_hashed='' ) {
		return
			md5(
				$login.
				SALT_TOKEN.
				( empty($password_hashed) ? $this->make_crypt($password) : $password_hashed )
			)
		;
	}

	function make_password( $password_length = 6, $str = '' ) {
		if( empty($str) ) {
			$str = MASK_GENPWD;
		}

		$len = strlen( $str ) - 1;

		$return = '';

		for( $i = 0;$i < $password_length;$i++ )
		$return .= $str[ rand(0, $len) ];

		return $return;
	}

	function clear_cookies( $names = 'uid;hash', $path = '/' )	{

		$explode = explode( ';', $names );
		$count = count( $explode );

		for($i = 0;$i < $count;$i++)
		if( isset($_COOKIE[$explode[$i]]) && $this->save_session ) {
			setcookie( $explode[$i], '', NOW - 1000, $path, $this->inf['cookie_domain'] );
			setcookie( $explode[$i], '', NOW - 1000, $path, '.'.$this->inf['cookie_domain'] );
		}
	}

	function logoff() {

		$this->clear_cookies(
			$this->inf['cookie_uid'].';'.$this->inf['cookie_hash'],
			$this->inf['cookie_path']
		);

	}

	function info( $index )	{
		if( isset($this->info[$index]) )
			return $this->info[$index];
		else	{
			$try = mysql_row('

				SELECT	'. $index .'
				FROM	`data_users`
				WHERE	`id` = '. $this->id

			);
			if( !empty($try) )	{
				$this->info[$index] = $try;
				return $try;
			}
			else
				return '';
		}
	}

	function delete( $ids ) {

		if( gettype($ids) != 'array' )
		$ids = array( $ids );

		if( empty($ids) )
		return;

		$imploded = implode( ',', $ids );

		$this->mysqli->query('

			DELETE
			FROM	`data_users`
			WHERE	`id` IN ('. $imploded .')

		');

		return $this->mysqli->affected_rows;
	}
}
?>
