<?php
		//add order
 		$curl = curl_init();
 		curl_setopt($curl, CURLOPT_URL, 'https://1v1-crm.ru/json/?func=api&action=set'); //урл сайта к которому обращаемся
 		curl_setopt($curl, CURLOPT_POST, 1);
 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 		$postData = array (
 			'key'					=>	'kjehfbv', //apikey
 			'fio'					=>	($_POST['fio']) ?: 'Иванов Иван петрович', //ФИО
 			'utm_source' 		=> ($_POST['source']) ?: 1, //первая метка
 			'utm_term' 			=> ($_POST['term']) ?: 2, //вторая метка
 			'utm_medium' 		=> ($_POST['medium']) ?: 3, //третья метка
 			'utm_content' 		=> ($_POST['content']) ?: 4, //Четвертая метка
 			'utm_campaign' 	=> ($_POST['campaign']) ?: 5, //Пятая метка
 			'phone'				=>	($_POST['phone']) ?: '8 800555-35-35', //Телефон
 			'quantity'			=>	'1', //Количество
 			'domain'				=> $_SERVER['HTTP_REFERER'], //Домен откуда поступил заказ
 			'ip' 					=> $_SERVER['REMOTE_ADDR'], //IP адресс
 			'referer' 			=> $_POST['referer'],//Рефер (откуда пришел посетитель)
 			'price'				=> ($_POST['price']) ?: 1, //Цена товара
 			'goods' 				=> [ //Детали товара
 				0 => [
 					'goodID' 	=> ($_POST['goodID']) ?: 1, //ID
 					'quantity' 	=> 1, //Количество
 					'price' 		=> ($_POST['price']) ?: 1 //Цена
 				]
 			],
 			'searchButton'=>'get' //это на случай если на сайте, к которому обращаемся проверяется была ли нажата кнопка submit, а не была ли оправлена форма			
 		);
 		curl_setopt($curl, CURLOPT_POSTFIELDS,    http_build_query($postData));
 		curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 5'); //эта строчка как-бы говорит: "я не скрипт, я IE5" :)
 		//curl_setopt ($curl, CURLOPT_REFERER, $_SERVER["HTTP_REFERER"]); //а вдруг там проверяют наличие рефера
 		$res = curl_exec($curl);
 
     	curl_close($curl);



     	$curl2 = curl_init();
     	curl_setopt($curl2, CURLOPT_URL, 'https://1v1-crm.ru/json?func=CronRobot&action=generate');
     	curl_exec($curl2);
     	curl_close($curl2);

     	echo $res;
?>