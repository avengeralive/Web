<?php

class Offer_Pinger_KMA extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
      

        $hash = Providers_KMA::registerLead($settings, $zakaz->name, $zakaz->phone, $zakaz->ip, $zakaz->referer, $zakaz->user_id);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $hash
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        $order = $zakaz->pinger_value;
        $status = Providers_KMA::getStatus($order);

        if ($status == 'P') {
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'A') {
            $status = Zakaz::STATUS_HOLD;
        } elseif ($status == 'D') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($status == 'F') {
            $status = Zakaz::STATUS_TRASH;
        }
        $comments = '';
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }

}
