<?php
phpinfo();
class Providers_Advertise {

    protected static function request($vars = array(),$url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        return json_decode($data);
    }
    
    public static function registerLead() {
        $url = 'https://advertise.ru/api/?action=add_order&api_key=c04813f70409426b95d6d01c19cffe5b046202e5890a0b0b9bcf33e49a&format=3';       
        $vars = array();
        $vars['orders'][0]['name'] = 'ТЕСТ22';
        $vars['orders'][0]['phone'] = '+79520120000'; 
        $vars['orders'][0]['subid'] = '123555'; 
        $vars['code'] = '952513f70509426ba0eee424';   
        $data = json_encode($vars);
        $send = self::request($data,$url);
        //$logger = Registry::get('di')->logger;
        //$logger->info('AUTOPAY#' . $res->order->order_id );  
        return $send;
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

$api = new Providers_Advertise();
$send = $api->registerLead();
                         
echo '<pre>';
print_r($send);
echo '</pre>';
      