<?php

class Providers_M4l {

    protected static function request($url, $vars = array()) {
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url . http_build_query($vars));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result);
        
    }

    public static function registerLead($offerId, $partnerId, $token, $zakaz) {
        
        $vars = array();       
        
        $vars['fullName'] = $zakaz->name;
        $vars['phone'] = $zakaz->phone;
        $vars['offerId'] = $offerId;
        $vars['partnerId'] = $partnerId;
        $vars['price'] = $zakaz->cena;
        $vars['country'] = $zakaz->short_country;
        $vars['access-token'] = $token;
        $vars['ip'] = $zakaz->ip;
        //$vars['sub_id'] = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36';
        

        $res = self::request('http://api.m4leads.com/order/add?', $vars);  
        
        $logger = Registry::get('di')->logger;
        $logger->custom('m4L', serialize($res));
        
        if (isset($res->data->errors)) {
        
            $logger = Registry::get('di')->logger;
            $logger->custom('m4L', $res->data->errors);

            throw new Exception("Не принят");
        }
        return $res->data->orderId;
    }

    public static function getPaymentStatus($apikey, $id) {        
        return true;
    }

    public static function getStatus($res_id , $token) {
        $vars = array();       
        $vars['ordersId'] = $res_id;
        $vars['access-token'] = $token;
        
        $res = self::request('http://api.m4leads.com/order/get-order-status?', $vars);             
        
        if (!isset($res->data)) {
            throw new Exception("Bad Request");
        }
        return $res->data;
    }

}
