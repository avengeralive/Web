<?php
//провайдер нашей срм
class Providers_1v1 {

    protected static function request($http_method, $method, $vars = array()) {
        $url = 'https://1v1-crm.ru/json/?func=api&action='. $method;
        if ($http_method == 'get') {
            $url .= '&' . http_build_query($vars);
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
        return json_decode($data);
    }

    public static function registerLead($offerID, $zakaz) {
        $vars = array();
        $vars['fio'] = $zakaz->name;
        $vars['phone'] = $zakaz->phone;
        $vars['comment'] = $zakaz->artikul;
        $vars['ip'] = $zakaz->ip;
        $vars['country'] = $zakaz->country;
        $vars['region'] = $zakaz->region;
        $vars['city'] = $zakaz->town;
        $vars['webmasterId'] = $zakaz->user_id;
        $vars['offerID'] = $offerID;
        $vars['domain2'] = $zakaz->referer;



        $res = self::request('get', 'cpa', $vars);
        if (!isset($res->OK)) {
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. $res);
            throw new Exception("Не принят");
        }
        return $res->OK;
    }

    public static function getPaymentStatus($id) {
        $vars = array();
        $vars['id'] = $id;
        $res = self::request('get', 'status', $vars);
        if (!isset($res->id)) {
            throw new Exception("Bad Request");
        }
        return $res;
    }

    public static function getStatus($id) {
		//https://1v1-crm.ru/json/?func=api&action=status&id=15000009
        $vars = array();
        $vars['id'] = $id;
        $res = self::request('get', 'status', $vars);
        if (!isset($res->id)) {
            throw new Exception("Bad Request");
        }
        return $res;
    }

}
