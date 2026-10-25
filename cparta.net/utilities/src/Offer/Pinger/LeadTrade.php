<?php

class Offer_Pinger_LeadTrade extends Offer_Pinger {
    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    public function ping($settings, \Zakaz $zakaz) {
        list($good_id) = explode(',', $settings);
        $hash = Providers_LeadTrade::registerLead($zakaz, 1, $good_id);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $hash
        ]);
        return true;
    }

    public function checkStatus(\Zakaz $zakaz) {
        $id = $zakaz->pinger_value;
        $res = Providers_LeadTrade::getStatus($id);
        
        $order = $res->$id;
        
        $st = $order->state;
        /*
        if ($status == 'hold') {
            $comments = $res->comment;
            $zakaz->update(['comments'=>$comments]);
            return true; //ничего не сменилось, статус=1
        }
         * 
         */

        if ($st == 'hold') {
            return true;
        }
  
                
        if ($st == 'accepted') {
            $status = Zakaz::STATUS_HOLD;
        } elseif ($st == 'declined') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($st == 'trash') {
            $status = Zakaz::STATUS_TRASH;
        }
        $comments = '';
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

    public function checkStatus2(\Zakaz $zakaz) {
        return true;
    }

}
