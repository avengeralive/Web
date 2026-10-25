<div class="row cabinet main mt-50 mb-50">
    
<div class="col-12 mb-10"><p class="pageTitle mb-25"><?php echo $loc['cat_offers.php']['t01']; ?></p></div>

	<?php
	if (isset($_GET['xtext']) && $_GET['xtext']=='1') {$error_message = $loc['cat_offers.php']['t02'];$error_type = 'error';}
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='2') {$error_message = $loc['cat_offers.php']['t03'];$error_type = 'success';}
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='3') {$error_message = $loc['cat_offers.php']['t04'];$error_type = 'success';}
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='4') {$error_message = $loc['cat_offers.php']['t05'];$error_type = 'error';}
        include_once './includes/errors.php';
	?>
<div class="col-12 mb-10">
	<?php
	// Выводим форму добавления категорий
	// Display the form of adding categories
	include ('./templates/'.$template.'/blocks/cat_offers_form.php');
	?>
</div>

<div class="col-6 mb-10">
	<p>
		<b><?php echo $loc['cat_offers.php']['t06']; ?></b>
	</p>
	<table class="table table-bordered">
		<tr class="table_zagolovki">
			<td><?php echo $loc['cat_offers.php']['t07']; ?></td>	
			<td><?php echo $loc['cat_offers.php']['t08']; ?></td>
		</tr>
		<?php
		$sql = "SELECT * FROM category_tpl ORDER BY `name` ASC";
		$result = $mysqli->query($sql);
		$cvet=0;
		if (mysqli_num_rows($result) > 0) 
			{
			while($res=mysqli_fetch_array($result)) 
				{
				$id_category=htmlentities($res['id']);
				$name_category=htmlentities($res['name']);
				?> 
				<tr class="<?php if ( $cvet & 1 ) {echo 'col2';} else {echo '';} $cvet++; ?>">
					<td><?php echo html_entity_decode($name_category, ENT_QUOTES, 'utf-8'); ?></td>
					<td><a href="./cat_offers.php?delete=<?php echo $id_category; ?>" onclick="if (!confirm('<?php echo $loc['cat_offers.php']['t09']; ?>&nbsp;<?php echo html_entity_decode($name_category, ENT_QUOTES, 'utf-8'); ?>?'))return false;"><?php echo $loc['cat_offers.php']['t10']; ?></a></td> 
				</tr>
				<?php
				}
			}
		?>  
	</table>
</div>
</div>