<?php

//b61dc580107d8ea4f17fb4b9b9390277
class Providers_LeadTrade {
    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($uri, $userAgent, $order = array()) {       
        $ch = curl_init("https://leadtrade.ru/api/send_lead");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($order));
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.152 Safari/537.36");
        $doc = curl_exec($ch);
        curl_close($ch);
        return $doc;
    }
    
    public static function registerLead(Zakaz $zakaz, $target, $good_id) {
        $url = 'http://leadtrade.ru/api/send_lead';
        $order = [
            'name' => $zakaz->name,
            'phone' => $zakaz->phone,
            'aim' => $target,
            'productsum' => (int)$zakaz->cena,
            'hash' => $good_id,
            'subid1' => $zakaz->subid1,
            'subid2' => $zakaz->subid2,
            'subid3' => $zakaz->subid3,
            'subid4' => $zakaz->subid4,
            'subid5' => $zakaz->subid5,
            'ip' => $zakaz->ip,
        ];
        $res = self::request($uri, $zakaz->useragent, $order);
        // self::telegram("register ok");
        $res = @json_decode($res);
        // self::telegram(gettype($res));
        if (!isset($res->lead_id)) {
            throw new Exception("Не принят");
        }
        return $res->lead_id;
    }

    public static function getStatus($order_id) {
        $api_key = '';
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
