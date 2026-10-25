<script type="text/javascript" charset="utf-8">
var form_send_file_num = 0;
var form_send_files = [];

function form_send_deleteFile(file_id, obj)
{
	if (confirm("Siz əminsiz?"))
	{
		if (file_id > 0)
            $.ajax(
            {
                url:"<?php echo Backstage::gi()->portal_url;?>materials/deleteFile/",
                type: "DELETE",
                data: {id: file_id},
                success:function(data)
                {
					console.log(data);
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
		$(obj).parent().remove();
		form_send_files.splice(obj.file_num,1);
	}
}

$(function()
{    

	$('#form_send_mail #uploader_materials').uploadify({
		'swf'      : '<?php echo Backstage::gi()->MATERIALS_URL; ?>temp/uploadify.swf',
		'uploader' : '<?php echo Backstage::gi()->MATERIALS_URL; ?>temp/uploadify.php?session_id=<?php echo session_id(); ?>',
		'multi'    : true,
		'wmode'      : 'transparent',
		'buttonImg': " ",
		//'fileTypeExts' : '*.jpg; *.jpeg; *.png; *.gif',
		//'fileTypeDesc' : 'JPG Image Files (*.jpg); JPEG Image Files (*.jpeg); PNG Image Files (*.png), GIF (*.gif)',
		'onUploadSuccess': function(file, data, response)
		{
			$('#form_send_mail #uploader_materials_div').append('<span style="padding-right: 7px;">'+file.name+'<a href="#dummy" file_num="'+form_send_file_num+'" onclick="form_send_deleteFile(0, this);"><span style="vertical-align: top;" class="glyphicon glyphicon-remove"></span></a></span>');
			form_send_files[form_send_file_num] = {id:0, name: file.name};
			form_send_file_num++;
		}
	});

	$('#emails_select_all').click(function(e)
	{
		$("#subscribers_list input[id^=subscriber]").prop('checked', $(this).prop('checked'));
	});

	$('#send_btn').click(function(e)
	{
		for(var instanceName in CKEDITOR.instances)
			CKEDITOR.instances[instanceName].updateElement();
		
		emails_data = [];
		$("#subscribers_list input[id^=subscriber]").each(function(el, val)
		{
			if ($(this).prop('checked'))
			{
				emails_data.push($(this).attr("data-email"));
			}
		});

		$('#emails').val(JSON.stringify(emails_data));

		$.ajax(
		{
			url: portal_url + "subscribers/sendMail/",
			type: "PUT",
			data: {
				form_values: JSON.stringify($('#form_send_mail').serializeJSON()),
				files: JSON.stringify(form_send_files)
			},
			success:function(data)
			{
				alert(data);
			},
			error: function (request, status, error)
			{
				console.log(request.responseText);
			}
		});		
		e.preventDefault();
	});		
	
});

		

</script>  
<div class="row">
	<div class="col-xs-2" style="overflow: hidden;">
		<div id="subscribers_list"  style="height: 500px; max-height: 500px; overflow-y: scroll;">
			<table class="table table-hover" id="crud-table">
			<?php
				echo '<thead><tr>';
					// Check all rows to be deleted
				echo '<th><input type="checkbox" id="emails_select_all"/></th>';
				echo "<th>eMail</th>";
				echo '</tr></thead>';
				
				echo '<tbody>';
				foreach ($subscribers as $subscriber)
				{
					echo '<tr>';
					echo '<td><input type="checkbox" data-email= "'.$subscriber->email.'" data-id="'.$subscriber->id.'" id="subscriber_'.$subscriber->id.'" value="1"/></td>';
					echo '<td>'.$subscriber->email.'</td>';
					echo '</tr>';
				}
				echo '</tbody>';
			?>
			</table>
		</div>
	</div>
	<div class="col-xs-10">
			<form name="form_send_mail" id="form_send_mail" action="<?php echo Backstage::gi()->portal_url; ?>subscribers/sendMail/" class="form-horizontal" method="post" enctype="multipart/form-data">
				<input id="emails" name="emails" type="hidden" value=""/>
				<div class="form-group">
					<label for="title" class="col-sm-2 control-label required">Title</label>
					<div class="col-xs-9">
						<input id="title" name="title" type="text" class="form-control input-sm" />
					</div>					
					<div class="form_hint"><span class="validation"></span></div>
				</div>
				<div class="form-group">
					<label for="message" class="col-sm-2 control-label required">Message</label>
					<div class="col-xs-9">
						<textarea id="message" name="message" class="ckeditor form-control input-sm"></textarea>
					</div>
					<div class="form_hint"><span class="validation"></span></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Files</label>
					<div class="col-xs-9">
						<div id="uploader_materials_div"></div>
						<br/>
						<input type="file" id="uploader_materials" name="uploader_materials" multiple="multiple" style="visibility:hidden;"/>
					</div>
				</div>				
				<div class="form-group">
					<label for="file" class="col-sm-2 control-label"></label>
					<div class="col-xs-9">
						<button type="button" id="send_btn" name="send_btn" class="btn btn-info">Send</button>
					</div>					
				</div>
				
			</form>            
	</div>
</div>
