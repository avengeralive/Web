<?php

class Offer_Pinger_LeadTrade extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($target, $good_id) = explode(',', $settings);
        
        $hash = Providers_LeadTrade::registerLead($zakaz, $target, $good_id);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $hash
        ]);
        return true;
    }

    public function checkStatus(\Zakaz $zakaz) {
        $id = $zakaz->pinger_value;
        $res = Providers_LeadTrade::getStatus($id);
        
        $order = $res->$id;
        
        $st = $order->state;
        /*
        if ($status == 'hold') {
            $comments = $res->comment;
            $zakaz->update(['comments'=>$comments]);
            return true; //ничего не сменилось, статус=1
        }
         * 
         */

        if ($st == 'hold') {
            return true;
        }
  
                
        if ($st == 'accepted') {
            $status = Zakaz::STATUS_HOLD;
        } elseif ($st == 'declined') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($st == 'trash') {
            $status = Zakaz::STATUS_TRASH;
        }
        $comments = '';
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

    public function checkStatus2(\Zakaz $zakaz) {
        return true;
    }

}
