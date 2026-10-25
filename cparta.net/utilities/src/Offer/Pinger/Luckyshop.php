<?php

class Offer_Pinger_Luckyshop extends Offer_Pinger {
    const API_KEY = '5e78ef118b5cf820212326764488';

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    public function ping($settings, \Zakaz $zakaz) {
        list($good_id, $api_key, $id) = explode(',', $settings);
        //self::telegram("START PING");
        $offer = Offer::getById($zakaz->offer_id);
        
        $id = Providers_Luckyshop::registerLead($good_id, self::API_KEY, $zakaz);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$good_id, $api_key, $id])
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        
        list($good_id, $api_key, $id) = explode(',', $zakaz->pinger_value);

        $data = Providers_Luckyshop::getStatus(self::API_KEY, $id);
        
	    $zakaz->update(['comments'=> $data->comment]);

        if ($data->status  == 'trash' || $data->status == 'fraud') {
            $status = Zakaz::STATUS_TRASH;
        }
        if ($data->status == 'new' || $data->status == 'wait') {
            return true;
        }
        if ($data->status == 'rejected' || $data->status == 'nopaid') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($data->status == 'paid' || $data->status == 'confirmed') {
            $status = Zakaz::STATUS_HOLD;
        } 
        $comments = $data->comment;
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
