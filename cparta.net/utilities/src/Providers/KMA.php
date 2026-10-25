<?php

//b61dc580107d8ea4f17fb4b9b9390277
class Providers_KMA {

    const API_KEY = '6ezWKdoDViCrXZnpbF2ROO6dH9nMmRHO';
    const URL = 'https://api.kma.biz/';

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($method, $vars = array()) {
        /*$vars['authid'] = self::API_ID;
        $vars['method'] = $method;
        $vars['authhash'] = self::API_KEY;
        $url = self::URL . '?' . http_build_query($vars);
        $data = @file_get_contents($url);
        self::telegram($data);
        $json = @json_decode($data);
        */
        if ($method == 'getstatuses') {
            $responseBody = file_get_contents(self::URL.'?method=getstatuses&token='.self::API_KEY.'&ids='.$vars['ids']);
            $json = json_decode($responseBody);
            // self::telegram($responseBody);
            return $json;
        }
        $headers = [
            "Authorization: Bearer ".self::API_KEY,
            "Content-Type: application/x-www-form-urlencoded"
        ];
        //self::telegram();
        $curl = curl_init(self::URL.$method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($vars));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $responseBody = curl_exec($curl);
        //self::telegram($responseBody);
        $json = json_decode($responseBody);
        return $json;
    }

    public static function registerLead($streamID, $clientName, $clientPhone, $clientIp, $referer, $webmaster) {
        $vars = array();
        $vars['channel'] = $streamID;
        $vars['phone'] = $clientPhone;
        $vars['ip'] = $clientIp;
        $vars['name'] = $clientName;
        $vars['country'] = 'RU';
        $vars['referer'] = $referer;
        $vars['data1'] = $webmaster;
        $res = self::request('lead/add', $vars);
        if ($res->code != 0) {
            throw new Exception($res->msg);
        }
        return $res->order;
    }

    public static function getStatus($hash) {
        $res = self::request('getstatuses', [
                    'ids' => $hash,
        ]);
	$data=$res;
        if (!isset($data->statuses)) {
            throw new Exception("Bad request. no status");
        }
        $res = array_pop($data->statuses);
        return $res->status;
    }

    public static function getPaymentStatus($hash) {
        return;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

