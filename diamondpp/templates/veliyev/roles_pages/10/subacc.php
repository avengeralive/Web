
<h1><?php echo $loc['subacc.php']['t01']; ?></h1>

<p>
	<?php 
	if (isset($_GET['xtext']) && $_GET['xtext']=='1') {echo '<font color=red><b>'.$loc['subacc.php']['t02'].'</b></font>';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='2') {echo '<font color=red><b>'.$loc['subacc.php']['t03'].'</b></font>';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='3') {echo '<font color=green><b>'.$loc['subacc.php']['t04'].'</b></font>';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='4') {echo '<font color=green><b>'.$loc['subacc.php']['t05'].'</b></font>';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='5') {echo '<font color=red><b>'.$loc['subacc.php']['t06'].'</b></font>';} 
	?>
</p>

<p>
	<?php echo $loc['subacc.php']['t07']; ?>
</p>

<!-- Блок с формой -->
<!-- Block with a form -->
<p>
	<form name="add_subacc" class="report" method="post" action="./subacc.php?<?php echo @$_SERVER['QUERY_STRING']; ?>">
		<script>
		function selectLandings()
			{
			var offer_id = $('select[name="offer_id"]').val();
			if(!offer_id)
				{
				$('p[name="landing_place"]').html('<b><?php echo $loc['subacc.php']['t10']; ?></b><br /><select name="landing_id" disabled="disabled"><option><?php echo $loc['subacc.php']['t09']; ?></option></select>');
				$('p[name="url_place"]').html('<b><?php echo $loc['subacc.php']['t11']; ?></b><br /><input type="text" name="page_url" disabled="disabled" value="<?php echo $loc['subacc.php']['t22']; ?>">');
				}
			else
				{
				$.ajax(
					{
					type: "POST",
					url: "/subacc_functions.php",
					data: { action: 'showLandingsNames', offer_id: offer_id },
					cache: false,
					success: function(responce){ $('p[name="landing_place"]').html(responce); }
					});
				};
			};
		function showPageUrl()
			{
			var landing_id = $('select[name="landing_id"]').val();
			if(!landing_id)
				{
				$('p[name="url_place"]').html('<b><?php echo $loc['subacc.php']['t11']; ?></b><br /><input type="text" name="page_url" disabled="disabled" value="<?php echo $loc['subacc.php']['t22']; ?>">');
				}
			else
				{
				$.ajax(
					{
					type: "POST",
					url: "/subacc_functions.php",
					data: { action: 'showLandingUrl', landing_id: landing_id },
					cache: false,
					success: function(responce){ $('p[name="url_place"]').html(responce); }
					});
				};
			};	
		function showButton()
			{
			var page_url = $('input[name="page_url"]').val();
			if(!page_url)
				{
				$('p[name="button_place"]').html('<input type="submit" name="submit_subacc" class="others_button_sohranit" value="<?php echo $loc['button']['t01']; ?>" style="display: none;">');
				}
			else
				{
				$.ajax(
					{
					type: "POST",
					url: "/subacc_functions.php",
					data: { action: 'showButtonPlace', page_url: page_url },
					cache: false,
					success: function(responce){ $('p[name="button_place"]').html(responce); }
					});
				};
			};			
		</script>	
		<p>
			<b><?php echo $loc['subacc.php']['t08']; ?></b><br />
			<select name="offer_id" onchange="javascript:selectLandings();">
				<option value=""><?php echo $loc['subacc.php']['t09']; ?></option>
				<?php
				$sql_getoffersdata = "SELECT id,name FROM offers WHERE `active`='1' ORDER BY `id` DESC";
				$result_getoffersdata = $mysqli->query($sql_getoffersdata);
				if (mysqli_num_rows($result_getoffersdata) > 0) 
					{
					while ($res_getoffersdata=mysqli_fetch_array($result_getoffersdata)) 
						{
						$offer_id=htmlentities($res_getoffersdata['id']);
						$offer_name=htmlentities($res_getoffersdata['name']);
						?>
						<option value="<?php echo $offer_id; ?>"><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></option>
						<?php
						}
					}
				?>
			</select>
		</p>
		<p name="landing_place">
			<b><?php echo $loc['subacc.php']['t10']; ?></b><br /><select name="landing_id" disabled="disabled"><option><?php echo $loc['subacc.php']['t09']; ?></option></select>
		</p>	
		<p name="url_place">
			<b><?php echo $loc['subacc.php']['t11']; ?></b><br /><input type="text" name="page_url" disabled="disabled" value="- Не указано -">
		</p>
		<p name="button_place">
			<input type="submit" name="submit_subacc" class="others_button_sohranit" value="<?php echo $loc['button']['t01']; ?>" style="display: none;">
		</p>
	</form>
</p>
<!-- Конец блока с формой -->
<!-- End unit with a form -->

<p>
	<br /><b><?php echo $loc['subacc.php']['t12']; ?></b>
	<table class="stats_table" style="width: 100%;">
		<tr class="table_zagolovki">
			<td><?php echo $loc['subacc.php']['t13']; ?></td>
			<td><?php echo $loc['subacc.php']['t14']; ?></td>
			<td><?php echo $loc['subacc.php']['t15']; ?></td>	
			<td><?php echo $loc['subacc.php']['t16']; ?></td>	
			<td><?php echo $loc['subacc.php']['t17']; ?></td>	
		</tr>
		<?php
		$sql_getsubaccdata = "SELECT * FROM subacc WHERE `user_id`='$user_id' ORDER BY `id` DESC";
		$result_getsubaccdata = $mysqli->query($sql_getsubaccdata);
		if (mysqli_num_rows($result_getsubaccdata) > 0) 
			{
			while ($res_getsubaccdata=mysqli_fetch_array($result_getsubaccdata)) 
				{
				$subacc_id=htmlentities($res_getsubaccdata['id']);
				$subacc_offer_id=htmlentities($res_getsubaccdata['offer_id']);
				$subacc_landing_id=htmlentities($res_getsubaccdata['landing_id']);
				$subacc_page=htmlentities($res_getsubaccdata['page']);
				
				// Определяем домен который используется для лендингов
				// Determine the domain that is used for landing
				$sql_domain = "SELECT domain FROM domains WHERE `active`='1' ORDER BY `id` DESC";
				$result_domain = $mysqli->query($sql_domain);
				$res_domain=mysqli_fetch_array($result_domain);
				$domain=htmlentities($res_domain['domain']);
				$subacc_link='http://'.$domain.'/?s='.$subacc_id;
				
				// Определяем название оффера
				// Determine the name offer
				$sql_getnameoffer = "SELECT name FROM offers WHERE `id`='$subacc_offer_id'";
				$result_getnameoffer = $mysqli->query($sql_getnameoffer);
				$res_getnameoffer=mysqli_fetch_array($result_getnameoffer);
				$offer_name=htmlentities($res_getnameoffer['name']);
				
				// Определяем название лендинга
				// Determine the name of landing
				$sql_getnamelanding = "SELECT name FROM landings WHERE `id`='$subacc_landing_id'";
				$result_getnamelanding = $mysqli->query($sql_getnamelanding);
				$res_getnamelanding=mysqli_fetch_array($result_getnamelanding);
				$landing_name=htmlentities($res_getnamelanding['name']);				
				?>
				<tr>
					<td><?php if (isset($subacc_offer_id)) {echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8');} ?></td>
					<td><?php if (isset($subacc_landing_id)) {echo html_entity_decode($landing_name, ENT_QUOTES, 'utf-8');} ?></td>
					<td><?php if (isset($subacc_page)) {echo html_entity_decode($subacc_page, ENT_QUOTES, 'utf-8');} ?></td>	
					<td><?php if (isset($subacc_link)) {echo $subacc_link;} ?></td>	
					<td>&nbsp;<a href="./subacc.php?delete=<?php if (isset($subacc_id)) {echo $subacc_id;} ?>" onclick="if (!confirm('<?php echo $loc['subacc.php']['t18']; ?>'))return false;"><?php echo $loc['subacc.php']['t19']; ?></a>&nbsp;</td>	
				</tr>	
				<?php
				}
			}
		?>
	</table>
</p>

<p style="margin-top: 30px;">
	<?php echo $loc['subacc.php']['t20']; ?>&nbsp;<?php echo $settings_account_max_subacc; ?>&nbsp;<?php echo $loc['subacc.php']['t21']; ?>
</p>

<p>
	&nbsp;
</p>

