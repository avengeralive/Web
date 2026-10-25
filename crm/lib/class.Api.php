<?php
namespace lib;

/**
* class.Api.php
*
*Класс - библиотека с функциями для для работы с Api
*подгружается через автоподгрузку классов
*
*
**/


class Api {
    
    /*
    	
    https://1v1-crm.ru/json/?func=api&action=cpa
    */
    
	function cpa() {
		$post 									= (!empty($_POST)) ? $_POST : $_GET;
    	//$post 									= array_filter($post);
    	//$first 									= json_encode($post, JSON_UNESCAPED_UNICODE);	
    	$list										= '17';
		$phone 									= (isset($post['phone'])) ? '7'. substr(preg_replace( '/\..*|[^0-9]/', '',  $post['phone']), -10) : '';
		$good_names 							= (isset($post['offerID'])) ? self::goodsToArray($post['offerID'], 'cpa') : '';
		$offerID								= (isset($post['offerID'])) ? $post['offerID'] : '';
		$weight									= self::ItemWeight($offerID);
		$total 									= (isset($post['offerID'])) ? self::goodsToArray($post['offerID'], 'total') : '';
		$externalId 							= (isset($post['externalId'])) ? $post['externalId'] : '' ;
		$externalWebmaster 						= (isset($post['externalWebmaster'])) ? $post['externalWebmaster'] : '' ;
		$ip 									= (isset($post['ip'])) ? $post['ip'] : '' ;
		$timezone 								= '';
		if (!empty($ip)) $timezone = Geo::getInfoByIp($ip); 
		if($timezone === 'Ip cannot be detect' || $timezone == 0) $timezone = '';

		$fields = [
			'domain' 							=> DOMAIN, 																						//(varchar) домен проекта
			'id_user' 							=> 0, 																							//(int) Id юзера
			'premium' 							=> 0,			  																				//(int) Premium
			'status' 							=> 1, 																							//(int) Статус 
			'page' 								=> 0,  																							//(int) Раздел или страница, с которой отправлен заказ
			'total'								=> $total,																						//(int) Общая сумма
			'goods_names' 						=> $good_names,  																				//(text) товары
			'time' 								=> time(), 																						//(int) Дата подачи 
			'lastUpdate' 						=> time(), 																						//(int) Дата изменения статуса
			'timeupdate' 						=> time(),	  																					//(int) Дата последнего изменения
			'phone' 							=> $phone,																						//(int) phone
			'ip'								=> $ip,	  																						//(varchar) ip клинента																			
			'name' 								=> (isset($post['fio'])) ? $post['fio'] : '',													//(varchar) ФИО
			'webmasterId' 						=> (isset($post['webmasterId'])) ? $post['webmasterId'] : '',  									//(int) External Webmaster
			'domain2'							=> (isset($post['domain2'])) ? $post['domain2'] : 'Пусто',
			'externalId'						=> (isset($post['externalId'])) ? $post['externalId'] : '',
			'externalWebmaster'					=> (isset($post['externalWebmaster'])) ? $post['externalWebmaster'] : '',
			'timezone'							=> $timezone,
			'weight'							=> $weight
		];

		//Undefined index: webmasterId 
		//фильтруем от пустых значений

		$fields 									= array_filter($fields);
		$Keys										= array_keys($fields);
		$Values										= array_values($fields);
		
		JBase::Set_Data('list'. $list, $Keys, $Values);
		$id = JBase::$SqlID;
		return ['OK' => $id];
	}

   /*
    	
	* https://1v1-crm.ru/json/?func=api&action=cpa_approved
	? Сначло добавляет заказ в Обработку с стаусом 777, чтобы его не видел никто.
	? А потом Бот раз в минуту перетаскивает эти заказы в Подтверждена отправка 
    */

	function cpa_approved() {
		$post 									= (!empty($_POST)) ? $_POST : $_GET;
    	$list										= '17';
		$phone 									= (isset($post['phone'])) ? '7'. substr(preg_replace( '/\..*|[^0-9]/', '',  $post['phone']), -10) : '';
		$good_names 							= (isset($post['offerID'])) ? self::goodsToArrayApproved($post['offerID'], 'cpa') : '';
		$total 									= (isset($post['offerID'])) ? self::goodsToArrayApproved($post['offerID'], 'total') : '';
		$ip 									= (isset($post['ip'])) ? $post['ip'] : '' ;
		$comment								= (isset($post['comment'])) ? $post['comment'] : '';
		$comment = str_ireplace("'", "`", $comment);
		$timezone 								= '';
		if (!empty($ip)) $timezone = Geo::getInfoByIp($ip); 
		if($timezone === 'Ip cannot be detect' || $timezone == 0) $timezone = '';


		$fields = [
			'domain' 							=> DOMAIN, 																					//(varchar) домен проекта
			'id_user' 							=> 0, 																						//(int) Id юзера
			'premium' 							=> 0,			  																			//(int) Premium
			'status' 							=> 777, 																						//(int) Статус 
			'page' 								=> 0,  																						//(int) Раздел или страница, с которой отправлен заказ
			'goods_names' 						=> $good_names,  																			//(text) товары
			'total' 							=> $total,																					//(int) Общая цена
			'time' 								=> time(), 																					//(int) Дата подачи 
			'lastUpdate' 						=> time(), 																					//(int) Дата изменения статуса
			'timeupdate' 						=> time(),	  																				//(int) Дата последнего изменения
			'phone' 							=> $phone,	  																				//(int) phone
			'name' 								=> (isset($post['fio'])) ? $post['fio'] : '',												//(varchar) ФИО
			'city' 								=> (isset($post['city'])) ? $post['city'] : '',												//(varchar) Город
			'region'							=> (isset($post['region'])) ? $post['region'] : '',											//(varchar) Регион
			'address'							=> (isset($post['address'])) ? $post['address'] : '',										//(varchar) Адресс
			'house'								=> (isset($post['house'])) ? $post['house'] : '',											//(varchar) Дом
			'flat'								=> (isset($post['flat'])) ? $post['flat'] : '',												//(varchar) Квартира
			'postIndex'							=> (isset($post['postIndex'])) ? $post['postIndex'] : '',									//(varchar) Почтовый индекс
			'webmasterId' 						=> (isset($post['webmasterId'])) ? $post['webmasterId'] : '',  								//(int) External Webmaster
			'domain2'							=> (isset($post['domain2'])) ? $post['domain2'] : 'Пусто',									//(varchar) домен, с которого пришел заказ
			'size'								=> $comment,																				//(varchar) Размер
			'comment'							=> $comment,																				//(varchar) Комментарии
			'approvedAt'						=> time(),																					//(varchar) Дата подтверждения
			'ip'								=> $ip,
			'timezone'							=> $timezone,
			'externalWebmaster'					=> (isset($post['externalWebmaster'])) ? $post['externalWebmaster'] : '',
			'externalId'						=> (isset($post['externalId'])) ? $post['externalId'] : '',
		];

		//Undefined index: webmasterId 
		//фильтруем от пустых значений
		$fields 									= array_filter($fields);
		$Keys										= array_keys($fields);
		$Values									= array_values($fields);
		
		JBase::Set_Data('list'. $list, $Keys, $Values);
		$id = JBase::$SqlID;
		
		return ['OK' => $id];
	}

	/*
	* https://1v1-crm.ru/json/?func=api&action=leadvertex_approved
	? Сначло добавляет заказ в Обработку с стаусом 777, чтобы его не видел никто.
	? А потом Бот раз в минуту перетаскивает эти заказы в Подтверждена отправка 
    */

	function leadvertex_approved() {
		$post 										= (!empty($_POST)) ? $_POST : $_GET;

		$list										= '17';
		$leadvertexid 								= $post['id'];
		$project 									= $post['offer'];
		$product 									= json_decode($post['goods'], true);
		$phone										= (isset($post['phone'])) ? '7'. substr(preg_replace( '/\..*|[^0-9]/', '',  $post['phone']), -10) : '';
		$ip 										= (isset($post['ip'])) ? $post['ip'] : '' ;
		$cnt 										= 0;
		$timezone 									= '';
		$goodsID									= [];
		$goods_names								= [];

		if($project === 'pro-elit')$id_user = 33382;
		elseif($project === 'test-tel')$id_user = 33381;
		else $id_user = 0;
		if (!empty($ip)) $timezone = Geo::getInfoByIp($ip); 
		if($timezone === 'Ip cannot be detect' || $timezone == 0) $timezone = '';

		foreach ($product as $key => $value) {
			$goodsID[] = $value['goodID'];
			$cnt++;
		}

		if($post['statusID'] == 10){
			foreach ($goodsID as $key => $Value) {
				$Result									= JBase::Get_Data('list51','crm_product',['leadvertex_product' => $Value, 'project' => $project, 'status' => 1]);
				$res									= $Result->fetch_assoc();
				if($res){
					$goods_names[] = $res['crm_product'];
				}	
			}
			if($goods_names){
				$total 									= (isset($goods_names)) ? self::goodsToArrayApproved($goods_names, 'total') : '';
				$goods_names 							= (isset($goods_names)) ? self::goodsToArrayApproved($goods_names, 'cpa') : '';
				$fields = [
					'domain' 							=> DOMAIN, 																					//(varchar) домен проекта
					'id_user' 							=> $id_user, 																						//(int) Id юзера
					'premium' 							=> 0,			  																			//(int) Premium
					'status' 							=> 777, 																						//(int) Статус 
					'page' 								=> 0,  																						//(int) Раздел или страница, с которой отправлен заказ
					'goods_names' 						=> $goods_names,  																			//(text) товары
					'total' 							=> $total,																					//(int) Общая цена
					'leadvertexId'						=> $leadvertexid,																			//(varchar) leadvertexid
					'leadvertexProject'					=> $project,																				//(varchar) Название проекта в Leadvertex
					'time' 								=> time(), 																					//(int) Дата подачи 
					'lastUpdate' 						=> time(), 																					//(int) Дата изменения статуса
					'timeupdate' 						=> time(),	  																				//(int) Дата последнего изменения
					'approvedAt'						=> time(),
					'phone' 							=> $phone,	  																				//(int) phone
					'name' 								=> (isset($post['fio'])) ? $post['fio'] : '',												//(varchar) ФИО
					'city' 								=> (isset($post['city'])) ? $post['city'] : '',												//(varchar) Город
					'region'							=> (isset($post['region'])) ? $post['region'] : '',											//(varchar) Регион
					'address'							=> (isset($post['address'])) ? $post['address'] : '',										//(varchar) Адресс
					'postIndex'							=> (isset($post['postIndex'])) ? $post['postIndex'] : '',									//(varchar) Почтовый индекс
					'externalWebmaster' 				=> (isset($post['externalWebmaster'])) ? $post['externalWebmaster'] : '',
					'externalId' 						=> (isset($post['externalId'])) ? $post['externalId'] : '',							
					'webmasterId' 						=> (isset($post['webmasterId'])) ? $project.$post['webmasterId'] : '',  					//(int) External Webmaster
					'domain2'							=> (isset($post['domain2'])) ? $post['domain2'] : 'Пусто',									//(varchar) домен, с которого пришел заказ
					'comment'							=> (isset($post['comment'])) ? $post['comment'] : '',										//(varchar) Комментарии
					'size'								=> (isset($post['comment'])) ? $post['comment'] : '',
					'ip'								=> $ip,
					'timezone'							=> $timezone
				];
				

				//Undefined index: webmasterId 
				//фильтруем от пустых значений
				$fields 								= array_filter($fields);
				$Keys									= array_keys($fields);
				$Values									= array_values($fields);

				JBase::Set_Data('list'. $list, $Keys, $Values);
				$id = JBase::$SqlID;
				return ['OK' => $id];
			}
		}
	}

	/*
    	
    	* https://1v1-crm.ru/json/?func=api&action=leadvertex
    */

	function leadvertex() {
		$post 										= (!empty($_POST)) ? $_POST : $_GET;
		$leadvertexid 								= $post['id'];
		$project 									= $post['offer'];
		$list										= '17';
		$product 									= json_decode($post['goods'], true);
		$phone										= (isset($post['phone'])) ? '7'. substr(preg_replace( '/\..*|[^0-9]/', '',  $post['phone']), -10) : '';
		$ip 										= (isset($post['ip'])) ? $post['ip'] : '' ;
		$cnt 										= 0;
		$timezone 									= '';
		if (!empty($ip)) $timezone = Geo::getInfoByIp($ip); 
		if($timezone === 'Ip cannot be detect' || $timezone == 0) $timezone = '';

		foreach ($product as $key => $value) {
			$goodsID = $value['goodID'];
			$cnt++;
		}
		$Result									= JBase::Get_Data('list51','crm_product',['leadvertex_product' => $goodsID, 'project' => $project, 'status' => 1]);
		$res									= $Result->fetch_assoc();
		if($res){
			$goods_names 							= $res['crm_product'];
			if($goods_names){
				$total 									= (isset($goods_names)) ? self::goodsToArrayApproved($goods_names, 'total') : '';
				$goods_names 							= (isset($goods_names)) ? self::goodsToArrayApproved($goods_names, 'cpa') : '';

				$fields = [
					'domain' 							=> DOMAIN, 																					//(varchar) домен проекта
					'id_user' 							=> 0, 																						//(int) Id юзера
					'premium' 							=> 0,			  																			//(int) Premium
					'status' 							=> 1, 																						//(int) Статус 
					'page' 								=> 0,  																						//(int) Раздел или страница, с которой отправлен заказ
					'goods_names' 						=> $goods_names,  																			//(text) товары
					'total' 							=> $total,																					//(int) Общая цена
					'leadvertexId'						=> $leadvertexid,																			//(varchar) leadvertexid
					'leadvertexProject'					=> $project,																				//(varchar) Название проекта в Leadvertex
					'time' 								=> time(), 																					//(int) Дата подачи 
					'lastUpdate' 						=> time(), 																					//(int) Дата изменения статуса
					'timeupdate' 						=> time(),	  																				//(int) Дата последнего изменения
					'phone' 							=> $phone,	  																				//(int) phone
					'name' 								=> (isset($post['fio'])) ? $post['fio'] : '',												//(varchar) ФИО
					'city' 								=> (isset($post['city'])) ? $post['city'] : '',												//(varchar) Город
					'region'							=> (isset($post['region'])) ? $post['region'] : '',											//(varchar) Регион
					'address'							=> (isset($post['address'])) ? $post['address'] : '',										//(varchar) Адресс
					'postIndex'							=> (isset($post['postIndex'])) ? $post['postIndex'] : '',									//(varchar) Почтовый индекс
					'externalWebmaster' 				=> (isset($post['externalWebmaster'])) ? $post['externalWebmaster'] : '',
					'externalId' 						=> (isset($post['externalId'])) ? $post['externalId'] : '',							
					'webmasterId' 						=> (isset($post['webmasterId'])) ? $project.$post['webmasterId'] : '',  																			//(int) External Webmaster
					'domain2'							=> (isset($post['domain2'])) ? $post['domain2'] : 'Пусто',									//(varchar) домен, с которого пришел заказ
					'comment'							=> (isset($post['comment'])) ? $post['comment'] : '',										//(varchar) Комментарии
					'ip'								=> $ip,
					'timezone'							=> $timezone
				];

				//Undefined index: webmasterId 
				//фильтруем от пустых значений
				$fields 								= array_filter($fields);
				$Keys									= array_keys($fields);
				$Values									= array_values($fields);

				JBase::Set_Data('list'. $list, $Keys, $Values);
				$id = JBase::$SqlID;
				return ['OK' => $id];
			}
		}
	}
	
	/*
    	
    	* https://1v1-crm.ru/json/?func=api&action=testTelLeadvertex
	*/
	
	function testTelLeadvertex(){
		$post 										= (!empty($_POST)) ? $_POST : $_GET;
		$tables 									= ['list14','list15','list16','list17','list18','list19','list20'];
		$id											= $post['id'];
		$phone										= (isset($post['phone'])) ? '7'. substr(preg_replace( '/\..*|[^0-9]/', '',  $post['phone']), -10) : '';
		$comment 									= '';
		$getBlackStatuses 							= self::getBlackStatuses($phone);
		$getDoubleTestTelLeadvertex					= self::getDoubleTestTelLeadvertex($phone);
		$comment									= 'CRM: '.$getDoubleTestTelLeadvertex.'. Черный список: '.$getBlackStatuses;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://test-tel.leadvertex.ru/api/admin/updateOrder.html?token=123456&id='.$id);
	   	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	   	curl_setopt($curl, CURLOPT_POSTFIELDS, "comment=".$comment);
	   	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		$posts = json_decode(curl_exec($curl), true);
		curl_close($curl); 
	}
	
	function getDoubleTestTelLeadvertex($phone) {
		$post 										= (!empty($_POST)) ? $_POST : $_GET;
		$cnt = 1;
		$tables = ['list14','list15','list16','list17','list18','list19','list20'];
		$comment = 'Дублей: нет';
			foreach ($tables as $table) {
				$res = JBase::Query("SELECT * FROM ". $table ." WHERE `phone` = '". $phone ."'");
				if (!empty($res)) {
					while ($doubles = $res->fetch_assoc()) {
						$cnt++;
						$status = JBase::Query("SELECT `name` FROM list8 WHERE `id` = ".$doubles['status']);
						$res_stat = $status->fetch_assoc();
						$proj = $doubles['id'];
						$comment = 	'Дубль: Заказ №'. $proj . PHP_EOL .'Статус: '.$res_stat['name'].PHP_EOL.'Комент: '.$doubles['comment'];
						break;
					}
				} else {
					$comment = 'Дублей: нет';
				}
			}			
			return $comment;
	}

	/*

	* https://1v1-crm.ru/json/?func=api&action=statusParcel&russianpostTrack=80084444126454
	*/

	function statusParcel(){
		$russianpostTrack = $_GET['russianpostTrack'];
		if($russianpostTrack){
			$Result = JBase::Get_Search_Text('list8', 'statusgroup');
			$num_rows = mysqli_num_rows($Result);
			$data = 'Нету такого почтового трека';
	
			for ($i=0; $i < $num_rows; $i++) { 
				$list = $Result->fetch_assoc();
				$statusgroup[$i] = $list['statusgroup'];
			}
	
			$statusgroup = array_unique($statusgroup);
	
			foreach ($statusgroup as $value) {
				$rspt = JBase::Get_Data('list'.$value,'*',['russianpostTrack' => $russianpostTrack]);
				$rspt = $rspt->fetch_assoc();
				if($rspt){
					JBase::Update_Data('list'.$value,['russianpostOther'=>'+'],['russianpostTrack'=>$russianpostTrack]);
					$data = 'OK => '.$rspt['id'];
				}
			}
			return $data;
		}
	} 

    /*
    	
    	https://1v1-crm.ru/json/?func=api&action=status&id=123
    */
    
	function status() {
		$post = (!empty($_POST)) ? $_POST : $_GET;
    	if (isset($post['id']) && (int)$post['id'] > 0) {
    		$ret = [
				'id' => (int)$post['id'],
				'status' => '0',
				'comment' => ''
			];
			foreach(['14','15','16','17','18','19','20'] as $key) {
    			$status = JBase::Get_Field_Value_From_Id('list'. $key, $post['id'], 'status');
				if (!empty($status)) {
					$ret = [
						'id' => (int)$post['id'],
						'status' => $key,
						//'status2' => $status,
						'comment' => JBase::Get_Field_Value_From_Id('list'. $key, $post['id'], 'comment')
					];
					break;
				}
			}
			
			return json_encode($ret, JSON_UNESCAPED_UNICODE);
    	}		
	}
	
	function blackdollar() {
		$post 									= (!empty($_POST)) ? $_POST : $_GET;
    	//$post 									= array_filter($post);
    	$first 									= json_encode($post, JSON_UNESCAPED_UNICODE);	
    	$list										= '17';
		$project									= (isset($post['project'])) ? $post['project'] : 'blackdollar'; 
		$good_names 							= (isset($post['goods']) && is_array($post['goods']) && !empty($post['goods'])) ? self::goodsToArray($post['goods'], 'blackdollar') : '';
		$liveinform								= (isset($post['phone'])) ? self::getBlackStatuses(substr(preg_replace( '/\..*|[^0-9]/', '',  $post['phone']), -10)) : 'no tel';
		
		$geoArr									= (isset($post['ip'])) ? self::geo($post['ip']) : [];
		$geo 										= (isset($post['ip']) && !empty($post['ip'])) ? json_encode($geoArr, JSON_UNESCAPED_UNICODE) : '';
		$time_zone								= (!empty($geoArr) && isset($geoArr['time_zone']) && isset($geoArr['time_zone']['offset']) && self::sign($geoArr['time_zone']['offset']) == '-1') ? $geoArr['time_zone']['offset'] : '+'. $geoArr['time_zone']['offset'];
	
// 		$geoArr									= [];
// 		$geo 										= '';
// 		$time_zone								= '';
		
		$dop10 = '';
		if (isset($post['additional10']) && !empty($post['additional10'])) $dop10 .= $post['additional10']; 
		if (isset($post['additional12']) && !empty($post['additional12'])) $dop10 .= $post['additional12'];
		if (isset($post['additional13']) && !empty($post['additional13'])) $dop10 .= $post['additional13'];
		if (isset($post['additional15']) && !empty($post['additional15'])) $dop10 .= $post['additional15'];
		if (isset($post['additional16']) && !empty($post['additional16'])) $dop10 .= $post['additional16'];
		if (isset($post['additional17']) && !empty($post['additional17'])) $dop10 .= $post['additional17'];
		if (isset($post['additional18']) && !empty($post['additional18'])) $dop10 .= $post['additional18'];
		if (isset($post['additional19']) && !empty($post['additional19'])) $dop10 .= $post['additional19'];
		if (isset($post['additional20']) && !empty($post['additional20'])) $dop10 .= $post['additional20'];
		if (isset($post['additional21']) && !empty($post['additional21'])) $dop10 .= $post['additional21']; 
		if (isset($post['additional22']) && !empty($post['additional22'])) $dop10 .= $post['additional22'];
		if (isset($post['additional23']) && !empty($post['additional23'])) $dop10 .= $post['additional23'];
		if (isset($post['additional24']) && !empty($post['additional24'])) $dop10 .= $post['additional24'];
		if (isset($post['additional25']) && !empty($post['additional25'])) $dop10 .= $post['additional25'];
		//$getDoubleLV = self::getDouble($post['phone']); //дубли в fun, fun2 - Поиск заказов по параметрам в leadvertex и выявление дублей
		$getDoublePhone = self::getDoublePhone($post['phone']); //Поиск заказов по phone в своей базе и выявление дублей
		$getDoubleIP = self::getDoubleIP($post['ip']); //Поиск заказов по ip в своей базе и выявление дублей
		$getDouble = array_merge($getDoublePhone, $getDoubleIP);
		$phone = (isset($post['phone'])) ? '7'. substr(preg_replace( '/\..*|[^0-9]/', '',  $post['phone']), -10) : '';
		
		
		$fields = [
			'domain' 							=> DOMAIN, 																								//(varchar) домен проекта
			'id_user' 							=> 0, 																									//(int) Id юзера
			'premium' 							=> 0,			  																							//(int) Premium
			'page' 								=> $first,  																							//(int) Раздел или страница, с которой отправлен заказ
			'status' 							=> '1', 																									//(int) Статус 
			'time' 								=> time(), 																								//(int) Дата подачи 
			'lastUpdate' 						=> time(), 																								//(int) Дата изменения статуса
			'timeupdate' 						=> time(),  																							//(int) Дата последнего изменения
			'price' 								=> (isset($post['price'])) ? (float)$post['price'] : 0,									//(int) Цена
			'total' 								=> (isset($post['total'])) ? (float)$post['total'] : 0,									//(int) Сумма заказа
			'agree_terms' 						=> 0,  																									//(int) С условиями покупки согласен
			'agree_personal' 					=> 0,  																									//(int) Согласен на обработку персональных данных
			'geo' 								=> $geo,																									//(varchar) geo по IP
			'name' 								=> (isset($post['fio'])) ? $post['fio'] : '',												//(varchar) ФИО
			'goods_names' 						=> $good_names,  																						//(text) товары
			'domain2' 							=> (isset($post['domain'])) ? $post['domain'] : '',										//(int) домен, с которого пришел заказ
			'comment' 							=> (isset($post['comment'])) ? $post['comment'] : '',  									//(int) Комментарий
			'all' 								=> (is_array($getDouble)) ? json_encode($getDouble) : $getDouble,  					//(int) Дубли
			'count' 								=> 0,  																									//(int) Кол-во
			'phone' 								=> $phone,  																							//(int) Телефон
			'email' 								=> '',  																									//(int) Email
			'category' 							=> '',																									//(int) Категория товара
			'liveinform' 						=> $liveinform,  																						//(int) Liveinform comment
			'size' 								=> (isset($post['additional2'])) ? $post['additional2'] : '',  						//(varchar) Размер
			'completely' 						=> (isset($post['additional11'])) ? $post['additional11'] : '',  						//(text) Дожим
			'weight' 							=> '1',  																								//(int) Масса
			'tag' 								=> '',  																									//(int) Метка
			'source' 							=> '',  																									//(int) Источник
			'ip' 									=> (isset($post['ip'])) ? $post['ip'] : '0.0.0.0',  										//(varchar) IP
			'referrer' 							=> (isset($post['referer'])) ? $post['referer'] : '',										//(int) Referrer
			'expend' 							=> '',  																									//(int) Затрачено
			'externalId' 						=> $post['externalID'],  																			//(int) External ID
			'webmasterId' 						=> $post['externalWebmaster'],  																	//(int) External Webmaster
			'dop1' 								=> (isset($post['additional1'])) ? $post['additional1'] : '',  						//(int) Доп.поле 1
			'dop2' 								=> (isset($post['additional2'])) ? $post['additional2'] : '',  						//(int) Доп.поле 2
			'dop3' 								=> (isset($post['additional3'])) ? $post['additional3'] : '',  						//(int) Доп.поле 3
			'dop4' 								=> (isset($post['additional4'])) ? $post['additional4'] : '',  						//(int) Доп.поле 4
			'dop5' 								=> (isset($post['additional5'])) ? $post['additional5'] : '',  						//(int) Доп.поле 5
			'dop6' 								=> (isset($post['additional6'])) ? $post['additional6'] : '',  						//(int) Доп.поле 6
			'dop7' 								=> (isset($post['additional7'])) ? $post['additional7'] : '',  						//(int) Доп.поле 7
			'dop8' 								=> (isset($post['additional8'])) ? $post['additional8'] : '',  						//(int) Доп.поле 8
			'dop9' 								=> (isset($post['additional9'])) ? $post['additional9'] : '',  						//(int) Доп.поле 9
			'dop10' 								=> ($dop10) ?: '',  																					//(int) Доп.поле 10
			'timezone' 							=> 60 * (int)$time_zone,  																			//(int) Смещение по гринвичу (мин)
			'allBuyPrice' 						=> '',  																									//(int) Закупочная цена (Итого)
			'developerPrice' 					=> '',  																									//(int) Вебмастер сумма
			'utm_source' 						=> (isset($post['utm_source'])) ? $post['utm_source'] : '',  							//(int) UTM-Source
			'utm_medium' 						=> (isset($post['utm_medium'])) ? $post['utm_medium'] : '',  							//(int) UTM-Medium
			'utm_campaign' 					=> (isset($post['utm_campaign'])) ? $post['utm_campaign'] : '',  						//(int) UTM-Campaign
			'utm_content' 						=> (isset($post['utm_content'])) ? $post['utm_content'] : '',  						//(int) UTM-Content
			'utm_term' 							=> (isset($post['utm_term'])) ? $post['utm_term'] : '',  								//(int) UTM-Term
			'statustime' 						=> time(),																								//(int) Дата последнего изменения статуса - statustime
			'lvproject' 						=> (isset($post['project'])) ? $post['project'] : 'blackdollar',  					//(int) lvproject
			'lvid' 								=> (isset($post['id'])) ? $post['id'] : ''  													//(int) lvid
		];

		
		//фильтруем от пустых значений
		$fields 									= array_filter($fields);
		$Keys										= array_keys($fields);
		$Values									= array_values($fields);
		
		JBase::Set_Data('list'. $list, $Keys, $Values);
		$id = JBase::$SqlID;
				
		return [$id => 'OK'];
	}
	
	function migrate() {
	
	
		$post 									= (!empty($_POST)) ? $_POST : $_GET;
    	$post 									= array_filter($post);
    	$first 									= json_encode($post, JSON_UNESCAPED_UNICODE);
		$project									= (isset($post['project'])) ? $post['project'] : 'migrate';
		$post['status']						= (isset($post['status'])) ? (int)$post['status'] : 0;
    	
    	$statusTo 								= self::statusTo($post['status'], $project);
    	$list										= '17';
    	$status									= '1';
    	if (!empty($statusTo)) {
    		$list = $statusTo['list'];
    		$status = $statusTo['id'];
    	}
		$good_names = (isset($post['goods']) && is_array($post['goods']) && !empty($post['goods'])) ? self::goodsToArray($post['goods'], 'migrate') : '';
										
										
										
		$city 									= (isset($post['city'])) ? $post['city'] : '';
		$address 								= (isset($post['address'])) ? $post['address'] : '';
    	$query 									= (!empty($city) && !empty($address)) ? $city .', '. $address : '';
    	$addr 									= (!empty($city) && !empty($address)) ? Dadata::clean3('address', $query) : [];	
		$flat 									= implode(" ", [$addr['flat_type'], $addr['flat']]);
		$city 									= implode(" ", [
			implode(" ", [$addr['city_type'], $addr['city']]), 
			implode(" ", [$addr['settlement_type'], $addr['settlement']])
		]);
		$house 									= implode(" ", [
			implode(" ", [$addr['house_type'], $addr['house']]),
			implode(" ", [$addr['block_type'], $addr['block']])
		]);
		$region 									= implode(" ", [
			implode(" ", [$addr['region_type'], $addr['region']]),
			implode(" ", [$addr['area_type'], $addr['area']])
		]);
		$street 									= implode(" ", [$addr['street_type'], $addr['street']]);
		$postIndex 								= (!empty($addr) && !isset($post['postIndex'])) ? $addr['postal_code'] : $post['postIndex'];
		//$timezone 								= (!empty($addr)) ? $addr['timezone'] : '';//UTC+5

		$dop10 = '';
		if (isset($post['additional10']) && !empty($post['additional10'])) $dop10 .= $post['additional10']; 
		if (isset($post['additional12']) && !empty($post['additional12'])) $dop10 .= $post['additional12'];
		if (isset($post['additional13']) && !empty($post['additional13'])) $dop10 .= $post['additional13'];
		if (isset($post['additional15']) && !empty($post['additional15'])) $dop10 .= $post['additional15'];
		if (isset($post['additional16']) && !empty($post['additional16'])) $dop10 .= $post['additional16'];
		if (isset($post['additional17']) && !empty($post['additional17'])) $dop10 .= $post['additional17'];
		if (isset($post['additional18']) && !empty($post['additional18'])) $dop10 .= $post['additional18'];
		if (isset($post['additional19']) && !empty($post['additional19'])) $dop10 .= $post['additional19'];
		if (isset($post['additional20']) && !empty($post['additional20'])) $dop10 .= $post['additional20'];
		if (isset($post['additional21']) && !empty($post['additional21'])) $dop10 .= $post['additional21']; 
		if (isset($post['additional22']) && !empty($post['additional22'])) $dop10 .= $post['additional22'];
		if (isset($post['additional23']) && !empty($post['additional23'])) $dop10 .= $post['additional23'];
		if (isset($post['additional24']) && !empty($post['additional24'])) $dop10 .= $post['additional24'];
		if (isset($post['additional25']) && !empty($post['additional25'])) $dop10 .= $post['additional25'];
		
		$phone = (isset($post['phone'])) ? '7'. substr(preg_replace( '/\..*|[^0-9]/', '',  $post['phone']), -10) : '';
		
		//return JBase::Set_Data('list17', ['domain','robot','status'], [DOMAIN, $post, 1]); //test
		$fields = [
			//'id' 									=> (isset($post['id'])) ? $post['id'] : '',												//(int) Premium
			'domain' 							=> DOMAIN, 																								//(varchar) домен проекта
			'id_user' 							=> (isset($post['operatorID'])) ? $post['operatorID'] : 0, 								//(int) Id юзера
			'premium' 							=> 0,			  																							//(int) Premium
			'page' 								=> $first,  																							//(int) Раздел или страница, с которой отправлен заказ
			'status' 							=> $status, 																							//(int) Статус 
			'time' 								=> (isset($post['time'])) ? strtotime($post['time']) : time(),							//(int) Дата подачи 
			'lastUpdate' 						=> (isset($post['lastUpdate'])) ? strtotime($post['lastUpdate']) : time(),			//(int) Дата изменения статуса
			'timeupdate' 						=> time(),  																							//(int) Дата последнего изменения
			'price' 								=> (isset($post['price'])) ? (float)$post['price'] : 0,									//(int) Цена
			'total' 								=> (isset($post['total'])) ? (float)$post['total'] : 0,									//(int) Сумма заказа
			'agree_terms' 						=> 0,  																									//(int) С условиями покупки согласен
			'agree_personal' 					=> 0,  																									//(int) Согласен на обработку персональных данных
			'geo' 								=> json_encode(array_filter($addr), JSON_UNESCAPED_UNICODE),  							//(varchar) geo по IP
			'name' 								=> (isset($post['fio'])) ? $post['fio'] : '',												//(varchar) ФИО
			'goods_names' 						=> $good_names,  																						//(text) товары
			//'goods_names' 						=> (isset($post['goods'])) ? self::goodsToArray2($post['goods']) : '{}',  		//(text) товары
			'domain2' 							=> (isset($post['domain'])) ? $post['domain'] : '',										//(int) домен, с которого пришел заказ
			'approvedAt' 						=> (isset($post['approvedAt'])) ? strtotime($post['approvedAt']) : 0,  				//(int) Дата апрува
			'shippedAt' 						=> (isset($post['shippedAt'])) ? strtotime($post['shippedAt']) : 0,  				//(int) Дата отправки
			'canceledAt' 						=> (isset($post['canceledAt'])) ? strtotime($post['canceledAt']) : 0,  				//(int) Дата отмены
			'buyoutAt' 							=> (isset($post['buyoutAt'])) ? strtotime($post['buyoutAt']) : 0,  					//(int) Дата выкупа
			'refundedAt' 						=> (isset($post['refundedAt'])) ? strtotime($post['refundedAt']) : 0,  				//(int) Дата возврата
			'comment' 							=> (isset($post['comment'])) ? $post['comment'] : '',  									//(int) Комментарий
			'log_robot' 						=> '',  																									//(int) Лог робота
			//'all' 								=> (isset($post['comment'])) ? $post['comment'] : '',  									//(int) Итого
			'time_call' 						=> 0,  																									//(int) Время перезвона
			'attempts' 							=> 0,  																									//(int) Количество попыток
			'russianpostTrack' 				=> (isset($post['russianpostTrack'])) ? (int)$post['russianpostTrack'] : 0,		//(int) Почта России: Track
			'russianpostStatus' 				=> '',  																									//(int) Почта России: cтатус посылки
			'count' 								=> 0,  																														//(int) Кол-во
			'postIndex' 						=> $postIndex,  																											//(int) Индекс
			'region' 							=> trim($region),  																										//(int) Регион
			'city' 								=> (substr($city, 0, 2) == ', ' || substr($city, 0, 2) == ' , ') ? substr($city, 2) : $city,		//(int) Город
			'address' 							=> trim($street),																											//(int) Адрес
			'house' 								=> trim($house),  																										//(int) Дом
			'flat' 								=> $flat,  																													//(int) Квартира
			'phone' 								=> $phone,  										//(int) Телефон
			'email' 								=> '',  																									//(int) Email
			'category' 							=> '',  																									//(int) Категория товара
			'lastSms' 							=> '',  																									//(int) Последнее SMS
			'smsStatus' 						=> '',  																									//(int) Статус SMS
			'lastVoiceSms' 					=> '',  																									//(int) Последнее голосовое SMS
			'lastVoiceStatus' 				=> '',  																									//(int) Статус голосового SMS
			'liveinform' 						=> '',  																									//(int) Группа режима прозвона
			'liveinformId' 					=> (isset($post['additional1'])) ? $post['additional1'] : '',  						//(int) Liveinform ID
			'size' 								=> (isset($post['additional2'])) ? $post['additional2'] : '',  						//(varchar) Размер
			'completely' 						=> (isset($post['additional11'])) ? $post['additional11'] : '',  						//(text) Дожим
			'weight' 							=> (isset($post['additional14'])) ? $post['additional14'] : '',  						//(int) Масса
			'tag' 								=> '',  																									//(int) Метка
			'source' 							=> '',  																									//(int) Источник
			'ip' 									=> (isset($post['ip'])) ? $post['ip'] : '0.0.0.0',  										//(varchar) IP
			'referrer' 							=> (isset($post['referer'])) ? $post['referer'] : '',										//(int) Referrer
			'expend' 							=> '',  																									//(int) Затрачено
			'externalId' 						=> $post['externalID'],  																			//(int) External ID
			'webmasterId' 						=> $post['externalWebmaster'],  																			//(int) External Webmaster
			'dop1' 								=> (isset($post['additional1'])) ? $post['additional1'] : '',  						//(int) Доп.поле 1
			'dop2' 								=> (isset($post['additional2'])) ? $post['additional2'] : '',  						//(int) Доп.поле 2
			'dop3' 								=> (isset($post['additional3'])) ? $post['additional3'] : '',  						//(int) Доп.поле 3
			'dop4' 								=> (isset($post['additional4'])) ? $post['additional4'] : '',  						//(int) Доп.поле 4
			'dop5' 								=> (isset($post['additional5'])) ? $post['additional5'] : '',  						//(int) Доп.поле 5
			'dop6' 								=> (isset($post['additional6'])) ? $post['additional6'] : '',  						//(int) Доп.поле 6
			'dop7' 								=> (isset($post['additional7'])) ? $post['additional7'] : '',  						//(int) Доп.поле 7
			'dop8' 								=> (isset($post['additional8'])) ? $post['additional8'] : '',  						//(int) Доп.поле 8
			'dop9' 								=> (isset($post['additional9'])) ? $post['additional9'] : '',  						//(int) Доп.поле 9
			'dop10' 								=> $dop10,  																							//(int) Доп.поле 10
			'timezone' 							=> (isset($post['timezone'])) ? $post['timezone'] : '',  								//(int) Смещение по гринвичу (мин)
			'allBuyPrice' 						=> '',  																									//(int) Закупочная цена (Итого)
			'developerPrice' 					=> '',  																									//(int) Вебмастер сумма
			'utm_source' 						=> (isset($post['utm_source'])) ? $post['utm_source'] : '',  							//(int) UTM-Source
			'utm_medium' 						=> (isset($post['utm_medium'])) ? $post['utm_medium'] : '',  							//(int) UTM-Medium
			'utm_campaign' 					=> (isset($post['utm_campaign'])) ? $post['utm_campaign'] : '',  						//(int) UTM-Campaign
			'utm_content' 						=> (isset($post['utm_content'])) ? $post['utm_content'] : '',  						//(int) UTM-Content
			'utm_term' 							=> (isset($post['utm_term'])) ? $post['utm_term'] : '',  								//(int) UTM-Term
			'operator' 							=> '',  																									//(int) operator
			'sms_template' 					=> '',  																									//(int) operator
			'statustime' 						=> (isset($post['lastUpdate'])) ? strtotime($post['lastUpdate']) : time(),			//(int) Дата последнего изменения статуса - statustime
			'lvproject' 						=> (isset($post['project'])) ? $post['project'] : '',  									//(int) lvproject
			'lvid' 								=> (isset($post['id'])) ? $post['id'] : ''  													//(int) lvid
		];

		
		//фильтруем от пустых значений
		$fields 									= array_filter($fields);
		$Keys										= array_keys($fields);
		$Values									= array_values($fields);
		
		JBase::Set_Data('list'. $list, $Keys, $Values);
		$id = JBase::$SqlID;
				
		return [$id => 'OK'];
	}
   
   //
	function set() {
		return self::cpa();
		if ($_POST["key"] == 'migrate') return self::migrate();
		if ($_POST["key"] == 'blackdollar') return self::blackdollar();
		else return false;
		
		header("Content-Type:application/json");
		$result = [];
		//$antispam = false;
		$antispam = self::antispam();
		//return json_encode($antispam, JSON_UNESCAPED_UNICODE);
		if (!empty($antispam)) {
			$errors = (isset($antispam['errors']) && is_array($antispam['errors'])) ? $antispam['errors'] : false;
			unset($antispam['errors']);
			
			//если все ок
			if (!$errors || $_POST["key"] == 'blackdollar') {//
				$Keys = array_keys($antispam);
				$Values = array_values($antispam);
				JBase::Set_Data('list17', $Keys, $Values);
				$id = JBase::$SqlID;
				
				CronRobot::addNew($id, 17, 1);
				return [$id => 'OK'];
			} else {
				
				switch($errors['status']) {	 
					case 'error': //Выводить ошибку при срабатывании фильтра
						if (isset($errors['time_min']))	$result['code1'] = 'Слишком короткое время оформления заказа: '. $errors['time_min'] .' сек';
						if (isset($errors['time_max']))	$result['code2'] = 'Слишком долгое время оформления заказа: '. $errors['time_max'] .' сек';
						if (isset($errors['stopword']))	$result['code3'] = 'Стоп-слова: '. $errors['stopword'];
						if (isset($errors['country'])) 	$result['code4'] = 'Запрещено для страны: '. $errors['country'];
						if (isset($errors['max'])) 		$result['code5'] = 'Максимальное количество заказов с одного IP: '. $errors['max'];
						if (isset($errors['ip'])) 			$result['code6'] = 'Этот IP в черном списке: '. $errors['ip'];
						return json_encode($result, JSON_UNESCAPED_UNICODE);
					break;  
					case 'fake': //Имитировать успешное оформление заказа						
						return [substr(time(), 4) => 'Ok'];
					break; 
				}
			}
			return json_encode($result, JSON_UNESCAPED_UNICODE);
		} 
		return [substr(time(), 4) => 'Ok'];
	}
	
	//
	function antispam() {
	
	
	/*
		antispam_use						=> Принцип работы
		antispam_ips_black				=> Черный список IP
		antispam_ips_max					=> Максимальное количество заказов с одного IP
		antispam_stop_word				=> Стоп-слова
		antispam_stop_country_type		=> Гео-фильтрация
		antispam_stop_country			=> Страны
		antispam_time_min					=> Мин.секунд на оформление заказа
		antispam_time_max					=> Макс.секунд на оформление заказа
	*/
	
		$key 				= (isset($_POST["key"])) ? $_POST["key"] : false;										//api_key required
		//if (!$key) return false; //??????
		$goods 			= (isset($_POST["goods"]) && is_array($_POST["goods"])) ? self::goodsToArray($_POST["goods"]) : $_POST["goods"];
		
		$utm_term 		= (isset($_POST["utm_term"])) ? JBase::escape($_POST["utm_term"]) : false;							//utm_term
		$utm_medium 	= (isset($_POST["utm_medium"])) ? JBase::escape($_POST["utm_medium"]) : false;					//utm_medium
		$utm_source 	= (isset($_POST["utm_source"])) ? JBase::escape($_POST["utm_source"]) : false;					//utm_source
		$utm_content 	= (isset($_POST["utm_content"])) ? JBase::escape($_POST["utm_content"]) : false;					//utm_content
		$utm_campaign 	= (isset($_POST["utm_campaign"])) ? JBase::escape($_POST["utm_campaign"]) : false;				//utm_campaign
		$searchButton 	= (isset($_POST["searchButton"]) && $_POST["searchButton"] == 'get') ? true : false;			//это на случай если на сайте, к которому обращаемся проверяется была ли нажата кнопка submit, а форма не была оправлена 
		$fio 				= (isset($_POST["fio"])) ? JBase::escape($_POST["fio"]) : false;										//ФИО
		$phone 			= (isset($_POST["phone"])) ? JBase::escape($_POST["phone"]) : false;									//Телефон
		$quantity 		= (isset($_POST["quantity"])) ? JBase::escape($_POST["quantity"]) : false;							//Количество
		//$domain 			= (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';			//Домен откуда поступил заказ
		$referer 		= (isset($_POST["referer"])) ? JBase::escape($_POST["referer"]) : false;							//referer (откуда пришел посетитель)
		$price 			= (isset($_POST["price"])) ? JBase::escape($_POST["price"]) : false;									//Цена товара
		$ip 				= (isset($_SERVER['REMOTE_ADDR'])) ? JBase::escape($_SERVER['REMOTE_ADDR']) : false;			//IP откуда поступил заказ

		$time_min 		= (isset($_POST["time_min"])) ? (int)$_POST["time_min"] : false;										//Мин.секунд на оформление заказа
		$time_max 		= (isset($_POST["time_max"])) ? (int)$_POST["time_max"] : false;										//Макс.секунд на оформление заказа

		$goods 			= $goods;																												//Товары
		$errors 			= [];																														//Антиспам выявлено

		$Result = JBase::Get_Full_Table_From_Domain('antispam');
		$items = [];			
		if (!empty($Result)) {
			while ($item = $Result->fetch_assoc()) 
				$items[$item['name']] = explode(PHP_EOL, $item['value']); //разбираем переносы строк		
		}
		
		// >>>>>>>> поля antispam - это массивы значений (приоритет сверху вниз) >>>>>>
		
		//Черный список IP - $items['antispam_ips_black'];
		if (in_array($ip, $items['antispam_ips_black'])) $errors['ip'] = $ip;
		
		//Стоп-слова - $items['antispam_stop_word'];
		if (count($items['antispam_stop_word']) > 0) {
			$fioexplode = explode(" ", $fio);
			foreach($items['antispam_stop_word'] as $word) {
				if (in_array($word, $fioexplode)) $errors['stopword'] = $word;
			}
		}
		
		//0-Не использовать,1-Выводить ошибку при срабатывании фильтра,2-Имитировать успешное оформление заказа
		if ((!empty($errors)) && $items['antispam_use'][0] == '0') $errors = [];
		if ((!empty($errors)) && $items['antispam_use'][0] == '1') $errors['status'] = 'error';
		if ((!empty($errors)) && $items['antispam_use'][0] == '2') $errors['status'] = 'fake';
		
		//Мин.секунд на оформление заказа - $items['antispam_time_min'];
		//Макс.секунд на оформление заказа - $items['antispam_time_min'];
		if ($time_min && (int)$items['antispam_time_min'][0] > 0 && (int)$items['antispam_time_min'][0] < $time_min) array_push($errors, ['time_min' => $time_min]);
		if ($time_max && (int)$items['antispam_time_max'][0] > 0 && (int)$items['antispam_time_max'][0] > $time_max) array_push($errors, ['time_max' => $time_min]);
		
		//Страны
		$geo = self::getGeo($ip);
		$city = $geo['city'][0];
		if ($geo['countrycode'][0]) {
			//1-Запретить только выбранные страны,2-Запретить все страны, кроме выбранных
			$expl = explode(" ", $items['antispam_stop_country'][0]);
			if (size($expl) > 0) {
				if (in_array($geo['countrycode'][0], $expl) && $items['antispam_stop_country_type'] == '1') array_push($errors, ['country' => $geo['countrycode'][0]]);
				if (!in_array($geo['countrycode'][0], $expl) && $items['antispam_stop_country_type'] == '2') array_push($errors, ['country' => $geo['countrycode'][0]]);
			}
		}
		
		//Максимальное количество заказов с одного IP - $items['antispam_ips_max']
		//>>>>>>>
		
		$fields = [
			'domain' 							=> DOMAIN, 							//(varchar) домен проекта
			'id_user' 							=> 0, 								//(int) Id юзера
			'premium' 							=> 0,  								//(int) Premium
			'page' 								=> '',  								//(int) Раздел или страница, с которой отправлен заказ
			'status' 							=> 1, 								//(int) Статус 
			'time' 								=> time(), 							//(int) Дата подачи 
			'timeupdate' 						=> time(),  						//(int) Дата последнего изменения
			'lastUpdate' 						=> time(),  						//(int) Дата изменения статуса
			'price' 								=> '',  								//(int) Цена
			'total' 								=> '',  								//(int) Сумма заказа
			'agree_terms' 						=> 0,  								//(int) С условиями покупки согласен
			'agree_personal' 					=> 0,  								//(int) Согласен на обработку персональных данных
			'geo' 								=> $geo,  							//(varchar) geo по IP
			'name' 								=> $fio,								//(varchar) ФИО
			'goods_names' 						=> '',  								//(text) товары
			'domain2' 							=> $domain,  						//(int) домен, с которого пришел заказ
			'approvedAt' 						=> 0,  								//(int) Дата апрува
			'shippedAt' 						=> 0,  								//(int) Дата отправки
			'canceledAt' 						=> 0,  								//(int) Дата отмены
			'buyoutAt' 							=> 0,  								//(int) Дата выкупа
			'refundedAt' 						=> 0,  								//(int) Дата возврата
			'comment' 							=> '',  								//(int) Комментарий
			'log_robot' 						=> '',  								//(int) Лог робота
			'all' 								=> '',  								//(int) Итого
			'time_call' 						=> 0,  								//(int) Время перезвона
			'attempts' 							=> 0,  								//(int) Количество попыток
			'liveinform' 						=> '',  								//(int) Группа режима прозвона
			'russianpostTrack' 				=> 0,  								//(int) Почта России: Track
			'russianpostStatus' 				=> '',  								//(int) Почта России: cтатус посылки
			'count' 								=> 0,  								//(int) Кол-во
			'postIndex' 						=> 0,  								//(int) Индекс
			'region' 							=> '',  								//(int) Регион
			'city' 								=> $city,  					//(int) Город
			'address' 							=> '',  								//(int) Адрес
			'house' 								=> '',  								//(int) Дом
			'flat' 								=> '',  								//(int) Квартира
			'phone' 								=> $phone,  						//(int) Телефон
			'email' 								=> '',  								//(int) Email
			'category' 							=> '',  								//(int) Категория товара
			'lastSms' 							=> '',  								//(int) Последнее SMS
			'smsStatus' 						=> '',  								//(int) Статус SMS
			'lastVoiceSms' 					=> '',  								//(int) Последнее голосовое SMS
			'lastVoiceStatus' 				=> '',  								//(int) Статус голосового SMS
			'liveinformId' 					=> '',  								//(int) Liveinform ID
			'size' 								=> '',  								//(int) Размер
			'completely' 						=> '',  								//(text) Дожим
			'weight' 							=> '',  								//(int) Масса
			'tag' 								=> '',  								//(int) Метка
			'source' 							=> '',  								//(int) Источник
			'ip' 									=> $ip,  							//(varchar) IP
			'referrer' 							=> $referer,  						//(int) Referrer
			'expend' 							=> '',  								//(int) Затрачено
			'externalId' 						=> $key,  							//(int) External ID
			'webmasterId' 						=> '',  								//(int) External Webmaster
			'dop1' 								=> '',  								//(int) Доп.поле 1
			'dop2' 								=> '',  								//(int) Доп.поле 2
			'dop3' 								=> '',  								//(int) Доп.поле 3
			'dop4' 								=> '',  								//(int) Доп.поле 4
			'dop5' 								=> '',  								//(int) Доп.поле 5
			'dop6' 								=> '',  								//(int) Доп.поле 6
			'dop7' 								=> '',  								//(int) Доп.поле 7
			'dop8' 								=> '',  								//(int) Доп.поле 8
			'dop9' 								=> '',  								//(int) Доп.поле 9
			'dop10' 								=> '',  								//(int) Доп.поле 10
			'timezone' 							=> '',  								//(int) Смещение по гринвичу (мин)
			'allBuyPrice' 						=> '',  								//(int) Закупочная цена (Итого)
			'developerPrice' 					=> '',  								//(int) Вебмастер сумма
			'utm_source' 						=> $utm_source,  					//(int) UTM-Source
			'utm_medium' 						=> $utm_medium,  					//(int) UTM-Medium
			'utm_campaign' 					=> $utm_campaign,  				//(int) UTM-Campaign
			'utm_term' 							=> $utm_term,  					//(int) UTM-Term
			'utm_content' 						=> $utm_content,  				//(int) UTM-Content
			'operator' 							=> '',  								//(int) operator
			'sms_template' 					=> '', 								//(int) sms_template
			'errors' 							=> $errors 							//Антиспам выявлено
		];

		//здесь можно подключить аккаунты партнеров
// 		switch($key) {	 
// 			case '5sBrM9tE':
// 			break;  
// 			case '6sBrM9tE':
// 			break; 
// 		}

		
		//фильтруем от пустых значений
		$fields = array_filter($fields);
		return $fields; 
	}
	
	//xml to json
	public function Parse($url) {
		$fileContents= file_get_contents($url);
		$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
		$fileContents = trim(str_replace('"', "'", $fileContents));
		$simpleXml = simplexml_load_string($fileContents);
		return $simpleXml;
	}
	//ip to geo
	function getGeo($ip = null) {
		return self::Parse("http://api.geoiplookup.net/?query=$ip")->results->result;
	}
	//поиск дублей по номеру телефона
	function getDoublePhone($phone = null) {
		$phone = ($phone) ?: (int)$_POST['phone']; 
		$items = [];
		$Result = JBase::Query("
			select id, status from list14 where phone = '$phone' union all
			select id, status from list15 where phone = '$phone' union all
			select id, status from list16 where phone = '$phone' union all
			select id, status from list17 where phone = '$phone' union all
			select id, status from list18 where phone = '$phone' union all
			select id, status from list19 where phone = '$phone' union all
			select id, status from list20 where phone = '$phone' limit 10
		");			
		if (!empty($Result)) {
			while ($item = $Result->fetch_assoc()) 
				$items[$item['id']] = $item['status']; 		
		}	
		return ['phone' => $items];
	}
	function getDoubleIP($ip = null) {
		$ip = ($ip) ?: (int)$_POST['ip']; 
		$ips = [];
		$Result = JBase::Query("
			select id, status from list14 where ip = '$ip' union all
			select id, status from list15 where ip = '$ip' union all
			select id, status from list16 where ip = '$ip' union all
			select id, status from list17 where ip = '$ip' union all
			select id, status from list18 where ip = '$ip' union all
			select id, status from list19 where ip = '$ip' union all
			select id, status from list20 where ip = '$ip' limit 10
		");			
		if (!empty($Result)) {
			while ($item = $Result->fetch_assoc()) 
				$ips[$item['id']] = $item['status']; 		
		}	
		return ['ip' => $ips];
	}

	function statusTo($status, $project) {
		$Result = DB::Get_Data_ND('associate', ['list', 'id'], [$project => $status]);			
		if (!empty($Result)) {
			$items = [];
			while ($item = $Result->fetch_assoc()) 
				$items = $item;	
			return $items;
		} else {
			return [1, 17];
		}
	}

	function ItemWeight($goodsID){
		// $post 		= (!empty($_POST)) ? $_POST : $_GET;

		if($goodsID == '') return 1;

		$product 	= JBase::Get_Data('list22', '*', ['id'=>$goodsID]);
		$result 	= $product->fetch_assoc();

		if($result['weight'] == '') return 1;

		return $result['weight'];
	}

	//товары
	function goodsToArray($str, $project) {
		//если товары
		if (is_array($str)) {
			$ret = [];
			switch($project) {
				case 'migrate'://миграция по 100
					$strArr 	= explode(";", $str);						
					//перебираем товары
					foreach ($strArr as $k => $v) {
						$good = explode(",", $v); //$good[0] - название товара
						//$goodParams = explode(" шт. за ", $good); //$goodParams[0] - кол-во, $goodParams[1] - цена
						//$goodParams = explode(".", $good[1]); //substr($goodParams[0], -3) - кол-во, substr($goodParams[1], 4) - цена
						$goodArr = explode(".", $good[1]); //substr($goodParams[0], -3) - кол-во, substr($goodParams[1], 4) - цена
						
						$alias =  md5($k);
						$ret[$alias] = [
							'goodID' 	=> $alias,
							'name' 		=> trim($good[0]),
							'price' 		=> explode(' ', trim($goodArr[1]))[1], //preg_replace( '/[^0-9]/', '', $goodParams[1] ),
							'quantity' 	=> explode(' ', trim($goodArr[0]))[0] //preg_replace( '/[^0-9]/', '', $goodParams[0] )
						];
					}
				break;
				case 'fun':					
				case 'crossi':					
					//перебираем товары
					foreach ($str as $k => $v) {
						$ret[$v['goodID']] = [
							'name' 		=> $v['name'],
							'price' 		=> $v['price'],
							'goodID' 	=> $v['goodID'],
							'quantity' 	=> $v['quantity']
						];
					}
				break;
				case 'lead':
				case 'blackdollar'://blackdollar
				case 'total':
					$num = 0;
					foreach ($str as $k => $v) {
						$Result = JBase::Get_Data('list22', '*', ['id' => $v]);
						if (!empty($Result)) {
							while ($numrow = $Result->fetch_assoc()) {
								$num += $numrow['price'];
							}
						}
					}
					return json_encode($num, JSON_UNESCAPED_UNICODE);
				break;
				case 'cpa':	
					foreach ($str as $k => $v) {
						// $good = [];
						$Result = JBase::Get_Data('list22', '*', ['id' => $v]);
						if (!empty($Result)) {
							while ($numrow = $Result->fetch_assoc()) {
								$good[$numrow['id']] = [
									'name' 		=> $numrow['name'],
									'price' 		=> $numrow['price'],
									'goodID' 	=> $numrow['id'],
									'quantity' 	=> 1
								];	
							}
						}
					}
					return json_encode($good, JSON_UNESCAPED_UNICODE);
				break;
				default:
					//перебираем товары
					foreach ($str as $k => $v) {
						$ret[$v['goodID']] = [
							'name' 		=> JBase::Get_Field_Value_From_Id('list22', $v['goodID'], 'name'),
							'price' 		=> $v['price'],
							'goodID' 	=> $v['goodID'],
							'quantity' 	=> $v['quantity']
						];
					}
					return json_encode($ret, JSON_UNESCAPED_UNICODE);
				break;
			}		
		} elseif ($str == (int)$str && (int)$str > 0) {
			switch($project) {
				case 'total':
					$num = 500;
					$Result = JBase::Get_Data('list22', '*', ['id' => (int)$str]);
					if (!empty($Result)) {
						while ($numrow = $Result->fetch_assoc()) {
							$num += $numrow['price'];
						}
						return json_encode($num, JSON_UNESCAPED_UNICODE);
					}
				break;
				case 'cpa': //cpa				
					$good = [];
					$Result = JBase::Get_Data('list22', '*', ['id' => (int)$str]);
					if (!empty($Result)) {
						while ($numrow = $Result->fetch_assoc()) {
							$good[$numrow['id']] = [
								'name' 		=> $numrow['name'],
								'price' 		=> $numrow['price'],
								'goodID' 	=> $numrow['id'],
								'quantity' 	=> 1
							];	
						}
						$good['33324'] = [
							"id" 			=> "33324",
							"name" 		=> "Доставка по РФ",
							"alias" 		=> "Dostavka_500_",
							"price" 		=> "500",
							"priceAll" 	=> "{}",
							"quantity" 	=> "1",
							"goodID" 	=> "33324"];
						return json_encode($good, JSON_UNESCAPED_UNICODE);
					}
				break;
			}
		}
	}

	//товары
	function goodsToArrayApproved($str, $project) {
		//если товары
		if (is_array($str)) {
			$ret = [];
			switch($project) {
				case 'migrate'://миграция по 100
					$strArr 	= explode(";", $str);						
					//перебираем товары
					foreach ($strArr as $k => $v) {
						$good = explode(",", $v); //$good[0] - название товара
						//$goodParams = explode(" шт. за ", $good); //$goodParams[0] - кол-во, $goodParams[1] - цена
						//$goodParams = explode(".", $good[1]); //substr($goodParams[0], -3) - кол-во, substr($goodParams[1], 4) - цена
						$goodArr = explode(".", $good[1]); //substr($goodParams[0], -3) - кол-во, substr($goodParams[1], 4) - цена
						
						$alias =  md5($k);
						$ret[$alias] = [
							'goodID' 	=> $alias,
							'name' 		=> trim($good[0]),
							'price' 		=> explode(' ', trim($goodArr[1]))[1], //preg_replace( '/[^0-9]/', '', $goodParams[1] ),
							'quantity' 	=> explode(' ', trim($goodArr[0]))[0] //preg_replace( '/[^0-9]/', '', $goodParams[0] )
						];
					}
				break;
				case 'fun':					
				case 'crossi':					
					//перебираем товары
					foreach ($str as $k => $v) {
						$ret[$v['goodID']] = [
							'name' 		=> $v['name'],
							'price' 		=> $v['price'],
							'goodID' 	=> $v['goodID'],
							'quantity' 	=> $v['quantity']
						];
					}
				break;
				case 'lead':
				case 'blackdollar'://blackdollar
				case 'total':
					$num = 0;
					foreach ($str as $k => $v) {
						$Result = JBase::Get_Data('list22', '*', ['id' => $v]);
						if (!empty($Result)) {
							while ($numrow = $Result->fetch_assoc()) {
								$num += $numrow['price'];
							}
						}
					}
					return json_encode($num, JSON_UNESCAPED_UNICODE);
				break;
				case 'cpa':	
					$cnt = 0;
					$good = [];
					
					foreach ($str as $k => $v) {
						$Result = JBase::Get_Data('list22', '*', ['id' => $v]);
						if (!empty($Result)) {
							while ($numrow = $Result->fetch_assoc()) {
								$good[$numrow['id']] = [
									'name' 		=> $numrow['name'],
									'price' 		=> $numrow['price'],
									'goodID' 	=> $numrow['id'],
									'quantity' 	=> 1
								];
								$cnt++;	
							}
						}
					}
					return json_encode($good, JSON_UNESCAPED_UNICODE);
				break;
				default:
					//перебираем товары
					foreach ($str as $k => $v) {
						$ret[$v['goodID']] = [
							'name' 		=> JBase::Get_Field_Value_From_Id('list22', $v['goodID'], 'name'),
							'price' 		=> $v['price'],
							'goodID' 	=> $v['goodID'],
							'quantity' 	=> $v['quantity']
						];
					}
					return json_encode($ret, JSON_UNESCAPED_UNICODE);
				break;
			}		
		} elseif ($str == (int)$str && (int)$str > 0) {
			switch($project) {
				case 'total':
					$num = 0;
					$Result = JBase::Get_Data('list22', '*', ['id' => (int)$str]);
					if (!empty($Result)) {
						while ($numrow = $Result->fetch_assoc()) {
							$num += $numrow['price'];
						}
						return json_encode($num, JSON_UNESCAPED_UNICODE);
					}
				break;
				case 'cpa': //cpa				
					$good = [];
					$Result = JBase::Get_Data('list22', '*', ['id' => (int)$str]);
					if (!empty($Result)) {
						while ($numrow = $Result->fetch_assoc()) {
							$good[$numrow['id']] = [
								'name' 		=> $numrow['name'],
								'price' 		=> $numrow['price'],
								'goodID' 	=> $numrow['id'],
								'quantity' 	=> 1
							];	
						}
						return json_encode($good, JSON_UNESCAPED_UNICODE);
					}
				break;
			}
		}
	}

	//geo
	function geo($ip) {
	
		/* API Geolocation
	
		sample:	https://api.ipgeolocation.io/ipgeo?apiKey=f55f35463f4045c3ad1693ad7db69a9d&ip=1.1.1.1	
		api-key:	f55f35463f4045c3ad1693ad7db69a9d
		limit: 	1K Daily, 30K Requests Per Month
		
		return: 	{
			"ip":"176.59.45.107",
			"continent_code":"EU",
			"continent_name":"Europe",
			"country_code2":"RU",
			"country_code3":"RUS",
			"country_name":"Russia",
			"country_capital":"Moscow",
			"state_prov":"Central Federal District",
			"district":"Tverskoy",
			"city":"Moscow",
			"zipcode":"127006",
			"latitude":"55.75580",
			"longitude":"37.61730",
			"is_eu":false,
			"calling_code":"+7",
			"country_tld":".ru",
			"languages":"ru,tt,xal,cau,ady,kv,ce,tyv,cv,udm,tut,mns,bua,myv,mdf,chm,ba,inh,tut,kbd,krc,av,sah,nog",
			"country_flag":"https://ipgeolocation.io/static/flags/ru_64.png",
			"geoname_id":"524901",
			"isp":"Tele2 Russia Groups",
			"connection_type":"",
			"organization":"T2 Mobile LLC",
			"currency": {
				"code": "RUB", "name": "Russian Ruble", "symbol": "₽"
			},
			"time_zone": {
				"name": "Europe/Moscow", 
				"offset": 3, 
				"current_time": "2019-09-09 11:28:37.342+0300", 
				"current_time_unix": 1568017717.342, 
				"is_dst": false, 
				"dst_savings": 0
			}
		}*/

 		$curl = curl_init();
 		curl_setopt($curl, CURLOPT_URL, 'https://api.ipgeolocation.io/ipgeo?apiKey=099a950e34044483b31d99d3c6bdc9c8&ip='. $ip); //урл сайта к которому обращаемся
 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 		$posts = json_decode(curl_exec($curl), true);
     	curl_close($curl);
    	# ПРИХОДИТ сообщение "message": "Your subscription is not active."
    	return $posts;
	}
	//timezone
	function sign( $number ) { 
		return ( $number > 0 ) ? 1 : ( ( $number < 0 ) ? -1 : 0 ); 
	}
	
	
	//curl 'https://api.ipgeolocation.io/ipgeo?apiKey=f55f35463f4045c3ad1693ad7db69a9d&ip=1.1.1.1'
	
	
	
	
	//https://dev.maxmind.com/geoip/geoip2/geolite2/
	//https://ipapi.co/
	//curl https://ipapi.co/8.8.8.8/json/  limit 1000 per day !
	//http://ip-api.com/json/176.112.221.123
	
	

	//http://api.ipinfodb.com/v3/ip-city/?key=YOUR_API_KEY&ip=IP_V4_OR_IPV6_ADDRESS                		 
	
	//https://apple.stackexchange.com/questions/237030/how-to-get-the-geolocation-of-an-ip-address-in-terminal ?
	//curl https://freegeoip.app/xml/17.178.96.59


		//здесь можно подключить аккаунты партнеров
// 		switch($key) {	 
// 			case '5sBrM9tE':
// 			break;  
// 			case '6sBrM9tE':
// 			break; 
// 		}






//	https://krossi.leadvertex.ru/api/admin/getOrdersByIds.html?token=1234567&ids=10055,10224,10382
// {
//     "10055": {
//         "datetime": "2018-12-16 17:57:11",
//         "timezone": -180,
//         "status": 9,
//         "statusGroup": "spam",
//         "price": 4190,
//         "total": 4190,
//         "webmaster": null,
//         "operatorID": "18724",
//         "domain": "ecco-winter.ru",
//         "referer": "https:\/\/www.google.ru\/",
//         "ip": "188.0.169.213",
//         "timeSpent": 232,
//         "utm_source": "",
//         "utm_medium": "",
//         "utm_term": "",
//         "utm_content": "",
//         "utm_campaign": "",
//         "lastUpdate": "2018-12-20 17:39:18",
//         "lastModify": "2018-12-20 17:39:18",
//         "russianpostTrack": "",
//         "russianpostStatus": "",
//         "goods": {
//             "33324": {
//                 "goodID": 33324,
//                 "name": "Доставка по РФ",
//                 "quantity": "1",
//                 "price": "500",
//                 "categoryID": "1552",
//                 "categoryName": "Доставка",
//                 "purchasingPrice": "0"
//             },
//             "51808": {
//                 "goodID": 51808,
//                 "name": "Экко кроссовки",
//                 "quantity": "1",
//                 "price": "3690",
//                 "categoryID": "1487",
//                 "categoryName": "Кроссовки",
//                 "purchasingPrice": "0"
//             }
//         },
//         "lastTextSms": "2018-12-19: Здравствуйте, наш менеджер с телефона +74993468451 звонил вам для подтверждения заказа товара. Мы снова вам перезвоним в течении 2 часов.",
//         "lastVoiceSms": "2018-12-20: {{audio=\"http:\/\/files.lvcdn.ru\/2017\/09\/24813\/742050a34bb4db63fd4f0c0648ac8c54_rec_6s.mp3\"}}",
//         "lastVoiceSmsStatus": "Занято",
//         "callmodeRecallAt": "0000-00-00 00:00:00",
//         "approvedAt": null,
//         "canceledAt": null,
//         "shippedAt": null,
//         "buyoutAt": null,
//         "refundedAt": null,
//         "roboLog": null,
//         "recallLog": null,
//         "externalWebmaster": null,
//         "externalID": null,
//         "similar": {
//             "phone": 1,
//             "ip": 0
//         },
//         "fio": "Джабраил",
//         "postIndex": "",
//         "region": "",
//         "city": "",
//         "address": "",
//         "phone": "79287454799",
//         "quantity": "2",
//         "comment": "не отв \/зв. неудач: 2018-12-16 15:01 \/зв. неудач: 2018-12-17 08:03 \/зв. неудач: 2018-12-17 10:06 \/зв. удач: 2018-12-17 12:09 \/зв. неудач: 2018-12-17 12:27 \/зв. неудач: 2018-12-17 14:29 \/зв. неудач: 2018-12-17 16:30 \/зв. неудач: 2018-12-18 08:32 \/зв. неудач: 2018-12-18 10:37 \/зв. неудач: 2018-12-18 12:40 \/зв. неудач: 2018-12-18 14:42 \/зв. неудач: 2018-12-18 16:43 \/зв. удач: 2018-12-19 08:48 \/зв. неудач: 2018-12-19 10:16 \/зв. неудач: 2018-12-19 12:19 \/зв. неудач: 2018-12-19 14:21 сброс и занято 19.12 в 19.09 \/зв. неудач: 2018-12-19 16:22 \/зв. неудач: 2018-12-20 08:25 \/зв. неудач: 2018-12-20 10:29 сброс и занято 20.12 в 15.26 \/зв. неудач: 2018-12-20 12:33 \/зв. неудач: 2018-12-20 14:34",
//         "additional1": "",
//         "additional2": "",
//         "additional5": "",
//         "additional10": "",
//         "additional11": "",
//         "additional13": "",
//         "additional14": "",
//         "additional22": ""
//     }
// }



	//"33324":{"goodID":33324,"name":"Доставка по РФ","quantity":"1","price":"500","categoryID":"1552","categoryName":"Доставка","purchasingPrice":"0"}
	function goodsToArray2($str) {
		//если товары
		if (!is_array($str)) {
			$strArr = explode(";", $str);
			$goodArr = [];

			$ret = [];
			//$count = 33324;
			//перебираем товары
			foreach ($strArr as $k => $v) {
				$good = explode(",", $v); //$good[0] - название товара
				//$goodParams = explode(" шт. за ", $good); //$goodParams[0] - кол-во, $goodParams[1] - цена
				//$goodParams = explode(".", $good[1]); //substr($goodParams[0], -3) - кол-во, substr($goodParams[1], 4) - цена
				$goodArr = explode(".", $good[1]); //substr($goodParams[0], -3) - кол-во, substr($goodParams[1], 4) - цена

				$ret[$k] = [
					'categoryID' 		=> $count,
					'categoryName' 	=> trim($good[0]),
					'purchasingPrice' => '0',
					'goodID' 			=> $count,
					'name' 				=> trim($good[0]),
					'price' 				=> explode(' ', trim($goodArr[1]))[1], //preg_replace( '/[^0-9]/', '', $goodParams[1] ),
					'quantity' 			=> explode(' ', trim($goodArr[0]))[0] //preg_replace( '/[^0-9]/', '', $goodParams[0] )
				];
				//$count++;
			}
			return json_encode($ret, JSON_UNESCAPED_UNICODE);		
		} else {
			return $str;
		}
	}

	//сопоставление статусов различных проектов
	function statusTo2($status, $project) {
		$Result = JBase::Query("SELECT `list`,`id` FROM `associate` WHERE `".$project."`='". $status ."'");			
		if (!empty($Result)) {
			$items = [];
			while ($item = $Result->fetch_assoc()) 
				$items = $item;	
			return $items;
		} else {
			return false;
		}
	}

	//миграция проекта
	function migrateProject() {
	
	
		/*
	
			Миграция проекта с помощью JavaScript
	
			var count = 0;
			setInterval(() => {
				var json = {func:'api'};
				json["action"] = "migrateProject";
				json["in"] = count*100 + 1;
				json["out"] = count*100 + 1 + 100;
				$.post("/json/", json, function(result) {
					console.log(count*100 +' = '+ result)
				})
				count++
			}, 10000)
	
		*/
	
		//доступы
		$api = [
			'tel-2' => '1234567',//6000//710k
			'tel' => '1234567',//24000//720k
			'topsale' => '1234567',//40100//750k
			'cpa-sale' => '12345678910',//30900//800k
			'fb-2' => '413439610',//15000//900k
			'fb' => '413439610',//35030//850k
			'cpa-crm2' => '123654789',//4000//920k
			'cpa-crm' => '12345678910',//4000//930k-
			'boris1' => '0dd4f3cfa6f5d5c25f6386b6a189494a',//5000//700k
			'krossi' => '1234567',//25600//600k
			'fun-2' => '9SUx2s5hqwXZdSEvAbOj',//119100//200к
			'fun' => '12345678910'//166010//400k
		];
	
		$post = (!empty($_POST)) ? $_POST : $_GET;
		$in = (int)$post['in'];
		$out = (int)$post['out'];
		if ($in == 0 || $out == 0) return 'in/out=0';
		//return $out;
		$proj = 'cpa-crm';
		$range = implode(',', range($in, $out));
		//$range = 26;
 		$curl = curl_init();
//  		+curl_setopt($curl, CURLOPT_URL, 'https://tel-2.leadvertex.ru/api/admin/getOrdersByIds.html?token=1234567&ids='. $range); //урл сайта к которому обращаемся
//  		+curl_setopt($curl, CURLOPT_URL, 'https://tel.leadvertex.ru/api/admin/getOrdersByIds.html?token=1234567&ids='. $range); //урл сайта к которому обращаемся
//  		+curl_setopt($curl, CURLOPT_URL, 'https://topsale.leadvertex.ru/api/admin/getOrdersByIds.html?token=1234567&ids='. $range); //урл сайта к которому обращаемся
// 		+curl_setopt($curl, CURLOPT_URL, 'https://cpa-sale.leadvertex.ru/api/admin/getOrdersByIds.html?token=12345678910&ids='. $range); //урл сайта к которому обращаемся
//  		+curl_setopt($curl, CURLOPT_URL, 'https://fb-2.leadvertex.ru/api/admin/getOrdersByIds.html?token=413439610&ids='. $range); //урл сайта к которому обращаемся
//  		+curl_setopt($curl, CURLOPT_URL, 'https://fb.leadvertex.ru/api/admin/getOrdersByIds.html?token=413439610&ids='. $range); //урл сайта к которому обращаемся
//  		+curl_setopt($curl, CURLOPT_URL, 'https://cpa-crm2.leadvertex.ru/api/admin/getOrdersByIds.html?token=123654789&ids='. $range); //урл сайта к которому обращаемся
//  		curl_setopt($curl, CURLOPT_URL, 'https://cpa-crm.leadvertex.ru/api/admin/getOrdersByIds.html?token=12345678910&ids='. $range); //урл сайта к которому обращаемся
//  		+curl_setopt($curl, CURLOPT_URL, 'https://fun-2.leadvertex.ru/api/admin/getOrdersByIds.html?token=9SUx2s5hqwXZdSEvAbOj&ids='. $range); //урл сайта к которому обращаемся
// 		+curl_setopt($curl, CURLOPT_URL, 'https://boris1.leadvertex.ru/api/admin/getOrdersByIds.html?token=0dd4f3cfa6f5d5c25f6386b6a189494a&ids='. $range); //урл сайта к которому обращаемся
//  		+curl_setopt($curl, CURLOPT_URL, 'https://krossi.leadvertex.ru/api/admin/getOrdersByIds.html?token=1234567&ids='. $range); //урл сайта к которому обращаемся
//  		+curl_setopt($curl, CURLOPT_URL, 'https://fun.leadvertex.ru/api/admin/getOrdersByIds.html?token=12345678910&ids='. $range); //урл сайта к которому обращаемся
//  		curl_setopt($curl, CURLOPT_POST, 1);
 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  		curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 5'); //эта строчка как-бы говорит: "я не скрипт, я IE5" :)
 		$result = json_decode(curl_exec($curl), true);
     	curl_close($curl);
    	
    	foreach ($result as $key => $value) {
    		if (isset($value['datetime']) && strtotime($value['datetime']) < 1569888000) self::migrateProject2($value, $proj, $key);
    	}
    	return ['OK' => (int)count($result)];
    	//return [json_encode($result) => 'OK'];
    }
	//миграция проекта
   function migrateProject2($post, $proj, $lvid) {
			$post2									= json_encode($post, JSON_UNESCAPED_UNICODE);
   	 	$statusTo 								= self::statusTo2($post['status'], $proj);
			//return $post;
			$list 									= $statusTo['list'];
   	 	$status 									= $statusTo['id'];
    	
			$city 									= (isset($post['city'])) ? $post['city'] : '';
			$address 								= (isset($post['address'])) ? $post['address'] : '';
	    	$query 									= (!empty($city) && !empty($address)) ? $city .', '. $address : '';
	    	//$addr 									= (!empty($city) && !empty($address)) ? Dadata::clean3('address', $query) : [];	
	    	$addr 									= [];	
	    	
// 			$flat = implode(" ", [$addr['flat_type'], $addr['flat']]);
// 			$city  = implode(" ", [
// 				implode(" ", [$addr['city_type'], $addr['city']]), 
// 				implode(" ", [$addr['settlement_type'], $addr['settlement']])
// 			]);
// 			$house = implode(" ", [
// 				implode(" ", [$addr['house_type'], $addr['house']]),
// 				implode(" ", [$addr['block_type'], $addr['block']])
// 			]);
// 			$region = implode(" ", [
// 				implode(" ", [$addr['region_type'], $addr['region']]),
// 				implode(" ", [$addr['area_type'], $addr['area']])
// 			]);
// 			$street = implode(" ", [$addr['street_type'], $addr['street']]);
			
			
			//$postIndex 								= (!empty($addr) && !isset($post['postIndex'])) ? $addr['postal_code'] : $post['postIndex'];
			$postIndex 							= $post['postIndex'];
			$city 								= $post['city'];
			$region 								= '';
			$street 								= $address;
			$house 								= '';
			$flat 								= '';
			//$timezone 								= (!empty($addr)) ? $addr['timezone'] : '';//UTC+5
	
	
			$dop10 = '';
			if (isset($post['additional10']) && !empty($post['additional10'])) $dop10 .= $post['additional10']; 
			if (isset($post['additional12']) && !empty($post['additional12'])) $dop10 .= $post['additional12'];
			if (isset($post['additional13']) && !empty($post['additional13'])) $dop10 .= $post['additional13'];
			if (isset($post['additional15']) && !empty($post['additional15'])) $dop10 .= $post['additional15'];
			if (isset($post['additional16']) && !empty($post['additional16'])) $dop10 .= $post['additional16'];
			if (isset($post['additional17']) && !empty($post['additional17'])) $dop10 .= $post['additional17'];
			if (isset($post['additional18']) && !empty($post['additional18'])) $dop10 .= $post['additional18'];
			if (isset($post['additional19']) && !empty($post['additional19'])) $dop10 .= $post['additional19'];
			if (isset($post['additional20']) && !empty($post['additional20'])) $dop10 .= $post['additional20'];
			if (isset($post['additional21']) && !empty($post['additional21'])) $dop10 .= $post['additional21']; 
			if (isset($post['additional22']) && !empty($post['additional22'])) $dop10 .= $post['additional22'];
			if (isset($post['additional23']) && !empty($post['additional23'])) $dop10 .= $post['additional23'];
			if (isset($post['additional24']) && !empty($post['additional24'])) $dop10 .= $post['additional24'];
			if (isset($post['additional25']) && !empty($post['additional25'])) $dop10 .= $post['additional25'];

			$phone = (isset($post['phone'])) ? '7'. substr(preg_replace( '/\..*|[^0-9]/', '',  $post['phone']), -10) : '';
		
			//return JBase::Set_Data('list17', ['domain','robot','status'], [DOMAIN, $post, 1]);
			$fields = [
				'id' 									=> 930000 + (int)$lvid,																								//(int) Premium
				'domain' 							=> DOMAIN, 																								//(varchar) домен проекта
				'id_user' 							=> (isset($post['operatorID'])) ? $post['operatorID'] : 0, 								//(int) Id юзера
				//'premium' 							=> $first,  																									//(int) Premium
				'page' 								=> $post2,  																							//(int) Раздел или страница, с которой отправлен заказ
				'status' 							=> $status, 																							//(int) Статус 
				'time' 								=> (isset($post['datetime']) && $post['datetime'] != '0000-00-00 00:00:00') ? strtotime($post['datetime']) : '',							//(int) Дата подачи 
				'timeupdate' 						=> (isset($post['lastModify']) && $post['lastModify'] != '0000-00-00 00:00:00') ? strtotime($post['lastModify']) : '',			//(int) Дата последнего изменения
				'lastUpdate' 						=> (isset($post['lastUpdate']) && $post['lastUpdate'] != '0000-00-00 00:00:00') ? strtotime($post['lastUpdate']) : '',  																							//(int) Дата изменения статуса
				'price' 								=> (isset($post['price'])) ? (float)$post['price'] : 0,									//(int) Цена
				'total' 								=> (isset($post['total'])) ? (float)$post['total'] : 0,									//(int) Сумма заказа
				'agree_terms' 						=> 0,  																									//(int) С условиями покупки согласен
				'agree_personal' 					=> 0,  																									//(int) Согласен на обработку персональных данных
				'geo' 								=> json_encode(array_filter($addr), JSON_UNESCAPED_UNICODE),  							//(varchar) geo по IP
				'name' 								=> (isset($post['fio'])) ? $post['fio'] : '',												//(varchar) ФИО
				'goods_names' 						=> (isset($post['goods'])) ? json_encode($post['goods'], JSON_UNESCAPED_UNICODE) : '{}',  			//(text) товары
				'domain2' 							=> (isset($post['domain'])) ? $post['domain'] : '',										//(int) домен, с которого пришел заказ
				'approvedAt' 						=> (isset($post['approvedAt']) && $post['approvedAt'] != '0000-00-00 00:00:00') ? strtotime($post['approvedAt']) : 0,  				//(int) Дата апрува
				'shippedAt' 						=> (isset($post['shippedAt']) && $post['shippedAt'] != '0000-00-00 00:00:00') ? strtotime($post['shippedAt']) : 0,  				//(int) Дата отправки
				'canceledAt' 						=> (isset($post['canceledAt']) && $post['canceledAt'] != '0000-00-00 00:00:00') ? strtotime($post['canceledAt']) : 0,  				//(int) Дата отмены
				'buyoutAt' 							=> (isset($post['buyoutAt']) && $post['buyoutAt'] != '0000-00-00 00:00:00') ? strtotime($post['buyoutAt']) : 0,  					//(int) Дата выкупа
				'refundedAt' 						=> (isset($post['refundedAt']) && $post['refundedAt'] != '0000-00-00 00:00:00') ? strtotime($post['refundedAt']) : 0,  				//(int) Дата возврата
				'comment' 							=> (isset($post['comment'])) ? $post['comment'] : '',  									//(int) Комментарий
				'log_robot' 						=> (isset($post['roboLog'])) ? $post['roboLog'] : '',  									//(int) Лог робота
				'all' 								=> '',  																									//(int) Дубли
				'time_call' 						=> 0,  																									//(int) Время перезвона
				'attempts' 							=> 0,  																									//(int) Количество попыток
				'liveinformId' 					=> '',  																									//(int) Группа режима прозвона
				'russianpostTrack' 				=> (isset($post['russianpostTrack'])) ? (int)$post['russianpostTrack'] : 0,		//(int) Почта России: Track
				'russianpostStatus' 				=> '',  																									//(int) Почта России: cтатус посылки
				'count' 								=> 0,  																														//(int) Кол-во
				'postIndex' 						=> $postIndex,  																											//(int) Индекс
				'region' 							=> trim($region),  																										//(int) Регион
				'city' 								=> (substr($city, 0, 2) == ', ' || substr($city, 0, 2) == ' , ') ? substr($city, 2) : $city,		//(int) Город
				'address' 							=> trim($street),																											//(int) Адрес
				'house' 								=> trim($house),  																										//(int) Дом
				'flat' 								=> $flat,  																													//(int) Квартира
				'phone' 								=> $phone,  										//(int) Телефон
				'email' 								=> '',  																									//(int) Email
				'category' 							=> '',  																									//(int) Категория товара
				'lastSms' 							=> (isset($post['lastTextSms'])) ? $post['lastTextSms'] : '',  						//(int) Последнее SMS
				'smsStatus' 						=> '',  																									//(int) Статус SMS
				'callmodeRecallAt' 				=> (isset($post['callmodeRecallAt']) && $post['callmodeRecallAt'] != '0000-00-00 00:00:00') ? strtotime($post['callmodeRecallAt']) : '',  	//(int) Последнее голосовое SMS
				'lastVoiceSms' 					=> (isset($post['lastVoiceSms'])) ? $post['lastVoiceSms'] : '',  						//(int) Последнее голосовое SMS
				'lastVoiceStatus' 				=> (isset($post['lastVoiceStatus'])) ? $post['lastVoiceStatus'] : '',  				//(int) Статус голосового SMS
				'liveinform' 						=> (isset($post['additional1'])) ? $post['additional1'] : '',  						//(int) Liveinform ID
				'size' 								=> (isset($post['additional2'])) ? $post['additional2'] : '',  						//(varchar) Размер
				'completely' 						=> (isset($post['additional11'])) ? $post['additional11'] : '',  						//(text) Дожим
				'weight' 							=> (isset($post['additional14'])) ? $post['additional14'] : '',  						//(int) Масса
				'tag' 								=> '', 																								//(int) Метка
				'source' 							=> '',  																									//(int) Источник
				'ip' 									=> (isset($post['ip'])) ? $post['ip'] : '0.0.0.0',  										//(varchar) IP
				'referrer' 							=> (isset($post['referer'])) ? $post['referer'] : '',										//(int) Referrer
				'expend' 							=> '',  																									//(int) Затрачено
				'externalId' 						=> (isset($post['externalID']) && (int)$post['externalID'] > 0) ? $post['externalID'] : '',								//(int) External ID
				'webmasterId' 						=> (isset($post['externalWebmaster']) && (int)$post['externalWebmaster'] > 0) ? $post['externalWebmaster'] : ((isset($post['webmaster']['id'])) ? $post['webmaster']['id'] : ''),							//(int) External Webmaster
				'dop1' 								=> (isset($post['additional1'])) ? $post['additional1'] : '',  						//(int) Доп.поле 1
				'dop2' 								=> (isset($post['additional2'])) ? $post['additional2'] : '',  						//(int) Доп.поле 2
				'dop3' 								=> (isset($post['additional3'])) ? $post['additional3'] : '',  						//(int) Доп.поле 3
				'dop4' 								=> (isset($post['additional4'])) ? $post['additional4'] : '',  						//(int) Доп.поле 4
				'dop5' 								=> (isset($post['additional5'])) ? $post['additional5'] : '',  						//(int) Доп.поле 5
				'dop6' 								=> (isset($post['additional6'])) ? $post['additional6'] : '',  						//(int) Доп.поле 6
				'dop7' 								=> (isset($post['additional7'])) ? $post['additional7'] : '',  						//(int) Доп.поле 7
				'dop8' 								=> (isset($post['additional8'])) ? $post['additional8'] : '',  						//(int) Доп.поле 8
				'dop9' 								=> (isset($post['additional9'])) ? $post['additional9'] : '',  						//(int) Доп.поле 9
				'dop10' 								=> $dop10,  																							//(int) Доп.поле 10
				'timezone' 							=> (isset($post['timezone'])) ? $post['timezone'] : '',  								//(int) Смещение по гринвичу (мин)
				'allBuyPrice' 						=> '',  																									//(int) Закупочная цена (Итого)
				'developerPrice' 					=> (isset($post['webmaster'])) ? json_encode($post['webmaster']) : '',  																									//(int) Вебмастер сумма
				'utm_source' 						=> (isset($post['utm_source'])) ? $post['utm_source'] : '',  							//(int) UTM-Source
				'utm_medium' 						=> (isset($post['utm_medium'])) ? $post['utm_medium'] : '',  							//(int) UTM-Medium
				'utm_campaign' 					=> (isset($post['utm_campaign'])) ? $post['utm_campaign'] : '',  						//(int) UTM-Campaign
				'utm_content' 						=> (isset($post['utm_content'])) ? $post['utm_content'] : '',  						//(int) UTM-Content
				'utm_term' 							=> (isset($post['utm_term'])) ? $post['utm_term'] : '',  								//(int) UTM-Term
				'operator' 							=> (isset($post['operatorID'])) ? $post['operatorID'] : '',  							//(int) operator
				'sms_template' 					=> '',  																									//(int) operator
				'statustime' 						=> time(),  																							//(int) statustime
				'lvproject' 						=> $proj,  																								//(int) lvproject
				'lvid' 								=> $lvid  																								//(int) lvid
			];
	
			
			//фильтруем от пустых значений
			$fields 									= array_filter($fields);
			$Keys										= array_keys($fields);
			$Values									= array_values($fields);
			
			JBase::Set_Data('list'. $list, $Keys, $Values);
			$id = JBase::$SqlID;
		return [$id => 'OK'];
	}
	//миграция проекта
	function migrateProject3() {
	
// 		$post = (!empty($_POST)) ? $_POST : $_GET;
// 		$in = (int)$post['in'];
// 		$out = (int)$post['out'];
// 		if ($in == 0 || $out == 0) return 'in/out=0';
// 		
// 		
		$list20 = [];
		$Result = JBase::Get_Data('list14', ['id','page'], ['time' => 0]);
		
		if (!empty($Result)) {
			while ($numrow = $Result->fetch_assoc()) {
				$dt = str_replace('{{autoPredictive}}','', $numrow['page']);
				$dt = str_replace('http://','', $dt);
				$dt = str_replace("а\о","а/о", $dt);
				$dt = str_replace('"Красноярский рабочий"',"Красноярский рабочий", $dt);
				$dt = str_replace('"Пионерская правда"',"Пионерская правда", $dt);
				$dt = str_replace('"217.174.180.33":',"217.174.180.33", $dt);
				$dt = str_replace("\/","", $dt);				
				$dt = str_replace('\/','', $dt);
				$dt = str_replace('"CANON"',"CANON", $dt);
				$dt = str_replace("\t","", $dt);
				$dt = str_replace("\r","", $dt);
				$dt = str_replace("\n","", $dt);
				$dt = str_replace('mp3"','mp3', $dt);
				$dt = str_replace('audio="','audio=', $dt);
				$list20[$numrow['id']] = strtotime(json_decode($dt, true)['datetime']);
			}
			
			//return count($list20);
			$i = 0;
			foreach($list20 as $id => $datetime) {
				//return $datetime;
				JBase::Update_Data('list14', ['time' => $datetime], ['id' => (int)$id]);
				
				$i++;
				if ($i == 150) break;
			}
		}
	}
	//Поиск заказов по параметрам в leadvertex и выявление дублей: 
// 	function getDouble() {
// 		
// 		$items = [];
// 		$Result = JBase::Query("SELECT `id`,`phone` FROM `list17` WHERE `status` = '0'");
// 		if (!empty($Result)) {
// 			while ($item = $Result->fetch_assoc()) 
// 				$items[$item['id']] = $item;	
// 		}
// 		
// 		
// 		
// 		
// 		$id = 100;
// 		$pr = 'не определен';
// 		    	
// 		/*
// 
// 			Поиск заказов по параметрам в leadvertex и выявление дублей: 
// 			https://test991.leadvertex.ru/api/admin/getOrdersIdsByCondition.html?token=api_key_here&phone=88005553535 //["10055","10224","10382","10545","10557"]
// 
// 		*/
// 		
// 		//доступы
// 		$api = [
// 			'tel-2' => '1234567',
// 			'tel' => '1234567',
// 			'topsale' => '1234567',
// 			'cpa-sale' => '12345678910',
// 			'fb-2' => '413439610',
// 			'fb' => '413439610',
// 			'cpa-crm2' => '123654789',
// 			'cpa-crm' => '12345678910',
// 			'boris1' => '0dd4f3cfa6f5d5c25f6386b6a189494a',
// 			'krossi' => '1234567',
// 			'fun-2' => '9SUx2s5hqwXZdSEvAbOj',
// 			'fun' => '12345678910'
// 		];
// 		
// 		foreach ($items as $id => $item) {
// 			foreach ($api as $proj => $pass) {
// 				//Поиск заказов по параметрам в leadvertex
// 				$Url = 'https://'. $proj .'.leadvertex.ru/api/admin/getOrdersIdsByCondition.html?token='. $pass .'&phone='. $item['phone']; 			
//  				$curl = curl_init();
//  				curl_setopt($curl, CURLOPT_URL, $Url);
//  				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//  				$res = json_decode(curl_exec($curl), true);
//      			curl_close($curl);
// 				
// 				if (!empty($res) && (int)$res[0] == $res[0]) {
// 					$id = $res[0];
// 					$pr = $proj;
// 					break;
// 				} else {
// 					$id = 102;
// 				}
// 			}
// 		
// 			/*
// 
// 				1 если нет дублей 
// 				81 если есть дубли
// 	
// 			*/
// 			
// 			$status = ($id == 100) ? 1 : (($id == 102) ? 1 : 81);
// 			$comment = ($id == 100) ? 'Опрос на дубли не прошел' : (($id == 102) ? 'Дублей нет' : 'дубль: Заказ №'. $id .', проект '. $pr);
// 			JBase::Query("UPDATE `list17` SET `status` = '". $status ."', `comment` = '". $comment ."' WHERE `id` = '". $item['id'] ."'");
// 		}
// 	}
	
	/*
		
		Поиск заказов по параметрам в БД 'STAT' и выявление дублей:
		https://1v1-crm.ru/json?func=Api&action=getDoubleStat
		
	*/
	function getDoubleStat() {
		
		$items = [];
		$Result = JBase::Query("SELECT `id`,`phone` FROM `list17` WHERE `status` = '0' ORDER BY `id` DESC LIMIT 5");
		if (!empty($Result)) {
			while ($item = $Result->fetch_assoc()) {
				$items[$item['id']] = $item;	
			}
		}
		
		//доступы
		$tables = ['stat.list14','stat.list15','stat.list16','stat.list17','stat.list18','stat.list19','stat.list20'];
		
		/*

			Статистика ID заказов по проектам 

		*/
		
		$ids = [
			'cpa-sale' => 800000,
			'topsale' => 750000,
			'tel-2' => 710000,
			'fb-2' => 900000,
			'tel' => 720000,
			'fb' => 850000,
				
			'cpa-crm2' => 920000,
			'cpa-crm' => 930000,
			'boris1' => 700000,
			'krossi' => 600000,
			'fun-2' => 200000,
			'fun' => 400000
		];
		
		//if (!empty($items)) 
		foreach ($items as $id => $item) {
			$comment = 'Дублей: нет';
			foreach ($tables as $table) {
				//Поиск заказов по параметрам в БД 'STAT'
				//$double = [];
				$res = JBase::Query("SELECT `id`,`lvproject`,`lvid` FROM ". $table ." WHERE `phone` = '". $item['phone'] ."' LIMIT 1");
// 				$res = JBase::Query("SELECT `id`,`lvproject`,`lvid` FROM stat.list14 where `phone` = '". $item['phone'] ."' union all
// 					SELECT `id`,`lvproject`,`lvid` FROM stat.list15 where `phone` = '". $item['phone'] ."' union all
// 					SELECT `id`,`lvproject`,`lvid` FROM stat.list16 where `phone` = '". $item['phone'] ."' union all
// 					SELECT `id`,`lvproject`,`lvid` FROM stat.list17 where `phone` = '". $item['phone'] ."' union all
// 					SELECT `id`,`lvproject`,`lvid` FROM stat.list18 where `phone` = '". $item['phone'] ."' union all
// 					SELECT `id`,`lvproject`,`lvid` FROM stat.list19 where `phone` = '". $item['phone'] ."' union all
// 					SELECT `id`,`lvproject`,`lvid` FROM stat.list20 where `phone` = '". $item['phone'] ."' limit 1");
				
				if (!empty($res)) {
					while ($doubles = $res->fetch_assoc()) {
						$proj = $doubles['lvproject'];
						$idOriginal = (int)$doubles['lvid'];

						if ($proj == 'fun') $proj = (((int)$doubles['id'] - 400000) > 0) ? 'fun' : 'fun2';
						if ($proj == 'tel') $proj = (((int)$doubles['id'] - 720000) > 0) ? 'tel' : 'tel2';
						
						$comment = 	'Дубль: Заказ №'. $idOriginal .', проект '. $proj;
						
						JBase::Update_Data('list17', ['status' => '1', 'comment' => $comment], ['id' => $item['id']]);
						break;
					}
				} else {
					$comment = 'Дублей: нет';
					JBase::Update_Data('list17', ['comment' => $comment,'status' => '1'], ['id' => $item['id']]);
				}
			}			
			JBase::Update_Data('list17', ['comment' => $comment,'status' => '1'], ['id' => $item['id']]);
		}
	}
	
	function getSingleDoubleCrm() {
		$Result = JBase::Query("SELECT `id`,`phone` FROM `list17` WHERE `id` = ".$_POST['id']);
		if (!empty($Result)) {
			$item = $Result->fetch_assoc();
		}

		//доступы
		$tables = ['list14','list15','list16','list17','list18','list19','list20'];
		// $tables = ['list14'];
		$comment = 'Дублей: нет';
			foreach ($tables as $table) {
				$res = JBase::Query("SELECT * FROM ". $table ." WHERE `phone` = '". $item['phone'] ."' AND `id` != ".$_POST['id']." LIMIT 1");
				if (!empty($res)) {
					while ($doubles = $res->fetch_assoc()) {
						$status = JBase::Query("SELECT `name` FROM list8 WHERE `id` = ".$doubles['status']);
						$res_stat = $status->fetch_assoc();
						// $proj = $doubles['lvproject'];
						// $idOriginal = (int)$doubles['lvid'];

						// if ($proj == 'fun') $proj = (((int)$doubles['id'] - 400000) > 0) ? 'fun' : 'fun2';
						// if ($proj == 'tel') $proj = (((int)$doubles['id'] - 720000) > 0) ? 'tel' : 'tel2';
						
						// $comment = 	'Дубль: Заказ №'. $idOriginal .', проект '. $proj;
						$proj = $doubles['id'];
						$comment = 	'Дубль: Заказ №'. $proj . PHP_EOL .'Статус: '.$res_stat['name'].PHP_EOL.'Комент: '.$doubles['comment'];
						
						JBase::Update_Data('list17', ['status' => '1', 'dop6' => $comment], ['id' => $item['id']]);
						break;
					}
				} else {
					$comment = 'Дублей: нет';
					JBase::Update_Data('list17', ['dop6' => $comment], ['id' => $item['id']]);
				}
			}			
			JBase::Update_Data('list17', ['dop6' => $comment], ['id' => $item['id']]);
			return json_encode([$comment]);
			// return $comment;
	}

	function getSingleDoubleStat() {
		
		$Result = JBase::Query("SELECT `id`,`phone` FROM `list17` WHERE `id` = ".$_POST['id']);
		if (!empty($Result)) {
			$item = $Result->fetch_assoc();
		}
		
		//доступы
		$tables = ['stat.list14','stat.list15','stat.list16','stat.list17','stat.list18','stat.list19','stat.list20'];
		
		/*

			Статистика ID заказов по проектам 

		*/
		
		$ids = [
			'cpa-sale' => 800000,
			'topsale' => 750000,
			'tel-2' => 710000,
			'fb-2' => 900000,
			'tel' => 720000,
			'fb' => 850000,
				
			'cpa-crm2' => 920000,
			'cpa-crm' => 930000,
			'boris1' => 700000,
			'krossi' => 600000,
			'fun-2' => 200000,
			'fun' => 400000
		];
		
		//if (!empty($items)) 
			$comment = 'Дублей: нет';
			foreach ($tables as $table) {
				//Поиск заказов по параметрам в БД 'STAT'
				//$double = [];
				$res = JBase::Query("SELECT `id`,`lvproject`,`lvid`,`comment` FROM ". $table ." WHERE `phone` = '". $item['phone'] ."' LIMIT 1");
				//var_dump("SELECT `id`,`lvproject`,`lvid` FROM ". $table ." WHERE `phone` = '". $item['phone'] ."' LIMIT 1");
// 				$res = JBase::Query("SELECT `id`,`lvproject`,`lvid` FROM stat.list14 where `phone` = '". $item['phone'] ."' union all
// 					SELECT `id`,`lvproject`,`lvid` FROM stat.list15 where `phone` = '". $item['phone'] ."' union all
// 					SELECT `id`,`lvproject`,`lvid` FROM stat.list16 where `phone` = '". $item['phone'] ."' union all
// 					SELECT `id`,`lvproject`,`lvid` FROM stat.list17 where `phone` = '". $item['phone'] ."' union all
// 					SELECT `id`,`lvproject`,`lvid` FROM stat.list18 where `phone` = '". $item['phone'] ."' union all
// 					SELECT `id`,`lvproject`,`lvid` FROM stat.list19 where `phone` = '". $item['phone'] ."' union all
// 					SELECT `id`,`lvproject`,`lvid` FROM stat.list20 where `phone` = '". $item['phone'] ."' limit 1");
				
				if (!empty($res)) {
					while ($doubles = $res->fetch_assoc()) {
						$proj = $doubles['lvproject'];
						$idOriginal = (int)$doubles['lvid'];

						if ($proj == 'fun') $proj = (((int)$doubles['id'] - 400000) > 0) ? 'fun' : 'fun2';
						if ($proj == 'tel') $proj = (((int)$doubles['id'] - 720000) > 0) ? 'tel' : 'tel2';
						
						$comment = 	'Дубль: Заказ №'. $idOriginal .PHP_EOL.'Проект: '. $proj.PHP_EOL.'Комент: '.$doubles['comment'];
						
						JBase::Update_Data('list17', ['status' => '1', 'dop7' => $comment], ['id' => $item['id']]);
						break;
					}
				} else {
					$comment = 'Дублей: нет';
					JBase::Update_Data('list17', ['dop7' => $comment], ['id' => $item['id']]);
				}
			}			
			JBase::Update_Data('list17', ['dop7' => $comment], ['id' => $item['id']]);
			return json_encode([$comment]);
	}
	
	
	
	
	function getDoubleStat1v2() {
		
		$items = [];
		$Result = JBase::Query("SELECT `id`,`phone` FROM `list17` WHERE `status` = '0' ORDER BY `id` DESC LIMIT 10");
		if (!empty($Result)) {
			while ($item = $Result->fetch_assoc()) {
				$items[$item['id']] = $item;	
			}
		}
		return $items;
		
	}
	
	function getDoubleWrite() {
		
		$items = $_POST;
		if (!empty($items)) foreach ($items as $id => $comment) {
			JBase::Query("UPDATE `list17` SET `status` = '1', `comment` = '". $comment ."' WHERE `id` = '". (int)$id ."'");
		}
	}
	
	
	//getDouble
	function updateOrder($id, $status, $comment) {
		//status
		$params = [
			'status' => $status,
			'comment' => $comment
		];
		
		/*

			Вы можете отредактировать заказ отправив POST (Content-Type:	application/x-www-form-urlencoded) запрос на URL: 
			https://test991.leadvertex.ru/api/admin/updateOrder.html?token=api_key_here&id=10055 где в GET указываете ID заказа, а в POST следующие поля:

		*/
		
		//Поиск заказов по параметрам в leadvertex
		$Url = 'https://boris1.leadvertex.ru/api/admin/updateOrder.html?token=0dd4f3cfa6f5d5c25f6386b6a189494a&id='. $id; 			
 		$curl = curl_init();
 		curl_setopt($curl, CURLOPT_URL, $Url);
 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
 		$res = json_decode(curl_exec($curl), true);
     	curl_close($curl);
		
		return $res;
	}

	//liveinform - Черный список

	public static function getBlackStatuses($phone = null) {
		$date_now = time() - 15638400;
		$date_blacklist = 0;
		// if(isset($_GET['phone'])) $phone = $_GET['phone'];

		$api_id = '5sBrM9tE-P3HnxTBU-sm8NMlOO-86pM5flY';
		$liveinformUrl = 'https://www.liveinform.ru/api/v2/';
		
		$url = $liveinformUrl .'blacklist2?api_id='.$api_id.'&contact=["'.$phone.'"]';
		// $url = $url.'?api_id='.$api_id.'&contact=["'.$phone.'"]';

		$res = json_decode(file_get_contents($url.'?api_id='.$api_id.'&contact=["'.$phone.'"]'));
		$res = $res->data->$phone;

		//записываем
		if ($res->returns > 1) {
			foreach ($res->blacklist as $key => $value) {
				if(strtotime($value->date) > $date_blacklist) $date_blacklist = strtotime($value->date);
			}

			if($date_blacklist > $date_now) {
				return 'Черный список ('.Liveinform::getBlackStatuses($res->blacklist).')';
			}else{
				return 'Возвратов не найдено';
			}

		} else {
			return 'Возвратов не найдено';
		}
	}

	//liveinform - sendPost
	public static function sendPost($url) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, 1);
  		curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 5'); //эта строчка как-бы говорит: "я не скрипт, я IE5" :)
 		$posts = json_decode(curl_exec($curl), true);
     	curl_close($curl);
		return $posts;
	}

	//liveinform - Черный список старт из cron
	public static function robotLiveinform() {
		
		$phones = [];
		$Result = JBase::Get_Data('list17', ['id','phone'], ['liveinform' => '']);
		
		if (!empty($Result)) {
			while ($numrow = $Result->fetch_assoc()) {
				$phones[$numrow['id']] = $numrow['phone'];
			}
			
			foreach($phones as $key => $phone) {
				JBase::Update_Data('list17', ['liveinform' => self::getBlackStatuses($phone)], ['id' => (int)$key]);
			}
		}
	}

	function getPostTrack(){
		$post 									= (!empty($_POST)) ? $_POST : $_GET;
		$list									= (isset($post['list'])) ? $post['list'] :	NULL;
		$status									= (isset($post['status'])) ? $post['status'] :	NULL;
		$method									= (isset($post['method'])) ? $post['method'] :	NULL;
		if($method){

			if(!$list) return 'Missing passed parameter "List"';

			if($method === 'cheack'){
				$QQ = "SELECT * FROM list$list WHERE `pendingOrders` != ''";
			}else{
				if($status){
					$QQ = "SELECT * FROM list$list WHERE `russianpostTrack` != '' AND `status` = ".$status." AND `russianpostStatus` = ''";
				}else{
					$QQ = "SELECT * FROM list$list WHERE `russianpostTrack` != '' AND (`russianpostStatus` = '' OR `russianpostStatus` = 'Прибыло в место вручения')";
				}
			}
			// Debugging::telegram($QQ);
			$result = JBase::Query($QQ);
			$num_rows = mysqli_num_rows($result);
			$data = [];
			for ($i=0; $i < $num_rows; $i++) { 
				$bd = $result->fetch_assoc();
				$data[$i] = array(
					'id'				=> $bd['id'],
					'russianpostTrack' 	=> $bd['russianpostTrack']
				);
				// $data[$i] = $bd['russianpostTrack'];
			}
			return $data;

		}
	}

	function setPostTrack(){
		$post 									= (!empty($_POST)) ? $_POST : $_GET;
		$list									= (isset($post['list'])) ? $post['list'] :	NULL;
		$status									= (isset($post['status'])) ? $post['status'] :	NULL;
		$russianpostTrack						= (isset($post['russianpostTrack'])) ? $post['russianpostTrack'] :	NULL;
		$comment								= (isset($post['comment'])) ? $post['comment'] : '';

		if(!$list) return 'Missing passed parameter "List"';
		if(!$status) return 'Missing passed parameter "status"';
		if(!$russianpostTrack) return 'Missing passed parameter "russianpostTrack"';
		
		if(empty($comment)){
			$QQ = "UPDATE list$list SET `pendingOrders` = '' WHERE `status` = '$status' AND `russianpostTrack` = '$russianpostTrack'";
		}else{
			$QQ = "UPDATE list$list SET `pendingOrders` = '$comment' WHERE `status` = '$status' AND `russianpostTrack` = '$russianpostTrack'";
		}
		// return $QQ;
		$res = JBase::Query($QQ);
		return $res;
	}

	/*
    	
    https://1v1-crm.ru/json/?func=api&action=changeStatusPostTrack
    */
	function changeStatusPostTrack(){
		$post 									= (!empty($_POST)) ? $_POST : $_GET;
		$list									= $post['list'];
		$id 									= $post['id'];
		$ids									= [$id];
		$tostatus								= $post['tostatus'];
		$comment								= $post['comment'];
		$date 									= time();

		if($tostatus == 9){
			JBase::statusChange((int)$list, $ids, (int)$tostatus);
			JBase::Query("UPDATE list15 SET `refundedAt` = '$date', `russianpostStatus` = '$comment' WHERE `id` = '$id'");
		}elseif($tostatus == 7){
			JBase::statusChange((int)$list, $ids, (int)$tostatus);
			JBase::Query("UPDATE list20 SET `buyoutAt` = '$date', `russianpostStatus` = '$comment' WHERE `id` = '$id'");
		}elseif($tostatus == 11){
			JBase::Update_Data('list'.$list,['status'=>'11','russianpostStatus'=>$comment],['id'=>$id]);
		}
		return "OK=>".$id.' comment = '.$comment.PHP_EOL;
	}

	function csvToArray(){
		if (($handle = fopen("product.csv", "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				for ($c=0; $c < $num; $c++) {
					if($data[$c] === 'crm_product' || $data[$c] === 'leadvertex_product') continue;
					if($c == 0){
						$crm_id = $data[$c];
					}elseif($c == 1){
						$leadvertex_id = $data[$c];
					}
				}
				if(!empty($crm_id) && !empty($leadvertex_id)){
					JBase::Query("INSERT INTO `list51` (`crm_product`, `leadvertex_product`, `project`) VALUES ('$crm_id', '$leadvertex_id', 'test-tel')");
				}
			}
			fclose($handle);
		}
	}
	function changePostTrackCSV(){
		$delimiter = ',';

		$csv = file_get_contents('4.csv');
		$rows = explode(PHP_EOL, $csv);
		$data = [];
		$data2 = [];
		$buf = null;
		$cnt = 0;

		foreach ($rows as $row)
		{
			$data[] = explode($delimiter, (int)$row);
		}
		$cnt = 1;
		for ($i=0; $i < count($data); $i++) {
			$russianpostTrack = $data[$i][0];
			if($russianpostTrack != '0'){
				// $data2[$cnt] = $russianpostTrack;
			
			$con = JBase::Query("SELECT * FROM `list18` WHERE `russianpostTrack` = '$russianpostTrack'");
				while ($v = $con->fetch_assoc()){
					$v['status'] = 47;
					$fields 								= array_filter($v);
					$Keys									= array_keys($v);
					$Values									= array_values($v);
					$vk = implode("`,`", $Keys);
					$vv = implode("','", $Values);
					// $QQ = "INSERT INTO `list19` (`$vk`) VALUES ('$vv')";
					// $QQ = "DELETE FROM `list18` WHERE `russianpostTrack` = '$russianpostTrack'";
					$data2[$cnt] = JBase::Query($QQ);
				}
				$cnt++;
			}
		}
		return $data2;
	}

	/*
		* Восстановление заказа из EXCEL файла 
		? https://1v1-crm.ru/json/?func=api&action=changeStatusPostTrack
	*/
	function restoreOrdersFromExcel(){
		$delimiter 	= ';';

		$filter = array(
			'1364307' => 136430,
			'1364609' => 136460,
			'1364926' => 136492,
			'1364951' => 136495,
			'1368123' => 136812,
			'1368204' => 136820,
			'1368212' => 136821,
			'1368213' => 136821,
			'1368438' => 136843,
			'1339849' => 133984,
			'1292497' => 129249,
			'1294616' => 129461,
			'1296493' => 129649,
			'1302954' => 130295,
			'1304537' => 130453,
			'1329251' => 132925,
			'1331533' => 133153,
			'1331922' => 133192,
			'1335326' => 133532,
			'1335936' => 133593,
			'1336558' => 133655,
			'1343184' => 134318,
			'1344896' => 134489,
			'1354624' => 135462,
			'1359033' => 135903,
			'1362201' => 136220,
			'1362400' => 136240,
			'1363397' => 136339,
			'1363486' => 136348
		);
		$csv 		= file_get_contents('11.csv');
		$rows 		= explode("\r\n", $csv);
		$data 		= [];
		$data2 		= [];
		$cnt 		= 1;
		$test = '';
		$list = 20;

		foreach ($rows as $row){	
			list($track,$dateSh,$dateBy,$id,$phone,$total,$postIndex,$region,$name) = explode($delimiter, $row);
			$id = (int)$id;
			if($id != ''){
				if(!isset($filter[$id])){
					$good_names 							= self::goodsToArray(97104, 'cpa');
					$total 									= self::goodsToArray(97104, 'total');
					$test .= $id.',';
					$data = [
						'id'								=> $id,
						'domain' 							=> DOMAIN, 																						//(varchar) домен проекта
						'id_user' 							=> 0, 																							//(int) Id юзера
						'premium' 							=> 0,			  																				//(int) Premium
						'status' 							=> 69, 																							//(int) Статус 
						'page' 								=> 0,  																							//(int) Раздел или страница, с которой отправлен заказ
						'total'								=> $total,																						//(int) Общая сумма
						'goods_names' 						=> $good_names,  																				//(text) товары
						'time' 								=> time(), 																						//(int) Дата подачи 
						'lastUpdate' 						=> time(), 																						//(int) Дата изменения статуса
						'timeupdate' 						=> time(),	  																					//(int) Дата последнего изменения
						'phone' 							=> $phone,																						//(int) phone
						// 'ip'								=> $ip,	  																						//(varchar) ip клинента																			
						'name' 								=> $name,													//(varchar) ФИО
						// 'webmasterId' 						=> (isset($post['webmasterId'])) ? $post['webmasterId'] : '',  									//(int) External Webmaster
						// 'domain2'							=> (isset($post['domain2'])) ? $post['domain2'] : 'Пусто',
						// 'externalId'						=> (isset($post['externalId'])) ? $post['externalId'] : '',
						// 'externalWebmaster'					=> (isset($post['externalWebmaster'])) ? $post['externalWebmaster'] : '',
						// 'timezone'							=> $timezone,
						// 'weight'							=> $weight
						'russianpostTrack'					=> $track,
						'shippedAt'							=> $dateSh,
						'buyoutAt'							=> $dateBy,
						'postIndex'							=> $postIndex,
						'region'							=> $region
					];

					$fields 									= array_filter($data);
					$Keys										= array_keys($fields);
					$Values										= array_values($fields);

					// JBase::Set_Data('list'. $list, $Keys, $Values);
				}
			}
		}

		return $id;
	}

	// TODO ---------------------------------------- Временные функции , которые нужно будет подчистить ----------------------------------------

	function postApi() {
		$buf = JBase::Get_Data('list50','*',['id'=>'1']);
    	$buf = $buf->fetch_assoc();
    	$user_id = $buf['userId'];
    	$api_key = $buf['key'];
		$con = JBase::Query("SELECT * FROM `list19` WHERE `id` = '1365272'");
		$result = $con->fetch_assoc();
		$tracks = $result['russianpostTrack'];
		$trackingData[] = array(
            "trackingUserClientPhone"=>strval($result['phone']),
                "trackingUserClientTrack"=>strval($result['russianpostTrack']),
                "trackingUserClientEmail"=>strval($result['email']),
                "trackingUserClientName"=>strval($result['name']),
                "trackingUserClientItemCost"=>(int)$result['total'],
                "sendToUserEmailFullTracking"=>(bool)false,
                "sendToAdminEmailFullTracking"=>(bool)false,
                "trackingUserClientOrderNumber"=>strval($result['id']),
                "trackingUserClientDescription"=>"",
                "trackingUserPaymentType"=>(int)1,
                'trackingUserClientDeliveryServiceId'=>0,
                'testMode'=>false
		);
		$requestKey = md5($user_id . ':' . $tracks . ':' . $api_key);
    	$params = array(
        	"trackingUserId"=>$user_id,
        	"trackingRequestKey"=>$requestKey,
        	"testMode"=>false,
        	"trackingData"=>$trackingData
		);
		$posts = self::sendRequest($params);
    	$r = json_decode($posts, true);
		return $r;
	}

	function sendRequest($params){
		$url									= "http://apilr2.r-lab.biz/addtrack.ashx";
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			"Content-Type: text/plain; charset=utf-8",
		));
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params, JSON_UNESCAPED_UNICODE));
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}

	function changeTrackLiveinform() {
		$data = [];
		$cnt = 1;
		$id = [1338434,1338755,1338763,1338776,1338823,1339021,1339029,1339131,1339159,1339232,1339463,1339534,1339677,1339721,1339738,1339782,1339829,1339840,1339849,1339916,1340069,1340108,1340177,1340227,1340230,1340422,1340425,1340462,1340523,1340546,1340552,1340690,1340892,1340973,1340975,1341035,1341059,1341088,1341135,1341136,1341139,1341156,1341197,1341248,1341262,1341283,1341396,1341479,1341585,1341670,1341751,1341766,1341790,1341820,1341840,1341848,1341917,1341950,1342021,1342036,1342096,1342153,1342214,1342233,1342250,1342343,1342490,1342494,1342505,1342523,1342553,1342617,1342630,1342648,1342649,1342654,1342669,1342675,1342680,1342708,1342726,1342739,1342790,1342805,1342812,1342843,1342900,1342964,1342967,1343033,1343037,1343136,1343158,1343162,1343237,1343238,1343242,1343352,1343395,1343420,1343438,1343498,1343526,1343601,1343638,1343703,1343722,1343775,1343782,1343866,1343868,1343903,1343904,1343915,1343934,1343969,1344009,1344030,1344039,1344051,1344074,1344129,1344137,1344138,1344167,1344191,1344239,1344365,1344379,1344394,1344445,1344452,1344457,1344488,1344507,1344670,1344692,1344695,1344720,1344763,1344773,1344774,1344817,1344822,1344838,1344849,1344864,1344937,1345180,1345225,1345288,1345379,1345391,1345414,1345423,1345431,1345668,1345856,1345881,1345894,1345922,1345949,1345988,1348248,1349559,1349676,1350249,1351238,1351251,1351598,1351992,1352083,1352110,1352377,1353139,1353195,1353236,1353297,1353594,1353931,1354070,1354200,1354602,1354693,1354764,1354810,1354931,1354988,1355092,1355106,1355844,1355984,1356132,1356270,1356285,1356298,1356535,1356719,1356739,1356745,1356747,1356919,1356920,1356929,1356950,1356959,1356981,1357010,1357038,1357079,1357091,1357108,1357163,1357269,1357298,1357317,1357320,1357361,1357370,1357471,1357483,1357520,1357609,1357624,1357634,1357639,1357674,1357715,1357730,1357735,1357778,1357807,1357867,1357941,1357985,1358051,1358055,1358064,1358102,1358155,1358189,1358191,1358207,1358214,1358288,1358299,1358317,1358331,1358361,1358376,1358439,1358442,1358459,1358489,1358493,1358511,1358519,1358531,1358541,1358557,1358573,1358596,1358638,1358657,1358709,1358731,1358752,1358790,1358825,1358845,1358854,1358855,1358856,1358859,1358870,1358905,1358906,1358966,1358995,1359002,1359015,1359054,1359057,1359059,1359073,1359165,1359197,1359199,1359234,1359262,1359267,1359273,1359275,1359301,1359305,1359326,1359335,1359344,1359357,1359376,1359386,1359429,1359432,1359457,1359496,1359505,1359574,1359603,1359610,1359640,1359690,1359694,1359731,1359782,1359844,1359852,1359857,1359929,1359959,1359965,1359970,1360035,1360056,1360149,1360154,1360166,1360172,1360184,1360227,1360232,1360284,1360340,1360351,1360487,1360494,1360504,1360515,1360519,1360520,1360549,1360556,1360585,1360613,1360615,1360641,1360662,1360684,1360702,1360723,1360732,1360744,1360749,1360766,1360778,1360786,1360796,1360816,1360817,1360831,1360845,1360846,1360848,1360900,1360907,1360913,1360937,1360958,1361064,1361136,1361175,1361186,1361244,1361280,1361292,1361293,1361333,1361348,1361363,1361373,1361380,1361388,1361391,1361398,1361409,1361420,1361431,1361445,1361451,1361452,1361457,1361509,1361517,1361558,1361580,1361585,1361690,1361693,1361742,1361763,1361861,1361909,1361926,1362008,1362012,1362029,1362084,1362104,1362154,1362156,1362185,1362188,1362192,1362193,1362194,1362197,1362222,1362224,1362246,1362263,1362304,1362305,1362313,1362343,1362378,1362389,1362399,1362400,1362408,1362412,1362431,1362492,1362501,1362513,1362525,1362537,1362539,1339013,1339057,1339449,1339715,1339731,1339767,1339810,1339923,1340038,1340053,1340099,1340374,1340534,1340579,1340586,1340707,1340999,1341465,1341572,1341583,1341613,1341629,1341663,1341754,1341828,1341973,1342084,1342138,1342162,1342220,1342259,1342652,1343023,1343054,1343185,1343306,1343636,1343704,1343742,1343773,1343791,1343799,1343863,1343883,1343896,1344034,1344085,1344088,1344142,1344252,1344265,1344465,1344529,1344566,1344586,1344614,1344653,1344674,1344679,1344706,1344764,1344831,1344879,1345030,1345078,1345862,1347531,1349462,1350630,1350852,1351096,1351193,1351628,1352310,1352785,1353022,1353907,1354170,1354517,1356854,1356989,1357041,1357076,1357100,1357432,1357484,1357512,1357627,1357664,1357691,1357955,1357988,1358125,1358197,1358282,1358293,1358406,1358431,1358535,1358718,1358756,1358833,1358922,1358991,1359016,1359031,1359099,1359112,1359160,1359229,1359588,1359628,1359657,1359764,1359831,1359858,1360129,1360220,1360310,1360432,1360467,1360495,1360503,1360507,1360555,1360634,1360672,1360673,1360743,1360890,1361037,1361085,1361093,1361259,1361433,1361441,1361475,1361513,1361533,1361564,1361577,1361592,1361610,1361615,1361626,1361654,1361655,1361660,1361700,1361724,1361818,1361822,1361826,1361964,1362100,1362145,1362152,1362162,1362184,1362196,1362262,1362317,1362471,1362484,1362551,1362584,1362612,1362630,1362651,1362660,1362668,1362677,1362698,1362708,1362712,1362714,1362720,1362723,1362727,1362730,1362733,1362740,1362744,1362761,1362771,1362786,1362794,1362796,1362824,1362831,1362832,1362835,1362841,1362869,1362890,1362891,1362903,1362914,1362915,1362939,1362944,1362958,1362965,1362966,1362985,1362996,1363007,1363010,1363011,1363018,1363020,1363026,1363031,1363033,1363050,1363077,1363092,1363097,1363110,1363124,1363126,1363165,1363167,1363170,1363181,1363190,1363191,1363194,1363204,1363229,1363230,1363242,1363268,1363294,1363301,1363321,1363327,1363339,1363342,1363346,1363353,1363384,1363392,1363422,1363450,1363489,1363498,1363517,1363526,1363540,
		1363546,1363578,1363584,1363585,1363622,1363627,1363636,1363647,1363670,1363680,1363687,1363705,1363765,1363767,1363793,1363800,1363804,1363816,1363825,1363826,1363829,1363848,1363859,1363867,1363880,1363909,1363912,1363923,1363976,1363978,1363981,1363984,1363990,1363997,1363999,1364009,1364011,1364039,1364043,1364062,1364085,1364087,1364090,1364120,1364129,1364139,1364146,1364150,1364154,1364182,1364188,1364206,1364232,1364239,1364243,1364261,1364276,1364279,1364309,1364312,1364333,1364348,1364349,1364359,1364361,1364400,1364403,1364405,1364406,1364423,1364446,1364451,1364457,1364463,1364464,1364465,1364476,1364499,1364504,1364550,1364603,1364615,1364627,1364637,1364638,1364645,1364660,1364679,1364705,1364771,1364778,1364782,1364803,1364806,1364822,1364824,1364840,1364845,1364869,1364876,1364902,1364926,1364936,1364960,1364968,1364980,1365014,1365042,1365056,1365082,1365092,1365108,1365111,1365121,1365136,1365150,1365174,1365175,1365184,1365189,1365218,1365231,1365239,1365246,1365255,1365264,1365276,1365304,1365311,1365319,1365334,1365336,1365341,1365347,1365353,1365367,1365369,1365370,1365375,1365388,1365426,1365431,1365483,1365484,1365494,1365535,1365537,1365543,1365576,1365586,1365590,1365600,1365608,1365617,1365670,1365694,1365732,1365743,1365744,1365786,1365789,1365799,1365815,1365840,1365883,1338342,1338506,1338910,1339217,1339735,1339737,1339741,1339747,1339912,1339981,1339998,1340244,1340325,1340347,1340442,1340448,1340487,1340588,1340599,1340611,1340648,1340661,1340668,1340671,1340715,1340751,1340794,1341308,1341367,1341532,1341661,1341822,1341849,1341882,1341960,1341982,1342053,1342066,1342080,1342174,1342191,1342193,1342218,1342222,1342350,1342357,1342391,1342403,1342408,1342460,1342581,1342635,1342756,1342836,1342857,1342913,1342923,1342941,1342963,1343106,1343335,1343379,1343427,1343450,1343455,1343478,1343479,1343548,1343563,1343571,1343597,1343605,1343619,1343649,1343659,1343662,1343713,1343716,1343727,1343867,1343984,1343987,1344004,1344011,1344025,1344107,1344160,1344210,1344219,1344294,1344311,1344328,1344381,1344553,1344581,1344662,1344744,1344809,1344811,1344893,1344933,1344938,1345151,1345152,1345220,1345239,1345259,1345459,1345887,1345951,1349572,1349947,1350312,1352211,1353507,1353747,1354136,1355284,1355371,1356013,1356145,1356644,1356652,1356659,1356671,1356674,1356717,1356808,1356883,1356931,1357083,1357119,1357203,1357207,1357290,1357575,1357659,1357684,1357755,1357803,1357827,1357852,1357871,1358017,1358048,1358076,1358080,1358087,1358096,1358119,1358158,1358215,1358246,1358298,1358316,1358374,1358413,1358463,1358466,1358477,1358538,1358540,1358548,1358587,1358593,1358602,1358608,1358648,1358666,1358683,1358700,1358766,1358768,1358828,1358866,1358880,1358921,1358942,1358945,1358949,1358967,1359006,1359021,1359032,1359046,1359047,1359060,1359085,1359105,1359173,1359184,1359237,1359238,1359314,1359336,1359409,1359424,1359473,1359506,1359543,1359567,1359656,1359696,1359697,1359738,1359750,1359778,1359856,1359893,1359919,1359978,1359992,1360005,1360082,1360110,1360193,1360256,1360266,1360269,1360278,1360280,1360297,1360318,1360370,1360379,1360422,1360460,1360491,1360535,1360537,1360686,1360703,1360722,1360746,1360765,1360820,1360837,1360839,1360841,1360849,1360853,1360864,1360885,1360905,1360951,1360972,1360981,1361036,1361039,1361047,1361055,1361056,1361057,1361070,1361086,1361101,1361107,1361116,1361135,1361138,1361149,1361150,1361190,1361209,1361245,1361254,1361257,1361302,1361336,1361346,1361371,1361379,1361419,1361421,1361428,1361453,1361459,1361489,1361550,1361554,1361588,1361589,1361623,1361634,1361637,1361638,1361675,1361701,1361736,1361738,1361777,1361794,1361838,1361845,1361895,1361935,1361947,1361963,1362003,1362004,1362005,1362006,1362009,1362010,1362011,1362013,1362014,1362016,1362043,1362044,1362144,1362195,1362211,1362290,1362358,1362528,1362737,1362741,1362746,1362776,1362790,1363044,1363088,1363101,1363107,1363139,1363140,1363150,1363157,1363202,1363238,1363349,1363397,1363402,1363408,1363453,1363499,1363534,1363541,1363579,1363638,1363643,1363669,1363675,1363695,1363886,1363892,1363895,1363896,1363897,1363900,1363902,1363903,1363916,1363974,1363985,1364047,1364248,1364355,1364493,1364512,1364518,1364553,1364595,1364614,1364643,1364655,1364663,1364683,1364728,1364768,1364769,1364791,1364816,1364819,1364858,1364872,1364894,1364940,1364942,1364952,1364972,1365038,1365083,1365102,1365114,1365123,1365130,1365133,1365139,1365228,1365251,1365309,1365322,1365348,
		1365352,1365376,1365391,1365400,1365403,1365434,1365439,1365487,1365538,1365737,1365751,1365760,1365764,1365792,1365804,1365809,1365823,1365831,1365874];
		foreach ($id as $ids) {
			$con = JBase::Query("SELECT * FROM list19 WHERE `id` = '$ids'");
			$res = $con->fetch_assoc();
			$liveinformId = $res['liveinformId'];
			$track = $res['russianpostTrack'];
			$url = "https://www.liveinform.ru/api/v2/edit/?api_id=5sBrM9tE-P3HnxTBU-sm8NMlOO-86pM5flY&liveinform_id={$liveinformId}&tracking={$track}";
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			$body = curl_exec($curl);
			curl_close($curl);
			$data[$cnt] = $body;
			$cnt++;
		}
		return $data;
	}
	
}



