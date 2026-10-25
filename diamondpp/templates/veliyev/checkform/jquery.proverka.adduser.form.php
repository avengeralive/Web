
<script type="text/javascript">
$(document).ready(function()
	{
	$(adduser_form).validate(
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
				required: "<?php echo $loc['users.php']['t42']; ?>",
				email: "<?php echo $loc['users.php']['t43']; ?>",
				minlength: "<?php echo $loc['users.php']['t44']; ?>",
				maxlength: "<?php echo $loc['users.php']['t45']; ?>"
				},
			password1:
				{
				required: "<?php echo $loc['users.php']['t46']; ?>",
				minlength: "<?php echo $loc['users.php']['t47']; ?>",
				maxlength: "<?php echo $loc['users.php']['t48']; ?>"
				},
			password2:
				{
				required: "<?php echo $loc['users.php']['t49']; ?>",
				minlength: "<?php echo $loc['users.php']['t50']; ?>",
				maxlength: "<?php echo $loc['users.php']['t51']; ?>",
				equalTo: "<?php echo $loc['users.php']['t52']; ?>"
				}
			}
		});
	});
</script>	
	