<?
require_once(CLASSES_BASE.'view_icms_proto.php');

class view_icms_form_account extends view_icms_proto{
	var $template = 'account-index-guest';
	var $o;

	function get_html($o) {
		$this->o = $o['object'];
		switch ($this->o['ID']) {
			case LOCATION_ACCOUNT_INDEX_GUEST:
				return $this->index_guest();
				break;
			case LOCATION_ACCOUNT_SHOW_RESTORE_PASSWORD_FORM:
				return $this->show_restore_password_form();
				break;
			case LOCATION_ACCOUNT_BAD_PASSWORD:
				return $this->bad_password();
				break;
			case LOCATION_ACCOUNT_INDEX_LOGGED:
				return $this->index_logged();
				break;
			case LOCATION_ACCOUNT_SHOW_REGISTRATION_FORM:
				return $this->show_registration_form();
				break;
			case LOCATION_ACCOUNT_SHOW_CHANGEPASSWORD:
				return $this->show_changepassword();
				break;
			case LOCATION_ACCOUNT_MY_SUBSCRIBE:
				return $this->my_subscribe();
				break;
			case LOCATION_ACCOUNT_SHOW_REGISTRATION_INFO:
				return $this->show_registration_info();
				break;
			default:
				return $this->index_guest();
				break;
			}
		}

function index_guest(){
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$t->set_var("PAGE.title", '' );
	$t->set_var("HTTPS_BASE", HTTPS_BASE );
	$t->set_block("page", "BLOCK.RESTORE", "BLOCK_RESTORE");

	$t->set_var("BLOCK_RESTORE", '');
	$t->set_block("page", "BLOCK.RESTORENONE", "BLOCK_RESTORENONE");
	$t->set_var("BLOCK_RESTORENONE", '');
	$t->set_block("page", "BLOCK.RESTOREOK", "BLOCK_RESTOREOK");
	$t->set_var("BLOCK_RESTOREOK", '');	
	$t->set_block("page", "BLOCK.INDEXGUEST", "BLOCK_INDEXGUEST");
	$t->set_var("BLOCK_INDEXGUEST", '');
	$t->parse("BLOCK_INDEXGUEST", 'BLOCK.INDEXGUEST', true);
	$t->set_block("page", "BLOCK.BADPASSWORD", "BLOCK_BADPASSWORD");
	$t->set_var("BLOCK_BADPASSWORD", '');

	$t->set_block("page", "BLOCK.REGFORM", "BLOCK_REGFORM");
	$t->set_block("BLOCK.REGFORM", "BLOCK.CITYLIST", "BLOCK_CITYLIST");
	$t->set_block("page", "BLOCK.REGOK", "BLOCK_REGOK");
	$t->set_block("page", "BLOCK.REG_EXSIST", "BLOCK_REG_EXSIST");
	$t->set_block('page', 'BLOCK.REGERROR', 'BLOCK_REGERROR');

	$t->set_var('BLOCK_REGERROR', '');
	$t->set_var("BLOCK_REGFORM", '');
	$t->set_var("BLOCK_CITYLIST", '');
	$t->set_var("BLOCK_REGOK", '');
	$t->set_var("BLOCK_REG_EXSIST", '');

	$this->_view_standart_parts($t);
	$t->parse("page","page");
	return $t->get("page");
	}

function show_restore_password_form(){
	global $m, $V;
	$subID = $this->o['subID'];
	$t = new ice_templates();
//	$t->set_file("page", CMS_TEMPLATES_SHARED.'account-restorepassword.html' );
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("HTTPS_BASE", HTTPS_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$t->set_block("page", "BLOCK.RESTORE", "BLOCK_RESTORE");
	$t->set_var("BLOCK_RESTORE", '');
	$t->set_block("page", "BLOCK.RESTORENONE", "BLOCK_RESTORENONE");
	$t->set_var("BLOCK_RESTORENONE", '');
	$t->set_block("page", "BLOCK.RESTOREOK", "BLOCK_RESTOREOK");
	$t->set_var("BLOCK_RESTOREOK", '');	
	$t->set_block("page", "BLOCK.INDEXGUEST", "BLOCK_INDEXGUEST");
	$t->set_var("BLOCK_INDEXGUEST", '');
	$t->set_block("page", "BLOCK.BADPASSWORD", "BLOCK_BADPASSWORD");
	$t->set_var("BLOCK_BADPASSWORD", '');
	$t->set_block("page", "BLOCK.REGFORM", "BLOCK_REGFORM");
	$t->set_block("BLOCK.REGFORM", "BLOCK.CITYLIST", "BLOCK_CITYLIST");
	$t->set_block("page", "BLOCK.REGOK", "BLOCK_REGOK");
	$t->set_block("page", "BLOCK.REG_EXSIST", "BLOCK_REG_EXSIST");
	$t->set_block('page', 'BLOCK.REGERROR', 'BLOCK_REGERROR');

	$t->set_var('BLOCK_REGERROR', '');
	$t->set_var("BLOCK_REGFORM", '');
	$t->set_var("BLOCK_CITYLIST", '');
	$t->set_var("BLOCK_REGOK", '');
	$t->set_var("BLOCK_REG_EXSIST", '');
	
	switch($subID) {
		case "none":
			// не найден
			$t->parse("BLOCK_RESTORE", 'BLOCK.RESTORE', true);
			$t->parse("BLOCK_RESTORENONE", 'BLOCK.RESTORENONE', true);
			break;
		case "ok":
			// пароль был выслан 
			$t->parse("BLOCK_RESTOREOK", 'BLOCK.RESTOREOK', true);
			break;
		default:
			// ничего
			$t->parse("BLOCK_RESTORE", 'BLOCK.RESTORE', true);
			break;
		};
	$this->_view_standart_parts($t);
	$t->parse("page","page");
	return $t->get("page");
	}


function bad_password(){
	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$t->set_var("PAGE.title", '' );
	$t->set_var("HTTPS_BASE", HTTPS_BASE );
	$t->set_block("page", "BLOCK.RESTORE", "BLOCK_RESTORE");
	$t->set_var("BLOCK_RESTORE", '');
	$t->set_block("page", "BLOCK.RESTORENONE", "BLOCK_RESTORENONE");
	$t->set_var("BLOCK_RESTORENONE", '');
	$t->set_block("page", "BLOCK.RESTOREOK", "BLOCK_RESTOREOK");
	$t->set_var("BLOCK_RESTOREOK", '');	
	$t->set_block("page", "BLOCK.INDEXGUEST", "BLOCK_INDEXGUEST");
	$t->set_var("BLOCK_INDEXGUEST", '');
	$t->set_block("page", "BLOCK.BADPASSWORD", "BLOCK_BADPASSWORD");
	$t->set_var("BLOCK_BADPASSWORD", '');
	$t->parse('BLOCK_BADPASSWORD', 'BLOCK.BADPASSWORD', true);
	$t->set_block("page", "BLOCK.REGFORM", "BLOCK_REGFORM");
	$t->set_block("BLOCK.REGFORM", "BLOCK.CITYLIST", "BLOCK_CITYLIST");
	$t->set_block("page", "BLOCK.REGOK", "BLOCK_REGOK");
	$t->set_block("page", "BLOCK.REG_EXSIST", "BLOCK_REG_EXSIST");
	$t->set_block('page', 'BLOCK.REGERROR', 'BLOCK_REGERROR');

	$t->set_var('BLOCK_REGERROR', '');
	$t->set_var("BLOCK_REGFORM", '');
	$t->set_var("BLOCK_CITYLIST", '');
	$t->set_var("BLOCK_REGOK", '');
	$t->set_var("BLOCK_REG_EXSIST", '');

	$this->_view_standart_parts($t);
	$t->parse("page","page");
	return $t->get("page");
	}
	
function index_logged(){
//	alid($this->user);
//	$o_orders = $this->m_basket->get_order_info_by_userid( $this->user['id'] );
	$o_orders = $this->o['orders'];
//	alid($o_orders);

	$t = new ice_templates();
	$t->set_file("page", 'account-index-logged.html' );

	$t->set_block('page', 'BLOCK.MY_ORDERS', 'BLOCK_MY_ORDERS');
	$t->set_block('BLOCK.MY_ORDERS', 'BLOCK.ORDER_LIST', 'BLOCK_ORDER_LIST');
	$t->set_block('BLOCK.ORDER_LIST', 'BLOCK.BASKET', 'BLOCK_BASKET');
	$t->set_block('page', 'BLOCK.HAVESUBSCRIBEOK', 'BLOCK_HAVESUBSCRIBEOK');
	$t->set_block('page', 'BLOCK.HAVESUBSCRIBE', 'BLOCK_HAVESUBSCRIBE');
	$t->set_block('page', 'BLOCK.HAVECHANGEPASSWORD', 'BLOCK_HAVECHANGEPASSWORD');
	$t->set_block('BLOCK.HAVECHANGEPASSWORD', 'BLOCK.HAVECHANGEPASSWORDERROR', 'BLOCK_HAVECHANGEPASSWORDERROR');
	$t->set_block('page', 'BLOCK.SHOW_REG_INFO', 'BLOCK_SHOW_REG_INFO');
	$t->set_block('page', 'BLOCK.SHOW_REG_INFO_OK', 'BLOCK_SHOW_REG_INFO_OK');
	$t->set_block('page', 'BLOCK.ERROR', 'BLOCK_ERROR');

	$t->set_var('BLOCK_MY_ORDERS', '');
	$t->set_var('BLOCK_ORDER_LIST', '');
	$t->set_var('BLOCK_BASKET', '');
	$t->set_var('BLOCK_HAVESUBSCRIBEOK', '');
	$t->set_var('BLOCK_HAVESUBSCRIBE', '');
	$t->set_var('BLOCK_HAVECHANGEPASSWORD', '');
	$t->set_var('BLOCK_HAVECHANGEPASSWORDERROR', '');
	$t->set_var('BLOCK_SHOW_REG_INFO', '');
	$t->set_var('BLOCK_SHOW_REG_INFO_OK', '');
	$t->set_var('BLOCK_ERROR', '');

	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$t->set_var("PAGE.title", '' );
	$t->set_var("HTTPS_BASE", HTTPS_BASE );

//	alid($this->o['user']);
	$t->set_var("user_name", htmlspecialchars($this->o['user']['user_name'] ) );

	$i = 1;
	foreach($o_orders['list'] as $k => $order) {
	
		//alid($order);
		
			$t->set_var('BLOCK_BASKET', '');
			$summ = 0;
			foreach($order['items'] as $kk => $item) {
				$t->set_var("name", $item['name'] );
				$t->set_var("summ_rur", number_format($item['last_price_ru'], 0, '.', '') );
				$t->set_var("quantity", $item['quantity'] );
				$t->set_var("url", $item['url'] );
				$summ += $item['last_price_ru'] * $item['quantity'];
				$t->parse('BLOCK_BASKET', 'BLOCK.BASKET', true);	
			}

			
			$t->set_var("order_number", $i );
			$t->set_var("summ_money_rur", number_format($summ, 0, '.', '') );
			$t->parse('BLOCK_ORDER_LIST', 'BLOCK.ORDER_LIST', true);
			$i++;
	}

	
	$t->parse('BLOCK_MY_ORDERS', 'BLOCK.MY_ORDERS', true);

	$this->_view_standart_parts($t);
	$t->parse("page","page");
	return $t->get("page");
}
	

	
	
	
	
	
	
	
function show_registration_form() {
//	$o_citys = $this->m_basket->_get_active_citys_list();
	$o_citys = $this->o['citys'];
	$err = isset($this->o['err'])?$this->o['err']:array();
	$subID = isset($this->o['subID'])?$this->o['subID']:'';

	$t = new ice_templates();
	$t->set_file("page", CMS_TEMPLATES_SHARED.$this->template.'.html' );
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("HTTPS_BASE", HTTPS_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );

	$t->set_block("page", "BLOCK.RESTORE", "BLOCK_RESTORE");
	$t->set_var("BLOCK_RESTORE", '');
	$t->set_block("page", "BLOCK.RESTORENONE", "BLOCK_RESTORENONE");
	$t->set_var("BLOCK_RESTORENONE", '');
	$t->set_block("page", "BLOCK.RESTOREOK", "BLOCK_RESTOREOK");
	$t->set_var("BLOCK_RESTOREOK", '');	
	$t->set_block("page", "BLOCK.INDEXGUEST", "BLOCK_INDEXGUEST");
	$t->set_var("BLOCK_INDEXGUEST", '');
	$t->set_block("page", "BLOCK.BADPASSWORD", "BLOCK_BADPASSWORD");
	$t->set_var("BLOCK_BADPASSWORD", '');

	$t->set_block("page", "BLOCK.REGFORM", "BLOCK_REGFORM");
	$t->set_block("BLOCK.REGFORM", "BLOCK.CITYLIST", "BLOCK_CITYLIST");
	$t->set_block("page", "BLOCK.REGOK", "BLOCK_REGOK");
	$t->set_block("page", "BLOCK.REG_EXSIST", "BLOCK_REG_EXSIST");
	$t->set_block('page', 'BLOCK.REGERROR', 'BLOCK_REGERROR');

	$t->set_var('BLOCK_REGERROR', '');
	$t->set_var("BLOCK_REGFORM", '');
	$t->set_var("BLOCK_CITYLIST", '');
	$t->set_var("BLOCK_REGOK", '');
	$t->set_var("BLOCK_REG_EXSIST", '');

	$t->set_var("fio", isset($err['errors_date']['fio']) ? $err['errors_date']['fio'] : '' );
	$t->set_var("phone", isset($err['errors_date']['phone']) ? $err['errors_date']['phone'] : '' );
	$t->set_var("email", isset($err['errors_date']['email']) ? $err['errors_date']['email'] : '' );

	// список городов
	if (isset($o_citys['list'])) {
		while (list($k, $v)=each($o_citys['list'])) {
			$t->set_var('city_id', $v['id']);
			$t->set_var('city_name', $v['name']);
			$t->set_var('selected', 
				((isset($this->V['city_id']) and $this->V['city_id']==$v['id']) ? ' selected="selected" ':'')
				);

			$t->parse('BLOCK_CITYLIST', 'BLOCK.CITYLIST', true);
			};

			$t->set_var('selectedother', 
				((isset($this->V['city_id']) and $this->V['city_id']==99999) ? ' selected="selected" ':'')
				);
	}

	if (isset($err['errors']) and strlen($err['errors'])>0) {
			$t->set_var('error', $err['errors']);
			$t->set_var('box-fio', ( strlen($err['errors_err']['fio_err']) > 0 ) ? 'box-pink' : 'box-none');
			$t->set_var('box-phone', ( strlen($err['errors_err']['phone_err']) > 0 ) ? 'box-pink' : 'box-none');
			$t->set_var('box-city', ( strlen($err['errors_err']['city_id_err']) > 0 ) ? 'box-pink' : 'box-none');
			$t->set_var('box-email', ( strlen($err['errors_err']['email_err']) > 0 ) ? 'box-pink' : 'box-none');
			$t->parse('BLOCK_REGERROR', 'BLOCK.REGERROR', true);
	}

	switch($subID) {
		case "ok":
			$auth_data = $this->check_login_and_insert();
			
			if($auth_data['status'] == 'new') {
				$t->set_var('login', $auth_data['login'] );
				$t->set_var('password', $auth_data['password'] );
	
				$t->parse("BLOCK_REGOK", 'BLOCK.REGOK', true);
			}
			elseif($auth_data['status'] == 'exsist') {
				$t->parse("BLOCK_REGOK_EXSIST", 'BLOCK.REGOK_EXSIST', true);
			}

			break;

		default:
			// ничего
			$t->parse("BLOCK_REGFORM", 'BLOCK.REGFORM', true);
			break;
		};

	$this->_view_standart_parts($t);
	$t->parse("page","page");
	return $t->get("page");
}
	
	
	
	
	
	
function show_changepassword() {
	global $CHANGEPASSWORD_STATUS;
	
	$t = new ice_templates();
	$t->set_file("page", 'account-index-logged.html' );
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("body_class", 'account-guest' );
	$t->set_var("PAGE.title", '' );
	$t->set_var("HTTPS_BASE", HTTPS_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );

	$t->set_block('page', 'BLOCK.MY_ORDERS', 'BLOCK_MY_ORDERS');
	$t->set_block('BLOCK.MY_ORDERS', 'BLOCK.ORDER_LIST', 'BLOCK_ORDER_LIST');
	$t->set_block('page', 'BLOCK.HAVESUBSCRIBEOK', 'BLOCK_HAVESUBSCRIBEOK');
	$t->set_block('page', 'BLOCK.HAVESUBSCRIBE', 'BLOCK_HAVESUBSCRIBE');
	$t->set_block('page', 'BLOCK.HAVECHANGEPASSWORD', 'BLOCK_HAVECHANGEPASSWORD');
	$t->set_block('BLOCK.HAVECHANGEPASSWORD', 'BLOCK.HAVECHANGEPASSWORDERROR', 'BLOCK_HAVECHANGEPASSWORDERROR');
	$t->set_block('BLOCK.HAVECHANGEPASSWORD', 'BLOCK.HAVECHANGEPASSWORDFORM', 'BLOCK_HAVECHANGEPASSWORDFORM');
	$t->set_block('page', 'BLOCK.SHOW_REG_INFO', 'BLOCK_SHOW_REG_INFO');
	$t->set_block('page', 'BLOCK.SHOW_REG_INFO_OK', 'BLOCK_SHOW_REG_INFO_OK');
	$t->set_block('page', 'BLOCK.ERROR', 'BLOCK_ERROR');

	$t->set_var('BLOCK_MY_ORDERS', '');
	$t->set_var('BLOCK_ORDER_LIST', '');
	$t->set_var('BLOCK_HAVESUBSCRIBEOK', '');
	$t->set_var('BLOCK_HAVESUBSCRIBE', '');
	$t->set_var('BLOCK_HAVECHANGEPASSWORD', '');
	$t->set_var('BLOCK_HAVECHANGEPASSWORDERROR', '');
	$t->set_var('BLOCK_HAVECHANGEPASSWORDFORM', '');
	$t->set_var('BLOCK_SHOW_REG_INFO', '');
	$t->set_var('BLOCK_SHOW_REG_INFO_OK', '');
	$t->set_var('BLOCK_ERROR', '');

/*
	if( isset($this->V['status']) ) {
		$t->set_var("HAVECHANGEPASSWORDERROR.title", $this->changepassword_status[ $this->V['status'] ]['title']);
		$t->set_var("HAVECHANGEPASSWORDERROR.text",  $this->changepassword_status[ $this->V['status'] ]['text']);

		$t->parse("BLOCK_HAVECHANGEPASSWORDERROR",   "BLOCK.HAVECHANGEPASSWORDERROR", true);
	}

	if( !isset($this->V['status']) or
		(
			isset($this->V['status']) and 
			$this->V['status'] != 'ok' 
		)
		) {
		$t->parse('BLOCK_HAVECHANGEPASSWORDFORM', 'BLOCK.HAVECHANGEPASSWORDFORM', true);
	}
*/
//	alid($this->o);
	if( (isset($this->o['subID'])) && (isset($CHANGEPASSWORD_STATUS[ $this->o['subID'] ]))  ) {
		$t->set_var("HAVECHANGEPASSWORDERROR.title", $CHANGEPASSWORD_STATUS[ $this->o['subID'] ]['title']);
		$t->set_var("HAVECHANGEPASSWORDERROR.text",  $CHANGEPASSWORD_STATUS[ $this->o['subID'] ]['text']);
		$t->parse("BLOCK_HAVECHANGEPASSWORDERROR",   "BLOCK.HAVECHANGEPASSWORDERROR", true);
	}

	if( !isset($this->o['subID']) or
		(
			isset($this->o['subID']) and 
			$this->o['subID'] != 'ok' 
		)
		) {
		$t->parse('BLOCK_HAVECHANGEPASSWORDFORM', 'BLOCK.HAVECHANGEPASSWORDFORM', true);
	}

	$t->parse('BLOCK_HAVECHANGEPASSWORD', 'BLOCK.HAVECHANGEPASSWORD', true);

	$t->set_var("menu_active.orders", '' );
	$t->set_var("menu_active.changepass", 'box-darkblue' );
	$t->set_var("menu_active.changesubscribe", '' );
	$t->set_var("menu_active.show_registration_info", '' );

	$this->_view_standart_parts($t);
	$t->parse("page","page");
	return $t->get("page");
}

	
	

	

	
	
	
	
function my_subscribe() {
	$t = new ice_templates();
	$t->set_file("page", 'account-index-logged.html' );
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );
	$t->set_var("body_class", 'account-guest' );
	$t->set_var("PAGE.title", '' );
	$t->set_var("HTTPS_BASE", HTTPS_BASE );

	$t->set_block('page', 'BLOCK.MY_ORDERS', 'BLOCK_MY_ORDERS');
	$t->set_block('BLOCK.MY_ORDERS', 'BLOCK.ORDER_LIST', 'BLOCK_ORDER_LIST');
	$t->set_block('page', 'BLOCK.HAVESUBSCRIBEOK', 'BLOCK_HAVESUBSCRIBEOK');
	$t->set_block('page', 'BLOCK.HAVESUBSCRIBE', 'BLOCK_HAVESUBSCRIBE');
	$t->set_block('page', 'BLOCK.HAVECHANGEPASSWORD', 'BLOCK_HAVECHANGEPASSWORD');
	$t->set_block('BLOCK.HAVECHANGEPASSWORD', 'BLOCK.HAVECHANGEPASSWORDERROR', 'BLOCK_HAVECHANGEPASSWORDERROR');
	$t->set_block('page', 'BLOCK.SHOW_REG_INFO', 'BLOCK_SHOW_REG_INFO');
	$t->set_block('page', 'BLOCK.SHOW_REG_INFO_OK', 'BLOCK_SHOW_REG_INFO_OK');
	$t->set_block('page', 'BLOCK.ERROR', 'BLOCK_ERROR');

	$t->set_var('BLOCK_MY_ORDERS', '');
	$t->set_var('BLOCK_ORDER_LIST', '');
	$t->set_var('BLOCK_HAVESUBSCRIBEOK', '');
	$t->set_var('BLOCK_HAVESUBSCRIBE', '');
	$t->set_var('BLOCK_HAVECHANGEPASSWORD', '');
	$t->set_var('BLOCK_HAVECHANGEPASSWORDERROR', '');
	$t->set_var('BLOCK_SHOW_REG_INFO', '');
	$t->set_var('BLOCK_SHOW_REG_INFO_OK', '');
	$t->set_var('BLOCK_ERROR', '');

	$t->parse('BLOCK_HAVESUBSCRIBE', 'BLOCK.HAVESUBSCRIBE', true);

	$t->set_var("menu_active.orders", '' );
	$t->set_var("menu_active.changepass", '' );
	$t->set_var("menu_active.changesubscribe", 'box-darkblue' );
	$t->set_var("menu_active.show_registration_info", '' );
	
	$t->set_var("subscribe.email", $this->o['user']['email'] );
	
	$t->set_var("subscribe.checked_active", ($this->o['user']['subscribe_status'] == 'active') ? 'checked="checked"' : '' );
	$t->set_var("subscribe.checked_disabled", ($this->o['user']['subscribe_status'] == 'disabled') ? 'checked="checked"' : '' );

	$this->_view_standart_parts($t);
	$t->parse("page","page");
	return $t->get("page");
}
	
	
	
	
	
	
	
	
function show_registration_info($status = '', $err = array()) {
	$t = new ice_templates();
	$t->set_file("page", 'account-index-logged.html' );
	$t->set_var("HTTP_BASE", HTTP_BASE );
	$t->set_var("PAGE.title", '' );
	$t->set_var("HTTPS_BASE", HTTPS_BASE );
	$t->set_var("PAGE.url", HTTP_BASE.$o['object']['url'] );

	$t->set_block('page', 'BLOCK.MY_ORDERS', 'BLOCK_MY_ORDERS');
	$t->set_block('BLOCK.MY_ORDERS', 'BLOCK.ORDER_LIST', 'BLOCK_ORDER_LIST');
	$t->set_block('page', 'BLOCK.HAVESUBSCRIBEOK', 'BLOCK_HAVESUBSCRIBEOK');
	$t->set_block('page', 'BLOCK.HAVESUBSCRIBE', 'BLOCK_HAVESUBSCRIBE');
	$t->set_block('page', 'BLOCK.HAVECHANGEPASSWORD', 'BLOCK_HAVECHANGEPASSWORD');
	$t->set_block('BLOCK.HAVECHANGEPASSWORD', 'BLOCK.HAVECHANGEPASSWORDERROR', 'BLOCK_HAVECHANGEPASSWORDERROR');
	$t->set_block('page', 'BLOCK.SHOW_REG_INFO', 'BLOCK_SHOW_REG_INFO');
	$t->set_block('page', 'BLOCK.SHOW_REG_INFO_OK', 'BLOCK_SHOW_REG_INFO_OK');
	$t->set_block('page', 'BLOCK.ERROR', 'BLOCK_ERROR');

	$t->set_var('BLOCK_MY_ORDERS', '');
	$t->set_var('BLOCK_ORDER_LIST', '');
	$t->set_var('BLOCK_HAVESUBSCRIBEOK', '');
	$t->set_var('BLOCK_HAVESUBSCRIBE', '');
	$t->set_var('BLOCK_HAVECHANGEPASSWORD', '');
	$t->set_var('BLOCK_HAVECHANGEPASSWORDERROR', '');
	$t->set_var('BLOCK_SHOW_REG_INFO', '');
	$t->set_var('BLOCK_SHOW_REG_INFO_OK', '');
	$t->set_var('BLOCK_ERROR', '');

	$t->set_var("user_id", $this->o['user']['user_id'] );
	$t->set_var("user_cityid", $this->o['user']['city_id'] );
	$t->set_var("user_fio",   (isset($this->V['fio'])) ? htmlspecialchars($this->V['fio']) : htmlspecialchars($this->o['user']['user_name']) );
	$t->set_var("user_email", (isset($this->V['email'])) ? $this->V['email'] : $this->o['user']['email'] );
	$t->set_var("user_login", (isset($this->V['login'])) ? $this->V['login'] : $this->o['user']['login'] );
	$t->set_var("user_telephone", (isset($this->V['telephone'])) ? $this->V['telephone'] : $this->o['user']['phone'] );
	$t->set_var("user_address", (isset($this->V['address'])) ? $this->V['address'] : $this->o['user']['address'] );

	if (isset($err['errors']) and strlen($err['errors'])>0) {
			$t->set_var('error', $err['errors']);
			$t->parse('BLOCK_ERROR', 'BLOCK.ERROR', true);
	}

	if($status == 'ok') {
		$t->parse('BLOCK_SHOW_REG_INFO_OK', 'BLOCK.SHOW_REG_INFO_OK', true);
	}
	else {
		$t->parse('BLOCK_SHOW_REG_INFO', 'BLOCK.SHOW_REG_INFO', true);
	}

	$this->_view_standart_parts($t);
	$t->parse("page","page");
	return $t->get("page");
}

	
	
	
	
	
}
?>
