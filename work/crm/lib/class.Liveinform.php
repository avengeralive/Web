<?php
namespace lib;

/**
* class.Liveinform.php
*
* Библиотека с функциями для работы Liveinform
* подгружается через автоподгрузку классов
*
* История: 25.07.2019 - файл создан
*
**/

class Liveinform {
	
	public static function start() {
		
		$api_id = $_POST['api_id'];
		$liveinformUrl = "https://www.liveinform.ru/api/v2/";
		$phone = array($_POST['contact']);
		
		if (isset($_POST['method'])) {
			switch($_POST['method']) {
				case 'add':
					$url = $liveinformUrl. $_POST['method'];
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id,
						'liveinform_id' 	=> (int)$_POST['liveinform_id'], //332633005
						'phone' 				=> $_POST['phone'], //Телефон клиента в международном формате
						'tracking' 			=> $_POST['tracking'], //Трек-номер заказа
						'order_id' 			=> $_POST['order_id'], //Номер заказа внутри вашего магазина
						'email' 				=> $_POST['email'],
						'firstname' 		=> $_POST['firstname'],
						'lastname' 			=> $_POST['lastname'],
						'tags' 				=> $_POST['tags'],
						'additional1' 		=> $_POST['additional1'],
						'additional2' 		=> $_POST['additional2'],
						'additional3' 		=> $_POST['additional3'],
						'index' 				=> $_POST['index'], //Индекс получателя (необходимо только для Белпочты)
						'price' 				=> $_POST['price'],
						'comment' 			=> $_POST['comment'] //Примечание к заказу
					]), true);
					return $res;
				break;
				case 'track':
					$url = $liveinformUrl. $_POST['method'];
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id,
						'liveinform_id' 	=> (int)$_POST['liveinform_id'] //332633005
					]), true);
					return $res;
				break;
				case 'edit':
					$url = $liveinformUrl. $_POST['method'];
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id,
						'liveinform_id' 	=> (int)$_POST['liveinform_id'], //332633005
						'phone' 				=> $_POST['phone'], //Телефон клиента в международном формате
						'tracking' 			=> $_POST['tracking'], //Трек-номер заказа
						'order_id' 			=> $_POST['order_id'], //Номер заказа внутри вашего магазина
						'email' 				=> $_POST['email'],
						'firstname' 		=> $_POST['firstname'],
						'lastname' 			=> $_POST['lastname'],
						'price' 				=> $_POST['price'],
						'comment' 			=> $_POST['comment'] //Примечание к заказу
						'additional1' 		=> $_POST['additional1'],
						'additional2' 		=> $_POST['additional2'],
						'additional3' 		=> $_POST['additional3'],
						'index' 				=> $_POST['index'], //Индекс получателя (необходимо только для Белпочты)
						'status' 			=> $_POST['status'], //welldone-Вручен, return-Возврат, stop, delete
						'np' 					=> $_POST['np'], //1, Изменить статус наложенного платежа на "Оплата"
						
					]), true);
					return $res;
				break;
				case 'balance':
					$url = $liveinformUrl. $_POST['method'];
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id
					]), true);
					return $res;
				break;
				case 'sendsms':
					$url = $liveinformUrl. $_POST['method'];
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id,
						'liveinform_id' 	=> $_POST['liveinform_id'], //[332633005,332633006]
						'text' 				=> $_POST['text'], //Текст sms
						'date' 				=> $_POST['date'], //Отложенный sms. Дата в формате UNIX Timestamp
						'options' 			=> [
							'translit' 		=> 1
						]
					]), true);
					return $res;
				break;
				case 'sendcall':
					$url = $liveinformUrl. $_POST['method'];
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id,
						'liveinform_id' 	=> $_POST['liveinform_id'], //[332633005,332633006]
						'text' 				=> $_POST['text'], //Текст звонка
						'date' 				=> $_POST['date'] //Отложенный звонок. Дата в формате UNIX Timestamp
					]), true);
					return $res;
				break;
				case 'sendemail':
					$url = $liveinformUrl. $_POST['method'];
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id,
						'liveinform_id' 	=> $_POST['liveinform_id'], //[332633005,332633006]
						'subject' 				=> $_POST['text'], //Тема письма
						'text' 				=> $_POST['text'], //Текст письма
						'date' 				=> $_POST['date'] //Отложенное письмо. Дата в формате UNIX Timestamp
					]), true);
					return $res;
				break;
				case 'blacklist2':
					$url = $liveinformUrl. $_POST['method'];
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id,
						'contact' 			=> json_encode($phone)
					]), true)['data']["$phone[0]"];
					
					//записываем
// 						if ($res["returns"] > 0) {
// 							$res = self::sendPost($url, [
// 								'additional1' 	=> 'Черный список (' . self::getBlackStatuses($res["blacklist"]) . ')'
// 							]);
// 							file_put_contents('log.txt', $res);
// 						} else {
// 							$res = self::sendPost($url, [
// 								'additional1' 	=> 'Возвратов не найдено'
// 							]);
// 							file_put_contents('log.txt', $res);
// 						}
					return $res;
				break;
			}
		}
	}
			
	//getLiveInform
	function getLiveInform($key) {
		$radios = JBase::escape($_POST['radios']);

		$fields = [
    	   'liveinform_id' 	=> $key,
    	   'radios' 			=> $radios,
    	   'api_id' 			=> '5sBrM9tE-P3HnxTBU-sm8NMlOO-86pM5flY'
		];
		return $fields;
		
		$curl = curl_init();
		curl_setopt_array($curl, [
		    CURLOPT_URL => "https://www.liveinform.ru/api/v2/edit/?" . http_build_query($fields),
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_RETURNTRANSFER => true
		]);
		
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}
	
	//getLiveInformTracking
	function getLiveInformTracking($tracking, $phone) {
		return $phone;
		
		$ch = curl_init("http://www.liveinform.ru/api/getinfo/");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
			"api_id" => "5sBrM9tE-P3HnxTBU-sm8NMlOO-86pM5flY",
			"phone" => '+79109971700',//$phone,
			"tracking" => '11175435210327'//$tracking
		));
		$body = curl_exec($ch);
		curl_close($ch);
		return $body;
		return self::getLiveInform($body);
	}
	
   //пим-касса
	function addLiveInform() {
		if (!empty($_FILES)) {
			$csv = array_map('str_getcsv', file($_FILES['file']['tmp_name']));

			$res = [];
			foreach($csv as $key) {//+79109971700
				$res[$key[0]] = self::getLiveInformTracking($key[0], (isset($key[1]))?$key[1]:'');
			}
			//return $res;
			return json_encode($res, JSON_UNESCAPED_UNICODE);
		}
	}
	
	public static function sendPost($url, $params) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
		return curl_exec($curl);
	}
		

	function getBlackStatuses($list) {
		$statuses = '';
		$a = 0;
		foreach ($list as $event) {
			if ($a > 0) $statuses .= ' | ';
			$statuses .= "Причина: ". $event['status'] .", Цена: ". $event['price'] .", Дата: ". $event['date'];
			$a++;
		}
		return $statuses;
	}
		
}


