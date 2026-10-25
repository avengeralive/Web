<?php

/**
 * @package    MVC
 *
 * Module Remart by Ali S. Veliyev
 */
class mRemart extends model
{
    public function get_users()
    {	
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id != 1)
	{
	    if ($this->data['request']->parameters['reg_by'] == '-') $this->data['request']->parameters['reg_by'] = '%';
	    if ($this->data['request']->parameters['pm'] == '-') $this->data['request']->parameters['pm'] = '%';
	    $this->data['result']['count'] = $this->dbmanager->selectByQuery('SELECT COUNT(*) as cnt FROM (SELECT u.id, u.login, u.name, u.surname, u.patronymic, u.email, um.mobile, um.company_name, um.validated, ug.role_id, um.bank, um.reg_by, (SELECT COUNT(*) FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o WHERE o.realtor = u.id) as user_objects, (SELECT COUNT(*) FROM '.Backstage::gi()->db_table_prefix.'users u1, '.Backstage::gi()->db_table_prefix.'rmrt_user_meta um1, '.Backstage::gi()->db_table_prefix.'user_grants ug1 WHERE ug1.user_id = u1.id AND ug1.role_id = 8 AND um1.user_id = u1.id AND um1.reg_by = u.id) as user_buyers FROM '.Backstage::gi()->db_table_prefix.'users u, '.Backstage::gi()->db_table_prefix.'user_grants ug, '.Backstage::gi()->db_table_prefix.'rmrt_user_meta um, '.Backstage::gi()->db_table_prefix.'rmrt_user_meta um3 WHERE um.reg_by = um3.user_id AND ug.role_id  = '.$this->data['request']->parameters['role_id'].' AND um.company = '.$this->data['request']->parameters['company'].' AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id) a WHERE a.id LIKE "%'.$this->data['request']->parameters['id'].'%" AND (CONCAT(name, " ", surname, " ", patronymic) LIKE "%'.$this->data['request']->parameters['name'].'%" OR CONCAT(surname, " ", name, " ", patronymic) LIKE "%'.$this->data['request']->parameters['name'].'%") AND a.email LIKE "%'.$this->data['request']->parameters['email'].'%" AND a.company_name LIKE "%'.$this->data['request']->parameters['company_name'].'%" AND a.mobile LIKE "%'.$this->data['request']->parameters['phone'].'%" AND a.user_objects >= '.$this->data['request']->parameters['objects_min'].' AND a.user_objects <= '.$this->data['request']->parameters['objects_max'].' AND a.user_buyers >= '.$this->data['request']->parameters['buyers_min'].' AND a.user_buyers <= '.$this->data['request']->parameters['buyers_max'].' AND a.reg_by LIKE "'.$this->data['request']->parameters['reg_by'].'" AND a.validated LIKE "%'.$this->data['request']->parameters['status'].'%"')[0]->cnt;
	    $this->data['result']['data'] = $this->dbmanager->selectByQuery('SELECT * FROM (SELECT u.id, u.login, u.name, u.surname, u.patronymic, u.email, um.mobile, um.company_name, um.validated, ug.role_id, um3.bank, um.bank as bank2, um.reg_by, (SELECT COUNT(*) FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o WHERE o.realtor = u.id) as user_objects, (SELECT COUNT(*) FROM '.Backstage::gi()->db_table_prefix.'users u1, '.Backstage::gi()->db_table_prefix.'rmrt_user_meta um1, '.Backstage::gi()->db_table_prefix.'user_grants ug1 WHERE ug1.user_id = u1.id AND ug1.role_id = 8 AND um1.user_id = u1.id AND um1.reg_by = u.id) as user_buyers FROM '.Backstage::gi()->db_table_prefix.'users u, '.Backstage::gi()->db_table_prefix.'user_grants ug, '.Backstage::gi()->db_table_prefix.'rmrt_user_meta um, '.Backstage::gi()->db_table_prefix.'rmrt_user_meta um3 WHERE um.reg_by = um3.user_id AND (um3.bank LIKE "%'.$this->data['request']->parameters['bank'].'%" OR um.bank LIKE "%'.$this->data['request']->parameters['bank'].'%") AND ug.role_id  = '.$this->data['request']->parameters['role_id'].' AND um.company = '.$this->data['request']->parameters['company'].' AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id) a WHERE a.id LIKE "%'.$this->data['request']->parameters['id'].'%" AND (CONCAT(name, " ", surname, " ", patronymic) LIKE "%'.$this->data['request']->parameters['name'].'%" OR CONCAT(surname, " ", name, " ", patronymic) LIKE "%'.$this->data['request']->parameters['name'].'%") AND a.email LIKE "%'.$this->data['request']->parameters['email'].'%" AND a.company_name LIKE "%'.$this->data['request']->parameters['company_name'].'%" AND a.mobile LIKE "%'.$this->data['request']->parameters['phone'].'%" AND a.user_objects >= '.$this->data['request']->parameters['objects_min'].' AND a.user_objects <= '.$this->data['request']->parameters['objects_max'].' AND a.user_buyers >= '.$this->data['request']->parameters['buyers_min'].' AND a.user_buyers <= '.$this->data['request']->parameters['buyers_max'].' AND a.reg_by LIKE "'.$this->data['request']->parameters['reg_by'].'" AND a.validated LIKE "%'.$this->data['request']->parameters['status'].'%" ORDER BY a.validated ASC, a.id ASC LIMIT '.$this->data['request']->parameters['offset'].", ".$this->data['request']->parameters['limit']);  
	    //AND um1.bank LIKE "%'.$this->data['request']->parameters['bank'].'%"
	    foreach ($this->data['result']['data'] as $key => $value)
	    {
			$result = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
			    ->fields('name, surname, patronymic')
			    ->where('id = '.$value->reg_by)
			    ->getScalar();
			$this->data['result']['data'][$key]->reg_by = $result->surname." ".$result->name." ".$result->patronymic;
			$this->data['result']['data'][$key]->favorites = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
			    ->fields('COUNT(id) as cnt')
			    ->where('user = '.$value->id)
			    ->getScalar()->cnt;
			$this->data['result']['data'][$key]->bids = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_bids')
			    ->fields('id')
			    ->where('buyer = '.$value->id)
			    ->select();
			
			if ($this->data['result']['data'][$key]->role_id == 6) {
		    $result = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_banks')
		    	->fields('name')
		    	->where('id = '.$value->bank2)
		    	->getScalar();
		    if ($value->bank2 == 0) $this->data['result']['data'][$key]->bank = "Remart";
		    else $this->data['result']['data'][$key]->bank = $result->name;
			}
			else
			{
			    $result = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_banks')
		    	->fields('name')
		    	->where('id = '.$value->bank)
		    	->getScalar();
		    if ($value->bank == 0) $this->data['result']['data'][$key]->bank = "Remart";
		    else $this->data['result']['data'][$key]->bank = $result->name;
			}
	    }
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function user()
    {	
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
	    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id != 1)
	{
	    $this->data['result']['data'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
		->fields('u.ID, u.name, u.surname, u.patronymic, u.email, u.about, um.birthday, um.id_serial, um.id_pin, um.comment, um.mobile, um.home, um.phone1, um.phone2, um.validated, um.reg_date, um.company_name, um.logo, um.company, um.voen, um.bank, um.website, um.reg_by, um.passch')
		->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id AND u.id = '.$this->data['request']->parameters['id'])
		->getScalar();
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function save_log($user, $action, $table, $table_values)
    {
	
	$tv['user'] = $user;
	$tv['date'] = date('Y-m-d H:i:s');
	$tv['action'] = $action.' <<'.$table.'>> '.json_encode($table_values);
	$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
	    ->values($tv)
	    ->insert();
    }
	
    public function save_user()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.id, u.email, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id AND um.validated = 1')
            ->getScalar();
	if ($this->data['item'])
	{
	    if (isset($this->data['request']->parameters['id']))
	    {
		$this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
		    ->fields('id')
		    ->where('id != '.$this->data['request']->parameters['id'].' AND email = "'.$this->data['request']->parameters['email'].'"')
		    ->getScalar();
	    }
	    else
	    {
		$this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
		    ->fields('id')
		    ->where('email = "'.$this->data['request']->parameters['email'].'"')
		    ->getScalar();
	    }
	    if (!$this->data['exists'])
	    {
		if (isset($this->data['request']->parameters['id']))
		{
		    $table_values['login'] = $this->data['request']->parameters['email'];
		    $table_values['email'] = $this->data['request']->parameters['email'];
		    $table_values['name'] = $this->data['request']->parameters['name'];
		    $table_values['surname'] = $this->data['request']->parameters['surname'];
		    $table_values['patronymic'] = $this->data['request']->parameters['patronymic'];
		    $table_values['about'] = $this->data['request']->parameters['about'];
		    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
			->values($table_values)
			->where('id = '.$this->data['request']->parameters['id'])
			->update();

		    $this->save_log($this->data['item']->id, 'update', 'users', $table_values);				

		    unset($table_values);
		    $table_values['birthday'] = $this->data['request']->parameters['birthday'];
		    $table_values['mobile'] = $this->data['request']->parameters['mobile'];
		    $table_values['home'] = $this->data['request']->parameters['home'];
		    $table_values['phone1'] = $this->data['request']->parameters['phone1'];
		    $table_values['phone2'] = $this->data['request']->parameters['phone2'];
		    $table_values['id_serial'] = $this->data['request']->parameters['id_serial'];
		    $table_values['id_pin'] = $this->data['request']->parameters['id_pin'];
		    $table_values['comment'] = $this->data['request']->parameters['comment'];
		    $table_values['company_name'] = $this->data['request']->parameters['company_name'];
		    $table_values['logo'] = $this->data['request']->parameters['logo'];
		    $table_values['company'] = $this->data['request']->parameters['company'];
		    $table_values['voen'] = $this->data['request']->parameters['voen'];
		    $table_values['bank'] = $this->data['request']->parameters['bank'];
		    $table_values['website'] = $this->data['request']->parameters['website'];
		    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
			->values($table_values)
			->where('user_id = '.$this->data['request']->parameters['id'])
			->update();	

		    $this->save_log($this->data['item']->id, 'update', 'rmrt_user_meta', $table_values);

		    $this->data['result'] = 'true';
		}
		else
		{
		    $table_values['login'] = $this->data['request']->parameters['email'];
		    $table_values['email'] = $this->data['request']->parameters['email'];
		    $table_values['name'] = $this->data['request']->parameters['name'];
		    $table_values['surname'] = $this->data['request']->parameters['surname'];
		    $table_values['patronymic'] = $this->data['request']->parameters['patronymic'];
		    $table_values['about'] = $this->data['request']->parameters['about'];
		    $password = substr(md5(rand()),0, 8);
		    $table_values['password'] = md5($password);	
		    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
			->values($table_values)
			->insert();
		    $this->data['id'] = $this->dbmanager->getLastID();

		    $this->save_log($this->data['item']->id, 'insert', 'users', $table_values);

		    if ($this->data['request']->parameters['role_id'] == 4) $role = 'проектного менеджера';
		    if ($this->data['request']->parameters['role_id'] == 5) $role = 'риелтора (риелторской компании)';
		    if ($this->data['request']->parameters['role_id'] == 6) $role = 'кредитного специалиста';
		    if ($this->data['request']->parameters['role_id'] == 7) $role = 'оценщика';
		    if ($this->data['request']->parameters['role_id'] == 8) $role = 'покупателя';
		    
		    //Send email with password to created user

		    $to = $this->data['request']->parameters['email'];
		    $subject = 'Регистрация '.$role;
		    $message = 'Ваш логин: '.$this->data['request']->parameters['email'].' Ваш пароль: '.$password;
		    $headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		    mail($to, $subject, $message, $headers);

		    unset($table_values);

		    $table_values['user_id'] = $this->data['id'];
		    $table_values['birthday'] = $this->data['request']->parameters['birthday'];
		    $table_values['mobile'] = $this->data['request']->parameters['mobile'];
		    $table_values['home'] = $this->data['request']->parameters['home'];
		    $table_values['phone1'] = $this->data['request']->parameters['phone1'];
		    $table_values['phone2'] = $this->data['request']->parameters['phone2'];
		    $table_values['id_serial'] = $this->data['request']->parameters['id_serial'];
		    $table_values['id_pin'] = $this->data['request']->parameters['id_pin'];
		    $table_values['comment'] = $this->data['request']->parameters['comment'];
		    $table_values['company_name'] = $this->data['request']->parameters['company_name'];
		    $table_values['logo'] = $this->data['request']->parameters['logo'];
		    $table_values['company'] = $this->data['request']->parameters['company'];
		    $table_values['voen'] = $this->data['request']->parameters['voen'];
		    $table_values['bank'] = $this->data['request']->parameters['bank'];
		    $table_values['website'] = $this->data['request']->parameters['website'];
		    $table_values['reg_date'] = date('Y-m-d H:i:s');
		    $table_values['reg_by'] = $this->data['item']->id;
		    $table_values['validated'] = 1;
		    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
			->values($table_values)
			->insert();

		    $this->save_log($this->data['item']->id, 'insert', 'rmrt_user_meta', $table_values);

		    unset($table_values);
		    $table_values['user_id'] = $this->data['id'];
		    $table_values['role_id'] = $this->data['request']->parameters['role_id'];
		    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'user_grants')
			->values($table_values)
			->insert();

		    $this->save_log($this->data['item']->id, 'insert', 'user_grants', $table_values);

		    $this->data['result'] = 'true';
		}
	    }
	    else { $this->data['result'] = 'false'; }
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
	
    public function deactivate()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4)
	{
	    $table_values['validated'] = 2;
	    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
		->values($table_values)
		->where('user_id = '.$this->data['request']->parameters['id'])
		->update();
	    
	    $table_values['status'] = 2;
	    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_bids')
		->values($table_values)
		->where('buyer = '.$this->data['request']->parameters['id'])
		->update();
	    
	    $this->save_log($this->data['item']->id, 'deactivate', 'users rmrt_user_meta', $table_values);
	}
    }
	
    public function activate()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	$this->data['user'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u')
            ->fields('u.id, u.email, u.password')
            ->where('u.id = "'.$this->data['request']->parameters['id'].'"')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4)
	{
	    $table_values['validated'] = 1;
	    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
		->values($table_values)
		->where('user_id = '.$this->data['request']->parameters['id'])
		->update();
		
	    $this->save_log($this->data['item']->id, 'activate', 'users rmrt_user_meta', $table_values);
					
	    if ($this->data['user']->password === '')
	    {
		unset($table_values);	
		$password = substr(md5(rand()),0, 8);
		$table_values['password'] = md5($password);	
		$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
		    ->values($table_values)
		    ->where('id = '.$this->data['request']->parameters['id'])
		    ->update();
			
		$this->save_log($this->data['item']->id, 'activate', 'users update users', $table_values);
			
		// Send email with new password to user
		    
		$to = $this->data['user']->email;
		$subject = 'Регистрация пользователя';
		$message = 'Ваш логин: '.$this->data['user']->email.' Ваш пароль: '.$password;
		$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);
	    }
	}
    }
	
    public function create_realtor()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	return $this->data;
    }
    
    public function create_realtor_company()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	return $this->data;
    }
    
    public function project_manager_card()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.id, ug.role_id, um.passch')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 2 AND um.user_id = u.id AND um.validated = 1')
            ->getScalar();
        return $this->data;
    }
    
    public function realtor_company_card()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
        return $this->data;
    }
    
    public function realtor_card()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
        return $this->data;
    }
    
    public function create_credit_specialist()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 4 || $this->data['item']->role_id == 2)
	{
	    $this->data['banks'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_banks')
		->fields('*')
		->where('status = 1')
		->select();
	}
	return $this->data;
    }
    
    public function credit_specialist_card()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 4 || $this->data['item']->role_id == 2)
	{
	    $this->data['banks'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_banks')
		->fields('*')
		->where('status = 1')
		->select();
	}
	return $this->data;
    }
    
    public function appraiser_card()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 3 || $this->data['item']->role_id == 2)
	{
	    $this->data['banks'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_banks')
		->fields('*')
		->where('status = 1')
		->select();
	}
	return $this->data;
    }
    
    public function buyer_card()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	return $this->data;
    }
    
    public function dashboard()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.id, ug.role_id, um.passch')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id AND um.validated = 1')
            ->getScalar();
	
	$this->data['buyers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, u.email, u.name, u.surname, u.patronymic')
            ->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 8')
            ->select();
	$this->data['bidbuyers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_bids b')
            ->fields('u.id, u.email, u.name, u.surname, u.patronymic')
            ->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND b.buyer = u.id')
	    ->group('u.id')
            ->select();
	foreach ($this->data['buyers'] as $k=>$v)
	{
	    $this->data['buyers'][$k]->favorites = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites f, '.Backstage::gi()->db_table_prefix.'rmrt_objects o')
		->fields('o.*, TRUE as favorite')
		->where('f.user = '.$v->id.' AND o.id = f.object')
		->select();
	}
	$this->data['banks'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_banks')
	    ->fields('*')
	    ->where('status = 1')
	    ->order('name')
	    ->select();
	$this->data['objects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
	    ->fields('*')
	    ->where('status = 7')
	    ->order('reg_date DESC')
	    ->select();
	$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
	    ->fields('*')
	    ->where("visibility = 1")
	    ->select();
	$this->data['allcities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
	    ->fields('*')
	    ->select();
	$this->data['objcities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities c', Backstage::gi()->db_table_prefix.'rmrt_objects o')
	    ->fields('c.*')
	    ->where('o.city = c.id')
	    ->group('c.id')
	    ->select();
	$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
	    ->fields('*')
	    ->select();
	$this->data['objregions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions c', Backstage::gi()->db_table_prefix.'rmrt_objects o')
	    ->fields('c.*')
	    ->where('o.region = c.id')
	    ->group('c.id')
	    ->select();
	$this->data['objmetro'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro c', Backstage::gi()->db_table_prefix.'rmrt_objects o')
	    ->fields('c.*')
	    ->where('o.metro = c.id')
	    ->group('c.id')
	    ->select();
	$this->data['objusers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_objects o')
	    ->fields('u.id, u.name, u.surname')
	    ->where('o.realtor = u.id')
	    ->group('u.id')
	    ->select();
	$this->data['metros'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro')
	    ->fields('*')
	    ->select();
	$this->data['orients'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_orient')
	    ->fields('*')
	    ->select();
	$this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
	    ->fields('*')
	    ->select();
	$this->data['rieltors'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, u.email, u.name, u.surname, u.patronymic')
            ->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 6')
            ->select();
	$this->data['apprizers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.id, u.email, um.company_name as name')
            ->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 7 AND um.user_id = u.id')
            ->select();
	$this->data['cs'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.id, u.name, u.surname')
            ->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 6 AND um.user_id = u.id')
            ->select();
	foreach ($this->data['objects'] as $key=>$object)
	{
	    if ($this->data['objects'][$key]->type == 1) $this->data['objects'][$key]->type = "Квартира";
	    if ($this->data['objects'][$key]->type == 2) $this->data['objects'][$key]->type = "Частный дом";
	    $this->data['objects'][$key]->city_id = $this->data['objects'][$key]->city;
	    $this->data['objects'][$key]->region_id = $this->data['objects'][$key]->region;
	    $this->data['objects'][$key]->metro_id = $this->data['objects'][$key]->metro;
	    $this->data['objects'][$key]->orient_id = $this->data['objects'][$key]->orient;
	    $this->data['objects'][$key]->city = $this->data['allcities'][$this->data['objects'][$key]->city - 1]->name;
	    $this->data['objects'][$key]->region = $this->data['regions'][$this->data['objects'][$key]->region - 1]->name;
	    $this->data['objects'][$key]->metro = $this->data['metros'][$this->data['objects'][$key]->metro - 1]->name;
	    if (isset($this->data['orients'][$this->data['objects'][$key]->orient - 1])) $this->data['objects'][$key]->orient = $this->data['orients'][$this->data['objects'][$key]->orient - 1]->name;
	}
	return $this->data;
    }
    
    public function get_objects()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4 || $this->data['item']->role_id == 5 || $this->data['item']->role_id == 8)
	{
	    $this->data['request']->parameters['search'] = strtolower($this->data['request']->parameters['search']); 
	    if ($this->data['request']->parameters['realtor'] == '-') $this->data['request']->parameters['realtor'] = '%';
	    if ($this->data['request']->parameters['status'] == '-') $this->data['request']->parameters['status'] = '1,2,3,4,5,6,7,8';
	    if ($this->data['request']->parameters['search'] == '-') $this->data['request']->parameters['search'] = '%';
	    if (isset($this->data['request']->parameters['metro'])) $metro = " metro IN (".$this->data['request']->parameters['metro'].") AND ";
	    else $metro = '';
	    $this->data['result']['count'] = $this->dbmanager->selectByQuery('SELECT COUNT(*) as cnt FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o WHERE id LIKE "%'.$this->data['request']->parameters['id'].'%" AND type LIKE "%'.$this->data['request']->parameters['type'].'%" AND ap_type LIKE "%'.$this->data['request']->parameters['ap_type'].'%" AND room IN ('.$this->data['request']->parameters['room'].') AND square >= '.$this->data['request']->parameters['square_min'].' AND square <= '.$this->data['request']->parameters['square_max'].' AND price >= '.$this->data['request']->parameters['price_min'].' AND price <= '.$this->data['request']->parameters['price_max'].' AND city IN ('.$this->data['request']->parameters['city'].') AND region IN ('.$this->data['request']->parameters['region'].') AND address LIKE "%'.$this->data['request']->parameters['address'].'%" AND realtor LIKE "'.$this->data['request']->parameters['realtor'].'" AND '.$metro.' status IN ('.$this->data['request']->parameters['status'].') AND (SELECT COUNT(b.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_appraiser_objects b WHERE b.object_id = o.id AND b.valued = 1) IN ('.$this->data['request']->parameters['valued'].') AND (id LIKE "%'.$this->data['request']->parameters['search'].'%" OR (SELECT COUNT(c.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_cities c WHERE o.city = c.id AND lower(c.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0 OR (SELECT COUNT(d.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_regions d WHERE o.region = d.id AND lower(d.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0)')[0]->cnt;
	    $this->data['request']->parameters['sort'] = str_replace('-', ' ', $this->data['request']->parameters['sort']);
	    $this->data['result']['data'] = $this->dbmanager->selectByQuery('SELECT o.*, (SELECT COUNT(b.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_appraiser_objects b WHERE b.object_id = o.id AND b.valued = 1) as valued_obj FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o WHERE id LIKE "%'.$this->data['request']->parameters['id'].'%" AND type LIKE "%'.$this->data['request']->parameters['type'].'%" AND ap_type LIKE "%'.$this->data['request']->parameters['ap_type'].'%" AND room IN ('.$this->data['request']->parameters['room'].') AND square >= '.$this->data['request']->parameters['square_min'].' AND square <= '.$this->data['request']->parameters['square_max'].' AND price >= '.$this->data['request']->parameters['price_min'].' AND price <= '.$this->data['request']->parameters['price_max'].' AND city IN ('.$this->data['request']->parameters['city'].') AND region IN ('.$this->data['request']->parameters['region'].') AND '.$metro.' address LIKE "%'.$this->data['request']->parameters['address'].'%" AND realtor LIKE "'.$this->data['request']->parameters['realtor'].'" AND status IN ('.$this->data['request']->parameters['status'].') AND (SELECT COUNT(b.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_appraiser_objects b WHERE b.object_id = o.id AND b.valued = 1) IN ('.$this->data['request']->parameters['valued'].') AND (id LIKE "%'.$this->data['request']->parameters['search'].'%" OR (SELECT COUNT(c.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_cities c WHERE o.city = c.id AND lower(c.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0 OR (SELECT COUNT(d.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_regions d WHERE o.region = d.id AND lower(d.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0) ORDER BY '.$this->data['request']->parameters['sort'].' LIMIT '.$this->data['request']->parameters['offset'].", ".$this->data['request']->parameters['limit']);
	    
	    $this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
		->fields('*')
		->select();
	    $this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
		->fields('*')
		->select();
	    $this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
		->fields('*')
		->select();
	    //$type[1] = 'Квартира';
	    //$type[2] = 'Частный дом';
	    foreach ($this->data['result']['data'] as $key=>$result)
	    {
		$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
		    ->fields('u.id, u.email, u.name, u.surname, u.patronymic, um.company, um.company_name')
		    ->where('um.user_id = u.id AND u.id = '.$this->data['result']['data'][$key]->realtor)
		    ->getScalar();
		$this->data['result']['data'][$key]->realtor_id = $this->data['result']['data'][$key]->realtor;
		if ($this->data['realtor']->company == 0) $this->data['result']['data'][$key]->realtor = $this->data['realtor']->name." ".$this->data['realtor']->surname;
		else $this->data['result']['data'][$key]->realtor = $this->data['realtor']->company_name;
		$this->data['result']['data'][$key]->city_id = $this->data['result']['data'][$key]->city;
		if ($this->data['result']['data'][$key]->city == 6) $this->data['result']['data'][$key]->region = $this->data['regions'][$this->data['result']['data'][$key]->region - 1]->name;
		$this->data['result']['data'][$key]->city = $this->data['cities'][$this->data['result']['data'][$key]->city - 1]->name;
		//if ($this->data['result']['data'][$key]->type == 1 && $this->data['result']['data'][$key]->ap_type == 2) $this->data['result']['data'][$key]->project = $this->data['projects'][$this->data['result']['data'][$key]->project - 1]->name;
		//$this->data['result']['data'][$key]->type = $type[$this->data['result']['data'][$key]->type];
		$this->data['main_image'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'materials')
		    ->fields('material_path')
		    ->where('id = "'.$this->data['result']['data'][$key]->main_photo.'"')
		    ->getScalar();
		if ($this->data['main_image']) $this->data['result']['data'][$key]->main_photo = $this->data['main_image']->material_path;
		$this->data['favorites'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
		    ->fields('*')
		    ->where('user = '.$this->data['item']->id.' AND object = "'.$this->data['result']['data'][$key]->id.'"')
		    ->getScalar();
		if ($this->data['favorites']) $this->data['result']['data'][$key]->favorite = true;
		else $this->data['result']['data'][$key]->favorite = false;
	    } 
	}
	else if ($this->data['item']->role_id == 7) 
	{
	    $this->data['request']->parameters['search'] = strtolower($this->data['request']->parameters['search']); 
	    if ($this->data['request']->parameters['realtor'] == '-') $this->data['request']->parameters['realtor'] = '%';
	    if ($this->data['request']->parameters['city'] == '-') $this->data['request']->parameters['city'] = '%';
	    if ($this->data['request']->parameters['region'] == '-') $this->data['request']->parameters['region'] = '%';
	    if ($this->data['request']->parameters['status'] == '-') $this->data['request']->parameters['status'] = '%';
	    if ($this->data['request']->parameters['search'] == '-') $this->data['request']->parameters['search'] = '%';
	    if (isset($this->data['request']->parameters['metro'])) $metro = " metro IN (".$this->data['request']->parameters['metro'].") AND ";
	    else $metro = '';
	    $this->data['result']['count'] = $this->dbmanager->selectByQuery('SELECT COUNT(*) as cnt FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o, '.Backstage::gi()->db_table_prefix.'rmrt_appraiser_objects ao WHERE ao.appraiser_id = '.$this->data['item']->id.' AND ao.object_id = o.id AND o.id LIKE "%'.$this->data['request']->parameters['id'].'%" AND type LIKE "%'.$this->data['request']->parameters['type'].'%" AND ap_type LIKE "%'.$this->data['request']->parameters['ap_type'].'%" AND room IN ('.$this->data['request']->parameters['room'].') AND square >= '.$this->data['request']->parameters['square_min'].' AND square <= '.$this->data['request']->parameters['square_max'].' AND price >= '.$this->data['request']->parameters['price_min'].' AND price <= '.$this->data['request']->parameters['price_max'].' AND city IN ('.$this->data['request']->parameters['city'].') AND region IN ('.$this->data['request']->parameters['region'].') AND '.$metro.' address LIKE "%'.$this->data['request']->parameters['address'].'%" AND realtor LIKE "'.$this->data['request']->parameters['realtor'].'" AND status IN (1,2,3,4,5,6,7) AND (o.id LIKE "%'.$this->data['request']->parameters['search'].'%" OR (SELECT COUNT(c.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_cities c WHERE o.city = c.id AND lower(c.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0 OR (SELECT COUNT(d.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_regions d WHERE o.region = d.id AND lower(d.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0)')[0]->cnt;
	    $this->data['request']->parameters['sort'] = str_replace('-', ' ', $this->data['request']->parameters['sort']);
	    $this->data['result']['data'] = $this->dbmanager->selectByQuery('SELECT o.* FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o, '.Backstage::gi()->db_table_prefix.'rmrt_appraiser_objects ao WHERE ao.appraiser_id = '.$this->data['item']->id.' AND ao.object_id = o.id AND o.id LIKE "%'.$this->data['request']->parameters['id'].'%" AND type LIKE "%'.$this->data['request']->parameters['type'].'%" AND ap_type LIKE "%'.$this->data['request']->parameters['ap_type'].'%" AND room IN ('.$this->data['request']->parameters['room'].') AND square >= '.$this->data['request']->parameters['square_min'].' AND '.$metro.' square <= '.$this->data['request']->parameters['square_max'].' AND price >= '.$this->data['request']->parameters['price_min'].' AND price <= '.$this->data['request']->parameters['price_max'].' AND city IN ('.$this->data['request']->parameters['city'].') AND region IN ('.$this->data['request']->parameters['region'].') AND address LIKE "%'.$this->data['request']->parameters['address'].'%" AND realtor LIKE "'.$this->data['request']->parameters['realtor'].'" AND status IN (1,2,3,4,5,6,7) AND (o.id LIKE "%'.$this->data['request']->parameters['search'].'%" OR (SELECT COUNT(c.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_cities c WHERE o.city = c.id AND lower(c.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0 OR (SELECT COUNT(d.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_regions d WHERE o.region = d.id AND lower(d.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0) ORDER BY '.$this->data['request']->parameters['sort'].' LIMIT '.$this->data['request']->parameters['offset'].", ".$this->data['request']->parameters['limit']);
	    
	    $this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
		->fields('*')
		->select();
	    $this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
		->fields('*')
		->select();
	    $this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
		->fields('*')
		->select();
	    //$type[1] = 'Квартира';
	    //$type[2] = 'Частный дом';
	    foreach ($this->data['result']['data'] as $key=>$result)
	    {
		$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
		    ->fields('u.id, u.email, u.name, u.surname, u.patronymic, um.company, um.company_name')
		    ->where('um.user_id = u.id AND u.id = '.$this->data['result']['data'][$key]->realtor)
		    ->getScalar();
		$this->data['result']['data'][$key]->realtor_id = $this->data['result']['data'][$key]->realtor;
		if ($this->data['realtor']->company == 0) $this->data['result']['data'][$key]->realtor = $this->data['realtor']->name." ".$this->data['realtor']->surname;
		else $this->data['result']['data'][$key]->realtor = $this->data['realtor']->company_name;
		$this->data['result']['data'][$key]->city_id = $this->data['result']['data'][$key]->city;
		if ($this->data['result']['data'][$key]->city == 6) $this->data['result']['data'][$key]->region = $this->data['regions'][$this->data['result']['data'][$key]->region - 1]->name;
		$this->data['result']['data'][$key]->city = $this->data['cities'][$this->data['result']['data'][$key]->city - 1]->name;
		//if ($this->data['result']['data'][$key]->type == 1 && $this->data['result']['data'][$key]->ap_type == 2) $this->data['result']['data'][$key]->project = $this->data['projects'][$this->data['result']['data'][$key]->project - 1]->name;
		//$this->data['result']['data'][$key]->type = $type[$this->data['result']['data'][$key]->type];
		$this->data['main_image'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'materials')
		    ->fields('material_path')
		    ->where('id = "'.$this->data['result']['data'][$key]->main_photo.'"')
		    ->getScalar();
		if ($this->data['main_image']) $this->data['result']['data'][$key]->main_photo = $this->data['main_image']->material_path;
		$this->data['favorites'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
		    ->fields('*')
		    ->where('user = '.$this->data['item']->id.' AND object = "'.$this->data['result']['data'][$key]->id.'"')
		    ->getScalar();
		if ($this->data['favorites']) $this->data['result']['data'][$key]->favorite = true;
		else $this->data['result']['data'][$key]->favorite = false;
	    }
	}
	else $this->data['result'] = 'false';
	return $this->data;
    }
    
    public function get_favorites()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4 || $this->data['item']->role_id == 5 || $this->data['item']->role_id == 8)
	{
	    $this->data['request']->parameters['search'] = strtolower($this->data['request']->parameters['search']); 
	    if ($this->data['request']->parameters['realtor'] == '-') $this->data['request']->parameters['realtor'] = '%';
	    if ($this->data['request']->parameters['city'] == '-') $this->data['request']->parameters['city'] = '%';
	    if ($this->data['request']->parameters['region'] == '-') $this->data['request']->parameters['region'] = '%';
	    if ($this->data['request']->parameters['status'] == '-') $this->data['request']->parameters['status'] = '1,2,3,4,5,6,7,8';
	    if ($this->data['request']->parameters['search'] == '-') $this->data['request']->parameters['search'] = '%';
	    if (isset($this->data['request']->parameters['metro'])) $metro = " metro IN (".$this->data['request']->parameters['metro'].") AND ";
	    else $metro = '';
	    $this->data['result']['count'] = $this->dbmanager->selectByQuery('SELECT COUNT(*) as cnt FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o, '.Backstage::gi()->db_table_prefix.'rmrt_favorites f WHERE f.user = '.$this->data['request']->parameters['user'].' AND f.object = o.id AND o.id LIKE "%'.$this->data['request']->parameters['id'].'%" AND type LIKE "%'.$this->data['request']->parameters['type'].'%" AND room IN ('.$this->data['request']->parameters['room'].') AND square >= '.$this->data['request']->parameters['square_min'].' AND square <= '.$this->data['request']->parameters['square_max'].' AND price >= '.$this->data['request']->parameters['price_min'].' AND price <= '.$this->data['request']->parameters['price_max'].' AND city IN ('.$this->data['request']->parameters['city'].') AND region IN ('.$this->data['request']->parameters['region'].') AND '.$metro.' address LIKE "%'.$this->data['request']->parameters['address'].'%" AND realtor LIKE "'.$this->data['request']->parameters['realtor'].'" AND status IN ('.$this->data['request']->parameters['status'].') AND (o.id LIKE "%'.$this->data['request']->parameters['search'].'%" OR (SELECT COUNT(c.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_cities c WHERE o.city = c.id AND lower(c.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0 OR (SELECT COUNT(d.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_regions d WHERE o.region = d.id AND lower(d.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0)')[0]->cnt;
	    $this->data['request']->parameters['sort'] = str_replace('-', ' ', $this->data['request']->parameters['sort']);
	    $this->data['result']['data'] = $this->dbmanager->selectByQuery('SELECT o.* FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o, '.Backstage::gi()->db_table_prefix.'rmrt_favorites f WHERE f.user = '.$this->data['request']->parameters['user'].' AND f.object = o.id AND o.id LIKE "%'.$this->data['request']->parameters['id'].'%" AND type LIKE "%'.$this->data['request']->parameters['type'].'%" AND room IN ('.$this->data['request']->parameters['room'].') AND square >= '.$this->data['request']->parameters['square_min'].' AND '.$metro.' square <= '.$this->data['request']->parameters['square_max'].' AND price >= '.$this->data['request']->parameters['price_min'].' AND price <= '.$this->data['request']->parameters['price_max'].' AND city IN ('.$this->data['request']->parameters['city'].') AND region IN ('.$this->data['request']->parameters['region'].') AND address LIKE "%'.$this->data['request']->parameters['address'].'%" AND realtor LIKE "'.$this->data['request']->parameters['realtor'].'" AND status IN ('.$this->data['request']->parameters['status'].') AND (o.id LIKE "%'.$this->data['request']->parameters['search'].'%" OR (SELECT COUNT(c.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_cities c WHERE o.city = c.id AND lower(c.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0 OR (SELECT COUNT(d.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_regions d WHERE o.region = d.id AND lower(d.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0) ORDER BY '.$this->data['request']->parameters['sort'].' LIMIT '.$this->data['request']->parameters['offset'].", ".$this->data['request']->parameters['limit']);
	    
	    $this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
		->fields('*')
		->select();
	    $this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
		->fields('*')
		->select();
	    $this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
		->fields('*')
		->select();
	    //$type[1] = 'Квартира';
	    //$type[2] = 'Частный дом';
	    foreach ($this->data['result']['data'] as $key=>$result)
	    {
		$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
		    ->fields('u.id, u.email, u.name, u.surname, u.patronymic, um.company, um.company_name')
		    ->where('um.user_id = u.id AND u.id = '.$this->data['result']['data'][$key]->realtor)
		    ->getScalar();
		$this->data['result']['data'][$key]->realtor_id = $this->data['result']['data'][$key]->realtor;
		if ($this->data['realtor']->company == 0) $this->data['result']['data'][$key]->realtor = $this->data['realtor']->name." ".$this->data['realtor']->surname;
		else $this->data['result']['data'][$key]->realtor = $this->data['realtor']->company_name;
		$this->data['result']['data'][$key]->city_id = $this->data['result']['data'][$key]->city;
		if ($this->data['result']['data'][$key]->city == 6) $this->data['result']['data'][$key]->region = $this->data['regions'][$this->data['result']['data'][$key]->region - 1]->name;
		$this->data['result']['data'][$key]->city = $this->data['cities'][$this->data['result']['data'][$key]->city - 1]->name;
		//if ($this->data['result']['data'][$key]->type == 1 && $this->data['result']['data'][$key]->ap_type == 2) $this->data['result']['data'][$key]->project = $this->data['projects'][$this->data['result']['data'][$key]->project - 1]->name;
		//$this->data['result']['data'][$key]->type = $type[$this->data['result']['data'][$key]->type];
		$this->data['main_image'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'materials')
		    ->fields('material_path')
		    ->where('id = "'.$this->data['result']['data'][$key]->main_photo.'"')
		    ->getScalar();
		if ($this->data['main_image']) $this->data['result']['data'][$key]->main_photo = $this->data['main_image']->material_path;
		$this->data['favorites'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
		    ->fields('*')
		    ->where('user = '.$this->data['item']->id.' AND object = "'.$this->data['result']['data'][$key]->id.'"')
		    ->getScalar();
		if ($this->data['favorites']) $this->data['result']['data'][$key]->favorite = true;
		else $this->data['result']['data'][$key]->favorite = false;
	    } 
	}
	else if ($this->data['item']->role_id == 7) 
	{
	    $this->data['request']->parameters['search'] = strtolower($this->data['request']->parameters['search']); 
	    if ($this->data['request']->parameters['realtor'] == '-') $this->data['request']->parameters['realtor'] = '%';
	    if ($this->data['request']->parameters['city'] == '-') $this->data['request']->parameters['city'] = '%';
	    if ($this->data['request']->parameters['region'] == '-') $this->data['request']->parameters['region'] = '%';
	    if ($this->data['request']->parameters['status'] == '-') $this->data['request']->parameters['status'] = '%';
	    if ($this->data['request']->parameters['search'] == '-') $this->data['request']->parameters['search'] = '%';
	    if (isset($this->data['request']->parameters['metro'])) $metro = " metro IN (".$this->data['request']->parameters['metro'].") AND ";
	    else $metro = '';
	    $this->data['result']['count'] = $this->dbmanager->selectByQuery('SELECT COUNT(*) as cnt FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o, '.Backstage::gi()->db_table_prefix.'rmrt_appraiser_objects ao, '.Backstage::gi()->db_table_prefix.'rmrt_favorites f WHERE f.user = '.$this->data['request']->parameters['user'].' AND f.object = o.id AND ao.appraiser_id = '.$this->data['item']->id.' AND ao.object_id = o.id AND o.id LIKE "%'.$this->data['request']->parameters['id'].'%" AND type LIKE "%'.$this->data['request']->parameters['type'].'%" AND room IN ('.$this->data['request']->parameters['room'].') AND square >= '.$this->data['request']->parameters['square_min'].' AND square <= '.$this->data['request']->parameters['square_max'].' AND price >= '.$this->data['request']->parameters['price_min'].' AND price <= '.$this->data['request']->parameters['price_max'].' AND '.$metro.' city IN ('.$this->data['request']->parameters['city'].') AND region IN ('.$this->data['request']->parameters['region'].') AND address LIKE "%'.$this->data['request']->parameters['address'].'%" AND realtor LIKE "'.$this->data['request']->parameters['realtor'].'" AND status = 5 AND (o.id LIKE "%'.$this->data['request']->parameters['search'].'%" OR (SELECT COUNT(c.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_cities c WHERE o.city = c.id AND lower(c.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0 OR (SELECT COUNT(d.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_regions d WHERE o.region = d.id AND lower(d.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0)')[0]->cnt;
	    $this->data['request']->parameters['sort'] = str_replace('-', ' ', $this->data['request']->parameters['sort']);
	    $this->data['result']['data'] = $this->dbmanager->selectByQuery('SELECT o.* FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o, '.Backstage::gi()->db_table_prefix.'rmrt_appraiser_objects ao, '.Backstage::gi()->db_table_prefix.'rmrt_favorites f WHERE f.user = '.$this->data['request']->parameters['user'].' AND f.object = o.id AND ao.appraiser_id = '.$this->data['item']->id.' AND ao.object_id = o.id AND o.id LIKE "%'.$this->data['request']->parameters['id'].'%" AND type LIKE "%'.$this->data['request']->parameters['type'].'%" AND room IN ('.$this->data['request']->parameters['room'].') AND square >= '.$this->data['request']->parameters['square_min'].' AND square <= '.$this->data['request']->parameters['square_max'].' AND price >= '.$this->data['request']->parameters['price_min'].' AND price <= '.$this->data['request']->parameters['price_max'].' city IN ('.$this->data['request']->parameters['city'].') AND region IN ('.$this->data['request']->parameters['region'].') AND address LIKE "%'.$this->data['request']->parameters['address'].'%" AND '.$metro.' realtor LIKE "'.$this->data['request']->parameters['realtor'].'" AND status = 5 AND (o.id LIKE "%'.$this->data['request']->parameters['search'].'%" OR (SELECT COUNT(c.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_cities c WHERE o.city = c.id AND lower(c.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0 OR (SELECT COUNT(d.id) FROM '.Backstage::gi()->db_table_prefix.'rmrt_regions d WHERE o.region = d.id AND lower(d.name) LIKE "%'.$this->data['request']->parameters['search'].'%") > 0) ORDER BY '.$this->data['request']->parameters['sort'].' LIMIT '.$this->data['request']->parameters['offset'].", ".$this->data['request']->parameters['limit']);
	    
	    $this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
		->fields('*')
		->select();
	    $this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
		->fields('*')
		->select();
	    $this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
		->fields('*')
		->select();
	    //$type[1] = 'Квартира';
	    //$type[2] = 'Частный дом';
	    foreach ($this->data['result']['data'] as $key=>$result)
	    {
		$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
		    ->fields('u.id, u.email, u.name, u.surname, u.patronymic, um.company, um.company_name')
		    ->where('um.user_id = u.id AND u.id = '.$this->data['result']['data'][$key]->realtor)
		    ->getScalar();
		$this->data['result']['data'][$key]->realtor_id = $this->data['result']['data'][$key]->realtor;
		if ($this->data['realtor']->company == 0) $this->data['result']['data'][$key]->realtor = $this->data['realtor']->name." ".$this->data['realtor']->surname;
		else $this->data['result']['data'][$key]->realtor = $this->data['realtor']->company_name;
		$this->data['result']['data'][$key]->city_id = $this->data['result']['data'][$key]->city;
		if ($this->data['result']['data'][$key]->city == 6) $this->data['result']['data'][$key]->region = $this->data['regions'][$this->data['result']['data'][$key]->region - 1]->name;
		$this->data['result']['data'][$key]->city = $this->data['cities'][$this->data['result']['data'][$key]->city - 1]->name;
		//if ($this->data['result']['data'][$key]->type == 1 && $this->data['result']['data'][$key]->ap_type == 2) $this->data['result']['data'][$key]->project = $this->data['projects'][$this->data['result']['data'][$key]->project - 1]->name;
		//$this->data['result']['data'][$key]->type = $type[$this->data['result']['data'][$key]->type];
		$this->data['main_image'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'materials')
		    ->fields('material_path')
		    ->where('id = "'.$this->data['result']['data'][$key]->main_photo.'"')
		    ->getScalar();
		if ($this->data['main_image']) $this->data['result']['data'][$key]->main_photo = $this->data['main_image']->material_path;
		$this->data['favorites'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
		    ->fields('*')
		    ->where('user = '.$this->data['item']->id.' AND object = "'.$this->data['result']['data'][$key]->id.'"')
		    ->getScalar();
		//if ($this->data['favorites']) $this->data['result']['data'][$key]->favorite = true;
		//else $this->data['result']['data'][$key]->favorite = false;
	    }
	}
	else $this->data['result'] = 'false';
	return $this->data;
    }
    
    public function object_card()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
	    ->fields('*')
	    ->where("visibility = 1")
	    ->select();
	$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
            ->fields('*')
            ->select();
	$this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
            ->fields('*')
            ->select();
	$this->data['metros'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro')
            ->fields('*')
            ->select();
	$this->data['orients'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_orient')
            ->fields('*')
            ->select();
	$this->data['appraisers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, u.name, u.surname')
	    ->where('u.id = ug.user_id AND ug.role_id = 7')
            ->select();
	$this->data['buyers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, u.name, u.surname')
	    ->where('u.id = ug.user_id AND ug.role_id = 8')
            ->select();
	return $this->data;
    }
    
    public function objects_view()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
            ->fields('*')
            ->select();
	$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
            ->fields('*')
            ->select();
	$this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
            ->fields('*')
            ->select();
	$this->data['metros'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro')
            ->fields('*')
            ->select();
	$this->data['orients'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_orient')
            ->fields('*')
            ->select();
	$this->data['appraisers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, u.name, u.surname')
	    ->where('u.id = ug.user_id AND ug.role_id = 7')
            ->select();
	return $this->data;
    }
    
    
    public function object()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
	    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id != 1)
	{
	    $this->data['result']['data'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
		->fields('*')
		->where('id = '.$this->data['request']->parameters['id'])
		->getScalar();
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function change_object_status()
    {	
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
	    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4)
	{
	    $table_values['status'] = $this->data['request']->parameters['status'];
	    $table_values['correction_comment'] = $this->data['request']->parameters['correction_comment'];
	    $this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
		->values($table_values)
		->where('id = '.$this->data['request']->parameters['id'])
		->update();
	    
	    if ($this->data['request']->parameters['status'] == 7) 
	    {
		$this->data['bids'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_bids b', Backstage::gi()->db_table_prefix.'rmrt_objects o')
		    ->fields('b.buyer')
		    ->where('o.city IN (b.city) AND o.room IN (b.room) AND o.price <= b.price_max AND o.region IN (b.region) AND b.status = 1 AND o.id = '.$this->data['request']->parameters['id'])
		    ->group("b.buyer")
		    ->select();
		foreach ($this->data['bids'] as $bid) {
		    $this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
			->fields('id')
			->where('user = '.$bid->buyer.' AND object = '.$this->data['request']->parameters['id'])
			->getScalar();
		    if (!$this->data['exists'])
		    {
			$table_values['user'] = $bid->buyer;
			$table_values['object'] = $this->data['request']->parameters['id'];
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
			    ->values($table_values)
			    ->insert();
			
			$this->data['recievers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u')
			    ->fields('u.id, u.email')
			    ->where('u.id = '.$bid->buyer)
			    ->select();
			foreach ($this->data['recievers'] as $reciever) {
			    $to = $reciever->email;
			    $subject = 'Новый объект в избранном на remart24.az';
			    $message = 'Уважаемый пользователь\r\nВ Вашем избранном добавлены новые объекты.\r\nС уважением,/r/nRemart 24';
			    $headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			    mail($to, $subject, $message, $headers);
			}
		    }
		}
	    }
	    
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function create_object()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
	    ->fields('*')
	    ->where("visibility = 1")
	    ->select();
	$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
            ->fields('*')
            ->select();
	$this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
            ->fields('*')
            ->select();
	$this->data['metros'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro')
            ->fields('*')
            ->select();
	$this->data['orients'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_orient')
            ->fields('*')
            ->select();
	return $this->data;
    }
    
    public function save_object()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 5 || $this->data['item']->role_id == 4)
	{
	    if (isset($this->data['request']->parameters['id']))
	    {
		//$this->data['request']->parameters['orient'] = implode(',', $this->data['request']->parameters['orient']);
		$table_values['type'] = $this->data['request']->parameters['type'];
		$table_values['comment'] = $this->data['request']->parameters['comment'];
		$table_values['address'] = $this->data['request']->parameters['address'];
		$table_values['kupche_doc'] = $this->data['request']->parameters['kupche_doc'];
		$table_values['texpass_doc'] = $this->data['request']->parameters['texpass_doc'];
		$table_values['city'] = $this->data['request']->parameters['city'];
		$table_values['region'] = $this->data['request']->parameters['region'];
		$table_values['metro'] = $this->data['request']->parameters['metro'];
		$table_values['orient'] = $this->data['request']->parameters['orient'];
		$table_values['project'] = $this->data['request']->parameters['project'];
		$table_values['price'] = $this->data['request']->parameters['price'];
		$table_values['ap_type'] = $this->data['request']->parameters['ap_type'];
		$table_values['kupche'] = $this->data['request']->parameters['kupche'];
		$table_values['pravo'] = $this->data['request']->parameters['pravo'];
		$table_values['gas'] = $this->data['request']->parameters['gas'];
		$table_values['room'] = $this->data['request']->parameters['room'];
		$table_values['floors'] = $this->data['request']->parameters['floors'];
		$table_values['floor'] = $this->data['request']->parameters['floor'];
		$table_values['square_zeml'] = $this->data['request']->parameters['square_zeml'];
		$table_values['square'] = $this->data['request']->parameters['square'];
		$table_values['sanuz'] = $this->data['request']->parameters['sanuz'];
		$table_values['balkon'] = $this->data['request']->parameters['balkon'];
		$table_values['remont'] = $this->data['request']->parameters['remont'];
		$table_values['phone'] = $this->data['request']->parameters['phone'];
		$table_values['kabeltv'] = $this->data['request']->parameters['kabeltv'];
		$table_values['lift'] = $this->data['request']->parameters['lift'];
		$table_values['garage'] = $this->data['request']->parameters['garage'];
		$table_values['safe'] = $this->data['request']->parameters['safe'];
		$table_values['pvcwin'] = $this->data['request']->parameters['pvcwin'];
		$table_values['waterboil'] = $this->data['request']->parameters['waterboil'];
		$table_values['warm'] = $this->data['request']->parameters['warm'];
		$table_values['kombi'] = $this->data['request']->parameters['kombi'];
		$table_values['conditioner'] = $this->data['request']->parameters['conditioner'];
		$table_values['kitchen'] = $this->data['request']->parameters['kitchen'];
		$table_values['pool'] = $this->data['request']->parameters['pool'];
		$table_values['photo'] = $this->data['request']->parameters['photo'];					
		$table_values['main_photo'] = $this->data['request']->parameters['main_photo'];					
		$table_values['lat'] = $this->data['request']->parameters['lat'];					
		$table_values['lng'] = $this->data['request']->parameters['lng'];			
		$table_values['kupche_text'] = $this->data['request']->parameters['kupche_text'];			
		if (isset($this->data['request']->parameters['status'])) $table_values['status'] = $this->data['request']->parameters['status'];
		if ($table_values['city'] != 6)
		{
		    $table_values['region'] = NULL;
		    $table_values['metro'] = NULL;
		    $table_values['orient'] = NULL;
		}
		$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
		    ->values($table_values)
		    ->where('id = '.$this->data['request']->parameters['id'])
		    ->update();
		
		$images = json_decode($this->data['request']->parameters['imgord']);
		unset($table_values);
		foreach ($images as $key=>$image)
		{
		    $table_values['ordering'] = $image;
		    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'materials')
			->values($table_values)
			->where('id = '.$key)
			->update();
		}
					
		$tv['user'] = $this->data['item']->id;
		$tv['date'] = date('Y-m-d H:i:s');
		$tv['action'] = 'UPDATE OBJECT '.json_encode($table_values);
		$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
		    ->values($tv)
		    ->insert();
						
		$this->data['result'] = 'true';
	    }
	    else
	    {
		//$this->data['request']->parameters['orient'] = implode(',', $this->data['request']->parameters['orient']);
		$table_values['realtor'] = $this->data['item']->id;
		$table_values['type'] = $this->data['request']->parameters['type'];
		$table_values['address'] = $this->data['request']->parameters['address'];
		$table_values['kupche_doc'] = $this->data['request']->parameters['kupche_doc'];
		$table_values['texpass_doc'] = $this->data['request']->parameters['texpass_doc'];
		$table_values['city'] = $this->data['request']->parameters['city'];
		$table_values['comment'] = $this->data['request']->parameters['comment'];
		$table_values['region'] = $this->data['request']->parameters['region'];
		$table_values['metro'] = $this->data['request']->parameters['metro'];
		$table_values['orient'] = $this->data['request']->parameters['orient'];
		$table_values['project'] = $this->data['request']->parameters['project'];
		$table_values['price'] = $this->data['request']->parameters['price'];
		$table_values['ap_type'] = $this->data['request']->parameters['ap_type'];
		$table_values['kupche'] = $this->data['request']->parameters['kupche'];
		$table_values['pravo'] = $this->data['request']->parameters['pravo'];
		$table_values['gas'] = $this->data['request']->parameters['gas'];
		$table_values['room'] = $this->data['request']->parameters['room'];
		$table_values['floors'] = $this->data['request']->parameters['floors'];
		$table_values['floor'] = $this->data['request']->parameters['floor'];
		$table_values['square_zeml'] = $this->data['request']->parameters['square_zeml'];
		$table_values['square'] = $this->data['request']->parameters['square'];
		$table_values['sanuz'] = $this->data['request']->parameters['sanuz'];
		$table_values['balkon'] = $this->data['request']->parameters['balkon'];
		$table_values['remont'] = $this->data['request']->parameters['remont'];
		$table_values['phone'] = $this->data['request']->parameters['phone'];
		$table_values['kabeltv'] = $this->data['request']->parameters['kabeltv'];
		$table_values['lift'] = $this->data['request']->parameters['lift'];
		$table_values['garage'] = $this->data['request']->parameters['garage'];
		$table_values['safe'] = $this->data['request']->parameters['safe'];
		$table_values['pvcwin'] = $this->data['request']->parameters['pvcwin'];
		$table_values['waterboil'] = $this->data['request']->parameters['waterboil'];
		$table_values['warm'] = $this->data['request']->parameters['warm'];
		$table_values['kombi'] = $this->data['request']->parameters['kombi'];
		$table_values['conditioner'] = $this->data['request']->parameters['conditioner'];
		$table_values['kitchen'] = $this->data['request']->parameters['kitchen'];
		$table_values['pool'] = $this->data['request']->parameters['pool'];
		$table_values['photo'] = $this->data['request']->parameters['photo'];
		$table_values['main_photo'] = $this->data['request']->parameters['main_photo'];
		$table_values['status'] = $this->data['request']->parameters['status'];
		$table_values['lat'] = $this->data['request']->parameters['lat'];					
		$table_values['lng'] = $this->data['request']->parameters['lng'];	
		$table_values['kupche_text'] = $this->data['request']->parameters['kupche_text'];	
		$table_values['reg_date'] = date('Y-m-d H:i:s');	
					
		if ($table_values['city'] != 6)
		{
		    $table_values['region'] = NULL;
		    $table_values['metro'] = NULL;
		    $table_values['orient'] = NULL;
		}
					
		$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
		    ->values($table_values)
		    ->insert();
		
		$images = json_decode($this->data['request']->parameters['imgord']);
		unset($table_values);
		foreach ($images as $key=>$image)
		{
		    $table_values['ordering'] = $image;
		    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'materials')
			->values($table_values)
			->where('id = '.$key)
			->update();
		}
					
		$tv['user'] = $this->data['item']->id;
		$tv['date'] = date('Y-m-d H:i:s');
		$tv['action'] = 'INSERT OBJECT '.json_encode($table_values);
		$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
		    ->values($tv)
		    ->insert();
						
		$this->data['result'] = 'true';
	    }
	}
	else $this->data['result'] = 'false';
	return $this->data;
    }
    
    public function send_to_appraiser()
    {	
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
	    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4)
	{
	    $this->data['objects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_appraiser_objects')
		->fields('*')
		->where('appraiser_id = '.$this->data['request']->parameters['appraiser_id'].' AND object_id = '.$this->data['request']->parameters['object_id'])
		->select();
	    if (!$this->data['objects']) {
		$table_values['appraiser_id'] = $this->data['request']->parameters['appraiser_id'];
		$table_values['object_id'] = $this->data['request']->parameters['object_id'];
		$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_appraiser_objects')
		    ->values($table_values)
		    ->insert();
		
		unset($table_values);
		$table_values['status'] = 5;
		$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
		    ->values($table_values)
		    ->where("id = ".$this->data['request']->parameters['object_id'])
		    ->update();
	    }
	    $this->data['result'] = 'true';
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function add_to_favorites()
    {	
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
	    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4)
	{
	    $this->data['objects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
		->fields('*')
		->where('user = '.$this->data['request']->parameters['user_id'].' AND object = '.$this->data['request']->parameters['object_id'])
		->select();
	    if (!$this->data['objects']) {
		$table_values['user'] = $this->data['request']->parameters['user_id'];
		$table_values['object'] = $this->data['request']->parameters['object_id'];
		$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
		    ->values($table_values)
		    ->insert();
		
		$this->data['recievers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u')
		    ->fields('u.id, u.email')
		    ->where('u.id = '.$this->data['request']->parameters['user_id'])
		    ->select();
		foreach ($this->data['recievers'] as $reciever) {
		    $to = $reciever->email;
		    $subject = 'Новый объект в избранном на remart24.az';
		    $message = 'Уважаемый пользователь\r\nВ Вашем избранном добавлены новые объекты.\r\nС уважением,/r/nRemart 24';
		    $headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		    mail($to, $subject, $message, $headers);
		}
	    }
	    $this->data['result'] = 'true';
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function view()
    {
	if (Backstage::gi()->login != '') {
	    $this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
		->fields('u.id, ug.role_id')
		->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id AND um.validated = 1')
		->getScalar();
	    if ($this->data['item']) {
		$this->data = $this->object();
		$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
		    ->fields('*')
		    ->where('id = '.$this->data['result']['data']->city)
		    ->getScalar();
		$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
		    ->fields('*')
		    ->where('id = '.$this->data['result']['data']->region)
		    ->getScalar();
		$this->data['metros'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro')
		    ->fields('*')
		    ->where('id = '.$this->data['result']['data']->metro)
		    ->getScalar();
		$this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
		    ->fields('*')
		    ->where('id = '.$this->data['result']['data']->project)
		    ->getScalar();
		$this->data['favorites'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
		    ->fields('*')
		    ->where('user = '.$this->data['item']->id.' AND object = '.$this->data['result']['data']->id)
		    ->getScalar();
		$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
		    ->fields('u.name, u.surname, um.phone1, um.phone2, um.mobile, um.home, um.company_name, um.company')
		    ->where('um.user_id = u.id AND u.id = '.$this->data['result']['data']->realtor)
		    ->getScalar();
		$this->data['appraisers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_appraiser_objects ao', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
		    ->fields('um.company_name, um.user_id, ao.rinok, ao.liquid')
		    ->where('um.user_id = ao.appraiser_id AND ao.object_id = '.$this->data['result']['data']->id)
		    ->select();
		}
		$this->data['images'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'materials')
		    ->fields('*')
		    ->where('id IN ('.$this->data['result']['data']->photo.')')
		    ->order("ordering")
		    ->select();
	}
	return $this->data;
    }
    
    public function valuate_object()
    {	
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
	    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 7)
	{
	    $table_values['rinok'] = $this->data['request']->parameters['rinok'];
	    $table_values['liquid'] = $this->data['request']->parameters['liquid'];
	    $table_values['valued'] = 1;
	    $this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_appraiser_objects')
	        ->values($table_values)
		->where('appraiser_id = '.$this->data['request']->parameters['appraiser_id'].' AND object_id = '.$this->data['request']->parameters['object_id'])
	        ->update();
	    unset($table_values);
	    $table_values['status'] = 6;
	    $this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
	        ->values($table_values)
		->where('id = '.$this->data['request']->parameters['object_id'])
	        ->update();
	    $this->data['result'] = 'true';
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function add_to_fav()
    {	
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
	    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4 || $this->data['item']->role_id == 8)
	{
	    $this->data['objects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
		->fields('*')
		->where('user = '.$this->data['item']->id.' AND object = '.$this->data['request']->parameters['object_id'])
		->getScalar();
	    if (!$this->data['objects']) {
		$table_values['user'] = $this->data['item']->id;
		$table_values['object'] = $this->data['request']->parameters['object_id'];
		$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
		    ->values($table_values)
		    ->insert();
		$this->data['result'] = '1';
	    }
	    else {
		$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
		    ->where('id = '.$this->data['objects']->id)
		    ->delete();
		$this->data['result'] = '2';
	    }
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function saveImage()
    {	
	if ($this->data['request']->parameters['secret'] == "seofest4df") {
	    $table_values['material_title'] = $this->data['request']->parameters['material_title'];
	    $table_values['material_path'] = $this->data['request']->parameters['material_path'];
	    $this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'materials')
		->values($table_values)
		->insert();
	    $this->data['id'] = $this->dbmanager->getLastID();
	}
	return $this->data;
    }
    
    public function getImage()
    {	
	$this->data['image'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'materials')
	    ->fields('*')
	    ->where('id = '.$this->data['request']->parameters['id'])
	    ->getScalar();
	return $this->data;
    }
    
    public function getImages()
    {	
	$this->data['images'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'materials')
	    ->fields('*')
	    ->where('id IN ('.$this->data['request']->parameters['ids'].')')
	    ->select();
	foreach ($this->data['images'] as $key=>$image)
	{
	    $this->data['images'][$key]->material_path = str_replace('/', '/thumb_', $this->data['images'][$key]->material_path);
	}
	return $this->data;
    }
    
    public function create_appraiser()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	return $this->data;
    }
    
    public function create_buyer()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	return $this->data;
    }
    
    public function favorites()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id AND um.validated = 1')
            ->getScalar();
	if ($this->data['item']->id)
	{
	    $this->data['objects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites f, '.Backstage::gi()->db_table_prefix.'rmrt_objects o')
		->fields('o.*, TRUE as favorite')
		->where('f.user = '.$this->data['item']->id.' AND o.id = f.object')
		->select();
	}
        return $this->data;
    }
	
    public function header()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.id, ug.role_id, um.mobile, u.email, u.name, u.surname')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id AND um.validated = 1')
            ->getScalar();
	$this->data['favorites'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
            ->fields('COUNT(*) as cnt')
            ->where('user = "'.$this->data['item']->id.'"')
            ->getScalar();
	$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
	    ->fields('*')
	    ->where("visibility = 1")
	    ->select();
	$this->data['objcities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities c', Backstage::gi()->db_table_prefix.'rmrt_objects o')
	    ->fields('c.*')
	    ->where('o.city = c.id')
	    ->group('c.id')
	    ->select();
	$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
	    ->fields('*')
	    ->select();
	$this->data['objregions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions c', Backstage::gi()->db_table_prefix.'rmrt_objects o')
	    ->fields('c.*')
	    ->where('o.region = c.id')
	    ->group('c.id')
	    ->select();
	$this->data['objusers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_objects o')
	    ->fields('u.id, u.name, u.surname')
	    ->where('o.realtor = u.id')
	    ->group('u.id')
	    ->select();
	$this->data['objmetros'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro c', Backstage::gi()->db_table_prefix.'rmrt_objects o')
	    ->fields('c.*')
	    ->where('o.metro = c.id')
	    ->group('c.id')
	    ->select();
	$this->data['metros'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro')
	    ->fields('*')
	    ->select();
	$this->data['orients'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_orient')
	    ->fields('*')
	    ->select();
	$this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
	    ->fields('*')
	    ->select();
        return $this->data;
    }
	
    public function create_bid()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
	    ->fields('*')
	    ->where("visibility = 1")
	    ->select();
	$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
            ->fields('*')
            ->select();
	$this->data['buyers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.*')
	    ->where('u.id = ug.user_id AND ug.role_id = 8')
            ->select();
	return $this->data;
    }
    
    public function save_bid()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.id, u.email, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id AND um.validated = 1')
            ->getScalar();
	if ($this->data['item'])
	{
	    if (isset($this->data['request']->parameters['id']))
	    {		    
	        $table_values['buyer'] = $this->data['request']->parameters['buyer'];
	        $table_values['phone'] = $this->data['request']->parameters['phone'];
	        $table_values['email'] = $this->data['request']->parameters['email'];
	        $table_values['type'] = $this->data['request']->parameters['type'];
	        $table_values['price_max'] = $this->data['request']->parameters['price_max'];
	        $table_values['room'] = $this->data['request']->parameters['room'];
	        $table_values['city'] = $this->data['request']->parameters['city'];
	        $table_values['region'] = $this->data['request']->parameters['region'];
	        $table_values['comment'] = $this->data['request']->parameters['comment'];
	        $table_values['notify'] = $this->data['request']->parameters['notify'];
	        $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_bids')
		    ->values($table_values)
		    ->where('id = '.$this->data['request']->parameters['id'])
		    ->update();

		$this->save_log($this->data['item']->id, 'update', 'rmrt_bids', $table_values);
		
		$this->data['result'] = 'true';
	    }
	    else
	    {
	        $table_values['buyer'] = $this->data['request']->parameters['buyer'];
	        $table_values['phone'] = $this->data['request']->parameters['phone'];
	        $table_values['email'] = $this->data['request']->parameters['email'];
	        $table_values['type'] = $this->data['request']->parameters['type'];
	        $table_values['price_max'] = $this->data['request']->parameters['price_max'];
	        $table_values['room'] = $this->data['request']->parameters['room'];
	        $table_values['city'] = $this->data['request']->parameters['city'];
	        $table_values['region'] = $this->data['request']->parameters['region'];
	        $table_values['comment'] = $this->data['request']->parameters['comment'];
	        $table_values['notify'] = $this->data['request']->parameters['notify'];
	        $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_bids')
		    ->values($table_values)
		    ->insert();
		$this->data['id'] = $this->dbmanager->getLastID();

		$this->save_log($this->data['item']->id, 'insert', 'rmrt_bids', $table_values);
		$to = $this->data['request']->parameters['email'];
		    $subject = 'Новая заявка на подбор недвижимости на remart24.az';
		    $message = 'Уважаемый пользователь, ваша заявка на подбор недвижимости принята. Благодарим Вас!\r\nС уважением,/r/nRemart 24';
		    $headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		    mail($to, $subject, $message, $headers);

		$this->data['recievers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
		    ->fields('u.id, u.email, ug.role_id')
		    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IN (2,4,5) AND um.validated = 1')
		    ->select();
		foreach ($this->data['recievers'] as $reciever) {
		    $to = $reciever->email;
		    $subject = 'Новая заявка на подбор недвижимости на remart24.az';
		    $message = 'Появилась новая заявка на подбор недвижимости на  remart24.az\r\nС уважением,/r/nRemart 24';
		    $headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		    mail($to, $subject, $message, $headers);
		}
		
		$this->data['result'] = 'true';
	    }
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function bid()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
	    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id != 1)
	{
	    $this->data['result']['data'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_bids')
		->fields('*')
		->where('id = '.$this->data['request']->parameters['id'])
		->getScalar();
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function bid_card()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
	    ->fields('*')
	    ->where("visibility = 1")
	    ->select();
	$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
            ->fields('*')
            ->select();
	$this->data['buyers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.*')
	    ->where('u.id = ug.user_id AND ug.role_id = 8')
            ->select();
	$this->data['realtors'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.*, um.company_name')
	    ->where('u.id = ug.user_id AND u.id = um.user_id AND ug.role_id = 5')
            ->select();
	
	return $this->data;
    }
    
    public function get_bids()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	$room = explode(',', $this->data['request']->parameters['room']);
	$rw = array();
	foreach ($room as $elem) $rw[] = 'room LIKE "%'.$elem.'%"';
	$room = implode(' OR ', $rw);
	
	$city = explode(',', $this->data['request']->parameters['city']);
	$rw = array();
	foreach ($city as $elem) $rw[] = 'city LIKE "%'.$elem.'%"';
	$city = implode(' OR ', $rw);
	
	$region = explode(',', $this->data['request']->parameters['region']);
	$rw = array();
	foreach ($region as $elem) $rw[] = 'region LIKE "%'.$elem.'%"';
	$region = implode(' OR ', $rw);
	
	$type = explode(',', $this->data['request']->parameters['type']);
	$rw = array();
	foreach ($type as $elem) $rw[] = 'type LIKE "%'.$elem.'%"';
	$type = implode(' OR ', $rw);
	
	
	if ($this->data['request']->parameters['status'] == '-') $this->data['request']->parameters['status'] = '%';
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4 || $this->data['item']->role_id == 5)
	{
	    $this->data['result']['count'] = $this->dbmanager->selectByQuery('SELECT COUNT(*) as cnt FROM '.Backstage::gi()->db_table_prefix.'rmrt_bids o WHERE id LIKE "%'.$this->data['request']->parameters['id'].'%" AND buyer IN ('.$this->data['request']->parameters['buyer'].') AND ('.$room.') AND price_max >= '.$this->data['request']->parameters['price_min'].' AND price_max <= '.$this->data['request']->parameters['price_max'].' AND ('.$city.') AND ('.$region.') AND ('.$type.') AND status LIKE "'.$this->data['request']->parameters['status'].'"')[0]->cnt;
	    //echo 'SELECT COUNT(*) as cnt FROM '.Backstage::gi()->db_table_prefix.'rmrt_bids o WHERE id LIKE "%'.$this->data['request']->parameters['id'].'%" AND buyer IN('.$this->data['request']->parameters['buyer'].') AND ('.$room.') AND price_max >= '.$this->data['request']->parameters['price_min'].' AND price_max <= '.$this->data['request']->parameters['price_max'].' AND city LIKE "%'.$city.'%" AND region LIKE "%'.$region.'%" AND status LIKE "'.$this->data['request']->parameters['status'].'"';
	    $this->data['request']->parameters['sort'] = str_replace('-', ' ', $this->data['request']->parameters['sort']);
	    $this->data['result']['data'] = $this->dbmanager->selectByQuery('SELECT * FROM '.Backstage::gi()->db_table_prefix.'rmrt_bids o WHERE id LIKE "%'.$this->data['request']->parameters['id'].'%" AND buyer IN ('.$this->data['request']->parameters['buyer'].') AND ('.$room.') AND price_max >= '.$this->data['request']->parameters['price_min'].' AND price_max <= '.$this->data['request']->parameters['price_max'].' AND ('.$city.') AND ('.$region.') AND ('.$type.') AND status LIKE "'.$this->data['request']->parameters['status'].'" ORDER BY '.$this->data['request']->parameters['sort'].' LIMIT '.$this->data['request']->parameters['offset'].", ".$this->data['request']->parameters['limit']);
	    //echo 'SELECT * FROM '.Backstage::gi()->db_table_prefix.'rmrt_bids o WHERE id LIKE "%'.$this->data['request']->parameters['id'].'%" AND buyer IN ('.$this->data['request']->parameters['buyer'].') AND ('.$room.') AND price_max >= '.$this->data['request']->parameters['price_min'].' AND price_max <= '.$this->data['request']->parameters['price_max'].' AND ('.$city.') AND ('.$region.') AND ('.$type.') AND status LIKE "'.$this->data['request']->parameters['status'].'" ORDER BY '.$this->data['request']->parameters['sort'].' LIMIT '.$this->data['request']->parameters['offset'].", ".$this->data['request']->parameters['limit'];
	    
	    $this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
		->fields('*')
		->select();
	    $this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
		->fields('*')
		->select();
	    $this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
		->fields('*')
		->select();
	    $xtype[0] = Translations::gi()->all;
	    $xtype[1] = Translations::gi()->new_build;
	    $xtype[2] = Translations::gi()->old_build;
	    $xtype[3] = Translations::gi()->private_h;
	    foreach ($this->data['result']['data'] as $key=>$result)
	    {
		$this->data['buyer'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
		    ->fields('u.id, u.email, u.name, u.surname, u.patronymic, um.company, um.company_name')
		    ->where('um.user_id = u.id AND u.id = '.$this->data['result']['data'][$key]->buyer)
		    ->getScalar();
		$this->data['result']['data'][$key]->buyer_id = $this->data['result']['data'][$key]->buyer;
		$this->data['result']['data'][$key]->buyer = $this->data['buyer']->name." ".$this->data['buyer']->surname;
		
		$reg = explode(',', $this->data['result']['data'][$key]->region);
		$region = array();
		foreach ($reg as $val) $region[] = $this->data['regions'][$val - 1]->name;
		$this->data['result']['data'][$key]->region = implode(', ', $region);
		
		$reg = explode(',', $this->data['result']['data'][$key]->city);
		$region = array();
		foreach ($reg as $val) $region[] = $this->data['cities'][$val - 1]->name;
		$this->data['result']['data'][$key]->city = implode(', ', $region);

		$x = explode(',', $this->data['result']['data'][$key]->type);
		$y = array();
		foreach ($x as $k) $y[] = $xtype[$k];
		$this->data['result']['data'][$key]->type = implode(', ', $y);
	    }
	    //var_dump($this->data['result']);
	}
	else if ($this->data['item']->role_id == 5)
	{
	    $this->data['result']['count'] = $this->dbmanager->selectByQuery('SELECT COUNT(*) as cnt FROM '.Backstage::gi()->db_table_prefix.'rmrt_bids o, '.Backstage::gi()->db_table_prefix.'rmrt_realtor_bids rb WHERE o.id = rb.bid_id AND rb.realtor_id = '.$this->data['item']->id.' AND o.id LIKE "%'.$this->data['request']->parameters['id'].'%" AND buyer IN ('.$this->data['request']->parameters['buyer'].') AND ('.$room.') AND ('.$type.') AND price_max >= '.$this->data['request']->parameters['price_min'].' AND price_max <= '.$this->data['request']->parameters['price_max'].' AND ('.$city.') AND ('.$region.') AND status LIKE "1"')[0]->cnt;
	    //echo 'SELECT COUNT(*) as cnt FROM '.Backstage::gi()->db_table_prefix.'rmrt_bids o WHERE id LIKE "%'.$this->data['request']->parameters['id'].'%" AND buyer IN('.$this->data['request']->parameters['buyer'].') AND ('.$room.') AND price_max >= '.$this->data['request']->parameters['price_min'].' AND price_max <= '.$this->data['request']->parameters['price_max'].' AND city LIKE "%'.$city.'%" AND region LIKE "%'.$region.'%" AND status LIKE "'.$this->data['request']->parameters['status'].'"';
	    $this->data['request']->parameters['sort'] = str_replace('-', ' ', $this->data['request']->parameters['sort']);
	    $this->data['result']['data'] = $this->dbmanager->selectByQuery('SELECT * FROM '.Backstage::gi()->db_table_prefix.'rmrt_bids o, '.Backstage::gi()->db_table_prefix.'rmrt_realtor_bids rb WHERE o.id = rb.bid_id AND rb.realtor_id = '.$this->data['item']->id.' AND o.id LIKE "%'.$this->data['request']->parameters['id'].'%" AND buyer IN ('.$this->data['request']->parameters['buyer'].') AND ('.$room.') AND ('.$type.') AND price_max >= '.$this->data['request']->parameters['price_min'].' AND price_max <= '.$this->data['request']->parameters['price_max'].' AND ('.$city.') AND ('.$region.') AND status LIKE "1" ORDER BY '.$this->data['request']->parameters['sort'].' LIMIT '.$this->data['request']->parameters['offset'].", ".$this->data['request']->parameters['limit']);
	    //echo 'SELECT * FROM '.Backstage::gi()->db_table_prefix.'rmrt_bids o WHERE id LIKE "%'.$this->data['request']->parameters['id'].'%" AND buyer IN('.$this->data['request']->parameters['buyer'].') AND ('.$room.') AND price_max >= '.$this->data['request']->parameters['price_min'].' AND price_max <= '.$this->data['request']->parameters['price_max'].' AND city LIKE "%'.$city.'%" AND region LIKE "%'.$region.'%" AND status LIKE "'.$this->data['request']->parameters['status'].'" ORDER BY '.$this->data['request']->parameters['sort'].' LIMIT '.$this->data['request']->parameters['offset'].", ".$this->data['request']->parameters['limit'];
	    
	    $this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
		->fields('*')
		->select();
	    $this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
		->fields('*')
		->select();
	    $this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
		->fields('*')
		->select();
	    foreach ($this->data['result']['data'] as $key=>$result)
	    {
		$this->data['buyer'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
		    ->fields('u.id, u.email, u.name, u.surname, u.patronymic, um.company, um.company_name')
		    ->where('um.user_id = u.id AND u.id = '.$this->data['result']['data'][$key]->buyer)
		    ->getScalar();
		$this->data['result']['data'][$key]->buyer_id = $this->data['result']['data'][$key]->buyer;
		$this->data['result']['data'][$key]->buyer = $this->data['buyer']->name." ".$this->data['buyer']->surname;
		
		$reg = explode(',', $this->data['result']['data'][$key]->region);
		$region = array();
		foreach ($reg as $val) $region[] = $this->data['regions'][$val - 1]->name;
		$this->data['result']['data'][$key]->region = implode(', ', $region);
		
		$reg = explode(',', $this->data['result']['data'][$key]->city);
		$region = array();
		foreach ($reg as $val) $region[] = $this->data['cities'][$val - 1]->name;
		$this->data['result']['data'][$key]->city = implode(', ', $region);
		
	    }
	    
	}
	
	else $this->data['result'] = 'false';
	return $this->data;
    }
    
    public function send_to_realtor()
    {	
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
	    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4)
	{
	    $realtors = explode(',', $this->data['request']->parameters['realtor_id']);
	    foreach ($realtors as $realtor) {
		$this->data['bids'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_realtor_bids')
		    ->fields('*')
		    ->where('realtor_id = '.$realtor.' AND bid_id = '.$this->data['request']->parameters['bid_id'])
		    ->select();
		if (!$this->data['bids']) {
		    $table_values['realtor_id'] = $realtor;
		    $table_values['bid_id'] = $this->data['request']->parameters['bid_id'];
		    $this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_realtor_bids')
			->values($table_values)
			->insert();
		}
	    }
	    $this->data['result'] = 'true';
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function change_bid_status()
    {	
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
	    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4)
	{
	    $table_values['status'] = $this->data['request']->parameters['status'];
	    $this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_bids')
		->values($table_values)
		->where('id = '.$this->data['request']->parameters['id'])
		->update();
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function changepass()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u')
            ->fields('u.id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND u.password = "'.md5($this->data['request']->parameters['old']).'"')
            ->getScalar();
	if ($this->data['item']->id && $this->data['request']->parameters['new'] == $this->data['request']->parameters['confirm'])
	{
	    $table_values['password'] = md5($this->data['request']->parameters['new']);
	    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
		->values($table_values)
		->where('id = '.$this->data['item']->id)
		->update();	
	    $table_values['passch'] = 1;
	    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
		->values($table_values)
		->where('user_id = '.$this->data['item']->id)
		->update();		
	}
	else $this->data['status'] = 'NOTHING';
	return $this->data;
    }
	
    public function create_bank()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	return $this->data;
    }
    
    public function save_bank()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.id, u.email, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id AND um.validated = 1')
            ->getScalar();
	if ($this->data['item'])
	{
	    if (isset($this->data['request']->parameters['id']))
	    {		    
	        $table_values['name'] = $this->data['request']->parameters['bank_name'];
	        $table_values['website'] = $this->data['request']->parameters['website'];
	        $table_values['logo'] = $this->data['request']->parameters['logo'];
	        
		$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_banks')
		    ->values($table_values)
		    ->where('id = '.$this->data['request']->parameters['id'])
		    ->update();
		
		$table_values['name'] = $this->data['request']->parameters['name'];
		$table_values['surname'] = $this->data['request']->parameters['surname'];
		$table_values['phone'] = $this->data['request']->parameters['phone'];
		$table_values['email'] = $this->data['request']->parameters['email'];
		$table_values['position'] = $this->data['request']->parameters['position'];
		$table_values['comment'] = $this->data['request']->parameters['comment'];
		
		$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_bank_cp')
		    ->values($table_values)
		    ->where('bank = '.$this->data['request']->parameters['id'])
		    ->update();

		$this->save_log($this->data['item']->id, 'update', 'rmrt_banks', $table_values);
		
		$this->data['result'] = 'true';
	    }
	    else
	    {
	        $table_values['name'] = $this->data['request']->parameters['bank_name'];
	        $table_values['website'] = $this->data['request']->parameters['website'];
	        $table_values['logo'] = $this->data['request']->parameters['logo'];
		
	        $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_banks')
		    ->values($table_values)
		    ->insert();
		$this->data['id'] = $this->dbmanager->getLastID();
		
		$table_values['bank'] = $this->data['id'];
		$table_values['name'] = $this->data['request']->parameters['name'];
		$table_values['surname'] = $this->data['request']->parameters['surname'];
		$table_values['phone'] = $this->data['request']->parameters['phone'];
		$table_values['email'] = $this->data['request']->parameters['email'];
		$table_values['position'] = $this->data['request']->parameters['position'];
		$table_values['comment'] = $this->data['request']->parameters['comment'];
		
		$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_bank_cp')
		    ->values($table_values)
		    ->insert();

		$this->save_log($this->data['item']->id, 'insert', 'rmrt_banks', $table_values);

		$this->data['recievers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
		    ->fields('u.id, u.email, ug.role_id')
		    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND (ug.role_id = 2 OR ug.role_id = 4) AND um.validated = 1')
		    ->select();
		foreach ($this->data['recievers'] as $reciever) {
		    $to = $reciever->email;
		    $subject = 'Новая заявка на подбор недвижимости';
		    $message = 'Появилась новая заявка на подбор недвижимости. О заявке можно посмотреть в email';
		    $headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		    mail($to, $subject, $message, $headers);
		}
		
		$this->data['result'] = 'true';
	    }
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function bank()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
	    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id != 1)
	{
	    $this->data['result']['data'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_banks b', Backstage::gi()->db_table_prefix.'rmrt_bank_cp bc')
		->fields('b.name as bank_name, b.website, b.status, b.logo, bc.*')
		->where('bc.bank = b.id AND b.id = '.$this->data['request']->parameters['id'])
		->getScalar();
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function bank_card()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
            ->fields('*')
            ->select();
	$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
            ->fields('*')
            ->select();
	$this->data['buyers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.*')
	    ->where('u.id = ug.user_id AND ug.role_id = 8')
            ->select();
	$this->data['realtors'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.*, um.company_name')
	    ->where('u.id = ug.user_id AND u.id = um.user_id AND ug.role_id = 5')
            ->select();
	
	return $this->data;
    }
    
    public function get_banks()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4)
	{
	    $this->data['result']['count'] = $this->dbmanager->selectByQuery('SELECT COUNT(*) as cnt FROM '.Backstage::gi()->db_table_prefix.'rmrt_banks o WHERE id LIKE "%'.$this->data['request']->parameters['id'].'%" AND name LIKE "%'.$this->data['request']->parameters['name'].'%" AND status IN ('.$this->data['request']->parameters['status'].')')[0]->cnt;
	    $this->data['result']['data'] = $this->dbmanager->selectByQuery('SELECT *, (SELECT COUNT(*) FROM '.Backstage::gi()->db_table_prefix.'rmrt_user_meta u1, '.Backstage::gi()->db_table_prefix.'rmrt_user_meta u2 WHERE u1.reg_by = u2.id AND u2.bank = o.id AND u1.validated = 1) as buyers  FROM '.Backstage::gi()->db_table_prefix.'rmrt_banks o WHERE id LIKE "%'.$this->data['request']->parameters['id'].'%" AND name LIKE "%'.$this->data['request']->parameters['name'].'%" AND status IN ('.$this->data['request']->parameters['status'].') ORDER BY '.$this->data['request']->parameters['sort'].' LIMIT '.$this->data['request']->parameters['offset'].", ".$this->data['request']->parameters['limit']);
	    
	}
	else $this->data['result'] = 'false';
	return $this->data;
    }
    
    public function create_project_manager()
    {
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	return $this->data;
    }
    
    public function change_bank_status()
    {	
	$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
	    ->fields('u.id, ug.role_id')
	    ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4)
	{
	    $table_values['status'] = $this->data['request']->parameters['status'];
	    $this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_banks')
		->values($table_values)
		->where('id = '.$this->data['request']->parameters['id'])
		->update();
	}
	else { $this->data['result'] = 'false'; }
	return $this->data;
    }
    
    public function resetPassword()
	{
		$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
            ->fields('id')
            ->where('lower(email) = "'.strtolower($this->data['request']->parameters['login']).'"')
            ->getScalar();
		if ($this->data['result'])
		{
			$password = substr(md5(rand()),0, 8);
			$table_values['password'] = md5($password);	
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
				->values($table_values)
				->where('id = '.$this->data['result']->id)
				->update();
			$to = $this->data['request']->parameters['login'];
			$subject = 'Сброс пароля';
			$message = 'Ваш логин: '.$this->data['request']->parameters['login'].' Ваш пароль: '.$password;
			$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
		}
        return $this->data;
	}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
	
	/*
	
	public function addfav()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id AND um.validated = 1')
            ->getScalar();
		if ($this->data['item']->id)
		{
			$table_values['user'] = $this->data['item']->id;
			$table_values['object'] = $this->data['request']->parameters['object'];
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
				->values($table_values)
				->insert();		
		}
        return $this->data;
	}
	
	
	public function delfav()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id AND um.validated = 1')
            ->getScalar();
		if ($this->data['item']->id)
		{
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
				->where('user = '.$this->data['item']->id.' AND object = '.$this->data['request']->parameters['object'])
				->delete();		
		}
        return $this->data;
	}
	
    
	
	
	public function send_invite() {
		$tv['user_id'] = $this->data['request']->parameters['user_id'];
		$tv['object_id'] = $this->data['request']->parameters['object_id'];
		$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'votes')
			->values($tv)
			->insert();
		return $this->data;
	}
	
	public function objects()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL AND um.user_id = u.id AND um.validated = 1')
            ->getScalar();
		$this->data['buyers'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, u.email, u.name, u.surname, u.patronymic')
            ->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 8')
            ->select();
		$this->data['rieltors'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, u.email, u.name, u.surname, u.patronymic')
            ->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 6')
            ->select();
		$this->data['objects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
			->fields('*')
			->where('status = 7')
			->order('reg_date DESC')
			->select();
		$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
			->fields('*')
			->select();
		$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
			->fields('*')
			->select();
		$this->data['metros'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro')
			->fields('*')
			->select();
		$this->data['orients'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_orient')
			->fields('*')
			->select();
		$this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
			->fields('*')
			->select();
		foreach ($this->data['objects'] as $key=>$object)
		{
			
			if ($this->data['objects'][$key]->type == 1) $this->data['objects'][$key]->type = "Квартира";
			if ($this->data['objects'][$key]->type == 2) $this->data['objects'][$key]->type = "Частный дом";
			$this->data['objects'][$key]->city_id = $this->data['objects'][$key]->city;
			$this->data['objects'][$key]->region_id = $this->data['objects'][$key]->region;
			$this->data['objects'][$key]->metro_id = $this->data['objects'][$key]->metro;
			$this->data['objects'][$key]->orient_id = $this->data['objects'][$key]->orient;
			$this->data['objects'][$key]->city = $this->data['cities'][$this->data['objects'][$key]->city - 1]->name;
			$this->data['objects'][$key]->region = $this->data['regions'][$this->data['objects'][$key]->region - 1]->name;
			$this->data['objects'][$key]->metro = $this->data['metros'][$this->data['objects'][$key]->metro - 1]->name;
			$this->data['objects'][$key]->orient = $this->data['orients'][$this->data['objects'][$key]->orient - 1]->name;
		}
		return $this->data;
	}
	
	
	public function resetPassword()
	{
		$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
            ->fields('id')
            ->where('lower(email) = "'.strtolower($this->data['request']->parameters['login']).'"')
            ->getScalar();
		if ($this->data['result'])
		{
			$password = substr(md5(rand()),0, 8);
			$table_values['password'] = md5($password);	
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
				->values($table_values)
				->where('id = '.$this->data['result']->id)
				->update();
			$to = $this->data['request']->parameters['login'];
			$subject = 'Сброс пароля';
			$message = 'Ваш логин: '.$this->data['request']->parameters['login'].' Ваш пароль: '.$password;
			$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
		}
        return $this->data;
	}
	
	
	
	public function create_project_manager()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		return $this->data;
	}
	
	public function edit_project_manager()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2)
		{
			$this->data['manager'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('u.id, u.login, u.name, u.surname, u.patronymic, u.email, u.about, um.birthday, um.mobile, um.home, um.phone1, um.phone2, um.id_serial, um.id_pin, um.comment')
				->where('um.user_id = u.id AND u.id = '.$this->data['request']->parameters['id'])
				->getScalar();
		}
		return $this->data;
	}
	
	public function edit_bank()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['bank'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'banks')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
		}
		return $this->data;
	}
	
	
	
	
	public function edit_credit_specialist()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['manager'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('u.id, u.login, u.name, u.surname, u.patronymic, u.email, u.about, um.birthday, um.mobile, um.home, um.phone1, um.phone2, um.id_serial, um.id_pin, um.comment')
				->where('um.user_id = u.id AND u.id = '.$this->data['request']->parameters['id'])
				->getScalar();
			$this->data['banks'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'banks')
				->fields('*')
				->where('validated = 1')
				->select();
		}
		return $this->data;
	}
	
	
	
	public function edit_realtor()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('u.*, um.*')
				->where('um.user_id = u.id AND u.id = '.$this->data['request']->parameters['id'])
				->getScalar();
		}
		return $this->data;
	}
	
	
	
	public function edit_buyer()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3 || $this->data['item']->role_id == 5)
		{
			$this->data['manager'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('u.id, u.login, u.name, u.surname, u.patronymic, u.email, u.about, um.birthday, um.mobile, um.home, um.phone1, um.phone2, um.comment')
				->where('um.user_id = u.id AND u.id = '.$this->data['request']->parameters['id'])
				->getScalar();
		}
		return $this->data;
	}
	
	
	
	public function edit_object()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 6 || $this->data['item']->role_id == 3)
		{
			$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
				->fields('*')
				->select();
			$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
				->fields('*')
				->select();
			$this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
				->fields('*')
				->select();
			$this->data['metros'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro')
				->fields('*')
				->select();
			$this->data['orients'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_orient')
				->fields('*')
				->select();
			$this->data['object'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
			$this->data['object']->orient = explode(',', $this->data['object']->orient);
		}
		return $this->data;
	}
	
	
	
	public function create_bank()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		return $this->data;
	}
	
	public function edit_appraiser()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['manager'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('*')
				->where('um.user_id = u.id AND u.id = '.$this->data['request']->parameters['id'])
				->getScalar();
		}
		return $this->data;
	}
	
	public function save_project_manager()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2)
		{
			if (isset($this->data['request']->parameters['id']))
			{
				$this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
					->fields('id')
					->where('id != '.$this->data['request']->parameters['id'].' AND email = "'.$this->data['request']->parameters['email'].'"')
					->getScalar();
			}
			else
			{
				$this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
					->fields('id')
					->where('email = "'.$this->data['request']->parameters['email'].'"')
					->getScalar();
			}
			if (!$this->data['exists'])
			{
				if (isset($this->data['request']->parameters['id']))
				{
					$table_values['login'] = $this->data['request']->parameters['email'];
					$table_values['email'] = $this->data['request']->parameters['email'];
					$table_values['name'] = $this->data['request']->parameters['name'];
					$table_values['surname'] = $this->data['request']->parameters['surname'];
					$table_values['patronymic'] = $this->data['request']->parameters['patronymic'];
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
						->values($table_values)
						->where('id = '.$this->data['request']->parameters['id'])
						->update();
						
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'UPDATE USERS '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
					
					$to = $this->data['request']->parameters['email'];
					$subject = 'Изменения данных о проектном менеджере';
					$message = 'Ваш логин: '.$this->data['request']->parameters['email'].' Ваш пароль: '.$password;
					$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
					unset($table_values);
					$table_values['birthday'] = $this->data['request']->parameters['birthday'];
					$table_values['mobile'] = $this->data['request']->parameters['mobile'];
					$table_values['home'] = $this->data['request']->parameters['home'];
					$table_values['phone1'] = $this->data['request']->parameters['phone1'];
					$table_values['phone2'] = $this->data['request']->parameters['phone2'];
					$table_values['id_serial'] = $this->data['request']->parameters['id_serial'];
					$table_values['id_pin'] = $this->data['request']->parameters['id_pin'];
					$table_values['comment'] = $this->data['request']->parameters['comment'];
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
						->values($table_values)
						->where('user_id = '.$this->data['request']->parameters['id'])
						->update();
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'UPDATE USERS '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					$this->data['result'] = 'true';
				}
				else
				{
					$table_values['login'] = $this->data['request']->parameters['email'];
					$table_values['email'] = $this->data['request']->parameters['email'];
					$table_values['name'] = $this->data['request']->parameters['name'];
					$table_values['surname'] = $this->data['request']->parameters['surname'];
					$table_values['patronymic'] = $this->data['request']->parameters['patronymic'];
					$password = substr(md5(rand()),0, 8);
					$table_values['password'] = md5($password);	
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
						->values($table_values)
						->insert();
					$this->data['id'] = $this->dbmanager->getLastID();
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT USERS '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
	
					$to = $this->data['request']->parameters['email'];
					$subject = 'Регистрация проектного менеджера';
					$message = 'Ваш логин: '.$this->data['request']->parameters['email'].' Ваш пароль: '.$password;
					$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
					unset($table_values);
					$table_values['user_id'] = $this->data['id'];
					$table_values['birthday'] = $this->data['request']->parameters['birthday'];
					$table_values['mobile'] = $this->data['request']->parameters['mobile'];
					$table_values['home'] = $this->data['request']->parameters['home'];
					$table_values['phone1'] = $this->data['request']->parameters['phone1'];
					$table_values['phone2'] = $this->data['request']->parameters['phone2'];
					$table_values['id_serial'] = $this->data['request']->parameters['id_serial'];
					$table_values['id_pin'] = $this->data['request']->parameters['id_pin'];
					$table_values['comment'] = $this->data['request']->parameters['comment'];
					$table_values['reg_date'] = date('Y-m-d H:i:s');
					$table_values['reg_by'] = $this->data['item']->id;
					$table_values['validated'] = 1;
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
						->values($table_values)
						->insert();
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT rmrt_user_meta '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					unset($table_values);
					$table_values['user_id'] = $this->data['id'];
					$table_values['role_id'] = 3;
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'user_grants')
						->values($table_values)
						->insert();
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date("Y-m-d H:i:s");
					$tv['action'] = 'INSERT USER_GRANTS '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
					$this->data['result'] = 'true';
				}
			}
			else $this->data['result'] = 'false';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	
	public function get_project_managers_count()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('COUNT(*) as cnt')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id  = 3 AND um.user_id = u.id')
				->getScalar();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_realtors()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('u.id, u.login, u.name, u.surname, u.patronymic, um.validated, um.company_name')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id  = 6 AND um.user_id = u.id')
				->limit($this->data['request']->parameters['perpage'] * ($this->data['request']->parameters['page'] - 1) .", ".$this->data['request']->parameters['perpage'])
				->select();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_realtors_count()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('COUNT(*) as cnt')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id  = 6 AND um.user_id = u.id')
				->getScalar();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_credit_specialists()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('u.id, u.login, u.name, u.surname, u.patronymic, um.validated')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id  = 5 AND um.user_id = u.id')
				->limit($this->data['request']->parameters['perpage'] * ($this->data['request']->parameters['page'] - 1) .", ".$this->data['request']->parameters['perpage'])
				->select();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_credit_specialists_count()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('COUNT(*) as cnt')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id  = 5 AND um.user_id = u.id')
				->getScalar();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_appraisers()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('u.id, u.email, um.company_name, um.validated')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id  = 7 AND um.user_id = u.id')
				->limit($this->data['request']->parameters['perpage'] * ($this->data['request']->parameters['page'] - 1) .", ".$this->data['request']->parameters['perpage'])
				->select();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_appraisers_count()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('COUNT(*) as cnt')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id  = 7 AND um.user_id = u.id')
				->getScalar();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_buyers()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('u.id, u.login, u.name, u.surname, u.patronymic, um.validated, um.mobile')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id  = 8 AND um.user_id = u.id')
				->limit($this->data['request']->parameters['perpage'] * ($this->data['request']->parameters['page'] - 1) .", ".$this->data['request']->parameters['perpage'])
				->select();
			foreach ($this->data['result'] as $k=>$v)
			{
				$this->data['result'][$k]->favorites = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites f, '.Backstage::gi()->db_table_prefix.'rmrt_objects o')
					->fields('o.*, TRUE as favorite')
					->where('f.user = '.$v->id.' AND o.id = f.object')
					->select();
			}
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_my_buyers()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 5)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('u.id, u.login, u.name, u.surname, u.patronymic, um.validated')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id  = 8 AND um.user_id = u.id AND um.reg_by = '.$this->data['item']->id)
				->limit($this->data['request']->parameters['perpage'] * ($this->data['request']->parameters['page'] - 1) .", ".$this->data['request']->parameters['perpage'])
				->select();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_buyers_count()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3  || $this->data['item']->role_id == 5)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('COUNT(*) as cnt')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id  = 8 AND um.user_id = u.id')
				->getScalar();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_my_buyers_count()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 5)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('COUNT(*) as cnt')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id  = 8 AND um.user_id = u.id AND um.reg_by = '.$this->data['item']->id)
				->getScalar();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function getInfo()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3 || $this->data['item']->role_id == 5)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
				->fields('u.id, u.login, u.name, u.surname, u.patronymic, u.about, u.email, u.about, um.birthday, um.mobile, um.home, um.id_serial, um.id_pin, um.comment, um.company_name, um.logo, um.company, um.voen')
				->where('um.user_id = u.id AND u.id = '.$this->data['request']->parameters['id'])
				->getScalar();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_banks()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'banks')
				->fields('*')
				->limit($this->data['request']->parameters['perpage'] * ($this->data['request']->parameters['page'] - 1) .", ".$this->data['request']->parameters['perpage'])
				->select();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_banks_count()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'banks')
				->fields('COUNT(*) as cnt')
				->getScalar();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_bank()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'banks')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	
	
	public function deactivatebank()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2)
		{
			$table_values['validated'] = 0;
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'banks')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'DEACTIVATE BANK '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
		}
	}
	
	public function activatebank()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2)
		{
			$table_values['validated'] = 1;
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'banks')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'ACTIVATE BANK '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
		}
	}
	
	public function save_realtor()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			if (isset($this->data['request']->parameters['id']))
			{
				$this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
					->fields('id')
					->where('id != '.$this->data['request']->parameters['id'].' AND email = "'.$this->data['request']->parameters['email'].'"')
					->getScalar();
			}
			else
			{
				$this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
					->fields('id')
					->where('email = "'.$this->data['request']->parameters['email'].'"')
					->getScalar();
			}
			if (!$this->data['exists'])
			{
				if (isset($this->data['request']->parameters['id']))
				{
					$table_values['login'] = $this->data['request']->parameters['email'];
					$table_values['email'] = $this->data['request']->parameters['email'];
					$table_values['name'] = $this->data['request']->parameters['name'];
					$table_values['surname'] = $this->data['request']->parameters['surname'];
					$table_values['patronymic'] = $this->data['request']->parameters['patronymic'];
					$table_values['about'] = $this->data['request']->parameters['about'];
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
						->values($table_values)
						->where('id = '.$this->data['request']->parameters['id'])
						->update();
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'URDATE REALTOR '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
					$to = $this->data['request']->parameters['email'];
					$subject = 'Изменения данных о риелторе';
					$message = 'Ваш логин: '.$this->data['request']->parameters['email'].' Ваш пароль: '.$password;
					$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
					unset($table_values);
					$table_values['company'] = $this->data['request']->parameters['company'];
					$table_values['voen'] = $this->data['request']->parameters['voen'];
					$table_values['company_name'] = $this->data['request']->parameters['company_name'];
					$table_values['logo'] = $this->data['request']->parameters['logo'];
					$table_values['birthday'] = $this->data['request']->parameters['birthday'];
					$table_values['mobile'] = $this->data['request']->parameters['mobile'];
					$table_values['home'] = $this->data['request']->parameters['home'];
					$table_values['phone1'] = $this->data['request']->parameters['phone1'];
					$table_values['phone2'] = $this->data['request']->parameters['phone2'];
					$table_values['id_serial'] = $this->data['request']->parameters['id_serial'];
					$table_values['id_pin'] = $this->data['request']->parameters['id_pin'];
					$table_values['comment'] = $this->data['request']->parameters['comment'];
					$table_values['validated'] = 1;
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
						->values($table_values)
						->where('user_id = '.$this->data['request']->parameters['id'])
						->update();
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'URDATE REALTOR '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
					$this->data['result'] = 'true';
				}
				else
				{
					$table_values['login'] = $this->data['request']->parameters['email'];
					$table_values['email'] = $this->data['request']->parameters['email'];
					$table_values['name'] = $this->data['request']->parameters['name'];
					$table_values['surname'] = $this->data['request']->parameters['surname'];
					$table_values['patronymic'] = $this->data['request']->parameters['patronymic'];
					$table_values['about'] = $this->data['request']->parameters['about'];
					$password = substr(md5(rand()),0, 8);
					$table_values['password'] = md5($password);	
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
						->values($table_values)
						->insert();
					$this->data['id'] = $this->dbmanager->getLastID();	
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT REALTOR '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
										
					$to = $this->data['request']->parameters['email'];
					$subject = 'Регистрация риелтора';
					$message = 'Ваш логин: '.$this->data['request']->parameters['email'].' Ваш пароль: '.$password;
					$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
					unset($table_values);
					$table_values['company_name'] = $this->data['request']->parameters['company_name'];
					$table_values['company'] = $this->data['request']->parameters['company'];
					$table_values['voen'] = $this->data['request']->parameters['voen'];
					$table_values['logo'] = $this->data['request']->parameters['logo'];
					$table_values['user_id'] = $this->data['id'];
					$table_values['birthday'] = $this->data['request']->parameters['birthday'];
					$table_values['mobile'] = $this->data['request']->parameters['mobile'];
					$table_values['home'] = $this->data['request']->parameters['home'];
					$table_values['phone1'] = $this->data['request']->parameters['phone1'];
					$table_values['phone2'] = $this->data['request']->parameters['phone2'];
					$table_values['id_serial'] = $this->data['request']->parameters['id_serial'];
					$table_values['id_pin'] = $this->data['request']->parameters['id_pin'];
					$table_values['comment'] = $this->data['request']->parameters['comment'];
					$table_values['reg_date'] = date('Y-m-d H:i:s');
					$table_values['reg_by'] = $this->data['item']->id;
					$table_values['validated'] = 1;
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
						->values($table_values)
						->insert();
						
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT USER STATUS '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					unset($table_values);
					$table_values['user_id'] = $this->data['id'];
					$table_values['role_id'] = 6;
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'user_grants')
						->values($table_values)
						->insert();
						
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT USER GRANTS '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
					$this->data['result'] = 'true';
				}
			}
			else $this->data['result'] = 'false';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function save_credit_specialist()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			if (isset($this->data['request']->parameters['id']))
			{
				$this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
					->fields('id')
					->where('id != '.$this->data['request']->parameters['id'].' AND email = "'.$this->data['request']->parameters['email'].'"')
					->getScalar();
			}
			else
			{
				$this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
					->fields('id')
					->where('email = "'.$this->data['request']->parameters['email'].'"')
					->getScalar();
			}
			if (!$this->data['exists'])
			{
				if (isset($this->data['request']->parameters['id']))
				{
					$table_values['login'] = $this->data['request']->parameters['email'];
					$table_values['email'] = $this->data['request']->parameters['email'];
					$table_values['name'] = $this->data['request']->parameters['name'];
					$table_values['surname'] = $this->data['request']->parameters['surname'];
					$table_values['patronymic'] = $this->data['request']->parameters['patronymic'];
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
						->values($table_values)
						->where('id = '.$this->data['request']->parameters['id'])
						->update();
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'URDATE CREDIT SPECIALIST '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
					$to = $this->data['request']->parameters['email'];
					$subject = 'Изменения данных о кредитном специалисте';
					$message = 'Ваш логин: '.$this->data['request']->parameters['email'].' Ваш пароль: '.$password;
					$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
					unset($table_values);
					$table_values['birthday'] = $this->data['request']->parameters['birthday'];
					$table_values['mobile'] = $this->data['request']->parameters['mobile'];
					$table_values['home'] = $this->data['request']->parameters['home'];
					$table_values['phone1'] = $this->data['request']->parameters['phone1'];
					$table_values['phone2'] = $this->data['request']->parameters['phone2'];
					$table_values['id_serial'] = $this->data['request']->parameters['id_serial'];
					$table_values['id_pin'] = $this->data['request']->parameters['id_pin'];
					$table_values['comment'] = $this->data['request']->parameters['comment'];
					$table_values['bank'] = $this->data['request']->parameters['bank'];
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
						->values($table_values)
						->where('user_id = '.$this->data['request']->parameters['id'])
						->update();
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'URDATE CREDIT SPECIALIST META '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
					$this->data['result'] = 'true';
				}
				else
				{
					$table_values['login'] = $this->data['request']->parameters['email'];
					$table_values['email'] = $this->data['request']->parameters['email'];
					$table_values['name'] = $this->data['request']->parameters['name'];
					$table_values['surname'] = $this->data['request']->parameters['surname'];
					$table_values['patronymic'] = $this->data['request']->parameters['patronymic'];
					$password = substr(md5(rand()),0, 8);
					$table_values['password'] = md5($password);	
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
						->values($table_values)
						->insert();
					$this->data['id'] = $this->dbmanager->getLastID();	
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT CREDIT SPECIALIST '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					
					$to = $this->data['request']->parameters['email'];
					$subject = 'Регистрация кредитного специалиста';
					$message = 'Ваш логин: '.$this->data['request']->parameters['email'].' Ваш пароль: '.$password;
					$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
					unset($table_values);
					$table_values['user_id'] = $this->data['id'];
					$table_values['birthday'] = $this->data['request']->parameters['birthday'];
					$table_values['mobile'] = $this->data['request']->parameters['mobile'];
					$table_values['home'] = $this->data['request']->parameters['home'];
					$table_values['phone1'] = $this->data['request']->parameters['phone1'];
					$table_values['phone2'] = $this->data['request']->parameters['phone2'];
					$table_values['id_serial'] = $this->data['request']->parameters['id_serial'];
					$table_values['id_pin'] = $this->data['request']->parameters['id_pin'];
					$table_values['comment'] = $this->data['request']->parameters['comment'];
					$table_values['bank'] = $this->data['request']->parameters['bank'];
					$table_values['reg_date'] = date('Y-m-d H:i:s');
					$table_values['reg_by'] = $this->data['item']->id;
					$table_values['validated'] = 1;
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
						->values($table_values)
						->insert();
						
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT CREDIT SPECIALIST META '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					unset($table_values);
					$table_values['user_id'] = $this->data['id'];
					$table_values['role_id'] = 5;
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'user_grants')
						->values($table_values)
						->insert();
						
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT CREDIT SPECIALIST GRANTS '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
					$this->data['result'] = 'true';
				}
			}
			else $this->data['result'] = 'false';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function save_appraiser()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			if (isset($this->data['request']->parameters['id']))
			{
				$this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
					->fields('id')
					->where('id != '.$this->data['request']->parameters['id'].' AND email = "'.$this->data['request']->parameters['email'].'"')
					->getScalar();
			}
			else
			{
				$this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
					->fields('id')
					->where('email = "'.$this->data['request']->parameters['email'].'"')
					->getScalar();
			}
			if (!$this->data['exists'])
			{
				if (isset($this->data['request']->parameters['id']))
				{
					$table_values['login'] = $this->data['request']->parameters['email'];
					$table_values['email'] = $this->data['request']->parameters['email'];
					$table_values['about'] = $this->data['request']->parameters['about'];
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
						->values($table_values)
						->where('id = '.$this->data['request']->parameters['id'])
						->update();
						
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'URDATE APPRAISER '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					$to = $this->data['request']->parameters['email'];
					$subject = 'Изменения данных об оценщике';
					$message = 'Ваш логин: '.$this->data['request']->parameters['email'].' Ваш пароль: '.$password;
					$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
					unset($table_values);
					$table_values['logo'] = $this->data['request']->parameters['logo'];
					$table_values['voen'] = $this->data['request']->parameters['voen'];
					$table_values['company_name'] = $this->data['request']->parameters['company_name'];
					$table_values['website'] = $this->data['request']->parameters['website'];
					$table_values['mobile'] = $this->data['request']->parameters['mobile'];
					$table_values['home'] = $this->data['request']->parameters['home'];
					$table_values['phone1'] = $this->data['request']->parameters['phone1'];
					$table_values['phone2'] = $this->data['request']->parameters['phone2'];
					$table_values['comment'] = $this->data['request']->parameters['comment'];
					$table_values['company'] = 1;
					$table_values['validated'] = 1;
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
						->values($table_values)
						->where('user_id = '.$this->data['request']->parameters['id'])
						->update();
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'URDATE APPRAISER META '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					$this->data['result'] = 'true';
				}
				else
				{
					$table_values['login'] = $this->data['request']->parameters['email'];
					$table_values['email'] = $this->data['request']->parameters['email'];
					$table_values['about'] = $this->data['request']->parameters['about'];
					$password = substr(md5(rand()),0, 8);
					$table_values['password'] = md5($password);	
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
						->values($table_values)
						->insert();
					$this->data['id'] = $this->dbmanager->getLastID();	
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT APPRAISER '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
									
					$to = $this->data['request']->parameters['email'];
					$subject = 'Регистрация оценщика';
					$message = 'Ваш логин: '.$this->data['request']->parameters['email'].' Ваш пароль: '.$password;
					$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
					unset($table_values);
					$table_values['user_id'] = $this->data['id'];
					$table_values['logo'] = $this->data['request']->parameters['logo'];
					$table_values['company_name'] = $this->data['request']->parameters['company_name'];
					$table_values['voen'] = $this->data['request']->parameters['voen'];
					$table_values['website'] = $this->data['request']->parameters['website'];
					$table_values['mobile'] = $this->data['request']->parameters['mobile'];
					$table_values['home'] = $this->data['request']->parameters['home'];
					$table_values['phone1'] = $this->data['request']->parameters['phone1'];
					$table_values['phone2'] = $this->data['request']->parameters['phone2'];
					$table_values['company'] = 1;
					$table_values['comment'] = $this->data['request']->parameters['comment'];
					$table_values['reg_date'] = date('Y-m-d H:i:s');
					$table_values['reg_by'] = $this->data['item']->id;
					$table_values['validated'] = 1;
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
						->values($table_values)
						->insert();
						
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT APPRAISER META '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					unset($table_values);
					$table_values['user_id'] = $this->data['id'];
					$table_values['role_id'] = 7;
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'user_grants')
						->values($table_values)
						->insert();
						
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT APPRAISER GRANTS '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					$this->data['result'] = 'true';
				}
			}
			else $this->data['result'] = 'false';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	
	
	public function save_bank()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
				if (isset($this->data['request']->parameters['id']))
				{
					$table_values['name'] = $this->data['request']->parameters['name'];
					$table_values['logo'] = $this->data['request']->parameters['logo'];
					$table_values['ipoteka'] = $this->data['request']->parameters['ipoteka'];
					$table_values['price'] = $this->data['request']->parameters['price'];
					$table_values['srok'] = $this->data['request']->parameters['srok'];
					$table_values['percent'] = $this->data['request']->parameters['percent'];
					$table_values['vznos'] = $this->data['request']->parameters['vznos'];
					$table_values['comission'] = $this->data['request']->parameters['comission'];
					$table_values['dolya'] = $this->data['request']->parameters['dolya'];
					$table_values['stoimost'] = $this->data['request']->parameters['stoimost'];
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'banks')
						->values($table_values)
						->where('id = '.$this->data['request']->parameters['id'])
						->update();
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'UPDATE BANK '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					$this->data['result'] = 'true';
				}
				else
				{
					$table_values['name'] = $this->data['request']->parameters['name'];
					$table_values['logo'] = $this->data['request']->parameters['logo'];
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'banks')
						->values($table_values)
						->insert();
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT BANK '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					$this->data['result'] = 'true';
				}
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	
	
	public function save_object_extra()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 7)
		{
			$this->data['price'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
				->fields('*')
				->where('appraiser = '.$this->data['item']->id.' AND object_id = '.$this->data['request']->parameters['object_id'])
				->getScalar();
			if ($this->data['price'])
			{
				$table_values['status'] = 1;
				$table_values['rinok'] = $this->data['request']->parameters['rinok'];
				$table_values['liquid'] = $this->data['request']->parameters['liquid'];
				$table_values['comment'] = $this->data['request']->parameters['comment'];
				$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
					->values($table_values)
					->where('id = '.$this->data['price']->id)
					->update();
				
				$tv['user'] = $this->data['item']->id;
				$tv['date'] = date('Y-m-d H:i:s');
				$tv['action'] = 'UPDATE PRICE '.json_encode($table_values);
				$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
					->values($tv)
					->insert();
						
				$this->data['result'] = 'true';
			}
			else
			{
				$table_values['appraiser'] = $this->data['item']->id;
				$table_values['object_id'] = $this->data['request']->parameters['object_id'];
				$table_values['rinok'] = $this->data['request']->parameters['rinok'];
				$table_values['liquid'] = $this->data['request']->parameters['liquid'];
				$table_values['comment'] = $this->data['request']->parameters['comment'];
				$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
					->values($table_values)
					->insert();
				
				$tv['user'] = $this->data['item']->id;
				$tv['date'] = date('Y-m-d H:i:s');
				$tv['action'] = 'INSERT PRICE '.json_encode($table_values);
				$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
					->values($tv)
					->insert();
					
				$this->data['result'] = 'true';
			}
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	
	
	public function get_my_objects()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 6 || $this->data['item']->role_id == 3 || $this->data['item']->role_id == 7)
		{
			if (isset($this->data['request']->parameters['address'])) $this->data['result'] = $this->dbmanager->selectByQuery('SELECT * FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o LEFT JOIN status s ON o.status = s.ID WHERE o.address LIKE "%'.$this->data['request']->parameters['address'].'%" AND o.realtor = '.$this->data['item']->id.'  ORDER BY o.reg_date DESC');
			else $this->data['result'] = $this->dbmanager->selectByQuery('SELECT * FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o LEFT JOIN status s ON o.status = s.ID WHERE o.realtor = '.$this->data['item']->id.' ORDER BY o.reg_date DESC');
			foreach ($this->data['result'] as $key=>$result)
			{
				$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
					->fields('u.id, u.email, u.name, u.surname, u.patronymic, um.company, um.company_name')
					->where('um.user_id = u.id AND u.id = '.$this->data['result'][$key]->realtor)
					->getScalar();
				if ($this->data['realtor']->company == 0) $this->data['result'][$key]->realtor = $this->data['realtor']->name." ".$this->data['realtor']->surname;
				else $this->data['result'][$key]->realtor = $this->data['realtor']->company_name;
			}
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_val_objects()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 6 || $this->data['item']->role_id == 3 || $this->data['item']->role_id == 7)
		{
			if ($this->data['request']->parameters['address']) $this->data['result'] = $this->dbmanager->selectByQuery('SELECT o.*, s.status_name FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o, votes v, status s WHERE o.status = s.ID AND o.address LIKE "%'.$this->data['request']->parameters['address'].'%" AND v.object_id = o.id AND v.user_id = '.$this->data['item']->id.' ORDER BY o.reg_date DESC');		
			else $this->data['result'] = $this->dbmanager->selectByQuery('SELECT o.*, s.status_name FROM '.Backstage::gi()->db_table_prefix.'rmrt_objects o, votes v, status s WHERE o.status = s.ID AND v.object_id = o.id AND v.user_id = '.$this->data['item']->id);
			foreach ($this->data['result'] as $key=>$value)
			{
				$this->data['result'][$key]->values = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
					->fields('*')
					->where('object_id = '.$this->data['result'][$key]->id.' AND appraiser = '.$this->data['item']->id)
					->getScalar();
				$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'rmrt_user_meta um')
					->fields('u.id, u.email, u.name, u.surname, u.patronymic, um.company, um.company_name')
					->where('um.user_id = u.id AND u.id = '.$this->data['result'][$key]->realtor)
					->getScalar();
				if ($this->data['realtor']->company == 0) $this->data['result'][$key]->realtor = $this->data['realtor']->name." ".$this->data['realtor']->surname;
				else $this->data['result'][$key]->realtor = $this->data['realtor']->company_name;
			}
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_valuates()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 6 || $this->data['item']->role_id == 3 || $this->data['item']->role_id == 7)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices a', Backstage::gi()->db_table_prefix.'users b')
				->fields('a.*, b.email')
				->where('a.object_id = '.$this->data['request']->parameters['id'].' AND a.appraiser = b.id')
				->select();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_objects_for_app()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 6 || $this->data['item']->role_id == 3 || $this->data['item']->role_id == 7)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where('status = 5')
				->select();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_object()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 6 || $this->data['item']->role_id == 3 || $this->data['item']->role_id == 7)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();

			$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
				->fields('*')
				->select();
			$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
				->fields('*')
				->select();
			$this->data['metros'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro')
				->fields('*')
				->select();
			$this->data['orients'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro')
				->fields('*')
				->select();
			$this->data['ap_types'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_ap_types')
				->fields('*')
				->select();
				
			$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u')
				->fields('u.id, u.email, u.name, u.surname, u.patronymic')
				->where('u.id = '.$this->data['result']->realtor)
				->getScalar();
			$this->data['result']->realtor = $this->data['realtor']->surname." ".$this->data['realtor']->name." ".$this->data['realtor']->patronymic." - ".$this->data['realtor']->email;
			
			if ($this->data['result']->type == 1) $this->data['result']->type = "Квартира";
			if ($this->data['result']->type == 2) $this->data['result']->type = "Частный дом";
			
			if ($this->data['result']->ap_type == 1) $this->data['result']->ap_type = "Новостройка";
			if ($this->data['result']->ap_type == 2) $this->data['result']->ap_type = "Вторичное жильё";
				
			$this->data['result']->value->rinok = 'AZN '.$this->data['result']->value->rinok;
			$this->data['result']->price = 'AZN '.$this->data['result']->price;
			$this->data['result']->city = $this->data['cities'][$this->data['result']->city - 1]->name;
			$this->data['result']->region = $this->data['regions'][$this->data['result']->region - 1]->name;
			$this->data['result']->metro = $this->data['metros'][$this->data['result']->metro - 1]->name;
			$this->data['result']->orient = $this->data['orients'][$this->data['result']->orient - 1]->name;
			$name[0] = 'Нет';
			$name[1] = 'Есть';
			$this->data['result']->square_zeml = $this->data['result']->square_zeml." сот";
			$this->data['result']->square = $this->data['result']->square." м<sup>2</sup>";
			$this->data['result']->phone = $name[$this->data['result']->phone];
			$this->data['result']->kabeltv = $name[$this->data['result']->kabeltv];
			$this->data['result']->lift = $name[$this->data['result']->lift];
			$this->data['result']->garage = $name[$this->data['result']->garage];
			$this->data['result']->safe = $name[$this->data['result']->safe];
			$this->data['result']->pvcwin = $name[$this->data['result']->pvcwin];
			$this->data['result']->waterboil = $name[$this->data['result']->waterboil];
			$this->data['result']->warm = $name[$this->data['result']->warm];
			$this->data['result']->kombi = $name[$this->data['result']->kombi];
			$this->data['result']->conditioner = $name[$this->data['result']->conditioner];
			$this->data['result']->kitchen = $name[$this->data['result']->kitchen];
			$this->data['result']->pravo = $name[$this->data['result']->pravo];
			$this->data['result']->kupche = $name[$this->data['result']->kupche];
			$this->data['result']->gas = $name[$this->data['result']->gas];
			//$this->data['result']-> = $name[$this->data['result']->];
			if ($this->data['result']->type == 1) $this->data['result']->ap_type = $this->data['ap_types'][$this->data['result']->ap_type - 1]->name;
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function get_valuate()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 6 || $this->data['item']->role_id == 3 || $this->data['item']->role_id == 7)
		{
			$this->data['result'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
				->fields('*')
				->where('appraiser = '.$this->data['item']->id.' AND object_id = '.$this->data['request']->parameters['id'])
				->getScalar();
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function pending_value()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$table_values['status'] = 1;
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
			
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'PENDING PRICE '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
					
			$this->data['result'] = 'true';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function approve_value()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			
			$this->data['price'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
			
			$table_values['status'] = 2;
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
			
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'APPROVE PRICE '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
				
			unset($table_values);
			$table_values['rinok'] = $this->data['price']->rinok;
			$table_values['liquid'] = $this->data['price']->liquid;
			$table_values['comment'] = $this->data['price']->comment;
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->values($table_values)
				->where('id = '.$this->data['price']->object_id)
				->update();
			
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'UPDATE OBJECT '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
				
			$this->data['result'] = 'true';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function decline_value()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$table_values['status'] = 3;
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
			
			$this->data['price'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
				
			unset($table_values);
			$table_values['rinok'] = '';
			$table_values['liquid'] = '';
			$table_values['comment'] = '';
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->values($table_values)
				->where('id = '.$this->data['price']->object_id)
				->update();
			
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'DECLINE PRICE '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
				
			$this->data['result'] = 'true';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	
	public function make_pending()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 6 || $this->data['item']->role_id == 2)
		{
			$table_values['status'] = 2;
			
			$this->data['object'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
			
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
				
			$status[1] = 'Created';	
			$status[2] = 'Pending';	
			$status[3] = 'Rejected';	
			$status[4] = 'Pending correction';	
			$status[5] = 'Pending valuation';	
			$status[6] = 'Pending approval';	
			$status[7] = 'Approved';	
			$status[8] = 'Sold';	
			
			$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
				->fields('email')
				->where('id = '.$this->data['object']->realtor)
				->getScalar();
			
			$to = $this->data['realtor']->email;
			$subject = 'Изменение статуса объявления';
			$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[2].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
			$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
			
			$this->data['pms'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
				->fields('u.email, ug.role_id')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 3')
				->select();
			foreach ($this->data['pms'] as $pm)
			{
				$to = $pm->email;
				$subject = 'Изменение статуса объявления';
				$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[2].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
				$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $message, $headers);
			}
				
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'PENDING OBJECT '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
				
			$this->data['result'] = 'true';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function save_buyer()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 5 || $this->data['item']->role_id == 3)
		{
			if (isset($this->data['request']->parameters['id']))
			{
				$this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
					->fields('id')
					->where('id != '.$this->data['request']->parameters['id'].' AND email = "'.$this->data['request']->parameters['email'].'"')
					->getScalar();
			}
			else
			{
				$this->data['exists'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
					->fields('id')
					->where('email = "'.$this->data['request']->parameters['email'].'"')
					->getScalar();
			}
			if (!$this->data['exists'])
			{
				if (isset($this->data['request']->parameters['id']))
				{
					$table_values['login'] = $this->data['request']->parameters['email'];
					$table_values['email'] = $this->data['request']->parameters['email'];
					$table_values['name'] = $this->data['request']->parameters['name'];
					$table_values['surname'] = $this->data['request']->parameters['surname'];
					$table_values['patronymic'] = $this->data['request']->parameters['patronymic'];
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
						->values($table_values)
						->where('id = '.$this->data['request']->parameters['id'])
						->update();
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'UPDATE BUYER '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
				
					$to = $this->data['request']->parameters['email'];
					$subject = 'Изменения данных о пользователе';
					$message = 'Ваш логин: '.$this->data['request']->parameters['email'].' Ваш пароль: '.$password;
					$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
					unset($table_values);
					$table_values['birthday'] = $this->data['request']->parameters['birthday'];
					$table_values['mobile'] = $this->data['request']->parameters['mobile'];
					$table_values['home'] = $this->data['request']->parameters['home'];
					$table_values['phone1'] = $this->data['request']->parameters['phone1'];
					$table_values['phone2'] = $this->data['request']->parameters['phone2'];
					$table_values['comment'] = $this->data['request']->parameters['comment'];
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
						->values($table_values)
						->where('user_id = '.$this->data['request']->parameters['id'])
						->update();
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'UPDATE BUYER META '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					$this->data['result'] = 'true';
				}
				else
				{
					$table_values['login'] = $this->data['request']->parameters['email'];
					$table_values['email'] = $this->data['request']->parameters['email'];
					$table_values['name'] = $this->data['request']->parameters['name'];
					$table_values['surname'] = $this->data['request']->parameters['surname'];
					$table_values['patronymic'] = $this->data['request']->parameters['patronymic'];
					//$password = substr(md5(rand()),0, 8);
					//$table_values['password'] = md5($password);	
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
						->values($table_values)
						->insert();
					$this->data['id'] = $this->dbmanager->getLastID();
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT BUYER '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					
					$to = $this->data['request']->parameters['email'];
					$subject = 'Регистрация пользователя';
					$message = 'Ваш логин: '.$this->data['request']->parameters['email'].' Ваш пароль: '.$password;
					$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
					unset($table_values);
					$table_values['user_id'] = $this->data['id'];
					$table_values['birthday'] = $this->data['request']->parameters['birthday'];
					$table_values['mobile'] = $this->data['request']->parameters['mobile'];
					$table_values['home'] = $this->data['request']->parameters['home'];
					$table_values['phone1'] = $this->data['request']->parameters['phone1'];
					$table_values['phone2'] = $this->data['request']->parameters['phone2'];
					$table_values['comment'] = $this->data['request']->parameters['comment'];
					$table_values['reg_date'] = date('Y-m-d H:i:s');
					$table_values['reg_by'] = $this->data['item']->id;
					$table_values['validated'] = 0;
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_user_meta')
						->values($table_values)
						->insert();
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT BUYER META '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					unset($table_values);
					$table_values['user_id'] = $this->data['id'];
					$table_values['role_id'] = 8;
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'user_grants')
						->values($table_values)
						->insert();
					
					$tv['user'] = $this->data['item']->id;
					$tv['date'] = date('Y-m-d H:i:s');
					$tv['action'] = 'INSERT BUYER GRANTS '.json_encode($table_values);
					$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
						->values($tv)
						->insert();
						
					$this->data['result'] = 'true';
				}
			}
			else $this->data['result'] = 'false';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	
	public function save_act()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3 || $this->data['item']->role_id == 7)
		{
			$this->data['price'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
			$table_values['status'] = 4; 
			$table_values['act'] = $this->data['request']->parameters['act'];
			$table_values['user'] = $this->data['request']->parameters['user'];
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
				
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'UPDATE PRICE ACT '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
						
			unset($table_values);
			$table_values['rinok'] = $this->data['price']->rinok;
			$table_values['liquid'] = $this->data['price']->liquid;
			$table_values['comment'] = $this->data['price']->comment;
			$table_values['act'] = $this->data['request']->parameters['act'];
			$table_values['user'] = $this->data['request']->parameters['user'];
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->values($table_values)
				->where('id = '.$this->data['price']->object_id)
				->update();
			
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'UPDATE OBJECT '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
				
			$this->data['result'] = 'true';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function make_reject()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$table_values['status'] = 3;
			
			$this->data['object'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
			
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
				
			$status[1] = 'Created';	
			$status[2] = 'Pending';	
			$status[3] = 'Rejected';	
			$status[4] = 'Pending correction';	
			$status[5] = 'Pending valuation';	
			$status[6] = 'Pending approval';	
			$status[7] = 'Approved';	
			$status[8] = 'Sold';	
			
			$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
				->fields('email')
				->where('id = '.$this->data['object']->realtor)
				->getScalar();
			
			$to = $this->data['realtor']->email;
			$subject = 'Изменение статуса объявления';
			$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[3].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
			$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
			
			$this->data['pms'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
				->fields('u.email, ug.role_id')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 3')
				->select();
			foreach ($this->data['pms'] as $pm)
			{
				$to = $pm->email;
				$subject = 'Изменение статуса объявления';
				$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[3].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
				$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $message, $headers);
			}
			
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'REJECT OBJECT '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
				
			$this->data['result'] = 'true';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function make_correct()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$table_values['status'] = 4;
			$table_values['correction_comment'] = $this->data['request']->parameters['comment'];
			
			$this->data['object'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
			
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
				
			$status[1] = 'Created';	
			$status[2] = 'Pending';	
			$status[3] = 'Rejected';	
			$status[4] = 'Pending correction';	
			$status[5] = 'Pending valuation';	
			$status[6] = 'Pending approval';	
			$status[7] = 'Approved';	
			$status[8] = 'Sold';	
			
			$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
				->fields('email')
				->where('id = '.$this->data['object']->realtor)
				->getScalar();
			
			$to = $this->data['realtor']->email;
			$subject = 'Изменение статуса объявления';
			$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[4].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
			$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
			
			$this->data['pms'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
				->fields('u.email, ug.role_id')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 3')
				->select();
			foreach ($this->data['pms'] as $pm)
			{
				$to = $pm->email;
				$subject = 'Изменение статуса объявления';
				$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[4].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
				$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $message, $headers);
			}
			
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'CORRECT OBJECT '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
				
			$this->data['result'] = 'true';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function make_valuation()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$table_values['status'] = 5;
			
			$this->data['object'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
			
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
				
			$status[1] = 'Created';	
			$status[2] = 'Pending';	
			$status[3] = 'Rejected';	
			$status[4] = 'Pending correction';	
			$status[5] = 'Pending valuation';	
			$status[6] = 'Pending approval';	
			$status[7] = 'Approved';	
			$status[8] = 'Sold';	
			
			$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
				->fields('email')
				->where('id = '.$this->data['object']->realtor)
				->getScalar();
			
			$to = $this->data['realtor']->email;
			$subject = 'Изменение статуса объявления';
			$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[5].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
			$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
			
			$this->data['pms'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
				->fields('u.email, ug.role_id')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 3')
				->select();
			foreach ($this->data['pms'] as $pm)
			{
				$to = $pm->email;
				$subject = 'Изменение статуса объявления';
				$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[5].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
				$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $message, $headers);
			}
			
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'VALUATION OBJECT '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
				
			$this->data['result'] = 'true';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function make_approval()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$table_values['status'] = 6;
			
			
			$this->data['object'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
			
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
				
			$status[1] = 'Created';	
			$status[2] = 'Pending';	
			$status[3] = 'Rejected';	
			$status[4] = 'Pending correction';	
			$status[5] = 'Pending valuation';	
			$status[6] = 'Pending approval';	
			$status[7] = 'Approved';	
			$status[8] = 'Sold';	
			
			$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
				->fields('email')
				->where('id = '.$this->data['object']->realtor)
				->getScalar();
			
			$to = $this->data['realtor']->email;
			$subject = 'Изменение статуса объявления';
			$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[6].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
			$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
			
			$this->data['pms'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
				->fields('u.email, ug.role_id')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 3')
				->select();
			foreach ($this->data['pms'] as $pm)
			{
				$to = $pm->email;
				$subject = 'Изменение статуса объявления';
				$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[6].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
				$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $message, $headers);
			}
			
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'PENDING APPROVE OBJECT '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
				
			$this->data['result'] = 'true';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function make_approved()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3)
		{
			$table_values['status'] = 7;
			
			$this->data['object'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
			
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
				
			$status[1] = 'Created';	
			$status[2] = 'Pending';	
			$status[3] = 'Rejected';	
			$status[4] = 'Pending correction';	
			$status[5] = 'Pending valuation';	
			$status[6] = 'Pending approval';	
			$status[7] = 'Approved';	
			$status[8] = 'Sold';	
			
			$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
				->fields('email')
				->where('id = '.$this->data['object']->realtor)
				->getScalar();
			
			$to = $this->data['realtor']->email;
			$subject = 'Изменение статуса объявления';
			$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[7].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
			$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
			
			$this->data['pms'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
				->fields('u.email, ug.role_id')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 3')
				->select();
			foreach ($this->data['pms'] as $pm)
			{
				$to = $pm->email;
				$subject = 'Изменение статуса объявления';
				$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[7].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
				$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $message, $headers);
			}
			
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'APPROVED OBJECT '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
				
			$this->data['result'] = 'true';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function make_sold()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3 || $this->data['item']->role_id == 6)
		{
			$table_values['status'] = 8;
			
			$this->data['object'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
			
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
				
			$status[1] = 'Created';	
			$status[2] = 'Pending';	
			$status[3] = 'Rejected';	
			$status[4] = 'Pending correction';	
			$status[5] = 'Pending valuation';	
			$status[6] = 'Pending approval';	
			$status[7] = 'Approved';	
			$status[8] = 'Sold';	
			
			$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
				->fields('email')
				->where('id = '.$this->data['object']->realtor)
				->getScalar();
			
			$to = $this->data['realtor']->email;
			$subject = 'Изменение статуса объявления';
			$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[8].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
			$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
			
			$this->data['pms'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
				->fields('u.email, ug.role_id')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 3')
				->select();
			foreach ($this->data['pms'] as $pm)
			{
				$to = $pm->email;
				$subject = 'Изменение статуса объявления';
				$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[8].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
				$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $message, $headers);
			}
			
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'SOLD OBJECT '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
				
			$this->data['result'] = 'true';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function make_created()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if ($this->data['item']->role_id == 2)
		{
			$table_values['status'] = 1;
			
			$this->data['object'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where('id = '.$this->data['request']->parameters['id'])
				->getScalar();
			
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->values($table_values)
				->where('id = '.$this->data['request']->parameters['id'])
				->update();
				
			$status[1] = 'Created';	
			$status[2] = 'Pending';	
			$status[3] = 'Rejected';	
			$status[4] = 'Pending correction';	
			$status[5] = 'Pending valuation';	
			$status[6] = 'Pending approval';	
			$status[7] = 'Approved';	
			$status[8] = 'Sold';	
			
			$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
				->fields('email')
				->where('id = '.$this->data['object']->realtor)
				->getScalar();
			
			$to = $this->data['realtor']->email;
			$subject = 'Изменение статуса объявления';
			$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[1].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
			$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
			
			$this->data['pms'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
				->fields('u.email, ug.role_id')
				->where('ug.user_id = u.id AND ug.role_id IS NOT NULL AND ug.role_id = 3')
				->select();
			foreach ($this->data['pms'] as $pm)
			{
				$to = $pm->email;
				$subject = 'Изменение статуса объявления';
				$message = 'Статус объявления #'.$this->data['request']->parameters['id'].' изменён с '.$status[$this->data['object']->status].' на '.$status[1].' пользователем '.Backstage::gi()->login.' в '.date('Y-m-d H:i:s').'. С уважением, REMART!';
				$headers = 'From: service@remart24.az' . "\r\n" . 'Reply-To: service@remart24.az' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $message, $headers);
			}
			
			$tv['user'] = $this->data['item']->id;
			$tv['date'] = date('Y-m-d H:i:s');
			$tv['action'] = 'CREATED OBJECT '.json_encode($table_values);
			$this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_log')
				->values($tv)
				->insert();
				
			$this->data['result'] = 'true';
		}
		else $this->data['result'] = 'false';
		return $this->data;
	}
	
	public function search()
	{
		$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		//if ($this->data['item']->role_id == 8)
		//{
			$metro = join("','", $this->data['request']->parameters['metro']);
			$region = join("','", $this->data['request']->parameters['region']);
			$city = join("','", $this->data['request']->parameters['city']);
			$orient = join("','", $this->data['request']->parameters['orient']);
			$room = join("','", $this->data['request']->parameters['room']);
			$project = join("','", $this->data['request']->parameters['project']);
			$type = isset($this->data['request']->parameters['type']) ? $this->data['request']->parameters['type'] : 0;
			$ap_type = isset($this->data['request']->parameters['ap_type']) ? $this->data['request']->parameters['ap_type'] : 0;
			$min_pr = ($this->data['request']->parameters['min_pr'] != '') ? $this->data['request']->parameters['min_pr'] : 0;
			$max_pr = ($this->data['request']->parameters['max_pr'] != '') ? $this->data['request']->parameters['max_pr'] : 1000000000;
			$min_sq = ($this->data['request']->parameters['min_sq'] != '') ? $this->data['request']->parameters['min_sq'] : 0;
			$max_sq = ($this->data['request']->parameters['max_sq'] != '') ? $this->data['request']->parameters['max_sq'] : 1000000000;
			$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
				->fields('*')
				->select();
			$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
				->fields('*')
				->select();
			$this->data['metros'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro')
				->fields('*')
				->select();
			$this->data['orients'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_orient')
				->fields('*')
				->select();
			$this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
				->fields('*')
				->select();
			$this->data['realtor'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
				->fields('u.id, ug.role_id')
				->where('ug.role_id = 6 AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
				->select();
			if ($metro == '') foreach ($this->data['metros'] as $metro) $this->data['request']->parameters['metro'][] = $metro->id;
			if ($region == '') foreach ($this->data['regions'] as $region) $this->data['request']->parameters['region'][] = $region->id;
			if ($city == '') foreach ($this->data['cities'] as $city) $this->data['request']->parameters['city'][] = $city->id;
			if ($orient == '') foreach ($this->data['orients'] as $orient) $this->data['request']->parameters['orient'][] = $orient->id;
			if ($project == '') foreach ($this->data['projects'] as $project) $this->data['request']->parameters['project'][] = $project->id;
			$realtarr = array();
			foreach ($this->data['realtor'] as $realtor) $realtarr[] = $realtor->id;
			$metro = join("','", $this->data['request']->parameters['metro']);
			$region = join("','", $this->data['request']->parameters['region']);
			$city = join("','", $this->data['request']->parameters['city']);
			$orient = join("|", $this->data['request']->parameters['orient']);
			$project = join("','", $this->data['request']->parameters['project']);
			if (!isset($this->data['request']->parameters['realtor']) || $this->data['request']->parameters['realtor'] == 0)  $realtor = join("','", $realtarr);
			else $realtor = $this->data['request']->parameters['realtor'];
			if ($room == '') $room = "1','2','3','4','5";
			if ($type == 1)
			{
				if ($ap_type == 0)
				{
					$sql = "SELECT * FROM objects WHERE realtor IN ('$realtor') AND metro IN ('$metro') AND city IN ('$city') AND region IN ('$region') AND room IN ('$room') AND ((rinok >= $min_pr AND rinok <= $max_pr AND rinok != '') OR (price >= $min_pr AND price <= $max_pr AND rinok = '')) AND square >= $min_sq AND square <= $max_sq AND type = 1 AND status = 7 AND (orient regexp '(^|,)($orient)(,|$)' OR orient IS NULL) ORDER BY reg_date DESC";
				}
				else if ($ap_type == 1)
				{
					$sql = "SELECT * FROM objects WHERE realtor IN ('$realtor') AND metro IN ('$metro') AND city IN ('$city') AND region IN ('$region') AND room IN ('$room') AND ((rinok >= $min_pr AND rinok <= $max_pr AND rinok != '') OR (price >= $min_pr AND price <= $max_pr AND rinok = '')) AND square >= $min_sq AND square <= $max_sq AND type = 1 AND ap_type = 1 AND status = 7 AND (orient regexp '(^|,)($orient)(,|$)' OR orient IS NULL) ORDER BY reg_date DESC";
				}
				else if ($ap_type == 2)
				{
					$sql = "SELECT * FROM objects WHERE realtor IN ('$realtor') AND metro IN ('$metro') AND city IN ('$city') AND region IN ('$region') AND room IN ('$room') AND project IN ('$project') AND ((rinok >= $min_pr AND rinok <= $max_pr AND rinok != '') OR (price >= $min_pr AND price <= $max_pr AND rinok = '')) AND square >= $min_sq AND square <= $max_sq AND type = 1 AND ap_type = 2 AND status = 7 AND (orient regexp '(^|,)($orient)(,|$)' OR orient IS NULL) ORDER BY reg_date DESC";
				}
			}
			else if ($type == 2)
			{
				$sql = "SELECT * FROM objects WHERE realtor IN ('$realtor') AND metro IN ('$metro') AND city IN ('$city') AND region IN ('$region') AND room IN ('$room') AND ((rinok >= $min_pr AND rinok <= $max_pr AND rinok != '') OR (price >= $min_pr AND price <= $max_pr AND rinok = '')) AND square >= $min_sq AND square <= $max_sq AND type = 2 AND status = 7 AND (orient regexp '(^|,)($orient)(,|$)' OR orient IS NULL) ORDER BY reg_date DESC";
			}
			else
			{
				$sql = "SELECT * FROM objects WHERE realtor IN ('$realtor') AND metro IN ('$metro') AND city IN ('$city') AND region IN ('$region') AND room IN ('$room') AND ((rinok >= $min_pr AND rinok <= $max_pr AND rinok != '') OR (price >= $min_pr AND price <= $max_pr AND rinok = '')) AND square >= $min_sq AND square <= $max_sq AND status = 7 AND (orient regexp '(^|,)($orient)(,|$)' OR orient IS NULL) ORDER BY reg_date DESC";
			}
			//echo $sql;
			$this->data['result'] = $this->dbmanager->selectByQuery($sql);
			foreach ($this->data['result'] as $key=>$result)
			{
				$this->data['result'][$key]->city_id = $this->data['result'][$key]->city;
				$this->data['result'][$key]->city = $this->data['cities'][$this->data['result'][$key]->city - 1]->name;
				if ($this->data['result'][$key]->type == 1) $this->data['result'][$key]->type = "Квартира";
				if ($this->data['result'][$key]->type == 2) $this->data['result'][$key]->type = "Частный дом";
			}
			//var_dump($this->data['result']);
		//}
		//else $this->data['result'] = 'false';
		foreach ($this->data['result'] as $k=>$v)
		{
			$this->data['item2'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
				->fields('id')
				->where('user = '.$this->data['item']->id.' AND object = '.$v->id)
				->getScalar();
			if ($this->data['item2']->id) $this->data['result'][$k]->favorite = true;
			else $this->data['result'][$k]->favorite = false;
		}
		return $this->data;
	}
	
	public function get_approved_objects_count()
	{
		if (!isset($this->data['request']->parameters['realtor']))
		{
			$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
				->fields('u.id, ug.role_id')
				->where('ug.role_id = 6 AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
				->select();
			if ($realtor == '') foreach ($this->data['item'] as $realtor) $this->data['request']->parameters['realtor'][] = $realtor->id;
			$realtor = join("','", $this->data['request']->parameters['realtor']);
			$this->data['objects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('COUNT(*) as cnt')
				->where("status = 7 AND realtor IN ('$realtor')")
				->getScalar();
		}
		else
		{
			$this->data['objects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('COUNT(*) as cnt')
				->where("status = 7 AND realtor IN ('".$this->data['request']->parameters['realtor']."')")
				->getScalar();
		}
		
		return $this->data;
	}
	
	public function get_approved_objects()
	{
		$this->data['itemx'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
            ->fields('u.id, ug.role_id')
            ->where('u.login = "'.Backstage::gi()->login.'" AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
            ->getScalar();
		if (!isset($this->data['request']->parameters['realtor']))
		{
			$this->data['item'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users u', Backstage::gi()->db_table_prefix.'user_grants ug')
				->fields('u.id, ug.role_id')
				->where('ug.role_id = 6 AND ug.user_id = u.id AND ug.role_id IS NOT NULL')
				->select();
			if ($realtor == '') foreach ($this->data['item'] as $realtor) $this->data['request']->parameters['realtor'][] = $realtor->id;
			$realtor = join("','", $this->data['request']->parameters['realtor']);
			$this->data['objects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where("status = 7")
				->order('reg_date DESC')
				->limit($this->data['request']->parameters['perpage'] * ($this->data['request']->parameters['page'] - 1) .", ".$this->data['request']->parameters['perpage'])
				->select();
		}
		else
		{
			$this->data['objects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_objects')
				->fields('*')
				->where("status = 7 AND realtor IN ('".$this->data['request']->parameters['realtor']."')")
				->order('reg_date DESC')
				->limit($this->data['request']->parameters['perpage'] * ($this->data['request']->parameters['page'] - 1) .", ".$this->data['request']->parameters['perpage'])
				->select();
		}
		
		$this->data['cities'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_cities')
			->fields('*')
			->select();
		$this->data['regions'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_regions')
			->fields('*')
			->select();
		$this->data['metros'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_metro')
			->fields('*')
			->select();
		$this->data['orients'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_orient')
			->fields('*')
			->select();
		$this->data['projects'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_projects')
			->fields('*')
			->select();
		foreach ($this->data['objects'] as $key=>$object)
		{
			$this->data['objects'][$key]->value = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'prices')
				->fields('*')
				->where('status = 4 AND object_id = '.$object->id)
				->order('rinok DESC')
				->getScalar();
			if ($this->data['objects'][$key]->type == 1) $this->data['objects'][$key]->type = "Квартира";
			if ($this->data['objects'][$key]->type == 2) $this->data['objects'][$key]->type = "Частный дом";
			$this->data['objects'][$key]->city_id = $this->data['objects'][$key]->city;
			$this->data['objects'][$key]->region_id = $this->data['objects'][$key]->region;
			$this->data['objects'][$key]->metro_id = $this->data['objects'][$key]->metro;
			$this->data['objects'][$key]->orient_id = $this->data['objects'][$key]->orient;
			$this->data['objects'][$key]->city = $this->data['cities'][$this->data['objects'][$key]->city - 1]->name;
			$this->data['objects'][$key]->region = $this->data['regions'][$this->data['objects'][$key]->region - 1]->name;
			$this->data['objects'][$key]->metro = $this->data['metros'][$this->data['objects'][$key]->metro - 1]->name;
			$this->data['objects'][$key]->orient = $this->data['orients'][$this->data['objects'][$key]->orient - 1]->name;

			$this->data['item2'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'rmrt_favorites')
				->fields('id')
				->where('user = '.$this->data['itemx']->id.' AND object = '.$object->id)
				->getScalar();
			if ($this->data['item2']->id) $this->data['objects'][$key]->favorite = true;
			else $this->data['objects'][$key]->favorite = false;
		}
		
		return $this->data;
	}*/
}