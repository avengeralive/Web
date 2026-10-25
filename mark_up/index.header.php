<?php require 'index.config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <base href="<?php echo get_bloginfo('url')?>/">
    <title>
    <?php
        echo (is_front_page())
        ? 'Разработка мобильных приложений на заказ. Калькулятор расчета цены: создание приложений для iPhone, iPad, iOS, Android - Infoshell'
        : wp_title('');
    ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Студии Infoshell – создание приложений для мобильных устройств Android и iOS, Windows на заказ. Профессиональные разработчики, портфолио, калькулятор расчета стоимости. Контакты в Москве и Санкт-Петербурге"/>
    <meta name="keywords" content="создание мобильного приложения на заказ, калькулятор стоимости"/>
    <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) { ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo $templateDir;?>/js/lib/animate.css/animate.css">
    <link rel="stylesheet" href="<?php echo $templateDir;?>/js/lib/OwlCarousel2/dist/assets/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo $templateDir;?>/js/lib/OwlCarousel2/dist/assets/owl.theme.default.css">
    <link rel="stylesheet" href="<?php echo $templateDir;?>/js/lib/OwlCarousel2/dist/assets/owl.theme.green.css">
    <link rel="stylesheet" href="<?php echo $templateDir;?>/css/infoshell2.css?v=20190411">
	<link rel="stylesheet" href="<?php echo $templateDir;?>/css/forms/web_forms.css">
    <link rel="stylesheet" href="<?php echo $templateDir;?>/css/new-style.css">
    <link rel="stylesheet" href="<?php echo $templateDir;?>/css/old-style.css">
	<link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
	<link href="<?php echo $templateDir;?>/calc/css/web_calc_styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <link rel="icon" href="<?php echo $templateDir;?>/favicon.ico" type="image/x-icon" />
    <link href="<?php echo $templateDir;?>/favicon-infoshell.svg" rel="icon" type="image/svg+xml" />
    <link rel="shortcut icon" href="<?php echo $templateDir;?>/favicon-infoshell.svg" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo $templateDir;?>/js/custom.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>//-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <?php #include('relCanonical.php'); ?>
    <?php wp_head(); ?>
    <style>
        @media (max-width: 991px) { .infoshel-main-services .col-12 { display: none; } }
    </style>
<? } ?>
</head>
<body>
<div id="cookies" style="display: none;">
    <div class="body">
        <div class="text">Мы используем cookie-файлы. Оставаясь на данном сайте, вы соглашаетесь на использование cookie-файлов.<br> Подробнее — в «<a href="/privacy-policy/">Условиях использования cookie-файлов</a>».</div>
        <span class="btn btn-yellow contactFormSubmit" onclick="likeCookies('like_cookies', 1);">ОК</span>
    </div>
</div>
<div class="page-surround infoshel-page">
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
                    <li><a class="infoshel-header__container-socialNetworks-vcru infoshel-header__container-socialNetworks-icon" href="<?php echo $socialUrl['vc'];?>" target="_blank"></a></li>
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
 <main class="infoshel-main">