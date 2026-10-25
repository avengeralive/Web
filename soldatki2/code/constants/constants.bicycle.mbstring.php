<?php
########################################################
#	constants.bicycle.mbstring.php
#
#	Класс - альтернативная реализация функций
#	для модуля mbstring - используется, если он не подключен
#	на сервере. Базируется на iconv
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.01 - файл создан
#
########################################################
#
	$MB_CYR_CHARS = array(
		'upper'	=> array("\xd0\x90","\xd0\x91","\xd0\x92","\xd0\x93","\xd0\x94","\xd0\x95","\xd0\x81","\xd0\x96","\xd0\x97","\xd0\x98","\xd0\x99","\xd0\x9a","\xd0\x9b","\xd0\x9c","\xd0\x9d","\xd0\x9e","\xd0\x9f","\xd0\xa0","\xd0\xa1","\xd0\xa2","\xd0\xa3","\xd0\xa4","\xd0\xa5","\xd0\xa6","\xd0\xa7","\xd0\xa8","\xd0\xa9","\xd0\xaa","\xd0\xab","\xd0\xac","\xd0\xad","\xd0\xae","\xd0\xaf"),
		'lower'	=> array("\xd0\xb0","\xd0\xb1","\xd0\xb2","\xd0\xb3","\xd0\xb4","\xd0\xb5","\xd1\x91","\xd0\xb6","\xd0\xb7","\xd0\xb8","\xd0\xb9","\xd0\xba","\xd0\xbb","\xd0\xbc","\xd0\xbd","\xd0\xbe","\xd0\xbf","\xd1\x80","\xd1\x81","\xd1\x82","\xd1\x83","\xd1\x84","\xd1\x85","\xd1\x86","\xd1\x87","\xd1\x88","\xd1\x89","\xd1\x8a","\xd1\x8b","\xd1\x8c","\xd1\x8d","\xd1\x8e","\xd1\x8f")
	);
	$GLOBALS['MB_CYR_CHARS'] = &$MB_CYR_CHARS;
#
########################################################


function mb_strlen( $str ) {
	return iconv_strlen( $str );
}

function mb_substr( $str, $offset, $len ) {
	if( $len >= mb_strlen($str) ) return $str;
	return iconv_substr( $str, $offset, $len );
}
function mb_strtoupperlower( &$str, $from, $to ) {
	return str_replace(
		$GLOBALS['MB_CYR_CHARS'][ $from ],
		$GLOBALS['MB_CYR_CHARS'][ $to ],
		$str
	);
}
function mb_strtoupper( $str ) {
	if( ENC != 'UTF-8' )
	return strtoupper( $str );

	return strtoupper( mb_strtoupperlower( $str, 'lower', 'upper' ) );
}
function mb_strtolower( $str ) {
	if( ENC != 'UTF-8' )
    return strtolower( $str );

	return strtolower( mb_strtoupperlower( $str, 'upper', 'lower' ) );
}
function mb_detect_encoding() {
	return ENC;
}

?>
