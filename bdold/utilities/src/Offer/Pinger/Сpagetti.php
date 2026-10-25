<?php

class Offer_Pinger_Сpagetti extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
        list($good_id, $apikey) = explode(',', $settings);

        $hash = Providers_Сpagetti::registerLead($zakaz->name, $zakaz->short_country, $zakaz->phone, $zakaz->ip, $zakaz->offer_id, $zakaz->useragent, $zakaz->referer, $zakaz->id, $good_id, $apikey);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $hash
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
