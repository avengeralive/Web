<div class="row cabinet main mt-50 mb-50">

    <div class="col-12 mb-10"><p class="pageTitle mb-25"><?php echo $loc['domains.php']['t01']; ?></p></div>
    
    <?php 
	if (isset($_GET['xtext']) && $_GET['xtext']=='1') {$error_message = $loc['domains.php']['t02'];$error_type = 'error';}
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='2') {$error_message = $loc['domains.php']['t03'];$error_type = 'success';}
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='3') {$error_message = $loc['domains.php']['t04'];$error_type = 'success';}
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='4') {$error_message = $loc['domains.php']['t05'];$error_type = 'error';}
        include_once './includes/errors.php';
    ?>
    <div class="col-12 mb-50">

	<?php
	// Выводим форму добавления домена
	// Display the form adding domain
	include ('./templates/'.$template.'/blocks/domains_form.php');
	?>
        
    </div>
    
    
    <div class="col-6 mb-50">
		<b><?php echo $loc['domains.php']['t06']; ?></b>
	</p>
	<table class="table table-bordered">
		<tr class="tableHead">
			<td><?php echo $loc['domains.php']['t07']; ?></td>	
			<td style="width: 350px;"><?php echo $loc['domains.php']['t08']; ?></td>
			<td><?php echo $loc['domains.php']['t09']; ?></td>
		</tr>
		<?php
		$sql = "SELECT * FROM domains ORDER BY `id` DESC";
		$result = $mysqli->query($sql);
		$cvet=0;
		if (mysqli_num_rows($result) > 0) 
			{
			while($res=mysqli_fetch_array($result)) 
				{
				$id_curdomain=htmlentities($res['id']);
				$active_curdomain=htmlentities($res['active']);
				$domain_curdomain=htmlentities($res['domain']);
				?> 
				<tr class="<?php if ( $cvet & 1 ) {echo 'col2';} else {echo '';} $cvet++; ?>">
					<td><?php echo html_entity_decode($domain_curdomain, ENT_QUOTES, 'utf-8'); ?></td>
					<td> 
					
					<?php 
					if ($active_curdomain=='1') {echo '<span style="background: green; color: white;">&nbsp;'.$loc['domains.php']['t10'].'&nbsp;</span>';}
					elseif ($active_curdomain=='2') {echo '<span style="background: green; color: white;">&nbsp;'.$loc['domains.php']['t11'].'&nbsp;</span>';}
					elseif ($active_curdomain=='0') 
						{
						?>
						<?php echo $loc['domains.php']['t12']; ?>&nbsp;<a class="normal_link" href="./domains.php?main=<?php echo $id_curdomain; ?>&act=1" onclick="if (!confirm('<?php echo $loc['domains.php']['t13']; ?>&nbsp;<?php echo html_entity_decode($domain_curdomain, ENT_QUOTES, 'utf-8'); ?>?'))return false;"><?php echo $loc['domains.php']['t14']; ?></a>
						|
						<a class="normal_link" href="./domains.php?main=<?php echo $id_curdomain; ?>&act=2" onclick="if (!confirm('<?php echo $loc['domains.php']['t13']; ?>&nbsp;<?php echo html_entity_decode($domain_curdomain, ENT_QUOTES, 'utf-8'); ?>?'))return false;"><?php echo $loc['domains.php']['t15']; ?></a>
						<?php
						}
					?>
					</td>	
					<td><a href="./domains.php?delete=<?php echo $id_curdomain; ?>" onclick="if (!confirm('<?php echo $loc['domains.php']['t17']; ?>&nbsp;<?php echo html_entity_decode($domain_curdomain, ENT_QUOTES, 'utf-8'); ?>?'))return false;"><?php echo $loc['domains.php']['t16']; ?></a></td> 
				</tr>
				<?php
				}
			}
		?>  
	</table>
</div>
    </div>