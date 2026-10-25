<?php

class Offer_Pinger_Luckyshop extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($good_id, $api_key) = explode(',', $settings);
        
        $offer = Offer::getById($zakaz->offer_id);
        
        $id = Providers_Luckyshop::registerLead($good_id, $api_key, $zakaz);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$good_id, $api_key, $id])
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        list($good_id, $api_key, $id) = explode(',', $zakaz->pinger_value);

        $data = Providers_Luckyshop::getStatus($api_key, $id);
        
	$zakaz->update(['comments'=> $data->comment]);

        if ($data->status  == 'trash' || $data->status == 'fraud') {
            $status = Zakaz::STATUS_TRASH;
        }
        if ($data->status == 'new' || $data->status == 'wait') {
            return true;
        }
        if ($data->status == 'rejected' || $data->status == 'nopaid') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($data->status == 'paid' || $data->status == 'confirmed') {
            $status = Zakaz::STATUS_HOLD;
        } 
        $comments = $data->comment;
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
