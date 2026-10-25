<?php

class Providers_likebz {

    //const API_KEY = '64515b31b3b7069df18f3dd9ec007238';
    const URL = 'http://likebz.ru/concentrat/partner/';

    protected static function request($vars = array()) {
        //$vars['format'] = 'json';
        //$vars['api_key'] = self::API_KEY;
        $url = self::URL . '?' . http_build_query($vars);
        $data = file_get_contents($url);

        //$json = @json_decode($data,true);

        return $data;
    }

    public static function registerLead($clientName, $clientPhone, $clientEmail) {
        $vars = array();
        //$vars['code'] = $leadCode;
        $vars['phone'] = $clientPhone;
        $vars['mail'] = $clientEmail;
        $vars['name'] = $clientName;
        $res = self::request($vars);
        $res = preg_replace("/[^0-9]/", '', $res);
        $lead_id = intval($res);
        return $lead_id;
    }

}
