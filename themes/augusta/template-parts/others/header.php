<header id="masthead" class="site-header">
	<div class="container">
		<div class="row align-items-center">
			<div class="site-branding col-md-3">
				<div class="site-branding-inner">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title h2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
						<?php
					endif;
					$augusta_description = get_bloginfo( 'description', 'display' );
					if ( $augusta_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $augusta_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div>
			</div>
			<!-- .site-branding col-md-3 -->

			<div class="col-md-9">
				<aside id="header-right" class="header-widget-area">
					<?php dynamic_sidebar( 'header-right' ); ?>
				</aside><!-- #secondary -->
			</div>
			<!-- /.col-md-9 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->

	<div class="augusta-navbar">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav id="site-navigation" class="main-navigation">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
						?>
					</nav><!-- #site-navigation -->
				</div>
				<!-- /.col-md-12 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->
	</div>
</header><!-- #masthead -->
