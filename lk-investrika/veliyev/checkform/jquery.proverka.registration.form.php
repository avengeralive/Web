
<script type="text/javascript">
$(document).ready(function()
	{
	$(registration_form).validate(
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
			registration_email:
				{
				email: true,
				required: true,
				minlength: 6,
				maxlength: 40
				},
			registration_password_1:
				{
				required: true,
				minlength: 6,
				maxlength: 40
				},
			registration_password_2:
				{
				required: true,
				minlength: 6,
				maxlength: 40,
				equalTo: "#registration_password_1"
				},	
			registration_tip:
				{
				required: true
				},				
			registration_agree_rules:
				{
				required: true
				}				
			},
		messages:
			{
			registration_email:
				{
				required: "<?php echo $loc['reg']['t11']; ?>",
				email: "<?php echo $loc['reg']['t12']; ?>",
				minlength: "<?php echo $loc['reg']['t13']; ?>",
				maxlength: "<?php echo $loc['reg']['t14']; ?>"
				},
			registration_password_1:
				{
				required: "<?php echo $loc['reg']['t15']; ?>",
				minlength: "<?php echo $loc['reg']['t16']; ?>",
				maxlength: "<?php echo $loc['reg']['t17']; ?>"
				},
			registration_password_2:
				{
				required: "<?php echo $loc['reg']['t18']; ?>",
				minlength: "<?php echo $loc['reg']['t19']; ?>",
				maxlength: "<?php echo $loc['reg']['t20']; ?>",
				equalTo: "<?php echo $loc['reg']['t21']; ?>"
				},	
			registration_tip:
				{
				required: "<?php echo $loc['reg']['t22']; ?>"
				},
			registration_agree_rules:
				{
				required: "<?php echo $loc['reg']['t23']; ?>"
				}
			}
		});
	});
</script>
