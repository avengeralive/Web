
<?php
include ('./templates/'.$template.'/checkform/jquery.proverka.adduser.form.php');
?>
		
<p>
	<form name="adduser_form" method="post" action="./adduser.php?<?php echo @$_SERVER['QUERY_STRING']?>">
		<table style="width: 700px;">
			<tr height="30">
				<td style="width: 180px;"><?php echo $loc['adduser.php']['t10']; ?>&nbsp;</td><td><input type="text" name="email" placeholder="<?php echo $loc['adduser.php']['t18']; ?>" value="" maxlength="50"  /></td>
			</tr>
			<tr height="30">
				<td><?php echo $loc['adduser.php']['t11']; ?>&nbsp;</td><td><input type="password" id="password1" name="password1" placeholder="<?php echo $loc['adduser.php']['t19']; ?>" value="" maxlength="50"  /></td>
			</tr>	
			<tr height="30">
				<td><?php echo $loc['adduser.php']['t12']; ?>&nbsp;</td><td><input type="password" name="password2" placeholder="<?php echo $loc['adduser.php']['t20']; ?>" value="" maxlength="50"  /></td>
			<tr>	
			<tr height="30">
				<td><?php echo $loc['adduser.php']['t13']; ?>&nbsp;</td>
				<td>
					<select name="active">
						<option value="0"><?php echo $loc['adduser.php']['t14']; ?></option>
						<option value="1"><?php echo $loc['adduser.php']['t15']; ?></option>			
						<option value="5"><?php echo $loc['adduser.php']['t16']; ?></option>
					</select>
				</td>
			</tr>	
			<tr height="30">
				<td><?php echo $loc['adduser.php']['t17']; ?>&nbsp;</td>
				<td>
					<select name="tip">
						<?php
						$sql_uroven = "SELECT tip,title FROM users_roles_tpl WHERE active='1'";
						$result_uroven = $mysqli->query($sql_uroven);
						if (mysqli_num_rows($result_uroven) > 0) 
							{
							while($res_uroven=mysqli_fetch_array($result_uroven)) 
								{ 
								if ($res_uroven['tip']!='20')
									{
									?>
									<option value="<?php echo htmlentities($res_uroven['tip']);?>"><?php echo htmlentities($res_uroven['title']);?></option>
									<?php
									}
								}
							}
						?>
					</select>
				</td>
			</tr>	
		</table>
		<p>
			<input name="submit_new_user" value="<?php echo $loc['button']['t01']; ?>" class="btn button" type="submit">
		</p>
	</form>
</p>
