<?php

class Providers_Affbay {

    protected static function request($vars = array()) {
        $url = 'https://efirstpanel.com/api/make/contact';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        return json_decode($data);
    }

    public static function registerLead($site_id, $apikey, $zakaz) {
        
        $vars = array();
        $vars['first_name'] = $zakaz->name;
        $vars['phone'] = $zakaz->phone;
        $vars['click_id'] = $zakaz->id;
        $vars['token'] = $apikey;
        $vars['product'] = $site_id;
        //$vars['ua'] = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36';

        $res = self::request($vars);  
        
        $logger = Registry::get('di')->logger;
        $logger->custom('AFFBAY', $zakaz->id . ', '. serialize($res));
        
        if (!isset($res->status) or $res->status == 'required fields missing' or $res->status == 'invalid product name' or $res->status == 'double phone' or $res->status == 'client not found, token mismatch') {
            throw new Exception($res->status);
        }
        return $res;

    }

    public static function getPaymentStatus($apikey, $id) {        
        return true;
    }

    public static function getStatus($apikey, $id) {
        return true;
    }

}
