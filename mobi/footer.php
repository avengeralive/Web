<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage FIXTEAM
 * @since FIXTEAM 1.0
 */

						// Widgets area inside page content
						fixteam_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					fixteam_create_widgets_area('widgets_below_page');

					$fixteam_body_style = fixteam_get_theme_option('body_style');
					if ($fixteam_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$fixteam_footer_type = fixteam_get_theme_option("footer_type");
			if ($fixteam_footer_type == 'custom' && !fixteam_is_layouts_available())
				$fixteam_footer_type = 'default';
			get_template_part( "templates/footer-{$fixteam_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (fixteam_is_on(fixteam_get_theme_option('debug_mode')) && fixteam_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(fixteam_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>