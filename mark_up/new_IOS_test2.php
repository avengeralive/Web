<?php require 'index.config.php'; ?>
<!DOCTYPE html>
<!-- /*
Template Name: Страница "Новая дизайн3"
*/ -->
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>UX дизайн, разработка UX дизайна</title>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/favicon.png" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/libs/font-awesome-4.2.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/libs/fancybox/jquery.fancybox.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/libs/owl-carousel/owl.carousel.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/libs/countdown/jquery.countdown.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/css/fonts.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/css/main.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/css/main2.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/css/media.css" />
        <link href="<?php echo get_template_directory_uri(); ?>/css/new-style-header.css?v=1" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri(); ?>/css/new-style-footer.css?v=1" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri(); ?>/css/new-style-service.css?v=1" rel="stylesheet">
        <script src="<?php echo get_template_directory_uri(); ?>/js/infoshell2_main.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js1/main.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js1/main2.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js1/ajaxForms.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&amp;subset=latin,cyrillic" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;subset=cyrillic" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri(); ?>/css1/formCorrections.css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri(); ?>/css1/main.css?1439406648325" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/infoshell_new/css/corporate.css">
        <script src="<?php echo get_template_directory_uri(); ?>/js/library.js"></script>
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
</head>
<body class="body-ios">
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
                    <li><a class="infoshel-header__container-socialNetworks-vcru infoshel-header__container-socialNetworks-icon" href="<?php echo $socialUrl['vc.ru'];?>" target="_blank"></a></li>
                </ul>
            </div>

            <div class="infoshel-header__container-phones">
                <p>Мск:<?php echo $contacts['moskow']['tel'];?></p>
                <p>СПб:<?php echo $contacts['piter']['tel'];?></p>
            </div>

        </div>
    </div>
</header>
<div class="side-menu">
    <div class="side-menu__header">
        <a class="side-menu__header-logo" href="<?php bloginfo('url'); ?>">
            <img src="<?php echo $templateDir;?>/img/infoshell2/main.svg" alt="">
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
    <div class="side-menu__social-links">
        <a class="side-menu__social-link side-menu__social-link-vk" href="<?php echo $socialUrl['vk'];?>" target="_blank"></a>
        <a class="side-menu__social-link side-menu__social-link-fb" href="<?php echo $socialUrl['fb'];?>" target="_blank"></a>
        <a class="side-menu__social-link side-menu__social-link-dr" href="<?php echo $socialUrl['dr'];?>" target="_blank"></a>
        <a class="side-menu__social-link side-menu__social-link-bh" href="<?php echo $socialUrl['bh'];?>" target="_blank"></a>
    </div>
</div>
<div class="header-ios">
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
				<a href="/services" class="all-services"> <i class="fa fa-long-arrow-left"></i> Все услуги</a>
			</div>

		</div>
		<div class="container-960">
			<div class="header-ios-title clearfix">
				<h1>Важен каждый пиксель</h1>
				<span>У Вас есть всего несколько секунд, чтобы произвести впечатление на пользователя</span>
			</div>
		</div>
	</div>
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
	<section class="section-1-ios text-black new-d">
			<div class="container-960">
				<div class="content-index">
					<h2 class="h2za">проектирование, юзабилити-аналитика, дизайн</h2>
					<p>
						Улучшая опыт взаимодействия пользователя с продуктом, мы решаем бизнес-проблемы заказчика: уменьшаем отток клиентов, повышаем конверсию и укрепляем лояльность. Чтобы создавать отличные пользовательские интерфейсы, мы объединили UI и UX дизайн. Опытная команда дизайнеров и проектировщиков InfoShell убедится, что Ваш продукт будет не только удобным и интуитивно понятным пользователю, но также функциональным и стильным.
					</p>
				</div>
			</div>
	</section>



<section class="section-2-ios new-d">
	<div class="container-960">
	  <h2 class="h2za">UX & UI-design</h2>
	  <div class="item-s2-ios">
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>
		  		<div class="icon-item-1 icon-item"></div>
		  	</div>
		  		<h4>web-дизайн</h4>
		 		<p>Дизайн сайта - лицо компании. Наша команда создает дизайн, который подчеркнет индивидуальность бренда, акцентирует внимание на преимуществах услуг и продуктов.</p>
		  </div>
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>
		  		<div class="icon-item-2 icon-item"></div>
		  	</div>
		  		<h4>дизайн приложений</h4>
		 		<p>Дизайн способен привлечь или отпугнуть пользователя. Мы создаем привлекательные интерфейсы, которые увеличивают вовлеченность пользователей и повышают ценность вашего бренда.</p>
		   </div>
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>
		  		<div class="icon-item-3 icon-item"></div>
		  	</div>
		  		<h4>дизайн для гаджетов</h4>
		 		<p>Разрабатывая под носимые устройства, мы придаем особое внимание практичности и минимализму интерфейсов и фокусируемся на ключевых функциях продукта.</p>
		   </div>
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>
		  		<div class="icon-item-4 icon-item"></div>
		  	</div>
		  		<h4>проектирование интерфейсов</h4>
		 		<p>Мы понимаем ожидания и предпочтения потребителя и создаем user-friendly интерфейсы с учетом специфики конкретного бизнеса.</p>
		  </div>
		  <div class="items">
		  	<div class="image-icon">
		  		<div class="bg-image-icon"></div>
		  		<div class="icon-item-5 icon-item"></div>
		  	</div>
		  		<h4>юзабилити аудит</h4>
		 		<p>Наши специалисты проводят экспертный анализ продукта, прорабатывают сценарии работы приложения и взаимодействия пользователя с интерфейсом и формируют документ с рекомендациями по улучшению интерфейса.</p>
		  </div>
	  </div>
	</div>
</section>



<section class="section-3-des">
	<div class="container-960">
		<h2 class="h2za">ux и ui-дизайн мобильных приложений</h2>
		<div class="s3-part1">
			<div class="des-s3 it-1">
				<img alt="Apple Watch,iPhone & iPad Design" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/serv-ic-1-w.png">
				<h4>Apple Watch,<br>iPhone & iPad Design</h4>
				<p>Мы разработали множество приложений для спортивных клубов, ресторанов, социальных сетей, онлайн-магазинов, медицинских центров и других сфер бизнеса. Мы знаем, каким должно быть отличное iOS-приложение, и используем все имеющиеся функции для создания интересного и качественного продукта.</p>
			</div>
			<div class="des-s3 it-2">
				<img alt="Android Material App Design" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/serv-ic-2-w.png">
				<h4>Android Material<br>App Design</h4>
				<p>Разработав Material Design, компания Google запустила новый тренд в дизайне мобильных приложений. Мы можем создать Material Design Android-приложения с нуля, а также помочь Вам обновить существующий дизайн приложения, сделав его еще более современным и привлекательным для пользователей.</p>
			</div>
		</div>
	</div>
	<div class="s3-part2">
		<div class="s3-example-1"></div>
	</div>
</section>




<section class="section-4-des">
	<h2 class="h2za">Процесс работы</h2>
	<div class="container-960">
		<div class="process">
			<div class="help-process">
				<img alt="Примечания" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/help.png">
				<div class="help-body">
					<p>В основе отличного дизайна лежит понимание, для кого он создается. Сначала мы изучаем предметную область вашего бизнеса, собираем информацию о рынке и конкурентах, выделаем ключевые преимущества, отмечаем недостатки. Затем, анализируем ваших клиентов, их ожидания и потребности и в итоге находим высокотехнологичное решение поставленной задачи.</p>
				</div>
			</div>
			<img alt="Исследование и аналитика" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/Scheme_1@2x.png">
			<p>1. Исследование и аналитика</p>
		</div>
		<div class="soed-line"></div>

		<div class="process">
			<div class="help-process">
				<img alt="Примечания" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/help.png">
				<div class="help-body">
					<p>Сценарий– это описание того, как пользователь взаимодействует с продуктом для достижения своей цели в соответствующем контексте.</p>
					<p>Контекст использования оказывает серьезное влияние на впечатление от интерфейса.</p>
					<p>Разрабатывая сценарии, мы ставим себя на место людей в тех ситуациях, когда им требуется воспользоваться приложением или сайтом и выявляем наиболее важные особенности взаимодействия с будущим продуктом. От того как качественно продуманы сценарии в контексте, будет зависеть успех продукта в целом.</p>
				</div>
			</div>
			<img alt="Разработка сценариев взаимодействия с продуктом" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/Scheme_2@2x.png">
			<p>2. Разработка сценариев взаимодействия с продуктом</p>
		</div>
		<div class="soed-line"></div>

		<div class="process">
			<div class="help-process">
				<img alt="Примечания" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/help.png">
				<div class="help-body">
					<p>На этом этапе, используя полученные артефакты и элементы интерфейса (тексты, кнопки, блоки и многое другое), мы создаем прототип - визуальное представление интерфейса, наглядно демонстрирующее структуру и функционал приложения. Прототип будет работать почти как готовое приложение или web-сайт и позволит оценить и протестировать, как сервис будет взаимодействовать  с будущими пользователями. Нужно отметить, что прототип не включает в себя дизайн.</p>
				</div>
			</div>
			<img alt="Создание прототипа интерфейса" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/Scheme_3@2x.png">
			<p>3. Создание прототипа интерфейса</p>
		</div>
		<div class="soed-line anoth-line"></div>

		<div class="process">
			<div class="help-process">
				<img alt="Примечания" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/help.png">
				<div class="help-body">
					<p>Отдел дизайна предоставляет заказчику свое видение визуальной части проекта. После внесения правок клиент утверждает фирменный стиль продукта, цвета, шрифты. Мы обязательно тестируем дизайн интерфейса на восприятие пользователем, а также на грамотность цветовой схемы, правильность расстановки цветовых акцентов, читабельность шрифтов и размеры кликабельных элементов.</p>
				</div>
			</div>
			<img alt="Концепция дизайна и тестирование" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/Scheme_4@2x.png">
			<p>4. Концепция дизайна и тестирование</p>
		</div>
		<div class="soed-line"></div>

		<div class="process">
			<img alt="Отрисовка дизайна продукта по утвержденной концепции" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/Scheme_5@2x.png">
			<p>5. Отрисовка дизайна продукта по утвержденной концепции</p>
		</div>

	</div>
</section>


<section class="section-3-des des-sites">
	<div class="container-960">
		<h2 class="h2za">ux и ui-дизайн сайтов</h2>
		<div class="s3-part1">
			<div class="des-s3 it-1">
				<div class="s3-ic"><img alt="Веб-сайты и приложения" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/Web_1.svg"></div>
				<h4>Веб-сайты и приложения</h4>
				<p>Наша главная цель – создание уникального пользовательского опыта для посетителей. Именно он определяет, останется клиент на вашем ресурсе или уйдет к конкуренту. Мы индивидуально подходим к каждому проекту и делаем веб-сервисы максимально удобными для пользователей, уделяя внимание мельчайшим деталям интерфейса и дизайна.</p>
			</div>
			<div class="des-s3 it-2">
				<div class="s3-ic"><img alt="Лэндинги и промо-сайты" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/Web_2.svg"></div>
				<h4>Лэндинги и промо-сайты</h4>
				<p>Запускаете ли вы новый продукт или хотите привлечь больше пользователей на существующий сервис и увеличить продажи, команда InfoShell разработает именно то, что вам нужно. Мы создаем страницы в поддержку запуска продукта, промо-сайты, лидогенерирующие страницы, которые стимулируют рост конверсии.</p>
			</div>
			<div class="des-s3 it-3">
				<div class="s3-ic"><img alt="Сервера, админки" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/Web_3.svg"></div>
				<h4>Сервера, админки</h4>
				<p>Разрабатывая решения для управления информацией, мы ставим на первое место легкость и простоту их использования. Мы проектируем удобные и функциональные административные панели сайтов и мобильных приложений, CRM и ERP-системы с интуитивно понятной навигацией и наглядными интерфейсами.</p>
			</div>
		</div>
	</div>
	<div class="design-sites-ex"></div>
</section>


<section class="section-rukovod-des">
	<h2 class="h2za">Наши руководители UX и UI-отделов</h2>
	<div class="container-960">

		<div class="rukovoditeli ruk-1">
			<div class="foto-ruk"><img alt="Павел Макаров" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/Pavel@2x.png"></div>
			<div class="about-ruk">
				<div class="who-is-ruk">
					<h5>Павел Макаров</h5>
					<h6>Руководитель отдела аналитики</h6>
					<p>Стаж: 6 лет</p>
				</div>
				<p class="skills skill-1">Справедливый <strong>судья</strong> конкурсов мобильных приложений</p>
				<p class="skills skill-2"><strong>Автор</strong> аналитических обзоров приложений для banki.ru</p>
			</div>
		</div>

		<div class="rukovoditeli ruk-2">
			<div class="foto-ruk"><img alt="Мария Терешкова" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/Mariya@2x.png"></div>
			<div class="about-ruk">
				<div class="who-is-ruk">
					<h5>Мария Терешкова</h5>
					<h6>Арт-директор</h6>
					<p>Стаж: 8 лет</p>
				</div>
				<p class="skills skill-1"><strong>Лектор</strong> в школе программирования и дизайна</p>
				<p class="skills skill-2"><strong>Автор</strong> советов и рекомендаций дизайнеров на проф. ресурсах</p>
				<p class="skills skill-3">Участник молодежной <strong>выставки</strong>, выставлялось 12 работ тушью</p>
			</div>
		</div>

	</div>
</section>



<!--section class="section-5 text-black">
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

						<div class="control-group">
							<textarea rows="10" name="message" placeholder="Опишите, пожалуйста, проект.." class="inputbox full clear"></textarea>
							</div>

						<div class="control-group">
							<div class="attachment">
								<div class="attach-container">
									<div class="attach-file">
										<div class="icon Attach"></div><span class="attach-file-name">Добавить файл</span>
									</div>

									<input name="upload_file" type="file" class="attach-file-input">

								</div>
								<a href="" class="attach-reset">&times;</a>
							</div>
							<div class="submit-btn">
								<span class="btn btn-black contactFormSubmit">Узнать цену</span>
							</div>
						</div>
					</div>
		</div>
	</div>
	</noindex>
</section-->























<!-- CALC -->
<!--section class=""-->
<?php require __DIR__.'/../calc/calc.inc.html'; ?>
<!--/section-->























<section class="section-des-example">
	<div class="container-960">
		<h2 class="h2za">Лучшие разработанные дизайны приложений</h2>
		<div class="prev_button2"><img alt="указатель" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/arr-l.png"></div> <!-- кнопки -->
		<div class="next_button2"><img alt="указатель" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/arr-r.png"></div> <!-- кнопки -->
		<div class="content-item-s7" id="owl-reviews">
			<div class="item">
				<div class="des-ex-pic">
					<img alt="Spartakiada" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/des-ex-1.png">
				</div>
				<h3>Spartakiada</h3>
				<p>Android</p>
			</div>
			<div class="item">
				<div class="des-ex-pic">
					<img alt="Philarmonic" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/des-ex-2.png">
				</div>
				<h3>Philarmonic</h3>
				<p>iPhone</p>
			</div>
			<div class="item">
				<div class="des-ex-pic">
					<img alt="Паспорт кожи" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/des-ex-3.png">
				</div>
				<h3>Паспорт кожи</h3>
				<p>iPhone</p>
			</div>
			<div class="item">
				<div class="des-ex-pic">
					<img alt="Trussardi" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/des-ex-4.png">
				</div>
				<h3>Trussardi</h3>
				<p>iPhone</p>
			</div>
			<div class="item">
				<div class="des-ex-pic">
					<img alt="Tutu.ru" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/des-ex-5.png">
				</div>
				<h3>Tutu.ru</h3>
				<p>iPhone</p>
			</div>
			<div class="item">
				<div class="des-ex-pic">
					<img alt="Faberlic" src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/des-ex-6.png">
				</div>
				<h3>Faberlic</h3>
				<p>iPhone, iPad, Android</p>
			</div>
		</div>
	</div>
</section>


<section class="section-community">
	<h2 class="h2za">Infoshell в дизайнерских сообществах:</h2>
	<div class="container-960">
		<div class="community com-1"><a href="https://dribbble.com/InfoShell"><img alt="dribbble" src ="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/com-1.png"></a></div>
		<div class="community com-2"><a href="https://www.behance.net/infoshell"><img alt="behance" src ="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/img/com-2.png"></a></div>
	</div>
</section>
<noindex>
<section class="section-9-ios">
	<div class="container-960">
		<h2 class="h2za">Полезные материалы о дизайне и юзабилити</h2>
		<div class="prev_button1"><i class="fa fa-angle-left"></i></div> <!-- кнопки -->
		<div class="next_button1"><i class="fa fa-angle-right"></i></div> <!-- кнопки -->
		<div class="items-s9-ios" id="owl-news">
		<?php
						$posts = get_posts(array(
							'category_name'=>'blog_design',
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
							'category_name'=>'blog_design',
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
			<a id="ZAKAZ_ZVONKA_BOTTOM" href="#" class="b-okno"><i class="fa fa-phone"></i> Заказать звонок</a>
		</div>
	</div>
</footer>
	<!--[if lt IE 9]>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/es5-shim.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/html5shiv.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="https://infoshell.ru/wp-content/themes/mark_up/infoshell_new/libs/respond/respond.min.js"></script>
	<![endif]-->
	<!--script src="https://infoshell.ru/wp-content/themes/mark_up/js/main.js"></script-->
<!--script src="https://infoshell.ru/wp-content/themes/mark_up/js1/main2.js?v=201901301"></script-->
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




<?php require __DIR__.'/../calc/calc.script.inc.html'; ?>




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