<!DOCTYPE html>
<!--
Author: Ali S. Veliyev, 2017.
-->
<html lang="ru">
	<head>
		<? wp_head(); ?>
		<title><? while ( have_posts() ) { the_title(); break; }?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="/wp-content/themes/kst/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Arsenal" rel="stylesheet">
		<link rel="stylesheet" href="/wp-content/themes/kst/css/lightbox.css">
		<link rel="stylesheet" href="/wp-content/themes/kst/css/font-awesome.min.css">
		<link rel="stylesheet" href="/wp-content/themes/kst/style.css">
		<script type="text/javascript" src="/wp-content/themes/kst/js/jquery.min.js"></script>
		<script type="text/javascript" src="/wp-content/themes/kst/js/parallax.min.js"></script>
		<script type="text/javascript" src="/wp-content/themes/kst/js/popper.min.js"></script>
		<script type="text/javascript" src="/wp-content/themes/kst/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/wp-content/themes/kst/js/lightbox.js"></script>
		<script type="text/javascript" src="/wp-content/themes/kst/js/script.js"></script>
	</head>
	<body>
		<header class="parallax-window">
			<nav class="navbar navbar-expand-lg navbar-light" id="main-menu">
				<div class="col col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2">
					<a id="logo_menu" href="/"><img src="/wp-content/themes/kst/images/logo.png"></a>
				</div>
				<div class="col col-6 col-sm-6 col-md-6 col-lg-8 col-xl-8" id="menu_div">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav m-auto">
						<?
							$menu = wp_get_nav_menu_items('Главное меню');
							global $post;
							foreach ($menu as $item) {				
						?>
							<li class="nav-item <? if ($item->object_id == $post->ID) echo 'active'; ?>">
								<a class="nav-link" href="<? echo $item->url; ?>"><? echo $item->title; ?></a>
							</li>
						<? } ?>
							<li><button type="submit" class="btn" id="header-search"><i class="fa fa-search"></i></button></li>
							<form id="search-form" method="get" action="search">
								<input type="text" name="q" placeholder="Поиск по клинике" class="form-control">
								<button type="submit" class="btn"><i class="fa fa-search"></i></button>
							</form>					
						</ul>
					</div>
				</div>
				<div class="col col-6 col-sm-6 col-md-8 col-lg-2 col-xl-2" id="infoblock">				
					<div class="phone"><a href="tel:+74999788481">+7 (499) 978 84 81</a><br><a href="tel:+74951145000">+7 (495) 114 50 00</a></div>
				</div>
				<div class="col col-3 col-sm-3 col-md-2 col-lg-8 col-xl-8" id="menu_div_mobile">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation" style="float: right; background: #fff;">
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>
				<div class="col col-12 col-sm-12" id="menu_div_mobile_inner" style="background: #fff; min-height:0px !important;">
					<div class="collapse navbar-collapse" id="navbarSupportedContent1">
						<ul class="navbar-nav m-auto">
						<?
							$menu = wp_get_nav_menu_items('Главное меню');
							global $post;
							foreach ($menu as $item) {				
						?>
							<li class="nav-item <? if ($item->object_id == $post->ID) echo 'active'; ?>">
								<a class="nav-link" href="<? echo $item->url; ?>"><? echo $item->title; ?></a>
							</li>
						<? } ?>			
						</ul>
					</div>
				</div>
			</nav>
			<a id="logo" href="/"><img src="/wp-content/themes/kst/images/logo.png"></a>
			<h2 id="banner_title"></h2>
		</header>