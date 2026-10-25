<?php

class Providers_LeadR {
    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }
    protected static function request($url, $requestQuery) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        //curl_setopt($curl, CURLOPT_TIMEOUT, 20);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($requestQuery));
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);     
        
            $logger = Registry::get('di')->logger;
            $logger->custom('LEAD-R', var_export($result));
        return $result;
    }
    
    public static function registerLead($flow, $zakaz) {
        $url = 'https://bestshop-product.ru/order/api.php';
        
        if ($name == '') {
            $name = 'Заказчик';
        }
        if ($phone == '') {
            $phone = 0;
        }

        $order = [
            'name' => $zakaz->name,
            'phone' => $zakaz->phone,
            'api_key' => 'cb1b710fb8a86c1cc54fc91dbb6a7c5f',
            'user_id' => 25607,
            'geo' => $zakaz->short_country,
            'flow_id' => $flow,
            'ip' => $zakaz->ip,
            'user_agent' => $zakaz->useragent,
            'data1' => '',
            'data2' => '',
        ];
        
        //$requestQuery = json_encode($infocdnData);

        $res = self::request($url, $order);  
        
        if (!isset($res['status_code']) || $res['status_code'] != 200) {
            throw new Exception("Не принят");
        }
        return $res['response']['id'];
    }

    public static function getPaymentStatus($apikey, $id) {        
        return true;
    }

    public static function getStatus($id, $u, $api_key) {
        $url = 'https://lead-r.ru/api3/get_leads';
        
        $order = [
            'api_key' => $api_key,
            'user_id' => $u,
            'ids' => $id,
        ];
        
        $res = self::request($url, $order);
        if (!isset($res['status_code']) || $res['status_code'] != 200) {
            throw new Exception("Bad Request");
        }
        return $res['response'];
    }
}
