<?php
####################################################################
#	system.vars.php
#
#	Глобальные функции и основные константы
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
####################################################################
if( DEBUG ) { error_reporting( E_ALL );ini_set('display_errors','on'); }
else		{ error_reporting( 0 );ini_set('display_errors','off'); }
####################################################################
#
	define( 'BUILD',						'1.0.127.0' );
	define( 'NOW',							time() );
	define( 'ONE_HOUR',						3600 );
	define( 'ONE_DAY',						ONE_HOUR * 24 );
	define( 'COOKIE_TIME',					NOW + ONE_DAY * 7 );
	define( 'HTTP',							get_protocol() );
	define( 'CLI',							php_sapi_name() == 'cli' );
#
####################################################################
#
	define( 'SITE_URL',						get_protocol().$_SERVER['HTTP_HOST'] );
	define( 'MAIL_FROM',					'no-reply@'.get_sld($_SERVER['HTTP_HOST']) );
	define( 'MAIL_FROM_NAME',				'noreply' );

	$GLOBALS['MAIL_CFG'] = array(
		'send_via_smtp'	=> false,
		'host'			=> '',		// smtp.gmail.com
		'debug'			=> 0,		// debugging: 1 = errors and messages, 2 = messages only
		'secure'		=> '',		// 'ssl'
		'port'			=> 25,		// 465
		'auth'			=> true,
		'username'		=> '',
		'password'		=> '',
		'addreply'		=> MAIL_FROM,
		'replyto'		=> MAIL_FROM
	);
#
####################################################################
#
	define( 'LOG_USER_LAST_VISITED',		true );
#
####################################################################
#
	define( 'COORDS_MOSCOW_CENTER_LAT',		55.755768 );
	define( 'COORDS_MOSCOW_CENTER_LNG',		37.617671 );

	define( 'COORDS_CONTACTS_LAT',			55.75826 );
	define( 'COORDS_CONTACTS_LNG',			37.631379 );

	define( 'ADDR_CURRENCY',				'http://www.cbr.ru/scripts/XML_daily.asp');
#
####################################################################
#								Smarty
	define( 'SMARTY_DIR_TEMPLATE',			ROOT . 'templates' );

	define( 'SMARTY_DIR_CACHE',				CACHE . 'smarty_cache_data' );
	define( 'SMARTY_DIR_COMPILE',			CACHE . 'smarty_cache_tpls' );

	define( 'SMARTY_DIR_CONFIG',			SMARTY_FOLDER . 'configs' );
	define( 'SMARTY_DIR_PLUGINS',			SMARTY_FOLDER . 'libs/plugins' );
	define( 'SMARTY_DIR',					SMARTY_FOLDER . 'libs/' );

	define( 'TPL_ERROR',					'error.tpl' );
	define( 'TPL_LK_404',					'lk/not-found.tpl' );
	define( 'TPL_LANDING_404',				'static/not-found.tpl' );
	define( 'LK_NO_RIGHTS_MODULE',			'no-rights' );
#
####################################################################
#
	define( 'URL_FRAMEWORK',				URI.'/framework/' );
	define( 'PATH_FRAMEWORK',				ROOT.'framework/' );
	define( 'PATH_UPLOADS',					ROOT.'uploads/' );
	define( 'URI_UPLOADS',					URI.'/uploads/' );
#
####################################################################
#
	define( 'SALT_TOKEN',					'CkldOEIUDFLKJ#(8fiEKJChdfj' );
	define( 'SALT_USER_SANDBOX',			'DkcjBHdieiDFKJd(*#$(*&@' );
#
####################################################################
#					Наборы символов для фильтра
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
	define( 'MASK_GETS',					MASK_NUMERIC . MASK_ENG . '_-' );
	define( 'MASK_LINK',					MASK_ENG . MASK_NUMERIC . '-' );
	define( 'MASK_ENUM',					MASK_ENG . MASK_NUMERIC .'_-' );
	define( 'MASK_TIMESTAMP',				MASK_NUMERIC . ' :-' );
	define( 'MASK_PHONE',					MASK_NUMERIC . ' ()+-' );
	define( 'MASK_GENPWD',					MASK_NUMERIC );
	define( 'MASK_LIST',					MASK_NUMERIC.';' );
	define( 'MASK_DATE',					MASK_NUMERIC.'-: /' );
	define( 'MASK_CHECKBOX',				MASK_NUMERIC.'fno' );
	define( 'MASK_URL',						MASK_ENG.MASK_RU.MASK_NUMERIC.'/.%-_?=&#*$+:;@{}|\^~[]`' );
#
####################################################################
#
	define( 'IMG_BIG_W',				1024 );
	define( 'IMG_BIG_H',				768 );
	define( 'PREVIEW_RATIO',			0.75 );

	define( 'IMG_SMALL_W',				200 );
	define( 'IMG_SMALL_H',				150 );
	define( 'IMG_JPEG_QUALITY',			80 );
#
####################################################################
#
	define( 'UPDATE_STRUCT_DROP_TABLE_ENABLED',		false );
	define( 'UPDATE_STRUCT_DROP_COLUMN_ENABLED',	true );
	define( 'ENC',							'UTF-8' );
	define( 'ENC_HSC',						'utf-8' ); // for htmlspecialchars
	define( 'SELECTED',						' selected="selected"' );
	define( 'CHECKED',						' checked="checked"' );
	define( 'DISABLED',						' disabled="disabled"' );
	define( 'REQUIRED',						' required="" aria-required="true"' );

	define( 'PREG_QUOTES',					'["|\']' );
	define( 'PREG_UTF',						ENC == 'UTF-8' ? 'u' : '' );
	define( 'PREG_SPACES',					'(\s{0,}|)' );

	define( 'CURRENCY_AUTO_FORM',			false );
	define( 'LONG_LIFE_TIMEOUT',			60000 );

	define( 'SEARCH_PLACEHOLDER',			'<span class="search-founded">$text</span>' );
	define( 'EXPLODE',						'___EXPLODE___' );
	define( 'MYSQL_TIMESTAMP_NULL',			'0000-00-00 00:00:00' );
#
####################################################################
#
	define( 'CACHE_JS_ON',					false );
	define( 'DO_GZIP_JSON',					false );
	define( 'CACHE_JS_LIFETIME',			ONE_DAY * 14 );
	define( 'CACHE_JS_PATH',				ROOT.'js-cache/' );

	define( 'LOG_ENABLED',					true );
	define( 'LOG_FILENAME',					'site.log' );
	define( 'LOG_FILE',						LOG_PATH . LOG_FILENAME );
	define( 'LOG_DATE_FORMAT',				'[Y/m/d H:i:s] ' );
	define( 'LOG_NEW_LINE',					'<br />' );
	define( 'LOG_LIMIT_SIZE',				2000000 );

	define( 'LOG_CONF_LF',					1 << 0 );
	define( 'LOG_CONF_DATE',				1 << 1 );
	define( 'LOG_CONF_DEFAULT',				LOG_CONF_LF | LOG_CONF_DATE );
	define( 'LOG_CONF_APPEND',				LOG_CONF_DEFAULT & ~LOG_CONF_LF & ~LOG_CONF_DATE );
#
####################################################################
#
	if( ENC == 'UTF-8' )
		@header( 'Content-type: text/html; charset=utf-8' );
	else
		@header( 'Content-type: text/html; charset=windows-1251' );

	if( strtolower(get_current_user()) == 'root' )
	exit( 'you cannot run this script as user "root"' );
#
####################################################################
no_magic_quotes();
include_constants( 'functions_exists' );
if( MAGIC_QUOTES_ON )	{
	stripslashes_rec( $_GET );
	stripslashes_rec( $_POST );
	stripslashes_rec( $_COOKIE );
}

function stripslashes_rec( &$array ) {

	if( !empty($array) )
	foreach( $array as $key => $value )
	if( gettype($value) == 'array' )
		stripslashes_rec( $array[$key] );
	else
		$array[ $key ] = stripslashes( $value );
}

$all_chars_fw_included = false;
function all_chars( $text ) {
	global $all_chars_fw_included;

	if( empty($all_chars_fw_included) ) {
		include_framework( 'HTMLPurifier' );
		$all_chars_fw_included = true;
	}

	$config = HTMLPurifier_Config::createDefault();
	$config->set('HTML.TargetBlank', true);
	$purifier = new HTMLPurifier($config);
	$clean_html = $purifier->purify( $text );

	return remove_quotes( preg_replace('#<script(.*?)>(.*?)</script>#is', '', $clean_html) );
}

##################################
# генерация спец. переменных для системного модуля gets
##################################
$avaliable_symbols_RAW	= MASK_GETS;
$numeric_codes_RAW		= MASK_NUMERIC;
$len = strlen( $avaliable_symbols_RAW );
for($i=0;$i<$len;$i++) $avaliable_symbols[ $avaliable_symbols_RAW[$i] ] = 1;
$len = strlen( $numeric_codes_RAW );
for($i=0;$i<$len;$i++) $isNumeric[ $numeric_codes_RAW[$i] ] = 1;
##################################
$BAD_SYMBOLS_FOUND	= 0;
$FILTER_CACHE = array();
function filter( $query, $mask = MASK_NUMERIC, $len = 0, $in_get = 0 )	{
	global $FILTER_CACHE;
	#############################################
	#	Фильтрация по маске разрешённых символов
	#	Если задан третий параметр, то строка обрезается
	#	до $len символов
	#############################################
	if( MAGIC_QUOTES_ON ) $query = stripslashes( $query );

	global $BAD_SYMBOLS_FOUND, $DATA_WAS_CUTTED;
	$BAD_SYMBOLS_FOUND = $DATA_WAS_CUTTED = 0;

	if( $query == '' ) return '';

	$return	= '';
	if( $in_get ) $query	= urldecode($query);

	$old_len = mb_strlen( $query );

	if( $len )
		mb_substr( $query, 0, $len );

	$q_len = mb_strlen( $query );
	$m_len = mb_strlen( $mask  );

	if( $old_len != $q_len ) $DATA_WAS_CUTTED = 1;

	// form hashtable for mask
	if( isset($FILTER_CACHE[$mask]) ) {
		$allowed_symbols = &$FILTER_CACHE[$mask];
	} else {
		$allowed_symbols = array();
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
function filter_ref( &$query, $mask = MASK_NUMERIC, $len = 0, $in_get = 0 )	{
	return $query = filter( $query, $mask, $len, $in_get );
}
function protection( &$input, $avaliable_symbols = '0-9' )	{
	$tmp	= preg_replace( "/[^".$avaliable_symbols."]/si", "", $input );
	$input	= $tmp;
	return $tmp;
}
function protection_mysql( $query )	{
	if( MAGIC_QUOTES_ON ) $query = stripslashes( $query );
    $query = @mysql_real_escape_string( $query );
	return $query;
}
function remove_quotes( $str ) {
	return str_replace( '\'', '', $str );
}

function get_cost_with_sign( $value, $sign ) {
	return filter( $value, MASK_SIGNED ) * $sign;
}

function get_cost( $value, $format = 1, $no_kop = 1, $ret_empty_on_null = 0 ){

	$value = str_replace( ',', '.', filter($value,MASK_NUMERIC.'.,') );

	$rub = '';
	$kop = '';

	if( $value == '' || $value == 0 )
		if( $ret_empty_on_null )
			return '';
		else
			return '0' . ( $no_kop ? '' : '.00' );

	$explode = explode( '.', $value );

	if( count($explode) == 1 )
	{
		$rub = $value;
		$kop = '00';
	}
	else
	{
		$rub = $explode[ 0 ];
		if( !strlen($explode[ 1 ]) )
			$kop = '00';
		else
			if( strlen($explode[ 1 ]) == 1 )
				$kop = $explode[ 1 ] . '0';
			else
				$kop = substr( $explode[ 1 ], 0, 2 );
	}

	if( $format )
	{
		$new_rub = '';
		$razryad_nomer = 0;

		for( $i = strlen($rub) - 1;$i + 1;$new_rub .= $rub[$i], $i--, $razryad_nomer++ )
			if( $razryad_nomer == 3 && !($razryad_nomer=0) )
				$new_rub .= ' ';

		$rub = '';

		for( $i = strlen($new_rub) - 1;$i + 1;$i-- )
			$rub .= $new_rub[ $i ];
	}

	return $rub . ( $no_kop ? '' : '.' . $kop );

}

function get_cost_array( $costs, $format = 1, $no_kop = 1, $ret_empty_on_null = 0 ) {

	foreach( $costs as $currency => $cost )
	$costs[ $currency ] = get_cost( $cost, $format, $no_kop, $ret_empty_on_null );

	return $costs;
}


function get_costs( $cost, $second='RUB' ){
	global $site;

	if( isset($site) ) {
		$lists = &$site->lists;
		$settings = &$site->settings;
	} else {
		global $lists, $settings;

	}

	$currency = 'RUB';
	$format = false;

	switch( gettype($second) ){

		case 'string':
		$currency = $second;
		break;

		case 'boolean':
		$format = $second;
		break;

		case 'array':
		$currency = $second[ 0 ];
		$format = $second[ 1 ];
		break;

	}
	$args = func_get_args();


	$conds = extend( array(

		'format'			=> 0,
		'no-kop'			=> 0,
		'ret-empty-on-null'	=> 0,
		'to-int'			=> 0,
		'round-2'			=> 0,
		'with-title'		=> ''

	), conds($args,2) );

	// parse conds
		if( isset($conds['with-kop']) )
		$conds[ 'no-kop' ] = 0;


	if(
		empty($currency) ||
		!isset($lists->data['currency']['data'][ $currency ])
	)	$currency = 'RUB';

	$return = array(
		'RUB'	=> $cost,
		''		=> $cost
	);

	// get cost in rubles
	if( $currency != 'RUB' )
	$return[ 'RUB' ] = $cost * $settings->val( 'currency_'.$currency );

	$return[ $currency ] = $cost;

	// form costs in other valutes
	foreach( $lists->data['currency']['data'] as $mnemo => $id )
	if( $mnemo != 'RUB' && $mnemo != $currency ) {
		$return[ $mnemo ] = $return[ 'RUB' ] / $settings->val( 'currency_'.$mnemo );
	}

	if( $conds['to-int'] )
	foreach( $return as $currency => $cost )
	$return[ $currency ] = (int) $cost;

	if( $conds['round-2'] )
	foreach( $return as $currency => $cost )
	$return[ $currency ] = round( $cost, 2 );

	if( $format )
	foreach( $return as &$cost )
	$cost = get_cost(
		$cost,
		$conds[ 'format' ],
		$conds[ 'no-kop' ],
		$conds[ 'ret-empty-on-null' ]
	);

	if( !empty($conds['with-title']) )
	foreach( $return as $currency => &$cost )
	$cost .= ' '. $lists->val( $currency, 'currency' );


	return $return;
}

function conds( $args, $i = 1 ){

	$conds = array();
	$count = count( $args );
	for( ; $i < $count; $i++ )
	if( gettype($args[$i]) != 'array' )
	$conds[ $args[$i] ] = $i;

	return $conds;
}

function ajax_trim( $str )	{
	return str_replace(
		array( "\r", "\n", "\t" ),
		'',
		$str
	);
}

function fetch_remote_file( $host, $path, $fetch_remote_type = 'file_get_contents') {
	//$fetch_remote_type = 'file_get_contents';
	$user_agent = 'Internet Explorer 11.0';

	@ini_set('allow_url_fopen',          1);
	@ini_set('default_socket_timeout',   15);
	@ini_set('user_agent',               $user_agent);
	if ( $fetch_remote_type == 'curl' || ($fetch_remote_type == '' && function_exists('curl_init'))) {
		$fetch_remote_type = 'curl';
		if ($ch = @curl_init()) {
			@curl_setopt($ch, CURLOPT_URL,				'http://' . $host . $path);
			@curl_setopt($ch, CURLOPT_HEADER,			false);
			@curl_setopt($ch, CURLOPT_RETURNTRANSFER,	true);
			@curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,	15);
			@curl_setopt($ch, CURLOPT_USERAGENT,		$user_agent);

			if ($data = @curl_exec($ch)) {
				return $data;
			}

			@curl_close($ch);
		}

	} else if ( $fetch_remote_type == 'file_get_contents' || ( $fetch_remote_type == '' && function_exists('file_get_contents') && ini_get('allow_url_fopen') == 1 )) {
		$fetch_remote_type = 'file_get_contents';
		if ($data = @file_get_contents('http://' . $host . $path)) {
			return $data;
		}
	} else {
		$fetch_remote_type = 'socket';
		$buff = '';
		$fp = @fsockopen($host, 80, $errno, $errstr, 15);
		if ($fp) {

			@fputs($fp, "GET {$path} HTTP/1.0\r\nHost: {$host}\r\n");
			@fputs($fp, "User-Agent: {$user_agent}\r\n");
			while (!@feof($fp)) {
				$buff .= @fgets($fp, 128);
			}
			@fclose($fp);

			$page = explode("\r\n\r\n", $buff);

			return $page[1];
		}
	}

	if( DEBUG )
	print('Не могу подключиться к серверу: http://' . $host . $path.', type: '.$fetch_remote_type);
	return false;
}


function form_url( &$url ) {
	if( !empty($url) && substr($url,0,4) != 'http' )
	$url = 'http://'.$url;
}

function form_words( $text, $min_size = 2 ) {

	$words = array();
	$words_raw = explode( ' ', preg_replace( '#(\s{1,})#si',' ', $text) );

	if( !empty($words_raw) )
	foreach( $words_raw as $word )
	if( mb_strlen($word) > $min_size )
	$words[] = $word;

	return $words;
}

function form_enum( $arr, $use_key=true ) {
	$to_implode = array();
	if( !empty($arr) ) {
		foreach( $arr as $key => $value ) {
			$to_implode[] = '\''.($use_key ? $key : $value).'\'';
		}
	}
	return implode(',',$to_implode);
}

function form_link( &$array, $id_index = 'id', $link_index = 'link' ) {

	if(
		isset($array[ $link_index ])	&&
		isset($array[ $id_index ])
	)
		if( empty($array[ $link_index ]) )
			$array[ $link_index ] = 'id-'. $array[ $id_index ];
		else;
	else
		return '';
}

function form_desc( &$text, $max_len = 300, $striptags = true, $skiptags=''/*'<br /><br>'*/ ) {

	if( $striptags )
	$text = strip_tags( $text );

	$len	= mb_strlen( $text );
	$cutted	= mb_substr( $text, 0, $max_len );

	if( mb_strlen($cutted) < $len && !empty($cutted) )
	$text = $cutted .'...';

}

function form_quotes( $text ) {
	return preg_replace( '#"(.*?)"#si', '«$1»', $text );
}

function get_sld() { // site level domain
	$folders = explode( '.', $_SERVER['HTTP_HOST'] );
	$count = count( $folders );

	if( $count > 2 ) {
		return $folders[$count-2].'.'.$folders[$count-1];
	} else {
		return $_SERVER['HTTP_HOST'];
	}
}

function get_ext( $path ) {
	$path_parts = pathinfo( $path );
	return $path_parts['extension'];
}

function get_protocol() {
	return 'http'.(is_https()?'s':'').'://';
}

function get_days_in_year( $year ) {
	return date('z', mktime(0,0,0,12,31,$year)) + 1;;
}
function get_date_from_doy( $year, $tDay, $tFormat = 'Y-m-d' ) {
	$day = intval( $tDay );
	$day = ( $day == 0 ) ? $day : $day - 1;
	$offset = intval( intval( $tDay ) * 86400 );
	$str = date( $tFormat, strtotime( 'Jan 1, '.$year ) + $offset );
	return( $str );
}
function get_date_from_woy( $year, $week, $day='1', $tFormat = 'Y-m-d' ) {
	$week = fill_zero( $week, 2 );
	return date( $tFormat, strtotime($year.'W'.$week.$day) );
}

function get_hours_from_count( $minutes ) {
	$minutes = intval( $minutes );

	$hours = intval( $minutes / 60 );
	$remainder = $minutes % 60;
	$remainder_60 = intval( round( intval($remainder)/60.0, 1 ) * 10 );

	if( $remainder_60 >= 10 ) {
		$hours++;
		$remainder_60 -= 10;
	}

	return $hours.".".$remainder_60;
}

function get_time_for_schedule( $minutes_after_midnight, $with_sign=false ) {

	$sign = '';
	if( $minutes_after_midnight > 0 ) {
		$hours = floor( $minutes_after_midnight / 60 );

		if( $with_sign )
		$sign = '+';
	} else {
		$hours = ceil( $minutes_after_midnight / 60 );

		if( $with_sign )
		$sign = '-';
	}
	$minutes = $minutes_after_midnight - $hours*60;
	return $sign.fill_zero(abs($hours),2).':'.fill_zero(abs($minutes),2);
}
function get_minutes_from_time( $value ) {

	if( empty($value) || $value == '0' )
	$value = '00:00';

	list($hours,$minutes) = explode( ':', $value );
	return intval( $hours * 60 + $minutes );
}

function get_unix_for_schedule( $unix, $minutes_norma ) {
	$time = parse_unix( $unix );
	list( $hour, $minute ) = explode( ':', get_time_for_schedule( $minutes_norma ) );

	return mktime2(array(
		'year'		=> $time['year'],
		'month'		=> $time['month'],
		'day'		=> $time['day'],
		'hour'		=> intval( $hour ),
		'minute'	=> intval( $minute ),
		'second'	=> 0
	));

}

function get_image_rand() {
	$result = '';
	$set = '0123456789abcdef';
	$len = strlen( $set );
	for( $i = 0;$i < 20;$i++ )
	$result .= substr( $set, rand(0,$len), 1 );

	return $result;
}

function get_ending( $number, $titles=array(), $exploder=';' ){
	if( gettype($titles) == 'string' )
	$titles = explode( $exploder, $titles );

	//$titles=array('комментарий','комментария','комментариев')
    $cases = array (2, 0, 1, 1, 1, 2);
    return $titles[ ($number%100 >4 && $number%100< 20)? 2 : $cases[min($number%10, 5)] ];
}

function generate_str( $result_len = 6, $mask_str = '' ) {
	if( empty($mask_str) ) {
		$mask_str = MASK_GENPWD;
	}

	$mask_len = strlen( $mask_str ) - 1;

	$return = '';

	for( $i = 0;$i < $result_len;$i++ )
	$return .= $mask_str[ rand(0, $mask_len) ];

	return $return;
}

function get_dow( $timestamp ) {

	$dow = date( 'w', $timestamp );
	if( $dow == 0 )
	$dow = 7;

	return $dow;

}

function get_translit( $name, $tolower = true ) {
	$return = '';

	$replacement = array(
		'А'=>'A','а'=>'a','Б'=>'B','б'=>'b','В'=>'V','в'=>'v','Г'=>'G','г'=>'g',
		'Д'=>'D','д'=>'d','Е'=>'E','е'=>'e','Ё'=>'Yo','ё'=>'yo','Ж'=>'Zh','ж'=>'zh',
		'З'=>'Z','з'=>'z','И'=>'I','и'=>'i','Й'=>'Y','й'=>'y','К'=>'K','к'=>'k',
		'Л'=>'L','л'=>'l','М'=>'M','м'=>'m','Н'=>'N','н'=>'n','О'=>'O','о'=>'o',
		'П'=>'P','п'=>'p','Р'=>'R','р'=>'r','С'=>'S','с'=>'s','Т'=>'T','т'=>'t',
		'У'=>'U','у'=>'u','Ф'=>'F','ф'=>'f','Х'=>'Kh','х'=>'kh','Ц'=>'Ts','ц'=>'ts',
		// 'Ч'=>'Ch','ч'=>'ch','Ш'=>'Sh','ш'=>'sh','Щ'=>'Sch','щ'=>'sch','Ъ'=>'"','ъ'=>'"',
		'Ч'=>'Ch','ч'=>'ch','Ш'=>'Sh','ш'=>'sh','Щ'=>'Sch','щ'=>'sch',
		// 'Ы'=>'Y','ы'=>'y','Ь'=>"'",'ь'=>"'",'Э'=>'E','э'=>'e','Ю'=>'Yu','ю'=>'yu',
		'Ы'=>'Y','ы'=>'y','Э'=>'E','э'=>'e','Ю'=>'Yu','ю'=>'yu',
		'Я'=>'Ya','я'=>'ya',
		' '=>'-','-'=>'-','_'=>'-',
		'A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E','F'=>'F','G'=>'G','H'=>'H','I'=>'I','J'=>'J','K'=>'K','L'=>'L','M'=>'M','N'=>'N','O'=>'O','P'=>'P','Q'=>'Q','R'=>'R','S'=>'S','T'=>'T','U'=>'U','V'=>'V','W'=>'W','X'=>'X','Y'=>'Y','Z'=>'Z','a'=>'a','b'=>'b','c'=>'c','d'=>'d','e'=>'e','f'=>'f','g'=>'g','h'=>'h','i'=>'i','j'=>'j','k'=>'k','l'=>'l','m'=>'m','n'=>'n','o'=>'o','p'=>'p','q'=>'q','r'=>'r','s'=>'s','t'=>'t','u'=>'u','v'=>'v','w'=>'w','x'=>'x','y'=>'y','z'=>'z',
		'0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9'
	);
	// $replacement = str_replace_PREPARE( $replacement_RAW );

	$c = '';
	$len = mb_strlen( $name );
	for( $i = 0;$i < $len;$i++ ) {

		$c = mb_substr( $name, $i, 1 );
		if( isset($replacement[$c]) )
		$return .= $replacement[$c];

	}

	// removing unnecessary dash symbols
	$return = preg_replace( '/[-]{1,}/', '-', $return );

	// remove dash at the end
	$len = mb_strlen( $return );
	if( mb_substr( $return, $len-1, 1 ) == '-' )
	$return = mb_substr( $return, 0, $len-1 );

	// to lower
	if( $tolower )
	$return = mb_strtolower( $return );

	return $return;
}

function get_reports_periods_tpls( $timestamp=null ) {

	if( $timestamp === null )
	$timestamp = NOW;

	$cur_year	= date( 'Y', $timestamp );
	$cur_month	= date( 'n', $timestamp );
	$cur_dom	= date( 'j', $timestamp );
	$cur_dow	= get_dow( $timestamp );
	$d_in_m		= date( 't', $timestamp );

	// ---------------------------------------------------------------------
	// корректировка ситуаций границ дней недели, выходящих за текущий месяц
	// week_from
	$wf_year = $cur_year;
	$wf_month = $cur_month;
	$wf_day = $cur_dom + ($cur_dow-1)*(-1);
	if( $wf_day <= 0 ) {
		if( $wf_month == 1 ) {
			$wf_month = 12;
			$wf_year--;
		} else {
			$wf_month--;
		}
		$d_in_prev_month = days_in_month( $wf_year, $wf_month );
		$wf_day += $d_in_prev_month;
	}
	// week_to
	$wt_year = $cur_year;
	$wt_month = $cur_month;
	$wt_day = $cur_dom + 7 - $cur_dow;
	if( $wt_day > $d_in_m ) {
		$wt_day = $wt_day - $d_in_m;
		if( $wt_month == 12 ) {
			$wt_month = 1;
			$wt_year++;
		} else {
			$wt_month++;
		}
	}
	// ---------------------------------------------------------------------

	$period_tpl = array(
		'day'	=> array(
			'from'	=> mktime2(array(
				'year'		=> $cur_year,
				'month'		=> $cur_month,
				'day'		=> $cur_dom,
				'hour'		=> 0,
				'minute'	=> 0,
				'second'	=> 0
			)),
			'to'	=> mktime2(array(
				'year'		=> $cur_year,
				'month'		=> $cur_month,
				'day'		=> $cur_dom,
				'hour'		=> 23,
				'minute'	=> 59,
				'second'	=> 59
			))
		),
		'week'	=> array(
			'from'	=> mktime2(array(
				'year'		=> $wf_year,
				'month'		=> $wf_month,
				'day'		=> $wf_day,
				'hour'		=> 0,
				'minute'	=> 0,
				'second'	=> 0
			)),
			'to'	=> mktime2(array(
				'year'		=> $wt_year,
				'month'		=> $wt_month,
				'day'		=> $wt_day,
				'hour'		=> 23,
				'minute'	=> 59,
				'second'	=> 59
			)),
		),
		'month'	=> array(
			'from'	=> mktime2(array(
				'year'		=> $cur_year,
				'month'		=> $cur_month,
				'day'		=> 1,
				'hour'		=> 0,
				'minute'	=> 0,
				'second'	=> 0
			)),
			'to'	=> mktime2(array(
				'year'		=> $cur_year,
				'month'		=> $cur_month,
				'day'		=> $d_in_m,
				'hour'		=> 23,
				'minute'	=> 59,
				'second'	=> 59
			)),
		),
		'year'	=> array(
			'from'	=> mktime2(array(
				'year'		=> $cur_year,
				'month'		=> 1,
				'day'		=> 1,
				'hour'		=> 0,
				'minute'	=> 0,
				'second'	=> 0
			)),
			'to'	=> mktime2(array(
				'year'		=> $cur_year,
				'month'		=> 12,
				'day'		=> 31,
				'hour'		=> 23,
				'minute'	=> 59,
				'second'	=> 59
			)),
		)
	);

	return $period_tpl;
}
function days_in_month( $year=null, $month=null ) {
	if( $year === null )
	$year = date( 'Y ');

	if( $month === null )
	$month = date( 'n' );

	// calculate number of days in a month
	return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
}

function random_color() {
    return strtoupper( str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT) );
}

function include_constants( $name, $once = true )	{
	if( file_exists(CODE.'constants/constants.'.$name.'.php') )
		if( DEBUG )
			if( $once )
				include_once CODE.'constants/constants.'.$name.'.php';
			else
				include CODE.'constants/constants.'.$name.'.php';
		else
			if( $once )
				@include_once CODE.'constants/constants.'.$name.'.php';
			else
				@include CODE.'constants/constants.'.$name.'.php';
	else;
}

function include_framework( $name )	{
	if( DEBUG )
		include_once PATH_FRAMEWORK.$name.'.php';
	else
		@include_once PATH_FRAMEWORK.$name.'.php';
}

function include_file( $path )	{
	if( DEBUG )
		include_once $path;
	else
		@include_once $path;
}

function load_interface( $name, $cl='system' ) {

	$name_filtered = str_replace( array('.','-'), '_', $name );
	$class_name = 'SYSTEM_'.$name_filtered;

	include_file( CODE.'system/system.'.$name.'.php' );
	$GLOBALS[$name_filtered] = new $class_name;
	$GLOBALS[$name_filtered]->_init( true );

}

function init_date_params( &$options ) {

	if( $options['year'] !== null && $options['month'] !== null ) {

		$periods = get_reports_periods_tpls(mktime2(array(
			'year'	=> $options['year'],
			'month'	=> $options['month'],
			'day'	=> 15
		)));
		$options['period_from_unix'] = $periods['month']['from'];
		$options['period_to_unix'] = $periods['month']['to'];

	} else {

		if( $options['period_from'] !== null && $options['period_to'] !== null ) {
			$options['period_from_unix'] = mysql_timestampToUnix( $options['period_from'] );
			$options['period_to_unix'] = mysql_timestampToUnix( $options['period_to'] );
		} else {

			if( $options['period_from_unix'] !== null && $options['period_to_unix'] !== null ) {

			} else {
				$periods = get_reports_periods_tpls();
				$options['period_from_unix'] = $periods['week']['from'];
				$options['period_to_unix'] = $periods['week']['to'];
			}

		}

		$options['year'] = date( 'Y', $options['period_to_unix'] );
		$options['month'] = date( 'n', $options['period_to_unix'] );

	}

	if( empty($options['period_from']) )
	$options['period_from'] = mysql_unixToTimestamp( $options['period_from_unix'] );
	if( empty($options['period_to']) )
	$options['period_to'] = mysql_unixToTimestamp( $options['period_to_unix'] );
}

function init_interfaces( &$object, $status, $i_list, $cl='system' ) {
	foreach( $i_list as $i_name )
	init_interface( $object, $status, $i_name );
}

function init_interface( &$object, $status, $i_name, $cl='system' ) {

	if( !$status ) {
		if( !isset($object->engine->{$i_name}) )
		$object->engine->load_module( $i_name );

		$object->{ $i_name } = &$object->engine->{ $i_name };
	} else {

		if( !isset($GLOBALS[$i_name]) )
		load_interface( $i_name, $cl );

		$object->{ $i_name } = &$GLOBALS[ $i_name ];
	}

}

function profile_log() {
	if( !defined('DEBUG')	||
		!DEBUG
	)	return;

	timer_stop( 'main' );
	echo ', ';memory();
	mysql_profile();
}

function eval_code( $code )	{
	if( DEBUG )
		eval( $code );
	else
		@eval( $code );
}

function bot_kick_all()	{
	if( !isset($_SERVER['HTTP_USER_AGENT']) )
	$_SERVER['HTTP_USER_AGENT'] = 'unknown';

	$userAgents = array(
		'Google',
		'Slurp',
		'MSNBot',
		'ia_archiver',
		'Yandex',
		'Rambler',
		'bot',
		'search'
	);
	if(preg_match('/' . implode('|', $userAgents) . '/si', $_SERVER['HTTP_USER_AGENT']))
		not_found();
}

function dir_check_create( $path, $chmod=0744 ) {
	$path = replaceSeparator( $path );
	if (!file_exists($path)) {
	    mkdir($path, $chmod, true);
	}
}

function stack($exit=0) {
	echo '<pre>';
	pr(debug_print_backtrace(),$exit);
	echo '</pre>';
}

function redirect( $url ) {
	// stack();
	header( 'Location: ' . $url );
	exit();
}
function redirectToReferer( $referer = null, $additional_get = null ) {

	if( !$referer )
		if( !isset($_SERVER['HTTP_REFERER']) )
			return false;
		else
			$referer = &$_SERVER['HTTP_REFERER'];
	else;

	if( !empty($additional_get) ) {

		$additional_imploded = implode( '&',$additional_get );

		$parsed = parse_url( $referer );

		$referer =
			(isset($parsed['scheme']) ? $parsed['scheme'].'://' : '').
			(isset($parsed['host'])? $parsed['host'] : SITE_URL ).
			(isset($parsed['path']) ? $parsed['path'] : '/' ).
			'?'.
			(!empty($parsed['query']) ? $parsed['query'].'&' : '' ).
			$additional_imploded
		;
	}

	redirect( $referer );
}

function refresh() {
	header( 'Location: '.$_SERVER['REDIRECT_URL'] );
	exit();
}

function not_found()	{
	header('HTTP/1.1 404 Not Found');
	exit('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL '.$_SERVER['REQUEST_URI'].' was not found on this server.</p>
</body></html>
');
}

function www_auth( $login, $password = null ) {

	$authorized = false;
	$logins = array();

	if( gettype($login) != 'array' )
		$logins[ (string) $login ] = (string) $password;
	else
		$logins = $login;

	if( !empty($logins) )
	foreach( $logins as $login => $password )
	if( _www_auth($login,$password) ) {
		$authorized = true;
		break;
	}

	if( !$authorized ) {
		header('WWW-Authenticate: Basic realm="Restricted area: need authorization"');
		header('HTTP/1.0 401 Unauthorized');
		exit('<html>
<head>
<title>401 Unauthorized</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<h1>401 Unauthorized</h1>
Access is denied due to invalid credentials.<br />
You do not have permission to view this directory or page using the credentials that you supplied.
</body></html>');
	}

	return $login;
}
function _www_auth( $login, $password ) {
	return
		isset($_SERVER['PHP_AUTH_USER'])		&&
		!empty($_SERVER['PHP_AUTH_PW'])			&&
		$_SERVER['PHP_AUTH_PW'] == $password	&&
		!empty($_SERVER['PHP_AUTH_USER'])		&&
		$_SERVER['PHP_AUTH_USER'] == $login
	;
}

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        return false;
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            @unlink($file);
        }
    }
    @rmdir($dirPath);
}

function safefilerewrite($fileName, $dataToSave)
{    if ($fp = fopen($fileName, 'w'))
    {
        $startTime = microtime(TRUE);
        do
        {            $canWrite = flock($fp, LOCK_EX);
           // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
           if(!$canWrite) usleep(round(rand(0, 100)*1000));
        } while ((!$canWrite)and((microtime(TRUE)-$startTime) < 5));

        //file was locked so now we can store information
        if ($canWrite)
        {            fwrite($fp, $dataToSave);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }

}

function write_ini_file($array, $file) {
    $res = array();
    foreach($array as $key => $val)
    {
        if(is_array($val))
        {
            $res[] = "[$key]";
            foreach($val as $skey => $sval) $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
        }
        else $res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
    }
    safefilerewrite($file, implode("\r\n", $res));
}

function parse_sec( $time = 0 )	{
	if( !$time ) $time = NOW;

	$hours = floor($time/3600);

	$ostatok_sekynd = $time-$hours*3600;
	$minutes = floor( $ostatok_sekynd/60 );

	return $hours."ч. ".$minutes."мин.";
}

function parse_size( $bytes, $eng=0, $round = 1 )	{

	if( $eng ) {
		$sizes = array( 'b', 'kb', 'mb', 'gb', 'tb', 'pb' );
	} else {
		$sizes = array( 'байт', 'кб', 'мб', 'гб', 'тб', 'пб' );
	}

	if( @pow(1024,count($sizes)) < $bytes ) return '>1024 пбайт';

	$i = 0;
	if( $bytes >= 1024 )
		do $i++;
		while( ($bytes/=1024)>1024 );

	return round($bytes, $round)." ".$sizes[$i];

}
function parse_str2( &$input, $assoc = true, $urldecode = false ) {
	$output = array();
	$len = strlen( $input );
		if( !$len ) return $output;
	$i = 0;
	$bit_startNameNotValue = 1;
	$buffer_startName = $buffer_startValue = "";

	$sdvig = 0;

	for($i = 0;$i < $len;$i++ )
		if( $bit_startNameNotValue )
			if( $input[$i] == "=" )
				$bit_startNameNotValue = 0;
			else
				$buffer_startName .= $input[$i];
		else
			if( $input[$i] == "&" )	{
				$bit_startNameNotValue = 1;

				if( $assoc )
					$output[ $buffer_startName ] = $buffer_startValue;
				else
					$output[ $sdvig++ ] = array(
						'key'	=> $buffer_startName,
						'value'	=> $buffer_startValue
					);

				$buffer_startName = $buffer_startValue = "";
			}
			else
				$buffer_startValue .= $input[$i];

	if( $assoc )
		$output[ $buffer_startName ] = $buffer_startValue;
	else
		$output[ $sdvig++ ] = array(
			'key'	=> $buffer_startName,
			'value'	=> $buffer_startValue
		);

	if( $urldecode )
	foreach( $output as $key => $value )
	$output[ $key ] = urldecode( $value );

	return $output;
}

function email_check($email)	{
	if( function_exists('filter_var') )
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	else
		return preg_match('/^([a-zA-Z0-9._-]+)\@([a-zA-Z0-9]+\.)+[\w]{2,6}$/u', $email);
}

##################################
#
#         MYSQL functions
#
##################################
function draw_trace() {
	$e = new Exception();
	$trace = $e->getTrace();

	$list = array();
	if( !empty($trace) ) {
		foreach( $trace as $item )
		echo basename($item['file']).'@'.$item['function'].':'.$item['line']."<br />\n";
	}
}

function mysql_truncate( $TABLE )	{
	global $mysqli;
	$mysqli->query( 'TRUNCATE TABLE `'. $TABLE .'`' );
}
function mysql_getNewID( $TABLE )	{
	global $mysqli;

	$q = $mysqli->query( 'SHOW TABLE STATUS LIKE "'. $TABLE .'"' );
	$rows = $q->fetch_assoc();
	$q->free();
	return $rows['Auto_increment'];
}

function mysql_row( $query, &$mysqli=null )	{
	if( $mysqli === null )
	global $mysqli;

	$q = $mysqli->query( $query );
	// pr($query);
	$result = $q->fetch_row();
	$q->free();

	return $result[ 0 ];
}


$mysqli_pools = array();
function mysql_async( $query ) {
	global $mysqli_pools;
	$mysqli = new mysqli( MYSQL_HOST, MYSQL_USER, MYSQL_PSWD, MYSQL_DBNM );

	if( $mysqli->connect_error )
	return;


	ENC == 'UTF-8' ? $mysqli->set_charset( 'utf8' ) : $mysqli->set_charset( 'cp1251' );

	$mysqli->query( $query, MYSQLI_ASYNC );

	$mysqli_pools[] = $mysqli;
}

function mysql_assoc( $query, &$mysqli=null )	{

	if( $mysqli === null )
	global $mysqli;

	$q = $mysqli->query( $query );
	if( !empty($mysqli->errno) ) {
		// echo $mysqli->error;
		return '';
	} else {
		$result = $q->fetch_assoc();
		$q->free();
		return $result;
	}
}
function mysql_assoc_array( $query, &$mysqli=null ) {
	$result = array();

	if( $mysqli === null )
	global $mysqli;

	$q = $mysqli->query( $query );
	if( empty($mysqli->errno) ) {
		while( $item = $q->fetch_assoc() ) {
			$result[] = $item;
		}
		$q->free();
	}

	return $result;
}

function mysql_fetch( $query, &$mysqli=null )	{

	if( $mysqli === null )
	global $mysqli;

	$q = $mysqli->query( $query );
	$result = $q->fetch_row();
	$q->free();

	return $result;
}
function mysql_update_rows( $update_rows, $table, $where='0', &$mysqli=null )	{

	if( $mysqli === null )
	global $mysqli;

	$rows = array();
	foreach( $update_rows as $key => $value ) {
		$rows[] = '`'.$key.'` = \''. addslashes(remove_quotes($value)) .'\'';
	}
	$mysqli->query('

		UPDATE	`'.$table.'`
		SET		'. implode(',',$rows) .'
		WHERE	'.$where

	);

	return !$mysqli->errno && $mysqli->affected_rows != -1;
}
function mysql_insert_rows( $rows, $table, &$mysqli=null )	{

	if( $mysqli === null )
	global $mysqli;

	$cols = array();
	$vals = array();
	foreach( $rows as $name => $value ) {
		$cols[] = '`'.$name.'`';
		$vals[] = '\''.htmlspecialchars(addslashes(remove_quotes( $value ))).'\'';
	}
	$mysqli->query('INSERT INTO `'.$table.'` ('.implode(',',$cols).') VALUES ('.implode(',',$vals).')');

	return !$mysqli->errno && $mysqli->affected_rows != -1;
}

function mysql_timestampToUnix( $str, $withStrToTime=false )	{
	if( $withStrToTime ) {
		return strtotime( $str.' UTC' );
	} else {
		@list( $date, $time )			= explode( ' ', $str );
		@list( $year, $month, $day )		= explode( '-', $date );
		@list( $hour, $minute, $second )	= explode( ':', $time );


		if( !intval(($hour|$minute|$second|$month|$day|$year)) ) return 0;

		return @mktime( $hour, $minute, $second, $month, $day, $year );
	}
}

function mysql_unixToTimestamp( $unix )	{
	return date( 'Y-m-d H:i:s', $unix );
}
function mysql_timestampToGets( $timestamp )	{
	$from = array( ':', ' ' );
	$to = array( '-', '-' );
	return str_replace( $from, $to, $timestamp );
}
function mysql_getsToTimestamp( $get )	{
	$to = array( ':', ' ' );
	$from = array( '-', '-' );
	return str_replace( $from, $to, $get );
}

function mysql_date_std()	{
	$try = @func_get_arg(0);
	if( gettype($try) == 'bool' )
		$time = NOW;
	else
		$time = $try;
	return date( 'd-m-Y', $time );
}

$mysqli_results = array();
function mysqli_free_results() {
	global $mysqli_results;pr($mysqli_results);
	if( !empty($mysqli_results) )
	foreach( $mysqli_results as $result )
	mysqli_free_result( $result );
}

function mysql_profile( &$mysqli = null, $explain = true, $load_jquery = true )	{

	if( $mysqli === null )
	global $mysqli;

	$buff = array();
	$q = $mysqli->query( 'show profiles' );

	if( empty($mysqli->errno) ) {
		while( $res = $q->fetch_assoc() )
		if( $explain )
			$buff[] = mysql_explain( $mysqli, $res['Query'], $res['Duration'], $load_jquery );
		else
			$buff[] = $res['Duration'] . "\t" . $res['Query'];
		$q->free();
	} else {
		echo $mysqli->error;
	}


	echo '<br>'. implode('<br>',$buff);
}

$explain_styleShowed = false;
function mysql_explain( &$mysqli = null, $q, $q_time='', $load_jquery=false )	{

	if( $mysqli === null )
	global $mysqli;

	global $explain_styleShowed, $site;

	if( stripos($q,'select') === false )
	return;

	$res = $mysqli->query( 'EXPLAIN '. str_ireplace('select','select SQL_NO_CACHE',$q) );
	// pr($q);
	$data = $res->fetch_assoc();

	$rows = array();
	$vals = array();

	if( !empty($data) )
	foreach( $data as $row => $val )
	{
		$rows[] = ( empty($row) ? '&nbsp;' : $row );
		$vals[] = ( empty($val) ? '&nbsp;' : $val );
	}

	// multiple queries
	$vals2 = '';
	while( $query = $res->fetch_row() ) {
		$to_implode = array();

		foreach( $query as $row => $val )
		$to_implode[] = $val;

		$vals2 .= '
		<tr>
			<td>'. implode('</td><td>',$to_implode) .'</td>
		</tr>';
	}
	$res->free();

	if( !empty($q_time) ){
		$rows[] = 'time';
		$vals[] = $q_time;
	}

	$q = str_replace( '"', '&quot;', $q );

	if( !$explain_styleShowed ){
		$explain_styleShowed = true;
		echo '
<link rel="stylesheet" type="text/css" href="'. URI .'/assets/css/highlight.css">
<script type="text/javascript" src="'.URI.'/assets/js/highlight.js"></script>
<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function(event) {
	SyntaxHighlighter.all();
});

</script>
<style>
table.todktable { width: 900px;border: 1px dotted grey;margin-top: 40px;display: }
table.todktable tr td { padding: 5px 5px 5px 5px;border: 1px dotted grey; }
table.todktable tr td pre { border: 1px solid #C0CAD5;width: 99%;white-space: normal; }
table.todktable tr td.query { padding-top: 0px;padding-bottom: 0px; }
</style>';
	}

	$rowscount = count( $rows );

	echo '
<center><table align="center" border="1" class="todktable">
	<tr><td colspan="'.$rowscount.'" class="query"><pre class="brush: sql;gutter: false;">'. $q .'</pre>' .'</tr>';

	if( $rowscount > 1 )
		echo '
		<tr>
			<td>'. implode('</td><td>',$rows) .'</td>
		</tr>
		<tr>
			<td>'. implode('</td><td>',$vals) .'</td>
		</tr>'. $vals2;
	else
		if( !empty($q_time) )
			echo '
				<tr>
					<td colspan="'. $rowscount .'">Empty set ('. $q_time .')</td>
				</tr>
			';
		else;

	echo '</table></center>';
}

function sqlite_utf8_like($mask, $value) {
	$mask = str_replace(
		array("%", "_"),
		array(".*?", "."),
		preg_quote($mask, "/")
	);
	$mask = "/^$mask$/ui";
	return preg_match($mask, $value);
}

function parse_unix( $unix=NOW ) {
	return array(
		'year'		=> date( 'Y', $unix ),
		'month'		=> date( 'n', $unix ),
		'day'		=> date( 'j', $unix ),
		'hour'		=> date( 'G', $unix ),
		'minute'	=> intval( date( 'i', $unix ) ),
		'second'	=> intval( date( 's', $unix ) ),
		'dow'		=> get_dow( $unix ),
		'dim'		=> date( 't', $unix )
	);
}

function mktime2( $params )	{
	$hour = $minute = $second = $month = $day = $year = 0;

	if( isset($params['hour']) )	$hour	= $params['hour'];
	if( isset($params['minute']) )	$minute	= $params['minute'];
	if( isset($params['second']) )	$second	= $params['second'];
	if( isset($params['month']) )	$month	= $params['month'];
	if( isset($params['day']) )		$day	= $params['day'];
	if( isset($params['year']) )	$year	= $params['year'];

	return mktime( $hour, $minute, $second, $month, $day, $year );
}

$timer_metki = array(  );
function timer_start( $metka="default" )	{
	global $timer_metki;
	$timer_metki[ $metka ] = microtime( true );
}

$timer = array();
function timer_stop( $metka="default", $to_echo=1 )	{
	global $timer_metki, $timer;

	$time[ $metka ] = microtime( true ) - $timer_metki[ $metka ];
	if( $to_echo ) echo $time[ $metka ] . " seconds";
	return $time[ $metka ];
}
function debug_report( $force_debug = false ) {
	global $site, $mysqli;
	if( DEBUG && !$site->gets->exists('ajax') || $force_debug ) {
		timer_stop( 'main' );
		echo ', ';memory();
		mysql_profile();
	}
}

function implode_index( $imploder, &$array ){
	return implode( $imploder, array_keys($array) );
}

function first( $index, $second = null ){

	$return_key	= true;

	$array = &$index;

	if( $second !== null )
		if( $second === false )
			$return_key = false;
		else
			if( $second === true )
				$return_key = true;
			else;
	else;

	foreach( $array as $key => $value ){
		reset( $array );
		if( $return_key )
			return $key;
		else
			return $value;
	}
}

function no_cache()	{
	#header( "Content-type: text/html; charset=utf-8" );
	header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header( "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header( "Cache-Control: no-store, no-cache, must-revalidate");
	header( "Cache-Control: post-check=0, pre-check=0", false);
	header( "Pragma: no-cache");
}


function no_magic_quotes() {
	@ini_set( 'magic_quotes_gpc',		'Off' );
	@ini_set( 'magic_quotes_runtime',	'Off' );
	@ini_set( 'magic_quotes_sybase',	'Off' );
}

$bitCalled_noRunLimit = 0;
function no_run_limit()	{
	global $bitCalled_noRunLimit;
	if( $bitCalled_noRunLimit ) return;
	$bitCalled_noRunLimit = 1;

	@set_time_limit( 0 ) or
	@ini_set( 'max_execution_time', 0 )	or
	@ini_alter( 'max_execution_time', 90000000 );
}

function set_phpseclib_ipath() {
	set_include_path(get_include_path() . PATH_SEPARATOR . str_replace(array('\\','/'),DIRECTORY_SEPARATOR,PATH_FRAMEWORK).'phpseclib');
}

function set_time_limit2( $time ) {
	@set_time_limit( $time ) or
	@ini_set( 'max_execution_time', $time )	or
	@ini_alter( 'max_execution_time', $time );
}

function enable_cors() {
	header('Access-Control-Allow-Origin: *');
}

function no_session_cookies()	{
	ini_set( 'session.use_cookies',0 );
	ini_set( 'session.use_only_cookies',0 );
	ini_set( 'session.use_trans_sid',1 );
}

function unserialize_array( &$array ) {
	$unserialized = unserialize( $array );
	return gettype($unserialized) == 'array' ? $unserialized : array();
}

$bitCalled_pregMatchInit = 0;
function preg_match_init()	{
	global $bitCalled_pregMatchInit;
	if( $bitCalled_pregMatchInit ) return;
	$bitCalled_pregMatchInit = 1;
	@ini_set( "pcre.backtrack_limit", 10000000 );	// preg_match для большого объема текста
}
function preg_replace_col_spaces( $matches ) {
	return str_replace( ' ', '_', $matches[0] );
}

$client_allow_gzip_CACHE_exists	= 0;
$client_allow_gzip_CACHE		= false;
function client_allow_gzip()	{
	global $client_allow_gzip_CACHE_exists, $client_allow_gzip_CACHE;
	if( $client_allow_gzip_CACHE_exists ) return $client_allow_gzip_CACHE;
	$client_allow_gzip_CACHE_exists = 1;

	if( !isset($_SERVER['HTTP_ACCEPT_ENCODING']) ) $_SERVER['HTTP_ACCEPT_ENCODING'] = "";
	if( !isset($_SERVER['HTTP_USER_AGENT']) ) $_SERVER['HTTP_USER_AGENT'] = "";

	if(
		preg_match("#gzip#si",$_SERVER['HTTP_ACCEPT_ENCODING']) &&
		!preg_match( "#konqueror|safari#si", $_SERVER['HTTP_USER_AGENT'])
	)
		return $client_allow_gzip_CACHE = true;
	else
		return $client_allow_gzip_CACHE = false;
}

function echo_cache( $fpath )	{

	if( client_allow_gzip() && file_exists($fpath.'.gz') ) {
		header( 'Content-Encoding: gzip' );
		header( 'Content-Length: ' . filesize($fpath.'.gz') );
		if( ob_get_level() )
			ob_end_clean();
		readfile( $fpath.'.gz' );
		exit();
	}
	else
		if( file_exists($fpath) ) {
			header( 'Content-Length: ' . filesize($fpath) );
			if( ob_get_level() )
				ob_end_clean();
			readfile( $fpath );
			exit();
		}
}

function echo_gz( &$data, $do_gzip=DO_GZIP_JSON )	{

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


function file_force_download( $file, $filename='', $contents=null ) {
	$GLOBALS['NODBG'] = true;

	// сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
	// если этого не сделать файл будет читаться в память полностью!
	if (ob_get_level())
	ob_end_clean();

	if( $contents === null ) {
		$content_length = filesize( $file );
	} else {
		$content_length = strlen( $contents );
	}

	// заставляем браузер показать окно сохранения файла
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=' . (empty($filename)? (!empty($file)?basename($file):time()):$filename));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: '.$content_length );

	// читаем файл и отправляем его пользователю
	if( $contents == null ) {
		readfile($file);
	} else {
		echo $contents;
	}
	exit();
}

function addslashes_preg( $str )	{
	# TEST REJIM
	$mask_PREPARE = array( ".", "[", "]", "(", ")", "{", "}", "^", '$', "|", "\\", "?", "*", "+" );

	$count = count( $mask_PREPARE );
	$mask = array();

	for($i = 0;$i < $count;$i++)
		$mask[$mask_PREPARE[$i]] = "\\" . $mask_PREPARE[$i];

	$conf = str_replace_PREPARE( $mask );
	return str_replace( $conf['from'], $conf['to'], $str );
}

function is_same_day( $period_from, $period_to ) {
	return
		date( 'Y', $period_from ) == date( 'Y', $period_to ) &&
		date( 'n', $period_from ) == date( 'n', $period_to ) &&
		date( 'j', $period_from ) == date( 'j', $period_to )
	;
}

function is_unix() {
	return strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN';
}

function is_32bit(){
	return PHP_INT_SIZE === 4;
}

function is_https() {
	$isSecure = false;
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
	    $isSecure = true;
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
	    $isSecure = true;
	}
	return $isSecure;
}

function is_assoc($arr)
{
	if( !is_array($arr) ) return 0;
	return array_keys($arr) !== range(0, count($arr) - 1);
}
function numbers_only( $str ) {
	return !preg_match( '#[^0-9]#si', $str );
}

function getPriceClassName( $price ) {
	if( $price > 0 )
	return ' price plus';

	if( $price < 0 )
	return ' price minus';

	return '';
}

function lfToBr( $string ) {
	return trim( str_replace( array("\r\n","\r","\n"), '<br />', $string ) );
}

function str_replace_PREPARE( $assoc, $reverse = true )	{
	$return = array( "from" => array(), "to" => array() );


	if( $reverse )
		foreach( $assoc as $from => $to )
		{
			$return[ 'from' ][] = $from;
			$return[ 'to'][]	= $to;
		}
	else
		foreach( $assoc as $from => $to )
		{
			$return[ 'from' ][] = $to;
			$return[ 'to'][]	= $from;
		}

	return $return;
}

function pr( $array, $exit=0 )	{
	echo '<table align="left" width="100%"><tr><td style="font-size: 13px;"><pre>'.print_r($array,1).'</pre></td></tr></table><br> ';
	if( $exit ) exit();
}


function extend( $default, $params ) {

	foreach( $params as $index => &$fff )
		if(
			gettype($params[$index]) == 'array' &&
			isset($default[$index])
		)
			$default[ $index ] = extend( $default[$index], $params[$index] );
		else
			$default[ $index ] = $params[ $index ];


	return $default;
}

function fill( $symb, $len=0 )	{
	if( !$len ) return '';
	$return = '';
	for($i = 0;$i < $len; $i++)
		$return .= $symb;
	return $return;
}
function fill_zero( $str, $zero_count, $symbol = "0", $right_join = 0 )	{
	$zeros = "";

	$len = strlen( $str );
	if( $len >= $zero_count ) return $str;

	for($i = $len;$i < $zero_count;$i++) $zeros .= $symbol;

	if( $right_join )
		return $str . $zeros;
	else
		return $zeros . $str;
}

function memory( $no_parse_size = 0, $crlf = 0 )	{
	$value = memory_get_usage();
	if( $no_parse_size )
		echo $value;
	else
		echo parse_size( $value, 1 );

	if( $crlf )
		echo "\n";
	else
		echo "<br>";
}

function replaceSeparator( $str ) {
	return str_replace( array('\\','/'), DIRECTORY_SEPARATOR, $str );
}
// экранирование с учетом того, что обратный слеш должен дублироваться
function replaceSeparatorWinDub( $str ) {
	return
		preg_replace(
			'#[\\x'.bin2hex(DIRECTORY_SEPARATOR).']{1,}#usi',
			DIRECTORY_SEPARATOR,
			str_replace(
				array('\\','/'),
				DIRECTORY_SEPARATOR,
				$str
			)
		)
	;
}

function replace_searchs( $rows, &$data, $text ) {
	foreach( $rows as $index )
	$data[ $index ] = replace_search( $data[$index], $text );
}

function replace_search_row( $row, &$data, $text ) {
	if( !empty($text) && !empty($data[$row]) )
	$data[ $row ] = replace_search( $data[$row], $text );
}

function replace_search_rows( $rows, &$data, &$fv ) {
	foreach( $rows as $row )
	replace_search_row( $row, $data, $fv[$row] );
}

function replace_search( $founded, $text ) {

	preg_match(
		'#('.addslashes_preg($text).')#siu',
		$founded,
		$result
	);

	if( !empty($result) )
		$replace_to = $result[ 0 ];
	else
		$replace_to = $text;

	return
		str_replace(
			'$text',
			$replace_to,
			/*str_ireplace(
				mb_strtolower($text),
				SEARCH_PLACEHOLDER,
				mb_strtolower($founded)
			)*/
			preg_replace(
				'#('.addslashes_preg($text).')#siu',
				SEARCH_PLACEHOLDER,
				$founded/*,1*/
			)
		)
	;
}


function base64url_encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

$searchIndex_founded = '';
$searchIndex_toSearch = '';
$searchIndex_map = '';
function search_index( &$array, $indexToSearch ) {
	global $searchIndex_founded, $searchIndex_toSearch, $searchIndex_map;

	unset( $searchIndex_founded );

	$searchIndex_founded = '';
	$searchIndex_map = '';
	$searchIndex_toSearch = $indexToSearch;

	_search_index( $array );

	return $searchIndex_founded;
}

function _search_index( &$array ) {
	global $searchIndex_founded, $searchIndex_toSearch, $searchIndex_map;

	$map_backup = $searchIndex_map;

	foreach( $array as $key => $value ) {
		$searchIndex_map = $map_backup;
		if( gettype($value) == 'array' || gettype($value) == 'object' ) {
			$searchIndex_map .= '.'.$key;
			_search_index( $value );
		}
		else
			if( $key == $searchIndex_toSearch ) {
				$searchIndex_founded = $value;
				$searchIndex_map .= '.'.$key;
				// echo $searchIndex_map.' - '. $value .'<br><br>';
				return;
			}
			else;
	}
}

?>
