<? get_header(); 
the_post();
?>
<section class="main_slider">
	<div class="container-custom">
		<div class="row">
			<div class="col-lg-12 heading text-center">
				<h2><? the_title(); ?></h2>
				<hr style="margin: 25px 0px;">
			</div>
			<div class="col-md-9">
				<div class="info">
					<ul>
						<li><img src="<? echo get_template_directory_uri(); ?>/images/calendar.png"> <? echo get_field('дата_проведения', get_the_ID()); ?></li>
						<li><img src="<? echo get_template_directory_uri(); ?>/images/clock-circular-outline.png"> <? echo get_field('время_проведения', get_the_ID()); ?></li>
						<li><img src="<? echo get_template_directory_uri(); ?>/images/location-pointer.png"> <? echo get_field('место_проведения', get_the_ID()); ?></li>
						<? $terms = get_the_terms($event->ID, 'event_category'); ?>
						<? foreach ($terms as $term) { ?>
						<li class="ev-type <? echo $term->slug; ?>"><? echo $term->name; ?></li>
						<? } ?>
					</ul>
					<hr style="margin: 25px 0px;">
				</div>
				<div class="inner">
					<nav>
					  	<div class="nav nav-tabs" id="nav-tab" role="tablist">
						    <a class="nav-item nav-link active" id="nav-description-tab" data-toggle="tab" href="#nav-description" role="tab" aria-controls="nav-description" aria-selected="true">Описание</a>
						    <a class="nav-item nav-link" id="nav-video-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-video" aria-selected="false">Видео</a>
						    <a class="nav-item nav-link" id="nav-materials-tab" data-toggle="tab" href="#nav-materials" role="tab" aria-controls="nav-materials" aria-selected="false">Метериалы</a>
						    <a class="nav-item nav-link" id="nav-testing-tab" data-toggle="tab" href="#nav-testing" role="tab" aria-controls="nav-testing" aria-selected="false">Тестирование</a>
					  	</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
							<? the_content(); ?>
							<hr style="margin: 50px 0px;">
							<h3>Содержание мероприятия</h3>
							<? foreach (get_field('содержание_мероприятия', get_the_ID()) as $inner) { ?>
								<h4 style="margin: 15px 0px;"><? echo $inner['заголовок_блока']; ?></h4>
								<? foreach ($inner['пункты'] as $pt) { ?>
									<p style="margin: 0px;"><? echo $pt['пункт']; ?></p>			
								<? } ?>
								<hr style="margin: 10px 0px;">
							<? } ?>
							<h3 style="margin-top: 25px;">Спикеры</h3>
							<div class="row" style="margin-left: 0px; margin-right: 0px; margin-top: 25px;">
								<div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
									<? foreach (get_field('спикеры', get_the_ID()) as $speaker) { ?>
									<img src="<? echo $speaker['фото']; ?>" style="width: 120px; height: 120px; border-radius: 60px;">
									<p class="text-center"><? echo $speaker['имя']; ?></p>
								<? } ?>
								</div>
							</div>
							
						</div>
						<div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
							<? echo get_field('видео', get_the_ID()); ?>
						</div>
						<div class="tab-pane fade" id="nav-materials" role="tabpanel" aria-labelledby="nav-materials-tab">
							<? foreach (get_field('материалы', get_the_ID()) as $material) { ?>
								<div class="row file">
									<p><img src=""> <? echo $material['название'] ?> <a href="">Скачать <i class="fas fa-download"></i></a><p>
								</div>
							<? } ?>
						</div>
						<div class="tab-pane fade" id="nav-testing" role="tabpanel" aria-labelledby="nav-testing-tab">

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="col-sm-12">
						<a href="#" class="register_event">Зарегистрироваться</a>
					</div>
					<div class="col-sm-12">
						
					</div>
					<div class="col-sm-12 allevents">
						<div class="row">
							<div class="col-sm-12">
								<h2 class='text-center'>Все мероприятия</h2>
							</div>
							<div class="col-sm-12">
								<div class="row">
<?
$events = get_posts(array('post_type' => 'events', 'posts_per_page' => 3, 
		'meta_query'	=> array(
			array(
				'key'	 	=> 'дата',
				'value'	  	=> date('d-m-Y'),
				'compare' 	=> '>=',
			)
		) 
	));
	foreach ($events as $event) {
?>
									<div class="col-sm-12 event">
										<div class="row">
											<div class="col-sm-6">
												<ul class="info">
													<li><img src="<? echo get_template_directory_uri(); ?>/images/calendar.png"> <? echo get_field('дата_проведения', $event->ID); ?></li>
													<li><img src="<? echo get_template_directory_uri(); ?>/images/clock-circular-outline.png"> <? echo get_field('время_проведения', $event->ID); ?></li>
													<li><img src="<? echo get_template_directory_uri(); ?>/images/location-pointer.png"> <? echo get_field('место_проведения', $event->ID); ?></li>
												</ul>
											</div>
											<div class="col-sm-6">
												<? $terms = get_the_terms($event->ID, 'event_category'); ?>
												<ul class="info last">
													<? foreach ($terms as $term) { ?>
													<li class="<? echo $term->slug; ?>"><? echo $term->name; ?></li>
													<? } ?>
												</ul>
											</div>
											<div class="col-sm-12">
												<a href="<? echo $event->guid; ?>" class="more">Подробнее</a>
											</div>
										</div>
									</div>
<? } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<? get_footer(); ?>