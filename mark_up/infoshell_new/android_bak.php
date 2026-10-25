<!DOCTYPE html>
<!-- /*
Template Name: Страница "Новый андройд"
*/ -->
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Разработка приложений для Android</title>
<?php
if(is_page()) {
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
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/main.css?v=1.2" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/main2.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/media.css?v=1.2" />
	<link href="https://infoshell.ru/wp-content/themes/mark_up/css1/formCorrections.css" rel="stylesheet">
    <style>
        section div.container-960 div.tables div.cell.text-cell h3 {
            text-align: left;
        }
    </style>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/js/library.js"></script>
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

	<script src="https://infoshell.ru/wp-content/themes/mark_up/js1/ajaxForms.js?v=1.4"></script>
</head>
<body class="body-ios body-andr">
	<header class="header-ios header-andr">
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
				<div class="contacts-ios clearfix">
					<div class="tel">Мск: +7 (495) 215 51 82 <br>СПб: +7 (812) 242 80 58</div>
					<a href="" id="ZAKAZ_ZVONKA" onclick="clik_show()" data-toggle="modal" data-target="#modal-1" class="btn-call-me"><span>Заказать<br> звонок</span></a>
				</div>
				<a href="/services/" class="all-services"> <i class="fa fa-long-arrow-left"></i> Все услуги</a>
			</div>		
		</div>
		<div class="container-960">
			<div class="header-ios-title header-andr-title clearfix">
				<span>Android программирование под смартфоны и планшеты</span>
			</div>
		</div>
	</header>
	<div id="modal-1" class="modal in" style="display: none; padding-right: 0px;">
			<div class="modal-content">
				<div class="modal-header-icon">
					<div class="icon Phone_call_modal"></div>
				</div>
				<div class="modal-header-text">Оставьте свой номер телефона, <br>и мы вам обязательно перезвоним!</div>
				<div data-goals="callback_service,all_callbacks,all_goals" id="emailForm" class="question-form contactForm">
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
	<section class="section-1-ios text-black" itemscope itemtype="http://schema.org/Service">
			<div class="container-960">
				<div class="content-index">
					<h1 itemprop="serviceType">Разработка приложений для Android</h1>
<br>
<div align="left" class="with-paragraphs" itemprop="description">



					<p>Мобильное приложение сделанное на базе Андроид — это коммуникационный сервис монетизации бизнеса среди 1 400 000 000 пользователей смартфонов и планшетов в Google Play Market.</p>
<p>Создание программ и мобильных приложений для Android — это разработка сложного многофункционального продукта на базе ядра Linux. Использование концепции Lean Startup в <a href="/blog/android-razrabotka/">процессе разработки</a> позволяет получить на выходе конкурентоспособный на рынке продукт с минимальными затратами для заказчика.</p>
<p>При заказе разработки в InfoShell, вы получаете качественный готовый продукт, бесплатную его загрузку в Google Play Market и льготные условия продвижения в ТОП.</p>
<p>Заказывая у нас, клиент получает детальные отчеты, начиная с этапа проектирования пользовательского интерфейса и до финального тестирования.</p>
				</div>
			</div>		
	</section>

<script type="application/ld+json">{
"@context": "http://schema.org/","@type": "Product",
"name": "Разработка приложений под Android",
"description": "В студии Infoshell вы можете заказать разработку приложений для мобильных устройств Android. Профессиональные разработчики приложений, портфолио, стоимость. Контакты в Москве и Санкт-Петербурге ☎ +7 (495) 215-51-82",
"image": "https://infoshell.ru/wp-content/themes/mark_up/images/logo.jpg"
}</script>


<section class="section-6">
	<h3 class="h2za">Наши портфолио</h3>
	<div class="container-960">
	<div class="prev_button"><i class="fa fa-angle-left"></i></div> <!-- кнопки -->
	<div class="next_button"><i class="fa fa-angle-right"></i></div> <!-- кнопки -->
	<div class="content-item-s6" id="owl-job" itemscope itemtype="http://schema.org/ItemList">
		<?php
			$posts = get_posts(array(
				'category_name'=>'rp_android',
				'orderby'=>'date',
				'posts_per_page'=>10,
				'order'=>'DESC'
			));
			$i=0;
			foreach($posts as $post) {
				$i = $i+1;
				setup_postdata($post);
				$id = get_the_ID();
				$attachmentId = get_post_thumbnail_id($id);
				$src = wp_get_attachment_image_src($attachmentId, 'blog_small');
			?>
			<?if($i%2 == 1):?>
				<div class="item con-two-slide">
				<a href="<?php the_permalink(); ?>">
                    <div class="item-img" itemprop="itemListElement" itemscope itemtype="http://schema.org/MobileApplication">
                        <img src="<?php echo $src[0]; ?>" alt="<?=the_title()?>" itemprop="image"><div class="text"><span itemprop="name"><?php the_title(); ?></span></div>
                    <meta itemprop="applicationCategory" content="Business"/>
                    <meta itemprop="operatingSystem" content="iOS"/>
                    <meta itemprop="position" content="<?php echo $i; ?>"/>
                    <div itemscope itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating">
                        <meta itemprop="bestRating" content="5"/>
                        <meta itemprop="ratingValue" content="5"/>
                        <meta itemprop="reviewCount" content="99"/>
                    </div>
                    <link itemprop="url" href="<?php the_permalink(); ?>" content="<?php the_permalink(); ?>"/>
                    </div>
                </a>
				<?if(count($post)-1 == $i):?>
					</div>
				<?endif;?>
			<?endif;?>
			
			<?if($i%2 == 0):?>
				<a href="<?php the_permalink(); ?>" class="two-slide">
                    <div class="item-img" itemprop="itemListElement" itemscope itemtype="http://schema.org/MobileApplication">
                        <img src="<?php echo $src[0]; ?>" alt="<?=the_title()?>" itemprop="image"><div class="text"><span itemprop="name"><?php the_title(); ?></span></div>
                    <meta itemprop="applicationCategory" content="Business"/>
                    <meta itemprop="operatingSystem" content="iOS"/>
                    <meta itemprop="position" content="<?php echo $i; ?>"/>
                    <div itemscope itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating">
                        <meta itemprop="bestRating" content="5"/>
                        <meta itemprop="ratingValue" content="5"/>
                        <meta itemprop="reviewCount" content="99"/>
                    </div>
                    <link itemprop="url" href="<?php the_permalink(); ?>" content="<?php the_permalink(); ?>"/>
                    </div>
                </a>
                </div>
			<?endif;?>
		<?}?>
	</div>
	</div>
</section>
<section class="section-8-ios section-8-andr">	
	<div class="container-960">
		<h3 class="h2za">Почему это выгодно?</h3>

		<div class="items-s8-ios items-s8-andr">
			<div class="col-item-6">
				<div class="image-s8-ios image-s8-andr">
				</div>
				<div class="text-s8-ios">
					Россия на 10 месте по доходу с программ и на 4 месте по числу загрузок в Google Play.*
				</div>
			</div>
			<div class="col-item-6">
				<div class="image-s8-ios image-s8-andr">
				</div>
				<div class="text-s8-ios">
					Большее количество загрузок: Google Play опережает AppStore по 
					количеству скачанных Android программ 
					на 60%.*
				</div>
			</div>
			<div class="col-item-6">
				<div class="image-s8-ios image-s8-andr">
				</div>
				<div class="text-s8-ios">
					Огромная аудитория. В России 35 млн. различных Android - устройств.
				</div>
			</div>
			<div class="col-item-6">
				<div class="image-s8-ios image-s8-andr">
				</div>
				<div class="text-s8-ios">
					Открытость платформы. Больший охват пользователей за счет 
					альтернативных магазинов.
				</div>
			</div>
			<div class="col-item-6">
				<div class="image-s8-ios image-s8-andr">
				</div>
				<div class="text-s8-ios">
					Удобство для создания внутрикорпоративных сервисов. Устанавливается под большинство устройств, низкая стоимость. Цена ios продукт значительно выше.
				</div>
			</div>
			<div class="col-item-6">
				<div class="image-s8-ios image-s8-andr">
				</div>
				<div class="text-s8-ios">
					Самые быстрорастущие категории в Google Play:«Игры», 
					«Фотография», «Музыка» и 
					«Развлечения».**
				</div>
			</div>
		</div>
		<div class="dannye-apple">	
			<p class="">* по данным AppAnnie на конец 2015 года   |   ** по данным AppFigures на январь 2017 года</p>
		</div>
	</div>
</section>
<section class="section-2-ios sec-2-andr" style="margin-left:-27px;">
	<div class="container-960">
	  <h3 class="h2za">Какие Android приложения мы делаем?</h3>
	  <div class="item-s2-ios item-s2-andr">	
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-1 icon-item"></div>
		  	</div>
		 		<p>Корпоративные продукты для бизнеса</p>
		  </div>
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-2 icon-item" ></div>
		  	</div>
		 		<p>Прикладные программы для работы с документами, органайзеры, утилиты</p>
		   </div>
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-3 icon-item"></div>
		  	</div>
		 		<p>Промо продукты</p>
		   </div>
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-4 icon-item"></div>
		  	</div>
		 		<p>Создание современных и развлекательных игр</p>
		  </div>
	  </div>
	</div>
</section>
<section class="section-5 text-black">
		<h3 class="h2za">Узнайте финальную стоимость приложения</h3>
	<div class="container-960">
		<p>Каждый проект рассчитывается индивидуально. Для того, чтобы узнать примерную цену разработки мобильного приложения для Android, кратко опишите его суть, ваши ожидания или пожелания.</p>	
		<div class="form-s5">
			<noindex>
			<div data-goals="project_estimate_service,all_project_price_check,all_goals" id="callForm" class="question-form contactForm">
						<input type="hidden" value="EXPERT_OCENKA" name="ymparam">
						<div class="control-group">
							<div class="col-item-3">
								<input type="text" name="name" placeholder="Ваше имя.." class="inputbox full">
							</div>
							<div class="col-item-3">
								<input type="text" name="phone" placeholder="Ваш телефон..*" class="inputbox full">
							</div>
							<div class="col-item-3">
								<input type="text" name="email" placeholder="Ваш e-mail.." class="inputbox full">
							</div>
						</div>
						<!-- /control-group-->
						<div class="control-group">
							<textarea rows="10" name="message" placeholder="Опишите, пожалуйста, проект.." class="inputbox full clear"></textarea>
							</div>
						<!-- /control-group-->
						<div class="control-group">
							<div class="attachment">
								<div class="attach-container">
									<div class="attach-file">
										<div class="icon Attach"></div><span class="attach-file-name">Добавить файл</span>
									</div>
									<!-- /attach-file-dummy-->
									<input name="upload_file" type="file" class="attach-file-input">
									<!-- /hidden file input-->
								</div>
								<!-- /attach-container--><a href="" class="attach-reset">&times;</a>
							</div>
							<!-- /attachment-->
		</noindex>
							<div class="submit-btn">
								<span class="btn btn-black contactFormSubmit">Узнать цену</span>
							</div>
						
						</div>
						<!-- /control-group-->
					
					</div>
				
		</div>
	</div>
</section>
<div class="container-960">
	<div class="line-after-sec-6">
	</div>
</div>
<footer class="footer-ios">
	<div class="container-960">
		<div class="left-f-ios">
			<div class="f-ios-logo">
				<a href="https://infoshell.ru"><img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/logo-footer.png" height="45" width="45" alt="infoshell"></a>
			</div>
			<a  href="https://infoshell.ru/files/InfoShell.pdf"class="preza-f-ios">
				Скачать презентацию
			</a>
		</div>
		<div class="right-f-ios">
			<div>+7 (495) 215-51-82 (Мск)</div>
			<div>+7 (812) 242-80-58 (СПб)</div>
			<a href="#" class="b-okno" id="ZAKAZ_ZVONKA_BOTTOM"><i class="fa fa-phone"></i> Заказать звонок</a>
		</div>
	</div>

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
</footer>
	<!--[if lt IE 9]>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/es5-shim.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/html5shiv.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/respond/respond.min.js"></script>
	<![endif]-->
	<script src="https://infoshell.ru/wp-content/themes/mark_up/js/main.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/js1/main.js"></script>
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
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/js/swiper.jquery.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/js/common.js"></script>
	
	<script>
			var swiper = new Swiper('.swiper-container', {
			pagination: '.swiper-pagination',
			width:  297,
			loop: true,
			paginationClickable: true,
			spaceBetween: 20
			});
	</script>
<div class="modal-backdrop in" onclick="clik_hide()" style="display:none" ></div>
<link rel="stylesheet" href="https://cdn.callbackkiller.com/widget/cbk.css">
<script type="text/javascript" src="https://cdn.callbackkiller.com/widget/cbk.js?cbk_code=16793" charset="UTF-8" async></script>
</body>
</html>