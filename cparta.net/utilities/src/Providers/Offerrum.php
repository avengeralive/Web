<?php
//провайдер Offerrum
class Providers_Offerrum {
    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($apikey, $flow, $subid = array(), $vars = array()) {
        $subid = implode(':', [$subid[0], $subid[1], $subid[2], $subid[3], $subid[4]]);
        $url = "https://api.offerrum.com/webmaster/order/?key={$apikey}&flow={$flow}&subid={$subid}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $data = curl_exec($ch);
        return json_decode($data);
    }

    public static function registerLead($offerID, $apikey, $zakaz) {
        $vars = array();
        $vars['country'] = '';
        $vars['fio'] = $zakaz->name;
        $vars['phone'] = $zakaz->phone;
        $vars['user_ip'] = $zakaz->ip;
        $vars['user_agent'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36 OPR/66.0.3515.60';
        $vars['order_time'] = time();
        $subid[0] = $zakaz->subid1;
        $subid[1] = $zakaz->subid2;
        $subid[2] = $zakaz->subid3;
        $subid[3] = $zakaz->subid4;
        $subid[4] = $zakaz->subid5;
        $flow = $offerID;

        $res = self::request($apikey, $flow, $subid, $vars);

        if (!isset($res->response->status) && $res->response->status != "ok") {
            $logger = Registry::get('di')->logger;
            $logger->custom('Offerrum', $zakaz->id . '-');
            throw new Exception("Не принят");
        }
        return $res->response->order_id;
    }

    public static function getPaymentStatus($id) {
        $vars = array();
        //$vars['key'] = 'aUr3dhYU6MHC6l1C98f7MhNjtJI24HywWxNjDBqPBMU1rQN9sZ';
        $vars['id'] = $id;
        $res = self::request('get', 'feed', $vars);
        if (!isset($res->id)) {
            throw new Exception("Bad Request");
        }
        return $res;
    }

    public static function getStatus($id) {
		//https://1v1-crm.ru/json/?func=api&action=status&id=15000009
        $vars = array();
        //$vars['key'] = 'aUr3dhYU6MHC6l1C98f7MhNjtJI24HywWxNjDBqPBMU1rQN9sZ';
        $vars['id'] = $id;
        $res = self::request('get', 'feed', $vars);
        //var_dump($res->leads[0]);
        if (!isset($res->leads[0])) {
            throw new Exception("Bad Request");
        }
        return $res->leads[0];
    }

}
