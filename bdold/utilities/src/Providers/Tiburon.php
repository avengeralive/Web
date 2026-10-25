<?php

//b61dc580107d8ea4f17fb4b9b9390277
class Providers_Tiburon {

    const API_KEY = '7b4765e82ed9800accbeb8115f23eedc';
    const URL = 'http://silomax.ru/index.php?route=product/api';

    protected static function request($method, $vars = array()) {
        $vars['key'] = self::API_KEY;
        $url = self::URL . $method;//. '&' . http_build_query($vars);

        $postdata = http_build_query($vars);

        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        $data = @file_get_contents($url, FALSE, $context);

        $json = @json_decode($data);

        return $json;
    }

    public static function registerLead($productName, $clientName, $clientPhone, $clientIp, $country, $city) {
        $vars = array();
        $vars['ip'] = $clientIp;
        $vars['city'] = $city;
        $vars['country'] = $country;
        $vars['name'] = $clientName;
        $vars['phone'] = $clientPhone;
        $vars['comment'] = $productName;

        $res = self::request('', $vars);

        if (!isset($res->order_id)) {
            throw new Exception("Ошибка регистрации.");
        }
        return $res->order_id;
    }

    public static function getStatus($hash) {
        $res = self::request('/get_status', [
                    'orders' => $hash,
        ]);
        $data = $res[0];
        if (!isset($data->status)) {
            throw new Exception("Bad request. no status");
        }
        
        return $data;
    }

    public static function getPaymentStatus($hash) {
        $res = self::request('/get_status', [
                    'orders' => $hash,
        ]);

        $data = $res[0];
        if (!isset($data->status)) {
            throw new Exception("Bad request. no status");
        }

        return $data;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

