<?php
class Offer_Pinger_RetailCRM extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
	
        include_once START_PATH . '/../includes/RetailCrmApi/index.php';
	

        $retailCrmApi = new retailCrmApi();
        list($site, $productId, $apikey) = explode(',', $settings);
        $send = $retailCrmApi->SendOrder($site, $zakaz->name, $zakaz->phone, $productId, $apikey);
        $retail_id = htmlentities($send['id']);

        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$site, $productId, $apikey, $retail_id]),
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        //$order = $zakaz->pinger_value;
        include_once START_PATH . '/../includes/RetailCrmApi/index.php';
        $retailCrmApi = new retailCrmApi();
        list($site, $productId, $apikey, $order) = explode(',', $zakaz->pinger_value);
        $send = $retailCrmApi->GetOrder($order,$apikey);
        if (!isset($send['order'])) {
            return false;
        }
        $st = self::statusCodes($send['order']['status']);
        
        if($st == 0){$status = 1;}
        if($st == 1 or $st == 3 or $st == 4){$status = 2;}
        if($st == 2){$status = 0;}
        if($st == 5){$status = 5;}
		
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
        include_once START_PATH . '/../includes/RetailCrmApi/index.php';
        $retailCrmApi = new retailCrmApi();
        list($site, $productId, $apikey) = explode(',', $zakaz->pinger_value);
        $send = $retailCrmApi->GetOrder($order,$apikey);
        if (!isset($send['order'])) {
            return false;
        }
        $st = self::statusCodes($send['order']['status']);
        if($st != 3 or $st != 4){return true;}
        if($st == 3){$addstatus = 4;}
        if($st == 4){$addstatus = 5;}
        
        $zakaz->update([
            'addstatus' => $addstatus
        ]);

        return true;        
        
    }
    
    public static function statusCodes($status) {
        $stat_arr = array(
            'new' => 0,
            'vtorichka' => 1,
            'availability-confirmed' => 0,
            'offer-analog' => 0,
            'client-confirmed' => 1,
            'prepayed' => 0,
            'soglasovanie' => 0,
            'perezvonit' => 0,
            'send-to-assembling' => 1,
            'assembling' => 1,
            'assembling-complete' => 1,
            'send-kurer' => 1,
            'zhdettovar' => 1,
            'send-post' => 1,
            'komplect1' => 1,
            'komplect2' => 1,
            'send-to-delivery' => 1,
            'delivering' => 1,
            'redirect' => 1,
            'data-vykup' => 1,
            'marketer' => 1,
            'collector' => 1,
            'complete' => 3,
            'vrucheno' => 3,
            'oplachen' => 3,
            'vozvrat' => 4,
            'vrucheno-iz-kollektora' => 3,
            'v-vozvrat' => 4,
            'vozvrat-kurer' => 4,
            'oplachen-kurer' => 3,
            'no-call' => 2,
            'ne-podtverghden2' => 4,
            'no-product' => 2,
            'already-buyed' => 2,
            'delyvery-did-not-suit' => 2,
            'prices-did-not-suit' => 2,
            'cancel-other' => 5,
            'pretenzii' => 2,
            'otloghen' => 2,
            'na-vozvrat-monsram' => 2
            ); 
        $status = $stat_arr[$status];
        
        return $status;
    }
}
