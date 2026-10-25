<!DOCTYPE html>
<!-- /*
Template Name: Страница "Corporate"
*/ -->
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
<meta charset="utf-8">
	<meta charset="utf-8" />
	<title>Разработка корпоративного портала. Стоимость и сроки создания корпоративного портала</title>
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
    <link rel="shortcut icon" href="/wp-content/themes/mark_up/favicon.ico" />
    <noindex>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<meta name="copyright" content="">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<link rel="stylesheet" href="/wp-content/themes/mark_up/infoshell_new/libs/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/wp-content/themes/mark_up/infoshell_new/libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" href="/wp-content/themes/mark_up/infoshell_new/libs/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" href="/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.countdown.css" />
	<link rel="stylesheet" href="/wp-content/themes/mark_up/infoshell_new/css/fonts.css" />
	<link rel="stylesheet" href="/wp-content/themes/mark_up/infoshell_new/css/main.css?v=20190130" />
	<!--link rel="stylesheet" href="/wp-content/themes/mark_up/infoshell_new/css/main2.css" /-->
	<link rel="stylesheet" href="/wp-content/themes/mark_up/infoshell_new/css/media.css" />
	<link href="/wp-content/themes/mark_up/css1/formCorrections.css" rel="stylesheet">
	<link href="/wp-content/themes/mark_up/css1/main2.css?v=20190130-5" rel="stylesheet">
	<link rel="stylesheet" href="/wp-content/themes/mark_up/infoshell_new/css/corporate.css" />
	<link rel="stylesheet" href="/wp-content/themes/mark_up/infoshell_new/css/corporate-media.css" />
	<link href="/wp-content/themes/mark_up/css1/formCorrections.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/new-style-header.css?v=1" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/new-style-footer.css?v=1" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/calc/css/web_calc_styles.css" rel="stylesheet">
	<!--link href="/wp-content/themes/mark_up/css1/main.css?1439406648325" rel="stylesheet"-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&amp;subset=latin,cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic" rel="stylesheet">
    <style>
        section div.container-960 div.tables div.cell.text-cell h3 {
            text-align: left;
        }
    </style>
<script src="/wp-content/themes/mark_up/js1/main.js"></script>
    <script src="/wp-content/themes/mark_up/js/infoshell2_main.js"></script>
		<script>
			$(document).ready(function(){
				$(".testimonials").owlCarousel({
					margin:15,
					autoHeight:true,
					dots: false,
					nav: true,
					navText: [],
					responsive : {
						320 : {
							items: 1,
							stagePadding: 50,
							nav: false
						},
						766 : {
							items: 2,
							nav: false
						},
						1000 : {
							items: 3
						}
					}
				});
				$(".showcase").owlCarousel({
					items: 1,
					loop: true
				});
				$(".portfolio-preview").owlCarousel({
					items: 1,
					nav: true,
					navText: [],
					autoHeight: true,
					dotsContainer: '.custom-owl-dots',
					responsive : {
						320 : {
							stagePadding: 25,
							nav: false
						},
						766 : {
							nav: false
						},
						985 : {
							nav: true
						}
					}
				});
			});

		</script>
	<script src="/wp-content/themes/mark_up/infoshell_new/libs/jquery/jquery-1.11.1.min.js"></script>
	<script src="/wp-content/themes/mark_up/infoshell_new/libs/jquery-mousewheel/jquery.mousewheel.min.js"></script>
	<script src="/wp-content/themes/mark_up/infoshell_new/libs/fancybox/jquery.fancybox.pack.js"></script>
	<script src="/wp-content/themes/mark_up/infoshell_new/libs/waypoints/waypoints-1.6.2.min.js"></script>
	<script src="/wp-content/themes/mark_up/infoshell_new/libs/scrollto/jquery.scrollTo.min.js"></script>
	<script src="/wp-content/themes/mark_up/infoshell_new/libs/owl-carousel/owl.carousel.min.js"></script>
	<script src="/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.plugin.js"></script>
	<script src="/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.countdown.min.js"></script>
	<script src="/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.countdown-ru.js"></script>
	<script src="/wp-content/themes/mark_up/infoshell_new/libs/landing-nav/navigation.js"></script>
	<script src="/wp-content/themes/mark_up/infoshell_new/js/swiper.jquery.min.js"></script>
	<script src="/wp-content/themes/mark_up/infoshell_new/js/common.js"></script>
	<script>
			var swiper = new Swiper('.swiper-container', {
			pagination: '.swiper-pagination',
			width:  297,
			loop: true,
			paginationClickable: true,
			spaceBetween: 20
			});
	</script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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

	<script src="/wp-content/themes/mark_up/js1/ajaxForms.js?v=1.4"></script>
	<!--script src="/wp-content/themes/mark_up/js1/main.js"></script-->

	<!--script type="text/javascript">
		$(document).ready(function(){
				$(".testimonials").owlCarousel({
					margin:15,
					autoHeight:true,
					dots: false,
					nav: true,
					navText: [],
					responsive : {
						320 : {
							items: 1,
							stagePadding: 50,
							nav: false
						},
						766 : {
							items: 2,
							nav: false
						},
						1000 : {
							items: 3
						}
					}
				});

				$(".showcase").owlCarousel({
					items: 1,
					loop: true
				});
				$(".portfolio-preview").owlCarousel({
					items: 1,
					nav: true,
					navText: [],
					autoHeight: true,
					dotsContainer: '.custom-owl-dots',
					responsive : {
						320 : {
							stagePadding: 25,
							nav: false
						},
						766 : {
							nav: false
						},
						985 : {
							nav: true
						}
					}
				});
			});
	</script-->
</head>
<body class="body-corporate">
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
                    <li><a class="infoshel-header__container-socialNetworks-fb infoshel-header__container-socialNetworks-icon" href="https://www.facebook.com/infoshell.apps/" target="_blank"></a></li>
                    <li><a class="infoshel-header__container-socialNetworks-bh infoshel-header__container-socialNetworks-icon" href="https://www.behance.net/infoshell" target="_blank"></a></li>
                    <li><a class="infoshel-header__container-socialNetworks-ins infoshel-header__container-socialNetworks-icon" href="https://www.instagram.com//infoshell" target="_blank"></a></li>
                    <li><a class="infoshel-header__container-socialNetworks-vcru infoshel-header__container-socialNetworks-icon" href="https://vc.ru/u/77560-dmitry-kotenko" target="_blank"></a></li>
                </ul>
            </div>

            <div class="infoshel-header__container-phones">
                <p>Мск: +7 (499) 113 37 19</p>
                <p>СПб: +7 (812) 507 80 51</p>
            </div>

        </div>
    </div>
</header>
<div class="side-menu">
    <div class="side-menu__header">
        <a class="side-menu__header-logo" href="https://develop4.icmark.ru">
            <img src="https://develop4.icmark.ru/wp-content/themes/mark_up/img/infoshell2/main.svg" alt="">
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
        <a class="infoshel-header__container-socialNetworks-fb side-menu__social-link" href="https://www.facebook.com/infoshell.apps/" target="_blank"></a>
        <a class="infoshel-header__container-socialNetworks-bh side-menu__social-link" href="https://www.behance.net/infoshell" target="_blank"></a>
        <a class="infoshel-header__container-socialNetworks-ins side-menu__social-link" href="https://www.instagram.com//infoshell" target="_blank"></a>
        <a class="infoshel-header__container-socialNetworks-vcru side-menu__social-link" href="https://vc.ru/u/77560-dmitry-kotenko" target="_blank"></a>
    </div>
</div>
	<div class="header-corporate">
		<div class="head-container">
			<div class="title-corporate">
				<h1>Разработка корпоративных порталов</h1>
				<div class="request-button">
					<a href="" data-toggle="modal" data-target="#modal-2" class="btn corporate-btn btn-yellow">оставить заявку</a>
                <br><br>
    <a href="#calculator" class="btn btn-outlined__white">Калькулятор<br>стоимости<br>приложения</a>
				</div>
			</div>
		</div>
	</div>

	<section class="introduction">
		<div class="container-960">
			<div class="first-title">
				<span>Компания Infoshell оказывает услуги по созданию корпоративных порталов повышенного уровня сложности. У нас вы можете заказать разработку интернет портала «под ключ» по гибкой методологии SCRUM.</span>
			</div>
			<div class="second-title">
				<span>
					За 8 лет работы в сфере создания мобильных приложений и web-ceрвисов команда Infoshell реализовала более 100 проектов для бизнеса и государственных структур. Мы создаем удобные решения для эффективного бизнеса: анализируем, чего не хватает бизнес-процессам клиента и что нужно автоматизировать, подбираем подходящие технологии, разрабатываем ИТ-решения и внедряем их в жизнь.
				</span>
			</div>
		</div>
	</section>

	<section class="tech-stack">
		<div class="the-stack">
			<h2>Наш технологический стек</h2>
			<div class="techlist">
				<img class="iconTech" alt="Symfony" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-01.jpg">
				<img class="iconTech" alt="Java" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-02.jpg">
				<img class="iconTech" alt="PHP" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-03.jpg">
				<img class="iconTech" alt="PostgreSQL" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-04.jpg">
				<img class="iconTech" alt="MySQL" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-05.jpg">
				<img class="iconTech" alt="MongoDB" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-06.jpg">
				<img class="iconTech addTopMargin" alt="redis" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-07.jpg">
				<img class="iconTech addTopMargin" alt="RabbitMQ" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-08.jpg">
				<img class="iconTech addTopMargin" alt="React" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-09.jpg">
				<img class="iconTech addTopMargin" alt="Redux" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-10.jpg">
				<img class="iconTech addTopMargin" alt="PostCSS" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-11.jpg">
				<img class="iconTech addTopMargin" alt="Ruby" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-12.jpg">
				<img class="iconTech addTopMargin" alt="RAILS" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-13.jpg">
				<img class="iconTech addTopMargin" alt="Big Data FINANCE" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-14.svg">
				<img class="iconTech addTopMargin" alt="ARTIFICAL INTELLIGENCE" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-15.svg">
				<img class="iconTech addTopMargin" alt="Machine Learning" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-16.svg">
				<img class="iconTech addTopMargin" alt="Microsoft .NET Framework" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-17.jpg">
				<img class="iconTech addTopMargin" alt="ANGULARJS" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-18.jpg">
				<img class="iconTech addTopMargin" alt="IOS" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-19.jpg">
				<img class="iconTech addTopMargin" alt="ANDROID" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-20.jpg">
				<img class="iconTech addTopMargin" alt="LARAVEL" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-21.jpg">
				<img class="iconTech addTopMargin" alt="ZEND FRAMEWORK" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-22.jpg">
				<img class="iconTech addTopMargin" alt="yiiframework" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-23.jpg">
				<img class="iconTech addTopMargin" alt="nodejs" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-24.jpg">
			</div>
		</div>
	</section>

	<section class="tasks-we-solve">
		<div class="container-960">
			<div class="tasks">
				<h2>Какие задачи мы решаем</h2>
				<div class="subtitle">
					<span>Команда разработчиков ознакомится с задачей и индивидуально подберет решение. Ниже описаны распространенные случаи и наши подходы к ним.</span>
				</div>
				<div class="work-process">
					<ol class="work-stages">
						<li class="work-stage work-stage-first">
							<div class="work-stage-image">
								<img alt="Разработка портала с нуля" class="left-image" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-task-01.svg">
							</div>
							<div class="work-stage-content">
								<span class="work-stage-head">Задача 1</span>
								<span class="work-stage-text">Вам необходима разработка сайта или портала с нуля.</span>
								<span class="work-stage-solution">Решение:</span>
								<span class="work-stage-solution-text">Готовы пройти с вами через весь SCRUM-процесс и разработать продукт, который улучшит и автоматизирует бизнес-процесс. Разработаем сайт, используя актуальный стек технологий, React JS/Angular/Java/Microsoft .Net/. Наш подход позволит запустить работу с минимальным ТЗ и построить максимально гибкий процесс. Процесс создания корпоративного сайта помогают ускорить наши собственные фреймворки, если перевести на человеческий язык - это полуфабрикаты/заготовки, которые позволяют нам предлагать меньшие временные издержки, а следовательно и более низкую стоимость.</span>
							</div>
						</li>


						<li class="work-stage work-stage-second">
							<div class="work-stage-image">
								<img alt="Доработка ТЗ и предоставление команды разработчиков" class="left-image" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-task-02.svg">
							</div>
							<div class="work-stage-content">
								<span class="work-stage-head">Задача 2</span>
								<span class="work-stage-text">У вас есть ТЗ, нужна команда для реализации.</span>
								<span class="work-stage-solution">Решение:</span>
								<span class="work-stage-solution-text">Мы поможем доработать ТЗ  и выделить на проект команду специалистов, которая необходима для его реализации. Проект может вестись под руководством нашего Product Owner или команда может быть переведена полностью полностью под ваше управление. Также есть возможность работы Product Owner на территории Заказчика.</span>
							</div>
						</li>

						<li class="work-stage work-stage-third">
							<div class="work-stage-image">
								<img alt="Доработка и реализация проекта" class="left-image" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-task-03.svg">
							</div>
							<div class="work-stage-content">
								<span class="work-stage-head">Задача 3</span>
								<span class="work-stage-text">У вас есть действующий корпоративный портал, необходимо его доработать или реализовать проект на ещё одной платформе.</span>
								<span class="work-stage-solution">Решение:</span>
								<span class="work-stage-solution-text">Проверим текущую систему на целостность, доработаем архитектуру базы данных с учетом необходимой нагрузки, безопасности хранения данных. Спроектируем, реализуем и внедрим портал на новую платформу.</span>
							</div>
						</li>

						<li class="work-stage">
							<div class="work-stage-image">
								<img alt="Аудит вашего портала" class="left-image" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-task-04.svg">
							</div>
							<div class="work-stage-content">
								<span class="work-stage-head">Задача 4</span>
								<span class="work-stage-text">Хотите провести проверку действующего корпоративного портала.</span>
								<span class="work-stage-solution">Решение:</span>
								<span class="work-stage-solution-text">Проводим аудит показателей системы, качества кода, проектного управления.</span>
							</div>
						</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="solutions">
		<div class="container-960">
			<div class="solutions-block">
				<h2>Отраслевые решения</h2>
				<span class="solutions-subtitle">Мы создаем отраслевые решения с учетом специфики вашей отрасли</span>
				<div class="solution-require-btn">
					<a href="" data-toggle="modal" data-target="#modal-2" class="btn corporate-btn btn-black-white">оставить заявку</a>
				</div>
				<div class="solutions-list">
					<div class="solution-list-block">
						<img alt="Решения для банков и финансового сектора" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-01.svg">
						<span class="sol-text">банки и финансы</span>
					</div>
					<div class="solution-list-block">
						<img alt="Порталы для страховых агентств" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-02.svg">
						<span class="sol-text">страхование</span>
					</div>
					<div class="solution-list-block">
						<img alt="Разработки для технологического сектора" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-03.svg">
						<span class="sol-text">технологический сектор</span>
					</div>
					<div class="solution-list-block">
						<img alt="Порталы для розничной торговли" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-04.svg">
						<span class="sol-text double-line">розничная торговля</span>
					</div>
					<div class="solution-list-block">
						<img alt="Сайты туристических агентств" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-05.svg">
						<span class="sol-text double-line">путешествия</span>
					</div>
					<div class="solution-list-block">
						<img alt="Разработки для топливно-энергетических направлений" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-06.svg">
						<span class="sol-text double-line">топливно-энергетический комплекс</span>
					</div>
					<div class="solution-list-block">
						<img alt="Развлекательные порталы и медиа" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-07.svg">
						<span class="sol-text">медиа и развлечения</span>
					</div>
					<div class="solution-list-block">
						<img alt="Медицинские порталы" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-08.svg">
						<span class="sol-text">медицина и биотехнологии</span>
					</div>
					<div class="solution-list-block">
						<img alt="Идеи для формирующихся рынков" src="/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-09.svg">
						<span class="sol-text">формирующиеся рынки</span>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!--section class="section-block bg-slider-1 block-request">
		<div class="container">
			<div class="center-aligned">
				<h3 class="section-header-dark">СРОКИ И СТОИМОСТЬ РАЗРАБОТКИ корпоративного портала</h3>
				<p class="section-text-dark">Каждый проект рассчитывается индивидуально. Стоимость портала зависит от сложности, объема и сроков работы. Вы можете оставить краткую информацию и наш менеджер вам перезвонит.</p>
			</div>
		</div>

		<div class="container">
			<noindex>
				<div class="question-face"><img alt="сотрудник infoshell" src="/wp-content/themes/mark_up/img1/faces/kirill-popov.png"  width="160" height="160">
					<div> <b>Кирилл Попов</b><br><span>Менеджер по работе с клиентами</span></div>
				</div>

				<div data-goals="project_estimate_main,all_project_price_check,all_goals" id="callForm" class="question-form contactForm">
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

					<div class="control-group">
						<textarea rows="10" name="message" placeholder="Опишите, пожалуйста, проект.." class="inputbox full clear"></textarea>
						</div>

					<div class="control-group">
						<div class="attachment">
							<div class="attach-container">
								<div class="attach-file">
									<div class="icon Attach"></div><span class="attach-file-name">Добавить файл</span>
								</div>
								<input type="file" class="attach-file-input" name="upload_file">
							</div>
							<a href="" class="attach-reset">&times;</a>
						</div>
						<div class="submit-btn">
							<span class="btn btn-black contactFormSubmit">ОСТАВИТЬ ЗАЯВКУ</span>
						</div>
					</div>
				</div>
			</noindex>
		</div>
	</section-->























<!-- CALC -->
<section class="">
<div id="calculator">
<div class="container">
<!--    <style>-->
<!--        #calculator #calc_header,-->
<!--        #calculator #calc_text {-->
<!--            display: none;-->
<!--        }-->
<!--    </style>-->

	<?php require __DIR__.'/../calc/calculator.html'; ?>
</div>
</div>
</section>

























	<section class="our-benefits">
		<div style="padding: 1px 10px;">
			<div class="benefits-heading">
				<h2>Почему выгодно <br>заказать корпоративный сайт у нас</h2>
			</div>
			<div class="our-benefits-block">
				<div class="benefits-list">
					<div class="benefit-block">
						<span class="benefit-title">ИСКЛЮЧИТЕЛЬНЫЙ ОПЫТ И КОМПЕТЕНЦИЯ</span>
						<p class="benefit-text">Штатные специалисты компании Infoshell имеют огромный и уникальный опыт разработки корпоративных порталов и исключительные компетенции в разных областях. Благодаря этому команды специалистов не только решают поставленные задачи по созданию сайта, но также используют свою экспертизу для подбора правильных инструментов и технологий, позволяющих реализовать задачу оптимальным образом.</p>
					</div>
					<div class="benefit-block">
						<span class="benefit-title">СОЗДАНИЕ ПОРТАЛА «ПОД КЛЮЧ»</span>
						<p class="benefit-text">Наша компания предлагает клиентам услугу создания корпоративного портала «под ключ». Работы начинаются с обязательного анализа требований и задач, а также консультирования клиента по другим вопросам. По готовности сайта мы осуществляем долгосрочную техническую поддержку, чтобы избежать любых сложностей в использовании продукта клиентом.</p>
					</div>
					<div class="benefit-block">
						<span class="benefit-title">ПОСТОЯННЫЙ ПОИСК НОВЫХ РЕШЕНИЙ</span>
						<p class="benefit-text">Мы гарантируем высочайшее качество работы, ведь постоянно находимся в поиске новых, оптимальных решений для достижения целей клиентов. Компания Infoshell считает основополагающим умение сбалансировать скорость и стоимость разработки. Такой подход позволяет нашим клиентам всегда получать достойный сайт, способный сделать бизнес проще и эффективнее.</p>
					</div>
					<div class="benefit-block">
						<span class="benefit-title">ИТЕРАЦИОННЫЙ ПОДХОД</span>
						<p class="benefit-text">Мы ведем работу короткими циклами (итерациями). Этот подход снижает риски и позволяет вместе с клиентом вносить изменения в проект прямо в процессе работы. Итерационный подход очень важен в нашем быстро изменяющемся мире, ведь именно он позволяет получить продукт, реально востребованный пользователями.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

<section class="section-block infoshel-main-reviews">
    <div class="container">
        <h2 class="infoshel-h2 infoshel-main-reviews__h2 wow fadeIn">Отзывы заказчиков</h2>
        <p class="infoshel-main-reviews__title wow fadeIn" data-wow-delay="0.3s">Конечная цель любого мобильного приложения – автоматизация бизнес-процессов, создание имиджа компании, увеличение прибыли бизнеса за счет популярности продукта в интернете</p>
    </div>
    <div class="infoshel-main-reviews-slider">
        <div class="infoshel-main-reviews-slider-navigation">
            <div class="infoshel-main-reviews-slider-prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.628" height="22.628" viewBox="0 0 22.628 22.628">
                    <path id="Combined_Shape" data-name="Combined Shape" d="M0,16V0H-3V13H-16v3Z" transform="translate(11.314 22.628) rotate(135)" fill="#f9f9f9"/>
                </svg>
            </div>
            <div class="infoshel-main-reviews-slider-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.628" height="22.628" viewBox="0 0 22.628 22.628">
                    <path id="Combined_Shape" data-name="Combined Shape" d="M0,16V0H3V13H16v3Z" transform="translate(11.314 22.628) rotate(-135)" fill="#f9f9f9"/>
                </svg>
            </div>
        </div>
        <ul class="swiper-wrapper">
            <li class="testimonials-client__item swiper-slide">
                <div class="youtube" data-embed="vipp5BNsnJc">
                    <div class="play-button"></div>
                </div>
                <p class="testimonials-client__name">Сергей Барамба</p>
                <p class="testimonials-client__job">ИТ Директор Группы компаний «РосОхрана»</p>
            </li>
            <li class="testimonials-client__item swiper-slide">
                <div class="youtube" data-embed="Ei6sZ13Aq5g">
                    <div class="play-button"></div>
                </div>
                <p class="testimonials-client__name">Денис Шпак</p>
                <p class="testimonials-client__job">Руководитель компании «Mobile Agent»</p>
            </li>
            <li class="testimonials-client__item swiper-slide">
                <div class="youtube" data-embed="nPW2I_pDLyg">
                    <div class="play-button"></div>
                </div>
                <p class="testimonials-client__name">Илья Новиков</p>
                <p class="testimonials-client__job">Global It Director of Insignia</p>
            </li>
            <li class="testimonials-client__item swiper-slide">
                <div class="youtube" data-embed="TzvVZDWe-u0">
                    <div class="play-button"></div>
                </div>
                <p class="testimonials-client__name">Лев Левицкий</p>
                <p class="testimonials-client__job">Директор по продуктам и проектам - Киноход</p>
            </li>
        </ul>
    </div>
</section>
<script>
    $(document).ready(function () {
        const swiper = new Swiper('.infoshel-main-reviews-slider', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            allowTouchMove: false,
            slidesPerView: 1,
            spaceBetween: 70,
            centeredSlides: true,
            // Navigation arrows
            navigation: {
                nextEl: '.infoshel-main-reviews-slider-next',
                prevEl: '.infoshel-main-reviews-slider-prev',
            },
            breakpoints: {
                // when window width is >= 320px
                1200: {
                    slidesPerView:3,
                    centeredSlides: true,
                },
                992: {
                    slidesPerView:2,
                    centeredSlides: false,
                }
            }
        });

        var youtube = document.querySelectorAll(".youtube");

        for (var i = 0; i < youtube.length; i++) {
            var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/sddefault.jpg";
            var image = new Image();
            image.src = source;

            image.addEventListener( "load", function() {
                youtube[ i ].appendChild( image );
            }( i ) );

            youtube[i].addEventListener("click", function () {
                var iframe = document.createElement("iframe");
                iframe.setAttribute("frameborder", "0");
                iframe.setAttribute("allowfullscreen", "");
                iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.embed + "?rel=0&showinfo=0&autoplay=1");
                this.innerHTML = "";
                this.appendChild(iframe);
            });
        }
    });
</script>

	<!--section class="section-block">
		<noindex>
			<div class="container-full">
				<h3 class="section-header-dark">Отзывы заказчиков</h3>
				<div class="testimonials owl-carousel">

		            <?php
		                $posts = get_posts('category_name=testimonials&posts_per_page=10&orderby=rand');
		                foreach( $posts as $post ) {

		                    $image = get_field('avatar');$alt = get_post_meta($post->ID, "img-alt", true);  ?>
		                    <div class="testimonials--item">
						        <div class="testimonials--text">
							        <p><?php echo $post->post_content; ?></p><a href=""></a>
						        </div>
						        <div class="testimonials--author">
							        <div class="face"><img alt="<?=$alt ? $alt : $post->post_title;?>" src="<?php echo $image['url']; ?>" width="80" height="80"></div><span><?php echo $post->post_title; ?></span>
						        </div>
					        </div>

		            <?php } ?>
				</div>
				<div class="testimonials--button"><a href="/company/" class="btn btn-outlined">Все отзывы и письма</a></div>
			</div>
		</noindex>
	</section-->

<footer class="infoshel-footerinfoshel-footer">
    <div class="infoshel-container infoshel-footer__container">
        <div class="infoshel-footer__container-logo">
            <a href="<?php bloginfo('url'); ?>"></a>
        </div>
        <div class="infoshel-footer__container-download">
            <a target="_blank" href="/files/InfoShell.pdf">Скачать презентацию о компании <span></span></a>
        </div>
        <div class="infoshel-footer__container-phone">
            <p>Мск: +7 (499) 113 37 19</p>
            <p>СПб: +7 (499) 113 37 19</p>
        </div>
    </div>
</footer>



	<div id="modal-1" class="modaler in" style="display: none; padding-right: 0px;">
		<div class="modaler-content">
			<div class="modaler-header-icon">
				<div class="icon Phone_call_modaler"></div>
			</div>
			<div class="modaler-header-text">Оставьте свой номер телефона, <br>и мы вам обязательно перезвоним!</div>
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
			<div class="modaler-close"><a href="" data-dismiss="modaler"><span>×</span>Закрыть</a></div>
		</div>
	</div>

	<div id="modal-2" class="modaler in" style="display: none; padding-right: 0px;">
		<div class="modaler-content">
			<div class="modaler-header-text">Вы можете оставить онлайн-заявку, <br>и мы вам обязательно ответим!</div>
			<div data-goals="project_estimate_main,all_project_price_check,all_goals" id="callForm" class="question-form contactForm">
				<div class="control-group">
					<input type="text" placeholder="Ваше имя.." name="name" class="inputbox full">
				</div>
				<!-- /control-group-->
				<div class="control-group">
					<input type="text" placeholder="Ваш телефон..*" name="phone" class="inputbox full">
				</div>
				<!-- /control-group-->
				<div class="control-group">
					<input type="text" placeholder="Ваш e-mail.." name="email" class="inputbox full">
				</div>
				<!-- /control-group-->
				<div class="control-group">
					<textarea rows="10" name="message" placeholder="Опишите, пожалуйста, проект.." class="inputbox full clear"></textarea>
				</div>
				<!-- /control-group-->
				<div class="control-group">
					<div class="attachment__white">
						<div class="attach-container">
							<div class="attach-file">
								<div class="icon Attach_white"></div><span class="attach-file-name">Добавить файл</span>
							</div>
							<!-- /attach-file-dummy-->
							<input type="file" class="attach-file-input" name="upload_file">
							<!-- /hidden file input-->
						</div>
						<!-- /attach-container--><a href="" class="attach-reset">&times;</a>
					</div>
					<!-- /attachment-->
				</div>
				<!-- /control-group-->
				<div class="control-group text-center">
					<span class="btn btn-yellow contactFormSubmit">Отправить</span>
				</div>
				<!-- /control-group-->
			</div>
			<!-- /form-->
			<div class="modaler-close"><a href="" data-dismiss="modaler"><span>&times;</span>Закрыть</a></div>
		</div>
	</div>

	<!--div class="modaler-backdrop in" onclick="clik_hide()" style="display:none" ></div-->



<?php require __DIR__.'/../calc/calc.script.inc.html'; ?>





<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23922742-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23922742-1');
</script>

</body>
</html>