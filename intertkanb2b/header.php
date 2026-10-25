<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><? wp_title(); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link rel="shortcut icon" href="/wp-content/themes/intertkanb2b/images/favicon.ico">
    <link rel="apple-touch-icon" href="/wp-content/themes/intertkanb2b/images/icon.png">

    <!-- Google font (font-family: 'Lato', sans-serif;) -->
    <!--<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,900" rel="stylesheet">
     Google font (font-family: 'Raleway', sans-serif;) 
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700,800" rel="stylesheet">-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;subset=cyrillic" rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/wp-content/themes/intertkanb2b/css/bootstrap.min.css">
    <link rel="stylesheet" href="/wp-content/themes/intertkanb2b/css/plugins.css">
    <link rel="stylesheet" href="/wp-content/themes/intertkanb2b/style.css">

    <!-- Cusom css -->
    <link rel="stylesheet" href="/wp-content/themes/intertkanb2b/css/custom.css">

    <!-- Modernizer js -->
    <script src="/wp-content/themes/intertkanb2b/js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

    <!-- Add your site or application content here -->

    <!--<div class="fakeloader"></div>-->

    <div class="fakeloader" style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px;  background: url('/wp-content/themes/intertkanb2b/images/tkan.jpg'); background-size: cover; background-position: center; z-index: 999;"><div class="fl spinner4" style="position: absolute; left: 602.5px; top: 473px;"></div></div>

    <!-- Wrapper -->
    <div id="wrapper" class="wrapper">
        
        <!-- Header -->
        <div class="header header-style-1 header-transparent sticky-header">
            <div class="container">
				<div class="mobile-menu d-block d-lg-none">
					<a href="/" class="logo">
						<img src="<? if (pll_current_language() == 'ru') echo get_field('лого', 7); else echo get_field('лого', 121); ?>" style="height: 100px;" alt="logo theme"> 
					</a>
					<div class="social-icons">
						<ul>
							<li class="twitter"><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
							<li class="facebook"><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
							<li class="instagram"><a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a></li>
							<li class="pinterest"><a href="https://www.pinterest.com/"><i class="fa fa-vk"></i></a></li>
						</ul>
                        <ul><?php pll_the_languages(array('display_names_as' => 'slug'));?></ul>
					</div>
				</div>
                <div class="header-inner d-none d-lg-flex">
                    <a href="/" class="logo">
                        <img src="<? if (pll_current_language() == 'ru') echo get_field('лого', 7); else echo get_field('лого', 121); ?>" style="height: 100px;" alt="logo theme">
					</a>
					
                    <!-- Nagivation -->
                    <nav class="bn-navigation text-right">
                        <? if (pll_current_language() == 'ru') { ?>
                        <? wp_nav_menu(array( 'container' => false, 'menu' => 'Главное меню' )); ?>
                        <? } else { ?>
                        <? wp_nav_menu(array( 'container' => false, 'menu' => 'English menu' )); ?>
                        <? } ?>
                        <ul><?php pll_the_languages(array('display_names_as' => 'slug'));?></ul>
                    </nav>
					<!--// Nagivation -->
					
                    <div class="social-icons">
                        <ul>
                            <li class="twitter"><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                            <li class="facebook"><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                            <li class="instagram"><a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a></li>
                            <li class="pinterest"><a href="https://www.pinterest.com/"><i class="fa fa-vk"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>