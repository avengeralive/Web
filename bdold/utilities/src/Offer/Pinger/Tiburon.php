<?php

class Offer_Pinger_Tiburon extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {

	
        $hash = Providers_Tiburon::registerLead($this->offer->name, $zakaz->name, $zakaz->phone, $zakaz->ip, $zakaz->country, $zakaz->town);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $hash
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        $order = $zakaz->pinger_value;
        $res = Providers_Tiburon::getStatus([$order]);
        $status = false;
	$zakaz->update(['comments'=>$res->comment]);

        if ($res->status == '0') {
            return true; //ничего не сменилось, статус=1
        }
        if ($res->status == '1') {
            $status = Zakaz::STATUS_HOLD;
        } elseif ($res->status == '-1') {
            $status = Zakaz::STATUS_REJECT;
        }
        $comments = $res->comment;
        if ($status !==false) {
            $zakaz->updateZakaz($zakaz->id, $status, $comments);
        }
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        $order = $zakaz->pinger_value;
        $res = Providers_Tiburon::getPaymentStatus([$order]);

        $status = false;
        if ($res->is_payed == '0') {
            return true; //ничего не сменилось, статус=1
        }
        if ($res->is_payed == '1') {
            $zakaz->update(['addstatus' => 4]);
        } else {
            $zakaz->update(['addstatus' => 5, 'comments' => $res->comment]);
        }
        return true;
    }

}
