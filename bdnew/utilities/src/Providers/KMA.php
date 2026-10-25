<?php

//b61dc580107d8ea4f17fb4b9b9390277
class Providers_KMA {

    const API_ID = 523;
    const API_KEY = 'b61dc580107d8ea4f17fb4b9b9390277';
    const URL = 'http://api.kma1.biz/';

    protected static function request($method, $vars = array()) {
        $vars['authid'] = self::API_ID;
        $vars['method'] = $method;
        $vars['authhash'] = self::API_KEY;
        $url = self::URL . '?' . http_build_query($vars);
        $data = @file_get_contents($url);

        $json = @json_decode($data);

        return $json;
    }

    public static function registerLead($streamID, $clientName, $clientPhone, $clientIp) {
        $vars = array();
        $vars['channel'] = $streamID;
        $vars['phone'] = $clientPhone;
        $vars['ip'] = $clientIp;
        $vars['name'] = $clientName;


        $res = self::request('addlead', $vars);
        if (!isset($res->orderid)) {
            throw new Exception($res->msg);
        }
        return $res->orderid;
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

