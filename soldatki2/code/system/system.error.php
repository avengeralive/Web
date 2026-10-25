<?php
###############################################
#	system.error.php
#
#	Системный модуль ошибок
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
###############################################
#
	$JSON_ERR_CODES = array(
		'UNKNOWN'			=>	0

		,'NOT_FOUND'					=>	1
		,'QUERY_TOO_SHORT'				=>	2
		,'WRONG_PARAMS'					=>	3
		,'ERROR_DB_INSERT'				=>	4
		,'DB_INSERT_TOO_SHORT_DATA'		=>	5


	);
	$JSON_ERR_MSGS	=	array(
		'UNKNOWN'			=>	'неизвестная ошибка'

		,'NOT_FOUND'					=>	'не найдено'
		,'QUERY_TOO_SHORT'				=>	'слишком короткий запрос'
		,'WRONG_PARAMS'					=>	'неправильный набор параметров'
		,'ERROR_DB_INSERT'				=>	'ошибка занесения записи в БД'
		,'DB_INSERT_TOO_SHORT_DATA'		=>	'длина данных слишком короткая'

	);
	$GLOBALS['JSON_ERR_CODES']	= &$JSON_ERR_CODES;
	$GLOBALS['JSON_ERR_MSGS']	= &$JSON_ERR_MSGS;
#
##############################################
class SYSTEM_error	{

	function _init()	{
		global $JSON_ERR_CODES, $JSON_ERR_MSGS;

		$this->err_array	= array();
		$this->json_codes	= &$JSON_ERR_CODES;
		$this->json_msgs	= &$JSON_ERR_MSGS;
	}

	function get_error_msg( $ERR_CODE, $params=array(''=>'') )	{
		$crlf = "";
		$return = '';
		if( isset($params['CRLF']) )	$crlf = "\n";
		if( isset($params['br']) )		$crlf = "<br>";

		switch( $ERR_CODE )	{
			case ERROR_AUTH: return 'неверная пара логин/пароль'.$crlf;

			case ERROR_USER_BLOCKED:
				if( isset($params['ip']) && isset($params['block_time']) )
					return	'IP <b>'.$params['ip'].'</b> заблокирован.<br>Доступ будет открыт через: '.$params['block_time'].$crlf;
				else
					return	'IP адрес заблокирован для авторизации' . $crlf;

			case ERROR_USER_REGISTERED:
				return 'Аккаунт неактивный и ожидает подтверждения регистрации';

			case ERROR_USER_DELETED:
				return 'Аккаунт заблокирован';

			case ERROR_REG_BLOCKED:
				if( isset($params['ip']) && isset($params['block_time']) )
					return	'Превышен лимит регистраций для IP-адреса <b>'.$params['ip'].'</b>. Регистрация будет возможна через '.$params['block_time'].$crlf;
				else
					return 'IP адрес заблокирован для регистрации' . $crlf;

			case ERROR_REQUEST_BLOCKED:
			case ERROR_RESTORE_BLOCKED:
				if( isset($params['ip']) && isset($params['block_time']) )
					return	'Превышен лимит заявок для IP-адреса <b>'.$params['ip'].'</b>. Отправка будет возможна через '.$params['block_time'].$crlf;
				else
					return 'IP адрес заблокирован для регистрации' . $crlf;

			case ERROR_404: return 'не найдено.' . $crlf;
			case ERROR_403: return 'доступ запрещен.' . $crlf;
			case ERROR_500: return 'произошла внутренняя ошибка сервера.' . $crlf;

			case ERROR_FILE_OPEN:
				$return = 'ошибка открытия файла';
				if( isset($params['fname']) ) $return  .= ': ' . trim($params['fname']);
				return $return . $crlf;

			case ERROR_HTTP_SOCKET_OPEN:
				$return = 'ошибка открытия сокета';
				if( isset($params['err_msg']) ) $return  .= ': ' . trim($params['err_msg']);
				return $return . $crlf;

			case ERROR_HTTP_3xx:
				$return = '[redirection]';
				if( isset($params['header']) ) $return .= ': ' . $params['header'];
				if( isset($params['url']) ) $return .= ' (url: '.color($params['url'],"blue").')';
				return $return .= $crlf;

			case ERROR_HTTP_4xx:
				#$return = '[client error]';
				$return = '';
				if( isset($params['header']) ) $return .= ': ' . $params['header'];
				if( isset($params['url']) ) $return .= ' (url: '.color($params['url'],"blue").')';
				return $return .= $crlf;

			case ERROR_HTTP_4xx:
				#$return = '[server error]';
				$return = '';
				if( isset($params['header']) ) $return .= ': ' . $params['header'];
				if( isset($params['url']) ) $return .= ' (url: '.color($params['url'],"blue").')';
				return $return .= $crlf;

			case ERROR_HTTP_GZIP_NO_FUNC:
				return 'сервер вернул данные в формате gz, для которых не найдена функция декодирования' . $crlf;

			case ERROR_DB_FILTERED:
				return 'были удалены запрещённые символы' . $crlf;

			case ERROR_DB_TOO_SHORT:
				return 'длина данных слишком короткая' . $crlf;

			case ERROR_DB_TOO_LONG:
				return 'длина данных превышает лимит' . $crlf;

			case ERROR_MAIL_SEND:
				return 'ошибка отправки письма' . $crlf;

			default: return 'неизвестная ошибка'.$crlf;
		}
	}

	function exists( $index )	{
		if( isset($this->err_array[$index]) )
			return 1;
		else
			return 0;
	}

	function delete( $index )	{
		unset( $this->err_array[$index] );
	}

	function delete_all()	{
		unset( $this->err_array );
		$this->err_array = array();
	}

	function insert( $err_name, $err_value )	{
		$this->err_array[ $err_name ] = $err_value;
		return 0;
	}

	function val( $index )	{
		if( !empty($this->err_array[$index]) )
			return $this->err_array[$index];
		else
			return "";
	}

	function json_code( $index )	{
		if( isset($this->json_codes[$index]) ) return $this->json_codes[$index];
		else	return 0;
	}

	function json_error( $index, $err_msg = 0 )	{
		$array = array(
			"err_code"	=>	$this->json_code( $index )
		);
		if( $err_msg ) $array['err_msg'] = $err_msg;

		echo json_encode( $array );
		exit();
	}
}
?>
