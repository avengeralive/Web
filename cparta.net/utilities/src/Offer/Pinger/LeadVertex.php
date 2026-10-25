<?php

class Offer_Pinger_LeadVertex extends Offer_Pinger {
    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }
    public function ping($settings, \Zakaz $zakaz) {
        list($id_l, $sub, $token) = explode(',', $settings);
        $offer = Offer::getById($zakaz->offer_id);
        $id = Providers_LeadVertex::registerLead($sub, $token, $zakaz, $offer->name, $id_l);
		// $logger = Registry::get('di')->logger;
        // $logger->text('LEADVERTEX order#' . $zakaz->id . ', response: ' . var_export($res, 1));
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $id.','.$sub.','.$token
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        list($id, $sub, $token) = explode(',', $zakaz->pinger_value);

        $status = Providers_LeadVertex::getPaymentStatus($sub, $token, $id);
        if ($status == '-1') {
            $zakaz->update(['addstatus'=>5]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == '1') {
            $zakaz->update(['addstatus'=>4]);
            return true; //ничего не сменилось, статус=1
        }
        
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        list($id, $sub, $token) = explode(',', $zakaz->pinger_value);
        // $id = $zakaz->pinger_value;
        $res = Providers_LeadVertex::getStatus($sub, $token, $id);
        $status = $res->statusGroup;
        $comments = $res->comment;

        if ($status === NULL) {
            return true; //статусы закрыты
        }		

        if ($status == 'processing') {
            $zakaz->update(['comments'=>$comments]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'canceled') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($status == 'spam') {
            $status = Zakaz::STATUS_TRASH;
        } elseif ($status == 'accepted' || $status == 'paid') {
            $status = Zakaz::STATUS_APPROVED;
        }

        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
