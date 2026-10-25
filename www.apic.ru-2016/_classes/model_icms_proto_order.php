<?
require_once(CLASSES_BASE.'model_icms_proto.php');
require_once(CLASSES_BASE.'model_basket.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_html_mime_mail.php');

class model_icms_proto_order extends model_icms_proto{

var $model_basket;
var $V;
var $template_user = 'proto_mail_order_user';
var $template_admin = 'proto_mail_order_admin';
var $avail_map = array(
		'0'=>'ѕод заказ',
		'1'=>'Ќет',
		'2'=>'≈сть',
		''=>'Ќеизвестно'
		);


function get_object_by_id($id) {
	global $V,$HTTP_POST_VARS,$HTTP_GET_VARS;

//	alid($V);
//	alid($_GET);
//	alid($_POST);

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


//	alid($this->V);

$this->model_basket = new model_basket($this->m );

switch($ID){
	case "index":
		$object = $this->index();
		break;
	case "process_order":
		$object = $this->process_order();
		break;
	case "remove":
		$object = $this->remove();
		break;
	case "update":
		$object = $this->update();
		break;
	case "add":
		$object = $this->add();
		break;
	case "cookie_disabled":
		$object = $this->cookiedisabled();
		break;
	case "check_add":
		$object = $this->check_add();
		break;
	case "order_ok":
		$object = $this->order_ok();
		break;
	default:
		$object = $this->index();
		break;
	};


//	alid($object);
    return Array(
        'status'=>true,
        'ID'=>$ID,
		'object'=>$object
		);
	}




function order_ok(){
	return array(
		'status'=>true,
		'ID'=>'order_ok'
		);
	}




function cookiedisabled() {
	return array(
		'status' => false,
		'basket' => array()
	);
}


// показать что в корзинке
function index(){
	global $_COOKIE;

	$status = $this->checkUserSession();
	if (!$status) {
		// куки однозначно отключены. ну нельз€ же так.
		Header("Location: ".URL_ORDER."?action=cookie_disabled&amp;".md5(time()) );
		exit();
		}

	if (!isset($_COOKIE[SESSION_COOKIE_NAME])) {
		return array('status'=>false,'basket'=>array() );
		};

	$o_basket = $this->model_basket->get_basket(
		$this->decodeModUidCookieAsLogRecord( $_COOKIE[SESSION_COOKIE_NAME] )
		);

	$o_special = $this->get_specials_for_url( 10, '/classic/' );
	$o_money = $this->get_money();

	//alid($o_special);

	$this->setVisualCookie($o_basket['item_count'], $o_basket['summ_money_rur'], $o_basket );

	return array(
		'status'=>true,
		'basket'=>$o_basket,
		'special'=>$o_special['childs'],
	    'money'=>$o_money['childs'],
		);
	}




function process_order(){
	global $V, $m, $model_basket, $ORDERS_INTERFACE, $HTTP_POST_VARS;

//alid(	$HTTP_POST_VARS	);

	$errors = '';
	$o_user_form = array();
	$o_user_form_error = array();
	while (list($k, $v) = each($ORDERS_INTERFACE)) {
		if (
			isset($HTTP_POST_VARS[$k]) &&
			preg_match("<".$v['regexp'].">m", $HTTP_POST_VARS[$k]) 
			) {
			// ok
			$o_user_form[$k] = $HTTP_POST_VARS[$k];
			$o_user_form_error[$k.'_err'] = '';
			}
		else {
			// err
			$errors .= "".$v['message']."";
//			$o_user_form[$k] = '';  // надо показать все же
			$o_user_form[$k] = $HTTP_POST_VARS[$k];  // надо показать все же
			$o_user_form_error[$k.'_err'] = $v['message'];
			};
		};
	$o_basket = $this->model_basket->get_basket($this->decodeModUidCookieAsLogRecord($_COOKIE[SESSION_COOKIE_NAME]));


	if (strlen($errors)>0) {
		// есть ошибки. нельз€ оформить заказ.
//		return index($o_user_form,$o_user_form_error,$errors);
		return array(
			'status'=>true,
			'basket'=>$o_basket,
			'user'=>$o_user_form,
			'errors'=>$errors
			);
		};



	// нет ошибок
	//обработаем загружаемый файл
	$s_file = $this->process_uploaded_file('file', ROOT_UPLOADS);

	$status = $this->model_basket->add_order(
			$this->decodeModUidCookieAsLogRecord($_COOKIE[SESSION_COOKIE_NAME]), 
			$o_user_form['fio'], 
			$o_user_form['email'], 
			$o_user_form['phone'], 
			$o_user_form['address'], 
			$o_user_form['company'], 
			(isset($s_file['file'])?$s_file['file']:''),
			$o_basket
			);

	$o_user_form['order_id'] = $this->model_basket->order_id;
	// отпарсим и пошлем письмо пользователю
	$this->_send_email_to_user(&$m, &$o_user_form, &$o_basket );

	// отпарсим и пошлем письмо администрации
	$this->_send_email_to_admin(&$m, &$o_user_form, &$o_basket, $s_file);

	// отпарсим и пошлем SMS  администрации
	$this->_send_sms_to_admin(&$m, &$o_user_form, &$o_basket, $s_file);

	// очистим куки
	$this->clearVisualCookie();

	Header("Location: ".URL_ORDER."?action=order_ok&".md5(time()) );
	exit();
	}








// создать письмо и отослать его пользователю. тут у нас модель немного работает как view :)
function _send_email_to_user($m, $o_user_form, $o_basket){
	global $ORDERS_EMAIL_EXTRA;

	$t = new ice_templates();
//	$t->set_file("page", TEMPLATES_ROOT.$this->template_user.".txt");
	$t->set_file("page", TEMPLATES_ROOT.$this->template_user.".html");
//	$t->set_var("page", $user_email['text']['text'] );
	reset($o_user_form);
	while (list($k, $v)=each($o_user_form)) {
		$t->set_var($k, $v );
		};

	$t->set_block('page', 'BLOCK.BASKET',         'BLOCK_BASKET');
	$t->set_var('BLOCK_BASKET', '');
	reset($o_basket['basket']);
	while (list($k, $v)=each($o_basket['basket'])) {
		$t->set_var('name', $v['name']);
//		$t->set_var('url', $v['url']);
		$t->set_var('last_price', number_format($v['last_price_ru'],0,'.',' ') );
		$t->set_var('quantity', $v['quantity']);
		$t->set_var('sum_price', number_format($v['quantity']*$v['last_price_ru'],0,'.',' ') );


				$t->set_var('url', 
								($v['type']=='pomo_folder_catalog_item_card')?
								$v['url']:$v['parent_url'] );
								
				if ($v['type']=='pomo_folder_catalog_item_card') {
					list($width, $height, $type, $attr) = getimagesize(ALL_ROOT_BASE.'public'.$v['image'] );
					$w = $width;
					$h = $height;
					if ($width>149){
						$w = 149;
						$h = $height*(149/$width);
						};
					if ($h>149){	
						$h = 149;
						$w = $width*(149/$height);
						};					
					$t->set_var('w', intval($w) );
					$t->set_var('h', intval($h) );
					$t->set_var('image', (strlen($v['image'])>0)?$v['image']:
							"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
							);
					}
				else {
					list($width, $height, $type, $attr) = getimagesize(ALL_ROOT_BASE.'public'.$v['parent_image'] );
					$w = $width;
					$h = $height;
					if ($width>149){
						$w = 149;
						$h = $height*(149/$width);
						};
					if ($h>149){	
						$h = 149;
						$w = $width*(149/$height);
						};					
					$t->set_var('w', intval($w) );
					$t->set_var('h', intval($h) );
						$t->set_var('image', (strlen($v['parent_image'])>0)?$v['parent_image']:
							"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
							);
						};




		$t->parse('BLOCK_BASKET', 'BLOCK.BASKET', true);
		};
	$t->set_var('total_summ_rur',  number_format( $o_basket['summ_money_rur'] ,0,'.',' ') );
	
	$t->set_var('city_id', $GLOBALS['POMO_CITY'][POMO_CITY_ID]['id']);
	$t->set_var('city_name', $GLOBALS['POMO_CITY'][POMO_CITY_ID]['name']);
	$t->set_var('order_id', $o_user_form['order_id']);
	$t->set_var('HTTP_BASE', HTTP_BASE);
	
	$t->set_block('page', 'BLOCK.CORP',         'BLOCK_CORP');
	$t->set_var('BLOCK_CORP', '');
	if ($o_user_form['company']!=''){
		$t->parse('BLOCK_CORP', 'BLOCK.CORP', true);
		};
	
	$t->parse("page","page");
	$mail_user_body =  $t->get("page");
//	echo '<pre>'.$mail_user_body.'</pre>';

/*
	html_mime_mail::sendHTMLMail(
		$o_user_form['email'], 
		ORDERS_USER_EMAIL_SUBJECT,
		$mail_user_body,
		ORDERS_FROM_EMAIL,
		ORDERS_FROM_EMAIL
		);
*/
	html_mime_mail::sendHTMLMail(
		$o_user_form['email'], 
		ORDERS_USER_EMAIL_SUBJECT.' '.$GLOBALS['POMO_CITY'][POMO_CITY_ID]['name'].' N'.$GLOBALS['POMO_CITY'][POMO_CITY_ID]['id'].'-'.$o_user_form['order_id'],
		'',
		$mail_user_body,
		ORDERS_FROM_EMAIL,
		ORDERS_FROM_EMAIL,
		ORDERS_FROM_EMAIL
		);



        reset($ORDERS_EMAIL_EXTRA);
	while (list($kk, $vv)=each($ORDERS_EMAIL_EXTRA)) {
 	html_mime_mail::sendHTMLMail(
		$vv, 
		ORDERS_USER_EMAIL_SUBJECT.' '.$GLOBALS['POMO_CITY'][POMO_CITY_ID]['name'].' N'.$GLOBALS['POMO_CITY'][POMO_CITY_ID]['id'].'-'.$o_user_form['order_id'],
		'',
		$mail_user_body,
		ORDERS_FROM_EMAIL,
		ORDERS_FROM_EMAIL,
		ORDERS_FROM_EMAIL
		);

		};

		


	}



function _send_email_to_admin($m, $o_user_form, $o_basket, $s_file){
	global $ORDERS_EMAIL;
	$t = new ice_templates();
	$t->set_file("page", TEMPLATES_ROOT.$this->template_admin.".txt");
//	$t->set_var("page", $user_email['text']['text'] );
	reset($o_user_form);
	while (list($k, $v)=each($o_user_form)) {
		$t->set_var($k, $v );
		};

	$t->set_block('page', 'BLOCK.BASKET',         'BLOCK_BASKET');
	$t->set_var('BLOCK_BASKET', '');
	reset($o_basket['basket']);
	while (list($k, $v)=each($o_basket['basket'])) {
		$t->set_var('name', $v['name']);
		$t->set_var('last_price', number_format($v['last_price_ru'],0,'.','') );
		$t->set_var('quantity', $v['quantity']);
		$t->set_var('avail', $this->avail_map[ $v['avail']	]);
		$t->set_var('url', HTTP_BASE.$v['url'] );
		$t->parse('BLOCK_BASKET', 'BLOCK.BASKET', true);
		};
	$t->set_var('total_summ_rur',  number_format( $o_basket['summ_money_rur'] ,0,'.','') );

	$t->set_var('city_id', $GLOBALS['POMO_CITY'][POMO_CITY_ID]['id']);
	$t->set_var('city_name', $GLOBALS['POMO_CITY'][POMO_CITY_ID]['name']);
	$t->set_var('HTTP_BASE', HTTP_BASE);


	$t->parse("page","page");
	$mail_user_body =  $t->get("page");
//	echo '<pre>'.$mail_user_body.'</pre>';


	while (list($kk, $vv)=each($ORDERS_EMAIL)) {
		if (isset($s_file['file'])){
			html_mime_mail::sendTxtMailAndAttachment(
				$vv, 
				array(ROOT_UPLOADS.$s_file['file']),
				ORDERS_USER_EMAIL_SUBJECT. $GLOBALS['POMO_CITY'][POMO_CITY_ID]['name'].' N'.$GLOBALS['POMO_CITY'][POMO_CITY_ID]['id'].'-'. $o_user_form['order_id'],
				$mail_user_body,
				ORDERS_FROM_EMAIL,
				ORDERS_FROM_EMAIL,
				$o_user_form['email']
				);
			}
		else {
			html_mime_mail::sendTxtMail(
				$vv, 
				ORDERS_USER_EMAIL_SUBJECT. $GLOBALS['POMO_CITY'][POMO_CITY_ID]['name'].' N'.$GLOBALS['POMO_CITY'][POMO_CITY_ID]['id'].'-'. $o_user_form['order_id'],
				$mail_user_body,
				ORDERS_FROM_EMAIL,
				ORDERS_FROM_EMAIL,
				$o_user_form['email']
				);
			};
		};

	}




function remove(){
//	global $V, $model_basket;
	global $_COOKIE;
//	echo "1";
	$status = $this->model_basket->remove_from_basket(
		$this->decodeModUidCookieAsLogRecord($_COOKIE[SESSION_COOKIE_NAME]),
		isset($this->V['subid'])?$this->V['subid']:0
		);

	$in_basket = $this->model_basket->get_basket(
		$this->decodeModUidCookieAsLogRecord($_COOKIE[SESSION_COOKIE_NAME])
		);
	if (!$in_basket['status']) {
		// die die die...
		};
	$this->setVisualCookie($in_basket['item_count'], $in_basket['summ_money_rur'],$in_basket);

//	echo "2";
	Header("Location: ".URL_ORDER."?".md5(time()) );
	exit();
	}







function update(){
//	global $V, $model_basket;
	while (list($k, $v)=each($this->V)) {
		if (preg_match('/quantity_([0-9]*)/', $k, $mm)) {
			$id = intval($mm[1]);
			$quantity = intval($v);
			if (!($quantity>0)) {
				// удалить
				$status = $this->model_basket->remove_from_basket(
					$this->decodeModUidCookieAsLogRecord($_COOKIE[SESSION_COOKIE_NAME]), $id
					);
				}
			else {
				$status = $this->model_basket->update_quantity_in_basket(
					$this->decodeModUidCookieAsLogRecord($_COOKIE[SESSION_COOKIE_NAME]), $id, $quantity
					);
				};
			};
		};

	Header("Location: ".URL_ORDER."?".md5(time()) );
	exit();
	}








// добавить товар в корзинку если есть сесси€.
function add(){
//	global $V, $model_basket;
	$status = $this->checkUserSession();
	if (!($status)) {
		// сесси€ не установлена. пр€ма€ ссылка на корзину (whazzzup?)
		header('Location: '.URL_ORDER.'?action=check_add&amp;subid='.$this->V['subid'].'&amp;q='.$this->V['q'].'&amp;'.md5(time()));
		exit();
		};
	return $this->do_add_item_to_basket();
	}


// если сесси€ установилась то добавить в корзнику.
// если нету, то сказать что надо включить кукисы так как мы без кукисов работать не умеем.
function check_add(){
//	global $V, $model_basket;
	$status = $this->checkUserSession();
	if ($status) {
		return $this->do_add_item_to_basket();
		}
	else {
		// куки однозначно отключены. ну нельз€ же так.
//		return say_cookie_disabled();
		Header("Location: ".URL_ORDER."?action=cookie_disabled&amp;".md5(time()) );
		exit();
		};
	}



// вставить в базу новую запись, обновить клиентские куки и отправить на первую страницу.
function do_add_item_to_basket(){
//	global $V, $model_basket;
//	global $V;
	//echo 'called: do_add_item_to_basket';
	$bstatus = $this->model_basket->add_item_to_basket(
		$this->decodeModUidCookieAsLogRecord($_COOKIE[SESSION_COOKIE_NAME]), 
		$this->V['subid'],
		$this->V['q']
		);
	if (!$bstatus) {
		// die die die...
		};
	$in_basket = $this->model_basket->get_basket(
		$this->decodeModUidCookieAsLogRecord($_COOKIE[SESSION_COOKIE_NAME])
		);
	if (!$in_basket['status']) {
		// die die die...
		};
	$this->setVisualCookie($in_basket['item_count'], $in_basket['summ_money_rur'],$in_basket );
	// отправим на первую страницу

	Header("Location: ".URL_ORDER."?".md5(time()) );
	exit();
	}














// поставить cookie сколько товаров и на сколько денег и что в корзине
function setVisualCookie($item_count, $summ_money_rur, $o_basket) {
	setcookie('basketcount',    (string) number_format( $item_count,0,'.',''),     time()+677007, '/',  BASKET_BASE);
	setcookie('basketpricerur', (string) number_format( $summ_money_rur,0,'.',''), time()+677007, '/',  BASKET_BASE);

		//alid($o_basket);
	$it = array();
	while (list($k, $v) = each($o_basket['basket'])) {
		$it[]=$v['item_id'];
		};
	$items = implode(',',$it);
	setcookie('basketitems', $items, time()+677007, '/', BASKET_BASE);
	}


// стереть cookie сколько товаров и на сколько денег и что в кор
function clearVisualCookie() {
	setcookie('basketcount',    '', time()-677007, '/', BASKET_BASE);
	setcookie('basketpricerur', '', time()-677007, '/', BASKET_BASE);
	setcookie('basketitems', '', time()-677007, '/',    BASKET_BASE);
	}



// а включены ли у него куки?
function checkUserSession(){
	if (isset($_COOKIE[SESSION_COOKIE_NAME])) {
		return true;
		};
	return false;
	}



// возвращает полученную от клиента сессионную mod_uid - куку в том виде, что пишетс€ в access_log (строка 32 символа).
function decodeModUidCookieAsLogRecord($src) {
        $src = urlencode($src);
        $src = base64_decode($src);
        $tmp = unpack("Nservice/Ntime/Npid/Nunique",$src);

        return
                strtoupper(
                str_pad(dechex($tmp['service']), 8, "0", STR_PAD_LEFT).
                str_pad(dechex($tmp['time']), 8, "0", STR_PAD_LEFT).
                str_pad(dechex($tmp['pid']), 8, "0", STR_PAD_LEFT).
                str_pad(dechex($tmp['unique']), 8, "0", STR_PAD_LEFT)
                );
        }








function _send_sms_to_admin($m, $o_user_form, $o_basket, $s_file){
	global $ORDERS_SMS;
	$t = new ice_templates();
	$t->set_file("page", TEMPLATES_ROOT.$this->template_admin_sms.".txt");
//	$t->set_var("page", $user_email['text']['text'] );
	reset($o_user_form);
	while (list($k, $v)=each($o_user_form)) {
		$t->set_var($k, $v );
		};

	$t->set_block('page', 'BLOCK.BASKET',         'BLOCK_BASKET');
	$t->set_var('BLOCK_BASKET', '');
	reset($o_basket['basket']);
	while (list($k, $v)=each($o_basket['basket'])) {
		$t->set_var('name', $v['name']);
		$t->set_var('last_price', number_format($v['last_price_ru'],0,'.','') );
		$t->set_var('quantity', $v['quantity']);
		$t->set_var('avail', $this->avail_map[ $v['avail']	]);
		$t->set_var('url', HTTP_BASE.$v['url'] );
		$t->parse('BLOCK_BASKET', 'BLOCK.BASKET', true);
		};
	$t->set_var('total_summ_rur',  number_format( $o_basket['summ_money_rur'] ,0,'.','') );

	$t->set_var('city_id', $GLOBALS['POMO_CITY'][POMO_CITY_ID]['id']);
	$t->set_var('city_name', $GLOBALS['POMO_CITY'][POMO_CITY_ID]['name']);
	$t->set_var('HTTP_BASE', HTTP_BASE);


	$t->parse("page","page");
	$mail_user_body =  $t->get("page");
//	echo '<pre>'.$mail_user_body.'</pre>';


	while (list($kk, $vv)=each($ORDERS_SMS)) {
		if (isset($s_file['file'])){
			html_mime_mail::sendTxtMailAndAttachment(
				$vv, 
				array(ROOT_UPLOADS.$s_file['file']),
				ORDERS_USER_EMAIL_SUBJECT. $GLOBALS['POMO_CITY'][POMO_CITY_ID]['name'].' N'.$GLOBALS['POMO_CITY'][POMO_CITY_ID]['id'].'-'. $o_user_form['order_id'],
				$mail_user_body,
				ORDERS_FROM_EMAIL,
				ORDERS_FROM_EMAIL,
				$o_user_form['email']
				);
			}
		else {
			html_mime_mail::sendTxtMail(
				$vv, 
				ORDERS_USER_EMAIL_SUBJECT. $GLOBALS['POMO_CITY'][POMO_CITY_ID]['name'].' N'.$GLOBALS['POMO_CITY'][POMO_CITY_ID]['id'].'-'. $o_user_form['order_id'],
				$mail_user_body,
				ORDERS_FROM_EMAIL,
				ORDERS_FROM_EMAIL,
				$o_user_form['email']
				);
			};
		};

	}
	
	




}
?>
