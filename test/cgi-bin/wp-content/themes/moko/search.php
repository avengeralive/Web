<?php
/**
 * Tag Main File.
 *
 * @package MOKO
 * @author  Noor Tech
 * @version 1.0
 */

get_header();
global $wp_query;
$data  = \MOKO\Includes\Classes\Common::instance()->data( 'search' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
$layout = ( $layout ) ? $layout : 'right';
$sidebar = ( $sidebar ) ? $sidebar : 'default-sidebar';
if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
$class = ( !$layout || $layout == 'full' ) ? 'col-xs-12 col-sm-12 col-md-12' : 'col-xs-12 col-sm-12 col-md-12 col-lg-8';
if ( class_exists( '\Elementor\Plugin' ) AND $data->get( 'tpl-type' ) == 'e' AND $data->get( 'tpl-elementor' ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'tpl-elementor' ) );
} else {
	?>
	
<?php if ( class_exists( '\Elementor\Plugin' )): ?>
	<?php do_action( 'moko_banner', $data ); ?>
<?php else: ?>
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
<?php endif; ?>

<!--Start blog area-->
<section class="sidebar-page-container sec-pad-2 blog-standard">
	<div class="auto-container">
		<div class="row clearfix">
			<?php
					if ( $data->get( 'layout' ) == 'left' ) {
						do_action( 'moko_sidebar', $data );
					}
			?>
			<div class="content-side <?php echo esc_attr( $class ); ?>">
				<?php if( have_posts() ) : ?>
				<div class="thm-unit-test">
					<?php
						while ( have_posts() ) :
							the_post();
							moko_template_load( 'templates/blog/blog.php', compact( 'data' ) );
						endwhile;
						wp_reset_postdata();
					?>
				</div>

				<!--Pagination-->
				<div class="styled-pagination text-center">
					<?php moko_the_pagination( $wp_query->max_num_pages );?>
				</div>

				<?php else : ?>
				
				<div class="search-notfound">
					<h4><?php printf(esc_html__( 'No result found for "%s"', 'moko' ), get_search_query()); ?></h4>
					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'moko' ); ?></p>
					<div class="sidebar search-search-form">
						<?php get_search_form(); ?>
					</div>
				</div>

				<?php endif; ?>
			</div>
			<?php
				if ( $data->get( 'layout' ) == 'right' ) {
					do_action( 'moko_sidebar', $data );
				}
			?>
		</div>
	</div>
</section> 
<!--End blog area-->
<?php
}
get_footer();

