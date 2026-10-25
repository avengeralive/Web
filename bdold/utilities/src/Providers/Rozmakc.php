<?php

class Providers_Rozmakc {

    protected static function request($url, $vars = array()) {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $responseBody = curl_exec($curl);
        curl_close($curl);
        $json = @json_decode($responseBody);
        
                $logger = Registry::get('di')->logger;
                $logger->custom('Rozmakc', $responseBody);
        
        return $json;
    }

    public static function registerLead($api_key, $offer, $zakaz) {
        
        $url = 'http://api.roz-yes.ru/v1/order/';
        
        $vars = array();
        $vars['key'] = $api_key;
        $vars['offer_id'] = $offer;
        $vars['clientname'] = $zakaz->name;
        $vars['phone'] = $zakaz->phone;
        $vars['email'] = $zakaz->email;
        $vars['ip'] = $zakaz->ip;
        $vars['user_agent'] = $zakaz->useragent;
        $vars['referer'] = $zakaz->referer;
        $vars['sub1'] = $zakaz->subid1;
        $vars['sub2'] = $zakaz->subid2;
        $vars['sub3'] = $zakaz->subid3;

        $res = self::request($url, $vars);
        if (!isset($res->id)) {
            throw new Exception('error');
        }
        return $res->id;
    }

    public static function getStatus($api_key,$id) {
        $url = 'http://api.roz-yes.ru/v1/order/'.$id.'/status';
        
        $vars = array();
        $vars['key'] = $api_key;

        $res = self::request($url, $vars);
        if (!isset($res->status)) {
            throw new Exception('error');
        }
        return $res;
    }

    public static function getPaymentStatus($wm_id, $wm_key, $order_id) {
        return static::getStatus($wm_id, $wm_key, $order_id);
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

