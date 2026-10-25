<?php

class Offer_Pinger_Vestamedia extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($apikey) = explode(',', $settings);

        $hash = Providers_Vestamedia::registerLead($zakaz->name, $zakaz->phone, $zakaz->offer_id, $zakaz->id, $apikey);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $apikey . ',' . $hash
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        return true;
        list($apikey, $order_id) = explode(',', $zakaz->pinger_value);
        
        $res = Providers_Vestamedia::getStatus($apikey, $order_id, $zakaz->offer_id);
        $st = $res->status;
        if ($st == 'hold'){
            return true; //ничего не сменилось, статус=1
        }
        if ($st == 'cancelled') {
            $status = Zakaz::STATUS_REJECT;
            $comments = $res->comment;
        } elseif ($st == 'confirmed') {
            $status = Zakaz::STATUS_HOLD;
            $comments = '';
        }
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }

}
