<? 


require_once(CLASSES_BASE.'model_trigger.php');
require_once(CLASSES_BASE.'model_user_admin.php');
class permission_manager{
	var $is_logged = false;
	var $login     = false;
	var $rights    = false;


function permission_manager($m){
	$this->m = &$m;
	}


function checkLogged(){
	global $HTTP_SERVER_VARS;
	if (isset( $HTTP_SERVER_VARS['PHP_AUTH_USER'])) {
	    $login = $HTTP_SERVER_VARS['PHP_AUTH_USER'];
		$password = $HTTP_SERVER_VARS['PHP_AUTH_PW'];
		$model_user_admin = new model_user_admin($this->m);
		$status = $model_user_admin->logon($login, $password);
		if ($status['status']) {
			$this->is_logged = true;
			$this->login = $login;
			$this->user = $status['user'];
			$rights = $this->getRightsForUser($login);
			if (!$rights['status']) {
				trigger_error('this->getRightsForUser($login) => false');
				};
			$this->rights = $rights['rights'];
			return true;
			};
		// оопс. не вошел. а хотел.
				// TRIGGER
		$headers = getallheaders(); 
		$hhh = '';
		foreach ($headers as $header => $value) { 
			$hhh .= "$header: $value\n"; 
			};
		$tr = new model_trigger(&$this->m);
		$s = $tr->call_trigger('administration_logon_error', array(
			'login'=>$HTTP_SERVER_VARS['PHP_AUTH_USER'],
			'USER_IP'=>$_SERVER["REMOTE_ADDR"],
			'HTTP_USER_AGENT'=> $_SERVER["HTTP_USER_AGENT"],
			'headers' => $hhh
			)
			);
		// /TRIGGER
		
		};

	$this->showLoginForm();
	return false;
	}


function getRightsForUser($login){
    $this->m->begin(__FILE__, __LINE__);

    $q = "
    SELECT
		ard.rightID,
		ard.ID as delegatedID,
		ar.*
    FROM
		".MYSQL_DB.".ADMIN_RIGHTS_DELEGATED as ard
	LEFT JOIN
		".MYSQL_DB.".ADMIN_RIGHTS as ar
	ON 
		ard.rightID = ar.ID
	WHERE
		ard.login = '#login#'
	ORDER BY 
		ar.name DESC
        ";

	$rights = $this->m->selectManyRows($q, __FILE__, __LINE__, 
        Array(
			'login'=>addslashes($login)
            )
        );
    if ($this->m->error  ) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

    if (!$this->m->commit(__FILE__, __LINE__)) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

    return Array(
        'status'=>true, 
        'rights'=>$rights
        );
	}



function get_all_possible_rights(){
    $this->m->begin(__FILE__, __LINE__);

    $q = "
    SELECT
		ar.*
    FROM
		".MYSQL_DB.".ADMIN_RIGHTS as ar
	ORDER BY 
		ar.name DESC
        ";

	$rights = $this->m->selectManyRows($q, __FILE__, __LINE__, 
        Array(
            )
        );
    if ($this->m->error  ) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

    if (!$this->m->commit(__FILE__, __LINE__)) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

    return Array(
        'status'=>true, 
        'rights'=>$rights
        );
	}



function deletePermissionsFromUserExceptArray($login, $permissions){
	if (sizeof($permissions)>0) {
		$pp = implode(',',$permissions);
		$and = "	AND
		 rightID NOT IN (#RIGHTS#)
				";
		}
	else {
		$and = "";
		$pp = '';
		};
	$q = "
	DELETE FROM
		".MYSQL_DB.".ADMIN_RIGHTS_DELEGATED
	WHERE
		login = '#login#'
		".$and;

    $this->m->begin(__FILE__, __LINE__);
	$rights = $this->m->query($q, __FILE__, __LINE__, 
        Array(
			'login'=>$login,
			'RIGHTS'=>$pp
            )
        );
    if ($this->m->error  ) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

    if (!$this->m->commit(__FILE__, __LINE__)) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

    return Array(
        'status'=>true
        );
	}


function addPermissionsArrayToUser($login, $permissions){
    $this->m->begin(__FILE__, __LINE__);
	$q = "
	INSERT
		".MYSQL_DB.".ADMIN_RIGHTS_DELEGATED
	SET
		login = '#login#',
		rightID = '#rightID#'
		";

	while (list($k, $v) = each($permissions)) {
		$r = $this->m->query($q, __FILE__, __LINE__, 
	        Array(
				'login'=>$login,
				'rightID'=>$v
	            )
	        );
	    if ($this->m->error  ) {
	        $this->m->rollback(__FILE__, __LINE__);
	        return Array('status'=>false);
	        };
		};

    if (!$this->m->commit(__FILE__, __LINE__)) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

    return Array(
        'status'=>true
        );
	}


/**
*   Сказать стандартную формочку логина/пароля "http 401"
*/
function showLoginForm($realm = "Private area"){
    Header("WWW-Authenticate: Basic realm=\"".$realm."\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "<h1>Доступ запрещен.</h1>Обратитесь к администратору сайта.";
    }


function check_rights($right){
	reset($this->rights);
	while (list($k, $v)=each($this->rights)) {
		if ($v['ID'] == $right) {
			return array(
				'status'=>true
				);
			}
		};
	return array(
		'status'=>false
		);
	}

function show_permission_denied(){
	global $HTTP_SERVER_VARS;
		// оопс. не вошел. а хотел.
		// TRIGGER
		$headers = getallheaders(); 
		$hhh = '';
		foreach ($headers as $header => $value) { 
			$hhh .= "$header: $value\n"; 
			};
		$tr = new model_trigger(&$this->m);
		$s = $tr->call_trigger('administration_permission_error', array(
			'login'=>$HTTP_SERVER_VARS['PHP_AUTH_USER'],
			'USER_IP'=>$_SERVER["REMOTE_ADDR"],
			'HTTP_USER_AGENT'=> $_SERVER["HTTP_USER_AGENT"],
			'headers' => $hhh
			)
			);
		// /TRIGGER

	echo "<html><body bgcolor='#ffffcc'><h3>Доступ запрещен.</h3> Обратитесь к администратору сайта чтобы узнать причину. <hr .>".ADMINISTRATOR_NAME."<br>".ADMINISTRATOR_EMAIL;
	echo "<!-- 123456789012345678901234567890123456789012345678901234567890 -->";
	echo "<!-- 123456789012345678901234567890123456789012345678901234567890 -->";
	exit();
	}


/**
*   Установить disabled в недопустимых элементах форм.
*/
function _set_write_disabled(&$t){
	global $rights;
	$status_permission = $this->check_rights($rights['edit']);
	if (!$status_permission['status']) {
		$t->set_var('WRITE.DISABLED', 'disabled');
		}
	else {
		$t->set_var('WRITE.DISABLED', '');
		};
	}


/**
*    Если нет прав на EDIT то сказать инна отсюда
*/
function _check_edit_rights(){
	global $rights;
	$status_permission = $this->check_rights($rights['edit']);
	if (!$status_permission['status']) {
		$this->show_permission_denied();
		exit();
		};
	}
}
?>