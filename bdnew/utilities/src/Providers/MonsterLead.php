<?php

class Providers_MonsterLead {

    const API_KEY = '64515b31b3b7069df18f3dd9ec007238';
    const URL = 'http://api.monsterleads.pro/method/';

    protected static function request($method, $vars = array()) {
        $vars['format'] = 'json';
        $vars['api_key'] = self::API_KEY;
        $url = self::URL . $method . '?' . http_build_query($vars);
        $data = @file_get_contents($url);

        $json = @json_decode($data);

        return $json;
    }

    public static function registerLead($leadCode, $clientName, $clientPhone, $clientIp, $sn = '') {
        $vars = array();
        $vars['code'] = $leadCode;
        $vars['tel'] = $clientPhone;
        $vars['ip'] = $clientIp;
        $vars['client'] = $clientName;
        if( $sn !=''){
            $vars['comments'] = $sn;
        }

        $res = self::request('order.add', $vars);
        if (!isset($res->lead_hash)) {
            throw new Exception($res->error_msg);
        }
        return $res->lead_hash;
    }

    public static function getStatus($hash) {
        $res = self::request('lead.list', [
                    'search_by' => 'hash',
                    'lead_list' => $hash,
        ]);
        if (!is_array($res)) {
            throw new Exception("Bad request");
        }
        $data = $res[0];
        if (!isset($data->status)) {
            throw new Exception("Bad request. no status");
        }
        return $data;
    }
    public static function getPaymentStatus($hash) {
        $res = self::request('lead.list', [
                    'search_by' => 'hash',
                    'lead_list' => $hash,
        ]);
        if (!is_array($res)) {
            throw new Exception("Bad request");
        }
        $data = $res[0];
        if (!isset($data->paid)) {
            throw new Exception("Bad request. no status");
        }
        return $data->paid;
    }

}
