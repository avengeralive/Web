<p class="pageTitle"><span><?php echo $loc['system_tds.php']['t01']; ?></span></p>
<script>
(function($) {
$(function() {

  $('input, select').styler({
    selectSearch: true,
    selectSearchLimit: 12,
  });

})
})(jQuery)

</script>
<?php
include ('./templates/'.$template.'/checkform/jquery.proverka.systemtds.form.php');
?>
	
<p>
	<form action="" name="addredirect_form" class="addredirect_form" method="post">
		<p>
			<b><?php echo $loc['system_tds.php']['t02']; ?></b>
		</p>
		<table class="system_tds_table">	
			<tr>
				<td style="width: 100px;"><?php echo $loc['system_tds.php']['t03']; ?></td><td><input type="text" name="description" value="" maxlength="100"></td>
			</tr>
			<tr>
				<td><?php echo $loc['system_tds.php']['t04']; ?></td><td><input type="text" name="page" value="<?php if (isset($_GET['page']) && $_GET['page']!='') {echo htmlentities($_GET['page']);} ?>" maxlength="250"></td>
			</tr>
			<tr>
				<td><?php echo $loc['system_tds.php']['t05']; ?></td><td><input type="text" name="referer" value="<?php if (isset($_GET['referer']) && $_GET['referer']!='') {echo htmlentities($_GET['referer']);} ?>" maxlength="250"></td>
			</tr>
			<tr>				
				<td><?php echo $loc['system_tds.php']['t06']; ?></td><td><input type="text" name="ip" class="minipole" value="<?php if (isset($_GET['ip']) && $_GET['ip']!='') {echo htmlentities($_GET['ip']);} ?>" maxlength="20"></td>
			</tr>
			<tr>				
				<td><?php echo $loc['system_tds.php']['t07']; ?></td>
				<td>
					<select name="platform" class="minipole">
						<option value="All" <?php if (!isset($_GET['platform']) || $_GET['platform']=='') {echo 'selected';} ?>><?php echo $loc['system_tds.php']['t08']; ?></option>
						<option value="Windows" <?php if (isset($_GET['platform']) && $_GET['platform']=='Windows') {echo 'selected';} ?>><?php echo $loc['system_tds.php']['t09']; ?></option>
						<option value="Linux" <?php if (isset($_GET['platform']) && $_GET['platform']=='Linux') {echo 'selected';} ?>><?php echo $loc['system_tds.php']['t10']; ?></option>
						<option value="Mac" <?php if (isset($_GET['platform']) && $_GET['platform']=='Mac') {echo 'selected';} ?>><?php echo $loc['system_tds.php']['t11']; ?></option>
						<option value="Android" <?php if (isset($_GET['platform']) && $_GET['platform']=='Android') {echo 'selected';} ?>><?php echo $loc['system_tds.php']['t12']; ?></option>
						<option value="iOS" <?php if (isset($_GET['platform']) && $_GET['platform']=='iOS') {echo 'selected';} ?>><?php echo $loc['system_tds.php']['t13']; ?></option>
					</select>
				</td>
			</tr>
			<tr>									
				<td><?php echo $loc['system_tds.php']['t14']; ?></td><td><input type="text" name="useragent" value="<?php if (isset($_GET['useragent']) && $_GET['useragent']!='') {echo htmlentities($_GET['useragent']);} ?>" maxlength="250"></td>
			</tr>
			<tr>				
				<td><?php echo $loc['system_tds.php']['t15']; ?></td>
				<td>
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
								if (isset($_GET['country']) && $_GET['country']==$current_country) 
									{
									echo ' selected';
									}
								?>><?php echo $current_country; ?></option>
								<?php
								}
							}
						?>
					</select>
				</td>
			</tr>
			<tr>								
				<td><?php echo $loc['system_tds.php']['t16']; ?></td><td><input type="text" name="destination" value="" maxlength="250"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>				
				<td colspan="2"><input type="submit" name="submit_redirect" class="others_button_sohranit" value="<?php echo $loc['button']['t01']; ?>"></td>
			</tr>
		</table>
	</form>
</p>

<p>
	<b><?php echo $loc['system_tds.php']['t17']; ?></b>
</p>

<div class="horizontal_scroll">
	<p>
		<table class="stats_table">
			<tr class="tableHead">
				<td><b><?php echo $loc['system_tds.php']['t18']; ?></b></td>
				<td><b><?php echo $loc['system_tds.php']['t19']; ?></b></td>
				<td><b><?php echo $loc['system_tds.php']['t20']; ?></b></td>
				<td><b><?php echo $loc['system_tds.php']['t21']; ?></b></td>
				<td><b><?php echo $loc['system_tds.php']['t22']; ?></b></td>
				<td><b><?php echo $loc['system_tds.php']['t23']; ?></b></td>
				<td><b><?php echo $loc['system_tds.php']['t24']; ?></b></td>
				<td><b><?php echo $loc['system_tds.php']['t25']; ?></b></td>
				<td><b><?php echo $loc['system_tds.php']['t26']; ?></b></td>
				<td><b><?php echo $loc['system_tds.php']['t27']; ?></b></td>
			</tr>
			<?php
			$sql_redirectlist = "SELECT * FROM system_tds ORDER BY `id` DESC";
			$result_redirectlist = $mysqli->query($sql_redirectlist);
			if (mysqli_num_rows($result_redirectlist) > 0) 
				{
				while ($res_redirectlist=mysqli_fetch_array($result_redirectlist)) 
					{
					$redirect_id=htmlentities($res_redirectlist['id']);
					$redirect_description=htmlentities($res_redirectlist['description']);
					$redirect_page=htmlentities($res_redirectlist['page']);
					$redirect_referer=htmlentities($res_redirectlist['referer']);
					$redirect_ip=htmlentities($res_redirectlist['ip']);
					$redirect_platform=htmlentities($res_redirectlist['platform']);
					$redirect_useragent=htmlentities($res_redirectlist['useragent']);
					$redirect_country=htmlentities($res_redirectlist['country']);
					$redirect_destination=htmlentities($res_redirectlist['destination']);
					?>
					<tr>
						<td><nobr><?php echo $redirect_id; ?></nobr></td>
						<td><nobr><?php echo html_entity_decode($redirect_description, ENT_QUOTES, 'utf-8'); ?></nobr></td>
						<td><nobr><?php if ($redirect_page=='All') {echo $loc['system_tds.php']['t28'];} else {echo $redirect_page;} ?></nobr></td>
						<td><nobr><?php if ($redirect_referer=='All') {echo $loc['system_tds.php']['t29'];} else {echo $redirect_referer;} ?></nobr></td>
						<td><nobr><?php if ($redirect_ip=='All') {echo $loc['system_tds.php']['t30'];} else {echo $redirect_ip;} ?></nobr></td>
						<td><nobr><?php if ($redirect_platform=='All') {echo $loc['system_tds.php']['t31'];} else {echo $redirect_platform;} ?></nobr></td>
						<td><nobr><?php if ($redirect_useragent=='All') {echo $loc['system_tds.php']['t30'];} else {echo $redirect_useragent;} ?></nobr></td>
						<td><nobr><?php echo $redirect_country; ?></td>
						<td><nobr><?php echo $redirect_destination; ?></td>
						<td>&nbsp;<a href="system_tds.php?delete=<?php echo $redirect_id; ?>" onclick="if (!confirm('<?php echo $loc['system_tds.php']['t32']; ?>'))return false;"><?php echo $loc['system_tds.php']['t33']; ?></a>&nbsp;</td>
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
