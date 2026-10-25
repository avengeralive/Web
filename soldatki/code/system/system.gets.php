<?php
########################################################
# 	system.gets.php
#
#	Системный модуль, конвертирует URL вида
#	www.site.com/param_one1/param_two2/param_three3/
#
#	в массив array( "param_one"=>1, "param_two"=>2, "param_three"=>3 );
#	в качестве значений может быть только цифры и символ "-" (для задания дат)
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
class SYSTEM_gets	{

	var $gets                  = array();

	function _init()	{
		global $avaliable_symbols, $isNumeric;
		$this->avaliable_symbols = &$avaliable_symbols;
		$this->isNumeric         = &$isNumeric;
		$this->form_gets();
	}

	var $index_search = array();
	function form_gets()	{

		if( !isset($_SERVER['REQUEST_URI']) )
		$_SERVER['REQUEST_URI'] = '/';

		$this->url = isset( $_SERVER['PATH_INFO'] ) && ( isset( $_SERVER['REQUEST_URI'] ) && !$_SERVER['REQUEST_URI'] ) ? $_SERVER['PATH_INFO'] : $_SERVER['REQUEST_URI'];
		$paths = explode( "/", $this->url );
		$count = count( $paths );

		for($i = 0;$i < $count;$i++)	{
			$len = strlen( $paths[$i] );
			if( !$len ) continue;

			$valueStart = 0;
			$keyName = "";
			$keyValue = "";
			for($j = 0;$j < $len;$j++)	{

				if( $paths[$i][$j] == "?" || $paths[$i][$j]== "&" ) break;

				if( !empty($this->avaliable_symbols[$paths[$i][$j]]) )
					$c = $paths[$i][$j];
				else
					$c = "";

				if( !empty($this->isNumeric[$c]) )
				$valueStart = 1;

				if( $valueStart && empty($this->isNumeric[$c]) && $c!="-" )
				continue;

				if( $valueStart )
					$keyValue .= $c;
				else
					$keyName .= $c;
			}

			if(!strlen($keyValue)) $keyValue = '';

			$this->gets[ $keyName ] = $keyValue;

			if( isset($paths[$i+1]) )
			$this->index_search[ $keyName ] = $paths[ $i+1 ];
		}

		if( isset($this->gets['']) ) unset( $this->gets[''] );
	}

	function val_index( $index, $withValue=1 )	{
		$cur_sdvig = 0;
		@reset( $this->gets );

		$value = '';
		foreach( $this->gets as $name=>$value )
			if( $cur_sdvig == $index )
				break;
			else
				$cur_sdvig++;

		if( !empty($name) )
			$return = $name;
		else
			$return = '';

		if( $withValue )
			$return .= $value;

		@reset( $this->gets );

		return $return;
	}

	var $str_val_cache = array(
		0	=> array(),
		1	=> array()
	);
	function str_val( $inputKey, $withValue=0 )	{
		#для страниц имеющих вид: http://www.site.com/.../param_name/param_value/../
		if( !$this->exists($inputKey) )
			return '';

		if( isset($this->str_val_cache[$withValue][$inputKey]) )
			return $this->str_val_cache[ $withValue ][ $inputKey ];

		$copy   = 0;
		$copied = 0;
		foreach( $this->gets as $key=>$value )
			if( $key == $inputKey )
				$copy = 1;
			else
				if( $copy && $copied = 1 )
					break;

		if( $copied )
		{
			$this->str_val_cache[ $withValue ][ $inputKey ] = $key . ( $withValue ? $value : "" );
			return $this->str_val_cache[ $withValue ][ $inputKey ];
		}
		else
			return '';
	}
	function next( $index ) {
		if( !empty($this->index_search[$index]) )
			return $this->index_search[ $index ];

		return empty($this->index_search[$index]) ? '' : $this->index_search[ $index ];
	}

	function get_search_query( $index )	{

		preg_match( '#/'.$index.'/(.*?)/#si', $this->url, $tmp );

		if( empty($tmp) ) return '';

		$return = urldecode( $tmp[1] );

		#if( ENC == 'UTF-8' )
		#	$return = cp1251_utf8_auto( $tmp[1] );
		#else
		#	$return = $tmp[1];

		return $return;
	}


	function exists( $index )	{
		return !empty($this->gets[$index]) OR isset($this->gets[$index]);
	}

	function is_empty( $index ) {
		return empty( $this->gets[$index] );
	}

	function val( $index )	{
		return isset($this->gets[$index]) ? $this->gets[$index] : '';
	}

	function set_val( $index, $value )	{
		$this->gets[$index] = $value;
	}

	function insert( $index, $value=1 )	{
		$this->gets[$index]=$value;
	}

	function delete( $index )	{
		unset( $this->gets[$index] );
	}

	function delete_all()	{
		unset( $this->gets );
		$this->gets = array();
	}
}
?>
