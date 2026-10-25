
	<?php
	include ('./templates/'.$template.'/checkform/jquery.proverka.landings.form.php');
	?>

        
    <div class="col-12 ">
        <div class="card" style="min-height: auto;">
            <div class="card-body">
	<!-- Блок с формой -->
	<!-- Block with a form -->
	<form name="landings_form" class="report" method="post" action="./landings.php?<?php echo @$_SERVER['QUERY_STRING']?>">
		<p>
			<b><?php echo $loc['landings.php']['t11']; ?></b>
		</p>
		<p>
			<table class="table table-borderless">
				<tr height="30">
                                    <td><?php echo $loc['landings.php']['t12']; ?>&nbsp;</td><td><input style="width:100%;" type="text" name="name" value="" maxlength="90" required /></td>
				</tr>
				<tr height="30">
                                    <td><?php echo $loc['landings.php']['t13']; ?>&nbsp;http://&nbsp;<?php echo $loc['landings.php']['t14']; ?>&nbsp;https://&nbsp;</td><td><input style="width:100%;" type="text" name="url" value="http://cparta.online/" required /></td>
				</tr>
                                <tr height="30">
					<td>Тип</td><td><select name="type">
                                                <option value="1">Обычный</option>
                                                <option value="4">Адаптивный</option>
                                                <option value="2">Мобильный</option>
                                                
                                            </select></td>
				</tr>
				<tr height="30">
					<td><?php echo $loc['landings.php']['t15']; ?>&nbsp;</td>
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
                        <p class="mt-25">
                            <input name="submit_addlanding" value="<?php echo $loc['button']['t01']; ?>" class="btn button" type="submit">
			</p>
		</p>
	</form>
	<!-- Конец блока с формой -->
	<!-- End unit with a form -->

            </div>
        </div>
    </div>
