<?php

class Providers_Сpagetti {

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($uri, $headers = array(), $order = array()) {
        //self::telegram('START');
        $curl = curl_init($uri);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $order);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $responseBody = curl_exec($curl);
        //self::telegram($responseBody);
        $response = json_decode($responseBody);
        if (!$response->success) {
            throw new Exception('Invalid: Order processing error. ');
        }
        return $response;
        /*try {
            $responseBody = curl_exec($curl);
            self::telegram($responseBody);
            // тело оказалось пустым
            if (empty($responseBody)) {
                throw new Exception(date('Y.m.d H:i:s') . 'Error: Empty response for order.');
            }
            /**
             * @var StdClass $response
             */ 
            /*$response = json_decode($responseBody);
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
        }*/
    }

    public static function registerLead($name, $country, $phone, $ip, $offer_id, $userAgent, $referer, $order_id, $good_id, $stream, $apikey) {
        
        $uri = 'http://api.cpagetti.com/order/register';
        
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
            'stream_code' => $stream,
            'sub1' => $order_id,
            'sub2' => $offer_id,
            'sub3' => $sign_hash
        ];
        $headers = [
            "Host" => $uri,
            "User-Agent" => (!empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null),
            "Accept" => (!empty($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : null),
            "Accept-Language" => (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : null),
            "Keep-Alive" => '15',
            "Connection" => "keep-alive",
            "Referer" => (!empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null),
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
