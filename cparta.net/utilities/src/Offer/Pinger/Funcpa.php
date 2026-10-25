<?php
 
class Offer_Pinger_Funcpa extends Offer_Pinger {
	public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    }
    public function ping($settings, \Zakaz $zakaz) {
		    //  $logger = Registry::get('di')->logger;
		
		list($stream, $sub, $apikey) = explode(",", $settings);
		$hash = Providers_Funcpa::registerLead($apikey, $stream, $zakaz);
		        // $logger->info('fancpa order#' . $zakaz->id . ', response: ' . var_export($hash, 1));
        $zakaz->update([
            'pinger_type' => get_class($this),
            'pinger_value' => $hash
        ]);
        return true;
    }

    public function checkStatus(\Zakaz $zakaz) {
    	//file_put_contents('/var/www/www-root/data/www/cparta.net/test_ping2.txt', $zakaz->id.' - '.$zakaz->pinger_type.' - '.$zakaz->pinger_value.'
//', FILE_APPEND);
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

