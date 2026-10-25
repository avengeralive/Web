<?php

class Offer_Pinger_Ctr extends Offer_Pinger {

    public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }

    public function ping($settings, \Zakaz $zakaz) {
        //list($s) = explode(',', $settings);
        
        $id = Providers_Ctr::registerLead($settings, $zakaz);
        //self::telegram('start');
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $id
        ]);
        
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        
        $status = Providers_Ctr::getStatus($zakaz);

        if ($status == 1 || $status == 0) {
            $status = Zakaz::STATUS_WAITING;
        }
        if ($status == 3) {
            $status = Zakaz::STATUS_APPROVED;
        }
        if ($status == 4 || $status == 77) {
            $status = Zakaz::STATUS_REJECT;
        }
        if ($status == 88 || $status == 13 || $status == 99 || $status == 66) {
            $status = Zakaz::STATUS_TRASH;
        }

        $zakaz->updateZakaz($zakaz->id, $status, $comments);

        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        
        return true;
        
        
        include_once START_PATH . '/../includes/ad1api/index.php';
        $ad1api = new ad1api();
        $send = $ad1api->GetSubID();
        $comments = '';
        $order = $zakaz->id;
        $sub_arr = $send['data']['subaccounts'];
        foreach ($sub_arr as $subs) {
            if ($subs['title'] == $order) {
                $subid = $subs['id'];
                break;
            }
        }
        if ($subid && $subid != '' && $subid != 0) {
            $send = $ad1api->GetOrder($subid);
            if ($send['data']['statsCount'] == 1) {
                $order_arr = $send['data']['stats'];
                $status = $order_arr[0]['status']['id'];
                if ($status != 3) {
                    return true;
                }
                if ($status == 3) {
                    $addstatus = 4;
                }
                $zakaz->update([
                    'addstatus' => $addstatus
                ]);
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

}
