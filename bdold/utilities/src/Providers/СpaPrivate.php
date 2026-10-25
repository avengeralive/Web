<?php

class Providers_СpaPrivate {

    protected static function request($url,$vars = array()) {
        $url .= '?' . http_build_query($vars);
        $logger = Registry::get('di')->logger;
        $logger->info('AUTOPAY#' . $url);        
        $result = file_get_contents($url); 
        
        return $result;
    }
    
    
    public static function registerLead($target, $goods, $zakaz) {
        $url = 'http://cpa-private.biz/handler';     
        $vars = array();
        $vars['target'] = $target;
        $vars['fio'] = $zakaz->name; 
        $vars['phone'] = $zakaz->phone; 
        $vars['goods'] = $goods.':1';
        $vars['ip'] = $zakaz->ip;
        $send = self::request($url,$vars);
        $send = json_decode($send);
        if (!isset($send->responce) || $send->responce != 'success') {
            throw new Exception("Не принят");
        }        
        
        return $send->id;
    }

    public static function getStatus($target, $order) {
        $request =  'http://api.cpa-private.biz/?method=getstatus&order_id='.$order.'&target='.$target;
        $res = file_get_contents($request);
        $data = json_decode($res);
        if (!isset($data->responce) || $data->responce != 'success') {
            throw new Exception("Bad Request");
        }        
        return $data;       
    }

}
