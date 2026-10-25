
	<!-- Блок с формой -->
	<!-- Block with a form -->
	<p>
		<b><?php echo $loc['callcenter.php']['t28']; ?></b>
	</p>
	<form name="editcallcenter_form" class="report" method="post" action="./callcenter.php">
		<p>
			<table class="landings_table">
				<?php
				if ($user_tip=='70')
					{
					?>
					<tr height="30">
						<td>
							<?php echo $loc['callcenter.php']['t38']; ?>&nbsp;
						</td>
						<td>
							<select name="reklamodatel">
								<?php
								$sql_rekl = "SELECT id,email FROM users WHERE `tip`='40' AND `uroven_dostupa`='2' ORDER BY id DESC";
								$result_rekl = $mysqli->query($sql_rekl);
								if (mysqli_num_rows($result_rekl) > 0) 
									{
									while($res_rekl=mysqli_fetch_array($result_rekl)) 
										{
										$rekl_id=htmlentities($res_rekl['id']);
										$rekl_email=htmlentities($res_rekl['email']);
										?>
										<option value="<?php echo $rekl_id; ?>"><?php echo html_entity_decode($rekl_email, ENT_QUOTES, 'utf-8') ;?></option>
										<?php
										}
									}
								?>
							</select>
						</td>
					</tr>					
					<?php
					}
				?>			
				<tr height="30">
					<td><?php echo $loc['callcenter.php']['t04']; ?>&nbsp;</td><td><input type="text" name="name" placeholder="<?php echo $loc['callcenter.php']['t08']; ?>" value="<?php echo html_entity_decode($callcenter_name, ENT_QUOTES, 'utf-8'); ?>" maxlength="100" required /> <font color="red">*</font></td>
				</tr>
				<tr height="30">
					<td><?php echo $loc['callcenter.php']['t05']; ?>&nbsp;</td><td><input type="text" name="site" placeholder="<?php echo $loc['callcenter.php']['t09']; ?>" value="<?php echo $callcenter_site; ?>" maxlength="100" /></td>
				</tr>
				<tr height="30">
					<td><?php echo $loc['callcenter.php']['t13']; ?>&nbsp;</td><td><input type="text" name="email" placeholder="<?php echo $loc['callcenter.php']['t14']; ?>" value="<?php echo $callcenter_email; ?>" maxlength="50" /></td>
				</tr>				
				<tr height="30">
					<td><?php echo $loc['callcenter.php']['t06']; ?>&nbsp;</td><td><input type="text" name="skype" placeholder="<?php echo $loc['callcenter.php']['t10']; ?>" value="<?php echo $callcenter_skype; ?>" maxlength="50" /></td>
				</tr>
				<tr height="30">
					<td><?php echo $loc['callcenter.php']['t07']; ?>&nbsp;</td><td><input type="text" name="phone" placeholder="<?php echo $loc['callcenter.php']['t11']; ?>" value="<?php echo $callcenter_phone; ?>" maxlength="50" /></td>
				</tr>
				<tr>
					<td><?php echo $loc['callcenter.php']['t27']; ?></td>
					<td style="line-height: 25px;">
						<?php
						if ($user_tip=='70')
							{
							$sql_selectoffers = "SELECT id,name FROM offers WHERE `owner_id`='$callcenter_owner' ORDER BY `id` DESC";
							}
						else
							{
							$sql_selectoffers = "SELECT id,name FROM offers WHERE `owner_id`='$user_id' ORDER BY `id` DESC";
							}							
						$result_selectoffers = $mysqli->query($sql_selectoffers);
						if (mysqli_num_rows($result_selectoffers) > 0) 
							{
							while($res_selectoffers=mysqli_fetch_array($result_selectoffers)) 
								{
								$offer_id=htmlentities($res_selectoffers['id']);
								$offer_name=htmlentities($res_selectoffers['name']);
								?>
								<div style="text-align: left; display: block;">
									<label>
										<input type="checkbox" name="offers[]" value="<?php echo $offer_id; ?>" 
										<?php 
										$callcenter_array = explode(',', $callcenter_offers);
										if (in_array($offer_id,$callcenter_array)) {echo 'checked="checked"';}
										?>>
											&nbsp;<?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?>
									</label>
								</div>
								<?php
								}
							}
						?>
					</td>
				</tr>
				<tr>
					<td><?php echo $loc['callcenter.php']['t35']; ?></td>
					<td>
						<select name="active" style="width: 150px;"> 
							<option value="1" <?php if ($callcenter_active=='1') {echo 'selected="selected"';} ?>><?php echo $loc['callcenter.php']['t36']; ?></option>
							<option value="2" <?php if ($callcenter_active=='2') {echo 'selected="selected"';} ?>><?php echo $loc['callcenter.php']['t37']; ?></option>
						</select>
					</td>
				</tr>
			</table>
			<p>
				<input type="hidden" name="edit" value="<?php echo $edit_callcenter; ?>">
				<input name="submit_editcallcenter" value="<?php echo $loc['button']['t01']; ?>" class="others_button_sohranit" type="submit" onclick="if (!confirm('<?php echo $loc['callcenter.php']['t34']; ?>&nbsp;&quot;<?php echo html_entity_decode($callcenter_name, ENT_QUOTES, 'utf-8'); ?>&quot;?'))return false;">
			</p>
		</p>
	</form>
	<!-- Конец блока с формой -->
	<!-- End unit with a form -->

	