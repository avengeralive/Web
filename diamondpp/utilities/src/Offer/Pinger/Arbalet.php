<?php
class Offer_Pinger_Arbalet extends Offer_Pinger {
    function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
        return $sendToTelegram;
    }

    public function ping($settings, \Zakaz $zakaz) {
	
        /*list($productId, $site, $apikey) = explode(',', $settings);

        $requestQuery = array(
            ''
        );

        $curl = curl_init();
		curl_setopt($curl,CURLOPT_URL, 'https://cpa78.info/api/?mode=addLead');
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $requestQuery);
		$result = curl_exec($curl);
		curl_close($curl);
		$result =json_decode($result, true);*/

        /*$zakaz->update([
            'pinger_type' => get_class($this),
            //'pinger_value' => implode(',',[$site, $productId, $apikey, $retail_id]),
            'pinger_value' => implode(',',[$retail_id]),
        ]);*/
        return true;
    }

    public function checkStatus( \Zakaz $zakaz) {

        return true;        
        
    }
    public function checkStatus2( \Zakaz $zakaz) {

        return true;        
        
    }
    
    
}
