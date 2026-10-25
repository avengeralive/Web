<?php
//Offer_Pinger_Ctr добавление

class Offer_Pinger_Ctr extends Offer_Pinger {
	
		
    public function ping($settings, \Zakaz $zakaz) {
	

        list($site_id, $apikey) = explode(',', $settings);
        Providers_Ctr::registerLead($site_id, $apikey, $zakaz);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$site_id, $apikey, $zakaz->id]),
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        list($site_id, $apikey, $zakaz->id) = explode(',', $zakaz->pinger_value);

        $res = Providers_Ctr::getPaymentStatus($apikey, $zakaz->id);

        if ($res == 5 or $res == '-1'){
            return true; //ничего не сменилось, статус=1
        }
        if ($res == 6) {
            $addstatus = 4;
        } elseif ($res == 7) {
            $addstatus = 5;
        }
        $zakaz->update([
                'addstatus' => $addstatus
        ]);        

        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        return true;
        
        
        
        
        
        list($site_id, $apikey, $zakaz->id) = explode(',', $zakaz->pinger_value);

        $res = Providers_Ctr::getStatus($apikey, $zakaz->id);
        $st = $res;
        if ($st == 0 or $st == 1){
            return true; //ничего не сменилось, статус=1
        }
        if ($st == 4 || $st == 77 || $st == 99) {
            $status = Zakaz::STATUS_REJECT;
            $comments = $res->comment;
        } elseif ($st == 3) {
            $status = Zakaz::STATUS_HOLD;
        } elseif ($st == 13 || $st == 88) {
            $status = Zakaz::STATUS_TRASH;
            $comments = $res->comment;
        }
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

    
    public function checkStatusNEW($orders) {
        $o = [];
        foreach ($orders as $order){
            $zakaz = Zakaz::getById($order);
            list($site_id, $apikey, $zakaz->id) = explode(',', $zakaz->pinger_value);
            $o[] = $zakaz->id;
        }
        $o = implode(',',$o);

        $res = Providers_Ctr::getStatus($apikey, $o);

        foreach ($res as $id => $st){
            if ($st == 0 or $st == 1){
                continue;
            }
            $zakaz = Zakaz::getById($id);

            if ($st == 4 || $st == 77 || $st == 99) {
                $status = Zakaz::STATUS_REJECT;
            } elseif ($st == 3) {
                $status = Zakaz::STATUS_HOLD;
            } elseif ($st == 13 || $st == 88) {
                $status = Zakaz::STATUS_TRASH;
            }
            $zakaz->updateZakaz($zakaz->id, $status, '');
        }
        return true;
    }
}
