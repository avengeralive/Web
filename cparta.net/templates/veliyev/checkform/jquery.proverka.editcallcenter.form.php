
<script type="text/javascript">
$(document).ready(function()
	{
	$(editcallcenter_form).validate(
		{
		rules:
			{
			name:
				{
				required: true,
				minlength: 3,
				maxlength: 40
				},
			site:
				{
				url: true,
				minlength: 3,
				maxlength: 40
				},
			email:
				{
				email: true,
				minlength: 3,
				maxlength: 40
				}
			},
		messages:
			{
			name:
				{
				required: "<?php echo $loc['operators.php']['t22']; ?>",
				minlength: "<?php echo $loc['operators.php']['t21']; ?>",
				maxlength: "<?php echo $loc['operators.php']['t23']; ?>"
				},
			site:
				{
				url: "<?php echo $loc['operators.php']['t25']; ?>",
				minlength: "<?php echo $loc['operators.php']['t21']; ?>",
				maxlength: "<?php echo $loc['operators.php']['t23']; ?>"
				},				
			email:
				{
				email: "<?php echo $loc['operators.php']['t24']; ?>",
				minlength: "<?php echo $loc['operators.php']['t21']; ?>",
				maxlength: "<?php echo $loc['operators.php']['t23']; ?>"
				}
			}
		});
	});
</script>
