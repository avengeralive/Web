<?php
########################################################
#	system.logs.php
#
#	Интерфейс для работы с логами
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
class SYSTEM_logs	{

	var $LOG_FILE = LOG_FILE;
	function _init() {

		// TODO static ver!
		$this->db = &$this->engine->db;

	}

	function __destruct() {

		// check for zipping log
		if(
			LOG_ENABLED &&
			file_exists($this->LOG_FILE) &&
			filesize($this->LOG_FILE) >= LOG_LIMIT_SIZE
		) {
			$archive_path = $this->LOG_FILE.'.'. date('Y-m-d') .'.zip';

			include_framework( 'pclzip.lib' );
			$zip = new PclZip( $archive_path );
			$zip->create( array($this->LOG_FILE), PCLZIP_OPT_REMOVE_ALL_PATH );

			file_put_contents( $this->LOG_FILE, '' );
		}

	}

	function add_warn( $message ) { $this->add( "[WARN] $message" ); }
	function add_crit( $message ) { $this->add( "[CRITICAL] $message" ); }
	function add_err( $message ) { $this->add( "[ERROR] $message" ); }

	var $log_echo	= false;
	var $log_file	= LOG_ENABLED;
	function add( $message, $conf = LOG_CONF_DEFAULT ) {

		$date = $conf&LOG_CONF_DATE ? date( LOG_DATE_FORMAT ) : '';

		if( $this->log_echo ) {
			echo $date . $message . ( $conf&LOG_CONF_LF ? LOG_NEW_LINE : '' );
			flush();
		}

		if( $this->log_file )
		file_put_contents(
			$this->LOG_FILE,
				$date.
				$message.
				($conf&LOG_CONF_LF?"\n":''),
			FILE_APPEND
		);

	}
}

?>
