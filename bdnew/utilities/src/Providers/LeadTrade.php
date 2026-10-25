<?php

//b61dc580107d8ea4f17fb4b9b9390277
class Providers_LeadTrade {

    protected static function request($uri, $userAgent, $order = array()) {
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($curl, CURLOPT_URL, $uri);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $order);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        try {
            $responseBody = curl_exec($curl);
            // тело оказалось пустым
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
            if (!$response->success) {
                throw new Exception('Invalid: Order processing error. ');
            }
            curl_close($curl);

            return $response;
            
        } catch (Exception $e) {
            throw new Exception(date('Y.m.d H:i:s') .' ' . $e->getMessage() . PHP_EOL . $e->getTraceAsString());
        }
    }
    
    public static function registerLead(Zakaz $zakaz, $target, $good_id) {
        
        $url = 'http://leadtrade.ru/api/send_lead';
        
        $order = [
            'name' => $zakaz->name,
            'phone' => $zakaz->phone,
            'mm' => 1,
            'aim' => $target,
            'productsum' => $zakaz->cena,
            'hash' => $good_id,
            'ip' => $zakaz->ip,
        ];
   
        $res = self::request($uri, $zakaz->useragent, $order);
        $res = @json_decode($res);
        if (!isset($res->lead)) {
            throw new Exception("Не принят");
        }
        return $res->lead;
    }

    public static function getStatus($order_id) {
        $api_key = '8e712991360a3e7b298f95c50f871c61750a9451';
        $url = 'http://leadtrade.ru/api/get_order/?api_key='.$api_key.'&order_ids='.$order_id;
        $result = file_get_contents($url); 
        $res = @json_decode($result);
        if (!isset($res->success) || $res->success != true || !isset($res->orders)) {
            throw new Exception($res->error_message);
        }
        return $res->orders;  
    }

    public static function getPaymentStatus($wm_id, $wm_key, $order_id) {
        return true;
    }

}
