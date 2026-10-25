<?php

/**
 * @package    filterChain
 *
 * @copyright  Copyright (C) 2014  Rinat Gazikhanov, Vusal Khalilov, BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
 
class mPretorian extends model
{
	function check()
	{		
		$grant_types = implode('","',(array)$this->data['grant_types']);
		if ($this->data['check_type'] === 'p')
		{
			if ($this->data['action'] != '')
			{
				$resource_type = "actions";
				$additional_where = ' and action_name = "'.$this->data['action'].'"';
			}
			else {
				$resource_type = "modules";
				$additional_where = '';
			}
			$sql = '(select c.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b, '.Backstage::gi()->db_table_prefix.'role_grants c where g.id = c.grant_id and UPPER(g.resource_name) = UPPER("'.$this->data['resource_name'].'") and g.grant_type in ("'.$grant_types.'") and g.resource_type = "'.$resource_type.'"'.$additional_where.' 
									and a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.role_id = c.role_id and c.pack_id is null
								union all 
							select d.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b, '.Backstage::gi()->db_table_prefix.'role_grants c, '.Backstage::gi()->db_table_prefix.'grants_packs_ref d where g.id = d.grant_id and UPPER(g.resource_name) = UPPER("'.$this->data['resource_name'].'") and g.grant_type in ("'.$grant_types.'") and g.resource_type = "'.$resource_type.'"'.$additional_where.'
									and a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.role_id = c.role_id and c.pack_id = d.pack_id and c.grant_id is null
								union all 
							select b.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b where g.id = b.grant_id and UPPER(g.resource_name) = UPPER("'.$this->data['resource_name'].'") and g.grant_type in ("'.$grant_types.'") and g.resource_type = "'.$resource_type.'"'.$additional_where.'
									and a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.grant_id is not null 
								union all 
							select c.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b, '.Backstage::gi()->db_table_prefix.'grants_packs_ref c where g.id = c.grant_id and UPPER(g.resource_name) = UPPER("'.$this->data['resource_name'].'") and g.grant_type in ("'.$grant_types.'") and g.resource_type = "'.$resource_type.'"'.$additional_where.'
									and a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.pack_id = c.pack_id and b.grant_id is null and b.role_id is null
								union all 
							select b.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'roles a, '.Backstage::gi()->db_table_prefix.'role_grants b where g.id = b.grant_id and UPPER(g.resource_name) = UPPER("'.$this->data['resource_name'].'") and g.grant_type in ("'.$grant_types.'") and g.resource_type = "'.$resource_type.'"'.$additional_where.'
									and a.role_name = "Public" and a.id = b.role_id
								union all 
							select c.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'roles a, '.Backstage::gi()->db_table_prefix.'role_grants b, '.Backstage::gi()->db_table_prefix.'grants_packs_ref c where g.id = c.grant_id and UPPER(g.resource_name) = UPPER("'.$this->data['resource_name'].'") and g.grant_type in ("'.$grant_types.'") and g.resource_type = "'.$resource_type.'"'.$additional_where.'
									and a.role_name = "Public" and a.id = b.role_id and c.pack_id = b.pack_id) pre';
									
			$this->data['check_count'] = $this->dbmanager->tables('(select c.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b, '.Backstage::gi()->db_table_prefix.'role_grants c where g.id = c.grant_id and UPPER(g.resource_name) = UPPER("'.$this->data['resource_name'].'") and g.grant_type in ("'.$grant_types.'") and g.resource_type = "'.$resource_type.'"'.$additional_where.' 
									and a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.role_id = c.role_id and c.pack_id is null
								union all 
							select d.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b, '.Backstage::gi()->db_table_prefix.'role_grants c, '.Backstage::gi()->db_table_prefix.'grants_packs_ref d where g.id = d.grant_id and UPPER(g.resource_name) = UPPER("'.$this->data['resource_name'].'") and g.grant_type in ("'.$grant_types.'") and g.resource_type = "'.$resource_type.'"'.$additional_where.'
									and a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.role_id = c.role_id and c.pack_id = d.pack_id and c.grant_id is null
								union all 
							select b.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b where g.id = b.grant_id and UPPER(g.resource_name) = UPPER("'.$this->data['resource_name'].'") and g.grant_type in ("'.$grant_types.'") and g.resource_type = "'.$resource_type.'"'.$additional_where.'
									and a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.grant_id is not null 
								union all 
							select c.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b, '.Backstage::gi()->db_table_prefix.'grants_packs_ref c where g.id = c.grant_id and UPPER(g.resource_name) = UPPER("'.$this->data['resource_name'].'") and g.grant_type in ("'.$grant_types.'") and g.resource_type = "'.$resource_type.'"'.$additional_where.'
									and a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.pack_id = c.pack_id and b.grant_id is null and b.role_id is null
								union all 
							select b.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'roles a, '.Backstage::gi()->db_table_prefix.'role_grants b where g.id = b.grant_id and UPPER(g.resource_name) = UPPER("'.$this->data['resource_name'].'") and g.grant_type in ("'.$grant_types.'") and g.resource_type = "'.$resource_type.'"'.$additional_where.'
									and a.role_name = "Public" and a.id = b.role_id
								union all 
							select c.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'roles a, '.Backstage::gi()->db_table_prefix.'role_grants b, '.Backstage::gi()->db_table_prefix.'grants_packs_ref c where g.id = c.grant_id and UPPER(g.resource_name) = UPPER("'.$this->data['resource_name'].'") and g.grant_type in ("'.$grant_types.'") and g.resource_type = "'.$resource_type.'"'.$additional_where.'
									and a.role_name = "Public" and a.id = b.role_id and c.pack_id = b.pack_id) pre')
			->count();
			
			if ($this->data['resource_id'] > 0)
				$this->data['check_count'] += $this->dbmanager->tables('(select c.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b, '.Backstage::gi()->db_table_prefix.'role_grants c where g.id = c.grant_id and g.resource_id = '.$this->data['resource_id'].' and g.resource_type = "'.$this->data['resource_name'].'" and g.grant_type in ("'.$grant_types.'")
									and a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.role_id = c.role_id and c.pack_id is null
								union all 
							select d.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b, '.Backstage::gi()->db_table_prefix.'role_grants c, '.Backstage::gi()->db_table_prefix.'grants_packs_ref d where g.id = d.grant_id and g.resource_id = '.$this->data['resource_id'].' and g.resource_type = "'.$this->data['resource_name'].'" and g.grant_type in ("'.$grant_types.'")
									and a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.role_id = c.role_id and c.pack_id = d.pack_id and c.grant_id is null
								union all 
							select b.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b where g.id = b.grant_id and g.resource_id = '.$this->data['resource_id'].' and g.resource_type = "'.$this->data['resource_name'].'" and g.grant_type in ("'.$grant_types.'")
									and a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.grant_id is not null 
								union all 
							select c.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b, '.Backstage::gi()->db_table_prefix.'grants_packs_ref c where g.id = c.grant_id and g.resource_id = '.$this->data['resource_id'].' and g.resource_type = "'.$this->data['resource_name'].'" and g.grant_type in ("'.$grant_types.'")
									and a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.pack_id = c.pack_id and b.grant_id is null and b.role_id is null
								union all 
							select b.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'roles a, '.Backstage::gi()->db_table_prefix.'role_grants b where g.id = b.grant_id and g.resource_id = '.$this->data['resource_id'].' and g.resource_type = "'.$this->data['resource_name'].'" and g.grant_type in ("'.$grant_types.'")
									and a.role_name = "Public" and a.id = b.role_id
								union all 
							select c.grant_id from '.Backstage::gi()->db_table_prefix.'grants g, '.Backstage::gi()->db_table_prefix.'roles a, '.Backstage::gi()->db_table_prefix.'role_grants b, '.Backstage::gi()->db_table_prefix.'grants_packs_ref c where g.id = c.grant_id and g.resource_id = '.$this->data['resource_id'].' and g.resource_type = "'.$this->data['resource_name'].'" and g.grant_type in ("'.$grant_types.'")
									and a.role_name = "Public" and a.id = b.role_id and c.pack_id = b.pack_id) pre')
				->count();
		}
		elseif ($this->data['check_type'] === 'f' && $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'grant_resource_types')->where('resource_type = "'.$this->data['resource_name'].'"')->count() > 0)
			$this->data['check_count'] = $this->dbmanager->tables('(select * from (select id from `'.Backstage::gi()->db_table_prefix.'grants` where resource_id = '.$this->data['resource_id'].' and resource_type = "'.$this->data['resource_name'].'"'.
			'and grant_type in ("'.implode('","',(array)$this->data['grant_types']).'")) aa where aa.id IN '. 
			'(select c.grant_id from '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b, '.Backstage::gi()->db_table_prefix.'role_grants c where a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id '.
			'and b.role_id = c.role_id '.
			'union all '.
			'select b.grant_id from '.Backstage::gi()->db_table_prefix.'users a, '.Backstage::gi()->db_table_prefix.'user_grants b where a.login = "'.Backstage::gi()->user->login.'" and a.id = b.user_id and b.grant_id is not null '.
			'union all '.
			'select b.grant_id from '.Backstage::gi()->db_table_prefix.'roles a, '.Backstage::gi()->db_table_prefix.'role_grants b where a.role_name = "Public" and a.id = b.role_id)) bbb'
			)
			->count();
		else 
			$this->data['check_count'] = 1;
		return $this->data;
	}	
}