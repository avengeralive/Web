<?php
class retailCrmApi{

	function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
        return $sendToTelegram;
    }

	function SendOrder($site, $name, $phone, $productId, $apiKey, $zakaz){
		$url = 'https://digital-shop.retailcrm.ru/api/v5/orders/create';
		if($name == ''){$name = 'Заказчик';}
		if($phone == ''){$phone = 0;}
		 $data=array(
			'site' => $site,
			'order' => json_encode(array(
				'firstName' => $name,
				'phone' => $phone,
				'source' => array(
					'medium' => $zakaz->user_id,
					'source' => 'avalead'
				),
				'items' => array(
					array(
						'offer' => array(
							//'id' => $productId,
							'externalId' => $productId
						)
					)
				),
				'delivery' => array(
					'code' => 'russianpost-digital'
				)
			)),
			'apiKey' => $apiKey

		 );
		$requestQuery = $data;
		$send= $this->postCurlData($url, $requestQuery, $apiKey);
		return $send;
	}

	function GetOrder($order, $apiKey){
            $url = 'https://digital-shop.retailcrm.ru/api/v5/orders/'.$order;

            $data = array(
                'by' => 'id',
                'apiKey' => $apiKey,
            );
			
            //$requestQuery = 'by=id&apiKey='.$apiKey;
			//$this->telegram($apiKey);
            $send = $this->getCurlData($url, $apiKey);
            return $send;
	}
 	function getCurlData($url,$requestQuery)
	{
		//$this->telegram($requestQuery);
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url.'?by=id&apiKey=c8XPC87FdIJpFPENCxKuBQNgPgmeQHbp');
		//file_put_contents('/var/www/html/text.txt', $url.'?by=id&apiKey=c8XPC87FdIJpFPENCxKuBQNgPgmeQHbp');
		//curl_setopt($curl, CURLOPT_TIMEOUT, 20);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($curl);
		curl_close($curl);
		//file_put_contents('/var/www/html/text.txt', $result);
		$result =json_decode($result, true);
		return $result;
	}
	function postCurlData($url,$requestQuery,$apiKey)
	{
		$proxy_url = 'http://digital-shop.su/crm/api.php';
		$payload = [
			'token' => '12345',
			'url' => $url,
			'method' => 'POST',
		];
		if ($requestQuery) $payload['data'] = json_encode($requestQuery, JSON_UNESCAPED_UNICODE);

		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => $proxy_url,
			CURLOPT_POST => 1,
			CURLOPT_HTTPHEADER => ['Content-Encoding: UTF-8', 'Connection: close'],
			CURLOPT_POSTFIELDS => $payload,
			CURLOPT_HEADER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => false,
		]);

		$response = curl_exec($curl);

		/*$responseStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		if ($response === false || $responseStatus > 499) {
			sleep(rand(3, 6));
			$response = curl_exec($curl);
			$responseStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		}*/
		file_put_contents('/var/www/html/text.txt', $response);
		file_put_contents('/var/www/html/text2.txt', json_encode($payload));
		$responseBody = json_decode($response, true);
		/*if ($response === false) {
			throw new Exception("httpRequest failed: curl " . curl_error($curl));
		}

		
		curl_close($curl);

		if ($responseStatus > 299) {
			throw new Exception("httpRequest failed: " . print_r($responseBody, true));
		}*/

		return $responseBody;

		/*
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		//curl_setopt($curl, CURLOPT_TIMEOUT, 20);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $requestQuery);
		$result = curl_exec($curl);
		curl_close($curl);
		//$this->telegram($requestQuery);
		//$this->telegram($result);
		file_put_contents('/var/www/html/text.txt', json_encode($requestQuery).'\n'.$result);
		$result =json_decode($result, true);*/
		//return $result;
	}

}
