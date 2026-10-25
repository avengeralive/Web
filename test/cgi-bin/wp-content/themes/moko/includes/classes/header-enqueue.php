<?php

namespace MOKO\Includes\Classes;


/**
 * Header and Enqueue class
 */
class Header_Enqueue {


	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue' ) );

		add_filter( 'wp_resource_hints', array( __CLASS__, 'resource_hints' ), 10, 2 );
	}

	/**
	 * Gets the arrays from method scripts and styles and process them to load.
	 * Styles are being loaded by default while scripts only enqueue and can be loaded where required.
	 *
	 * @return void This function returns nothing.
	 */
	public static function enqueue() {

		self::scripts();

		self::styles();

	}

	/**
	 * The major scripts loader to load all the scripts of the theme. Developer can hookup own scripts.
	 * All the scripts are being load in footer.
	 *
	 * @return array Returns the array of scripts to load
	 */
	public static function scripts() {
		$options = get_theme_mod( 'moko' . '_options-mods' );
		$ssl     = is_ssl() ? 'https' : 'http';

		$scripts = array(
			'popper' => 'assets/js/popper.min.js',
			'bootstrap' => 'assets/js/bootstrap.min.js',
			'jquery-mcustomscrollbar' => 'assets/js/jquery.mCustomScrollbar.concat.min.js',
			'jquery-fancybox' => 'assets/js/jquery.fancybox.js',
			'appear' => 'assets/js/appear.js',
			'parallax' => 'assets/js/parallax.min.js',
			'tilt-jquery' => 'assets/js/tilt.jquery.min.js',
			'jquery-paroller' => 'assets/js/jquery.paroller.min.js',
			'owl' => 'assets/js/owl.js',
			'wow' => 'assets/js/wow.js',
			'jquery-countdown' => 'assets/js/jquery.countdown.js',
			'mixitup' => 'assets/js/mixitup.js',
			'nav-tool' => 'assets/js/nav-tool.js',
			'jquery-ui' => 'assets/js/jquery-ui.js',
			'moko-main-script' => 'assets/js/script.js',
		);

		$scripts = apply_filters( 'MOKO/includes/classes/header_enqueue/scripts', $scripts );
		/**
		 * Enqueue the scripts
		 *
		 * @var array
		 */
		foreach ( $scripts as $name => $js ) {

			if ( strstr( $js, 'http' ) || strstr( $js, 'https' ) || strstr( $js, 'googleapis.com' ) ) {

				wp_register_script( "{$name}", $js, '', '', true );
			} else {
				wp_register_script( "{$name}", get_template_directory_uri() . '/' . $js, '', '', true );
			}
		}

		wp_enqueue_script( array(
			'jquery',
			'popper',
			'bootstrap',
			'jquery-mcustomscrollbar',
			'jquery-fancybox',
			'appear',
			'parallax',
			'tilt-jquery',
			'jquery-paroller',
			'owl',
			'wow',
			'jquery-countdown',
			'mixitup',
			'nav-tool',
			'jquery-ui',
			'moko-main-script'
		) );


		$header_data = array(
			'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			'nonce'   => wp_create_nonce( MOKO_NONCE ),
		);

		wp_localize_script( 'jquery', 'moko_data', $header_data );

		if ( moko_set( $options, 'footer_js' ) ) {

			wp_add_inline_script( 'jquery', moko_set( $options, 'footer_js' ) );
		}

	}

	/**
	 * The major styles loader to load all the styles of the theme. Developer can hookup own styles.
	 * All the styles are being load in head.
	 *
	 * @return array Returns the array of styles to load
	 */
	public static function styles() {
		$options = moko_WSH()->option();
		
		if( $options->get( 'main_color_scheme' ) ){
			$maincolor = str_replace( '#', '' , $options->get( 'main_color_scheme' ));
		}
		elseif( $options->get( 'predefined_color_scheme' ) ){
			$maincolor =  str_replace( '#', '' , $options->get( 'predefined_color_scheme' ));	
		}
		else{
			$maincolor = str_replace( '#', '' , '#f7941d' );	
		}
		
		$styles = array(
			'google-fonts' => self::fonts_url(),
			'bootstrap' => 'assets/css/bootstrap.css',
			'fontawesome-all' => 'assets/css/fontawesome-all.css',
			'flaticon' => 'assets/css/flaticon.css',
			'animate' => 'assets/css/animate.css',
			'owl' => 'assets/css/owl.css',
			'animation' => 'assets/css/animation.css',
			'jquery-ui' => 'assets/css/jquery-ui.css',
			'custom-animate' => 'assets/css/custom-animate.css',
			'jquery-fancybox' => 'assets/css/jquery.fancybox.min.css',
			'jquery-bootstrap-touchspin' => 'assets/css/jquery.bootstrap-touchspin.css',
			'jquery-mcustomscrollbar' => 'assets/css/jquery.mCustomScrollbar.min.css',
			'moko-main-style' => 'assets/css/style.css',
			'moko-custom' => 'assets/css/custom.css',
			'moko-gutenberg' => 'assets/css/gutenberg.css',
			'moko-tut' => 'assets/css/tut.css',
			'moko-responsive' => 'assets/css/responsive.css',
			'moko-woocommerce' => 'assets/css/woocommerce.css',
		);
		
		$styles = apply_filters( 'MOKO/includes/classes/header_enqueue/styles', $styles );

		/**
		 * Enqueue the styles
		 *
		 * @var array
		 */
		foreach ( $styles as $name => $style ) {

			if ( strstr( $style, 'http' ) || strstr( $style, 'https' ) || strstr( $style, 'fonts.googleapis' ) ) {
				wp_enqueue_style( "moko-{$name}", $style );
			} else {
				wp_enqueue_style( "moko-{$name}", get_template_directory_uri() . '/' . $style );
			}
		}
		$options      = moko_WSH()->option();
		$custom_style = '';

		wp_add_inline_style( 'color', $custom_style );

		$header_styles = self::header_styles(); 
		
		if ( $custom_font = $options->get('theme_custom_font') ) {
            $header_styles .= moko_custom_fonts_load( $custom_font );
        }

		wp_add_inline_style( 'moko-main-style', $header_styles );
	}

	/**
	 * Register custom fonts.
	 */
	public static function fonts_url() {
		$fonts_url = '';

		$font_families['Archivo'] = 'Archivo:wght@400,500,600,700';
		$font_families['Poppins'] = 'Poppins:wght@300,400,500,600,700,800,900';

		$font_families = apply_filters( 'MOKO/includes/classes/header_enqueue/font_families', $font_families );

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$protocol  = is_ssl() ? 'https' : 'http';
		$fonts_url = add_query_arg( $query_args, $protocol . '://fonts.googleapis.com/css' );

		return esc_url_raw($fonts_url);
	}


	/**
	 * Add preconnect for Google Fonts.
	 *
	 * @since MOKO 1.0
	 *
	 * @param array  $urls          URLs to print for resource hints.
	 * @param string $relation_type The relation type the URLs are printed.
	 *
	 * @return array $urls           URLs to print for resource hints.
	 */
	public static function resource_hints( $urls, $relation_type ) {
		if ( wp_style_is( 'moko-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		}

		return $urls;
	}

	/**
	 * header_styles
	 *
	 * @since MOKO 1.0
	 *
	 * @param array $urls URLs to print for resource hints.
	 */
	public static function header_styles() {

		$data = \MOKO\Includes\Classes\Common::instance()->data( 'blog' )->get();

		$options = moko_WSH()->option();

		$styles = '';
		if ( $options->get( 'footer_top_button' ) ) :
			$styles .= "#topcontrol {
				background: " . $options->get( 'button_bg' ) . " none repeat scroll 0 0 !important;
				opacity: 0.5;

				color: " . $options->get( 'button_color' ) . " !important;

			}";

		endif;

		$settings = get_theme_mod( 'moko' . '_options-mods' );

		if ( $custom_font = moko_set( $settings, 'theme_custom_font' ) ) {

			$styles .= apply_filters('moko_redux_custom_fonts_load', $custom_font );


		}

		return $styles;
	}


}