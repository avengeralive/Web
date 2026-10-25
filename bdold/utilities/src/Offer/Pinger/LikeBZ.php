<?php

class Offer_Pinger_LikeBZ extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {

        include_once START_PATH . '/../includes/RetailCrmApi/index.php';

        $id = Providers_likebz::registerLead($zakaz->name, $zakaz->phone, $zakaz->email);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $id,
        ]);
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        return true;
    }
    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }
}
