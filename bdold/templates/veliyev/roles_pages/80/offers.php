
<h1><?php echo $loc['offers.php']['t01']; ?></h1>

<p>
	<?php 
	if (isset($_GET['xtext']) && $_GET['xtext']=='1') {echo '<font color=red><b>'.$loc['offers.php']['t48'].'</b></font>';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='2') {echo '<font color=red><b>'.$loc['offers.php']['t49'].'</b></font>';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='3') {echo '<font color=red><b>'.$loc['offers.php']['t50'].'</b></font>';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='4') {echo '<font color=green><b>'.$loc['offers.php']['t51'].'</b></font>';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='5') {echo '<font color=green><b>'.$loc['offers.php']['t52'].'</b></font>';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='6') {echo '<font color=red><b>'.$loc['offers.php']['t53'].'</b></font>';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='7') {echo '<font color=green><b>'.$loc['offers.php']['t165'].'</b></font>';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='8') {echo '<font color=red><b>'.$loc['offers.php']['t166'].'</b></font>';} 
	?>
</p>

<?php
if (isset($_GET['offer']) && ($_GET['offer']!=''))
	{
	// Вывод отдельно взятого оффера
	// Display a single offer
	include './templates/'.$template.'/blocks/offers_80_view.php';
	}
else
	{
	// Вывод списка всех офферов
	// Display a list of all offers
	include './templates/'.$template.'/blocks/offers_80_spisok.php';
	}
?>
<p>
	&nbsp;
</p>

