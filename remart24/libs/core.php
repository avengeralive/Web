<?php

/**
 * @package    front
 *
 * @copyright  Copyright 2014, 2015 Rinat Gazikhanov, Vusal Khalilov, BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
 
class Core 
{
	private $data = array();
	private $request;
	private $dont_force = false;
	
	function __construct() 
	{
			// Child directories
		define('TEMPLATE_DIR', TEMPLATES_DIR.Backstage::gi()->template_name.DR);
		define('ADMIN_TEMPLATE_DIR', TEMPLATES_DIR.'admin'.DR.Backstage::gi()->admin_template_name.DR);
		define('CONTROLLERS_DIR', MODULES_DIR.'controllers'.DR);
		define('MODELS_DIR', MODULES_DIR.'models'.DR);
		define('VIEWS_DIR', MODULES_DIR.'views'.DR);
		
		$this->request = new stdClass();

			//	Processing the URLs 
		Backstage::gi()->portal_url = $this->processURLs();
		Backstage::gi()->portal_url_wo_domain = str_replace(strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['HTTP_HOST'], '', Backstage::gi()->portal_url);
				
			// If there is a mark of not installed files run the installer
		if (Backstage::gi()->portal_installed === 0) 
		{
			header("Location: ".Backstage::gi()->portal_url."install");
			exit();
		}		
		
		define('MATERIALS_URL', str_replace(ROOT_DIR, Backstage::gi()->portal_url, MATERIALS_DIR));                
		define('EXTERNAL_URL', str_replace(ROOT_DIR, Backstage::gi()->portal_url, EXTERNAL_DIR));                
		define('TEMPLATE_URL', str_replace(ROOT_DIR, Backstage::gi()->portal_url, TEMPLATE_DIR));
		define('ADMIN_TEMPLATE_URL', str_replace(ROOT_DIR, Backstage::gi()->portal_url, ADMIN_TEMPLATE_DIR));
        define('VIEWS_URL', str_replace(ROOT_DIR, Backstage::gi()->portal_url, VIEWS_DIR));

		Backstage::gi()->DR = DR;
		Backstage::gi()->ROOT_DIR = ROOT_DIR;
		Backstage::gi()->LIBS_DIR = LIBS_DIR;
		Backstage::gi()->CONFIG_DIR = CONFIG_DIR;
		Backstage::gi()->LANGS_DIR = LANGS_DIR;
		Backstage::gi()->EXTERNAL_DIR = EXTERNAL_DIR;
		Backstage::gi()->MODULES_DIR = MODULES_DIR;
		Backstage::gi()->TEMPLATES_DIR = TEMPLATES_DIR;
		Backstage::gi()->TEMPLATE_DIR = TEMPLATE_DIR;
		Backstage::gi()->ADMIN_TEMPLATE_DIR = ADMIN_TEMPLATE_DIR;
		Backstage::gi()->CGI_DIR = CGI_DIR;
		Backstage::gi()->MATERIALS_DIR = MATERIALS_DIR;

		Backstage::gi()->CONTROLLERS_DIR = CONTROLLERS_DIR;
		Backstage::gi()->MODELS_DIR = MODELS_DIR;
		Backstage::gi()->VIEWS_DIR = VIEWS_DIR;

		Backstage::gi()->MATERIALS_URL = MATERIALS_URL;
		Backstage::gi()->EXTERNAL_URL = EXTERNAL_URL;
		Backstage::gi()->TEMPLATE_URL = TEMPLATE_URL;
		Backstage::gi()->ADMIN_TEMPLATE_URL = ADMIN_TEMPLATE_URL;
		Backstage::gi()->VIEWS_URL = VIEWS_URL;

		$_SESSION['EXTERNAL_URL'] = EXTERNAL_URL;
		$_SESSION['EXTERNAL_DIR'] = EXTERNAL_DIR;
		
		$url_parts = explode(Backstage::gi()->portal_url, Backstage::gi()->full_url);
		$url_parts = explode('?', $url_parts[1]);
		
			// Don't force exception cases
		if (preg_match('/^pages\/repository(\/[0-9]+\/[0-9]+\/[0-9]+)?$/', $url_parts[0]) && isset($_GET['search_name']))
			$this->dont_force = true;		
		
	    if (preg_match('/^auth\/login$/', $url_parts[0]) && isset($_GET['login']))
			$this->dont_force = true;		
			
			// Let's run initiation
		$this->run();
	}

	private function run() 
	{
		// Parse the request, make first data and pass it to the filter chain in next steps
		try
		{
			$this->data = $this->parseRequest();
		}
			// Let's catch any qBit exception and return it with responser
		catch (QException $e)
		{
			$this->data['excepion'] = new stdClass();
			$this->data['excepion']->message = $e;
			$this->data['excepion']->code = $e->getErrorCode();
		}
		catch (Exception $e)
		{
			throw $e;
		}
		new Responser($this->data);
	}
	
	/**
	 * Used to process current URL and correctly match it to the configured URLs
	 *
	 * @return string $portal_url
	 */	
	private function processURLs()
	{
		$portal_url = '';
		$this->request->full_url = $this->getFullURL(true);
		Backstage::gi()->full_url = $this->request->full_url;			
		Backstage::gi()->portal_urls = explode(',', Backstage::gi()->portal_urls); 
		foreach (Backstage::gi()->portal_urls as $url)
		{
			if (strpos($this->request->full_url, $url) === 0)
				$portal_url = $url;
		}		
		return $portal_url;
	}
	
	private function forceRequest($input, $url_strip = false, $tags_strip = false)
	{		
		if ($this->dont_force)
			return $input;
		if (is_array($input))
		{
			foreach ($input as &$input_el)
			{
				$input_el = $this->forceRequest($input_el, $url_strip, $tags_strip);
			}
			return $input;
		}
		else
		{			
			if ($url_strip)				
				$input = str_ireplace(array("\0", '%00', "\x0a", '%0a', "\x1a", '%1a'), '', urldecode($input));
			if ($tags_strip) 
				$input = strip_tags($input);
			// or whatever encoding you use instead of utf-8
			$input = preg_replace("/[^\w\/\?\&\.=,]+/", "-", $input);	// replace all non-secure symbols with "-"
			//$input = htmlspecialchars($input, ENT_QUOTES, 'utf-8');
			return trim($input);		
		}
	}
		// Get full url address (http://www.name.com/urlpart1/urlpart2?get_params)
	private function getFullURL($strip = true) 
	{
		return 'http'.(($_SERVER['SERVER_PORT'] == '443') ? 's' : '').'://'. $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	}		
	
	private function parseRequest()
	{
			// Defining type of the request
		$this->request->method = $_SERVER['REQUEST_METHOD'];		
		switch($this->request->method)  
		{
			case 'GET':  
				$this->request->parameters = $this->forceRequest($_GET, false, true);
				break;  
			case 'POST':  
				$this->request->parameters = $_POST;
				break;  
			case 'PUT':  
				parse_str(file_get_contents('php://input'), $this->request->parameters);
				break;
			case 'DELETE':  
				parse_str(file_get_contents('php://input'), $this->request->parameters);
				break;  
			default:  
				throw new QException(array('ER-00006', $this->request->method));
		}

			// Parsing the URL
		$this->parseURL();
		$this->request->request_url = $this->request->module_name.'/'.$this->request->action_name.'/';
		Backstage::gi()->request_url = $this->request->request_url;
			// Route ajax requests
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')
		{
				// AJAX ROUTING
			$this->request->routing = 'ajax';
		}
		else
		{
				// NON-AJAX ROUTING
			$this->request->routing = 'static';
		}
		
			// Identify user data
		$this->request->user = $this->getUserData();
		Backstage::gi()->user = $this->request->user;
		Backstage::gi()->login = $this->request->user->login;

			// Identify language		
		Backstage::gi()->portal_current_lang = $this->getCurrentLang();
		$data['request'] = $this->request;
		return $data;
	}

	
		// Parse full URL to an array
	private function parseURL()
	{	
			// Get clean url address (from the address string or shell) (urlpart1/urlpart2)
		$this->request->clean_url = $this->getCleanURL();	
		Backstage::gi()->clean_url = $this->request->clean_url;	
		$this->request = Router::gi()->mapURL($this->request);
		Backstage::gi()->parent_module_name = $this->request->module_name;
		Backstage::gi()->parent_action_name = $this->request->action_name;
		Backstage::gi()->parent_parameters = $this->request->parameters;
	}	
		
		// Get clean URL (e.g. urlpart1/urlpart2?get_params)
	private function getCleanURL()
	{
		global $argc, $argv;	// Global variables used when qBit is running as a daemon process
	
		if (@$argc > 1)
			$clean_url = $argv[1];
		else
		{
			$curr_url = explode(Backstage::gi()->portal_url, $this->request->full_url);
			$curr_url = $curr_url[1];
		}
		if ($curr_url=='' || $curr_url=='/') return '';		// Clean URL is empty in this case
		$clean_url = $this->toValidURL($curr_url);			// Format URL string from unnecessary symbols
		$first_symb = substr($curr_url,0,1);
		if ($first_symb=='/')
			$curr_url = substr($curr_url,1);
		$last_symb = substr($clean_url,-1);
		if ($last_symb=='/')
			$clean_url = substr($clean_url,0,-1);
		return $clean_url;
	}
	
		// Format URL string from unnecessary symbols (e.g. http://www.name.com//subname??param/// -> http://www.name.com/subname--param/)
	private function toValidURL($curr_url)
	{
		$edited_url = $this->forceRequest($curr_url, true, true);	// replace all non-secure symbols with "-"				
		$edited_url = trim($edited_url);
		if ($edited_url=='' || $edited_url=='/') return '';
			// Clean unwanted '/'-es
		if (!strstr($edited_url,'/'))
		{
			$new_url_arr[] = $edited_url;
		} 
		else 
		{
			$url_arr = explode('/', $edited_url);
			foreach($url_arr as $url_item) 
			{
				if($url_item != '')
					$new_url_arr[] = $url_item;
			}
		}
		$edited_url = implode('/',$new_url_arr);
		$last_item_index = count($new_url_arr)-1;
		$last_url_item = $new_url_arr[$last_item_index] ;
		if (!strstr($last_url_item, '.'))
		{
			$edited_url = $edited_url.'/';
		}
		return $edited_url;
	}	
	
	private function verifyCookie() 
	{
		if (!isset($_COOKIE['AUTH']) || empty($_COOKIE['AUTH']))
			return false;

		list($login, $expiration, $hmac) = explode('|', $_COOKIE['AUTH']);

		$expired = $expiration;

		if ($expired < time())
			return false;

		$key = hash_hmac('md5', $login . $expiration, 'blabla');
		$hash = hash_hmac('md5', $login . $expiration, $key);

		if ($hmac != $hash)
			return false;
		return $login;
	}	
	
	private function getUserData()
	{
		$user_data = new stdClass();
		if ($login = $this->verifyCookie())
		{
			$data = $this->getUserStatus($login);
			
			if(isset($data->status) && $data->status == 1){
				$user_data->login = $login;
			}
			else{
				unset($_COOKIE['AUTH']);
    			setcookie('AUTH', null, -1 ,Backstage::gi()->portal_url_wo_domain);

				$user_data->login = '';
				$user_data->password = '';			
			}

		}
		else
		{
			$user_data->login = '';
			$user_data->password = '';			
		}
		/*
		if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']))
		{
			$user_data->login = '';
			$user_data->password = '';
		}
		else
		{
			$user_data->login = $_SERVER['PHP_AUTH_USER'];
			//$user_data->password = $_SERVER['PHP_AUTH_PW'];
		}
		*/
		return $user_data;
	}
	
	private function getCurrentLang()
	{
        $portal_langs = explode(',', Backstage::gi()->portal_langs);
		if (isset($this->request->parameters['lang']) && in_array($this->request->parameters['lang'], $portal_langs))
		{
			setcookie("portal_current_lang", $this->request->parameters['lang'], time() + 864000, Backstage::gi()->portal_url_wo_domain);
			$current_lang = strtolower($this->request->parameters['lang']);
		}
		else
		{
			if (!isset($_COOKIE['portal_current_lang']))
			{
				setcookie("portal_current_lang", Backstage::gi()->portal_default_lang, time() + 864000, Backstage::gi()->portal_url_wo_domain);
				$current_lang = Backstage::gi()->portal_default_lang;
			}
			else
                $current_lang = $_COOKIE['portal_current_lang'];
		}

        return $current_lang;
	}

	private function getUserStatus($login)
    {
        $data['module_name'] = 'auth';
        $data['model_name'] = 'auth';
        $data['action_name'] = 'getUserStatus';
        $data['auth_login'] = $login;
        $data = Loader::gi()->getModel($data);
        return $data;
    }
}
