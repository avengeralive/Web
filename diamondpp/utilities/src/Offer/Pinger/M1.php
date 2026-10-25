<?php

class Offer_Pinger_M1 extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($good_id, $user, $api_key) = explode(',', $settings);
        
        $offer = Offer::getById($zakaz->offer_id);
        
        $id = Providers_M1::registerLead($user, $api_key, $good_id, $zakaz);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$good_id, $user, $api_key, $id])
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        list($good_id, $user, $api_key, $id) = explode(',', $zakaz->pinger_value);

        $data = Providers_M1::getStatus($user, $api_key,$id);
        $comments = ($data->result[0]->callcenter_comment != '') ? $data->result[0]->callcenter_comment : $data->result[0]->comment;
        
	$zakaz->update(['comments'=> $comments]);

        if ($data->result[0]->trash  == 1) {
            $status = Zakaz::STATUS_TRASH;
        }
        if ($data->result[0]->status == 0) {
            return true;
        }
        if ($data->result[0]->status == 2 && $data->result[0]->trash  != 1) {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($data->result[0]->status == 1) {
            $status = Zakaz::STATUS_HOLD;
        } 
        
        
        
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
