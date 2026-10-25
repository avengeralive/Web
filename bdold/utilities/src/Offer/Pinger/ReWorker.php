<?php
class Offer_Pinger_ReWorker extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {    
	
        include_once START_PATH . '/../includes/reworkerApi/index.php';
        $ReworkerApi = new ReworkerApi();
        list( $shop_id, $sku, $price, $userTo ) = explode(',', $settings);
        $send = $ReworkerApi->SendOrder($shop_id, $zakaz->name, $zakaz->phone, $userTo, $price, $sku);
        $ReworkerId = htmlentities($send['order_id']);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$shop_id, $sku, $price, $userTo, $ReworkerId])
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        include_once START_PATH . '/../includes/reworkerApi/index.php';
        $ReworkerApi = new ReworkerApi();
        list( $shop_id, $sku, $price, $userTo, $order ) = explode(',', $zakaz->pinger_value);
        $send = $ReworkerApi->GetOrder($order, $userTo);
        $stat_arr = array(
                'processing'=>0,
                'approved'=>1,
                'declined'=>2,
                'shipped'=>1,
                'delivered'=>1,
                'return'=>2,
                'paid'=>1
        );        
        $st = $stat_arr[$send[0]['order_status']];
        if(isset($send[0]['decline_reason'])){
            $comments = ($send[0]['decline_reason'] == 'Не указано') ? '' : $send[0]['decline_reason'];
        }else{
            $comments = '';
        }
        
        if($st == 0){return true;}
        if($st == 1){$status = 2;}
        if($st == 2){$status = 0;}
        
        $zakaz->updateZakaz($zakaz->id , $status , $comments);
        
        return true;
    }
    
    public function checkStatus2( \Zakaz $zakaz) {
        include_once START_PATH . '/../includes/reworkerApi/index.php';
        $ReworkerApi = new ReworkerApi();
        list( $shop_id, $sku, $price, $userTo, $order ) = explode(',', $zakaz->pinger_value);
        $send = $ReworkerApi->GetOrder($order, $userTo);
        $stat_arr = array(
                'processing'=>0,
                'approved'=>0,
                'declined'=>0,
                'shipped'=>0,
                'delivered'=>0,
                'return'=>5,
                'paid'=>4
        );          
        $st = $stat_arr[$send[0]['order_status']];
        if(!isset($send[0]['order_status']) or $st == 0 ){return true;}       
        $zakaz->update([
            'addstatus' => $st
        ]);           
        return true;
    }        

}
