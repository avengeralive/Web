<?php
namespace lib;
#########################################################
# cotfw.settings.php
#
# Библиотека для работы с настройками в базе данных
#
# История:  2016.10.08 - файл создан
#			2016.10.14 - симметричное шифрование полей
#
#########################################################
#
	class COTFW_settings {

		var $data = array();
		var $data_full = array();
		var $cfg = null;
		var $encrypt_pass ='dke@0123;@(38df#71;2o3SD8e932kei1#(!0)@';
		var $encrypt_size = 192;
		var $default_settings = array(
// 			'pdd_main_mailbox'	=> array(
// 				'defval'	=> '',
// 				'hidden'	=> '0',
// 				'public'	=> '0',
// 				'comment'	=> 'main :: mailbox',
// 				'encrypted'	=> false
// 			),
// 			'recaptcha_key'	=> array(
// 				'defval'	=> '',
// 				'hidden'	=> '0',
// 				'public'	=> '1',
// 				'comment'	=> 'reCAPTCHA :: key',
// 				'encrypted'	=> false
// 			),
// 			'recaptcha_secret_key'	=> array(
// 				'defval'	=> '',
// 				'hidden'	=> '0',
// 				'public'	=> '0',
// 				'comment'	=> 'reCAPTCHA :: secret key',
// 				'encrypted'	=> false
// 			),
// 			'dadata_api'	=> array(
// 				'defval'	=> '',
// 				'hidden'	=> '0',
// 				'public'	=> '1',
// 				'comment'	=> 'DADATA :: API',
// 				'encrypted'	=> false
// 			),
// 			'dadata_key'	=> array(
// 				'defval'	=> '',
// 				'hidden'	=> '0',
// 				'public'	=> '1',
// 				'comment'	=> 'DADATA :: KEY',
// 				'encrypted'	=> false
// 			),
// 			'dadata_pay'	=> array(
// 				'defval'	=> '',
// 				'hidden'	=> '0',
// 				'public'	=> '1',
// 				'comment'	=> 'DADATA :: PAY',
// 				'encrypted'	=> false
// 			),
// 			'mainsms_key'	=> array(
// 				'defval'	=> '',
// 				'hidden'	=> '0',
// 				'public'	=> '1',
// 				'comment'	=> 'DADATA :: PAY',
// 				'encrypted'	=> false
// 			)
		);


// mainsms_project
// 
// queue_offer
// queue_work_hourBegin
// queue_work_hourEnd
// queue_work_timezone
// 
// smsAuto_client
// smsAuto_me_phone
// smsAuto_me_template
// smsAuto_sendToDoubles

		function __construct() {

// 			include_lib( 'class.GibberishAES' );
// 			GibberishAES::size( $this->encrypt_size );

			$folders = explode( '.', $_SERVER['HTTP_HOST'] );
			$count = count( $folders );
			$domain = $folders[$count-2].'.'.$folders[$count-1];

			$this->_init( true );
		}
		
		function _init( $static = false, &$mysqli = null, $cfg=array() ) {

			global $mysqli;
		    if( $mysqli === null ) {			    
			    JBase::Query("select 1");
			    $mysqli=JBase::$mysqli_pool;
			}
			$this->mysqli = &$mysqli;

			$this->cfg = $cfg + array(
				'table'				=> 'settings',
				'row_name'			=> 'name',
				'row_value'			=> 'value',
				'row_hidden'		=> 'hidden',
				'row_public'		=> 'public',
				'row_comment'		=> 'comment',
				'default_settings'	=> $this->default_settings
			);

			$this->init_all();

		}
		
		function init_all() {

			// формируем список существующих настроек
			$q = $this->mysqli->query('

				SELECT		*
				FROM		`'.$this->cfg['table'].'`
				WHERE 		`domain` = "'.DOMAIN.'"
				ORDER BY	`'.$this->cfg['row_name'].'`

			');
			while( $item = $q->fetch_assoc() ) {
				$this->data[ $item[ $this->cfg['row_name'] ] ] = $item[ $this->cfg['row_value'] ];
				$this->data_full[ $item[ $this->cfg['row_name'] ] ] = $item;
			}
			$q->free();

			// добавляем отсутствующие настройки
			if( $this->cfg['default_settings'] !== null )
			foreach( $this->cfg['default_settings'] as $setting_name => $setting )
			if( !isset($this->data[$setting_name]) ) {
				$this->data_full[ $setting_name ] = $setting;
				$this->insert( $setting_name, $setting['defval'] );
				$this->set_hidden( $setting_name, $setting['hidden'] );
				$this->set_comment( $setting_name, $setting['comment'] );
				$this->set_public( $setting_name, $setting['public'] );
			}



			// актуализируем поля
			foreach( $this->default_settings as $name => $setting )
			foreach( array('hidden','public','comment') as $row )
			if( $setting[$row] != $this->data_full[$name][$row] )
			$this->set_value( $row, $name, $setting[$row] );

		}

		function val( $index, $from_cache = true )	{

			if( isset($this->data[$index]) && $from_cache ) {
				$result = $this->data[$index];
			} else {
				$index = filter_str( $index, MASK_TEXT );
				$try = mysql_row('

					SELECT	'.$this->cfg['row_value'].'
					FROM	'.$this->cfg['table'].'
					WHERE	'.$this->cfg['row_name'].' = "'. $index .'"
					AND 	`domain` = "'.DOMAIN.'"

				');

				if( empty($try) ) {
					$result = null;
				} else {
					$result = $this->data[$index] = $this->data_full[$index]['value'] = $try;
				}
			}

			if( $this->encrypt_required($index) ) {
				$result = $this->decrypt_value( $result );
			}

			return $result;
		}

		function val_public( $index, $from_cache = true ) {
			if( $this->is_public($index) ) {
				return $this->val( $index, $from_cache );
			} else {
				return '';
			}
		}

		function set_value( $row_name, $name, $value ) {
			$row = $this->cfg['row_'.$row_name];

			$this->mysqli->query('

				UPDATE	'.$this->cfg['table'].'
				SET		'.$row.' = '.$this->encode_value( $value ).'
				WHERE	'.$this->cfg['row_name'].' = \''.str_replace('\'','',$name).'\'
				AND 	`domain` = "'.DOMAIN.'"


			');
			$this->data_full[ $name ][ $row ] = $value;
		}

		function set_hidden( $name, $value ) {
			$this->set_value( 'hidden', $name, $value );
		}

		function set_comment( $name, $value ) {
			$this->set_value( 'comment', $name, $value );
		}

		function set_public( $name, $value ) {
			$this->set_value( 'public', $name, $value );
		}

		function update( $name, $value='' ) {

			if( $this->encrypt_required($name) )
			$value = $this->encrypt_value( $value );

			$setting_exists = $this->val( $name );

			if( $setting_exists !== null ) {
				$this->mysqli->query('

					UPDATE	'.$this->cfg['table'].'
					SET		'.$this->cfg['row_value'].' = '.$this->encode_value( $value ).'
					WHERE	'.$this->cfg['row_name'].' = \''.str_replace('\'','',$name).'\'
					AND 	`domain` = "'.DOMAIN.'"

				');
			} else {
				$this->insert( $name, $value );
			}

			$this->data[ $name ] = $this->data_full[$name]['value'] = $value;
		}

		function insert( $name, $value ) {

			if( $this->encrypt_required($name) )
			$value = $this->encrypt_value( $value );

			$this->mysqli->query('

				INSERT INTO '.$this->cfg['table'].'
				(
					'.$this->cfg['row_name'].',
					'.$this->cfg['row_value'].'
				)
					VALUES
				(
					\''.str_replace('\'','',$name).'\',
					'.$this->encode_value( $value ).'
				)'

			);

			return $this->data[ $name ] = $this->data_full[$name]['value'] = $this->val( $name, false );
		}

		function is_public( $index ) {
			return isset($this->data_full[$index]) && !empty($this->data_full[$index]['public']);
		}

		function exists( $index ) {
			return isset( $this->data[$index] );
		}

		function encrypt_required( $index ) {
			return isset($this->default_settings[$index]) && !empty($this->default_settings[$index]['encrypted']);
		}

		function encrypt_value( $value ) {
			return GibberishAES::enc( $value, $this->encrypt_pass );;
		}

		function decrypt_value( $encrypted_string ) {
			return GibberishAES::dec( $encrypted_string, $this->encrypt_pass );
		}

		function encode_value( $value, $prefix='0x' ) {
			return '\''.str_replace( '\'', '', $value ).'\'';
		}

	}
#
#########################################################
?>