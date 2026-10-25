<?php

/**
 * @package    MVC
 *
 * @copyright  Copyright (C) 2014  Rinat Gazikhanov, Vusal Khalilov, BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
class cForms extends controller
{	
	/**
	 * Used to load form to the viewport (client)
	 * Please use $this->data['request']->parameters['parameter_name'] to get parameters
	 *
	 * @return array global $this->data
	 */	
	public function getForm()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$form_id = $this->data['item']->id;

        $form_class = $form_action = $form_type = $form_method = $form_request = $form_callback = "";

        if(isset($this->data['request']->parameters['lq']['formaction']) &&
            !empty($this->data['request']->parameters['lq']['formaction']))
		        $form_action = $this->data['request']->parameters['lq']['formaction'];

		if(isset($this->data['request']->parameters['lq']['formtype']) &&
            !empty($this->data['request']->parameters['lq']['formtype']))
		        $form_type = $this->data['request']->parameters['lq']['formtype'];

		if(isset($this->data['request']->parameters['lq']['formmethod']) &&
            !empty($this->data['request']->parameters['lq']['formmethod']))
		        $form_method = $this->data['request']->parameters['lq']['formmethod'];

		if(isset($this->data['request']->parameters['lq']['formrequest']) &&
            $this->data['request']->parameters['lq']['formrequest'] == "ajax"){
            $form_request = 'data-form-request="ajax" type="button"';
            $form_class = 'qbit_custom_ajax_form';
        }

		if(isset($this->data['request']->parameters['lq']['formcallback']) &&
            !empty($this->data['request']->parameters['lq']['formcallback']))
		        $form_callback = $this->data['request']->parameters['lq']['formcallback'];

		$form_values = Loader::gi()->callModule('GET', 'forms/getFormValues', array('form_id'=>$form_id)); 
		if (!isset($this->data['request']->parameters['lq']['design']))
			$design_name = $this->data['item']->design_name;
		else
			$design_name = isset($this->data['request']->parameters['lq']['design'])?$this->data['request']->parameters['lq']['design']:'';
		$des_data = Loader::gi()->callModule('GET', 'designs', array('where'=>'design_name="'.$design_name.'"'));
		if ($des_data['items'])
			$design = $des_data['items'][0];
		else
			throw new QException(array('ER-00026', $design_name));		

        $block_rules_cnt = preg_match_all("/.*(\[\[([A-z0-9\-\_]+)\]\]).*/", $design->block, $block_rules, PREG_SET_ORDER);
        $structure_rules_cnt = preg_match_all("/(\[\[([A-z0-9\-\_]+)\]\])/", $design->structure, $structure_rules, PREG_SET_ORDER);

		$fields = array('structure', 'id', 'field_title', 'field_name', 'field', 'button');
        $this->data['sequence'] = '';
        $this->data['block'] = $design->block;
		foreach ($form_values['items'] as $key => $value)
		{
			$field_class = $value->required != 0?'required_field':'';
            $field_class .= ' '.$value->field_class;
            $field_width = '';
            if ($value->field_width && (int)$value->field_width > 0)
                $field_width = 'style="width: '.$value->field_width.'px"';
            $placeholder = '';
            if ($value->has_placeholder == 1)
                $placeholder = 'placeholder="'.$value->field_title.'"';
			// Linked fields
			foreach ($form_values['items'] as $linked_key => $linked_value)
			{
				if ($value->id === $linked_value->linked_field_id)
				{
					$form_values['items'][$key]->linked_key = $linked_key;
				}
			}
            $form_values['items'][$key]->field = '';

				// Creating bodies of the fields
			if (is_array($value->value))	// Translations for the field are set
			{
				$form_values['items'][$key]->field .= '<ul class="nav nav-tabs" id="'.$value->field_name.'_tab">';
				foreach ($value->value as $translation) 
				{
					$form_values['items'][$key]->field .= "<li><a href='#".$value->field_name."_".$translation->short."' data-toggle='tab'>".$translation->short."</a></li>";
				}
				$form_values['items'][$key]->field .= '</ul>';
				$form_values['items'][$key]->field .= '<div class="tab-content">';

				foreach ($value->value as $translation) 
				{
					$form_values['items'][$key]->field .= "<div class='tab-pane' id='".$value->field_name."_".$translation->short."'>";
						// Field type handling
					switch ($value->type_name)
					{
						case 'text':
							$form_values['items'][$key]->field .= '<input class="'.$field_class.'" type="text" '.$placeholder.' id="'.$value->field_name.'['.$translation->short.']" name="'.$value->field_name.'" '.$field_width.' />';
						break;
						case 'checkbox':
							$form_values['items'][$key]->field .= '<input class="'.$field_class.'" type="checkbox" id="'.$value->field_name.'['.$translation->short.']" name="'.$value->field_name.'" value="1" />';
						break;
						case 'select':
							$form_values['items'][$key]->field .= '<select class="'.$field_class.'" id="'.$value->field_name.'" name="'.$value->field_name.'['.$translation->short.']" '.$field_width.'>';
							foreach ($value->select_options as $select_option)
							{
								$form_values['items'][$key]->field .= '<option value="'.$select_option->option_value.'">'.$select_option->option_title.'</option>'; 
							}
							$form_values['items'][$key]->field .= '</select>';
						break;
						case 'multiselect':
							$form_values['items'][$key]->field .= '<select class="'.$field_class.'" id="'.$value->field_name.'" name="'.$value->field_name.'['.$translation->short.']" '.$field_width.'>';
							foreach ($value->select_options as $select_option)
							{
								$form_values['items'][$key]->field .= '<option value="'.$select_option->option_value.'">'.$select_option->option_title.'</option>'; 
							}
							$form_values['items'][$key]->field .= '</select>';
						break;
						case 'upload':
							$form_values['items'][$key]->field .= '<input class="'.$field_class.'" type="file" id="'.$value->field_name.'['.$translation->short.']" name="'.$value->field_name.'"  />';
						break;
						case 'textarea':   
							$form_values['items'][$key]->field .= '<textarea class="'.$field_class.'" '.$placeholder.' id="'.$value->field_name.'['.$translation->short.']" name="'.$value->field_name.'" '.$field_width.'></textarea>';
						break;
						case 'button':
							$form_values['items'][$key]->field .= '<button '.$form_request.' class="'.$field_class.'" id="'.$value->field_name.'['.$translation->short.']" name="'.$value->field_name.'" '.$field_width.'>'.$value->field_title.'</button>';
						break;
					}						
					$form_values['items'][$key]->field .= '</div>';
				}
				$form_values['items'][$key]->field .= '</div>';
			}
			else				
				switch ($value->type_name)
				{
					case 'text':
						$form_values['items'][$key]->field = '<input class="'.$field_class.'" type="text" '.$placeholder.' id="'.$value->field_name.'" name="'.$value->field_name.'" '.$field_width.' />';
					break;
					case 'checkbox':
						$form_values['items'][$key]->field = '<input class="'.$field_class.'" type="checkbox" id="'.$value->field_name.'" name="'.$value->field_name.'" value="1" />';
					break;
					case 'select':
						$form_values['items'][$key]->field = '<select class="'.$field_class.'" id="'.$value->field_name.'" name="'.$value->field_name.'" '.$field_width.'>';
						foreach ($value->select_options as $select_option)
						{
							$form_values['items'][$key]->field .= '<option value="'.$select_option->option_value.'">'.$select_option->option_title.'</option>'; 
						}
						$form_values['items'][$key]->field .= '</select>';
					break;
					case 'multiselect':
						$form_values['items'][$key]->field = '<select class="'.$field_class.'" id="'.$value->field_name.'" name="'.$value->field_name.'" '.$field_width.'>';
						foreach ($value->select_options as $select_option)
						{
							$form_values['items'][$key]->field .= '<option value="'.$select_option->option_value.'">'.$select_option->option_title.'</option>'; 
						}
						$form_values['items'][$key]->field .= '</select>';
					break;
					case 'upload':
						$form_values['items'][$key]->field = '<input class="'.$field_class.'" type="file" id="'.$value->field_name.'" name="'.$value->field_name.'"  />';
					break;
					case 'textarea':   
						$form_values['items'][$key]->field = '<textarea class="'.$field_class.'" '.$placeholder.' id="'.$value->field_name.'" name="'.$value->field_name.'" '.$field_width.'></textarea>';
					break;
					case 'button':
                        $form_values['items'][$key]->field = '<button '.$form_request.' class="'.$field_class.'" id="'.$value->field_name.'" name="'.$value->field_name.'" '.$field_width.' data-form-id="">'.$value->field_title.'</button>';
					break;
				}

		    $in_block = false;
            foreach($block_rules as $rule_key => $rule)
            {
                if($rule[2] === $value->field_name){
                    $this->data['block'] = str_replace($rule[1], $value->field, $this->data['block']);
                    $in_block = true;
                }
            }

            if(!$in_block){
                $item = $design->structure;
                foreach ($structure_rules as $rule_key => $rule)
                {
                    if (in_array($rule[2], $fields))
                        $item = str_replace($rule[1], $value->{$rule[2]}, $item);
                }
                $this->data['sequence'] .= $item;
            }
		}

        foreach ($block_rules as $rule_key => $rule)
        {
            $this->data['block'] = str_replace('[[structure]]', $this->data['sequence'], $this->data['block']);
        }

        $this->data['block'] = "<form class='".$form_class."' action='".$form_action."' method='".$form_method."' enctype='".$form_type."' data-callback='".$form_callback."'>" . $this->data['block'] . "</form>";

			// View loading
        $this->data['view_name'] = 'form';
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	} 
	
	/**
	 * Used to load fields to the viewport (client)
	 * Please use $this->data['request']->parameters['parameter_name'] to get parameters
	 *
	 * @return array global $this->data
	 */	
    public function getFormFields()
    {
		$this->data = Loader::gi()->getModel($this->data);		
			// Get form field types
		$form_field_types = Loader::gi()->callModule('GET', 'forms/getFormFieldTypes', array('order'=>'type_name'));
		$this->data['form_field_types'] = $form_field_types['items'];
			// Get linked fields of the field
		$form_field_selects = Loader::gi()->callModule('GET', 'forms/getFormFieldSelects', array('order'=>'select_name'));
		$this->data['form_field_selects'] = $form_field_selects['items'];
			// Get linked fields of the field
		$form_field_linked_fields = Loader::gi()->callModule('GET', 'forms/getFormFieldLinkedFields', array('order'=>'field_name'));
		$this->data['form_field_linked_fields'] = $form_field_linked_fields['items'];

        $this->data['view_name'] = 'formFields';
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}    
	
    public function getFormField()
    {
		$this->data['field'] = new stdClass();
		$this->data['field']->num = $this->data['request']->parameters['max_num'];
		$this->data['field']->id = 0;
		$this->data['field']->ordering = 0;
        $this->data['field']->field_name = '';
        $this->data['field']->field_class = '';
		$this->data['field']->field_type_id = 0;
		$this->data['field']->field_select_id = 0;
		$this->data['field']->linked_field_id = 0;
		$this->data['field']->translation = 0;
        $this->data['field']->required = 0;
        $this->data['field']->datetime = 0;
        $this->data['field']->has_placeholder = 0;
		$this->data['field']->field_width = 0;
		
		$translations = Translations::gi()->getTranslations('form_fields', 0);
		if (!empty($translations)) {
			foreach ($translations as $translation_field => $translation)
				$this->data['field']->$translation_field = $translation;
		}
			
			// Get form field types
		$form_field_types = Loader::gi()->callModule('GET', 'forms/getFormFieldTypes', array('order'=>'type_name'));
		$this->data['form_field_types'] = $form_field_types['items'];
			// Get linked fields of the field
		$form_field_selects = Loader::gi()->callModule('GET', 'forms/getFormFieldSelects', array('order'=>'select_name'));
		$this->data['form_field_selects'] = $form_field_selects['items'];
			// Get linked fields of the field
		$form_field_linked_fields = Loader::gi()->callModule('GET', 'forms/getFormFieldLinkedFields', array('order'=>'field_name'));
		$this->data['form_field_linked_fields'] = $form_field_linked_fields['items'];
		

        $this->data['view_name'] = 'formField';
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}    
	
	public function getFormFieldTypes()
	{
		$this->data = Loader::gi()->getModel($this->data);
		return $this->data;
	}	
		
	public function getFormFieldSelects()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['items'];
		return $this->data;
	}	
			
	public function getFormFieldLinkedFields()
	{
		$this->data = Loader::gi()->getModel($this->data);
		return $this->data;
	}		
	
	public function saveFormFields()
	{	
		$fields_form = json_decode($this->data['request']->parameters['form_values'], true);
		$items = array();
		foreach($fields_form['id'] as $key=>$field)
		{
			if (isset($field))
			{
				$items[$key]['id'] = $field;
				$items[$key]['form_id'] = $fields_form['form_id'];
                $items[$key]['field_name'] = $fields_form['field_name'][$key];
                $items[$key]['field_class'] = $fields_form['field_class'][$key];
				$items[$key]['field_title'] = $fields_form['field_title'][$key];
				if (is_array($items[$key]['field_title']))
				{
					unset($items[$key]['field_title'][0]);
					$items[$key]['translations']['field_title'] = $items[$key]['field_title'];
					$items[$key]['field_title'] = '';
				}
                $items[$key]['ordering'] = $fields_form['ordering'][$key];
                $items[$key]['field_width'] = $fields_form['field_width'][$key];
				$items[$key]['translation'] = $fields_form['translation'][$key];
				$items[$key]['field_type_id'] = $fields_form['field_type_id'][$key];
				$items[$key]['field_select_id'] = $fields_form['field_select_id'][$key];
				$items[$key]['linked_field_id'] = $fields_form['linked_field_id'][$key];
				$items[$key]['required'] = $fields_form['required'][$key];
                $items[$key]['datetime'] = $fields_form['datetime'][$key];
                $items[$key]['has_placeholder'] = $fields_form['has_placeholder'][$key];
			}
		}
		$this->data['items'] = $items;
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = '';
		return $this->data;
	}
        
	public function deleteFormFields()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['status'];		
		return $this->data;		
	}
	
    public function deleteFormFieldValues()
    {
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['status'];		
		return $this->data;		
	}

	public function getFormFieldSelectOptions()
	{
		$this->data = Loader::gi()->getModel($this->data);	
        $this->data['view_name'] = 'formFieldSelectOptions';
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;		
	}
		
    public function getFormFieldSelectOption()
    {
		$this->data['option'] = new stdClass();
		$this->data['option']->num = $this->data['request']->parameters['max_num'];
		$this->data['option']->id = 0;
		$this->data['option']->ordering = 0;
		$this->data['option']->option_value = '';
		$this->data['option']->selected = 0;
		
		$translations = Translations::gi()->getTranslations('form_field_select_options', 0);
		if (!empty($translations)) {
			foreach ($translations as $translation_field => $translation)
				$this->data['option']->$translation_field = $translation;
		}

        $this->data['view_name'] = 'formFieldSelectOption';
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}    
	
	public function saveFormFieldSelectOptions()
	{	
		$options_form = json_decode($this->data['request']->parameters['form_values'], true);
		$items = array();
		foreach($options_form['id'] as $key=>$field)
		{
			if (isset($field))
			{
				$items[$key]['id'] = $field;
				$items[$key]['field_select_id'] = $options_form['field_select_id'];
				$items[$key]['option_title'] = $options_form['option_title'][$key];
				if (is_array($items[$key]['option_title']))
				{
					unset($items[$key]['option_title'][0]);
					$items[$key]['translations']['option_title'] = $items[$key]['option_title'];
					$items[$key]['option_title'] = '';
				}
				$items[$key]['option_value'] = $options_form['option_value'][$key];
				$items[$key]['ordering'] = $options_form['ordering'][$key];
				$items[$key]['selected'] = $options_form['selected'][$key];
			}
		}
		$this->data['items'] = $items;
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = '';
		return $this->data;
	}		

    public function deleteFormFieldSelects()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = '';		
		return $this->data;		
	}

	public function getFormValues()
	{
		// Model loading
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['form_type'] = isset($this->data['request']->parameters['form_type'])?$this->data['request']->parameters['form_type']:'';
		// View loading
        $this->data['view_name'] = 'formValues';
        if ($this->data['request']->data_type == 'json'){
            $this->data['body'] = $this->data['items'];
        } else {
            $this->data['body'] = Loader::gi()->getView($this->data);
        }

		return $this->data;            
	}
	
	public function saveFormFieldValues()
	{
		$items = array();
		$fields = $this->data['request']->parameters['fields'];
		$form_id = $this->data['request']->parameters['form_id'];
		$table_name = $this->data['request']->parameters['table_name'];
		$row_id = $this->data['request']->parameters['row_id'];
		$i = 0;
		
		foreach ($fields as $key=>$field)
		{
			if (substr($key, 0,7) == 'fieldid')
			{
				$items[$i]['field_id'] = $field;
				continue;
			}
			if (substr($key, 0,7) == 'valueid')
			{
				$items[$i]['id'] = $field;
				continue;
			}
			$items[$i]['form_id'] = $form_id;
			$items[$i]['table_name'] = $table_name;
			$items[$i]['row_id'] = $row_id;
			$items[$i]['value'] = $field;
			
			if (is_array($items[$i]['value']))
			{
				unset($items[$i]['value'][0]);
				$items[$i]['translations']['value'] = $items[$i]['value'];
				$items[$i]['value'] = '';
			}
			$i++;				
		}

		// Model loading
		$this->data['items'] = $items;
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = '';
		return $this->data;
	}
	
    public function getObjectFormID()
    {
		$this->data = Loader::gi()->getModel($this->data);		
        $this->data['body'] = $this->data['item']->form_id;
        return $this->data;
	}    	
    public function getSequenceRowID()
    {
        $this->data['body'] = Loader::gi()->getModel($this->data);;
        return $this->data;
    }
}