
<script type="text/javascript">
$(document).ready(function()
	{
	$(addredirect_form).validate(
		{
		rules:
			{
			description:
				{
				required: true,
				minlength: 1,
				maxlength: 100
				},
			destination:
				{
				required: true,
				minlength: 1,
				maxlength: 250
				}				
			},
		messages:
			{
			description:
				{
				required: "<?php echo $loc['system_tds.php']['t34']; ?>",
				minlength: "<?php echo $loc['system_tds.php']['t35']; ?>",
				maxlength: "<?php echo $loc['system_tds.php']['t36']; ?>"
				},
			destination:
				{
				required: "<?php echo $loc['system_tds.php']['t37']; ?>",
				minlength: "<?php echo $loc['system_tds.php']['t38']; ?>",
				maxlength: "<?php echo $loc['system_tds.php']['t39']; ?>"
				}
			}
		});
	});
</script>	
	