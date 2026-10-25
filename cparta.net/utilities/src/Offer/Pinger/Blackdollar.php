<?php
 
class Offer_Pinger_Blackdollar extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
		     $logger = Registry::get('di')->logger;
		
		list($stream) = explode(",", $settings);
		$hash = Providers_Blackdollar::registerLead($stream, $zakaz);
		        $logger->custom('blackdollar',  'order#' . $zakaz->id . ', response: ' . var_export($hash, 1));
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $hash
        ]);
        return true;
    }

    public function checkStatus(\Zakaz $zakaz) {
		$res = Providers_Blackdollar::getStatus($zakaz->pinger_value);
		if($res===false) return;
		$status = $res->order_status;
		$comments = $res->comments;
		if($status==0){
			$status = Zakaz::STATUS_REJECT;
		}elseif ($status==5){
			$status = Zakaz::STATUS_TRASH;
		}elseif ($status==3){
			$status = Zakaz::STATUS_APPROVED;
		}else{
			$status = Zakaz::STATUS_WAITING;
		}
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

}

