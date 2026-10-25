
<script type="text/javascript">
$(document).ready(function()
	{
	$(form_tickets).validate(
		{
		rules:
			{
			theme:
				{
				required: true,
				minlength: 10,
				maxlength: 80
				},
			text:
				{
				required: true,
				minlength: 30,
				maxlength: 500
				},				
				
			},
		messages:
			{
			theme:
				{
				required: "<?php echo $loc['tickets.php']['t38']; ?>",
				minlength: "<?php echo $loc['tickets.php']['t39']; ?>",
				maxlength: "<?php echo $loc['tickets.php']['t40']; ?>"
				},
			text:
				{
				required: "<?php echo $loc['tickets.php']['t41']; ?>",
				minlength: "<?php echo $loc['tickets.php']['t42']; ?>",
				maxlength: "<?php echo $loc['tickets.php']['t43']; ?>"
				}
			}
		});
	});
</script>	
	