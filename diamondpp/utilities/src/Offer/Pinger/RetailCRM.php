<?php
class Offer_Pinger_RetailCRM extends Offer_Pinger {
    function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
        return $sendToTelegram;
    }

    public function ping($settings, \Zakaz $zakaz) {
	
        include_once START_PATH . '/../includes/RetailCrmApi/index.php';
	

        $retailCrmApi = new retailCrmApi();
        list($productId, $site, $apikey) = explode(',', $settings);

        $send = $retailCrmApi->SendOrder($site, $zakaz->name, $zakaz->phone, $productId, $apikey, $zakaz);
        $retail_id = $send['id'];

        $zakaz->update([
            'pinger_type' => get_class($this),
            //'pinger_value' => implode(',',[$site, $productId, $apikey, $retail_id]),
            'pinger_value' => implode(',',[$retail_id]),
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        //$order = $zakaz->pinger_value;
        include_once '/var/www/pp/includes/RetailCrmApi/index.php';
        $retailCrmApi = new retailCrmApi();
        //$this->telegram($zakaz->pinger_value);
        $order = $zakaz->pinger_value;
        $apikey = 'c8XPC87FdIJpFPENCxKuBQNgPgmeQHbp';
        $send = $retailCrmApi->GetOrder($order,$apikey);
        if (!isset($send['order'])) {
            return false;
        }
        //$this->telegram($send['order']['status']);
        $st = self::statusCodes($send['order']['status']);
        
        $status = $st;
        //if($st == 0){$status = 1;}
        //if($st == 1 or $st == 3 or $st == 4){$status = 2;}
        //if($st == 2){$status = 0;}
        //if($st == 5){$status = 5;}
		
        $comments = '';
        if(isset($send['order']['statusComment']) && $send['order']['statusComment'] != ''){
            $comments = $send['order']['statusComment'];
        }elseif(isset($send['order']['managerComment']) && $send['order']['managerComment'] != ''){
            $comments = $send['order']['managerComment'];
        }
		
        //$logger = Registry::get('di')->logger;
       // $logger->info('RETAIL REQEST: comment :' . $comments . '||| $st :' .$st . ' ||| status:' .$send['order']['status']);		
        $zakaz->updateZakaz($zakaz->id, $status, $comments);

        return true;        
        
    }
    public function checkStatus2( \Zakaz $zakaz) {

        $order = $zakaz->pinger_value;
        include_once '/var/www/pp/includes/RetailCrmApi/index.php';
        $retailCrmApi = new retailCrmApi();
        $order = $zakaz->pinger_value;
        $apikey = 'c8XPC87FdIJpFPENCxKuBQNgPgmeQHbp';
        $send = $retailCrmApi->GetOrder($order,$apikey);
        if (!isset($send['order'])) {
            return false;
        }
        $st = self::addstatusCodes($send['order']['status']);
        //if($st != 3 or $st != 4){return true;}
        //if($st == 3){$addstatus = 4;}
        //if($st == 4){$addstatus = 5;}

        $addstatus = $st;


        
        $zakaz->update([
            'addstatus' => $addstatus
        ]);

        return true;        
        
    }
    
    public static function statusCodes($status) {

        $stat_arr = array(
            'new' => 1, 
            'perezvoniy-pozge' => 1,

            'no-product' => 0,
            'already-buyed' => 0,
            'delyvery-did-not-suit' => 0,
            'prices-did-not-suit' => 0,
            'ne-original' => 0,
            'dorogo' => 0,
            'cancel-other' => 0,
            'prochee' => 0,
            'podumaet' => 0,
            'opis' => 0,
            'otzivi' => 0,
            'return' => 0,
            'vozvratpokontroly' => 0,
            'fraud' => 0,
            'expired-call' => 0,
            'kurier' => 0,
            'region-zakrit' => 0,

            'dublicat-na-udalenie' => 5,

            'auto-spam' => 5,
            'otdel-pretenzii' => 5,
            'spam' => 5,

            'sbros' => 1,
            'no-calling' => 1,
            'no-calling1' => 1,
            'no-calling2' => 1,
            'no-calling3' => 1,
            'no-calling4' => 1,
            'no-calling1day' => 1,
            'no-calling2day' => 1,
            'no-calling3day' => 1,

            'perezvo-call' => 1,
            'verk' => 1,
            'no-callap1' => 1,
            'no-callap2' => 1,
            'no-callap3' => 1,
            'no-callap4' => 1,
            'no-callap5' => 1,
            'nd1day' => 1,
            'no-callap1d' => 1,
            'no-callap1d2' => 1,
            'nd2day' => 1,
            'nd2day1d' => 1,
            'nd2day2' => 1,
            'nd3day' => 1,
            'no-call3day3' => 1,
            'no-call3day2' => 1,
            'no-call3day4' => 1,

            'nosposobdostavki' => 0,
            'fileds' => 0,
            'stop-client' => 0,
            'buyeny' => 0,
            'dorogo1' => 0,
            'prochee1' => 0,
            'opis-1' => 0,
            'otzivi1' => 0,
            'netdeneg' => 0,
            'nosroki' => 0,
            'nolead' => 0,
            'nostoimost' => 0,
            'otgovorili' => 0,

            'send-to-assembling' => 3,
            'delivering' => 3,
            'pvz' => 3,
            'complete' => 3,
            'client-confirmed' => 3,
            'pz2' => 3,
            'trekbuy' => 3,
            'problem1' => 3,
            'problem2' => 3,
            'okadmin1' => 3,
            'okoper1' => 3,
            'okoper2' => 3,
            'okoper3' => 3,
            'okoper4' => 3,
            'okoper5' => 3,
            'okoperatop6' => 3,
            'sboradmin' => 3,
            'oper1' => 3,
            'oper2' => 3,
            'oper3' => 3,
            'oper4' => 3,
            'oper5' => 3,
            'oper6' => 3,
            'transfererror-bp' => 3,
            'readytotransfer-bp' => 3,
            'transferred-bp' => 3,
            'temporary-storage' => 3,
            'temporary-storage-dop' => 3,
            'dop2-vrem-hran' => 3,
            'peredal-prf' => 3
            ); 
        $status = $stat_arr[$status];
        
        return $status;
    }

    public static function addstatusCodes($status) {

        $stat_arr = array(
            'new' => 1, 
            'perezvoniy-pozge' => 2,

            'no-product' => 6,
            'already-buyed' => 7,
            'delyvery-did-not-suit' => 8,
            'prices-did-not-suit' => 9,
            'ne-original' => 10,
            'dorogo' => 11,
            'cancel-other' => 12,
            'prochee' => 13,
            'podumaet' => 14,
            'opis' => 15,
            'otzivi' => 16,
            'return' => 13,
            'vozvratpokontroly' => 13,
            'fraud' => 17,
            'expired-call' => 20,
            'kurier' => 19,
            'region-zakrit' => 13,

            'dublicat-na-udalenie' => 31,

            'auto-spam' => 30,
            'otdel-pretenzii' => 30,
            'spam' => 30,

            'sbros' => 4,
            'no-calling' => 3,
            'no-calling1' => 3,
            'no-calling2' => 3,
            'no-calling3' => 3,
            'no-calling4' => 3,
            'no-calling1day' => 3,
            'no-calling2day' => 3,
            'no-calling3day' => 3,

            'perezvo-call' => 4,
            'verk' => 4,
            'no-callap1' => 4,
            'no-callap2' => 4,
            'no-callap3' => 4,
            'no-callap4' => 4,
            'no-callap5' => 4,
            'nd1day' => 4,
            'no-callap1d' => 4,
            'no-callap1d2' => 4,
            'nd2day' => 4,
            'nd2day1d' => 4,
            'nd2day2' => 4,
            'nd3day' => 4,
            'no-call3day3' => 4,
            'no-call3day2' => 4,
            'no-call3day4' => 4,

            'nosposobdostavki' => 4,
            'fileds' => 4,
            'stop-client' => 4,
            'buyeny' => 4,
            'dorogo1' => 4,
            'prochee1' => 4,
            'opis-1' => 4,
            'otzivi1' => 4,
            'netdeneg' => 4,
            'nosroki' => 4,
            'nolead' => 4,
            'nostoimost' => 4,
            'otgovorili' => 4,

            'send-to-assembling' => 33,
            'delivering' => 33,
            'pvz' => 33,
            'complete' => 33,
            'client-confirmed' => 33,
            'pz2' => 33,
            'trekbuy' => 33,
            'problem1' => 33,
            'problem2' => 33,
            'okadmin1' => 33,
            'okoper1' => 33,
            'okoper2' => 33,
            'okoper3' => 33,
            'okoper4' => 33,
            'okoper5' => 33,
            'okoperatop6' => 33,
            'sboradmin' => 33,
            'oper1' => 33,
            'oper2' => 33,
            'oper3' => 33,
            'oper4' => 33,
            'oper5' => 33,
            'oper6' => 33,
            'transfererror-bp' => 33,
            'readytotransfer-bp' => 33,
            'transferred-bp' => 33,
            'temporary-storage' => 33,
            'temporary-storage-dop' => 33,
            'dop2-vrem-hran' => 33,
            'peredal-prf' => 33
            ); 
        $status = $stat_arr[$status];
        
        return $status;
    }
}
