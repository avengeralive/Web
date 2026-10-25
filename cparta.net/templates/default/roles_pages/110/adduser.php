<div class="row cabinet main mt-50 mb-50">

    <div class="col-12 mb-10"><p class="pageTitle mb-25"><?php echo $loc['adduser.php']['t01']; ?></p></div>

	<?php
	if (isset($_GET['xtext']) && $_GET['xtext']!='')
		{
		// Сообщения об ошибках либо об успехе
		// Service messages
		$xtext=htmlentities($_GET['xtext']);
		if ($xtext=='1') {$error_message = $loc['adduser.php']['t02'];$error_type = 'error';}
		if ($xtext=='2') {$error_message = $loc['adduser.php']['t03'];$error_type = 'error';}
		if ($xtext=='3') {$error_message = $loc['adduser.php']['t04'];$error_type = 'error';}
		if ($xtext=='4') {$error_message = $loc['adduser.php']['t05'];$error_type = 'error';}
		if ($xtext=='5') {$error_message = $loc['adduser.php']['t06'];$error_type = 'error';}
		if ($xtext=='6') {$error_message = $loc['adduser.php']['t07'];$error_type = 'error';}
		if ($xtext=='7') {$error_message = $loc['adduser.php']['t08'];$error_type = 'error';}
		if ($xtext=='8') {$error_message = $loc['adduser.php']['t09'];$error_type = 'success';}	
		}
                include_once './includes/errors.php';
	?>

    <div class="col-12 mb-10">
            <?php
            // Форма добавления пользователя
            // Add a user form
            include './templates/'.$template.'/blocks/adduser_form.php';
            ?>
    </div>

</div>