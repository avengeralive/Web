
<script type="text/javascript">
$(document).ready(function()
	{
	$(addoperator_form).validate(
		{
		rules:
			{
			email:
				{
				email: true,
				required: true,
				minlength: 6,
				maxlength: 40
				},
			password1:
				{
				required: true,
				minlength: 6,
				maxlength: 40
				},
			password2:
				{
				required: true,
				minlength: 6,
				maxlength: 40,
				equalTo: "#password1"
				}			
			},
		messages:
			{
			email:
				{
				required: "<?php echo $loc['reg']['t11']; ?>",
				email: "<?php echo $loc['reg']['t12']; ?>",
				minlength: "<?php echo $loc['reg']['t13']; ?>",
				maxlength: "<?php echo $loc['reg']['t14']; ?>"
				},
			password1:
				{
				required: "<?php echo $loc['reg']['t15']; ?>",
				minlength: "<?php echo $loc['reg']['t16']; ?>",
				maxlength: "<?php echo $loc['reg']['t17']; ?>"
				},
			password2:
				{
				required: "<?php echo $loc['reg']['t18']; ?>",
				minlength: "<?php echo $loc['reg']['t19']; ?>",
				maxlength: "<?php echo $loc['reg']['t20']; ?>",
				equalTo: "<?php echo $loc['reg']['t21']; ?>"
				}
			}
		});
	});
</script>
