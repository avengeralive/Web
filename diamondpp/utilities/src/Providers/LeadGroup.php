<?php

class Providers_LeadGroup {

    protected static function request($http_method, $method, $sub, $token, $vars = array()) {
        $url = 'https://' . $sub . '.leadgroup.su/api/admin/' . $method . '.html?token=' . $token;
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
        $data = curl_exec($ch); //var_dump($data);
            //$logger = Registry::get('di')->logger;
            //$logger->custom('LeadGroup', $zakaz->id . '-'. $url);
            //$logger = Registry::get('di')->logger;
            //$logger->custom('LeadGroup', $zakaz->id . '-'. http_build_query($vars));
            //$logger = Registry::get('di')->logger;
            //$logger->custom('LeadGroup', $zakaz->id . '-'. serialize($data));
        
        return json_decode($data);
    }

    protected static function request2($id, $sub, $token) {
        $url = 'https://' . $sub . '.leadgroup.su/api/getOrdersByIds.html?token='.$token.'&ids[]='.$id;
        //var_dump($url);
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch); //var_dump($data);
            /*$logger = Registry::get('di')->logger; //var_dump($logger);
            $logger->custom('LeadVertex', $id . '-'. $url);
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $id . '-'. serialize($data));*/
        
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
        $vars['externalWebmaster'] = $zakaz->user_id;
        $vars['externalID'] = $zakaz->id;
        $vars['referer'] = $zakaz->referer;
        
        /*if($zakaz->owner_id == 72){
            $vars['price'] = $zakaz->cena;
            $vars['total'] = $zakaz->cena;
            //$vars['additional1'] = $zakaz->id;
            $vars['additional3'] = $offername;
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
            $vars['additional5'] = $zakaz->user_id;
        }
	if($zakaz->owner_id == 999){
            $vars['price'] = $zakaz->cena;
            $vars['total'] = $zakaz->cena;

            $vars['domain'] = Offer_Landing::getById( $zakaz->landing_id )->url;
            $vars['additional1'] = $zakaz->user_id;
            $vars['additional2'] = $zakaz->id;
        }
	if($zakaz->owner_id == 998){
            $vars['price'] = $zakaz->cena;
            $vars['total'] = $zakaz->cena;

            $vars['domain'] = Offer_Landing::getById( $zakaz->landing_id )->url;
            $vars['additional1'] = $offername;
            $vars['additional10'] = $zakaz->user_id;
            $vars['additional12'] = $zakaz->id;
        }*/
        $res = self::request('post', 'addOrder', $sub, $token, $vars);
        //var_dump($res);
        $id = key($res);
        if ($res->$id != "OK") {
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadGroup', $zakaz->id . '-'. key($res));
            throw new Exception("Не принят");
        }
        return $id;
    }

    public static function getPaymentStatus($id, $settings) {
        list($id_l, $sub, $token) = explode(',', $settings);
        $res = self::request2($id, $sub, $token);
        $stat = self::request('get', 'getStatusList', $sub, $token, []);
        //var_dump($res);
        //if (!isset($res->$id)) {
        //    throw new Exception("Bad Request");
        //}
        //$data = $res->$id;
        $data = $stat->{$res->$id->status}->group;
        return $data;
    }

    public static function getStatus($id, $settings) {
        list($id_l, $sub, $token) = explode(',', $settings);
        $res = self::request2($id, $sub, $token);
        $stat = self::request('get', 'getStatusList', $sub, $token, []);
        //var_dump($stat->{$res->$id->status}->group);
        //if (!isset($res->$id)) {
        //    throw new Exception("Bad Request");
        //}
        //$data = $stat->{$res->$id->status}->group;
        //var_dump($res->$id); die();
        return $res->$id;
    }

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

}
