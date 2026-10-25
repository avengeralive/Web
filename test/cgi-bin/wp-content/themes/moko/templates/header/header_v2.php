<?php
$options = moko_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' );

//Logo Settings
$light_image_logo = $options->get( 'image_normal_logo' );
$light_logo_dimension = $options->get( 'normal_logo_dimension' );

$dark_image_logo = $options->get( 'image_normal_logo2' );
$dark_logo_dimension = $options->get( 'normal_logo_dimension2' );

$sticky_image_logo = $options->get( 'image_normal_logo3' );
$sticky_logo_dimension = $options->get( 'normal_logo_dimension3' );

$mobile_sidebar_logo = $options->get( 'image_normal_logo4' );
$mobile_sidebar_logo_dimension = $options->get( 'normal_logo_dimension4' );

$sidebar_logo = $options->get( 'image_normal_logo5' );
$sidebar_logo_dimension = $options->get( 'normal_logo_dimension5' );

$logo_type = '';
$logo_text = '';
$logo_typography = ''; ?>

<div class="<?php if($options->get('theme_boxed')) echo 'box-layout'; ?>">
<div class="page-wrapper <?php if($options->get('theme_dark')) echo 'dark-body'; ?> <?php if($options->get('sticky_menu')) echo 'want-sticky-header'; ?> <?php if($options->get('theme_rtl')) echo 'rtl'; ?>">

	<?php if( $options->get( 'theme_preloader' ) ):?>
   	<!-- Preloader -->
	<div class="preloader">
		<div class="box"></div>
	</div>
	<?php endif; ?>
    
    <!-- Main Header / Header Style Two -->
    <header class="main-header header-style-two">
    	<?php if( $options->get('show_top_bar_v2') ): ?>
		<!-- Header Top -->
        <div class="header-top">
            <div class="auto-container">
                <div class="inner-container clearfix">
					<?php if( $options->get('show_welcome_message_v2') ): ?>
                    <!-- Top Left -->
                    <div class="top-left pull-left">
						<div class="text"><?php echo wp_kses($options->get('welcome_message_v2'), $allowed_html); ?></div>
                    </div>
					<?php endif; ?>
                    
					<?php if( $options->get('show_address_v2') or $options->get('show_email_address_v2') ): ?>
					<!-- Top Right -->
					<div class="top-right pull-right">
						<!-- Info List -->
						<ul class="info-list">
                        	<?php if( $options->get('show_address_v2') ): ?>
							<li><span class="icon flaticon-maps-and-flags"></span> <?php echo wp_kses($options->get('address_v2'), $allowed_html); ?></li>
                            <?php endif; ?>
                            
                            <?php if( $options->get('show_email_address_v2') ): ?>
							<li><span class="icon flaticon-big-envelope"></span><a href="mailto:<?php echo sanitize_email($options->get('email_address_v2')); ?>"> <?php echo sanitize_email($options->get('email_address_v2')); ?></a></li>
                            <?php endif; ?>
						</ul>
					</div>
					<?php endif; ?>
                </div>
            </div>
        </div>
		<?php endif; ?>
        
		<!--Header-Upper-->
        <div class="header-upper">
        	<div class="auto-container clearfix">
				<div class="pull-left logo-box">
					<div class="logo"><?php echo moko_logo( $logo_type, $light_image_logo, $light_logo_dimension, $logo_text, $logo_typography ); ?></div>
				</div>
				
				<div class="nav-outer clearfix">
					<?php if( $options->get('sidebar_info_v2') ): ?>
					<!--Mobile Navigation Toggler-->
					<div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
					<?php endif; ?>
					<!-- Main Menu -->
					<nav class="main-menu navbar-expand-md">
						<div class="navbar-header">
							<!-- Toggle Button -->    	
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						
						<div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
							<ul class="navigation clearfix">
								<?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'container_id' => 'navbar-collapse-1',
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
					</nav>
					
					<!-- Main Menu End-->
					<div class="outer-box clearfix">
                        <?php if( $options->get('show_cart_v2') ):
						if( function_exists( 'WC' ) ): global $woocommerce; ?>
						<!-- Cart Box -->
						<div class="cart-box">
							<div class="dropdown">
								<button class="cart-box-btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flaticon-cart"></span><span class="total-cart"><?php echo wp_kses( $woocommerce->cart->cart_contents_count, $allowed_html ); ?></span></button>
								<div class="dropdown-menu pull-right cart-panel" aria-labelledby="dropdownMenu1">

									<?php get_template_part('templates/widgets/cart_items'); ?>
									
									<div class="cart-total"><?php esc_html_e('Sub Total:', 'moko'); ?> <span><?php echo wp_kses_post($woocommerce->cart->get_cart_total()); ?></span></div>
									<ul class="btns-boxed">
										<?php $cart_url = wc_get_cart_url();
										if ($cart_url) : ?>
										<li><a href="<?php echo esc_url($cart_url); ?>"><?php esc_html_e('View Cart', 'moko'); ?></a></li>
										<?php endif; ?>
														
										<?php $checkout_url = wc_get_checkout_url();
										if ($checkout_url) : ?>
										<li><a href="<?php echo esc_url($checkout_url); ?>"><?php esc_html_e('CheckOut', 'moko'); ?></a></li>
										<?php endif; ?>
									</ul>

								</div>
							</div>
						</div>
                        <?php endif; endif; ?>
						
                        <?php if( $options->get('show_search_v2') ): ?>
						<!-- Search Btn -->
						<div class="search-box-btn search-box-outer"><span class="icon fa fa-search"></span></div>
                        <?php endif; ?>
                        
						<?php if( $options->get('show_button_v2') ):
						if( $options->get('button_link_v2') and $options->get('button_name_v2') ): ?>
						<!-- Quote Btn -->
						<div class="btn-box">
							<a href="<?php echo esc_url($options->get('button_link_v2')); ?>" class="theme-btn btn-style-<?php echo esc_attr($options->get('button_style_v2')); ?>"><span class="txt"><?php echo wp_kses($options->get('button_name_v2'), $allowed_html); ?></span></a>
						</div>
						<?php endif; endif; ?>
                        
                        <?php if( $options->get('sidebar_info_v2') ): ?>
						<!-- Nav Btn -->
						<div class="nav-btn navSidebar-button"><span class="icon flaticon-menu-2"></span></div>
						<?php endif; ?>
					</div>
				</div>
            </div>
        </div>
        <!--End Header Upper-->
        
		<!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <?php echo moko_logo( $logo_type, $sticky_image_logo, $sticky_logo_dimension, $logo_text, $logo_typography ); ?>
                </div>
                <!--Right Col-->
                <div class="pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav><!-- Main Menu End-->
					
					<!-- Main Menu End-->
					<div class="outer-box clearfix">
						<?php if( $options->get('show_cart_v2') ):
						if( function_exists( 'WC' ) ): global $woocommerce; ?>
						<!-- Cart Box -->
						<div class="cart-box">
							<div class="dropdown">
								<button class="cart-box-btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flaticon-cart"></span><span class="total-cart"><?php echo wp_kses( $woocommerce->cart->cart_contents_count, $allowed_html ); ?></span></button>
								<div class="dropdown-menu pull-right cart-panel" aria-labelledby="dropdownMenu2">

									<?php get_template_part('templates/widgets/cart_items'); ?>
									
									<div class="cart-total"><?php esc_html_e('Sub Total:', 'moko'); ?> <span><?php echo wp_kses_post($woocommerce->cart->get_cart_total()); ?></span></div>
									<ul class="btns-boxed">
										<?php $cart_url = wc_get_cart_url();
										if ($cart_url) : ?>
										<li><a href="<?php echo esc_url($cart_url); ?>"><?php esc_html_e('View Cart', 'moko'); ?></a></li>
										<?php endif; ?>
														
										<?php $checkout_url = wc_get_checkout_url();
										if ($checkout_url) : ?>
										<li><a href="<?php echo esc_url($checkout_url); ?>"><?php esc_html_e('CheckOut', 'moko'); ?></a></li>
										<?php endif; ?>
									</ul>

								</div>
							</div>
						</div>
						<?php endif; endif; ?>
                        
                        <?php if( $options->get('show_search_v2') ): ?>
						<!-- Search Btn -->
						<div class="search-box-btn search-box-outer"><span class="icon fa fa-search"></span></div>
						<?php endif; ?>
						
                        <?php if( $options->get('show_button_v2') ): ?>
						<!-- Quote Btn -->
						<div class="btn-box">
							<a href="<?php echo esc_url($options->get('button_link_v2')); ?>" class="theme-btn btn-style-<?php echo esc_attr($options->get('button_style_sticky_v2')); ?>"><span class="txt"><?php echo wp_kses($options->get('button_name_v2'), $allowed_html); ?></span></a>
						</div>
						<?php endif; ?>
						
                        <?php if( $options->get('sidebar_info_v2') ): ?>
						<!-- Nav Btn -->
						<div class="nav-btn navSidebar-button"><span class="icon flaticon-menu"></span></div>
						<?php endif; ?>
					</div>
                </div>
            </div>
        </div>
        <!-- End Sticky Menu -->
    
		<!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-multiply"></span></div>
            
            <nav class="menu-box">
                <div class="nav-logo"><?php echo moko_logo( $logo_type, $mobile_sidebar_logo, $mobile_sidebar_logo_dimension, $logo_text, $logo_typography ); ?></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            </nav>
        </div><!-- End Mobile Menu -->
    </header>
    <!-- End Main Header -->
	
    <?php if( $options->get('sidebar_info_v2') ): ?>
	<!-- Sidebar Cart Item -->
	<div class="xs-sidebar-group info-group">
		<div class="xs-overlay xs-bg-black"></div>
		<div class="xs-sidebar-widget">
			<div class="sidebar-widget-container">
				<div class="widget-heading">
					<a href="#" class="close-side-widget">X</a>
				</div>
                
				<div class="sidebar-textwidget">
					<!-- Sidebar Info Content -->
					<div class="sidebar-info-contents">
						<div class="content-inner">
							<div class="logo">
								<?php echo moko_logo( $logo_type, $sidebar_logo, $sidebar_logo_dimension, $logo_text, $logo_typography ); ?>
							</div>
							<div class="content-box">
								<h2><?php echo wp_kses($options->get('sidebar_about_title_v2'), $allowed_html); ?></h2>
								<p class="text"><?php echo wp_kses($options->get('sidebar_about_text_v2'), $allowed_html); ?></p>
                                <?php if( $options->get('show_sidebar_button_v2') ):
								if( $options->get('sidebar_button_link_v2') and $options->get('sidebar_button_name_v2') ):?>
								<a href="<?php echo esc_url($options->get('sidebar_button_link_v2')); ?>" class="theme-btn btn-style-<?php echo esc_attr($options->get('sidebar_button_style_v2')); ?>"><span class="txt"><?php echo wp_kses($options->get('sidebar_button_name_v2'), $allowed_html); ?></span></a>
                                <?php endif; endif; ?>
							</div>
							<div class="contact-info">
								<?php if( $options->get('sidebar_contact_title_v2') ): ?>
								<h2><?php echo wp_kses($options->get('sidebar_contact_title_v2'), $allowed_html); ?></h2>
								<?php endif; ?>
								<ul class="list-style-one">
									<?php if( $options->get('sidebar_address_v2') ): ?>
									<li><span class="icon fas fa-map-marker"></span><?php echo wp_kses($options->get('sidebar_address_v2'), $allowed_html); ?></li>
									<?php endif; ?>
									
									<?php if( $options->get('sidebar_phone_number_v2') ): ?>
									<li><span class="icon fas fa-phone"></span><a href="tel:<?php echo wp_kses(phone_number($options->get('sidebar_phone_number_v2')), $allowed_html); ?>"><?php echo wp_kses($options->get('sidebar_phone_number_v2'), $allowed_html); ?></a></li>
									<?php endif; ?>
									
									<?php if( $options->get('sidebar_email_address_v2') ): ?>
									<li><span class="icon fa fa-envelope"></span><a href="mailto:<?php echo sanitize_email($options->get('sidebar_email_address_v2')); ?>"><?php echo sanitize_email($options->get('sidebar_email_address_v2')); ?></a></li>
									<?php endif; ?>
									
									<?php if( $options->get('sidebar_working_hours_v2') ): ?>
									<li><span class="icon fas fa-clock"></span><?php echo wp_kses($options->get('sidebar_working_hours_v2'), $allowed_html); ?></li>
									<?php endif; ?>
								</ul>
							</div>
                            
                            <?php if( $options->get('show_sidebar_social_media_v2') ):
							$icons = $options->get( 'sidebar_social_media_v2' );
							if ( ! empty( $icons ) ) : ?>
							<!-- Social Box -->
							<ul class="social-box">
                            	<?php
								foreach ( $icons as $h_icon ) :
								$header_social_icons = json_decode( urldecode( moko_set( $h_icon, 'data' ) ) );
								if ( moko_set( $header_social_icons, 'enable' ) == '' ) {
									continue;
								}
								$icon_class = explode( '-', moko_set( $header_social_icons, 'icon' ) );
								?>
								<li><a href="<?php echo esc_url(moko_set( $header_social_icons, 'url' )); ?>" style="background-color:<?php echo esc_attr(moko_set( $header_social_icons, 'background' )); ?>; color: <?php echo esc_attr(moko_set( $header_social_icons, 'color' )); ?>" class="fab <?php echo esc_attr( moko_set( $header_social_icons, 'icon' ) ); ?>" target="_blank"></a></li>
								<?php endforeach; ?>
							</ul>
                            <?php endif; endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END sidebar widget item -->
    <?php endif; ?>
    