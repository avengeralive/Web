<?
require_once(CLASSES_BASE.'model_icms_proto.php');
require_once(CLASSES_BASE.'model_basket.php');
require_once(CLASSES_BASE.'model_shopuser.php');
require_once(CLASSES_BASE.'model_logged_cookies.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_html_mime_mail.php');
require_once(CLASSES_BASE.'model_trigger.php');

class model_icms_form_account extends model_icms_proto{
	var $model_basket;
	var $V;
	var $template_admin = 'mail_form_account';
	var $id;
	var $subscribe_to_value = array(
		'1'=>'active',
		'2'=>'disabled'
		);
	var $spam_array;
	var $changepassword_status;
	var $interface_form;
	var $interface_form_reg;

function __construct(){
	global $SPAM_ARRAY, $CHANGEPASSWORD_STATUS, $INTERFACE_FORM, $INTERFACE_FORM_REG;
	$this->spam_array = $SPAM_ARRAY;
	$this->changepassword_status = $CHANGEPASSWORD_STATUS;
	$this->interface_form = $INTERFACE_FORM;
	$this->interface_form_reg = $INTERFACE_FORM_REG;
	}

function get_object_by_id($id) {
	global $V,$HTTP_POST_VARS,$HTTP_GET_VARS;
	$this->id = $id;
	
	$this->m = new ice_mysql();
	$this->m_user = new model_shopuser(&$this->m, MYSQL_DB.'.user_card');
	$this->m_basket = new model_basket(&$this->m, MYSQL_DB);
	$this->m_logged = new model_logged_cookies(&$this->m, LOGGED_SECRET_KEY);

	if (isset($HTTP_POST_VARS['action'])) {
		$ID = $HTTP_POST_VARS['action'];
		$this->V = $HTTP_POST_VARS;
		}
	elseif (isset($HTTP_GET_VARS['action'])) {
		$ID = $HTTP_GET_VARS['action'];
		$this->V = $HTTP_GET_VARS;
		}
	else {
		$ID = 'index';
		$this->V = $V;
		};

//	alid($HTTP_POST_VARS);
//	alid($HTTP_GET_VARS);
//	alid($ID);
//	alid($this->V);
	switch($ID) {

	// гостевые

			// показать что ввели плохой пароль
			case LOCATION_ACCOUNT_BAD_PASSWORD:
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>$ID
							)
						);
				break;


			// показать форму восстановления пароля
			case LOCATION_ACCOUNT_SHOW_RESTORE_PASSWORD_FORM:
				$subID = (isset($this->V[LOCATION_ACCOUNT_SUBID])) ?  $this->V[LOCATION_ACCOUNT_SUBID] : '';
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>$ID,
							'subID'=>$subID
							)
						);
				break;


			// восстановить пароль.
			case LOCATION_ACCOUNT_TRY_RESTORE_PASSWORD:
				if (
					isset($this->V['login']) && 
					(strlen($this->V['login']) >0)
					){
						// попробуем проверить 
						$ret_try = $this->try_restore_password(	$this->V['login']	);
						if( 'none' == $ret_try['status'] ) {
							header('Location: /'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_SHOW_RESTORE_PASSWORD_FORM.'/?'.LOCATION_ACCOUNT_SUBID.'=none');
							exit();
							}
						elseif( 'ok' == $ret_try['status'] ) {
							header('Location: /'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_SHOW_RESTORE_PASSWORD_FORM.'/?'.LOCATION_ACCOUNT_SUBID.'=ok');
							exit();
							};
					}
				else {
					// да и проверять нечего 
					header('Location: /'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_SHOW_RESTORE_PASSWORD_FORM.'/?'.LOCATION_ACCOUNT_SUBID.'=none');
					exit();
					};
				break;

				
			// залогинится 
			case LOCATION_ACCOUNT_LOGIN:
				return $this->login();
				break;


			// первая странрца аккаунта для гостей 
			case LOCATION_ACCOUNT_INDEX_GUEST:
				$user = $this->check_cookie_session();
				if ($user['status']){
					$this->user = $user['user'];
					$o_orders = $this->m_basket->get_order_info_by_userid( $this->user['id'] );
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>LOCATION_ACCOUNT_INDEX_LOGGED,
							'orders'=>$o_orders
							)
						);
					}
				else {
					// не залогинен
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>LOCATION_ACCOUNT_INDEX_GUEST
							)
						);
					};
				break;

				
	// негостевые

	
			// первая страница для залогиненого
			case LOCATION_ACCOUNT_INDEX_LOGGED:
				$user = $this->check_cookie_session();
				if (!($user['status'])) {
					header('Location: /'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_INDEX_GUEST.'/?rand='.rand() );
					exit();
					};
				$this->user = $user['user'];
				$o_orders = $this->m_basket->get_order_info_by_userid( $this->user['id'] );
				//alid($o_orders);
				return array(
					'status'=>true,
					'object'=>array(
						'ID'=>LOCATION_ACCOUNT_INDEX_LOGGED,
						'user'=>$this->user,
						'orders'=>$o_orders
						)
					);
				break;


			// разлогинится 
			case LOCATION_ACCOUNT_LOGOUT:
				$user = $this->check_cookie_session();
				if (!($user['status'])){
					header('Location: /'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_INDEX_GUEST.'/?rand='.rand() );
					exit();
					};
				$this->user = $user['user'];
				$this->set_logout();
				header('Location: /'.LOCATION_ACCOUNT.'/?rand='.rand()	);
				break;


			case LOCATION_ACCOUNT_SHOW_REGISTRATION_FORM:
				$user = $this->check_cookie_session();
				if ($user['status']){
					$this->user = $user['user'];
					$o_orders = $this->m_basket->get_order_info_by_userid( $this->user['id'] );
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>LOCATION_ACCOUNT_INDEX_LOGGED,
							'orders'=>$o_orders
							)
						);
					}
				else {
					// не залогинен
					$subID = (isset($this->V[LOCATION_ACCOUNT_SUBID])) ?  $this->V[LOCATION_ACCOUNT_SUBID] : '';
					$o_citys = $this->m_basket->_get_active_citys_list();
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>LOCATION_ACCOUNT_SHOW_REGISTRATION_FORM,
							'subID'=>$subID,
							'citys'=>$o_citys
							)
						);


					};
				break;


			case LOCATION_ACCOUNT_TRY_REGISTRATION_FORM:
				$user = $this->check_cookie_session();
				if ($user['status']){
					// если вдруг залогинен то вернем страницу для залогиненого пользователя 
					$this->user = $user['user'];
					$o_orders = $this->m_basket->get_order_info_by_userid( $this->user['id'] );
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>LOCATION_ACCOUNT_INDEX_LOGGED,
							'orders'=>$o_orders
							)
						);
					}
				else {
					$err = $this->process_registration();
					if($err['status']) {
						return array(
							'status'=>true,
							'object'=>array(
								'ID'=>LOCATION_ACCOUNT_SHOW_REGISTRATION_FORM,
								'subID'=>'ok',
								'citys'=>$o_citys
								)
							);
					}
					else 
					{
						return array(
							'status'=>true,
							'object'=>array(
								'ID'=>LOCATION_ACCOUNT_SHOW_REGISTRATION_FORM,
								'subID'=>'error',
								'citys'=>$o_citys,
								'error'=>$err
								)
							);
					};
				};
				break;


			case LOCATION_ACCOUNT_SHOW_CHANGEPASSWORD:
				$user = $this->check_cookie_session();
				$subID = (isset($this->V[LOCATION_ACCOUNT_SUBID])) ?  $this->V[LOCATION_ACCOUNT_SUBID] : '';
				if ($user['status']){
					$this->user = $user['user'];
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>$ID,
							'subID'=>$subID,
							'user'=>$user['user']
							)
						);
					}
				else {
					// не залогинен
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>LOCATION_ACCOUNT_INDEX_GUEST
							)
						);
					};
				break;


			case LOCATION_ACCOUNT_TRY_CHANGEPASSWORD:
				$user = $this->check_cookie_session();
				if ($user['status']){
					$this->user = $user['user'];
					return $this->try_changepassword();
					}
				else {
					// не залогинен
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>LOCATION_ACCOUNT_INDEX_GUEST
							)
						);
					};
				break;


			case LOCATION_ACCOUNT_MY_SUBSCRIBE:
				$user = $this->check_cookie_session();
				if ($user['status']){
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>$ID,
							'user'=>$user['user']
							)
						);
					}
				else {
					header('Location: /'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_INDEX_GUEST.'/?rand='.rand() );
					exit();
					};
				break;


			case LOCATION_ACCOUNT_TRY_SUBSCRIBE:
				$user = $this->check_cookie_session();
				if ($user['status']){
					$this->user = $user['user'];
					$s = $this->m_user->change_subscribe_for_user( $this->user['user_id'], $this->subscribe_to_value[$this->V['subscribe_status']] );
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>LOCATION_ACCOUNT_MY_SUBSCRIBE,
							'user'=>$user['user']
							)
						);
					
					}
				else {
					// не залогинен
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>LOCATION_ACCOUNT_INDEX_GUEST
							)
						);
					};
				break;


			case LOCATION_ACCOUNT_SHOW_REGISTRATION_INFO:
				$user = $this->check_cookie_session();
				if ($user['status']){
					$this->user = $user['user'];
					$subID = (isset($this->V[LOCATION_ACCOUNT_SUBID])) ?  $this->V[LOCATION_ACCOUNT_SUBID] : '';
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>LOCATION_ACCOUNT_SHOW_REGISTRATION_INFO,
							'subID'=>$subID,
							'user'=>$user['user']
							)
						);
					}
				else {
					header('Location: /'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_INDEX_GUEST.'/?rand='.rand() );
					exit();
					};
				break;


			case LOCATION_ACCOUNT_TRY_REGISTRATION_INFO:
				$user = $this->check_cookie_session();
				if ($user['status']){
					$this->user = $user['user'];
					$err = $this->try_registration_info();
					if($err['status']) {
						return array(
							'status'=>true,
							'object'=>array(
								'ID'=>LOCATION_ACCOUNT_SHOW_REGISTRATION_INFO,
								'subID'=>'ok',
								'user'=>$user['user']
								)
							);
						}
					else {
						return array(
							'status'=>true,
							'object'=>array(
								'ID'=>LOCATION_ACCOUNT_SHOW_REGISTRATION_INFO,
								'subID'=>'error',
								'error'=>$err,
								'user'=>$user['user']
								)
							);
					}
				}
				else {
					// не залогинен
					return array(
						'status'=>true,
						'object'=>array(
							'ID'=>LOCATION_ACCOUNT_INDEX_GUEST
							)
						);
					};
				break;


			default:
				$user = $this->check_cookie_session();
				if ($user['status']){
					header('Location: /'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_INDEX_LOGGED.'/?rand='.rand() );
					}
				else {
					return array(
						'status'=>true,
						'object'=>array('ID'=>LOCATION_ACCOUNT_INDEX_GUEST)
						);
					};
				break;

			
			};
	}




function login(){
	if (
		isset($this->V['login']) &&
		isset($this->V['password']) &&
		(strlen($this->V['login'])>0) &&
		(strlen($this->V['password'])>0)
		) {
		$o_ = $this->m_user->check_login($this->V['login'], $this->V['password']);
		if (isset($o_['exist']) && $o_['exist']) {
			$o_key = $this->m_logged->get_key();
			$s_logged = $this->m_logged->set_logged($o_key['full_key'], $o_['user_id']);
			if ($s_logged['status']) {
				header('location: /'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_INDEX_LOGGED.'/&rand='.rand() );
				exit();
				};
			};
		};
	header('location: /'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_BAD_PASSWORD.'/&rand='.rand() );
	exit();
	}





function try_changepassword() {
	if (!(   isset($this->V['newpass1']) && isset($this->V['newpass2'])	)) {
		header('Location: '.HTTP_BASE.'/'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_SHOW_CHANGEPASSWORD.'/?'.LOCATION_ACCOUNT_SUBID.'=nodata');
		exit();
		};
	if (	5 > strlen($this->V['newpass1'])	){
		header('Location: '.HTTP_BASE.'/'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_SHOW_CHANGEPASSWORD.'/?'.LOCATION_ACCOUNT_SUBID.'=badlength');
		exit();
		};
	if (	$this->V['newpass1'] != $this->V['newpass2']	) {
		header('Location: '.HTTP_BASE.'/'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_SHOW_CHANGEPASSWORD.'/?'.LOCATION_ACCOUNT_SUBID.'=mismatch');
		exit();
		};
	if (	$this->V['newpass1'] == $this->user['email']	) {
		header('Location: '.HTTP_BASE.'/'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_SHOW_CHANGEPASSWORD.'/?'.LOCATION_ACCOUNT_SUBID.'=badpass');
		exit();
		};

	$s = $this->m_user->change_password_for_user( $this->user['user_id'], $this->V['newpass1'] );
	header('Location: '.HTTP_BASE.'/'.LOCATION_ACCOUNT.'/'.LOCATION_ACCOUNT_SHOW_CHANGEPASSWORD.'/?'.LOCATION_ACCOUNT_SUBID.'=ok');
	exit();
	}



// обновить регистрационные данные 
function try_registration_info() {
	$errors = '';
	$o_user_form = array();
	$o_user_form_error = array();

	while (list($k, $v) = each($this->interface_form_reg['order'])) {
		if (
			isset($this->V[$k]) &&
			preg_match("<".$v['regexp'].">m", $this->V[$k]) 
			) {
			// ok
			$o_user_form[$k] = $this->V[$k];
			$o_user_form_error[$k.'_err'] = '';
			}
		else {
			// err
			$errors .= "<li>".$v['message']."</li>";
			$o_user_form[$k] = $this->V[$k];  // надо показать все же
			$o_user_form_error[$k.'_err'] = $v['message'];
			};
		};

	if (
		( $this->check_for_spam($o_user_form['fio']) ) ||
		( $this->check_for_spam($this->V['address']) ) ||
		( $this->check_for_spam($this->V['telephone']) ) 
	){
	        $errors .= '<li>'.$this->interface_form['spam_message'].'</li>';
	};

	if (strlen($errors)>0) {
		return array(
			'status' => false,
			'errors' => $errors,
			'errors_date' => $o_user_form,
			'errors_err' => $o_user_form_error
			);

	};

	$this->m_user->change_userinfo_afterorder(	$this->V['user_id'],
												$this->V['fio'],
												$this->V['email'],
												$this->V['telephone'],
												$this->V['user_cityid'],
												$this->V['address'] );

	return array(
		'status' => true
		);
}


/**
 *	Checking and registration user
 */
function check_login_and_insert() {
	$o_login = $this->m_user->get_public_card_by_login($this->V['email']);

	if( !$o_login['exist'] ) {
		// придумаем пароль для пользователя
		$password = $this->m_user->generateNewPassword(5);

		// insert user autorization into database
		$address = '';
		$this->m_user->insert_public_card( $this->V['fio'], $this->V['email'], $password, $this->V['email'], $this->V['phone'], $this->V['city_id'], $address);
		
		// send mail for user about autorization information
		$this->sendMail_registration_ok($this->V['email']);
	}
	else {
		$this->try_restore_password($this->V['email']);

		return array(
			'status' => 'exsist',
			'login' => $this->V['email'],
			'password' => $o_login['user']['password']
			);
	}

	return array(
		'status' => 'new',
		'login' => $this->V['email'],
		'password' => $password
		);
}






function try_restore_password(	$login	){
	$o = $this->m_user->get_public_card_by_login( $login );
//alid($o);

	if (
		($o['status']) && 
		($o['exist']) 
		) {
		// пошлем письмо

		$t = new ice_templates();
		$t->set_file("page", 'account-restorepass-email.txt' );
		$t->set_var("name",     $o['user']['user_name'] );
		$t->set_var("login",    $o['user']['login'] );
		$t->set_var("password", $o['user']['password'] );
		$t->set_var("email",    $o['user']['email'] );
		$t->set_var("HTTP_BASE", HTTP_BASE );
		$t->set_var("HTTPS_BASE", HTTPS_BASE );
		$t->parse("page","page");
		$body =  $t->get("page");

		$mail_ = html_mime_mail::sendTxtMail(  
			$o['user']['email'], 
			USERACCOUNT_SUBJECT_RESTOREPASS, 
			$body,
			SUBSCRIBE_SENDMAIL_FROM_EMAIL, SUBSCRIBE_SENDMAIL_FROM_NAME
			);

		// TRIGGER
		$tr = new model_trigger(&$this->m);
		$s = $tr->call_trigger('try_restore_password_ok', array(
				"name" =>$o['user']['user_name'],
				"login"=>$o['user']['login'],
				"email"=>$o['user']['email']
				)
			);
		// /TRIGGER

		return array(
			'status' => 'ok'
			);
		}
	else {
		return array(
			'status' => 'none'
			);
		};
	}



function sendMail_registration_ok( $login ) {
	$o = $this->m_user->get_public_card_by_login( $login );

	if (
		($o['status']) && 
		($o['exist']) 
		) {
		// пошлем письмо

		$t = new ice_templates();
		$t->set_file("page", 'account-registration-email.txt' );
		$t->set_var("name",     $o['user']['user_name'] );
		$t->set_var("login",    $o['user']['login'] );
		$t->set_var("password", $o['user']['password'] );
		$t->set_var("email",    $o['user']['email'] );
		$t->set_var("HTTP_BASE", HTTP_BASE );
		$t->set_var("HTTPS_BASE", HTTPS_BASE );
		$t->parse("page","page");
		$body =  $t->get("page");

		$mail_ = html_mime_mail::sendTxtMail(  
			$o['user']['email'], 
			USERACCOUNT_SUBJECT_AUTORIZATION, 
			$body,
			SUBSCRIBE_SENDMAIL_FROM_EMAIL, SUBSCRIBE_SENDMAIL_FROM_NAME
			);
	}
}





/*
Проверим кукисы у пользователя. Если у него есть подходящий кукис, он залогинен и не подделан - то юзер залогинен.
*/
function check_cookie_session(){
	global $_COOKIE;
	if (isset($_COOKIE['JSESSIONID'])) {
		$JSESSIONID = $_COOKIE['JSESSIONID'];
		$o_logged = $this->m_logged->is_logged( $JSESSIONID );
		if ($o_logged['status']){
			return array(
				'status'=>true,
				'user'=>$o_logged['user'],
				'key'=>$o_logged['key'],
				'JSESSIONID'=>$JSESSIONID
				);
			};
		};
	return array(
		'status'=>false
		);
	}









function set_logout(){
	global $_COOKIE;
	if (isset($_COOKIE['JSESSIONID'])) {
		$JSESSIONID = $_COOKIE['JSESSIONID'];
		$s_ = $this->m_logged->set_logout( $JSESSIONID);
		return;
		};
	}





	
	
/*
Проверим введенные пользователем поля на спам.
*/
function check_for_spam($message) {
	reset($this->spam_array);
	while (list($k, $v) = each($this->spam_array) ) {
		if (preg_match($v,$message)) {
			return true;
		}
	}
	return false;
}




function process_registration() {
	$errors = '';
	$o_user_form = array();
	$o_user_form_error = array();

	while (list($k, $v) = each($this->interface_form['registration'])) {
		if (
			isset($this->V[$k]) &&
			preg_match("<".$v['regexp'].">m", $this->V[$k]) 
			) {
			// ok
			$o_user_form[$k] = $this->V[$k];
			$o_user_form_error[$k.'_err'] = '';
			}
		else {
			// err
			$errors .= "<li>".$v['message']."</li>";
			$o_user_form[$k] = $this->V[$k];  // надо показать все же
			$o_user_form_error[$k.'_err'] = $v['message'];
			};
		};

	if (
		( $this->check_for_spam($o_user_form['fio']) ) ||
		( $this->check_for_spam($o_user_form['phone']) ) 
	){
	        $errors .= '<li>'.$this->interface_form['spam_message'].'</li>';
	};

	if (strlen($errors)>0) {
		return array(
			'status' => false,
			'errors' => $errors,
			'errors_date' => $o_user_form,
			'errors_err' => $o_user_form_error
			);

	};
	
	return array(
		'status' => true
		);
}



}
?>