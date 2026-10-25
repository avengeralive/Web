<?
/*
Template name: Мероприятия
*/
?>
<? get_header(); ?>
<section class="main_slider">
			<div class="container-custom">
				<div class="row">
					<div class="col-lg-12 heading">
						<h2>Предстоящие</h2>
						<hr>	
					</div>
					<div class="col-lg-12 event_box">
						<div class="row">
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
	foreach ($events as $event) {
?>
							<div class="col-md-6">
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
							</div>
<? } ?>
						</div>		
					</div>
					<div class="col-lg-12 heading">
						<h2>Прошедшие</h2>
						<hr>
					</div>
					<div class="col-lg-12 event_box">
						<div class="row">
<?
	$events = get_posts(array('post_type' => 'events', 'posts_per_page' => 999, 
		'meta_query'	=> array(
			array(
				'key'	 	=> 'дата',
				'value'	  	=> date('d-m-Y'),
				'compare' 	=> '<',
			)
		) 
	));
	foreach ($events as $event) {
?>
							<div class="col-md-6">
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
							</div>
<? } ?>
						</div>		
					</div>
				</div>
			</div>
		</section>
<? get_footer(); ?>