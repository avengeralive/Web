<?php

class Providers_ApiLeads {

    protected static $key = 'd6bc8c2b59de236981197ad7f419965f';

    protected static function request($method, $vars = array()) {
        $url = 'http://al-api.com/api/lead/' . $method . '?';
        $ch = curl_init($url);
        $headers = [];




        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($vars));
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        $data = curl_exec($ch);
        $logger = Registry::get('di')->logger;
        $logger->custom('apileads', var_export($data, 1));
        return json_decode($data);
    }

    public static function registerLead($name, $country, $phone, $ip, $offer_id) {
        $uid = 8852;
        $vars = array();
        $vars['name'] = $name;
        $vars['country'] = $country;
        $vars['phone'] = $phone;
        $vars['ip'] = $ip;
        $vars['user_id'] = $uid;
        $vars['offer_id'] = $offer_id;
        $vars['check_sum'] = sha1($uid . $offer_id . $name . $phone . self::$key);

        $res = self::request('create', $vars);
        if (!isset($res->id)) {
            throw new Exception("Не принят");
        }
        return $res->id;
    }

    public static function getPaymentStatus($token, $id) {
        return;
    }

    public static function getStatus($id) {
        $res = self::request('status', ['id' => $id, 'check_sum' => sha1($id . static::$key)]);
        if (empty($res)) {
            throw new Exception("Bad Request");
        }
        $data = $res;
        return $data;
    }

}
