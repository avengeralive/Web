<?php
/**
 * Banner Template
 *
 * @package    WordPress
 * @subpackage Noor Tech
 * @author     Noor Tech
 * @version    1.0
 */

if ( $data->get( 'enable_banner' ) AND $data->get( 'banner_type' ) == 'e' AND ! empty( $data->get( 'banner_elementor' ) ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'banner_elementor' ) );

	return false;
}

?>
<?php if ( $data->get( 'enable_banner' ) ) : ?>

<!-- Page Title Section -->
<section class="page-title 11" style="background-image: url(<?php echo esc_url( $data->get( 'banner' ) ); ?>)">
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

<?php endif; ?>