<?php

class Offer_Pinger_CpaMVP extends Offer_Pinger {
    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }
    public function ping($settings, \Zakaz $zakaz) {
        list($stream,$sub,$apikey) = explode(',', $settings);

        $offer = Offer::getById($zakaz->offer_id);
        // self::telegram("START");
        $id = Providers_CpaMVP::registerLead($stream, $apikey, $zakaz);
        // self::telegram("STOP");
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',', [$id]).','.$sub.','.$apikey
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {



		//Берем ид заказа в функции ping выше видно как его записывали
		
        list($order,$sub,$apikey) = explode(',', $zakaz->pinger_value);
            $logger = Registry::get('di')->logger;
            $logger->custom('CpaMVP', $zakaz->id . '-'. $order);
			
        $res = Providers_CpaMVP::getStatus($order,$apikey);
		$st = $res->order_status;
        if ($st === NULL || $st == 0) {
            return true; //статусы закрыты
        }
		
        $logger = Registry::get('di')->logger;
        $logger->info('CpaMVP order#' . $zakaz->id . ', response: ' . var_export($res, 1));

			
        $comments =$res->comments;

        if ($st == '1') {
            $zakaz->update(['comments'=>$comments]);
            return true; //ничего не сменилось, статус=1
        }
        if ($st == '0') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($st == '5') {
            $status = Zakaz::STATUS_TRASH;
        } elseif ($st == '3') {
            $status = Zakaz::STATUS_HOLD;
        }

            $logger = Registry::get('di')->logger;
            $logger->custom('LeadVertex', $zakaz->id . '-'. $order. '-'.$st. '-'.$status);

        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }
	
    public function checkStatus2( \Zakaz $zakaz) {
		//Берем ид заказа в функции ping выше видно как его записывали
        list($order) = explode(',', $zakaz->pinger_value);

        $res = Providers_CpaMVP::getStatus($order);
		$status = $res->status;
        if ($status === NULL || $status == 0) {
            return true; //статусы закрыты
        }
		
        if ($status == '16') {
            $zakaz->update(['addstatus'=>5]);
            return true;
        }
        if ($status == '20') {
            $zakaz->update(['addstatus'=>4]);
            return true;
        }

        return true;
    }
}
