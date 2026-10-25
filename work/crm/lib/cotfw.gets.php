<?php
namespace lib;
#########################################################
# cotfw.gets.php
#
# Библиотека для работы ЧПУ
#
# История:  2016.10.08 - файл создан
#
#########################################################
#
	class COTFW_gets {

		var $gets = array();
		var $last_folder = '';
		var $folders = array();
		
		function _init( $url=null )	{
			
			$numeric_codes_RAW		= '0123456789';
			$available_symbols_RAW	= $numeric_codes_RAW.'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz_-';;
			$len = strlen( $available_symbols_RAW );
			for($i=0;$i<$len;$i++) $available_symbols[ $available_symbols_RAW[$i] ] = 1;
			$len = strlen( $numeric_codes_RAW );
			for($i=0;$i<$len;$i++) $isNumeric[ $numeric_codes_RAW[$i] ] = 1;

			$this->available_symbols = &$available_symbols;
			$this->isNumeric         = &$isNumeric;

			$this->available_symbols['.'] = 1;

			$this->form_gets($url);
		}
		
		var $index_search = array();
		function form_gets( $url=null )	{

			if( $url === null ) {
				if( !isset($_SERVER['REQUEST_URI']) )
				$_SERVER['REQUEST_URI'] = '/';

				$this->url = isset( $_SERVER['PATH_INFO'] ) && ( isset( $_SERVER['REQUEST_URI'] ) && !$_SERVER['REQUEST_URI'] ) ? $_SERVER['PATH_INFO'] : $_SERVER['REQUEST_URI'];
			} else {
				$this->url = $url;
			}


			$paths = explode( "/", $this->url );
			$count = count( $paths );

			for($i = 0;$i < $count;$i++)	{
				$len = strlen( $paths[$i] );
				if( !$len ) continue;

				$this->folders[ $paths[$i] ] = 1;

				$valueStart = 0;
				$keyName = "";
				$keyValue = "";
				for($j = 0;$j < $len;$j++)	{

					if( $paths[$i][$j] == "?" || $paths[$i][$j]== "&" ) break;

					if( !empty($this->available_symbols[$paths[$i][$j]]) )
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
			if( isset($keyValue) )
			$this->last_folder = $keyValue;

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
			
			return $return;
		}


		function exists( $index )	{
			return !empty($this->gets[$index]) OR isset($this->gets[$index]);	
		}
		function folder_exists( $index ) {
			return isset( $this->folders[$index] );
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
#
#########################################################
?>