<?php
	namespace lib;
	//удаляем pdf по истечении 1 суток
// 	$files = (array)glob("/var/www/crm/pdf/exit/*") ?: [];
// 	$now   = time();
// 	if (!empty($files)) foreach ($files as $file) {
// 		if (is_file($file)) {
// 			if ($now - filemtime($file) >= 60 * 60 * 24 * 1) { // 1 days
// 				unlink($file);
// 			}
// 		}
// 	}
	
	//Перемещать заказ в другой статус по истечению заданного периода
	$curl1 = curl_init();
	curl_setopt($curl1, CURLOPT_URL, 'https://1v1-crm.ru/json?func=Statuses&action=listChangeTime');
	$res = curl_exec($curl1);
	curl_close($curl1);
	
	//Перемещать заказ в другой статус по статусу почты России
// 	$curl2 = curl_init();
// 	curl_setopt($curl2, CURLOPT_URL, 'https://1v1-crm.ru/json?func=Statuses&action=listChangeTime');
// 	$res = curl_exec($curl2);
// 	curl_close($curl2);

?>