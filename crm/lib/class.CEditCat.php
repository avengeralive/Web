<?php 
namespace lib;

/**
* class.CEditCat.php
*
*Класс - библиотека с функциями для работы модуля Каталог
*подгружается через автоподгрузку классов
*
*
**/

class CEditCat {

    //добавление объявления
    function add1() {
	   if (!isset($_POST['token']) && $_POST['token'] != TOKEN) return false; //стандартная проверка
	   $list_id = (int)($_POST['list_id']);

	   if (isset($_POST['field']['currentSms']) && $_POST['field']['currentSms'] != '') {
			$sms = json_decode($_POST['field']['currentSms'], true);
			if(isset($sms['smsText'])){
				SMS::sendSingle($list_id, $_POST['item_id'], $sms['smsText']);
			}else {
				SMS::sendSingle($list_id, $_POST['item_id'], '');
			}
		}

	   if ($list_id > 0 && in_array($list_id, [14,15,16,17,18,19,20])) return self::addSale();
	   
	   $userType = (int)userType(CUser::user(TOKEN));
	   $user = (int)USERID;
	   $domain = DOMAIN;
	   
	   $Names  = [];
	   $Values = [];
	   if ($list_id == 11) $fieldArray = $_POST['field'];
	   else $fieldArray = array_filter($_POST['field']); //фильтруем 

	   //проверка, существует ли запись
	   $item_id = ((int)$_POST['item_id'] > 0) ? (int)$_POST['item_id'] : 0;
	   
	   //перебор входного массива
	   foreach ($fieldArray as $key => $value) {
			//дополняем данными перед попаданием в базу
			switch ($key) {
				case 'price':
					$value = (!empty($value)) ? preg_replace('/\s+/', '', $value) : 0; //удаляем пробелы в цене
				break;
			}

			array_push($Names, $key);
			array_push($Values, $value);
		}
		if ($list_id == 11) $result = array_combine($Names, $Values);
		else $result = array_filter(array_combine($Names, $Values));
		//var_dump($result); exit();
		if ($item_id == '0') {
			$Names2 = array_merge($Names, ['id_user','time','status','domain']);
			$Values2 = array_merge($Values, [$user, time(), '1', $domain]);
			$Value45s2 = JBase::Set_Data('list'. $list_id, $Names2, $Values2);
			$id = JBase::$SqlID;
	   } else {
	   	$result['timeupdate'] = time();
			$id = $item_id;
	   	JBase::Update_Data('list'. $list_id, $result, ['id' => $id]);
	   }

	   if ($list_id == 1) CronRobot::generateParts($id); //генерация шаблона для прозвона
	   return $id;			
    }
    //добавление объявления
    function addSale() {
	   if (!isset($_POST['token']) && $_POST['token'] != TOKEN) return false; //стандартная проверка
	   if (!isset($_POST['item_id']) || (int)$_POST['item_id'] == 0) return false; //запрещаем добавление
	   
	   $userType 	= (int)userType(CUser::user(TOKEN));
	   $item_id 	= (int)($_POST['item_id']);
	   $list_id 	= (int)($_POST['list_id']);
	   //$user 		= USERID;
	   $domain 		= DOMAIN;
	   $Names  		= [];
	   $Values 		= [];
	   //unset($fieldArray['user']);
	   //unset($fieldArray['operator']);
	   
	   $fieldArray = array_filter($_POST['field']); 
		$status0 	= (isset($fieldArray['status'])) ? (int)$fieldArray['status'] : 1;
		
	   //проверка, существует ли запись
	   $data = self::checkWrite($list_id, $item_id);
   	//return $data;
	   $status = $data['status'];
	   $new_list_id = JBase::Get_Field_Value_From_Id('list8', $status, 'statusgroup');
	   
	   //если сменили статус
	   if ($status && $status != $status0) {	
			JBase::statusChange($list_id, $item_id, $new_list_id, $status0);
			$list_id = $new_list_id;
	   } else {
	   	//
	   }
	   
	   //перебор входного массива
	   foreach ($fieldArray as $key => $value) {
			//дополняем данными перед попаданием в базу
			switch ($key) {
 				case 'price'://удаляем пробелы в цене
 					$value = preg_replace('/\s+/', '', $value);
 				break;
 				case 'lastSms'://Отправить SMS (отправится при сохранении)
 					$value = ((int)$value == $value) ? $value : json_decode($value, true)['smsTime'].': '.json_decode($value, true)['smsText'];
 				break;
 				case 'hoursToChange'://время смены статуса
 				break;
//  				case 'user':
//  					$key = 'id_user';
//  					$value = $user;
//  				break;
//  				case 'operator':
//  					$value = $user;
//  				break;
 				case 'robot':
 					//if ($item_id == '0') //CronRobot::generateParts($id); //генерация шаблона для прозвона
 				break;
 			}	
		  
			array_push($Names, $key);
			array_push($Values, $value);
		}
		$NamesValues = array_combine($Names, $Values);
		
		//лог изменений
		$logOperation = [];
		foreach ($NamesValues as $key => $value) {
			if ($data[$key] != $value) {
				$logOperation[$key] = [
					'time' => (string)time(),
					'id' => (string)$item_id,
					'user' => (string)USERID,
					'lvproject' => (string)$data['lvproject'],
					'new' => (array)$value,
					'old' => (array)$data[$key],
					'timeedit' => (string)(time() - (time() - (int)$data['timeupdate'])),
					'field' => (string)$key
				];
			}
		}
   	if (!empty($logOperation)) //лог изменений
   		JBase::Set_Data('change_card', ['domain', 'item_id', 'time', 'detail'], [DOMAIN, $item_id, time(), json_encode(array_filter($logOperation), JSON_UNESCAPED_UNICODE)]); 
   	// if ( userType(CUser::user(TOKEN)) == "2" ||  userType(CUser::user(TOKEN)) == "3" ) $NamesValues['operator'] = USERID;
   	// if ( userType(CUser::user(TOKEN)) == "2" ||  userType(CUser::user(TOKEN)) == "3" ) $NamesValues['id_user'] = USERID;
   	$NamesValues['lastUpdate'] = time();
	   $NamesValues['timeupdate'] = time();
	   	if(isset($NamesValues['status'])){
			if($NamesValues['status'] == 2){
				if ( userType(CUser::user(TOKEN)) == "2" ||  userType(CUser::user(TOKEN)) == "3" ) $NamesValues['operator'] = USERID;
				$NamesValues['id_user'] = 0;
			}else{
				if ( userType(CUser::user(TOKEN)) == "2" ||  userType(CUser::user(TOKEN)) == "3" ) $NamesValues['operator'] = USERID;
   				if ( userType(CUser::user(TOKEN)) == "2" ||  userType(CUser::user(TOKEN)) == "3" ) $NamesValues['id_user'] = USERID;
			}
	   	}else{
			if ( userType(CUser::user(TOKEN)) == "2" ||  userType(CUser::user(TOKEN)) == "3" ) $NamesValues['operator'] = USERID;
			if ( userType(CUser::user(TOKEN)) == "2" ||  userType(CUser::user(TOKEN)) == "3" ) $NamesValues['id_user'] = USERID;
		   }
   	//сохраняем изменения
   	JBase::Update_Data('list'. $list_id, $NamesValues, ['id' => $item_id]); 
   	//JBase::Get_All_Count(); //пересчет количества по статусам
	   
	   return $item_id;			
    }
    
	//проверка, существует ли запись
	function checkWrite($list_id, $item_id) {
	   $rows = [];
   	if (in_array($list_id, [14,15,16,17,18,19,20])) {
  			foreach ([14,15,16,17,18,19,20] as $list) {
  				$Result = JBase::Query("SELECT * FROM `list". $list ."` WHERE `id` = '". $item_id ."'");
    			if ($Result) {
					while ($row = $Result->fetch_assoc()) {
						$rows = $row;
					}
    			}
    		}
	   }
	   $Result->free();
		return $rows;
	}

	//
	function newOrder() {
		$res=[];
					$Result = JBase::Query("SELECT operator_opencard  FROM operators");
					if($Result) while ($row = mysqli_fetch_array($Result)) {
							$open_cards = explode("||",$row[0]);
					}
// 					$open_cards = explode("\n",$Result);
					if ((isset($_POST['open_card'])) && (isset($_POST['open_card_user']))) {
						$open_card = $_POST['open_card'];
						$open_card_user = $_POST['open_card_user'];
							if ($open_card != '') {
							if( !in_array($open_card_user."_".$open_card ,$open_cards ) )
								{
    							for ($i = 0; $i < count($open_cards);$i++){
											if(stristr($open_cards[$i], '_', true) == $open_card_user ){
												array_splice($open_cards, $i, 1);
										}
								}
								if($open_cards[0] == "") $open_cards[0] = $open_card_user."_".$open_card;
								else array_push($open_cards,$open_card_user."_".$open_card);

								if (count($open_cards) > 1){
									$text =  implode("||",$open_cards);
								}
								else{
									$text = $open_cards[0];
								}
									$Result = JBase::Query("UPDATE operators SET operator_opencard='".$text."'");
								}
							}
							else{
								for ($i = 0; $i < count($open_cards);$i++){
// 										
											if(stristr($open_cards[$i], '_', true) == $open_card_user ){
												array_splice($open_cards, $i, 1);
											}
									}
								if (count($open_cards) > 1){
									$text =  implode("||",$open_cards);
								}
								else{
									$text = $open_cards[0];
								}
									$Result = JBase::Query("UPDATE operators SET operator_opencard='".$text."'");
							}
							$res['cards']=$open_cards;
					}
				// 	$open_cards_res = [];
// 					
// 					$res['open_cards'] = $open_cards_res;
					
			
		
		
		if (isset($_POST['ex_count'])) {
			$Result = JBase::Query("SELECT count(id) ex_count  FROM list17  WHERE status = 1");
			
			$count = 0;
			if($Result) while ($row = mysqli_fetch_array($Result)) {
				$count = (int)$row['ex_count'];
			}
			//JBase::Get_All_Count();
			
			$res['count'] = (int)$count;
			
			return $res;
		}
		
	}
   
   //addInExcel
	function addInExcel() {
		
		$user = (int)USERID;
	  	$domain = DOMAIN;
		$data =  $_POST['data'];
		$list = $_POST['list_id']; //номер статуса
		$select = $_POST['select_value'];
		
		$valid = array('approvedAt','shippedAt','canceledAt','buyoutAt','refundedAt','lastUpdate','timeupdate');
		$goods = array('goods_names');
		
		//$select = {"ID":"1","name":"19","status":"2","price":"10","agree_personal":"-1","agree_terms":"-1","category":"-1","goods_names":"20","domain2":"74","approvedAt":"69","shippedAt":"70","canceledAt":"71","buyoutAt":"72","refundedAt":"73","comment":"22","log_robot":"-1","all":"11","time_call":"-1","attempts":"-1","group_time_call":"-1","russianpostTrack":"49","russianpostStatus":"50","count":"23","postIndex":"13","region":"14","city":"15","address":"16","house":"17","flat":"18","phone":"20","lastSms":"66","smsStatus":"-1","lastVoiceSms":"67","lastVoiceStatus":"68","liveinformId":"-1","size":"-1","completely":"-1","weight":"-1","tag":"-1","source":"-1","ip":"77","referrer":"78","expend":"-1","externalId":"84","webmasterId":"85","dop1":"24","dop2":"25","dop3":"26","dop4":"27","dop5":"28","dop6":"29","dop7":"30","dop8":"31","dop9":"32","dop10":"34","timezone":"9","allBuyPrice":"65","developerPrice":"76","utm_source":"79","utm_medium":"80","utm_campaign":"81","utm_term":"82","utm_content":"83","total":"-1","email":"21","operator":"4","sms_template":"-1","f1562399916n":"-1"};
		$select = array_diff($select, array('-1')); //удаляем неактивные
		$fl_select = array_flip($select);
		//$data = array_intersect_key($data,$fl_select);	
		
		foreach ($data as $i => $value) {
			$data[$i] = array_intersect_key($data[$i], $fl_select);
		}
		
		$arr = [];
		$names = [];
		$values = [];
		$val_list = [];
		$val_list[0] = [];
		
		foreach ($select as $aS => $value1) {
			array_push($names, $aS);
		}
		//return $list;
		if (is_numeric ($list)) {
			$Names2 = array_merge($names, ['id_user','time','domain']);
			$Name = "(`" .implode("`,`", $Names2)."`)";
			//var_dump($data);
			$upd_data = [];
			foreach ($data as $i => $value) {
				$upd_it = [];
				$data[$i] = array_intersect_key($data[$i], $fl_select);
				$res = JBase::Query("SELECT `statusgroup`, `id` FROM `list8` WHERE `id` = '". $data[$i][intval($list)] ."'");

				if (!$res) return 'error with status';
				
				while ($row = mysqli_fetch_array($res)) {
					$listf = $row['statusgroup'];
					$list_id = $row['id'];
				}
				$data[$i][intval($list)] = $list_id;
			
				foreach ($select as $aS => $value1) {
					//если даты
					if (in_array($aS, $valid)) {
						$data[$i][$value1] = strtotime($data[$i][$value1]);
					}
					//если домен
					if (in_array($aS, ['domain'])) {
						$data[$i][$value1] = DOMAIN;
					}
					//если домен
					if (in_array($aS, ['price'])) {
						$data[$i][$value1] = substr(preg_replace( '/\..*|[^0-9]/', '',  $data[$i][$value1]), -10);
					}
					//если id
					if (in_array($aS, ['ID'])) {
						$data[$i][$value1] = /*200000 + */ (int)$data[$i][$value1];
					}
					//если товары
					if (in_array($aS, $goods)) {

						if (is_numeric ($data[$i][$value1])) {
							$res = JBase::Query("SELECT id, name, alias, price, priceAll FROM `list22` WHERE `id` IN(". $data[$i][$value1] .", 33324)");
							$goodarr = [];
							while ($row = mysqli_fetch_array($res)) {
								$goodarr_it = [];
								$goodarr_it['goodID'] = $row['id'];
								$goodarr_it['id'] = $row['id'];
								$goodarr_it['name'] = $row['name'];
								$goodarr_it['alias'] = $row['alias'];
								$goodarr_it['price'] = $row['price'];
								$goodarr_it['priceAll'] = $row['priceAll'];
								$goodarr_it['quantity'] = 1;
								$goodarr[$row['id']] = $goodarr_it;
							}
							$data[$i][$value1] = json_encode($goodarr, JSON_UNESCAPED_UNICODE);
						}
						else {

							$str = $data[$i][$value1];
							//$str = str_replace("\r\n", "", $str);//принимает разделитель перенос строки 
							
							$strArr = explode(";", $str);
							$goodArr = [];

							$data[$i][$value1] = [];
							
							//перебираем товары
							foreach ($strArr as $k => $v) {
								$good = explode(",", $v); //$good[0] - название товара
								//$goodParams = explode(" шт. за ", $good); //$goodParams[0] - кол-во, $goodParams[1] - цена
								//$goodParams = explode(".", $good[1]); //substr($goodParams[0], -3) - кол-во, substr($goodParams[1], 4) - цена
								$goodArr = explode(".", $good[1]); //substr($goodParams[0], -3) - кол-во, substr($goodParams[1], 4) - цена

								$alias =  md5($k);//(isset($select['alias'])) ? $select['alias'] :
								$data[$i][$value1][$alias] = [
									'goodID' 	=> $alias,
									'name' 		=> trim($good[0]),
									'price' 		=> explode(' ', trim($goodArr[1]))[1], //preg_replace( '/[^0-9]/', '', $goodParams[1] ),
									'quantity' 	=> explode(' ', trim($goodArr[0]))[0] //preg_replace( '/[^0-9]/', '', $goodParams[0] )
								];
							}

							$data[$i][$value1] = json_encode($data[$i][$value1], JSON_UNESCAPED_UNICODE);
						}
						
					}
					array_push($values, $data[$i][$value1]);
				}

				$Values2 = array_merge($values, [$user, time(), $domain]);
				foreach ($Names2 as $k => $v) $upd_it[$v] = $Values2[$k];
				$curlist = 0;
				for ($x = 14; $x <= 20; $x++) {
					$res = JBase::Query("SELECT * FROM `list".$x."` WHERE `id` = ".$upd_it['ID']);
					$row = mysqli_fetch_array($res);
					if ($row) { $curlist = $x; break; }
				}
				if ($curlist == 0) $val_list['list'.$listf] .= "('" .implode("','", $Values2)."'),";
				else $upd_data[] = $upd_it;
				//$val_list['list'.$listf] .= "('" .implode("','", $Values2)."'),";
				
				$values = [];
				array_push($arr,'list'.$listf);
			}
			//return $upd_data;
			for ($i = 0; $i < count($upd_data); $i++) {
				JBase::statusChange($curlist, [$upd_data[$i]['ID']], $upd_data[$i]['status']);
				$eq = [];
				foreach ($upd_data[$i] as $k => $v) if ($k != 'ID' && $k != 'status') $eq[] = "`".$k."` = '".$v."'";
				$q = "UPDATE `".$arr[$i]."` SET ".implode(',', $eq)." WHERE `id` = ".$upd_data[$i]['ID'];
				$res = JBase::Query($q);
				if (!$res) {	
					return $q;
				}
			}
			for ($i = 0; $i < count($arr); $i++) {
				$q = "INSERT INTO `".$arr[$i]."`".$Name." VALUES " .substr($val_list[$arr[$i]], 0, -1). ";";
				$res = JBase::Query($q);
				if (!$res) {	
					return $q;
				}
			}
			return $res;
		} else {
		 	$list = 22;
		 	$Names2 = array_merge($names, ['id_user','time','status','domain']);
			$Name = "(`" .implode("`,`", $Names2)."`)";
			
		 	foreach($data as $i => $value) {
		 		$data[$i] = array_intersect_key($data[$i], $fl_select);
		 		foreach($select as $aS => $value1) {
					if ($aS == 'price') array_push($values, explode(':', $data[$i][$value1])[1]); //цены в формате 1:2990
					if ($aS != 'price') array_push($values, $data[$i][$value1]);
				}
				
				$Values2 = array_merge($values, [$user, time(), '1', $domain]);	
				$val .= "('" .implode("','", $Values2)."'),";
				$values = [];
			}
			return JBase::Query("INSERT INTO `list".$list."`".$Name." VALUES " .substr($val, 0, -1). ";");
		}
		return $Values2;
	}
	
	function deleteCard() {
		$data = [];
        if (!empty($_POST['dellArr'])) {
        	$list = 'list'. (int)$_POST['dellArr'][0]['IDbase'];
   		if (!in_array($list_id, [14,15,16,17,18,19,20,51,52])) {
			   $data['OK'] = 1;
				$res = JBase::Update_Data($list, ['status' => '2', 'timeupdate' => time()], ['id' => (int)$_POST['dellArr'][0]['ID']]);
				$data['Res'] = $res;
        }
		}
		$data['dellArr'] = $_POST['dellArr'][0];
		$data['list_id'] = $list_id;
		return $data;
    }
   //динамические настройки сайта БД
   function dbsettings() {
	   require_once $_SERVER["DOCUMENT_ROOT"].'/lib.php';
	   include_lib( 'cotfw.settings' );	   
    
	   $json = &$GLOBALS['JSON'];
    
	   $dbsettings = new COTFW_settings();
    
	   switch( $_POST['method'] ) {
    
		  case 'listing':
			 $json['result'] = [];
			 foreach( $dbsettings->data as $setting_name => $setting_value ) {
				if( isset($dbsettings->data_full[ $setting_name ]) ) {
				    $setting = &$dbsettings->data_full[ $setting_name ];
				    if( empty($setting['hidden']) ) {
					   $setting['value'] = $dbsettings->val( $setting_name );// расшифровка данных (при необходимости)
					   $json['result'][ $setting_name ] = $setting;
				    }
				}
			 }
			 	
			 json_good();
			 break;
    
		  case 'update':
			 $name	= filter_str( $_POST['name'], MASK_TEXT );
			 $value	= filter_str( $_POST['value'], MASK_TEXT );
    
			 if( $dbsettings->exists($name) ) {
				$dbsettings->update( $name, $value );
				$json['result'] = $dbsettings->data_full[ $name ];
				$json['result']['value'] = $dbsettings->val( $name );
				json_good();
			 } else {
				json_bad( 'Неизвестная настройка' );
			 }
			 break;
    
		  case 'get':
			 $json['result'] = [];
    
			 $list = explode( ';', $_POST['list'] );
			 if( !empty($list) )
				foreach( $list as $name )
				    if( $dbsettings->exists($name) && $dbsettings->is_public($name) )
					   $json['result'][ $name ] = $dbsettings->val( $name );
				    	
				    json_good();
				    break;
    
		  default:
			 json_bad( 'Неизвестный метод' );
    
	   }    
	   json_result();
    
    }
   
	//выдача карточек каталога
	function listing() {
		require_once $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		
		$granted 	= []; //разрешенные поля
		$list_id 	= (!empty($_POST['list_id'])) ? (int)( $_POST['list_id'] ) : false;
		$item_id 	= (!empty($_POST['item_id'])) ? (int)( $_POST['item_id'] ) : false;
		$page_id 	= (!empty($_POST['page_id'])) ? JBase::escape( $_POST['page_id'] ) : false;
		$user_id 	= (!empty($_POST['user_id'])) ? JBase::escape( $_POST['user_id'] ) : false;
		$status 		= (!empty($_POST['status'])) ? JBase::escape( $_POST['status'] ) : 0;

		//пагинация
		$pagination = (!empty($_POST['pagination'])) ? true : false;
		$order_by 	= (!empty($_POST['order_by'])) ? explode("-", JBase::escape($_POST['order_by'])) : JBase::escape($_POST['price']);
		$offset 		= (!empty($_POST['offset'])) ? (int)( $_POST['offset'] ) : 0;
		$count 		= (!empty($_POST['count'])) ? (int)( $_POST['count'] ) : null;
	   
		//поиск по форме поиска
		$search 		= (!empty($_POST['search'])) ? json_decode( $_POST['search'], true ) : false;
		$searchLV		= (!empty($_POST['searchLV'])) ? $_POST['searchLV'] : '';
		$search_goods	= (!empty($_POST['search_goods'])) ? $_POST['search_goods'] : '';
		
		//поиск похожих объявлений
		$similar 	= (!empty($_POST['similar'])) ? JBase::escape( $_POST['similar'] ) : false;
	   
		//выборка по условиям: текстовый поиск, по цене, по типу пользователей
		$text 		= (!empty($_POST['text'])) ? JBase::escape( $_POST['text'] ) : false;
		$usertypes 	= (!empty($_POST['usertype'])) ? JBase::escape( $_POST['usertype'] ) : 'all';
		$query 		= [];
	   
		//where
		$where 		= "list" .$list_id. ".domain = '". DOMAIN ."' ";
    	
    	//поиск по карточкам пользователя
		if( $user_id ) {
			switch( $user_id ) {   
				case '0':
					$where .= " AND list" .$list_id. ".id_user = '" . USERID . "'";
				break; 
				case 'status0':
					if ( userType(CUser::user(TOKEN)) == "1" ) $where .= " AND list" .$list_id. ".status = '0'";
					else $where .= " AND list" .$list_id. ".status = '0' AND list" .$list_id. ".id_user = '" . USERID . "'";
				break; 
				case 'status1':
					if ( userType(CUser::user(TOKEN)) == "1" ) $where .= " AND list" .$list_id. ".status = '1'";
					else $where .= " AND list" .$list_id. ".status = '1' AND list" .$list_id. ".id_user = '" . USERID . "'";
				break; 
				case 'status2':
					if ( userType(CUser::user(TOKEN)) == "1" ) $where .= " AND list" .$list_id. ".status = '2'";
					else $where .= " AND list" .$list_id. ".status = '2' AND list" .$list_id. ".id_user = '" . USERID . "'";
				break; 
				case 'status3':
					if ( userType(CUser::user(TOKEN)) == "1" ) $where .= " AND list" .$list_id. ".status = '3'";
					else $where .= " AND list" .$list_id. ".status = '3' AND list" .$list_id. ".id_user = '" . USERID . "'";
				break; 
				case 'all':
				default:
				break;
			}
		}  
    	
		//вычисляем значение пагинации (на какой странице находимся)
		if(!isset($offset)) $offset = '0'; 
			
		//вычисляем значение количества записей на странице
		if( $count == null ) {
			$limit = JBase::Query( "SELECT `count` FROM `list_table` WHERE `id` = '" . $list_id . "' AND domain = '".DOMAIN."'" );
	   	while ($row = mysqli_fetch_array($limit)) {
				$count .= $row['count'];
			}
		}

		//получаем данные о полях select
		//$l = JBase::Get_Data('list_field', ['name_field','param'], ['table_field' => $list, 'type_field' => 'select']);
		$l = JBase::Query("SELECT `name_field`, `param` FROM list_field WHERE `table_field` = 'list". $list_id ."' AND `type_field` = 'select' AND `param` != ''");
		$l2 = [];
		if (!empty($l)) {
			while ($l3 = $l->fetch_assoc()) {
				$l4 = json_decode($l3['param'], true);
				if (isset($l4['list_id'])) {
					//получаем значение id_content листов
					$m = JBase::Get_Data('list'. $l4['list_id'], ['id','name'], ['status' => '1']);
					$m2 = [];
					if (!empty($m)) {
						while ($m3 = $m->fetch_assoc())
							$m2[$m3['id']] = $m3['name'];
					}
					$l4['vals'] = $m2;
					$l2[$l3['name_field']] = $l4;
				} elseif (isset($l4['list'])) {
					$l4['vals'] = $l4['list'];
					$l2[$l3['name_field']] = $l4;
				}
			}
		} 
		
		//сортировка новые, дешевле, дороже
    	$order = '';
		$list = 'list'. $list_id;
    	$or = (is_array($order_by)) ? $order_by[0] : $order_by;
    	
		switch( $or ) {
			case 'goods':
				$order .= ' '. $list .'.name DESC';
			break;
			case 'leadvertex':
				$order .= ' '. $list .'.leadvertex_product DESC';
			break;
			case 'new':
				$order .= ' '. $list .'.timeupdate DESC'; //новые сверху
			break;
			case 'bot':
				$order .= ' '. $list .'.price ASC'; //дешевые сверху
			break;
			case 'top':
				$order .= ' '. $list .'.price DESC'; //дорогие сверху
			break;
			case 'operator':
			$desc = (is_array($order_by) && isset($order_by[1])) ? $order_by[1] : ' DESC ';
				$order .= ' operatorId '. $desc . ' '; 
			break;
			case 'ids':
				$desc = (is_array($order_by) && isset($order_by[1])) ? $order_by[1] : ' DESC ';
				$order .= ' '. $list .'.id '. $desc . ' '; 
			break;
// 			case 'rand':
// 				$order .= ' RAND()'; //случайно
// 				Нельзя использовать ORDER BY rand(), т.к. эта структура делает копию всех наших данных, 
// 				загоняет во временную таблицу, добавляет туда еще один столбец, куда записывает результат 
// 				функции rand и потом файловую сортировку всего этого огромного массива. Поэтому, если мы 
// 				хотим выбрать случайную строку, ORDER BY rand() можно применять лишь на небольших объемах 
// 				данных, на больших это сразу убьет всю производительность.
// 			break;
			default:
				$desc = (is_array($order_by) && isset($order_by[1])) ? $order_by[1] : ' DESC ';
				//return $desc;
				$order .= ' '. $list .'.'. $or .' '. $desc; //сортировка по полям
			break;
		}

		$json = &$GLOBALS['JSON'];
		switch( $_POST['method'] ) {    
			case 'get':
				$json['result'] = [];  
				if (isset($status) && $status != false) {
					if($search_goods == ''){
						if ((int)$status > 0) {    
							$where .= " AND list" .$list_id. ".status = '". (int)$status ."'";
						} else {  
							$where .= " AND list" .$list_id. ".status = '1'";
						}
					}  
				}
				
				if($searchLV != ''){
					if(is_array($searchLV)){
						$searchText = implode(",", $searchLV);
						$where .= " AND list" .$list_id. ".leadvertex_product IN (".$searchText.")";
					}else{
						$where .= " AND list" .$list_id. ".leadvertex_product = '$searchLV'";
					}
				}
				if($search_goods != ''){
					if(is_array($search_goods)){
						$searchGoods = implode(",", $search_goods);
						$where .= " AND list" .$list_id. ".id IN (".$searchGoods.")";
					}else{
						$where .= " AND list" .$list_id. ".id = '$search_goods'";
					}
				}

			 //выборка карточки по id
			 if( $item_id ) {
				 $where .= ' AND list' .$list_id. '.id = "'. $item_id  .'" ';
			 }
			 
			 //сортировка все, частные, компании
			 switch( $usertypes ) {    
					case 'all':
						$where .= ' '; //все
						break;
					case 'com':
						$where .= ' AND my_users.usertype = 3 '; //компании
						break;
					case 'use':
						$where .= ' AND my_users.usertype = 2 '; //частные
						break;
				}
		
				//поиск по тексту
				if( $text ) {
					$RR = 'SELECT `name_field` FROM `list_field` WHERE `searchtext` = "1" AND `table_field` = "list' . $list_id . '"';
				    $Results = JBase::Query( $RR );
				    $wheretext = '';
	   			while( $items = $Results->fetch_assoc() ) {
	   				if ($wheretext != '') $wheretext .= ' OR ';
						$wheretext .= "list" .$list_id. ".". $items['name_field'] ." LIKE '%". $text ."%'";
					}
					$where .= " AND (". $wheretext .") "; 
				}

				//var_dump($where);
				
				//есть ли данные в форме поиска
				if( $search ) {
					foreach ($search as $key => $value) {
						if (is_numeric(preg_replace('/[^0-9]/', '', $value)) && $key != 'Url' && $key != 'galleryfield') {
							$where .=' AND list' .$list_id. '.'.$key. ' = ' .$value. '+0'; //в число
						} elseif ($key == 'subLocalityName') {
							$where .=" AND list" .$list_id. ".yandexfield LIKE '%". $value ."%'"; 
						} elseif ($key == 'Url' || $key == 'galleryfield') {
							$where .=" AND list" .$list_id. ".".$key. " != ''"; 
						} elseif (is_array($value)) {
							$minmax = (array_keys($value)[0] == 'in') ? '>' : '<';
							$minmax2 = (array_keys($value)[1] == 'out') ? '<' : false;
							$where .=" AND list" .$list_id. ".".$key. " " .$minmax. " '" .array_values($value)[0]. "'+0"; //в число
							if ($minmax2) $where .=" AND list" .$list_id. ".".$key. " " .$minmax2. " '" .array_values($value)[1]. "'+0"; //в число
						} else {
							$where .=" AND list" .$list_id. ".".$key. " = '" .$value. "'";
						}
					}
				}
					
				//есть ли похожие
				//if( $similar ) $where .= " AND `names` LIKE '%" . $similar . "%' ";

				$json['result'] = [];
				switch($list_id) {
					case 14:
					case 15:
					case 16:
					case 17:
					case 18:
					case 19:
					case 20://CREATE INDEX id_name_avatar_usertype ON my_users(id, name, avatar, usertype);
						$q = 'SELECT list' .$list_id. '.*, my_users.id as operatorId, my_users.name as operatorName, my_users.usertype, list' .$list_id. '.id AS ids
								FROM list' .$list_id. '
								LEFT JOIN my_users ON list' .$list_id. '.id_user = my_users.id
								WHERE ' .$where. '
								ORDER BY ' .$order. ' 
								LIMIT ' .$count. ' 
								OFFSET ' .$offset. '';
					break;
					default:
						$q = 'SELECT list' .$list_id. '.*, my_users.id, my_users.name as operatorName, my_users.usertype, list' .$list_id. '.id AS ids
								FROM list' .$list_id. '
								LEFT JOIN my_users ON list' .$list_id. '.id_user = my_users.id
								WHERE ' .$where. '
								ORDER BY ' .$order. ' 
								LIMIT ' .$count. ' 
								OFFSET ' .$offset. '';
					break;
				}
				
				//var_dump(json_encode($q), JSON_UNESCAPED_UNICODE);
				$Result = JBase::Query($q);

				if ($Result) {
					$granted = self::unsetsGranted($list_id);
					while( $adv = $Result->fetch_assoc() ) {
						//перебираем массив выдачи и заменяем значения полей select
						foreach ($l2 as $keyl2 => $valuel2) {
							if (isset($valuel2['vals'][$adv[$keyl2]])) $adv[$keyl2] = [$adv[$keyl2] => $valuel2['vals'][$adv[$keyl2]]];
						}  
						$json['result'][] = self::unsets($adv, $granted);
					}
				}
			break;    
			default: json_bad( 'неизвестный метод' );
		}   
	   
	   //вычисляем значение количества записей в list_id для пагинации
	   if( $pagination ) {
	   	$pagination = JBase::Query( 'SELECT list'. $list_id .'.*, my_users.id, my_users.usertype, list'. $list_id .'.id AS ids
			 						 FROM list' .$list_id. '
			 						 LEFT JOIN my_users
			 						 ON list' .$list_id. '.id_user = my_users.id
			 						 WHERE ' . $where );
			$json['count'] = mysqli_num_rows($pagination);
		}
		
		$json['offset'] = $offset;
		$json['status'] = 'good';
		$json['not'] = self::unsetsNot($list_id);
		$json['granted'] = $granted;
		if($search_goods != ''){
			$json['nopagination'] = true;
		}

		//$json['page'] = $page;
	   json_result(); 
   
    }
    
	//чистка выдачи crm по ролям
	function unsetsGranted($list) {
		$granted = ['ids'];
		$Result = JBase::Get_Data('list_field', 'name_field', ['table_field' => 'list'.$list, 'show'=> '1']);
		if ($Result) while( $g = $Result->fetch_assoc() ) {
			$granted[] = $g['name_field'];
		}
		return $granted;
	}
	//чистка выдачи crm по ролям
	function unsets($adv, $granted) {
		foreach ($adv as $key => $value) {
			if (!in_array($key, $granted)) {
				$adv[$key] = '';
			}
		}
		return $adv;
	}
	function unsetsNot($list) {
		$not = [];
		$Result = JBase::Get_Data('list_field', 'name_field', ['table_field' => 'list'.$list, 'show'=> '0']);
		if ($Result) while( $g = $Result->fetch_assoc() ) {
			array_push($not, $g['name_field']);
		}
		return $not;
	}

    //moderation
    function moderation() {
	   $item_id 	= (int)( $_POST['item_id'] );
	   $list_id 	= (int)( $_POST['list_id'] );
	   $change 	= (int)( $_POST['change'] );
		JBase::Query("UPDATE `list" . $list_id . "` SET `status` = '" . $change . "' WHERE `id`='" . $item_id . "'");
	   return 'Выполнено';
    }

	function deleteCustomData() {
		$Result = JBase::Get_Data('list8', 'statusgroup', ['id' => $_POST['status']]);
		$list = $Result->fetch_assoc();
		JBase::Query("UPDATE `list" . $list['statusgroup'] . "` SET `dop".$_POST['select']."` = '' WHERE status = ".$_POST['status']);
	}

	function addCustomData() {
		$Result = JBase::Get_Data('list8', 'statusgroup', ['id' => $_POST['status']]);
		$list = $Result->fetch_assoc();
		if ($_POST['radio1'] == 'one') {
			JBase::Query("UPDATE `list" . $list['statusgroup'] . "` SET `dop".$_POST['select']."` = '".$_POST['area']."' WHERE status = ".$_POST['status']." AND `dop".$_POST['select']."` = ''");
		} else {
			JBase::Query("UPDATE `list" . $list['statusgroup'] . "` SET `dop".$_POST['select']."` = '".$_POST['area']."' WHERE status = ".$_POST['status']);
		}
	}

	function getAllIDS() {
		$Result = JBase::Get_Data('list8', 'statusgroup', ['id' => $_POST['status']]);
		$list = $Result->fetch_assoc();
		$Result = JBase::Get_Data('list'.$list['statusgroup'], 'id', ['status' => $_POST['status']]);
		$Data = [];
		while ($Res = $Result->fetch_assoc()) $Data[] = $Res['id'];
		return json_encode($Data);
	}

	function getAll() {
		$post 			= (isset($_POST)) ? $_POST : $_GET;

		$data_value = array(
			'fio' 					=> (isset($post['fio'])) ? $post['fio'] : NULL,
			'product' 				=> (isset($post['product'])) ? $post['product'] : NULL,
			'phone' 				=> (isset($post['phone'])) ? $post['phone'] : NULL,
			'post_track' 			=> (isset($post['post_track'])) ? $post['post_track'] : NULL,
			'id' 					=> (isset($post['id'])) ? $post['id'] : NULL,
			'webmasterId' 			=> (isset($post['webmasterId'])) ? $post['webmasterId'] : NULL,
			'apr_date_from'			=> (isset($post['apr_date_from'])) ? strtotime($post['apr_date_from']) : NULL,
			'apr_date_before' 		=> (isset($post['apr_date_before'])) ? strtotime($post['apr_date_before']) : NULL,
			'buy_date_from'			=> (isset($post['buy_date_from'])) ? strtotime($post['buy_date_from']) : NULL,
			'buy_date_before'		=> (isset($post['buy_date_before'])) ? strtotime($post['buy_date_before']) : NULL,
			'shippedAt_from'		=> (isset($post['shippedAt_from'])) ? strtotime($post['shippedAt_from']) : NULL,
			'shippedAt_before'		=> (isset($post['shippedAt_before'])) ? strtotime($post['shippedAt_before']) : NULL,
			'canceledAt_from'		=> (isset($post['canceledAt_from'])) ? strtotime($post['canceledAt_from']) : NULL,
			'canceledAt_before'		=> (isset($post['canceledAt_before'])) ? strtotime($post['canceledAt_before']) : NULL,
			'refundedAt_from'		=> (isset($post['refundedAt_from'])) ? strtotime($post['refundedAt_from']) : NULL,
			'refundedAt_before'		=> (isset($post['refundedAt_before'])) ? strtotime($post['refundedAt_before']) : NULL,
			'externalId'			=> (isset($post['externalId'])) ? $post['externalId'] : NULL,
			'externalWebmaster'		=> (isset($post['externalWebmaster'])) ? $post['externalWebmaster'] : NULL,
		);

		$Result = JBase::Get_Search_Text('list8', 'statusgroup');
		$num_rows = mysqli_num_rows($Result);
		$Data = [];

		for ($i=0; $i < $num_rows; $i++) { 
			$list = $Result->fetch_assoc();
			$statusgroup[$i] = $list['statusgroup'];
		}
		
		unset($Result,$num_rows,$list);

		$statusgroup = array_unique($statusgroup);
		$count = [];
		$key = 0;
		foreach ($statusgroup as $value) {
			$Result1 = JBase::Get_Search_Text('list'.$value,'*',$data_value);
			$Result2 = JBase::Get_Search_Text('list'.$value,'*',$data_value);
			$num_rows = mysqli_num_rows($Result1);
			for ($d=0; $d < $num_rows; $d++) { 
				$stat = $value;
				if($value == 14) $stat = 'err';
				if($value == 15) $stat = 'return';
				if($value == 16) $stat = 'cancel';
				if($value == 17) $stat = 'processing';
				if($value == 18) $stat = 'accepted';
				if($value == 19) $stat = 'sent';
				if($value == 20) $stat = 'paid';
				
				$count[$stat] = $num_rows;
			}
			unset($data);
			for ($c=0; $c < $num_rows; $c++) {
				if($key > 100) continue;
				$list = $Result2->fetch_assoc();
				$data = array(
					'status'=>$list['status']
				);
				$status = JBase::Get_Search_Text('list8','*',$data);
				$stResult = $status->fetch_assoc();		

				$Data[$key] = ['list'=>$value,'st'=>$stResult['name']] + $list ;
				$key++;
				
			}
			
		}
		$Data[$key] = $count;
		unset($Result,$num_rows,$list);

		// return json_encode($data, JSON_FORCE_OBJECT);
		// return json_encode($Result, JSON_ENESCAPED_UNICODE);
		// $Result = JBase::Get_Search_Text('list'.$value,'*',$_POST['fio'],$_POST['product'],$_POST['apr_date'],$_POST['buy_date'],$_POST['phone'],$_POST['post_track'],$_POST['id'],$_POST['webmasterId']);
		// $Result123 = JBase::Get_Search_Text('list8', 'statusgroup');
		// ConsoleLog::cl_print_r($Data, 'Test');
		return json_encode($Data);
	}

	function doubleCheck(){
		$post 			= (isset($_POST)) ? $_POST : $_GET;
		$list 			= $post['list'];
		if($list == 51){
			$data			= [];
			$connect		= JBase::Query("SELECT * FROM `list51` WHERE `leadvertex_product` IN (SELECT `leadvertex_product` FROM `list51` WHERE `status` = '1' GROUP BY `leadvertex_product` HAVING COUNT(`leadvertex_product`) > 1) ORDER BY `leadvertex_product`");
			while($res = $connect->fetch_assoc()){
				$data[] = $res['leadvertex_product'];
			}
			$data = array_unique($data);
			return $data; 
		}elseif($list == 22){
			$data 				= [];
			$connect 			= JBase::Query('SELECT * FROM `list22` WHERE `name` IN (SELECT `name` FROM `list22` GROUP BY `name` HAVING COUNT(`name`) > 1) ORDER BY `name`');
			while($res = $connect->fetch_assoc()){
				$data[] = (int)$res['id'];
			}

			return $data;
		}
	}


}

