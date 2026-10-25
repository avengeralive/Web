
<script type="text/javascript">
$(document).ready(function()
	{
	$(domains_form).validate(
		{
		rules:
			{
			domain:
				{
				required: true,
				minlength: 5,
				maxlength: 30
				}
			},
		messages:
			{
			domain:
				{
				required: "<?php echo $loc['domains.php']['t20']; ?>",
				minlength: "<?php echo $loc['domains.php']['t21']; ?>",
				maxlength: "<?php echo $loc['domains.php']['t22']; ?>"
				}
			}
		});
	});
</script>	
	