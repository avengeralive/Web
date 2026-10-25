<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">    
        <link rel="shortcut icon" href="<? echo get_field('фавикон', 2); ?>" type="image/x-icon"/>       
        <title>OOO "OAЗА СТРОЙ"<? wp_title(); ?></title>
		<style type="text/css">
			img.wp-smiley,
			img.emoji {
				display: inline !important;
				border: none !important;
				box-shadow: none !important;
				height: 1em !important;
				width: 1em !important;
				margin: 0 .07em !important;
				vertical-align: -0.1em !important;
				background: none !important;
				padding: 0 !important;
			}
		</style>
		<link rel='stylesheet' href='/wp-content/themes/domik/css/plugins.css' type='text/css' media='all' />
		<link rel='stylesheet' href='/wp-content/themes/domik/style.css' type='text/css' media='all' />
		<link rel='stylesheet' href='/wp-content/themes/domik/css/custom.css' type='text/css' media='all' />
		<link rel="stylesheet" href="/wp-content/plugins/js_composer/assets/css/js_composer.min.css" type="text/css" media="all">
		<? wp_head(); ?>
		<!--<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
		<script type='text/javascript' src='http://demowp.cththemes.com/domik/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>-->

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->		
    	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
		<!--[if lte IE 9]>
			<link rel="stylesheet" type="text/css" href="/wp-content/plugins/js_composer/assets/css/vc_lte_ie9.min.css" media="screen">
		<![endif]-->
		<style type="text/css">
			.vc_custom_1491408332063 {
				margin-right: 0px !important;
				margin-left: 0px !important;
			}
			.vc_custom_1448424139671 {
				padding-right: 0px !important;
				padding-left: 0px !important;
			}
		</style>
		<noscript>
			<style type="text/css"> 
				.wpb_animate_when_almost_visible { opacity: 1; }
			</style>
		</noscript>        
    </head>
    <body class="home page-template page-template-homepage page-template-homepage-php page page-id-525 wpb-js-composer js-comp-ver-5.1 vc_responsive">
        <div class="loader domik-loader"><i class="fa fa-refresh fa-spin"></i></div>
        <div id="main">      
            <header class="domik-header">
                <div class="header-inner">
                    <div class="logo-holder">
                        <a class="ajax" href="/">
                                                        <img src="<? echo get_field('логотип', 2); ?>" 
                             
                             width="auth"
                                                         
                             height="60"
                                                         class="domik-logo" alt="Domik" />
                                                                                                            </a>
                    </div>
                    <div class="nav-button-holder">
                        <div class="nav-button vis-m"><span></span><span></span><span></span></div>
                    </div>
                    <div class="nav-holder">
                        <nav>
							<ul id="menu-domik-menus" class="domik_main-nav">
							<? wp_nav_menu( array( "menu" => "Menu", 'container' => '', 'items_wrap' => '%3$s' ) ); ?>
                        <!--<li id="menu-item-841" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-525 current_page_item menu-item-841"><a href="http://demowp.cththemes.com/domik/" class="ajax ph act-link">Home</a></li>
<li id="menu-item-845" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-845"><a href="http://demowp.cththemes.com/domik/projects/" class="ajax pp">Projects</a></li>
<li id="menu-item-840" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-840"><a href="http://demowp.cththemes.com/domik/about/" class="ajax pa">About Us</a>
<ul class="sub-menu">
	<li id="menu-item-820" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-820"><a href="http://demowp.cththemes.com/domik/about/#about_sec1" class="ajax custom-scroll-link">About us</a></li>
	<li id="menu-item-821" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-821"><a href="http://demowp.cththemes.com/domik/about/#about_sec2" class="ajax custom-scroll-link">Team</a></li>
	<li id="menu-item-822" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-822"><a href="http://demowp.cththemes.com/domik/about/#about_sec3" class="ajax custom-scroll-link">Story</a></li>
	<li id="menu-item-823" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-823"><a href="http://demowp.cththemes.com/domik/about/#about_sec4" class="ajax custom-scroll-link">Services</a></li>
</ul>
</li>
<li id="menu-item-842" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-842"><a href="http://demowp.cththemes.com/domik/contact/" class="ajax">Contact</a></li>
<li id="menu-item-833" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-833"><a href="http://demowp.cththemes.com/domik/blog/" class="ajax">Blog</a></li>
<li id="menu-item-831" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-831"><a href="#">Pages</a>
<ul class="sub-menu">
	<li id="menu-item-834" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-834"><a href="#">Home</a>
	<ul class="sub-menu">
		<li id="menu-item-848" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-848"><a href="http://demowp.cththemes.com/domik/home-video/" class="ajax">Home Video</a></li>
		<li id="menu-item-847" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-847"><a href="http://demowp.cththemes.com/domik/home-carousel/" class="ajax">Home Carousel</a></li>
		<li id="menu-item-846" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-846"><a href="http://demowp.cththemes.com/domik/home-image/" class="ajax">Home Image</a></li>
	</ul>
</li>
	<li id="menu-item-839" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-839"><a href="http://demowp.cththemes.com/domik/about-me/" class="ajax">About Me</a></li>
	<li id="menu-item-835" class="menu-item menu-item-type-taxonomy menu-item-object-skill menu-item-835"><a href="http://demowp.cththemes.com/domik/skills/houses/" class="ajax">Category</a></li>
	<li id="menu-item-881" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-881"><a href="http://demowp.cththemes.com/domik/aliquip-pertinax-vix-ad/" class="ajax">Blog Single</a></li>
	<li id="menu-item-832" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-832"><a href="#">Portfolio</a>
	<ul class="sub-menu">
		<li id="menu-item-843" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-843"><a href="http://demowp.cththemes.com/domik/portfolio-style-2/" class="ajax">Style 2</a></li>
		<li id="menu-item-844" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-844"><a href="http://demowp.cththemes.com/domik/portfolio-style-3/" class="ajax">Style 3</a></li>
	</ul>
</li>
	<li id="menu-item-836" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-836"><a href="#">Portfolio Single</a>
	<ul class="sub-menu">
		<li id="menu-item-849" class="menu-item menu-item-type-post_type menu-item-object-portfolio menu-item-849"><a href="http://demowp.cththemes.com/domik/portfolio/sodio-sem-lobortis/" class="ajax">Style 1</a></li>
		<li id="menu-item-850" class="menu-item menu-item-type-post_type menu-item-object-portfolio menu-item-850"><a href="http://demowp.cththemes.com/domik/portfolio/maecenas-lacinia/" class="ajax">Style 2</a></li>
		<li id="menu-item-851" class="menu-item menu-item-type-post_type menu-item-object-portfolio menu-item-851"><a href="http://demowp.cththemes.com/domik/portfolio/luctus-et-ultrices/" class="ajax">Style 3</a></li>
		<li id="menu-item-852" class="menu-item menu-item-type-post_type menu-item-object-portfolio menu-item-852"><a href="http://demowp.cththemes.com/domik/portfolio/phasellus-scelerisque-2/" class="ajax">Style 4</a></li>
		<li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-portfolio menu-item-853"><a href="http://demowp.cththemes.com/domik/portfolio/duis-egestas/" class="ajax">Style 5</a></li>
		<li id="menu-item-854" class="menu-item menu-item-type-post_type menu-item-object-portfolio menu-item-854"><a href="http://demowp.cththemes.com/domik/portfolio/quisque-2/" class="ajax">Style 6</a></li>
		<li id="menu-item-855" class="menu-item menu-item-type-post_type menu-item-object-portfolio menu-item-855"><a href="http://demowp.cththemes.com/domik/portfolio/nec-libero-2/" class="ajax">Style 7</a></li>
	</ul>
</li>
	<li id="menu-item-899" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-899"><a href="http://demowp.cththemes.com/domik/portfolio/" class="ajax">Scroll to loadmore</a></li>
	<li id="menu-item-838" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-838"><a href="http://demowp.cththemes.com/domik/404" class="ajax">404</a></li>
</ul>
</li>-->
</ul>                        </nav>
                    </div>
                                </div>
                                    <!--<div class="share-container  isShare"></div>
                    <a class="selectMe shareSelector transition" data-sharenames="facebook,twitter,google,tumblr">Share</a> -->
                                    
                             
            </header>