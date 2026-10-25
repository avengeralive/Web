<footer>			
	
	<div class="container">
		<div class="col-xs-12">
			<?php
					wp_nav_menu( array(
						'theme_location' => 'menu',
						'container' => 'false',
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'menu_class' => 'navbar-footer',
						'menu_id' => '',
						'depth' => 1
					) );
				?> 
<ul class="footsoc">	
					<li class="soc-vk-footer">
						<a href="#">
							<img src="<?php bloginfo('template_url'); ?>/images/vk1.png" height="20" width="25"/>
						</a>
					</li>
					<li class="soc-fb-footer">
						<a href="#">
							<img src="<?php bloginfo('template_url'); ?>/images/facebook1.png" height="25" width="25" />	
						</a>
					</li>
					<li class="soc-inst-footer">
						<a href="#">
							<img src="<?php bloginfo('template_url'); ?>/images/instagram1.png" height="20" width="20"/>
						</a>
					</li>
			</ul>
			
		</div>
		<div class="col-xs-12">
				<p class="hello">Email: <?php bloginfo('admin_email'); ?></p>
			</div>
	</div>
				
</footer>

</body>
<?php wp_footer(); ?>
</html>