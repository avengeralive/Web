<?php require 'index.config.php'; ?>
<!DOCTYPE HTML>
<!--[if IE 9 ]><html id="ie9" class="no-js"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js"><!--<![endif]-->
<head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-41248362-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-41248362-4');
</script>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
/*	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
*/
	?></title>
<?php
if( is_single() || is_page()) {
	if(get_post_meta($post->ID, "meta-description", true) !='' ) {
		echo '<meta name="description" content="' . get_post_meta($post->ID, "meta-description", true) . '" />';
		echo "\n";
	}
	if(get_post_meta($post->ID, "meta-keywords", true) !='' ) {
		echo '<meta name="keywords" content="' . get_post_meta($post->ID, "meta-keywords", true) . '" />';
		echo "\n";
	}
}
?>
    <base href="<?=get_bloginfo('url')?>/">
<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) { ?>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700,900,500,400italic,700italic&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'  data-noprefix>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
	<link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="icon" type="image/x-icon" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/reset.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox.css" rel="stylesheet">
    <!--<meta content="https://infoshell.ru/wp-content/uploads/2014/07/home-slide.jpg" property="og:image">-->
    <link rel="image_src" href="https://infoshell.ru/wp-content/uploads/2014/07/home-slide.jpg" />
    <link href="<?php echo get_template_directory_uri(); ?>/css/style.css?v=8" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="<?php echo get_template_directory_uri(); ?>/css/forms/web_forms.css" rel="stylesheet" >
    <link href="<?php echo get_template_directory_uri(); ?>/css1/formCorrections.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/new-style-header.css?v=1" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/new-style-footer.css?v=1" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/new-style-form.css?v=1" rel="stylesheet">
	<script src="<?php echo get_template_directory_uri(); ?>/js/library.js"></script>
    
    
	<script src="<?php echo get_template_directory_uri(); ?>/js/lib/helper-plugins/jquery.touchSwipe.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/parallax.js"></script>
	<script>var root ="<?php echo get_template_directory_uri(); ?>";</script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/mobile.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/form.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate/jquery.validate.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate/localization/messages_ru.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/lib/jquery.fancybox.pack.js"></script>
    <script src="<?php echo $templateDir;?>/js/lib/Responsive-Scroller-jQuery-Floating-Carousel/floatingcarousel.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/infoshell2_main.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js1/main.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js1/main2.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js1/ajaxForms.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/lib/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&amp;subset=latin,cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic" rel="stylesheet">

    <script src="https://infoshell.ru/wp-content/themes/mark_up/js1/ajaxForms.js?v=1.4"></script>


	<script type="text/javascript">
		function equalHeight(group) {
			var tallest = 0;
			group.each(function() {
				thisHeight = $(this).height();
				if(thisHeight > tallest) {
					tallest = thisHeight;
				}
			});
			group.height(tallest);
		}
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
          $(".develop-web-list li a").click(function () {
              $(this).siblings().slideToggle("slow");
              $(this).toggleClass('open');
        });
      });
      </script>
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1, width=device-width">
    
    <?#include('relCanonical.php')?>
    <? wp_head(); ?>
    <style>
    .process-develop h2 {
        color: #fff;
    }
    </style>
<? } ?>
</head>
<body>
        <header class="infoshel-header container-fluid">
            <div class="infoshel-header__container row">
                <div class="infoshel-header__container-burger"><div class="infoshel-header__container-burger-line"></div></div>
                <div class="infoshel-header__container-logo wow fadeInDown"><a href="<?php bloginfo('url'); ?>"></a></div>
                <div class="infoshel-header__container-menu">
                    <nav class="infoshel-header__container-nav">
                        <ul class="infoshel-header__container-nav-menu">
                            <li><a href="services/" class="">Услуги</a></li>
                            <li><a href="portfolio/" class="">Портфолио</a></li>
                            <li><a href="company/" class="">Компания</a></li>
                            <li><a href="contact/" class="">Контакты</a></li>
                            <li><a href="blog/" class="">Блог</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="infoshel-header__container-content">
                    <div class="infoshel-header__container-socialNetworks">
                        <ul>
                            <!--<li><a class="infoshel-header__container-socialNetworks-vk infoshel-header__container-socialNetworks-icon" href="<?php echo $socialUrl['vk'];?>" target="_blank"></a></li>//-->
                            <li><a class="infoshel-header__container-socialNetworks-fb infoshel-header__container-socialNetworks-icon" href="<?php echo $socialUrl['fb'];?>" target="_blank"></a></li>
                            <li><a class="infoshel-header__container-socialNetworks-bh infoshel-header__container-socialNetworks-icon" href="<?php echo $socialUrl['bh'];?>" target="_blank"></a></li>
                            <li><a class="infoshel-header__container-socialNetworks-ins infoshel-header__container-socialNetworks-icon" href="<?php echo $socialUrl['ins'];?>" target="_blank"></a></li>
                            <li><a class="infoshel-header__container-socialNetworks-vcru infoshel-header__container-socialNetworks-icon" href="<?php echo $socialUrl['vc.ru'];?>" target="_blank"></a></li>
                        </ul>
                    </div>

                    <div class="infoshel-header__container-phones">
                        <p>Мск:<?php echo $contacts['moskow']['tel'];?></p>
                        <p>СПб:<?php echo $contacts['piter']['tel'];?></p>
                    </div>

                    <div class="infoshel-header__container-requestCall">
                        <a class="infoshel-header__container-requestCall-link" data-toggle="modal" data-target="#exampleModalCenter" href="">
                            <span>Заказать<br>звонок</span>
                            <i class="infoshel-header__container-requestCall-icon"></i>
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <div class="side-menu">
            <div class="side-menu__header">
                <a class="side-menu__header-logo" href="<?php bloginfo('url'); ?>">
                    <img src="<?php echo $templateDir;?>/img/infoshell2/main.svg" alt="">
                </a>
                <span class="side-menu__header-close"></span>
            </div>
            <div class="side-menu__menu">
                <ul>
                    <li class="side-menu__menu-link active"><a href="/services/">Услуги</a></li>
                    <li class="side-menu__menu-link"><a href="/portfolio/">Портфолио</a></li>
                    <li class="side-menu__menu-link"><a href="/company/">Компания</a></li>
                    <li class="side-menu__menu-link"><a href="/blog/">Блог</a></li>
                    <li class="side-menu__menu-link"><a href="/contact/">Контакты</a></li>
                </ul>
            </div>
            <div class="side-menu__menu-btn">
                <button class="infoshel-button side-menu__menu-button" data-toggle="modal" data-target="#exampleModalCenter">Оставить заявку</button>
                <!--button class="infoshel-button side-menu__menu-button side-menu__menu-button-white" data-toggle="modal" data-target="#exampleModalCenter">Заказать звонок</button-->
            </div>
            <div class="side-menu__social-links">
                <a class="infoshel-header__container-socialNetworks-fb side-menu__social-link" href="<?php echo $socialUrl['fb'];?>" target="_blank"></a>
                <a class="infoshel-header__container-socialNetworks-bh side-menu__social-link" href="<?php echo $socialUrl['bh'];?>" target="_blank"></a>
                <a class="infoshel-header__container-socialNetworks-ins side-menu__social-link" href="<?php echo $socialUrl['ins'];?>" target="_blank"></a>
                <a class="infoshel-header__container-socialNetworks-vcru side-menu__social-link" href="<?php echo $socialUrl['vc'];?>" target="_blank"></a>
            </div>
        </div>
    <div class="page">
        <script type="text/javascript">
            function ct_load_script() {
                var ct = document.createElement('script'); ct.type = 'text/javascript';
                ct.src = 'https://cc.calltracking.ru/phone.c0d31.2512.async.js?nc='+Math.floor(new Date().getTime()/300000);
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ct, s);
            }
            if ( null != window.onload ) { wol = window.onload; window.onload = function() { wol(); ct_load_script(); }
            } else { window.onload = ct_load_script; }
        </script>