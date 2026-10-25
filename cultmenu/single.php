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

			<div class="quote">
				<div class="quote-txt">
					<?php the_excerpt(); ?>
				</div>
			</div>

			<h2><?php the_title() ?></h2>
			<p><?php the_content(); ?></p>
			<div class="single-slide">
				<div class='slide'>
					<input type="radio" name="slider2" id="slider2_1" checked="checked">
					<label for="slider2_1"></label>
					<div class="sld">
						<img src="<?php bloginfo('template_url'); ?>/images/10.jpg" height="530" width="530">
					</div>
					<label for="slider2_2"></label>
					<input type="radio" name="slider2" id="slider2_2">
					<label for="slider2_2"></label>
					<div class="sld"> 
						<img src="<?php bloginfo('template_url'); ?>/images/11.jpg" height="530" width="530">
					</div>
					<label for="slider2_3"></label>
					<input type="radio" name="slider2" id="slider2_3">
					<label for="slider2_3"></label>
					<div class="sld"> 
						<img src="<?php bloginfo('template_url'); ?>/images/12.jpg" height="530" width="530">
					</div>
					<label for="slider2_4">
					</label>
				</div>
			</div>
			<p><?php the_content(); ?></p>		
			<div class="buy">
				<div class="buy-txt">
					<h3 class="buy-name"><?php the_title(); ?></h>
					<p><?php the_time('j.m.Y'); ?></p>
					<p>Time</p>
					<a href=""></a>
					<button class="buy-ticket">Купить билет</button>
				</div>
			</div>
		</div>	
	</div>								
			
</section>

<?php get_footer(); ?>