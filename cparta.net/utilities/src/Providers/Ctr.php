<?php

class Providers_Ctr {

    const API_KEY = '33440abf889a6b7b57b209405d6979f0';

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($method, $post) { 
        if ($method == 'order') {
            $url = 'https://thank-you.pro/api.php?method=order_add&key='.self::API_KEY;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $x = curl_exec($ch);
            //self::telegram($x);
            $response = json_decode($x);
            curl_close($ch);
        }
        else {
            $url = 'http://ctr.ru/api.php?method=get_order_status&key='.self::API_KEY.'&out_order_ids='.$post;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $x = curl_exec($ch);
            // self::telegram($x);
            $response = json_decode($x);
            curl_close($ch);
        }
        
        
        return $response;
    }
    
    public static function registerLead($s, $zakaz) {
        $post = [
            'fio'          => $zakaz->name,
            'phone'        => $zakaz->phone,
            'site_id'      => $s,
            'out_order_id' => $zakaz->id,
            'country'      => 'RU',
            'ip'           => $zakaz->ip,
            'ua'           => 'UserAgent',
            'referer'      => $zakaz->referer
        ];

        $response = self::request('order', $post);  
        
        $logger = Registry::get('di')->logger;
        $logger->custom('CTR', $zakaz->id . ', '. serialize($response));
        
        if ($response->result->success == false) {
            throw new Exception("Не принят");
        }
        
        return $zakaz->id;
    }

    public static function getPaymentStatus($apikey, $id) {        
        return true;
    }

    public static function getStatus($zakaz) {
        $response = self::request('get_status', $zakaz->id);
        return $response->result->{$zakaz->id};
    }
}
