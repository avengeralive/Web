<?php

class Providers_TeleSales {

    public static function registerLead($settings, $fio, $phone, $ip) {
        $vars = array();
        $url = 'https://dashboard.telesales-cc.ru/api/order/store?' . http_build_query([
                    'api_token' => $settings['token'],
                    'order_offer_id' => $settings['offer_id'],
                    'order_webmaster_id' => $settings['webmaster_id'],
                    'order_client_name' => $fio,
                    'order_client_phone' => $phone,
                    'order_client_geo_ip' => $ip,
                    'order_cc_process' => 1,
                    'order_advert_id' => $settings['advertiser'],
        ]);


        $data = file_get_contents($url);
        $res = json_decode($data);

        if (!isset($res->data->order_id)) {
            throw new Exception("Не принят");
        }
        return $res->data->order_id;
    }

    public static function getPaymentStatus($token, $id) {
        $url = 'https://dashboard.telesales-cc.ru/api/order/view/' . $id . '?api_token=' . $token;
        $data = file_get_contents($url);
        $res = json_decode($data);

	if(isset($res->code) && $res->code==500) return false;

        if (empty($res) || !@isset($res->data[0])) {
            throw new Exception("Bad Request");
        }

        return $res->data[0];
    }

    public static function getStatus($token, $id) {
        return $this->getPaymentStatus($token, $id);
    }

}
