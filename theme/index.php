<? get_header(); ?>
<?
$section1_header = get_field('секция_1_(заголовок)', 2);
$section1_content = get_field('секция_1_(содержимое)', 2);
$args = array(
		'numberposts'	   => 20,
		'orderby'          => 'date',
		'order'            => 'ASC',
		'post_type'        => 'portfolio',
		'post_status'      => 'publish',
	);
	$portfolio = get_posts( $args );
$args = array(
		'numberposts'	   => 20,
		'orderby'          => 'date',
		'order'            => 'ASC',
		'post_type'        => 'advertis',
		'post_status'      => 'publish',
	);
	$advertis = get_posts( $args );
?>
<section id="studio">
	<div class="container">
		<h2 class="section-title"><? echo $section1_header; ?></h2>
		<? echo $section1_content; ?>
	</div>
</section>
<section id="projects">
	<? foreach ($portfolio as $key => $post) { 
	$image = get_field('изображение', $post->ID);
	if ($key % 2 == 0) {
	?>
	<div class="row portfolio_item">
		<div class="col-sm-6 col-md-4 prtf_backstage">
		</div>
		<div class="col-sm-6 col-md-8">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-6 portfolio_image">
					<img src="<? echo $image; ?>">
				</div>
				<div class="col-sm-6 col-md-6 portfolio_description">
					<h3 class="portfolio_title"><? echo $post->post_title; ?></h3>
					<? echo $post->post_content; ?>
				</div>
			</div>
		</div>
	</div>
	<? } else { ?>
	<div class="row portfolio_item">
		<div class="col-sm-6 col-md-8">
		</div>
		<div class="col-sm-6 col-md-4 prtf_backstage">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-6 portfolio_image mobile">
					<img src="<? echo $image; ?>">
				</div>
				<div class="col-sm-6 col-md-6 portfolio_description">
					<h3 class="portfolio_title"><? echo $post->post_title; ?></h3>
					<? echo $post->post_content; ?>
				</div>
				<div class="col-sm-6 col-md-6 portfolio_image desctop">
					<img src="<? echo $image; ?>">
				</div>
			</div>
		</div>
	</div>
	<? } ?>
	<? } ?>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="section-title">Реклама</h2>
			</div>
			<? foreach ($advertis as $key => $post) { ?>
			<div class="adv_item col-12 col-sm-6 col-md-4">
				<? echo $post->post_content; ?>
			</div>
			<? } ?>
		</div>
	</div>
</section>

<section id="contacts">
	<div class="row">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1255.7300778634155!2d37.57239900817523!3d55.76659076406693!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54a2e4f3ec959%3A0xd2c9e0b892824af4!2z0JzQsNC70LDRjyDQk9GA0YPQt9C40L3RgdC60LDRjyDRg9C7LiwgMjgsINCc0L7RgdC60LLQsCwgMTIzNTU3!5e0!3m2!1sru!2sru!4v1520775303366" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	<div class="row footerlayer">
		<div class="col-12 col-sm-2 col-md-3"></div>
		<div class="col-12 col-sm-8 col-md-6 feedback">
			<div class="row">
				<div class="col-12">
					<h3>Связаться с нами</h3>
				</div>
				<div class="col-12 col-sm-6">
					<div class="row addr">
						<div class="col-2">
							<i class="fas fa-map-marker"></i>
						</div>
						<div class="col-10">
							123557, г. Москва, ул. Малая Грузинская, дом 28 офис 57
						</div>
					</div>
					<div class="row addr">
						<div class="col-2">
							<i class="fas fa-phone"></i>
						</div>
						<div class="col-10">
							+7 495 796-72-70
						</div>
					</div>
					<div class="row addr">
						<div class="col-2">
							<i class="fas fa-at"></i>
						</div>
						<div class="col-10">
							
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-6">
					<? echo do_shortcode('[contact-form-7 id="26"]'); ?>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-2 col-md-3"></div>
		<div class="col-12 col-sm-2 col-md-3"></div>
		<div class="col-12 col-sm-8 col-md-6">
			<ul class="footermenu">
				<li class="nav-item">
					<a class="nav-link" href="#studio">Студия <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#projects">Работы</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Команда</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#contacts">Контакты</a>
				</li>
			</ul>
		</div>
		<div class="col-12 col-sm-2 col-md-3"></div>
		<div class="col-12">
			<p class="text-center copy">
				&copy; Мэйнстрим фильм 2018
			</p>
		</div>
	</div>
</section>

<? get_footer(); ?>