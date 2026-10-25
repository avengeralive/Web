<?
/* 
Template name: Home
*/
?>

<? get_header(); ?>
        <!--// Header -->

        <!-- Header Banner -->
        <div class="banner-area banner-slider-active">
        	<?
        		$slider = get_posts(array('post_type' => 'slider'));
        		foreach ($slider as $slide) {
        	?>
			<!-- Single Banner -->
			<div class="banner justify-content-center align-items-center" data-black-overlay="5" style="background-image: url(<? echo get_the_post_thumbnail_url($slide->ID, 'full'); ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
				<div class="container">
					<div class="banner-text banner-text-white">
						<div class="banner-countbox event-countdown" data-countdown="2018/9/12"></div>
						<h1><? echo $slide->post_title; ?></h1>
						<h4><? echo $slide->post_content; ?></h4>
						<a href="#regform" class="cr-btn cr-btn-lg cr-btn-blue">
							<span>Register now</span>
						</a>
					</div>
				</div>
			</div>
			<? } ?>

        </div>
        <!--// Header Banner -->

        <!-- Page Content -->
        <main id="page-content">
            
            <!-- About Area -->
            <section class="cr-section about-area bg-white section-padding-md">
                <div class="container">
                    <div class="about-text text-center">
                        <img src="<? echo get_field('значок', 121); ?>" alt="about icons">
                        <h4><? echo get_field('подзаголовок', 121); ?></h4>
                        <h2><? echo get_field('заголовок', 121); ?></h2>
						<p><? echo get_field('описание', 121); ?></p>
						<div class="button-group">
							<a href="<? echo get_field('первая_ссылка', 121); ?>" class="cr-btn cr-btn-blue">
								<span><? echo get_field('текст_первой_ссылки', 121); ?></span>
							</a>
							<a href="<? echo get_field('вторая_ссылка', 121); ?>" class="cr-btn cr-btn-red">
								<span><? echo get_field('текст_второй_ссылки', 121); ?></span>
							</a>
						</div>
                    </div>
                </div>
            </section>
			<!--// About Area -->

			<!--
			<section class="cr-section portfolio-area bg-white section-padding-md">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8 col-md-10 col-12">
							<div class="section-title text-center">
								<h2>Фотогалерея</h2>
							</div>
						</div>
					</div>
					<div class="row justify-content-center portfolios portfolio-popup-gallery-active">
						<?
			        		$galleries = get_posts(array('post_type' => 'gallery', 'limit' => 8 ));
			        		foreach ($galleries as $album) {
			        	?>
			        	<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
							<a href="<? echo $album->guid; ?>" class="portfolio1">
								<div class="portfolio-thumb">
									<img src="<? echo get_the_post_thumbnail_url($album->ID, 'full'); ?>" alt="portfolio thumb 1">
								</div>
								<div class="portfolio-content">
									<h6><? echo $album->post_title; ?></h6>
								</div>
							</a>
						</div>
						<? } ?>
					</div>
				</div>
			</section>
			-->

			<!-- Events Area -->
			
			<!--// Events Area -->

			<!-- Video Promo Area -->
			<!--<div class="cr-section video-promo-area bg-white section-padding-md">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="videobox mr-0 mr-xl-3">
								<div class="embed-responsive embed-responsive-16by9">
									<? echo get_field('ссылка_на_видео', 121); ?>
								</div>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="video-promo-content">
								<? echo get_field('описание_к_видео', 121); ?>
								<a href="<? echo get_field('ссылка_кнопки', 121); ?>" class="cr-btn cr-btn-red">
									<span><? echo get_field('текст_кнопки', 121); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>-->
			<!--// Video Promo Area -->

			<section class="cr-section about-area bg-white section-padding-md" style="padding-top: 0px;">
                <div class="container">
					<div class="row text-center">
						<h2 style="margin: 0 auto; margin-bottom: 50px;">Преимущества участия</h2>
					</div>
					<div class="about-text text-center row">
						<div class="col-sm-6 col-md-4">
							<img src="/wp-content/themes/intertkanb2b/images/icons/meeting.svg" style="height: 70px;">
							<p><b>целевые встречи</b> с производителями, здесь нет случайных посетителей, только профессионалы в сфере легкой и текстильной промышленности</p>
						</div>
						<div class="col-sm-6 col-md-4">
							<img src="/wp-content/themes/intertkanb2b/images/icons/hand-shake.svg" style="height: 70px;">
							<p>возможность обрести <b>новых деловых партнеров</b> и получить <b>выгодные условия</b> для развития своего бизнеса</p>
						</div>
						<div class="col-sm-6 col-md-4">
							<img src="/wp-content/themes/intertkanb2b/images/icons/CPM.svg" style="height: 70px;">
							<p>мероприятие проводится в сроки проведения международной выставки <b>CPM (CollectionPremièreMoscow)</b></p>
						</div>
						<div class="col-sm-6 col-md-4">
							<img src="/wp-content/themes/intertkanb2b/images/icons/placeholder.svg" style="height: 70px;">
							<p><b>удобное расположение</b>, мероприятие проходит в ЦВК <b>«Экспоцентр»</b></p>
						</div>
						<div class="col-sm-6 col-md-4">
							<img src="/wp-content/themes/intertkanb2b/images/icons/thread.svg" style="height: 70px;">
							<p><b>поддержка</b> мероприятия со стороны ведущих <b>отраслевых ассоциаций</b>, федеральных и региональных <b>органов власти</b></p>
						</div>
						<div class="col-sm-6 col-md-4">
							<img src="/wp-content/themes/intertkanb2b/images/icons/megaphone.svg" style="height: 70px;">
							<p>широкая рекламная и информационная <b>поддержка СМИ</b></p>
						</div>
					</div>
                </div>
            </section>

            <section class="cr-section events-area bg-image-3 section-padding-md" data-black-overlay="2">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8 col-md-10 col-12">
							<div class="section-title section-title-white text-center">
								<h2>ФОРМАТ ПРОВЕДЕНИЯ</h2>
							</div>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<div class="tab-content" id="upcoming-events-ontent">

								<div class="events-wrap tab-pane fade show active" id="upcoming-eventlist-1" role="tabpanel" aria-labelledby="upcoming-eventlist-1-tab">

									<!-- Single Upcoming Event -->
									<a href="event-details.html" class="event-single">
										<div class="event-thumb">
											<img src="/wp-content/themes/intertkanb2b/images/events/upcoming-events/event-thumb-1.jpg" alt="upcoming event thumb">
										</div>
										<div class="event-content">
											<p>деловые встречи в формате B2B</p>
										</div>
									</a>
									<!--// Single Upcoming Event -->

									<!-- Single Upcoming Event -->
									<a href="event-details.html" class="event-single">
										<div class="event-thumb">
											<img src="/wp-content/themes/intertkanb2b/images/events/upcoming-events/event-thumb-2.jpg" alt="upcoming event thumb">
										</div>
										<div class="event-content">
											<p>персональные переговоры</p>
										</div>
									</a>
									<!--// Single Upcoming Event -->

									<!-- Single Upcoming Event -->
									<a href="event-details.html" class="event-single">
										<div class="event-thumb">
											<img src="/wp-content/themes/intertkanb2b/images/events/upcoming-events/event-thumb-3.jpg" alt="upcoming event thumb">
										</div>
										<div class="event-content">
											<p>демонстрация своей продукции непосредственно менеджерам, принимающим решение о закупках</p>
										</div>
									</a>
									<!--// Single Upcoming Event -->

								</div>

								
							</div>
						</div>
					</div>
				</div>
			</section>
			
			
			<div class="cr-section video-promo-area bg-white section-padding-md">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
						 	<div class="col-sm-12" style="border: 1px solid #de2633; padding: 0; height: 200px;">
								<h2 style="text-align: center; background: #de2632; color: #fff;">Участники</h2>
								<ul>
									<li>российские и зарубежные производители тканей и фурнитуры</li>
									<li>фабрики-производители одежды, домашнего текстиля, трикотажа.</li>
								</ul>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-sm-12" style="border: 1px solid #6dcf3f; padding: 0; height: 200px;">
								<h2 style="text-align: center; background: #6dcf3f; color: #fff;">Посетители</h2>
								<ul>
									<li>представители российских и зарубежных брендов готовой одежды</li>
									<li>модные дома, дизайнеры</li>
									<li>владельцы розничных сетей и магазинов</li>
									<li>оптовые компании</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="testimonial-area section-padding-sm" data-white-overlay="9">
                <div class="container">
                    <div class="testimonial-wrap">
                    	<?
			        		$slider = get_posts(array('post_type' => 'reviews'));
			        		foreach ($slider as $slide) {
			        	?>
                        <div class="testimonial text-center">
                            <p><? echo $slide->post_content; ?></p>
                            <h6><? echo $slide->post_title; ?></h6>
                        </div>
                        <? } ?>
                    </div>
                </div>
            </div>

			<div class="cr-section video-promo-area bg-white section-padding-md" id="regform">
				<div class="container">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<h3 class="text-center">Apply form and become exibitor</h3>
							<form action="/wp-admin/admin-post.php" method="post" id="contact-form" class="contact-page-form">
								<div class="row">
									<input type="hidden" name="action" value="register_participant">
									<div class="col-12 mt-30">
										<input type="text" name="company_name" placeholder="Company name">
									</div>
									<div class="col-12 mt-30">
										<input type="text" name="contact_pers" placeholder="Contact person">
									</div>
									<div class="col-12 mt-30">
										<input type="text" name="phone" placeholder="Phone">
									</div>
									<div class="col-12 mt-30">
										<input type="email" name="email" placeholder="E-mail">
									</div>
									<div class="col-12 mt-30">
										<textarea name="source" cols="30" rows="7" placeholder="Source"></textarea>
									</div>
									<div class="col-12 mt-30 text-center">
										<button type="submit" class="cr-btn mt-30">
											<span>Become exibitor <i class="fa fa-angle-right"></i></span>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="cr-section mb-30">
				<div class="container">
					<div class="row">
						<div class="col-12 text-center">
							<h2 >Место проведения</h2>
							<p>Место проведения мероприятия: ЦВК «Экспоцентр», павильон2, «Синий зал» (г. Москва,
	Краснопресненская набережная, д.14)</p>
	<p>Центральный выставочный комплекс «Экспоцентр» находится в центре столицы, рядом с
	деловым центром Москва-Сити, в шаговой доступности от метро «Выставочная» и
	«Деловой центр».</p>
	<p>Удобное расположение дает возможность всем участникам мероприятия быстро и
	комфортно добраться до места.</p>
							<div class="button-group">
								<a href="/посетителям/получить-электронный-билет/" class="cr-btn cr-btn-blue">
									<span>Получить электронный билет</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="banner-area banner-slider-active" style="max-height: 600px;">

	            <!-- Single Banner -->
	            <div class="banner justify-content-center align-items-center bg-parallax" style="background-image: url(<? echo get_field('фотка_места', 121); ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
	                <div class="container">
	                    
	                </div>
	            </div>
        	</div>

			<div class="cr-section">
				<div class="row">
					<div class="col-12">
						<iframe src="https://yandex.ru/map-widget/v1/-/CBuZEIa1XD" width="100%" height="400" frameborder="1" allowfullscreen="true"></iframe>
					</div>
				</div>
			</div>
        </main>
        <!--// Page Content -->

        <!-- Footer -->
<? get_footer(); ?>