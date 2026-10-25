<?php 
namespace lib;

if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

/**
* class.CUser.php
*
*Класс - библиотека с функциями для ответов ajax для работы с Пользователями
*подгружается через автоподгрузку классов
*
* История:  2016.12.12 - файл создан
*
**/


class CUser {
   
    //восстановление пароля
    function forgotPassword($Username) {

    	$id = JBase::Get_Id('my_users', ['email' => $Username]);
		if ( !$id ) $id = JBase::Get_Id('my_users', ['username' => $Username]);
		if ( $id ) {  
    
            //формируем новый пароль
            $new_pass = substr( str_shuffle( 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789' ), 0, 6 );
            $new_pass_crypted = strtoupper( md5( $new_pass ) );

			//заполнение массива данных дополнительными параметрами
			$user_info['email'] = JBase::escape($Username);
			$user_info['newpass'] = $new_pass;
			
			//инициализация PHPMailer и отправка ИД шаблона и массива данных
			$mailsend = new MailSend( 'no-reply@1v1-crm.ru' );
			$result = $mailsend->MailSend( 1, $user_info );
    
            if( $result ) {
                //обновляем пароль в базе данных
                JBase::Update_Data('my_users', ['password' => $new_pass_crypted], ['id' => $id]);
                return('2');
                
            } else return( $mailsend->ErrorInfo );
            
        } else return('3');
        
    }
	//регистрация пользователя
	function registerUser($Username) {

		if (filter_var($Username, FILTER_VALIDATE_EMAIL)) {
		
			$id = JBase::Get_Id('my_users', ['email' => $Username]);
			if ( !$id ) $id = JBase::Get_Id('my_users', ['username' => $Username]);
			if ( !$id ) {
			
        	    //формируем новый пароль
        	    $new_pass = substr( str_shuffle( 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789' ), 0, 6 );
        	    $new_pass_crypted = strtoupper( md5( $new_pass ) );
	
				//заполнение массива данных дополнительными параметрами
				$user_info['email'] = JBase::escape($Username);
				$user_info['newpass'] = $new_pass;
				
	        	$Name = [
	            	'password',
	            	'username',
	            	'email',
	            	'usertype',
	            	'status',
	            	'registerDate',
	            	'domain',
	            	'ipreg'
	        	];
	        	$Value = [
	            	$new_pass_crypted,
	        		$Username,
	           		$Username,
	        		'2',
	           		'1',
	        	    time(),
	        	    DOMAIN,
	        	    $_SERVER['REMOTE_ADDR']
	        	];    	
	            $register = JBase::Set_Data('my_users', $Name, $Value);
				
				if( $register ) {
	           	    
					//отправка письма пользователю шаблон #1
					$mailsend2 = new MailSend( 'no-reply@1v1-crm.ru' );
					$mailsend2->MailSend( 2, $user_info );
				
					// Инициализация PHPMailer и отправка ИД шаблона и массива данных
	        		include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
	        		load_interface( 'settings' );
	           		$settings	= &$GLOBALS['cotfw.settings'];
				
					//отправка письма админу шаблон #3
					$user_info['email'] = $settings->val('pdd_main_mailbox');
					$mailsend = new MailSend( 'no-reply@1v1-crm.ru' );
					$mailsend->MailSend( 3, $user_info );
					
	               	return('2');
	               	
	            } else return('5');
	            
	    	} else return('4');
	    
	    } else return('6');
	    	
	}
    //удаление пользователя из личного кабинета
    function deleteMe() {

		$id = JBase::Get_Id('my_users', ['id' => self::user(TOKEN), 'password' => JBase::escape($_POST['param'])]);
		if ( $id ) {
            
			// Инициализация PHPMailer и отправка ИД шаблона и массива данных
			//include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
			//load_interface( 'settings' );
            //$settings	= &$GLOBALS['cotfw.settings'];
			//$mailsend = new MailSend( $settings->val('pdd_main_mailbox') );
			//отправка письма пользователю
			//$mailsend->MailSend( 5, $user_info );
			
			//не удаляем пользователя, а блокируем
			JBase::Update_Data('my_users', ['status' => '0'], ['id' => self::user(TOKEN)]);
			foreach ($_COOKIE as $name => $value) {
				setcookie($name, '', time() - 3600); // ставим все cookie пустыми и просроченными
				unset($_COOKIE[$name]); // и забываем для себя
            }
            
			return 'Выполнено';
		} return 'Неверный пароль';
    }
	//запрос списка пользователей
	function getUsers() {
    	if ( userType(self::user(TOKEN)) == '1' ) {
			$tagsarr = ['id','name','email'];
        	$Result = JBase::Get_Data('my_users', $tagsarr);
        	$items = [];
			while ($item = $Result->fetch_assoc()) 
				$items[] = $item;
			return $items;
		}
	}
	//поиск пользователя по параметрам
    function findUser() {
    	if ( userType(self::user(TOKEN)) == '1' ) {
    	
        	$tagsarr = ['id','name','username','phone','email','status','usertype','registerDate','ipauth','time_test','balance','avatar','blocktext',
	            'ex',
	            'bl',
	            'tr',
	            'ch',
	            'st',
	            'go',
	            'ar',
	            'co',
	            'te',
	            'mp',
	            'se',
	            'li',
	            'hi'];
        	$Res = JBase::Get_Data('my_users', $tagsarr, [$_POST['param'][0] => $_POST['param'][1]]);
        	if (!empty($Res)) {
        		$item = $Res->fetch_assoc();
        		
        		//useragent
    		    $user_agent = JBase::Get_Data('session_users', ['user_agent'], ['user_id' => $item['id']]);
    		    if (!empty($user_agent)) { 
	    		    while ($agent = $user_agent->fetch_assoc()) 
        	    	    $get_browser = get_browser( $agent['user_agent'], true );
        	    	    
					if (!empty($get_browser)) {
						$item['device'] = $get_browser['device_type'];
						$item['system'] = $get_browser['platform'];	
						$item['browser'] = $get_browser['parent'];			
        	    	}
				}
        	}
        	if (empty($item)) $item['error'] = 'Такого пользователя не существует';
        	return json_encode($item);
        }
    }
    //сохранение пользователя если админ
    function saveUserAdmin() {
    	if ( userType(self::user(TOKEN)) == '1' ) {
    	
    		if ( $_POST['password'] != '' ) 
    			$password = strtoupper(md5( $_POST['password'] ));
    			$userName = explode("\n", $_POST['username']);
    			
    		if ( $_POST['id'] == '0' ) {
				if (count($userName) > 0) {
					foreach ($userName as $key => $value) {
						$Name = [
	         		   'password',
	         		   'username',
	         		   'name',
	         		   'job',
	         		   'email',
	         		   'phone',
	         		   'usertype',
	         		   'status',
	            		'registerDate',
	           			'domain',
	            		'ipreg',
	            		'ex',
	            		'bl',
	            		'tr',
	            		'ch',
	            		'st',
	            		'go',
	            		'ar',
	            		'co',
	            		'te',
	            		'mp',
	            		'se',
	            		'li',
	            		'hi'
	        			];
	        			$Value = [
	            		$password,
	        				$value,
	        				JBase::escape($_POST['name']),
	        				JBase::escape($_POST['job']),
	           			mb_strtolower(JBase::escape($_POST['email'])),
	           			JBase::escape($_POST['phone']),
	        				JBase::escape($_POST['usertype']),
	           			JBase::escape($_POST['status']),
	        	 			time(),
	        	 			DOMAIN,
	        	 			$_SERVER['REMOTE_ADDR'],
	            		($_POST['ex'] == 'true') ? 1 : 0,
	            		($_POST['bl'] == 'true') ? 1 : 0,
	            		($_POST['tr'] == 'true') ? 1 : 0,
	            		($_POST['ch'] == 'true') ? 1 : 0,
	            		($_POST['st'] == 'true') ? 1 : 0,
	            		($_POST['go'] == 'true') ? 1 : 0,
	            		($_POST['ar'] == 'true') ? 1 : 0,
	            		($_POST['co'] == 'true') ? 1 : 0,
	            		($_POST['te'] == 'true') ? 1 : 0,
	            		($_POST['mp'] == 'true') ? 1 : 0,
	            		($_POST['se'] == 'true') ? 1 : 0,
	            		($_POST['li'] == 'true') ? 1 : 0,
	            		($_POST['hi'] == 'true') ? 1 : 0
	        			]; 
	        			   	
	         		$register = JBase::Set_Data('my_users', $Name, $Value);
// 				if( $register ) {
// 					//отправка письма пользователю шаблон #2
// 					$user_info['newpass'] = $_POST['password'];
// 					$mailsend2 = new MailSend( 'no-reply@1v1-crm.ru' );
// 					$mailsend2->MailSend( 2, $user_info );            	
// 	         }
					}
					return true;
	            //return count(explode("\n", $_POST['username']));
	      	}  	
    		} else {

    			$param = [
    				"email" 		=> mb_strtolower(JBase::escape($_POST['email'])), 
    				"name" 		=> JBase::escape($_POST['name']),
    				"job" 		=> JBase::escape($_POST['job']),
    				"phone" 		=> JBase::escape($_POST['phone']),
    				"status" 	=> JBase::escape($_POST['status']),
    				"username" 	=> JBase::escape($_POST['username']),
    				"usertype" 	=> JBase::escape($_POST['usertype']),
    				"password" 	=> strtoupper(md5( $_POST['password'] )),
	            'ex'			=> ($_POST['ex'] == 'true') ? 1 : 0,
	            'bl'			=> ($_POST['bl'] == 'true') ? 1 : 0,
	            'tr'			=> ($_POST['tr'] == 'true') ? 1 : 0,
	            'ch'			=> ($_POST['ch'] == 'true') ? 1 : 0,
	            'st'			=> ($_POST['st'] == 'true') ? 1 : 0,
	            'go'			=> ($_POST['go'] == 'true') ? 1 : 0,
	            'ar'			=> ($_POST['ar'] == 'true') ? 1 : 0,
	            'co'			=> ($_POST['co'] == 'true') ? 1 : 0,
	            'te'			=> ($_POST['te'] == 'true') ? 1 : 0,
	            'mp'			=> ($_POST['mp'] == 'true') ? 1 : 0,
	            'se'			=> ($_POST['se'] == 'true') ? 1 : 0,
	            'li'			=> ($_POST['li'] == 'true') ? 1 : 0,
	            'hi'			=> ($_POST['hi'] == 'true') ? 1 : 0
    			];
    				
    			$param = array_filter( $param );
    			return JBase::Update_Data('my_users', $param, ['id' => (int)$_POST['id']]);
    			return json_encode($param);
    		}
		}
    }
    //сохранение пользователя если пользователь
    function saveMe() {
    	# $_POST['param'] = [id, value];
    	
    	if ($_POST['param'][0] == 'phone_user') {
    		if (!self::checkUser( $_POST['param'][1], 'phone' )) return 'Этот телефон принадлежит другому пользователю';
    		JBase::Update_Data('my_users', ['phone' => JBase::escape($_POST['param'][1])], ['id' => self::user(TOKEN)]);
    	}
    	if ($_POST['param'][0] == 'email_user') {
    		if (!self::checkUser( $_POST['param'][1], 'email' )) return 'Этот адрес принадлежит другому пользователю';
    		JBase::Update_Data('my_users', ['email' => JBase::escape($_POST['param'][1])], ['id' => self::user(TOKEN)]);
    	}
    	if ($_POST['param'][0] == 'login_user') {
    		if (!self::checkUser( $_POST['param'][1], 'username' )) return 'Этот логин принадлежит другому пользователю';
    		JBase::Update_Data('my_users', ['username' => JBase::escape($_POST['param'][1])], ['id' => self::user(TOKEN)]);
    	}
    	if ($_POST['param'][0] == 'name_user') {
    		if (!self::checkUser( $_POST['param'][1], 'name' )) return 'Это имя принадлежит другому пользователю';
    		JBase::Update_Data('my_users', ['name' => JBase::escape($_POST['param'][1])], ['id' => self::user(TOKEN)]);
    	}
    	return 'Выполнено';
    }
    
    //сохранение пользователя если пользователь
    function saveAll() {    	
    	if (isset($_POST['job']) && isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email'])) {
    		$values = [
    			'job' => JBase::escape($_POST['job']),
    			'name' => JBase::escape($_POST['name']),
    			'phone' => JBase::escape($_POST['phone']),
    			'email' => JBase::escape($_POST['email'])
    		];
    		JBase::Update_Data('my_users', $values, ['id' => self::user(TOKEN)]);
    		header("Location: /user");
    	}
    }		
				
	//изменение пароля
    function changePass() {
    	# $_POST['param'] = [old, new];
    	
		//получение id пользователя, которому производим изменения
   		$item = JBase::Get_Id('my_users', ['id' => self::user(TOKEN), 'password' => JBase::escape($_POST['param'][0])]);
   		if ((int)$item != 0) {
   			JBase::Update_Data('my_users', ['password' => JBase::escape($_POST['param'][1])], ['id' => self::user(TOKEN)]);
   			return 'Выполнено';
   		} else return 'Неверный пароль';	
    }
    //удаление аватара
    function removeAvatar() {
    	return JBase::Update_Data('my_users', ['avatar' => 'nophoto.png'], ['id' => self::user(TOKEN)]);
    } 
	//проверка пользователя
	function checkUser( $param, $name ) {
		$id = JBase::Get_Id('my_users', [$name => $param], self::user(TOKEN));
		if ( !$id ) return true;
		else return false;
	}

    //учетные данные в личном кабинете пользователя
    function getMe() {
    	$res = JBase::Get_Data('my_users', '*', ['id' => self::user(JLoads::$wad_md5)]);
        $item = $res->fetch_assoc();
        return $item;
    }

    //сессия пользователя 
    public static function user($token) {
        if (!empty($token)) {
            $res = JBase::Get_Data('session_users', 'user_id', ['rand_cod' => $token]);
            $user_id = $res->fetch_assoc();
            if (!empty($user_id['user_id'])) {
                return $user_id['user_id'];
            } else {
            	$res = JBase::Get_Data('session_users', 'user_id', ['wad_md5' => $token]);
            	$user_id = $res->fetch_assoc();
            	if (!empty($user_id['user_id'])) {
                    return $user_id['user_id'];
                } else {
                    return 'wadmin_' . $token;
                }
            }
        }
    }






    //учетные данные в личном кабинете пользователя
    function load_my() {
    	$res = JBase::Get_Data('my_users', '*', ['id' => self::user(TOKEN)]);
        $item = $res->fetch_assoc();
        return $item;
    }  
   
    //телефон пользователя
    function users_phones() {
        JBase::Get_Data('my_users', 'phone', ['id' => self::user(TOKEN)]);
        $res = $sql->fetch_assoc();
        return $res;
    }
	//save_logindata_cabinet
    function save_logindata_cabinet() {
    	
    	if ((!(self::check_login( $_POST['username'] ))) AND ( $_POST['username'] != '' )) return 'login';
    	if ( JBase::escape($_POST['password']) != '' ) $password = strtoupper(md5(JBase::escape($_POST['password'])));

    	$item = JBase::Get_Id('my_users', ['id' => self::user(TOKEN), 'password' => strtoupper( md5( $_POST['oldpassword'] ))]);
    	if ( (int)$item != 0 ) {
    	
    		$param = [
    			'username' => JBase::escape($_POST['username']),
    			'password' => $password
    		];
    		$param = array_diff( $param, [''] );
    		return JBase::Update_Data('my_users', $param, ['id' => self::user(TOKEN)]);
    	} 
    	else return 'wrong';
    }
    //load_avatar
    function load_avatar() {
		
		$sftp = new LocalConnection();
		$data_url = $_POST['avatar'];

		// Здесь будет храниться путь к изображению для загрузки
		$img = null;
		$img_name = null;

		if ( is_uploaded_file($_FILES['files']['tmp_name']) ) {
			$img = $_FILES['files']['tmp_name'];
			$img_name = $_FILES['files']['name'];

		} elseif ( $data_url ) {
			// Разрешенные MIME-типы изображений
			$mime_types = array('image/png', 'image/jpeg', 'image/gif');

			// Парсим data-url ("data:mime/type:base64,SomeLongBase64EncodedData")
			list($meta, $payload) = explode(';', $data_url, 2);
			list(, $mime_type) = explode(':', $meta, 2);
			list(, $data) = explode(',', $payload, 2);

			// Если такой mime-тип разрешен...
			if (in_array($mime_type, $mime_types)) {
				// ...расшифровываем данные изображения
				$data = base64_decode($data);

				// Создаем временный файл во временной папке
				$img = tempnam(sys_get_temp_dir(), 'php');

				if (is_writable($img)) {
					// Если он нормально создался - записываем в него данные
					file_put_contents($img, $data);

					// И делаем фиктивное имя якобы загруженного файла
					$img_name = 'dataurl.jpg';
				} else {
					$img = null;
				}
			}
		}
		
		if ( $img && is_readable($img) ) {
        	//определяем переменные
			$error = false;

			try {
				$max_size = 960;

				// Обработка файла (ресайз и формат)
				$imagick = new \Imagick($img);

				if($imagick->getImageWidth() > $max_size || $imagick->getImageHeight() > $max_size) {
					$imagick->scaleImage($max_size, $max_size, true);
				}

				$imagick->setImageFormat('jpg');
				$imagick->writeImage($img);
				$imagick->clear();
				$imagick->destroy();
			} catch (\ImagickException $e) {
				// Unable to load image
				$error = true;
			}

			if ( !$error ) {
				$destination_path = DOMAIN .'/avatar/'.  $img_name;
				$path_parts = $sftp->SendFile($img, $destination_path, ['jpg','jpeg','png','JPG','JPEG','PNG']);
			}
			JBase::Update_Data('my_users', ['avatar' => $path_parts['basename']], ['id' => self::user(TOKEN)]);
			return $path_parts['basename'];
    	}
    }
    //загрузка информации о пользователе в админке
    function load_user() {
        $tagsarr = ['username','phone','email','status','usertype'];
        $res = JBase::Get_Data('my_users', $tagsarr, [JBase::escape($_POST['option']) => JBase::escape($_POST['text'])]);
        if (!empty($res)) {
            $item = $res->fetch_assoc();
            if ($item != null) {
            	for ($i = 0; $i < count($tagsarr); $i++) {
             		if ($item[$tagsarr[$i]] == "") {
             			$item[$tagsarr[$i]] = "Не указано";
             		}
            	}
            }
        }
        if (empty($item)) {
            $item['error'] = 'Такого пользователя не существует';
        }
        return $item;
    }
    //удаление аватара
    function del_avatar(){
    	return JBase::Update_Data('my_users', ['avatar' => 'nophoto.png'], ['id' => self::user(TOKEN)]);
    } 
    //регистрация пользователя
    function registrs() {    
        $login = JBase::escape($_POST['login']);
        $pass  = JBase::escape($_POST['pass']);
    	$login  = mb_strtolower($login);
    
        if ( strlen($login) <= 3 )  return false;
    
        $user_type = '2'; //пользователь
        if( isset($_POST['type']) && $_POST['type'] == '3' )
            $user_type = '3'; //компания
    
        $newpass = strtoupper(md5($pass));
        
    	$Result = JBase::Get_Id('my_users', ['username' => $login]);
        if ((int)$Result == 0) {
        
        	$Name  = [
        	    'username',
        	    'email',
        	    'password',
        	    'usertype',
        	    'domain',
        	    'registerDate',
        	    'status',
        	    'ipreg'
        	];
        	$Value = [
        	    $login,
        	    $login,
        	    $newpass,
        	    $user_type,
        	    DOMAIN,
        	    time(),
        	    '1',
        	    $_SERVER['REMOTE_ADDR']
        	];
    	
            JBase::Set_Data('my_users', $Name, $Value);
            self::auth(JBase::$SqlID);
            
			$user_info['user_mail'] = $login; //для письма

			// Инициализация PHPMailer и отправка ИД шаблона и массива данных
        	include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
        	load_interface( 'settings' );
            $settings	= &$GLOBALS['cotfw.settings'];
			$mailsend = new MailSend( $settings->val('pdd_main_mailbox') );
			$mailsend->MailSend( 2, $user_info );
			//отправка письма админу шаблон #3
			$mailsend->MailSend( 3, $user_info );

            return true;
        }
        return false;
    }
    //авторизация пользователя
    function auth( $id ) {
            
        $user_agent = (!empty($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT']   : '0';
        $user_ip    = (!empty($_SERVER['REMOTE_ADDR']))     ? $_SERVER['REMOTE_ADDR']       : '0';
        $referer    = (!empty($_SERVER['HTTP_REFERER']))    ? $_SERVER['HTTP_REFERER']      :  '---';
        
        $Name = [
            'domain',
            'rand_cod',
            'user_id',
            'user_ip',
            'time',
            'user_agent',
            'wad_md5',
            'referer'
        ];
        $Value = [
            DOMAIN,
            JLoads::$rand_cod,
            $id,
            JBase::escape($user_ip),
            time(),
            JBase::escape($user_agent),
            JLoads::$wad_md5,
            JBase::escape($referer)
        ];
        
        JBase::Del_Data_Where('session_users', 'user_id', $id);
        return JBase::Set_Data('session_users', $Name, $Value);
    }
	// отписка от рассылки new
	function unsubscribeIt() {
		
		include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		load_interface( 'settings' );
		
    	// проверяем email или телефон
        $type = (preg_match('/@/', $_POST['text'])) ? 'email' : 'phone';
    	JBase::Set_Data('unsubscribe', [$type, 'time'], [$_POST['text'], time()]);
    	
    	//уведомление на почту
    	$settings	= &$GLOBALS['cotfw.settings'];
    	$mailsend = new MailSend( $settings->val('pdd_main_mailbox') );
		$user_info['email'] = $settings->val('pdd_main_mailbox');
		$user_info['user_mail'] = $_POST['text'];
		$mailsend->MailSend( 10, $user_info );
    	
    }
	//проверка на свободность email, login, phone , возвращает true  если данные никому не принадлежат
	function check_email( $mail ) {
		
    	$id = JBase::Get_Id('my_users', ['email' => $mail], self::user(TOKEN));
		if ( !$id ) $id = JBase::Get_Id('my_users', ['username' => $mail]);
		if ( !$id ) return true;
		else return false;
	}
	function check_login( $login ) {
		
		$id = JBase::Get_Id('my_users', ['username' => $login], self::user(TOKEN));
		if ( !$id ) return true;
		else return false;
	}
	function check_phone( $phone ) {
		
		$id = JBase::Get_Id('my_users', ['phone' => $phone], self::user(TOKEN));
		if ( !$id ) return true;
		else return false;
	}
	//отправляет смс с кодом подтверждения номера
	function phone_registr() {
		
		if (!(self::check_login($_POST['phone']))) return 'phone';
		
		include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		include_once $_SERVER["DOCUMENT_ROOT"].'/lib/class.CSms.php';
		
		load_interface( 'settings' );
		$settings = &$GLOBALS['cotfw.settings'];
		$SMS = new CSms( $settings->val('SMSRUapi_id') );
		
		$key = rand(1000, 9999);
		$data = (object)[
			'to' => '+7' . $_POST['phone'],
			'text' => 'Ваш код подтверждения:' . $key
		];
		
		$SMS = $SMS->send_one($data);
		if ($SMS->status == "OK") {
			$user_info = ["key" => md5($key), "phone" => $_POST['phone']];
			return $user_info;
		}
		else return 'error';
	}
	// окончательная регистрация и авторизация пользователя по номер телефона
	function phone_au() {

        $Name = [
            'password',
            'username',
            'usertype',
            'status',
            'registerDate',
            'domain',
            'ipreg'
        ];
        $Value = [
            substr( str_shuffle( 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789' ), 0, 6 ),
            $_POST['phone'],
            '2',
            '1',
            time(),
            DOMAIN,
            $_SERVER['REMOTE_ADDR']
        ];
    
        JBase::Set_Data('my_users', $Name, $Value);
        self::auth(JBase::$SqlID);
	}
	//vk_request
	function vk_request() {
		return file_get_contents($_GET['url']);
	}
	
	
	
	
	
	
	
	
    //регистрация через высылку контрольного писма на почту
	function emailRegister() {
		
		$Mail = JBase::escape($_POST['mail']);
		if (self::check_email($Mail)) {
		
			//инициализация PHPMailer и отправка ИД шаблона и массива данных
			include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
			load_interface( 'settings' );
            $settings	= &$GLOBALS['cotfw.settings'];
			$mailsend = new MailSend( $settings->val('pdd_main_mailbox') );
		
            //формируем новый пароль            
            $new_pass = substr( str_shuffle( 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789' ), 0, 6 );
    
			//заполнение массива данных дополнительными параметрами и отправка письма пользователю
			$user_info['email'] = $Mail;
			$user_info['newpass'] = $new_pass;			
			$result = $mailsend->MailSend( 1, $user_info );
            
            if( $result ) {
                // регистрируем юзера
        		$Name = [
            		'password',
            		'username',
            		'email',
            		'usertype',
            		'status',
            		'registerDate',
            		'domain',
            		'ipreg'
        		];
        		$Value = [
            		strtoupper(md5( $new_pass )),
            		$Mail,
            		$Mail,
            		'2',
            		'1',
        		    time(),
        		    DOMAIN,
        		    $_SERVER['REMOTE_ADDR']
        		];    	
                return JBase::Set_Data('my_users', $Name, $Value);
            }
    	}
    	else return false;
	}
    //восстановление пароля
    function repassmy() {

    	$id = JBase::Get_Id('my_users', ['email' => JBase::escape($_POST['Username'])]);
		if ( !$id ) $id = JBase::Get_Id('my_users', ['username' => JBase::escape($_POST['Username'])]);
		if ( $id ) {  
    
            // формируем новый пароль
            $new_pass = substr( str_shuffle( 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789' ), 0, 6 );
            $new_pass_crypted = strtoupper( md5( $new_pass ) );
    
			// Инициализация PHPMailer и отправка ИД шаблона и массива данных
        	include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
        	load_interface( 'settings' );
        	$json = &$GLOBALS['JSON'];
            $settings = &$GLOBALS['cotfw.settings'];

			// Заполнение массива данных дополнительными параметрами
			$user_info['email'] = JBase::escape($_POST['Username']);
			$user_info['newpass'] = $new_pass;
			
			//отправка письма пользователю
			$mailsend = new MailSend( $settings->val('pdd_main_mailbox') );
			$result = $mailsend->MailSend( 1, $user_info );
    
            if( $result ) {
                // обновляем пароль в базе данных
                JBase::Update_Data('my_users', ['password' => $new_pass_crypted], ['id' => $id]);
                json_good();
            } else {
                json_bad( $mailsend->ErrorInfo );
            }
        } else {
            json_bad( 'Пользователь с указанным адресом не найден' );
        }
        json_result();
    }
	//проверка почты при регистрации
    function emailRegisterCheck() {
		
		$id = JBase::Get_Id('my_users', ['email' => $_POST['mail'], 'password' => strtoupper(md5( $_POST['code'] ))]);
		if ( !$id ) $id = JBase::Get_Id('my_users', ['username' => $_POST['mail'], 'password' => strtoupper(md5( $_POST['code'] ))]);
		if ( !$id ) return false;
		
		if ( $id ) self::auth( $id );
    }
    //сохранение изменений в load_user и личном кабинете
    function save_users_param() {
    	
    	if ( $_POST['password'] != '' ) $password = strtoupper(md5( $_POST['password'] ));
    	
    	if ( !self::check_login( $_POST['username'] ) && $_POST['username'] != '' ) return 'login';
    	if ( !self::check_phone( $_POST['phone'] ) && $_POST['phone'] != '' ) return 'phone';
    	if ( !self::check_email( $_POST['email'] ) && $_POST['email'] != '' ) return 'email';
    		
    	$param = [
    		"email" 	=> mb_strtolower(JBase::escape($_POST['email'])), 
    		"name" 		=> JBase::escape($_POST['name']),
    		"phone" 	=> JBase::escape($_POST['phone']),
    		"status" 	=> JBase::escape($_POST['status']),
    		"username" 	=> JBase::escape($_POST['username']),
    		"usertype" 	=> JBase::escape($_POST['usertype']),
    		"password" 	=> $password
    	];
    		
    	$param = array_diff( $param, [''] );
    	JBase::Update_Data('my_users', $param, ['id' => (int)$_POST['id']]);

    	return 'Выполнено';
    }
}


