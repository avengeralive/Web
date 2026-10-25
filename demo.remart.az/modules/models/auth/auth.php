<?php

/**
 * @package    MVC
 *
 * @copyright  Copyright (C) 2017  Rinat Gazikhanov, Vusal Khalilov, Elshan Akhundov BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
class mAuth extends model
{
    public function login()
    {
        $hash_group = base64_encode(date("Y-m-d H:i:s").'auth');
    	//****************************** LOGGING HERE ****************************************
    	// error_log("Begining authentification, user-".strtolower($this->data['request']->parameters['login']),0);
        $table = Backstage::gi()->db_table_prefix.'users a, user_meta b';

		$this->data['item'] = $this->dbmanager->tables($table)
											->fields('*')
											->where('((lower(a.login) = "'.strtolower($this->data['request']->parameters['login']).'") or (CONCAT("0", SUBSTRING(b.mobile, 5)) = "'.strtolower($this->data['request']->parameters['login']).'") and b.user_id = a.id) and password = "'.md5($this->data['request']->parameters['password']).'"')
											->getScalar();
											
	    $_SESSION['userDisplayName'] = $this->data['request']->parameters['login'];								
        
        // If not successful login 
        
        if (!$this->data['item'])
		{
				// CHECK IF LDAP IS ON 
			if (Backstage::gi()->authentication_type=='ldap') 
			{
			   	$ldap = ldap_connect(Backstage::gi()->ldaphost,Backstage::gi()->ldapport) or die("Cant connect to LDAP Server");
			   	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
			        // IF ON LDAP BIND 
				if ($ldap)
				{
					$login = strtolower($this->data['request']->parameters['login']).Backstage::gi()->ldapdomain;
					$bind = false;
					$bind = ldap_bind($ldap,$login,$this->data['request']->parameters['password']);

					if ($bind and $this->data['request']->parameters['password']!='') // IF authentification is ok
					{
						//$ldap_dn = "OU=AZERCELL,DC=azercell,DC=com";
						$filter = "(SAMAccountName=" . strtolower($this->data['request']->parameters['login']) . ")";
						$attr = array( "sn", "cn","displayname","givenname","mail");

						$sr=ldap_search($ldap,Backstage::gi()->ldapbase,$filter,$attr);
						$info = ldap_get_entries($ldap, $sr);
						
						// IF SUCCESS check user in wacis 
						$this->data['item'] = $this->dbmanager->tables($table)
									->fields('*')
									->where('lower(login) = "'.strtolower($this->data['request']->parameters['login']).'" ')
									->getScalar();
						if (!$this->data['item'])
						{
							// IF NO, INSERT to users table
						
							$this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
										->values(array('login'=>strtolower($this->data['request']->parameters['login']),'password'=>md5($this->data['request']->parameters['password']),'name'=>$info[0]['givenname'][0],'surname'=>$info[0]['sn'][0],'email'=>$info[0]['mail'][0]))
										->insert();
										
							if (Backstage::gi()->track_user_activity)			
								Arhlog::commit('users', 'auth',  $hash_group, null, 'i', 'id='.$this->dbmanager->getLastID());
						}

							// FILL COOKIES
						$_SESSION['userDisplayName'] = $info[0]['displayname'][0];								
						$this->data['item'] = $this->dbmanager->tables($table)
							->fields('*')
							->where('lower(login) = "'.strtolower($this->data['request']->parameters['login']).'" ')
							->getScalar();			
				   }
				   ldap_unbind($ldap);
				}
			}
		} 
		
        return $this->data;
    }
    
    public function getNameAndSurnameByLogin(){
	
	$login = (isset($this->data['request']->parameters['login'])?$this->data['request']->parameters['login']:null);
	if ($login!=null){
		$params = array ('login'=>$login);
		$this->data['body'] = $this->dbmanager->selectByQuery(Queries::gi()->getQuery('get_name_and_surname_by_login', $params));
	 if (empty($this->data['body'])) {
		$this->data['body'] = $login;
	}		
	}
	else{
		$this->data['body'] = 'Login is not specified';
	}
		
	return $this->data;
		    	
    }
}