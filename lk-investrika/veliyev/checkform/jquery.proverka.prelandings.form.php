
<script type="text/javascript">
$(document).ready(function()
	{
	$(prelandings_form).validate(
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
				required: "<?php echo $loc['prelandings.php']['t02']; ?>",
				minlength: "<?php echo $loc['prelandings.php']['t03']; ?>",
				maxlength: "<?php echo $loc['prelandings.php']['t04']; ?>"
				},
			url:
				{
				url: "<?php echo $loc['prelandings.php']['t08']; ?>",
				required: "<?php echo $loc['prelandings.php']['t05']; ?>",
				minlength: "<?php echo $loc['prelandings.php']['t06']; ?>",
				maxlength: "<?php echo $loc['prelandings.php']['t07']; ?>"
				}				
			}
		});
	});
</script>	
	