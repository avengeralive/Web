<?php

class Providers_eAutopay {

    protected static function request($user_api_key, $request, $vars = array()) {
        $url = 'https://api.e-autopay.com/v01/'.$user_api_key.'/orders'.$request;

        $requestArray = json_encode($vars);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestArray);      
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        return json_decode($data);
    }
    
    public static function registerLead($customer_api_key, $user_api_key, $good_id, $zakaz) {
        $vars = array();
        $vars['customer_api_key'] = $customer_api_key;
        $vars['order']['customer']['given_name'] = $zakaz->name;
        $vars['order']['customer']['country'] = $zakaz->short_country;
        $vars['order']['customer']['address'] = $zakaz->address;
        $vars['order']['customer']['email'] = $zakaz->email;
        $vars['order']['customer']['phone'] = $zakaz->phone;
        $vars['order']['credentials']['created'] = $zakaz->date;
        $vars['order']['credentials']['currency'] = 'руб';
        $vars['order']['basket'][0]['good_id'] = $good_id;
        $vars['order']['basket'][0]['cost'] = $zakaz->cena;
        $vars['order']['basket'][0]['quantity'] = 1;       

        $res = self::request($user_api_key, '', $vars);
        //$logger = Registry::get('di')->logger;
        //$logger->info('AUTOPAY#' . $res->order->order_id );
        if (!isset($res)) {
            throw new Exception("Не принят");
        }
        return $res->order->order_id;
    }

    public static function getPaymentStatus($customer_api_key, $user_api_key, $id) {
        $request =  'https://api.e-autopay.com/v01/'.$user_api_key.'/orders/'.$id.'?{"customer_api_key":"'.$customer_api_key.'"}';
        $res = file_get_contents($request);
        $data = json_decode($res);
        if (!isset($data->order)) {
            throw new Exception("Bad Request");
        }

        return $data->order; 
    }

    public static function getStatus($customer_api_key, $user_api_key, $id) {
        $request =  'https://api.e-autopay.com/v01/'.$user_api_key.'/orders/'.$id.'?{"customer_api_key":"'.$customer_api_key.'"}';
        $res = file_get_contents($request);
        $data = json_decode($res);
        if (!isset($data->order)) {
            throw new Exception("Bad Request");
        }
        
        return $data->order;         
    }

}
