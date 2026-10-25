<? get_header(); ?>
		<section class="main_slider">
			<div class="layer">
				<div class="container-custom">
					<div class="row">
						<div class="col-lg-4 img-cont">
							<img src="<? echo get_template_directory_uri(); ?>/images/lo.png">
							<h2>Карьерный<br>конструктор</h2>
						</div>
						<div class="col-lg-8">
							<div class="ev-slider">
								<div class="row">
									<div id="events" class="carousel slide" data-ride="carousel">
									  	<div class="carousel-inner">
<?
	$events = get_posts(array('post_type' => 'events', 'posts_per_page' => 999, 
		'meta_query'	=> array(
			array(
				'key'	 	=> 'дата',
				'value'	  	=> date('d-m-Y'),
				'compare' 	=> '>=',
			)
		) 
	));
	foreach ($events as $key=>$event) {
?>
											<div class="carousel-item <? if ($key == 0) { ?>active<? } ?>">
									      		<div class="row">
									      			<div class="col-12">
														<h3><? echo $event->post_title; ?></h3>
														<? foreach (get_field('спикеры', $event->ID) as $speaker) { ?>
														<h4><? echo $speaker['имя']; ?></h4>
														<? } ?>
														<? $terms = get_the_terms($event->ID, 'event_category'); ?>
														<? foreach ($terms as $term) { ?>
														<h4 class="ev-type <? echo $term->slug; ?>"><? echo $term->name; ?></h4>
														<? } ?>
													</div>
													<div class="col-12">
														<a href="<? echo $event->guid; ?>" class="more">Подробнее</a>
													</div>
									      		</div>
									    	</div>
<? } ?>
									  	</div>
										<a class="carousel-control-prev" href="#events" role="button" data-slide="prev">
										    <span class="carousel-control-prev-icon" aria-hidden="true"><img src="<? echo get_template_directory_uri(); ?>/images/arrow-left.png"></span>
										    <span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#events" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"><img src="<? echo get_template_directory_uri(); ?>/images/arrow-right.png"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="about">
			<div class="container-custom">
				<div class="row">
					<div class="col-lg-6 text">
						<h1>О проекте</h1>
						<p>Формирование творческой среды, развивающей<br>лидерские и творческиеспособности обучающихся<br>в новом формате, направленном на взаимодействие<br>студентов и аспирантов, преподавателей, тренеров,<br>представителей бизнес сообщества и органов<br>государственной власти в рамках разработки и<br>внедрения социально-значимых проектов на стыке<br>областей знания.</p>
						<a href="/o-proekte/">Подробнее</a>
					</div>
					<div class="col-lg-6">
						<img src="<? echo get_template_directory_uri(); ?>/images/about.png" style="width: 100%;">
					</div>
				</div>
			</div>
		</section>
		<section class="advantages">
			<div class="layer">
				<div class="container-custom">
					<div class="row">
						<div class="col-lg-12">
							<h2 class="text-center">Преимущества</h2>
						</div>
						<div class="col-md-6 col-lg-3 icons">
							<img src="<? echo get_template_directory_uri(); ?>/images/clock.png">
							<h3>Сконструируй карьеру и создай<br>бизнес</h3>
						</div>
						<div class="col-md-6 col-lg-3 icons">
							<img src="<? echo get_template_directory_uri(); ?>/images/open-book.png">
							<h3>Получи знания<br>экспертов-практиков</h3>
						</div>
						<div class="col-md-6 col-lg-3 icons">
							<img src="<? echo get_template_directory_uri(); ?>/images/network.png">
							<h3>Решай кейсы в составе<br>сильной команды</h3>
						</div>
						<div class="col-md-6 col-lg-3 icons">
							<img src="<? echo get_template_directory_uri(); ?>/images/art.png">
							<h3>Выйди на новый<br>компетентностный уровень</h3>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="calendar">
			<div class="container-custom">
				<div class="row">
					<div class="col-lg-4 col-md-8">
						<div class="calendar_box">
							<h2>Календарь мероприятий</h2>
							<hr>
							<div id="calendar"></div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4">
						<div class="program_box">
							<h2>Блоки программы</h2>
							<label class="lichnost"><input name="personal" type="checkbox"><i class="fas fa-check"></i> Личность</label>

							<label class="biznes"><input type="checkbox"><i class="fas fa-check"></i> Бизнес</label>
							<label class="professiya"><input type="checkbox"><i class="fas fa-check"></i> Профессия</label>
							<h2>Участие</h2>
							<label><input type="checkbox"><i class="fas fa-check"></i> Очно</label>
							<label><input type="checkbox"><i class="fas fa-check"></i> Дистанционно</label>
							<h2>Циклы обучения</h2>
							<label><input type="checkbox"><i class="fas fa-check"></i> Первый</label>
							<label><input type="checkbox"><i class="fas fa-check"></i> Второй</label>
							<label><input type="checkbox"><i class="fas fa-check"></i> Третий</label>
							<label><input type="checkbox"><i class="fas fa-check"></i> Четвертый</label>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="row">
							<div class="col-lg-12 arrows">
								<a href="#"><img src="<? echo get_template_directory_uri(); ?>/images/arrow-top.png"></a>	
							</div>
							<div class="col-lg-12">
<?
	$events = get_posts(array('post_type' => 'events', 'posts_per_page' => 3 ));
	foreach ($events as $event) {
?>
								<div class="program_slide">
									<h3><? echo $event->post_title; ?></h3>
									<ul class="info">
										<li><img src="<? echo get_template_directory_uri(); ?>/images/calendar.png"> <? echo get_field('дата_проведения', $event->ID); ?></li>
										<li><img src="<? echo get_template_directory_uri(); ?>/images/clock-circular-outline.png"> <? echo get_field('время_проведения', $event->ID); ?></li>
										<li><img src="<? echo get_template_directory_uri(); ?>/images/location-pointer.png"> <? echo get_field('место_проведения', $event->ID); ?></li>
									</ul>
									<? foreach (get_field('спикеры', $event->ID) as $speaker) { ?>
									<ul class="info">
										<li><? echo $speaker['имя']; ?></li>
										<li><? echo $speaker['место_работы']; ?></li>
									</ul>	
									<? } ?>
									<? $terms = get_the_terms($event->ID, 'event_category'); ?>
									<ul class="info last">
										<? foreach ($terms as $term) { ?>
										<li class="<? echo $term->slug; ?>"><? echo $term->name; ?></li>
										<? } ?>
										<li><a href="<? echo $event->guid; ?>">Подробнее</a></li>
									</ul>
								</div>
<? } ?>
							<div class="col-lg-12 arrows">
								<a href="#"><img src="<? echo get_template_directory_uri(); ?>/images/arrow-bottom.png"></a>	
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</section>
		<section class="model">
			<div class="container-custom">
				<div class="row">
					<div class="col-lg-12">
						<h2>Модель обучения</h2>
					</div>
					<div class="col-lg-4 model_block">
						<div class="block_inner">
							<img src="<? echo get_template_directory_uri(); ?>/images/model1.png">
							<hr>
							<h3>Регистрация на портале</h3>
						</div>
					</div>
					<div class="col-lg-4 model_block">
						<div class="block_inner">
							<img src="<? echo get_template_directory_uri(); ?>/images/model2.png">
							<hr>
							<h3>Приобретение компетенций</h3>
						</div>
					</div>
					<div class="col-lg-4 model_block">
						<div class="block_inner">
							<img src="<? echo get_template_directory_uri(); ?>/images/model3.png">
							<hr>                                                    
							<h3>Получение сертификата</h3>
						</div>
					</div>
					<div class="col-lg-12">
						
					</div>
					<div class="col-lg-12">
						<a href="#" class="btncs">Проверить сертификат</a>
					</div>
				</div>
			</div>
		</section>
		<section class="news">
			<div class="container-custom">
				<div class="row">
					<div class="col-lg-12">
						<h2>Новости</h2>
					</div>
					<div class="col-lg-12">
						<div id="news" class="carousel slide" data-ride="carousel">
						  	<ol class="carousel-indicators">
						    	<li data-target="#news" data-slide-to="0" class="active"></li>
						    	<li data-target="#news" data-slide-to="1"></li>
						  	</ol>
						  	<div class="carousel-inner">
						    	<div class="carousel-item active">
						      		<div class="row">
						      			<div class="col-lg-4">
						      				<div class="newsitem">
						      					<span class="date">12 августа, 2018</span>
						      					<img src="<? echo get_template_directory_uri(); ?>/images/news.png">
						      					<h3>День России</h3>
						      					<p>Уважаемые участники, 12 июня - это государственный праздник Российской федерации. Отмечается ежегодно с 1992 г.</p>
						      				</div>	
						      			</div>
						      			<div class="col-lg-4">
						      				<div class="newsitem">
						      					<span class="date">12 августа, 2018</span>
						      					<img src="<? echo get_template_directory_uri(); ?>/images/news.png">
						      					<h3>День России</h3>
						      					<p>Уважаемые участники, 12 июня - это государственный праздник Российской федерации. Отмечается ежегодно с 1992 г.</p>
						      				</div>
						      			</div>
						      			<div class="col-lg-4">
						      				<div class="newsitem">
						      					<span class="date">12 августа, 2018</span>
						      					<img src="<? echo get_template_directory_uri(); ?>/images/news.png">
						      					<h3>День России</h3>
						      					<p>Уважаемые участники, 12 июня - это государственный праздник Российской федерации. Отмечается ежегодно с 1992 г.</p>
						      				</div>
						      			</div>
						      		</div>
						    	</div>
							    <div class="carousel-item">
							      	<div class="row">
						      			<div class="col-lg-4">
						      				<div class="newsitem">
						      					<span class="date">12 августа, 2018</span>
						      					<img src="<? echo get_template_directory_uri(); ?>/images/news.png">
						      					<h3>День России</h3>
						      					<p>Уважаемые участники, 12 июня - это государственный праздник Российской федерации. Отмечается ежегодно с 1992 г.</p>
						      				</div>
						      			</div>
						      			<div class="col-lg-4">
						      				<div class="newsitem">
						      					<span class="date">12 августа, 2018</span>
						      					<img src="<? echo get_template_directory_uri(); ?>/images/news.png">
						      					<h3>День России</h3>
						      					<p>Уважаемые участники, 12 июня - это государственный праздник Российской федерации. Отмечается ежегодно с 1992 г.</p>
						      				</div>
						      			</div>
						      			<div class="col-lg-4">
						      				<div class="newsitem">
						      					<span class="date">12 августа, 2018</span>
						      					<img src="<? echo get_template_directory_uri(); ?>/images/news.png">
						      					<h3>День России</h3>
						      					<p>Уважаемые участники, 12 июня - это государственный праздник Российской федерации. Отмечается ежегодно с 1992 г.</p>
						      				</div>
						      			</div>
						      		</div>
							    </div>
						  	</div>
						</div>
						<a href="#" class="allnews">Все новости</a>
					</div>
				</div>
			</div>
		</section>
		<section class="partners">
			<div class="container-custom">
				<div class="row">
					<div class="col-lg-12">
						<h2>Наши партнеры</h2>
					</div>
					<div class="col-lg-12">
						<div id="partners" class="carousel slide" data-ride="carousel">
						  	<ol class="carousel-indicators">
						    	<li data-target="#partners" data-slide-to="0" class="active"></li>
						    	<li data-target="#partners" data-slide-to="1"></li>
						  	</ol>
						  	<div class="carousel-inner">
						    	<div class="carousel-item active">
						      		<div class="row">
						      			<div class="col-lg-4">
						      				<div class="block_inner">
						      					<img src="<? echo get_template_directory_uri(); ?>/images/gazprom.png">
						      				</div>
						      			</div>
						      			<div class="col-lg-4">
						      				<div class="block_inner">
						      					<img src="<? echo get_template_directory_uri(); ?>/images/gazprom.png">
						      				</div>
						      			</div>
						      			<div class="col-lg-4">
						      				<div class="block_inner">
						      					<img src="<? echo get_template_directory_uri(); ?>/images/gazprom.png">
						      				</div>
						      			</div>
						      		</div>
						    	</div>
							    <div class="carousel-item">
							      	<div class="row">
						      			<div class="col-lg-4">
						      				<div class="block_inner">
						      					<img src="<? echo get_template_directory_uri(); ?>/images/gazprom.png">
						      				</div>
						      			</div>
						      			<div class="col-lg-4">
						      				<div class="block_inner">
						      					<img src="<? echo get_template_directory_uri(); ?>/images/gazprom.png">
						      				</div>
						      			</div>
						      			<div class="col-lg-4">
						      				<div class="block_inner">
						      					<img src="<? echo get_template_directory_uri(); ?>/images/gazprom.png">
						      				</div>
						      			</div>
						      		</div>
							    </div>
						  	</div>
							<a class="carousel-control-prev" href="#partners" role="button" data-slide="prev">
							    <span class="carousel-control-prev-icon" aria-hidden="true"><img src="<? echo get_template_directory_uri(); ?>/images/arrow-left.png"></span>
							    <span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#partners" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"><img src="<? echo get_template_directory_uri(); ?>/images/arrow-right.png"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
<? get_footer(); ?>