<?php
namespace lib;
########################################################
# cotfw.logs.php
#
# Интерфейс для работы с логами
#
# История: 2016.10.19 - файл создан
#
########################################################
#
	define( 'LOG_PATH',						'/var/www/vocu/cdn/yandexlog/' );
	define( 'LOG_ENABLED',					true );
	define( 'LOG_FILENAME',					DOMAIN.'.log' );
	define( 'LOG_FILE',						LOG_PATH . LOG_FILENAME );
	define( 'LOG_DATE_FORMAT',				'[Y/m/d H:i:s] ' );
	define( 'LOG_NEW_LINE',					'<br />' );
	define( 'LOG_LIMIT_SIZE',				2000000 );

	define( 'LOG_CONF_LF',					1 << 0 );
	define( 'LOG_CONF_DATE',				1 << 1 );
	define( 'LOG_CONF_DEFAULT',				LOG_CONF_LF | LOG_CONF_DATE );
	define( 'LOG_CONF_APPEND',				LOG_CONF_DEFAULT & ~LOG_CONF_LF & ~LOG_CONF_DATE );
#
########################################################
#
	class COTFW_logs	{

		var $LOG_FILEPATH	= LOG_FILE;
		var $enable_echo	= false;
		var $enable_file	= LOG_ENABLED;

		function _init( $static=false ) {}

		function __construct( $LOG_FILEPATH=null ) {
			if( $LOG_FILEPATH != null )
			$this->set_log_filepath( $LOG_FILEPATH );
		}

		function __destruct() {

			// check for zipping log
			if(
				LOG_ENABLED &&
				file_exists($this->LOG_FILEPATH) &&
				filesize($this->LOG_FILEPATH) >= LOG_LIMIT_SIZE
			) {
				$archive_path = $this->LOG_FILEPATH.'.'. date('Y-m-d') .'.zip';

				include_lib( 'class.pclzip' );
				$zip = new \PclZip( $archive_path );
				$zip->create( array($this->LOG_FILEPATH), PCLZIP_OPT_REMOVE_ALL_PATH );

				file_put_contents( $this->LOG_FILEPATH, '' );
			}

		}

		function set_log_filepath( $LOG_FILEPATH ) {
			$this->LOG_FILEPATH = $LOG_FILEPATH;
		}
		
		function add_warning( $message, $conf = LOG_CONF_DEFAULT ) {
			$this->add( $message, $conf, '[WARN] ');
		}
		
		function add_error( $message, $conf = LOG_CONF_DEFAULT ) {
			$this->add( $message, $conf, '[ERR] ');
		}

		function add( $message, $conf = LOG_CONF_DEFAULT, $prefix='' ) {

			$date = $conf&LOG_CONF_DATE ? date( LOG_DATE_FORMAT ) : '';

			if( $this->enable_echo ) {
				echo $date . $prefix . $message . ( $conf&LOG_CONF_LF ? LOG_NEW_LINE : '' );
				flush();
			}

			if( $this->enable_file ) {
				if(!is_dir(dirname($this->LOG_FILEPATH))) {
					mkdir(dirname($this->LOG_FILEPATH), 0777, true);
				}

				file_put_contents(
					$this->LOG_FILEPATH,
						$date.
						$prefix.
						$message.
						($conf&LOG_CONF_LF?"\n":''),
					FILE_APPEND
				);
			}

		}
	}
#
########################################################
?>