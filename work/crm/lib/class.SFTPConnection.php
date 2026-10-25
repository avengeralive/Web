<?php
namespace lib;
use  \Exception;

if(!defined('VOCU_FWK')) {
	die();
} // не работает без нашего фреймверка

/**
 * class.SFTPConnection.php
 *
 *Класс - библиотека с функциями для работы  CDN по SSH
 *подгружается через автоподгрузку классов
 *
 * История:  2016.12.07 - файл создан
 *
 **/
class SFTPConnection extends AbstractConnection {
	private $connection;
	private $sftp;

	public function __construct() {
		// Parent constructor fills $this->host, $this->port, $this->user and $this->pass
		parent::__construct();

		// Create connection
		if(function_exists('ssh2_connect')) {
			$this->connection = @ssh2_connect($this->host, $this->port);

			if(!$this->connection) {
				throw new Exception("Could not connect to $this->host on port $this->port.");
			}

			if(!@ssh2_auth_password($this->connection, $this->user, $this->pass)) {
				throw new Exception("Could not authenticate with username");
			}

			$this->sftp = @ssh2_sftp($this->connection);

			if(!$this->sftp) {
				throw new Exception("Could not initialize SFTP subsystem.");
			}
		}
	}

	public function login() {
		throw new Exception(
			'Использование удаленного метода SFTPConnection::login(). ' .
			'Этот код не работал с тех пор, как метод login() был удален. ' .
			'Рассмотрите переход на использование класса LocalConnection ' .
			'(это использование SFTPConnection не менялось на LocalConnection)'
		);
	}

	public function moveFile($source_path, $destination_path, $permissions = 0644) {
		if(@ssh2_scp_send($this->connection, $source_path, $destination_path, $permissions) === false) {
			throw new Exception("Could not send data from file: $source_path.");
		}

		@unlink($source_path);
	}

	public function removeFile($file) {
		if(function_exists('ssh2_connect')) {
			//ssh2_sftp_unlink($this->sftp, JLoads::$cdnpath . DS . "$file");
		}
	}

	public function removeDir($dir) {
		$dir = JLoads::$DIRHOME . DS . $dir;
		//$command = 'rm -rf ' . $dir;

		//$this->exec($command);
	}

	public function makeDir($dir, $permissions = null) {
		$sftp = $this->sftp;
		$dir = "{$sftp}{$dir}";

		if(!file_exists("ssh2.sftp://{$dir}")) {
			mkdir("ssh2.sftp://{$dir}", 0755, true);
		}
	}

	// Local helpers

	protected function exec($command) {
		ssh2_exec($this->connection, $command);
	}
}
