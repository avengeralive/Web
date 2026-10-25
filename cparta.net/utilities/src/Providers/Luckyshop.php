<?php

class Providers_Luckyshop {

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    protected static function request($vars = array(), $method, $api_key) {
        $url = 'https://lucky.online/api-webmaster/' . $method . '?api_key='. $api_key;
        //self::telegram(json_encode($vars));
        if ($method == 'lead-status-batch.html') {
            // self::telegram('OK'); 
            $url .= '&click_id='.$vars['click_id'];
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $responseBody = curl_exec($curl);
            $result = file_get_contents($url); 
            //self::telegram($result);
        }
        else {
            $options = array ('http' => array ('header' => "Content-type: application/x-www-form-urlencoded\r\n", 'method'  => 'POST', 'content' => http_build_query($vars)));  
            $context  = stream_context_create($options);  
            $result = file_get_contents($url, false, $context); 
        }
        //self::telegram($result);
        $json = @json_decode($result);

        return $json;
    }
    
    public static function registerLead($good_id, $api_key, $zakaz) {
        
        if($zakaz->name == ''){$name = 'Заказчик';}else{$name = $zakaz->name;}
           
        $vars = array();
        //$vars['offer_id'] = $good_id;  
        //$vars['user_id'] = $zakaz->user_id;
        $vars['campaignHash'] = $good_id;
        $vars['country_call'] = 'RU';
        $vars['name'] = $name;
        $vars['phone'] = $zakaz->phone;
        $vars['userAgent'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36 OPR/66.0.3515.60';
        $vars['ip'] = $zakaz->ip;
        
        $action = 'lead.html';
        $method = 'POST';
        
        $res = self::request($vars, $action, $api_key);

        if (isset($res->errors)) {
            throw new Exception($res->errors->error_message);
        }

        return $res->data->click_id;
    }

    public static function getStatus($api_key, $click_id) {
        //self::telegram($click_id);
        //$action = 'lead-status.html?click_id='.$click_id.'&api_key='.$api_key;
        //$method = 'GET';
        $vars['click_id'] = $click_id;
        $res = self::request($vars, 'lead-status-batch.html', $api_key);
        if (isset($res->errors)) {
            throw new Exception($res->errors->error_message);
        }
        return $res;   
    }

}
