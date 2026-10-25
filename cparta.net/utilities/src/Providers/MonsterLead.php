<?php

class Providers_MonsterLead {

    const API_KEY = '54389015e74c7d3b15953295200ac0ff';
    const URL = 'http://api.monsterleads.pro/method/';

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($method, $vars = array()) {
        $vars['format'] = 'json';
        $vars['api_key'] = self::API_KEY;
        $url = self::URL . $method . '?' . http_build_query($vars);
        $data = @file_get_contents($url);
        //self::telegram($data);
        $json = @json_decode($data);

        return $json;
    }

    public static function registerLead($leadCode, $clientName, $clientPhone, $clientIp, $sn = '') {
        $vars = array();
        $vars['code'] = $leadCode;
        $vars['tel'] = $clientPhone;
        $vars['ip'] = $clientIp;
        $vars['client'] = $clientName;
        $vars['traffic_type'] = 0;
        if( $sn !=''){
            $vars['comments'] = $sn;
        }

        $res = self::request('order.add', $vars);
        if (!isset($res->lead_hash)) {
            throw new Exception($res->error_msg);
        }
        return $res->lead_hash;
    }

    public static function getStatus($hash) {
        $res = self::request('lead.list', [
                    'search_by' => 'hash',
                    'lead_list' => $hash,
        ]);
        if (!is_array($res)) {
            throw new Exception("Bad request");
        }
        $data = $res[0];
        if (!isset($data->status)) {
            throw new Exception("Bad request. no status");
        }
        return $data;
    }
    public static function getPaymentStatus($hash) {
        $res = self::request('lead.list', [
                    'search_by' => 'hash',
                    'lead_list' => $hash,
        ]);
        if (!is_array($res)) {
            throw new Exception("Bad request");
        }
        $data = $res[0];
        if (!isset($data->paid)) {
            throw new Exception("Bad request. no status");
        }
        return $data->paid;
    }

}
