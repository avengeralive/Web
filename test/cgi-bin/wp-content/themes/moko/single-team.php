<?php get_header();
$data = \MOKO\Includes\Classes\Common::instance()->data('single-team')->get(); ?>

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

<!-- Team Detail Section -->
<section class="team-single-section">
	<div class="auto-container">
		<div class="row clearfix">

			<!-- Image Column -->
			<div class="image-column col-lg-4 col-md-12 col-sm-12">
				<div class="inner-column wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="image">
						<?php the_post_thumbnail('moko_300x450'); ?>
					</div>
				</div>
			</div>

			<!-- Content Column -->
			<div class="content-column col-lg-8 col-md-12 col-sm-12">
				<div class="inner-column">
					<h2><?php the_title(); ?> <span class="category"><?php echo wp_kses(get_post_meta( get_the_id(), 'designation', true ), true); ?></span></h2>
					<ul class="post-meta">
						<li><span class="icon flaticon-big-envelope"></span> <a href="mailto:<?php echo sanitize_email(get_post_meta( get_the_id(), 'email_address', true )); ?>"><?php echo sanitize_email(get_post_meta( get_the_id(), 'email_address', true )); ?></a></li>
						<li><span class="icon flaticon-phone-call"></span> <a href="tel:<?php echo esc_attr(phone_number(get_post_meta( get_the_id(), 'phone_number', true ))); ?>"><?php echo wp_kses(get_post_meta( get_the_id(), 'phone_number', true ), true); ?></a></li>
						<li><span class="icon fa fa-whatsapp"></span> <a href="https://wa.me/<?php echo esc_attr(phone_number(get_post_meta( get_the_id(), 'whatsapp', true ))); ?>"><?php echo wp_kses(get_post_meta( get_the_id(), 'whatsapp', true ), true); ?></a></li>
					</ul>
					<div class="text">
						<?php the_content(); ?>
					</div>
					
					<?php $features_list = get_post_meta( get_the_id(), 'features', true );
					if(!empty($features_list)){
					$features_list = explode("\n", ($features_list)); ?>
					<div class="row clearfix">
						<div class="column col-lg-12 col-md-12 col-sm-12">
							<ul class="list-style-three">
								<?php foreach($features_list as $features): ?>
								<li><?php echo wp_kses($features, true); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<?php } ?>
					
					<?php
                        $icons = get_post_meta( get_the_id(), 'social_profile', true );
                        if ( ! empty( $icons ) ) :
                    ?>
                    <!-- Social Box -->
					<ul class="social-icon-one">
						<?php foreach ( $icons as $h_icon ) :
							$header_social_icons = json_decode( urldecode( moko_set( $h_icon, 'data' ) ) );
							if ( moko_set( $header_social_icons, 'enable' ) == '' ) {
								continue;
							}
							$icon_class = explode( '-', moko_set( $header_social_icons, 'icon' ) );
                        ?>
                        <li><a href="<?php echo moko_set( $header_social_icons, 'url' ); ?>" style="background-color:<?php echo moko_set( $header_social_icons, 'background' ); ?>; color: <?php echo moko_set( $header_social_icons, 'color' ); ?>" class="fa <?php echo esc_attr( moko_set( $header_social_icons, 'icon' ) ); ?>" target="_blank"></a></li>
                    	<?php endforeach; ?>
					</ul>
                    <?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- End Team Detail Section -->

<?php endwhile; ?>

<?php get_footer(); ?>