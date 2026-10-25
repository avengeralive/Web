<?php
 
class Offer_Pinger_Funcpa extends Offer_Pinger {

    public function ping($settings, \Zakaz $zakaz) {
		     $logger = Registry::get('di')->logger;
		
		list($stream, $api) = explode(",", $settings);
		$hash = Providers_Funcpa::registerLead($stream, $zakaz);
		        $logger->info('fancpa order#' . $zakaz->id . ', response: ' . var_export($hash, 1));
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $hash
        ]);
        return true;
    }

    public function checkStatus(\Zakaz $zakaz) {
		$res = Providers_Funcpa::getStatus($zakaz->pinger_value);
		if($res===false) return;
		$status = $res->order_status;
		$comments = $res->comments;
		if($status==0){
			$status = Zakaz::STATUS_REJECT;
		}elseif ($status==5){
			$status = Zakaz::STATUS_TRASH;
		}elseif ($status==3){
			$status = Zakaz::STATUS_HOLD;
		}else{
			$status = Zakaz::STATUS_WAITING;
		}
        $zakaz->updateZakaz($zakaz->id, $status, $comments);
        return true;
    }

    public function checkStatus2(\Zakaz $zakaz) {
        return true;
    }

}

