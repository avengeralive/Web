<?php

class Providers_Vtiger {
    
    public static function registerLead($url, $login,$passw,$offer,$zakaz) {
      
	$request = array();
	$request['sostatus'] = 'Новый'; // статус заказа новый
	$request['sp_firstname'] = $zakaz->name; // ФИО клиента
	$request['sp_client_mobile'] = $zakaz->phone; // Телефон клиента
	$request['sp_country'] = $zakaz->short_country; // страна которую выбрал клиент на сайте. Коды стран в таблице googledocs
	/* RU KZ UA BY AZ MD AM DE KG LV LT EE AT HU PL SK CZ LI SI CH UZ DK GB GE IT ES WORLD */	
	
	//$request['sp_timezone'] = $customer_time_zone; //часовой пояс клиента, который определился при посещении сайта, к примеру +3 = МСК, +1 - Европейские страны
	
	$request['sp_offer'] = $offer; // оффер. коды офферов в таблице googledocs
	/* varicream gemocream jointcream mastopathycream prostacream wrinklescream psoriascream funguscream cellulitecream gastritiselixir hairspray parasitelixir psoriassalt */

	$request['sp_ip'] = $zakaz->ip; // ip-адрес клиента    
        $request['sp_geo_country'] = $zakaz->short_country; // страна которую получили от гео по IP - символьный 2-х значный код страны RU, KZ, AZ .....
	
        //$request['sp_landing_url'] = $url; // url лэндинга, с которого пришел заказ
	
	//$request['language_landing'] = 'RU'; // язык лендинга
	/* RU KZ AZ EN DE FR */
			
        $comission = $zakaz->comission + $zakaz->comission_cpa;

	$request["sp_utm_source"] = 'yescpa'; //символьное название CPA-сети

	$request["sp_utm_content"] = $zakaz->user_id;  //№ веб-мастера в CPA сети
	$request['sp_net_so_number'] = $zakaz->id; //№ заказа в CPA-сети
	$request['sp_lead_cost_pp'] = $comission; //цена за лид ПП
		
	$request['sp_landing_type'] = 'Веб'; // Тип лендинга "Мобильный", "Веб", "Айфрейм", "Адаптив"
    
	//обязательный массив
	$request['currency_id'] = '21x1';
	$request['productid'] = '14x22979';
	$request['LineItems'][0]['quantity'] = 1;
	$request['LineItems'][0]['productid'] = '14x22979';
	$request['LineItems'][0]['unit_price'] = 0;
        
        $vtigerConnector = new Providers_Vtiger_WSClient($url);
        $send = $vtigerConnector->doLogin($login,$passw);     
        
        $send = $vtigerConnector->doCreate('SalesOrder', $request);        
        
        if (!isset($send['success']) || $send['success'] != 1) {
            throw new Exception("Не принят");
        }        
        
        return $send['result']['salesorder_custom'];         
        
    }

    public static function getStatus($url, $login, $passw, $order) {

        $vtigerConnector = new Providers_Vtiger_WSClient($url);
	$vtigerConnector->doLogin($login, $passw);  // Пользователь = CPA-сеть
        
        $logger = Registry::get('di')->logger;
        $logger->custom('vtiger', 'vtiger_data# ' . $url . '|' . $login . '|'. $passw . '|'. $order);  
        
	//данные по заказам выбираем по уникальному номеру заказа salesorder_custom, который возвращается после создания заказа
	$result = $vtigerConnector->doQuery("SELECT * FROM SalesOrder WHERE salesorder_custom = '$order';");
	//Также можно получать информацию о заказах можно с помощью передаваемого сетью sp_net_so_number
	//$result = $vtigerConnector->doQuery("SELECT * FROM SalesOrder WHERE sp_net_so_number in ('order_one', 'order_two', 'order_three', 'order_four');")
	//вместо * можно указать конкретные поля, чтобы не тащить всё
	//также, как в обычном SQL запросе можно указать условие отбора лидов WHERE field1 = 'new';
	
	//$res = $vtigerConnector->doInvoke('logout');
        
        $logger = Registry::get('di')->logger;
        $logger->custom('vtiger', 'vtiger#' . var_export($result, 1));      
        
        if (!isset($result[0]['sostatus'])) {
            throw new Exception("Bad Request");
        }        
        return $result[0];       
    }

}
