<?php
namespace lib;
class SMS {

	function joinArrayValues($params)
    {
        $result = array();
        foreach ($params as $name => $value) {
            $result[$name] = is_array($value) ? join(',', ( is_array(array_values($value)[0]) ?  self::joinArrayValues($value) : $value)) : $value;
        }
        return $result;
    }


    function generateSign(array $params)
    {
    	//загружаем и инициализируем интерфейсы
		include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		load_interface( 'settings' );
		$dbsettings = &$GLOBALS['cotfw.settings']; //$dbsettings->val( 'dadata_api' )
      	$params['project'] = $dbsettings->val( 'mainsms_project' );
      	ksort($params);
      	return md5(sha1(join(';', array_merge($params, Array($dbsettings->val('mainsms_key'))))));
    }

	function send() {
		//загружаем и инициализируем интерфейсы
		include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		load_interface( 'settings' );
		$dbsettings = &$GLOBALS['cotfw.settings']; //$dbsettings->val( 'dadata_api' )

		$Sms = JBase::Get_Data('list5', ['f1557931993n'], ['id' => $_POST['tostatus']]);
		$pattern = $Sms->fetch_assoc();
		$ids = [];
		foreach ($_POST['ids'] as $key => $value) $ids[] = intval($value);
		$Result = JBase::Get_Data('list'.$_POST['list'], '*', ['id' => $ids]);
		while ($item = $Result->fetch_assoc()) {
			$item = Mustage::getData($item);
			$smspattern = $pattern['f1557931993n'];
			foreach ($item as $fields => $value) {
				$smspattern = str_replace('{{'.$fields.'}}', $value, $smspattern);
			}
			//$project = 'veliyev';
			$sender = 'VELIYEV';
			//$api_key = 'b226fde671a20';
			//$item['phone'] = '79778100107';
			//$step1 = $smspattern.";".$project.";".$item['phone'].";".$sender.";".$api_key;
			//$step2 = sha1($step1);
			//$sign = md5($step2);

			/*$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://mainsms.ru/api/message/send?project=".$project."&sender=".$sender."&message=".$smspattern."&recipients=".$item['phone']."&sign=".$sign);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			$headers = array();
			$headers[] = 'Accept: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			if (curl_errno($ch)) {
			    echo 'Error:' . curl_error($ch);
			}
			var_dump($result);
			curl_close ($ch);*/

			$params = array(
	            'recipients'    => $item['phone'],
	            'message'       => $smspattern,
	            'sender'        => 'VELIYEV',
	            'test'          => 0
	        );

			$params = self::joinArrayValues($params);
        	$sign = self::generateSign($params);
        	$params = array_merge(array('project' => $dbsettings->val( 'mainsms_project' )), $params);
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
        	//var_dump($response);
        	//var_dump($ids);
        	foreach ($ids as $key => $id) { //var_dump($id);
        		$Result2 = JBase::Get_Data('list'.$_POST['list'], ['log_robot'], ['id' => $id]);
				$val = $Result2->fetch_assoc();
				if ($val['log_robot'] == '') $arr = [];
				else $arr = json_decode($val['log_robot'], true);

				$arr[] = json_decode($response, true);
				$json = json_encode($arr, JSON_UNESCAPED_UNICODE);

				$x = JBase::Update_Field_Value_From_Id('list'.$_POST['list'], $id, "log_robot = '".$json."'");
				var_dump($x);
        	}
        	

		    
		}
	}



}




