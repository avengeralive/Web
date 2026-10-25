<?php
	namespace lib;

	$post = ($_POST) ?: $_GET;
	//echo json_encode($post);

	$response0 = 'Ожидание действия от пользователя';
	
	
	
	
	
	switch(strtolower($post['select'])) {
		case 'tel':
		case 'krossi':
		case 'topsale':
		case 'tel-2':
			$token = '1234567';
		break;
		case 'fun':
		case 'cpa-crm':
		case 'cpa-sale':
			$token = '12345678910';
		break;
		case 'fun-2':
			$token = '9SUx2s5hqwXZdSEvAbOj';
		break;
		case 'cpa-crm2':
			$token = '123654789';
		break;
		case 'fb':
		case 'fb-2':
			$token = '413439610';
		break;
		default:
			$token = false;
		break;
	}
	
	switch(strtolower($post['api'])) {
		case '1':
			$authToken = 'PjA5ck2gkDEnYfoJXm68YpuJ6y4EE1_9';
			$authKey = 'c3YzdHByb0B5YW5kZXgucnU6NDEzNDM5NjEwRA=='; //sv3tpro@yandex.ru
		break;
		case '2':
			$authToken = 'kShAyFOyZ8D8TIxlZfUamLudIEukMRZD';
			$authKey = 'c3YzdHBybzFAeWFuZGV4LnJ1OjQxMzQzOTYxMEQ='; //sv3tpro1@yandex.ru
		break;
		default:
			$authKey = false;
			$authToken = false;
		break;
	}
	
	switch(strtolower($post['select'])) {
		case 'fun':
		case 'fun-2':
		case 'topsale':
			$status = '98';
		break;
		case 'cpa-sale':
			$status = '87';
		break;
		case 'tel-2':
		case 'cpa-crm2':
			$status = '96';
		break;
		case 'tel':
			$status = '97';
		break;
		case 'krossi':
			$status = '95';
		break;
		break;
		case 'cpa-crm':
			$status = '99';
		break;
		case 'fb':
		case 'fb-2':
			$status = '86';
		break;
		default:
			$status = false;
		break;
	}
	
	if ($status && $token && $authKey && $authToken && ((int)$post['id'] == $post['id'])) {
		//$data_json = json_encode($ids);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://otpravka-api.pochta.ru/1.0/batch/'. $post['id'] .'/shipment');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: AccessToken '. $authToken,
			'X-User-Authorization: Basic '. $authKey,
			"Content-Type: application/json;charset=UTF-8"
		));
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($crl, CURLOPT_HEADER, true);
		$response  = curl_exec($ch);
		curl_close($ch);
	}
	
	
	
	
	
// 	{
//     "address-type-to": "DEFAULT",
//     "area-to": "р-н Венгеровский",
//     "barcode": "11175438330077",
//     "batch-category": "WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY",
//     "batch-name": "529",
//     "batch-status": "CREATED",
//     "comment": "26320-4134",
//     "completeness-checking": false,
//     "delivery-time": {
//         "max-days": 13, "min-days": 11
//     },
//     "ground-rate": 20750,
//     "ground-rate-with-vat": 24900,
//     "ground-rate-wo-vat": 20750,
//     "house-to": "60",
//     "id": 112277380,
//     "index-to": 632253,
//     "insr-rate": 13187,
//     "insr-rate-with-vat": 15825,
//     "insr-rate-wo-vat": 13187,
//     "insr-value": 389000,
//     "legal-hid": "16b3158e-b38e-40b0-bde4-7100a874f332",
//     "mail-category": "WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY",
//     "mail-direct": 643,
//     "mail-rank": "WO_RANK",
//     "mail-type": "POSTAL_PARCEL",
//     "manual-address-input": false,
//     "mass": 375,
//     "mass-rate": 20750,
//     "mass-rate-with-vat": 24900,
//     "mass-rate-wo-vat": 20750,
//     "order-num": "26320-4134",
//     "payment": 389000,
//     "payment-method": "CASHLESS",
//     "place-to": "с Петропавловка 2-я",
//     "pochtaid-hid": "16b2d5c0-872f-4cce-9ada-b122295989b9",
//     "postmarks": [ "NO_RETURN","NONSTANDARD"],
//     "postoffice-code": "109440",
//     "recipient-name": "Герасимов Михаил Иванович",
//     "region-to": "обл Новосибирская",
//     "room-to": "1",
//     "slash-to": "1",
//     "str-index-to": "632253",
//     "street-to": "ул Школьная",
//     "tel-address": 79232250593,
//     "total-rate-wo-vat": 33937,
//     "total-vat": 6788,
//     "transport-type": "SURFACE",
//     "version": 0
//		}

?>



<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	</head>
	<body>
		<h3>Какой-то заголовок</h3>
		<div class="selector"><form action="/check.php" name="check">
			<select class="selector_account" name="api">
				<option value="0" selected="selected">Проект не выбран</option>
				<option value="1">Аккаунт 1</option>
				<option value="2">Аккаунт 2</option>
			</select>
			<select class="selector_list" name="select">
				<option data-id="0" value="0" selected="selected">Проект не выбран</option>
				<option data-id="98" value="Fun">Fun</option>
				<option data-id="98" value="Fun-2">Fun-2</option>
				<option data-id="99" value="Cpa-crm">Cpa-crm</option>
				<option data-id="96" value="Cpa-crm2">Cpa-crm2</option>
				<option data-id="86" value="Fb">Fb</option>
				<option data-id="86" value="Fb-2">Fb-2</option>
				<option data-id="87" value="Cpa-sale">Cpa-sale</option>
				<option data-id="98" value="Topsale">Topsale</option>
				<option data-id="95" value="Krossi">Krossi</option>
				<option data-id="97" value="tel">tel</option>
				<option data-id="96" value="tel-2">tel-2</option>
			</select>
			<input type="text" class="selector__input" placeholder="ID партии" name="id">
			<button type="submit" class="go">Получить треки</button>
			</form>
		</div>
		<div class="echo"></div>
		<div class="total">
			Найдено треков:<input class="totalAll"> 
			Обработано треков:<input class="totalOk">
		</div><br><br><br><br><br><br><br>
		<code><?php 
			echo '<code item="start">Почта России: '. $response0 .'</code><br><br>';
			$resp = json_decode($response, true);
			$count = count($resp);
			foreach ($resp as $key) {
				if (isset($key['barcode']) && $key['barcode'] == (int)$key['barcode']) {
					$url1 = 'https://'. $post['select'] .'.leadvertex.ru/api/admin/getOrdersIdsByCondition.html?token='. $token .'&russianpostTrack='. (int)$key['barcode'];
					$url2 = 'https://'. $post['select'] .'.leadvertex.ru/api/admin/updateOrder.html?token='. $token .'&id='. $updateOrder .'&status='. $status;
				
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url1);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$res1  = curl_exec($ch);
					curl_close($ch);
		
					if (!empty(json_decode($res1, true))) {
						$message = 'найден в заказе #'. json_decode($res1, true)[0];
							
// 						$ch = curl_init();
// 						curl_setopt($ch, CURLOPT_URL, $url2);
// 						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// 						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 						$res2  = curl_exec($ch);
// 						curl_close($ch);
// 					
// 						if (!empty(json_decode($res2, true))) {
// 							$message = 'Статус заказа #'. json_decode($res1, true)[0] .' обновлен на '. $status;
// 						} else {
// 							$message = 'Ошибка при обновлении статуса';
// 						}
					} else {
						$message = 'не найден в проекте '. $post['select'];
					}
					echo 'Трек-номер: <code>'. $key['barcode'] .' - '. $message .'</code><br>';
				}
				//break;
			}
		?></code><br><br><br><br><br><br><br>
		<script>
			let ret = <?=json_encode($post)?>;
			console.log(ret)
			$('.selector_list').val(ret.select)
			$('.selector__input').val(ret.id)
			$('.selector_account').val(ret.api)
			$('.totalAll').val(<?=$count?>)
		</script>
		
		
		
		<style>
			body {
    padding: 0;
    margin: 0;
    text-align: center;
    font-size: 14px;
    font-family: arial;
}

h3 {
    margin: 20px;
    font-size: 23px;
}

select, input, button {
    background: white;
    border: 1px #cccccc solid;
    padding: 6px 10px;
    font-family: arial;
    font-size: 14px;
    width: 200px;
    border-radius: 0;
    vertical-align: top;
    -webkit-appearance: none;
    -webkit-border-radius: 0;
    outline: none;
}
code {
    padding: 2px 4px;
    font-size: 90%;
    color: #c7254e;
    background-color: #f9f2f4;
    border-radius: 4px;
}

code, kbd, pre, samp {
    font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
}
code, kbd, pre, samp {
    font-family: monospace, monospace;
    font-size: 1em;
}
button.go {
    background: #acda7e;
    cursor: pointer;
    border-color: transparent;
}

.selector {
    margin-bottom: 35px;
}

.total input {
    width: 100px;
    margin: 0 10px;
    background: #ececec;
    pointer-events: none;
}
		</style>
	</body>
</html>



