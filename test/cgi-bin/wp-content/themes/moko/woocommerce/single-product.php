<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );
$data    = \MOKO\Includes\Classes\Common::instance()->data( 'single' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
$layout = ( $layout ) ? $layout : 'full';
$sidebar = ( $sidebar ) ? $sidebar : 'product-sidebar';
$class = ( !$layout || $layout == 'full' ) ? 'content-side col-lg-12 col-md-12 col-sm-12' : 'content-side col-lg-8 col-md-12 col-sm-12';
if ( class_exists( '\Elementor\Plugin' ) && $data->get( 'tpl-type' ) == 'e') {
	
	while(have_posts()) {
	   the_post();
	   the_content();
    }

} else {
?>

<?php if ( class_exists( '\Elementor\Plugin' )):?>
	<?php do_action( 'moko_banner', $data );?>
<?php else:?>
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

<!-- Sidebar Page Container -->
<div class="sidebar-page-container">
	<div class="auto-container">
		<div class="row clearfix">
			
                <!-- sidebar area -->
                <?php
                    if ( $data->get( 'layout' ) == 'left' ) {
                        do_action( 'moko_sidebar', $data );
                        
                        /**
                         * woocommerce_sidebar hook
                         *
                         * @hooked woocommerce_get_sidebar - 10
                         */
                        do_action( 'woocommerce_sidebar' );
                    }
                ?>
                
                <div class="<?php echo esc_attr($class);?>">
                    <div class="shop-single">
						<div class="product-details">
							<?php
								/**
								 * woocommerce_before_main_content hook
								 *
								 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
								 * @hooked woocommerce_breadcrumb - 20
								 */
								do_action( 'woocommerce_before_main_content' );
							?>
								<?php while ( have_posts() ) : the_post(); ?>
									<?php wc_get_template_part( 'content', 'single-product' ); ?>
								<?php endwhile; // end of the loop. ?>
							<?php
								/**
								 * woocommerce_after_main_content hook
								 *
								 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
								 */
								do_action( 'woocommerce_after_main_content' );
							?>
						</div>
                    </div>
                </div>
            
                <!-- sidebar area -->
                <?php
                    if ( $data->get( 'layout' ) == 'right' ) {
                        do_action( 'moko_sidebar', $data );
                        
                        /**
                         * woocommerce_sidebar hook
                         *
                         * @hooked woocommerce_get_sidebar - 10
                         */
                        do_action( 'woocommerce_sidebar' );
                    }
                ?>
                
            </div>
		</div>
	</div>
</div>
<?php
}
get_footer( 'shop' );
