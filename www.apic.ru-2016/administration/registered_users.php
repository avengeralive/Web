<?
require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'class_permission_manager.php');
require_once(CLASSES_BASE.'model_user_admin.php');

$rights = array(
    'view'=>7,
    'edit'=>8
    );

$bgcolors = array(
/*
    "0" => "#ffffff",
    "1" => "#f0f0f0",
    "2" => "#ffdddd"
*/
    "0" => "",
    "1" => "",
    "2" => "error"
	);

$cpermissions = array(
	"view"=>"Просмотр раздела",
	"edit"=>"Редактирование раздела"
	);

	$interface_form['create']=
		array(
			'login'=>array(
				'regexp'=>'^(.{3,255})$', 
				'message'=>'Поле <strong>Логин доступа</strong> заполнено неверно. Допустимая длина - от 3 до 255 символов.'
				),
			'name'=>array(
				'regexp'=>'^(.{3,255})$', 
				'message'=>'Поле <strong>ФИО</strong> заполнено неверно. Допустимая длина - от 3 до 255 символов.'
				),
			'password'=>array(
				'regexp'=>'^(.{5,255})$', 
				'message'=>'Поле <strong>Пароль</strong> заполнено неверно. Допустимая длина - от 5 до 255 символов.'
				),
			'email'=>array(
//				'regexp'=>'^(.{7,255})$', 
				'regexp'=>'^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'. '@'. '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.' . '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', 
				'message'=>'Поле <strong>E-mail</strong> заполнено неверно. Допустимая длина - от 7 до 255 символов, должен быть введен правильный e-mail адрес.'
				),
			'phone'=>array(
				'regexp'=>'^(.{5,255})$', 
				'message'=>'Поле <strong>Телефон</strong> заполнено неверно. Допустимая длина - от 5 до 255 символов.'
				),
			'status'=>array(
				'regexp'=>'^(active|disabled)$', 
				'message'=>'Поле <strong>Статус</strong> заполнено неверно.'
				),
			'righttype'=>array(
				'regexp'=>'^(admin|dealermanager)$', 
				'message'=>'Поле <strong>Уровень доступа</strong> заполнено неверно.'
				)
			);
	$interface_form['update']=
		array(
			'userID'=>array(
				'regexp'=>'^([0-9]+)$', 
				'message'=>'Поле <strong>ID</strong> не определено!',
				),
			'login'=>array(
				'regexp'=>'^(.{3,255})$', 
				'message'=>'Поле <strong>Логин доступа</strong> заполнено неверно. Допустимая длина - от 3 до 255 символов.'
				),
			'name'=>array(
				'regexp'=>'^(.{3,255})$', 
				'message'=>'Поле <strong>ФИО</strong> заполнено неверно. Допустимая длина - от 3 до 255 символов.'
				),
			'email'=>array(
				'regexp'=>'^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'. '@'. '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.' . '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', 
				'message'=>'Поле <strong>E-mail</strong> заполнено неверно. Допустимая длина - от 7 до 255 символов, должен быть введен правильный e-mail адрес.'
				),
			'phone'=>array(
				'regexp'=>'^(.{5,255})$', 
				'message'=>'Поле <strong>Телефон</strong> заполнено неверно. Допустимая длина - от 5 до 255 символов.'
				),
			'status'=>array(
				'regexp'=>'^(active|disabled)$', 
				'message'=>'Поле <strong>Статус</strong> заполнено неверно.'
				),
			'righttype'=>array(
				'regexp'=>'^(admin|dealermanager)$', 
				'message'=>'Поле <strong>Уровень доступа</strong> заполнено неверно.'
				)
			);


$m = new ice_mysql();
$pm = new permission_manager($m);
if (!$pm->checkLogged()){
	// добавить в лог что кто то логинился...
	exit();
	};
$status_permission = $pm->check_rights($rights['view']);
if (!$status_permission['status']) {
	$pm->show_permission_denied();
	exit();
	};

if (isset($HTTP_POST_VARS['ID'])) {
	$ID = $HTTP_POST_VARS['ID'];
	$V = $HTTP_POST_VARS;
	}
elseif (isset($HTTP_GET_VARS['ID'])) {
	$ID = $HTTP_GET_VARS['ID'];
	$V = $HTTP_GET_VARS;
	}
else {
	$ID = 'index';
	$V = $HTTP_GET_VARS;
	};

$model_user_admin = new model_user_admin($m);

$html = "";
if ( function_exists($ID) ) {
	$html = call_user_func($ID);
	}
else {
	$html = "Обработчик для $ID не существует.";
	};
ice_cache::no_cache($html, CACHE_USE_HEADERS);
exit();


//========================================================================================================//

function index($error = ''){
		global $m, $pm, $V, $model_user_admin, $bgcolors;
		$d = $model_user_admin->getUsersLike();

		$t = new ice_templates();
		$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."registered_users/index.html" );
		$t->set_var('ERROR',  $error);
		$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
		$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);

		$t->set_block('page', 'BLOCK.USERS', 'BLOCK_USERS');
		$t->set_var('BLOCK_USERS', '');
		$cbgcolor = 0;
		while (list($k, $v)=each($d['users'])) {
		$cbgcolor = 0;
            $cbgcolor = intval(!($cbgcolor));
			$t->set_var('status.active.selected', '');
			$t->set_var('status.disabled.selected', '');
            if ($v['status'] != 'active') {
				$t->set_var('status.disabled.selected', 'selected');
				$cbgcolor = 2;
                }
			else {
				$t->set_var('status.active.selected', 'selected');
				};

			$t->set_var("name", $v["name"]);
			$t->set_var('login',  $v['login']);
			$t->set_var('email',   $v['email']);
			$t->set_var('phone',   $v['phone']);
			$t->set_var('ID',   $v['ID']);
			$t->set_var('bgcolor', $bgcolors[$cbgcolor]);
			$t->parse('BLOCK_USERS', 'BLOCK.USERS', true);
			};

		$pm->_set_write_disabled(&$t);
		$t->parse("page","page");
		return $t->get("page");
		}



function view_user_card($error = ''){
	global $m, $pm, $V, $model_user_admin, $bgcolors, $interface_form, $cpermissions;
	$o_user = $model_user_admin->getUser($V['login']);
	if (!$o_user['status']){
		trigger_error('$model_user_admin->getUser=> false');
		};

	$o_user_perm = $pm->getRightsForUser($o_user['user']['login']);
	if (!$o_user_perm['status']){
		trigger_error('$pm->getRightsForUser=> false');
		};

	$o_all_rights = $pm->get_all_possible_rights();
	if (!$o_all_rights['status']){
		trigger_error('$pm->get_all_possible_rights()=> false');
		};

	$t = new ice_templates();
	$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."registered_users/view_user_card.html" );
	$t->set_var('ERROR',  $error);
	$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
	$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);

	$t->set_var('USER.name',  $o_user['user']['name']);
	$t->set_var('USER.login',  $o_user['user']['login']);
	$t->set_var('USER.email',  $o_user['user']['email']);
	$t->set_var('USER.phone',  htmlspecialchars($o_user['user']['phone']));
	$t->set_var('USER.userID',  $o_user['user']['ID']);

	$t->set_var('status.'.$o_user['user']['status'].'.selected', 'selected');
	$t->set_var('righttype.'.$o_user['user']['righttype'].'.selected', 'selected');
	$t->set_var('status.bgcolor', 
				$o_user['user']['status']=='active' ? $bgcolors['1'] : $bgcolors['2']
				);

	$t->set_block('page', 'BLOCK.PERMISSIONS', 'BLOCK_PERMISSIONS');
	$t->set_var('BLOCK_PERMISSIONS', '');

	$cbgcolor = 0;
	//	print_r($o_user_perm['rights']);
		while (list($k, $v)=each( $o_all_rights['rights'] )) {
			$p_granted = false;
			$delegated_id = '0';
			reset($o_user_perm['rights']);
			while (list($kk, $vv)=each( $o_user_perm['rights'] )) {
				if ($vv['rightID']==$v['ID']) {
					$p_granted = true;
					$delegated_id = $vv['delegatedID'];
					break;
					};
				};

			if ($p_granted) {
	            $cbgcolor = intval(!($cbgcolor));
				$t->set_var('permission.checked', 'checked');
				}
			else {
				$cbgcolor = 2;
				$t->set_var('permission.checked', '');
				};

			if ($v['status']!='active'){
				$t->set_var('permission.checked', 'DISABLED');
				};

			$t->set_var('PERM.ID', $v['ID']);
			$t->set_var('DELEGATED_ID', $delegated_id );
			$t->set_var('PERM.file', $v['file']);
			$t->set_var('PERM.name', $v['name']);
			$t->set_var('PERM.type', $cpermissions[$v['perm_type']]);
			$t->set_var('bgcolor', $bgcolors[$cbgcolor]);
			$t->parse('BLOCK_PERMISSIONS', 'BLOCK.PERMISSIONS', true);
			};

	$pm->_set_write_disabled(&$t);
	$t->parse("page","page");
	return $t->get("page");
	}



function update_user_card(){
	global $m, $pm, $V, $model_user_admin, $bgcolors, $interface_form;
	$pm->_check_edit_rights();

	$errors = '';
	$o_user_form = array();
	while (list($k, $v) = each($interface_form['update'])) {
		if (
			isset($V[$k]) &&
			preg_match("<".$v['regexp'].">", $V[$k]) 
			) {
			$o_user_form[$k] = $V[$k];
			}
		else {
			$errors .= "<li>".$v['message'];
			$o_user_form[$k] = '';
			};
		};

	if (strlen($errors)>0) {
		// есть ошибки. нельзя обновлять.
		return view_user_card($errors);
		};

	$status = $model_user_admin->updateUserAccount(
		$o_user_form['userID'], 
		$o_user_form['login'], 
		$o_user_form['name'], 
		$o_user_form['email'], 
		$o_user_form['phone'], 
		$o_user_form['status'],
		$o_user_form['righttype']
		);
	if (!$status['status']){
		trigger_error('$model_user_admin->updateUserAccount=> false');
		};

	return view_user_card('Карточка пользователя обновлена');
	}



function update_user_password(){
	global $m, $pm, $V, $model_user_admin, $bgcolors, $interface_form;
	$pm->_check_edit_rights();

	$status = $model_user_admin->updatePassword($V['login'], $V['password']);
	if (!$status['status']){
		trigger_error('$model_user_admin->registration($login, $name, $email, $password, $status)=> false');
		};

	return view_user_card('Пароль доступа изменен');
	}



function update_user_permissions(){
	global $m, $pm, $V, $model_user_admin, $bgcolors, $interface_form;
	$pm->_check_edit_rights();
	
	reset($V);
	$new_permissions = array();
	$old_permissions = array();
	while (list($k, $v) = each($V)) {
		if (preg_match("/^permission([0-9]+)$/", $k, $match)) {
			// какое то право
			$rightID = $match[1];
			$delegatedID = intval($v);
			if ($delegatedID>0) {
				$old_permissions[] = $rightID;
				}
			else {
				$new_permissions[] = $rightID;
				};
			};
		};

	// стереть все права, которых нет в $old_parmissions
//	print_r($old_permissions);
	$del_status = $pm->deletePermissionsFromUserExceptArray($V['login'], $old_permissions);
	if (!$del_status['status']){
		trigger_error('$pm->deletePermissionsFromUserExceptArray(=> false');
		};
	// установить $new_parmissions
//	print_r($new_permissions);
	$add_status = $pm->addPermissionsArrayToUser($V['login'], $new_permissions);
	if (!$add_status['status']){
		trigger_error('$pm->addPermissionsArrayToUser=> false');
		};
	return view_user_card('Права пользователя были изменены');
	}


function add_user(){
	global $m, $pm, $V, $model_user_admin, $bgcolors, $interface_form;
	$pm->_check_edit_rights();

	$errors = '';
	$o_user_form = array();
	while (list($k, $v) = each($interface_form['create'])) {
		if (
			isset($V[$k]) &&
			preg_match("<".$v['regexp'].">", $V[$k]) 
			) {
			$o_user_form[$k] = $V[$k];
			}
		else {
			$errors .= "<li>".$v['message'];
			$o_user_form[$k] = '';
			};
		};

	if (strlen($errors)>0) {
		// есть ошибки. нельзя обновлять.
		return index($errors);
		};

	$status = $model_user_admin->registration(
		$o_user_form['login'], 
		$o_user_form['name'], 
		$o_user_form['email'], 
		$o_user_form['phone'], 
		$o_user_form['password'], 
		$o_user_form['status'],
		$o_user_form['righttype']
		);
	if (!$status['status']){
		trigger_error('$model_user_admin->registration($login, $name, $email, $password, $status)=> false');
		};

	return view_user_card('Пользователь добавлен');
	}



function update_user_index(){
	global $m, $pm, $V, $model_user_admin, $bgcolors, $interface_form;
	$pm->_check_edit_rights();

	$errors = '';
	while (list($k, $v) = each($V)) {
		if (
			preg_match("/^status(.*)$/", $k, $match) &&
			isset($V['login'.$match[1]])
			) {
			$status = $model_user_admin->changeUserStatus($V['login'.$match[1]], $v);
			if (!$status['status']) {
				trigger_error('$model_user_admin->changeUserStatus => false');
				};
			};
		};
	return index('Изменено');
	}


function mysqltimestamp_to_date($d){
	preg_match("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", $d, $m);
	$year=$m[1];
	$month=$m[2];
	$day=$m[3];
	$h=$m[4];
	$min=$m[5];
	$sec=$m[6];
	$ts = mktime ($h, $min, $sec, $month, $day, $year);
	return date("j F Y H:i:s ", $ts);
	}

?>