<?php 
namespace lib;
if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

/**
* class.CDN.php
*
*Класс - библиотека с функциями для работы CDN
*подгружается через автоподгрузку классов
*
* История:  09.05.2019 - файл создан
*
**/

class CDN {
	
	function curl($D=null) {
		
		$D = (isset($_POST['data'])) ? $_POST : $D;
		$ext	= (is_array($D['data'])) ? pathinfo($D['data']['name'], PATHINFO_EXTENSION) : pathinfo($D['data'], PATHINFO_EXTENSION);
		$img	= (is_array($D['data'])) ? $ext .';;'. base64_encode(file_get_contents($D['data']['name'])) : $ext .';;'. base64_encode(file_get_contents($D['data']));
		$file = tempnam(sys_get_temp_dir(), 'cdn');
		file_put_contents($file, $img);
		
		//формируем данные для отправки
		$handle = fopen($file, "r");
		$fileLen = filesize($file);
    
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => "http://10.7.140.14:8081/curl.php",
			CURLOPT_UPLOAD => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_INFILE => $handle,
			CURLOPT_INFILESIZE => $fileLen,
			CURLOPT_CUSTOMREQUEST => 'PUT',
			CURLOPT_HTTPHEADER => [
				'Content-Length: ' . $fileLen
			]
		]);
		
		$result = curl_exec($curl);
		curl_close($curl);
		
		fclose($file);
		@unlink($file);
		return $result;
    }

}

