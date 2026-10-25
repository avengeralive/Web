<?php /* Template Name: Контакты */ get_header(); ?>

	<section class="contacts">
		<div class="container">
			<div class="bread-crumbs">
				<div class="bread-crumbs__wrapper">
					<a href="/">Главная</a>
					<span> > </span>
					<p><?php the_title(); ?></p>
				</div>
			</div>
			<div class="title title__blog-page">
				<h2> будем рады с вами познакомится </h2>
			</div>
			<div class="contacts__content">
				<?php the_content(); ?>
			</div>
		</div>
	</section>

<?php get_footer(); ?>