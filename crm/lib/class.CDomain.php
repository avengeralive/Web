<?php 
namespace lib;

if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

/**
* class.CCSS.php
*
*Класс - Модуль для проверки свободных доменов
*подгружается через автоподгрузку классов
*
* История:  2017.09.27 - файл создан
* 			2018.08.02 - файл обновлен, добавлена проверка делегирования

**/

class CDomain{


  	//проверка домена и установка сайта - обновлено
  	function install2( $ARR ) {
  	
	  	$domain = $ARR['name']; 
	  	$Result = JBase::Get_Data('list2', '*', ['id' => (int)$ARR['id']]);
	  	JBase::Update_Data('list2', ['f1528723031n' => $domain], ['id' => (int)$ARR['id']]);
    	while ($param = $Result->fetch_assoc()) {
    		$items = $param;
    	}	  	
	  	
  		if( $domain ) {
			$domain = trim($domain);
			if(substr(strtolower($domain), 0, 8) == "https://") $domain = substr($domain, 8);
			if(substr(strtolower($domain), 0, 7) == "http://") $domain = substr($domain, 7);
			if(substr(strtolower($domain), 0, 4) == "www.") $domain = substr($domain, 4);
			
			//проверка, существует ли запись. защита от повторной установки
			if( self::ValidateDomain($domain) || substr(strtolower($domain), 0, 3) == 'xn-') { 
            	$access_granted = true;
            	$Result = JBase::Query('SELECT 1 FROM realty.templates WHERE `domain` = "'.$domain.'"');
            	while( $access_try = $Result->fetch_assoc() ) {
            	    $access_granted = false;
            	    break;
            	}
            	$Result->free();
        	}
				
			if ( $access_granted ) {
				
				//проверка на шаблон
				if ( $items['template'] == 'moscow' || $items['template'] == 'london' || $items['template'] == 'madrid' || $items['template'] == 'tokyo') {
								
					//начинаем установку сайта
					$pass = md5($domain);
					$pass = preg_replace("/[^0-9,.]/", "", $pass);
					$pass = substr($pass, -5);
					$pass = strrev($pass);				
					
					return CSetup::ExportSite($items['template'], $domain, $pass, $items);
				}
			}
		}
  	}
  	
  	
  	//проверка dns и установка сайта
  	// function whoisGet() {
//   	
//         //инициализируем интерфейсы
//         require_once $_SERVER["DOCUMENT_ROOT"].'/lib.php';
//         load_interface( 'settings' );
//         $settings	= &$GLOBALS['cotfw.settings'];
//         
// 	  	$user = $_GET['user'];
// 	  	$domain = $_GET['domain'];
// 	  	$template = JBase::Get_Field_Value_From_Id( 'my_users', $user, 'message' );
// 	  	
// // 	  	$user = '47705';
// // 	  	$domain = 'goldencity-an.ru';
// // 	  	$template = 'london';
// 	  	
//   		if( $domain ) {
// 			$domain = trim($domain);
// 			if(substr(strtolower($domain), 0, 8) == "https://") $domain = substr($domain, 8);
// 			if(substr(strtolower($domain), 0, 7) == "http://") $domain = substr($domain, 7);
// 			if(substr(strtolower($domain), 0, 4) == "www.") $domain = substr($domain, 4);
// 			
// 			if( self::ValidateDomain($domain) ) 
// 				$result = self::LookupDomain($domain);	
// 				
// 			$result = explode(PHP_EOL, $result);
// 			array_pop($result);
// 			array_pop($result);
//         	$arr = [];
// 			
// 			foreach($result as $res) {
// 				$resp = explode(': ', $res);
// 				$resp[1] = ltrim($resp[1]);
// 				array_push($arr, $resp);
// 			}
// 			
// 			//убираем домен вниз и разворачиваем массив
// 			array_push($arr, array_shift($arr));
// 			$arr = array_reverse($arr);
// 			
// 			//меняем значения			
// 	    	$arr[0][1] = strtolower($arr[0][1]);
// 	    	$arr[2][1] = strtotime($arr[2][1]);
// 	    	$arr[3][1] = strtotime($arr[3][1]);
// 	    	$arr[4][1] = strtotime($arr[4][1]);
// 	    	
// 	    	if($arr[9][0] == 'nserver') $arr[9][0] = 'nserver1';
// 	    	if($arr[10][0] == 'nserver') $arr[10][0] = 'nserver2';
// 	    	if($arr[11][0] == 'nserver') $arr[11][0] = 'nserver3';
// 			
// 			//сравниваем ns серверы
// 			$NS1 = explode('.', $arr[9][1]);
// 			$NS2 = explode('.', $arr[10][1]);
// 			$NS3 = explode('.', $arr[11][1]);
// 			
// 				
// 			//готовим значения для публикации
// 			$List_Field_Value = '';
// 			foreach($arr as $List_Field) {
// 				$List_Field_Value .= "`". $List_Field[0] ."`='". $List_Field[1] ."',";
// 			}
// 			//обновили параметры домена для статистики
// 			$List_Field_Value = substr($List_Field_Value, 0, -1);	
// 			JBase::Update_Field_Value_From_Id('domain', $user, $List_Field_Value);	
// 			//return $List_Field_Value;
// 			
// 			$next = '0';
// 			if ($NS1[1] == 'flops' && $NS2[1] == 'flops' && $NS3[1] == 'flops') $next = '1';
// 			if ($NS1[1] == 'beget' && $NS2[1] == 'beget' && $NS3[1] == 'beget') $next = '1';
// 			if ($NS1[1] == 'yandex' || $NS2[1] == 'yandex' || $NS3[1] == 'yandex') $next = '1';
// 
// 			//проверка, существует ли запись. защита от повторной установки
//         	if( $next == '1' ) {
//             	$access_granted = true;
//             	$Result = JBase::Query('SELECT 1 FROM realty.templates WHERE `domain` = "'.$domain.'"');
//             	while( $access_try = $Result->fetch_assoc() ) {
//             	    $access_granted = false;
//             	    break;
//             	}
//             	$Result->free();
//         	}
// 				
// 			if ( $access_granted ) {
// 				
// 				//проверка на шаблон
// 				if ( $template == 'moscow' || $template == 'london' || $template == 'madrid' || $template == 'tokyo') {
// 					//обновили message у юзера otys
// 					$List_Field2 = "`message`='finish'";
// 					JBase::Update_Field_Value_From_Id('my_users', $user, $List_Field2);
// 					//скопировали данные авторизации у юзера в realty
// 					JBase::Query("INSERT INTO realty.my_users (`domain`,`name`,`username`,`email`,`password`,`usertype`,`status`) 
// 								SELECT '". $domain ."',`name`,`username`,`email`,`password`,'1','1' FROM otys.my_users 
// 								WHERE  `id` = '". $user ."'");
// 		
// 					//узнали мыло пользователя по домену
// 					$usermail = JBase::Get_Field_Value_From_Id( 'my_users', $user, 'email' );
// 					//Письмо с инструкциями пользователю
// 					$data['email'] = $usermail;
// 					$data['domain'] = $domain;
// 					// Инициализация PHPMailer и отправка ИД шаблона и массива данных
// 					$mailsend = new MailSend( $settings->val('pdd_main_mailbox') );
// 					$result = $mailsend->MailSend( '99', $data );
// 					
// 					//Оповещение администратору при установке сайта 
// 					$data['email'] = $settings->val('pdd_main_mailbox');
// 					$data['domain'] = $domain;
// 					$data['usermail'] = $usermail;
// 					// Инициализация PHPMailer и отправка ИД шаблона и массива данных
// 					$mailsend = new MailSend( $settings->val('pdd_main_mailbox') );
// 					$result = $mailsend->MailSend( '100', $data );
// 								
// 					//начинаем установку сайта
// 					$pass = md5($domain);
// 					$pass = preg_replace("/[^0-9,.]/", "", $pass);
// 					$pass = substr($pass, -5);
// 					$pass = strrev($pass);				
// 					
// 					CSetup::ExportSite($template, $domain, $pass);
// 					return 1; //нужно для алерта на фронтенде
// 				}
// 				
// 			} else {
// 				return 0; //нужно для алерта на фронтенде
// 			}
// 		}
//   	}
	function LookupDomain($domain) {
		$whoisservers = array(
			"com" => "whois.verisign-grs.com",
			"info" => "whois.afilias.net",
			"net" => "whois.verisign-grs.net",
			//"org" => "whois.pir.org",
			//"pro" => "whois.dotproregistry.net",
			"ru" => "whois.tcinet.ru", 
			"su" => "whois.tcinet.ru"
		);
  	
		$domain_parts = explode(".", $domain);
		$tld = strtolower(array_pop($domain_parts));
		$whoisserver = $whoisservers[$tld];
		if(!$whoisserver) {
			return "Error: No appropriate Whois server found for $domain domain!";
		}
		
		$result = self::QueryWhoisServer($whoisserver, $domain);
		if(!$result) {
			return "Error: No results retrieved from $whoisserver server for $domain domain!";
		} else {
			while(strpos($result, "Whois Server:") !== FALSE){
				preg_match("/Whois Server: (.*)/", $result, $matches);
				$secondary = $matches[1];
				if($secondary) {
					$result = self::QueryWhoisServer($secondary, $domain);
					$whoisserver = $secondary;
				}
			}
		}
		return $result;
	}
	function ValidateDomain($domain) {
		if(!preg_match("/^([-a-z0-9]{2,100})\.([a-z\.]{2,8})$/i", $domain)) {
			return false;
		}
		return $domain;
	}
	function QueryWhoisServer($whoisserver, $domain) {
		$port = 43;
		$timeout = 10;
		$fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout) or die("Socket Error " . $errno . " - " . $errstr);
		//if($whoisserver == "whois.verisign-grs.com") $domain = "=".$domain; // whois.verisign-grs.com requires the equals sign ("=") or it returns any result containing the searched string.
		fputs($fp, $domain . "\r\n");
		$out = "";
		while(!feof($fp)){
			$out .= fgets($fp);
		}
		fclose($fp);
		$res = "";
		if((strpos(strtolower($out), "error") === FALSE) && (strpos(strtolower($out), "not allocated") === FALSE)) {
			$rows = explode("\n", $out);
			foreach($rows as $row) {
				$row = trim($row);
				if(($row != '') && ($row{0} != '#') && ($row{0} != '%')) {
					$res .= $row."\n";
				}
			}
		}
		return $res;
	}
	
    //генератор лицензий
    function generate_license($suffix = null) {
    
    	//$license = generate_license();
    	// YF6G2-HJQEZ-8JZKY-8C8ZN
    	//$license = generate_license(123456);
    	// ZJK82N-8GA5AR-ZSPQVX-2N9C
    	//$license = generate_license($_SERVER['REMOTE_ADDR']);
    	// M9H7FP-996BNB-77Y9KW-ARUP4
    	//$license = generate_license('my text suffix');
    	// Q98K2F-THAZWG-HJ8R56-MY-TEXT-SUFFIX
    	//https://stackoverflow.com/questions/3687878/serial-generation-with-php
    	
		if(isset($suffix)){
			$num_segments = 3;
			$segment_chars = 6;
		}else{
			$num_segments = 4;
			$segment_chars = 5;
		}
		$tokens = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
		$license_string = '';
		
		for ($i = 0; $i < $num_segments; $i++) {
			$segment = '';
			for ($j = 0; $j < $segment_chars; $j++) {
				$segment .= $tokens[rand(0, strlen($tokens)-1)];
			}
			$license_string .= $segment;
			if ($i < ($num_segments - 1)) {
				$license_string .= '-';
			}
		}
		
		if(isset($suffix)){
			if(is_numeric($suffix)) {
				$license_string .= '-'.strtoupper(base_convert($suffix,10,36));
			}else{
				$long = sprintf("%u\n", ip2long($suffix),true);
				if($suffix === long2ip($long) ) {
					$license_string .= '-'.strtoupper(base_convert($long,10,36));
				}else{
					$license_string .= '-'.strtoupper(str_ireplace(' ','-',$suffix));
				}
			}
		}
		return $license_string;
	}
	//генерим лицензию
	function license2() {
        return self::generate_license($_POST['time']);
	}
	//генерим лицензию
	function license($iduser) {
        if (DOMAIN == 'vocu.ru' || DOMAIN == 'otys.ru') {
            $license = self::generate_license($iduser);
			JBase::Query("INSERT INTO `domain` (`id`,`domain`,`license`) VALUES (".$iduser.",'".DOMAIN."','".$license."')");
			//генерим партнерскую ссылку
			$referal_id = substr( md5( time() . rand( 1000, 9999 ) ), 0, 10 );
			JBase::Query("UPDATE `my_users` SET `referal_id` = '". $referal_id ."' WHERE `id` = '" . $iduser . "'");
        }
	}
	//проверка домена на занятость
	function check_domain() {
			
		$servers = [
    		[
    			"ru",
    			"whois.tcinet.ru",
    			"No entries found"
    		],[
    			"com",
    			"whois.verisign-grs.net",
    			"No match"
    		],[
    			"net",
    			"whois.verisign-grs.net",
    			"No match"
    		]
    	];
		
		// Устанавливаем неограниченное время выполнения скрипта
  		set_time_limit(0);
  		
		$first_level_domains = [
			"ru",
			"com",
			"net"
		];
  		$price = [
  			"ru"=>"290",
  			"com"=>"990",
  			"net"=>"1490"
  		];
  		
//   	$Result = JBase::Query("SELECT * from `domainzone`");
// 		if (!empty($Result))
// 			$price = array();
// 			while ($item = $Result->fetch_assoc()) 
// 				$price[] = $item;
// 			return $price;
		
		$res = [
			count($first_level_domains)
		];
		
		
		
		
		
		
		$domain = JBase::escape($_POST['domain']);
		$domain = trim($domain);
		
		if(substr(strtolower($domain), 0, 8) == "https://") $domain = substr($domain, 8);
		if(substr(strtolower($domain), 0, 7) == "http://") $domain = substr($domain, 7);
		if(substr(strtolower($domain), 0, 4) == "www.") $domain = substr($domain, 4);
		
		//Метод возвращает список зон
		//https://api.beget.com/api/domain/getZoneList?login=adminvxh&passwd=XVbIYfB8&output_format=json
		
		//https://api.beget.com/api/domain/checkDomainToRegister?login=adminvxh&passwd=XVbIYfB8&input_format=json&output_format=json&input_data={"hostname": "domainrer33333", "zone_id": 393, "period":1}
			
			
/*
            "com": {"id": 2, "zone": "com", "price": 760, }
            "dental": {"id": 1746, "zone": "dental", "price": 1880,},
            "doctor": {"id": 2214, "zone": "doctor", "price": 7810,}
            "estate": {"id": 1534, "zone": "estate", "price": 1230, },
            "fit": {"id": 1934, "zone": "fit", "price": 2230,},
            "fitness": {"id": 1770, "zone": "fitness", "price": 1230, }
            "florist": {"id": 1593, "zone": "florist", "price": 1230, },
            "flowers": {"id": 1922, "zone": "flowers", "price": 1970,  },
            "house": {"id": 1594, "zone": "house", "price": 1230, },
            "info": {"id": 4, "zone": "info", "price": 960}
            "moscow": {"id": 1781, "zone": "moscow", "price": 389/607},
            "name": {"id": 8, "zone": "name", "price": 730,  },
            "net": {"id": 3, "zone": "net", "price": 960, }
            "ooo": {"id": 1870, "zone": "ooo", "price": 1500, },
            "org": {"id": 24, "zone": "org", "price": 1000,  }
            "pet": {"id": 2109, "zone": "pet", "price": 1440, }
            "pro": {"id": 622, "zone": "pro", "price": 950, }
            "realty": {"id": 2203, "zone": "realty", "price": 762, },
            "ru": {"id": 1, "zone": "ru", "price": 149, }
            "site": {"id": 2034, "zone": "site", "price": 99/1950, },
            "su": {"id": 11, "zone": "su", "price": 325/435, }
            "vet": {"id": 1833, "zone": "vet", "price": 1910, }
            "vip": {"id": 2154, "zone": "vip", "price": 1440, }
            
    */        
            
            
            
		
		if (!preg_match("/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]$/", $domain)) {
		
					
/*
            "москва": {"id": 1853, "zone": "москва", "price": 0, },
            "онлайн": {"id": 1820, "zone": "онлайн", "price": 0, },
            "сайт": {"id": 1819, "zone": "сайт", "price": 0, },
            "рус": {"id": 2071, "zone": "рус", "price": 0, },
            "рф": {"id": 393, "zone": "рф", "price": 0, }
            
    */   
    
    
			return 'norussians';
		}
		
			$fdomain = $domain;
			//$price = array_flip($price);
			if ( preg_match("/\./", $domain) ) {
			
				$first_dom = substr( $domain, strpos($domain, ".") + 1 );
				for( $i = 0; $i < count($first_level_domains); $i++ ) {
					if ( $first_level_domains[$i] == $first_dom ) {
					
						$first_level_domains[$i] = $first_level_domains[0];
						$first_level_domains[0] = $first_dom;
					}
				}
				$first_dom = substr($domain, strpos($domain, "."));
				$fdomain = str_replace($first_dom, "", $domain);
			
			}
				
			for( $k = 0; $k < count($first_level_domains); $k++ ) {
			$domain = ( $fdomain .".". $first_level_domains[$k] );
			$first_dom = substr( $domain, strpos($domain, ".") + 1 );
  			
  			// Получаем имя whois-сервера, который отвечает за домен $first_dom
  			for( $i = 0; $i < count($servers); $i++ ) {
    			if($servers[$i][0] == $first_dom){
      				// Запоминаем имя сервера
      				$whois = $servers[$i][1];
      				// и фразу, означающую, что домен отсутствует
      				$not_found_string = $servers[$i][2];
      				break;
    			}
  			}

  			// Проверяем определён ли whois-сервер который несёт ответственность за данный доменный уровень
  			// if(empty($whois)) array($res[$k]= $domain." К сожалению не найден соответствующий Whois-сервер",'0');
  			// Обращаемся к whois-серверу и получаем информацию о доменном имени
  			$str = "";
  			$fp = fsockopen( $whois, 43 );
  			fputs( $fp, "$domain\r\n" );
  			while( !feof($fp) ) {
    			$str .= fgets( $fp, 128 );
  			}
  			fclose( $fp );
			
			// если в ответе имеется фраза-отказ, домен не
			// зарегистрирован, если такой фразы нет -
			// следовательно домен зарегистрирован
  			if( !preg_match("/".$not_found_string."/is", $str) ) 
				$res[$k] = array( $domain ." Домен занят", '0', '0' );
  			else $res[$k]= array( $domain." Домен свободен", '1', $price[$first_dom] );
  		}
  		return($res);
  	}
  	
  	
  	
	//проверка домена на занятость
	function cdomain() {
			
		//Устанавливаем неограниченное время выполнения скрипта
  		//set_time_limit(0);
		
		$domain = JBase::escape($_POST['domain']);
		$domain = trim($domain);
		$zones = [];
		
		if (substr(strtolower($domain), 0, 8) == "https://") $domain = substr($domain, 8);
		if (substr(strtolower($domain), 0, 7) == "http://") $domain = substr($domain, 7);
		if (substr(strtolower($domain), 0, 4) == "www.") $domain = substr($domain, 4);
		
		//убираем зону из домена
		$domainArr = explode('.', $domain);
		if (sizeof($domainArr) > 1) array_pop($domainArr);
		$domain = implode('.', $domainArr);

		//формируем список зон
		if (preg_match('/[А-Яа-яЁё]/u', $domain)) {
			$zones = [
      	  	'онлайн'			=> 1820,
      	  	'сайт'			=> 1819,
      	  	'рус'				=> 2071,
      	  	'рф'				=> 393
			];
		} else {
			$zones = [
            'ru'				=> 1,
      	  	'com'				=> 2,
            //'net'				=> 3,
            //'info'				=> 4,
            //'name'				=> 8,
            'su'				=> 11,
            //'org'				=> 24,
            //'pro'				=> 622,
      	  	//'dental'			=> 1746,
      	  	//'doctor'			=> 2214,
      	  	//'estate'			=> 1534,
      	  	//'fitness'			=> 1770,
            //'florist'			=> 1593,
            //'flowers'			=> 1922,
            //'house'			=> 1594,
            //'moscow'			=> 1781,
            //'realty'			=> 2203,
      	  	//'fit'				=> 1934,
            //'ooo'				=> 1870,
            //'pet'				=> 2109,
            //'site'				=> 2034,
            //'vet'				=> 1833,
            //'vip'				=> 2154
			];
		}
		
		
		
		$Result = [];
		foreach ($zones as $key => $value) {

			$tmp = self::getBeget($domain, $value);
			
			$res = [];
			$res['is'] 	= $tmp['answer']['result']['may_be_registered'];
			$price = (int)$tmp['answer']['result']['price'];
			$res['one'] = (ceil( $price / 100)) * 100 + (ceil( $price * 0.5 / 10)) * 10;
			$res['two'] = $res['one'] * 2;
			$res['zone'] = $key;
			
			
			
			if (($tmp['answer']['result']['in_system'] == 'true') || 
				((int)$tmp['answer']['result']['balance'] >= (int)$tmp['answer']['result']['price'])) {
			
				$data['beget'] 	= $domain .'.'. $key;
				$data['email'] 	= 'admin@otys.ru'; //получатель
				$data['owner'] 	= DOMAIN;
				
				$template = ($tmp['answer']['result']['in_system'] == 'true') ? '1' : '2';
				
				//инициализация PHPMailer и отправка ИД шаблона и массива данных
				//$mailsend = new MailSend('no-reply@otys.ru');
				//$status = $mailsend->MailSend($template, $data);
			}
			
			array_push($Result, $res);
			//sleep(1);
		}
			
		return json_encode($Result);
  	}
  	
  	function getBeget($domain, $zoneid) {
  		
		//формируем данные для отправки		
		$items = [
        	'hostname'			=> $domain,
        	'zone_id'			=> $zoneid,
        	'period'				=> '1'
		];
			
		$fields = [
        	'login'				=> 'adminvxh',
        	'passwd'				=> 'XVbIYfB8',
        	'input_format'		=> 'json',
        	'output_format'	=> 'json',
        	'input_data'		=> json_encode($items)	
		];
		
		$url = 'https://api.beget.com/api/domain/checkDomainToRegister?'. http_build_query($fields);
		$json = file_get_contents($url);
		$Result = json_decode($json, true);
		
		return $Result;
  	}
  	
  	function my_domains() {
  		$Result = JBase::Query("SELECT * FROM `domain`");
		 if (!empty($Result))
			$items = array();
			while ($item = $Result->fetch_assoc()) 
				$items[] = $item;
			return $items;
  	}
}
