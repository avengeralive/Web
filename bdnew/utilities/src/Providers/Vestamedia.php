<?php

class Providers_Vestamedia {
    
    /*
        
        http://ultrametabolismo.life/api/yes-cpa/get.php

        
        https://www.ultraslim.life/api/yes-cpa/get.php
    */

    protected static function request($uri, $order = array()) {
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $uri);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $order);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        try {
            $responseBody = curl_exec($curl);
            //тело оказалось пустым
            if (empty($responseBody)) {
                throw new Exception(date('Y.m.d H:i:s') . 'Error: Empty response for order.');
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
            $logger->custom('Vestamedia', $responseBody);
            return $response;
            
        } catch (Exception $e) {
            throw new Exception(date('Y.m.d H:i:s') .' ' . $e->getMessage() . PHP_EOL . $e->getTraceAsString());
        }
    }

    public static function registerLead($name, $phone, $offer_id, $order_id, $apikey) {

        if($offer_id == 324){
            $uri = 'https://ultrametabolismo.life/';
            $uri_req = 'http://www.ultrametabolismo.life/api/yes-cpa/post.php';
        }elseif($offer_id == 325){
            $uri = 'https://www.ultraslim.life';
            $uri_req = 'https://www.ultraslim.life/api/yes-cpa/post.php';
        }       
        
        $order = [
            'api_key' => $apikey,
            'name' => $name,
            'phone' => $phone,
            'url' => $uri,
            'user_id' => '59de92f6d28f32d15fd2201911d27a2e',
            'order_id' => $order_id
        ];

        $res = self::request($uri_req, $order);
        if (!isset($res->order_id)) {
            throw new Exception("Не принят");
        }
        return $res->order_id;
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
