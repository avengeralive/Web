<?php
namespace lib;

//include_once __DIR__ . '/../__dpr.php';


if(!defined('VOCU_FWK')) {
	die();
} // не работает без нашего фреймворка

/**
 * class.SFTPConnection.php
 *
 *Класс - библиотека с функциями для работы  CDN по SSH
 *подгружается через автоподгрузку классов
 *
 * История:  2016.12.07 - файл создан
 *
 **/
class LocalConnection extends AbstractConnection {
	public static function GetBaseDir() {
		return JLoads::$DIRHOME . '/cdn';
	}


	public function __construct() {
		parent::__construct();
	}

	public function moveFile($source_path, $destination_path, $permissions = 0644) {
		$destination_path = static::GetBaseDir() . DS . $destination_path;

		rename($source_path, $destination_path);
		chmod($destination_path, $permissions);
	}

	public function removeFile($file) {
		$file = static::GetBaseDir() . DS . $file;

		if(is_file($file)) {
			//unlink($file);
		}
	}

	public function removeDir($dir) {
		$dir = static::GetBaseDir() . DS . $dir;

		if(is_dir($dir)) {
			//shell_exec('rm -rf ' . $dir);
		}
	}

	public function copyDir($dir, $dest) {
		$dir = static::GetBaseDir() . DS . $dir;
		$dest = static::GetBaseDir() . DS . $dest;

		if(is_dir($dir)) {
			shell_exec("cp -r $dir $dest");
		}
	}

	public function makeDir($dir, $permissions = 0775) {
		$dir = static::GetBaseDir() . DS . $dir;

		if(!is_dir($dir) && !is_file($dir)) {
			mkdir($dir, $permissions, true);
		}
	}
}