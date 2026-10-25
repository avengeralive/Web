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
	
	public static function get() {
		
		$post = (!empty($_POST)) ? $_POST : $_GET;
		if (!empty($post) && !empty($post['api_id']) && !empty($post['method']))
			return self::start($post, $post['ids']);
		
	}
	
	public static function add($list, $id) {
		$data = JBase::Get_Data('list'. $list, '*', ['id' => $id]);
		$list_data = [];
		if (!empty($data)) {
			while( $s = $data->fetch_assoc() ) {
				$list_data = $s;
			}
		}
		$tags = ($list == '53') ? 'w' : 'п';
		return self::start([
			'method' 			=> 'add',
			'phone' 				=> $list_data['phone'], //Телефон клиента в международном формате
			'tracking' 			=> $list_data['russianpostTrack'], //Трек-номер заказа
			'order_id' 			=> $list_data['id'], //Номер заказа внутри вашего магазина
			//'email' 				=> $list_data['email'],
			'firstname' 		=> $list_data['name'],
			//'lastname' 			=> $list_data['lastname'],
			'tags' 				=> $tags,
			'additional1' 		=> $list_data['dop1'],
			'additional2' 		=> $list_data['dop2'],
			'additional3' 		=> $list_data['dop3'],
			'price' 				=> $list_data['price']
		]);
		
	}
	
	public static function start($post, $ids = null) {
		
		//return $post['api_id'];
		$url = 'https://www.liveinform.ru/api/v2/'. $post['method'] .'/';
		
		if (isset($post['method'])) {
			switch($post['method']) {
				case 'add':
					if ($ids && is_array($ids) && !empty($ids)) {
						$params = [];
						foreach ($ids as $id) {
							$Result = JBase::Query("SELECT * FROM list19 WHERE `id` = '". $id ."'");
    						if ($Result) {
    							$rows = [];
								while ($row = $Result->fetch_assoc()) {
									$rows = $row;
								}
								array_push($params, array_filter([ //JSON-массив с данными о заказе:
									'phone' 			=> $rows['phone'], //Телефон клиента в международном формате
									'tracking' 			=> $rows['russianpostTrack'], //Трек-номер заказа
									'order_id' 			=> '№'. $rows['id'], //Номер заказа внутри вашего магазина
									//'email' 				=> $post['email'],
									'firstname' 		=> $rows['name'],
									//'lastname' 			=> $post['lastname'],
									'tags' 				=> ($rows['status'] == '53') ? 'w' : 'п',
									'additional1' 		=> $rows['dop1'],
									'additional2' 		=> $rows['dop2'],
									'additional3' 		=> $rows['dop3'],
									//'index' 				=> $post['index'], //Индекс получателя (необходимо только для Белпочты)
									//'comment' 			=> $post['comment'], //Примечание к заказу
									'price' 				=> $rows['price']
								]));
    						}
    						$Result->free();
						}
					}
    				//{"status":"","balance":116477.53,"tariff":"3.75","count":1,"total":3.75,"needed":0,"orders":[{"status":"ADDED","liveinform_id":18948226}]}	
    				//{"status":"ERROR","error":[{"code":217,"text":""}]}	
					$returns = [];
					$orders = json_decode(self::sendPost($url, array_filter($params)), true);
					if ($orders['status'] == 'OK') {
						foreach ($ids as $key => $id) {
							JBase::Update_Data('list19', ['liveinformId' => $orders['orders'][$key]['liveinform_id']], ['id' => (int)$id]);
							array_push($returns, [$id => 'OK']);
						}
					} elseif ($orders['status'] == 'ERROR') {
						foreach ($ids as $key => $id) {
							JBase::Update_Data('list19', ['liveinformId' => $orders['error']], ['id' => (int)$id]);
							array_push($returns, [$id => 'ERROR']);
						}
					}

					return $returns;
				break;
				case 'track':
						$res = json_decode(self::sendPost($url, [
							'api_id' 			=> $api_id,
							'liveinform_id' 	=> (int)$post['liveinform_id'] //332633005
						]), true);
						return $res;
					
					
				break;
				case 'edit':
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id,
						'liveinform_id' 	=> (int)$post['liveinform_id'], //332633005 
						'phone' 				=> $post['phone'], //Телефон клиента в международном формате
						'tracking' 			=> $post['tracking'], //Трек-номер заказа
						'order_id' 			=> $post['order_id'], //Номер заказа внутри вашего магазина
						'email' 				=> $post['email'],
						'firstname' 		=> $post['firstname'],
						'lastname' 			=> $post['lastname'],
						'price' 				=> $post['price'],
						'comment' 			=> $post['comment'], //Примечание к заказу
						'additional1' 		=> $post['additional1'],
						'additional2' 		=> $post['additional2'],
						'additional3' 		=> $post['additional3'],
						//'index' 				=> $post['index'], //Индекс получателя (необходимо только для Белпочты)
						'status' 			=> $post['status'], //welldone-Вручен, return-Возврат, stop, delete
						'np' 					=> $post['np'] //1, Изменить статус наложенного платежа на "Оплата"
					]), true);
					return $res;
				break;
				case 'balance':
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id
					]), true);
					return $res;
				break;
				case 'sendsms':
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id,
						'liveinform_id' 	=> $post['liveinform_id'], //[332633005,332633006]
						'text' 				=> $post['text'], //Текст sms
						'date' 				=> $post['date'], //Отложенный sms. Дата в формате UNIX Timestamp
						'options' 			=> [
							'translit' 		=> 1
						]
					]), true);
					return $res;
				break;
				case 'sendcall':
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id,
						'liveinform_id' 	=> $post['liveinform_id'], //[332633005,332633006]
						'text' 				=> $post['text'], //Текст звонка
						'date' 				=> $post['date'] //Отложенный звонок. Дата в формате UNIX Timestamp
					]), true);
					return $res;
				break;
				case 'sendemail':
					$res = json_decode(self::sendPost($url, [
						'api_id' 			=> $api_id,
						'liveinform_id' 	=> $post['liveinform_id'], //[332633005,332633006]
						'subject' 			=> $post['subject'], //Тема письма
						'text' 				=> $post['text'], //Текст письма
						'date' 				=> $post['date'] //Отложенное письмо. Дата в формате UNIX Timestamp
					]), true);
					return $res;
				break;
				case 'blacklist2':
					$phone = array($post['phone']);
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
		//return $phone;
		
		$ch = curl_init("https://www.liveinform.ru/api/getinfo/");
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
		//var_dump($params);
		//return $params;
		//return '{"status":"OK","balance":115890.48,"tariff":"3.75","count":2,"total":7.5,"needed":0,"orders":[{"status":"ADDED","liveinform_id":18954764},{"status":"ADDED","liveinform_id":18954765}]}';
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_POSTFIELDS, array('api_id' => '5sBrM9tE-P3HnxTBU-sm8NMlOO-86pM5flY', 'orders' => json_encode($params, true)));
		//curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
		$body = curl_exec($curl);
		curl_close($curl);
		Debugging::debug('Liveinform', $body);
		return $body;
	}

	function getBlackStatuses($list) {
		$statuses = '';
		$a = 0;
		foreach ($list as $event) {
			if ($a > 0) $statuses .= ' | ';
			$statuses .= "Причина: ". $event->status .", Цена: ". $event->price .", Дата: ". $event->date;
			$a++;
		}
		return $statuses;
	}
		
}


