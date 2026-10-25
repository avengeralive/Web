
<script type="text/javascript">
$(document).ready(function()
	{
	$(landings_form).validate(
		{
		rules:
			{
			name:
				{
				required: true,
				minlength: 3,
				maxlength: 90
				},
			url:
				{
				url: true,
				required: true,
				minlength: 10,
				maxlength: 200
				}				
			},
		messages:
			{
			name:
				{
				required: "<?php echo $loc['landings.php']['t26']; ?>",
				minlength: "<?php echo $loc['landings.php']['t27']; ?>",
				maxlength: "<?php echo $loc['landings.php']['t28']; ?>"
				},
			url:
				{
				url: "<?php echo $loc['landings.php']['t32']; ?>",
				required: "<?php echo $loc['landings.php']['t29']; ?>",
				minlength: "<?php echo $loc['landings.php']['t30']; ?>",
				maxlength: "<?php echo $loc['landings.php']['t31']; ?>"
				}				
			}
		});
	});
</script>	
	