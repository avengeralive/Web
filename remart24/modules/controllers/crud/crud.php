<?php
class cCrud extends controller
{	
	public function execute()
	{
		$this->data['view_name'] = 'crud';
		$this->data['body'] = Loader::gi()->getView($this->data);

		return $this->data;
	}	

	public function load()
	{
			// Get crud native parameters data
		$crud_params_form = json_decode($this->data['request']->parameters['crud_params_form'], true);
		$crud_data = json_decode(base64_decode($this->data['request']->parameters['crud_data']), true);

		$this->data = array_merge($this->data, $crud_data);
		$this->data = array_merge($this->data, $crud_params_form);
		
			// Parse field processors
		if (isset($this->data['request']->parameters['form_type']))
		{
			$field_processors_parsed = array();
			foreach($this->data['field_processors'] as $field=>$processor)		
			{
				$row_id = isset($this->data['request']->parameters['row_id'])?$this->data['request']->parameters['row_id']:0;				
				$field_processors_parsed[$field] = new stdClass();
				$processor_data = Loader::gi()->callModule('GET', $processor, array('crud_name'=>$this->data['name'], 'field_name'=>$field, 'row_id'=>$row_id));
				$field_processors_parsed[$field]->body = $processor_data['body'];
			}
			$this->data['field_processors'] = $field_processors_parsed;
		}
		
			// Parse the additional data only if we select the whole crud data
			
		if (!isset($this->data['request']->parameters['row_id']))
		{
				// Get data from sources for the mapped fields
			foreach($this->data['mapped_field_inputs'] as $inputs_key=>$field_inputs)
			{
				$field_input_part1 = substr($field_inputs, 0, strpos($field_inputs, ':'));
				$field_input_part2 = json_decode(substr($field_inputs, strpos($field_inputs, ':')+1),true);
				if (strtolower($field_input_part1) === 'db')
				{
					$items = Loader::gi()->callModule('GET', 'crud', array('resource_name' => $field_input_part2['table'], 'where'=> @$field_input_part2['where'], 'order' => @$field_input_part2['order'], 'group' => @$field_input_part2['group']));
					$items_arr = array();
					foreach ($items['items'] as $key => $item)
						$items_arr[$item->{$field_input_part2['id']}] = $item->{$field_input_part2['field']};

					$crud_data['mapped_field_inputs'][$inputs_key] = 'select:'.json_encode($items_arr);
				}
			}
			
			$after_load_method_path = $crud_data['after_load_method_path'];
			$this->data['db_adapter'] = $crud_data['db_adapter'];
			
				// Get search fields
			if (isset($this->data['request']->parameters['crud_search_form']))
			{
				$this->data['crud_search_form'] = json_decode($this->data['request']->parameters['crud_search_form'], true);
				$search_fields = array();
				if (!isset($this->data['crud_search_form']['search_condition']))
					$this->data['crud_search_form']['search_condition'] = 'like';
				$this->data['crud_search_condition'] = $this->data['crud_search_form']['search_condition'];
				unset($this->data['crud_search_form']['search_condition']);			
				foreach ($this->data['crud_search_form'] as $el=>$val)
				{
					if (strpos($el, '^') === 0)
						$el = str_replace('^', '', $el);
					else
						$el = str_replace('^', '.', $el);
					if ($val !== '')
					{
						if (strpos($val, ',') > 0)
						{
							$val_parts = explode(',', $val);
							$search_fields_parts = array();
							foreach ($val_parts as $val_part)
							{
								if (in_array($this->data['crud_search_condition'], array('like', 'not like')) && !in_array(substr($el, strpos($el,'.')+1), $this->data['manual_search_format']))
									$val_part = '%'.$val_part.'%';
								$search_fields_parts[] = $el.' '.$this->data['crud_search_condition'].' \''.$val_part.'\'';
							}
							$search_fields[] = ' ('.implode(' or ', $search_fields_parts).') ';
						}
						else
						{
							if (in_array($this->data['crud_search_condition'], array('like', 'not like')) && !in_array(substr($el, strpos($el,'.')+1), $this->data['manual_search_format']))
								$val = '%'.$val.'%';
							$search_fields[] = $el.' '.$this->data['crud_search_condition'].' \''.$val.'\'';
						}
					}
				}
				$this->data['search_fields'] = implode(' and ', $search_fields);
			}
		}
		
		// Model loading
		$this->data = Loader::gi()->getModel($this->data);

			// Parse the additional data and get the view only if we select the whole crud data
		if (!isset($this->data['request']->parameters['row_id']) || $this->data['request']->parameters['row_id'] == 0)
		{		
			$this->data['crud_pages_count'] = $this->data['crud_count_per_page']==0?1:ceil($this->data['crud_total_count']/$this->data['crud_count_per_page']);
			$crud_data['fields'] = $this->data['fields'];
			$this->data['crud_data'] = base64_encode(json_encode($crud_data));
			$this->data['crud_params'] = $crud_params_form;
			$this->data['view_name']  = 'crudTable';
			$this->data['body'] = Loader::gi()->getView($this->data);
			if ($after_load_method_path !== '')
				$out = Loader::gi()->callAPI('GET', Backstage::gi()->portal_url.$after_load_method_path, $this->data['request']->parameters);
		}
		else 
		{
			$this->data['body'] = $this->data['rows'];
		}
		
		return $this->data;
	}
	
	public function validateUnique()
	{
		$crud_data = json_decode(base64_decode($this->data['request']->parameters['crud_data']), true);
		$form_values = json_decode($this->data['request']->parameters['form_values'], true);
		if (isset($crud_data['mapped_fields']))
			$mapped_fields = $crud_data['mapped_fields'];
		if (isset($crud_data['ids']))
			$ids = $crud_data['ids'];

		$this->data['unique_fields'] = $crud_data['unique_fields'];

		$where = array();
		$values = array();
			// Collecting values and table names
		foreach ($form_values as $el=>$val)
		{
			$el_parts = explode('^', $el);
			$el_field = $el_parts[1];
			if (in_array($el_parts[1], $ids))
			{
				if ($val !== '' && $val > 0)
				{
					$where[$el_parts[0]] = "{$el_field} != {$val}";
				}
			}
			if (in_array($el_field, $this->data['unique_fields']))			
				$values[$el_parts[0]][$el_field] = "{$val}";
		}
		
		$this->data['values'] = $values;
		$this->data['where'] = $where;

		// Model loading
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['status'];
		
		return $this->data;		
	}
	
	public function save()
	{
		$crud_data = json_decode(base64_decode($this->data['request']->parameters['crud_data']), true);	
		$form_params = json_decode($this->data['request']->parameters['crud_params_form'], true);
		$form_values = json_decode($this->data['request']->parameters['form_values'], true);
		$files = json_decode($this->data['request']->parameters['files'], true);
		
		if (isset($crud_data['ids']))
			$ids = $crud_data['ids'];
		if (isset($crud_data['mapped_fields']))
			$mapped_fields = $crud_data['mapped_fields'];		
		$this->data['mapped_parents'] = $crud_data['mapped_parents'];
		$this->data['crud_parent_id'] = $crud_data['crud_parent_id'];
		$this->data['crud_parent_table'] = $crud_data['crud_parent_table'];
		$this->data['crud_resource_types'] = $crud_data['crud_resource_types'];
		$this->data['disabled_saving_fields'] = $crud_data['disabled_saving_fields'];
		$this->data['disabled_saving_tables'] = $crud_data['disabled_saving_tables'];
		$translations = $crud_data['translations'];
		$mapped_passwords = $crud_data['mapped_passwords'];

			// Additional access right checks
		$method = $this->data['request']->method;
		foreach ($this->data['crud_resource_types'] as $crud_resource_types)
		{
					// In future we should change this behavior in case of multi-ids
			/* NO NEED TO CHECK ACCESS RIGHTS HERE - 18.04.2017
			if (!Pretorian::gi()->check($crud_resource_types, $method, $form_values[$crud_resource_types.'^'.$ids[0]]))
			{	
				switch($method)  
				{
					case 'POST':  
						throw new QException(array('ER-00011'));
						break;  
					case 'PUT':  
						throw new QException(array('ER-00012'));
						break;
				}
			}
			*/
		}
		
		if (isset($crud_data['before_save_method_path']))
			$before_save_method_path = $crud_data['before_save_method_path'];
		if (isset($crud_data['after_save_method_path']))
			$after_save_method_path = $crud_data['after_save_method_path'];
		if (isset($crud_data['after_load_method_path']))
			$after_load_method_path = $crud_data['after_load_method_path'];
		if (isset($crud_data['override_orig_save']))
			$override_orig_save = (boolean)$crud_data['override_orig_save'];		
		if (isset($crud_data['crud_resource_types']))
			$this->data['crud_resource_types'] = $crud_data['crud_resource_types'];
		
		if (isset($before_save_method_path) && $before_save_method_path !== '')
		{
			$data = Loader::gi()->callModule($method, $before_save_method_path, $this->data['request']->parameters);
			if ($override_orig_save)
			{
				$this->data['body'] = @$data['body'];
				return $this->data;
			}
		}
		
		$where = array();
		$values = array();

			// Collecting values and table names
		foreach ($form_values as $el=>$val)
		{
			$el_parts = explode('^', $el);			
			if (!isset($el_parts[1])) $el_field = $el_parts[0];
				else $el_field = $el_parts[1];
			if (in_array($el_field, $this->data['disabled_saving_fields']))
				continue;
			if (!in_array($el_parts[0], $this->data['disabled_saving_tables']))
			{
				if (!empty($mapped_fields) && array_key_exists($el_field, $mapped_fields))
					$el_field = $mapped_fields[$el_field];  
						
				if (in_array($el_parts[1], $ids))
				{
					if ($val !== '' && $val > 0)
					{
						$values[$el_parts[0]]['reserved_id'] = $val;
						$where[$el_parts[0]] = "{$el_field} = {$val}";
					}
				}
				elseif (in_array($el_field, $translations))	// Parsing translations
				{
					unset($val[0]);
					$values[$el_parts[0]]['translations'][$el_field] = $val;
					$values[$el_parts[0]][$el_field] = '';
				}
				elseif (array_key_exists($el_field, $mapped_passwords))	// Parsing passwords
				{
					if ($mapped_passwords[$el_field] === 'md5' && $val != '')
						$values[$el_parts[0]][$el_field] = md5($val); 
				}			
				else
					$values[$el_parts[0]][$el_field] = "{$val}";
			}
		}
		
		$this->data['where'] = $where;
		$this->data['values'] = $values;

		$this->data = Loader::gi()->getModel($this->data);	
		
			// Saving files		
		if ($crud_data['uploader_object_type'] != '')
		{
			$file_par['files'] = $files;
			$file_par['session_id'] = session_id();
			$file_par['object_type'] = $crud_data['uploader_object_type'];
			$file_par['object_id'] = $this->data['id'];
			$data = Loader::gi()->callModule($method, 'materials/saveFiles', $file_par);
		}
		
			// Saving form values (if a form is actiaved)		
		if ($crud_data['additional_form_field'] != '' && isset($this->data['request']->parameters['additional_form']))
		{
			$form_par['fields'] = json_decode($this->data['request']->parameters['additional_form'], true);
			$form_par['form_id'] = $form_values[current(preg_grep('/\^'.$crud_data['additional_form_field'].'/', array_keys($form_values)))];
			
			if ($crud_data['additional_form_uridi'])
			{
				$form_par['table_name'] = '';
				$form_par['row_id'] = $form_values[current(preg_grep('/\^'.$crud_data['additional_form_table'].'/', array_keys($form_values)))];
			}
			else
			{
				$form_par['table_name'] = $crud_data['additional_form_table'];
				$form_par['row_id'] = $this->data['id'];
			}
			$data = Loader::gi()->callModule($method, 'forms/saveFormFieldValues', $form_par);
		}
		
		$this->data['request']->parameters['id'] = $this->data['id'];
		
		if ($after_save_method_path !== '')
			$data = Loader::gi()->callModule($method, $after_save_method_path, $this->data['request']->parameters);
		// Saving map
		$map_data = Loader::gi()->callModule('POST', 'search/saveMap', array('fields'=>$values, 'container_id'=>$this->data['id']));
			
		$this->data['body'] = $this->data['status'];
		return $this->data;
	}
        
	public function delete()
	{
		// Collecting values and table names
		$crud_data = json_decode(base64_decode($this->data['request']->parameters['crud_data']), true);	
		$form_params = json_decode($this->data['request']->parameters['crud_params_form'], true);
		$this->data['deleting_data'] = json_decode($this->data['request']->parameters['deleting_data'], true);
		$this->data['translations'] = $crud_data['translations'];
		$this->data['mapped_parents'] = $crud_data['mapped_parents'];
		$this->data['additional_form_uridi'] = $crud_data['additional_form_uridi'];
		$this->data['additional_form_table'] = $crud_data['additional_form_table'];
		$this->data['crud_resource_types'] = $crud_data['crud_resource_types'];
		$before_delete_method_path = $crud_data['before_delete_method_path'];
		$override_orig_delete = (boolean)$crud_data['override_orig_delete'];
		$after_delete_method_path = $crud_data['after_delete_method_path'];
		
		if (isset($before_delete_method_path) && $before_delete_method_path !== '')
		{
			$data = Loader::gi()->callModule('DELETE', $before_delete_method_path, $this->data['request']->parameters);
			if ($override_orig_delete)
			{
				$this->data['body'] = @$data['body'];
				return $this->data;
			}	
		}
		
		
		$this->data = Loader::gi()->getModel($this->data);
		
		if (isset($after_delete_method_path) && $after_delete_method_path !== '')
			$data = Loader::gi()->callModule('DELETE', $after_delete_method_path, $this->data['request']->parameters);
		
		$this->data['body'] = $this->data['status'];
		return $this->data;
	}
	
	/**
	 * Function will recieve parameters: body, crudname, type.
	 * There are main templates for crud printing named
	 * print_table_body
	 * print_table_header
	 * print_table_footer
	 * 
	 * print_item_body
	 * print_item_header
	 * print_item_footer
	 * 
	 * and could be specific templates in following naming
	 * print_table_table_crudname_body
	 * print_table_table_crudname_header
	 * print_table_table_crudname_footer
	 * 
	 * print_table_item_crudname_body
	 * print_table_item_crudname_body
	 * print_table_item_crudname_body
	 *
	 */
	 
	public function printIt()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$header_tpl = $this->data['header_tpl'];
		$body_tpl = $this->data['body_tpl'];
		$footer_tpl = $this->data['footer_tpl'];

		$content = $this->data['request']->parameters['body'];

		$content_data = Loader::gi()->callModule('DELETE', 'contents/getContent', array('name'=>$header_tpl));
		$header = $content_data['body'];
		
		$content_data = Loader::gi()->callModule('DELETE', 'contents/getContent', array('name'=>$body_tpl));
		$body = $content_data['body'];

		$content_data = Loader::gi()->callModule('DELETE', 'contents/getContent', array('name'=>$footer_tpl));
		$footer = $content_data['body'];


		//setting the body
		
 		$body = str_replace("[[body]]", $content, $body);


        $this->data['body'] = $header.$body.$footer;
        return $this->data;
	}	
	
	public function buildForm()
	{
		$this->data['crud_data'] = json_decode(base64_decode($this->data['request']->parameters['crud_data']), true);
		$this->data['form_type'] = $this->data['request']->parameters['form_type'];	
		if (isset($this->data['request']->parameters['row_id']))
			$this->data['row_id'] = $this->data['request']->parameters['row_id'];
		$this->data['request']->parameters['fields'] = $this->data['crud_data']['fields'];
		
			// Load the main CRUD row data 
		$row = Loader::gi()->callModule('POST', 'crud/load', $this->data['request']->parameters);
		if (isset($this->data['request']->parameters['row_id']))			
			$this->data['row'] = $row['body']['id'.$this->data['row_id']];
			
			// Processor overload
		$this->data['crud_data']['field_processors'] = $row['field_processors'];
		
		$this->data['crud_params_form'] = json_decode($this->data['request']->parameters['crud_params_form'], true);
				
			// Load additional form fields if there are any
		if ($this->data['form_type'] == 'add' && $this->data['crud_params_form']['crud_parent_id'] > 0 && $this->data['crud_data']['additional_form_field'] != '')
		{
			$additional_form_id = Loader::gi()->callModule('POST', 'forms/getObjectFormID', array('object_table'=>$this->data['crud_params_form']['additional_form_table'],'object_id'=>$this->data['crud_params_form']['crud_parent_id']));
			$this->data['additional_form_id'] = $additional_form_id['body'];
			
			if ($this->data['additional_form_id'] > 0)
			{
				$additional_form = Loader::gi()->callModule('GET', 'forms/getFormValues', array('form_id'=>$this->data['additional_form_id'],'row_id'=>0,'table_name'=>$this->data['crud_params_form']['additional_form_table'],'form_type'=>'add'));
				$this->data['additional_form'] = $additional_form['body'];
			}
		}	
		if ($this->data['form_type'] == 'edit' && $this->data['crud_data']['additional_form_field'] != '' && $this->data['row']->{$this->data['crud_data']['additional_form_field']} > 0)
		{			
				// If "use row_id instead flag" is true, then we should use predefined row_id and set the value of table_name to empty
			if ($this->data['crud_data']['additional_form_uridi'])
			{
				$table_name = '';
				$row_id = $this->data['row']->{$this->data['crud_params_form']['additional_form_table']};
			}
			else
			{
				$table_name = $this->data['crud_params_form']['additional_form_table'];
				$row_id = $this->data['row_id'];
			}
			
			$additional_form = Loader::gi()->callModule('GET', 'forms/getFormValues', array('form_id'=>$this->data['row']->{$this->data['crud_data']['additional_form_field']},'row_id'=>$row_id,'table_name'=>$table_name,'form_type'=>'edit'));
			$this->data['additional_form'] = $additional_form['body'];
		}
		
		$this->data['view_name'] = 'crudFormBuilder';
		$this->data['body'] = Loader::gi()->getView($this->data);
		
        return $this->data;
	}
}