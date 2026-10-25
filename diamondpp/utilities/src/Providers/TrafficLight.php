<?php
//провайдер Traffic Light
class Providers_TrafficLight {

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($http_method, $method, $vars = array()) {
        // $vars['key'] = '';
        $vars['key'] = '';
        $url = 'http://api.cpa.tl/api/lead/' . $method;
        if ($http_method == 'get') {
            $url .= '?' . http_build_query($vars);
        }
        $ch = curl_init($url);
        if ($http_method == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        
        return json_decode($data);
    }

    public static function registerLead($offerID, $zakaz) {
        $vars = array();
        //$vars['key'] = '';
        $vars['id'] = $zakaz->id;
        $vars['offer_id'] = $offerID;
        //$vars['stream_hid'] = '';
        $vars['ip_address'] = $zakaz->ip;
        $vars['name'] = $zakaz->name;
        $vars['phone'] = $zakaz->phone;
        $vars['comments'] = $zakaz->artikul;
        $vars['country'] = $zakaz->country;
        //$vars['address'] = '';
        //$vars['tz'] = '+3';
        $vars['web_id'] = $zakaz->user_id;
        //$vars['domain2'] = $zakaz->referer;
        
        $res = self::request('post', 'send', $vars);
        var_dump($res);
        if (!isset($res->id)) {
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. $res->errmsg);
            throw new Exception("Не принят");
        }
        return $res->id;
        //return true;
    }

    public static function getPaymentStatus($id) {
        $vars = array();
        //$vars['key'] = '';
        $vars['id'] = $id;
        $res = self::request('get', 'feed', $vars);
        if (!isset($res->id)) {
            throw new Exception("Bad Request");
        }
        return $res;
    }

    public static function getStatus($id) {
        $vars = array();
        //$vars['key'] = '';
        $vars['id'] = $id;
        $res = self::request('get', 'feed', $vars);
        //var_dump($res->leads[0]);
        if (!isset($res->leads[0])) {
            // throw new Exception("Bad Request");
            return '';
        }
        return $res->leads[0];
    }

}
