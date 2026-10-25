<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<base href="<?=get_bloginfo('url')?>/">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<title>Разработка мобильных приложений для iOS, Android, iPhone, Windows phone на заказ</title>
		<meta name="Description" content="Разработка мобильных приложений для телефонов и планшетов, а также веб-разработка сервисов. Создание приложения на базе iOS и Android любого уровня сложности. Мы ведем разработку по гибкой системе ведения проектов Scrum — отчет о проделанной работе в конце каждой недели. Расчет стоимость Вашего мобильного приложения. Портфолио. Отзывы."/>
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&amp;subset=latin,cyrillic" rel="stylesheet">
		<link href="<?php echo get_template_directory_uri(); ?>/css/main.css?1438504738837" rel="stylesheet">
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();

?>
	</head>
	<body>
		<div class="page-surround">
			<!-- ! JADE DONT PRETTIFY INLINE HTML ELEMENTS-->
			<div class="side-menu"><span class="mini-head">: : : Услуги : : :</span>
				<!-- /mini-head-->
				<ul class="side-menu-items">
					<li><a href="/developing-for-iphone/">Разработка под iOS</a></li>
					<li><a href="/developing-for-android-os/">Разработка под Android</a></li>
					<li><a href="/promotion-application/">Продвижение приложений</a></li>
					<li><a href="/web-development/">Разработка web-сервисов</a></li>
					<li><a href="/gamedevelopment/">Разработка игр</a></li>
				</ul>
				<!-- /side-menu-items--><span class="mini-head">: : : Портфолио : : :</span>
				<!-- /mini-head-->
				<ul class="side-menu-items">
					<li><a href="/portfolio?cat=12">Приложения</a></li>
					<li><a href="/portfolio?cat=10">Веб-сервисы</a></li>
					<li><a href="/portfolio?cat=11">Игры</a></li>
					<li><a href="/portfolio/">Все</a></li>
				</ul>
				<!-- /side-menu-items--><span class="mini-head">: : : Infoshell : : :</span>
				<!-- /mini-head-->
				<ul class="side-menu-items">
					<li><a href="/company/">Компания</a></li>
					<li><a href="/blog/">Блог</a></li>
					<li><a href="/contact/">Контакты</a></li>
				</ul>
				<!-- /side-menu-items-->
			</div>
			<!-- /side-menu-->
			<header class="header">
				<div class="container-mobile-full"><a id="menu-toggle" href=""><span></span></a>
					<!-- /menu-toggle--><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" width="80" height="80" alt=""></a>
					<nav class="main-nav">
						<ul class="menu">
							<li>
								<!-- add "active" class to <a> if necessary--><a href="/portfolio/" class="menu-item">Портфолио</a>
							</li>
							<li>
								<!-- add "active" class to <a> if necessary--><a href="/company/" class="menu-item">Компания</a>
							</li>
							<li>
								<!-- add "active" class to <a> if necessary--><a href="/contact/" class="menu-item">Контакты</a>
							</li>
						</ul>
						<!-- /ul.menu-->
					</nav>
					<!-- /nav.main-nav-->
					<div class="contact-info">
						<div class="tels">Мск:  (495) 215 51 82 <br> СПб: (812) 242 80 58 </div>
						<div class="request-call"><a href="" data-toggle="modal" data-target="#modal-1" class="request-call-btn">
								<div class="icon Phone_head"></div><span>Заказать <br> звонок</span></a></div>
						<!-- /request-call-->
					</div>
					<!-- /contact-info-->
				</div>
				<!-- /container-mobile-full-->
			</header>
			<!-- /header-->

			<section class="showcase owl-carousel">
                <div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/bg_slider_1.jpg');" class="section-block bg text-center valigner">
                    <div class="valigner-content">
                        <h1 class="showcase--title">РАЗРАБОТКА <br>МОБИЛЬНЫХ ПРИЛОЖЕНИЙ, <br>web-сервисов и игр</h1><a href="" data-toggle="modal" data-target="#modal-2" class="btn btn-black">оставить заявку</a>
                    </div>
                </div>
                <!-- /section-block-->
				<div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/award_bg.jpg');" class="section-block bg text-center valigner">
					<div class="valigner-content"><img src="<?php echo get_template_directory_uri(); ?>/img/award_1.png" alt="" class="showcase--image"></div>
				</div>
				<!-- /section-block-->
				<div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/award_bg.jpg');" class="section-block bg text-center valigner">
					<div class="valigner-content"><img src="<?php echo get_template_directory_uri(); ?>/img/award_2.png" alt="" class="showcase--image"></div>
				</div>
				<div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/award_bg.jpg');" class="section-block bg text-center valigner">
					<div class="valigner-content"><img src="<?php echo get_template_directory_uri(); ?>/img/award_3.png" alt="" class="showcase--image"></div>
				</div>
                <!-- /section-block-->
                <div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/bg_slider_5.jpg');" class="section-block bg">
                    <div class="container__full-height valigner">
                        <div class="valigner-content">
                            <span class="showcase--title__white">ПРИЛОЖЕНИЕ <br>ПАСПОРТ КОЖИ</span>
                            <p class="showcase--subtext__white">Онлайн-консультация; <br>Ослеживание изменений; <br>База знаний</p>
                        </div>
                    </div>
                    <!-- /container-->
                </div>
                <!-- /section-block-->
                <div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/bg_slider_6.jpg');" class="section-block bg">
                    <div class="container__full-height valigner">
                        <div class="valigner-content">
                            <span class="showcase--title__white">ОФИЦИАЛЬНОЕ <br>ПРИЛОЖЕНИЕ <br>ФК «ЗЕНИТ»</span>
                            <p class="showcase--subtext__white">2840 положительных отзывов, <br>5 место в TOP Overall Free App (iOs)</p>
                        </div>
                    </div>
                    <!-- /container-->
                </div>
                <!-- /section-block-->
                <div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/bg_slider_7.jpg');" class="section-block bg">
                    <div class="container__full-height valigner">
                        <div class="valigner-content">
                            <span class="showcase--title__white">ПЛАТЕЖНЫЙ <br>СЕРВИС PAYBER</span>
                            <p class="showcase--subtext__white">Система банковских платежей; <br>Совместные покупки; <br>Разработано за 4 месяца</p>
                        </div>
                    </div>
                    <!-- /container-->
                </div>
                <!-- /section-block-->
                <div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/bg_slider_8.jpg');" class="section-block bg">
                    <div class="container__full-height valigner">
                        <div class="valigner-content">
                            <span class="showcase--title__white">ПУТЕВОДИТЕЛЬ <br>ПО ГОРОДАМ <br>AUDIO TOUR AZBO</span>
                            <p class="showcase--subtext__white">3 — TOP Free app Travel, <br>49 — Top Overall Free App (iOs), <br>Разработано за 4 месяца</p>
                        </div>
                    </div>
                    <!-- /container-->
                </div>
                <!-- /section-block-->
                <div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/bg_slider_9.jpg');" class="section-block bg">
                    <div class="container__full-height valigner">
                        <div class="valigner-content">
                            <span class="showcase--title__white">ПРИЛОЖЕНИЕ <br>РАДИО RECORD</span>
                            <p class="showcase--subtext__white">821 323 установок за 6 месяцев; <br>5248 положительных отзывов; <br>5 TOP Overall Free App (iOS); <br> 8 Top Music &amp; Audio (Android); <br>Разработано за 5 месяцев</p>
                        </div>
                    </div>
                    <!-- /container-->
                </div>
                <!-- /section-block-->
                <div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/bg_slider_10.jpg');" class="section-block bg">
                    <div class="container__full-height valigner">
                        <div class="valigner-content">
                            <span class="showcase--title__white">ОФЦИАЛЬНОЕ <br>ПРИЛОЖЕНИЕ <br>FABERLIC</span>
                            <p class="showcase--subtext__white">Повышение лояльности; <br>Online-заказ</p>
                        </div>
                    </div>
                    <!-- /container-->
                </div>
                <!-- /section-block-->
            </section>
			<!-- /showcase-->
			<section class="section-block bg-black">
				<div class="container-big">
					<div class="col-item-4 what-we-do">
						<div class="what-we-do--icon">
							<div class="icon Services_1"></div>
						</div>
						<div class="what-we-do--header">Приложения <br>под iOS</div>
						<div class="what-we-do--text">InfoShell предлагает услуги по разработке программного обеспечения под iOS, Android OS, Windows Phone и Sumsung Tizen в соответствии с индивидуальными требованиями заказчика.</div><a href="/developing-for-iphone/" class="btn btn-outlined">подробнее</a>
					</div>
					<!-- /col-->
					<div class="col-item-4 what-we-do">
						<div class="what-we-do--icon">
							<div class="icon Services_2"></div>
						</div>
						<div class="what-we-do--header">Web-сервисы</div>
						<div class="what-we-do--text">Еще одно наше приоритетное направление – разработка web-продуктов любого уровня сложности, способных выдерживать высокие нагрузки.</div><a href="/web-development/" class="btn btn-outlined">подробнее</a>
					</div>
					<!-- /col-->
					<div class="col-item-4 what-we-do">
						<div class="what-we-do--icon">
							<div class="icon Services_3"></div>
						</div>
						<div class="what-we-do--header">Игры</div>
						<div class="what-we-do--text">Помимо разработки приложений и веб-сервисов мы занимаемся созданием качественных мобильных и браузерных игр, а также игровых приложений для социальных сетей.</div><a href="/gamedevelopment/" class="btn btn-outlined">подробнее</a>
					</div>
					<!-- /col-->
					<div class="col-item-4 what-we-do">
						<div class="what-we-do--icon">
							<div class="icon Services_4"></div>
						</div>
						<div class="what-we-do--header">Дизайн, <br>UX</div>
						<div class="what-we-do--text">Мы проектируем user-friendly интерфейсы и создаем для них красивый и стильный дизайн, как в рамках разработки программного продукта, так и в качестве отдельных услуг по дизайну и ux-аналитике.</div><a href="/gamedevelopment/" class="btn btn-outlined">подробнее</a>
					</div>
					<!-- /col-->
				</div>
				<!-- /container-->
			</section>
			<!-- /section-block-->
			<section class="section-block">
				<div class="container">
					<h2 class="section-header-dark">Последние разработанные приложения</h2>
					<div class="custom-owl-dots">
						<div class="icon Platf_ios"><span>Iphone</span></div>
						<div class="icon Platf_andr"><span>Android</span></div>
						<div class="icon Platf_web"><span>Web</span></div>
					</div>
					<!-- /custom-owl-dots-->
					<div class="portfolio-preview owl-carousel">
                        <div class="slide"><a href="/project/crm-%D1%81%D0%B8%D1%81%D1%82%D0%B5%D0%BC%D0%B0-freshoffice/" class="portfolio-preview--item col-item-3"><img src="/wp-content/uploads/2015/07/freshof_prev.jpg" alt="">
                                <div class="portfolio-preview--name">CRM-система FreshOffice</div></a><a href="/project/%D0%BF%D0%B0%D1%81%D0%BF%D0%BE%D1%80%D1%82-%D0%BA%D0%BE%D0%B6%D0%B8/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2015/05/prev_skin.jpg" alt="">
                                <div class="portfolio-preview--name">Паспорт кожи</div></a><a href="/project/v-lounge-%D0%BE%D1%82-%D0%BA%D0%BE%D0%BC%D0%BF%D0%B0%D0%BD%D0%B8%D0%B8-insignia/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2015/05/prev_vlounge.jpg" alt="">
                                <div class="portfolio-preview--name">V-lounge от компании Insignia</div></a><a href="/project/faberlic-3/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2011/08/prev_faber.jpg" alt="">
                                <div class="portfolio-preview--name">Официальное приложение Faberlic</div></a><a href="/project/roddom/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2011/08/prev_furst.jpg" alt="">
                                <div class="portfolio-preview--name">Женская академия</div></a><a href="/project/zenit/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2011/08/prev_zenit.jpg" alt="">
                                <div class="portfolio-preview--name">Официальное приложение ФК “Зенит”</div></a></div>
                        <!-- /slide-->
						<div class="slide"><a href="/project/spartakiada/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2015/07/sparta_mob_prev.jpg" alt="">
								<div class="portfolio-preview--name">Spartakiada</div></a><a href="/project/%D0%BF%D1%80%D0%B8%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5-%D0%B3%D0%B5%D0%B9%D0%BC%D0%B8%D1%84%D0%B8%D0%BA%D0%B0%D1%86%D0%B8%D1%8F-%D0%B4%D0%BB%D1%8F-%D0%BE%D1%82%D0%B4%D0%B5%D0%BB%D0%B0-%D0%BF/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2015/06/prev_fts.jpg" alt="">
								<div class="portfolio-preview--name">Приложение-геймификация для отдела продаж</div></a><a href="/project/faberlic-3/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2011/08/prev_faber.jpg" alt="">
								<div class="portfolio-preview--name">Официальное приложение Faberlic</div></a><a href="/project/roddom/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2011/08/prev_furst.jpg" alt="">
								<div class="portfolio-preview--name">Женская академия</div></a><a href="/project/zenit/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2011/08/prev_zenit.jpg" alt="">
								<div class="portfolio-preview--name">Официальное приложение ФК "Зенит"</div></a><a href="/project/audio_tour_azbo/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2012/09/prev_azbo.jpg" alt="">
								<div class="portfolio-preview--name">Путеводитель по городам Azbo audio tour</div></a></div>
						<!-- /slide-->
						<div class="slide"><a class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2015/08/sparta_web_prev.jpg" alt="">
								<div class="portfolio-preview--name">Spartakiada</div></a><a href="/project/%D0%B1%D0%B8%D1%80%D0%B6%D0%B0-%D0%BF%D1%80%D0%BE%D0%B3%D0%BD%D0%BE%D0%B7%D0%BE%D0%B2-fsx/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2015/05/prev_birzha.jpg" alt="">
								<div class="portfolio-preview--name">Биржа прогнозов FSX</div></a><a href="/project/kindium/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2011/08/prev_kindium.jpg" alt="">
								<div class="portfolio-preview--name">Kindium.ru - мир детской моды</div></a><a href="/project/world-of-opera/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2012/09/prev_opera_web.jpg" alt="">
								<div class="portfolio-preview--name">"World of opera"</div></a><a href="/project/art_design_vk/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2014/09/prev_artdes_web.jpg" alt="">
								<div class="portfolio-preview--name">"Арт и дизайн" - открытки для "VK.com"</div></a><a href="/project/domitex-2/" class="portfolio-preview--item col-item-3"><img src="https://infoshell.ru/wp-content/uploads/2014/10/prev_terminal1.jpg" alt="">
								<div class="portfolio-preview--name">Электронная витрина "Домитекс"</div></a></div>
						<!-- /slide-->
					</div>
					<!-- /portfolio-preview-->
				</div>
				<!-- /container-->
			</section>
			<!-- /section-block-->
			<section class="section-block bg-black why-block">
				<div class="container">
					<h2 class="section-header">Зачем нужно мобильное приложение?</h2>
					<p class="section-text">Конечная цель мобилизации – увеличение прибыли бизнеса за счет основных <br>преимуществ использования мобильного приложения</p>
				</div>
				<!-- /container-->
				<div class="container-mobile-full">
					<div class="col-item-5 why">
						<div class="why--icon">
							<div class="icon Icon_1"></div>
						</div>
						<div class="why-header">Повышение <br>лояльности <br>клиентов</div>
					</div>
					<!-- /col-->
					<div class="col-item-5 why">
						<div class="why--icon">
							<div class="icon Icon_2"></div>
						</div>
						<div class="why-header">Рост эффективности <br>труда работников</div>
					</div>
					<!-- /col-->
					<div class="col-item-5 why">
						<div class="why--icon">
							<div class="icon Icon_3"></div>
						</div>
						<div class="why-header">Привлечение <br>новых клиентов</div>
					</div>
					<!-- /col-->
					<div class="col-item-5 why">
						<div class="why--icon">
							<div class="icon Icon_4"></div>
						</div>
						<div class="why-header">Автоматизация <br>бизнес-процессов</div>
					</div>
					<!-- /col-->
					<div class="col-item-5 why">
						<div class="why--icon">
							<div class="icon Icon_5"></div>
						</div>
						<div class="why-header">Ускорение принятия <br>управленческих <br>решений</div>
					</div>
					<!-- /col-->
				</div>
				<!-- /container-->
			</section>
			<!-- /section-block-->
			<section class="section-block bg-slider-1">
				<div class="container">
					<h2 class="section-header-dark">Сколько может стоить ваше приложение?</h2>
					<p class="section-text-dark">Каждый проект рассчитывается индивидуально. Стоимость зависит от сложности, <br>объема и сроков работы. Вы можете оставить краткую информацию <br>и наш менеджер вам перезвонит.</p>
				</div>
				<!-- /container-->
				<div class="container">
					<div class="question-face"><img src="<?php echo get_template_directory_uri(); ?>/img/faces/kirill-popov.png" alt="" width="160" height="160">
						<div> <b>Кирилл Попов</b><br><span>Менеджер по работе с клиентами</span></div>
					</div>
					<!-- /question-face-->
                    <form enctype="multipart/form-data" action="https://infoshell.ru/wp-content/themes/mark_up/mail/send.php" method="post" id="callForm" novalidate="novalidate" class="question-form">
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
									<input type="file" name="upload_file" class="attach-file-input">
									<!-- /hidden file input-->
								</div>
								<!-- /attach-container--><a href="" class="attach-reset">&times;</a>
							</div>
							<!-- /attachment-->
							<div class="submit-btn">
								<a type="submit" class="btn btn-black callFormSubmit">Узнать стоимость</a>
							</div>
						</div>
						<!-- /control-group-->
					</form>
					<!-- /form-->
				</div>
				<!-- /container-->
			</section>
			<!-- /section-block-->
			<section class="section-block development-stages-block">
				<div class="container">
					<h2 class="section-header-dark" style="padding-bottom: 20px;">Этапы разработки мобильного приложения</h2>
					<ol class="development-stages">
						<li class="development-stages--stage">
							<div class="development-stages--stage-image"><img src="<?php echo get_template_directory_uri(); ?>/img/stages/1.png" alt=""></div>
							<div class="development-stages--stage-content">
								<span class="development-stages--stage-head">1. Идея проекта и консультация</span>
								<p class="development-stages--stage-text">Люди приходят к нам в компанию, чтобы воплотить в жизнь свои идеи или автоматизировать бизнес-процессы. Мы предоставляем бесплатную консультацию у аналитика InfoShell и доработку идейной составляющей проекта.</p>
							</div><img src="<?php echo get_template_directory_uri(); ?>/img/stages/idea.png" width="107" height="112" class="idea">
						</li>
						<li class="development-stages--stage">
							<div class="development-stages--stage-image"><img src="<?php echo get_template_directory_uri(); ?>/img/stages/2.png" alt=""></div>
							<div class="development-stages--stage-content">
								<span class="development-stages--stage-head">2. Оценка проекта и предложение</span>
								<p class="development-stages--stage-text">Оценку проекта произодит команда разработчиков. После чего клиент получает предварительное коммерческое предложение на разработку продукта.</p>
							</div>
						</li>
						<li class="development-stages--stage">
							<div class="development-stages--stage-image"><img src="<?php echo get_template_directory_uri(); ?>/img/stages/3.png" alt=""></div>
							<div class="development-stages--stage-content">
								<div class="relative">
									<span class="development-stages--stage-head">3. Бэклог и договор</span>
									<div class="tooltip"><span>?</span>
										<div class="tooltip-content"><b>Продукт-оунер</b> — руководитель проекта.<br>
											<b>Бэклог</b> — список задач для команды разработки, которые полностью описывают проект.
										</div>
									</div>
								</div>
								<p class="development-stages--stage-text">Встреча с продукт-оунером, обсуждение деталей проекта. Команда разрабатывает бэклог на весь проект совместно с заказчиком. После утверждения бэклога, с заказчиком подписывается договор.</p>
							</div>
						</li>
						<li class="development-stages--stage-preinner">
							<div class="development-stages--stage-image"><img src="<?php echo get_template_directory_uri(); ?>/img/stages/4.png" alt=""></div>
							<div class="development-stages--stage-content">
								<div class="relative">
									<span class="development-stages--stage-head">4. Планирование спринта</span>
									<div class="tooltip"><span>?</span>
										<div class="tooltip-content"><b>Спринт</b> — этап в рамках которого реализуется определенная часть проекта</div>
									</div>
								</div>
								<p class="development-stages--stage-text">Договоренность с заказчиком о том какие задачи будут выполнены на ближайшем спринте.</p>
							</div>
						</li>
						<li class="development-stages--stage-inner">
							<div class="development-stages--stage-arrow-up">проект пока <br>не завершен</div>
							<div class="development-stages--stage-arrow-down"></div>
							<div class="development-stages--stage-image"><img src="<?php echo get_template_directory_uri(); ?>/img/stages/5.png" alt=""></div>
							<div class="development-stages--stage-content">
								<span class="development-stages--stage-head">5. ретроспектива</span>
								<p class="development-stages--stage-text">Демонстрация заказчику результатов за неделю. Команда анализирует риски и проблемы, завершает спринт, оптимизирует дальнейший процесс разработки.</p>
							</div>
							<div class="clock"><img src="<?php echo get_template_directory_uri(); ?>/img/stages/clock.png" alt="" width="99" height="78"><b>24 часа</b><span>Каждый день команда отчитывается продукт-оунеру о выполненных задачах.</span></div>
						</li>
						<li class="development-stages--stage-last">
							<div class="development-stages--stage-last-arrow-down">проект завершен</div>
							<div class="development-stages--stage-image"><img src="<?php echo get_template_directory_uri(); ?>/img/stages/6.png" alt=""></div>
							<div class="development-stages--stage-content">
								<span class="development-stages--stage-head">6. Завершение</span>
								<p class="development-stages--stage-text">Клиент получачет отменный готовый продукт, который можно использовать по назначению.</p>
							</div>
						</li>
					</ol>
					<!-- /development-stages-->
				</div>
				<!-- /container-->
			</section>
			<!-- /section-block-->
			<section class="section-block bg-adv">
				<div class="container">
					<h3 class="section-header">Преимущества infoShell</h3>
				</div>
				<!-- /container-->
				<div class="container-big">
					<div class="col-item-4 benefits">
						<div class="benefits--icon">
							<div class="icon Astr_1"></div>
						</div>
						<div class="benefits--header">за 6 лет <br>более 100 проектов</div>
						<div class="benefits--text">Мы разрабатывает мобильные приложения с 2009 года и уже сотрудничаем с рынками Америки и Европы, реализуя проекты абсолютно для любой сферы деятельности.</div>
					</div>
					<!-- /col-->
					<div class="col-item-4 benefits">
						<div class="benefits--icon">
							<div class="icon Astr_2"></div>
						</div>
						<div class="benefits--header">топовые позиции <br>в рейтингах</div>
						<div class="benefits--text">На российском рынке мы – одни из лучших разработчиков мобильных приложений ( по версии c-News, CMSMagazine и Ruward 2014)</div>
					</div>
					<!-- /col-->
					<div class="col-item-4 benefits">
						<div class="benefits--icon">
							<div class="icon Astr_3"></div>
						</div>
						<div class="benefits--header">Прокачанные <br>специалисты</div>
						<div class="benefits--text">Наши специалисты входят в жюри конкурсов и премий по mobile, пишут материалы для проф. ресурсов и читают лекции на курсах программирования и дизайна.</div>
					</div>
					<!-- /col-->
					<div class="col-item-4 benefits">
						<div class="benefits--icon">
							<div class="icon Astr_4"></div>
						</div>
						<div class="benefits--header">Клиенты видят <br>процесс разработки</div>
						<div class="benefits--text">Каждую неделю наша команда предоставляет заказчику отчет о проделанной работе над проектом. Что позволяет быть всегда в курсе, того как создается продукт.</div>
					</div>
					<!-- /col-->
				</div>
				<!-- /container-->
			</section>
			<!-- /section-block-->
			<section class="presentation-block bg-black">
				<div class="container-mobile-full">
					<div class="presentation-block--booklet"><img src="<?php echo get_template_directory_uri(); ?>/img/booklet.png" alt="" width="390" height="220"></div>
					<div class="presentation-block--content"><span class="presentation-block--text"><a href="https://infoshell.ru/files/Infoshell.pdf" class="icon Download">Скачать</a> <span>презентацию о компании</span></span></div>
				</div>
				<!-- /container-->
			</section>
			<!-- /section-block-->
			<section class="section-block">
				<div class="container">
					<h3 class="section-header-dark">Отзывы заказчиков</h3>
					<div class="testimonials owl-carousel">

                        <?php
                            $posts = get_posts('category_name=testimonials&posts_per_page=10&orderby=rand');
                            foreach( $posts as $post ) {

                                $image = get_field('avatar'); ?>
                                <div class="testimonials--item">
							        <div class="testimonials--text">
								        <p><?php echo $post->post_content; ?></p><a href=""></a>
							        </div>
							        <!-- /testimonials--text-->
							        <div class="testimonials--author">
								        <div class="face"><img src="<?php echo $image['url']; ?>" width="80" height="80"></div><span><?php echo $post->post_title; ?></span>
							        </div>
							        <!-- /testimonials--author-->
						        </div>

                        <?php } ?>
					</div>
					<!-- /testimonials-->
					<div class="testimonials--button"><a href="/company/" class="btn btn-outlined">Все отзывы и письма</a></div>
				</div>
				<!-- /container-->
			</section>
			<!-- /section-block-->
			<section class="section-block container-mobile-full with-dashed-border-top">
				<h3 class="section-header-dark">С нами работают</h3>
				<div class="companies-list">
					<!-- / ! JADE DONT PRETTIFY INLINE HTML ELEMENTS, SORRY--><a href="/project/audio_tour_azbo/" class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/azbo.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/azbo.png" alt="" class="visible"></a>
					<!-- /a.company--><a href="/project/zenit/" class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/zenit.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/zenit.png" alt="" class="visible"></a>
					<!-- /a.company--><a href="/project/record/" class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/record.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/record.png" alt="" class="visible"></a>
					<!-- /a.company--><a href="/project/pazlinki-2/" class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/step.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/step.png" alt="" class="visible"></a>
					<!-- /a.company--><a href="/project/permenergo-2/" class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/permenergo.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/permenergo.png" alt="" class="visible/"></a>
					<!-- /a.company--><a class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/and.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/and.png" alt="" class="visible"></a>
					<!-- /a.company--><a href="/project/lokomotiv/" class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/loko.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/loko.png" alt="" class="visible"></a>
					<!-- /a.company--><a href="/project/mgu/" class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/mgu.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/mgu.png" alt="" class="visible"></a>
					<!-- /a.company--><a class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/pek.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/pek.png" alt="" class="visible"></a>
					<!-- /a.company--><a class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/loveradio.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/loveradio.png" alt="" class="visible"></a>
					<!-- /a.company--><a href="/project/captain_morgan/" class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/captainmorgan.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/captainmorgan.png" alt="" class="visible"></a>
					<!-- /a.company--><a href="/project/philipmorris/" class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/pm.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/pm.png" alt="" class="visible"></a>
					<!-- /a.company--><a href="/project/faberlic-3/" class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/faberlic.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/faberlic.png" alt="" class="visible"></a>
					<!-- /a.company--><a href="/project/art_disign/" class="company"><img src="<?php echo get_template_directory_uri(); ?>/img/companies-color/artdesign.png" alt="" class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/img/companies/artdesign.png" alt="" class="visible"></a>
					<!-- /a.company-->
				</div>
				<!-- /companies-list-->
			</section>
			<!-- /section-block-->
			<section class="section-block bg-black">
				<div class="container">
					<h3 class="section-header">Наш блог</h3>					
					<div class="blog">
						<?php
						$posts = get_posts(array(
							'category_name'=>'blog',
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
							<div class="blog-entry">
								<div style="background-image: url(<?php echo $src[0]; ?>)" class="blog-entry--image"><a href="<?php the_permalink(); ?>"></a></div>
									<div class="blog-entry--body">
										<?php
											
															
											foreach((get_the_category($id)) as $category) { 
												$idc = $category->cat_ID;
												$link = get_category_link($idc);
												$img_arr = get_field('categ_image', 'category_'.$idc);
																
												if(!empty($img_arr['sizes']['thumbnail'])){
													//echo "<i class='icc'><img src=".$img_arr['sizes']['thumbnail']." ></i>";
												}
											}
										?>
										<div class="blog-entry--icon">News</div>
										<h2 class="blog-entry--head"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<p class="blog-entry--text"><?php echo get_the_excerpt(); ?></p>
										<p class="blog-entry--date"><?php the_time('j F y'); ?></p>
									</div>
								</div>

						<?php } ?>
					</div>
					<!-- /blog-->
					<div class="testimonials--button"><a href="/blog/" class="btn btn-outlined">Узнать больше о делах компании</a></div>
				</div>
				<!-- /container-->
			</section>
			<!-- /section-block-->
			<section class="with-full-map">
				<div id="map-canvas" class="contacts-map"></div>
				<!-- / map-->
				<div class="container-mobile-full contacts">
					<div class="contacts-list">
						<div class="contacts-list--item"> <a href class="contacts-list--item-head">Россия, г. Москва:</a>
							<!-- /contacts-list--item-head-->
							<div class="contacts-list--item-content">
								<p>Адрес: ст. метро Маяковская, 1-я Тверская-Ямская улица, 16/23, оф. 8</p>
								<p class="icon-tel">Телефон/факс: (495) 215-51-82</p>
								<p class="icon-email">E-mail: info@infoshell.ru</p>
							</div>
							<!-- /contacts-list--item-content-->
						</div>
						<!-- /contacts-list--item-->
						<div class="contacts-list--item"> <a href class="contacts-list--item-head">Россия, г. Санкт-Петербург:</a>
							<!-- /contacts-list--item-head-->
							<div class="contacts-list--item-content">
								<p>Адрес: ст. метро Петроградская, Каменноостровский пр., д. 26-28, офис 39 (Дом Бенуа)</p>
								<p class="icon-tel">Телефон/факс: (812) 242-80-58</p>
								<p class="icon-email">E-mail: info@infoshell.ru</p>
							</div>
							<!-- /contacts-list--item-content-->
						</div>
						<!-- /contacts-list--item-->
						<div class="contacts-list--item"> <a href class="contacts-list--item-head">Россия, г. Астрахань:</a>
							<!-- /contacts-list--item-head-->
							<div class="contacts-list--item-content">
								<p>Адрес: ул. Савушкина, 6 к. 6</p>
								<p class="icon-tel">Телефон/факс: (495) 215-51-82</p>
								<p class="icon-email">E-mail: info@infoshell.ru</p>
							</div>
							<!-- /contacts-list--item-content-->
						</div>
						<!-- /contacts-list--item-->
						<div class="contacts-list--item"> <a href class="contacts-list--item-head">Россия, г. Улан-Удэ:</a>
							<!-- /contacts-list--item-head-->
							<div class="contacts-list--item-content">
								<p>Адрес: ул. Ключевская. 76А, оф.32</p>
								<p class="icon-tel">Телефон/факс: (495) 215-51-82</p>
								<p class="icon-email">E-mail: info@infoshell.ru</p>
							</div>
							<!-- /contacts-list--item-content-->
						</div>
						<!-- /contacts-list--item-->
						<div class="soc"><a href="https://vk.com/infoshell" class="icon Soc_vk"></a><a href="https://www.facebook.com/infoshell.apps?ref=hl" class="icon Soc_facebook"></a><a href="https://dribbble.com/InfoShell" class="icon Soc_dribbble"></a><a href="https://www.behance.net/infoshell" class="icon Soc_behance"></a></div>
						<!-- /social btns-->
					</div>
					<!-- /contacts-list-->
                    <form action="https://infoshell.ru/wp-content/themes/mark_up/mail/send.php" method="post" id="emailForm" novalidate="novalidate" class="contacts-form">
                    <div class="control-group">
							<input type="text" placeholder="Ваше имя.." class="inputbox full" name="name">
						</div>
						<!-- /control-group-->
						<div class="control-group">
							<input type="text" placeholder="Ваш e-mail.." class="inputbox full" name="email">
						</div>
						<!-- /control-group-->
						<div class="control-group">
							<textarea rows="10" placeholder="Сообщение.." class="inputbox full clear" name="message"></textarea>
						</div>
						<!-- /control-group-->
						<div class="control-group"><a href="" class="btn btn-outlined__white callFormSubmit">Отправить</a></div>
						<!-- /control-group-->
					</form>
					<!-- /contacts-form-->
				</div>
				<!-- /container-->
			</section>
			<!-- /section-block-->

			<footer class="footer">
				<div class="container-mobile-full"><a href="" class="footer-logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="" width="45" height="45"></a>
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
			<!-- /footer-->
			<div id="modal-1" class="modal">
				<div class="modal-content">
					<div class="modal-header-icon">
						<div class="icon Phone_call_modal"></div>
					</div>
					<div class="modal-header-text">Оставьте свой номер телефона, <br>и мы вам обязательно перезвоним!</div>
                    <form action="https://infoshell.ru/wp-content/themes/mark_up/mail/send.php" method="post" id="emailForm" novalidate="novalidate" class="question-form">
                        <input type="hidden" value="CALL_US_TOP" name="ymparam">
                        <input type="hidden" value="1" name="type">
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
                            <a href="#" class="btn btn-yellow emailFormSubmit">отправить</a>
						</div>
						<!-- /control-group-->
					</form>
					<!-- /form-->
					<div class="modal-close"><a href="" data-dismiss="modal"><span>&times;</span>Закрыть</a></div>
				</div>
			</div>
            <div id="success_modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header-icon">
                        <div class="icon Phone_call_modal"></div>
                    </div>
                    <div class="modal-header-text">Ваша заявка отправлена, <br>с вами свяжутся в ближайшее время!</div>
                    <div class="modal-close"><a href="" data-dismiss="modal"><span>&times;</span>Закрыть</a></div>
                </div>
            </div>
			<div id="modal-2" class="modal">
				<div class="modal-content">
					<div class="modal-header-text">Вы можете оставить онлайн-заявку, <br>и мы вам обязательно ответим!</div>
                    <form enctype="multipart/form-data" action="/wp-content/themes/mark_up/mail/send.php" method="post" id="callForm" novalidate="novalidate">
                        <input type="hidden" value="EXPERT_OCENKA" name="ymparam">
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
                            <a href="#" class="btn btn-yellow callFormSubmit">отправить</a>
						</div>
						<!-- /control-group-->
					</form>
					<!-- /form-->
					<div class="modal-close"><a href="" data-dismiss="modal"><span>&times;</span>Закрыть</a></div>
				</div>
			</div>
			<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
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
						items: 1
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
			<!-- Scripts for map-->
			<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;amp;sensor=false"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate/jquery.validate.min.js"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate/localization/messages_ru.min.js"></script>
			<script>
				var map;
				function initialize() {
					var mapOptions = {
						zoom: 5,
						center: new google.maps.LatLng(55.772089, 37.592534),
						zoomControl: false,
						zoomControlOptions: {
							style: google.maps.ZoomControlStyle.SMALL
						},
						disableDefaultUI: true
					};
					var styles = [
						{
							"stylers": [
								{ "saturation": -75 },
								{ "lightness": -55 }
							]
						}
					]
					var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});
					map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
					map.mapTypes.set('map_style', styledMap);
					map.setMapTypeId('map_style');
					var image = '<?php echo get_template_directory_uri(); ?>/img/map-logo.png';
				
					var myLatLng0 = new google.maps.LatLng(55.773089, 37.591534);
					var beachMarker = new google.maps.Marker({
						position: myLatLng0,
						map: map,
						icon: image
					});
				
					var myLatLng1 = new google.maps.LatLng(59.96907, 30.309144);
					var beachMarker = new google.maps.Marker({
						position: myLatLng1,
						map: map,
						icon: image
					});
				
					var myLatLng2 = new google.maps.LatLng(38.032098, -78.470734);
					var beachMarker = new google.maps.Marker({
						position: myLatLng2,
						map: map,
						icon: image
					});
				
					var myLatLng3 = new google.maps.LatLng(46.3756968,48.0497982);
					var beachMarker = new google.maps.Marker({
						position: myLatLng3,
						map: map,
						icon: image
					});
				
					var myLatLng4 = new google.maps.LatLng(51.8201356,107.6584025);
					var beachMarker = new google.maps.Marker({
						position: myLatLng4,
						map: map,
						icon: image
					});
				}
				google.maps.event.addDomListener(window, 'load', initialize);
			</script>
            <script>
                $(document).ready(function(){
                    jQuery.validator.addMethod("fileSize", function (val, element, param) {

                        if(element.files.length == 0) return true;
                        var size = element.files[0].size;

                        if (size > parseInt(param))
                        {
                            return false;
                        } else {
                            return true;
                        }

                    }, "Файл дожен быть меньше чем 25МБ");

                    $('#callForm').validate({
                        /* submitHandler: function(form) {
                         $(form).submit();
                         }*/
                    });

                    $('#emailForm').validate({
                    });

                    $('.upload-file').find('[name=upload_file]').change(function(){
                        var me = $(this);
                        var el = document.createElement('a');
                        var el2 = document.createElement('div');
                        $('.remove-container').html('');

                        $(el).html('Удалить');
                        $(el2).html(me.val());


                        $(el).click(function(){

                            $('.remove-container').html('');
                            me.val('');
                            console.log('asd');
                        });

                        $('.remove-container').append(el2).append(el);

                    });

                    $('.callFormSubmit').click(function(){
                        $(this).closest('form').submit();
                        return false;
                    });

                    $('.emailFormSubmit').click(function(){
                        $(this).closest('form').submit();
                        return false;
                    });

                    <?php if(array_key_exists('mailsuccess', $_REQUEST) && $_REQUEST['mailsuccess'] == 1) { ?>
                    $('.success_modal').show();
//                    $('.modal').show();
//                    $('.wrapper-overlay').show();
                    setTimeout(function(){
                        $('.success_modal').fadeOut(1000);
//                        $('.modal').fadeOut(1000);
//                        $('.wrapper-overlay').fadeOut(1000);
                    }, 1500)
                    <?php } ?>
                });


            </script>
        </div>
	</body>
</html>