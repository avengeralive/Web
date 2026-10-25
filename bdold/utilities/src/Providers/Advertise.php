<?php

class Providers_Everad {

    protected static function request($vars = array()) {
        $url = 'http://lh.everad.ru/api/orders';
        $options = array ('http' => array ('header' => "Content-type: application/x-www-form-urlencoded\r\n", 'method'  => 'POST', 'content' => http_build_query($vars)));  
        $context  = stream_context_create($options);  
        $result = file_get_contents($url, false, $context); 
    }
    
    public static function registerLead($partner, $api_key, $good_id, $zakaz) {
        $vars = array();
        $vars['name'] = $zakaz->name;
        $vars['phone'] = $zakaz->phone;
        $vars['address'] = $zakaz->address;
        $vars['country_code'] = $zakaz->short_country;        
        $vars['offer_id'] = $good_id;  
        $vars['id'] = $zakaz->id;  
        $vars['token'] = $api_key;  
        $vars['partner_id'] = $partner;   
        
        self::request($vars);
        //$logger = Registry::get('di')->logger;
        //$logger->info('AUTOPAY#' . $res->order->order_id );
        $data = self::getStatus($api_key, $zakaz->id);
        if (!isset($data) or $data->status != 1) {
            throw new Exception("Не принят");
        }        
        return $zakaz->id;
    }

    public static function getStatus($api_key, $id) {
        $request =  'http://lh.everad.ru/api/orders/?id='.$id.'&token='.$api_key;
        $res = file_get_contents($request);
        $data = json_decode($res);
        if (!isset($data[0])) {
            throw new Exception("Bad Request");
        }        
        return $data[0];       
    }

}
