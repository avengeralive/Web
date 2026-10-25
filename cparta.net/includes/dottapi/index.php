<?php

class DotttApi {

    function SendOrder($offer, $name, $phone, $userTo, $userFrom, $shortCountry, $browser, $subId1, $subId2, $subId3) {
        $apiKey = '4eb32e1ff759015f18e01c561393045a';
        $url = 'https://dott.pro/api_web/1.0/addOrder/?api_key=' . $apiKey;
        if ($name == '') {
            $name = 'Заказчик';
        }
        if ($phone == '') {
            $phone = 0;
        }

        $data = array(
            'offer_id' => $offer,
            'user_id' => $userTo,
            'web_id' => $userFrom,
            'country' => $shortCountry,
            'name' => $name,
            'phone' => $phone,
            'agent' => $browser,
            'data1' => $subId1,
            'data2' => $subId2,
            'data3' => $subId3,
            'check_sum' => md5($userTo . $offer . $apiKey)
        );
        $requestQuery = http_build_query($data);
        $logger = Registry::get('di')->logger;
        $logger->warning('DotApi request: ' . var_export($requestQuery, 1));

        $send = $this->postCurlData($url, $requestQuery);
        $logger->info('DotApi response: ' . var_export($send, 1));
        return $send;
    }

    function GetOrder($order) {
        $apiKey = '4eb32e1ff759015f18e01c561393045a';
        $url = 'https://dott.pro/api_web/1.0/getOrder/?api_key=' . $apiKey;
        $data = array(
            'id' => $order
        );
$logger = Registry::get('di')->logger;
	
        $requestQuery = http_build_query($data);

        $send = $this->postCurlData($url, $requestQuery);
	$logger->custom('dot','Check: '.$order.' = '.$url.', REQ: '.$requestQuery.' / '.var_export($send, 1));
        return $send;
    }

    function postCurlData($url, $requestQuery) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestQuery);
	//curl_setopt($curl, CURLOPT_HEADER, 1);

        $result = curl_exec($curl);
        $logger = Registry::get('di')->logger;
        $logger->custom('dotpro','DotPro raw response: ' . $result);
        curl_close($curl);
        $result = json_decode($result, true);
        return $result;
    }

}
