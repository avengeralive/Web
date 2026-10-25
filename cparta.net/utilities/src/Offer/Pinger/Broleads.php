<?php

class Offer_Pinger_Broleads extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {

        list($stream) = explode(',', $settings);
        
        $id = Providers_Broleads::registerLead($stream, $zakaz);

        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$id])
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
