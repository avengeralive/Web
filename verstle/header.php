<!DOCTYPE HTML>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Bacotna is a truly multi purpose template, coming with 50+ ready-to-use Homepages & 100+ HTML Files in one Package. Build whatever you like with this Template.Be it Business, Corporate, Medical, Travel, Construction, Real Estate, Magazine, Portfolio, Agency, Hotel, Yoga, Hosting, Photography, Ecommerce, Industry or Product launch, just everything is possible with bacotna.">
	<meta name="keywords" content=" app, business, construction, corporate, creative, ecommerce, hosting, hotel, magazine, medical, multipurpose, photography, real estate, restaurant, yoga">
	<meta name="robots" content="index,follow">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="">
    
    <title>MobileCrew</title>
    <!-- Bootstrap Core CSS -->
    <link href="/wp-content/themes/mobilecrew/css/bootstrap.min.css" rel="stylesheet">	
    <link href="/wp-content/themes/mobilecrew/css/bootstrap3.min.css" rel="stylesheet">	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/mobilecrew/css/main.css">
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel='stylesheet prefetch' href='/wp-content/themes/mobilecrew/OwlCarousel2-2.2.1/owl.carousel.css'>
    <link rel='stylesheet prefetch' href='/wp-content/themes/mobilecrew/css/flaticon.css'>
	<? wp_head(); ?>
</head>
<body>

<div class="main">
<nav>
<div class=" position-relative">
<div class="relative-menu">
<div class="fixed-menu">
<ul>
<li><a href="<? if (!is_home()) { echo '/'; } ?>#header" class="active-menu">О нас</a></li>
<li><a href="<? if (!is_home()) { echo '/'; } ?>#project0">Проекты</a></li>
<li><a href="<? if (!is_home()) { echo '/'; } ?>#team">О команде</a></li>
<li><a href="#contact">Контакты</a></li>
</ul>
</div>
</div>
</div>
</nav>

<div class="header-nav">
<div class="">
<div class="top_height row ">
<div class="col-lg-6 col-md-12">
<a href="/" class="logo" style="font-family: MullerBold; font-weight: bold; color: #000; font-size: 30px;">Mobile<span style="color:#f03845;">Crew</span></a>
<div id="demo" style="inline-block"></div>
<div id="demo1" style="inline-block"></div>
<div id="demo3" style="inline-block"></div>
<div id="demo4" style="inline-block"></div>
<button class="nav-button"><i class="fas fa-bars"></i></button>
</div>
<div class="col-lg-6 col-md-12">
<div class="buy"><a href="#"> Заказать продукт</a></div> 
</div>
</div>
</div>
</div>

<div class="pop-up-shop" style="display:none;">
<div class="container" style="height:100vh; position:relative;">
<div class="close"> <i class="fas fa-times"></i></div>
<div class="shop">
<h2>Оставить заявку</h2>
<p>Наш менеджер с Вами свяжется. Или позвоните нам сами:8 800 888 88 00</p>
<!--<form class="form1">
<input type="text" placeholder="Ваше имя">
<input type="email" placeholder="Ваше эл.почта">
<input type="text" placeholder="Ваше номер телефоне">
<input type="submit" placeholder="Отправить">
</form>-->
<? echo do_shortcode('[contact-form-7 id="56" title="Оставить заявку" html_class="form1"]'); ?>
</div>
</div>
</div>