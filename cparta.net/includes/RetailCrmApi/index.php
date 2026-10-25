<?php
class retailCrmApi{

	function SendOrder($site, $name, $phone, $productId, $apiKey){
		$url = 'https://dvad.retailcrm.ru/api/v3/orders/create';
		if($name == ''){$name = 'Заказчик';}
		if($phone == ''){$phone = 0;}

		 $data=array(
			'site' => $site,
			'order' => json_encode(array(
				'firstName' => $name,
				'phone' => $phone,
				'items' => array(
					array(
						'productId' => $productId
					)
				)
			)),
			'apiKey' => $apiKey,

			'customFields' => json_encode(array(
				'orderFrom' => 'YesCPA'
			))

		 );
		$requestQuery = http_build_query($data);

		$send= $this->postCurlData($url, $requestQuery);
		return $send;
	}

	function GetOrder($order, $apiKey){
            $url = 'https://dvad.retailcrm.ru/api/v3/orders/'.$order;

            $data = array(
                'by' => 'id',
                'apiKey' => $apiKey,
            );

            $requestQuery = http_build_query($data);

            $send= $this->getCurlData($url, $requestQuery);
            return $send;
	}
 	function getCurlData($url,$requestQuery)
	{
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url.'?'.$requestQuery);
		//curl_setopt($curl, CURLOPT_TIMEOUT, 20);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($curl);
		curl_close($curl);
		$result =json_decode($result, true);
		return $result;
	}
	function postCurlData($url,$requestQuery)
	{
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		//curl_setopt($curl, CURLOPT_TIMEOUT, 20);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $requestQuery);
		$result = curl_exec($curl);
		curl_close($curl);
		$result =json_decode($result, true);
		return $result;
	}

}
