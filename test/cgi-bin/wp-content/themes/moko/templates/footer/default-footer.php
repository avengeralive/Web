<?php
/**
 * Footer Template  File
 *
 * @package MOKO
 * @author  Noor Tech
 * @version 1.0
 */

$options = moko_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' ); ?>

	<!-- Main Footer -->
    <footer class="main-footer style-three">
		<?php if ( is_active_sidebar( 'footer-sidebar' ) ) { ?>
		<div class="pattern-layer" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-3.png'); ?>)"></div>
		<div class="pattern-layer-two" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-4.png'); ?>)"></div>
		<div class="pattern-layer-three" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-5.png'); ?>)"></div>
		<?php } ?>
		
    	<div class="auto-container">
        	<?php if ( is_active_sidebar( 'footer-sidebar' ) ) { ?>
			<!--Widgets Section-->
            <div class="widgets-section">
            	<div class="row clearfix">
                	<?php dynamic_sidebar( 'footer-sidebar' ); ?>
				</div>
			</div>
			<?php } ?>
			
			<!-- Footer Bottom -->
			<div class="footer-bottom">
				<div class="copyright"><?php echo wp_kses( $options->get( 'copyrights_v1', 'Copyright &copy; 2021. All Rights Reserved By <a href="https://themeforest.net/user/noor_tech" target="_blank">noor_tech.</a>' ), $allowed_html ); ?></div>
			</div>
		</div>
	</footer>
	<!-- End Main Footer -->
    