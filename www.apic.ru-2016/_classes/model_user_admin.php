<?


require_once(CLASSES_BASE.'model_user_abstract.php');
class model_user_admin extends model_user_abstract{

function model_user_admin($m){
	$this->m = &$m;
	$this->TABLE_USER = TABLE_ADMIN_USER;
	}


function registration($login, $name, $email, $phone, $password, $status, $righttype){

    $this->m->begin(__FILE__, __LINE__);
    $q0 = "
    INSERT
    INTO
				".$this->TABLE_USER."
	SET
			login = '#login#',
			password = md5('#password#'),
			name= '#name#',
			email = '#email#',
			phone = '#phone#',
			created=NOW(),
			updated=NOW(),
			status= '#status#',
			righttype = '#righttype#'
         ";

    $groups = $this->m->query($q0, __FILE__, __LINE__, 
        Array(
			"login"=>$login,
			"name"=>$name,
			"email"=>$email,
			"phone"=>$phone,
			"password"=>$password,
			"status"=>$status,
			"righttype"=>$righttype
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
			'status'=>false
			);
        };

	return Array(
		'status'=>true
		);
	}




function updateUserAccount($ID, $login,$name, $email, $phone, $status, $righttype){
    $this->m->begin(__FILE__, __LINE__);
    $q0 = "
    UPDATE
		".$this->TABLE_USER."
	SET
			login = '#login#',
			name= '#name#',
			email = '#email#',
			phone = '#phone#',
			status= '#status#',
			righttype = '#righttype#',
			updated=NOW()
	WHERE
		ID = '#ID#'
		";

    $this->m->query($q0, __FILE__, __LINE__, 
        Array(
			"login"=>$login,
			"name"=>$name,
			"email"=>$email,
			"phone"=>$phone,
			"status"=>$status,
			"righttype"=>$righttype,
			"ID" => $ID
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
   return Array(
		'status'=>true,
		);
	}



}
?>