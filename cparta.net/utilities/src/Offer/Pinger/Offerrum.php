<?php

class Offer_Pinger_Offerrum extends Offer_Pinger {
    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    public function ping($settings, \Zakaz $zakaz) {
        list($offerID,$sub,$apikey) = explode(',', $settings);
        $offer = Offer::getById($zakaz->offer_id);
        $id = Providers_Offerrum::registerLead($offerID, $apikey, $zakaz);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',', [$id])
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {


        //Берем ид заказа в функции ping выше видно как его записывали
        
        list($order) = explode(',', $zakaz->pinger_value);
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. $order);
            
        $res = Providers_TrafficLight::getStatus($order);

        $st = $res->status_code;
        if ($st === NULL) {
            return true; //статусы закрыты
        }
        
        $logger = Registry::get('di')->logger;
        $logger->info('LEADVERTEX order#' . $zakaz->id . ', response: ' . var_export($res, 1));

            
        $comments = $res->comment;
        if ($res->trash != NULL) {
            $status = Zakaz::STATUS_TRASH;
        }
        else {
            if ($st == 0) {
                $zakaz->update(['comments'=>$comments]);
                return true; //ничего не сменилось, статус=1
            }
            if ($st == -10) {
                $status = Zakaz::STATUS_REJECT;
            } elseif ($st == 5) {
                $status = Zakaz::STATUS_APPROVED;
            } elseif ($st == 10) {
                $status = Zakaz::STATUS_APPROVED;
            }
        }
        //var_dump($status);
            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. $order. '-'.$st. '-'.$status);

        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }
    
    public function checkStatus2( \Zakaz $zakaz) {
        
        //Берем ид заказа в функции ping выше видно как его записывали
        list($order) = explode(',', $zakaz->pinger_value);

        $res = Providers_TrafficLight::getStatus($order);
        $status = $res->status_code;
        if ($status === NULL) {
            return true; //статусы закрыты
        }
        
        if ($status == -10) {
            $zakaz->update(['addstatus'=>5]);
            return true;
        }
        if ($status == 10) {
            $zakaz->update(['addstatus'=>4]);
            return true;
        }

        return true;
    }
}
