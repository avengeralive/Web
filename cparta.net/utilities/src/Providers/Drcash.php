<?php

class Providers_Drcash {

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($token, $post) {  
        // отправляем заявку
        $ch = curl_init('https://affiliate.drcash.sh/v1/order');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

        curl_setopt( $ch, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$token
            )
        );
        $x = curl_exec($ch);
        // self::telegram($x);
        $response = json_decode($x);
        curl_close($ch);
        
        return $response;
    }
    
    public static function registerLead($s, $token, $zakaz) {
        $post = [
            "stream_code" => $s,
            "client" => [
                'name' => $zakaz->name,
                'phone' => $zakaz->phone,
            ],
            'sub1' => $zakaz->id,
            'sub2' => $zakaz->user_id
        ];
        
        $response = self::request($token, $post);  
        
        $logger = Registry::get('di')->logger;
        $logger->custom('DRCASH', $zakaz->id . ', '. serialize($response));
        
        if (!isset($response->uuid)) {
            throw new Exception("Не принят");
        }
        
        return $response->uuid;
    }

    public static function getPaymentStatus($apikey, $id) {        
        return true;
    }

    public static function getStatus($apikey, $id) {
        return true;
    }
}
