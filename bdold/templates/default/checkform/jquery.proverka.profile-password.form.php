
<script type="text/javascript">
$(document).ready(function()
	{
	$(profile_changepassword_form).validate(
		{
		rules:
			{
			profile_password_1:
				{
				required: true,
				minlength: 6,
				maxlength: 40
				},
			profile_password_2:
				{
				required: true,
				minlength: 6,
				maxlength: 40,
				equalTo: "#profile_password_1"
				}
			},
		messages:
			{
			profile_password_1:
				{
				required: "<?php echo $loc['profile.php']['t32']; ?>",
				minlength: "<?php echo $loc['profile.php']['t33']; ?>",
				maxlength: "<?php echo $loc['profile.php']['t34']; ?>"
				},
			profile_password_2:
				{
				required: "<?php echo $loc['profile.php']['t35']; ?>",
				minlength: "<?php echo $loc['profile.php']['t36']; ?>",
				maxlength: "<?php echo $loc['profile.php']['t37']; ?>",
				equalTo: "<?php echo $loc['profile.php']['t38']; ?>"
				}
			}
		});
	});
</script>	
	