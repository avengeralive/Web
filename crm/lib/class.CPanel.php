<?php 
namespace lib;

/**
* class.CPanel.php
*
*Класс - библиотека с функциями для работы панели администратора
*подгружается через автоподгрузку классов
*
*
**/


class CPanel {
	
	//генерация форм и сохранение в кеш
	function gen( $id = false ) {
		
		if (!$id) $id = (int)$_REQUEST['id']; 
		
		
		$Result = JBase::Get_Data('list_table', '*', ['domain_id' => $id]);		
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
					
				$response['ts']	   = $numrow['ts'];
				$response['sf']	   = $numrow['sf'];
				$response['list']	 = false;
				$response['user']	 = false;
				$response['mod_menu'] = explode("_", $numrow['mod_menu']);
				$response['position'] = $numrow['position'];
				  	
			}
		}
	
		if (!empty($response)) {
			$sftp = new LocalConnection();
			$sftp->SendFile(json_encode($response), DOMAIN . '/form/' . $id . '.json');
		}
		return json_encode($response);
	}
	//список полей ввода
	function fieldList() {
		$response = [];
		$Result = JBase::Get_Nodomain('list_field', '*', ['table_field' => 'list'. (int)$_POST['list_id']]);							
		while ($numrow = $Result->fetch_assoc()) {
			foreach ($numrow as $key => $value) {
				if ($numrow['type_field'] != 'system' ) $response[$key][] = $value;
			}
		}
		//$Result->free();
		
		if (!empty($response)) {
			unset($response['domain']);
			$out = [];
			foreach ($response as $key => $subarr) {
				foreach ($subarr as $subkey => $subvalue) {
					$out[$subkey][$key] = $subvalue;
				}
			}
			return json_encode($out);
		}
		return false; 
	}
	//создать поле ввода
	function addField() {
		$list = 'list'. (int)$_POST['list']; 
		$field = 'f'. time() .'n';
		$Name = [
			'domain',
			'name_field',
			'type_field',
			'table_field',
			'caption'
		];
		$Value = [
			DOMAIN,
			$field,
			'text',
			$list,
			'Новое поле'
		];
		
		if (!in_array($list, ['list14','list15','list16','list17','list18','list19','list20'])) {
			JBase::Set_Data('list_field', $Name, $Value);
		} else {
			$Value[3] = 'list14';
			JBase::Set_Data('list_field', $Name, $Value);
			$Value[3] = 'list15';
			JBase::Set_Data('list_field', $Name, $Value);
			$Value[3] = 'list16';
			JBase::Set_Data('list_field', $Name, $Value);
			$Value[3] = 'list17';
			JBase::Set_Data('list_field', $Name, $Value);
			$Value[3] = 'list18';
			JBase::Set_Data('list_field', $Name, $Value);
			$Value[3] = 'list19';
			JBase::Set_Data('list_field', $Name, $Value);
			$Value[3] = 'list20';
			JBase::Set_Data('list_field', $Name, $Value);
		}
		JBase::Alter_Table($list, $field, 'text');
		
		//self::gen((int)$_POST['list']);
		return (int)$_POST['list'];
	}
	//галочка вкл-выкл каталог
	function offBase() {
		JBase::Update_Data('list_table', ['published' => (int)$_POST['param'][1]], ['domain_id' => (int)$_POST['param'][0]]);
	}
	//выбор пунктов меню публикации каталога
	function pageBase() {
		JBase::Update_Data('list_table', ['mod_menu' => $_POST['menu']], ['domain_id' => (int)$_POST['idbase']]);
		self::gen((int)$_POST['idbase']);
		return true;
	}
	//заголовок каталога
	function titleBase() {
		JBase::Update_Data('list_table', ['title' => $_POST['param'][1]], ['domain_id' => (int)$_POST['param'][0]]);
	}
	//заголовок фотоальбома
	function albumName() {
		JBase::Update_Data('photoalbums', ['name' => $_POST['param'][1]], ['id' => (int)$_POST['param'][0]]);
	}
	//сохранение в динамических настройках
	function dbsettingSave() {
		JBase::Update_Data('settings', ['value' => $_POST['param'][1]], ['id' => (int)$_POST['param'][0]]);
	}
	//сохранение в динамических настройках
	function antispamSave() {
		JBase::Update_Data('antispam', ['value' => $_POST['param'][1]], ['id' => (int)$_POST['param'][0]]);
	}
	//сохранение в динамических настройках
	function operatorSave() {
		JBase::Update_Data('operators', [$_POST['param'][0] => $_POST['param'][1]], '');
		return $_POST['param'];
	}
	//cоздать каталог
	function newBase() {	
		$Name  = [
			'domain_id',
			'domain',
			'email',
			'title',
			'count'
		];
		$Value = [
			'',
			DOMAIN,
			'0_0_0',
			'Новый каталог',
			'50'
		];
		$list = JBase::Set_Data_Unik('list_table', $Name, $Value);
		JBase::Update_Data('list_table', ['domain_id' => $list], ['id' => $list]);
		
		JBase::Create_List($list);	 
		self::gen($list);	
		return $list;
	}
	//сохранить html
	function savelisttemplate() {
		JBase::Update_Data('list_table', [$_POST['template'] => $_POST['html']], ['domain_id' => (int)$_POST['list']]);
		self::gen((int)$_POST['list']);
		return true;
	}
	//выбор позиции для каталога
	function selectPosition() {
		JBase::Update_Data('list_table', ['position' => $_POST['param'][1]], ['domain_id' => (int)$_POST['param'][0]]);
	}
	//сохранить настройки поля ввода
	function saveField() {
		//$list = 'list'. (int)$_POST['idbase']; 
		$Value = [
			'param' 			=> $_POST['param'],
			'caption' 		=> $_POST['caption'],
			'type_field' 	=> $_POST['type_field'],
			'operator' 		=> ($_POST['operator'] == 'true') ? 1 : 0,
			'required' 		=> ($_POST['required'] == 'true') ? 1 : 0,
			'searchtext' 	=> ($_POST['searchtext'] == 'true') ? 1 : 0,
			'show' 			=> ($_POST['show'] == 'true') ? 1 : 0
		];
		self::gen((int)$_POST['idbase']);
		JBase::Update_Data_Nodomain('list_field', $Value, ['id' => (int)$_POST['id']]);
		return true;
	}
	//вызов списка каталогов
	function listBase() {
		$response = [];	
		$template = JBase::Get_Field_Value_From_Domain('templates', 'template');
		$Result = JBase::Get_From_Template('list_table', '*', ['domain' => $template]);
		while ($numrow = $Result->fetch_assoc()) { 
			$response['id'][]		= $numrow['id'];
			$response['domain_id'][] = $numrow['domain_id'];
			$response['title'][]	 = $numrow['title'];
			$response['email'][]	 = $numrow['email'];
			$response['mod_menu'][]  = explode("_", $numrow['mod_menu']);
			$response['html1'][]	 = htmlspecialchars_decode($numrow['html1']);
			$response['html2'][]	 = htmlspecialchars_decode($numrow['html2']);
			$response['html3'][]	 = htmlspecialchars_decode($numrow['html3']);
			$response['html4'][]	 = htmlspecialchars_decode($numrow['html4']);
			$response['html5'][]	 = htmlspecialchars_decode($numrow['html5']);
			$response['html6'][]	 = htmlspecialchars_decode($numrow['html6']);
			$response['html7'][]	 = htmlspecialchars_decode($numrow['html7']);
			$response['html8'][]	 = htmlspecialchars_decode($numrow['html8']);
			$response['html9'][]	 = htmlspecialchars_decode($numrow['html9']);
			$response['html10'][]	= htmlspecialchars_decode($numrow['html10']);
			$response['position'][]  = $numrow['position'];
			$response['published'][] = $numrow['published'];
			$response['moderation'][]= $numrow['moderation'];
			$response['sf'][]		= $numrow['sf'];
			$response['ts'][]		= $numrow['ts'];
		}
		if (empty($response)) $response['error'] = 'No data';
		//$template->free();
		//$Result->free();
		return json_encode($response);		
	}
	//вызов списка каталогов
	function listBase2() {	
		$response = [];
		//$template = JBase::Get_Field_Value_From_Domain('templates', 'template');
		$Result = JBase::Get_Data('list_table', '*', '');
		while ($numrow = $Result->fetch_assoc()) { 
			$response['title'][]	 = $numrow['title'];
			$response['email'][]	 = $numrow['email'];
			$response['domain_id'][] = $numrow['domain_id'];
			$response['mod_menu'][]  = explode("_", $numrow['mod_menu']);
			$response['position'][]  = $numrow['position'];
			$response['published'][] = $numrow['published'];
			$response['moderation'][]= $numrow['moderation'];
			$response['html1'][]	 = htmlspecialchars_decode($numrow['html1']);
			$response['html2'][]	 = htmlspecialchars_decode($numrow['html2']);
			$response['html3'][]	 = htmlspecialchars_decode($numrow['html3']);
			$response['html4'][]	 = htmlspecialchars_decode($numrow['html4']);
			$response['html5'][]	 = htmlspecialchars_decode($numrow['html5']);
			$response['html6'][]	 = htmlspecialchars_decode($numrow['html6']);
			$response['html7'][]	 = htmlspecialchars_decode($numrow['html7']);
			$response['html8'][]	 = htmlspecialchars_decode($numrow['html8']);
			$response['html9'][]	 = htmlspecialchars_decode($numrow['html9']);
			$response['html10'][]	= htmlspecialchars_decode($numrow['html10']);
		}
		//$template->free();
		//$Result->free();
		if (!empty($response)) {
			$out = [];
			foreach ($response as $key => $subarr) {
				foreach ($subarr as $subkey => $subvalue) {
					$out[$subkey][$key] = $subvalue;
				}
			}
			return json_encode($out);
		}
		return false;		
	}
	//Настройки модерации каталога
	function moderMode() {
		JBase::Update_Data('list_table', ['moderation' => (int)$_POST['param'][1]], ['domain_id' => (int)$_POST['param'][0]]);
	}

	//смена статуса
	function statusChange() {
		if (!empty($_POST['ids']) && !empty($_POST['tostatus'])) {
				return JBase::statusChange((int)$_POST['list'], $_POST['ids'], (int)$_POST['tostatus']);
		}
	}

	function Get_Data(){
		$postIndex = $_POST['postIndex'];
		$QQ = "SELECT * FROM `closePostIndex` WHERE `postIndex` = '$postIndex'";
		$res = JBase::Query($QQ);
		$num_rows = mysqli_num_rows($res);
		if($num_rows > 0){
			return 1;
		}else{
			return 0;
		}
	}
	// сохранение
	function Update_Data(){
		$Table_Name = 'list'.(int)$_POST['list'];
		$set		= $_POST['set'];
		$id			= $_POST['id'];
		$new_set = '';
		
		if(is_array($set)){
			foreach($set as $key => $value) {
				$new_set .= "`". $key."`='". $value ."', ";
			}
			$new_set = rtrim($new_set, ", ");
		} else $new_set .= $set;
		
		$QQ = "UPDATE $Table_Name SET $new_set WHERE `domain` = '". JBase::get_db() ."' and `id` = '$id' ";	
		//var_dump($QQ);
		$res = JBase::Query($QQ);
		return $res;
	}
	//недозвон - время перезвона
	function noCall() {
		if (!empty($_POST['ids'])) {
			if (!empty($_POST['comment'])) {
				$comment = JBase::Get_Field_Value_From_Id('list'. (int)$_POST['list'], (int)$_POST['ids'], 'comment') . "\n". JBase::escape($_POST['comment']);
				JBase::Update_Data('list'. (int)$_POST['list'], ['comment' => $comment], ['id' => (int)$_POST['ids']]); //comment
			}
			JBase::Update_Data('list'.(int)$_POST['list'], ['time_call' => (int)$_POST['time']], ['id' => (int)$_POST['ids']]);
			JBase::statusChange((int)$_POST['list'], [(int)$_POST['ids']], (int)$_POST['tostatus']); //смена статуса	
		}
	}
		
				
	//групп пользователей
	function group_setting() {
		$response = [];
		$Result = JBase::Get_Full_Table('my_users_group');
		while ($numrow = $Result->fetch_assoc()) {
			$response['group']['id'][]	 = $numrow['id'];
			$response['group']['name'][]   = $numrow['name'];
		}
		//$Result->free();
		return $response;
	}
	
	//api
// 	function api() {
// 		$ids = (is_array($_POST['ids'])) ? $_POST['ids'] : [];
// 		$list = (int)$_POST['list'];
// 		if ($ids.size > 0) {
// 			//return Api::
// 		}
// 	}
	
	function selectGoods() {
		$Result = DB::Get_Full_Table('list22');				
		if (!empty($Result)) {
			$items = [];
			$vals = [
				'0' => 'Без категории',
				'1563' => '[Апсел]',
				'1552' => 'Доставка',
				'1551' => 'Кеды',
				'1550' => 'Детские игрушки',
				'1548' => 'Телефоны',
				'1546' => 'Ботинки',
				'1488' => 'Электроника',
				'1487' => 'Кроссовки',
				'1587' => 'Одежда',
				'1911' => 'Пылесосы',
				'1912' => 'Линзы',
				'1913' => 'Парфюм',
				'1929' => 'Камеры/Регистраторы',
				'1930' => 'Наушники',
				'1931' => 'TV-Приставки',
				'2060' => 'Магнитолы',
				'2068' => 'Смарт часы',
				'1565' => 'Шлак'
			];
			while ($item = $Result->fetch_assoc()) {
				$select = [
 					'id' => $item['id'],
 					'goodID' => $item['id'],
					'name' => $item['name'],
					'price' => $item['price'],
					'priceAll' => $item['priceAll'],
					'alias' => $item['alias']
				];
				$val = (isset($item['category']) && isset($vals[$item['category']]) && (int)$item['category'] > 0) ? $vals[$item['category']] : 'Без категории';
				$items[$val][] = $select;
			}
			return $items;
		}
	}
	//tocsv
	function tocsv($list = null, $ids = null) {
		$ids = ($ids && is_array($ids)) ? $ids : 22; //22-товары
		$list = ($list) ? (int)$list : 22; //22-товары
		$list22 = JBase::Query( "SELECT * FROM `list". $list ."` LIMIT 500");
		$fields = JBase::Query( "SELECT `name_field`,`caption` FROM `list_field` WHERE `table_field` = 'list". $list ."'");
								
		if (!empty($list22) && !empty($fields)) {
			$items = [];
			while ($item = $list22->fetch_assoc()) {
				unset($item['geo']);
				unset($item['id_user']);
				unset($item['status']);
				unset($item['page']);
				unset($item['premium']);
				unset($item['statuschange']);
				unset($item['timeupdate']);
				unset($item['domain']);
				unset($item['time']);
				$items[] = $item;
			}
			
			return $items;
		}

	}

	//запрос пользователей
	function get_users() {
		return JBase::Get_Limit('my_users', 'id', 'name', 50);
	}
	//запрос пользователей
	function get_raions() {
		$city = (int)$_POST['city'];
		$Result = DB::Get_Data_ND('raions', '*', ['city' => $city], 'name');				
		if (!empty($Result)) {
			$items = [];
			while ($item = $Result->fetch_assoc()) 
				$items[$item['domain']][] = $item;
			return $items;
		}
	}
	//категории
	function get_category() {
		return JBase::Get_Limit('list_table', 'domain_id', 'title', 50);
	}
	//настройки оформления
	function colors() {
		if (!empty($_POST['params'])) {
			return JBase::Update_Data('colors', ['hash' => $_POST['params'][1]], ['name' => $_POST['params'][0]]);
		}
	}
	
	//настройки оформления
	function getFace() {
		
		if (!empty($_POST['param'])) {
			switch ($_POST['param']) {
				case 'get':
					$result = [];
					$Result = JBase::Get_Data('templates', ['mobile','animate','view'], '');
					if ($Result) {
						while ($param = $Result->fetch_assoc()) {
							$result['mobile']['Мобильная версия'] = $param['mobile'];
							$result['animate']['Динамический фон'] = $param['animate'];
							$result['view']['Вид карточек плиткой'] = $param['view'];
						}
						
						//получаем root css
						$css = JBase::Get_Limit('mod_menu_css', 'id', 'css', '1');
						$css = array_values($css)[0];
						$sccArr = self::breakCSS($css);

						$result['bg']['Фоновое изображение'] = ($sccArr['--bg']) ?: false;
						$result['bglogo']['Логотип'] = ($sccArr['--bglogo']) ?: false;
						$result['color']['Оттенок сайта'] = ($sccArr['--color']) ?: false;
						$result['deg']['Цвет иконок'] = ($sccArr['--deg']) ?: false;
						$result['font']['Шрифт'] = ($sccArr['--font']) ?: false;
						
						return json_encode($result);
					}
				break;
				case 'update':
					switch ($_POST['name'][0]) {
						case 'mobile':
						case 'animate':
						case 'view':
							$param = ($_POST['name'][1] == 'true') ? 1 : 0;
							JBase::Update_Data('templates', [$_POST['name'][0] => (int)$param], '');
							return $param;
						break;
						case 'bg':
						case 'bglogo':
						case 'color':
						case 'deg':
						case 'font':
							//получаем root css
							$cssOrig = JBase::Get_Limit('mod_menu_css', 'id', 'css', '1');
							
							$css = array_values($cssOrig)[0];
							$sccArr = self::breakCSS($css);
							$name = '--'. $_POST['name'][0];

							if ($name == '--bglogo') {
	  						$template = JBase::Get_Field_Value_From_Domain('templates', 'template');
								if ($template == 'moscow' || $template == 'tokyo' || $template == 'london') {
	  							$text = JBase::Get_Field_Value_From_Domain_Id('article', '1', 'content');
	  							$text = str_replace($sccArr[$name], $_POST['name'][1], $text);
	  							$text_update 	= "content='". $text ."'";
	  							JBase::Update_Field_Value_From_Domain_Id('article', '1', $text_update);
	  						}
	  						if ($template == 'madrid') {
	  							$text = JBase::Get_Field_Value_From_Domain_Id('article', '53', 'content');
	  							$text = str_replace($sccArr[$name], $_POST['name'][1], $text);
	  							$text_update 	= "content='". $text ."'";
	  							JBase::Update_Field_Value_From_Domain_Id('article', '53', $text_update);
	  						}
	  					}
	  					
							$css = str_replace($sccArr[$name], $_POST['name'][1], $css);
							JBase::Update_Data('mod_menu_css', ['css' => $css], ['id' => array_keys($cssOrig)[0]]);
							
							CCSS::pagecssjs('css', array_keys($cssOrig)[0]);
							JBase::Update_Data('templates', ['version' => time()], '');
							
							return true;
						break;
					}
				break;
			}
		} 
	}
	//парсинг css
	function breakCSS($css) {
		
		$results = [];
		$css = preg_replace("/\r\n|\r|\n/", '', $css); //удаляем переносы строк
		$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css); //удаляем комментарии

		preg_match_all("/(.+?)\s?\{\s?(.+?)\s?\}/", $css, $matches);
		foreach($matches[1] AS $i => $original) {
			if ($i == ':root') {
				foreach(explode(';', $matches[2][$i]) AS $attr) {
					if (strlen($attr) > 0) {
						list($name, $value) = explode(':', $attr, 2);
						$results[$matches[1][$i]][trim($name)] = trim($value);
					}
				}
			}
		}   
		return $results[':root'];
	}
	
	//календарь - запрос содержимого по юзеру
	function get_calendar() {
		$items = [];
		if ( userType(CUser::user(TOKEN)) != '1' ) $res = JBase::Get_Data('calendar', '*', ['user' => (int)$_POST['user'], 'on' => '1']);
		if ( userType(CUser::user(TOKEN)) == '1' ) $res = JBase::Get_Data('calendar', '*', ['on' => '1']);
		if ($res) {
			while ($param = $res->fetch_assoc()) {
				$items[] = $param;
			}
		}  
		return $items;
	}
	//календарь - запрос содержимого по объявлению
	function get_calendar_ad() {
		$items = [];
		$res = JBase::Get_Data('calendar', '*', ['item' => (int)$_POST['item'], 'list' => (int)$_POST['list']]);
		if ($res) {
			while ($param = $res->fetch_assoc()) {
				$items[] = $param;
			}
		}  
		return $items;
	}
	//динамические настройки
	function getSettings() {

			$items = [];
			$res = JBase::Get_Data('settings', ['id','comment','value'], '', 'id');
			if ($res) {
				while ($param = $res->fetch_assoc()) {
					$items[$param['id']] = $param;
				}
			} 
			return $items;
	}
	//Antispam
	function antispam() {

			$items = [];
			$res = JBase::Get_Data('antispam', ['id','comment','value'], '', 'id');
			if ($res) {
				while ($param = $res->fetch_assoc()) {
					$items[$param['id']] = $param;
				}
			} 
			return $items;
	}
	//getSms
	function getSms() {

			$items = [];
			$res = JBase::Get_Data('list5', ['id','name','f1557931993n'], '', 'id');
			if ($res) {
				while ($param = $res->fetch_assoc()) {
					$items[$param['id']] = [
						'id' => $param['id'],
						'comment' => $param['name'],
						'value' => $param['f1557931993n']
					];
				}
			} 
			return $items;
	}
	
	
	//календарь - новая запись
	function new_calendar() {
	
	   if ($_POST['param'][0] == 'Встреча') $bg = ['#adcbe6','#7097bd','#4a4a4a'];
	   if ($_POST['param'][0] == 'Звонок') $bg = ['#e6adad','#e6adad','#4a4a4a'];
	   if ($_POST['param'][0] == 'Показ') $bg = ['#ade6ad','#83bd70','#4a4a4a'];
	   
		$Name  = [
			'on',
			'user',
			'list',
			'item',
			'start',
			'title',
			'backgroundColor',
			'borderColor',
			'textColor',
			'domain'
		];
		$Value = [
			'1',
			USERID,
			$_POST['list'],
			$_POST['item'],
			strtotime($_POST['param'][1]),
			JBase::escape($_POST['param'][0]),
			$bg[0],
			$bg[1],
			$bg[2],
			DOMAIN
		];	
		return JBase::Set_Data('calendar', $Name, $Value);
	}
	//календарь - обновление содержимого по id
	function update_calendar() {
		$Value = [
			'start' => JBase::escape( $_POST['start'] ),
			'title' => JBase::escape( $_POST['title'] ),		
			'allday' => JBase::escape( $_POST['allday'] ),
			'textColor' => JBase::escape( $_POST['textColor'] ),
			'borderColor' => JBase::escape( $_POST['borderColor'] ),
			'description' => JBase::escape( $_POST['description'] ),
			'backgroundColor' => JBase::escape( $_POST['backgroundColor'] )
		];
		$Value = array_filter($Value);
		return JBase::Update_Data('calendar', $Value, ['user' => (int)$_POST['user'], 'id' => (int)$_POST['id']]);
	}
	//Комментарий к объекту - добавление/обновление содержимого
	function writecontainersave() {
		$name = JBase::escape($_POST['name']);
		$phone = JBase::escape($_POST['phone']);
		$desc = JBase::escape($_POST['description']);
		if ( userType(CUser::user(TOKEN)) == '1' ) {
			return JBase::Update_Data('comment', ['time' => time(), 'description' => $desc, 'name' => $name, 'phone' => $phone], ['item' => (int)$_POST['item'], 'list' => (int)$_POST['list']]);
		} else return JBase::Update_Data('comment', ['time' => time(), 'description' => $desc, 'name' => $name, 'phone' => $phone], ['item' => (int)$_POST['item'], 'list' => (int)$_POST['list'], 'user' => (int)USERID]);
	} 
	//Комментарий к объекту - запрос содержимого
	function writecontainer() {
		$list = (int)$_POST['list'];
		$item = (int)$_POST['item'];
		
		//проверка, существует ли запись
		$Result = JBase::Query('SELECT 1 FROM `comment` WHERE `list` = "'. $list .'" AND `item` = "'. $item .'"');
		$access_allowed = false;
		while( $access_try = $Result->fetch_assoc() ) {
			$access_allowed = true;
			break;
		}
		//$Result->free();
		
		//если не существует, значит запись будет добавлена
		if( !$access_allowed ) {
			$Name  = [
				'user',
				'time',
				'item',
				'list',
				'domain'
			];
			$Value = [
				USERID,
				time(),
				$item,
				$list,
				DOMAIN
			];  
			JBase::Set_Data('comment', $Name, $Value);
			//запрашиваем description
			$res = JBase::Get_Data('comment', '*', ['item' => $item, 'list' => $list]);
			while ($param = $res->fetch_assoc()) 
				return $param;
		} else {
			if ( userType(CUser::user(TOKEN)) == '1' ) {
				$res = JBase::Get_Data('comment', '*', ['item' => $item, 'list' => $list]);
			} else $res = JBase::Get_Data('comment', '*', ['item' => $item, 'list' => $list, 'user' => (int)USERID]);
			while ($param = $res->fetch_assoc()) 
				return $param;
		}
	}
	 
	 
	function templates() {
		

		$all 			= (!empty($_POST['all'])) ? implode('_', array_unique(explode('_', $_POST['all']))) : false;
		$order 		= (!empty($_POST['order'])) ? (int)$_POST['order'] : 0;
		$serviceId 	= (!empty($_POST['serviceId'])) ? (int)$_POST['serviceId'] : 0;
		$values 		= (!empty($_POST['values'])) ? JBase::escape( $_POST['values'] ) : 0;
		$field 		= (!empty($_POST['field'])) ? JBase::escape( $_POST['field'] ) : 0;
		$name	 		= (!empty($_POST['name'])) ? JBase::escape( $_POST['name'] ) : '';
		$list 		= (int)$_POST['list'];
		$item 		= (int)$_POST['item'];
		$id 			= (int)$_POST['id'];
		$priceArr 	= array_filter($_POST['price']);
		
		switch ($_POST['type']) {
			case 'get':
				$res = JBase::Get_Data('list27', ['id','name'], ['status' => '1'], 'name');
				$Result = [];
				if (!empty($res)) {
					while ($param = $res->fetch_assoc()) 
					$Result[$param['id']] = $param['name'];
				}
				return $Result;
			break;
			case 'del':
				return JBase::Update_Data('template_services', ['on' => '0'], ['item' => $item, 'list' => $list, 'id' => $id]);
			break;
			case 'order':
				return JBase::Update_Data('template_services', ['order' => $order], ['item' => $item, 'list' => $list, 'id' => $id]);
			break;
			case 'save':				
				//если не существует, значит запись будет добавлена
				if( $id == 0 ) {
					$Key  = [
						'on',
						'list',
						'item',
						'name',
						'serviceId',
						'domain'
					];
					$Value = [
						'1',
						$list,
						$item,
						$name,
						$serviceId,
						DOMAIN
					];  
					return JBase::Set_Data('template_services', $Key, $Value);
				} else {
					JBase::Update_Data('template_services', [$field => $values, 'serviceId' => $serviceId, 'name' => $name], ['item' => $item, 'list' => $list, 'id' => $id]);
					if ($all) {
						sort($all);
						JBase::Update_Data('template_services', ['values' => $all], ['item' => $item, 'list' => $list, 'id' => $id]);
					}
					return true;
				}
			break;
			case 'show':
				$res = JBase::Get_Data('template_services', '*', ['item' => $item, 'list' => $list, 'on' => '1'], 'order');
				$Result = [];
				if (!empty($res)) {
					while ($param = $res->fetch_assoc()) 
					$Result[] = $param;
				}
				return $Result;
			break;
			case 'required':
				if ($_POST['required'] == (int)$_POST['required'])
					return JBase::Update_Data('template_services', ['required' => (int)$_POST['required']], ['item' => $item, 'list' => $list, 'id' => $id]);
			break;
			case 'getservice':
				$res = JBase::Get_Data('list28', ['id','name'], ['status' => '1', 'service' => $serviceId], 'name');
				$Result = [];
				if (!empty($res)) {
					while ($param = $res->fetch_assoc()) 
					$Result[$param['id']] = $param['name'];
				}
				return $Result;
			break;
		}
	}

}

