<?php get_header();
$data = \MOKO\Includes\Classes\Common::instance()->data('single-project')->get(); ?>

<!-- Page Title Section -->
<section class="page-title" style="background-image: url(<?php echo esc_url( $data->get( 'banner' ) ); ?>)">
	<?php if($data->get( 'banner' )) { ?>
	<div class="pattern-layer-one" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/main-slider/pattern-1.png'); ?>)"></div>
	<div class="pattern-layer-two" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-17.png'); ?>)"></div>
	<div class="pattern-layer-three" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-18.png'); ?>)"></div>
	<div class="pattern-layer-four" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/cross-icon.png'); ?>)"></div>
	<?php } ?>
	<div class="auto-container">
		<h2><?php if( $data->get( 'title' ) ) echo wp_kses( $data->get( 'title' ), true ); else wp_title( '' ); ?></h2>
		<ul class="page-breadcrumb">
			<?php echo moko_the_breadcrumb(); ?>
		</ul>
	</div>
</section>
<!-- End Page Title Section -->

<?php while (have_posts()) : the_post(); ?>

<!-- Gallery Detail Section -->
<section class="gallery-detail-section">
	<div class="auto-container">
		<div class="inner-container">
			<!-- Info Section -->
			<div class="upper-box">
				<div class="row clearfix">
					<?php if( $options->get( 'single_project_published' ) ) { ?>
					<!-- Column -->
					<div class="column col-lg-3 col-md-6 col-sm-12">
						<ul class="list">
							<li><strong><?php esc_html_e('PUBLISHED', 'moko'); ?></strong></li>
							<li><?php echo wp_kses(get_post_meta( get_the_id(), 'published', true ), true ); ?></li>
						</ul>
					</div>
					<?php } ?>
					
					<?php if( $options->get( 'single_project_category' ) ) { ?>
					<!-- Column -->
					<div class="column col-lg-3 col-md-6 col-sm-12">
						<ul class="list">
							<li><strong><?php esc_html_e('CATEGORY', 'moko'); ?></strong></li>
							<li><?php echo wp_kses(get_post_meta( get_the_id(), 'category', true ), true ); ?></li>
						</ul>
					</div>
					<?php } ?>
					
					<?php if( $options->get( 'single_project_client' ) ) { ?>
					<!-- Column -->
					<div class="column col-lg-3 col-md-6 col-sm-12">
						<ul class="list">
							<li><strong><?php esc_html_e('CLIENT', 'moko'); ?></strong></li>
							<li><?php echo wp_kses(get_post_meta( get_the_id(), 'client', true ), true ); ?></li>
						</ul>
					</div>
					<?php } ?>
					
					<?php if(function_exists('moko_share_us_three')): ?>
					<!-- Column -->
					<div class="column col-lg-3 col-md-6 col-sm-12 text-right">
						<!-- Social Box -->
						<?php echo wp_kses(moko_share_us_three(get_the_id(), $post->post_name ), true); ?>
					</div>
					<?php endif; ?>
					
				</div>
			</div>
			<div class="inner-box">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>
<!-- End Gallery Detail Section -->

<?php endwhile; ?>

<?php get_footer(); ?>