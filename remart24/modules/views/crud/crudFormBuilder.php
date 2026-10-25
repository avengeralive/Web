<?php
	$text_types = array("VAR_STRING", "FLOAT", "DOUBLE", "LONG", "TINYINT");
	$textarea_types = array("TEXT", "BLOB");
	$date_types = array("DATETIME", "DATE", "TIMESTAMP");
	$name = $crud_params_form['name'];
	$fields = $crud_params_form['name'];
	extract($crud_data);	
?>
<script type="text/javascript" charset="utf-8">
	$('input.datetime').datetimepicker({language:'en-gb'});
</script>
	
<form name="<?php echo $name;?>-crud_edit_form" id="<?php echo $name;?>-crud_edit_form" role="form" class="form-horizontal" form_type="<?=$form_type;?>" action="<?php echo Backstage::gi()->portal_url;?>crud/save/" method="post">
<?php
	foreach ($fields as $field)
	{
			// Default field values
		$field_value = '';
		if (in_array($field['name'],$ids))
			$field_value = 0;
		
		if (in_array(strtoupper($field['type']), $date_types))
			$field_value = date(Backstage::gi()->date_format);
		
		if ($crud_params_form['crud_parent_id'] > 0 && $field['name'] === reset($mapped_parents))
		{
			$field_value = $crud_params_form['crud_parent_id'];
		}
			// Select the form of the parent element
		if ($crud_params_form['crud_parent_id'] > 0 && $crud_params_form['additional_form_table'] != '' && $field['name'] === $additional_form_field && !isset($row->{$field['name']}))
		{
			$field_value = $additional_form_id;
		}
			// Check if there are any default values defined
		if (array_key_exists($field['name'], $default_values))
		{
			$field_value = $default_values[$field['name']];
		}
		
			// If the returned set of data is defined, we will assign the values
		if (isset($row) && isset($row->{$field['name']}))
		{	
			$field_value = $row->{$field['name']};
		}
		elseif (in_array($field['name'], $translations))
		{
			$field_value = array();
			$langs = explode(',', Backstage::gi()->portal_langs);
			foreach ($langs as $key => $lang)
			{
				$field_value[$lang] = new stdClass();
				$field_value[$lang]->translation = '';
			}
		}
		
		if ($field['name'] == 'child_count')
			continue;
		if (isset($removed_fields[$form_type]) && in_array($field['name'], $removed_fields[$form_type]))
			continue;
		
		if (in_array($field['name'], $hidden_fields[$form_type]))
		{
			echo '<input type="hidden" class="hidden_fields" id="'.$field['table'].'-'.$field['name'].'" name="'.$field['table'].'^'.$field['name'].'" value="'.$field_value.'"/>';
			continue;
		}

		$readonly = '';
		$hidden = '';
		$ckeditor = '';
		$style = '';
		$js_handler = '';

			// Disable fields with condition

		if (isset($disabled_fields_if[$form_type][$field['name']]))
		{
			$cond_url = $disabled_fields_if[$form_type][$field['name']];
			$condition = Loader::gi()->callModule('GET', $cond_url, array('row_data'=>$row));
			if ($condition['body'])
				$readonly = 'readonly';
		}

		if (in_array($field['name'],$ids) || in_array($field['name'], $disabled_edit_fields))
			$readonly = 'readonly';

		if (in_array($field['name'], $hidden_edit_fields))
			$style .= 'visibility:hidden; ';

		if (in_array($field['name'],$ids) || in_array($field['name'], $add_editor_list))
			$ckeditor = 'ckeditor_w';

		if (array_key_exists($field['name'], $js_handlers))
			$js_handler = $js_handlers[$field['name']]['event'].'="'.$js_handlers[$field['name']]['handler'].'(this)"';

		if (strtoupper($field['name']) === strtoupper($additional_form_field))
			$js_handler = 'onchange="'.$name.'_additionalFormOpen(\''.$form_type.'\', this, \''.$additional_form_table.'\');"';

		if (array_key_exists($field['name'], $form_fields_dimensions))
		{
			$dims = explode(',',$form_fields_dimensions[$field['name']]);
			$style .= "width: ".trim($dims[0])."px; height: ".trim($dims[1])."px;";
		}

		echo '<div class="form-group">';

		if (!in_array($field['name'], $hidden_edit_fields))
		{
			if (array_key_exists($field['name'], $titles))
				echo '<label for="'.$field['name'].'" class="col-sm-2 control-label">'.$titles[$field['name']].'</label>';
			else
				echo '<label for="'.$field['name'].'" class="col-sm-2 control-label">'.$field['name'].'</label>';
		}

		echo '<div class="col-xs-9">';
		if (array_key_exists($field['name'], $mapped_field_inputs))
		{

			$field_input_part1 = substr($mapped_field_inputs[$field['name']], 0, strpos($mapped_field_inputs[$field['name']], ':'));
			$field_input_part2 = substr($mapped_field_inputs[$field['name']], strpos($mapped_field_inputs[$field['name']], ':')+1);

			if ($readonly == 'readonly')
				$readonly = 'disabled';
			switch ($field_input_part1)
			{
				case 'autocomplete':
					$field_name = $field['table'].'-'.$field['name'];
					$typehead_name = str_replace('-', '', $field_name);
					$params_array = json_decode($field_input_part2, true);
					$additional_search_params = isset($params_array['additional_search_params'])?"&".$params_array['additional_search_params']:"";
				//	$js_handler2  =  $js_handlers[substr($field['name'], 0,-5)]['handler'].'(this)"';
					?>
					<script>
					 $(function(){	// UNIVERSAL TYPEAHEAD
							var additional_search_params = "<?php echo $additional_search_params;?>";
							var <?php echo $typehead_name?> = new Bloodhound({
							  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
							  queryTokenizer: Bloodhound.tokenizers.whitespace,
							  remote: {
								url: '<?php echo Backstage::gi()->portal_url ?><?php echo $params_array['json_method']?>',
								   replace: function(url, query) {
										return url + "?q=" + encodeURIComponent(query) + additional_search_params;
									}
							  },
							  limit:100
							});
							 
							<?php echo $typehead_name?>.initialize();
				
							$('#<?php echo $name;?>-crud_edit_form #<?php echo $field_name; ?>').typeahead(null, 
							{
							  name: '<?php echo $typehead_name?>',
							  displayKey: '<?php echo $params_array['full_field']?>',
							  source: <?php echo $typehead_name?>.ttAdapter(),
							  templates: {
								empty: [
								  '<div class="empty-message">',
								  '<?php echo Translations::gi()->cant_find ?>',
								  '</div>'
								].join('\n'),
								suggestion: Handlebars.compile('<p>{{<?php echo $params_array['id_field']?>}} - <strong>{{<?php echo $params_array['full_field']?>}}</strong></p>')
							  }
							}).on('typeahead:selected', function (obj, datum) 
							{    
								
								$('#<?php echo $name;?>-crud_edit_form #<?php echo $params_array['hidden_field_id']?>').val(datum.<?php echo $params_array['id_field']?>);
							   
							});
							//END UNIVERSAL TYPEAHEAD  
						});
						</script>
						<input type="text" id="<?php echo $field['table'].'-'.$field['name']; ?>" name="<?php echo $field['table'].'^'.$field['name']; ?>" class="form-control input-sm" <?php echo $readonly; ?> style="<?php echo $style; ?>" value="<?php echo $field_value;?>" <?php echo $js_handler; ?> />
				<?php
				break;					
				case 'select':
					echo '<select id="'.$field['table'].'-'.$field['name'].'" name="'.$field['table'].'^'.$field['name'].'" class="form-control input-sm" '.$readonly.' style="'.$style.'" '.$js_handler.'>';
					echo '<option value="0">-</option>';
					$select = json_decode($field_input_part2, true);

					foreach ($select as $option_value=>$option_desc)
					{
						$selected = '';
						if ($option_value == $field_value) $selected = 'selected';
						echo '<option value="'.$option_value.'" '.$selected.'>'.$option_desc.'</option>';
					}
					echo '</select>';
				break;
				case 'checkbox':
					$field_input_part2 = explode(',',$field_input_part2);
					$checked = '';
					$value = $field_input_part2[0];
						$checked = 'checked';
					if ($field_value == 1 || (isset($field_input_part2[1]) && $field_input_part2[1] === 'checked'))
						$checked = 'checked';
					else
						$checked = '';						
					
					echo '<input type="hidden" name="'.$field['table'].'^'.$field['name'].'" value="0">';
					echo '<input type="checkbox" id="'.$field['table'].'-'.$field['name'].'" name="'.$field['table'].'^'.$field['name'].'" '.$readonly.' style="'.$style.'" value="'.$value.'" '.$js_handler.' '.$checked.'>';
				break;
			}
		}
		elseif (array_key_exists($field['name'], $field_processors))
		{
			?>
			<input type="text" id="<?php echo $field['table'].'-'.$field['name']; ?>" name="<?php echo $field['table'].'^'.$field['name']; ?>" class="form-control input-sm" <?php echo $readonly; ?> style="<?php echo $style; ?>" value="<?php echo $field_value;?>" <?php echo $js_handler; ?> />
			<?php
			if (isset($field_processors[$field['name']]->body))
				echo $field_processors[$field['name']]->body;
			
		}
		elseif (in_array($field['name'], $translations))	// Translations for the field are set
		{

			$langs = explode(',', Backstage::gi()->portal_langs);
			echo '<ul class="nav nav-tabs" id="'.$field['table'].'_'.$field['name'].'_tab">';
			foreach ($langs as $key => $lang)
			{
				echo "<li><a href='#".$field['table'].'_'.$field['name']."_".$lang."' data-toggle='tab'>".$lang."</a></li>";
			}
			echo '</ul>';
			echo '<div class="tab-content">';

			foreach ($langs as $key => $lang)
			{
				// LQ Button For Translations
				if (in_array($field['name'], $add_lq_button)){
					$buttonLQ = '<button type="button" class="addLQbtn btn btn-primary btn-sm" rel="'.$field['table'].'^'.$field['name'].'['.($lang).']" alt="' . $field['type'] . '">Add LQ</button>';
				} else {
					$buttonLQ = '';
				}

				echo "<div class='tab-pane' id='".$field['table'].'_'.$field['name']."_". $lang."'>";
				if (in_array(strtoupper($field['type']), $textarea_types))
					echo '<textarea id="'.$field['table'].'-'.$field['name'].'_'.$lang.'" name="'.$field['table'].'^'.$field['name'].'['.($lang).']" class="form-control input-sm '.$ckeditor.'" '.$readonly.' style="'.$style.'" '.$js_handler.'>'.$field_value[$lang]->translation.'</textarea>' . $buttonLQ;
				elseif (in_array(strtoupper($field['type']), $text_types))
					echo '<input id="'.$field['table'].'-'.$field['name'].'_'.$lang.'" name="'.$field['table'].'^'.$field['name'].'['.($lang).']" class="form-control input-sm ui-autocomplete-input" value="'.htmlspecialchars($field_value[$lang]->translation).'" '.$readonly.' style="'.$style.'" '.$js_handler.'/>' . $buttonLQ;
				elseif (in_array(strtoupper($field['type']), $date_types))
					echo '<input id="'.$field['table'].'-'.$field['name'].'_'.$lang.'" name="'.$field['table'].'^'.$field['name'].'['.($lang).']" class="datetime form-control input-sm" value="'.$field_value[$lang]->translation.'" '.$readonly.' style="'.$style.'"/ '.$js_handler.'>';
				else
					echo '<input id="'.$field['table'].'-'.$field['name'].'_'.$lang.'" name="'.$field['table'].'^'.$field['name'].'['.($lang).']" class="form-control input-sm" value="'.htmlspecialchars($field_value[$lang]->translation).'" '.$readonly.' style="'.$style.'" '.$js_handler.'/>';

				echo '</div>';
			}
			echo '</div>';
		}
		else
		{
			// LQ Button
			if (in_array($field['name'], $add_lq_button)){
				$buttonLQ = '<button type="button" class="addLQbtn btn btn-primary btn-sm" rel="'.$field['table'].'^'.$field['name'].'" alt="' . $field['type'] . '">Add LQ</button>';
			} else {
				$buttonLQ = '';
			}

			if (array_key_exists($field['name'], $mapped_passwords))
				echo '<input type="password" id="'.$field['table'].'-'.$field['name'].'" name="'.$field['table'].'^'.$field['name'].'" class="form-control input-sm" value="'.$field_value.'" '.$readonly.' style="'.$style.'" '.$js_handler.'/>';
			elseif (in_array(strtoupper($field['type']), $textarea_types))
				echo '<textarea id="'.$field['table'].'-'.$field['name'].'" name="'.$field['table'].'^'.$field['name'].'" class="form-control input-sm '.$ckeditor.'" '.$readonly.' style="'.$style.'" '.$js_handler.'>'.$field_value.'</textarea>' . $buttonLQ;
			elseif (in_array(strtoupper($field['type']), $text_types))
				echo '<input id="'.$field['table'].'-'.$field['name'].'" name="'.$field['table'].'^'.$field['name'].'" class="form-control input-sm ui-autocomplete-input" value="'.htmlspecialchars($field_value).'" '.$readonly.' style="'.$style.'" '.$js_handler.'/>' . $buttonLQ;
			elseif (in_array(strtoupper($field['type']), $date_types))
				echo '<input id="'.$field['table'].'-'.$field['name'].'" name="'.$field['table'].'^'.$field['name'].'" class="datetime form-control input-sm" value="'.$field_value.'" '.$readonly.' style="'.$style.'" '.$js_handler.'/>';
			else
				echo '<input id="'.$field['table'].'-'.$field['name'].'" name="'.$field['table'].'^'.$field['name'].'" class="form-control input-sm" value="'.htmlspecialchars($field_value).'" '.$readonly.' style="'.$style.'" '.$js_handler.'/>';
		}
		echo '</div>';
		echo '<div class="form_hint"><span class="validation"></span></div>';
		echo '</div>';
	}
		// Materials uploader
	if (!empty($uploader_object_type))
	{
		?>
		<div class="form-group">
			<label class="col-sm-2 control-label">Uploaded files</label>
			<div class="col-xs-9">
				<span class="btn btn-success fileinput-button">
					<i class="glyphicon glyphicon-plus"></i>
					<span><?php echo Translations::gi()->select_files;?></span>
					<!-- The file input field used as target for the file upload widget -->
					<input id="uploader_materials" type="file" name="files[]" multiple>
				</span>						
				<br/><br/>
				<div id="uploader_materials_div">
                    <ol></ol>
				</div>
			</div>
		</div>
		<?php
	}
?>
</form>
<form name="<?php echo $name;?>-crud_additional_form" id="<?php echo $name;?>-crud_additional_form" role="form" class="form-horizontal" method="post">
	<div id="<?php echo $name;?>-crud_additional_form_div">
	<?php
		if (isset($additional_form))
			echo $additional_form;
	?>
	</div>
</form>
