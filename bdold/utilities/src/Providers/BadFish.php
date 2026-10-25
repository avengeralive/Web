<?php

class Providers_BadFish {
    
    /*
        https://83.222.117.42:6660/api/gate/v1/yescpa/create
    */

    protected static function request($uri, $type, $order = array(), $headers = array()) {
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $uri);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $responseBody = curl_exec($curl);
        curl_close($curl);
        
        
        try {
            
            $logger = Registry::get('di')->logger;
            $logger->custom('FISH', $responseBody);
            //тело оказалось пустым
            if (empty($responseBody)) {
                throw new Exception(date('Y.m.d H:i:s') . ' Err1or: Empty response for order.');
            }
            /**
             * @var StdClass $response
             */ 
            $response = json_decode($responseBody);
            // возможно пришел некорректный формат
            if (empty($response)) {
                throw new Exception('Error: Broken json format for order. ');
            }
            // заказ не принят API
            if (!$response->status || $response->status != 'ok') {
                throw new Exception('Invalid: Order processing error. ');
            }
            curl_close($curl);
            $logger = Registry::get('di')->logger;
            $logger->custom('FISH', $responseBody);
            return $response;
            
        } catch (Exception $e) {
            throw new Exception(date('Y.m.d H:i:s') .' ' . $e->getMessage() . PHP_EOL . $e->getTraceAsString());
        }
    }
    
    /*
"lead_id" - (integer, uniq) = ID-лида из Вашей системы.

"fio" - (string, max - 500 символов) = ФИО-клиента.

"phone" - (string или integer, max - 500 символов) = Телефон клиента.

"country" - (string или integer) = СТРОГО: 1 или "1" - РФ, 2 или "2" - Казахстан.

"ip" - (INET) = IP-адрес клиента (8.8.8.8).

"product_id" - (integer) = ID-товара из нашей системы (смот. пункт №2. Получение списка ID-товаров для отправки лидов).
     */
    

    public static function registerLead($name, $phone, $ip, $short_country, $order_id, $apikey) {

                    $uri = 'https://83.222.117.42:6660/api/gate/v1/yescpa/help';
                    $headers = [];
                    $headers[] = 'YESCPA-API-TOKEN: ' . $apikey;
                    
                    //$res = self::request($uri, 'get', $order=[], $headers);
                    
        $uri = 'https://83.222.117.42:6660/api/gate/v1/yescpa/help';
        $options = array ('http' => array ('header' => "YESCPA-API-TOKEN:" . $apikey, 'method'  => 'GET'));  
        $context  = stream_context_create($options);  
        $result = file_get_contents($url, false, $context);  
                    
            $logger = Registry::get('di')->logger;
            $logger->custom('FISH', $result);
        
        /*
        
        $uri = 'https://83.222.117.42:6660/api/gate/v1/yescpa/create';     
        
        if($short_country == 'KZ'){
            $country = 2;
        }else{
            $country = 1;
        }
        
        
        
        $order = [
            'lead_id' => $order_id,
            'fio' => $name,
            'phone' => $phone,
            'country' => $country,
            'ip' => $ip,
            'product_id' => $order_id
        ];

        $res = self::request($uri_req, $order);
        if (!isset($res->order_id)) {
            throw new Exception("Не принят");
        }
        return $res->order_id;
         * */
         
    }

    public static function getPaymentStatus($token, $id) {
        
        
        return;
    }

    public static function getStatus($apikey, $order_id, $offer_id) {
        
        if($offer_id == 324){
            $uri_req = 'http://www.ultrametabolismo.life/api/yes-cpa/get.php?ids=';
        }elseif($offer_id == 325){
            $uri_req = 'http://www.ultraslim.life/api/yes-cpa/get.php?ids=';
        }   
        $result = file_get_contents($uri_req); 
        $data = json_decode($result);
        if (!isset($data->order_id)) {
            throw new Exception("Bad Request");
        }
        return $data;
    }

}
