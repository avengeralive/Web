<?php
class Offer_Pinger_LeadVertexKZIPHONE extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {

	
       
	throw new Exception("KZ, KG disabled");		
		list($sub, $webmasterID, $token) = explode(',', $settings);
        $offer = Offer::getById($zakaz->offer_id);
		
		
        $logger = Registry::get('di')->logger;
        $logger->info('LEAD: sub :' . $sub . '||| $webmasterID :' .$webmasterID . ' ||| token:' .$token.'||| '.$zakaz->short_country);	
        
        $id = Providers_LeadVertex::registerLead($sub, $webmasterID, $token, $zakaz, $offer->name);
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => implode(',', [$sub, $webmasterID, $token, $id])
        ]);
        return true;
    }

    public function checkStatus2( \Zakaz $zakaz) {
        list( $sub, $webmasterID, $token, $order) = explode(',', $zakaz->pinger_value);

        $status = Providers_LeadVertex::getPaymentStatus($sub, $webmasterID, $token, $order);
        if ($status == '-1') {
            $zakaz->update(['addstatus'=>5]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == '1') {
            $zakaz->update(['addstatus'=>4]);
            return true; //ничего не сменилось, статус=1
        }
        
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        list( $sub, $webmasterID, $token, $order) = explode(',', $zakaz->pinger_value);

        $res = Providers_LeadVertex::getStatus($sub, $webmasterID, $token, $order);
		$status = $res->status;
		
        //$logger = Registry::get('di')->logger;
       //$logger->info('LEADVERTEX order#' . $zakaz->id . ', response: ' . var_export($res, 1));
		
        if ($status == 'processing') {
		$zakaz->update(['comments'=>$res->fields->comment]);
            return true; //ничего не сменилось, статус=1
        }
        if ($status == 'canceled' || $status == 'spam') {
            $status = Zakaz::STATUS_REJECT;
        } elseif ($status == 'accepted' || $status == 'paid') {
            $status = Zakaz::STATUS_HOLD;
        }
        $comments = $res->fields->comment;
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}
