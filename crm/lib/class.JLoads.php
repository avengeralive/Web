<?php 
namespace lib;
if (!defined('VOCU_FWK')) die('не работает без нашего фреймверка'); // не работает без нашего фреймверка

/**
* class.JLoads.php
*
*Класс - библиотека с функциями  и основными настройками
*подгружается через автоподгрузку классов
*
* История:  2016.12.20 - файл создан
*
**/
class JLoads {
	
	public static $cdn = 'https://' . DOMAIN . '/cdn/' . DOMAIN . '';
	public static $cdnjs = 'https://' . DOMAIN . '/cdn/' . DOMAIN . '/script';
	public static $cdncss = 'https://' . DOMAIN . '/cdn/' . DOMAIN . '/css';

    public static $db = 'crm';
    public static $DIRHOME = '/var/www/crm';
    public static $blocktime;
    
	public static $rand_cod = '';
	public static $wad_md5 = '';
	public static $user_id = 0;
	public static $cap = '';
	
	public static $CDN = "local";
	public static $cdnpath = '/var/www/crm';
	public static $cdnhost = DOMAIN;
	public static $cdnuser = SSH_LOGIN;
	public static $cdnpass = SSH_PASSWORD;
	public static $cdnport = SSH_PORT;
	
	public static $host_db = '10.8.0.1';
	public static $user_db = MYSQL_LOGIN;
	public static $password_db = MYSQL_PASSWORD;
	
	public static $page = false;
    
    public static function loadClassFrom($class_name) {
    	switch($class_name) {
    		case 'COTFW_settings':
    			$a = new COTFW_settings();
    			return $a;
    		break;	
    	}
    }

	public static function initJSON() {

		foreach ($_COOKIE as $name => $value) {
			if(substr($name, 0, 7) == 'wadmin_') {
				self::$rand_cod = $name;
				self::$wad_md5  = $value;

				if(isset($_GET['token'])) $token = $_GET['token'];
				if(isset($_POST['token'])) $token = $_POST['token'];


				if (isset($token) && CUser::user($token) == 'wadmin_' . self::$wad_md5) {
					//self::$cap = $_SESSION['guest']['cap'];
				} else {
					$id = JBase::Get_Id('session_users', ['rand_cod' => self::$rand_cod, 'wad_md5' => self::$wad_md5]);
					self::$cap = JBase::Get_Field_Value_From_Id('session_users', $id, 'cap');
				}

			}
		}
	}    
    
    
}
