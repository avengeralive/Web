<?php

class Offer_Pinger_AmoCrm extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($subdomain, $login, $token, $resp_user, $dealname) = explode(',', $settings);
        
        $offer = Offer::getById($zakaz->offer_id);
        
        $id = Providers_AmoCrm::registerLead($subdomain, $login, $token, $resp_user, $dealname, $zakaz);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$subdomain, $login, $token, $resp_user, $dealname, $id]),
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        list($subdomain, $login, $token, $resp_user, $dealname, $order) = explode(',', $zakaz->pinger_value);
        //$order = $zakaz->pinger_value;
        $send = Providers_AmoCrm::getStatus($subdomain, $login, $token, $order);
        $status = $send->status_id;
		
        $stat_arr = array(
            142=>4,
            143=>5
        );         
        $addstatus = $stat_arr[$status];  		
        if(!isset($addstatus) or $addstatus == 0){return true;}          
        $zakaz->update([
            'addstatus' => $addstatus
        ]);  
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        list($subdomain, $login, $token, $resp_user, $dealname, $order) = explode(',', $zakaz->pinger_value);
        //$order = $zakaz->pinger_value;
        $send = Providers_AmoCrm::getStatus($subdomain, $login, $token, $order);
        $status = $send->status_id;
        $comments = $send->name; 
        $price = $send->price;
        
        if($zakaz->offer_id == 20){
            $comission_all = $price*0.1;
            $comission = $comission_all*0.7;
            $comission_cpa = $comission_all-$comission;
        
            $zakaz->update([
                'comission' => $comission,
                'comission_cpa' => $comission_cpa,
                'cena' => $price
            ]);             
        }		
		
        $stat_arr = array(
            23497333=>1,
            23497336=>2,
            23497339=>0,
            23541916=>5,
            23497345=>2,
            142=>2,
            143=>1
        );         
        $st = $stat_arr[$status];  		
        if(!isset($status) or $status == 1){return true;}          
        $zakaz->updateZakaz($zakaz->id , $st , $comments);      
        return true;
    }

}
