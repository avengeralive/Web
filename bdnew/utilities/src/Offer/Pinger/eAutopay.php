<?php

class Offer_Pinger_eAutopay extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($customer_api_key, $user_api_key, $good_id) = explode(',', $settings);
        
        $offer = Offer::getById($zakaz->offer_id);
        
        $id = Providers_eAutopay::registerLead($customer_api_key, $user_api_key, $good_id, $zakaz);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$customer_api_key, $user_api_key, $good_id, $id])
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        list($customer_api_key, $user_api_key, $good_id, $id) = explode(',', $settings);

        $res = Providers_eAutopay::getPaymentStatus($customer_api_key, $user_api_key, $id);
	$status = $res->status;
        if ($status == 'in_hands_paid' || $status == 'delivered_paid') {
            $zakaz->update(['addstatus'=>4]);
            return true;
        }
        if ($status == 'cancelled' || $status == 'returned') {
            $zakaz->update(['addstatus'=>5]);
            return true; 
        }
        
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        list($customer_api_key, $user_api_key, $good_id, $id) = explode(',', $zakaz->pinger_value);

        $res = Providers_eAutopay::getPaymentStatus($customer_api_key, $user_api_key, $id);
	$status = $res->status;
        $comments = $res->credentials->notes.' '.$res->credentials->author_comment.' '.$res->credentials->logist_comment;
	$zakaz->update(['comments'=>$comments]);

        if ($status == 'new') {
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'refused') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($status == 'confirmed'  || $status == 'in_hands_unpaid' || $status == 'sent' || $status == 'in_hands_paid' || $status == 'delivered_unpaid' || $status == 'ready_for_delivery' || $status == 'delivered_paid') {
            $status = Zakaz::STATUS_HOLD;
        }
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
