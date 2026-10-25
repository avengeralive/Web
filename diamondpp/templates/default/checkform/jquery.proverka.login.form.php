
<script type="text/javascript">
$(document).ready(function()
	{
	$(login_form).validate(
		{
		errorClass: "errorclass",
		validClass: "validclass",
		success: function(element) 
			{
			$(element).addClass("validclass");
			$(element).parent().addClass("validclass");
			$(element).siblings().addClass("validclass");
			},		
		rules:
			{
			login_email:
				{
				email: true,
				required: true,
				minlength: 6,
				maxlength: 40
				},
			login_password:
				{
				required: true,
				minlength: 6,
				maxlength: 40
				}
			},
		messages:
			{
			login_email:
				{
				required: "<?php echo $loc['auth']['t07']; ?>",
				email: "<?php echo $loc['auth']['t08']; ?>",
				minlength: "<?php echo $loc['auth']['t09']; ?>",
				maxlength: "<?php echo $loc['auth']['t10']; ?>"
				},
			login_password:
				{
				required: "<?php echo $loc['auth']['t11']; ?>",
				minlength: "<?php echo $loc['auth']['t12']; ?>",
				maxlength: "<?php echo $loc['auth']['t13']; ?>"
				}
			}
		});	
	});
</script>
