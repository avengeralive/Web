<?php
/**
 * 404 page file
 *
 * @package    WordPress
 * @subpackage Moko
 * @author     Noor Tech <support@themerange.net>
 * @version    1.0
 */

$allowed_html = wp_kses_allowed_html( 'post' );
$title = sprintf(__('Oops.... Page Not Found', 'moko'), esc_html(home_url('/')));
$text = sprintf(__('Sorry, but the page you are looking for does not existing', 'moko'), esc_html(home_url('/')));
$error_image = $options->get( 'error_page_image' );
$error_image = moko_set( $error_image, 'url', MOKO_URI . 'assets/images/resource/error.svg' ); ?>

<?php get_header();
$data = \MOKO\Includes\Classes\Common::instance()->data( '404' )->get();
do_action( 'moko_banner', $data );
$options = moko_WSH()->option();
if ( class_exists( '\Elementor\Plugin' ) AND $data->get( 'tpl-type' ) == 'e' AND $data->get( 'tpl-elementor' ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'tpl-elementor' ) );
} else {
?>

<!-- Error Section -->
<section class="error-section">
	<div class="auto-container">
		<div class="content">
			<div class="error-image">
				<img src="<?php echo esc_url($error_image); ?>" alt="<?php esc_attr_e('404 Image', 'moko'); ?>" />
			</div>
			<h2><?php echo wp_kses( $options->get('error_page_title'), $allowed_html ) ? wp_kses($options->get('error_page_title' ), $allowed_html ) : $title; ?></h2>
			
			<div class="text"><?php echo wp_kses( $options->get('error_page_text'), $allowed_html ) ? wp_kses($options->get('error_page_text' ), $allowed_html ) : $text; ?></div>
			
			<?php if ( $options->get('back_to_home_btn') ) : ?>
			<a href="<?php echo esc_url(home_url('/')); ?>" class="theme-btn btn-style-five"><span class="txt"><?php echo wp_kses( $options->get('back_home_btn_label'), $allowed_html ) ? wp_kses( $options->get('back_home_btn_label'), $allowed_html ) : esc_html_e( 'Go To Home Page', 'moko' ); ?></span></a>
			<?php endif; ?>
		</div>
	</div>
</section>
<!-- End Error Section -->
    
<?php
}
get_footer('404'); ?>
