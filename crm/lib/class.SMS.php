<?php
namespace lib;
class SMS {

	private static $mainsms_key;
	private static $mainsms_project;
	private static $mainsms_sender;
	private static $sms_provider;

	public static function start() {
		include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		load_interface( 'settings' );
		$dbsettings = &$GLOBALS['cotfw.settings'];
		self::$mainsms_key = $dbsettings->val('mainsms_key');
		self::$mainsms_project = $dbsettings->val('mainsms_project');
		self::$mainsms_sender = $dbsettings->val('mainsms_project');
		self::$sms_provider = $dbsettings->val('sms_provider');
	}
	//создание маски
	function joinArrayValues($params) {
			$result = array();
			foreach ($params as $name => $value) {
			    $result[$name] = is_array($value) ? join(',', ( is_array(array_values($value)[0]) ?  self::joinArrayValues($value) : $value)) : $value;
			}
			return $result;
    }

   //создание подписи
   function generateSign(array $params) {
      	$params['project'] = self::$mainsms_project;
      	ksort($params);
      	return md5(sha1(join(';', array_merge($params, Array(self::$mainsms_key)))));
    }
   
   //функция отправки сообщения по шаблону из ajax
	function send() {
		self::start();
		$list = (int)$_POST['list'];
		$Sms = JBase::Get_Data('list5', ['f1557931993n'], ['id' => (int)$_POST['id']]); //id шаблона
		$pattern = $Sms->fetch_assoc();
		$ids = [];
		foreach ($_POST['ids'] as $key => $value) $ids[] = intval($value);
		$Result = JBase::Get_Data('list'.$list, '*', ['id' => $ids]);
		while ($item = $Result->fetch_assoc()) {
			$id = $item['id'];
			$item = Mustage::getData($item);
			$smspattern = $pattern['f1557931993n']; //текст сообщения
			foreach ($item as $fields => $value) {
				$smspattern = str_replace('{{'.$fields.'}}', $value, $smspattern);
			}
			$params = array(
				    'recipients'    => $item['phone'],
				    'message'       => $smspattern,
				    'sender'			=> self::$mainsms_sender,
				    'test'			  => 0
				);
			if (self::$sms_provider == 'mainsms') $rs = self::mainsms($params);
			if (self::$sms_provider == 'pimpay') $rs = self::pimpay($params);
			/*$params = self::joinArrayValues($params);															//формируем параметры
			$sign = self::generateSign($params);															     //создаем подпись
			$params = array_merge(array('project' => self::$mainsms_project), $params);      //шафлим параметры до нормального состояния
			$url = 'https://mainsms.ru/api/message/send';												    //урл отправки
			$post = http_build_query(array_merge($params, array('sign' => $sign)), '', '&'); //создаем строку запроса
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$response = curl_exec($ch);
			curl_close($ch);
			$rs = json_decode($response, true);;*/

			$Names = [
				'domain' => DOMAIN,
				'in' => $id,
				'out' => $item['phone'],
				'name' => $smspattern,
				'timeupdate' => time(),
				'status' => 1,
				'price' => $rs['price'],
	
			];
			JBase::Set_Data('list6', array_keys($Names), array_values($Names));

			//запись в лог робота
			$json = JBase::Get_Field_Value_From_Id('list'.$list, $id, 'log_robot');
			if (!json_decode($json, true)) $arr = [];
			else $arr = json_decode($json, true);
			$arr[] = $rs;
			$json = json_encode($arr, JSON_UNESCAPED_UNICODE);
			$x = JBase::Update_Field_Value_From_Id('list'. $list, $id, "log_robot = '".$json."'");
		}
	}
	
	//функция отправки смс после звонков робота
	function sendSMS($list, $id, $template) {
		self::start();
		$Sms = JBase::Get_Data('list5', ['f1557931993n'], ['id' => $template]); //id шаблона
		$pattern = $Sms->fetch_assoc();
		$Result = JBase::Get_Data('list'.$list, '*', ['id' => $id]);
		$item = $Result->fetch_assoc();
			$id = $item['id'];
			$item = Mustage::getData($item);
			$smspattern = $pattern['f1557931993n']; //текст сообщения
			foreach ($item as $fields => $value) {
				$smspattern = str_replace('{{'.$fields.'}}', $value, $smspattern);
			}
			$params = array(
				    'recipients'    => $item['phone'],
				    'message'       => $smspattern,
				    'sender'			=> self::$mainsms_sender,
				    'test'			  => 0
				);

			if (self::$sms_provider == 'mainsms') $rs = self::mainsms($params);
			if (self::$sms_provider == 'pimpay') $rs = self::pimpay($params);
			/*$params = self::joinArrayValues($params);
			$sign = self::generateSign($params);
			$params = array_merge(array('project' => self::$mainsms_project), $params);
			$url = 'https://mainsms.ru/api/message/send';
			$post = http_build_query(array_merge($params, array('sign' => $sign)), '', '&');
			
		   $ch = curl_init($url);
		   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		   curl_setopt($ch, CURLOPT_POST, 1);
		   curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		   $response = curl_exec($ch);
		   curl_close($ch);
		   $rs = json_decode($response, true);*/
		   
			$Names = [
				'domain' => DOMAIN,
				'in' => $id,
				'out' => $item['phone'],
				'name' => $smspattern,
				'timeupdate' => time(),
				'status' => 1,
				// 'price' => $rs['price'],
				'price' => 0
	
			];

			JBase::Set_Data('list6', array_keys($Names), array_values($Names));


			//запись в лог робота
			$json = JBase::Get_Field_Value_From_Id('list'.$list, $id, 'log_robot');
			if (!json_decode($json, true)) $arr = [];
			else $arr = json_decode($json, true);
			$arr[] = $rs;
			$json = json_encode($arr, JSON_UNESCAPED_UNICODE);
			$x = JBase::Update_Field_Value_From_Id('list'.$list, $id, "log_robot = '".$json."'");
	}

	//функция отправки конкретного сообщения
	function sendSingle($list, $id, $message) {
		//var_dump("It works");
		self::start();
		//$Sms = JBase::Get_Field_Value_From_Id('list5', $id, 'f1557931993n');
		//$pattern = $Sms->fetch_assoc();
		$Result = JBase::Get_Data('list'.$list, '*', ['id' => $id]);
		$item = $Result->fetch_assoc();
		$item = Mustage::getData($item);
		$params = array(
				'recipients'    => $item['phone'],
				'message'       => $message,
				'sender'			=> self::$mainsms_sender,
				'test'			  => 0
	    );
	    if (self::$sms_provider == 'mainsms') $rs = self::mainsms($params);
		if (self::$sms_provider == 'pimpay') $rs = self::pimpay($params);
		/*$params = self::joinArrayValues($params);
		$sign = self::generateSign($params);
		$params = array_merge(array('project' => self::$mainsms_project), $params);
		$url = 'https://mainsms.ru/api/message/send';
		$post = http_build_query(array_merge($params, array('sign' => $sign)), '', '&');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);
		$rs = json_decode($response, true);*/

		$Names = [
			'domain' => DOMAIN,
			'in' => $id,
			'out' => $item['phone'],
			// 'name' => $smspattern,
			'name' => '',
			'timeupdate' => time(),
			'status' => 1,
			'price' => $rs['price'],

		];
		JBase::Set_Data('list6', array_keys($Names), array_values($Names));


		//запись в лог робота
		$json = JBase::Get_Field_Value_From_Id('list'.$list, $id, 'log_robot');
		if (!json_decode($json, true)) $arr = [];
		else $arr = json_decode($json, true);
		$arr[] = $rs;
		$json = json_encode($arr, JSON_UNESCAPED_UNICODE);
		$x = JBase::Update_Field_Value_From_Id('list'.$list, $id, "log_robot = '".$json."'");
	}


	function mainsms($params) {
		$params = self::joinArrayValues($params);
		$sign = self::generateSign($params);
		$params = array_merge(array('project' => self::$mainsms_project), $params);
		$url = 'https://mainsms.ru/api/message/send';
		$post = http_build_query(array_merge($params, array('sign' => $sign)), '', '&');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);
		return json_decode($response, true);
	}

	function pimpay($params) {
		$url = 'https://api.inform.pimpay.ru/send-sms';
		$data = array(
			'phoneNumber' => $params['recipients'],
			'text' => $params['message']
		);
		$data_json = json_encode($data);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer e16776567f2da00777c183bdb53dca2e',
			'Content-Type: application/json'
		));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		return json_decode($response, true);
	}


	//история звонков
// 	function getHistory() {
// 		$Result = JBase::Query('SELECT * FROM list6');
// 		$Data = [];
// 		while ($Queue = $Result->fetch_assoc()) $Data[] = $Queue;
// 		return $Data;
// 	}


}




