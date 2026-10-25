
<script type="text/javascript">
$(document).ready(function()
	{
	$(addnews_form).validate(
		{
		rules:
			{
			news_small:
				{
				required: true,
				minlength: 10,
				maxlength: 90
				},
			news_full:
				{
				required: true,
				minlength: 30,
				maxlength: 900
				},				
				
			},
		messages:
			{
			news_small:
				{
				required: "<?php echo $loc['news.php']['t20']; ?>",
				minlength: "<?php echo $loc['news.php']['t21']; ?>",
				maxlength: "<?php echo $loc['news.php']['t22']; ?>"
				},
			news_full:
				{
				required: "<?php echo $loc['news.php']['t23']; ?>",
				minlength: "<?php echo $loc['news.php']['t24']; ?>",
				maxlength: "<?php echo $loc['news.php']['t25']; ?>"
				}
			}
		});
	});
</script>	
	