<?php

class Providers_Сpagetti {

    protected static function request($uri, $headers = array(), $order = array()) {
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
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

    public static function registerLead($name, $country, $phone, $ip, $offer_id, $userAgent, $referer, $order_id, $good_id, $apikey) {
        
        $uri = 'http://cpagetti.com/api/order/register';
        
        $arHash = [ 
            $order_id,
            $offer_id,
            $apikey
        ];
        $sign_hash = strtoupper(md5(implode(":", $arHash)));
        
        $order = [
            'api_key' => $apikey,
            'name' => $name,
            'phone' => $phone,
            'offer_id' => $good_id,
            'country' => $country,
            'ip' => $ip,
            'sub1' => $order_id,
            'sub2' => $offer_id,
            'sub3' => $sign_hash
        ];
        $headers = [
            "Host" => $uri,
            "User-Agent" => $userAgent,
            "Accept" => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            "Accept-Language" => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
            "Keep-Alive" => '15',
            "Connection" => "keep-alive",
            "Referer" => $referer,
        ];

        $res = self::request($uri, $headers, $order);

        if (!isset($res->id)) {
            throw new Exception("Не принят");
        }
        return $res->id;
    }

    public static function getPaymentStatus($token, $id) {
        return;
    }

    public static function getStatus($id) {
        return;
    }

}
