<?php 
namespace lib;
if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

/**
* class.CEditCat.php
*
*Класс - библиотека с функциями для работы модуля Каталог
*подгружается через автоподгрузку классов
*
* История:  2017.01.12 - файл создан
*
**/

class CEditCat {

    //добавление объявления
    function add1() {
	   
	   if (!isset($_POST['token']) && $_POST['token'] != TOKEN) return false;
	   $item_id = (int)($_POST['item_id']);
	   $list_id = (int)($_POST['list_id']);
	   $userType = userType(CUser::user(TOKEN));
	   $user = (int)USERID;
	   $domain = DOMAIN;
	   
	   $Names  = [];
	   $Values = [];
	   $fieldArray = $_POST['field']; 
		$status = (int)$fieldArray['status'];
	   
	   //защита от гостевого постинга
// 	   if ($user == '0') {
// 	   	$W = JBase::Query("SELECT `id` FROM `my_users` WHERE `domain` = '". $domain ."' AND `usertype` = '1' AND `username` != 'mail@mail.ru' LIMIT 1");
// 	   	while ($Where = $W->fetch_assoc()) {
// 		  	$WWW = $Where['id'];
// 				if ($WWW > 0) $user = $WWW;
// 	   	}
// 		}
		//шаблон
	 //$template = JBase::Get_Field_Value_From_Domain('templates', 'template');
	 
	   //проверка, существует ли запись
	   $item_id = (!empty($item_id) && self::checkWrite($list_id, $item_id, $user, $userType)) ? $item_id : '0';
	   
	   //перебор входного массива
	   foreach ($fieldArray as $key => $value) {
	   
			//удаляем пробелы в цене
			if ($key == 'price') $value = preg_replace('/\s+/', '', $value);

	   	//определение типа поля
			$type_field = JBase::Get_Type_Field(['table_field' => 'list'. $list_id, 'name_field' => $key]);
				
			//если поле selectmenu
			if ($type_field == 'selectmenu') {
    
			$to_json = [];
			$decoded = json_decode( $value, true );
			 
			if ($decoded !== false) {
				foreach( $decoded as $menu_id => $menu_title ) {
					$title = JBase::Get_Field_Value_From_Id('my_menu', $menu_id, 'title');
					$title = ($title != '') ? $title : JBase::Get_Field_Value_From_Id('modules', $menu_id, 'title');
					if ( !empty($title) ) {
					   $to_json[] = '"'.$menu_id.'":"'.$menu_title.'"';
						}
					}
				}
			 $value = '{'.implode( ',', $to_json ).'}';
		  }
		  
			array_push($Names, $key);
			array_push($Values, $value);
		}
		
		if( $item_id == '0' ) {
			$Names2 = array_merge($Names, ['id_user','time','status','domain']);
			$Values2 = array_merge($Values, [$user, time(), $status, $domain]);
			$Value45s2 = JBase::Set_Data('list'. $list_id, $Names2, $Values2);
			$id = JBase::$SqlID;

				//E-mail оповещения (разбираем строку вида 0_1_999, где 0 - автор, 1 -администратор, 999 - шаблон письма)
				//$emailparam = explode( '_', JBase::Get_Field_Value_From_Domain_Id( 'list_table', $list_id, 'email' ) );
				//отправка уведомления пользователю
				//if ( $emailparam[0] ) self::sendMailUser($user);
				//отправка уведомления администратору
				//if ( $emailparam[1]) self::sendMailAdmin($user, $list_id, $id, $emailparam);
	   	
	   } else {
			$id = $item_id;
	   	JBase::Update_Data('list'. $list_id, array_combine($Names, $Values), ['id' => $id]);
	   }
	   
	   //JBase::Update_Data('list'. $list_id, ['timeupdate' => time()], ['id' => $id]);

	   
  		//$moderation = JBase::Get_Field_Value_From_Domain_Id('list_table', $list_id, 'moderation');
		
// 		switch( $moderation ) {    
// 	   	case '1':
// 	   	case '2':
// 	   	case '3':
// 	   	case '4':
// 				JBase::Update_Data('list'. $list_id, ['status' => '0'], ['id' => $id]);
// 			break;   
// 	   	case '5':
// 				JBase::Update_Data('list'. $list_id, ['status' => '1'], ['id' => $id]);
// 			break;
// 		}
		
		if (in_array($list_id, ['14','15','16','17','18','19','20'])) {
	   	JBase::Get_All_Count();
		}
	   
	   
	   return $id;			
    }
    
    
    
    //проверка, существует ли запись
    function checkWrite($list_id, $item_id, $user, $userType) {
	   if ( $userType == '1' ) $Result = JBase::Query('SELECT 1 FROM `list'.$list_id.'` WHERE `id` = "'.$item_id.'"');
    	if ( $userType != '1' ) $Result = JBase::Query('SELECT 1 FROM `list'.$list_id.'` WHERE `id` = "'.$item_id.'" AND `id_user` = "'. $user .'"');
	   $access_allowed = false;
	   while( $access_try = $Result->fetch_assoc() ) {
		  $access_allowed = true;
		  break;
	   }
	   $Result->free();
		return $access_allowed;
    } 
    
    //отправка уведомления пользователю 
    function sendMailUser($user) {
    	$data['email'] = filter_var( JBase::Get_Field_Value_From_Id( 'my_users', $user, 'email' ), FILTER_VALIDATE_EMAIL );
		if ( ! $data['email'] ) $data['email'] = filter_var( JBase::Get_Field_Value_From_Id( 'my_users', $user, 'username' ), FILTER_VALIDATE_EMAIL );
		// Инициализация PHPMailer и отправка ИД шаблона и массива данных
		$mailsend = new MailSend( 'no-reply@1v1-crm.ru' );
		$result = $mailsend->MailSend( 8, $data );
    }
    
    //отправка уведомления администратору
    function sendMailAdmin($user, $list_id, $item_id, $emailparam) {
		
		
	   //инициализируем интерфейсы
	   require_once $_SERVER["DOCUMENT_ROOT"].'/lib.php';
	   load_interface( 'settings' );
	   $settings = &$GLOBALS['cotfw.settings'];
	   $emailadmin = $settings->val('pdd_main_mailbox');
	   
	   if ( $emailadmin ) {
			$Result2 = JBase::Get_Data('list'. $list_id, '*', ['id' => $item_id]);
			$list_item = [];
			while ($numrow2 = $Result2->fetch_assoc()) {
				$list_item = $numrow2;
			}
			
			//готовим массив для модерации через почту
			$item_info = [];
			$field_types_show = ['text' => true];
	   		   
			//запрашиваем название полей
			$q = JBase::Query("SELECT `name_field`,`caption`,`type_field` FROM `list_field` WHERE `table_field` = 'list" . $list_id . "'");
			while( @list($field_id, $field_caption, $field_type) = $q->fetch_row() ) {
				if( isset($list_item[$field_id]) && !empty($list_item[$field_id]) && $field_type !='system' )
					$item_info[] = [
						'key' => $field_caption,
						'value' => $list_item[$field_id]
					];
			}
			$q->free();
			 
			//перебираем массив: поле - значение
			foreach($item_info as $subArr) {
				$data['values'] .= "<p>".implode(': ', $subArr)."</p>";
			}
				
			//определяем получателя
			$data['email'] = $emailadmin;
			$data['list_id'] = $list_id;
			$data['item_id'] = $item_id;
				
			// Инициализация PHPMailer и отправка ИД шаблона и массива данных
			$mailsend = new MailSend( 'no-reply@1v1-crm.ru' );
			$result = $mailsend->MailSend( $emailparam[2], $data );
		}
	}
	
    //add.js изменение изображений
	function reSaveImg() {
		
		if (!empty($_POST['img'])) {
			
			$img = null;
			$img_name = null;
			$list = (int)($_POST['list']);
			$name = (int)($_POST['name']) .'.jpg';
			$data_url = $_POST['img'];
			
			//Разрешенные MIME-типы изображений
			$mime_types = ['image/png', 'image/jpeg', 'image/gif'];

			//Парсим data-url ("data:mime/type:base64,SomeLongBase64EncodedData")
			list($meta, $payload) = explode(';', $data_url, 2);
			list(, $mime_type) = explode(':', $meta, 2);
			list(, $data) = explode(',', $payload, 2);
				
			if (in_array($mime_type, $mime_types)) {			
				$data = base64_decode($data);
				$img = tempnam(sys_get_temp_dir(), 'php');

				if(is_writable($img)) {
					file_put_contents($img, $data);
					
					if ($img && is_readable($img)) {
						
						$error = false;
						
						try {
							//Обработка файла (ресайз и формат)
							$max_size = 960;
							$imagick = new \Imagick($img);
		
							if($imagick->getImageWidth() > $max_size || $imagick->getImageHeight() > $max_size) {
								$imagick->scaleImage($max_size, $max_size, true);
							}
		
							$imagick->setImageFormat('jpg');
							$imagick->writeImage($img);
							$imagick->clear();
							$imagick->destroy();
							
						} catch(\ImagickException $e) {
							$error = true;
						}
	
						if(!$error) {
							$destination_path = DOMAIN . DS . 'card' . DS . $list . DS . $name;
							
							$sftp = new LocalConnection();
							$path_parts = $sftp->SendFile($img, $destination_path, ['jpg']);
							return $path_parts;
							
						} else return json_encode(false);
					}
				} else return json_encode(false);
			}
		}
	}

    //add.js добавление изображений
	function AddFileAlbum() {
		//загружаем и инициализируем интерфейсы
		include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		load_interface( 'settings' );
		$dbsettings = &$GLOBALS['cotfw.settings'];
		$sftp = new LocalConnection();

		$data_url = $_POST['files_dataurl'];
		$img = null;
		$img_name = null;

		if (!empty($_FILES) || !empty($data_url)) {
			$idbase    = (int)($_POST['idbase']);
			$fieldid   = (int)($_POST['id']);
			$fieldName = JBase::escape($_POST['FieldName']);

			if (is_uploaded_file($_FILES['file']['tmp_name'])) {
				$img = $_FILES['file']['tmp_name'];
				$img_name = $_FILES['file']['name'];
				
			} elseif ($data_url) {
				// Разрешенные MIME-типы изображений
				$mime_types = array('image/png', 'image/jpeg', 'image/gif');

				// Парсим data-url
				list($meta, $payload) = explode(';', $data_url, 2);
				list(, $mime_type) = explode(':', $meta, 2);
				list(, $data) = explode(',', $payload, 2);
								
				if (in_array($mime_type, $mime_types)) {				
					$data = base64_decode($data);
					$img = tempnam(sys_get_temp_dir(), 'php');

					if(is_writable($img)) {
						file_put_contents($img, $data);
						$img_name = 'dataurl.jpg';
					} else {
						$img = null;
					}
				}
			}
			
			if ($img && is_readable($img)) {	   		
				$watermark 	= $dbsettings->val( 'watermark' );
				$error = false;

				try {
					$max_size = 960;
					$imagick = new \Imagick($img);

					if ($imagick->getImageWidth() > $max_size || $imagick->getImageHeight() > $max_size) {
						$imagick->scaleImage($max_size, $max_size, true);
					}

					$imagick->setImageBackgroundColor('#ffffff');
					$imagick = $imagick->flattenImages();
					$imagick->setImageFormat('jpg');
					$imagick->setImageCompressionQuality(95);
					if (isset($_POST['rotate']) && (int)($_POST['rotate']) == $_POST['rotate'] && (int)($_POST['rotate']) > 0) $imagick->rotateImage('white', '90'); // Rotate
					$imagick->writeImage($img);
					$imagick->clear();
					$imagick->destroy();
					
				} catch(\ImagickException $e) {
					$error = true;
				}

				if(!$error) {
					$destination_path = DOMAIN .'/card/'. $idbase . DS . $img_name;

					//!!!!!!!!!нужно сделать проверку на доступность файла
					if ( $watermark ) {
						$image = imagecreatefromjpeg($img);
						$logoImage = imagecreatefrompng($watermark);
						$imageWidth = imagesx($image);
						$imageHeight = imagesy($image);
						$logoWidth = imagesx($logoImage);
						$logoHeight = imagesy($logoImage);

						imagecopy(
							$image,
							$logoImage,
							$imageWidth-$logoWidth, 
							$imageHeight-$logoHeight,
							0, 0,
							$logoWidth, $logoHeight
						);

						//делаем фиктивное имя якобы загруженного файла
						imagejpeg($image, 'imgandwatermark.jpeg');
						$path_parts = $sftp->SendFile('imgandwatermark.jpeg', $destination_path, ['jpg','jpeg','png','JPG','JPEG','PNG']);
					} else {
						$path_parts = $sftp->SendFile($img, $destination_path, ['jpg','jpeg','png','JPG','JPEG','PNG']);
					}

					if(!isset($path_parts['error']) ) {
						$fieldValue = $path_parts['basename'];
						$id_user	= JBase::Get_Field_Value_From_Id('list' . $idbase, $fieldid, 'id_user');
						$BaseValue  = JBase::Get_Field_Value_From_Id('list' . $idbase, $fieldid, $fieldName);

						if (empty($BaseValue))
							$BaseValue = '{}';

						$BaseValueObj			  = json_decode($BaseValue);
						$BaseValueArr			  = (array) $BaseValueObj;
						$BaseValueArr[$path_parts['filename']]['img'] = $path_parts['basename'];
						$BaseValueStr			  = json_encode($BaseValueArr);
						JBase::Update_Data('list' . $idbase, [$fieldName => $BaseValueStr], ['id' => $fieldid]);

						echo $BaseValueStr;
					} else {
						echo json_encode(false);
					}
				} else {
					echo json_encode(false);
				}
			}
		}
		$Result2 = JBase::Get_Data('list'. $idbase, '*', ['id' => $fieldid]);
		if ($Result2) {
			while ($numrow2 = $Result2->fetch_assoc()) {
				$time = intval($numrow2['time']);
				if ($time <= 0) {
					$time = time();
					$timevalue = "time='" . $time . "'";
					JBase::Update_Field_Value_From_Id("list". $idbase, $fieldid, $timevalue);
				}
				
				//?????
				foreach ($numrow2 as $key => $value) {
					if ($key != 'domain' and $key != 'id_user' and $key != 'status')
						$response[$idbase]['list'][$key][$time] = htmlspecialchars_decode($value);
					if ($key == 'id_user')
						$response[$idbase]['user'][$key][$time] = $value;
				}
			}
		}
	}
	
	
	function getLiveInform($key) {
		$radios = JBase::escape($_POST['radios']);

		$fields = [
    	   'liveinform_id' 	=> $key,
    	   'radios' 			=> $radios,
    	   'api_id' 			=> '5sBrM9tE-P3HnxTBU-sm8NMlOO-86pM5flY'
		];
		return $fields;
		
		$curl = curl_init();
		curl_setopt_array($curl, [
		    CURLOPT_URL => "https://www.liveinform.ru/api/v2/edit/?" . http_build_query($fields),
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_RETURNTRANSFER => true
		]);
		
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}
	//getLiveInformTracking
	function getLiveInformTracking($tracking, $phone) {
		return $phone;
		
		$ch = curl_init("http://www.liveinform.ru/api/getinfo/");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
			"api_id" => "5sBrM9tE-P3HnxTBU-sm8NMlOO-86pM5flY",
			"phone" => '+79109971700',//$phone,
			"tracking" => '11175435210327'//$tracking
		));
		$body = curl_exec($ch);
		curl_close($ch);
		return $body;
		return self::getLiveInform($body);
	}
   //addLiveInform
	function addLiveInform() {
		if (!empty($_FILES)) {
			$csv = array_map('str_getcsv', file($_FILES['file']['tmp_name']));

			$res = [];
			foreach($csv as $key) {//+79109971700
				$res[$key[0]] = self::getLiveInformTracking($key[0], (isset($key[1]))?$key[1]:'');
			}
			//return $res;
			return json_encode($res, JSON_UNESCAPED_UNICODE);
		}
	}
   //addInExcel
	function addInExcel() {
		$user = (int)USERID;
	  	$domain = DOMAIN;
		$data =  $_POST['data'];
		$list = $_POST['list_id'];
//  		return $data; 
		$select = $_POST['select_value'];
		$select = array_diff($select, array('-1'));
		$fl_select = array_flip($select);
// 		$data = array_intersect_key($data,$fl_select);	
		foreach($data as $i => $value) {
		 		$data[$i] = array_intersect_key($data[$i],$fl_select);
		}
		$arr=[];
		$names=[];
		$values=[];
		$val_list=[];
		$val_list[0] = array();
		foreach($select as $aS => $value1) {
			array_push ( $names, $aS);
		}
		
// 		return $Name;
		if(is_numeric ($list)){
			$Names2 = array_merge($names, ['id_user','time','domain']);
			$Name = "(`" .implode("`,`", $Names2)."`)";
			foreach($data as $i => $value) {
			$data[$i] = array_intersect_key($data[$i],$fl_select);
// 			for ($i=0;$i<$data.length;$i++){
// 			return $data[$i];
			$q = "SELECT `statusgroup`, `id` FROM `list8` WHERE `name` = '".$data[$i][intval($list)]."'";
			$res = JBase::Query($q);
			if(!$res) return 'error with status';
			while ($row = mysqli_fetch_array($res)) {
				$listf = $row['statusgroup'];
				$list_id = $row['id'];
					
			}
			$data[$i][intval($list)] = $list_id;
			foreach($select as $aS => $value1) {
				array_push ( $values, $data[$i][$value1]);
			}
// 			return $values;
			$Values2 = array_merge($values, [$user, time(), $domain]);

			$val_list['list'.$listf] .= "('" .implode("','", $Values2)."'),";
			$values = [];
			array_push($arr,'list'.$listf);
			}
			for ($i = 0; $i < $arr; $i++) {
    			$q = "INSERT INTO `".$arr[$i]."`".$Name." VALUES " .substr($val_list[$arr[$i]], 0, -1). ";";
				$res = JBase::Query($q);
				JBase::Get_All_Count();
				return $res;
			}

			

			
		}
		 else {
		 	$list = 22;
		 	$Names2 = array_merge($names, ['id_user','time','status','domain']);
			$Name = "(`" .implode("`,`", $Names2)."`)";
		 	foreach($data as $i => $value) {
		 		$data[$i] = array_intersect_key($data[$i],$fl_select);
		 		foreach($select as $aS => $value1) {
					array_push ( $values, $data[$i][$value1]);
				}
				$Values2 = array_merge($values, [$user, time(), '1', $domain]);	
				$val .= "('" .implode("','", $Values2)."'),";
				$values = [];
			}
			$q = "INSERT INTO `list".$list."`".$Name." VALUES " .substr($val, 0, -1). ";";
			$res = JBase::Query($q);
			return $res;
		}
		return $Values2;
			
		
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
    
    //передача прав на редактирование
    function forwardCard() {
	   if (!empty($_POST['forwardArr'])) {
	   	$list = 'list'. (int)$_POST['forwardArr'][0]['IDbase'];
	   	if ( userType(CUser::user(TOKEN)) == '1' ) {
	   		JBase::Update_Data($list, ['id_user' => (int)$_POST['forwardArr'][0]['User']], ['id' => (int)$_POST['forwardArr'][0]['ID']]);
	   		JBase::Update_Data('comment', ['user' => (int)$_POST['forwardArr'][0]['User']], ['list' => (int)$_POST['forwardArr'][0]['IDbase'], 'item' => (int)$_POST['forwardArr'][0]['ID']]);
		  }
	   	if ( $_POST['forwardArr'][0]['IDbase'] == '17' ) {
	   		JBase::Update_Data('calendar', ['user' => (int)$_POST['forwardArr'][0]['User']], ['list' => '17', 'item' => (int)$_POST['forwardArr'][0]['ID']]);
	   		JBase::Update_Data('comment', ['user' => (int)$_POST['forwardArr'][0]['User']], ['list' => '17', 'item' => (int)$_POST['forwardArr'][0]['ID']]);
	   	}
	   }
    }
    
    //кнопка удаления объявления
    function deleteCard() {
	   if (!empty($_POST['dellArr'])) {
	   	$list = 'list'. (int)$_POST['dellArr'][0]['IDbase'];
	   	if ( userType(CUser::user(TOKEN)) == '1' ) {
	   		JBase::Update_Data($list, ['status' => '0', 'timeupdate' => time()], ['id' => (int)$_POST['dellArr'][0]['ID']]);
		  } else {
	   		JBase::Update_Data($list, ['status' => '0', 'timeupdate' => time()], ['id' => (int)$_POST['dellArr'][0]['ID'], 'id_user' => USERID]);
	   	}
	   }
    }
    
    //кнопка публикации объявления
    function publicCard() {
	   if (!empty($_POST['publicArr'])) {
	   	$list = 'list'. (int)$_POST['publicArr'][0]['IDbase'];
	   	if ( userType(CUser::user(TOKEN)) == '1' ) {
	   		JBase::Update_Data($list, ['status' => '1', 'timeupdate' => time()], ['id' => (int)$_POST['publicArr'][0]['ID']]);
		  } else {
	   		JBase::Update_Data($list, ['status' => '1', 'timeupdate' => time()], ['id' => (int)$_POST['publicArr'][0]['ID'], 'id_user' => USERID]);
	   	}
	   	if ( $_POST['publicArr'][0]['IDbase'] == '17' )
	   		JBase::Update_Data('calendar', ['on' => '1'], ['list' => (int)$_POST['publicArr'][0]['IDbase'], 'item' => (int)$_POST['publicArr'][0]['ID']]);
	   }
    }
    
    //кнопка снятия объявления с публикации
    function republicCard() {
	   if (!empty($_POST['republicArr'])) {
	   	$list = 'list'. (int)$_POST['republicArr'][0]['IDbase'];
	   	if ( userType(CUser::user(TOKEN)) == '1' ) {
	   		JBase::Update_Data($list, ['status' => '3'], ['id' => (int)$_POST['republicArr'][0]['ID']]);
		  } else {
	   		JBase::Update_Data($list, ['status' => '3'], ['id' => (int)$_POST['republicArr'][0]['ID'], 'id_user' => USERID]);
	   	}
	   	if ( $_POST['republicArr'][0]['IDbase'] == '17' )
	   		JBase::Update_Data('calendar', ['on' => '0'], ['list' => (int)$_POST['republicArr'][0]['IDbase'], 'item' => (int)$_POST['republicArr'][0]['ID']]);
	   }
    }
    
    //кнопка применить премиум услугу
    function premiumCard() {
		
	   if (!empty($_POST['premiumArr'])) {
	   	$premium = (int) $_POST['premiumArr'][0]['Type'];
	   	
	   	if ( userType(CUser::user(TOKEN)) == '1' ) {
	   		$list = 'list'. (int)$_POST['premiumArr'][0]['IDbase'];
	   		JBase::Update_Data($list, ['premium' => $premium, 'timeupdate' => time()], ['id' => (int)$_POST['premiumArr'][0]['ID']]);
	   		return 'Выполнено';	
	   		
		  } else {
	   		//загружаем и инициализируем интерфейсы
				include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
				load_interface( 'settings' );
				$dbsettings = &$GLOBALS['cotfw.settings'];
				
				//определяем переменные
				$balance1 	= $dbsettings->val( 'premium_color' );
				$balance2 	= $dbsettings->val( 'premium_left' );
	   
		  	if ( $premium === 0 ) $balance = '0';
		  	if ( $premium === 1 ) $balance = $balance1;
		  	if ( $premium === 2 ) $balance = $balance2;
		  	
	   		$balanceUser = JBase::Get_Field_Value_From_Id('my_users', USERID, 'balance');
		  	//если достаточно средств
	   		if ( $balanceUser >= $balance ) {
	   			$list = 'list'. (int)$_POST['premiumArr'][0]['IDbase'];
	   			JBase::Update_Data($list, ['premium' => $premium, 'timeupdate' => time()], ['id' => (int)$_POST['premiumArr'][0]['ID'], 'id_user' => USERID]);
	   			JBase::Update_Data('my_users', ['balance' => $balanceUser - $balance], ['id' => USERID]);
	   			return 'Выполнено';	
	   		} else {
		  	    return 'Недостаточно средств';
		  	}
		  }
	   }
    }

	//выдача карточек каталога
	function listing() {
    
		require_once $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		$list_id 	= (!empty($_POST['list_id'])) ? (int)( $_POST['list_id'] ) : false;
	   
		$item_id 	= (!empty($_POST['item_id'])) ? (int)( $_POST['item_id'] ) : false;
		$page_id 	= (!empty($_POST['page_id'])) ? JBase::escape( $_POST['page_id'] ) : false;
		
		$user_id 	= (!empty($_POST['user_id'])) ? JBase::escape( $_POST['user_id'] ) : false;
		$raions	 	= (!empty($_POST['raions']) && $_POST['raions'] != 'Все районы' && $_POST['raions'] != 'undefined' && $_POST['raions'] != 'all') ? JBase::escape( $_POST['raions'] ) : false;
		$feeds	 	= (!empty($_POST['feeds']) && in_array($_POST['feeds'], ['all','cian','avito','yandex','domclick','n1'])) ? $_POST['feeds'] : false;
		$status	 	= JBase::escape( $_POST['status'] );

		//пагинация
		$count 		= (!empty($_POST['count'])) ? (int)( $_POST['count'] ) : null;
		$offset 		= (!empty($_POST['offset'])) ? (int)( $_POST['offset'] ) : 0;
		$pagination = (!empty($_POST['pagination'])) ? true : false;
	   
		//поиск по форме поиска
		$search 		= (!empty($_POST['search'])) ? json_decode( $_POST['search'], true ) : false;
		
		//поиск похожих объявлений
		$similar 	= (!empty($_POST['similar'])) ? JBase::escape( $_POST['similar'] ) : false;
	   
		//выборка по условиям: текстовый поиск, по цене, по типу пользователей
		$text 		= (!empty($_POST['text'])) ? JBase::escape( $_POST['text'] ) : false;
		$usertypes 	= (!empty($_POST['usertype'])) ? JBase::escape( $_POST['usertype'] ) : 'all';
		$query 		= [];
	   
		//where
		$where 		= 'list' .$list_id. '.domain = "'.DOMAIN.'" ';
    	if ( $list_id == 26 ) $where = 'list' .$list_id. '.domain = "nodomain" ';
    	
    	//поиск по карточкам пользователя
    	//if ( $user_id != 0 ) $where .= " AND list" .$list_id. ".id_user = '" . $user_id . "'";
    	
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
		$list = 'list'. $list_id;
		$l = JBase::Get_Data('list_field', ['name_field','param'], ['table_field' => $list, 'type_field' => 'select']);
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
    	$orderby = '';
		$price = JBase::escape( $_POST['price'] );
		switch( $price ) {    
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
		
		
		
		$json = &$GLOBALS['JSON'];
		switch( $_POST['method'] ) {    
			case 'get':
				$json['result'] = [];  
				if (isset($status) && $status != false) {  
					if ((int)$status > 0) {    
						$where .= " AND list" .$list_id. ".status = '". (int)$status ."'";
					} else {  
						$where .= " AND list" .$list_id. ".status = '1'";
					}
				}
				
			 //выборка карточки по id
			 if( $item_id ) {
				 $where .= ' AND list' .$list_id. '.id = "'. $item_id  .'" ';
			 }
    			//выборка карточки по району
			 if( $raions ) {
				 $where .= " AND list". $list_id .".yandexfield  LIKE '%". $raions ."%' ";
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
				if( $similar ) $where .= " AND `names` LIKE '%" . $similar . "%' ";

				$json['result'] = [];
				$q = 'SELECT list' .$list_id. '.*, my_users.id, my_users.name as operatorName, my_users.avatar, my_users.usertype, list' .$list_id. '.id AS ids
			 						 FROM list' .$list_id. '
			 						 LEFT JOIN my_users
			 						 ON list' .$list_id. '.id_user = my_users.id
			 						 WHERE ' .$where. '
			 						 ORDER BY ' .$orderby. ' 
			  						 LIMIT ' .$count. ' 
			  						 OFFSET ' .$offset. '';
				//var_dump($q);
				$Result = JBase::Query($q);

				if ($Result) {
					$granted = self::unsetsGranted($list_id);
					while( $adv = $Result->fetch_assoc() ) {
						//перебираем массив выдачи и заменяем значения полей select
						foreach ($l2 as $keyl2 => $valuel2) {
							$adv[$keyl2] = [$adv[$keyl2] => $valuel2['vals'][$adv[$keyl2]]];
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
}

