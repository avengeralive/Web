<?php
//провайдер нашей срм
class Providers_CpaMVP {

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($method, $vars = array()) {
        $url = 'https://api.cpamvp.site/v1/order/';
        if($method == 'status'){
            $url .= $vars['id']."/status/?key=".$vars['key'];
        }
        $ch = curl_init($url);
        if($method != 'status'){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        // self::telegram($data);
        return json_decode($data);
    }

    public static function registerLead($stream ,$apikey, $zakaz) {
        $vars = array();
        $vars['key']            = $apikey;
        $vars['stream']         = $stream;
        $vars['ip']             = $zakaz->ip;
        $vars['clientname']     = $zakaz->name;
        $vars['phone']          = $zakaz->phone;
        $vars['comments']       = $zakaz->artikul;
        $vars['subid1']         = $zakaz->subid1;
        $vars['subid2']         = $zakaz->subid2;
        $vars['subid3']         = $zakaz->subid3;
        $vars['subid4']         = $zakaz->subid4;
        $vars['subid5']         = $zakaz->subid5;
        $vars['referer']        = $zakaz->referer;



        $res = self::request(NULL, $vars);
        if (!isset($res->id)) {
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. $res);
            throw new Exception("Не принят");
        }
        return $res->id;
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

    public static function getStatus($id,$apikey) {
        $vars = array();
        $vars['id']     = $id;
        $vars['key']    = $apikey;
        $res = self::request("status", $vars);
        if ($res->status != '200') {
            throw new Exception("Bad Request");
        }
        return $res;
    }

}
