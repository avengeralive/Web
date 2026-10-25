
	<!-- Блок с формой -->
	<!-- Block with a form -->
	<p>
		<b><?php echo $loc['operators.php']['t31']; ?></b>
	</p>
	<p>
		<form name="editoperator_form" class="report" method="post" action="./operators.php">
			<table style="width: 700px;">
				<tr height="30">
					<td><?php echo $loc['operators.php']['t32']; ?></td>
					<td>
						<select name="active" style="width: 150px;"> 
							<option value="1" <?php if ($operators_active=='1') {echo 'selected="selected"';} ?>><?php echo $loc['operators.php']['t33']; ?></option>
							<option value="5" <?php if ($operators_active=='5') {echo 'selected="selected"';} ?>><?php echo $loc['operators.php']['t34']; ?></option>
						</select>
					</td>
				</tr>		
				<tr height="30">
					<td style="width: 180px;"><?php echo $loc['adduser.php']['t10']; ?>&nbsp;</td><td><input type="text" name="email" placeholder="<?php echo $loc['adduser.php']['t18']; ?>" value="<?php echo $operators_email; ?>" maxlength="50" required /></td>
				</tr>
				<tr height="30">
					<td><?php echo $loc['operators.php']['t28']; ?></td>			
					<td><input type="text" name="name" placeholder="<?php echo $loc['operators.php']['t29']; ?>" value="<?php echo html_entity_decode($operators_name, ENT_QUOTES, 'utf-8'); ?>" maxlength="50" /></td>
				</tr>
				<tr height="30">
					<td><?php echo $loc['operators.php']['t36']; ?>&nbsp;</td>
					<td>
						<select name="callcenter">
							<?php
							if ($user_tip=='70')
								{
								$sql_uroven = "SELECT id,name,owner_id FROM callcenters ORDER BY id DESC";
								}
							else
								{
								$sql_uroven = "SELECT id,name,owner_id FROM callcenters WHERE `owner_id`='$user_id' ORDER BY id DESC";	
								}
							$result_uroven = $mysqli->query($sql_uroven);
							if (mysqli_num_rows($result_uroven) > 0) 
								{
								while($res_uroven=mysqli_fetch_array($result_uroven)) 
									{
									$sp_id=htmlentities($res_uroven['id']);
									$sp_name=htmlentities($res_uroven['name']);
									$sp_owner=htmlentities($res_uroven['owner_id']);
									
									if ($user_tip=='70')
										{
										$sql_rekl = "SELECT id,email FROM users WHERE `id`='$sp_owner'";
										$result_rekl = $mysqli->query($sql_rekl);
										$res_rekl=mysqli_fetch_array($result_rekl);
										$rekl_id=htmlentities($res_rekl['id']);
										$rekl_email=htmlentities($res_rekl['email']);
										?>
										<option value="<?php echo $sp_id; ?>" <?php if ($sp_id==$operators_callcenter) {echo 'selected="selected"';} ?>><?php echo $loc['operators.php']['t37']; ?>&nbsp;<?php echo $rekl_email.',&nbsp;'.html_entity_decode($sp_name, ENT_QUOTES, 'utf-8') ;?></option>
										<?php
										}
									else
										{
										?>
										<option value="<?php echo $sp_id; ?>" <?php if ($sp_id==$operators_callcenter) {echo 'selected="selected"';} ?>><?php echo html_entity_decode($sp_name, ENT_QUOTES, 'utf-8') ;?></option>
										<?php
										}
									}
								}
							?>
						</select>
					</td>
				</tr>	
				</table>
				</p>
				<p>
				<table style="width: 700px;">
				<tr height="30">
					<td style="width: 180px;"><?php echo $loc['operators.php']['t35']; ?>&nbsp;</td><td><input type="password" id="password1" name="password1" placeholder="<?php echo $loc['adduser.php']['t19']; ?>" value="" maxlength="50" /></td>
				</tr>	
				<tr height="30">
					<td><?php echo $loc['adduser.php']['t12']; ?>&nbsp;</td><td><input type="password" name="password2" placeholder="<?php echo $loc['adduser.php']['t20']; ?>" value="" maxlength="50" /></td>
				<tr>			
			</table>
			<p>
			<input type="hidden" name="id" value="<?php echo $edit_operators; ?>">
				<?php 
				if (mysqli_num_rows($result_uroven) > 0) 
					{
					echo '<input name="submit_editoperator" value="'.$loc['button']['t01'].'" class="others_button_sohranit" type="submit">';
					}
				else
					{
					echo '<br /><b><font color=red>'.$loc['operators.php']['t14'].'</font></b>';				
					}
				?>
			</p>
		</form>
	</p>
	<!-- Конец блока с формой -->
	<!-- End unit with a form -->

	