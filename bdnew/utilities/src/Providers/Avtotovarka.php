<?php

class Providers_Avtotovarka {

    protected static function request($headers, $apikey, $vars = array()) {
        $url = 'https://api.autotovarka.ru/orders';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        return json_decode($data);
    }

    public static function registerLead($site_id, $flow_id, $zakaz) {

        $headers = [];
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
 /*       
name	<string>	имя покупателя	необязательно	Ульяна
phone	<string>	телефон покупателя	обязательно	79123456789
flow_id	<number>	ID потока	обязательно	1234
site_id	<number>	ID сайта	обязательно	1221
params	<string>	query-параметры	необязательно	utm_source=source&utm_medium=medium&utm_campaign=campaign&utm_term=term&utm_content=content&sub1=1&sub2=2&sub3=3&sub4=4&sub5=5
*/
        
        $vars = array();
        $vars['name'] = $zakaz->name;
        $vars['phone'] = $zakaz->phone;
        $vars['flow_id'] = $flow_id;
        $vars['site_id'] = $site_id;
        
        $vars['params'] = 'sub1='.$zakaz->id.'&sub2='.$zakaz->user_id;


        $res = self::request($headers, $apikey, $vars);  
        
        $logger = Registry::get('di')->logger;
        $logger->custom('Avtotovarka', serialize($res));
        
        if (!isset($res->id)) {
            throw new Exception("Не принят");
        }
        return $res->id;
    }

    public static function getPaymentStatus($apikey, $id) {        
        return true;
    }

    public static function getStatus($apikey, $id) {
        return true;
    }

}
