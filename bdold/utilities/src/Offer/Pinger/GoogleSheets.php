<?php

class Offer_Pinger_GoogleSheets extends Offer_Pinger {
	
		
    public function ping($settings, \Zakaz $zakaz) {
	

        list($spreadsheetId) = explode(',', $settings);
        Providers_GoogleSheets::registerLead($spreadsheetId, $zakaz);
        /*
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',',[$site_id, $apikey, $zakaz->id]),
        ]);
         * 
         */
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {
        return true;
    }

}
