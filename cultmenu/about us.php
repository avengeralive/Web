<?php get_header(); ?>
<?php get_template_part( 'template-parts/breadcrumbs'); ?>

<section class="post_blog_bg primary-bg">
	<div class="container">
		<div class="single-content">	
			<?php if ( have_posts() ) : while (have_posts() ) : the_post(); ?>
			<img src="<?php bloginfo('template_url'); ?>/images/10.jpg" height="500" width="1300">
			<h2><?php the_title(); ?></h2>
			<p><?php the_content(); ?></p>
			<?php endwhile; ?>

			<?php else: ?>

			<?php endif; ?>
	
			<div class="info">
				<h1 class="name-info-1">СЛЕДИ ЗА НАМИ:</h1>

				<h1 class="name-info-2">ЕСЛИ У ВАС ЕСТЬ ВОПРОСЫ ИЛИ ОТЗЫВЫ:</h1>
				<P class="hello">Email: <?php bloginfo('admin_email'); ?></P>
				<P class="hello">Email: <?php bloginfo('admin_email'); ?></P>
			</div>
		</div>								
			
</section>

<?php get_footer(); ?>