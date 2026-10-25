
	<?php
	include ('./templates/'.$template.'/checkform/jquery.proverka.prelandings.form.php');
	?>
        
    <div class="col-12 ">
        <div class="card" style="min-height: auto;">
            <div class="card-body">
	<!-- Блок с формой -->
	<!-- Block with a form -->
	<form name="prelandings_form" class="report" method="post" action="./prelandings.php?<?php echo @$_SERVER['QUERY_STRING']?>">
		<p>
			<b><?php echo $loc['prelandings.php']['t27']; ?></b>
		</p>

			<table class="table table-borderless">
				<tr height="30">
					<td><?php echo $loc['prelandings.php']['t28']; ?>&nbsp;</td><td><input style="width:100%;" type="text" name="name" value="" maxlength="90" required /></td>
				</tr>
				<tr height="30">
					<td><?php echo $loc['prelandings.php']['t29']; ?>&nbsp;http://&nbsp;<?php echo $loc['prelandings.php']['t30']; ?>&nbsp;https://&nbsp;</td><td><input style="width:100%;" type="text" name="url" value="http://bd-offers.ru/" maxlength="250" required /></td>
				</tr>
				<tr height="30">
					<td><?php echo $loc['prelandings.php']['t31']; ?>&nbsp;</td>
					<td>
						<select name="offer_id">
							<?php
							if ($user_tip=='70' || $user_tip=='20' || $user_tip=='90' || $user_tip=='100' || $user_tip=='110')
								{
								$sql_offer = "SELECT id,name FROM offers ORDER BY id DESC";								
								}
							else
								{	
								// Рекламодатель может выбирать из списка только свои офферы
								// An advertiser can select from a list of only your offers
								$sql_offer = "SELECT id,name FROM offers WHERE `owner_id`='$user_id' ORDER BY id DESC";								
								}
							$result_offer = $mysqli->query($sql_offer);
							if (mysqli_num_rows($result_offer) > 0) 
								{
								while($res_offer=mysqli_fetch_array($result_offer)) 
									{
									$of_id=htmlentities($res_offer['id']);
									$of_name=htmlentities($res_offer['name']);
									?> 
									<option class="options" value="<?php echo $of_id; ?>"><?php echo html_entity_decode($of_name, ENT_QUOTES, 'utf-8'); ?></option>
									<?php
									}
								}
							?>
						</select>
					</td>
				</tr>				
			</table>
			<p>
				<input name="submit_addprelanding" value="<?php echo $loc['prelandings.php']['t32']; ?>" class="others_button_sohranit" type="submit">
			</p>

	</form>
	<!-- Конец блока с формой -->
	<!-- End unit with a form -->
            </div>
        </div>
    </div>