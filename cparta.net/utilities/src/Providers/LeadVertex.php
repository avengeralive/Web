<?php

class Providers_LeadVertex {
    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($http_method, $method, $sub, $token, $vars = array()) {
        $url = 'https://'.$sub.'.leadvertex.ru/api/admin/'.$method.'.html?token='.$token;
        if ($http_method == 'get') {
            $url .= '&' . http_build_query($vars);
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
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. $url);
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. http_build_query($vars));
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. serialize($data));
            
        return json_decode($data);
    }

    protected static function request2($http_method, $method, $sub, $token, $ids) {
        $url = 'https://'.$sub.'.leadvertex.ru/api/admin/'.$method.'.html?ids='.$ids.'&token='.$token.'';
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. $url);
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. http_build_query($vars));
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. serialize($data));
        return json_decode($data);
    }

    public static function registerLead($sub, $token, $zakaz, $offername, $id_l = NULL) {
        $vars = array();
        $vars['fio'] = $zakaz->name;
        $vars['phone'] = $zakaz->phone;
        $vars['comment'] = $zakaz->artikul;
        $vars['ip'] = $zakaz->ip;
        $vars['country'] = $zakaz->country;
        $vars['region'] = $zakaz->region;
        $vars['city'] = $zakaz->town;
        $vars['externalWebmaster'] = $zakaz->externalWebmaster;
        $vars['externalID'] = $zakaz->externalId;
        $vars['referer'] = $zakaz->referer;
        $vars['total'] = $zakaz->cena;
        $vars['additional2'] = $zakaz->user_id;
        $vars['additional3'] = $zakaz->id;
        $vars['domain'] = Offer_Landing::getById( $zakaz->landing_id )->url;
        $vars['webmasterID'] = 21;

        if(!empty($id_l)){
            $data = array(
                0 => array(
                    'goodID' => $id_l,
                    'quantity' => '1',
                    'price' => $zakaz->cena
                ),
            );
            $vars['goods'] = $data;
        }
        // $vars['additional5'] = $zakaz->user_id;

        $res = self::request('post', 'addOrder', $sub, $token, $vars);
        $idle = 0;
        if(!empty($res)){
            foreach ($res as $key => $value) {
                $idle = $key;
                if($value != 'OK'){
                    $logger = Registry::get('di')->logger;
                    $logger->custom('LeadVertex', $zakaz->id . '-'. $res);
                    throw new Exception("Не принят");
                }
            }
        }
        return $idle;
    }

    public static function getPaymentStatus($sub, $token, $id) {
        $res = self::request2('get', 'getOrdersByIds', $sub, $token, $id);
        if (!isset($res->$id)) {
            throw new Exception("Bad Request");
        }
        $data = $res->$id;
        return $data->payment->status;
    }

    public static function getStatus($sub, $token, $id) {
        $res = self::request2('get', 'getOrdersByIds', $sub, $token, $id);
        if (!isset($res->$id)) {
            throw new Exception("Bad Request");
        }
        $data = $res->$id;
        return $data;
    }

}
