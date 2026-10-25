<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<? wp_head(); ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PBNLLQT');</script>
<!-- End Google Tag Manager -->

<!-- Marquiz script start -->
<script src="//script.marquiz.ru/v1.js" type="application/javascript"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  Marquiz.init({ 
    id: '5c2660924154390055b6e64a', 
    autoOpen: false, 
    autoOpenFreq: 'once', 
    openOnExit: false 
  });
});
</script>
<!-- Marquiz script end -->
<script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?160",t.onload=function(){VK.Retargeting.Init("VK-RTRG-375078-g7nAU"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-375078-g7nAU" style="position:fixed; left:-999px;" alt="Script"/></noscript>

<script >
	var _alloka = {
		objects: {
			'75121310840d73d2': {
				block_class: 'phone_alloka',
				jivosite: false,
				email: false
			}
		},
		trackable_source_types:  ["type_in", "referrer", "utm"],
		last_source: false,
		use_geo: true
	};
</script>
	
<script src="https://analytics.alloka.ru/v4/alloka.js" ></script>
		<title><? while ( have_posts() ) { the_title(); break; }?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="/wp-content/themes/kst/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Arsenal" rel="stylesheet">
		<!--<link rel="stylesheet" href="/wp-content/themes/kst/css/lightbox.css">-->
		<link rel="stylesheet" href="/wp-content/themes/kst/css/font-awesome.min.css">
		<link rel="stylesheet" href="/wp-content/themes/kst/style.css">
		<script  src="/wp-content/themes/kst/js/jquery.min.js"></script>
		<script  src="/wp-content/themes/kst/js/parallax.min.js"></script>
		<script  src="/wp-content/themes/kst/js/popper.min.js"></script>
		<script  src="/wp-content/themes/kst/js/bootstrap.min.js"></script>
		<!--<script  src="/wp-content/themes/kst/js/lightbox.js"></script>-->
		<script  src="/wp-content/themes/kst/js/script.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.css" />
		<script src="/wp-content/themes/kst/js/jquery.fancybox.min.js"></script>
		<script >/*
			// Bubble Script by Lisa (issa@lissaexplains.com, http://lissaexplains.com)
			// Based on code by Altan d.o.o. (snow@altan.hr)
			var no = 15;
			var speed = 15;
			var bubble = new Array();
			var all = 0;
			bubble[0] = "/wp-content/themes/kst/images/bonus/b1.gif"
			bubble[1] = "/wp-content/themes/kst/images/bonus/b2.gif"
			bubble[2] = "/wp-content/themes/kst/images/bonus/b3.gif"

			var dx, xp, yp;    // coordinate and position variables
			var am, stx, sty;  // amplitude and step variables
			var i, doc_width = $(window).width() - 100, doc_height = $(window).scrollTop() + $(window).height();

			dx = new Array();
			xp = new Array();
			yp = new Array();
			am = new Array();
			stx = new Array();
			sty = new Array();
			j = 0;

			for (i = 0; i < no; ++ i) 
			{
			   dx[i] = 0; 
			   xp[i] = Math.random()*(doc_width-50);
			   yp[i] = doc_height;
			   am[i] = Math.random()*20;
			   stx[i] = 0.02 + Math.random()/10;
			   sty[i] = 0.7 + Math.random();
			  
			   if (i == 0) 
			   {
				  document.write("<div id=\"dot"+ i +"\" style=\"position: absolute; z-index: 9999; visibility: visible; top: 15px; left: 15px; width:70px;\"><img style='width:100%' src=\"" + bubble[j] + "\" border=\"0\"><\/div>");
			   } 
			   else 
			   {
				  document.write("<div id=\"dot"+ i +"\" style=\"position: absolute; z-index: 9999; visibility: visible; top: 15px; left: 15px; width:70px;\"><img style='width:100%' src=\"" + bubble[j] + "\" border=\"0\"><\/div>");
			   }
			   if (j == (bubble.length-1)) { j = 0; } else { j += 1; }
			}

			function DoBubble() 
			{  
				all += speed;
				for (i = 0; i < no; ++ i) 
				{  
				  // iterate for every dot
					yp[i] -= sty[i];
					if (yp[i] < -50) 
					{
						if (2*all <= 30000)
						{
							xp[i] = Math.random()*(doc_width-am[i]-30);
							yp[i] = $(window).scrollTop() + $(window).height();;
							stx[i] = 0.02 + Math.random()/10;
							sty[i] = 0.7 + Math.random();
						}
						else
						{
							$("#dot"+ i).remove();
						}
					}
					dx[i] += stx[i];
				 if (document.getElementById("dot"+i) != null) {
					document.getElementById("dot"+i).style.top = yp[i] + "px";
					document.getElementById("dot"+i).style.left = xp[i] + am[i]*Math.sin(dx[i]) + "px"; 
				 }
				}
				setTimeout("DoBubble()", speed);
			}

			setTimeout('DoBubble()', speed); */
		</script>
		
	<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(42761559, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/42761559" style="position:absolute; left:-9999px;" alt="Yandex.Metrika" /></div></noscript> <!-- /Yandex.Metrika counter -->
		
	</head>
	<body itemscope="itemscope" itemtype="http://schema.org/WebPage">
		<header itemscope itemtype="http://schema.org/WPHeader">
			<nav class="navbar navbar-expand-lg navbar-light" id="main-menu">
				<div class="col col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2">
					<a id="logo_menu"  ><img src="/wp-content/themes/kst/images/logo.png" alt="Клиника Современных Технологий"></a>
				</div>
				<div class="col col-6 col-sm-6 col-md-6 col-lg-8 col-xl-8" id="menu_div">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav m-auto">
						<?
							//$menu = wp_nav_menu(array('manu' => 'Главное меню', 'container'=> '', 'items_wrap' => '%3$s'));
							global $post;
							magomra_nav_menu('Главное меню');
						?>
							<li><button type="submit" class="btn" id="header-search"><i class="fa fa-search"></i></button></li>
							<li><form id="search-form" method="get" action="/search">
								<input type="text" name="q" placeholder="Поиск по клинике" class="form-control">
								<button type="submit" class="btn"><i class="fa fa-search"></i></button>
							</form>	</li>				
						</ul>
					</div>
				</div>
				<div class="col col-6 col-sm-6 col-md-8 col-lg-2 col-xl-2" id="infoblock">				
					<div class="phone">
						<span><a class="" href="tel:+74951264981" itemprop="telephone" onclick="ym(42761559, 'reachGoal', 'mobileshapka'); return true;"> +7 (495) 114 51 51</a></span>
						<br>
						<a class="" href="mailto:info@kst-clinic.ru" onclick="ym(42761559, 'reachGoal', 'mailshapka'); return true;">info@kst-clinic.ru</a>
					</div>

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
							magomra_nav_menu('Главное меню');
						 ?>			
						</ul>
					</div>
				</div>
			</nav>
			<div class="logobanner">
				<a id="logo"><img src="/wp-content/themes/kst/images/logo.png" alt="Клиника Современных Технологий"></a>
			</div>
			<div class="parallax-window">
				
			<div id="banner_title"></div>
			<div class="col doc col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" itemscope itemtype="http://schema.org/Organization" style="display: none;">
				<div class="col doc col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 20px;">
					<form id="header-search-form" action="/search" method="get">
						<input type="text" name="q" placeholder="Поиск по клинике" class="form-control">
						<button type="submit" class="btn"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<span itemprop="name">Клиника Современных Технологий</span>
							
				<div itemprop="address" class="col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6" itemscope itemtype="http://schema.org/PostalAddress">
					<div class="textwidget">
						<div class="contact-footer-bottom">
							
						<p class="r-b fff f-adr">АДРЕС:</p>
						<p class="r-Sb">г. <span itemprop="addressLocality">Москва</span>, <span itemprop="streetAddress">Большой Головин переулок, д.4</span></p>
						</div>
						<p class="r-b fff f-clock">ЧАСЫ РАБОТЫ:</p>
						<p class="r-b">ежедневно:&nbsp;<span class="futura">8:00 — 21:00</span></p>
<p class="r-b">Банковские реквизиты:</p>
<p class="r-b">ИНН 7715180548</p>
<p class="r-b">КПП 770201001</p>
<p class="r-b">ОГРН 1027739074296</p>
					</div>
				</div>
				<div class="col doc col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
					<div class="textwidget">			
						<div class="contact-footer-bottom tel-and-mail">
							<p class="r-b fff f-tel">ТЕЛЕФОН:</p>
							<p class="futura"><a class="phone_alloka" itemprop="telephone">+7 (495) 114 51 51</a><br>
							</p>
						</div>
						<div class="tel-and-mail">
						<p class="r-b fff f-email">E-MAIL:</p>
						<p class="r-Sb"><a class="href" href="mailto:info@kst-clinic.ru" itemprop="email">info@kst-clinic.ru</a></p>

						</div>
					</div>
				</div>
			</div>
			</div>
			

		</header>