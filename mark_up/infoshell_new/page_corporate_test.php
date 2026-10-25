<!DOCTYPE html>
<!-- /*
Template Name: Страница "Corporate Test"
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
	<title>Разработка корпоративных сайтов и порталов</title>
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
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<meta name="copyright" content="">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<link rel="shortcut icon" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/favicon.png" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/countdown/jquery.countdown.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/fonts.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/main.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/main2.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/corporate.css" />
<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/corporate-media.css" />
	<link href="https://infoshell.ru/wp-content/themes/mark_up/css1/formCorrections.css" rel="stylesheet">
	<link href="https://infoshell.ru/wp-content/themes/mark_up/css1/main.css?1439406648325" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&amp;subset=latin,cyrillic" rel="stylesheet">
    <style>
        section div.container-960 div.tables div.cell.text-cell h3 {
            text-align: left;
        }
    </style>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/js/library.js"></script>
    <script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/js/corporate.js"></script>
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
	<script src="https://infoshell.ru/wp-content/themes/mark_up/js1/main.js"></script>

	<script type="text/javascript">
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
			});
	</script>
</head>
<body class="body-corporate">
	<header class="header-corporate">
		<div class="nav-corporate">
			<div class="container-960">
				<a href="/" class="logo-header-ios"><img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/logo.svg" alt="Инфошелл"></a>
				<button class="button-main-mnu"></button>
				<nav>
					<ul>
						<li><a href="/services/" class="active">Услуги</a></li>
						<li><a href="/portfolio/">Портфолио</a></li>
						<li><a href="/company/">Компания</a></li>
						<li><a href="/contact/">Контакты</a></li>
					</ul>
				</nav>
				<div class="contacts-corporate clearfix">
					<div class="tel">Мск: +7 (495) 215 51 82 <br>СПб: +7 (812) 242 80 58</div>
					<a id="ZAKAZ_ZVONKA" href="#" onclick="clik_show()" data-toggle="modal" data-target="#modal-1" class="btn-call-me"><span>Заказать<br> звонок</span></a>
				</div>
				<a href="/services/" class="all-services"> <i class="fa fa-long-arrow-left"></i> Все услуги</a>
			</div>		
		</div>
		<div class="head-container">
			<div class="title-corporate">
				<h1>Разработка корпоративных сайтов повышенного уровня сложности</h1>
				<div class="request-button">
					<a href="" data-toggle="modal" data-target="#modal-2" class="btn corporate-btn btn-yellow">оставить заявку</a>
				</div>
			</div>
		</div>
	</header>

	<section class="introduction">
		<div class="container-960">
			<div class="first-title">
				<span>Компания Infoshell оказывает услуги по созданию корпоративных порталов и сайтов повышенного уровня сложности. У нас вы можете заказать разработку корпоративного сайта «под ключ» по гибкой методологии SCRUM.</span>	
			</div>
			<div class="second-title">
				<span>
					За 8 лет работы в сфере создания мобильных приложений и web-ceрвисов команда Infoshell реализовала более 100 проектов для бизнеса и государственных структур.Мы создаем удобные решения для эффективного бизнеса: анализируем, чего не хватает бизнес-процессам клиента и что нужно автоматизировать, подбираем подходящие технологии, разрабатываем ИТ-решения и внедряем их в жизнь.
				</span>
			</div>
		</div>
	</section>

	<section class="tech-stack">
		<div class="the-stack">
			<h2>Наш технологический стек</h2>
			<div class="techlist">
				<img class="iconTech" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-01.jpg">
				<img class="iconTech" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-02.jpg">
				<img class="iconTech" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-03.jpg">
				<img class="iconTech" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-04.jpg">
				<img class="iconTech" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-05.jpg">
				<img class="iconTech" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-06.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-07.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-08.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-09.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-10.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-11.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-12.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-13.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-14.svg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-15.svg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-16.svg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-17.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-18.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-19.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-20.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-21.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-22.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-23.jpg">
				<img class="iconTech addTopMargin" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-teh-24.jpg">
			</div>
		</div>
	</section>

	<section class="tasks-we-solve">
		<div class="container-960">
			<div class="tasks">
				<h2>Какие задачи мы решаем</h2>
				<div class="subtitle">
					<span>Наша команда ознакомится с  задачей и индивидуально подберет решение. Ниже описаны распространенные случаи и наши подходы к ним.</span>	
				</div>
				<div class="work-process">
					<ol class="work-stages">
						<li class="work-stage work-stage-first">
							<div class="work-stage-image">
								<img class="left-image" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-task-01.svg">
							</div>
							<div class="work-stage-content">
								<span class="work-stage-head">Задача 1</span>
								<span class="work-stage-text">Вам необходима разработка сайта или портала с нуля.</span>
								<span class="work-stage-solution">Решение:</span>
								<span class="work-stage-solution-text">Мы готовы пройти с вами через весь SCRUM-процесс и разработать продукт, который улучшит ваш бизнес-процесс. Мы разработаем сайт, используя актуальный стек технологий, React JS/Angular/Java/Microsoft .Net/. Наш подход позволит запустить работу с минимальным ТЗ и построить максимально гибкий процесс. Создание корпоративного сайта поможет ускорить не только методология разработки, но и наши собственные фреймворки, если перевести на человеческий язык - это полуфабрикаты/заготовки, которые позволяют нам предлагать меньшие временные издержки, а следовательно и более низкую стоимость.</span>
							</div>
						</li>


						<li class="work-stage work-stage-second">
							<div class="work-stage-image">
								<img class="left-image" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-task-02.svg">
							</div>
							<div class="work-stage-content">
								<span class="work-stage-head">Задача 2</span>
								<span class="work-stage-text">У вас есть ТЗ нужна команда для реализации.</span>
								<span class="work-stage-solution">Решение:</span>
								<span class="work-stage-solution-text">Мы поможем доработать ТЗ  и выделить на проект команду специалистов, которая необходима для его реализации. Проект может вестись под руководством нашего Product Owner или команда может быть переведена полностью полностью под ваше управление. Также есть возможность работы Product Owner на территории Заказчика.</span>
							</div>
						</li>

						<li class="work-stage work-stage-third">
							<div class="work-stage-image">
								<img class="left-image" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-task-03.svg">
							</div>
							<div class="work-stage-content">
								<span class="work-stage-head">Задача 3</span>
								<span class="work-stage-text">У вас есть действующий корпоративный портал , необходимо его доработать или реализовать проект на ещё одной платформе.</span>
								<span class="work-stage-solution">Решение:</span>
								<span class="work-stage-solution-text">Проверим текущую систему на целостность, доработаем архитектуру базы данных с учетом необходимой нагрузки, безопасности хранения данных. Спроектируем и реализуем проект на новой платформе.</span>
							</div>
						</li>

						<li class="work-stage">
							<div class="work-stage-image">
								<img class="left-image" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-task-04.svg">
							</div>
							<div class="work-stage-content">
								<span class="work-stage-head">Задача 4</span>
								<span class="work-stage-text">Хотите провести проверку действующей системы.</span>
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
						<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-01.svg">
						<span class="sol-text">банки и финансы</span>
					</div>
					<div class="solution-list-block">
						<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-02.svg">
						<span class="sol-text">страхование</span>
					</div>
					<div class="solution-list-block">
						<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-03.svg">
						<span class="sol-text">технологический сектор</span>
					</div>
					<div class="solution-list-block">
						<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-04.svg">
						<span class="sol-text double-line">розничная торговля</span>
					</div>
					<div class="solution-list-block">
						<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-05.svg">
						<span class="sol-text double-line">путешествия</span>
					</div>
					<div class="solution-list-block">
						<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-06.svg">
						<span class="sol-text double-line">топливно-энергетический комплекс</span>
					</div>
					<div class="solution-list-block">
						<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-07.svg">
						<span class="sol-text">медия и развлечения</span>
					</div>
					<div class="solution-list-block">
						<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-08.svg">
						<span class="sol-text">медицина и биотехнологии</span>
					</div>
					<div class="solution-list-block">
						<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/corporate/ic-solutions-09.svg">
						<span class="sol-text">формирующиеся рынки</span>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="section-block bg-slider-1 block-request">
		<div class="container">
			<div class="center-aligned">
				<h3 class="section-header-dark">СРОКИ И СТОИМОСТЬ РАЗРАБОТКИ корпоративного портала</h3>
				<p class="section-text-dark">Каждый проект рассчитывается индивидуально. Стоимость зависит от сложности, объема и сроков работы. Вы можете оставить краткую информацию и наш менеджер вам перезвонит.</p>
			</div>
		</div>
		<!-- /container-->
		<div class="container">
			<noindex>
				<div class="question-face"><img alt="сотрудник infoshell" src="https://infoshell.ru/wp-content/themes/mark_up/img1/faces/kirill-popov.png"  width="160" height="160">
					<div> <b>Кирилл Попов</b><br><span>Менеджер по работе с клиентами</span></div>
				</div>
				<!-- /question-face-->
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
								<input type="file" class="attach-file-input" name="upload_file">
								<!-- /hidden file input-->
							</div>
							<!-- /attach-container--><a href="" class="attach-reset">&times;</a>
						</div>
						<!-- /attachment-->
						<div class="submit-btn">
							<span class="btn btn-black contactFormSubmit">ОСТАВИТЬ ЗАЯВКУ</span>
						</div>
					</div>
					<!-- /control-group-->
				</div>
			<!-- /form-->
			</noindex>
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
						<span class="benefit-title">Исключительные компетенции</span>
						<p class="benefit-text">В штате компании работают специалисты с уникальными компетенциями, готовые взять на себя не только решение задач по созданию программного обеспечения, но и комплексную экспертизу проекта с целью выбора подходящих технологий для его реализации.</p>
					</div>
					<div class="benefit-block">
						<span class="benefit-title">ПОЛНЫЙ ЦИКЛ создания корпоративного сайта</span>
						<p class="benefit-text">Мы предлагаем весь спектр услуг по разработке и внедрению веб-сервиса, от анализа требований и консультирования до оказания долгосрочной технической поддержки.</p>
					</div>
					<div class="benefit-block">
						<span class="benefit-title">Поиск оптимальных решений</span>
						<p class="benefit-text">Мы гарантируем высокое качество сайта и постоянно находимся в поиске оптимального решения, соблюдая разумный баланс между скоростью и стоимостью разработки, быстродействием и производительностью ИТ-ресурсов, для того, чтобы предложить вам действительно достойный продукт, способный сделать ваш бизнес проще и эффективнее.</p>
					</div>
					<div class="benefit-block">
						<span class="benefit-title">ИТЕРАЦИОННЫЙ ПОДХОД ПО SCRUM</span>
						<p class="benefit-text">Разработка короткими циклами (итерациями) снижает риски и позволяет вносить изменения в процесс работы. Что позволяет получить именно тот продукт, который будет реально востребован пользователями. </p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-block">
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
						        <!-- /testimonials-text-->
						        <div class="testimonials--author">
							        <div class="face"><img alt="<?=$alt ? $alt : $post->post_title;?>" src="<?php echo $image['url']; ?>" width="80" height="80"></div><span><?php echo $post->post_title; ?></span>
						        </div>
						        <!-- /testimonials-author-->
					        </div>

		            <?php } ?>
				</div>
				<!-- /testimonials-->
				<div class="testimonials--button"><a href="/company/" class="btn btn-outlined">Все отзывы и письма</a></div>
			</div>
		</noindex>
	</section>

	<footer class="footer">
		<div class="container-mobile-full"><a href="" class="footer-logo"><img alt="разработка мобильных приложений" src="https://infoshell.ru/wp-content/themes/mark_up/img1/logo.svg"   width="45" height="45"></a>
			<!-- /footer-logo--><a href="https://infoshell.ru/files/Infoshell.pdf" class="download-presentation">
				<div class="icon Download_foot"></div><span>Скачать презентацию</span></a>
			<!-- /dowload-presentation-->
			<div class="footer-info"><span class="footer-tel"><b>+7 (495) 215-51-82</b> (Мск)</span>
				<!-- /footer-tel--><span class="footer-tel"><b>+7 (812) 242-80-58</b> (СПб)</span>
				<!-- /footer-tel--><a href="" data-toggle="modal" data-target="#modal-1" class="footer-request-call">
					<div class="icon Phone_foot"></div><span>Заказать звонок</span></a>
				<!-- /footer-request-call-->
			</div>
		</div>
		<!-- /container-mobile-full-->
	</footer>



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

	<div id="modal-2" class="modal">
		<div class="modal-content">
			<div class="modal-header-text">Вы можете оставить онлайн-заявку, <br>и мы вам обязательно ответим!</div>
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
			<div class="modal-close"><a href="" data-dismiss="modal"><span>&times;</span>Закрыть</a></div>
		</div>
	</div>

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