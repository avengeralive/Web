<main>
    <div class="row grow">
        <div class="col-md-7">
            <h1>Потоки</h1>
        </div>
        <? include './templates/' . $template . '/roles_pages/' . $user_tip . '/menu_top.php'; ?>
    </div>
    <div class="row grow">

        <?php 
	if (isset($_GET['xtext']) && $_GET['xtext']=='1') {$error_message = $loc['streams.php']['t29'];$error_type = 'error';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='2') {$error_message = $loc['streams.php']['t30'];$error_type = 'error';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='3') {$error_message = $loc['streams.php']['t31'];$error_type = 'success';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='4') {$error_message = $loc['streams.php']['t32'];$error_type = 'success';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='5') {$error_message = $loc['streams.php']['t33'];$error_type = 'success';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='6') {$error_message = $loc['streams.php']['t42'];$error_type = 'success';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='7') {$error_message = $loc['streams.php']['t43'];$error_type = 'success';} 
	if (isset($_GET['xtext']) && $_GET['xtext']=='8') {$error_message = 'Не верно установлен Traffback!';$error_type = 'error';} 
	?>

<?php
if (isset($_GET['offer']) && ($_GET['offer']!=''))
	{
	include './templates/'.$template.'/blocks/streams_10_add.php';
	} else { ?>
			<? include './templates/'.$template.'/blocks/streams_10_view.php'; ?>
	<? } ?>		
	</div>
</main>