<?php require_once(Backstage::gi()->ADMIN_TEMPLATE_DIR.'views/header.php'); ?>

<script type="text/javascript" charset="utf-8">
	$(function()
	{
	
		$('#auth_form').bootstrapValidator({
		      feedbackIcons: {
		            valid: 'glyphicon glyphicon-ok',
		            invalid: 'glyphicon glyphicon-remove',
		            validating: 'glyphicon glyphicon-refresh'
		        },
		        excluded: '',
						fields : {
						   	 login: {
						   	 	validators: {
						   	 		notEmpty: {
						   	 		 message : '<?php echo Translations::gi()->validation_hint_notEmpty; ?>' 
						   	 		}
						   	 	}
						   	 },
						   	 password: {
						   	 	validators: {
						   	 		notEmpty: {
						   	 		 message : '<?php echo Translations::gi()->validation_hint_notEmpty; ?>' 
						   	 		}
						   	 	}
						   	 }
						}
		}).on('success.form.bv', function(e) //if validation successful 
			{
				e.preventDefault();
				submit_auth_form();
			});
		//END Validation	
	
	    function submit_auth_form()
	    {   
			$.ajax(
			{
	            url: '<?php echo Backstage::gi()->portal_url;?>auth/login',
				type: "GET",
				data: $('#auth_form').serialize(),
				success:function(data, status, jqxhr)
				{
					console.log('request done: '+data);
					if (data == 0)
					{
						$('#status').html('Login və/və ya parol yanlışdır.');
					}
					else
					{	
						$.cookie('AUTH', data, {expires: 4, path: '<?php echo Backstage::gi()->portal_url_wo_domain;?>'});
						location.reload(false);
					}
	              
				},
				error: function (request, status, error) {
					console.log(request.responseText);
				}                        
			}); 
	    }
	});

</script>

<div class="jumbotron">
<div class="container">
<div id="status"></div>
<form name="auth_form" id="auth_form" role="form" class="form-horizontal" action="<?php echo Backstage::gi()->portal_url;?>auth/login/" method="post">
	<div class="form-group">
		<label for="login" class="col-sm-2 control-label">Login</label>
			<div class="col-xs-9">
				<input type="text" id="login" name="login" class="form-control input-sm" />
			</div>
			<div class="form_hint"><span class="validation"></span></div>			
	</div>		
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">Parol</label>
			<div class="col-xs-9">
				<input type="password" id="password" name="password" class="form-control input-sm" />
			</div>
			<div class="form_hint"><span class="validation"></span></div>			
	</div>
	<center><button type="submit" class="btn btn-primary" id="auth_submit">Daxil ol</button></center>
</form>
</div>
</div>


<?php require_once(Backstage::gi()->ADMIN_TEMPLATE_DIR.'views/footer.php');  ?>
