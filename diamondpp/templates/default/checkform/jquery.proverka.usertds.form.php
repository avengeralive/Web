
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
			offer_id:
				{
				required: true
				},
			landing_id:
				{
				required: true
				},
			offer_dest_id:
				{
				required: true
				},
			landing_dest_id:
				{
				required: true
				}					
			},
		messages:
			{
			description:
				{
				required: "<?php echo $loc['user_tds.php']['t37']; ?>",
				minlength: "<?php echo $loc['user_tds.php']['t38']; ?>",
				maxlength: "<?php echo $loc['user_tds.php']['t39']; ?>"
				},
			offer_id:
				{
				required: "<?php echo $loc['user_tds.php']['t40']; ?>"
				},
			landing_id:
				{
				required: "<?php echo $loc['user_tds.php']['t41']; ?>"
				},
			offer_dest_id:
				{
				required: "<?php echo $loc['user_tds.php']['t42']; ?>"
				},
			landing_dest_id:
				{
				required: "<?php echo $loc['user_tds.php']['t43']; ?>"
				}				
			}
		});
	});
</script>	
	