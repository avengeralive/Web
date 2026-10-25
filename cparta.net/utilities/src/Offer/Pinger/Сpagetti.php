<?php

class Offer_Pinger_Сpagetti extends Offer_Pinger {
    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    public function ping($settings, \Zakaz $zakaz) {
        list($good_id, $stream, $apikey) = explode(',', $settings);

        $hash = Providers_Сpagetti::registerLead($zakaz->name, $zakaz->short_country, $zakaz->phone, $zakaz->ip, $zakaz->offer_id, $zakaz->useragent, $zakaz->referer, $zakaz->id, $good_id, $stream, $apikey);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $hash
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }

}
