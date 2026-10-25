<!DOCTYPE html>
<!-- /*
Template Name: Страница "CRP, ERP системы"
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
	<title>Разработка CRM-систем</title>
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
    <link rel="icon" href="/wp-content/themes/mark_up/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/wp-content/themes/mark_up/favicon.ico" />
<noindex>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<meta name="copyright" content="">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/libs/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/libs/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/libs/countdown/jquery.countdown.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/css/fonts.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/css/main.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/css/main2.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/css/media.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/css/crm.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/css/crm-media.css?v=1.1" />
	<link href="<?php echo get_template_directory_uri(); ?>/css1/formCorrections.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/css1/main.css?1439406648325" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/new-style-header.css?v=1" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/new-style-footer.css?v=1" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&amp;subset=latin,cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic" rel="stylesheet">
    <style>
        section div.container-960 div.tables div.cell.text-cell h3 {
            text-align: left;
        }
    </style>
    <script src="<?php echo get_template_directory_uri(); ?>/js/library.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/infoshell_new/js/corporate.js"></script>
    <script>
        $(document).ready(function () {
            $(".infoshel-header__container-burger").click(function() {
                if(!$('.side-menu').hasClass('active')) {
                    $(".side-menu").addClass("active");
                    $(".infoshel-page").addClass("active");
                } else {
                    $(".side-menu").removeClass("active");
                    $(".infoshel-page").removeClass("active");
                }
            });
            $(".side-menu__header-close").click(function() {
                $(".side-menu").removeClass("active");
                $(".infoshel-page").removeClass("active");
            });
        })
    </script>
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

	<script src="<?php echo get_template_directory_uri(); ?>/js1/ajaxForms.js?v=1.4"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js1/main.js"></script>
</head>
<body class="body-crm">
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
	<div class="header-crm">
		<div class="head-container">
			<div class="title-corporate">
				<h1>Индивидуальная разработка <br>CRM и ERP систем</h1>
				<div class="request-button">
					<a href="" data-toggle="modal" data-target="#modal-2" class="btn corporate-btn btn-yellow">оставить заявку</a>
				</div>
			</div>
		</div>
	</div>

	<section class="introduction">
		<div class="container-960" itemscope itemtype="http://schema.org/Service">
			<div class="first-title">
				<span itemprop="serviceType">Мы разрабатываем CRM и ERP системы, которые на 100% подходят бизнесу наших клиентов. Помогаем автоматизировать работу, когда “коробочные” решения не применимы в рамках оригинальных бизнес процессов. Решаем любые задачи, интегрируем со сторонними информационными системами. Возможна разработка CRM-системы, как составного элемента существующей ERP-систем.</span>
			</div>
			<div class="second-title" itemprop="description">
				<span>
					Наши инженеры создают отраслевые решения с учетом специфики отрасли клиента. Мы имеем опыт работы в следующих отраслях: логистика, оптово-розничная торговля, финансы, туризм, телекоммуникации, фармацевтика, страхование и др.
				</span>
			</div>
		</div>
	</section>

	<section class="what-we-do-section">
		<h2>ЧТО МЫ ДЕЛАЕМ</h2>
		<div class="what-we-do-block">
			<div class="what-we-do-items">
				<div class="col-item-4 what-we-do">
					<div class="what-we-do--icon what-we-do--icon-one"></div>
					<div class="what-we-do--text"><p>Индивидуальная разработка CRM и ERP систем «с нуля» под конкретного заказчика.</p></div>
				</div>

				<div class="col-item-4 what-we-do">
					<div class="what-we-do--icon what-we-do--icon-two"></div>
					<div class="what-we-do--text">
						<p>Доработка готовой системы под потребности клиента.</p>
					</div>
				</div>

				<div class="col-item-4 what-we-do">
					<div class="what-we-do--icon what-we-do--icon-three"></div>
					<div class="what-we-do--text"><p>Создание нового продукта на основе типового решения.</p></div>
				</div>
			</div>
		</div>
	</section>

	<section class="dev-stages section-3-ios">
		<div class="container-960 container-modified">
			<h2 class="h2za">этапы разработки приложения</h2>
			<div class="tables">
				<div class="table">
					<div class="row">
						<div class="cell before-idea">
							<div class="img-table-1">
								<img src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/for-Scheme/Scheme_1@2x.png" alt="Идея веб-проекта и консультация" class="img-schem-1">
							</div>
						</div>
						<div class="cell text-cell">
							<h3>1. Идея проекта и консультация</h3>
							<p>
								Клиенты приходят к нам с идеей  создания CRM или ERP системы или конкретными требованиями к функционалу. В ходе бесплатной консультации наш аналитик проводит предварительный аудит с выявлением процессов и потребностей вашей компании, ищет возможные решения  для увеличения скорости, эффективности, удобства и формирует видение будущего проекта.
							</p>
							<div class="question-table">
								<div class="tooltipz tool1">
									<p><strong>Идея и консультация</strong></p>
									<p>Почти всегда идея, с которой клиенты приходят к нам, требует аналитики и доработки. Эта работа необходима, чтобы на старте четко понимать, что мы имеем и в каком направлении двигаться, а также, чтобы продумать стратегию создания лучшего продукта.</p>
									<p>На этом этапе мы проводим аналитику рынка приложений/веб-сервисов по выбранной тематике, выявляем лидеров и находим примеры плохой реализации, определяем критерии их успеха или провала. Мы изучаем продукты конкурентов с точки зрения интерфейсных решений, ориентирования на конечного пользователя, выполнения сервисом своих целей и задач и выявляем их преимущества и недостатки.</p>
									<p>Полученные знания проецируем на будущее приложение, формируем представление о конечном продукте, о пользователях и их целях, и в результате получаем видение будущего проекта, зафиксированное в документе - project vision.</p>
									<p>После консультации с нашим специалистом у Вас появится точное понимание, как сделать так чтобы проект выстрелил.</p>
									<p>Приступаем к работе!</p>
								</div>
							</div>

						</div>
					</div>
					<div class="row">
						<div class="cell">
							<div class="img-table-1">
								<img src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/for-Scheme/Scheme_2@2x.png" alt="Оценка проекта и предложение" class="img-schem-2">
							</div>
						</div>
						<div class="cell text-cell ">
							<h3>2. Оценка проекта и предложение</h3>
							<p>
								Команда разработчиков оценивает будущую CRM или ERP системы, и мы составляем предварительное коммерческое предложение на разработку.
							</p>
							<div class="question-table">
								<div class="tooltipz tool2">
									<p><strong>Оценка проекта и предложение</strong></p>
									<p>После составления project vision проекта наша команда разработчиков оценивает примерные трудозатраты на реализацию продукта. Исходя из поставленных задач и технологических ограничений, составляется оценка количества часов, необходимых на разработку вашего продукта.</p>
									<p>На основе полученной оценки формируется предварительное коммерческое предложение, в которое входит описание похожих проектов, реализованных нашей компанией, состав команды разработчиков и профессиональный уровень каждого участника,  стоимость всего проекта с разбиением на этапы разработки.</p>
									<p>На коммерческом предложении в дальнейшем будет основан договор.</p>
								</div>
							</div>

						</div>
					</div>
					<div class="row">
						<div class="cell">
							<div class="img-table-1">
								<img src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/for-Scheme/Scheme_3@2x.png" alt="Бэклог и договор на веб - разработку" class="img-schem-3">
							</div>
						</div>
						<div class="cell text-cell">
							<h3>3. ПРОЕКТИРОВАНИЕ, БЭКЛОГ И ДОГОВОР НА РАЗРАБОТКУ</h3>
							<p>
								После обсуждения деталей проекта с продукт-оунером, заказчик и команда разрабатывают архитектуру решения, описывает алгоритмы и сценарии работы в бэклоге на весь проект. Проектируем интерфейсы и возможно разрабатываем дизайн. После этого с заказчиком подписывается договор.
							</p>
							<div class="question-table">
								<div class="tooltipz tool2">
									<p><strong>Бэклог и договор</strong></p>
									<p>Далее, команда разработчиков вместе с продукт оунером (Product Owner)* и Заказчиком составляет второй единый документ приложения - Бэклог Продукта**.</p>
									<br>
									<p>* продукт оунер – руководитель проекта</p>
									<br>
									<p>Ответственность за содержимое бэклога, его упорядочение и доступность всем членам проекта несет Product Owner. Он также ответственен за достижение максимальной ценности продукта и работы, выполняемой командой, поэтому непрерывно анализирует процесс разработки и ищет способы по улучшению продукта. Эту роль может исполнять как человек со стороны заказчика, так и сотрудник нашей компании.</p>
									<br>
									<p>**бэклог – список задач для команды разработки, которые полностью описывают проект</p>
									<br>
									<p>Документ представляет собой иерархическую структуру из пользовательских возможностей и технических требований, упорядоченных по очередности реализации, более важный функционал будет реализован раньше остальных. Каждому элементу Бэклога присваиваться описание, порядковый номер, оценка объема работы и ценность. Это позволяет просчитать окончательную стоимость разработки всего продукта.</p>

									<p>Договор в первую очередь обеспечивает полную прозрачность проводимых работ для заказчика и позволяет ему контролировать процесс разработки на каждом этапе.Все этапы прописываются отдельно, что позволяет производить оплату выполненной работы по факту сдачи.</p>
									<p>Бэклог – гибкий документ, который позволяет Заказчику вносить даже серьезные изменения в продукт по ходу разработки, ведь большинство новаторских идей придумываются уже в ходе выполнения проекта. Дополнительный функционал оформляется в виде доп. соглашений к договору, в которых отмечается, сдвинет ли реализация вносимых изменений сроки завершения этапов проекта.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="cell">
							<div class="img-table-2">
								<img src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/for-Scheme/Scheme_4@2x.png" alt="Планирование спринта" class="img-schem-4">
							</div>
						</div>
						<div class="cell text-cell">
							<h3>4. Планирование спринта</h3>
							<p>
								Определение вместе с клиентом тех задач, которые необходимо реализовать на предстоящем спринте.
							</p>
							<div class="question-table">
								<div class="tooltipz tool2">
									<p><strong>Планирование спринта</strong></p>
									<p>Сердцем Scrum* является Спринт** длительностью в одну или две недели, в течение которых создается потенциально готовая к выпуску и использованию часть продукта. </p>
									<br>
									<p>*Scrum – гибкая методология разработки, по который мы ведем проекты</p>
									<p>** Спринт-этап в рамках которого реализуется определенная часть проекта</p>
									<br>
									<p>Обычно длительность Спринта является постоянной на протяжении всего периода разработки. Следующий Спринт начинается сразу же по окончании предыдущего.</p>
									<p>Спринт состоит из списка того, какие функции нужно разработать и гибкого плана, служащего ориентиром в работе по проекту. Ресурсом для планирования спринта является Бэклог Продукта.</p>
									<p>Объем работ на предстоящий Спринт определяется во время планирования Спринта в ходе совместной работы всей команды.</p>
									<p>При планировании Спринта команда отвечает на следующие вопросы:</p>
									<p>•	Цель Спринта, или каков будет результат выполнения запланированных на него работ?</p>
									<p>•	Как будет выполняться разработка?</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="table nth-5">
					<div class="row">
						<div class="cell">
							<div class="img-table-3">
								<img src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/for-Scheme/Scheme_5@2x.png" alt="Ретроспектива" class="img-schem-5">
							</div>
						</div>
						<div class="cell text-cell">
							<h3>5. ретроспек&shy;тива</h3>
							<p>
								Завершение спринта и демонстрация клиенту результатов за неделю. Команда инспектирует себя, выявляет успешные решения/ошибки и решает вопрос о необходимых улучшениях.
							</p>
							<div class="question-table">
								<div class="tooltipz tool2">
									<p><strong>Ретроспектива спринта</strong></p>
									<p>Каждый день в течение Спринта в определенное время проходят Скрам митинги - 15-минутные встречи/созвоны для команды разработчиков с целью синхронизации действий и создания плана работы на ближайшие 24 часа.</p>
									<p>В конце Спринта, после демонстрации Заказчику результата работы, команда проводит ретроспективу. Ретроспектива дает команде возможность инспектировать себя и определить успешные/неудачные моменты работы. И что самое важное, в процессе ретроспективы команда находит пути улучшения качества разрабатываемого продукта и применяет их в течение следующего Спринта.</p>
								</div>
							</div>
							<div class="h-24-ouner">
								<p class="title">24 часа</p>
								<p class="desc">Каждый день команда отчи -тывается продукт-оунеру о выполненных задачах.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="table">
					<div class="row">
						<div class="cell clear-margin-bottom">
							<div class="img-table-4">
								<img src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/for-Scheme/Scheme_6@2x.png" alt="Завершение" class="img-schem-6">
							</div>
						</div>
						<div class="cell text-cell clear-margin-bottom">
							<h3>6. Завершение</h3>
							<p>
								Завершение спринта и демонстрация клиенту результатов за неделю. Команда инспектирует себя, выявляет успешные решения/ошибки и решает вопрос о необходимых улучшениях.
							</p>
							<!-- <div class="question-table">
								<div class="tooltipz tool2">
									<p><strong>Идея и консультация</strong></p>
									<p>
										Почти всегда идея, с которой клиенты приходят к нам, требует аналитики и доработки. Эта работа необходима, чтобы на старте четко понимать, что мы имеем и в каком направлении двигаться, а также, чтобы продумать стратегию создания лучшего продукта.
										<br><br>На этом этапе мы проводим аналитику рынка приложений/веб-сервисов по выбранной тематике, выявляем лидеров и находим примеры плохой реализации, определяем критерии их успеха или провала. Мы изучаем продукты конкурентов с точки зрения интерфейсных решений, ориентирования на конечного пользователя, выполнения сервисом своих целей и задач и выявляем их преимущества и недостатки.
										<br><br>Полученные знания проецируем на будущее приложение, формируем представление о конечном продукте, о пользователях и их целях, и в результате получаем видение будущего проекта, зафиксированное в документе - project vision.
										<br><br>После консультации с нашим специалистом у Вас появится точное понимание, как сделать так чтобы проект выстрелил.
										<br><br>Приступаем к работе!
									</p>
								</div>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="projects-done">
		<div class="container-960">
			<div class="projects-done-block">
				<h2>Разработанные проекты</h2>
				<div class="projects-done-require-btn">
					<a href="" data-toggle="modal" data-target="#modal-2" class="btn corporate-btn btn-black-white">оставить заявку</a>
				</div>
				<div class="proj-content">
					<div class="proj-item">
						<span class="title">CRM/ERP для аудита супервайзерами и <br>тайными покупателями в торговых точках</span>
						<span class="text">CRM система содержит базы точек проведения аудита, исполнителей. Инструмент для формирования заданий/ опросов и сводных отчетов по результатам проверок. Позволяет оценивать качество работы, выявлять нарушения на местах. В рамках ERP системы были реализованы модули “Финансы” и “Отчетность”. </span>
					</div>
					<div class="proj-item">
						<span class="title">CRM/ERP для службы <br>помощи призывникам</span>
						<span class="text">Сохраняется вся история взаимодействия клиента и исполнителя. Выстраиваемые по заданным параметрам воронки продаж. Интеграция с call-центром, sms и email – шлюзами. Настройки CRM системы позволяют разбить многоуровневый процесс продаж на короткие этапы. Встроенная финансовая аналитика. Аналитика производства позволяет оценивать качество работы как с отдельно взятым клиентом, так и с группой клиентов в целом исходя из заданных параметров.</span>
					</div>
					<div class="proj-item">
						<span class="title">CRM для службы <br>такси</span>
						<span class="text">Реализован интерфейс для управление процессами внутри службы и работы оператора с заказами.</span>
					</div>
					<div class="proj-item">
						<span class="title">CRM для службы доставки еды</span>
						<span class="text">Дополнительно к мобильному приложению и сайту доставки еды мы осуществили разработку CRM системы для работы с поступающими заказами: формирование заказов, хранение данных клиентов, статусная модель, передача заявки на доставку.</span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="our-advantages">
		<div class="advantages-block">
			<h2>НАШИ ПРЕИМУЩЕСТВА</h2>
			<div class="advantages-list">
				<div class="advantage">
					<img src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/crm/ic-advantages-01.svg">
					<span class="title">Индивидуальное решение</span>
					<span class="text">Разработка под процессы вашего бизнеса и существующую инфраструктуру компании.</span>
				</div>
				<div class="advantage">
					<img src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/crm/ic-advantages-02.svg">
					<span class="title">Интеграция</span>
					<span class="text">Интеграция с используемыми решениями и продуктами.</span>
				</div>
				<div class="advantage">
					<img src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/crm/ic-advantages-03.svg">
					<span class="title">Надежная защита данных</span>
					<span class="text">Данные будут храниться на ваших серверах и передаваться в зашифрованном виде.</span>
				</div>
				<div class="advantage">
					<img src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/crm/ic-advantages-04.svg">
					<span class="title">Неограниченное число юзеров</span>
					<span class="text">Исходные коды и права на систему будут принадлежать вам. При росте бизнеса, не будете платить за дополнительных пользователей.</span>
				</div>
				<div class="advantage">
					<img src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/crm/ic-advantages-05.svg">
					<span class="title">Обучение <br>персонала</span>
					<span class="text">После внедрения будет проведено обучение ваших сотрудников.</span>
				</div>
				<div class="advantage">
					<img src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/crm/ic-advantages-06.svg">
					<span class="title">Дальнейшее сопровождение</span>
					<span class="text">В разрабатываемых CRM и ERP проектах будет предусмотрена возможность доработки при появлении новых целей и задач.</span>
				</div>
			</div>
		</div>
	</section>

	<section class="tech-stack">
		<div class="the-stack">
			<h2>Наш технологический стек</h2>
			<div class="stack-text-block">
				<span class="stack-text">Мы работаем с хорошо зарекомендовавшими себя технологиями: HTML5, CSS3, JS, jQuery, PHP, MySQL, Java и Angular js.</span>
			</div>
			<div class="techlist">
				<img class="iconTech" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-01.jpg">
				<img class="iconTech" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-02.jpg">
				<img class="iconTech" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-03.jpg">
				<img class="iconTech" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-04.jpg">
				<img class="iconTech" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-05.jpg">
				<img class="iconTech" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-06.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-07.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-08.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-09.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-10.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-11.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-12.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-13.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-14.svg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-15.svg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-16.svg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-17.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-18.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-19.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-20.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-21.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-22.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-23.jpg">
				<img class="iconTech addTopMargin" src="<?php echo get_template_directory_uri(); ?>/infoshell_new/img/corporate/ic-teh-24.jpg">
			</div>
		</div>
	</section>


	<section class="section-block bg-slider-1 block-request">
		<div class="container">
			<div class="center-aligned">
				<h3 class="section-header-dark">СКОЛЬКО СТОИТ РАЗРАБОТКА CRM ИЛИ ERP СИСТЕМЫ?</h3>
				<p class="section-text-dark">Стоимость разработки рассчитывается индивидуально. Расскажите нам про проект в любой удобной форме, и мы оперативно вышлем коммерческое предложение.</p>
			</div>
		</div>
		<!-- /container-->
		<div class="container">
			<noindex>
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