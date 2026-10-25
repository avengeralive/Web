<?php

class Providers_Ctr {

    protected static function request($method, $apikey, $vars = array()) {
        $url = 'https://thank-you.pro/api.php?method='.$method.'&key='.$apikey;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        return json_decode($data);
    }

    public static function registerLead($site_id, $apikey, $zakaz) {
        
        $vars = array();
        $vars['fio'] = $zakaz->name;
        $vars['phone'] = $zakaz->phone;
        $vars['site_id'] = $site_id;
        $vars['out_order_id'] = $zakaz->id;
        $vars['country'] = $zakaz->short_country;
        $vars['ip'] = $zakaz->ip;
        $vars['ua'] = $zakaz->useragent;
        $vars['sub_id'] = $zakaz->user_id;
        //$vars['ua'] = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36';
        

        $res = self::request('order_add', $apikey, $vars);  
        
        $logger = Registry::get('di')->logger;
        $logger->info('CTR_CHECK#' . $zakaz->id . ', '. serialize($res));
        
        if (!isset($res->result->success) or $res->result->success !== true) {
            throw new Exception("Не принят");
        }
        return $res;
    }

    public static function getPaymentStatus($apikey, $id) {        
        $url = 'http://ctr.ru/api.php?key='.$apikey.'&method=get_delivery_status&out_order_ids='.$id; 
        $result = file_get_contents($url);             
        $data = json_decode($result);
        if (!isset($data->result->$id)) {
            throw new Exception("Bad Request");
        }
        return $data->result->$id;
    }

    public static function getStatus($apikey, $id) {
        $url = 'http://ctr.ru/api.php?key='.$apikey.'&method=get_order_status_with_comment&out_order_ids='.$id; 
        $result = file_get_contents($url); 
        
        $data = json_decode($result);

        if (!isset($data->result)) {
            throw new Exception("Bad Request");
        }
        return $data->result;
    }

}
