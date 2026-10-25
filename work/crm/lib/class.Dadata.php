<?php 
namespace lib;

/**
* class.Dadata.php
*
* Библиотека с функциями для работы API Dadata.ru
* подгружается через автоподгрузку классов
*
*
**/

class Dadata {
    
	public function suggest() {
	
		//загружаем и инициализируем интерфейсы
		include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		load_interface( 'settings' );
		$dbsettings = &$GLOBALS['cotfw.settings'];
		
		if (isset($_POST['type'])) {
			switch ($_POST['type']) {
				case 'address':
					$fields = ['query' => $_POST['query'], 'count' => 4];
					$url = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address';
				break;
				case 'name':
					$fields = ['query' => $_POST['query'], 'count' => 1];
					$url = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/name';
				break;
				case 'email':
					$fields = ['query' => $_POST['query'], 'count' => 4];
					$url = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/email';
				break;
			}
			$result = false;
			if ($ch = curl_init($url)) {
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Accept: application/json',
					'Authorization: Token '. $dbsettings->val( 'dadata_api' )
				));
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
				$result = curl_exec($ch);
				$result = json_decode($result, true);
				curl_close($ch);
			}
			return $result;
		}
	}

	//if dadata_pay - Платные подсказки

	// Стандартизация одного значения конкретного типа
	public function clean2() {
		$requestData = self::clean($_POST['type'], $_POST['query']);
		return $requestData[0];
		//return $requestData;
	}
	
	// Стандартизация одного значения конкретного типа
	public function clean($type, $data) {
        $requestData = array($data);
        return self::executeRequest("https://dadata.ru/api/v2/clean/$type", $requestData);
    }
    // Стандартизация нескольких значений одного типа
    public function cleanRecord($structure, $record) {
        $requestData = array(
          "structure" => $structure,
          "data" => array($record)
        );
        return self::executeRequest("https://dadata.ru/api/v2/clean", $requestData);
    }

    private function executeRequest($url, $data) {
    
		//загружаем и инициализируем интерфейсы
		include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		load_interface( 'settings' );
		$dbsettings = &$GLOBALS['cotfw.settings'];
		
		$result = false;
		if ($curl = curl_init($url)) {
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
             'Content-Type: application/json',
             'Accept: application/json',
             'Authorization: Token '. $dbsettings->val( 'dadata_api' ),
             'X-Secret: '. $dbsettings->val( 'dadata_key' )
          ));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
			$result = curl_exec($curl);
			curl_close($curl);
		}
		return json_decode($result, true);
	}
    

// $apiKey = "8ecaa3cb70560af74c3fea2918795beb195440b8";
// $secretKey = "cf8c7212059d94906a8162f22270dd3f80e18ec2";
// $dadata = new Dadata($apiKey, $secretKey);
// // Стандартизация одного значения конкретного типа
// $result = $dadata->clean('name', 'Сергей Владимерович Иванов');
// print_r($result);
// // Стандартизация нескольких значений одного типа
// // Допускается не более 1 ФИО, 3 адресов, 3 телефонов, 3 email
// $structure = array("PHONE", "PHONE", "PHONE");
// $record = array("8 916 823 3454", "495 663-12-53", "457 07 25");
// $result = $dadata->cleanRecord($structure, $record);
    
    
    
    
    
    //Адрес в формате Почты России
	//Форматирование: полные типы вместо сокращенных

// function join(arr /*, separator */) {
//   var separator = arguments.length > 1 ? arguments[1] : ", ";
//   return arr.filter(function(n){return n}).join(separator);
// }
// 
// function makeAddressString(address){
//   return join([
//     join([address.region_type_full, address.region], " "),
//     join([address.area_type_full, address.area], " "),
//     join([address.settlement_type_full, address.settlement], " "),
//     (address.city !== address.region && join([address.city_type_full, address.city], " ") || ""),
//     join([address.street_type_full, address.street], " "),
//     join([address.house_type_full, address.house,
//           address.block_type_full, address.block], " "),
//     join([address.flat_type_full, address.flat], " ")
//     ]);
// }
// 
// function formatResult(value, currentValue, suggestion) {
//   var addressValue = makeAddressString(suggestion.data);
//   suggestion.value = addressValue; 
//   return addressValue;
// }
// 
// function formatSelected(suggestion){
//   var addressValue = makeAddressString(suggestion.data);  
//   return addressValue;
// }
// 
// $("#address").suggestions({
//   token: "5ef98f5781a106962077fb18109095f9f11ebac1",
//   type: "ADDRESS",
//   formatResult: formatResult,
//   formatSelected: formatSelected
// });




}



