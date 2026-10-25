<?php

class Providers_RocketCall {

    protected static function request($http_method, $method, $token, $vars = array()) {
        $url = 'https://api.rocket-call.com/v1/public/' . $method . '?';
        if ($http_method == 'get') {
            $url .= '&' . http_build_query($vars);
        }
        $ch = curl_init($url);
        $headers = [];
        $headers[] = 'Token: ' . $token;


        if ($http_method == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($vars));
            $headers[] = 'Content-Type: application/json';
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $logger = Registry::get('di')->logger;
        $logger->custom('rc', var_export($vars, 1));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        $logger->custom('rc', var_export($data, 1));
        return json_decode($data);
    }

    public static function registerLead($pid, $token, $fio, $phone, $ip) {
        $vars = array();
        $vars['name'] = $fio;
        $vars['ip'] = $ip;
        $vars['status'] = 1;
        $vars['phone'] = $phone;
        $vars['date'] = date("Y-m-d H:i:s");
        $vars['product_id'] = $pid;
        $vars['products'] = [];
        $vars['api_id'] = 'Order ' . $phone;
        $vars['products'][] = [
            'product_id' => $pid,
            'count' => 1,
        ];

        $res = self::request('post', 'orders', $token, $vars);
        if (!isset($res->status) || $res->status !== true) {
            throw new Exception("Не принят");
        }
        return $res->data->id;
    }

    public static function getPaymentStatus($token, $id) {
        $res = self::request('post', 'orders/get', $token, ['ids' => $id]);
        if (empty($res)) {
            throw new Exception("Bad Request");
        }
        $data = $res[0];
        return $data->is_paid;
    }

    public static function getStatus($token, $id) {
        $res = self::request('post', 'orders/get', $token, ['ids' => $id]);
        if (empty($res)) {
            throw new Exception("Bad Request");
        }
        $data = $res[0];
        return $data;
    }

}
