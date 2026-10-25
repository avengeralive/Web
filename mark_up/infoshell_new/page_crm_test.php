<!DOCTYPE html>
<!-- /*
Template Name: Страница "CRP, ERP системы TEST"
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
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/media.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/crm.css" />
	<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/css/crm-media.css" />
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
	<header class="header-crm">
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
				<h1>Индивидуальная разработка <br>CRM и ERP систем</h1>
				<div class="request-button">
					<a href="" data-toggle="modal" data-target="#modal-2" class="btn corporate-btn btn-yellow">оставить заявку</a>
				</div>
			</div>
		</div>
	</header>

	<section class="introduction">
		<div class="container-960">
			<div class="first-title">
				<span>Мы разрабатываем CRM и ERP системы, которые на 100% подходят бизнесу наших клиентов. Помогаем автоматизировать работу, когда “коробочные” решения не применимы в рамках оригинальных бизнес процессов. Решаем любые задачи, интегрируем со сторонними информационными системами. Возможна разработка CRM-системы, как составного элемента существующей ERP-систем.</span>	
			</div>
			<div class="second-title">
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
								<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/for-Scheme/Scheme_1@2x.png" alt="Идея веб-проекта и консультация" class="img-schem-1">
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
								<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/for-Scheme/Scheme_2@2x.png" alt="Оценка проекта и предложение" class="img-schem-2">
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
								<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/for-Scheme/Scheme_3@2x.png" alt="Бэклог и договор на веб - разработку" class="img-schem-3">
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
								<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/for-Scheme/Scheme_4@2x.png" alt="Планирование спринта" class="img-schem-4">
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
								<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/for-Scheme/Scheme_5@2x.png" alt="Ретроспектива" class="img-schem-5">
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
								<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/for-Scheme/Scheme_6@2x.png" alt="Завершение" class="img-schem-6">
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
					<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/crm/ic-advantages-01.svg">
					<span class="title">Индивидуальное решение</span>
					<span class="text">Разработка под процессы вашего бизнеса и существующую инфраструктуру компании.</span>
				</div>
				<div class="advantage">
					<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/crm/ic-advantages-02.svg">
					<span class="title">Интеграция <br>СИСТЕМЫ</span>
					<span class="text">Интеграция с используемыми решениями и продуктами.</span>
				</div>
				<div class="advantage">
					<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/crm/ic-advantages-03.svg">
					<span class="title">Надежная защита данных</span>
					<span class="text">Данные будут храниться на ваших серверах и передаваться в зашифрованном виде.</span>
				</div>
				<div class="advantage">
					<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/crm/ic-advantages-04.svg">
					<span class="title">Неограниченное число юзеров</span>
					<span class="text">Исходные коды и права на систему будут принадлежать вам. При росте бизнеса, не будете платить за дополнительных пользователей.</span>
				</div>
				<div class="advantage">
					<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/crm/ic-advantages-05.svg">
					<span class="title">Обучение <br>персонала</span>
					<span class="text">После внедрения системы будет проведено обучение ваших сотрудников.</span>
				</div>
				<div class="advantage">
					<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/crm/ic-advantages-06.svg">
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