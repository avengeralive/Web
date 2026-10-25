<?php

class Providers_Shakes {

    const API_KEY = '5e8b3b8f460efe43e36dd3038a939caf';
    const URL = 'http://shakes.pro/index.php';

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($method, $vars = array()) {
        $url = self::URL . '?r='.$method.'&key=' . self::API_KEY;
        //$data = @file_get_contents($url);
        // self::telegram(json_encode($vars));
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$data = curl_exec($ch);
        // self::telegram($data);

        $json = @json_decode($data);

        return $json;
    }

    public static function registerLead($leadCode, \Zakaz $zakaz) {
        $vars = [
            'name' => $zakaz->name,
            'phone' => $zakaz->phone,
            'countryCode' => 'ru',
            'offerId' => explode('|', $leadCode)[1],
            'landingUrl' => 'https://cparta.online/',
            'ip' => $zakaz->ip,
            'createdAt' => $zakaz->date,
            'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36',
            'streamCode' => explode('|', $leadCode)[0],
            'sub1' => $zakaz->subid1,
            'sub2' => $zakaz->subid2,
            'sub3' => $zakaz->subid3,
            'sub4' => $zakaz->subid4,
            'referrer' => 'Cparta'
        ];

        $res = self::request('api/order/in', $vars);
        if ($res->status != 'ok') {
            throw new Exception($res->error_msg);
        }
        return $res->response;
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
