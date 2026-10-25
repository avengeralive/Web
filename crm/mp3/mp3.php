<?php

	//_POST
	if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'PUT') {
		parse_str(file_get_contents("php://input"), $_POST);
		foreach ($_POST as $key => $value) {
			unset($_POST[$key]);
			$_POST[str_replace('amp;', '', $key)] = $value;
		}
		$_REQUEST = array_merge($_REQUEST, $_POST);
	}
	
	echo curl($_REQUEST);
	
	
	function get_content($URL){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $URL);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
	}

	function curl($D) {
		$ext	= (is_array($D['data'])) ? pathinfo($D['data']['name'], PATHINFO_EXTENSION) : pathinfo($D['data'], PATHINFO_EXTENSION);
		switch ($ext) {
			case null:
			case 'wav':
				$ext	= 'wav';
				$img = base64_encode(get_content($D['data']));
			break;
			default:
				$img = (is_array($D['data'])) ? base64_encode(file_get_contents($D['data']['tmp_name'])) : base64_encode(get_content($D['data']));
			break;
		}
		
		$json = [];
// 		$json['ext'] = strtolower($ext);
// 		$json['img'] = $img;
// 		$json['d'] = file_get_contents($D['data']);
		$json['result'] = addPhoto(strtolower($ext), $img);
	   return json_encode($json);
	}

   //xml импорт - добавление изображений
	function addPhoto($ext, $img) {
		
		if (!empty($img)) {	
			$base64 = base64_decode($img);
			$img = tempnam(sys_get_temp_dir(), 'php');
				
			if(is_writable($img)) {
				file_put_contents($img, $base64);
			} else {
				$img = null;
			}

			if ($img && is_readable($img)) { 
			       		
				$error = false;
				//Расширения (обязательно в нижнем регистре)
				$doc_extensions = [
					'doc', 'xls', 'ppt', 'docx', 'xlsx', 'pptx',
					'pdf', 'rtf', 'psd', 'djvu', 'fb2', 'txt',
					'cdr', 'gif', 'jpg', 'jpeg', 'png', 'svg', 'wav'
				];
					
				if (!$error && in_array($ext, $doc_extensions)) {
					
					$path = dynamic_path() .'.'. $ext;
					$remote_dir = dirname($path);
					if(!is_dir($remote_dir)) {
						mkdir($remote_dir, 0777, true);
					}
								
					$path_parts = pathinfo($path);
					if (!in_array($path_parts['extension'], $doc_extensions)) {
						$path_parts['error'] = 'Недопустимый тип файла';
					}

					if (in_array($path_parts['extension'], $doc_extensions)) {
						$path_parts['basename'] = "{$path_parts['filename']}.{$path_parts['extension']}";
					}

					$path_parts['all'] = $path_parts['dirname'] . '/' . $path_parts['basename'];
					$destination_path = '/var/www/crm/mp3/' . $path_parts['all'];

					chmod($destination_path, 0644);
					rename($img, $destination_path);
					chmod($destination_path, 0644);

					return $path_parts;

				} elseif (!$error && $ext == 'wav') {
					$path = str_replace('+', '.', $ext);
										
					$path_parts = pathinfo($path);
					$path_parts['basename'] = "{$path_parts['filename']}.{$path_parts['extension']}";

					$path_parts['all'] = $path_parts['dirname'] . '/' . $path_parts['basename'];
					$destination_path = '/var/www/crm/mp3/' . $path_parts['all'];

					rename($img, $destination_path);
					chmod($destination_path, 0644);

					return $path_parts;
				} else return 'ext refuse';
			} else return 'not readable';
		} else return 'not get file';
	}
	
	//xml импорт - dynamic_path
	function dynamic_path() {
		$fullPath = round(microtime(true) * 1000);
		$dirPath = substr($fullPath, 2, -5);
		//1000 файлов в секунду, 10000 файлов в папке
		$fileName = substr($fullPath, -5);
		//2 = 100 папок в папке
		//3 = 1000 папок в папке
		$dir = implode('/', str_split($dirPath, 2));
		return 'mp3/1'. $dir .'/'. $fileName;
	}
	
	
