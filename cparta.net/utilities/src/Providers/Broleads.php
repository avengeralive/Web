<?php

class Providers_Broleads {
    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($url, $requestQuery) {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestQuery);
        $result = curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        // self::telegram($result);
        return $http_code;
        
    }
    
    public static function registerLead($stream, $zakaz) {
        $url = 'https://broleads.com/api/v1/order';
        $landing = "Bro-Bro";
        
        if ($name == '') {
            $name = 'Заказчик';
        }
        if ($phone == '') {
            $phone = 0;
        }
        
        $api_key = '631c39fd1hyte3thKEYzazaza762267078a03';
        $arHash = [ 
            $zakaz->user_id,
            $zakaz->id,
            $api_key
        ];

        $sign_hash = strtoupper(md5(implode(":", $arHash)));
        
        $param = [
            'stream' => $stream,
            'landing' => $landing,
            'country' => $zakaz->short_country,
            'name' => $zakaz->name,
            'phone' => $zakaz->phone,
            'ip' => $zakaz->ip,
            'user-agent' => $zakaz->useragent,
            'sub1' => $zakaz->user_id,
            'sub2' => $sign_hash,
            'clickid' => $zakaz->id,
        ];

        $res = self::request($url, $param);  

        $logger = Registry::get('di')->logger;
        $logger->custom('BROLEADS', $zakaz->id . ', '. serialize($res));
        
        if (!isset($res) || $res != 200) {
            throw new Exception("Не принят");
        }
        return $zakaz->id;
    }

    public static function getPaymentStatus($apikey, $id) {        
        return true;
    }

    public static function getStatus($apikey, $id) {
        return true;
    }
}
