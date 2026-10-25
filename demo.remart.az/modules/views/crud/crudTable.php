<script type="text/javascript" charset="utf-8">
var <?php echo $name;?>_file_num = 0;
var <?php echo $name;?>_files = {};
var <?php echo $name;?>_processors_data = {};
var <?php echo $name;?>_current_id = 0;
var name = '<?php echo $name;?>';
var <?php echo $name;?>_data = '';

$(function()
{
	// Clear popovers
	$('html').on('click', function(e) {
	  if (!$(e.target).is("button") &&
		 !$(e.target).parents().is('.popover.in')) {
		$('[data-original-title]').popover('destroy');
	  }
	});

    <?php echo $name;?>_data = <?php echo json_encode($rows); ?>;
    $("#<?php echo $name;?>-crud_params_form #crud_current_page").val(<?php echo $crud_current_page;?>);

    $('.<?php echo $name;?>-crud_header').click(function(e)
    {
        if ($(this).attr("data-order") === '')
        {
			$(this).attr("data-order","asc")
        }
        else if ($(this).attr("data-order") === 'asc')
        {
			$(this).attr("data-order","desc");
        }
        else if ($(this).attr("data-order") === 'desc')
        {
			$(this).attr("data-order","");
        }

        order = '';
        $('.<?php echo $name;?>-crud_header').each(function(i, el)
        {
            if ($(this).attr("data-order") !== '')
                order += $(this).attr("data-column")+' '+$(this).attr("data-order")+',';
        });
        order = order.substring(0, order.length - 1);
        $('#<?php echo $name;?>-crud_params_form #order').val(order);

        <?php echo $name;?>_load();
        e.preventDefault();
        return false;
    });

		// Save form elements activator
	function crud_edit_form_activator()
	{
			// After we set the value initiate CKEDITOR
		$('.ckeditor_w').each(function(e)
		{
			CKEDITOR.replace(this);
		});
		
			// Open the first tab of navbars
		<?php
		foreach ($fields as $field)
		{
			if (in_array($field['name'], $translations))
				echo "$('#".$field['table']."_".$field['name']."_tab a:first').tab('show');";
		}
		?>
			// Open the first tab of navbars of the additional form
		$('#<?php echo $name;?>-crud_edit_modal #<?php echo $name;?>-crud_additional_form_div .nav-tabs a:first').tab('show');		
						
			// Validate and Save edit form
		<?php if (!!array_diff(array('add','edit'), $restrictions)) { ?>
		
		$('#<?php echo $name;?>-crud_save_btn').click(function(e)
		{
			$('#<?php echo $name;?>-crud_edit_form').submit();
		});

		$('#<?php echo $name;?>-crud_edit_form').validate({
			errorPlacement: function(error, element)
			{
				showPopover(element, error.html());
			},
			submitHandler: function(form)
			{
				var method = "POST";
				switch ($(form).attr("form_type"))
				{
					case "add": method = "POST";
					break;
					case "edit": method = "PUT";
					break;
				}
				
				<?php if (!empty($unique_fields))
				{
				?>
					$.ajax(
					{
						url:"<?php echo Backstage::gi()->portal_url;?>crud/validateUnique/",
						type: "POST",
						data: {
							form_values: JSON.stringify($(form).serializeJSON()),
							crud_data: '<?php echo $crud_data;?>',
							crud_params_form: JSON.stringify($('#<?php echo $name;?>-crud_params_form').serializeJSON())
						},

						success:function(data)
						{
							
							if (data == 0)
								<?php echo $name;?>_submit_crud_form(form, method);
							else
								alert('The resource name is already busy.');
						},
						error: function (request, status, error)
						{
							console.log(request.responseText);
						}
					});
				<?php } else
					echo $name.'_submit_crud_form(form, method);'
				?>
			}
		});
		<?php } ?>
		
			// Uploader form
		<?php 
		$timestamp = time();
		if (array_diff(array('add','edit'), $restrictions)) { ?>

		$('#<?php echo $name;?>-crud_edit_form #uploader_materials').fileupload({
			url: '<?php echo Backstage::gi()->MATERIALS_URL; ?>temp/upload.php?session_id=<?php echo session_id(); ?>',
			dataType: 'html',
			acceptFileTypes: /<?php echo $uploader_settings['extensions']; ?>$/i,
			formData     : {
				timestamp : '<?php echo $timestamp;?>',
				token     : '<?php echo md5('crud_key' . $timestamp);?>',
				fileTypeExts : '<?php echo $uploader_settings['extensions']; ?>'			
			},	
			done: function (e, data) {
				if (data.result == "")
					$.each(data.files, function (index, file) {						
						var filetype = file.name.split('.').pop();
						switch (filetype)
						{
							case 'jpeg':
							case 'jpg':
							case 'gif':
							case 'png':
							case 'bmp':
							case 'tiff':
							case 'tif':
								$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>temp/files/<?php echo session_id(); ?>/'+file.name+'" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+file.name+'" onclick="<?php echo $name;?>_deleteFile(0, this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/files/<?php echo session_id(); ?>/'+file.name+'">'+file.name+'</a></div></span>');
							break;
							case 'pdf':
								$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>temp/img/pdf.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+file.name+'" onclick="<?php echo $name;?>_deleteFile(0, this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/files/<?php echo session_id(); ?>/'+file.name+'">'+file.name+'</a></div></span>');
							break;
							case 'xls':
								$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>temp/img/xls.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+file.name+'" onclick="<?php echo $name;?>_deleteFile(0, this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/files/<?php echo session_id(); ?>/'+file.name+'">'+file.name+'</a></div></span>');
							break;
							case 'xlsx':
								$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>temp/img/xlsx.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+file.name+'" onclick="<?php echo $name;?>_deleteFile(0, this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/files/<?php echo session_id(); ?>/'+file.name+'">'+file.name+'</a></div></span>');
							break;
							case 'doc':
							case 'docx':
								$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>temp/img/doc.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+file.name+'" onclick="<?php echo $name;?>_deleteFile(0, this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/files/<?php echo session_id(); ?>/'+file.name+'">'+file.name+'</a></div></span>');
							break;
							case 'html':
								$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>temp/img/html.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+file.name+'" onclick="<?php echo $name;?>_deleteFile(0, this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/files/<?php echo session_id(); ?>/'+file.name+'">'+file.name+'</a></div></span>');
							break;
							case 'mp3':
								$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>temp/img/mp3.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+file.name+'" onclick="<?php echo $name;?>_deleteFile(0, this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/files/<?php echo session_id(); ?>/'+file.name+'">'+file.name+'</a></div></span>');
							break;
							case 'txt':
								$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>temp/img/txt.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+file.name+'" onclick="<?php echo $name;?>_deleteFile(0, this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/files/<?php echo session_id(); ?>/'+file.name+'">'+file.name+'</a></div></span>');
							break;
							case 'zip':
								$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>temp/img/zip.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+file.name+'" onclick="<?php echo $name;?>_deleteFile(0, this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/files/<?php echo session_id(); ?>/'+file.name+'">'+file.name+'</a></div></span>');
							break;
							default:
								$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>temp/img/file.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+file.name+'" onclick="<?php echo $name;?>_deleteFile(0, this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/files/<?php echo session_id(); ?>/'+file.name+'">'+file.name+'</a></div></span>');
							break;
						}
						<?php echo $name;?>_files[<?php echo $name;?>_file_num] = {id:0, name: file.name};
						<?php echo $name;?>_file_num++;						
					});
					else
						console.log(data.result);
			}
		}).error(function (jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		});
				
		<?php 
		}
		
		if (!empty($uploader_object_type))
		{
			?>
				$.ajax(
				{
					url:"<?php echo Backstage::gi()->portal_url;?>materials/getFiles",
					type: "GET",
					data: {
						object_type: '<?php echo $uploader_object_type; ?>',
						object_id: <?php echo $name;?>_current_id
					},
					success:function(data)
					{
						$.each(JSON.parse(data), function(fl_el, fl_val)
						{
							switch (fl_val.material_type)
							{
								case 'image':
									$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?><?php echo $uploader_object_type;?>/'+fl_val.object_id+'/thumbnail/'+fl_val.material_path+'" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" onclick="<?php echo $name;?>_deleteFile('+fl_val.id+', this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?><?php echo $uploader_object_type;?>/'+fl_val.object_id+'/thumbnail/'+fl_val.material_path+'">'+fl_val.material_path+'</a></div></span>');
								break;
								case 'pdf':
									$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/img/pdf.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+fl_val.material_path+'" onclick="<?php echo $name;?>_deleteFile('+fl_val.id+', this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?><?php echo $uploader_object_type;?>/'+fl_val.object_id+'/'+fl_val.material_path+'">'+fl_val.material_path+'</a></div></span>');
								break;
								case 'excel':
									$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/img/xls.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+fl_val.material_path+'" onclick="<?php echo $name;?>_deleteFile('+fl_val.id+', this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?><?php echo $uploader_object_type;?>/'+fl_val.object_id+'/'+fl_val.material_path+'">'+fl_val.material_path+'</a></div></span>');
								break;
								case 'word':
									$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/img/doc.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+fl_val.material_path+'" onclick="<?php echo $name;?>_deleteFile('+fl_val.id+', this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?><?php echo $uploader_object_type;?>/'+fl_val.object_id+'/'+fl_val.material_path+'">'+fl_val.material_path+'</a></div></span>');
								break;
								case 'html':
									$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/img/html.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+fl_val.material_path+'" onclick="<?php echo $name;?>_deleteFile('+fl_val.id+', this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?><?php echo $uploader_object_type;?>/'+fl_val.object_id+'/'+fl_val.material_path+'">'+fl_val.material_path+'</a></div></span>');
								break;
								case 'mp3':
									$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/img/mp3.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+fl_val.material_path+'" onclick="<?php echo $name;?>_deleteFile('+fl_val.id+', this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?><?php echo $uploader_object_type;?>/'+fl_val.object_id+'/'+fl_val.material_path+'">'+fl_val.material_path+'</a></div></span>');
								break;
								case 'text':
									$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/img/txt.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+fl_val.material_path+'" onclick="<?php echo $name;?>_deleteFile('+fl_val.id+', this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?><?php echo $uploader_object_type;?>/'+fl_val.object_id+'/'+fl_val.material_path+'">'+fl_val.material_path+'</a></div></span>');
								break;
								case 'zip':
									$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/img/zip.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+fl_val.material_path+'" onclick="<?php echo $name;?>_deleteFile('+fl_val.id+', this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?><?php echo $uploader_object_type;?>/'+fl_val.object_id+'/'+fl_val.material_path+'">'+fl_val.material_path+'</a></div></span>');
								break;
								case 'file':
									$('#<?php echo $name;?>-crud_edit_form #uploader_materials_div').append('<span style="float: left; padding-right: 7px;"><img id="file_'+<?php echo $name;?>_file_num+'" height="100" src="<?php echo Backstage::gi()->MATERIALS_URL;?>/temp/img/file.png" /><a href="#dummy" file_num="'+<?php echo $name;?>_file_num+'" file_name="'+fl_val.material_path+'" onclick="<?php echo $name;?>_deleteFile('+fl_val.id+', this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a><div><a href="<?php echo Backstage::gi()->MATERIALS_URL;?><?php echo $uploader_object_type;?>/'+fl_val.object_id+'/'+fl_val.material_path+'">'+fl_val.material_path+'</a></div></span>');
								break;								
							}
							<?php echo $name;?>_files[<?php echo $name;?>_file_num] = {id:fl_val.id, name: fl_val.material_path};
							<?php echo $name;?>_file_num++;
						});
					},
					error: function (request, status, error)
					{
						console.log(request.responseText);
					}
				});
			<?php
		}
		?>		
	}
	function <?php echo $name;?>_submit_crud_form(form, method)
	{
		for(var instanceName in CKEDITOR.instances)
		{
			CKEDITOR.instances[instanceName].updateElement();
		}
		//tinyMCE.triggerSave();
		$.ajax(
		{
			url: form.action,
			type: method,
			data: {
				form_values: JSON.stringify($(form).serializeJSON()),
				crud_data: '<?php echo $crud_data;?>',
				crud_params_form: JSON.stringify($('#<?php echo $name;?>-crud_params_form').serializeJSON()),
				files: JSON.stringify(<?php echo $name;?>_files),
				processors_data: JSON.stringify(<?php echo $name;?>_processors_data),
				additional_form: JSON.stringify($('#<?php echo $name;?>-crud_edit_modal #<?php echo $name;?>-crud_additional_form').serializeJSON())
			},
			success:function(data)
			{
				console.log(data);
				$('.<?php echo $name;?>-crud_modal').modal('hide');
				$('.modal-backdrop').remove();
				<?php echo $name;?>_load();
			},
			error: function (request, status, error)
			{
				console.log(request.responseText);
			}
		});

	}		
		// Add button click handler
    $('.<?php echo $name;?>-crud_add_btn').click(function(e)
    {
		$.ajax(
			{
				url:"<?php echo Backstage::gi()->portal_url;?>crud/buildForm",
				type: "POST",
				data: {
					form_type: "add",
					crud_data: '<?php echo $crud_data;?>',
					crud_params_form: JSON.stringify($('#<?php echo $name;?>-crud_params_form').serializeJSON())					
				},
				success:function(data)
				{
					$('#<?php echo $name;?>-crud_modal_body').html(data);
					crud_edit_form_activator();										
				
				},
				error: function (request, status, error)
				{
					console.log(request.responseText);
				}
			});
    });
	
		// Edit button click handler
    $('.<?php echo $name;?>-crud_edit_btn').click(function(e)
    {
		<?php echo $name;?>_current_id = $(this).attr("data-id");
		$.ajax(
			{
				url:"<?php echo Backstage::gi()->portal_url;?>crud/buildForm",
				type: "POST",
				data: {
					form_type: "edit",
					row_id: $(this).attr("data-id"),
					crud_data: '<?php echo $crud_data;?>',
					crud_params_form: JSON.stringify($('#<?php echo $name;?>-crud_params_form').serializeJSON())					
				},
				success:function(data)
				{
					$('#<?php echo $name;?>-crud_modal_body').html(data);
					crud_edit_form_activator();
				},
				error: function (request, status, error)
				{
					console.log(request.responseText);
				}
			});		
    });
	
		// View button click handler
    $('.<?php echo $name;?>-crud_view_btn').click(function(e)
    {
        $.each(<?php echo $name;?>_data['id'+$(this).attr("data-id")], function(el, val)
        {
            $("#<?php echo $name;?>-crud_view_"+el).html(val);
        });
    });

	$('.<?php echo $name;?>-crud_modal').on('shown.bs.modal', function()
	{
		$(document).off('focusin.modal');
	});


	$('#<?php echo $name;?>-crud_delete_all').click(function(e)
	{
		$("#<?php echo $name;?>-crud_search_form input[id^=crud_delete]").prop('checked', $(this).prop('checked'));
	});

    $('.<?php echo $name;?>-crud_delete_btn').click(function(e)
    {
        if (confirm("<?php echo Translations::gi()->are_you_sure; ?>"))
        {
			deleting_data = [];
			item = {
				id: $(this).attr("data-id"),
				table: $("#<?php echo $name;?>-crud_search_form input[id$=crud_delete_"+$(this).attr("data-id")+"]").attr("data-table")
			};
			deleting_data.push(item);
            $.ajax(
            {
                url:"<?php echo Backstage::gi()->portal_url;?>crud/delete/",
                type: "DELETE",
                data: {
					deleting_data: JSON.stringify(deleting_data),
					crud_data: '<?php echo $crud_data;?>',
					crud_params_form: JSON.stringify($('#<?php echo $name;?>-crud_params_form').serializeJSON())
				},
                success:function(data)
                {
					<?php echo $name;?>_load();
					console.log(data);
                },
                error: function (request, status, error)
				{
                    console.log(request.responseText);
                }
            });
        }
    });
    $('.<?php echo $name;?>-crud_delete_all_btn').click(function(e)
    {
        if (confirm("<?php echo Translations::gi()->are_you_sure; ?>"))
        {
			deleting_data = [];
			$("#<?php echo $name;?>-crud_search_form input[id^=crud_delete]").each(function(el, val)
            {
				if ($(this).prop('checked'))
				{
					item = {
						id: $(this).attr("data-id"),
						table: $(this).attr("data-table")
					};
					deleting_data.push(item);
				}
            });

            $.ajax(
            {
                url:"<?php echo Backstage::gi()->portal_url;?>crud/delete/",
                type: "DELETE",
                data: {
					deleting_data: JSON.stringify(deleting_data),
					crud_data: '<?php echo $crud_data;?>',
					crud_params_form: JSON.stringify($('#<?php echo $name;?>-crud_params_form').serializeJSON())
				},

                success:function(data)
                {
					<?php echo $name;?>_load();
                },
                error: function (request, status, error)
				{
                    console.log(request.responseText);
                }
            });
        }
    });

	$('.<?php echo $name;?>-crud_modal').on('hidden.bs.modal', function ()
	{
		for(name in CKEDITOR.instances)
		{
			CKEDITOR.instances[name].destroy();
		}

		//tinyMCE.remove();
		<?php echo $name;?>_load();
	});

    function showPopover(element, msg)
    {
		$(element).popover({html: true, container: 'body', content: msg})
			.popover('show')
			.blur(function () {
				$(this).popover('destroy');
			});
    }

	
    $('.<?php echo $name;?>-crud_page').click(function(e)
    {
        $("#<?php echo $name;?>-crud_params_form #crud_current_page").val($(this).attr("data-page"));
        <?php echo $name;?>_load();
        e.preventDefault();
        return false;
    });

		// Search form
    $('#<?php echo $name;?>-crud_search_form').submit(function(e) {
        <?php echo $name;?>_load();
        e.preventDefault();
    });

    $('#<?php echo $name;?>-crud_search_clear').click(function(e) {
        <?php echo $name;?>_resetForm("#<?php echo $name;?>-crud_search_form");
        <?php echo $name;?>_load();
        e.preventDefault();
    });

		// Count per page
    $('#<?php echo $name;?>-select_count_per_page').change(function(e){
        $("#<?php echo $name;?>-crud_params_form #crud_count_per_page").val($(this).val());
        <?php echo $name;?>_load();
        e.preventDefault();
    });
    $('#<?php echo $name;?>-select_count_per_page option[value="<?php echo $crud_count_per_page; ?>"]').prop('selected',true);

});


// Get children by parent id
function <?php echo $name;?>_getChildren(id, obj)
{
	$("#<?php echo $name;?>-crud_params_form #crud_parent_id").val(id);
	<?php echo $name;?>_load();
};

function <?php echo $name;?>_deleteFile(file_id, obj)
{
	if (confirm("Siz əminsiz?"))
	{
		//if (file_id > 0)
            $.ajax(
            {
                url:"<?php echo Backstage::gi()->portal_url;?>materials/deleteFile/",
                type: "DELETE",
                data: {id: file_id, file_name: $(obj).attr('file_name')},
                success:function(data)
                {
					console.log(data);
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
		$(obj).parent().remove();
		delete <?php echo $name;?>_files[$(obj).attr('file_num')];
	}
}

function <?php echo $name;?>_resetForm(form)
{
	<?php echo $name;?>_current_id = 0;
	var field_types = {};
	var types = ['LONG', 'TINY'];
	<?php
		foreach ($fields as $field)
		{
			echo 'field_types["'.$field['name'].'"] = "'.$field['type'].'";';
		}
	?>

	$.each(field_types, function(el, value)
	{
		//if ($.inArray(value, types) !== -1)
		//	$(form+" input:text[name$=\\^"+el+"]").val('0');
		//else
			$(form+" input:text[name$=\\^"+el+"]").val('');
	});
	

	//$(form).find('input:text, input[type="hidden"], input:password, input:file').val('');
	$(form).find('select').prop('selectedIndex',0);
	$(form+' input:checkbox').each(function(i,item)
	{ 
		this.checked = item.defaultChecked; 
	});
	
	$(form).find('input:radio').removeAttr('checked').removeAttr('selected');
	<?php echo $name;?>_file_num = 0;
	<?php echo $name;?>_files = {};
	<?php echo $name;?>_processors_data = {};
	$(form+' #uploader_materials_div').html('');
}

// Export button
$(".<?php echo $name;?>-crud_export_btn").click(function(e) {
	data_clone = $('#<?php echo $name;?>_data').clone();
	console.log(data_clone);
	data_clone.find('input,button,select').remove();
	data_clone.find('a').contents().unwrap();
	//console.log($(data_clone).html());
    window.open('data:application/vnd.ms-excel;charset=UTF-8,\uFEFF' + encodeURIComponent($(data_clone).html()));
    e.preventDefault();
});

// Print button
$(".<?php echo $name;?>-crud_print_btn").click(function(e) {

	data_clone = $('#<?php echo $name;?>_data').clone();
	data_clone.find('input, button, select').remove();
	data_clone.find('a').contents().unwrap();
	data_clone.find('td, th').css('font-size', '10px');
	data_clone.find('td, th').css('border', '1px solid grey');
	data_clone.find('table').css('border-collapse', 'collapse');
	data_clone.find('table').css('border-collapse', 'collapse');
	
	data_clone.find('tbody').find('tr').first().remove();
	data_clone.find('thead').find('th').first().remove();
	data_clone.find('tbody').find('td').first().remove();
	data_clone.find('thead').find('th').last().remove();
	data_clone.find('tbody').find('td').last().remove();
	data_clone.find('thead').find('th').first().remove();
	data_clone.find('tbody').find('td').first().remove();
	
	//data_clone.find('td:eq(1),th:eq(1)').remove();

	$.ajax(
	{
		url:"<?php echo Backstage::gi()->portal_url;?>crud/printIt/",
		type: "POST",
		data: {
			body : data_clone.html(),
			crud : '<?php echo $name; ?>',
			type : 'table'
		}
	}).done(function(print_response) {
			// $("<div/>", {
   //  			 text: print_response
			// }).print();
		console.log(print_response);
		$('#print_div').html(print_response);	
		$('#print_div').print();
	});
});


//Print Item button
$(".<?php echo $name;?>-crud_item_print_btn").click(function(e) {

	data_clone = $('#item_body').clone();
	data_clone.find('input, button, select').remove();
	data_clone.find('a').contents().unwrap();
	data_clone.find('td, th').css('font-size', '10px');
	data_clone.find('td, th').css('border', '1px solid grey');
	data_clone.find('table').css('border-collapse', 'collapse');

	$.ajax(
	{
		url:"<?php echo Backstage::gi()->portal_url;?>crud/printIt/",
		type: "POST",
		data: {
			body : data_clone.html(),
			crud : '<?php echo $name; ?>',
			type : 'item'
		}
	}).done(function(print_response) {
			// $("<div/>", {
   //  			 text: print_response
			// }).print();
		$('#print_div').html(print_response);	
		$('#print_div').print();
	});
});


function <?php echo $name;?>_additionalFormOpen(form_type, obj, table)
{
	form_id = $(obj).val();
	row_id = <?php echo $name;?>_current_id;
	$.ajax(
	{
		url:"<?php echo Backstage::gi()->portal_url;?>forms/getFormValues/",
		type: "GET",
		data: "form_id="+form_id+"&row_id="+row_id+"&table_name="+table+"&form_type="+form_type,
		success:function(data)
		{
			$('#<?php echo $name;?>-crud_edit_modal #<?php echo $name;?>-crud_additional_form_div').html(data);
			$('#<?php echo $name;?>-crud_edit_modal  #<?php echo $name;?>-crud_additional_form_div .nav-tabs a:first').tab('show');
            $('input.datetime').datetimepicker({language:'en-gb'});
		},
		error: function (request, status, error) {
			console.log(request.responseText);
		}
	});

};

function <?php echo $name;?>_inline_edit(obj, value)
{
	console.log(value);
	var position = $(obj).offset();
	var top_offset = parseInt($(obj).css("padding-left"));
	var left_offset = parseInt($(obj).css("padding-top"));
	var flying_field = '<input type="text" value="'+value+'" style="position: absolute; width: '+$(obj).width()+'px; top: '+(position.top+top_offset)+'px; left: '+(position.left+left_offset)+'px"/>';
	$(obj).append(flying_field);
}


</script>

<?php
		// Check the permissions
	if (Backstage::gi()->pretorian_check_level === 'a')
		$get_permitted = Pretorian::gi()->check($crud_params['orig_module_name'], 'GET')||Pretorian::gi()->check($crud_params['orig_module_name'], 'GET', $crud_params['orig_action_name']);
	else
		$get_permitted = Pretorian::gi()->check($crud_params['orig_module_name'], 'GET');

	if (Backstage::gi()->pretorian_check_level === 'a')
		$post_permitted = Pretorian::gi()->check($crud_params['orig_module_name'], 'POST')||Pretorian::gi()->check($crud_params['orig_module_name'], 'POST', $crud_params['orig_action_name']);
	else
		$post_permitted = Pretorian::gi()->check($crud_params['orig_module_name'], 'POST');

	if (Backstage::gi()->pretorian_check_level === 'a')
		$put_permitted = Pretorian::gi()->check($crud_params['orig_module_name'], 'PUT')||Pretorian::gi()->check($crud_params['orig_module_name'], 'PUT', $crud_params['orig_action_name']);
	else
		$put_permitted = Pretorian::gi()->check($crud_params['orig_module_name'], 'PUT');
		
	if (Backstage::gi()->pretorian_check_level === 'a')
		$delete_permitted = Pretorian::gi()->check($crud_params['orig_module_name'], 'DELETE')||Pretorian::gi()->check($crud_params['orig_module_name'], 'DELETE', $crud_params['orig_action_name']);
	else
		$delete_permitted = Pretorian::gi()->check($crud_params['orig_module_name'], 'DELETE');

?>

<div id="print_div" style="display:none"></div>
<div class="table-responsive">
    <?php 
	if (!in_array('add', $restrictions) && $post_permitted) {
     ?>
    <button type="button" data-id="0" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#<?php echo $name;?>-crud_edit_modal" class="<?php echo $name;?>-crud_add_btn btn btn-warning">
        <span class="glyphicon glyphicon-floppy-open"></span> <?php echo Translations::gi()->add_note; ?>
    </button>
    <?php } ?>
    <?php if (!in_array('export', $restrictions)) { ?>
    <button type="button" class="<?php echo $name;?>-crud_export_btn btn btn-info">
        <span class="glyphicon glyphicon-export"></span> Excel
    </button>
    <?php } ?>
	<?php if (!in_array('print', $restrictions)) { ?>
    <button type="button" class="<?php echo $name;?>-crud_print_btn btn btn-info">
        <span class="glyphicon glyphicon-print"></span> <?php echo Translations::gi()->print; ?>
    </button>
    <?php } 
	if (!in_array('delete', $restrictions) && $delete_permitted) {
     ?>
    <button type="button" class="<?php echo $name;?>-crud_delete_all_btn btn btn-danger">
        <span class="glyphicon glyphicon-floppy-remove"></span> <?php echo Translations::gi()->delete; ?>
    </button>
    <?php } ?>
	<form name="<?php echo $name;?>-crud_search_form" id="<?php echo $name;?>-crud_search_form">
    <div id="<?php echo $name;?>_data">
    <table class="table table-hover" id="crud-table">
        <?php
		
		// Header part of the table
		if (!empty($mapped_parents) && $parent_parent_id >= 0)
		{
			echo "<br/><a href='#dummy' onclick='".$name."_getChildren(\"".$parent_parent_id."\", this)'>< Back</a>";
		}
		echo '<thead><tr>';
			// Check all rows to be deleted
		echo '<th><input type="checkbox" data-target="'.$name.'" id="'.$name.'-crud_delete_all"/></th>';
		if (!empty($mapped_parents))
			echo '<th></th>';
		foreach ($fields as $field)
		{
			$data_order = '';
			$order_class = '';
			if ($order !== '' && preg_match('/(^|,)'.$field['name'].'[\s]+desc/', $order))
			{
				$data_order = 'desc';
				$order_class = 'glyphicon-sort-by-attributes-alt';
			}

			if ($order !== '' && preg_match('/(^|,)'.$field['name'].'[\s]+asc/', $order))
			{
				$data_order = 'asc';
				$order_class = 'glyphicon-sort-by-attributes';
			}
				// disabledTableFields is deprecated starting from 05-oct-2015. Use hideFields instead.
			if (!in_array($field['name'], $hidden_fields['table']) && !in_array($field['name'], $disabled_table_fields))  
			{				
				if (array_key_exists($field['name'], $titles))
					echo "<th><a href='#' class='$name-crud_header' data-column='{$field['name']}' data-order='$data_order'><span class='glyphicon $order_class'></span>{$titles[$field['name']]}</a></th>";
				else
					echo "<th><a href='#' class='$name-crud_header' data-column='{$field['name']}' data-order='$data_order'><span class='glyphicon $order_class'></span>{$field['name']}</a></th>";
			}
		}
		echo "<th></th>";
		echo '</tr></thead>';

		// Search panel
		if (!empty($search))
		{
			echo '<tr>';
			echo '<td></td>';
			if (!empty($mapped_parents))
				echo '<td></td>';
			foreach ($fields as $field)
			{
				$value = '';
				$search_input = '';
				if (in_array($field['name'], $search) || $search[0] === '*')
				{
					if (isset($crud_search_form[$field['table'].'^'.$field['name']]))
						$value = $crud_search_form[$field['table'].'^'.$field['name']];
					if (array_key_exists($field['name'], $mapped_search))
					{
						$search_input_part1 = substr($mapped_search[$field['name']], 0, strpos($mapped_search[$field['name']], ':'));
						$search_input_part2 = substr($mapped_search[$field['name']], strpos($mapped_search[$field['name']], ':')+1);
						switch ($search_input_part1)
						{
							case 'select':
								$search_input = '<select id="'.$field['table'].'-'.$field['name'].'" name="'.$field['table'].'^'.$field['name'].'" class="form-control input-sm">';
								$search_input .= '<option value="">-</option>';
								$select = json_decode($search_input_part2, true);
								foreach ($select as $option_value=>$option_desc)
								{
									$selected = '';
									if ($option_value == $value) $selected = 'selected';
									$search_input .= '<option value="'.$option_value.'" '.$selected.'>'.$option_desc.'</option>';
								}
								$search_input .= '</select>';
							break;
						}
					}
					else
						$search_input = '<input id="'.$field['table'].'-'.$field['name'].'" name="'.$field['table'].'^'.$field['name'].'" value="'.$value.'" class="form-control input-sm" />';
				}
				if (!in_array($field['name'], $hidden_fields['table']) && !in_array($field['name'], $disabled_table_fields))
					echo '<td>'.$search_input.'</td>';
			}
			?>
			<td width="130px" class="text-center">
				<select name="search_condition">
					<option value="like" <?php if ($crud_search_condition === 'like') echo 'selected';?>><?php echo Translations::gi()->similar; ?></option>
					<option value="not like" <?php if ($crud_search_condition === 'not like') echo 'selected';?>><?php echo Translations::gi()->different; ?></option>
					<option value=">" <?php if ($crud_search_condition === '>') echo 'selected';?>><?php echo Translations::gi()->greater; ?></option>
					<option value="<" <?php if ($crud_search_condition === '<') echo 'selected';?>><?php echo Translations::gi()->less; ?></option>
				</select>
                <br>
				<button type="submit" title="<?php echo Translations::gi()->search; ?>" class="btn btn-info btn-sm">
					<span class="glyphicon glyphicon-search"></span>
				</button>
				<button type="reset" title="<?php echo Translations::gi()->reset; ?>" class="btn btn-danger btn-sm" id="<?php echo $name;?>-crud_search_clear">
					<span class="glyphicon glyphicon-remove"></span>
				</button>
			</td>
			<?php
			echo '</tr>';
		}

                // Rows
		foreach ($rows as $row)
		{
			$format_class = '';
			// Set CSS formatting by rules
			foreach ($format_rules as $rule_key=>$rule_val)
			{
				$rule_key_parts = preg_split("/([<=|>=|<|>|=]+)/", $rule_key, -1, PREG_SPLIT_DELIM_CAPTURE);
				switch (trim($rule_key_parts[1]))
				{
					case '>':
						if ($row->{trim($rule_key_parts[0])} > trim($rule_key_parts[2]))
							$format_class = $rule_val;
					break;
					case '<':
						if ($row->{trim($rule_key_parts[0])} < trim($rule_key_parts[2]))
							$format_class = $rule_val;
					break;
					case '>=':
						if ($row->{trim($rule_key_parts[0])} >= trim($rule_key_parts[2]))
							$format_class = $rule_val;
					break;
					case '<=':
						if ($row->{trim($rule_key_parts[0])} <= trim($rule_key_parts[2]))
							$format_class = $rule_val;
					break;
					case '=':
						if ($row->{trim($rule_key_parts[0])} == trim($rule_key_parts[2]))
							$format_class = $rule_val;
					break;
				}
			}

			echo "<tr id='row_".$row->{$ids[0]}."' class='$format_class'>";

				// Check for delete
			foreach ($fields as $field)
				if (strtoupper($field['name']) === strtoupper($ids[0]))
				{
					echo '<td><input type="checkbox" data-table="'.$field['table'].'" data-id="'.$row->{$ids[0]}.'" id="crud_delete_'.$row->{$ids[0]}.'" value="1"/></td>';
					break;
				}
				// Parent open cell
			if (!empty($mapped_parents))
				echo "<td class='text-center'><a href='#dummy' id='crud_parent_".$row->{key($mapped_parents)}."' onclick='".$name."_getChildren(\"".$row->{key($mapped_parents)}."\", this)'>+ (COUNT:".$row->child_count.")</a></td>";
			foreach ($fields as $field)
			{
					// Field cells							

				if (!in_array($field['name'], $hidden_fields['table']) && !in_array($field['name'], $disabled_table_fields))
				{
					$td_inline_edit = '';
					if (is_array($row->{$field['name']}))
						$value = $row->{$field['name']}[Backstage::gi()->portal_current_lang]->translation;
					else
					{
						if (array_key_exists($field['name'], $mapped_values_f))
						{
		                    $functionp = explode("#", ($mapped_values_f->{$field['name']}));
	                        $function = create_function($functionp[0], $functionp[1]);
	                        $value = $function($row->{$field['name']});
						}
						elseif (array_key_exists($field['name'], $mapped_values) && array_key_exists((String)$row->{$field['name']}, $mapped_values[$field['name']])) 
						{
	                        $value = $mapped_values[$field['name']][$row->{$field['name']}];
						}
						else
						{
	                        $value = $row->{$field['name']};
							if (in_array($field['name'], $inline_edit_fields))
								$td_inline_edit = "onclick=\"{$name}_inline_edit(this, '".$row->{$field['name']}."');\"";
						}
					}
						// Format the view of the values
					foreach ($fields_formats as $key=>$fields_format)
					{
						if (in_array($field['name'], $fields_format['table']))
							switch ($key)
							{
								case 'text': $value = htmlspecialchars($value);
								break;
							}
					}
					if (array_key_exists($field['name'], $links))
						echo "<td $td_inline_edit><a href='#dummy' id='crud_link_".$row->{$ids[0]}."' onclick='".$links[$field['name']]."(".$row->{$ids[0]}.", \"".$value."\", this)'>".$value."</a></td>";
					else
						echo "<td $td_inline_edit>".$value."</td>";					
				}
			}
			echo '<td width="130px">';
			if (!in_array('view', $restrictions) && $get_permitted)
			{
				// View button
				echo '<button type="button" title="'.Translations::gi()->view.'" data-id="'.$row->{$ids[0]}.'" data-toggle="modal" data-target="#'.$name.'-crud_view_modal" class="'.$name.'-crud_view_btn btn btn-info btn-xs">';
				echo '<span class="glyphicon glyphicon-floppy-disk"></span>';
				echo '</button>';
			}
			if (!in_array('edit', $restrictions) && $put_permitted)
			{
				// Edit button
				echo '<button type="button" title="'.Translations::gi()->edit.'" data-id="'.$row->{$ids[0]}.'" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#'.$name.'-crud_edit_modal" class="'.$name.'-crud_edit_btn btn btn-warning btn-xs">';
				echo '<span class="glyphicon glyphicon-floppy-save"></span>';
				echo '</button>';
			}
			if (!in_array('delete', $restrictions) && $delete_permitted)
			{
				// Delete button
				echo '<button type="button" title="'.Translations::gi()->delete.'" data-id="'.$row->{$ids[0]}.'" class="'.$name.'-crud_delete_btn btn btn-danger btn-xs">';
				echo '<span class="glyphicon glyphicon-floppy-remove"></span>';
				echo '</button>';
			}
				// Custom buttons
			foreach ($buttons as $button_method => $button)
			{
				echo '<button type="button" title="'.$button['title'].'" data-id="'.$row->{$ids[0]}.'" onclick="'.$button_method.'('.$row->{$ids[0]}.', this)" class="'.$name.'-crud_'.$button_method.'_btn btn btn-info btn-xs">';
				echo '<span class="'.$button['style'].'"></span>';
				echo '</button>';
			}
				// Custom conditional buttons
			foreach ($buttons_if as $button_method => $button)
			{
				if (in_array($row->{$button['field']}, $button['values']))
				{
					echo '<button type="button" title="'.$button['title'].'" data-id="'.$row->{$ids[0]}.'" onclick="'.$button_method.'('.$row->{$ids[0]}.', this)" class="'.$name.'-crud_'.$button_method.'_btn btn btn-info btn-xs">';
					echo '<span class="'.$button['style'].'"></span>';
					echo '</button>';
				}
			}
			echo '</td>';
			echo '</tr>';
		}
                if (!empty($totals))
                {
                    echo '<tr><td></td>';
                    foreach ($fields as $field)
                    {
                        if (array_key_exists($field['name'], $totals))
                            echo '<td><b>'.$totals[$field['name']].'</b></td>';
                        else
                            echo '<td></td>';
                    }
                    echo '<td></td></tr>';
                }
		?>
    </table>
    </div>
	</form>
        <div>
	<?php // Pagination part
				echo '<div class="col-xs-2"><b>'.Translations::gi()->total_count.': '.$crud_total_count.'</b></div>';

                echo '<div class="col-xs-2"><select id="'.$name.'-select_count_per_page" name="'.$name.'-select_count_per_page" class="form-control">';
                echo '<option value="5">5</option>';
                echo '<option value="10">10</option>';
                echo '<option value="50">50</option>';
                echo '<option value="0">'.Translations::gi()->all.'</option>';
                echo '</select></div>';
		if ($crud_pages_count > 1)
		{
			echo '<div class="col-md-10"><ul class="pagination" style="margin: 0 0;">';
			if ($crud_current_page != 1)
				echo '<li><a href="#" data-page="1" class="'.$name.'-crud_page">&laquo;</a></li>';
			if ($crud_pages_count <= 15)
			{
				for ($i=1; $i<=$crud_pages_count; $i++)
				{
					if ($i == $crud_current_page)
						echo '<li class="active"><a href="#" data-page="'.$i.'" class="'.$name.'-crud_current_page">'.$i.' <span class="sr-only">(current)</span></a></li>';
					else
						echo '<li><a href="#" data-page="'.$i.'" class="'.$name.'-crud_page">'.$i.'</a></li>';
				}
			}
			elseif ($crud_current_page >= 5 &&  $crud_current_page <= $crud_pages_count-4)
			{
				for ($i=1; $i<=2; $i++)
				{
					echo '<li><a href="#" data-page="'.$i.'" class="'.$name.'-crud_page">'.$i.'</a></li>';
				}
				echo '<li><a href="#">...</a></li>';
				for ($i=$crud_current_page-1; $i<=$crud_current_page+1; $i++)
				{
					if ($i == $crud_current_page)
						echo '<li class="active"><a href="#" data-page="'.$i.'" class="'.$name.'-crud_current_page">'.$i.' <span class="sr-only">(current)</span></a></li>';
					else
						echo '<li><a href="#" data-page="'.$i.'" class="'.$name.'-crud_page">'.$i.'</a></li>';
				}
				echo '<li><a href="#">...</a></li>';
				for ($i=$crud_pages_count-1; $i<=$crud_pages_count; $i++)
				{
					echo '<li><a href="#" data-page="'.$i.'" class="'.$name.'-crud_page">'.$i.'</a></li>';
				}
			}
			else
			{
				for ($i=1; $i<=5; $i++)
				{
					if ($i == $crud_current_page)
						echo '<li class="active"><a href="#" data-page="'.$i.'" class="'.$name.'-crud_current_page">'.$i.' <span class="sr-only">(current)</span></a></li>';
					else
						echo '<li><a href="#" data-page="'.$i.'" class="'.$name.'-crud_page">'.$i.'</a></li>';
				}
				echo '<li><a href="#">...</a></li>';
				for ($i=$crud_pages_count-4; $i<=$crud_pages_count; $i++)
				{
					if ($i == $crud_current_page)
						echo '<li class="active"><a href="#" data-page="'.$i.'" class="'.$name.'-crud_current_page">'.$i.' <span class="sr-only">(current)</span></a></li>';
					else
						echo '<li><a href="#" data-page="'.$i.'" class="'.$name.'-crud_page">'.$i.'</a></li>';
				}
			}
				if ($crud_current_page != $i-1)
					echo '<li><a href="#" data-page="'.($i-1).'" class="'.$name.'-crud_page">&raquo;</a></li>';
			echo '</ul></div>';
		}
		
	/**
	 * Is used to separately create "add" and "edit" forms
	 *
	 * @param string Form type ("add" or "edit")
	 * @return object "HTML code"
	 */
 if (!!array_diff(array('add','edit'), $restrictions)) 
 { 
	
	?>
	</div>
</div>

<!-- Modal add & edit -->
<div class="modal fade <?php echo $name;?>-crud_modal" id="<?php echo $name;?>-crud_edit_modal" tabindex="-1" role="dialog" aria-labelledby="add_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="add_label">Elave etmek</h4>
      </div>
      <div class="modal-body" id="<?php echo $name;?>-crud_modal_body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Translations::gi()->close; ?></button>
        <button type="button" class="btn btn-primary" id="<?php echo $name;?>-crud_save_btn"><?php echo Translations::gi()->save; ?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal edit -->


<!-- Modal LQ -->
<div class="modal fade" id="insertLQModal" tabindex="-1" role="dialog" aria-labelledby="view_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="view_label">Add LQ</h4>
            </div>
            <div class="modal-body">
                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="lqTypes" class="active"><a href="#LQcontainer" aria-controls="LQcontainer" role="tab" data-toggle="tab">Container</a></li>
                        <li role="lqTypes"><a href="#LQmodule" aria-controls="LQmodule" role="tab" data-toggle="tab">Module</a></li>
                        <li role="lqTypes"><a href="#LQTranslation" aria-controls="LQTranslation" role="tab" data-toggle="tab">Translation</a></li>
                        <li role="lqTypes"><a href="#LQconstant" aria-controls="LQconstant" role="tab" data-toggle="tab">Constant</a></li>
                        <li role="lqTypes"><a href="#LQparameter" aria-controls="LQparameter" role="tab" data-toggle="tab">Parameter</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content lqBlocks">
                        <div role="tabpanel" class="tab-pane active" id="LQcontainer">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="containerName" class="col-sm-2 control-label">Container name</label>
                                    <div class="col-sm-7">
                                        <input type="containerName" class="form-control" id="containerName" placeholder="Name">
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="getLQ btn btn-primary" rel="container">Get LQ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="LQmodule">
                            <b>Select module</b>
                            <?php
                                $modulesArray = array('Contents' => 'contents', 'Catalogs' => 'catalogs');
                                foreach ($modulesArray as $moduleName=>$moduleID){
                                    echo '<div class="radio">
                                                <label>
                                                    <input type="radio" class="moduleType" name="moduleType" value="'.$moduleID.'">
                                                    '.$moduleName.'
                                                </label>
                                            </div>';
                                }
                            ?>
                            <div class="form-group" style="display:none;">
                                <label for="moduleName">Select module name</label>
                                <select id="moduleName" class="moduleName form-control" name="moduleName">
                                </select>
                            </div>
                            <div class="form-group" style="display:none;">
                                <label for="catalogItems">Select catalog items (or leave it empty if you want to show all)</label>
                                <select multiple id="catalogItems" class="catalogItems form-control" name="catalogItems">
                                </select>
                            </div>
                            <input type="hidden" class="actionModule" id="actionModule">
                            <div class="form-group" style="display:none;">
                                <label for="designName">Select design</label>
                                <select id="designName" class="designName form-control" name="designName">
                                </select>
                            </div>
                            <div class="form-group" style="display:none;">
                                <label for="materialDesignName">Select material design</label>
                                <select id="materialDesignName" class="materialDesignName form-control" name="materialDesignName">
                                </select>
                            </div>
                            <div class="form-group" style="display:none;">
                                <div class="col-sm-6">
                                    <label for="countNavigation" class="control-label">Items per page</label>
                                    <input type="countNavigation" class="form-control countNavigation" id="countNavigation" placeholder="10">
                                </div>
                                <div class="col-sm-6">
                                    <label for="countNavigation" class="control-label">Navigation design</label>
                                    <select id="navigationDesignName" class="navigationDesignName form-control" name="navigationDesignName">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="display:none;">
                                <br><br><br><br>
                                <label for="materialDesignName">Write container name (or create it)</label>
                                    <div class="input-group">
                                      <span class="input-group-addon">
                                        Create <input type="checkbox" class="containerIsExist">
                                      </span>
                                    </div><!-- /input-group -->
                                <input type="text" class="containerName form-control" id="containerName" name="containerName">
                            </div>
                            <div class="col-sm-12 text-center">
                                <button type="button" class="getLQ btn btn-primary" rel="module">Get LQ</button>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="LQTranslation">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="translationName" class="col-sm-2 control-label">Translation name</label>
                                    <div class="col-sm-7">
                                        <input type="translationName" class="form-control" id="translationName" placeholder="Name">
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="getLQ btn btn-primary" rel="translation">Get LQ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="LQconstant">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="constantName" class="col-sm-2 control-label">Constant name</label>
                                    <div class="col-sm-7">
                                        <input type="constantName" class="form-control" id="constantName" placeholder="Constant">
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="getLQ btn btn-primary" rel="constant">Get LQ</button>
                                    </div>
                                    <div class="col-sm-12">
                                        <br><br>
                                        <?php
                                        $constantsArray = array(
                                            '$portal_url' => 'Portal URL',
                                            '$TEMPLATE_URL' => 'Template directory URL',
                                            '$EXTERNAL_URL' => 'External directory URL',
                                            'navigation' => 'Pagination (for catalogs)',
                                            'pnum' => 'Number of page, pagination (for catalogs)',
                                            'structure' => 'Structure of block',
                                            'files' => 'Get all files',
                                            'first_file' => 'Get first file'
                                        )
                                        ?>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>LQ</th>
                                                    <th>Description</th>
                                                </tr>
                                                <?php
                                                foreach($constantsArray as $constantName=>$constantDesc){
                                                    echo '<tr>
                                                                <td style="line-height:0.5px"><a class="lqRowConstants" href="#">[[' . $constantName . ']]</a></td>
                                                                <td style="line-height:0.5px">' . $constantDesc . '</td>
                                                            </tr>';                                                }
                                                ?>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="LQparameter">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="parameterName" class="col-sm-2 control-label">Parameter name</label>
                                    <div class="col-sm-7">
                                        <input type="parameterName" class="form-control" id="parameterName" placeholder="Parameter">
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="getLQ btn btn-primary" rel="parameter">Get LQ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="text-center">
                        <a class="lqRow" href="#"></a>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php } ?>

<!-- Modal view -->
<div class="modal fade" id="<?php echo $name;?>-crud_view_modal" tabindex="-1" role="dialog" aria-labelledby="view_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="view_label">Baxmaq</h4>
      </div>
      <div id="item_body" class="modal-body">
      	<?php if (!in_array('print', $restrictions)) { ?>
    <button type="button" class="<?php echo $name;?>-crud_item_print_btn btn btn-info">
        <span class="glyphicon glyphicon-print"></span> Print
    </button>
    <?php } ?>
		<dl class="dl-horizontal">
		<?php
			foreach ($fields as $field)
			{
				if (array_key_exists($field['name'], $titles))
					echo '<dt>'.$titles[$field['name']].':</dt> <dd class="clearfix"><span id="'.$name.'-crud_view_'.$field['name'].'"></span></dd>';
				else
					echo '<dt>'.$field['name'].':</dt> <dd class="clearfix"><span id="'.$name.'-crud_view_'.$field['name'].'"></span></dd>';
			}
		?>
		</dl>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Translations::gi()->close; ?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
