<?php
	// ! Генерирует платежи для предоплаты и отсылает СМС
	$curl = curl_init();
 	curl_setopt($curl, CURLOPT_URL, 'https://1v1-crm.ru/json?func=Robots&action=PikassaCreatePayment');
 	curl_exec($curl);
	curl_close($curl);

	// ! Проверят оплачин ли заказ по предоплате и если оплачен переносит в подтверждена отправка
	$curl = curl_init();
 	curl_setopt($curl, CURLOPT_URL, 'https://1v1-crm.ru/json?func=Robots&action=PikassaCheakPayment');
 	curl_exec($curl);
	curl_close($curl);
	 
	// ! проверка заказов в обработке на наличие возвратов
 	$curl2 = curl_init();
 	curl_setopt($curl2, CURLOPT_URL, 'https://1v1-crm.ru/json?func=Api&action=robotLiveinform');
 	curl_exec($curl2);
 	curl_close($curl2);
	
	// ! обработка звонков из очереди
 	/*$curl2 = curl_init();
 	curl_setopt($curl2, CURLOPT_URL, 'https://1v1-crm.ru/json?func=CronRobot&action=generate');
 	curl_exec($curl2);
 	curl_close($curl2);
// 	
// 	//обработка успешных звонков
 	$curl3 = curl_init();
 	curl_setopt($curl3, CURLOPT_URL, 'https://1v1-crm.ru/json?func=CronRobot&action=success');
 	curl_exec($curl3);
 	curl_close($curl3);*/
	
	// ! проверка на дубли в lv				
//  	$curl4 = curl_init();
//  	curl_setopt($curl4, CURLOPT_URL, 'https://1v1-crm.ru/json?func=Api&action=getDouble');
//  	curl_exec($curl4);
//  	curl_close($curl4);
 	
 	// ! проверка на дубли в базе статистики ~ 1M записей				
//  	$curl6 = curl_init();
//  	curl_setopt($curl6, CURLOPT_URL, 'https://1v1-crm.ru/json?func=Api&action=getDoubleStat');
//  	curl_exec($curl6);
//  	curl_close($curl6);
 	
	
	//подсчет количества заказов в статусах				
 	$curl5 = curl_init();
 	curl_setopt($curl5, CURLOPT_URL, 'https://1v1-crm.ru/json?func=JBase&action=Get_All_Count');
 	curl_exec($curl5);
	curl_close($curl5);
	 
	// перекладывает заказы из Обработки со статусом 777 в Подтвержденные
	$curl6 = curl_init();
	curl_setopt($curl6, CURLOPT_URL, 'https://1v1-crm.ru/json?func=Statuses&action=From_Processing_To_Confirmation');
	curl_exec($curl6);
	curl_close($curl6);

?>