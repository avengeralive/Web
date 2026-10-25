<?php

/**
 * @package    router
 *
 * @copyright  Copyright 2015 Rinat Gazikhanov, Vusal Khalilov, BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
 
class Router
{	
    protected static $instance = null;  // object instance
	
    private function __construct() {  }
    private function __clone()     {  }
    private function __wakeup()    {  }
	
    public static function gi() 
    {
        if (is_null(self::$instance)) 
		{
            self::$instance = new Router;
        }
        return self::$instance;
    }
		
	public function mapURL($request)
	{
		$routs_file = file(Backstage::gi()->LIBS_DIR.'routs.inc.php');
		$request->data_type = Backstage::gi()->default_data_type;
	
		$url_parts = explode('?', $request->clean_url);
			// Parameters url after ? 
		Backstage::gi()->parameters_url = '';
		if (isset($url_parts[1]))
			Backstage::gi()->parameters_url = $request->parameters_url = $url_parts[1];

			// Look up for any URL match
		foreach ($routs_file as $route)
		{
			$route_parts = explode('|', $route);
			$route = $route_parts[0];
			$pattern = "@^".preg_replace('/\\\:[a-zA-Z0-9\_\-\=]+/', '([a-zA-Z0-9\-\_\=]+)', trim(preg_quote($route)))."(\.[a-zA-Z0-9\-\_]+)?$@D";	
			//$pattern = "@^".preg_replace('/\\\:[a-zA-Z0-9\_\-\=]+/', '([a-zA-Z0-9\-\_\=]+)', trim(preg_quote($route)))."$@D";	
			$matches = array();
			//echo $pattern.'<br/>';
			if (preg_match($pattern, $url_parts[0], $matches))
			{
				if (strpos($matches[(count($matches)-1)],'.') === 0)
				{
					$request->data_type = str_replace('.', '', array_pop($matches));
				}
				array_shift($matches);
				$temp_names = explode(',', $route_parts[1]);
				$request->module_name = trim(array_shift($temp_names));
				$request->action_name = trim(array_shift($temp_names));
				if (strstr($request->clean_url, '?'))
					parse_str($url_parts[1], $request->parameters);
				$offset = 0;
				foreach ($temp_names as $key=>$name)
				{
						// Override the value of the variable if the "=" sign is given
					if (strpos($name, '='))
					{
						$name_parts = explode('=', $name);						
						$request->parameters[trim($name_parts[0])] = $name_parts[1];
						$offset += 1;
					}
					else
					{
						$request->parameters[trim($name)] = $matches[$key - $offset];
					}
				}

				return $request;
			}
		}
			
			// If there is no RESTful matching use the classic schema
		$url_arr = explode('/', $url_parts[0]);
				
			// Module and action names
		if ($request->clean_url == '' || $request->clean_url[0]=='?')
		{
			$url_arr[0] = Backstage::gi()->default_module_name;
			$url_arr[1] = Backstage::gi()->default_action_name;			
		}
		
		if (empty($url_arr[0]))
			throw new QException(array('ER-00002'));
			
		$request->module_name = $url_arr[0];
			
			// Action name - parsed from the url as action{.data_type} where data_type could be json, xml and etc (default is text).
			// If action name is empty we should use the request method and data_type is taken from the module name as module{.data_type}
		if (empty($url_arr[1]))
		{
			$request->action_name = strtolower($request->method);
			if (strstr($request->module_name, '.'))
			{
				$module_name_parts = explode('.', $request->module_name);
				$request->module_name = $module_name_parts[0];
				$request->data_type = $module_name_parts[1];
			}			
		}
		else
		{
			$request->action_name = $url_arr[1];		
			if (strstr($request->action_name, '.'))
			{
				$action_name_parts = explode('.', $request->action_name);
				$request->action_name = $action_name_parts[0];
				$request->data_type = $action_name_parts[1];
			}
		}

		return $request;
	}
}