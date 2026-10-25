<?php

class Offer_Pinger_Affbay extends Offer_Pinger {

    
		
    public function ping($settings, \Zakaz $zakaz) {
	

        list($site_id, $apikey) = explode(',', $settings);
        Providers_Affbay::registerLead($site_id, $apikey, $zakaz);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$site_id, $apikey, $zakaz->id]),
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        return true;
    }
    
}
