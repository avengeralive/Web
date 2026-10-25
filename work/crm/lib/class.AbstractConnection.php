<?php
namespace lib;
use  \Exception;

if(!defined('VOCU_FWK')) {
	die();
} // не работает без нашего фреймверка


abstract class AbstractConnection {

	/**
	 * @var string Временная папка
	 */
	protected static $tmp_dir = '/tmp/vocu';

	/**
	 * @var array Расширения (обязательно в нижнем регистре), для которых
	 * имя файла должно заменяться случайным числом.
	 */
	protected static $doc_extensions = [
		'doc', 'xls', 'ppt', 'docx', 'xlsx', 'pptx',
		'pdf', 'rtf', 'psd', 'djvu', 'fb2', 'txt',
		'cdr', 'gif', 'jpg', 'jpeg', 'png'
	];

	/**
	 * Возвращает путь к папке, в которой лежат домены
	 *
	 * @return string
	 */
	public static function GetBaseDir() {
		return JLoads::$DIRHOME;
	}


	// Данные подключения
	protected $host;
	protected $port;
	protected $user;
	protected $pass;

	public function __construct() {
		$this->host = JLoads::$cdnhost;
		$this->port = JLoads::$cdnport;
		$this->user = JLoads::$cdnuser;
		$this->pass = JLoads::$cdnpass;
	}

	abstract public function moveFile($source_path, $destination_path, $permissions = 0644);
	abstract public function removeFile($file);
	abstract public function removeDir($dir);
	abstract public function makeDir($file, $permissions = null);


	public function SendFile($local_file, $remote_file, $allow_type = null) {
		if(!@is_file($local_file)) {
			if(!is_dir(static::$tmp_dir)) {
				mkdir(static::$tmp_dir, 0777, true);
			}

			$tmp_name = static::$tmp_dir . DS . uniqid() . '.tmp';

			if(file_put_contents($tmp_name, $local_file) === false) {
				throw new Exception("Could not write local file: {$tmp_name}.");
			}

			$local_file = $tmp_name;
		}

		// At this point $local_file is path to file we want to upload.

		$path_parts = pathinfo($remote_file);
		$path_parts['extension'] = strtolower($path_parts['extension']);// Все расширения к нижнему регистру
		$path_parts['filename'] = strtolower($path_parts['filename']); // Все названия к нижнему регистру

		if(is_array($allow_type) && !in_array($path_parts['extension'], $allow_type)) {
			$path_parts['error'] = 'Недопустимый тип файла';
			return $path_parts;
		}
		// At this point we're allowed to upload file with this extension.

		// Convert documents to digit-style filenames (MyCoolPresentation.pptx => 345384539453.pptx)
		if(in_array($path_parts['extension'], static::$doc_extensions)) {
			$path_parts['filename'] = time() . rand(999, 999999999);
			$path_parts['basename'] = "{$path_parts['filename']}.{$path_parts['extension']}";
		}

		$remote_file = $path_parts['dirname'] . DS . $path_parts['basename'];
		$remote_dir = dirname($remote_file);

		if(!is_dir($remote_dir)) {
			$this->makeDir($remote_dir);
		}

		// At this point $remote_file contains full final destination path
		// (e.g. /var/www/vocu/cdn/somedomain.ru/test.txt) and $remote_dir exists


		// Move temporary file to it's new destination
		$this->moveFile($local_file, $remote_file);

		return $path_parts;
	}
}