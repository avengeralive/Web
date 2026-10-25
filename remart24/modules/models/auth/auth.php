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
        $table = Backstage::gi()->db_table_prefix.'users a';

		$this->data['item'] = $this->dbmanager->tables($table)
											->fields('*')
											->where('lower(login) = "'.strtolower($this->data['request']->parameters['login']).'" and password = "'.$this->data['request']->parameters['password'].'" and status = 1')
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
				if ($ldap){
					$login = strtolower($this->data['request']->parameters['login']).Backstage::gi()->ldapdomain;
					$bind = false;
					$bind = ldap_bind($ldap,$login,$this->data['request']->parameters['password']);


					if ($bind and $this->data['request']->parameters['password']!='') // IF authentification is ok
					{
						//**************** LOGGING HERE *********************
						// error_log("Connected to LDAP, cheking user ",0);

						$filter = "(SAMAccountName=" . strtolower($this->data['request']->parameters['login']) . ")";
						$attr = array( "sn", "cn","displayname","givenname","mail");

						$sr=ldap_search($ldap,Backstage::gi()->ldapbase,$filter,$attr);
						$info = ldap_get_entries($ldap, $sr);

						//**************** LOGGING HERE ********************* 
						//error_log($info[0]['givenname'][0],0);

						// IF SUCCESS check user in wacis 
						$this->data['item'] = $this->dbmanager->tables($table)
													->fields('*')
													->where('lower(login) = "'.strtolower($this->data['request']->parameters['login']).'" ')
													->getScalar();
						if (!$this->data['item'])
						{
							// IF NO, INSERT to users table **************** LOGGING HERE *********************
							// error_log("There is no user, inserting to users table",0);
							$this->dbmanager->tables(Backstage::gi()->db_table_prefix.'users')
											->values(array('login'=>strtolower($this->data['request']->parameters['login']),'password'=>$this->data['request']->parameters['password'],'name'=>$info[0]['givenname'][0],'surname'=>$info[0]['sn'][0],'email'=>$info[0]['mail'][0],'ldap_user'=>1))
											->insert();
							// $this->dbmanager->getLastID() , Backstage::gi()->user_group_id
							// Assign role users to user 
							$this->dbmanager->tables(Backstage::gi()->db_table_prefix.'user_grants')
											->values(array("user_id"=>$this->dbmanager->getLastID(),"role_id"=>Backstage::gi()->user_group_id))
											->insert();

							if (Backstage::gi()->track_user_activity)			
								Arhlog::commit('users', 'auth',  $hash_group, null, 'i', 'id='.$this->dbmanager->getLastID());
						}

						// FILL COOKIES
						// error_log("User ok, filling cookies ",0);
						$_SESSION['userDisplayName'] = $info[0]['displayname'][0];
						// error_log("Full name=".Backstage::gi()->fullUserName,0);
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

    public function getUserStatus(){

    	$table = Backstage::gi()->db_table_prefix.'users a';

    	$data = $this->dbmanager->tables($table)
				->fields('status')
				->where('lower(login) = "'.strtolower($this->data['auth_login']).'"')
				->getScalar();	
		return $data;
    }
}