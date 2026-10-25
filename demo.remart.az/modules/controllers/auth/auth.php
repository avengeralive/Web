<?php

/**
 * @package    MVC
 *
 * @copyright  Copyright (C) 2017  Elshan Akhundov, Rinat Gazikhanov, Vusal Khalilov, BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
class cAuth extends controller
{
    public function get()
	{
        $this->data['view_name'] = 'loginform';
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	public function getPublic()
	{
        $this->data['view_name'] = 'publicloginform';
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	private function generateCookie($login, $expiration) 
	{
		$key = hash_hmac('md5', $login.$expiration, 'blabla');
		$hash = hash_hmac('md5', $login.$expiration, $key);
		$cookie = $login.'|'.$expiration.'|'.$hash;
		return $cookie;
	}
		
    public function login()
    {
		$this->data = Loader::gi()->getModel($this->data);

		if (!$this->data['item'])
		{
			if (Backstage::gi()->track_user_activity)			
				Arhlog::log(array('users'), 'auth', 's', array('login'=>$this->data['request']->parameters['login'], 'action'=>'login', 'status'=>'unsuccess'));				// Arhlog data
			$this->data['body'] = 0;
			return $this->data;
		}
		
		$expiration = time() + 172800;
		$cookie = $this->generateCookie($this->data['item']->login, $expiration);

		Backstage::gi()->user = $this->data['item'];
		Backstage::gi()->user->password = '';
		if (Backstage::gi()->track_user_activity)			
			Arhlog::log(array('users'), 'auth', 's', array('login'=>$this->data['request']->parameters['login'], 'action'=>'login', 'status'=>'success'));				// Arhlog data
			
		$this->data['body'] = $cookie;
        return $this->data;

    }

    public function logout()
    {
		if (Backstage::gi()->track_user_activity)			
			Arhlog::log(array('users'), 'auth', 's', array('login'=>Backstage::gi()->user->login, 'action'=>'logout', 'status'=>'success'));				// Arhlog data
		Backstage::gi()->user->id = 0;
		Backstage::gi()->user->login = '';
		Backstage::gi()->user->password = '';
		unset($_SESSION['userDisplayName']);
		unset($_COOKIE['AUTH']);		
    	setcookie('AUTH', null, -1, Backstage::gi()->portal_url_wo_domain);
		header("Location: ".Backstage::gi()->portal_url.'login', true, 301);
		exit();
        return $this->data;
    }

    public function publicLogout()
    {
		Backstage::gi()->user->id = 0;
		Backstage::gi()->user->login = '';
		Backstage::gi()->user->password = '';
		unset($_COOKIE['AUTH']);
    	setcookie('AUTH', null, -1, Backstage::gi()->portal_url_wo_domain);
		header("Location: ".Backstage::gi()->portal_url);
		
		exit();
        return $this->data;
    }
    
    public function getNameAndSurnameByLogin(){
	
	$this->data = Loader::gi()->getModel($this->data);
	return $this->data;
		    	
    }
}