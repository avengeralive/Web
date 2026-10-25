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

$logo_type = '';
$logo_text = '';
$logo_typography = ''; ?>

<div class="<?php if($options->get('theme_boxed')) echo 'box-layout'; ?>">
<div class="page-wrapper hidden-bar-wrapper <?php if($options->get('theme_dark')) echo 'dark-body'; ?> <?php if($options->get('sticky_menu')) echo 'want-sticky-header'; ?> <?php if($options->get('theme_rtl')) echo 'rtl'; ?>">

	<?php if( $options->get( 'theme_preloader' ) ):?>
    <!-- Preloader -->
	<div class="preloader">
		<div class="box"></div>
	</div>
	<?php endif; ?>
    
    <!-- Main Header-->
    <header class="main-header header-style-one">
		<!--Header-Upper-->
        <div class="header-upper">
        	<div class="auto-container clearfix">
				<div class="pull-left logo-box">
					<div class="logo"><?php echo moko_logo( $logo_type, $light_image_logo, $light_logo_dimension, $logo_text, $logo_typography ); ?></div>
				</div>
				
				<div class="nav-outer clearfix">
					<!--Mobile Navigation Toggler-->
					<div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
					
					<?php if ( has_nav_menu( 'main_menu' ) ) { ?>
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
					<?php } ?>
					
					<!-- Main Menu End-->
					<div class="outer-box clearfix">
						<?php if( $options->get('show_button_v1') ):
						if( $options->get('button_link_v1') and $options->get('button_name_v1') ): ?>
						<!-- Quote Btn -->
						<div class="btn-box">
							<a href="<?php echo esc_url($options->get('button_link_v1')); ?>" class="theme-btn btn-style-<?php echo esc_attr($options->get('button_style_v1')); ?>"><span class="txt"><?php echo wp_kses($options->get('button_name_v1'), $allowed_html); ?></span></a>
						</div>
                        <?php endif; endif; ?>
                        
						<?php if( $options->get('show_search_v1') ): ?>
						<!-- Search Btn -->
						<div class="search-box-btn search-box-outer"><span class="icon fa fa-search"></span></div>
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
						<?php if( $options->get('show_button_v1') ):
						if( $options->get('button_link_v1') and $options->get('button_name_v1') ): ?>
						<!-- Quote Btn -->
						<div class="btn-box">
							<a href="<?php echo esc_url($options->get('button_link_v1')); ?>" class="theme-btn btn-style-<?php echo esc_attr($options->get('button_style_sticky_v1')); ?>"><span class="txt"><?php echo wp_kses($options->get('button_name_v1'), $allowed_html); ?></span></a>
						</div>
                        <?php endif; endif; ?>
                        
						<?php if( $options->get('show_search_v1') ):?>
						<!-- Search Btn -->
						<div class="search-box-btn search-box-outer"><span class="icon fa fa-search"></span></div>
						<?php endif; ?>
					</div>
                </div>
            </div>
        </div><!-- End Sticky Menu -->
    
		<!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-multiply"></span></div>
            <nav class="menu-box">
                <div class="nav-logo">
                	<?php echo moko_logo( $logo_type, $mobile_sidebar_logo, $mobile_sidebar_logo_dimension, $logo_text, $logo_typography ); ?>
                </div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            </nav>
        </div><!-- End Mobile Menu -->
    </header>
    <!-- End Main Header -->
    