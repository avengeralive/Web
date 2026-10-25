<?php
 
class Providers_Blackdollar {

	const api_key="05892ddc215ea67db7cc53ad1f6493a1";

	protected static function request($function, $vars = array())
	{
	$url = "http://api.blackdollar.ru/v1/order/";
	if ($function=="status"){
			$url .= $vars['id']."/status/?key=".$vars['key'];
		}

		$ch = curl_init($url);

		if ($function!="status"){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$data = curl_exec($ch);
		$logger = Registry::get('di')->logger;
        $logger->custom('blackdollar', 'text : '.var_export($data, 1));
		if (!$data) {
			throw new Exception("Не принят");
		}
		curl_close($ch);
		return json_decode($data);
	}

	public static function registerLead($stream, $zakaz) {
		$vars = [];
		// required params
		$vars['key'] = self::api_key;
		$vars['stream'] = $stream;
		$vars['ip'] = $zakaz->ip;
		$vars['clientname'] = $zakaz->name;
		$vars['phone'] = $zakaz->phone;
        $vars['externalWebmaster'] = $zakaz->user_id;
        $vars['referer'] = $zakaz->referer;
        
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