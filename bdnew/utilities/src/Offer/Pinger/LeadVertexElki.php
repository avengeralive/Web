<?php

class Offer_Pinger_LeadVertexElki extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        $id = Providers_LeadVertex::registerLead('elki2017', 10, 555, $zakaz, $offer->name);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $id
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        
        $order = $zakaz->pinger_value;
        
        $status = Providers_LeadVertex::getStatus('elki2017', 10, 555, $order);
        if ($status == 'processing') {
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'canceled' || $status=='spam') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($status == 'accepted' || $status=='paid') {
            $status = Zakaz::STATUS_APPROVED;
        }
        $comments = '';
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
