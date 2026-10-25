<?php

class Providers_Ad1 {

    protected static function request($url, $requestQuery) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        //curl_setopt($curl, CURLOPT_TIMEOUT, 20);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestQuery);
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        return $result;
    }
    
    public static function registerLead($s, $api_key, $zakaz) {
        $url = 'http://infocdn.org/interface/api.php';
        
        if ($name == '') {
            $name = 'Заказчик';
        }
        if ($phone == '') {
            $phone = 0;
        }

        $infocdnData = array(
            'orders' => array(
                array(
                    'country' => $zakaz->short_country, //страна доставки
                    'fio' => $zakaz->name, // Имя
                    'phone' => $zakaz->phone, // Телефон
                    'user_ip' => $zakaz->ip, //ip пользователя
                    'user_agent' => $zakaz->useragent, //UserAgent пользователя
                    'order_time' => time() //timestamp времени заказа
                )
            ),
            'system' => array(
                'network' => 'ad1', // название сети
                'thread' => $s, // id потока из ad1.ru, например bakm
                'subid' => $zakaz->id . ': : : :' . $zakaz->user_id, // 5 субайди, например subid1:subid2:subid3:subid4:subid5 (не обязательно)
                'site_key' => $api_key // ключ
            )
        );
        
        $requestQuery = json_encode($infocdnData);

        $res = self::request($url, $requestQuery);  
        
        $logger = Registry::get('di')->logger;
        $logger->custom('AD1', $zakaz->id . ', '. serialize($res));
        if (!isset($res['additional_status']) || $res['additional_status'] != 0) {
            throw new Exception("Не принят");
        }
        return $res['order_id'];
    }

    public static function getPaymentStatus($apikey, $id) {        
        return true;
    }

    public static function getStatus($apikey, $id) {
        
        
        
        
        
        
        
        
        
        
        return true;
    }
}
