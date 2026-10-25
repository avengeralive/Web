<!doctype html>
	<html lang="ru">
	<head>
		<meta charset="utf-8" />
		<title><?php wp_title("|", true); ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="theme-color" content="#fff" />
		<meta name="format-detection" content="telephone=no" />
		<?php wp_head(); ?>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800" rel="stylesheet">
		<?php wp_enqueue_script("jquery"); ?>
 
		<?php wp_head(); ?>
	<body>
	<!-- BEGIN content -->
	<div class="out">
		<header>
			<div class="main-nav">
				<div class="main-nav__wrapper">
					<div class="container">
						<div class="main-nav__content">
							<div class="logo">
								<a href="/">
									<img src="<?= get_template_directory_uri(); ?>/img/logo.svg" alt=""> </a>
							</div>
							<div class="drp-btn" id="nav">
								<div class="line"> </div>
								<ul class="drp-btn__menu">
									<?php wp_nav_menu(array('theme_location' => 'hostels-menu', 'menu_class' => '', 'container' => false)); ?>
									<li class="main-nav__adaptive">
										<a href="/blog/"> Блог </a>
									</li>
									<li class="main-nav__adaptive modal_open">
										<a href="/kontakty/"> Контакты </a>
									</li>
									<li class="main-nav__adaptive_tel modal_open">
										<a href="#"> Заказать звонок </a>
									</li>
								</ul>
							</div>
							<nav class="main-nav__nav">
								<?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => false)); ?>
							</nav>
							<div class="main-nav__contacts">
								<ul>
									<li>
										<a href="tel:<?= preg_replace( '![^0-9\+]+!', '', get_field('phone1', 'option') ); ?>"> <?= the_field('phone1', 'option'); ?>
										</a>
										<p>
											<strong> (по России бесплатно) </strong>
										</p>
									</li>
									<li>
										<a href="tel:<?= preg_replace( '![^0-9\+]+!', '', get_field('phone2', 'option') ); ?>"> <?= the_field('phone2', 'option'); ?>
										</a>
										<a href="#" class="modal_open">
							            	<strong>
							                	Заказать звонок
							            	</strong>
							            </a>	
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>