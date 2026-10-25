<?php
########################################################
# 	system.session.php
#
#	Системный модуль для хранения сессий в базе данных
#
#	История:
#			2017.11.15 - файл создан
#
########################################################
class SYSTEM_session {

	function _init( $static = false, &$mysqli = null, $cfg=array() ) {

		if( $mysqli === null ) {
			global $mysqli;
		}
		$this->mysqli = &$mysqli;

		init_interfaces( $this, $static, array('lists','user','ankets') );

		session_set_save_handler(
			array( $this, '_open' ),
			array( $this, '_close' ),
			array( $this, '_read' ),
			array( $this, '_write' ),
			array( $this, '_destroy' ),
			array( $this, '_gc' )
		);

		session_start();

	}

	public function _open() {
		return !empty( $this->mysqli );
	}

	public function _close() {
		return true;
	}

	public function _read($id) {
		return mysql_row('SELECT data FROM logs_sessions WHERE session_id = \''.$this->filter_session($id).'\'');
	}

	public function _write($id, $data){

		$time = time();

		$query = $this->mysqli->prepare('REPLACE INTO logs_sessions SET session_id=?, ip=?, data=?, access=?');
		$query->bind_param( 'ssss', $id, $this->user->ip_int, $data, $time );
		$query->execute();
		$query->close();

		return !$this->mysqli->errno;
	}

	public function _destroy($id) {
		$this->mysqli->query( 'DELETE FROM logs_sessions WHERE session_id = \''.$this->filter_session($id).'\'' );
		return !$this->mysqli->errno;
	}

	public function _gc($max){
		$old = time() - $max;

		// формируем список файлов
		$q = '

			SELECT	*
			FROM	`logs_sessions`
			WHERE	`access` < \''.$old.'\'

		';
		// pr( $q );
		$sessions = mysql_assoc_array($q);
		if( !empty($sessions) ) {
			foreach( $sessions as $item ) {
				// по ID сессии вычисляем путь до песочницы
				$path = $this->ankets->get_temp_anket_path( $item['session_id'] );
				deleteDir( $path );
				@unlink( $path );
			}
		}

		$this->mysqli->query('DELETE FROM logs_sessions WHERE access < \''.$old.'\'');
		return !$this->mysqli->errno;
	}

	private function filter_session( $id ) {
		return filter( $id, MASK_TEXT );
	}
}
?>
