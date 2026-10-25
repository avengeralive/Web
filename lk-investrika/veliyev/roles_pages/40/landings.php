
<h1><?php echo $loc['landings.php']['t01']; ?></h1>

<p>
	<?php
	if (isset($_GET['xtext']) && $_GET['xtext']=='1') {echo '<font color=green><b>'.$loc['landings.php']['t02'].'</b></font>';}
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='2') {echo '<font color=red><b>'.$loc['landings.php']['t03'].'</b></font>';}
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='3') {echo '<font color=green><b>'.$loc['landings.php']['t04'].'</b></font>';}	
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='4') {echo '<font color=red><b>'.$loc['landings.php']['t05'].'</b></font>';}
	?>
</p>

<p>
	<?php
	// Выводим форму добавления лендинга или сайта
	// Display the form or add a landing or website
	include ('./templates/'.$template.'/blocks/landings_form.php');
	?>
</p>

<p>
	&nbsp;
</p>

<p>
	<p>
		<b><?php echo $loc['landings.php']['t06']; ?></b>
	</p>
	<table class="stats_table" width="100%">
		<tr class="table_zagolovki">
			<td><?php echo $loc['landings.php']['t07']; ?></td>	
			<td><?php echo $loc['landings.php']['t08']; ?></td>
			<td><?php echo $loc['landings.php']['t09']; ?></td>
		</tr>
		<?php
		$sql_landings = "SELECT * FROM landings WHERE `owner_id`='$user_id' ORDER BY `id` DESC";
		$result_landings = $mysqli->query($sql_landings);
		$cvet=0;
		if (mysqli_num_rows($result_landings) > 0) 
			{
			while($res_landings=mysqli_fetch_array($result_landings)) 
				{
				$landing_id=htmlentities($res_landings['id']);
				$landing_name=htmlentities($res_landings['name']);
				$landing_url = str_replace('&amp;', '&', htmlentities($res_landings['url']));
				$landing_offer_id=htmlentities($res_landings['offer_id']);
				?> 
				<tr class="<?php if ( $cvet & 1 ) {echo 'col2';} else {echo '';} $cvet++; ?>">
					<td style="text-align: left;"><?php echo html_entity_decode($landing_name, ENT_QUOTES, 'utf-8'); ?></td>
					<td style="text-align: left;"><a target="_blank" href="<?php echo $landing_url; ?>"><?php echo $landing_url; ?></a></td>
					<td style="text-align: left;">
						<?php
						// Получаем буквенное название оффера
						// Get the name of the letter offer
						$sql_viewoffer = "SELECT id,name FROM offers WHERE `id`='$landing_offer_id'";
						$result_viewoffer = $mysqli->query($sql_viewoffer);
						if (mysqli_num_rows($result_viewoffer) > 0) 
							{
							$res_viewoffer=mysqli_fetch_array($result_viewoffer);
							$id_of=htmlentities($res_viewoffer['id']);
							$name_of=htmlentities($res_viewoffer['name']);
							echo '<a target="_blank" href="./offers.php?offer='.$id_of.'">'.html_entity_decode($name_of, ENT_QUOTES, 'utf-8').'</a>';
							}
						else
							{
							echo $loc['landings.php']['t10'];
							}
						?>
					</td>
				</tr>
				<?php
				}
			}
		?>  
	</table>
</p>
