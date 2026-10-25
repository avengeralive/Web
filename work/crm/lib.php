<?php

#########################################################
#
use lib\JBase,
    lib\JLoads;
	$GLOBALS['JSON'] = [];

#
#########################################################
#
	$GLOBALS['CONST'] = ['DEFAULT_COORDS' => 'POINT(0 -999)'];

	// это данные конструктора полей
	$GLOBALS['LISTS'] = [
		'field_types'	=> [
			'text'	=> [
				'name'	=>	'text',
				'desc'	=>	'Дополнительные параметры не требуются',
				'type'	=> 'text'
			],
			'textarea'	=> [
				'name'	=>	'textarea',
				'desc'	=>	'Дополнительные параметры не требуются',
				'type'	=> 'text'
			],
			'textint'	=> [
				'name'	=>	'price',
				'desc'	=>	'Поле ввода цены. Принимает только числовые значения. Дополнительные параметры не требуются',
				'type'	=> 'text'
			],
			'chekbox'	=> [
				'name'	=>	'checkbox',
				'desc'	=>	'Пример: func123(); (При указании имени функции, запускает ее при onchange)',
				'type'	=> 'text'
			],
			'radiobtn'	=> [
				'name'	=>	'radiobtn',
				'desc'	=>	'Пример: {"₽":"₽","$":"$","€":"€"}',
				'type'	=> 'text'
			],
			'fotoalbum'	=> [
				'name'	=>	'gallery',
				'desc'	=>	'Пример: {"thumb":{"height":"1000","width":"1000","type":"5"},"MaxSize":"3000000"}',
				'type'	=> 'text'
			],
			'select'	=> [
				'name'	=>	'select',
				'desc'	=>	'Пример: {"list":{"0":"Физическое лицо","1":"Юридическое лицо"}}',
				'type'	=> 'text'
			],
			'youtube'	=> [
				'name'	=>	'youtube',
				'desc'	=>	'Дополнительные параметры не требуются',
				'type'	=> 'text'
			],
			'yandex'	=> [
				'name'	=>	'yandex',
				'desc'	=>	'Дополнительные параметры не требуются',
				'type'	=> 'text'
			],
			'selectmenu' => [
				'name'	=>	'selectmenu',
				'desc'	=>	'Пример: 23001 (Модуль меню в форме выпадающего списка. В параметрах указывается id модуля)',
				'type'	=> 'text'
			]
		]
	];

#
#########################################################
#
	$GLOBALS['MAIL_CFG'] = [
		'send_via_smtp'	=> true,
		'host'			=> 'smtp.yandex.ru',		// smtp.gmail.com
		'debug'			=> 0,		// debugging: 1 = errors and messages, 2 = messages only
		'secure'		=> 'ssl',		// 'ssl'
		'port'			=> 465,		// 465
		'auth'			=> true,
		'username'		=> '',
		'password'		=> '',
		'addreply'		=> '',
		'replyto'		=> ''
	];

	define( 'LIB_PATH', 	dirname(__FILE__).'/lib/' );

#
#########################  хех, отладчик! надо попробовать  ################################
#
if( !function_exists('pr') ) {
	function pr( $array, $exit=0 )	{
		echo '<table align="left" width="100%"><tr><td style="font-size: 13px;"><pre>'.print_r($array,1).'</pre></td></tr></table><br>';
		if( $exit ) exit();
	}
}

#
##########################  работа с БД - вынести в class.JBase.php? ###############################
#
if( !function_exists('mysql_init') ) {
	function mysql_init() {
		global $mysqli;

		if( empty($mysqli) ) {
			foreach( $GLOBALS['cfg_classnames_try'] as $classname_try ) {
				if( class_exists($classname_try) ) {
					$mysqli = new mysqli( $classname_try::$host_db, $classname_try::$user_db, $classname_try::$password_db, $classname_try::$db );
					break;
				}
			}
		}
		
		return !$mysqli->connect_error;
	}
}
if( !function_exists('mysql_row') ) {
	function mysql_row( $query, &$mysqli=null )	{
		if( $mysqli === null )
		global $mysqli;

		$q = JBase::Query( $query );
		// pr($query);
		$result = $q->fetch_row();
		$q->free();

		return $result[ 0 ];
	}
}

#
#########################    ################################
#
if( !function_exists('echo_gz') ) {
	function echo_gz( &$data, $do_gzip=false )	{

		#header( "Content-type: text/html; charset=utf-8");

		if( client_allow_gzip() && $do_gzip )
		{
			$gzipped = gzencode( json_encode($data), 5 );

			header( 'Content-Encoding: gzip' );
			header( 'Content-Length: ' . strlen($gzipped) );
			echo $gzipped;
			exit();

		} else {
			echo json_encode($data);
			exit();
		}

	}
	function client_allow_gzip()	{
		if( !isset($_SERVER['HTTP_ACCEPT_ENCODING']) ) $_SERVER['HTTP_ACCEPT_ENCODING'] = "";
		if( !isset($_SERVER['HTTP_USER_AGENT']) ) $_SERVER['HTTP_USER_AGENT'] = "";
		
		if(
			preg_match("#gzip#si",$_SERVER['HTTP_ACCEPT_ENCODING']) &&
			!preg_match( "#konqueror|safari#si", $_SERVER['HTTP_USER_AGENT'])
		)
			return true;
		else
			return false;
	}
}
if( !function_exists('json_good') ) {
	function json_good(){
		$GLOBALS['JSON'][ 'status' ] = 'good';
		unset( $GLOBALS['JSON']['err_msg'] );
	}
}
if( !function_exists('json_bad') ) {
	function json_bad( $err_msg = '' ) {
		$GLOBALS['JSON'][ 'status' ] = 'bad';
		$GLOBALS['JSON'][ 'err_msg' ] = $err_msg;
	}
}
if( !function_exists('json_result') ) {
	function json_result() {
		echo_gz( $GLOBALS['JSON'] );
	}
}
#
#########################  возможно остатки от Smarty  ################################
#
function lfToBr( $string ) {
	return trim( str_replace( array("\r\n","\r","\n"), '<br />', $string ) );
}
function redirect( $url ) {
	header( 'Location: ' . $url );
	exit();
}
function remove_quotes( $str ) {
	return str_replace( '\'', '', $str );
}
#
########################  важно!!!  #################################
#
if( !function_exists('include_lib') ) {
	function include_lib( $lib_name )	{
		include_once LIB_PATH.$lib_name.'.php';
	}
}

if( !function_exists('load_interface') ) {
	function load_interface( $name, $cl='cotfw' ) {

		$class_name = strtoupper($cl).'_'.$name;
		$fname = $cl.'.'.$name;

		include_lib( $fname );
		//$GLOBALS[ $fname ] = new $class_name;
		$GLOBALS[ $fname ] = JLoads::loadClassFrom($class_name);
		$GLOBALS[ $fname ]->_init( true );
	}
	function init_interfaces( &$object, $i_list, $cl='cotfw' ) {
		foreach( $i_list as $i_name )
		init_interface( $object, $i_name, $cl );
	}

	function init_interface( &$object, $i_name, $cl='cotfw' ) {

		$fname = $cl.'.'.$i_name;

		if( !isset($GLOBALS[$fname]) )
		load_interface( $i_name, $cl );

		$object->{ $i_name } = &$GLOBALS[ $fname ];
	}
}
#
##########################  filter_str  ###############################
#
	define( 'MASK_NUMERIC',					'0123456789' );
	define( 'MASK_SIGNED',					MASK_NUMERIC.'-' );
	define( 'MASK_FLOAT',					MASK_NUMERIC.',.-' );
	define( 'MASK_ENG',						'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' );
	define( 'MASK_RU',						'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя' );
	define( 'MASK_DEFAULT',					MASK_NUMERIC . MASK_ENG . MASK_RU . '_@-.' );
	define( 'MASK_EMAIL',					MASK_DEFAULT );
	define( 'MASK_TEXT',					MASK_DEFAULT . " \"\r\n\t:,;/+()!&=?][%«»" );
	define( 'MASK_HASH',					MASK_NUMERIC . 'ABCDEFabcdef' );
	define( 'MASK_SEARCH',					MASK_NUMERIC . MASK_ENG . MASK_RU . ' ' );
	define( 'MASK_GETS',					MASK_NUMERIC . MASK_ENG . '_-.' );
	define( 'MASK_LINK',					MASK_ENG . MASK_NUMERIC . '-' );
	define( 'MASK_ENUM',					MASK_ENG . MASK_NUMERIC .'_-' );
	define( 'MASK_TIMESTAMP',				MASK_NUMERIC . ' :-' );
	define( 'MASK_PHONE',					MASK_NUMERIC . ' ()+-' );
	define( 'MASK_GENPWD',					MASK_NUMERIC );
	define( 'MASK_LIST',					MASK_NUMERIC.';' );
	define( 'MASK_DATE',					MASK_NUMERIC.'-: ' );
	define( 'MASK_CHECKBOX',				MASK_NUMERIC.'fno' );
	define( 'MASK_URL',						MASK_ENG.MASK_RU.MASK_NUMERIC.'/.%-_?=&#*$+:;@{}|\^~[]`' );


if( !function_exists('filter_str') ) {
	$FILTER_CACHE = [];
	function filter_str( $query, $mask = MASK_NUMERIC, $len = 0, $in_get = 0 )	{
		global $FILTER_CACHE;
		#############################################
		#	Фильтрация по маске разрешённых символов
		#	Если задан третий параметр, то строка обрезается
		#	до $len символов
		#############################################
		
		if( $query == '' ) return '';

		$return	= '';
		if( $in_get ) $query	= urldecode($query);

		$old_len = mb_strlen( $query );
		
		if( $len )
			mb_substr( $query, 0, $len );
		
		$q_len = mb_strlen( $query );
		$m_len = mb_strlen( $mask  );

		// form hashtable for mask
		if( isset($FILTER_CACHE[$mask]) ) {
			$allowed_symbols = &$FILTER_CACHE[$mask];
		} else {
			$allowed_symbols = [];
			for( $j = 0;$j < $m_len;$j++ ) {
				$c = mb_substr( $mask, $j, 1 );
				$allowed_symbols[ $c ] = true;
			}
			$FILTER_CACHE[ $mask ] = $allowed_symbols;
		}

		
		for($i = 0;$i < $q_len;$i++)	{

			$c = mb_substr( $query, $i, 1 );

			if( isset($allowed_symbols[$c]) )
			$return .= $c;
		}

		if( $m_len != mb_strlen($return) )
		$BAD_SYMBOLS_FOUND = 1;

		return $return;
	}
}
if( !function_exists('Page') ) {
	function Page()
	{

		if (JLoads::$page)
			return JLoads::$page;

		if ($_POST['page'])
			return $_POST['page'];

		if ($_GET['page'])
			return $_GET['page'];

		return 'home';
	}
}

?>