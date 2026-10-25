<?php

class Offer_Pinger_RocketCall extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
       
        list($pid, $token) = explode(',', $settings);
        $id = Providers_RocketCall::registerLead($pid, $token, $zakaz->name, $zakaz->phone, $zakaz->ip);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',', [$token, $id])
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        if ($zakaz->addstatus == 4)
            return;
        list( $token, $order) = explode(',', $zakaz->pinger_value);
        $status = Providers_RocketCall::getPaymentStatus($token, $order);


        if ($status == '1') {
            $zakaz->update(['addstatus' => 4]);
            return;
        }

        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        list( $token, $order) = explode(',', $zakaz->pinger_value);

        $res = Providers_RocketCall::getStatus($token, $order);
	$status = $res->status;
	$zakaz->update(['comments'=>$res->comment]);

        $statusNew = -1;
        if ($status == '4' || $status == '6' || $status == 8) {
            $statusNew = Zakaz::STATUS_REJECT;
        }
        if ($status == '5') {
            $statusNew = Zakaz::STATUS_HOLD;
        }
        if ($statusNew == -1)
            return;
        $zakaz->updateZakaz($zakaz->id, $statusNew, $res->comment);
        return true;
    }

}
