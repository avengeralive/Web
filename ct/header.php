<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Кофе-тренд - поставка и продажа кофе и чая</title>
    <link rel="icon" href="/wp-content/themes/ct/images/logo.png">
	<link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
	<link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/font/flaticon.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/css/slick.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/css/navbar_styleSheet.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/font/flaticon.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/css/venobox.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/css/style.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/css/media.css">
	<? wp_head(); ?>
</head>

<body>
    <!-- preloader start  -->
    <div id="spinners">
        <div id="preloader_1">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- preloader end  -->

    <!--  Navbar start-->
    <nav id="header" class="navbar navbar-fixed-top" style="
    background:  burlywood;">
        <div id="header-container" class="container navbar-container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="brand" class="navbar-brand" href="#"><img src="<?php bloginfo('template_directory') ?>/images/logo.png"  alt="logo" height="85px"> Coffee Trend</a>
            </div>
            <a href="tel:+74955096848" class="phonelnk">+7 (495) 509-68-48</a>
            <div id="navbar" class="collapse navbar-collapse">

                <ul class="nav navbar-nav navbar-right" >
                   
                    <li><a href="#manu_part" style="font-size:22px;">О нас</a></li>
                    <li><a href="#about_part"style="font-size:22px;">Наши преимущества</a></li>
                    <li><a href="#gallery_part"style="font-size:22px;">Марки</a></li>
                    <li><a href="#chef_part"style="font-size:22px;">Дополнительно</a></li>
                    <li><a href="#footer_part"style="font-size:22px;">Контакты</a></li>
                    <li>
                        
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar part end-->
<!--Banner part start-->
    <section id="banner_part">
        <div class="banner_slide">
            <div class="banner_bg" style="background: url(wp-content/themes/ct/images/banner.jpg) no-repeat center; background-size: cover">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="banner_text">
                            <div class="col-md-12">
                                <h3><?php bloginfo('');?></h3>
								<h2>ПОСТАВКА КОФЕ И ЧАЯ</h2>
                                <p></p>
                                
                                <a href="#" data-toggle="modal" data-target="#exampleModal" class="purchase">ЗАКАЗАТЬ</a>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner_bg" style="background: url(wp-content/themes/ct/images/banner2.jpg) no-repeat center; background-size: cover">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="banner_text">
                            <div class="col-md-12">
                                <h3><?php bloginfo('');?></h3>
								<h2>ПОСТАВКА КОФЕ И ЧАЯ</h2>
                                <p></p>
                                
                                <a href="#footer_part" class="purchase">ЗАКАЗАТЬ</a>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner_bg" style="background: url(wp-content/themes/ct/images/banner3.jpg) no-repeat center; background-size: cover">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="banner_text">
                            <div class="col-md-12">
                                <h3><?php bloginfo('');?></h3>
								<h2>ПОСТАВКА КОФЕ И ЧАЯ</h2>
                                <p></p>
                                
                                <a href="#" class="purchase" data-toggle="modal" data-target="#exampleModal">ЗАКАЗАТЬ</a>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part End -->