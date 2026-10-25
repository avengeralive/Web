<?php get_header(); ?>

<section class="blog">
	<div class="container">
		<div class="bread-crumbs">
			<div class="bread-crumbs__wrapper">
				<a href="/">Главная</a>
				<span> > </span>
				<p>Блог</p>
			</div>
		</div>
		<div class="title title__blog">
			<h2> Блог нашего хостела </h2>
		</div>
		<div class="blog__wrapper">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="blog__content">
					<div class="blog__text">
						<div class="blog__text_wrapper">
							<time> <?= get_the_date('d.m.Y'); ?> </time>
							<a href="<?php the_permalink(); ?>">
								<h3> <?php the_title(); ?> </h3>
							</a>
							<p> <?= get_the_excerpt(); ?> </p>
						</div>
						<div class="button button__blog">
							<a href="<?php the_permalink(); ?>"> Подробнее </a>
						</div>
					</div>
					<div class="blog__image">
						<a href="<?php the_permalink(); ?>">
							<img src="<?= get_the_post_thumbnail_url(); ?>" alt=""> </a>
						<div class="blog__image_bg"></div>
					</div>
				</div>
			<?php endwhile; else : ?>
				<p><?php _e( 'Извините, ничего не найдено.' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
