<? get_header(); ?>
<section>
	<div class="container">
		<div class="row">
			<?php rewind_posts(); ?>
			<?php wp_reset_query(); ?>
			<?php wp_reset_postdata(); ?>
			<? the_post(); ?>
			<h1 class="page-title"><? the_title(); ?></h1>
			<? the_content(); ?>
		</div>
	</div>
</section>
<? get_footer(); ?>