<?php
function get_user_data($uid) {
    $u = User::getById($uid);
    if (!$u) return false;
    $f = $u->fields;
    $f['enabled'] = $u->isEnabled();
    return $f;
}

function logout_user() {
    User::logout();
}

function get_userid_by_login($login) {
    try {
        $u = User::getByLogin($login);
        return $u->id;
    } catch (Exception $e) {
        return 0;
    }
}

function get_userid_by_uniq($uniq, $server = 0) {
  if (!$uniq) return false;
  $r = fssql_query("SELECT id FROM users WHERE uniqid='".mysql_escape_string($uniq)."'");
  if (mysql_num_rows($r))
	return mysql_result($r,0);
    else return 0;
}

function get_userid_by_email($email) {
  $r = fssql_query("SELECT id FROM users WHERE email='".mysql_escape_string($email)."'");
  if (mysql_num_rows($r))
	return mysql_result($r,0);
    else return 0;
}

function user_enable($user_id) {
	mysql_query('UPDATE users SET disabled=0, uniqid=NULL WHERE id='.(int)$user_id);
}

function user_disable($user_id) {
	mysql_query('UPDATE users SET disabled=1, uniqid=NULL WHERE id='.(int)$user_id);
}

function change_user_data($id,$array,$enable=0) {
  $enable = (integer) $enable;
  $id = (integer) $id;
    
      if (($array['email'])&&(!is_email($array['email'])))
        throw new Exception_CMS(Exception_CMS::INVALID_EMAIL);
        
  $r = fssql_query("select count(ID) from users where id=$id");
  $f = mysql_fetch_row($r);
  if (!$f[0]) throw new Exception_CMS(Exception_CMS::USER_NOT_FOUND);
    
  $r = fssql_query("SELECT A.name, A.required, A.type FROM types_fields A, types B where B.id=A.id and B.alias='users' and A.type<>7 and A.type<>8");
  $enable = 1-$enable;
  $names = 'disabled='.$enable;
  while ($f = mysql_fetch_row($r)) {
        if ($f[0] == 'date_reg') continue;
        if ($f[1] && !$array[$f[0]] && $f[0]!='password') 
            throw new Exception_CMS(Exception_CMS::INVALID_PARAMS);
        
        if (isset($array[$f[0]])) 
            $names .= ','.$f[0]."='".mysql_escape_string($array[$f[0]])."'";
  }

  fssql_query("update users set $names where id=$id");
}

function register_user($array, $enable=0, $unique_email = TRUE) {
    try {
      $enable = (integer) $enable;
    
      if (($array['email'])&&(!is_email($array['email'])))
        throw new Exception_CMS(Exception_CMS::INVALID_EMAIL);
      
      if ($array['password'] != $array['password2']) 
        throw new Exception_CMS(Exception_CMS::PASSWORDS_DOESNT_MATCH);
      unset($array['password2']);
      $array['password'] = md5($array['password']);
      
      if (!$array['login']) 
        throw new Exception_CMS(Exception_CMS::INVALID_PARAMS);
        
      if (get_userid_by_login($array['login']))
        throw new Exception_CMS(Exception_CMS::USER_EXISTS);
            
      $r = fssql_query("SELECT A.name, A.required, A.type FROM types_fields A, types B WHERE B.id=A.id and B.alias='users' and A.type<>7 and A.type<>8");
      $enable = 1-$enable;
      $names = 'disabled, date_reg';
      $values = $enable.',NOW()';
      while ($f = mysql_fetch_row($r)) {
        if ($f[0] == 'date_reg') continue;
        if (($f[1])&&(!$array[$f[0]])) throw new Exception_CMS(Exception_CMS::INVALID_PARAMS);
    	if ($array[$f[0]]) {
    	  $names .= ','.$f[0];
    	  $values .= ",'".$array[$f[0]]."'";
    	}
      }

      fssql_query("insert into users ($names) values ($values)");
      
      return mysql_insert_id();
    } catch (Exception_CMS $e) {
        return $e->code;
    }
}

function login_user($username, $password, $remember) {
    $result = Zend_Auth::getInstance()->authenticate(new UserAuthAdapter(array(
        'login'    => $username,
        'pass'     => $password,
        'remember' => $remember
    ))); 

    switch ($result->getCode()) {
        case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
            return ERROR_USER_NOT_FOUND;
        case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
            return ERROR_INVALID_PASSWORD;
        case Zend_Auth_Result::SUCCESS:
            return TRUE;
    }
}

function is_subscribed($list_id,$user_id) {
  $r = fssql_query("select count(iduser) from mail_lists_users where idlist=$list_id and iduser=$user_id");
  if (mysql_num_rows($r))
  {
    return mysql_result($r,0);
  } else {
    return 0;
  }
}

// подписать пользователя $user_id на список $list_id, если не подписан
// отписать пользователя $user_id от списока $list_id, если подписан
function toggle_subscribe($list_id,$user_id) {
  $r = fssql_query("select count(iduser) from mail_lists_users where idlist=$list_id and iduser=$user_id");
  $f = mysql_fetch_row($r);
  if ($f[0]) {
    fssql_query("delete from mail_lists_users where idlist=$list_id and iduser=$user_id");
  } else {
    fssql_query("insert into mail_lists_users (idlist, iduser) values($list_id,$user_id)");
  }
}