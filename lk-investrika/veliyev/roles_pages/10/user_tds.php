<?php

// Если в GET-запросе были переданы ID редиректа и партнерская ссылка, то получаем данные об этом редиректе
// If the GET-request were transferred ID and redirect affiliate link, get the information about this redirect
if ((isset($_GET['id']) && $_GET['id']!='') && (isset($_GET['link']) && $_GET['link']!=''))
	{
	$id_zapisi=htmlentities($_GET['id']);
	$code=htmlentities($_GET['link']);
	$link=partnerstroka_decode($code,true);
	$get_user_id=htmlentities($link[0]);
	$get_offer_id=htmlentities($link[1]);
	$get_landing_id=htmlentities($link[2]);
	
	// Извлекаем информацию из таблицы статистики посещений
	// Get information from a table of statistics of visits
	$sql_getdatastats = "SELECT * FROM clients_log WHERE `id`='$id_zapisi' AND `code`='$code' AND `user_id`='$user_id'";
	$result_getdatastats=$mysqli->query($sql_getdatastats);
	if (mysqli_num_rows($result_getdatastats) > 0) 
		{
		$res_getdatastats=mysqli_fetch_array($result_getdatastats);
		$get_referer=htmlentities($res_getdatastats['referer']);
		$get_ip=htmlentities($res_getdatastats['ip']);
		$get_platform=htmlentities($res_getdatastats['platform']);
		$get_useragent=htmlentities($res_getdatastats['useragent']);
		$get_country=htmlentities($res_getdatastats['country']);
		}
	}
?>

<h1><?php echo $loc['user_tds.php']['t01']; ?></h1>

<?php
include ('./templates/'.$template.'/checkform/jquery.proverka.usertds.form.php');
?>
	
<p>
	<form action="" name="addredirect_form" class="addredirect_form" method="post">
		<script>
		function selectLandings()
			{
			var offer_id = $('select[name="offer_id"]').val();
			if(!offer_id)
				{
				$('p[name="landing_place"]').html('<b><?php echo $loc['user_tds.php']['t36']; ?></b><br /><select name="landing_id" disabled="disabled"><option value=""><?php echo $loc['user_tds.php']['t04']; ?></option></select>');
				}
			else
				{
				$.ajax(
					{
					type: "POST",
					url: "/user_tds_functions.php",
					data: { action: 'showLandingsNames', offer_id: offer_id },
					cache: false,
					success: function(responce){ $('p[name="landing_place"]').html(responce); }
					});
				};
			};
			
		function selectLandings2()
			{
			var offer_dest_id = $('select[name="offer_dest_id"]').val();
			if(!offer_dest_id)
				{
				$('p[name="landing_dest_place"]').html('<b><?php echo $loc['user_tds.php']['t36']; ?></b><br /><select name="landing_dest_id" disabled="disabled"><option value=""><?php echo $loc['user_tds.php']['t04']; ?></option></select>');
				}
			else
				{
				$.ajax(
					{
					type: "POST",
					url: "/user_tds_functions.php",
					data: { action: 'showLandingsNames2', offer_dest_id: offer_dest_id },
					cache: false,
					success: function(responce){ $('p[name="landing_dest_place"]').html(responce); }
					});
				};
			};			
		</script>
		<p>
			<b><?php echo $loc['user_tds.php']['t02']; ?></b>
		</p>
		<div style="display: block;">
		<div style="width: 50%; float: left;">
		<p>
			<b><?php echo $loc['user_tds.php']['t03']; ?></b><br />
			<select name="offer_id" onchange="javascript:selectLandings();">
				<option value=""><?php echo $loc['user_tds.php']['t04']; ?></option>
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
			<b><?php echo $loc['user_tds.php']['t05']; ?></b><br /><select name="landing_id" disabled="disabled"><option value=""><?php echo $loc['user_tds.php']['t04']; ?></option></select>
		</p>		
		<p>
			<b><?php echo $loc['user_tds.php']['t06']; ?></b><br />
			<input type="text" name="referer" style="width: 300px;" placeholder="<?php echo $loc['user_tds.php']['t15']; ?>" value="<?php if (isset($get_referer) && $get_referer!='') {echo htmlentities($get_referer);} ?>" maxlength="250">
		</p>
		<p>
			<b><?php echo $loc['user_tds.php']['t07']; ?></b><br />
			<input type="text" name="ip" class="minipole" placeholder="<?php echo $loc['user_tds.php']['t15']; ?>" value="<?php if (isset($get_ip) && $get_ip!='') {echo htmlentities($get_ip);} ?>" maxlength="20">
		</p>
		<p>
			<b><?php echo $loc['user_tds.php']['t08']; ?></b><br />
			<select name="platform" class="minipole">
				<option value="All" <?php if (!isset($get_platform) || $get_platform=='') {echo 'selected';} ?>><?php echo $loc['user_tds.php']['t09']; ?></option>
				<option value="Windows" <?php if (isset($get_platform) && $get_platform=='Windows') {echo 'selected';} ?>><?php echo $loc['user_tds.php']['t10']; ?></option>
				<option value="Linux" <?php if (isset($get_platform) && $get_platform=='Linux') {echo 'selected';} ?>><?php echo $loc['user_tds.php']['t11']; ?></option>
				<option value="Mac" <?php if (isset($get_platform) && $get_platform=='Mac') {echo 'selected';} ?>><?php echo $loc['user_tds.php']['t12']; ?></option>
				<option value="Android" <?php if (isset($get_platform) && $get_platform=='Android') {echo 'selected';} ?>><?php echo $loc['user_tds.php']['t13']; ?></option>
				<option value="iOS" <?php if (isset($get_platform) && $get_platform=='iOS') {echo 'selected';} ?>><?php echo $loc['user_tds.php']['t14']; ?></option>
			</select>
		</p>
		</div>
		<div style="width: 50%; float: right;">
		<p>
			<b><?php echo $loc['user_tds.php']['t16']; ?></b><br />
			<input type="text" name="useragent" style="width: 300px;" placeholder="<?php echo $loc['user_tds.php']['t15']; ?>" value="<?php if (isset($get_useragent) && $get_useragent!='') {echo htmlentities($get_useragent);} ?>" maxlength="250">
		</p>
		<p>
			<b><?php echo $loc['user_tds.php']['t17']; ?></b><br />
			<select name="country" class="minipole">
			<?php
			$sql_spisokstran = "SELECT * FROM sxgeo_country ORDER BY `name_ru` ASC";
			$result_spisokstran=$mysqli->query($sql_spisokstran);
			if (mysqli_num_rows($result_spisokstran) > 0) 
				{
				while ($res_spisokstran=mysqli_fetch_array($result_spisokstran)) 
					{
					$current_country=htmlentities($res_spisokstran['name_ru']);
					$current_iso=htmlentities($res_spisokstran['iso']);
					?>
					<option value="<?php echo $current_country; ?>"<?php 
					if (isset($get_country) && $get_country==$current_country) 
						{
						echo ' selected';
						}
					?>><?php echo $current_country; ?></option>
					<?php
					}
				}
			?>
			</select>
		</p>
		<p>
			<b><?php echo $loc['user_tds.php']['t21']; ?></b><br />
			<select name="offer_dest_id" onchange="javascript:selectLandings2();">
				<option value=""><?php echo $loc['user_tds.php']['t04']; ?></option>
				<?php
				$sql_getoffersdata = "SELECT id,name FROM offers WHERE `active`='1' ORDER BY `id` DESC";
				$result_getoffersdata = $mysqli->query($sql_getoffersdata);
				if (mysqli_num_rows($result_getoffersdata) > 0) 
					{
					while ($res_getoffersdata=mysqli_fetch_array($result_getoffersdata)) 
						{
						$offer_dest_id=htmlentities($res_getoffersdata['id']);
						$offer_dest_name=htmlentities($res_getoffersdata['name']);
						?>
						<option value="<?php echo $offer_dest_id; ?>"><?php echo html_entity_decode($offer_dest_name, ENT_QUOTES, 'utf-8'); ?></option>
						<?php
						}
					}
				?>
			</select>
		</p>
		<p name="landing_dest_place">
			<b><?php echo $loc['user_tds.php']['t22']; ?></b><br /><select name="landing_dest_id" disabled="disabled"><option value=""><?php echo $loc['user_tds.php']['t04']; ?></option></select>
		</p>				
		<p>
			<b><?php echo $loc['user_tds.php']['t18']; ?></b><br />
			<input type="text" name="description" value="" maxlength="100">
		</p>		
		<p>
			<input type="submit" name="submit_redirect" class="others_button_sohranit" value="<?php echo $loc['button']['t01']; ?>">
		</p>
		</div>
		</div>
	</form>
</p>



<div class="horizontal_scroll">
	<p>
		<table class="stats_table">
			<tr class="table_zagolovki">
				<td colspan="30" style="background: white; border: 1px solid white; text-align: left; margin: 0; padding: 0;">
					<p>
						<b><?php echo $loc['user_tds.php']['t19']; ?></b>
					</p>
				</td>
			</tr>
			<tr class="table_zagolovki">
				<td><nobr><b><?php echo $loc['user_tds.php']['t20']; ?></b></nobr></td>
				<td><nobr><b><?php echo $loc['user_tds.php']['t23']; ?></b></nobr></td>
				<td><nobr><b><?php echo $loc['user_tds.php']['t24']; ?></b></nobr></td>
				<td><nobr><b><?php echo $loc['user_tds.php']['t25']; ?></b></nobr></td>
				<td><nobr><b><?php echo $loc['user_tds.php']['t26']; ?></b></nobr></td>
				<td><nobr><b><?php echo $loc['user_tds.php']['t27']; ?></b></nobr></td>
				<td><nobr><b><?php echo $loc['user_tds.php']['t28']; ?></b></nobr></td>
				<td><nobr><b><?php echo $loc['user_tds.php']['t29']; ?></b></nobr></td>
				<td><nobr><b><?php echo $loc['user_tds.php']['t30']; ?></b></nobr></td>
				<td><nobr><b><?php echo $loc['user_tds.php']['t31']; ?></b></nobr></td>				
				<td><nobr><b><?php echo $loc['user_tds.php']['t32']; ?></b></nobr></td>
			</tr>
			<?php
			$sql_redirectlist = "SELECT * FROM user_tds WHERE `user_id`='$user_id' ORDER BY `id` DESC";
			$result_redirectlist = $mysqli->query($sql_redirectlist);
			if (mysqli_num_rows($result_redirectlist) > 0) 
				{
				while ($res_redirectlist=mysqli_fetch_array($result_redirectlist)) 
					{
					$redirect_id=htmlentities($res_redirectlist['id']);
					$redirect_description=htmlentities($res_redirectlist['description']);
					$redirect_offer_id=htmlentities($res_redirectlist['offer_id']);
					$redirect_landing_id=htmlentities($res_redirectlist['landing_id']);
					$redirect_referer=htmlentities($res_redirectlist['referer']);
					$redirect_ip=htmlentities($res_redirectlist['ip']);
					$redirect_platform=htmlentities($res_redirectlist['platform']);
					$redirect_useragent=htmlentities($res_redirectlist['useragent']);
					$redirect_country=htmlentities($res_redirectlist['country']);
					$redirect_offer_dest_id=htmlentities($res_redirectlist['offer_dest_id']);
					$redirect_landing_dest_id=htmlentities($res_redirectlist['landing_dest_id']);					
					
					// Определяем название оффера на который будет приходить трафик
					// Determine the name offer which will be coming traffic
					$sql_getnameoffer = "SELECT name FROM offers WHERE `id`='$redirect_offer_id'";
					$result_getnameoffer = $mysqli->query($sql_getnameoffer);
					$res_getnameoffer=mysqli_fetch_array($result_getnameoffer);
					$redirect_offer_name=htmlentities($res_getnameoffer['name']);
					
					// Определяем название лендинга на который будет приходить трафик
					// Determine the name landing on which traffic will be coming
					$sql_getnamelanding = "SELECT name FROM landings WHERE `id`='$redirect_landing_id'";
					$result_getnamelanding = $mysqli->query($sql_getnamelanding);
					$res_getnamelanding=mysqli_fetch_array($result_getnamelanding);
					$redirect_landing_name=htmlentities($res_getnamelanding['name']);				
					
					// Определяем название оффера на который будет редиректить
					// Determine the name offer which will redirect
					$sql_getnameoffer = "SELECT name FROM offers WHERE `id`='$redirect_offer_dest_id'";
					$result_getnameoffer = $mysqli->query($sql_getnameoffer);
					$res_getnameoffer=mysqli_fetch_array($result_getnameoffer);
					$redirect_offer_dest_name=htmlentities($res_getnameoffer['name']);
					
					// Определяем название лендинга на который будет редиректить
					// Determine the name of landing which will redirect
					$sql_getnamelanding = "SELECT name FROM landings WHERE `id`='$redirect_landing_dest_id'";
					$result_getnamelanding = $mysqli->query($sql_getnamelanding);
					$res_getnamelanding=mysqli_fetch_array($result_getnamelanding);
					$redirect_landing_dest_name=htmlentities($res_getnamelanding['name']);									
					
					?>
					<tr>
						<td><nobr><?php echo html_entity_decode($redirect_description, ENT_QUOTES, 'utf-8'); ?></nobr></td>
						<td><nobr><?php echo html_entity_decode($redirect_offer_name, ENT_QUOTES, 'utf-8'); ?></nobr></td>
						<td><nobr><?php echo html_entity_decode($redirect_landing_name, ENT_QUOTES, 'utf-8'); ?></nobr></td>
						<td><nobr><?php if ($redirect_referer=='All') {echo $loc['user_tds.php']['t33'];} else {echo $redirect_referer;} ?></nobr></td>
						<td><nobr><?php if ($redirect_ip=='All') {echo $loc['user_tds.php']['t15'];} else {echo $redirect_ip;} ?></nobr></td>
						<td><nobr><?php if ($redirect_platform=='All') {echo $loc['user_tds.php']['t09'];} else {echo $redirect_platform;} ?></nobr></td>
						<td><nobr><?php if ($redirect_useragent=='All') {echo $loc['user_tds.php']['t15'];} else {echo $redirect_useragent;} ?></nobr></td>
						<td><nobr><?php echo $redirect_country; ?></td>
						<td><nobr><?php echo html_entity_decode($redirect_offer_dest_name, ENT_QUOTES, 'utf-8'); ?></nobr></td>
						<td><nobr><?php echo html_entity_decode($redirect_landing_dest_name, ENT_QUOTES, 'utf-8'); ?></nobr></td>
						<td>&nbsp;<a href="./user_tds.php?delete=<?php echo $redirect_id; ?>" onclick="if (!confirm('<?php echo $loc['user_tds.php']['t34']; ?>'))return false;"><?php echo $loc['user_tds.php']['t35']; ?></a>&nbsp;</td>
					</tr>			
					<?
					}
				}
			?>
		</table>
	</p>
</div>

<p>
	&nbsp;
</p>
