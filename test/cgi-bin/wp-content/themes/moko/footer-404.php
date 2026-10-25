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
    <footer class="main-footer">
		<div class="pattern-layer" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-3.png'); ?>)"></div>
		<div class="pattern-layer-two" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-4.png'); ?>)"></div>
		<div class="pattern-layer-three" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pattern-5.png'); ?>)"></div>
		
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
				<div class="copyright"><?php echo wp_kses( $options->get( 'copyrights_v3' ), $allowed_html ); ?></div>
			</div>
		</div>
	</footer>
	<!-- End Main Footer -->
    
    <?php if( $options->get('show_search_v1') or $options->get('show_search_v2') or $options->get('show_search_v3') or $options->get('show_search_v4') ): ?>
    <!-- Search Popup -->
    <div class="search-popup">
        <button class="close-search style-two"><span class="flaticon-multiply"></span></button>
        <button class="close-search"><span class="fa fa-arrow-up"></span></button>
        <?php echo get_template_part('searchform1'); ?>
    </div>
    <!-- End Header Search -->
    <?php endif; ?>

    <!-- Scroll To Top -->
    <div class="back-to-top scroll-to-target show-back-to-top" data-target="html"><?php esc_html_e('TOP', 'moko'); ?></div>
    
</div>

<?php wp_footer(); ?>
</body>
</html>
    