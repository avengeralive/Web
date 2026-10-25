<?php
namespace Cetera\Widget; 

/**
 * Виджет "Постраничная навигация"
 * 
 * @package CeteraCMS
 */ 
class UserAuth extends Templateable {
	
	public $password_error = false;
	public $login_error = false;
	public $login = '';
		 
    protected $_params = array(
		'register_url'        => '/register',
		'profile_url'         => '/personal',
		'recover_password_url'=> false,
	    'template'            => 'default.twig',
		'authorized_redirect' => false,
    ); 

	protected function init()
	{
		if (isset($_POST['UserAuth']))
		{
			$_POST['email'] = $_POST['login'];
			$this->login = $_POST['login'];
			$result = $this->application->getAuth()->authenticate(new \Cetera\UserAuthAdapter($_POST)); 
			switch ($result->getCode()) {
				case \Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
					$this->login_error = 'Пользователь не найден';
					break;
			
				case \Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
					$this->password_error = 'Неправильный пароль';
					break;
			}			
		}
		
		if ($this->application->getUser() && $this->getParam('authorized_redirect'))
		{
			header('Location: '.$this->getParam('authorized_redirect'));
			die();
		}
	}	
      
}