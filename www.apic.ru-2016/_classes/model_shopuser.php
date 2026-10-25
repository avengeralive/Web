<?
/*
Регистрация, восстановление пароля, логин, логаут, итп 
Все связанное с пользователем.

*/

class model_shopuser {
function model_shopuser($m, $table_user) {
		$this->m = &$m;
		$this->TABLE_USER = $table_user;
        }



function check_login( $login, $password ){
	$q = "
	SELECT
		di.id
	FROM
		".$this->TABLE_USER." as di
	WHERE
		 di.login = '#login#'
	AND
		di.password = '#password#'
		";


    $o = $this->m->selectOneRow($q, __FILE__, __LINE__, Array(
		'login'=>$login,
		'password'=>$password
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };


	if (
		isset($o['id']) && 
		$o['id']>0
		) {
		return array(
			'status'=>true,
			'exist'=>true,
			'user_id'=>$o['id']
			);
		};

	return array(
		'status'=>true,
		'exist'=>false
		);
	}



function get_public_card_by_login( $login ){
	$q = "
	SELECT
		*
	FROM
		".$this->TABLE_USER."
	WHERE
		 login = '#login#'
		";
    $o = $this->m->selectOneRow($q, __FILE__, __LINE__, Array(
		'login'=>$login
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	if (
		isset($o['id']) && 
		$o['id']>0
		) {
		return array(
			'status'=>true,
			'user'=>$o,
			'exist'=>true
			);
		};

	return array(
		'status'=>true,
		'exist'=>false
		);
	}



function get_public_card_by_email( $email ){
	$q = "
	SELECT
		*
	FROM
		".$this->TABLE_USER."
	WHERE
		 email = '#email#'
		";
    $o = $this->m->selectOneRow($q, __FILE__, __LINE__, Array(
		'email'=>$email
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	if (
		isset($o['id']) && 
		$o['id']>0
		) {
		return array(
			'status'=>true,
			'user'=>$o,
			'exist'=>true
			);
		};

	return array(
		'status'=>true,
		'exist'=>false
		);
	}



function get_public_card_by_id( $id ){
	$q = "
	SELECT
		*
	FROM
		".$this->TABLE_USER."
	WHERE
		 id = '#id#'
		";
    $o = $this->m->selectOneRow($q, __FILE__, __LINE__, Array(
		'id'=>$id
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	if (
		isset($o['id']) && 
		$o['id']>0
		) {
		return array(
			'status'=>true,
			'user'=>$o
			);
		};

	return array(
		'status'=>true,
		'exist'=>false
		);
	}


function change_password_for_user( $id, $password ){
	$q = "
	UPDATE
		".$this->TABLE_USER."
	SET
		password = '#password#'
	WHERE
		 id = '#id#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id'=>$id,
		'password'=>$password
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		);
	}

function change_subscribe_for_user( $id, $subscribe_status   	  ){
	$q = "
	UPDATE
		".$this->TABLE_USER."
	SET
		 subscribe_status   	  = '#subscribe_status#'
	WHERE
		 id = '#id#'
		";
    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id'=>$id,
		'subscribe_status'=>$subscribe_status   	 
		));
    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		);
	}



function change_userinfo_afterorder( $id, $user_name, $email, $phone, $city_id, $address ){
	$q = "
		UPDATE
			".$this->TABLE_USER."
		SET
			 user_name = '#user_name#',
			 email = '#email#',
			 phone = '#phone#',
			 city_id = #city_id#,
			 address = '#address#'
		WHERE
			 id = '#id#'
		";

    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'id'=>$id,
		'user_name'=>$user_name,
		'email'=>$email,
		'phone'=>$phone,
		'city_id'=>$city_id,
		'address'=>$address
		));

    if ($this->m->error ) {
        return Array('status'=>false);
        };
	return array(
		'status'=>true,
		);
	}



function insert_public_card( $user_name, $login, $password, $email, $phone, $city_id, $address ) {
	$q = "
		INSERT INTO
			".$this->TABLE_USER."
		SET
			user_name = '#user_name#',
			login = '#login#',
			password = '#password#',
			email = '#email#',
			phone = '#phone#',
			city_id = #city_id#,
			address = '#address#',
			subscribe_status = 'active'
		";

    $o = $this->m->query($q, __FILE__, __LINE__, Array(
		'user_name'=>$user_name,
		'login'=>$login,
		'password'=>$password,
		'email'=>$email,
		'phone'=>$phone,
		'city_id'=>$city_id,
		'address'=>$address
		));

    if ($this->m->error ) {
        return Array('status'=>false);
        };

	return array(
		'status'=>true
		);
	}


















/**
*    Список пользователей по условию.
*/
function getUsersLike($like='1=1', $offset='0', $limit='1000', $orderby = ''){
	if (strlen($orderby)>0) {
	$like .= "
	ORDER BY #orderby#
		";
		};

	$q = "
	SELECT
		*
	FROM
		".$this->TABLE_USER."
	WHERE
		 ".$like." 
	LIMIT 
		#offset#, #limit#
	";

    $this->m->begin(__FILE__, __LINE__);
    $o = $this->m->selectManyRows($q, __FILE__, __LINE__, Array(
//		'like'=>$like,
		'offset'=>$offset,
		'limit'=>$limit,
		'orderby'=>$orderby
		));

    if ($this->m->error ) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

    if (!$this->m->commit(__FILE__, __LINE__)) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

	return Array(
		'status'=>true,
		'users'=>$o
		);
	}


function getUser($login){
    $this->m->begin(__FILE__, __LINE__);

    $q = "
    SELECT
		*
    FROM
		".$this->TABLE_USER."
	WHERE
		login = '#login#' 
        ";

	$user = $this->m->selectOneRow($q, __FILE__, __LINE__, 
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

    if (!( is_array($user) && (sizeof($user)>0) )) {
        return Array('status'=>false);
        };

    return Array(
        'status'=>true, 
        'user'=>$user
        );
	}



function updatePassword($login, $password) {
    $this->m->begin(__FILE__, __LINE__);
	$q0 = "
	UPDATE
		".$this->TABLE_USER."
	SET
		password = '#password#'
	WHERE
		login = '#login#'
	LIMIT 1
		";
    $this->m->query($q0, __FILE__, __LINE__, 
        Array(
			'login'=>$login,
			'password'=>$password
		)
        );

    if ($this->m->error ) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array(
			'status'=>false
			);
        };

    if (!$this->m->commit(__FILE__, __LINE__)) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array(
			'status'=>false,
			);
        };
    return $this->getUser($login);
	}


function logon($login, $password) {
    $this->m->begin(__FILE__, __LINE__);

    $q = "
    SELECT
		*
    FROM
		".$this->TABLE_USER."
	WHERE
		login = '#login#' 
	AND 
		password = md5('#password#')
	AND
		status = 'active'
        ";

	$user = $this->m->selectOneRow($q, __FILE__, __LINE__, 
        Array(
			'login'=>$login,
			'password'=>$password
            )
        );
    if ($this->m->error | (!$this->m->rows) ) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

    if (!$this->m->commit(__FILE__, __LINE__)) {
        $this->m->rollback(__FILE__, __LINE__);
        return Array('status'=>false);
        };

    return Array(
        'status'=>true, 
        'user'=>$user
        );
	}



function changeUserStatus($login, $status){
    $this->m->begin(__FILE__, __LINE__);

    $q = "
	UPDATE
		".$this->TABLE_USER."
	SET
		status = '#status#'
	WHERE
		login = '#login#'
        ";

	$user = $this->m->query($q, __FILE__, __LINE__, 
        Array(
			'login'=>$login,
			'status'=>$status
            )
        );
    if ($this->m->error ) {
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



function generateNewPassword($length=5, $base='1234567890') {
	$pass = '';
	srand ((double) microtime() * 1000000);
	while (strlen($pass)<$length) {
	    $randomNumber = rand(1,strlen($base));
	    $pass .= substr($base,$randomNumber-1,1);
		};
	return $pass;
	}

}
?>
