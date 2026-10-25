
<h1><?php echo $loc['prelandings.php']['t01']; ?></h1>

<p>
	<?php
	if (isset($_GET['xtext']) && $_GET['xtext']=='1') {echo '<font color=green><b>'.$loc['prelandings.php']['t09'].'</b></font>';}
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='2') {echo '<font color=red><b>'.$loc['prelandings.php']['t10'].'</b></font>';}
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='3') {echo '<font color=green><b>'.$loc['prelandings.php']['t11'].'</b></font>';}	
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='4') {echo '<font color=red><b>'.$loc['prelandings.php']['t12'].'</b></font>';}
	?>
</p>

<p>
	<?php
	// Выводим форму добавления прелендинга или сайта
	// Display the form or add a prelanding or website
	include ('./templates/'.$template.'/blocks/prelandings_form.php');
	?>
</p>

<p>
	&nbsp;
</p>

<p>
	<p>
		<b><?php echo $loc['prelandings.php']['t13']; ?></b>
	</p>
	<table class="stats_table" width="100%">
		<tr class="table_zagolovki">
			<td><?php echo $loc['prelandings.php']['t14']; ?></td>	
			<td><?php echo $loc['prelandings.php']['t15']; ?></td>
			<td><?php echo $loc['prelandings.php']['t16']; ?></td>
		</tr>
		<?php
		$sql_prelandings = "SELECT * FROM prelandings WHERE `owner_id`='$user_id' ORDER BY `id` DESC";
		$result_prelandings = $mysqli->query($sql_prelandings);
		$cvet=0;
		if (mysqli_num_rows($result_prelandings) > 0) 
			{
			while($res_prelandings=mysqli_fetch_array($result_prelandings)) 
				{
				$prelanding_id=htmlentities($res_prelandings['id']);
				$prelanding_name=htmlentities($res_prelandings['name']);
				$prelanding_url = str_replace('&amp;', '&', htmlentities($res_prelandings['url']));
				$prelanding_offer_id=htmlentities($res_prelandings['offer_id']);
				?> 
				<tr>
					<td style="text-align: left;"><?php echo html_entity_decode($prelanding_name, ENT_QUOTES, 'utf-8'); ?></td>
					<td style="text-align: left;"><a target="_blank" href="<?php echo $prelanding_url; ?>"><?php echo $prelanding_url; ?></a></td>
					<td style="text-align: left;">
						<?php
						// Получаем буквенное название оффера
						// Get the name of the letter offer
						$sql_viewoffer = "SELECT id,name FROM offers WHERE `id`='$prelanding_offer_id'";
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
							echo '<font color=red>'.$loc['prelandings.php']['t20'].'</font>';
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
