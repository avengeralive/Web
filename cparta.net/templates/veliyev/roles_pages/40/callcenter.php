
<h1><?php echo $loc['callcenter.php']['t01']; ?></h1>

<p>
	<?php
	if (isset($_GET['xtext']) && $_GET['xtext']!='')
		{
		// Сообщения об ошибках либо об успехе
		// Service messages
		$xtext=htmlentities($_GET['xtext']);
		if ($xtext=='1') {echo '<font color=green>'.$loc['callcenter.php']['t02'].'</font>';}
		if ($xtext=='2') {echo '<font color=red>'.$loc['callcenter.php']['t12'].'</font>';}
		if ($xtext=='3') {echo '<font color=green>'.$loc['callcenter.php']['t23'].'</font>';}
		if ($xtext=='4') {echo '<font color=red>'.$loc['callcenter.php']['t24'].'</font>';}
		if ($xtext=='5') {echo '<font color=green>'.$loc['callcenter.php']['t30'].'</font>';}
		if ($xtext=='6') {echo '<font color=red>'.$loc['callcenter.php']['t31'].'</font>';}
		}
	?>
</p>

<?php
if (isset($_GET['edit']) && $_GET['edit']!='')
	{
	$edit_callcenter=htmlentities($_GET['edit']);
	$sql_check_callcenter = "SELECT * FROM callcenters WHERE `owner_id`='$user_id' AND `id`='$edit_callcenter'";
	$result_check_callcenter = $mysqli->query($sql_check_callcenter);
	if (mysqli_num_rows($result_check_callcenter) > 0) 
		{
		$res_check_callcenter=mysqli_fetch_array($result_check_callcenter);
		$callcenter_id=htmlentities($res_check_callcenter['id']);
		$callcenter_name=htmlentities($res_check_callcenter['name']);
		$callcenter_site=str_replace('&amp;', '&', htmlentities($res_check_callcenter['site']));
		$callcenter_email=htmlentities($res_check_callcenter['email']);
		$callcenter_skype=htmlentities($res_check_callcenter['skype']);
		$callcenter_phone=htmlentities($res_check_callcenter['phone']);	
		$callcenter_offers=htmlentities($res_check_callcenter['offers']);	
		$callcenter_active=htmlentities($res_check_callcenter['active']);
		?>
		<p>
			<?php
			// Форма редактирования колл-центра
			// Edit a call-center form
			include './templates/'.$template.'/checkform/jquery.proverka.editcallcenter.form.php';
			include './templates/'.$template.'/blocks/editcallcenter_form.php';
			?>
		</p>	
		<?php
		}
	}
else
	{
	?>
	<p>
		<?php
		// Форма добавления колл-центра
		// Add a call-center form
		include './templates/'.$template.'/checkform/jquery.proverka.addcallcenter.form.php';
		include './templates/'.$template.'/blocks/addcallcenter_form.php';
		?>
	</p>
	<p>
		<p>
			<b><?php echo $loc['callcenter.php']['t15'];?></b>
		</p>
		<table class="stats_table" style="width: 100%; margin: 15px 0px 15px 0px;">
			<tr class="tableHead">
				<td>
					<?php echo $loc['callcenter.php']['t32'];?>
				</td>
				<td width="360"><?php echo $loc['callcenter.php']['t27']; ?></td>
				<td width="100"><?php echo $loc['callcenter.php']['t21'];?></td>
			</tr>
		</table>
		<?php
		$sql_callcenter = "SELECT * FROM callcenters WHERE `owner_id`='$user_id' ORDER BY `id` DESC";
		$result_callcenter = $mysqli->query($sql_callcenter);
		if (mysqli_num_rows($result_callcenter) > 0) 
			{
			while($res_callcenter=mysqli_fetch_array($result_callcenter)) 
				{
				$callcenter_id=htmlentities($res_callcenter['id']);
				$callcenter_name=htmlentities($res_callcenter['name']);
				$callcenter_site=str_replace('&amp;', '&', htmlentities($res_callcenter['site']));
				$callcenter_email=htmlentities($res_callcenter['email']);
				$callcenter_skype=htmlentities($res_callcenter['skype']);
				$callcenter_phone=htmlentities($res_callcenter['phone']);
				$callcenter_offers=htmlentities($res_callcenter['offers']);
				$callcenter_active=htmlentities($res_callcenter['active']);
				?> 
				<table class="stats_table" style="width: 100%; margin: 15px 0px 15px 0px;">
					<tr>
						<td style="text-align: left;">
							<span style="<?php if ($callcenter_active=='1') {echo 'background: green; color: white;';} else {echo 'background: red; color: white;';} ?>">&nbsp;<?php echo html_entity_decode($callcenter_name, ENT_QUOTES, 'utf-8'); ?>&nbsp;</span><?php echo '<br />'; ?>
							<div style="position: relative; height: 29px; line-height: 29px; margin-bottom: 5px;">
								<span title="<?php echo $loc['callcenter.php']['t17']; ?>" class="ico_site"></span>&nbsp;<?php if ($callcenter_site=='') {echo '<font color="#cccccc">'.$loc['callcenter.php']['t33'].'</font>';} else {?><a target="_blank" href="<?php echo $callcenter_site; ?>"><?php echo $callcenter_site; ?></a><?php } ?>&nbsp;&nbsp;
								<span title="<?php echo $loc['callcenter.php']['t18']; ?>" class="ico_email"></span>&nbsp;<?php if ($callcenter_email=='') {echo '<font color="#cccccc">'.$loc['callcenter.php']['t33'].'</font>';} else {?><a href="mailto:'.$callcenter_email.'"><?php echo $callcenter_email; ?></a><?php } ?>&nbsp;&nbsp;
								<span title="<?php echo $loc['callcenter.php']['t19']; ?>" class="ico_skype"></span>&nbsp;<?php if ($callcenter_skype=='') {echo '<font color="#cccccc">'.$loc['callcenter.php']['t33'].'</font>';} else {?><a href="skype:'.$callcenter_skype.'?add"><?php echo $callcenter_skype; ?></a><?php } ?>&nbsp;&nbsp;
								<span title="<?php echo $loc['callcenter.php']['t20']; ?>" class="ico_phone"></span>&nbsp;<?php if ($callcenter_phone=='') {echo '<font color="#cccccc">'.$loc['callcenter.php']['t33'].'</font>';} else {?><a href="skype:'.$callcenter_phone.'?add"><?php echo $callcenter_phone; ?></a><?php } ?>
							</div>
						</td>
						<td width="360">
							<?php
							$sql_selectoffers = "SELECT id,name FROM offers WHERE `owner_id`='$user_id' ORDER BY `id` DESC";
							$result_selectoffers = $mysqli->query($sql_selectoffers);
							if (mysqli_num_rows($result_selectoffers) > 0) 
								{
								while($res_selectoffers=mysqli_fetch_array($result_selectoffers)) 
									{
									$offer_id=htmlentities($res_selectoffers['id']);
									$offer_name=htmlentities($res_selectoffers['name']);
									?>
									<div style="text-align: left; display: block;">
										<?php
										$callcenter_array = explode(',', $callcenter_offers);
										if (in_array($offer_id,$callcenter_array)) 
											{
											$offer_name = html_entity_decode($offer_name, ENT_QUOTES, 'utf-8');
											echo $offer_name_vyvod = mb_substr($offer_name, 0, 45, 'UTF-8');
											if (mb_strlen($offer_name, 'UTF-8')>45) {echo '...';}
											}
										?>
									</div>
									<?php
									}
								}
							?>
						</td>
						<td width="100">
							<a class="no_border" href="./callcenter.php?edit=<?php echo $callcenter_id; ?>"><div class="ico_edit" title="<?php echo $loc['callcenter.php']['t29']; ?>"></div></a>&nbsp;&nbsp;<a class="no_border" href="./callcenter.php?delete=<?php echo $callcenter_id; ?>" onclick="if (!confirm('<?php echo $loc['callcenter.php']['t25']; ?>&nbsp;&quot;<?php echo html_entity_decode($callcenter_name, ENT_QUOTES, 'utf-8'); ?>&quot;? <?php echo $loc['callcenter.php']['t26']; ?>'))return false;"><div title="<?php echo $loc['callcenter.php']['t22'];?>" class="ico_delete"></div></a>
						</td>
					</tr>
				</table>
				<?php
				}
			}
		?>  
	</p>
	<?php
	}
?>

<p>
	&nbsp;
</p>