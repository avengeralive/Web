<?php

class Providers_Luckyshop {

    protected static function request($vars = array(), $method) {
        $url = ' https://lucky.online/api-reseller/' . $method;
        $options = array ('http' => array ('header' => "Content-type: application/x-www-form-urlencoded\r\n", 'method'  => 'POST', 'content' => http_build_query($vars)));  
        $context  = stream_context_create($options);  
        $result = file_get_contents($url, false, $context);       
        $json = @json_decode($result);

        return $json;
    }
    
    public static function registerLead($good_id, $api_key, $zakaz) {
        
        if($zakaz->name == ''){$name = 'Заказчик';}else{$name = $zakaz->name;}
           
        $vars = array();
        $vars['api_key'] = $api_key;
        $vars['offer_id'] = $good_id;  
        $vars['user_id'] = $zakaz->user_id;
        $vars['name'] = $name;
        $vars['phone'] = $zakaz->phone;
        $vars['user_agent'] = $zakaz->useragent;
        $vars['ip'] = $zakaz->ip;
        
        $action = 'lead.html';
        $method = 'POST';
        
        $res = self::request($vars, $action);

        if (isset($res->errors)) {
            throw new Exception($res->errors->error_message);
        }

        return $res->data->click_id;
    }

    public static function getStatus($api_key, $click_id) {
        $action = 'lead-status.html?click_id='.$click_id.'&api_key='.$api_key;
        $method = 'GET';
        
        $res = self::request($vars, $action);
        if (isset($res->errors)) {
            throw new Exception($res->errors->error_message);
        }
        return $res;   
    }

}
