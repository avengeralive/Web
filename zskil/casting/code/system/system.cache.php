<?php
########################################################
# 	system.cache.php
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
class SYSTEM_cache	{

	function _init( $static = false )	{

		if( !$static ) {

			$this->gets		= &$this->engine->gets;
			$this->lists	= &$this->engine->lists;
			$this->user		= &$this->engine->user;
			$this->settings = &$this->engine->settings;
			$this->rights	= &$this->engine->rights;

		} else {

			global $gets, $lists, $user, $settings, $rights;

			$this->gets		= &$gets;
			$this->lists	= &$lists;
			$this->user		= &$user;
			$this->settings	= &$settings;
			$this->rights	= &$rights;

		}
	}

	function row( $data ) {
		return
			json_encode(
				gettype($data) == 'array' ? $data : array()
			)
		;
	}

	function row_extract( &$data ) {
		$extracted = json_decode( $data, true );
		return gettype($extracted) == 'array' ? $extracted : array();
	}

	function write( $path, &$data ) {
		$open = fopen( $path, 'w' );
		if( $open ) {
			fwrite( $open, json_encode($data) );
			fclose( $open );
		}
	}

	function form( $name, $params = array() ) {

		$options = $params + array(
			'use_cache'				=> true,
			'force_cache_update'	=> false,
		);

		$result = array();

		switch( $name ) {

			case 'regions':
			return $this->_form(array(
				'cache_on'				=> CACHE_REGIONS_ON,
				'cache_path'			=> CACHE_REGIONS_PATH,
				'cache_lifetime'		=> CACHE_REGIONS_LIFETIME,
				'use_cache'				=> $options['use_cache'],
				'force_cache_update'	=> $options['force_cache_update'],
				'method_form_db'		=> 'form_db_regions',
				'title'					=> 'регионы',
			));
			break;

		}

		return $result;
	}

	function _form( $params ) {
		$options = $params + array(
			'cache_on'				=> true,
			'cache_path'			=> '',
			'cache_lifetime'		=> 60 * 60 * 24 * 7,
			'use_cache'				=> true,
			'force_cache_update'	=> false,
			'method_form_db'		=> '',
			'title'					=> '',
		);

		if( !$options['use_cache'] )
		return $this->{ $options['method_form_db'] }( $options );

		$data = array();

		if( $options['cache_on'] )
			$cache_need_update =
				!file_exists($options['cache_path']) ||
				NOW - filemtime( $options['cache_path'] ) > $options['cache_lifetime'] ||
				$options['force_cache_update']
			;
		else
			$cache_need_update = true;

		if( !$options['cache_on'] || $cache_need_update )
		$data = $this->{ $options['method_form_db'] }( $options );

		if( $options['cache_on'] ) {
			if( $cache_need_update ) {

				$this->engine->logs->add( 'обновляем кеш "'.$options['title'].'" ('.$options['cache_path'].')' );
				$this->write( $options['cache_path'], $data );

			} else {
				$data = json_decode( file_get_contents( $options['cache_path'] ), true );
			}
		}

		return $data;
	}

	function form_db_regions() {
		$regions = array();

		// sqlite
		/*$q = $this->mysqli->query('

			SELECT		*
			FROM		`address_regions`
			ORDER BY	`region_name`

		');
		while( $item = $q->fetch_assoc() )
		$regions[] = $item;
		$q->free();*/

		return $regions;
	}

}


?>
