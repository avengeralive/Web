
<script type="text/javascript">
$(document).ready(function()
	{
	$(form_ticket_reply).validate(
		{
		rules:
			{
			text:
				{
				required: true,
				minlength: 2,
				maxlength: 500
				},				
				
			},
		messages:
			{
			text:
				{
				required: "<?php echo $loc['tickets.php']['t35']; ?>",
				minlength: "<?php echo $loc['tickets.php']['t36']; ?>",
				maxlength: "<?php echo $loc['tickets.php']['t37']; ?>"
				}
			}
		});
	});
</script>	
	