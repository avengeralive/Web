<p>
Отслеживание почтового отправления № <?php echo $zakaz_view_tracking_number; ?> <input type="button" id="btn-track" value="Найти почтовое отправление">
</p>

<script>
	$('#btn-track').click
		(
		function()
			{
			document.getElementById('btn-track').disabled='disabled';
			document.getElementById('btn-track').value='Ожидайте...';
			$.ajax
				(
					{
					type: 'POST',
					url: "./russianpost.php", 
					data: 'track_number=<?php echo $zakaz_view_tracking_number; ?>&ob=<?php echo $zakaz_view_id; ?>&zakaz_number=<?php echo $zakaz_view_number; ?>&offer_id=<?php echo $zakaz_view_offer_id; ?>&owner_id=<?php echo $zakaz_view_owner_id; ?>',
					cache: false,  
					timeout: 2000,
					success: function(html)
						{  
						$("#content").html(html);  
						document.getElementById('btn-track').value='Готово';
						},
					error: function(html) 
						{
						$("#content").html('Вывод невозможен. Попробуйте пожалуйста позже.'); 
						document.getElementById('btn-track').value='Готово';
						}	
					}
				);  
			}
		);
</script>
<div id="content"></div>

