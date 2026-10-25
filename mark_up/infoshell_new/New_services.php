<!DOCTYPE html>
<!-- /*
Template Name: Страница "Новая Севис"
*/ -->
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru" class="html-body">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Основные услуги Infoshell</title>
	<?php 
if( is_page() ) {
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
<noindex>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/favicon.png" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.countdown.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/fonts.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/main.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/main2.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/media.css?v=1.1" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/style.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/new-services.css?v=1.1" />
	<link href="https://infoshell.ru/wp-content/themes/mark_up/css1/formCorrections.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">
		<meta name="copyright">
</noindex>
	<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','//connect.facebook.net/en_US/fbevents.js');

		fbq('init', '975313775862135');
		fbq('track', "PageView");</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=975313775862135&ev=PageView&noscript=1"
		/></noscript>
	<!-- End Facebook Pixel Code -->
</head>
<body class="body-ios body-services">
<div class="body-serv">
	<header class="header-ios serv">
		<div class="nav-ios">
			<div class="container-960">
				<a href="https://infoshell.ru" class="logo-header-ios"><img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/header-logo.png" alt="Инфошелл"></a>
				<button class="button-main-mnu"></button>
				<nav>
					<ul>
						<li><a href="/portfolio/" class="active">Портфолио</a></li>
                        <li><a href="/services/">Услуги</a></li>
						<li><a href="/company/">Компания</a></li>
						<li><a href="/contact/">Контакты</a></li>
					</ul>
				</nav>
				<div class="contact-info">
						<div class="tels">Мск: +7 (495) 215 51 82 <br> СПб: +7 (812) 242 80 58 </div>
						<div class="request-call"><a href="" onclick="clik_show()" data-toggle="modal" data-target="#modal-1" class="request-call-btn">
								<div class="icon Phone_head"></div><span>Заказать <br> звонок</span></a></div>
						<!-- /request-call-->
					</div>
			</div>		
		</div>
	</header>
	<div id="modal-1" class="modal in" style="display: none; padding-right: 0px;">
			<div class="modal-content">
				<div class="modal-header-icon">
					<div class="icon Phone_call_modal"></div>
				</div>
				<div class="modal-header-text">Оставьте свой номер телефона, <br>и мы вам обязательно перезвоним!</div>
				<div data-goals="callback_services,all_callbacks,all_goals" id="emailForm" class="question-form contactForm">
					<div class="control-group">
						<input type="text" name="name" placeholder="Ваше имя.." class="inputbox full">
					</div>
					<!-- /control-group-->
					<div class="control-group">
						<input type="text" name="phone" placeholder="Ваш телефон..*" class="inputbox full">
					</div>
					<!-- /control-group-->
					<div class="control-group">
						<input type="text" name="email" placeholder="Ваш e-mail.." class="inputbox full">
					</div>
					<!-- /control-group-->
					<div class="control-group text-center">
						<span class="btn btn-yellow contactFormSubmit">Отправить</span>
					</div>
					<!-- /control-group-->
				</div>
				<!-- /form-->
				<div class="modal-close"><a href="" data-dismiss="modal"><span>×</span>Закрыть</a></div>
			</div>
		</div>
<section class="section-2-ios serv" itemscope itemtype="http://schema.org/Service">
    <meta itemprop="serviceType" content="Разработка приложений и игр под Android, iOS, WEB" />
    
	<div itemprop="provider" itemscope itemtype="http://schema.org/LocalBusiness">
        <meta itemprop="name" content="Infoshell.ru" />
        <meta itemprop="telephone" content="+7 (495) 215-51-82" />
        <meta itemprop="address" content="Россия, г. Москва, ст. метро Маяковская, 1-я Тверская-Ямская улица, 16/23, оф. 8"/>
        <meta itemprop="email" content="info@infoshell.ru" />
        <meta itemprop="image" content="https://infoshell.ru/wp-content/themes/mark_up/images/logo.jpg"/>
        <meta itemprop="priceRange" content="$$"/>
    </div>
    
    <div class="container-960">
        <h1 align="center">Услуги, которые мы предоставляем:</h1>	
	  <div class="item-s2-ios" itemprop="hasOfferCatalog" itemscope itemtype="http://schema.org/OfferCatalog">
		 <a href="/developing-for-iphone/"> <div class="items" itemprop="itemListElement" itemscope itemtype="http://schema.org/OfferCatalog">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-1 icon-item"></div>
		  	</div>
		 		<p itemprop="name">РАЗРАБОТКА ПОД iOS</p>
		  </div></a>
		 <a href="/developing-for-android-os/"> <div class="items" itemprop="itemListElement" itemscope itemtype="http://schema.org/OfferCatalog">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-2 icon-item"></div>
		  	</div>
		 		<p itemprop="name">РАЗРАБОТКА ПОД ANDROID</p>
		   </div></a>
		 <a href="/web-development/"> <div class="items" itemprop="itemListElement" itemscope itemtype="http://schema.org/OfferCatalog">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-3 icon-item"></div>
		  	</div>
		 		<p itemprop="name">WEB-СЕРВИСЫ</p>
		   </div></a>
		 <a href="/gamedevelopment/" class="image-icon-go"> <div class="items" itemprop="itemListElement" itemscope itemtype="http://schema.org/OfferCatalog">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-4 icon-item"></div>
		  	</div>
		 		<p itemprop="name">ИГРЫ</p>
		  </div></a>
		 <a href="/ux-design/"> <div class="items" itemprop="itemListElement" itemscope itemtype="http://schema.org/OfferCatalog">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-5 icon-item"></div>
		  	</div>
		 		<p itemprop="name">ДИЗАЙН, UX</p>
		  </div></a>
		 <a href="/promotion-application/"> <div class="items" itemprop="itemListElement" itemscope itemtype="http://schema.org/OfferCatalog">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-6 icon-item"></div>
		  	</div>
		 		<p itemprop="name">ПРОДВИЖЕНИЕ</p>
		  </div></a>





		 <a href="/corporate/"> <div class="items" itemprop="itemListElement" itemscope itemtype="http://schema.org/OfferCatalog">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-7 icon-item"></div>
		  	</div>
		 		<p itemprop="name">КОРПОРАТИВНЫЕ ПОРТАЛЫ</p>
		  </div></a>

		 <a href="/razrabotka-crm-sistem/"> <div class="items" itemprop="itemListElement" itemscope itemtype="http://schema.org/OfferCatalog">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-8 icon-item"></div>
		  	</div>
		 		<p itemprop="name">CRM/ERP СИСТЕМЫ</p>
		  </div></a>

		 <a href="/vr/"> <div class="items" itemprop="itemListElement" itemscope itemtype="http://schema.org/OfferCatalog">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-9 icon-item"></div>
		  	</div>
		 		<p itemprop="name">VR/AR</p>
		  </div></a>
	  </div>
	</div>
</section>
</div>
<footer class="footer-ios">
	<div class="container-960">
		<div class="left-f-ios">
			<div class="f-ios-logo">
				<a href="https://infoshell.ru"><img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/logo-footer.png" height="45" width="45" alt="infoshell"></a>
			</div>
			<a href="https://infoshell.ru/files/Infoshell.pdf" class="preza-f-ios">
				Скачать презентацию
			</a>
		</div>
		<div class="footer-info"><span class="footer-tel"><b>+7 (495) 215-51-82</b> (Мск)</span>
						<!-- /footer-tel--><span class="footer-tel"><b>+7 (812) 242-80-58</b> (СПб)</span>
						<!-- /footer-tel--><a id="ZAKAZ_ZVONKA_BOTTOM" href="" data-toggle="modal" data-target="#modal-1" class="footer-request-call">
							<div class="icon Phone_foot"></div><span>Заказать звонок</span></a>
						<!-- /footer-request-call-->
					</div>
	</div>
</footer>
	<!--[if lt IE 9]>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/es5-shim.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/html5shiv.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/respond/respond.min.js"></script>
	<![endif]-->
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/jquery/jquery-1.11.1.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/jquery-mousewheel/jquery.mousewheel.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/fancybox/jquery.fancybox.pack.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/waypoints/waypoints-1.6.2.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/scrollto/jquery.scrollTo.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/owl-carousel/owl.carousel.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.plugin.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.countdown.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.countdown-ru.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/landing-nav/navigation.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/js/common.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/js/main.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/js1/ajaxForms.js?v=1.4"></script>
 <!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter934261 = new Ya.Metrika({id:934261,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/934261" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23922742-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23922742-1');
</script>

	<div class="modal-backdrop in" onclick="clik_hide()" style="display:none" ></div>
<link rel="stylesheet" href="https://cdn.callbackkiller.com/widget/cbk.css">
<script type="text/javascript" src="https://cdn.callbackkiller.com/widget/cbk.js?cbk_code=16793" charset="UTF-8" async></script>
</body>
</html>