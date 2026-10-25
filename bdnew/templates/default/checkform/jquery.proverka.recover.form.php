
<script type="text/javascript">
$(document).ready(function()
	{
	$(recover_form).validate(
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
			recover_email:
				{
				email: true,
				required: true,
				minlength: 6,
				maxlength: 40
				}
			},
		messages:
			{
			recover_email:
				{
				required: "<?php echo $loc['recover.php']['t09']; ?>",
				email: "<?php echo $loc['recover.php']['t10']; ?>",
				minlength: "<?php echo $loc['recover.php']['t11']; ?>",
				maxlength: "<?php echo $loc['recover.php']['t12']; ?>"
				}
			}
		});	
	});
</script>
