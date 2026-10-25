<?


class model_user_abstract{

function model_user_abstract($m, $TABLE_USER){
	$this->m = &$m;
	$this->TABLE_USER = $TABLE_USER;
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
		password = md5('#password#')
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
		LOGIN = '#login#' 
	AND 
		PASSWORD = md5('#password#')
	AND
		STATUS = 'active'
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


function generateNewPassword($length=5, $base='1234567890'){
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