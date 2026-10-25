<?php

class Offer_Pinger_Everad extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($api_key, $user, $good_id) = explode(',', $settings);
        
        $offer = Offer::getById($zakaz->offer_id);
        
        $id = Providers_Everad::registerLead($user, $api_key, $good_id, $zakaz);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$api_key, $user, $good_id, $id])
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        list($api_key, $user, $good_id, $id) = explode(',', $zakaz->pinger_value);

        $data = Providers_Everad::getStatus($api_key,$zakaz->id);
	$zakaz->update(['comments'=> $data->comment]);

        if ($data->status == 1) {
            return true; //ничего не сменилось, статус=1
        }
        if ($data->status == 3) {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($data->status == 2) {
            $status = Zakaz::STATUS_HOLD;
        }
        $comments = $data->comment;
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
