<?php
namespace lib;
//https://ru.stackoverflow.com/questions/953618/bad-request-%D0%9F%D0%BE%D1%87%D1%82%D0%B0-%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D0%B8

class RusPostApi {
	private static $token;
	private static $key;

	public static function russianPostParcel($list, $ids, $account) {
		$data = [
			"orders" => $ids,
			"template" => 1,
			"post_type" => 'POSTAL_PARCEL',
			"partion" => 1,
			"list" => $list,
			"account" => $account
		];
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://pochta.blackdollar.ru/add.php');
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, ['data' => $data_json]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response  = curl_exec($ch);
		curl_close($ch);

		//$orders = self::start($list, $ids, $account);
		//self::russianpostapi(1, 'POSTAL_PARCEL', true, $orders, $list);
	}

	public static function russianPostParcelToNewStatus($list, $ids, $account) {
		$data = [
			"orders" => $ids,
			"template" => 1,
			"post_type" => 'POSTAL_PARCEL',
			"partion" => 0,
			"list" => $list,
			"account" => $account
		];
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://pochta.blackdollar.ru/add.php');
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, ['data' => $data_json]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response  = curl_exec($ch);
		curl_close($ch);

		//$orders = self::start($list, $ids, $account);
		//self::russianpostapi(1, 'POSTAL_PARCEL', false, $orders, $list);
	}

	public static function russianPostOnlineParcel($list, $ids, $account) {
		$data = [
			"orders" => $ids,
			"template" => 1,
			"post_type" => 'ONLINE_PARCEL',
			"partion" => 1,
			"list" => $list,
			"account" => $account
		];
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://pochta.blackdollar.ru/add.php');
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, ['data' => $data_json]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response  = curl_exec($ch);
		curl_close($ch);
		/*$orders = self::start($list, $ids, $account);
		$new_ids = self::russianpostapi(1, 'ONLINE_PARCEL', true, $orders, $list);
		$last_ids = array_diff($ids, $new_ids);
		$orders = self::start($list, $last_ids, $account);
		self::russianpostapi(1, 'POSTAL_PARCEL', true, $orders, $list);*/
	}

	public static function russianPostOnlineParcelToNewStatus($list, $ids, $account) {
		$data = [
			"orders" => $ids,
			"template" => 1,
			"post_type" => 'ONLINE_PARCEL',
			"partion" => 0,
			"list" => $list,
			"account" => $account
		];
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://pochta.blackdollar.ru/add.php');
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, ['data' => $data_json]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response  = curl_exec($ch);
		curl_close($ch);
		//var_dump($response);
		//die();
		/*$orders = self::start($list, $ids, $account);
		$new_ids = self::russianpostapi(1, 'ONLINE_PARCEL', false, $orders, $list);
		$last_ids = array_diff($ids, $new_ids);
		$orders = self::start($list, $last_ids, $account);
		self::russianpostapi(1, 'POSTAL_PARCEL', false, $orders, $list);*/
	}

	public static function russianPostOnlineCourier($list, $ids, $account) {
		$data = [
			"orders" => $ids,
			"template" => 1,
			"post_type" => 'ONLINE_COURIER',
			"partion" => 1,
			"list" => $list,
			"account" => $account
		];
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://pochta.blackdollar.ru/add.php');
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, ['data' => $data_json]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response  = curl_exec($ch);
		curl_close($ch);
		//var_dump($response);
		//die();
		/*$orders = self::start($list, $ids, $account);
		$new_ids = self::russianpostapi(1, 'ONLINE_PARCEL', false, $orders, $list);
		$last_ids = array_diff($ids, $new_ids);
		$orders = self::start($list, $last_ids, $account);
		self::russianpostapi(1, 'POSTAL_PARCEL', false, $orders, $list);*/
	}

	public static function russianPostOnlineCourierToNewStatus($list, $ids, $account) {
		$data = [
			"orders" => $ids,
			"template" => 1,
			"post_type" => 'ONLINE_COURIER',
			"partion" => 0,
			"list" => $list,
			"account" => $account
		];
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://pochta.blackdollar.ru/add.php');
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, ['data' => $data_json]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response  = curl_exec($ch);
		curl_close($ch);
		//var_dump($response);
		//die();
		/*$orders = self::start($list, $ids, $account);
		$new_ids = self::russianpostapi(1, 'ONLINE_PARCEL', false, $orders, $list);
		$last_ids = array_diff($ids, $new_ids);
		$orders = self::start($list, $last_ids, $account);
		self::russianpostapi(1, 'POSTAL_PARCEL', false, $orders, $list);*/
	}

	public static function start($list, $ids, $account = 1) {
		$auth = JBase::Get_Data('list23', '*', ['id' => $account]);
		$auth_data = $auth->fetch_assoc();
		self::$token = $auth_data['f1561714784n'];
		self::$key = base64_encode($auth_data['name'].':'.$auth_data['f1561714768n']);
		$ord = JBase::Get_Data('list'.$list, '*', ['id' => $ids]);
		$orders = array();
		while ($order_tpl = $ord->fetch_assoc()) $orders[] = $order_tpl;
		return $orders;
	}

	public function normalizeAddress($address) {
		$data = array(0 => (object) array(
			"id" => 1,
			"original-address" => $address
		));
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://otpravka-api.pochta.ru/1.0/clean/address');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: AccessToken '.self::$token,
			'X-User-Authorization: Basic '.self::$key,
			"Content-Type: application/json;charset=UTF-8"
		));
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response  = curl_exec($ch);
		curl_close($ch);
		return json_decode($response, true)[0];
	}

	public function getOrders() {
		$ids = $_REQUEST['ids'];
		$orders = [];
		for ($list = 14; $list <= 20; $list++) {
			$ord = JBase::Get_Data('list'.$list, '*', ['id' => $ids]);
			while ($order_tpl = $ord->fetch_assoc()) {
				$order_tpl['list'] = $list;
				$orders[] = $order_tpl;
			}
		}
		echo json_encode($orders);
		die();
	}

	public function getPattern() {
		$tpl = JBase::Get_Data('list11', '*', ['account' => $_REQUEST['id']]);
		$pattern = $tpl->fetch_assoc();
		echo json_encode($pattern);
		die();
	}

	public function returnAuth() {
		$auth = JBase::Get_Data('list23', '*', ['id' => $_REQUEST['account']]);
		$auth_data = $auth->fetch_assoc();
		echo json_encode(['token' => $auth_data['f1561714784n'], 'key' => base64_encode($auth_data['name'].':'.$auth_data['f1561714768n'])]);
		die();
	}

	public function changeStatus() {
		$data['ids'] = $_REQUEST['ids'];
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://pochta.blackdollar.ru/getinfo.php');
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, ['data' => $data_json]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response  = curl_exec($ch);
		$data = json_decode($response, true);
		foreach ($data as $key => $value) {
			JBase::Update_Field_Value_From_Id('list'.$value['list'], $value['order'], "russianpostTrack = '".$value['rpt_barcode']."'");
			JBase::Update_Field_Value_From_Id('list'.$value['list'], $value['order'], "tarif = '".$value['rpt_tarif']."'");
			if ($value['post_type'] == 'ONLINE_PARCEL') JBase::statusChange($value['list'], [$value['order']], 56);
			if ($value['post_type'] == 'POSTAL_PARCEL') JBase::statusChange($value['list'], [$value['order']], 55);
		}
		die();
	}

	public function rpa() {
		$partion = true;
		$data = array();
		$data['orders'] = [1000000, 1000308];
		$data['pattern'] = 13;
		$data['post_type'] = 'POSTAL_PARCEL';
		$data['partion'] = $partion;
		$data['list'] = 20;
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://pochta.blackdollar.ru/add.php');
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, ['data' => $data_json]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response  = curl_exec($ch);
		curl_close($ch);
		var_dump($response);
		die();
	}

	public static function russianpostapi($template, $post_type, $partion, $orders, $list) {
		$tpl = JBase::Get_Data('list11', '*', ['id' => $template]);
		$pattern = $tpl->fetch_assoc();
		/*
		$data = array();
		$data['orders'] = $orders;
		$data['pattern'] = $pattern;
		$data['post_type'] = $post_type;
		$data['partion'] = $partion;
		$data['list'] = $list;
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://pochta.blackdollar.ru/add.php');
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response  = curl_exec($ch);
		curl_close($ch);
		*/

		$data = array();
		foreach ($orders as $order) {
			$address = self::normalizeAddress($order['postIndex'].' '.$order['region'].' '.$order['city'].' '.$order['address'].' '.$order['house'].' '.$order['flat']);
			//var_dump($order);
			//var_dump($address);
			$inner = array(
				"address-type-to" => $pattern['to_typeAddress'],
				//"area-to" => "string",
				//"branch-name" => "string",
				//"completeness-checking" => true,
				"compulsory-payment" => $order['total'] * 100,
				//"corpus-to" => $address['corpus'],
				//"courier" => true,
				/*"customs-declaration" => (object) array(
					"certificate-number" => "string",
					"currency" => "string",
					"customs-entries" => array(
						(object) array(
							"amount" => 0,
							"country-code" => 0,
							"description" => "string",
							"tnved-code" => "string",
							"value" => 0,
							"weight" => 0,
						),
					),
					"entries-type" => "GIFT",
					"invoice-number" => "string",
					"license-number" => "string",
					"with-certificate" => true,
					"with-invoice" => true,
					"with-license" => true,
				),*/
				//"delivery-with-cod" => true,
				/*"dimension" => (object) array(
					"height" => 0,
					"length" => 0,
					"width" => 0
				),*/
				//"dimension-type" => "S",
				//"easy-return" => true,
				/*"ecom-data" => (object) array(
					"delivery-point-index" => "string",
					"delivery-rate" => 0,
					"delivery-vat-rate" => 0,
					"services" => array("WITHOUT_SERVICE"),
				),*/
				//"envelope-type" => "C4",
				"fragile" => false,
				"given-name" => $order['name'],
				/*"goods" => (object) array(
					"items" => $items,
				),*/
				//"hotel-to" => $address['hotel'],
				//"house-to" => $address['house'],
				"index-to" => $order['postIndex'],
				"insr-value" => $order['total'] * 100,
				//"inventory" => true,
				//"letter-to" => $address['letter'],
				//"location-to" => $address['location'],
				"mail-category" => $pattern['sender_mailCtg'],
				"mail-direct" => $pattern['sender_country'],
				"mail-type" => $post_type,
				"mass" => $order['weight'],
				//"middle-name" => "string",
				"no-return" => true,
				//"notice-payment-method" => "CASHLESS",
				//"num-address-type-to" => "string",
				//"office-to" => "string",
				"order-num" => $order['id'],
				"payment" => $order['total'] * 100,
				//"payment-method" => "CASHLESS",
				"place-to" => $address['place'],
				"postoffice-code" => $pattern['sender_postOfficeIndex'],
				//"raw-address" => "string",
				"recipient-name" => $order['name'],
				"region-to" => $address['region'],
				//"room-to" => "string",
				//"slash-to" => "string",
				//"sms-notice-recipient" => 0,
				//"str-index-to" => "string",
				"street-to" => $address['street'],
				"surname" => $order['name'],
				//"tel-address" => 0,
				//"transport-type" => "SURFACE",
				//"vladenie-to" => "string",
				//"vsd" => true,
				//"with-electronic-notice" => true,
				//"with-order-of-notice" => true,
				//"with-simple-notice" => true,
				//"wo-mail-rank" => true
			);
			if (isset($address['building'])) $inner["building-to"] = $address['building'];
			if (isset($address['corpus'])) $inner["corpus-to"] = $address['corpus'];
			if (isset($address['hotel'])) $inner["hotel-to"] = $address['hotel'];
			if (isset($address['letter'])) $inner["letter-to"] = $address['letter'];
			if (isset($address['area'])) $inner["area-to"] = $address['area'];
			if (isset($address['house'])) $inner["house-to"] = $address['house'];
			if (isset($address['room'])) $inner["room-to"] = $address['room'];
			if (isset($address['slash'])) $inner["slash-to"] = $address['slash'];
			if (isset($address['num-address-type'])) $inner["num-address-type-to"] = $address['num-address-type'];
			$data[] = (object) $inner;
		}
		$data_json = json_encode($data);
		var_dump($data_json);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://otpravka-api.pochta.ru/1.0/user/backlog');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: AccessToken '.self::$token,
			'X-User-Authorization: Basic '.self::$key,
			"Content-Type: application/json;charset=UTF-8"
		));
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response  = curl_exec($ch);
		curl_close($ch);
		var_dump($response);
		$json_resp = json_decode($response, true);

		$orderids = [];
		if (isset($json_resp["result-ids"])) {
			$ids = $json_resp["result-ids"];
			foreach ($ids as $k => $order) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://otpravka-api.pochta.ru/1.0/backlog/'.$order);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Authorization: AccessToken '.self::$token,
					'X-User-Authorization: Basic '.self::$key,
					"Content-Type: application/json;charset=UTF-8"
				));
				curl_setopt($ch, CURLINFO_HEADER_OUT, true);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, false);
				$response  = curl_exec($ch);
				$dt = json_decode($response, true);
				//var_dump($dt);
				curl_close($ch);
				JBase::Update_Field_Value_From_Id('list'.$list, $dt['order-num'], "russianpostTrack = '".$dt['barcode']."'");
				if ($post_type == 'ONLINE_PARCEL') JBase::statusChange($list, [$dt['order-num']], 56);
				if ($post_type == 'POSTAL_PARCEL') JBase::statusChange($list, [$dt['order-num']], 55);
				$orderids[] = $dt['order-num'];
			}
			if ($partion == true) {
				$data_json = json_encode($ids);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://otpravka-api.pochta.ru/1.0/user/shipment');
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Authorization: AccessToken '.self::$token,
					'X-User-Authorization: Basic '.self::$key,
					"Content-Type: application/json;charset=UTF-8"
				));
				curl_setopt($ch, CURLINFO_HEADER_OUT, true);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, false);
				$response  = curl_exec($ch);
				curl_close($ch);
			}
		}
		return $orderids;
	}

}




