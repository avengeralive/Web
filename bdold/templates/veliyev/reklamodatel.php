
	<div class="wrapper">
		<!--[if lt IE 9]>
			<div class="browsehappy"><?php echo $loc['service']['t01']; ?></div>
		<![endif]-->

		<?php
		// Выводим шапку сайта
		// Print cap site
		include './templates/'.$template.'/blocks/shapka_not_login.php';

		// Выводим верхнее горизонтальное меню
		// Display the top horizontal menu
		include './templates/'.$template.'/blocks/top_menu_not_login.php';
		?>

		<div class="page">
			<div class="cnt">
				<div class="page__title"><span><?php echo $loc['reklamodatel.php']['t01']; ?></span></div>
				<div class="page__text">
					<h2><?php echo $loc['reklamodatel.php']['t02']; ?></h2>
					<?php echo $loc['reklamodatel.php']['t03']; ?>
				</div>
			</div>
		</div>

		<?php
		// То что выводится на каждой странице до авторизации
		// What is displayed on each page to login
		include './templates/'.$template.'/blocks/always_not_login.php';

		// Выводим нижнее горизонтальное меню
		// Display the bottom horizontal menu
		include './templates/'.$template.'/blocks/bottom_menu_not_login.php';
		?>

	</div>

	<?php
	// Выводим форму логина
	// Display the login form
	include './templates/'.$template.'/blocks/login_form.php';
	?>

	<script src="./templates/<?php echo $template; ?>/js/scripts.js"></script>
	
	<!--[if lt IE 10]>
	<script src="./templates/<?php echo $template; ?>/js/attrplaceholder.js"></script>
	<![endif]-->
