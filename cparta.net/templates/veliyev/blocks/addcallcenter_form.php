
	<!-- Блок с формой -->
	<!-- Block with a form -->
	<p>
		<b><?php echo $loc['callcenter.php']['t03']; ?></b>
	</p>
	<form name="addcallcenter_form" class="report" method="post" action="./callcenter.php">
		<p>
			<table class="landings_table">
				<?php
				if ($user_tip=='70')
					{
					?>
					<tr height="30">
						<td style="width: 186px;">
							<?php echo $loc['callcenter.php']['t38']; ?>&nbsp;
						</td>
						<td>
							<select name="reklamodatel" id="reklamodatel_id" onchange="$('.list_offers').html(''); changeRekl(); check_Rekl();">
								<option value="0"><?php echo $loc['callcenter.php']['t40']; ?></option>
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
					<td><?php echo $loc['callcenter.php']['t04']; ?>&nbsp;</td><td><input type="text" name="name" placeholder="<?php echo $loc['callcenter.php']['t08']; ?>" value="" maxlength="100" required /> <font color="red">*</font></td>
				</tr>
				<tr height="30">
					<td><?php echo $loc['callcenter.php']['t05']; ?>&nbsp;</td><td><input type="text" name="site" placeholder="<?php echo $loc['callcenter.php']['t09']; ?>" value="" maxlength="100" /></td>
				</tr>
				<tr height="30">
					<td><?php echo $loc['callcenter.php']['t13']; ?>&nbsp;</td><td><input type="text" name="email" placeholder="<?php echo $loc['callcenter.php']['t14']; ?>" value="" maxlength="50" /></td>
				</tr>				
				<tr height="30">
					<td><?php echo $loc['callcenter.php']['t06']; ?>&nbsp;</td><td><input type="text" name="skype" placeholder="<?php echo $loc['callcenter.php']['t10']; ?>" value="" maxlength="50" /></td>
				</tr>
				<tr height="30">
					<td><?php echo $loc['callcenter.php']['t07']; ?>&nbsp;</td><td><input type="text" name="phone" placeholder="<?php echo $loc['callcenter.php']['t11']; ?>" value="" maxlength="50" /></td>
				</tr>
				<?php
				if ($user_tip=='70')
					{
					echo '<tr><td colspan="2" class="list_offers"></td></tr>';
					?>						
					<script type="text/javascript">
						function getXmlHttp() 
							{
							var xmlhttp;
							try 
								{
								xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
								} 
							catch (e) 
								{
								try 
									{
									xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
									} 
								catch (E) 
									{
									xmlhttp = false;
									}
								}
							if (!xmlhttp && typeof XMLHttpRequest!='undefined') 
								{
								xmlhttp = new XMLHttpRequest();
								}
							return xmlhttp;
							}
						function changeRekl(id) 
							{
							var xmlhttp = getXmlHttp();
							xmlhttp.open('POST', './callcenter.php', true);
							xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
							xmlhttp.send("reklamodatel_id=" + $("#reklamodatel_id option:selected").val()+"&checkoffers=yes");
							xmlhttp.onreadystatechange = function() 
								{
								if (xmlhttp.readyState == 4) 
									{
									if(xmlhttp.status == 200) 
										{
										var xlist_offers = JSON.parse(xmlhttp.responseText);
										var text = ""; 
										var start_text="<tr><td style='width: 186px;'><?php echo $loc['callcenter.php']['t27']; ?></td><td style='line-height: 25px;'>";
										var end_text="</td></tr>";
										for (var id in xlist_offers) 
											{
											text += "<div style='text-align: left; display: block;'><label><input type='checkbox' name='offers[]' value='"+xlist_offers[id].id+"'>&nbsp;"+xlist_offers[id].name+"</label></div>";
											}
										$(".list_offers").html(start_text+text+end_text); 
										}
									}
								}
							}
						function check_Rekl()
							{
							if ($("#reklamodatel_id option:selected").val()=="0")
								{
								$("#submit_addcallcenter").css("display", "none");
								alert('<?php echo $loc['callcenter.php']['t39']; ?>');
								}
							else
								{
								$("#submit_addcallcenter").css("display", "block");
								}								
							}
					</script>
					<?php
					}
				elseif ($user_tip=='40')
					{
					$sql_selectoffers = "SELECT id,name FROM offers WHERE `owner_id`='$user_id' ORDER BY `id` DESC";
					$result_selectoffers = $mysqli->query($sql_selectoffers);
					if (mysqli_num_rows($result_selectoffers) > 0) 
						{
						echo '<tr><td>'.$loc['callcenter.php']['t27'].'</td><td style="line-height: 25px;">';
						while($res_selectoffers=mysqli_fetch_array($result_selectoffers)) 
							{
							$offer_id=htmlentities($res_selectoffers['id']);
							$offer_name=htmlentities($res_selectoffers['name']);
							?>
							<div style="text-align: left; display: block;">
								<label>
									<input type="checkbox" name="offers[]" value="<?php echo $offer_id; ?>">&nbsp;<?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?>
								</label>
							</div>
							<?php
							}
						echo '</td></tr>';
						}						
					}
				?>
				<tr>
					<td><?php echo $loc['callcenter.php']['t35']; ?></td>
					<td>
						<select name="active" style="width: 150px;"> 
							<option value="1" selected="selected"><?php echo $loc['callcenter.php']['t36']; ?></option>
							<option value="2"><?php echo $loc['callcenter.php']['t37']; ?></option>
						</select>
					</td>
				</tr>				
			</table>
			<p>
				<input id="submit_addcallcenter" name="submit_addcallcenter" value="<?php echo $loc['button']['t01']; ?>" class="others_button_sohranit" type="submit" <?php if ($user_tip=='70') {echo 'style="display: none;"';} ?>>&nbsp;
			</p>
		</p>
	</form>
	<!-- Конец блока с формой -->
	<!-- End unit with a form -->

	