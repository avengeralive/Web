<?php

class Offer_Pinger_DiamondCrm extends Offer_Pinger {

    function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
        return $sendToTelegram;
    }

    public function ping($settings, \Zakaz $zakaz) {
        list($value) = explode(',', $settings);
        $offer = Offer::getById($zakaz->offer_id);
        $id = Providers_DiamondCrm::registerLead($value, $zakaz);
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

        $res = Providers_DiamondCrm::getStatus($order);
        $st = $res->status;
        //$this->telegram($st);
        // echo $res->id.PHP_EOL.$st.PHP_EOL;
        if ($st === NULL || $st == 0) {
            return true; //статусы закрыты
        }
		
        $comments =$res->comment;

        if ($st == '17') {
            $zakaz->update(['comments'=>$comments]);
            return true; //ничего не сменилось, статус=1
        }
        if ($st == '16') {
            $zakaz->update(['comments'=>$comments]);
            $status = Zakaz::STATUS_REJECT;
        } elseif ($st == '14') {
            $zakaz->update(['comments'=>$comments]);
            $status = Zakaz::STATUS_TRASH;
        } elseif ($st == '18' || $st == '20') { 
            $zakaz->update(['comments'=>$comments]);
            $status = Zakaz::STATUS_HOLD;
        }

            // $logger = Registry::get('di')->logger;
            // $logger->custom('LeadVertex', $zakaz->id . '-'. $order. '-'.$st. '-'.$status);
        //$this->telegram($status);
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }
	
    public function checkStatus2( \Zakaz $zakaz) {
		//Берем ид заказа в функции ping выше видно как его записывали
        list($order) = explode(',', $zakaz->pinger_value);

        $res = Providers_DiamondCrm::getStatus($order);
        $status = $res->addstatus;
        $comments =$res->comment;
        if ($status === NULL || $status == 0) {
            return true; //статусы закрыты
        }
		
        
        $zakaz->update(['comments'=>$comments]);
        switch ($status) {
            case 1: $zakaz->update(['addstatus'=>1]); break;
            case 2: $zakaz->update(['addstatus'=>2]); break;
            case 3: $zakaz->update(['addstatus'=>3]); break;
            case 4: $zakaz->update(['addstatus'=>3]); break;
            case 5: $zakaz->update(['addstatus'=>3]); break;
            case 6: $zakaz->update(['addstatus'=>3]); break;
            case 7: $zakaz->update(['addstatus'=>3]); break;
            case 8: $zakaz->update(['addstatus'=>3]); break;
            case 9: $zakaz->update(['addstatus'=>3]); break;
            case 10: $zakaz->update(['addstatus'=>3]); break;
            case 11: $zakaz->update(['addstatus'=>3]); break;
            case 12: $zakaz->update(['addstatus'=>3]); break;
            case 13: $zakaz->update(['addstatus'=>3]); break;
            case 14: $zakaz->update(['addstatus'=>3]); break;
            case 15: $zakaz->update(['addstatus'=>3]); break;
            case 16: $zakaz->update(['addstatus'=>3]); break;
            case 17: $zakaz->update(['addstatus'=>4]); break;
            case 18: $zakaz->update(['addstatus'=>4]); break;
            case 19: $zakaz->update(['addstatus'=>4]); break;
            case 20: $zakaz->update(['addstatus'=>4]); break;
            case 21: $zakaz->update(['addstatus'=>4]); break;
            case 22: $zakaz->update(['addstatus'=>4]); break;
            case 23: $zakaz->update(['addstatus'=>4]); break;
            case 24: $zakaz->update(['addstatus'=>4]); break;
            case 25: $zakaz->update(['addstatus'=>4]); break;
            case 26: $zakaz->update(['addstatus'=>4]); break;
            case 27: $zakaz->update(['addstatus'=>4]); break;
            case 28: $zakaz->update(['addstatus'=>4]); break;
            case 29: $zakaz->update(['addstatus'=>4]); break;
            case 30: $zakaz->update(['addstatus'=>4]); break;
            case 31: $zakaz->update(['addstatus'=>4]); break;
            case 32: $zakaz->update(['addstatus'=>4]); break;
            case 33: $zakaz->update(['addstatus'=>4]); break;
            case 34: $zakaz->update(['addstatus'=>4]); break;
            case 35: $zakaz->update(['addstatus'=>4]); break;
            case 36: $zakaz->update(['addstatus'=>4]); break;
            case 37: $zakaz->update(['addstatus'=>4]); break;
            case 38: $zakaz->update(['addstatus'=>4]); break;
            case 39: $zakaz->update(['addstatus'=>4]); break;
            case 40: $zakaz->update(['addstatus'=>4]); break;
            case 41: $zakaz->update(['addstatus'=>4]); break;
            case 42: $zakaz->update(['addstatus'=>4]); break;
            case 43: $zakaz->update(['addstatus'=>4]); break;
            case 44: $zakaz->update(['addstatus'=>4]); break;
            case 45: $zakaz->update(['addstatus'=>4]); break;
            case 46: $zakaz->update(['addstatus'=>4]); break;
            case 47: $zakaz->update(['addstatus'=>4]); break;
            case 48: $zakaz->update(['addstatus'=>4]); break;
            case 49: $zakaz->update(['addstatus'=>5]); break;
            case 50: $zakaz->update(['addstatus'=>6]); break;
            case 51: $zakaz->update(['addstatus'=>7]); break;
            case 52: $zakaz->update(['addstatus'=>8]); break;
            case 53: $zakaz->update(['addstatus'=>9]); break;
            case 54: $zakaz->update(['addstatus'=>10]); break;
            case 55: $zakaz->update(['addstatus'=>11]); break;
            case 56: $zakaz->update(['addstatus'=>12]); break;
            case 57: $zakaz->update(['addstatus'=>13]); break;
            case 58: $zakaz->update(['addstatus'=>14]); break;
            case 59: $zakaz->update(['addstatus'=>15]); break;
            case 60: $zakaz->update(['addstatus'=>16]); break;
            case 61: $zakaz->update(['addstatus'=>17]); break;
            case 62: $zakaz->update(['addstatus'=>18]); break;
            case 63: $zakaz->update(['addstatus'=>19]); break;
            case 64: $zakaz->update(['addstatus'=>15]); break;
            case 65: $zakaz->update(['addstatus'=>20]); break;
            case 66: $zakaz->update(['addstatus'=>21]); break;
            case 67: $zakaz->update(['addstatus'=>22]); break;
            case 68: $zakaz->update(['addstatus'=>29]); break;
            case 69: $zakaz->update(['addstatus'=>23]); break;
            case 70: $zakaz->update(['addstatus'=>24]); break;
            case 71: $zakaz->update(['addstatus'=>25]); break;
            case 72: $zakaz->update(['addstatus'=>26]); break;
            case 73: $zakaz->update(['addstatus'=>27]); break;
            case 74: $zakaz->update(['addstatus'=>28]); break;
            case 75: $zakaz->update(['addstatus'=>29]); break;
            case 76: $zakaz->update(['addstatus'=>30]); break;
            case 77: $zakaz->update(['addstatus'=>31]); break;
            case 78: $zakaz->update(['addstatus'=>5]); break;
            case 79: $zakaz->update(['addstatus'=>5]); break;
            case 80: $zakaz->update(['addstatus'=>5]); break;
            case 81: $zakaz->update(['addstatus'=>5]); break;
            case 82: $zakaz->update(['addstatus'=>5]); break;
            case 83: $zakaz->update(['addstatus'=>5]); break;
            case 84: $zakaz->update(['addstatus'=>5]); break;
            case 85: $zakaz->update(['addstatus'=>5]); break;
            case 86: $zakaz->update(['addstatus'=>5]); break;
            case 87: $zakaz->update(['addstatus'=>5]); break;
            case 88: $zakaz->update(['addstatus'=>5]); break;
            case 89: $zakaz->update(['addstatus'=>5]); break;
            case 90: $zakaz->update(['addstatus'=>5]); break;
            case 91: $zakaz->update(['addstatus'=>5]); break;
            case 92: $zakaz->update(['addstatus'=>5]); break;
            case 93: $zakaz->update(['addstatus'=>5]); break;
            case 94: $zakaz->update(['addstatus'=>5]); break;
            case 95: $zakaz->update(['addstatus'=>5]); break;
            case 96: $zakaz->update(['addstatus'=>5]); break;
            case 97: $zakaz->update(['addstatus'=>5]); break;
            case 98: $zakaz->update(['addstatus'=>5]); break;
            case 99: $zakaz->update(['addstatus'=>5]); break;
            case 100: $zakaz->update(['addstatus'=>5]); break;
            case 101: $zakaz->update(['addstatus'=>5]); break;
            case 102: $zakaz->update(['addstatus'=>5]); break;
            case 103: $zakaz->update(['addstatus'=>5]); break;
            case 104: $zakaz->update(['addstatus'=>5]); break;
            case 105: $zakaz->update(['addstatus'=>5]); break;
            case 106: $zakaz->update(['addstatus'=>4]); break;
        }
        //var_dump($status);
        /*if ($status == '16') {
            $zakaz->update(['comments'=>$comments]);
            $zakaz->update(['addstatus'=>5]);
            return true;
        }
        if ($status == '20') {
            $zakaz->update(['comments'=>$comments]);
            $zakaz->update(['addstatus'=>4]);
            return true;
        }*/

        return true;
    }
}
