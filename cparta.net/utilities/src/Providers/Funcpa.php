<?php
 
class Providers_Funcpa {
	public function telegram($text){
        if(is_array($text)) $text = implode(",",$text);
        $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
        $chat_id = "-323189907";

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
	}
	
	protected static function request($function, $vars = array())
	{
		$url = "http://api.funcpa.ru/v1/order/";
		if ($function=="status"){
				$url .= $vars['id']."/status/?key=".$vars['key'];
				//file_put_contents('/var/www/www-root/data/www/cparta.net/testping.txt', $url.'
				//',	 FILE_APPEND);
			}

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$data = curl_exec($ch);
		$logger = Registry::get('di')->logger;
        $logger->custom('text', var_export($data, 1));
		if (!$data) {
			throw new Exception("Не принят");
		}
		curl_close($ch);
		//self::telegram($data);
		return json_decode($data);
	}

	public static function registerLead($apikey, $stream, $zakaz) {
		$vars = [];
		// required params
		$vars['key'] = $apikey;
		$vars['stream'] = $stream;
		$vars['ip'] = $zakaz->ip;
		$vars['clientname'] = ($zakaz->name=='')?'Не указано':$zakaz->name;
		$vars['phone'] = $zakaz->phone;

		$res = self::request('order',$vars);
		if($res->status==200){
			$id = (isset($res->id))?intval($res->id):0;
			return $id;
		}else{
			throw new Exception('Error: '.$res->error);
		}
	}

	public static function getStatus($id){
		$vars['key'] = self::api_key;
		$vars['id'] = $id;
		$res = self::request('status', $vars);
		if(isset($res->status) && $res->status == 200) {
			return $res;
		}else{
			throw new Exception("Can't check status!");
		}
	}

}