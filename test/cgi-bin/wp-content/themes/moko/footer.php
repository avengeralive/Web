<?php
/**
 * Footer Main File.
 *
 * @package MOKO
 * @author  Template Path
 * @version 1.0
 */
global $wp_query;
$page_id = ( $wp_query->is_posts_page ) ? $wp_query->queried_object->ID : get_the_ID();
$options = moko_WSH()->option(); 
$allowed_html = wp_kses_allowed_html( 'post' ); ?>

	<div class="clearfix"></div>

	<?php moko_template_load( 'templates/footer/footer.php', compact( 'page_id' ) ); ?>
    
</div><!-- End Page Wrapper -->

<?php if( $options->get('show_search_v1') or $options->get('show_search_v2') or $options->get('show_search_v3') ): ?>
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

<?php wp_footer(); ?>
</body>
</html>
