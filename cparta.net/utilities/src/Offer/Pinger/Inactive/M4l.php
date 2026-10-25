<?php

class Offer_Pinger_M4l extends Offer_Pinger {
	
		
    public function ping($settings, \Zakaz $zakaz) {
	

        list($offerId, $partnerId, $token) = explode(',', $settings);
        $res_id = Providers_M4l::registerLead($offerId, $partnerId, $token, $zakaz);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$res_id , $token]),
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        
        list($res_id , $token) = explode(',', $zakaz->pinger_value);

        $res = Providers_M4l::getStatus($res_id , $token);
        
        if($res->data){
            foreach ($res->data as $data){
               if($data->order != $res_id || $data->orderStatus == 0 || $data->orderStatus == 6){
                   return true;
               } 
               $st = $data->orderStatus;
                if(isset($data->comment)){
                    $comments = $data->comment;
                }else{
                    $comments='';
                }
                if ($st == 2) {
                    $status = Zakaz::STATUS_REJECT;
                } elseif ($st == 1) {
                    $status = Zakaz::STATUS_HOLD;
                } elseif ($st == 4) {
                    $status = Zakaz::STATUS_TRASH;
                }
                $zakaz->updateZakaz($zakaz->id, $status, $comments);
            }
        }

        return true;
    }

}
