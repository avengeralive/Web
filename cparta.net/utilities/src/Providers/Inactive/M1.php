<?php

class Providers_M1 {

    protected static function request($vars = array(), $method) {
        $url = 'https://m1-shop.ru/' . $method;
        $options = array ('http' => array ('header' => "Content-type: application/x-www-form-urlencoded\r\n", 'method'  => 'POST', 'content' => http_build_query($vars)));  
        $context  = stream_context_create($options);  
        $result = file_get_contents($url, false, $context);         
        $json = @json_decode($result);
        return $json;
    }
    
    public static function registerLead($partner, $api_key, $good_id, $zakaz) {
        
        if($zakaz->name == ''){$name = 'Заказчик';}else{$name = $zakaz->name;}
        
        $vars = array();
        $vars['name'] = $name;
        $vars['phone'] = $zakaz->phone;
        $vars['ref'] = $partner;
        $vars['api_key'] = $api_key;
        $vars['product_id'] = $good_id;      
        $vars['ip'] = $zakaz->ip;
        
        $method = 'send_order';
        
        $res = self::request($vars, $method);
        
        if (!isset($res->result) || $res->result == 'error') {
            throw new Exception($res->message);
        }
        return $res->id;
    }

    public static function getStatus($partner, $api_key, $id) {
        $vars = array();
        $vars['id'] = $id;
        $vars['ref'] = $partner;
        $vars['api_key'] = $api_key;

        $method = 'get_order_status';
        $res = self::request($vars, $method);
        if (!isset($res->result) || $res->result == 'error') {
            throw new Exception($res->message);
        }
        return $res;   
    }

}
