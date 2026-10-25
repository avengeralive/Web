<?php

class Offer_Pinger_Monster extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {

	

        $hash = Providers_MonsterLead::registerLead($settings, $zakaz->name, $zakaz->phone, $zakaz->ip, $zakaz->artikul);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $hash
        ]);
        return true;
    }
    
    public function checkStatus( \Zakaz $zakaz) {
        $order = $zakaz->pinger_value;
        $res = Providers_MonsterLead::getStatus($order);     
	$status = $res->status;
	$zakaz->update(['comments'=> $res->data4]);

        if ($status == 1) {
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 2) {
            $status = Zakaz::STATUS_HOLD;
        } elseif ($status == 3) {
            $status = Zakaz::STATUS_REJECT;
        }        
        $comments = $res->data4;
        $zakaz->updateZakaz($zakaz->id , $status , $comments);
        return true;
    }
    
    public function checkStatus2( \Zakaz $zakaz) {
           $order = $zakaz->pinger_value;
           $status = Providers_MonsterLead::getPaymentStatus($order);     
           if ($status == 2) {
      $zakaz->update(['addstatus'=>4]);
               return true; //
           }
     if ($status == 3) {
      $zakaz->update(['addstatus'=>5]);
               return true; //
           }

           return true;
   }
}
