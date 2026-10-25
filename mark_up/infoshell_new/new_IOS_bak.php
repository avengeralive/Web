<!DOCTYPE html>
<!-- /*
Template Name: Страница "Новыя IOS"
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
	<title>Разработка приложений для iOS - iPhone, iPad</title>
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
	<link href="https://infoshell.ru/wp-content/themes/mark_up/css1/formCorrections.css" rel="stylesheet">
	<link href="https://infoshell.ru/wp-content/themes/mark_up/css1/main.css?1439406648325" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&amp;subset=latin,cyrillic" rel="stylesheet">
	<link href="https://infoshell.ru/wp-content/themes/mark_up/css1/main.css?1439406648325" rel="stylesheet">
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
<body class="body-ios">
	<header class="header-ios">
		<div class="nav-ios">
			<div class="container-960">
				<a href="/" class="logo-header-ios"><img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/header-logo.png" alt="Инфошелл"></a>
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
					<a id="ZAKAZ_ZVONKA" href="#" onclick="clik_show()" data-toggle="modal" data-target="#modal-1" class="btn-call-me"><span>Заказать<br> звонок</span></a>
				</div>
				<a href="/services/" class="all-services"> <i class="fa fa-long-arrow-left"></i> Все услуги</a>
			</div>		
		</div>
		<div class="container-960">
			<div class="header-ios-title clearfix">
				<span style="font-size: 50px">Разработка приложений<br>
				 для iOS: iPhone, iPad и Apple Watch</span>
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
	<section class="section-1-ios text-black">
			<div class="container-960" itemscope itemtype="http://schema.org/Service">
				<div class="content-index">
					 <h1 class="noBorderTop" itemprop="serviceType">Разработка мобильных приложений для iOS</h1>
					<p itemprop="description">Команда Infoshell предлагает создание приложений для iPhone, iPad с учетом индивидуальных требований бизнеса. Мы осуществляем разработку для iOS в соответствии с маркетинговой политикой компаний-заказчиков.
Получите у менеджеров Infoshell консультацию. Вам станет понятно, нужно ли вам мобильное приложение и какое приложение необходимо: на <a title="Разработка для Android на заказ" href="/developing-for-android-os/">Android</a> или iOS. Оставив заявку на создание приложений для iPhone, вы получите готовые решения по автоматизации бизнеса, а по истечению оговоренного срока - готовое приложение.
</p>
				</div>
			</div>		
	</section>

<script type="application/ld+json">{
"@context": "http://schema.org/","@type": "Product",
"name": "Разработка приложений под iOS",
"description": "В студии Infoshell вы можете заказать разработку приложений для мобильных устройств iOS. Профессиональные разработчики приложений, портфолио, стоимость. Контакты в Москве и Санкт-Петербурге ☎ +7 (495) 215-51-82",
"image": "https://infoshell.ru/wp-content/themes/mark_up/images/logo.jpg"
}</script>



<section class="section-2-ios">
	<div class="container-960">
	  <h2 class="h2za">Мы делаем:</h2>
	  <div class="item-s2-ios">	
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-1 icon-item"></div>
		  	</div>
		 		<p>Приложения для любой сферы бизнеса: ритейл, HoReCa, спортивные клубы и др.</p>
		  </div>
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-2 icon-item"></div>
		  	</div>
		 		<p>Банковские клиенты и другие приложения для сферы финансов</p>
		   </div>
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-3 icon-item"></div>
		  	</div>
		 		<p>Lifestyle-приложения</p>
		   </div>
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>	
		  		<div class="icon-item-4 icon-item" style="margin-left: -15px;"></div>
		  	</div>
		 		<p>Мобильные социальные сети и программы для общения</p>
		  </div>
	  </div>
	</div>
</section>
<section class="section-3-ios">
	<div class="container-960">
		<h3 class="h2za">Этапы создания iOS приложений</h3>
		<div class="tables">
			<div class="table">
				<div class="row">
					<div class="cell before-idea">
						<div class="img-table-1">						
							<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/for-Scheme/Scheme_1@2x.png" alt="Идея приложения и консультация" class="img-schem-1">
						</div>
					</div>
					<div class="cell text-cell">
						<h3>1. Идея приложения и консультация</h3>
						<p>
							Люди приходят к нам в компанию, чтобы воплотить в жизнь свою идею и автоматизировать бизнес-процессы. Мы предоставляем бесплатную консультацию у аналитика InfoShell и доработку идейной 
							составляющей проекта.
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
							Оценку проекта производит команда разработчиков. После чего клиент 
							получает предварительное коммерческое предложение.
						</p>
						<div class="question-table">
							<div class="tooltipz tool2">
								<p><strong>Оценка проекта и предложение</strong></p>
								<p>После составления project vision проекта наша команда разработчиков оценивает примерные трудозатраты на реализацию продукта. Исходя из поставленных задач и технологических ограничений, составляется оценка количества часов, необходимых на создание вашего продукта.</p>
								<p>На основе полученной оценки формируется предварительное коммерческое предложение, в которое входит описание похожих проектов, реализованных нашей компанией, состав команды разработчиков и профессиональный уровень каждого участника,  стоимость всего проекта с разбиением на этапы.</p>
								<p>На коммерческом предложении в дальнейшем будет основан договор.</p>
							</div>
						</div>	
												
					</div>
				</div>
				<div class="row">
					<div class="cell">
						<div class="img-table-1">						
							<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/for-Scheme/Scheme_3@2x.png" alt="Бэклог и договор" class="img-schem-3">
						</div>
					</div>
					<div class="cell text-cell">
						<h3>3. Бэклог и договор</h3>
						<p>
							Встреча с продукт-оунером, обсуждение деталей проекта. Команда 
							разрабатывает бэклог на весь проект совместно с заказчиком. После утверждения бэклога, с заказчиком подписывается договор.
						</p>
						<div class="question-table">
							<div class="tooltipz tool2">
								<p><strong>Бэклог и договор</strong></p>
								<p>Далее, команда разработчиков вместе с продукт оунером (Product Owner)* и Заказчиком составляет второй единый документ приложения - Бэклог Продукта**.</p>
								<br>
								<p>* продукт оунер – руководитель проекта</p>
								<br>
								<p>Ответственность за содержимое бэклога, его упорядочение и доступность всем членам проекта несет Product Owner. Он также ответственен за достижение максимальной ценности продукта и работы, выполняемой командой, поэтому непрерывно анализирует текущий ход работ над продуктом и ищет способы по улучшения его. Эту роль может исполнять как человек со стороны заказчика, так и сотрудник нашей компании.</p>
								<br>
								<p>**бэклог – список задач для команды разработчиков, которые полностью описывают проект</p>
								<br>
								<p>Документ представляет собой иерархическую структуру из пользовательских возможностей и технических требований, упорядоченных по очередности реализации, более важный функционал будет реализован раньше остальных. Каждому элементу Бэклога присваиваться описание, порядковый номер, оценка объема работы и ценность. Это позволяет просчитать окончательную стоимость продукта.</p>

								<p>Договор в первую очередь обеспечивает полную прозрачность проводимых работ для заказчика и позволяет ему контролировать процесс от А до Я на каждом этапе. Все этапы прописываются отдельно, что позволяет производить оплату выполненной работы по факту сдачи.</p>
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
							Договоренность с заказчиком о том, какие задачи будут 
							выполнены на ближайшем спринте.
						</p>
						<div class="question-table">
							<div class="tooltipz tool2">
								<p><strong>Планирование спринта</strong></p>
								<p>Сердцем Scrum* является Спринт** длительностью в одну или две недели, в течение которых создается потенциально готовая к выпуску и использованию часть продукта. </p>
								<br>
								<p>*Scrum – гибкая методология создания, по который мы ведем проекты</p>
								<p>** Спринт-этап в рамках которого реализуется определенная часть проекта</p>
								<br>
								<p>Обычно длительность Спринта является постоянной на протяжении всего периода разработки. Следующий Спринт начинается сразу же по окончании предыдущего.</p>
								<p>Спринт состоит из списка того, какие функции нужно разработать и гибкого плана, служащего ориентиром в работе по проекту. Ресурсом для планирования спринта является Бэклог Продукта.</p>
								<p>Объем работ на предстоящий Спринт определяется во время планирования Спринта в ходе совместной работы всей команды.</p>
								<p>При планировании Спринта команда отвечает на следующие вопросы:</p>
								<p>•	Цель Спринта, или каков будет результат выполнения запланированных на него работ?</p>
								<p>•	Как будет выполняться программирование?</p>
							</div>
						</div>				
					</div>
				</div>
			</div>
			<div class="table nth-5">
				<div class="row">
					<div class="cell">
						<div class="img-table-3">						
							<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/for-Scheme/Scheme_5@2x.png" alt="ретроспектива" class="img-schem-5">
						</div>
					</div>
					<div class="cell text-cell">
						<h3>5. ретроспектива</h3>
						<p>
							Демонстрация заказчику результатов за неделю. Команда 
							анализирует риски и проблемы, завершает спринт, оптимизирует дальнейший процесс разработки.
						</p>
						<div class="question-table">
							<div class="tooltipz tool2">
								<p><strong>Ретроспектива спринта</strong></p>
								<p>Каждый день в течение Спринта в определенное время проходят Скрам митинги - 15-минутные встречи/созвоны для команды разработчиков с целью синхронизации действий и создания плана работы на ближайшие 24 часа.</p>
								<p>В конце Спринта, после демонстрации Заказчику результата работы, команда проводит ретроспективу. Ретроспектива дает команде возможность инспектировать себя и определить успешные/неудачные моменты работы. И что самое важное, в процессе ретроспективы команда находит пути улучшения качества разрабатываемого продукта и применяет их в течение следующего Спринта.</p>
							</div>
						</div>						
						<div class="h-24-ouner">
							<p>24 часа</p>
							<p>Каждый день команда отчи -тывается продукт-оунеру о выполненных задачах.</p>
							<p class="text-small">отчётность команды продукт-оунеру</p>
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
							Клиент получает готовое приложение, которое поможет ему достигнуть поставленных целей.
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
						</div>	 -->										
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section-4-ios">
	<h3 class="h2za">Заказать iOS разработку у нас</h3>
	<div class="container-1450 item-s4">
		<div class="items-s4">
			<div class="image-s4"></div>
			<p>более 50 реализованных<br> ios-приложений</p>
			<p>Мы разрабатываем приложения разных типов: от корпоративных бизнес-приложений до социальных сетей и игр, от приложений по автоматизации до банковских клиентов.</p>
		</div>
		<div class="items-s4">
			<div class="image-s4"></div>
			<p>Звездная<br>команда</p>
			<p>У нас слаженный коллектив программистов высшего уровня, разработавших вместе большое количество проектов.</p>
		</div>
		<div class="items-s4">
			<div class="image-s4"></div>
			<p>ориентация на<br>цели заказчика</p>
			<p>Наша главная задача – помочь клиенту решить его проблемы и задачи. Мы индивидуально подходим к каждому проекту и разрабатываем именно то, что поможет нашему заказчику достигнуть поставленных целей.</p>
		</div>
		<div class="items-s4">
			<div class="image-s4"></div>
			<p>Успешный опыт<br>и надежность</p>
			<p>Большой опыт продвижения продуктов в ТОП AppStore. С нами сотрудничают такие компании как ФК Зенит, Faberlic, Radio Record и другие известные бренды.</p>
		</div>
	</div>
</section>
<section class="section-5 text-black">
	<noindex>
		<h3 class="h2za">Сколько стоит iOS приложение?</h3>
	<div class="container-960">
		<p>Стоимость каждого мобильного приложения для iOS рассчитывается индивидуально. Для того чтобы узнать примерную стоимость приложения, кратко опишите его суть, ваши ожидания или пожелания.</p>	
		<div class="form-s5">
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
							<div class="submit-btn">
								<span class="btn btn-black contactFormSubmit">Узнать цену</span>
							</div>
						</div>
						<!-- /control-group-->
					</div>
		</div>
	</div>
	</noindex>
</section>
<section class="section-6">
	<h3 class="h2za">Наши лучшие работы</h3>
	<div class="container-960">
	<div class="prev_button"><i class="fa fa-angle-left"></i></div> <!-- кнопки -->
	<div class="next_button"><i class="fa fa-angle-right"></i></div> <!-- кнопки -->
	<div class="content-item-s6" id="owl-job" itemscope itemtype="http://schema.org/ItemList">
		<?php
			$posts = get_posts(array(
				'category_name'=>'rp_ios',
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
<div class="container-960">
	<div class="line-after-sec-6">
	</div>
</div>
<noindex>
		<section class="section-7">
	<div class="container-960">
		<h3 class="h2za">Отзывы заказчиков</h3>
		<div class="arrows">	
			<div class="prev_button2"><i class="fa fa-angle-left"></i></div> <!-- кнопки -->
			<div class="next_button2"><i class="fa fa-angle-right"></i></div> <!-- кнопки -->
		</div>
		<div class="otz-item-s7 swiper-container">
			<div class="otz-body swiper-wrapper">
			<?php $posts = get_posts('category_name=testimonials&posts_per_page=10&orderby=rand');
                            foreach( $posts as $post ) {

                               $image = get_field('avatar'); ?>
				<div class="o_item swiper-slide">
					<div class="text-reviews">
						<p>
							<?php echo $post->post_content; ?>
						</p>
						<p></p>
					</div>
					<div class="user-reviews">
						<img src="<?php echo $image['url']; ?>" alt="<?=get_the_title($post)?>">
						<p>
							<?php echo $post->post_title; ?>
						</p>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="all-reviews"><a href="/company/" class="">все отзывы и письма</a></div>
	</div>
</section>
</noindex>			
<section class="section-8-ios">	
	<div class="container-960">
		<h3 class="h2za">Преимущества разработки приложений для iOS</h3>

		<div class="items-s8-ios">
			<div class="col-item-6">
				<div class="image-s8-ios">
				</div>
				<div class="text-s8-ios">
						Россия на 9 месте по доходу с 
						iOS-приложений и на 5 месте по числу 
						загрузок в AppStore.*
				</div>
			</div>
			<div class="col-item-6">
				<div class="image-s8-ios">
				</div>
				<div class="text-s8-ios">
					На апрель 2016 года россияне купили 
					и используют почти 10 млн IPhone различных поколений и 3 млн IPad (итого 13 млн устройств 
					в России).
				</div>
			</div>
			<div class="col-item-6">
				<div class="image-s8-ios">
				</div>
				<div class="text-s8-ios">
					10 млрд. $ – выручка разработчиков за 2017 год.*
				</div>
			</div>
			<div class="col-item-6">
				<div class="image-s8-ios">
				</div>
				<div class="text-s8-ios">
					30 млрд $ - общая сумма выручки 
					создателей мобильных приложений за всю историю существования 
					магазина.*
				</div>
			</div>
			<div class="col-item-6">
				<div class="image-s8-ios">
				</div>
				<div class="text-s8-ios">
					Каждую секунду из магазина 
					загружается около 850 программ 
					и игр для iPhone и iPad.*
				</div>
			</div>
			<div class="col-item-6">
				<div class="image-s8-ios">
				</div>
				<div class="text-s8-ios">
					Более платежеспособная аудитория: AppStore приносит на 70% больше 
					доходов чем Google Play.*
				</div>
			</div>
		</div>
		<div class="dannye-apple">	
			<p class="">*по данным AppAnnie на конец 2017 года</p>
		</div>
	</div>
</section>
<noindex>
<section class="section-9-ios">
	<div class="container-960">
		<h3 class="h2za">Полезные материалы об iOS приложениях</h3>
		<div class="prev_button1"><i class="fa fa-angle-left"></i></div> <!-- кнопки -->
		<div class="next_button1"><i class="fa fa-angle-right"></i></div> <!-- кнопки -->
		<div class="items-s9-ios" id="owl-news">
		<?php
						$posts = get_posts(array(
							'category_name'=>'blog_ios',
							'orderby'=>'date',
							'posts_per_page'=>10,
							'order'=>'DESC'
						));

					foreach($posts as $post) {
						setup_postdata($post);
						$id = get_the_ID();
						$attachmentId = get_post_thumbnail_id($id);
                        $src = wp_get_attachment_image_src($attachmentId, 'blog_small');
						?>
			<div class="item-s9-ios col-items-4">
				<div class="image-s9-ios">
					<div style="background-image: url(<?php echo $src[0]; ?>)" class="blog-entry--image"><a href="<?php the_permalink(); ?>"></a></div>
					<img class="news-s9-ios" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/news.png" style="width:inherit" height="60" width="60" alt="<?php the_title(); ?>">
				    <a href="<?php the_permalink(); ?>"></a>
				</div>
				<div class="text-s9-ios">
					
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<p class="blog-entry--text"><?php echo get_the_excerpt(); ?></p>
					<span><?php the_time('j F y'); ?></span>
				</div>
			</div>
			<?php } ?>
			
	</div>
			
		
		<div class="mobile-items">
		
		<?php
						$posts = get_posts(array(
							'category_name'=>'blog_ios',
							'orderby'=>'date',
							'posts_per_page'=>3,
							'order'=>'DESC'
						));

					foreach($posts as $post) {
						setup_postdata($post);
						$id = get_the_ID();
						$attachmentId = get_post_thumbnail_id($id);
                        $src = wp_get_attachment_image_src($attachmentId, 'blog_small');
						?>
			<div class="mob-item" style="background-image: url(<?php echo $src[0]; ?>);">
				<div class="text-s9-ios">
					<a style="font-size: 15px" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<p><?php echo get_the_excerpt(); ?></p>
					<span><?php the_time('j F y'); ?></span>
				</div>
				<img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/news-icon-m.png" height="30" width="30" alt="Новости">
			</div>
			<?php } ?>
		</div>
	</div>
</section>
</noindex>
<footer class="footer-ios">
	<div class="container-960">
		<div class="left-f-ios">
			<div class="f-ios-logo">
				<a href="https://infoshell.ru"><img src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/logo-footer.png" height="45" width="45" alt="infoshell"></a>
			</div>
			<a href="https://infoshell.ru/files/InfoShell.pdf" class="preza-f-ios">
				Скачать презентацию
			</a>
		</div>
		<div class="right-f-ios">
			<div>+7 (495) 215-51-82 (Мск)</div>
			<div>+7 (812) 242-80-58 (СПб)</div>
			<a id="ZAKAZ_ZVONKA_BOTTOM" href="#" class="b-okno" ><i class="fa fa-phone"></i> Заказать звонок</a>
		</div>
	</div>
</footer>
	<!--[if lt IE 9]>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/es5-shim.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/html5shiv.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/respond/respond.min.js"></script>
	<![endif]-->
<script src="https://infoshell.ru/wp-content/themes/mark_up/js/main.js"></script>
<script src="https://infoshell.ru/wp-content/themes/mark_up/js1/main.js"></script>
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