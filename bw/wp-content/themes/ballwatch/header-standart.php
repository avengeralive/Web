<!DOCTYPE html>
<html class="wide wow-animation" lang="en"> 
  <head>
    <!-- Site Title-->
    <title><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="ball, ball watch, часы, бол, болл, наручные часы, бренд, официальный, сайт, представитель, швейцарский" />
	<meta name="description" content="Официальный сайт российского представительства самого технологичного бренда механических швейцарских наручных часов "Ball"" />
	<base href="http://ballwatch.aliveliyev.com"/>

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald:200,400%7CLato:300,400,300italic,700%7CMontserrat:900">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fonts.css">
		<!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
		<![endif]--> 
	  <?php wp_head(); ?>
  </head>
  <body>
    <!-- Page preloader-->
    <div class="page-loader"> 
      <div class="page-loader-body"> 
        <div class="preloader-wrapper big active"> 
          <div class="spinner-layer spinner-blue"> 
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"> </div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
          <div class="spinner-layer spinner-red">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"> </div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
          <div class="spinner-layer spinner-yellow"> 
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"> </div>
            </div>
          </div>
          <div class="spinner-layer spinner-green"> 
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page-->
    <div class="page">
      <section class="section">
        <!-- Page Header-->
        <header class="page-header bg-gray-darker breadcrumbs-custom-wrap">
          <div class="rd-navbar-wrap rd-navbar-default">
            <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fullwidth" data-xl-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-device-layout="rd-navbar-static" data-md-stick-up-offset="2px" data-lg-stick-up-offset="2px" data-stick-up="true" data-sm-stick-up="true" data-md-stick-up="true" data-lg-stick-up="true" data-xl-stick-up="true">
              <div class="rd-navbar-inner">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- RD Navbar Toggle-->
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <!-- RD Navbar Brand-->
                  <div class="rd-navbar-brand"><a class="brand-name" href="/"><img class="logo-default" src="<?php echo get_template_directory_uri(); ?>/images/ball_watch.svg" alt="" width="128" height="52"/><img class="logo-inverse" src="<?php echo get_template_directory_uri(); ?>/images/ball_watch_inverse.svg" alt="" width="128" height="52"/></a></div>
                </div>
                <div class="rd-navbar-aside-right">
                  <div class="rd-navbar-nav-wrap">
                    <!-- RD Navbar Nav-->
					  <? echo wp_nav_menu( array(
	'theme_location'  => '',
	'menu'            => 'Главное меню', 
	'container'       => '', 
	'container_class' => '', 
	'container_id'    => '',
	'menu_class'      => 'rd-navbar-nav', 
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => '',
) ); ?>
                  </div>
                  <div class="rd-navbar-aside-right-inner">
                    <!-- RD Navbar Search-->
                    <div class="rd-navbar-search"><a class="rd-navbar-search-toggle" data-rd-navbar-toggle=".rd-navbar-search" href="#"><span></span></a>
                      <form class="rd-search" action="/" data-search-live="rd-search-results-live" method="GET">
                        <div class="form-wrap">
                          <label class="form-label form-label" for="rd-navbar-search-form-input">Поиск...</label>
                          <input class="rd-navbar-search-form-input form-input" id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off">
                          <div class="rd-search-results-live" id="rd-search-results-live"></div>
                        </div>
                        <button class="rd-search-form-submit mdi mdi-magnify"></button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
          </div>
        <!-- Breadcrumbs-->
<!--<section class="breadcrumbs-custom breadcrumbs-custom-svg" style="padding: 0px !important; background: #000;">
          <img src="<?php echo get_template_directory_uri(); ?>/images/header.jpg" alt="" height="700" width="auto">
        </section>-->
        </header>
