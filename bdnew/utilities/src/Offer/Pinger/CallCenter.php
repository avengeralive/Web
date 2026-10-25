<?php

class Offer_Pinger_CallCenter extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
      	
        include_once START_PATH . '/../includes/callCenter/connect.php';
        $callcenter = new callcenter();
        $offer = Offer::getById($zakaz->offer_id);

        $send = $callcenter->SendOrder($zakaz->id, $zakaz->name, $zakaz->phone, $offer->name, $offer->cena);
        //var_dump($send);

        $send = json_decode($send, true);
        $send = $send['id'];

        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $send,
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        $order = $zakaz->pinger_value;
        include_once START_PATH . '/../includes/callCenter/connect.php';
        $callcenter = new callcenter();
        $send = $callcenter->GetOrder($order);
        $send = json_decode( $send , true);
  
            if(isset($send['message'])){
                $st = 3;
            }else{
                $state = $send['data']['state'];
                $st = $this->statusCodes($state);
            }        
        
        if($st == 0){return true;}
        if($st == 1){$status = 2;}
        if($st == 2){$status = 0;}
        if($st == 3){$status = 5;}
        echo $state;
        $comments = '';    
        $zakaz->updateZakaz($zakaz->id , $status , $comments);
        
        return true;
    }
    public function checkStatus2( \Zakaz $zakaz) {
        $order = $zakaz->pinger_value;
        include_once START_PATH . '/../includes/callCenter/connect.php';
        $callcenter = new callcenter();
        $send = $callcenter->GetOrder($order);
        $send = json_decode( $send , true);
        if($send['data']['state'] != 32 or $send['data']['state'] != 25){return true;}   				
        if($send['data']['state'] == 32){$addstatus = 5;}
        if($send['data']['state'] == 25){$addstatus = 4;}
        $zakaz->update([
            'addstatus' => $addstatus
        ]); 
        return true;
    }    
    public function statusCodes($status) {
        $stat_arr = array(
                1=>0,                2=>0,                3=>0,                4=>0,
                5=>1,                6=>0,                7=>0,                8=>0,
                9=>2,                10=>1,                11=>1,                12=>2,
                13=>1,                14=>1,                15=>1,                16=>1,
                17=>1,                18=>2,                19=>1,                20=>1,
                21=>1,                22=>2,                23=>3,                24=>3,
                25=>1,                32=>2,                33=>1,                34=>1,
                35=>0,                37=>1,                38=>1,                39=>1,
                40=>0,                41=>1,                42=>1,                43=>1,
                44=>1,                45=>1,                46=>1,                47=>1,
                48=>1,                49=>1,                50=>1,                51=>1,
                52=>1,                53=>1,                54=>1
            ); 
        $status = $stat_arr[$status];
        
        return $status;
    }

}
