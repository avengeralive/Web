<?php
namespace lib;

/**
* class.Api.php
*
*Класс - библиотека с функциями для для работы с Api
*подгружается через автоподгрузку классов
*
*
**/


class Api {
    
	function postback() {
		$post = (!empty($_POST)) ? $_POST : $_GET;
    	$post = json_encode($post, JSON_UNESCAPED_UNICODE);
// 		$Keys = array_keys($post);
// 		$Values = array_values($post);
// 		switch ($post['fun']) {
// 			
// 		}	
		return JBase::Set_Data('list17', ['domain','robot','status'], [DOMAIN, $post, 1]);
		return 'OK';
		//return self::set();
	}
	
	function migrate() {
		$post 					= (!empty($_POST)) ? $_POST : $_GET;
    	$post 					= array_filter($post);
    	$post 					= json_encode($post, JSON_UNESCAPED_UNICODE);
    	$post['status'] 		= self::statusTo($post['status'], $post['key']);
		$Keys 					= array_keys($post);
		$Values 					= array_values($post);
		
		JBase::Set_Data('list17', $Keys, $Values);
		$id = JBase::$SqlID;
				
		return [$id => 'OK'];
// 		switch ($post['project']) {
// 			case 'fun':
// 			break;
// 		}	
	}
    
	function set() {
		if ($_POST["key"] == 'migrate') return self::migrate();
		
		header("Content-Type:application/json");
		$result = [];
		//$antispam = false;
		$antispam = self::antispam();
			//return json_encode($antispam, JSON_UNESCAPED_UNICODE);
		if (!empty($antispam)) {
			$errors = (isset($antispam['errors']) && is_array($antispam['errors'])) ? $antispam['errors'] : false;
			unset($antispam['errors']);
			//если все ок
			if (!$errors || $_POST["key"] == 'migrate') {
				$Keys = array_keys($antispam);
				$Values = array_values($antispam);
				
				
				
				
				
			
				//API
// 				$isNew = true;
// 				$str0 = JBase::Get_Data('list35', ['id','code'], ['type' => '1']);
// 				$code0 = [];
// 				if (!empty($str0)) {
// 					if () {
// 						while ($tmp0 = $str0->fetch_assoc()) {
// 							self::jdkfhg($tmp0);
// 							$code0[$tmp0['id']] = [
// 								'url' => $tmp0['url'],
// 								'code' => $tmp0['code'],
// 								'type' => $tmp0['type']
// 							];
// 						}
// 					}
// 					if (count($code0) > 1) $code0 = Mustage::get($code0[0]);
// 	   			else $code0 = Mustage::get($code0);
// 				}	
			
			
			
			
			
			
			
				JBase::Set_Data('list17', $Keys, $Values);
				$id = JBase::$SqlID;
				
				CronRobot::addNew($id, 17, 1);
				return [$id => 'OK'];
			} else {
				
				switch($errors['status']) {	 
					case 'error': //Выводить ошибку при срабатывании фильтра
						if (isset($errors['time_min']))	$result['code1'] = 'Слишком короткое время оформления заказа: '. $errors['time_min'] .' сек';
						if (isset($errors['time_max']))	$result['code2'] = 'Слишком долгое время оформления заказа: '. $errors['time_max'] .' сек';
						if (isset($errors['stopword']))	$result['code3'] = 'Стоп-слова: '. $errors['stopword'];
						if (isset($errors['country'])) 	$result['code4'] = 'Запрещено для страны: '. $errors['country'];
						if (isset($errors['max'])) 		$result['code5'] = 'Максимальное количество заказов с одного IP: '. $errors['max'];
						if (isset($errors['ip'])) 			$result['code6'] = 'Этот IP в черном списке: '. $errors['ip'];
						return json_encode($result, JSON_UNESCAPED_UNICODE);
					break;  
					case 'fake': //Имитировать успешное оформление заказа						
						return [substr(time(), 4) => 'Ok'];
					break; 
				}
			}
			return json_encode($result, JSON_UNESCAPED_UNICODE);
		} 
		return [substr(time(), 4) => 'Ok'];
	}
    
    
	
	function antispam() {
	
	
	/*
		antispam_use						=> Принцип работы
		antispam_ips_black				=> Черный список IP
		antispam_ips_max					=> Максимальное количество заказов с одного IP
		antispam_stop_word				=> Стоп-слова
		antispam_stop_country_type		=> Гео-фильтрация
		antispam_stop_country			=> Страны
		antispam_time_min					=> Мин.секунд на оформление заказа
		antispam_time_max					=> Макс.секунд на оформление заказа
	*/
	
		$key 				= (isset($_POST["key"])) ? JBase::escape($_POST["key"]) : false;										//api_key required
		if (!$key) return false;
		
		$utm_term 		= (isset($_POST["utm_term"])) ? JBase::escape($_POST["utm_term"]) : false;							//utm_term
		$utm_medium 	= (isset($_POST["utm_medium"])) ? JBase::escape($_POST["utm_medium"]) : false;					//utm_medium
		$utm_source 	= (isset($_POST["utm_source"])) ? JBase::escape($_POST["utm_source"]) : false;					//utm_source
		$utm_content 	= (isset($_POST["utm_content"])) ? JBase::escape($_POST["utm_content"]) : false;					//utm_content
		$utm_campaign 	= (isset($_POST["utm_campaign"])) ? JBase::escape($_POST["utm_campaign"]) : false;				//utm_campaign
		$searchButton 	= (isset($_POST["searchButton"]) && $_POST["searchButton"] == 'get') ? true : false;			//это на случай если на сайте, к которому обращаемся проверяется была ли нажата кнопка submit, а форма не была оправлена 
		
		$fio 				= (isset($_POST["fio"])) ? JBase::escape($_POST["fio"]) : false;										//ФИО
		$phone 			= (isset($_POST["phone"])) ? JBase::escape($_POST["phone"]) : false;									//Телефон
		$quantity 		= (isset($_POST["quantity"])) ? JBase::escape($_POST["quantity"]) : false;							//Количество
		//$domain 			= (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : false;								//Домен откуда поступил заказ
		$referer 		= (isset($_POST["referer"])) ? JBase::escape($_POST["referer"]) : false;							//referer (откуда пришел посетитель)
		$price 			= (isset($_POST["price"])) ? JBase::escape($_POST["price"]) : false;									//Цена товара
		//$ip 				= (isset($_SERVER['REMOTE_ADDR'])) ? JBase::escape($_SERVER['REMOTE_ADDR']) : false;			//IP откуда поступил заказ
		$goods 			= (isset($_POST["goods"])) ? json_decode($_POST["goods"], true) : false;							//Товары

		$time_min 		= (isset($_POST["time_min"])) ? (int)$_POST["time_min"] : false;										//Мин.секунд на оформление заказа
		$time_max 		= (isset($_POST["time_max"])) ? (int)$_POST["time_max"] : false;										//Макс.секунд на оформление заказа

		$errors 			= [];																														//Антиспам выявлено

		$Result = JBase::Get_Full_Table_From_Domain('antispam');
		$items = [];			
		if (!empty($Result)) {
			while ($item = $Result->fetch_assoc()) 
				$items[$item['name']] = explode(PHP_EOL, $item['value']); //разбираем переносы строк		
		}
		
		// >>>>>>>> поля antispam - это массивы значений (приоритет сверху вниз) >>>>>>
		
		//Черный список IP - $items['antispam_ips_black'];
		if (in_array($ip, $items['antispam_ips_black'])) $errors['ip'] = $ip;
		
		//Стоп-слова - $items['antispam_stop_word'];
		if (count($items['antispam_stop_word']) > 0) {
			$fioexplode = explode(" ", $fio);
			foreach($items['antispam_stop_word'] as $word) {
				if (in_array($word, $fioexplode)) $errors['stopword'] = $word;
			}
		}
		
		//0-Не использовать,1-Выводить ошибку при срабатывании фильтра,2-Имитировать успешное оформление заказа
		if ((!empty($errors)) && $items['antispam_use'][0] == '0') $errors = [];
		if ((!empty($errors)) && $items['antispam_use'][0] == '1') $errors['status'] = 'error';
		if ((!empty($errors)) && $items['antispam_use'][0] == '2') $errors['status'] = 'fake';
		
		//Мин.секунд на оформление заказа - $items['antispam_time_min'];
		//Макс.секунд на оформление заказа - $items['antispam_time_min'];
		if ($time_min && (int)$items['antispam_time_min'][0] > 0 && (int)$items['antispam_time_min'][0] < $time_min) array_push($errors, ['time_min' => $time_min]);
		if ($time_max && (int)$items['antispam_time_max'][0] > 0 && (int)$items['antispam_time_max'][0] > $time_max) array_push($errors, ['time_max' => $time_min]);
		
		//Страны
		$geo = self::getGeo($ip);
		$city = $geo['city'][0];
		if ($geo['countrycode'][0]) {
			//1-Запретить только выбранные страны,2-Запретить все страны, кроме выбранных
			$expl = explode(" ", $items['antispam_stop_country'][0]);
			if (size($expl) > 0) {
				if (in_array($geo['countrycode'][0], $expl) && $items['antispam_stop_country_type'] == '1') array_push($errors, ['country' => $geo['countrycode'][0]]);
				if (!in_array($geo['countrycode'][0], $expl) && $items['antispam_stop_country_type'] == '2') array_push($errors, ['country' => $geo['countrycode'][0]]);
			}
		}
		
		//Максимальное количество заказов с одного IP - $items['antispam_ips_max']
		//>>>>>>>
		
		$fields = [
			'domain' 							=> DOMAIN, 							//(varchar) домен проекта
			'id_user' 							=> 0, 								//(int) Id юзера
			'premium' 							=> 0,  								//(int) Premium
			'page' 								=> '',  								//(int) Раздел или страница, с которой отправлен заказ
			'status' 							=> 1, 								//(int) Статус 
			'time' 								=> time(), 							//(int) Дата подачи 
			'timeupdate' 						=> time(),  						//(int) Дата последнего изменения
			'lastUpdate' 						=> time(),  						//(int) Дата изменения статуса
			'price' 								=> '',  								//(int) Цена
			'total' 								=> '',  								//(int) Сумма заказа
			'agree_terms' 						=> 0,  								//(int) С условиями покупки согласен
			'agree_personal' 					=> 0,  								//(int) Согласен на обработку персональных данных
			'geo' 								=> $geo,  							//(varchar) geo по IP
			'name' 								=> $fio,								//(varchar) ФИО
			'goods_names' 						=> '',  								//(text) товары
			'domain2' 							=> $domain,  						//(int) домен, с которого пришел заказ
			'approvedAt' 						=> 0,  								//(int) Дата апрува
			'shippedAt' 						=> 0,  								//(int) Дата отправки
			'canceledAt' 						=> 0,  								//(int) Дата отмены
			'buyoutAt' 							=> 0,  								//(int) Дата выкупа
			'refundedAt' 						=> 0,  								//(int) Дата возврата
			'comment' 							=> '',  								//(int) Комментарий
			'log_robot' 						=> '',  								//(int) Лог робота
			'all' 								=> '',  								//(int) Итого
			'time_call' 						=> 0,  								//(int) Время перезвона
			'attempts' 							=> 0,  								//(int) Количество попыток
			'group_time_call' 				=> '',  								//(int) Группа режима прозвона
			'russianpostTrack' 				=> 0,  								//(int) Почта России: Track
			'russianpostStatus' 				=> '',  								//(int) Почта России: cтатус посылки
			'count' 								=> 0,  								//(int) Кол-во
			'postIndex' 						=> 0,  								//(int) Индекс
			'region' 							=> '',  								//(int) Регион
			'city' 								=> $city,  					//(int) Город
			'address' 							=> '',  								//(int) Адрес
			'house' 								=> '',  								//(int) Дом
			'flat' 								=> '',  								//(int) Квартира
			'phone' 								=> $phone,  						//(int) Телефон
			'email' 								=> '',  								//(int) Email
			'category' 							=> '',  								//(int) Категория товара
			'lastSms' 							=> '',  								//(int) Последнее SMS
			'smsStatus' 						=> '',  								//(int) Статус SMS
			'lastVoiceSms' 					=> '',  								//(int) Последнее голосовое SMS
			'lastVoiceStatus' 				=> '',  								//(int) Статус голосового SMS
			'liveinformId' 					=> '',  								//(int) Liveinform ID
			'size' 								=> '',  								//(int) Размер
			'completely' 						=> '',  								//(text) Дожим
			'weight' 							=> '',  								//(int) Масса
			'tag' 								=> '',  								//(int) Метка
			'source' 							=> '',  								//(int) Источник
			'ip' 									=> $ip,  							//(varchar) IP
			'referrer' 							=> $referer,  						//(int) Referrer
			'expend' 							=> '',  								//(int) Затрачено
			'externalId' 						=> $key,  							//(int) External ID
			'webmasterId' 						=> '',  								//(int) External Webmaster
			'dop1' 								=> '',  								//(int) Доп.поле 1
			'dop2' 								=> '',  								//(int) Доп.поле 2
			'dop3' 								=> '',  								//(int) Доп.поле 3
			'dop4' 								=> '',  								//(int) Доп.поле 4
			'dop5' 								=> '',  								//(int) Доп.поле 5
			'dop6' 								=> '',  								//(int) Доп.поле 6
			'dop7' 								=> '',  								//(int) Доп.поле 7
			'dop8' 								=> '',  								//(int) Доп.поле 8
			'dop9' 								=> $dop9,  								//(int) Доп.поле 9
			'dop10' 								=> $dop10,  								//(int) Доп.поле 10
			'timezone' 							=> '',  								//(int) Смещение по гринвичу (мин)
			'allBuyPrice' 						=> '',  								//(int) Закупочная цена (Итого)
			'developerPrice' 					=> '',  								//(int) Вебмастер сумма
			'utm_source' 						=> $utm_source,  					//(int) UTM-Source
			'utm_medium' 						=> $utm_medium,  					//(int) UTM-Medium
			'utm_campaign' 					=> $utm_campaign,  				//(int) UTM-Campaign
			'utm_term' 							=> $utm_term,  					//(int) UTM-Term
			'utm_content' 						=> $utm_content,  				//(int) UTM-Content
			'operator' 							=> '',  								//(int) operator
			'sms_template' 					=> '', 								//(int) sms_template
			'errors' 							=> $errors 							//Антиспам выявлено
		];

		//здесь можно подключить аккаунты партнеров
// 		switch($key) {	 
// 			case '5sBrM9tE':
// 			break;  
// 			case '6sBrM9tE':
// 			break; 
// 		}

		
		//фильтруем от пустых значений
		$fields = array_filter($fields);
		return $fields; 
	}
	
	//xml to json
	public function Parse($url) {
		$fileContents= file_get_contents($url);
		$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
		$fileContents = trim(str_replace('"', "'", $fileContents));
		$simpleXml = simplexml_load_string($fileContents);
		return $simpleXml;
	}
    
	//ip to geo
	function getGeo($ip = null) {
		return self::Parse("http://api.geoiplookup.net/?query=$ip")->results->result;
	}

	function statusTo($key = null, $project = null) {
		if ($key && $project) {
			$Result = JBase::Get_Data('associate', ['id'], [$project => $key]);
			$items = [];			
			if (!empty($Result)) {
				while ($item = $Result->fetch_assoc()) 
					$items[$item['id']] = $item['list'];		
			}
		}
		return $items;
	}

	//http://api.ipinfodb.com/v3/ip-city/?key=YOUR_API_KEY&ip=IP_V4_OR_IPV6_ADDRESS                		 
	
}