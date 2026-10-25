<?php 
namespace lib;
if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

/**
* class.Cat.php
*
* Библиотека с функциями для работы модуля Каталог
* с фронтендом на php.
* подгружается через автоподгрузку классов
*
* История:  2 апреля 2019 - файл создан
*
**/

class Cat {
	
	//рендеринг карточек
	function renderCard($R, $X, $JSCat, $list_info) {
			
		$template = 'html'. $X['template'];
		$exit = '';
		
		//перебираем значения
		if (!empty($list_info[$template])) {
			foreach($R['result'] as $key1 => $value) {
				if (isset($key1)) {
					$tmpl = $list_info[$template];
					
					foreach($list_info['field'] as $key => $val) {
   					switch($val['type']) {	
							case 'text':
							case 'textarea':
								$tmpl = str_replace("{{{$key}}}", $value[$key], $tmpl);
							break;
							case 'radiobtn':
								$V = json_decode($val['param'], true)[$value[$key]];
								$tmpl = str_replace("{{{$key}}}", '<span class="'. $key .'" data-view="listing">'. $V .'</span>', $tmpl);
							break;
							case 'select':
								$V = json_decode($val['param'], true)['list'][$value[$key]];
								$tmpl = str_replace("{{{$key}}}", '<span class="'. $key .'" data-view="listing">'. $V .'</span>', $tmpl);
							break;
							case 'chekbox':
								$tmpl = str_replace("{{{$key}}}", $value[$key], $tmpl);
							break;
							case 'fotoalbum':
								if (!empty($value[$key])) {
									$V = json_decode($value[$key], true);
									reset($V);
									$ava = '/cdn/'. DOMAIN .'/card/'. $X['list_id'] .'/'. key($V) .'.jpg'; 
								} else {
									$ava = '/cdn/lib/nophoto.jpg';
								}			
								$tmpl = str_replace("{{{$key}}}", '<a class="'. $key .'" data-view="listing" href="'. $ava .'" style="font-size:0px;background-size: cover;background-image:url('. $ava .')"></a>', $tmpl);
							break;
							case 'link':
								$tmpl = str_replace("{{{$key}}}", $value[$key], $tmpl);
							break;
							case 'textint':
								$tmpl = str_replace("{{{$key}}}", '<span class="'. $key .'" data-view="listing">'. $value[$key] .'</span>', $tmpl);
							break;
							case 'yandex':
								$V = json_decode($value[$key], true)['ycoradr']['address'];
								$tmpl = str_replace("{{{$key}}}", '<span class="'. $key .'" data-view="listing">'. $V .'</span>', $tmpl);
							break;
							case 'youtube':
								$tmpl = str_replace("{{{$key}}}", $value[$key], $tmpl);
							break;
						}
					}	
					
					//записываем сформированную карточку в общий список
					$exit .= $tmpl;
				}
			}
			return $exit;
		} else {
			return 'Отсутствует разметка для этого каталога';
		}
	}
	
	//рендеринг поиск
	function renderSearch($X, $JSCat, $list_info) {
			
		$template = 'html'. $X['template'];
		$tmpl = $list_info[$template];
		$regexp_str = '{{(\\w+)(\\.|)(selectmenu|map|yandex|youtube|select|check|radio|textarea|input|range|gallery|link|){1}(.*?)}}'; //orig
				
		$regexp_all = '{{(.*?)}}'; //все
		$regexp_all_attr = '\[(.*?)\]'; //аттрибуты
		$regexp_all_type = '(selectmenu|map|yandex|youtube|select|check|radio|textarea|input|range|gallery|link|){1}'; //поля
		
		//перебираем значения
		if (!empty($list_info[$template])) {	
			foreach($list_info['field'] as $key => $val) {
						
   			switch($val['type']) {	
					case 'text':
						$tmpl = str_replace("{{{$key}}}", '<textarea'. self::renderAttr() .'></textarea>', $tmpl);
					break;
// 					case 'textarea':
// 						$tmpl = str_replace("{{{$key}}}", $value[$key], $tmpl);
// 					break;
// 					case 'radiobtn':
// 						$V = json_decode($val['param'], true)[$value[$key]];
// 						$tmpl = str_replace("{{{$key}}}", '<span class="'. $key .'" data-view="listing">'. $V .'</span>', $tmpl);
// 					break;
// 					case 'select':
// 						$V = json_decode($val['param'], true)['list'][$value[$key]];
// 						$tmpl = str_replace("{{{$key}}}", '<span class="'. $key .'" data-view="listing">'. $V .'</span>', $tmpl);
// 					break;
// 					case 'chekbox':
// 						$tmpl = str_replace("{{{$key}}}", $value[$key], $tmpl);
// 					break;
// 					case 'fotoalbum':
// 						if (!empty($value[$key])) {
// 							$V = json_decode($value[$key], true);
// 							reset($V);
// 							$ava = '/cdn/'. DOMAIN .'/card/'. $X['list_id'] .'/'. key($V) .'.jpg'; 
// 						} else {
// 							$ava = '/cdn/lib/nophoto.jpg';
// 						}			
// 						$tmpl = str_replace("{{{$key}}}", '<a class="'. $key .'" data-view="listing" href="'. $ava .'" style="font-size:0px;background-size: cover;background-image:url('. $ava .')"></a>', $tmpl);
// 					break;
// 					case 'link':
// 						$tmpl = str_replace("{{{$key}}}", $value[$key], $tmpl);
// 					break;
// 					case 'textint':
// 						$tmpl = str_replace("{{{$key}}}", '<span class="'. $key .'" data-view="listing">'. $value[$key] .'</span>', $tmpl);
// 					break;
// 					case 'yandex':
// 						$V = json_decode($value[$key], true)['ycoradr']['address'];
// 						$tmpl = str_replace("{{{$key}}}", '<span class="'. $key .'" data-view="listing">'. $V .'</span>', $tmpl);
// 					break;
// 					case 'youtube':
// 						$tmpl = str_replace("{{{$key}}}", $value[$key], $tmpl);
// 					break;
				}
			}	
			return $tmpl;
		} else {
			return 'Отсутствует разметка для этого каталога';
		}
	}

	function str_without_spaces($str) {
		return preg_replace('/\s+/', '', $str);
	}

	function str_without_quotes($str) {
		return preg_replace("/[^a-zA-Z0-9]+/", '', $str);
	}
	
	function renderAttr($str) {
		$attrs_remove_spaces = false;

		$res = [];
		if ($str) {
			$str = str_replace("[", "", $str)
			$str = str_replace("]", "", $str);
			
			$attrs = explode(',', $str);
			for ($i = 0; $i < count($attrs); $i++) {
				$name_val = explode(':', $attrs[i]);
				$name_val[0] = self::str_without_spaces($name_val[0]);
				$old_len = strlen($name_val[1]);
				$name_val[1] = self::str_without_quotes($name_val[1]);
				if ($attrs_remove_spaces && strlen($name_val[1]) == $old_len) {
					$name_val[1] = self::str_without_spaces($name_val[1]);
				}
				if ($name_val[0]) {
					$res[$name_val[0]] = $name_val[1];
				}
			}
		}
		return $res;
	}
		
	//генерация полей и разметки
	function gen($list, $template) {
		
		$Result = JBase::Get_From_Template('list_table', '*', ['domain_id' => $list, 'domain' => $template]);	
		if ($Result) {	
			while ($numrow = $Result->fetch_assoc()) {					
					
				$fields = [];
				$Result2 = JBase::Get_Nodomain('list_field', '*', ['table_field' => 'list'. $numrow['domain_id']]);
				while ($NumField = $Result2->fetch_assoc()) {
					if ($NumField['type_field'] != 'system') {
						if ($NumField['name_field'] != 'id') {
						
							$fields[$NumField['name_field']]['caption'] = $NumField['caption']; 
							$fields[$NumField['name_field']]['type'] = $NumField['type_field'];   
							$fields[$NumField['name_field']]['param'] = (array) json_decode($NumField['param']);
							$fields[$NumField['name_field']]['required'] = $NumField['required'];	
	 
							if ($NumField['type_field'] == 'select') $fields[$NumField['name_field']]['param'] = $NumField['param']; 
							if ($NumField['type_field'] == 'textint') $fields[$NumField['name_field']]['param'] = $NumField['param'];	
							if ($NumField['type_field'] == 'chekbox') $fields[$NumField['name_field']]['param'] = $NumField['param'];
							if ($NumField['type_field'] == 'youtube') $fields[$NumField['name_field']]['param'] = $NumField['param'];	   
	
						}
					}
				}
					
				$response['field']   = $fields;
				$response['html1']   = htmlspecialchars_decode($numrow['html1']);
				$response['html2']   = htmlspecialchars_decode($numrow['html2']);
				$response['html3']   = htmlspecialchars_decode($numrow['html3']);
				$response['html4']   = htmlspecialchars_decode($numrow['html4']);
				$response['html5']   = htmlspecialchars_decode($numrow['html5']);
				$response['html6']   = htmlspecialchars_decode($numrow['html6']);
				$response['html7']   = htmlspecialchars_decode($numrow['html7']);
				$response['html8']   = htmlspecialchars_decode($numrow['html8']);
				$response['html9']   = htmlspecialchars_decode($numrow['html9']);
				$response['html10']  = htmlspecialchars_decode($numrow['html10']);
				
				$response['position'] = $numrow['position'];
				$response['list']	 = $list;  	
			}
		}
	
		return $response;
	}

	//запрос карточек каталога
	function get($X, $JSCat) {

//		входящий массив
//
// 	$X = [
// 		'list_id' => $list_id,
// 		'item_id' => $item_id,
// 		'user_id' => $user_id,
// 		'page_id' => $page_id,
// 		'count' => $count,
// 		'offset' => $offset,
// 		'template' => $template,
// 		'pagination' => $pagination,
// 		'search' => $search,
// 		'text' => $text,
// 		'usertype' => $usertype,
// 		'price' => $price
// 	];


		//получаем разметку каталога и полей к нему
		$list_info = self::gen($X['list_id'], $JSCat['template']);
		   
		//если поиск
		if ($X['template'] == 3) {
			return self::renderSearch($X, $JSCat, $list_info);
		}
		
		//переключаем на парсинг
		if (!empty($X['count']) && $X['count'] === 17) {
			//return CParser::curl();
		}
		
		$R = [];
		$query = [];
		$orderby = '';
		$R['result'] = []; 
		  
		$where = 'list'. $X['list_id'] .'.domain = "'. DOMAIN .'" ';
		if ($X['list_id'] == 26) $where = 'list'. $X['list_id'] .'.domain = "nodomain" ';
				
		//вычисляем значение пагинации (на какой странице находимся)
		if (!$X['offset']) $X['offset'] = '0'; 
		
		//сортировка новые, дешевле, дороже
		switch($X['price']) {	
		  case 'new':
				$orderby .= ' `timeupdate` DESC'; //новые сверху
				break;
			case 'bot':
				$orderby .= ' `price` + 0 ASC'; //дешевые сверху
				break;
			case 'top':
				$orderby .= ' `price` + 0 DESC'; //дорогие сверху
				break;
			case 'rand':
				$orderby .= ' RAND()'; //случайно
				break;
		}
	
		//выборка карточки по user_id, если не админ
		if( isset($X['user_id']) && $X['user_id'] != false) {	
			switch($X['user_id']) { 
				//все мои объявления
				case '0':
							$where .= ' AND list' .$X['list_id']. '.id_user = "' . $JSCat['user'] . '"';
				break; 
				//мои объявления на модерации
				case 'status0':
					   if ( userType(CUser::user($JSCat['token'])) == '1' ) $where .= ' AND list' .$X['list_id']. '.status = "0"';
					   else $where .= ' AND list' .$X['list_id']. '.id_user = "' . $JSCat['user'] . '" AND list'. $X['list_id'] .'.status = "0"';
				break;
				//мои объявления опубликованные
				case 'status1':
					   if ( userType(CUser::user($JSCat['token'])) == '1' ) $where .= ' AND list'. $X['list_id'] .'.status = "1"';
					   else $where .= ' AND list'. $X['list_id'] .'.id_user = "' . $JSCat['user'] . '" AND list'. $X['list_id'] .'.status = "1"';
				break;
				//мои объявления архив
				case 'status2':
					   if ( userType(CUser::user($JSCat['token'])) == '1' ) $where .= ' AND list'. $X['list_id'] .'.status = "2"';
					   else $where .= ' AND list'. $X['list_id'] .'.id_user = "' . $JSCat['user'] . '" AND list'. $X['list_id'] .'.status = "2"';
				break;
				//мои объявления неопубликованные
				case 'status3':
					   if ( userType(CUser::user($JSCat['token'])) == '1' ) $where .= ' AND list'. $X['list_id'] .'.status = "3"';
					   else $where .= ' AND list'. $X['list_id'] .'.id_user = "' . $JSCat['user'] . '" AND list'. $X['list_id'] .'.status = "3"';
				break; 
				//все активные объявления
				case 'all':
					   $where .= ' AND list'. $X['list_id'] .'.id_user > "0" AND list'. $X['list_id'] .'.status = "1"';
				break;   
				//все активные объявления по id пользователя
				case preg_match( '#[^0-9]#si', $X['user_id'] ):
					   $where .= ' AND list'. $X['list_id'] .'.id_user = "'.$X['user_id'].'" AND list'. $X['list_id'] .'.status = "1"';
				break;
				//выборка по странице  
				case 'page':
					   $where .= ' AND list'. $X['list_id'] .'.id_user > "0" AND list'. $X['list_id'] .'.status = "1" AND my_users.id_manager LIKE "%' . $X['page_id'] . '%" ';
				break;
				//выборка premium объявлений 
				case 'premium':
					   $where .= ' AND list'. $X['list_id'] .'.id_user > "0" AND list'. $X['list_id'] .'.status = "1" AND list'. $X['list_id'] .'.premium = "2" ';
				break;
				//выборка color объявлений 
				case 'color':
					   $where .= ' AND list'. $X['list_id'] .'.id_user > "0" AND list'. $X['list_id'] .'.status = "1" AND list'. $X['list_id'] .'.premium = "1" ';
				break;			
			}	
		}
		
		//выборка карточки по id
		if ($X['item_id']) $where .= ' AND list'. $X['list_id'] .'.id = "'. $X['item_id']  .'" ';

			 
		//сортировка все, частные, компании
		switch($X['usertype']) {	
			case 'all'://все
			break;
			case 'com':
				$where .= ' AND my_users.usertype = 3 '; //компании
			break;
			case 'use':
				$where .= ' AND my_users.usertype = 2 '; //частные
			break;
		}
		
		//поиск по тексту
		if ($X['text']) {
			$Results = JBase::Query('SELECT `name_field` FROM `list_field` WHERE `searchtext` = "1" AND `table_field` = "list' . $X['list_id'] . '"');
			$wheretext = '';
			while( $items = $Results->fetch_assoc() ) {
				if ($wheretext != '') $wheretext .= ' OR ';
				$wheretext .= "list" .$X['list_id']. ".". $items['name_field'] ." LIKE '%". $X['text'] ."%'";
			}
			$where .= " AND (". $wheretext .") "; 
		}
				
		//есть ли данные в форме поиска
		if ($X['search']) {
			foreach ($X['search'] as $key => $value) {
				if (is_numeric(preg_replace('/[^0-9]/', '', $value)) && $key != 'Url' && $key != 'galleryfield') {
					$where .=' AND list'. $X['list_id'] .'.'.$key. ' = ' .$value. '+0'; //в число
				} elseif ($key == 'subLocalityName') {
					$where .=" AND list" .$X['list_id']. ".yandexfield LIKE '%". $value ."%'"; 
				} elseif ($key == 'Url' || $key == 'galleryfield') {
					$where .=" AND list" .$X['list_id']. ".".$key. " != ''"; 
				} elseif (is_array($value)) {
					$minmax = (array_keys($value)[0] == 'in') ? '>' : '<';
					$minmax2 = (array_keys($value)[1] == 'out') ? '<' : false;
					$where .=" AND list" .$X['list_id']. ".".$key. " " .$minmax. " '" .array_values($value)[0]. "'+0"; //в число
					if ($minmax2) $where .=" AND list" .$X['list_id']. ".".$key. " " .$minmax2. " '" .array_values($value)[1]. "'+0"; //в число
				} else {
					$where .=" AND list" .$X['list_id']. ".".$key. " = '" .$value. "'";
				}
			}
		}
	 
		$q = 'SELECT list' .$X['list_id']. '.*, my_users.id, my_users.avatar, my_users.usertype, list' .$X['list_id']. '.id AS ids
			 						 FROM list' .$X['list_id']. '
			 						 LEFT JOIN my_users
			 						 ON list' .$X['list_id']. '.id_user = my_users.id
			 						 WHERE ' .$where. '
			 						 ORDER BY ' .$orderby. ' 
			  						 LIMIT ' .$X['count']. ' 
			  						 OFFSET ' .$X['offset']. '';
		//var_dump($q);
		$Result = JBase::Query( $q );
			 
		if ($Result) {
			while( $adv = $Result->fetch_assoc() ) {	
				foreach( $adv as $key => $value ) {
					if( strpos($key,'_point') ) unset( $adv[ $key ] );	
				}
				$R['result'][] = $adv;
			}
		}
	   
	   //вычисляем значение количества записей в list_id для пагинации
	   if ($X['pagination']) {
	   	$pagination = JBase::Query( 'SELECT list' .$X['list_id']. '.*, my_users.id, my_users.usertype, list' .$X['list_id']. '.id AS ids
			 						 FROM list' .$X['list_id']. '
			 						 LEFT JOIN my_users
			 						 ON list' .$X['list_id']. '.id_user = my_users.id
			 						 WHERE ' . $where );
			$R['count'] = mysqli_num_rows($pagination);
		}
		
		$R['offset'] = $X['offset'];
		$R['status'] = 'good';
		
   	//рендеринг
   	switch($X['template']) {	
			case '2':
			case '4':
			case '6':
			case '8':
			case '10':
				return self::renderCard($R, $X, $JSCat, $list_info); //если карточка
			break;
			case '2':
			case '7':
				//return self::renderDetail($R, $X, $JSCat, $list_info); //если подробная
			break;
			case '5':
			case '9':
				//return self::renderForm($R, $X, $JSCat, $list_info); //редактирование/добавление
			break;
			case '3':
				//return self::renderSearch($R, $X, $JSCat, $list_info); //если поиск
			break;
		}
	}
	
}

