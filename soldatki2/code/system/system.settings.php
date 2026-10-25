<?php
########################################################
#	system.settings.php
#
#	Интерфейс для работы с настройками, хранящимися в таблице data_settings
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
class SYSTEM_settings	{

	var $data = array();
	var $cfg = null;

	function _init( $static = false, &$mysqli = null, $cfg=array() ) {

		if( $mysqli === null ) {
			global $mysqli;
		}
		$this->mysqli = &$mysqli;

		init_interfaces( $this, $static, array('gets','lists','logs') );

		$this->cfg = $cfg + array(
			'table'				=> 'data_settings',
			'row_name'			=> 'name',
			'row_value'			=> 'value',
			'default_settings'	=> $this->lists->data['db']['SETTINGS_ROWS']
		);

		$this->init_all();

	}

	function init_all() {

		// формируем список существующих настроек
		$q = $this->mysqli->query( 'SELECT * FROM '.$this->cfg['table'] );
		if( $q !== false ) {
			while( $item = $q->fetch_assoc() )
			$this->data[ $item[ $this->cfg['row_name'] ] ] = $item[ $this->cfg['row_value'] ];
			$q->free();

			// добавляем отсутствующие настройки
			if( $this->cfg['default_settings'] !== null )
			foreach( $this->lists->data['db']['SETTINGS_ROWS'] as $setting_name => $setting_info )
			if( !isset($this->data[$setting_name]) )
			$this->insert( $setting_name, $setting_info['defval'] );
		}

	}

	function val( $index, $from_cache = true )	{

		if( isset($this->data[$index]) && $from_cache ) {
			return $this->data[$index];
		} else {
			$index = filter( $index, MASK_TEXT );
			$try = mysql_row('

				SELECT	'.$this->cfg['row_value'].'
				FROM	'.$this->cfg['table'].'
				WHERE	'.$this->cfg['row_name'].' = "'. $index .'"

			');

			if( empty($try) ) {
				return null;
			} else {
				return $this->data[$index] = $try;
			}
		}
	}

	function update( $name, $value='' ) {

		$setting_exists = $this->val( $name );

		if( $setting_exists !== null ) {
			$this->mysqli->query( 'UPDATE '.$this->cfg['table'].' SET '.$this->cfg['row_value'].' = \''.str_replace('\'','',$value).'\' WHERE '.$this->cfg['row_name'].' = \''.str_replace('\'','',$name).'\'' );
		} else {
			$this->insert( $name, $value );
		}

		$this->data[ $name ] = $value;
	}

	function insert( $name, $value ) {
		$this->mysqli->query( 'INSERT INTO '.$this->cfg['table'].' ( '.$this->cfg['row_name'].', '.$this->cfg['row_value'].' ) VALUES ( \''.str_replace('\'','',$name).'\', \''.str_replace('\'','',$value).'\' )' );
		$this->data[ $name ] = $value;
	}

	function exists( $index ) {
		return isset( $this->data[$index] );
	}
}


?>
