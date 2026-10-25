<div class="row main mt-50 mb-50">

    <div class="col-12 mb-10"><p class="pageTitle mb-25"><?php echo $loc['prelandings.php']['t01']; ?></p></div>

    
    <?php 
    if (isset($_GET['xtext']) && $_GET['xtext']=='1') {$error_message = $loc['prelandings.php']['t09'];$error_type = 'success';} 
    if (isset($_GET['xtext']) && $_GET['xtext']=='2') {$error_message = $loc['prelandings.php']['t10'];$error_type = 'error';} 
    if (isset($_GET['xtext']) && $_GET['xtext']=='3') {$error_message = $loc['prelandings.php']['t11'];$error_type = 'success';} 
    if (isset($_GET['xtext']) && $_GET['xtext']=='4') {$error_message = $loc['prelandings.php']['t12'];$error_type = 'error';}
    ?>

    <?php
    // Выводим форму добавления прелендинга или сайта
    // Display the form or add a prelanding or website
    include ('./templates/'.$template.'/blocks/prelandings_form.php');
    ?>

    
    <div class="col-12 mt-30">
    
	<p>
		<b><?php echo $loc['prelandings.php']['t13']; ?></b>
	</p>
        
	<table class="table table-bordered" width="100%">
		<tr class="tableHead">
			<td style="width: 40px;"><?php echo $loc['prelandings.php']['t17']; ?></td>
			<td style="width: 250px;"><?php echo $loc['prelandings.php']['t14']; ?></td>	
			<td><?php echo $loc['prelandings.php']['t15']; ?></td>
			<td style="width: 400px;"><?php echo $loc['prelandings.php']['t16']; ?></td>
			<td style="width: 100px;"><?php echo $loc['prelandings.php']['t18']; ?></td>
			<td style="width: 70px;"><?php echo $loc['prelandings.php']['t19']; ?></td>
		</tr>
	
		<?php
		$sql_prelandings = "SELECT * FROM prelandings ORDER BY `id` DESC";
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
					<td style="width: 40px;"><?php echo $prelanding_id; ?></td>
					<td style="width: 250px; text-align: left;"><?php echo html_entity_decode($prelanding_name, ENT_QUOTES, 'utf-8'); ?></td>
					<td style="text-align: left;"><a target="_blank" href="<?php echo $prelanding_url; ?>"><?php echo $prelanding_url; ?></a></td>
					<td style="text-align: left; width: 400px;">
						<?php
						// Получаем буквенное название оффера и его статус
						// Get the name of the letter and its status offer
						$sql_viewoffer = "SELECT id,name,active FROM offers WHERE `id`='$prelanding_offer_id'";
						$result_viewoffer = $mysqli->query($sql_viewoffer);
						if (mysqli_num_rows($result_viewoffer) > 0) 
							{
							$res_viewoffer=mysqli_fetch_array($result_viewoffer);
							$id_of=htmlentities($res_viewoffer['id']);
							$name_of=htmlentities($res_viewoffer['name']);
							$active_of=htmlentities($res_viewoffer['active']);
							echo '<a target="_blank" href="./offers.php?offer='.$id_of.'">'.html_entity_decode($name_of, ENT_QUOTES, 'utf-8').'</a>';
							}
						else
							{
							echo '<font color=red>'.$loc['prelandings.php']['t20'].'</font>';
							}
						?>
					</td>
					<?php
					if (isset($active_of))
						{
						if ($active_of=='0') {echo '<td style="width: 100px; background: red; color: white;">'.$loc['prelandings.php']['t21'].'</td>';}
						if ($active_of=='1') {echo '<td style="width: 100px; background: green; color: white;">'.$loc['prelandings.php']['t22'].'</td>';}
						if ($active_of=='2') {echo '<td style="width: 100px; background: yellow; color: red;">'.$loc['prelandings.php']['t23'].'</td>';}
						}
					else
						{
						echo '<td style="background: red; color: white;">'.$loc['prelandings.php']['t24'].'</td>';
						}
					?>
					</td>
					<td style="width: 70px;"><a href="./prelandings.php?delete=<?php echo $prelanding_id; ?>" onclick="if (!confirm('<?php echo $loc['prelandings.php']['t25']; ?>&nbsp;<?php echo html_entity_decode($prelanding_name, ENT_QUOTES, 'utf-8'); ?>?'))return false;"><?php echo $loc['prelandings.php']['t26']; ?></a></td> 
				</tr>
							
				<?php
				}
			}
		?>  

</p>
</table>
    </div>
