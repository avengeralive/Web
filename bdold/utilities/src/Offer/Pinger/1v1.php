<?php

class Offer_Pinger_1v1 extends Offer_Pinger {

    // private function telegram($text){
    //     if(is_array($text)) $text = json_encode($text, true);
    //     $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
    //     $chat_id = "-323189907";
    
    //     $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    //     return $sendToTelegram;
    // }

    public function ping($settings, \Zakaz $zakaz) {
        list($value) = explode(',', $settings);

        $offer = Offer::getById($zakaz->offer_id);

        $id = Providers_1v1::registerLead($value, $zakaz);
        $zakaz->update([
            // 'owner_id'       => $offer->owner_id,
            'pinger_type'   => get_class($this),
            'pinger_value'  => implode(',', [$id])
        ]);
        return true;
    }


    public function checkStatus( \Zakaz $zakaz) {
        // self::telegram($zakaz->pinger_value);
		//Берем ид заказа в функции ping выше видно как его записывали
        list($order) = explode(',', $zakaz->pinger_value);

        if(empty($order)) return;

        $res = Providers_1v1::getStatus($order);
        $st = $res->status;
        // echo $res->id.PHP_EOL.$st.PHP_EOL;
        if ($st === NULL || $st == 0) {
            return true; //статусы закрыты
        }
		
        $comments =$res->comment;

        if ($st == '17') {
            $zakaz->update(['comments'=>$comments]);
            self::requestLV($zakaz,$comments,0);
            return true; //ничего не сменилось, статус=1
        }
        if ($st == '16') {
            $zakaz->update(['comments'=>$comments]);
            $status = Zakaz::STATUS_REJECT;
            self::requestLV($zakaz,$comments,2);
        } elseif ($st == '14') {
            $zakaz->update(['comments'=>$comments]);
            $status = Zakaz::STATUS_TRASH;
            self::requestLV($zakaz,$comments,9);
        } elseif ($st == '18' || $st == '20') {
            $zakaz->update(['comments'=>$comments]);
            $status = Zakaz::STATUS_HOLD;
            self::requestLV($zakaz,$comments,1);
        }

            // $logger = Registry::get('di')->logger;
            // $logger->custom('LeadVertex', $zakaz->id . '-'. $order. '-'.$st. '-'.$status);
        
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }
	
    public function checkStatus2( \Zakaz $zakaz) {
		//Берем ид заказа в функции ping выше видно как его записывали
        list($order) = explode(',', $zakaz->pinger_value);

        $res = Providers_1v1::getStatus($order);
        $status = $res->status;
        $comments =$res->comment;
        if ($status === NULL || $status == 0) {
            return true; //статусы закрыты
        }
		
        if ($status == '16') {
            $zakaz->update(['comments'=>$comments]);
            $zakaz->update(['addstatus'=>5]);
            return true;
        }
        if ($status == '20') {
            $zakaz->update(['comments'=>$comments]);
            $zakaz->update(['addstatus'=>4]);
            return true;
        }

        return true;
    }
}
