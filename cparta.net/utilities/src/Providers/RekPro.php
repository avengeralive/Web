<?php
//провайдер Traffic Light
class Providers_RekPro {
    protected static function request($http_method, $method, $vars = array()) {
        $vars['api_key'] = '057871ba195976dfcf6fa3f8640577f5';
        $url = 'http://rekl.pro/' . $method;
        if ($http_method == 'get') {
            $url .= '?' . http_build_query($vars);
        }
        $ch = curl_init($url);
        if ($http_method == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        //var_dump($url);
        //$x = json_decode($data);
        //file_put_contents('/var/www/www-root/data/www/blackdollar.ru/test.txt', $data);
        //die();
        return json_decode($data);
    }

    public static function registerLead($offerID, $zakaz) {
        $vars = array();
        //$vars['key'] = 'aUr3dhYU6MHC6l1C98f7MhNjtJI24HywWxNjDBqPBMU1rQN9sZ';
        $vars['secondid'] = $zakaz->id;
        $vars['offer_id'] = $offerID;
        //$vars['stream_hid'] = '';
        //$vars['ip_address'] = $zakaz->ip;
        $vars['name'] = $zakaz->name;
        $vars['phone'] = $zakaz->phone;
        $vars['model'] = $zakaz->artikul;
        $country = array(
            "Россия" => 0,
            "Беларусь" => 1,
            "Казахстан" => 2, 
            "Украина" => 3,
            "Киргизия" => 4,
            "Азербайджан" => 6,
            "Армения" => 14,
            "Узбекистан" => 15,
            "Италия" => 17,
            "Испания" => 18,
            "Германия" => 19
        );
        $vars['country'] = $country[$zakaz->country];
        //$vars['address'] = '';
        //$vars['tz'] = '+3';
        $vars['subid'] = $zakaz->user_id;
        //$vars['domain2'] = $zakaz->referer;
        
        $res = self::request('post', 'api_simple_order', $vars);
        var_dump($res);
        //file_put_contents('/var/www/www-root/data/www/blackdollar.ru/test.txt', $res);
        if ($res->status_code != 200) {
            //file_put_contents('/var/www/www-root/data/www/blackdollar.ru/test.txt', $res->errmsg);
            $logger = Registry::get('di')->logger;
            $logger->custom('RekPro', $zakaz->id . '-'. $res->status_text);
            throw new Exception("Не принят");
        }
        return $res->status_text;
        //return true;
    }
/*
    public static function getPaymentStatus($id) {
        $vars = array();
        //$vars['key'] = 'aUr3dhYU6MHC6l1C98f7MhNjtJI24HywWxNjDBqPBMU1rQN9sZ';
        $vars['id'] = $id;
        $res = self::request('post', 'api_status', $vars);
        if (!isset($res->id)) {
            throw new Exception("Bad Request");
        }
        return $res;
    }
*/

    public static function getStatus($id) {
        $vars = array();
        $vars['ids'] = $id;
        $res = self::request('post', 'api_status', $vars);
        if ($res->status_text != 200) {
            throw new Exception("Bad Request");
        }
        return $res->status_code[0];
    }

}
