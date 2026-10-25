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

// require './vendor/autoload.php';
// 
// use Google\Cloud\TextToSpeech\V1\AudioConfig;
// use Google\Cloud\TextToSpeech\V1\AudioEncoding;
// use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
// use Google\Cloud\TextToSpeech\V1\SynthesisInput;
// use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
// use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

class CEditCat {

    //добавление объявления
    function add1() {
	   
	   if (!isset($_POST['token']) && $_POST['token'] != TOKEN) return false;
	   $list_id = (int)($_POST['list_id']);
	   if ($list_id > 0 && in_array($list_id, [14,15,16,17,18,19,20])) return self::addSale();
	   
	   $userType = (int)userType(CUser::user(TOKEN));
	   $user = (int)USERID;
	   $domain = DOMAIN;
	   
	   $Names  = [];
	   $Values = [];
	   $fieldArray = array_filter($_POST['field']); //фильтруем 

	   //проверка, существует ли запись
	   $item_id = (int)($_POST['item_id']);
	   $item_id = (($item_id > 0) && self::checkWrite($list_id, $item_id, $user)) ? $item_id : 0;
	   
	   //перебор входного массива
	   foreach ($fieldArray as $key => $value) {
			//дополняем данными перед попаданием в базу
			switch ($key) {
				case 'price':
					$value = preg_replace('/\s+/', '', $value); //удаляем пробелы в цене
				break;
			}

			array_push($Names, $key);
			array_push($Values, $value);
		}
		
		$result = array_filter(array_combine($Names, $Values));
		
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
	   
	   if (!isset($_POST['token']) && $_POST['token'] != TOKEN) return false;
	   if (!isset($_POST['item_id']) || (int)$_POST['item_id'] == 0) return false;
	   
	   $userType 	= (int)userType(CUser::user(TOKEN));
	   $item_id 	= (int)($_POST['item_id']);
	   $list_id 	= (int)($_POST['list_id']);
	   $user 		= USERID;
	   $domain 		= DOMAIN;
	   $Names  		= [];
	   $Values 		= [];
	   
	   $fieldArray = array_filter($_POST['field']); 
		$status0 	= (isset($fieldArray['status'])) ? (int)$fieldArray['status'] : 1;

	   //проверка, существует ли запись
	   $status = self::checkWrite($list_id, $item_id, $user);
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
 				case 'id_user':
 				case 'operator':
 					$key = 'id_user';
 				break;
 				case 'robot':
 					//if ($item_id == '0') //CronRobot::generateParts($id); //генерация шаблона для прозвона
 				break;
 			}	
		  
			array_push($Names, $key);
			array_push($Values, $value);
		}
		
   	JBase::Update_Data('list'. $list_id, array_combine($Names, $Values), ['id' => $item_id]);
   	JBase::Get_All_Count();
   	
	   return $item_id;			
    }
    
	//проверка, существует ли запись
	function checkWrite($list_id, $item_id, $user_id) {
	   $access_allowed = false;

   	if (!in_array($list_id, [14,15,16,17,18,19,20])) {
  			$Result = JBase::Query('SELECT 1 FROM `list'. $list_id .'` WHERE `id` = "'. $item_id .'" AND `id_user` = "'. $user_id .'"');
  		} else {
  			foreach ([14,15,16,17,18,19,20] as $list) {
  				$Result = JBase::Query("SELECT 1 FROM `list". $list ."` WHERE `id` = '". $item_id ."'");
    			if ($Result) {
					while ($row = $Result->fetch_assoc()) {
						$access_allowed = (int)$row['status'];
					}
    				break;
    			}
    		}
	   }
	   $Result->free();
		return $access_allowed;
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

				if (is_writable($img)) {
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

	//
	function newOrder() {
	
		$ex_count =  (int)$_POST['ex_count'];
		//$res = JBase::Query("SELECT count(id) as b1 FROM list17  WHERE status = 1 OR status = 0;");
		$res = JBase::Query("SELECT count(id) as b1 FROM list17  WHERE status = 1");
		
		$count = 0;
		while ($row = mysqli_fetch_array($res)) {
			$count = (int)$row['b1'];
		}
		JBase::Get_All_Count();
		return (int)$count;
	}
   
   //addInExcel
	function addInExcel() {
		
		$user = (int)USERID;
	  	$domain = DOMAIN;
		$data =  $_POST['data'];
		$list = $_POST['list_id'];
		$select = $_POST['select_value'];
		
		$valid = array('approvedAt','shippedAt','canceledAt','buyoutAt','refundedAt');
		$goods = array('goods_names');
		
		//$select = {"ID":"1","name":"19","status":"2","price":"10","agree_personal":"-1","agree_terms":"-1","category":"-1","goods_names":"20","domain2":"74","approvedAt":"69","shippedAt":"70","canceledAt":"71","buyoutAt":"72","refundedAt":"73","comment":"22","log_robot":"-1","all":"11","time_call":"-1","attempts":"-1","group_time_call":"-1","russianpostTrack":"49","russianpostStatus":"50","count":"23","postIndex":"13","region":"14","city":"15","address":"16","house":"17","flat":"18","phone":"20","lastSms":"66","smsStatus":"-1","lastVoiceSms":"67","lastVoiceStatus":"68","liveinformId":"-1","size":"-1","completely":"-1","weight":"-1","tag":"-1","source":"-1","ip":"77","referrer":"78","expend":"-1","externalId":"84","webmasterId":"85","dop1":"24","dop2":"25","dop3":"26","dop4":"27","dop5":"28","dop6":"29","dop7":"30","dop8":"31","dop9":"32","dop10":"34","timezone":"9","allBuyPrice":"65","developerPrice":"76","utm_source":"79","utm_medium":"80","utm_campaign":"81","utm_term":"82","utm_content":"83","total":"-1","email":"21","operator":"4","sms_template":"-1","f1562399916n":"-1"};
		$select = array_diff($select, array('-1'));
		$fl_select = array_flip($select);
		//$data = array_intersect_key($data,$fl_select);	
		
		foreach ($data as $i => $value) {
			$data[$i] = array_intersect_key($data[$i],$fl_select);
		}
		
		$arr = [];
		$names = [];
		$values = [];
		$val_list = [];
		$val_list[0] = [];
		
		foreach ($select as $aS => $value1) {
			array_push($names, $aS);
		}
		
		if (is_numeric ($list)) {
			$Names2 = array_merge($names, ['id_user','time','domain']);
			$Name = "(`" .implode("`,`", $Names2)."`)";
			
			foreach ($data as $i => $value) {
				$data[$i] = array_intersect_key($data[$i], $fl_select);
				$res = JBase::Query("SELECT `statusgroup`, `id` FROM `list8` WHERE `name` = '". $data[$i][intval($list)] ."'");
				if (!$res) return 'error with status';
				
				while ($row = mysqli_fetch_array($res)) {
					$listf = $row['statusgroup'];
					$list_id = $row['id'];
				}
				$data[$i][intval($list)] = $list_id;
			
				foreach ($select as $aS => $value1) {
					if (in_array($aS, $valid)) {
						$data[$i][$value1] = strtotime($data[$i][$value1]);
					}
					if (in_array($aS, ['domain'])) {
						$data[$i][$value1] = DOMAIN;
					}
					//если товары
					if (in_array($aS, $goods)) {

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
					array_push($values, $data[$i][$value1]);
				}

				$Values2 = array_merge($values, [$user, time(), $domain]);
				$val_list['list'.$listf] .= "('" .implode("','", $Values2)."'),";
				
				$values = [];
				array_push($arr,'list'.$listf);
			}
			
			for ($i = 0; $i < $arr; $i++) {
    			$q = "INSERT INTO `".$arr[$i]."`".$Name." VALUES " .substr($val_list[$arr[$i]], 0, -1). ";";
				$res = JBase::Query($q);
				if (!$res) {	
					return $q;
				}	
				return $res;
			}
		} else {
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
			return JBase::Query("INSERT INTO `list".$list."`".$Name." VALUES " .substr($val, 0, -1). ";");
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
//     function forwardCard() {
// 	   if (!empty($_POST['forwardArr'])) {
// 	   	$list = 'list'. (int)$_POST['forwardArr'][0]['IDbase'];
// 	   	if ( userType(CUser::user(TOKEN)) == '1' ) {
// 	   		JBase::Update_Data($list, ['id_user' => (int)$_POST['forwardArr'][0]['User']], ['id' => (int)$_POST['forwardArr'][0]['ID']]);
// 	   		JBase::Update_Data('comment', ['user' => (int)$_POST['forwardArr'][0]['User']], ['list' => (int)$_POST['forwardArr'][0]['IDbase'], 'item' => (int)$_POST['forwardArr'][0]['ID']]);
// 		  }
// 	   }
//     }
    
    //кнопка удаления объявления
//     function deleteCard() {
// 	   if (!empty($_POST['dellArr'])) {
// 	   	$list = 'list'. (int)$_POST['dellArr'][0]['IDbase'];
// 	   	if ( userType(CUser::user(TOKEN)) == '1' ) {
// 	   		JBase::Update_Data($list, ['status' => '0', 'timeupdate' => time()], ['id' => (int)$_POST['dellArr'][0]['ID']]);
// 		  } else {
// 	   		JBase::Update_Data($list, ['status' => '0', 'timeupdate' => time()], ['id' => (int)$_POST['dellArr'][0]['ID'], 'id_user' => USERID]);
// 	   	}
// 	   }
//     }
    
    //кнопка публикации объявления
//     function publicCard() {
// 	   if (!empty($_POST['publicArr'])) {
// 	   	$list = 'list'. (int)$_POST['publicArr'][0]['IDbase'];
// 	   	if ( userType(CUser::user(TOKEN)) == '1' ) {
// 	   		JBase::Update_Data($list, ['status' => '1', 'timeupdate' => time()], ['id' => (int)$_POST['publicArr'][0]['ID']]);
// 		  } else {
// 	   		JBase::Update_Data($list, ['status' => '1', 'timeupdate' => time()], ['id' => (int)$_POST['publicArr'][0]['ID'], 'id_user' => USERID]);
// 	   	}
// 	   }
//     }
    
    //кнопка снятия объявления с публикации
//     function republicCard() {
// 	   if (!empty($_POST['republicArr'])) {
// 	   	$list = 'list'. (int)$_POST['republicArr'][0]['IDbase'];
// 	   	if ( userType(CUser::user(TOKEN)) == '1' ) {
// 	   		JBase::Update_Data($list, ['status' => '3'], ['id' => (int)$_POST['republicArr'][0]['ID']]);
// 		  } else {
// 	   		JBase::Update_Data($list, ['status' => '3'], ['id' => (int)$_POST['republicArr'][0]['ID'], 'id_user' => USERID]);
// 	   	}
// 	   }
//     }
    
    //кнопка применить премиум услугу
//     function premiumCard() {
// 		
// 	   if (!empty($_POST['premiumArr'])) {
// 	   	$premium = (int) $_POST['premiumArr'][0]['Type'];
// 	   	
// 	   	if ( userType(CUser::user(TOKEN)) == '1' ) {
// 	   		$list = 'list'. (int)$_POST['premiumArr'][0]['IDbase'];
// 	   		JBase::Update_Data($list, ['premium' => $premium, 'timeupdate' => time()], ['id' => (int)$_POST['premiumArr'][0]['ID']]);
// 	   		return 'Выполнено';	
// 	   		
// 		  } else {
// 	   		//загружаем и инициализируем интерфейсы
// 				include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
// 				load_interface( 'settings' );
// 				$dbsettings = &$GLOBALS['cotfw.settings'];
// 				
// 				//определяем переменные
// 				$balance1 	= $dbsettings->val( 'premium_color' );
// 				$balance2 	= $dbsettings->val( 'premium_left' );
// 	   
// 		  	if ( $premium === 0 ) $balance = '0';
// 		  	if ( $premium === 1 ) $balance = $balance1;
// 		  	if ( $premium === 2 ) $balance = $balance2;
// 		  	
// 	   		$balanceUser = JBase::Get_Field_Value_From_Id('my_users', USERID, 'balance');
// 		  	//если достаточно средств
// 	   		if ( $balanceUser >= $balance ) {
// 	   			$list = 'list'. (int)$_POST['premiumArr'][0]['IDbase'];
// 	   			JBase::Update_Data($list, ['premium' => $premium, 'timeupdate' => time()], ['id' => (int)$_POST['premiumArr'][0]['ID'], 'id_user' => USERID]);
// 	   			JBase::Update_Data('my_users', ['balance' => $balanceUser - $balance], ['id' => USERID]);
// 	   			return 'Выполнено';	
// 	   		} else {
// 		  	    return 'Недостаточно средств';
// 		  	}
// 		  }
// 	   }
//     }

	//выдача карточек каталога
	function listing() {
    
		$list_id 	= (!empty($_POST['list_id'])) ? (int)( $_POST['list_id'] ) : false;
		if ($list_id == '99') return self::get_operator();
		$granted = []; //разрешенные поля
		require_once $_SERVER["DOCUMENT_ROOT"].'/lib.php';
// 	   $page			= (!empty($_POST['page'])) ? (int)$_POST['page'] : 'home';
// 	   if ((int)$page > 0 && in_array($list_id, ['14','15','16','17','18','19','20'])) switch( $page ) {    
// 			case 1: $where .= " AND list17.status = '" . $page . "'"; $list_id = 17; break; //Обработка - 17
// 			case 2: $where .= " AND list17.status = '" . $page . "'"; $list_id = 17; break; //НДЗ-Робот Дозвон - 17
// 			case 3: $where .= " AND list20.status = '" . $page . "'"; $list_id = 20; break; //ОКК - 20
// 			case 4: $where .= " AND list16.status = '" . $page . "'"; $list_id = 16; break; //Отменен - 16
// 			case 5: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //Отправлен по РФ - 19
// 			case 6: $where .= " AND list14.status = '" . $page . "'"; $list_id = 14; break; //Спам/ошибки/Консультация - 14
// 			case 7: $where .= " AND list20.status = '" . $page . "'"; $list_id = 20; break; //Оплачен - 20
// 			case 8: $where .= " AND list20.status = '" . $page . "'"; $list_id = 20; break; //Перевод - 20
// 			case 9: $where .= " AND list15.status = '" . $page . "'"; $list_id = 15; break; //Возврат - 15
// 			case 10: $where .= " AND list14.status = '" . $page . "'"; $list_id = 14; break; //Дубль - 14
// 			case 11: $where .= " AND list18.status = '" . $page . "'"; $list_id = 18; break; //Переданы на склад - 18
// 			case 12: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //Пришло на почту сегодня - 19
// 			case 13: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 1 - 19
// 			case 14: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 2 - 19
// 			case 15: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 3 - 19
// 			case 16: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 4 - 19
// 			case 17: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 5 - 19
// 			case 31: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 6 - 19
// 			case 18: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 7 - 19
// 			case 19: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 8 - 19
// 			case 20: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 9 - 19
// 			case 21: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 10 - 19
// 			case 22: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 11 - 19
// 			case 23: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 12 - 19
// 			case 24: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 13 - 19
// 			case 25: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 14 - 19
// 			case 26: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 15 - 19
// 			case 27: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День >15 - 19
// 			case 28: $where .= " AND list17.status = '" . $page . "'"; $list_id = 17; break; //НДЗ-Звонит Робот - 17
// 			case 29: $where .= " AND list17.status = '" . $page . "'"; $list_id = 17; break; //Думает/набрать позже - 17
// 			case 30: $where .= " AND list17.status = '" . $page . "'"; $list_id = 17; break; //Подтвержден [2 прозвон] - 17
// 			case 32: $where .= " AND list14.status = '" . $page . "'"; $list_id = 14; break; //Фрод - 14
// 			case 33: $where .= " AND list18.status = '" . $page . "'"; $list_id = 18; break; //Подтверждена отправка - 18
// 			case 34: $where .= " AND list14.status = '" . $page . "'"; $list_id = 14; break; //Жалобы на конкурентов - 14
// 			case 35: $where .= " AND list18.status = '" . $page . "'"; $list_id = 18; break; //Завести трек - 18
// 			case 36: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 4 [Дозвон] - 19
// 			case 37: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 5 [Дозвон] - 19
// 			case 38: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 6 [Дозвон] - 19
// 			case 39: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 7 [Дозвон] - 19
// 			case 40: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 8 [Дозвон] - 19
// 			case 41: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 9 [Дозвон] - 19
// 			case 42: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 10 [Дозвон] - 19
// 			case 43: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 11 [Дозвон] - 19
// 			case 44: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 12 [Дозвон] - 19
// 			case 45: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 13 [Дозвон] - 19
// 			case 46: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 14 [Дозвон] - 19
// 			case 47: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День 15 [Дозвон] - 19
// 			case 48: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //День >15 [Дозвон] - 19
// 			case 49: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //Уехали на почту - 19
// 			case 50: $where .= " AND list18.status = '" . $page . "'"; $list_id = 18; break; //Промежуточный - 18
// 			case 52: $where .= " AND list18.status = '" . $page . "'"; $list_id = 18; break; //Подтверждена отправка {Онлайн} - 18
// 			case 53: $where .= " AND list18.status = '" . $page . "'"; $list_id = 18; break; //Переданы на склад {Онлайн} - 18
// 			case 54: $where .= " AND list19.status = '" . $page . "'"; $list_id = 19; break; //Уехали на почту {Онлайн} - 19
// 			case 55: $where .= " AND list18.status = '" . $page . "'"; $list_id = 18; break; //Запасной - 18
// 			case 56: $where .= " AND list18.status = '" . $page . "'"; $list_id = 18; break; //Распечатать накладные {Н} - 18
// 			default:
// 			break;
// 		}
	   
		$item_id 	= (!empty($_POST['item_id'])) ? (int)( $_POST['item_id'] ) : false;
		$page_id 	= (!empty($_POST['page_id'])) ? JBase::escape( $_POST['page_id'] ) : false;
		
		$user_id 	= (!empty($_POST['user_id'])) ? JBase::escape( $_POST['user_id'] ) : false;
		$status	 	= JBase::escape( $_POST['status'] );

		//пагинация
		$pagination = (!empty($_POST['pagination'])) ? true : false;
		$order_by 	= (!empty($_POST['order_by'])) ? explode("-", JBase::escape($_POST['order_by'])) : JBase::escape($_POST['price']);
		$offset 		= (!empty($_POST['offset'])) ? (int)( $_POST['offset'] ) : 0;
		$count 		= (!empty($_POST['count'])) ? (int)( $_POST['count'] ) : null;
	   
		//поиск по форме поиска
		$search 		= (!empty($_POST['search'])) ? json_decode( $_POST['search'], true ) : false;
		
		//поиск похожих объявлений
		$similar 	= (!empty($_POST['similar'])) ? JBase::escape( $_POST['similar'] ) : false;
	   
		//выборка по условиям: текстовый поиск, по цене, по типу пользователей
		$text 		= (!empty($_POST['text'])) ? JBase::escape( $_POST['text'] ) : false;
		$usertypes 	= (!empty($_POST['usertype'])) ? JBase::escape( $_POST['usertype'] ) : 'all';
		$query 		= [];
	   
		//where
		$where 		= "list" .$list_id. ".domain = '". DOMAIN ."' ";
    	if ( $list_id == 26 ) $where = 'list' .$list_id. ".domain = 'nodomain' ";
    	
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
		  case 'new':
				$order .= ' '. $list .'.timeupdate DESC'; //новые сверху
				break;
			case 'bot':
				$order .= ' '. $list .'.price + 0 ASC'; //дешевые сверху
				break;
			case 'top':
				$order .= ' '. $list .'.price + 0 DESC'; //дорогие сверху
				break;
			case 'rand':
				$order .= ' RAND()'; //случайно
				break;
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
			 						 ORDER BY ' .$order. ' 
			  						 LIMIT ' .$count. ' 
			  						 OFFSET ' .$offset. '';
				//var_dump(json_encode($q), JSON_UNESCAPED_UNICODE);
				$Result = JBase::Query($q);

				if ($Result) {
					$granted = self::unsetsGranted($list_id);
					while( $adv = $Result->fetch_assoc() ) {
						//перебираем массив выдачи и заменяем значения полей select
						foreach ($l2 as $keyl2 => $valuel2) {
							if (isset($valuel2['vals'][$adv[$keyl2]])) $adv[$keyl2] = [$adv[$keyl2] => $valuel2['vals'][$adv[$keyl2]]];
						}  
						//$json['result'][] = $adv;
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

}

