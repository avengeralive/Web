<?php

class Offer_Pinger_ApiLeads extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
      

        $hash = Providers_ApiLeads::registerLead($zakaz->name, $zakaz->short_country, $zakaz->phone, $zakaz->ip, $settings);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $hash
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        $order = $zakaz->pinger_value;
        $res = Providers_ApiLeads::getStatus($order);
        $status = $res->status;
        if ($status == 'accept' || $status=='expect') {
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'confirm') {
            $status = Zakaz::STATUS_HOLD;
        } elseif ($status == 'reject') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($status == 'trash' || $status=='fail') {
            $status = Zakaz::STATUS_TRASH;
        }
        $comments = $res->comment;
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }

}
