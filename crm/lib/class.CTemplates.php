<?php
namespace lib;

/**
 * class.CTemplates.php
 *
 **/

class CTemplates {
		
	//забираем инфо о модулях сайта для нужной страницы
	protected static function Get_Block($user, $page) {
		$Datas = JBase::Get_Data('modules', ['domain_id','position','page_list','access_usertype','name','setting'], ['published' => 1]);
		$GoCpu = JBase::Get_Field_Value_From_Id('my_menu', $page, 'cpu');
		if (empty($GoCpu)) $GoCpu = $page;
		
		$Data = [];
		$userType = userType((int) $user);
		while($Rows = $Datas->fetch_assoc()) {
			$access_usertype = explode('_', $Rows['access_usertype']);
			$page_list = explode('_', $Rows['page_list']);
			
			//актуализируем параметры выборки
			if (in_array($GoCpu, $page_list) || (($GoCpu != 'home') && in_array('all', $page_list))) {
				if (in_array($userType, $access_usertype)) {
					$Data[$Rows['position']][$Rows['domain_id']]['domain_id'] = $Rows['domain_id'];
					$Data[$Rows['position']][$Rows['domain_id']]['setting'] = $Rows['setting'];
					$Data[$Rows['position']][$Rows['domain_id']]['name'] = $Rows['name'];
				}
			}
		}
 		return $Data;
	}			
 			
	protected static function generate_content_block($pos_id, $Get_Block) {
		$posmodule = '';
		if (isset($Get_Block) && isset($pos_id) && isset($Get_Block[$pos_id]))
			foreach ($Get_Block[$pos_id] as $domain_id => $module) {
				//if ($Get_Block[$pos_id][$domain_id]['name'] != 'mod_menu')
				$posmodule .= self::module_body($Get_Block[$pos_id][$domain_id]['domain_id'], $Get_Block[$pos_id][$domain_id]['name'], $Get_Block[$pos_id][$domain_id]['setting']);
			}			
		return ['html' => $posmodule];
	}

	private static function _get_menu_level($parent_id, $items) {
		$children = [];
		foreach($items as $item) {
			if ($item['id_parent'] == $parent_id) {
				$item['id'] = $item['id'];
				$item['children'] = self::_get_menu_level($item['id'], $items);

				$children[ $item['id'] ] = $item;
			}
		}

		return $children;
	}

	protected static function generate_menu_item($item) {
		$href = '/' . ($item['cpu'] ? $item['cpu'] : $item['id']);
		$href = ($href == '/?page=home' || $href == '/?home') ? '/' : $href;
		$item_html = "";
		$item_html .= "<li>";
		$item_html .= "<a class=\"m{$item['id']}\" href=\"{$href}\">{$item['title']}</a>";
		$temp_item_html = '';
		foreach ($item['children'] as $children) {
			$temp_item_html .= self::generate_menu_item($children);
		}
		if ($temp_item_html != '') {
			$item_html .= "<ul class=\"ul{$item['id']}\">".$temp_item_html."</ul>";
		}
		$item_html .= "</li>";
		return $item_html;
	}

	protected static function generate_menu_block($pos_id, $Get_Block) {
		$posmodule = '';
		
		if (isset($Get_Block) && isset($pos_id) && isset($Get_Block[$pos_id]))
			foreach ($Get_Block[$pos_id] as $module_id => $module) {
			
				if ($Get_Block[$pos_id][$module_id]['name'] == 'mod_menu') {
					$res2 = JBase::Get_Data('my_menu', '*', ['id_menu'=>$module_id, 'published'=>'1'], 'ordering');
					if ($res2) {
						$items = [];
						while ($row = $res2->fetch_assoc()) {
							$items[] = $row;
						}
					}

					if (empty($items)) continue;

					$menu = self::_get_menu_level(0, $items);
					$posmodule .= "<div class=\"menu{$module_id}\">";
					$posmodule .= "<ul class=\"ulmenu{$module_id}\">";

					foreach ($menu as $item) {
						$posmodule .= self::generate_menu_item($item);
					}

					$posmodule .= "</ul>";
					$posmodule .= "</div>";
					$script = htmlspecialchars_decode($Get_Block[$pos_id][$module_id]['setting'], ENT_QUOTES);
					$posmodule .= '<script>' . $script . '</script>';
				}
		}
		
		return ['html' => $posmodule];
	}
	
	public function module_body($id, $mod_name, $setting) {
		$modhtml = '';
		
		if ($mod_name == "mod_cssjs_editor") {
			$content = htmlspecialchars_decode(JBase::Get_Field_Value_From_Domain_Id('article', $id, 'content'), ENT_QUOTES);
			$modhtml .= '<div class="text' . $id . '">' . $content . '</div>';
			$modhtml .= '<script>' . htmlspecialchars_decode($setting, ENT_QUOTES) . '</script>';
		} elseif ($mod_name == "mod_banks") {
			$modhtml .= '<div class="banks">' . CSys::banks() . '</div>';
		} elseif ($mod_name == "mod_users") {
			$modhtml .= '<div class="users">' . CSys::users() . '</div>';
		} elseif ($mod_name == "mod_map") {
			$modhtml .= '<div class="mod_map">' . CSys::mod_map() . '</div>';
		} elseif ($mod_name == "mod_contacts") {
			$modhtml .= '<div class="mod_contacts">' . CSys::mod_contacts() . '</div>';
		} elseif ($mod_name == "mod_str_navigation") {
			$modhtml .= '<div class="crumb">' . CSys::Crumbss(self::Page()) . '</div>';
		} elseif ($mod_name == "mod_double_menu") {
			$setting = htmlspecialchars_decode($setting, ENT_QUOTES);
			$setting = json_decode($setting);
			$settingp = (!empty($setting->p)) ? $setting->p : '';
			if (!empty($setting->m))
				$modhtml .= CSys::double_default($setting->m, $settingp);
		} elseif ($mod_name == "mod_auth") {
			$modhtml .= self::mod_auth();
		}
		
		return $modhtml;
	}
	
	//структура разметки сайта
	public static function index($user) {
	
		//генерация страницы start
		$start_time = microtime();
		$start_array = explode(" ", $start_time);
		$start_time = $start_array[1] + $start_array[0];


		global $Variable_HTML;
		$Page = self::Page();
		
		if( $user == 0 || $user == NULL || substr($user, 0, 6) == 'wadmin') {
			$user_type = '5';
			$UserAutorize = [];
		} else {
			$UserArray = self::Get_User($user);
			$user_type  = $UserArray['usertype'];
			$UserAutorize = [
				'userName'		=> $UserArray['name'],
				'balance'		=> $UserArray['balance'],
				'registerDate'	=> $UserArray['registerDate'],
				'referalId'		=> $UserArray['referal_id'],
				'message'		=> $UserArray['message'],
				'avatar'		=> ($UserArray['avatar'] == 'nophoto.png') ? '/cdn/lib/nophoto.png' : JLoads::$cdn. '/avatar/' .$UserArray['avatar'],
				'phone'			=> $UserArray['phone'],
				// 'geo'			=> $UserArray['geo']
			];
		}

		//переменные php to js
		$TemplateArray = self::Get_Template();		
		$title = ( empty( $TemplateArray['caption'] )) ? $TemplateArray['title'] : $TemplateArray['caption'];			
		$Templates_HTML = str_replace('​​', '', htmlspecialchars_decode($TemplateArray['html']));
		$favicon = ( !empty( $TemplateArray['favicon'] )) ? $TemplateArray['favicon'] : '/cdn/lib/'. $TemplateArray['template'] .'.png';
		$mobile = ( $TemplateArray['mobile'] == '1' ) ? 'device-width' : '1300px';
		$view = ( $TemplateArray['view'] == '1' ) ? 'column' : '';
		$animate = ( $TemplateArray['animate'] == '1' ) ? 'animate' : '';
		$cpupage = ( !empty( $TemplateArray['cpu'] )) ? $TemplateArray['cpu'] : $Page;
		$ogimage = $TemplateArray['ogimage'];
		$ogtitle = $TemplateArray['ogtitle'];
		$ogdescription = $TemplateArray['ogdescription'];
		
		
		$UserGuest = [
			'cdn'			=> JLoads::$cdn,
			'token'			=> JLoads::$wad_md5,
			'page'			=> $Page,
			'domain'		=> DOMAIN,
			'cpu'			=> $cpupage,
			'city'			=> $TemplateArray['city'],
			'template'		=> $TemplateArray['template'],
			'category'		=> $TemplateArray['category'],
			'user'			=> $user,
			'userType'		=> $user_type
		];			
				
		$Variable_HTML = '
			<!DOCTYPE html><html lang="ru" prefix="og: http://ogp.me/ns#"><head>
			<link rel="icon" href="' . $favicon . '" type="image/x-icon" />
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="viewport" content="width=' . $mobile . ', initial-scale=' . $TemplateArray['mobile'] . ', shrink-to-fit=no" />
			<meta property="og:type" content="website"/>
			<meta property="og:url" content="' . $TemplateArray['ogurl'] . '"/>
			<meta property="og:image" content="' . $ogimage. '"/>
			<meta property="og:title" content="' . $ogtitle . '"/>
			<meta property="og:site_name" content="' . $TemplateArray['ogsite_name'] . '"/>
			<meta property="og:description" content="' . $ogdescription . '"/>
			<meta name="google-site-verification" content="' . $TemplateArray['google'] . '" />
			<meta name="yandex-verification" content="' . $TemplateArray['yandex'] . '" />
			<meta name="description" content="" />
			<meta name="keywords" content="' . $TemplateArray['keywords'] . '" /> 
			<meta name="wot-verify" content="b68cb8a7513d0dde1ab3" />
			<meta name="theme-color" content="#587a9f" />
			<link rel="manifest" href="/js/manifest.json" />
			<title></title>
			<script type="text/javascript">
				const JSCat = Object.freeze(' . json_encode(array_merge($UserGuest, $UserAutorize)) . ');
			</script>
			<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>';
		
		if ($cpupage == 'add')		
			$Variable_HTML .= '<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>';

			$Variable_HTML .= '<script type="text/javascript" src="/js/general.js?v' . $TemplateArray['version'] . '"></script>
								<script type="text/javascript" src="/js/lib.core.js?v' . $TemplateArray['version'] . '"></script>
								<link rel="stylesheet" type="text/css" href="/css/' . $TemplateArray['template'] . '.css?v' . $TemplateArray['version'] . '" media="all" />
								<link rel="stylesheet" type="text/css" onerror="reload(\'css\');" href="' . JLoads::$cdncss . DS . $Page . '.css?v' . $TemplateArray['version'] . '" media="all" />';
			
		if ($Page != 'home')
			$Variable_HTML .= '<link rel="stylesheet" type="text/css" onerror="cssreload(this,\'all\');" href="' . JLoads::$cdncss . '/all.css?v' . $TemplateArray['version'] . '" media="all">';

		//header
		$Variable_HTML .= '</head><body itemscope="" itemtype="http://schema.org/WebPage" content="'. $TemplateArray['template'] .'"  '. $animate .' class="'. $view .'" page="'. $cpupage .'"><div id="page">';

		//content
		$Get_Block = self::Get_Block($user, $Page);	
		$Positions = self::Get_Position();	
		if (!empty($Positions)) {
			foreach (self::Get_Position() as $key => $value) {
				if (isset($key)) {
						
					$p_html = '';
					$result = self::generate_content_block($value, $Get_Block);
					$p_html .= $result['html'];
						
					$result = self::generate_menu_block($value, $Get_Block);
					$p_html .= $result['html'];
	
					$pos_html = "<div id=\"pos{$value}\">{$p_html}</div>";
					$Templates_HTML = str_replace("{{{$value}}}", $pos_html, $Templates_HTML);
				}
			}
			$Variable_HTML .= $Templates_HTML;
		}
					
		$Variable_HTML .= '</div>';
		
		//footer
		if($TemplateArray['metrika'] != '')
			$Variable_HTML .= '<script type="text/javascript">(function(d,w,c){(w[c]=w[c]||[]).push(function(){try{w.yaCounter'.$TemplateArray['metrika'].'=new Ya.Metrika2({
			id:'.$TemplateArray['metrika'].',clickmap:true,trackLinks:true,accurateTrackBounce:true,webvisor:true});}catch(e){}});var n=d.getElementsByTagName("script")[0],
			s=d.createElement("script"),f=function(){n.parentNode.insertBefore(s,n);};s.type="text/javascript";s.async=true;s.src="https://mc.yandex.ru/metrika/tag.js";
			if(w.opera=="[object Opera]"){d.addEventListener("DOMContentLoaded",f,false);}else{f();}})(document, window, "yandex_metrika_callbacks2");</script>
			<noscript><div><img src="https://mc.yandex.ru/watch/'.$TemplateArray['metrika'].'" style="position:absolute;left:-9999px;" alt=""/></div></noscript>';

		if($TemplateArray['analytics'] != '')
			$Variable_HTML .= '<script async src="https://www.googletagmanager.com/gtag/js?id='.$TemplateArray['analytics'].'"></script>
			<script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag("js", new Date());gtag("config", "'.$TemplateArray['analytics'].'");</script>';
			
		if ($Page != 'home')
			$Variable_HTML .= '<script type="text/javascript" onerror="reload(\'js\');" src="' . JLoads::$cdnjs .'/all.js?v' . $TemplateArray['version'] . '"></script>';

		if ($user_type == '1')
			$Variable_HTML .= '<link rel="stylesheet" type="text/css" href="/css/amenu.css" media="all">
			<script type="text/javascript" src="/js/amenu.js"></script>
			<script type="text/javascript" src="/js/codemirror.js"></script>';
		
		//генерация страницы end
		$end_time = microtime();
		$end_array = explode(" ",$end_time);
		$end_time = $end_array[1] + $end_array[0];
		$time = $end_time - $start_time;
		$ram = round(memory_get_usage()/1024/1024, 2);
		
		//get_defined_constants — Возвращает ассоциативный массив с именами всех констант и их значений

		//$arr = get_defined_vars();
		// печатает все серверные переменные
		//print_r($arr["_SERVER"]);
		//var_dump(json_encode($_SERVER));

		$Variable_HTML .= '<script type="text/javascript" onerror="reload(\'js\');" src="' . JLoads::$cdnjs . DS . $Page . '.js?v' . $TemplateArray['version'] . '"></script>
			<script type="text/javascript" src="/js/photobox.js"></script>
			<span style="position:absolute;font-size:0">Время: '.$time.'сек, Память: '.$ram.'MB</span>
			</body></html>';
			
	}

	//сессия пользователя
	public static function Session_Go() {
		$flag = false;
		$UserID = 0; //сначала это безвольное чмо
		
		//проверяем cookie на наличие сессии
		foreach ($_COOKIE as $name => $value) {
			if (substr($name, 0, 7) == 'wadmin_') {
				$flag = true;
				JLoads::$rand_cod = $name;
				JLoads::$wad_md5  = $value;
			}
		}
		
		//если есть признаки, получаем id сессии и её пользователя
		if ( $flag ) {
			$SessionID = JBase::Get_Id('session_users', ['rand_cod' => JLoads::$rand_cod, 'wad_md5' => JLoads::$wad_md5]);
			
			if (!empty($SessionID)) {
				$UserID = JBase::Get_Field_Value_From_Id('session_users', $SessionID, 'user_id');
				//обновляем время и ip
				JBase::Update_Data('my_users', ['time_test' => time(), 'ipauth' => $_SERVER['REMOTE_ADDR']], ['id' => (int)$UserID]);
			} else {
				setcookie($name, "");
			}

			//если выходим из системы
			if(isset($_GET['logout'])) {
				// Если удалять запись из базы, другие авторизованные устройства тоже
				// потеряют авторизацию. Поэтому запись в базе должна оставаться до
				// тех пор, пока последнее устройство не выйдет из системы.

				// Для этого необходимо вести учет количества авторизованных устройств,
				// хранить их в базе и хранить их статус "авторизован - не авторизован".
				// Поскольку это весьма сложная задача, пока что я просто добавил
				// дополнительный параметр logoutAll, который скидывает авторизацию со
				// всех устройств. Можно добавить эту кнопку в личном кабинете, к примеру.

				// Примечание: указывать его нужно дополнительно к ?logout, например так:
				// https://elitkan.ru/?logout&logoutAll
				if(isset($_GET['logoutAll'])) {
					if(!empty($SessionID)) {
						JBase::Del_Data('session_users', $SessionID);
					}
				}
				
				foreach($_COOKIE as $name => $value) {
					setcookie($name, '', time() - 3600); // ставим все cookie пустыми и просроченными
					unset($_COOKIE[$name]); // и забываем для себя
				}
				
				//redirect на страницу-прокладку, чтобы избежать багов
				header('Location: /views/logout.php', true, 301);
   				die();
			}
			
		} else {
		
			//выдаем новые cookie
			JLoads::$rand_cod = 'wadmin_' . rand(99999, 9999999999999999);
			JLoads::$wad_md5  = md5(JLoads::$rand_cod);

			setcookie(JLoads::$rand_cod, JLoads::$wad_md5, 0x6FFFFFFF, "/", "", true, true);
			$UserID = 0;
		}

		//авторизация
		if (!empty($_POST['Username'])) {
			if ( $_SESSION['csrf_token'] != $_POST['csrf_token'] ) {
				CError::Alert('1');
			} else {
				if (!empty($_POST['Auth'])) { //авторизация
					if (!empty($_POST['Password'])) {
						$password = strtoupper(md5(($_POST['Password'])));
						$username = ($_POST['Username']);
						
						//авторизация
						$UserID = JBase::Get_Id('my_users', ['username' => $username, 'password' => $password, 'status' => '1']);
						if (!empty($UserID)) {
				
							//запрашиваем данные сессии
							$SessionID = JBase::Get_Id('session_users', ['user_id' => $UserID]);
							$Session = null;
							if ($SessionID) {
								$SessionDATA = JBase::Get_Data('session_users', ['rand_cod','wad_md5'], ['id' => $SessionID]);
								$Session = $SessionDATA->fetch_assoc();
							}
					
							//переобъявляем cookie
							if ($Session['rand_cod']) {
								setcookie(JLoads::$rand_cod, null);
								setcookie($Session['rand_cod'], $Session['wad_md5']);
								header("Refresh:0");
							} else {
					
								//записываем данные сессии
								$referer = (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '---';
								$user_ag = (!empty($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '0';
								$user_ip = (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0';
	
								$Name  = [
									'domain',
									'rand_cod',
									'user_id',
									'user_ip',
									'time',
									'user_agent',
									'wad_md5',
									'referer',
									'cap'
								];
								$Value = [
									DOMAIN,
									JLoads::$rand_cod,
									$UserID,
									$user_ip,
									time(),
									$user_ag,
									JLoads::$wad_md5,
									$referer,
									rand(10000, 99999)
								];
								JBase::Del_Data_Where('session_users', 'user_id', $UserID);
								JBase::Set_Data_Unik('session_users', $Name, $Value);
								header("Refresh:0");
							}
						}
					}
				}
				if (!empty($_POST['Register'])) { //регистрация
					$Alert = CUser::registerUser(JBase::escape($_POST['Username']));
					CError::Alert($Alert);
				}
				if (!empty($_POST['Forgot'])) { //забыли пароль?
					$Alert = CUser::forgotPassword(JBase::escape($_POST['Username']));
					CError::Alert($Alert);
				}
			}
		}
		
		$return = (!empty($UserID)) ? $UserID : 0;
		return $return;
	}
	//обращение к пункту меню
	public static function Page() {
	
		if (JLoads::$page) return JLoads::$page;
		
		if (!empty($_GET['page'])) {
			$id = JBase::Get_Id('my_menu', ['cpu' => $_GET['page']]);

			$u = JBase::Get_Field_Value_From_Id('my_menu', $_GET['page'], 'cpu');
			if (!empty($u) and $id != $_GET['page']) {
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: /" . $u);
				exit();
			}

			if (!empty($id)) {
				JLoads::$page = $id;
				return $id;
			}
		}

		if (isset($_GET['page'])) {
			switch ($_GET['page']) {
				case '':
				case 'home':
					JLoads::$page = 'home';
					return 'home';
				break;
				case 'panel':
				case 'cabinet':
					header('Location: /partner', true, 301);
				break;
				case (int)$_GET['page']:
					if (!JBase::Get_Field_Value_From_Id('my_menu', $_GET['page'], 'id')) {
						if (!JBase::Get_Field_Value_From_Id('my_users', $_GET['page'], 'id')) {
							header("HTTP/1.0 404 Not Found");
							CError::Error_Message('404', 'Страница не найдена');
						}
					}
					JLoads::$page = (int)($_GET['page']);
					return (int)($_GET['page']);
				break;
			}
		} 
	}
	//позиции сайта
	function Get_Position() {
		$res = JBase::Get_Full_Table_From_Domain('position');
		while ($rows = $res->fetch_object()) {
			$item_info[] = array(
				'key' => $rows->id,
				'value' => $rows->name
			);
		}
		if (!empty($item_info))
			return array_column($item_info, 'value', 'key');
	}
	//шаблон сайта
	function Get_Template() {
		$res = JBase::Get_Full_Table_From_Domain('templates');
		$Template = $res->fetch_assoc();
		if(!empty($Template)) {
			if(!empty($_GET['page'])) {
				$TDK = JBase::Get_Data('my_menu', ['title','caption','description','keywords'], ['cpu' => $_GET['page']]); 
				$TDKR = $TDK->fetch_assoc();
				$Template['title'] 			= $TDKR['title'];
				$Template['caption'] 		= $TDKR['caption'];
				$Template['keywords'] 		= $TDKR['keywords'];
				$Template['description'] 	= $TDKR['description'];
				$Template['cpu'] 				= $_GET['page'];
			}
			return $Template;
		}
	}
	//операторы
	function Get_Operators() {
		$Operators = [];
		$Result = JBase::Get_Data('my_users',["id","name","usertype"]);
		if ($Result) while( $g = $Result->fetch_assoc() ) {
			if ($g['usertype'] == '2' || $g['usertype'] == '3') {
				$Operators[$g['id']] = $g;
			}
		}
		if(!empty($Operators)) return $Operators;
	}
	//настройки оператора
	function operatorSetting() {
		$operatorSetting = [];
		$Result = JBase::Get_Data('operators','*','');
		if ($Result) while( $g = $Result->fetch_assoc() ) {
			$operatorSetting = $g;
		}
		if(!empty($operatorSetting)) return $operatorSetting;
	}
	//шаблоны sms
	function Get_Sms() {
		$Sms = [];
		$Result = JBase::Get_Data('list5', ["id","name"], ['status' => '1']);
		if ($Result) {
			while( $g = $Result->fetch_assoc() ) {
				$Sms[$g['id']] = $g['name'];
			}
		}
		return $Sms;
	}

	//инфо о пользователе
	function Get_User($user) {
		$res = JBase::Get_Data('my_users', ['name','usertype','balance','registerDate','referal_id','avatar','message','phone','statuses','statin','roles',
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
	            'hi'], ['id' => $user]); 
		$UserArray = $res->fetch_assoc();
		if(!empty($UserArray))
			return $UserArray;
	}
	//генерация токена, для csrf, можно конечно еще и хешировать дополнительно
	public function generate_form_token() {
		return $_SESSION['csrf_token'] = substr( str_shuffle( 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM' ), 0, 15 );
	}
	//шаблон панели управления
	function Cabinet($user, $uri) {
		//if ($uri == 'cabinet') header('Location: /crm', true, 301);
		
		if( $user == 0 || $user == NULL || substr($user, 0, 6) == 'wadmin') {
			$user_type = '5';
		} else {
			
			$TemplateArray 		= self::Get_Template();
			$UserArray 				= self::Get_User($user);
			$user_type  			= (int)$UserArray['usertype'];
			$RoleGroup 				= explode("_", JBase::Get_Field_Value_From_Id_Nodomain('my_users_group', $user_type, 'roles'));
			$RoleUser 				= explode("_", $UserArray['roles']);

			$sms 						= self::Get_Sms();
			$operatorSetting 		= self::operatorSetting();
			$operators 				= self::Get_Operators();
			
			$salesScript			= [];
			$QQ 					= "SELECT id , script_greeting , script_confirms_order , script_end_call FROM `list22` WHERE 1";
			$ResultSalesScript		= JBase::Query($QQ);
			foreach ($ResultSalesScript as $keys => $values) {
				$salesScript[$values['id']] = $values;
			}

			$sizeAndWeight			= [];
			$QQ 					= "SELECT id , size , weight FROM `list22` WHERE 1";
			$ResultSalesScript		= JBase::Query($QQ);
			foreach ($ResultSalesScript as $keys => $values) {
				$sizeAndWeight[$values['id']] = $values;
			}
			
			$JSCat = [
				'Group'				=> implode("_", $RoleGroup),
				'Roles'				=> implode("_", $RoleUser),
				'operatorSetting'	=> $operatorSetting,
				'operators'			=> $operators,
				'sms'					=> $sms,
				'ex'					=> $UserArray['ex'],
				'bl'					=> $UserArray['bl'],
				'tr'					=> $UserArray['tr'],
				'ch'					=> $UserArray['ch'],
				'st'					=> $UserArray['st'],
				'go'					=> $UserArray['go'],
				'ar'					=> $UserArray['ar'],
				'co'					=> $UserArray['co'],
				'te'					=> $UserArray['te'],
				'mp'					=> $UserArray['mp'],
				'se'					=> $UserArray['se'],
				'li'					=> $UserArray['li'],
				'hi'					=> $UserArray['hi'],
				'userName'			=> $UserArray['name'],
				'balance'			=> $UserArray['balance'],
				'registerDate'		=> $UserArray['registerDate'],
				'referalId'			=> $UserArray['referal_id'],
				'message'			=> $UserArray['message'],
				'avatar'				=> ($UserArray['avatar'] == 'nophoto.png') ? '/cdn/lib/nophoto.png' : JLoads::$cdn. '/avatar/' .$UserArray['avatar'],
				'phone'				=> $UserArray['phone'],
				'statin'				=> $UserArray['statin'],
				'statuses'			=> $UserArray['statuses'],
				'cdn'					=> JLoads::$cdn,
				'token'				=> JLoads::$wad_md5,
				'domain'				=> DOMAIN,
				'city'				=> $TemplateArray['city'],
				'template'			=> $TemplateArray['template'],
				'templatename'		=> $TemplateArray['templatename'],
				'category'			=> $TemplateArray['category'],
				'user'				=> $user,
				'userType'			=> $user_type,
				'salesScript'		=> $salesScript,
				'sizeAndWeight'		=> $sizeAndWeight
			];
		
		}
		switch ($user_type) {
			case 1:
			case 2:
			case 3:
			case 4:
			case 6:
			case 7:
			case 9:
			case 10:
			case 11:
			case 8:
				$value = JBase::Get_Data('settings', 'value', ['name' => 'pdd_main_mailbox']); 
				$userMail = $value->fetch_assoc();
				$JSCat['userMail'] = $userMail['value'];
				include_once('./views/start.php');
			break;
			case 5:
				$value = JBase::Get_Data('settings', 'value', ['name' => 'auth_type']); 
				$auth_type = $value->fetch_assoc();
				$auth_type = $auth_type['value'];
				include_once('./views/login.php');
			break;
		}
		
	}
	
	function mod_auth() {
	
		$generate_form_token = self::generate_form_token();
		
		$value = JBase::Get_Data('settings', 'value', ['name' => 'auth_type']); 
		$auth_type = $value->fetch_assoc();
		$type = ( $auth_type['value'] === 'true' );
		
		if ( $type ) {
	
			$html = '<div id="adminlogin">
				<input type="radio" name="login" id="login1" checked="checked"/><label for="login1">Авторизация</label>
				<input type="radio" name="login" id="login2"/><label for="login2">Регистрация</label>
				<input type="radio" name="login" id="login3"/><label for="login3">Забыли пароль?</label>
				<form name="login-form" action="" method="post">
					<h1>Авторизация</h1>
					<input type="hidden" name="Auth" value="true">
					<input type="hidden" name="csrf_token" value="'. $generate_form_token .'">
					<input name="Username" type="text" placeholder="E-mail" />
					<input name="Password" placeholder="Пароль" type="password" />
					<input type="submit" name="submit" value="ВОЙТИ" />
				</form>
				<form name="reg-form" action="" method="post">
					<h1>Регистрация</h1>
					<p>Регистрируясь, вы принимаете условия<br><a target="_blank" rel="noopener noreferrer nofollow" href="/privacypolicy">Политики конфиденциальности</a></p>
					<input type="hidden" name="Register" value="true">
					<input type="hidden" name="csrf_token" value="'. $generate_form_token .'">
					<input name="Username" required type="text" placeholder="E-mail" maxlength="50">
					<input type="submit" name="submit" value="Региcтрация" />
				</form>
				<form name="forgot-form" action="" method="post">
					<h1>Восстановление пароля</h1>
					<p>Введите cвой E-mail и мы вышлем Вам<br>инcтрукцию по воccтановлению пароля</p>
					<input type="hidden" name="Forgot" value="true">
					<input type="hidden" name="csrf_token" value="'. $generate_form_token .'">
					<input name="Username" required type="text" placeholder="E-mail" maxlength="50">
					<input type="submit" name="submit" value="Воccтановить пароль" />
				</form>
			</div>';
	
		} else {
	
			$html = '<div id="adminlogin">
				<input type="radio" name="login" id="login1" checked="checked"/><label for="login1">Авторизация</label>
				<input type="radio" name="login" id="login2"/><label for="login2">Забыли пароль?</label>
				<form name="login-form" action="" method="post">
					<h1>Авторизация</h1>
					<input type="hidden" name="Auth" value="true">
					<input type="hidden" name="csrf_token" value="'. $generate_form_token .'">
					<input name="Username" type="text" placeholder="E-mail" />
					<input name="Password" placeholder="Пароль" type="password" />
					<input type="submit" name="submit" value="ВОЙТИ" />
				</form>
				<form name="forgot-form" action="" method="post">
				<h1>Восстановление пароля</h1>
						<p>Введите cвой E-mail и мы вышлем Вам<br>инcтрукцию по воccтановлению пароля</p>
					<input type="hidden" name="Forgot" value="true">
					<input type="hidden" name="csrf_token" value="'. $generate_form_token .'">
					<input name="Username" required type="text" placeholder="E-mail" maxlength="50">
					<input type="submit" name="submit" value="Воccтановить пароль" />
				</form>
			</div>';
	
		}
		return $html;
	}
}
