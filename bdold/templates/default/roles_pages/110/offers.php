<div class="row main mt-50 mb-50">

	<?php 
	if (isset($_GET['xtext']) && $_GET['xtext']=='1') {$error_message = $loc['offers.php']['t48'];$error_type = 'error';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='2') {$error_message = $loc['offers.php']['t49'];$error_type = 'error';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='3') {$error_message = $loc['offers.php']['t50'];$error_type = 'error';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='4') {$error_message = $loc['offers.php']['t51'];$error_type = 'success';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='5') {$error_message = $loc['offers.php']['t52'];$error_type = 'success';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='6') {$error_message = $loc['offers.php']['t53'];$error_type = 'error';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='7') {$error_message = $loc['offers.php']['t165'];$error_type = 'success';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='8') {$error_message = $loc['offers.php']['t166'];$error_type = 'error';} 
	?>


<?php
if (isset($_GET['offer']) && ($_GET['offer']!=''))
	{
	// Вывод отдельно взятого оффера
	// Display a single offer
	include './templates/'.$template.'/blocks/offers_110_view.php';
	}
elseif (isset($_GET['addoffer']) && ($_GET['addoffer']!=''))
	{
	// Добавление нового оффера
	// Add a new offer
        echo '<div class="col-12 mb-10"><p class="pageTitle mb-25">'.$loc['settings.php']['t67'].'</p></div>';
	include './templates/'.$template.'/blocks/offers_110_addoffer.php';
	}	
else
	{
	// Вывод списка всех офферов
	// Display a list of all offers
	echo '
            <div class="col-12 mb-10">
                <p class="float-left pageTitle mb-25">'.$loc['offers.php']['t01'].'</p>
                <a class="float-right" href="./offers.php?addoffer=ok"><button class="btn button">Добавить оффер</button></a>     
            </div>
            ';
	include './templates/'.$template.'/blocks/offers_110_spisok.php';
	}
?>
</div>