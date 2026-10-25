<?php
/**
 * Footer Template  File
 *
 * @package MOKO
 * @author  Noor Tech
 * @version 1.0
 */

$options = moko_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' );

$footer_bg = $options->get( 'footer_bg_img_v2' );
$footer_bg = moko_set( $footer_bg, 'url', MOKO_URI . 'assets/images/background/map-pattern-2.png' ); ?>
	
	<!-- Footer Style Two -->
    <footer class="footer-style-two" style="background-image: url(<?php echo esc_url($footer_bg); ?>)">
    	<?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) { ?>
		<div class="auto-container">
        	<!--Widgets Section-->
            <div class="widgets-section">
            	<div class="row clearfix">
                	<?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<!-- Footer Bottom -->
		<div class="footer-bottom">
			<div class="auto-container">
				<div class="row clearfix">
					<!-- Copyright Column -->
					<div class="copyright-column col-lg-6 col-md-12 col-sm-12">
						<div class="copyright"><?php echo wp_kses( $options->get( 'copyrights_v2', 'Copyright &copy; 2021. All Rights Reserved By <a href="https://themeforest.net/user/noor_tech" target="_blank">noor_tech.</a>' ), $allowed_html ); ?></div>
					</div>
					
					<!-- Nav Column -->
					<div class="nav-column col-lg-6 col-md-12 col-sm-12">
						<ul>
							<?php wp_nav_menu( array( 'theme_location' => 'footer_menu', 'container_id' => 'navbar-collapse-1',
								'container_class'=>'navbar-collapse collapse navbar-right',
								'menu_class'=>'nav navbar-nav',
								'fallback_cb'=>false, 
								'items_wrap' => '%3$s', 
								'container'=>false,
								'depth'=>'3',
								'walker'=> new Bootstrap_walker()  
							) ); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Main Footer -->
