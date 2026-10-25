<?php

class Offer_Pinger_Rozmakc extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($of, $api_key) = explode(',', $settings);
        
        $offer = Offer::getById($zakaz->offer_id);
        
        $id = Providers_Rozmakc::registerLead($api_key, $of, $zakaz);

        
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$api_key, $id])
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        list($api_key, $id) = explode(',', $zakaz->pinger_value);

        $data = Providers_Rozmakc::getStatus($api_key,$id);
        
        $st = $data->order_status;
        $comments = $data->comments;
        if ($st == 1) {
            return true;
        }
        if ($st == 0) {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($st == 3) {
            $status = Zakaz::STATUS_HOLD;
        } elseif ($st == 5) {
            $status = Zakaz::STATUS_TRASH;
        }
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
