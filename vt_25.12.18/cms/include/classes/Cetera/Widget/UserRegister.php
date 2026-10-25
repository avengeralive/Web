<?php
namespace Cetera\Widget; 

/**
 * Виджет "Форма регистрации пользователя"
 * 
 * @package CeteraCMS
 */ 
class UserRegister extends Templateable {
	
	public $post = null;	
	public $login_error = null;
	public $email_error = null;
	public $password_error = null;
	public $password2_error = null;
		
    protected $_params = array(
		'unique_email' => false,
	    'template'     => 'default.twig',
    ); 

	protected function init()
	{
		if (isset($_POST['UserRegister']))
		{
			$this->post = $_POST;
			
			if ($this->getParam('unique_email'))
			{
				$u = \Cetera\User::getByEmail($_POST['email']);
				if ($u)
				{
					$this->email_error = 'Пользователь с таким e-mail уже зарегистрирован';
					return;
				}
			}
			
			if ($_POST['password'] != $_POST['password2'])
			{
				$this->password_error = 'Пароли не совпадают';
				return;
			}
			
			$u = \Cetera\User::create();
			$u->setFields($_POST);
			try
			{
				$u->save();
				$result = $this->application->getAuth()->authenticate(new \Cetera\UserAuthAdapter( array(
					'login' => $_POST['login'],
					'pass'  => $_POST['password'],
				) )); 			
				
				header('Location: /');
				die();
			}
			catch (\Cetera\Exception\Form $e)
			{
				$field = $e->field.'_error';
				$this->$field = $e->getMessage();
				return;
			}
		}
		
	}	
      
}