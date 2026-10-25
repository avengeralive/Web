<?php get_header(); ?>

	<section class="blog-page">
		<div class="container">
			<div class="bread-crumbs">
				<div class="bread-crumbs__wrapper">
					<a href="/">Главная</a>
					<span> > </span>
					<a href="/blog/">Блог</a>
					<span> > </span>
					<p><?php the_title(); ?></p>
				</div>
			</div>
			<div class="title title__blog-page">
				<h2> <?php the_title(); ?> </h2>
			</div>
			<div class="blog-page__content">
				<?php the_content(); ?>
			</div>
		</div>
	</section>

<?php get_footer(); ?>