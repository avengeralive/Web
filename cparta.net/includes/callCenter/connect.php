<?php
class callcenter{
	
	function SendOrder($zakazid, $name, $phone, $name_offer , $price_offer){
		$url = 'https://api.callcpa.ru/orders?token=8KpJ3oJS2Y6ERqv393xB5';
		if($name == ''){$name = 'Orderer';}
		if($phone == ''){$phone = 0;}
		$order = array(
		  "id" => $zakazid,
		  "phone" => $phone,
		  "name" => $name,
		  "type_payment" => 0,
		  "type_delivery" => 0,
		  "state" => 0,
		  "price" => $price_offer,
		  "syspicious" => false,
		  "rpo" => 0,
		  "address" => '',
		  "product" => array(array(
				"title" => $name_offer,
				"count" => 1,
				"price" => $price_offer
				)),
		  "note" => '',			
		);
	
		$post_arr = json_encode( $order );		
		$callspa = $this->postCurlData($url, $post_arr);
		return $callspa;
	}
	
	function GetAllOrders(){
		$url = 'https://api.callcpa.ru/orders?token=8KpJ3oJS2Y6ERqv393xB5';
		$post_arr = '';		
		$callspa = $this->getCurlData($url);
		return $callspa;
	}
	
	function GetOrder($order){
		$url = 'https://api.callcpa.ru/orders/'.$order.'?token=8KpJ3oJS2Y6ERqv393xB5';
		$post_arr = '';		
		$callspa = $this->getCurlData($url);
		return $callspa;
	}	
	
	public function getCurlData($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		$curlData = curl_exec($curl);
		curl_close($curl);
		return $curlData;	
		
	}	

	public function postCurlData($url, $post_arr)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		//curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_arr );
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		$curlData = curl_exec($curl);
		curl_close($curl);
		return $curlData;	
		
	}

	
}